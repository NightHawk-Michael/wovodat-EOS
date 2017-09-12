define(function (require) {
    'use strict';
    var $ = require('jquery'),
        Backbone = require('backbone'),
        _ = require('underscore'),
        Pace = require('pace'),

        template = require('text!templates/page.html'),
        Volcano = require('models/volcano'),
        Volcanoes = require('collections/volcanoes'),
        VolcanoSelect = require('views/volcano_select'),
        TimeSeriesSelect = require('views/time_series_select'),
        Eruption = require('models/eruption'),
        Eruptions = require('collections/eruptions'),
        EruptionSelect = require('views/eruption_select'),
        EruptionGraph = require('views/eruption_graph'),
        EruptionForecasts = require('collections/eruption_forecasts'),
        EruptionForecastsGraph = require('views/eruption_forecast_graph'),
        TimeSerie = require('models/serie'),
        // TimeSeriesSelect = require('views/time_series_select'),
        OverviewGraphContainer = require('views/overview_graph_container'),
        OverviewGraph = require('views/overview_graph'),
        Filter = require('models/filter'),
        FilterSelect = require('views/filter_select'),
        Filters = require('collections/filters'),
        TimeRange = require('models/time_range'),
        TimeSeries = require('collections/series'),
        // TimeSeriesContainer = require('views/time_series_container'),
        Tooltip = require('views/series_tooltip'),
        TimeSeriesGraphContainer = require('views/time_serie_graph_container'),
        EventHandler = require('handler/event_handler'),
        FilterColorCollection = require('collections/filter_colors'),
        Offline = require('views/offline'),
        ProgressBar = require('text!templates/progressbar.html');
    return Backbone.View.extend({
        el: '#main',

        initialize: function (options) {
            this.selecting_vd_num = options.vnum;
            var op="";
            var threshold=-1000000;
            if (options.dataRange != undefined){
                op = options.dataRange.substr(0,1);
                threshold = parseFloat(options.dataRange.substr(1,options.dataRange.length));

            }
            if(options.ed_etime != undefined&&options.ed_stime != undefined ){
                this.ed_stime_num = new Date(options.ed_stime.replace(" ","T")).getTime();
                this.ed_etime_num = new Date(options.ed_etime.replace(" ","T")).getTime();
            }

            this.urlTimeSeries = {};
            if(options.dataType != undefined){
                var temp = options.dataType.split("(");
                if(temp[1]!=undefined){
                    temp[1] = temp[1].slice(0,-1) // remove brackets
                }else{
                    temp[1] = " "; // no filter
                }
                this.urlTimeSeries = {
                    dataType: temp[0].trim(),
                    filter: temp[1],
                    dataRange: {
                        op: op,
                        threshold: threshold
                    },
                    dataMinTime: new Date(options.dataMinTime.replace(" ","T")).getTime(),
                    dataMaxTime: new Date(options.dataMaxTime.replace(" ","T")).getTime(),
                };
            }

            this.$el.html("");
            this.render();
        },
        render: function () {
            /**
             * Variables declaration
             **/
                //check offline mode
            var offline = false;
            if ($('#offline').length > 0) {
                offline = true;
            } else {
                offline = false;
            }
            var
                observer = new (Backbone.Model.extend())(),
                categories = ["Seismic", "Deformation", "Gas", "Hydrology", "Thermal", "Fields", "Meteology"],
                selectingTimeSeries = new TimeSeries({
                    offline: offline
                }),
                filterColorCollection = new FilterColorCollection({
                    offline: offline
                }),
                selectingFilters = [],
                volcanoes = new Volcanoes({
                    offline: offline
                }),
                selectingEruptions = new Eruptions({
                    offline: offline
                }),
                eruptions = new Eruptions({
                    offline: offline
                }),
                eruptionForecasts = new EruptionForecasts({
                    offline: offline
                }),
                selectingVolcano = new Volcano(),
                timeSeries = new TimeSeries({
                    offline: offline
                }),
                serieGraphTimeRange = new TimeRange(),
                forecastsGraphTimeRange = new TimeRange(),
                selectingTimeRange = new TimeRange(),
                eruptionTimeRange = new TimeRange(),
                overviewGraphTimeRange = new TimeRange(),


                volcanoSelect = new VolcanoSelect({
                    collection: volcanoes,
                    categories: categories,
                    offline: offline,
                    selectingVolcano: selectingVolcano,
                    selecting_vd_num: this.selecting_vd_num
                }),

                timeSeriesSelect = new TimeSeriesSelect({
                    categories: categories,
                    volcano: selectingVolcano,
                    offline: offline,
                    selectingTimeSeries: selectingTimeSeries,
                    urlTimeSeries: this.urlTimeSeries,
                    timeSeries: timeSeries,
                }),
                filtersSelect = new FilterSelect({
                    categories: categories,
                    selectings: selectingTimeSeries,
                    selectingFilters: selectingFilters,
                    urlFilters: this.urlTimeSeries.filter,
                    dataRange: this.urlTimeSeries.dataRange,
                }),
                overviewGraph = new OverviewGraph({
                    categories: categories,
                    selectingTimeSeries: this.overviewSelectingTimeSeries,
                    serieGraphTimeRange: serieGraphTimeRange,
                    selectingTimeRange: selectingTimeRange,
                    overviewGraphTimeRange: overviewGraphTimeRange,
                    offline: offline,
                    initialDataMaxTime: this.urlTimeSeries.dataMaxTime,
                    initialDataMinTime: this.urlTimeSeries.dataMinTime,
                    filterColorCollection: filterColorCollection
                }),

                overviewGraphContainer = new OverviewGraphContainer({
                    categories: categories,
                    selectingTimeSeries: selectingTimeSeries,
                    serieGraphTimeRange: serieGraphTimeRange,
                    observer: observer,
                    graph: overviewGraph
                }),

                eruptionSelect = new EruptionSelect({
                    categories: categories,
                    eruptions: eruptions,
                    eruptionForecasts: eruptionForecasts,
                    observer: observer,
                    selectingEruptions: selectingEruptions,
                    selecting_vd_num: this.selecting_vd_num,
                    ed_stime_num: this.ed_stime_num,
                    ed_etime_num: this.ed_etime_num,
                    selectingTimeRange: selectingTimeRange,
                }),


                eruptionGraph = new EruptionGraph({
                    //eruptions: eruptions,
                    observer: observer,
                    categories: categories,
                    serieGraphTimeRange: serieGraphTimeRange,
                    forecastsGraphTimeRange: forecastsGraphTimeRange,
                    eruptionTimeRange: eruptionTimeRange,
                    overviewGraphTimeRange: overviewGraphTimeRange,
                    selecting_vd_num: this.selecting_vd_num,
                    ed_stime_num: this.ed_stime_num,
                    ed_etime_num: this.ed_etime_num
                }),

                eruptionForecastsGraph = new EruptionForecastsGraph({
                    observer: observer,
                    categories: categories,
                    eruptionForecasts: eruptionForecasts

                }),
                timeSeriesGraphContainer = new TimeSeriesGraphContainer({
                    observer: observer,
                    categories: categories,
                    selectingTimeSeries: selectingTimeSeries,
                    eruptionTimeRange: eruptionTimeRange,
                    serieGraphTimeRange: serieGraphTimeRange,
                    forecastsGraphTimeRange: forecastsGraphTimeRange,
                    selectedVolcano : selectingVolcano,
                    // timeRange: timeRange

                }),
                offline = new Offline({
                    selectingVolcano: selectingVolcano,
                    volcanoes: volcanoes,
                    eruptions: eruptions,
                    timeSeries: timeSeries,
                    eruptionForecasts: eruptionForecasts,
                    filterColorCollection: filterColorCollection
                }),


                eventHandler = new EventHandler({
                    categories: categories,
                    volcanoSelect: volcanoSelect,
                    timeSeriesSelect: timeSeriesSelect,
                    filtersSelect: filtersSelect,
                    overviewGraphContainer: overviewGraphContainer,
                    eruptionSelect: eruptionSelect,
                    selectingVolcano: selectingVolcano,
                    selectingEruptions: selectingEruptions,
                    selectingTimeSeries: selectingTimeSeries,
                    timeSeries: timeSeries,
                    overviewGraph: overviewGraph,
                    eruptionGraph: eruptionGraph,
                    eruptionTimeRange: eruptionTimeRange,
                    timeSeriesGraphContainer: timeSeriesGraphContainer,
                    serieGraphTimeRange: serieGraphTimeRange,
                    forecastsGraphTimeRange: forecastsGraphTimeRange,
                    selectingTimeRange: selectingTimeRange,
                    selectingFilters: selectingFilters,
                    eruptionForecasts: eruptionForecasts,
                    eruptionForecastsGraph: eruptionForecastsGraph,
                    eruptions: eruptions,
                    offline: offline,

                });
            //console.log(volcanoes);
            // console.log(filterColorCollection);
            // console.log(overviewGraph);
            /** Body **/
            // var test = new TimeSerie('58166f4b40cca4e8ed2522b5f00bc756');
            // test.fetch({
            //   success: function(collection, response) {
            //     console.log(response);
            //   }
            // });
            volcanoSelect.$el.appendTo(this.$el);
            offline.$el.appendTo(this.$el);
            timeSeriesSelect.$el.appendTo(this.$el);
            filtersSelect.$el.appendTo(this.$el);
            overviewGraphContainer.$el.appendTo(this.$el);
            eruptionSelect.$el.appendTo(this.$el);
            eruptionGraph.$el.appendTo(this.$el);
            eruptionForecastsGraph.$el.appendTo(this.$el);
            timeSeriesGraphContainer.$el.appendTo(this.$el);
            this.$el.append(ProgressBar);
            // $('#progressbar').modal();
            // urlLoader.$el.appendTo(this.$el);

            // new EruptionForecastGraph({
            //   collection: new EruptionForecasts(),
            //   observer: observer,
            //   timeRange: timeRange,
            //   volcano: selectingVolcano
            // }).$el.appendTo(this.$el);


        }
    });
});