define(function (require) {
    'use strict';
    var $ = require('jquery'),
        Backbone = require('backbone'),
        Serie = require('models/serie');
    //1
    return Backbone.Collection.extend({
        model: Serie,
        modelsMap: {},

        initialize: function (options) {
            // this.isVocalnoChanged = false;
            this.offline = options.offline;
        },
        /**
         *
         * @param vd_id
         * @return differed Object
         */
        changeVolcano: function (vd_id) {
            var deferredObject = $.Deferred();
            this.data = {};
            this.vd_id = vd_id;
            if (this.offline) {
                this.url = 'offline-data/time_series_list.json';
            } else {
                this.url = 'api/?data=time_series_list&vd_id=' + vd_id;
            }

            var categories = ["Seismic", "Deformation", "Gas", "Hydrology", "Thermal", "Field", "Meteology"];
            for (var i = 0; i < categories.length; i++) {
                delete this[categories[i]];
            }
            this.length = 0;
            var self = this;
            this.fetch({
                success: function (collection, response) {
                    //group Data in categroy

                    var currentCategory = "";
                    //success: function(collection,response){
                    for (var i = 0; i < response.length; i++) {
                        var model = collection.models[i];
                        var item = model.attributes;
                        var station1 = "";
                        var station2 = "";
                        if (item.station_id1 == item.station_id2) {
                            station1 = item.station_code1;
                            station2 = "";
                        } else {
                            if (item.station_id1 == "0") {
                                station1 = "";
                                station2 = item.station_code2;
                            } else {
                                station1 = item.station_code1;
                                if (item.station_id == "0") {
                                    station2 = "";
                                } else {
                                    station2 = " - " + item.station_code2;
                                }
                            }
                        }
                        model.attributes.showingName = station1 + station2 + "(" + item.component + ")";
                        if (self.offline) {
                            model.url = 'offline-data/' + model.attributes.sr_id + '.json';
                        } else {
                            model.updateURL(vd_id);
                        }
                        if (currentCategory == "" | currentCategory != item.category) {
                            collection[item.category] = [];
                            currentCategory = item.category;
                        }
                        collection[currentCategory].push(model);
                        // collection.length++;
                    }
                    deferredObject.resolve("success");
                }
            });
            return deferredObject.promise()

        },

        /**
         *
         * @param series : {sr_id : String}
         * @returns time series with given sr_id
         */
        get: function (series) {
            if (this.modelsMap[series.sr_id] !== undefined) {
                return this.modelsMap[series.sr_id];
            }
            for (var i = 0; i < this.models.length; i++) {
                if (series.sr_id !== undefined) {
                    if (this.models[i].get('sr_id') === series.sr_id) {
                        return this.models[i];
                    }
                } else {
                    if (this.models[i].get('category') === series.category
                        && this.models[i].get('component') === series.component
                        && this.models[i].get('data_type') === series.data_type
                        && this.models[i].get('station_id2') === series.sta_id1
                        && this.models[i].get('station_id2') === series.sta_id2
                    ) {
                        return this.models[i];
                    }
                }
            }
        },
    });
});