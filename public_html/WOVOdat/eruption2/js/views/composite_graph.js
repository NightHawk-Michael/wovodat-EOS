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

      this.serieGraphTimeRange = options.serieGraphTimeRange;
      this.timeRange = options.overviewGraphTimeRange;
      this.selectingTimeRange = options.selectingTimeRange;
      this.filterColorCollection = new FilterColorCollection;
      this.filterColorCollection.fetch();
      this.categories = options.categories;
      //console.log(this.filterColorCollection);

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
      (document.getElementsByClassName('composite-graph-container'))[0].style.padding = '0px';

      this.trigger('hide');
    },
    showLoading: function(){
      this.$el.html(this.loading);
    },
    render: function() {
      // this.showLoading();
      var options = {
        grid:{
          // margin: 20,
          minBorderMargin : 10
        },
        xaxis: {
          mode:'time',
          timeformat: "%d-%b<br>%Y",
          autoscale: true,
          canvas: true,
          rotateTicks: 90,
          min: this.minX,
          max: this.maxX,
          // minTickSize: [1, "month"],
          ticks: 6,
        },
        yaxis: {
          show: true,
          color: '#00000000',
          canvas: false,
          // tickFormatter: function(val, axis) {
          //   // console.log(val);
          //   if(val > 9999 || val <-9999){
          //     val = val.toPrecision(1);
          //   }else{

          //   }
          //   return val;
          // },
          min: this.minY,
          max: this.maxY,
          //axisLabelUseCanvas: true,
          autoscaleMargin: 5,
          ticks: 6,
          errorbar : 0,
          labelWidth: 40
        },

        zoom: {
          interactive: false,
        },
        legend :{
          type: 'canvas'
        },
      };
      //pass color into options
      console.log(options);
      options.colors = ["#000000", "#afd8f8", "#cb4b4b", "#4da74d", "#9440ed"];

      if (!this.data || !this.data.length) {
        this.$el.html(''); //$(this) = this.$el
        return;
      };

      this.$el.width('auto' );
      this.$el.height(200);

      this.$el.addClass("composite-graph");

      this.graph = $.plot(this.$el, this.data, options);
      //To edit the series object, go to GraphHelper used for data in the prepareData method below.
      //this.$el.bind('plotselected', this.selectingTimeRange, this.onSelect);

    },

    update: function() {
      this.showLoading();
      this.prepareData();
      this.render();
    },


    prepareData: function() {
      if (this.timeRange != undefined && this.data != undefined && this.data.length > 0){
          var minY = 100000;
          var maxY = -500000;
        this.minX = this.timeRange.attributes.startTime;
        this.maxX = this.timeRange.attributes.endTime;
          console.log (this.data);
          for (var p = 0; p < this.data.length; p++) {
            var eventData = this.data[p].data;

            for (var i = 0; i < eventData.length; i++) {
              var eData = eventData[i];
              /*
              Make the y-value of eruption out of range for not displaying in graph
               */
              if (p %2 == 1) {
                eData[1] = 1000000;
                continue;
              }
              if (eData[0] < this.timeRange.attributes.startTime || eData[0] > this.timeRange.attributes.endTime) continue;
              /*
              Remove error bar
               */
              if (eData.length == 3){
                eData[2] = 0;
                if (eData[1] < minY) minY = eData[1];
                if (eData[1] > maxY) maxY = eData[1];
              }else{
                if (eData[eData.length - 1] < minY) minY = eData[eData.length - 1];
                if (eData[eData.length - 1] > maxY) maxY = eData[eData.length - 1];
              }

            }

          }
        if (maxY > 0)this.maxY = maxY * 1.1;
        else this.maxY = maxY * 0.9;
        if (minY > 0)this.minY = minY * 0.9;
        else this.minY = minY * 1.1;

          //console.log (maxY + "\t" + minY);

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