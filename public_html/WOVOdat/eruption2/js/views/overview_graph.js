define(function(require) {
  'use strict';
  var $ = require('jquery'),
      Backbone = require('backbone'),
      _ = require('underscore'),
      flot = require(['jquery.flot', 'jquery.flot.time', 'jquery.flot.navigate', 'jquery.flot.selection','excanvas','jquery.flot.errorbars','jquery.flot.legendoncanvas','jquery.flot.axislabels']),
      GraphHelper = require('helper/graph'),
      loading = require('text!templates/loading.html'),
      FilterColorCollection = require('collections/filter_colors');
  return Backbone.View.extend({
    loading: _.template(loading),
    initialize: function(options) {
      
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
    
    selectingFiltersChanged: function(selectingFilters) {
      this.selectingFilters = selectingFilters;
      if(selectingFilters.empty){
        this.hide();
      }
      this.update();
    },
    onSelect: function(event, ranges) {

      var startTime = ranges.xaxis.from,
          endTime = ranges.xaxis.to;
      event.data.data.set({
        'startTime': startTime,
        'endTime': endTime,
        'overviewGraphMinX': event.data.graphMinX,
        'overviewGraphMaxX': event.data.graphMaxX
      });
      // console.log(ranges.xaxis);
      // console.log(event.data);
      event.data.data.trigger('update');
    },
    //selectingRegionChanged: function(selectingTimeRange){
      //this.$el.bind('plotselected',this.selectingTimeRange,this.plotSelectingRegion);
      //console.log(2);
    //},
    //plotSelectingRegion

    selectingRegionChanged: function(selectingTimeRange){
      // console.log(selectingTimeRange);
      var selectedMinX = selectingTimeRange.get('selectedMinX');
      var selectedMaxX = selectingTimeRange.get('selectedMaxX');

      this.graph.setSelection({
        xaxis: {
          from: selectedMinX,
          to: selectedMaxX,
        }
      })
    },

    hide: function(){
      this.$el.html("");
      this.$el.width(0);
      this.$el.height(0);
      (document.getElementsByClassName('overview-graph-container'))[0].style.padding = '0px';

      this.trigger('hide');
    },
    showLoading: function(){
      this.$el.html(this.loading);
    },
    render: function() {
      // this.showLoading();
      if(this.initialDataMinTime != undefined){
        this.minX = this.initialDataMinTime;
      }
      if(this.initialDataMaxTime != undefined){
        this.maxX = this.initialDataMaxTime;
      }

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
          ticks: this.ticks,
          labelWidth: 40
        },
        selection: { 
          mode: 'x', 
          color: '#451A2B' 
        },
        zoom: {
          interactive: false,
        },
        legend :{
          type: 'canvas'
        },
      };
          //pass color into options
      options.colors = ["#000000", "#afd8f8", "#cb4b4b", "#4da74d", "#9440ed"];

      if (!this.data || !this.data.length) {
        this.$el.html(''); //$(this) = this.$el
        return;
      };

      this.$el.width('auto');
      this.$el.height(200);

      this.$el.addClass("overview-graph");


      //limit data to be rendered
      

      document.getElementById('overview-title').style.display = 'block';
      (document.getElementsByClassName('overview-graph-container'))[0].style.padding = '20px';

      this.graph = $.plot(this.$el, this.data, options);
      //To edit the series object, go to GraphHelper used for data in the prepareData method below.
      var eventData = {
        data: this.selectingTimeRange,
        graphMinX: this.minX,
        graphMaxX: this.maxX
      };

      //this.$el.bind('plotselected', this.selectingTimeRange, this.onSelect);
      this.$el.bind('plotselected', eventData, this.onSelect);
      this.initialDataMinTime = this.initialDataMaxTime = undefined;
    },

    update: function() {
      this.showLoading();
      this.prepareData();
      this.render();
    },
    
  
    prepareData: function() {

      
      var filters =[];
      var categories=this.categories;
      for(var i=0;i<categories.length;i++){
        if(this.selectingFilters[categories[i]]!=undefined){
          filters = filters.concat(this.selectingFilters[categories[i]]);   
        }
      }
      //console.log(filters);
      // this variable helps to set color for each earthquake type
      var earthquakeTypeColor = this.filterColorCollection;
      // Preset color for each filter data to achieve color coherence in between overview and time series graph.
      var presetColorArray = ["#000000", "#396ab1", "#cb4b4b", "#4da74d", "#9440ed", "#948b3d", "#da7c30", "#cb1480", "#85004e", "#19d1d6"];
      // ensure the color will not be repeated unless it has reached the end of the presetColorArray 
      var counter = 0;
      for(var i=0;i<filters.length;i++){
        var currentFilter = filters[i];
        for(var k=0;k<currentFilter.filterAttributes.length;k++){
            var currentFilterAttributes = currentFilter.filterAttributes[k];
            // Checking whether the filterAtribute name is an earthquake type (eg.R,v,...).
            // If yes, then use the pre-assigned color in the database.
            // Else use the color from the presetColorArray above.
            var graphColorForEarthquakeType = null;
            for(var j=0;j<earthquakeTypeColor.length;j++){
              if(currentFilterAttributes.name == earthquakeTypeColor.models[j].id){
                graphColorForEarthquakeType = earthquakeTypeColor.models[j].attributes.color;
                break;
              }
            }
            //console.log(currentFilterAttributes.color);
            if(graphColorForEarthquakeType == null){
              var colorPos = counter%(presetColorArray.length);
              currentFilterAttributes.color = presetColorArray[colorPos];
              counter++;
            }
            else{
              currentFilterAttributes.color = graphColorForEarthquakeType;
            }
            //console.log(counter);
        } 
      }

      
      var allowErrorbar = false;
      var allowAxisLabel =false;
      var limitNumberOfData =true;
      //var adjustTimeRange = false;
      //formatData: function(graph,filters,allowErrorbar,allowAxisLabel,limitNumberOfData)
      GraphHelper.formatData(this,filters,allowErrorbar,allowAxisLabel,limitNumberOfData); 
      
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