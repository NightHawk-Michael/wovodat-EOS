define(function(require) {
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
      CompositeGraphContainer = require('views/composite_graph_container'),
      CompositeGraph = require('views/composite_graph'),
      Filter = require('models/filter'),
      FilterSelect = require('views/filter_select'),
      Filters = require('collections/filters'),
      TimeRange = require('models/time_range'),
      TimeSeries = require('collections/series'),
      TimeSeriesContainer = require('views/time_series_container'),
      TimeRangeSelect = require('views/time_range_select'),
      Tooltip = require('views/series_tooltip'),
      TimeSeriesGraphContainer = require('views/time_serie_graph_container'),
      StackGraphContainer = require('views/stack_time_serie_graph_container'),
      StackGraph = require('views/stack_time_serie'),

      EventHandler = require('handler/event_handler'),
      FilterColorCollection = require('collections/filter_colors'),
      Offline = require('views/offline');

  return Backbone.View.extend({
    el: '#main',
    
    initialize: function(options) {
      this.selecting_vd_num = options.vnum;
      this.ed_stime_num = options.ed_stime;
      this.ed_etime_num = options.ed_etime;
      this.selectedTimeSeries = options.timeSeries;
      this.$el.html("");
      this.render();
    },
    render: function() {
      /**
      * Variables declaration
      **/
      //check offline mode
      var offline = false;
      if($('#offline').length > 0){
        offline = true;
      }else{
        offline = false;
      }
      var
          observer = new (Backbone.Model.extend())(),
          categories=["Seismic","Deformation","Gas","Hydrology","Thermal","Fields","Meteology"],
          selectingTimeSeries = new TimeSeries({
            offline: offline
          }),
          filterColorCollection = new FilterColorCollection({
            offline: offline
          }),
          selectingFilters = new Filters(),
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
          compositeGraphTimeRange = new TimeRange(),



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
            offline:offline,
            selectingTimeSeries: selectingTimeSeries,
            selectedTimeSeries: this.selectedTimeSeries,
            timeSeries: timeSeries,
            selectingFilters: selectingFilters
          }),
          filtersSelect = new FilterSelect({
            categories: categories,
            selectings: selectingTimeSeries,
            selectingFilters: selectingFilters
          }),
          overviewGraph = new OverviewGraph({
            categories: categories,
            selectingTimeSeries: this.overviewSelectingTimeSeries,
            serieGraphTimeRange: serieGraphTimeRange,
            selectingTimeRange: selectingTimeRange,
            overviewGraphTimeRange: overviewGraphTimeRange,
            offline: offline,
            filterColorCollection: filterColorCollection
          }),
          compositeGraph = new CompositeGraph({
            selectingTimeSeries: this.overviewSelectingTimeSeries,
            serieGraphTimeRange: serieGraphTimeRange,
            selectingTimeRange: selectingTimeRange,
            compositeGraphTimeRange: compositeGraphTimeRange,
            // collection: filterColorCollection
          }),

          overviewGraphContainer = new OverviewGraphContainer({
            categories: categories,
            selectingTimeSeries: selectingTimeSeries,
            serieGraphTimeRange: serieGraphTimeRange,
            observer: observer,
            graph: overviewGraph
          }),
          compositeGraphContainer = new CompositeGraphContainer({
            categories: categories,
            selectingTimeSeries: selectingTimeSeries,
            serieGraphTimeRange: serieGraphTimeRange,
            observer: observer,
            graph: compositeGraph
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
          stackGraph = new StackGraph({
            selectingTimeSeries: this.overviewSelectingTimeSeries,
            serieGraphTimeRange: serieGraphTimeRange,
            selectingTimeRange: selectingTimeRange,
            compositeGraphTimeRange: compositeGraphTimeRange,
            // collection: filterColorCollection
          }),
          eruptionForecastsGraph = new EruptionForecastsGraph({
            observer: observer,
            categories: categories,
            eruptionForecasts: eruptionForecasts

          }),
          stackGraphContainer = new StackGraphContainer({
            observer: observer,
            categories: categories,
            selectingTimeSeries: selectingTimeSeries,
            eruptionTimeRange: eruptionTimeRange,
            serieGraphTimeRange: serieGraphTimeRange,
            forecastsGraphTimeRange: forecastsGraphTimeRange,
            eruptions : eruptions,
            stackGraph : stackGraph,
            // timeRange: timeRange

          }),
          timeSeriesGraphContainer = new TimeSeriesGraphContainer({
            observer: observer,
            categories: categories,
            selectingTimeSeries: selectingTimeSeries,
            eruptionTimeRange: eruptionTimeRange,
            serieGraphTimeRange: serieGraphTimeRange,
            forecastsGraphTimeRange: forecastsGraphTimeRange,
            eruptions : eruptions,
            stackGraphContainer :stackGraphContainer,
            compositeGraphContainer :compositeGraphContainer
            // timeRange: timeRange

          }),


          // urlLoader = new UrlLoader({
          //   observer: observer,
          //   volcanoes: volcanoes,
          //   eruptions: eruptions,
          //   selectingEruptions: selectingEruptions
          // }),
          offline = new Offline({
            selectingVolcano : selectingVolcano,
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
            timeSeries :timeSeries,
            overviewGraph: overviewGraph,
            eruptionGraph: eruptionGraph,
            eruptionTimeRange: eruptionTimeRange,
            timeSeriesGraphContainer: timeSeriesGraphContainer,
            stackGraphContainer :stackGraphContainer,
            serieGraphTimeRange: serieGraphTimeRange,
            forecastsGraphTimeRange: forecastsGraphTimeRange,
            selectingTimeRange: selectingTimeRange,
            selectingFilters: selectingFilters,
            eruptionForecastsGraph: eruptionForecastsGraph,
            compositeGraph : compositeGraph,
            compositeGraphContainer : compositeGraphContainer,
            eruptions: eruptions,
            offline: offline,
            stackGraph : stackGraph
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
      stackGraphContainer.$el.appendTo(this.$el);
      compositeGraphContainer.$el.appendTo(this.$el);


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