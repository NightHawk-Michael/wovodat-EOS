/**
 EventHandler: handle all event of all elements in page
 Author: Fabio 17-Jun-2015
 **/
define(function (require) {
    'use strict';
    var $ = require('jquery'),
        Backbone = require('backbone'),
        _ = require('underscore'),
    materialize = require('material');
    return Backbone.Model.extend({

        initialize: function (options) {
            _(this).bindAll(
                // 'onSelectVolcanoChanged',
                'changeVolcano',
                'makeOffline',
                // 'timeSeriesChanged',
                'showFilters',
                // 'onAddSelectingTimeSeries',
                // 'onRemoveSelectingTimeSeries',
                // 'onResetSelectingTimeSeries',
                // 'timeSeriesChanged',
                'filtersSelectChange',
                'selectingTimeSeriesChanged',
                // 'selectingTimeSeriesChangedCheck',
                'changeSelectingEruptions',
                'seriesGraphTimeRangeChanged',
                'selectingTimeRangeChanged',
                'selectingFiltersChanged',
                'eruptionGraphTimeRangeChanged',
                // 'eruptionsFetched',
                'timeSeriesSelectHidden',
                'filtersSelectHidden',
                'showOverviewGraph',
                'overviewGraphHidden',
                'overviewGraphShown',
                'eruptionSelectHidden',
                'eruptionGraphHidden',
                'eruptionGraphShown',
                'highlightOverViewGraphChanged'
            );
            //Variable declaration
            this.numProcesses = 0;
            this.volcanoSelect = options.volcanoSelect;
            this.timeSeriesSelect = options.timeSeriesSelect;
            this.overviewGraphContainer = options.overviewGraphContainer;
            this.eruptionSelect = options.eruptionSelect;
            this.selectingVolcano = options.selectingVolcano;
            this.selectingEruptions = options.selectingEruptions;
            this.selectingTimeSeries = options.selectingTimeSeries;
            this.timeSeries = options.timeSeries;
            this.overviewGraph = options.overviewGraph;
            this.eruptionGraph = options.eruptionGraph;
            this.timeSeriesGraphContainer = options.timeSeriesGraphContainer;
            this.serieGraphTimeRange = options.serieGraphTimeRange;
            this.eruptionTimeRange = options.eruptionTimeRange;
            this.forecastsGraphTimeRange = options.forecastsGraphTimeRange;
            this.selectingTimeRange = options.selectingTimeRange;
            this.filtersSelect = options.filtersSelect;
            this.selectingFilters = options.selectingFilters;
            this.eruptionForecasts = options.eruptionForecasts;
            this.eruptionForecastsGraph = options.eruptionForecastsGraph;
            this.eruptions = options.eruptions;
            this.offline = options.offline;
            this.progressbar = $("#progressbar");
            //event listeners
            this.listenTo(this.selectingVolcano, 'update', this.changeVolcano);
            this.listenTo(this.volcanoSelect, 'make-offline', this.makeOffline);
            this.listenTo(this.timeSeriesSelect, "show-filters", this.showFilters);
            this.listenTo(this.timeSeriesSelect, "filter-select-change", this.filtersSelectChange);
            this.listenTo(this.selectingEruptions, 'add', this.changeSelectingEruptions);
            this.listenTo(this.timeSeriesGraphContainer, 'update-time-range', this.seriesGraphTimeRangeChanged);
            this.listenTo(this.eruptionGraph, 'eruption-graph-time-range-change', this.eruptionGraphTimeRangeChanged);


            this.listenTo(this.forecastsGraphTimeRange, 'update', this.forecastsGraphTimeRangeChanged);
            this.listenTo(this.overviewGraph, 'selecting-time-range-change', this.selectingTimeRangeChanged);
            this.listenTo(this.serieGraphTimeRange, 'zoom', this.highlightOverViewGraphChanged);
            this.listenTo(this.eruptionTimeRange, 'update', this.eruptionTimeRangeChanged);
            // this.listenTo(this.eruptions, 'fetched', this.eruptionsFetched);
            /**
             * Events when some part is hidden
             */
            this.listenTo(this.timeSeriesSelect, 'hide', this.timeSeriesSelectHidden);
            this.listenTo(this.filtersSelect, 'hide', this.filtersSelectHidden);
            this.listenTo(this.filtersSelect, 'show-overview-graph', this.showOverviewGraph);
            this.listenTo(this.filtersSelect, 'hide-overview-graph', this.hideOverviewGraph);
            this.listenTo(this.overviewGraph, 'hide', this.overviewGraphHidden);
            this.listenTo(this.overviewGraph, 'show', this.overviewGraphShown);
            //
            // this.listenTo(this.eruptionSelect, 'hide', this.eruptionSelectHidden);
            // this.listenTo(this.eruptionGraph, 'hide', this.eruptionGraphHidden);
            this.listenTo(this.eruptionGraph, 'show', this.eruptionGraphShown);


            // this.listenTo(this.selectingEruptions, 'reset', this.resetSelectingEruptions);

        },
        // onSelectVolcanoChanged: function(e){
        //   this.volcanoSelect.onSelectChanged(this.selectingVolcano);
        // },
        turnProgressbar: function (on) {
            this.progressbar = $("#progressbar");
            if (on) {
                this.numProcesses++;
                if (this.numProcesses > 0) {
                    this.progressbar.css("display", "block");
                    // this.progressbar.modal('open');
                }

            } else {
                this.numProcesses--;
                if (this.numProcesses === 0) {
                    this.progressbar.css("display", "none");
                    // this.progressbar.modal('close');
                }

            }
        },
        changeVolcano: function (e) {
            this.turnProgressbar(true);
            var vd_id = this.selectingVolcano.get('vd_id');
            console.log("volcano start");
            var self = this;
            $.when(
                // this.volcanoSelect.changeSelection(vd_id),
                this.timeSeries.changeVolcano(vd_id),
                this.eruptions.changeVolcano(vd_id),
                this.eruptionForecasts.changeVolcano(vd_id)
            ).then(function () {

                    console.log("volcano done");
                    self.eruptionSelect.changeVolcano(self.eruptions);
                    self.timeSeriesSelect.changeVolcano(vd_id, self.timeSeries);

                    self.eruptionGraph.initialEruption(self.eruptionSelect.availableEruptions);
                    self.eruptionForecastsGraph.show();
                    self.turnProgressbar(false);
                }
            );

            //this.eruptionSelect.show();
        },

        // updateTimeSeriesData: function(e){
        //   var vd_id = this.selectingVolcano.get('vd_id');
        //   this.timeSeriesSelect.updateVolcanoData(vd_id, this.timeSeries);
        // },
        makeOffline: function (e) {
            this.offline.makeOffline(this.selectingVolcano);
        },
        filtersSelectChange: function (filterID) {
            this.filtersSelect.filterSelectChange(filterID);
        },
        selectingTimeSeriesChanged: function (e) {
            console.log("Asd");
        },
        selectingFiltersChanged: function (e) {
            this.overviewGraphContainer.selectingFiltersChanged(this.selectingFilters);
            this.overviewGraph.selectingFiltersChanged(this.selectingFilters);
            this.timeSeriesGraphContainer.selectingFiltersChanged(this.selectingFilters, this.selectingTimeSeries);
        },
        showOverviewGraph: function () {
            this.turnProgressbar(true);
            this.overviewGraphContainer.show(this.selectingFilters);
            this.overviewGraph.show(this.selectingFilters, this.selectingTimeSeries);
            this.timeSeriesGraphContainer.selectingFiltersChanged(this.selectingFilters, this.selectingTimeSeries);
            this.turnProgressbar(false);
        },
        hideOverviewGraph: function () {
            this.overviewGraphContainer.hide();
            this.overviewGraph.hide();
            this.timeSeriesGraphContainer.selectingFiltersChanged(this.selectingFilters, this.selectingTimeSeries);
        },
        changeSelectingEruptions: function (e) {
            this.eruptionGraph.initialEruption(this.eruptionSelect.availableEruptions);
            this.eruptionGraph.changeEruption(e, this.selectingTimeRange);
            this.eruptionForecastsGraph.changeEruption(e);
        },
        timeSeriesSelectHidden: function (e) {
            this.filtersSelect.hide();


        },
        filtersSelectHidden: function (e) {
            this.overviewGraph.hide();
            this.overviewGraphContainer.hide();
            this.overviewGraph.hide();
            this.timeSeriesGraphContainer.hide();
            // this.eruptionSelect.hide();
            // this.eruptionSelect.show();
        },
        overviewGraphShown: function (range) {
            this.timeSeriesGraphContainer.updateTimeRangeLimit(range);
            this.eruptionGraph.updateTimeRangeLimit(range);
            // this.eruptionSelect.hide();
            // this.eruptionSelect.show();
        },
        overviewGraphHidden: function (e,range) {
            this.eruptionGraph.updateTimeRangeLimit(range);
            // this.eruptionSelect.hide();
            // this.eruptionSelect.show();
        },
        eruptionGraphHidden: function (e) {
            this.timeSeriesGraphContainer.hide();
            this.eruptionForecastsGraph.hide();

        },
        eruptionGraphShown: function (timeRange) {
            this.forecastsGraphTimeRangeChanged(timeRange);

        },
        eruptionSelectHidden: function (e) {

            this.eruptionGraph.hide();

        },
        showFilters: function () {
            var self = this;
            this.turnProgressbar(true);
            $.when(
                this.filtersSelect.render(this.selectingTimeSeries)
            ).then(function () {
                    self.turnProgressbar(false);
                }
            );
            // this.filtersSelect.render(this.selectingTimeSeries);
        },
        seriesGraphTimeRangeChanged: function (timeRange,id) {
            this.turnProgressbar(true);
            this.eruptionGraph.eruptionTimeRangeChanged(timeRange);
            this.eruptionForecastsGraph.forecastsGraphTimeRangeChanged(timeRange);
            this.timeSeriesGraphContainer.seriesGraphTimeRangeChanged(timeRange,id);
            this.overviewGraph.selectingRegionChanged(timeRange);
            this.turnProgressbar(false);
        },
        eruptionGraphTimeRangeChanged: function (timeRange) {
            //console.log(this.serieGraphTimeRange;
            this.turnProgressbar(true);
            this.timeSeriesGraphContainer.seriesGraphTimeRangeChanged(timeRange,"");
            this.overviewGraph.selectingRegionChanged(timeRange);
            this.eruptionForecastsGraph.forecastsGraphTimeRangeChanged(timeRange);
            this.turnProgressbar(false);
        },
        forecastsGraphTimeRangeChanged: function (timeRange) {

            this.eruptionForecastsGraph.forecastsGraphTimeRangeChanged(timeRange);
        },
        selectingTimeRangeChanged: function (timeRange) {
            // this.eruptionSelect.selectingTimeRangeChanged(timeRange);


            // this.selectingTimeRange.trigger('update');
            // this.timeSeriesGraphContainer.selectingTimeRangeChanged(timeRange);
            this.seriesGraphTimeRangeChanged(timeRange,"");
            // this.timeSeriesGraphContainer.selectingTimeRangeChanged(e);
        },
        highlightOverViewGraphChanged: function (e) {
            this.selectingTimeRange.set({
                minX: this.serieGraphTimeRange.get('minX'),
                maxX: this.serieGraphTimeRange.get('maxX')
            })
            // console.log(this.selectingTimeRange);
            this.overviewGraph.selectingRegionChanged(this.selectingTimeRange);
        },
        destroy: function () {

        }
    });
});