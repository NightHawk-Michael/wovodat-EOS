define(['jquery', 'backbone'], function ($, Backbone) {
    'use strict';

    return Backbone.Model.extend({


        initialize: function (options) {

            // Your server goes below
            //options.url = 'http://localhost:8000' + options.url;
            // this.sr
            if (!options.offline) {
                this.url = 'api/?data=time_serie';
                for (var property in options) {
                    if (options.hasOwnProperty(property)) {
                        // do stuff
                        this.url = this.url + "&serie[" + property + "]=" + options[property];
                    }
                }
            } else {
                this.url = 'offline-data/' + options.sr_id + '.json';
            }


            this.loaded = false;

        },
        getName: function () {
            var data = this.attributes;
            var station1 = "";
            var station2 = "";
            if (data.station_id1 == data.station_id2) {
                station1 = data.station_code1;
                station2 = "";
            } else {
                if (data.station_id1 == "0") {
                    station1 = "";
                    station2 = data.station_code2;
                } else {
                    station1 = data.station_code1;
                    if (data.station_id == "0") {
                        station2 = "";
                    } else {
                        station2 = " - " + data.station_code2;
                    }
                }
            }
            var component = data.component;
            return station1 + station2 + "(" + component + ")";

        },
        updateURL: function (vd_id) {
            this.url = this.url + "&vd_id=" + vd_id;
        },
        /** return the data of time serie in term of filter in jquery deferred object**/
        getDataFromFilter: function (filterName) {
            if (!options.offline) {
                var url = this.url + "&serie[filter]=" + filterName;
                return $.getJSON(url);
            } else {
                var data = [];
                var serieDatas = this.get('data').data;
                for (var i = 0; i < serieDatas.length; i++) {
                    var serieData = serieDatas[i];
                    if (filterName == serieData.filter) {
                        data.push(serieData);
                    }

                }
                return data;
            }

        },
        getFilterList: function (selectingTimeSeries) {

            var deferredObject = $.Deferred();
            if(this.loaded){
                deferredObject.resolve("success");
                return deferredObject;
            }
            this.selectingTimeSeries = selectingTimeSeries;
            var self = this;

            this.fetch({
                success: function (model, response) {
                    model.loaded = true;
                    var filters = response.data.filters;
                    if (filters.length == 0) {
                        response.data.hasData = false;
                    } else {
                        response.data.hasData = true;
                    }
                    if (filters[0] === " " && filters.length===1) {
                        response.data.hasFilter = false;
                    } else {
                        response.data.hasFilter = true;
                    }
                    deferredObject.resolve("success");
                }
            });
            // $.getJSON(url,function(result){
            //     self.filters = result.filters;
            //     //no data
            //     if(self.filters[0] === "  "){
            //         self.hasData = false;
            //     }else{
            //         self.hasData  = true;
            //     }
            //     if(self.filters[0] === " "){
            //         self.hasFilter = false;
            //     }else{
            //         self.hasFilter  = true;
            //     }
            //
            // });

            return deferredObject.promise();
        }

    });
});