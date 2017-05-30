define(function(require) {
    'use strict';
    var $ = require('jquery'),
        Backbone = require('backbone'),
        _ = require('underscore'),
        flot = require(['jquery.flot', 'jquery.flot.time', 'jquery.flot.navigate', 'jquery.flot.selection','excanvas','jquery.flot.legendoncanvas','jquery.flot.axislabels']),
        TimeRange = require('models/time_range'),
        GraphHelper = require('helper/graph'),
    //Filter Color for each earthquake type configuration
        loading = require('text!templates/loading.html'),
        FilterColor = require('models/filter_color'),
        FilterColorCollection = require('collections/filter_colors');
    return Backbone.View.extend({
        loading: _.template(loading),
        initialize: function(options) {
            this.data =  options.data;
            this.eruptionData = options.eruptionData;
            this.serieGraphTimeRange = options.serieGraphTimeRange;
            this.timeRange = options.overviewGraphTimeRange;
            this.selectingTimeRange = options.selectingTimeRange;
            this.isDisplayXaxis = options.isXaxis;
            this.isMargin = options.isMargin;
            this.order = options.order;
            this.filterColorCollection = new FilterColorCollection({
                offline: false
            });
            //this.filterColorCollection.fetch();
            this.categories = options.categories;


            //console.log(this.filterColorCollection);

        },
        show: function(){
            //console.log ("UPDATE");
            //this.minX = this.serieGraphTimeRange.get('startTime');
            //this.maxX = this.serieGraphTimeRange.get('endTime');
            //this.timeRangeChanged(this.timeRange);
            //this.render();
            this.update();
        },
        selectingFiltersChanged: function(selectingFilters) {
            this.selectingFilters = selectingFilters;
            if(selectingFilters.length == 0){
                this.hide();
            }
            this.update();
        },
        //onSelect: function(event, ranges) {
        //
        //  var startTime = ranges.xaxis.from,
        //      endTime = ranges.xaxis.to;
        //
        //  event.data.set({
        //    'startTime': startTime,
        //    'endTime': endTime,
        //
        //  });
        //
        //  event.data.trigger('update');
        //},
        hide: function(){
            this.$el.html("");
            this.$el.width(0);
            this.$el.height(0);
            (document.getElementsByClassName('stack-graph-container'))[0].style.display = 'none';


        },
        showLoading: function(){
            //this.$el2.html(this.loading);
        },
        displayXaxis: function(isDisplayXaxis){
            if (isDisplayXaxis){
                return "%d-%b<br>%Y";
            }  else{
                return "";
            }
        },
        render: function() {
            //this.data.yaxis = 1;
            //this.$el.html("");
            var options = {
                grid:{
                    minBorderMargin : 50,
                    hoverable: true,

                },
                xaxis: {
                    mode:'time',
                    timeformat: this.displayXaxis(this.isDisplayXaxis),
                    min: this.minX,
                    max: this.maxX,
                    show: true,
                    autoscale: true,
                    canvas: true,
                    ticks: 6,
                    zoomRange: [30000000],
                },
                yaxis: {
                    show:true,
                    min: this.minY,
                    max: this.maxY,
                    tickFormatter: function (val, axis) {
                        var string = val.toString();
                        if (string.length > 7) {
                            var rounded = Math.round( val * 10 ) / 10;
                            var fixed = rounded.toFixed(1);
                            //return parseFloat( val.toFixed(2) )
                            return fixed;
                        }
                        return val;
                    },
                    ticks: 6 //this.ticks

      ,
                },
                zoom: {
                    interactive: false,

                },
                pan: {
                    interactive: false,

                },
                tooltip:{
                    show: false,
                },

            };

            if (!this.data || this.data.length == 0 || !this.data[1] || !this.data[0] ) {
                this.$el.html('');
                return;
            }
            this.$el.width(this.width);
            this.$el.height(300);
            this.$el.addClass('stack-graph' + this.order);
            if (this.isMargin) $(".stack-graph" + this.order).css("margin-top","-95px");
            //this.$el.append(' Individual graph display </br>');
            // plot the time series graph after being selected (eg. onSelect in OverViewGraph).
            // config graph theme colors
            //if (!this.data || !this.data.length) {
            //    this.$el.html(''); //$(this) = this.$el
            //    (document.getElementsByClassName('composite-graph-container'))[0].style.display = 'none';
            //
            //    return;
            //};
            //Push data eruption

            //this.data.push

            this.graph = $.plot(this.$el, this.data, options);
            //console.log(this.$el);

            //To edit the series object, go to GraphHelper used for data in the prepareData method below.
            //this.$el.bind('plotselected', this.selectingTimeRange, this.onSelect);

        },

        update: function() {

            this.showLoading();
            this.prepareData();

            this.render();
        },


        prepareData: function() {
            if(this.serieGraphTimeRange != undefined){
                this.minX = this.serieGraphTimeRange.get('startTime');
                this.maxX = this.serieGraphTimeRange.get('endTime');
            }
            if (this.data != undefined){
                //if(this.data);
                for (var p = 0 ;  p < this.data.length;p = p+2){
                    var minY = 100000;
                    var maxY = -500000;
                    if (this.data[p] == undefined) continue;
                    var eventData = this.data[p].data;
                    if (eventData == undefined) continue;
                    for (var i = 0 ; i < eventData.length; i++){
                        if (eventData[i][0] < this.minX || eventData[i][0] > this.maxX) continue;
                        var y;
                        if (eventData[i].length == 3){
                            y = eventData[i][1];
                        }else{
                            y = eventData[i][eventData[i].length-1];
                        }

                        if (y < minY) minY = y;
                        if (y > maxY) {
                            maxY = y;

                        }
                    }
                    if (maxY - minY > 6){
                        minY =  minY -3;
                        maxY = maxY + 3;
                    }
                    this.minY =  minY;
                    this.maxY =  maxY;
                }
                /*
                Config eruption marker
                 */
                    if (this.data.length >=1){
                        var eventData = this.data[1].data;
                        for (var i = 0 ; i < eventData.length; i++){
                            if (eventData[i][0] < this.minX || eventData[i][0] > this.maxX) continue;
                            eventData[i][1] = this.maxY;

                        }

                    }
            }
        },

        destroy: function() {
            // From StackOverflow with love.
            this.undelegateEvents();
            this.$el.removeData().unbind();
            this.remove();
            Backbone.View.prototype.remove.call(this);
        }
    });
});