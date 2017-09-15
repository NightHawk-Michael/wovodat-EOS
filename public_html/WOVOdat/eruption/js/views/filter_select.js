define(function (require) {
    'use strict';
    var $ = require('jquery'),
        Backbone = require('backbone'),
        _ = require('underscore'),
        Filter = require('models/filter'),
        Filters = require('collections/filters'),
        template = require('text!templates/filter.html'),
        loading = require('text!templates/loading.html'),
        Handlebars = require('handlebars'),
        materialize = require('material');

    return Backbone.View.extend({
        el: '',

        className: "mgt15",
        initialize: function (options) {

            this.observer = options.observer;
            this.selectingTimeSeries = options.selectingTimeSeries;
            this.selectingFilters = options.selectingFilters;
            this.categories = options.categories;
            this.urlFilter = options.urlFilter
            this.filters = [];
            for (var i = 0; i < this.categories.length; i++) {
                this.filters[this.categories[i]] = [];
            }
            this.dataRange = options.dataRange;

        },
        selectingTimeSeriesChanged: function (selectingTimeSeries) {
            this.selectingTimeSeries = selectingTimeSeries;
            // this.filters.reset();

            this.render(this.filters);


        },


        fetchFilterList: function () {
            var deferredObject = $.Deferred();
            this.filters = [];
            this.filters.empty = true;

            var getFilterListCalls = []
            for (var i = 0; i < this.selectingTimeSeries.models.length; i++) {
                getFilterListCalls.push(this.selectingTimeSeries.models[i].getFilterList(this.selectingTimeSeries));
            }
            var self = this;

            $.when.apply(this, getFilterListCalls).then(function () {
                console.log("getFilterListCalls Done");
                deferredObject.resolve("success");
            })
            return deferredObject.promise();
        },

        render: function (selectingTimeSeries) {

            this.selectingTimeSeries = selectingTimeSeries;
            var deferredObject = $.Deferred();

            // var categories=["Seismic","Deformation","Gas","Hydrology","Thermal","Field","Meteology"];
            // var selectingFilters = [];
            // for(var i = 0;i<categories.length;i++){
            //   selectingFilters = selectingFilters.concat(this.selectingFilters.getAllFilters(categories[i]));
            // }
            var categories = this.categories;
            var self = this;
            $.when(
                this.fetchFilterList()
            ).then(function () {
                var temp = Handlebars.compile(template);
                Handlebars.registerHelper('list', function (items, options) {
                    var ret = "";
                    for (var i = 0, j = items.length; i < j; i++) {
                        ret = ret + options.fn(items[i]);
                    }
                    return ret;
                });
                Handlebars.registerHelper('if', function (condition, options) {
                    if (condition) {
                        return options.fn(this);
                    } else {
                        return options.inverse(this);
                    }
                });
                for (var i = 0; i < categories.length; i++) {
                    var category = categories[i];
                    var options = {
                        series: self.generateData(category, self.selectingTimeSeries)
                    }
                    var html = temp(options);
                    $('.filter-field' + '.' + category).html(html);
                    $('.filter-select').material_select();

                }

                for (var j = 0; j < self.selectingFilters.length; j++) {
                    var temp = self.selectingFilters[j].split(".");
                    var selected = false;
                    for (var i = 0; i < self.selectingTimeSeries.models.length; i++) {
                        if (temp[0] === self.selectingTimeSeries.models[i].get("sr_id")) {
                            selected = true;
                        }
                    }
                    if(!selected){
                        self.selectingFilters.splice(j,1);
                        j--;
                    }
                }
                if (self.selectingFilters.length != 0) {
                    self.trigger("show-overview-graph");
                }else{
                    self.trigger("hide-overview-graph");
                }
                deferredObject.resolve("success");
            });


            // this.showGraph();
            // //selectedFIlter only valid at the first time of loading
            // if(this.dataRange != undefined && tempFilter){
            //     this.dataRange.op = "";
            //     this.selectedFilter = undefined;
            // }
            return deferredObject.promise();
            //this.selectedFilter = undefined; // selectedFIlter only valid at the first time of loading
        },
        //generate data for html template
        /* {[{nodata,
         name,
         filter:[{isSelected,value,showingName}]
         }]} */
        generateData: function (category, selectingTimeSeries) {
            var output = [];
            var selectingFilters = this.selectingFilters
            for (var i = 0; i < selectingTimeSeries.models.length; i++) {
                var item = selectingTimeSeries.models[i].attributes;
                if (item.category === category) {
                    //get Filters
                    var filters = [];
                    for (var j = 0; j < item.data.filters.length; j++) {
                        var value = item.sr_id + "." + item.data.filters[j];
                        var isSelected = true;
                        if (!selectingFilters.includes(value)) {
                            isSelected = false;
                        }
                        filters.push({isSelected: isSelected, value: value, showingName: item.data.filters[j]});
                    }

                    var item2 = {
                        nodata: !item.data.hasData,
                        hasFilter: item.data.hasFilter,
                        name: item.showingName,
                        filters: filters
                    }
                    if (!item2.hasFilter) {
                        var filterID = filters[0].value;
                        var pos = this.selectingFilters.indexOf(filterID);
                        if (pos == -1) {
                            this.selectingFilters.push(filterID);
                        }
                    }
                    output.push(item2);
                }
            }
            return output;
        },
        hide: function () {
            this.$el.html("");

            var categories = this.categories;
            for (var i = 0; i < categories.length; i++) {
                delete this.selectingFilters[categories[i]];
            }
            this.selectingFilters.empty = true;
            // this.render();
            this.trigger('hide');

        },

        filterSelectChange: function (filterID) {
            if (filterID.split(".")[1] == " ") {
                var checkbox = {checked: true}
            } else {
                var temp = document.getElementById(filterID);
                var checkbox = $(temp)[0];
            }

            if (filterID == this.urlFilter) {
                checkbox.checked = true;
            } else {
                var pos = this.selectingFilters.indexOf(filterID);
                if (checkbox.checked) {

                    if (pos == -1) {
                        this.selectingFilters.push(filterID);
                    }
                } else {
                    if (pos != -1) {
                        this.selectingFilters.splice(pos, 1);
                    }
                }
            }
            this.trigger('show-overview-graph');


        },
        destroy: function () {
            // From StackOverflow with love.
            this.undelegateEvents();
            this.$el.removeData().unbind();
            this.remove();
            Backbone.View.prototype.remove.call(this);
        }
    });
});