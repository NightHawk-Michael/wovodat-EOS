define(function (require) {
    'use strict';
    var $ = require('jquery'),
        Backbone = require('backbone'),
        _ = require('underscore'),
        flot = require(['jquery.flot', 'jquery.flot.time', 'jquery.flot.navigate', 'jquery.flot.selection', 'excanvas', 'jquery.flot.errorbars', 'jquery.flot.legendoncanvas', 'jquery.flot.axislabels']),
        GraphHelper = require('helper/graph'),
        loading = require('text!templates/loading.html'),
        FilterColorCollection = require('collections/filter_colors');
    return Backbone.View.extend({
        loading: _.template(loading),
        initialize: function (options) {

            this.serieGraphTimeRange = options.serieGraphTimeRange;
            this.timeRange = options.overviewGraphTimeRange;
            this.selectingTimeRange = options.selectingTimeRange;
            this.filterColorCollection = new FilterColorCollection({
                offline: options.offline
            });
            this.initialDataMaxTime = options.initialDataMaxTime;
            this.initialDataMinTime = options.initialDataMinTime;
            this.categories = options.categories;
            //console.log(this.filterColorCollection);

        },

        show: function (selectingFilters, selectingTimeSeries) {
            this.selectingFilters = selectingFilters;
            this.selectingTimeSeries = selectingTimeSeries;
            if (selectingFilters.length == 0) {
                this.hide();
            }
            this.update();
        },
        onSelect: function (event, ranges) {

            var timerange = {
                minX: ranges.xaxis.from,
                maxX: ranges.xaxis.to
            };
            // console.log(ranges.xaxis);
            // console.log(event.data);
            event.data.target.trigger('selecting-time-range-change', timerange);

        },
        //selectingRegionChanged: function(selectingTimeRange){
        //this.$el.bind('plotselected',this.selectingTimeRange,this.plotSelectingRegion);
        //console.log(2);
        //},
        //plotSelectingRegion

        selectingRegionChanged: function (selectingTimeRange) {
            if(this.graph == undefined){
                return;
            }
            // console.log(selectingTimeRange);
            var selectedMinX = selectingTimeRange.minX;
            var selectedMaxX = selectingTimeRange.maxX;
            this.graph.setSelection({
                xaxis: {
                    from: selectedMinX,
                    to: selectedMaxX,
                }
            }, true)
        },

        hide: function () {
            this.$el.html("");
            this.$el.width(0);
            this.$el.height(0);
            this.trigger('hide');
        },
        render: function () {
            // this.showLoading();
            if (this.initialDataMinTime != undefined) {
                this.minX = this.initialDataMinTime;
            }
            if (this.initialDataMaxTime != undefined) {
                this.maxX = this.initialDataMaxTime;
            }
            var options = {
                grid: {
                    margin: 20,
                    minBorderMargin: 20
                },
                xaxis: {
                    mode: 'time',
                    timeformat: "%d-%b<br>%Y",
                    autoscale: true,
                    canvas: true,
                    rotateTicks: 90,
                    min: this.minX,
                    max: this.maxX,
                    limit: 1000,
                    // minTickSize: [1, "month"],
                    ticks: 6,
                },
                yaxis: {
                    show: true,
                    color: '#00000000',
                    canvas: false,
                    min: this.minY,
                    max: this.maxY,

                    autoscaleMargin: 5,
                    labelWidth: 40
                },
                selection: {
                    mode: 'x',
                    color: '#451A2B'
                },
                zoom: {
                    interactive: false,
                },
                pan:{
                    interactive: false,
                },
                legend: {
                    type: 'canvas'
                },
            };
            //pass color into options
            options.colors = ["#000000", "#afd8f8", "#cb4b4b", "#4da74d", "#9440ed"];

            if (!this.data || !this.data.length) {
                this.$el.html(''); //$(this) = this.$el
                return;
            }
            ;

            this.$el.width('auto');
            this.$el.height(200);
            this.$el.addClass("overview-graph");

            //limit data to be rendered

            // console.log(this.data);
            this.graph = $.plot(this.$el, this.data, options);
            //To edit the series object, go to GraphHelper used for data in the prepareData method below.
            var eventData = {
                target: this,
                graphMinX: this.minX,
                graphMaxX: this.maxX
            };

            //this.$el.bind('plotselected', this.selectingTimeRange, this.onSelect);
            this.$el.bind('plotselected', eventData, this.onSelect);
            this.initialDataMinTime = this.initialDataMaxTime = undefined;

            // eventData.data.set({
            //     'minX': eventData.graphMinX,
            //     'maxX': eventData.graphMaxX,
            //     'overviewGraphMinX': eventData.graphMinX,
            //     'overviewGraphMaxX': eventData.graphMaxX
            // });
            // console.log(ranges.xaxis);
            // console.log(event.data);
            this.trigger("show",{MinX: eventData.graphMinX, MaxX: eventData.graphMaxX});

        },

        update: function () {
            this.prepareData();
            this.render();
        },


        prepareData: function () {


            var filters = [];
            for (var i = 0; i < this.selectingFilters.length; i++) {
                var temp = this.selectingFilters[i].split(".");
                filters.push ({value : this.selectingFilters[i],sr_id:temp[0],filterName: temp[1]});

            }
            //console.log(filters);
            // this variable helps to set color for each earthquake type
            var earthquakeTypeColor = this.filterColorCollection;
            // Preset color for each filter data to achieve color coherence in between overview and time series graph.
            var presetColorArray = ["#000000", "#396ab1", "#cb4b4b", "#4da74d", "#9440ed", "#948b3d", "#da7c30", "#cb1480", "#85004e", "#19d1d6"];
            // ensure the color will not be repeated unless it has reached the end of the presetColorArray
            var counter = 0;
            for (var i = 0; i < filters.length; i++) {
                var currentFilter = filters[i];
                    // Checking whether the filterAtribute name is an earthquake type (eg.R,v,...).
                    // If yes, then use the pre-assigned color in the database.
                    // Else use the color from the presetColorArray above.
                    var graphColorForEarthquakeType = null;
                    for (var j = 0; j < earthquakeTypeColor.length; j++) {
                        if (currentFilter.filterName == earthquakeTypeColor.models[j].id) {
                            graphColorForEarthquakeType = earthquakeTypeColor.models[j].attributes.color;
                            break;
                        }
                    }
                    //console.log(currentFilterAttributes.color);
                    if (graphColorForEarthquakeType == null) {
                        var colorPos = counter % (presetColorArray.length);
                        currentFilter.color = presetColorArray[colorPos];
                        counter++;
                    }
                    else {
                        currentFilter.color = graphColorForEarthquakeType;
                    }
                    //console.log(counter);

            }


            var allowErrorbar = false;
            var allowAxisLabel = false;
            //console.log(this.serieGraphTimeRange);
            //var adjustTimeRange = false;
            //formatData: function(graph,filters,allowErrorbar,allowAxisLabel,limitNumberOfData)
            GraphHelper.formatData(this, filters, allowErrorbar, allowAxisLabel,this.selectingTimeSeries);

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