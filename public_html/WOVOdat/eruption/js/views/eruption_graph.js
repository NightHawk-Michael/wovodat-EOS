define(function (require) {
    'use strict';
    var $ = require('jquery'),
        Backbone = require('backbone'),
        _ = require('underscore'),
        flot = require(['jquery.flot', 'jquery.flot.time', 'jquery.flot.navigate', 'jquery.flot.selection']),
        moment = require('moment'),
        Const = require('helper/const'),
        edTemplate = require('text!templates/tooltip_ed.html'),
        edphsTemplate = require('text!templates/tooltip_ed_phs.html'),
        TimeRange = require('models/time_range'),
        Tooltip = require('views/eruption_tooltip');

    return Backbone.View.extend({
        el: '',

        initialize: function (options) {
            _(this).bindAll(
                // 'render',
                'onHover'
                // 'updateStartTime',
                // 'changeTimeRange'
            );
            this.observer = options.observer;
            //this.eruptions = options.eruptions;
            this.timeRange = options.eruptionTimeRange;
            this.overviewGraphTimeRange = options.overviewGraphTimeRange;
            this.serieGraphTimeRange = options.serieGraphTimeRange;
            this.forecastsGraphTimeRange = options.forecastsGraphTimeRange;
            // this.eruptions = new Array();
            this.selectingEruption = options.selectingEruption;
            this.edTooltip = new Tooltip({
                template: edTemplate
            });
            this.edphsTooltip = new Tooltip({
                template: edphsTemplate
            });
            this.selecting_vd_num = options.selecting_vd_num;
            this.ed_stime_num = options.ed_stime_num;
            this.ed_etime_num = options.ed_etime_num;


        },
        eruptionTimeRangeChanged: function (selectingTimeRange) {
            if (this.graph == undefined) {
                this.minX = selectingTimeRange.minX;
                this.maxX = selectingTimeRange.maxX;
                this.render();
                return;
            }
            var xaxis = this.graph.getAxes().xaxis;
            xaxis.options.min = selectingTimeRange.minX;
            xaxis.options.max = selectingTimeRange.maxX;
            this.graph.setupGrid();
            this.graph.draw();
        },
        onHover: function (event, pos, item) {
            if (!item) {
                this.edTooltip.hide();
                this.edphsTooltip.hide();
            } else if (item.series.dataType === 'ed') {
                this.edTooltip.update(pos, item, "");
                this.edphsTooltip.hide();
            } else {

                this.edphsTooltip.update(pos, item, item.series.label);
                this.edTooltip.hide();
            }
        },

        changeEruption: function (selectingEruption, selectingTimeRange) {
            this.selectingTimeRange = selectingTimeRange;
            if (selectingEruption.get('ed_id') == -1) {

                //this.hide();
            } else {
                this.selectingEruption = selectingEruption;
                this.startTime = selectingTimeRange.get("minX");
                this.endTime = selectingTimeRange.get("maxX");
            }
            this.show();


        },
        /**
         Display all eruption when user does not select any
         */
        initialEruption: function (availableEruptions) {
            this.availableEruptions = availableEruptions;

            this.show();


        },
        //show eruption graph
        show: function () {
            this.render();
            // this.trigger('show');
        },
        //hide eruption graph
        hide: function () {
            this.selectingEruption = undefined;
            this.$el.html("");
            this.$el.height(0);
            this.$el.width(0);
            this.trigger('hide');
        },
        generateBarChartFlotData: function (data, color, label, dataType, name) {
            return {
                data: data,
                color: color,
                label: label,
                bars: {
                    show: true,
                    fullparams: true,
                    horizontal: true,
                    fill: false,
                    fillcolor: null,

                },
                dataType: dataType,
                name: name,
            }
        },
        render: function () {


            var maxVEI = 7;
            var self = this,

                el = this.$el,
                data = this.prepareData(),
                graph_pram_data = [],
                option = {
                    grid: {
                        minBorderMargin: 20,
                        hoverable: true,
                    },
                    xaxis: {
                        min: this.startTime,
                        max: this.endTime,
                        autoscale: true,
                        ticks: 6,
                        mode: 'time',
                        timeformat: "%d-%b-%Y",
                        zoomRangeLimit: [this.timeRangeLimit.MinX, this.timeRangeLimit.MaxX],
                        panRange: [this.timeRangeLimit.MinX, this.timeRangeLimit.MaxX],
                    },
                    yaxis: {
                        min: 0,
                        max: maxVEI + 1,
                        tickSize: 1,
                        zoomRange: false,
                        panRange: false,
                        labelWidth: 60,
                        label: 'VEI',
                    },


                    zoom: {
                        interactive: true
                    },
                    pan: {
                        interactive: true
                    }
                };
            /** Eruption part **/
            if (data.edData.length > 0) {
                graph_pram_data.push(this.generateBarChartFlotData([data.edData[0].data], 'Black', 'Eruption', 'ed', ""));
                for (var i = 1; i < data.edData.length; i++) {
                    graph_pram_data.push(this.generateBarChartFlotData([data.edData[i].data], '', '', 'ed', ""));
                }
            }

            /** Phreatic Eruption **/
            if (data.ed_phs_data.length > 0) {
                var ed_phs_data = data.ed_phs_data[0];
                if (ed_phs_data.types != undefined) {
                    for (var i = 0; i < ed_phs_data.types.length; i++) {
                        var type = ed_phs_data.types[i];
                        graph_pram_data.push(this.generateBarChartFlotData(ed_phs_data[type].data, ed_phs_data[type].color, type, 'ed_phs', ""));
                    }
                }
                for (var i = 1; i < data.ed_phs_data.length; i++) {
                    var ed_phs_data = data.ed_phs_data[i];
                    if (ed_phs_data.types != undefined) {
                        for (var j = 0; j < ed_phs_data.types.length; j++) {
                            var type = ed_phs_data.types[j];
                            graph_pram_data.push(this.generateBarChartFlotData(ed_phs_data[type].data, '', '', 'ed_phs', ""));
                        }
                    }
                }
            }


            el.width('auto');
            el.height(150);
            el.addClass("eruption-graph card-panel");

            var eventDataChange = {
                startTime: this.overviewGraphTimeRange.get('startTime'),
                endTime: this.overviewGraphTimeRange.get('endTime'),
                data: graph_pram_data,
                graph: this.graph,
                el: this.$el,
                target: this,
                original_option: option
            };
            var eventDataHover = {
                // ed_phs_data_type: data.ed_phs_data_type
            };
            el.bind('plotpan', eventDataChange, this.onChange);
            el.bind('plotzoom', eventDataChange, this.onChange);

            this.graph = $.plot(el, graph_pram_data, option);
            this.trigger("show",{minX: this.startTime, maxX: this.endTime});
        },
        onChange: function (event, plot) {
            var xaxis = plot.getXAxes()[0];
            // var data = event.data.data;
            var target = event.data.target;
            var timeRange = {
                minX: xaxis.min,
                maxX: xaxis.max
            };
            target.trigger("eruption-graph-time-range-change",timeRange);
        },
        getStartingTime: function (ed_stime) {
            var date = new Date(ed_stime);
            var year = date.getFullYear();
            var starting_date = new Date(year, 0, 0, 0, 0, 0, 0);
            return starting_date.getTime();

        },
        updateTimeRangeLimit: function (range) {
            this.timeRangeLimit = range;
            var xaxis = this.graph.getAxes().xaxis;
            if(range === undefined){

                xaxis.options.zoomRangeLimit[0] = this.startTime;
                xaxis.options.zoomRangeLimit[1] = this.endTime;
                xaxis.options.panRange = xaxis.options.zoomRangeLimit;
                xaxis.options.min = this.startTime;
                xaxis.options.max = this.endTime;

            }else{
                xaxis.options.zoomRangeLimit = [this.timeRangeLimit.MinX,this.timeRangeLimit.MaxX];
                xaxis.options.panRange = xaxis.options.zoomRangeLimit;
                xaxis.options.min = this.timeRangeLimit.MinX;
                xaxis.options.max = this.timeRangeLimit.MaxX;
            }
            this.graph.setupGrid();
            this.graph.draw();
            var timeRange = {
                minX: xaxis.options.min,
                maxX: xaxis.options.max
            };
            this.trigger("show",timeRange)
        },
        prepareDataAllEruption: function (eruptions) {
            var startTime = 100000000000000;
            var endTime = -1000000000000;
            var self = this,
                edData = [],
                ed_phs_data = [],
                ed_phs_data_type = [];
            for (var i = 0; i < eruptions.length; i++) {
                var ed = eruptions[i];
                startTime = Math.min(startTime, ed.get("ed_stime"))
                endTime = Math.max(endTime, ed.get("ed_etime"))
                var ed_stime = ed.get('ed_stime'),
                    ed_etime = ed.get('ed_etime'),
                    ed_vei = parseInt(ed.get('ed_vei'));

                var edDataElement = {
                    //left,right,bottom,up
                    data: [ed_stime, ed_etime, 0, ed_vei],
                    attributes: ed.attributes
                };
                edData.push(edDataElement);
                var ed_phs_data_element = [];
                ed.get('ed_phs').forEach(function (ed_phs) {

                    var ed_phs_stime = ed_phs.ed_phs_stime,
                        ed_phs_etime = ed_phs.ed_phs_etime,
                        ed_phs_lower_vei = undefined,
                        ed_phs_upper_vei = undefined,
                        ed_phs_type = ed_phs.ed_phs_type,
                        ed_phs_color = "",
                        flag = false;
                    /** Phereatic Eruption is vertical bar **/
                    if (ed_phs_type == "Phreatic eruption") {
                        ed_phs_lower_vei = 0;
                        ed_phs_upper_vei = 1;
                        ed_phs_color = "#1e88e5"; // blue
                        flag = true;

                    }
                    /** Magmatic Extrusion is horizontal bar **/
                    if (ed_phs_type == "Magmatic extrusion") {
                        ed_phs_lower_vei = 0.5 - 0.2;
                        ed_phs_upper_vei = 0.5 + 0.2;
                        ed_phs_color = "#fb8c00";
                        flag = true;
                    }
                    /** Tectonic Earthquake is vertical bar **/
                    if (ed_phs_type == "Tectonic earthquake") {
                        ed_phs_lower_vei = 0;
                        ed_phs_upper_vei = 1;
                        ed_phs_color = "#8e24aa";
                        flag = true;
                    }
                    /** Explosion is vertical bar **/
                    if (ed_phs_type == "Explosion") {
                        ed_phs_lower_vei = 0;
                        ed_phs_upper_vei = ed_phs.ed_phs_vei;
                        ed_phs_color = "#212121";
                        flag = true;
                    }
                    /** Climatic phase is vertical bar **/
                    if (ed_phs_type == "Climatic phase") {
                        ed_phs_lower_vei = 0;
                        ed_phs_upper_vei = ed_phs.ed_phs_vei;
                        ed_phs_color = "#e53935";
                        flag = true;
                    }
                    if (flag) {
                        if (ed_phs_data_element.types == undefined) {
                            ed_phs_data_element.types = [];
                        }
                        if (ed_phs_data_element[ed_phs_type] == undefined) {
                            ed_phs_data_element.types.push(ed_phs_type);
                            ed_phs_data_element[ed_phs_type] = {
                                //left,right,bottom,up
                                data: [],

                                color: ed_phs_color
                            };
                        }
                        ed_phs_data_element[ed_phs_type].data.push([ed_phs_stime, ed_phs_etime, ed_phs_lower_vei, ed_phs_upper_vei]);
                    }

                });
                ed_phs_data.push(ed_phs_data_element)

            }
            if (!$.isNumeric(this.startTime) || !$.isNumeric(this.endTime) || this.endTime < this.startTime) {
                this.startTime = startTime;
                this.endTime = endTime;
                this.startTime = Math.min(this.startTime * 0.9, this.startTime * 1.1);
                this.endTime = Math.max(this.endTime * 0.9, this.endTime * 1.1);
                this.timeRangeLimit= {
                    MinX : this.startTime,
                    MaxX : this.endTime,
                };
            }

            // this.setUpTimeranges(this.startTime, this.endTime);


            return {
                edData: edData,
                ed_phs_data: ed_phs_data,
                ed_phs_data_type: ed_phs_data_type,
            };
        },
        prepareData: function () {

            if (this.selectingEruption == undefined) { // no eruption is selected
                var __ret = this.prepareDataAllEruption(this.availableEruptions);
                var edData = __ret.edData;
                var ed_phs_data = __ret.ed_phs_data;
                var ed_phs_data_type = __ret.ed_phs_data_type;
            } else {
                var __ret = this.prepareDataAllEruption([this.selectingEruption]);
                var edData = __ret.edData;
                var ed_phs_data = __ret.ed_phs_data;
                var ed_phs_data_type = __ret.ed_phs_data_type;
            }

            return {
                edData: edData,
                ed_phs_data: ed_phs_data,
                ed_phs_data_type: ed_phs_data_type
            };
        }
    });
});