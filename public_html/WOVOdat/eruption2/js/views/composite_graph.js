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
      this.filterColorCollection = new FilterColorCollection({
        offline: false
      });
      //this.filterColorCollection.fetch();
      this.categories = options.categories;1
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
      (document.getElementsByClassName('composite-graph-container'))[0].style.display = 'none';

      this.trigger('hide');
    },
    showLoading: function(){
      this.$el.html(this.loading);
    },
    render: function() {
      //console.log(this.$el);
      /*
      Config verical axes
       */
      var yaxes = [];

      var backUpcolors = [];
      if (this.data != undefined){
        //console.log(this.data);
        var colors = ["#000000", "#0072BB", "#FF4C3B", "#FFD034"];
        var positionLeft = true;
        var minY = 100000;
        var maxY = -500000;

        for (var p  = 0 ; p < this.data.length; p++){
          //Set Y value of eruption between maxY and MinY
          if (this.data[p].points ==  undefined) continue;
          if(this.data[p].points.symbol == "volcano" ){
            var eData = this.data[p].data;
            for (var i = 0 ; i < eData.length; i++){
              eData[i][1] = (maxY + minY)/2;
            }
            continue;
          }
          minY = 100000;
          maxY = -500000;
          var eventData = this.data[p].data;
          var count = 0;
          for (var i = 0; i < eventData.length; i++) {
            var eData = eventData[i];

            if (eData[0] < this.timeRange.attributes.startTime || eData[0] > this.timeRange.attributes.endTime) continue;
            count++;
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
          if (count==0){
            maxY = 1;
            minY = -1;
          }else
          //if (maxY > 0)maxY = maxY * 1.1;
          //else maxY = maxY * 0.9;
          //if (minY > 0)minY = minY * 0.9;
          //else minY = minY * 1.1;
          var position;
          if (positionLeft){
            position =  "left";
            positionLeft = false;
          } else{
            position =  "right";
            positionLeft =  true;
          }
          backUpcolors.push(this.data[p].color);
          this.data[p].points.color = this.data[p].color;
          this.data[p].fillColor = this.data[p].color;

          var option = {
              font :{
                color:  this.data[p].color,
              },
              max : maxY ,
              min : minY,
              alignTicksWithAxis: position ,
              position: position,


          }
          yaxes.push(option);
          this.data[p].yaxis = yaxes.length;


        }

        this.dataOwner = "";
        for (var p  = 0 ; p < this.data.length; p++){
          //Set Y value of eruption between maxY and MinY
          //Data Owner
          if (this.data[p].points ==  undefined){
            var owner = this.data[p];

            var label = this.data[p-2].label;
            var color = this.data[p-2].points.color;
            owner = owner.split("color: black").join("color: " + color);
            owner = owner.split("Data Owner:").join (label + " - Data Owner: ")
            this.dataOwner += owner;
          }


        }

      }

      // this.showLoading();
      var options = {
        series :{
          scale : true,
        },
        grid:{

          // margin: 20,
          minBorderMargin : 20
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
          canvas: false,
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
          //min: this.minY,
          //max: this.maxY,
          ////axisLabelUseCanvas: true,
          //autoscaleMargin: 5,
          ticks: 6,
          //errorbar : 0,
          //labelWidth: 40
        },
        yaxes: yaxes,
        zoom: {
          interactive: false,
        },
        legend :{
          type: 'canvas'
        },
      };
      //pass color into options
     // options.colors = ["#000000"];
     // console.log (option);
      if (!this.data || !this.data.length) {
        this.$el.html(''); //$(this) = this.$el
        (document.getElementsByClassName('composite-graph-container'))[0].style.display = 'none';

        return;
      };


      this.$el.width();
      this.$el.height(300);

      this.$el.addClass("composite-graph");
      document.getElementById('composite-title').style.visibility = "visible";

      (document.getElementsByClassName("composite-graph-container")[0]).style.display = "block";
      this.graph = $.plot(this.$el, this.data, options);

      //To edit the series object, go to GraphHelper used for data in the prepareData method below.
      //this.$el.bind('plotselected', this.selectingTimeRange, this.onSelect);
      //reset data
      for (var p  = 0 ; p < this.data.length; p++) {
          if (this.data[p].points ==  undefined) continue;
          if(this.data[p].points.symbol == "volcano") continue;
          this.data[p].yaxis = 1;
          this.data[p].color = backUpcolors[p/3];
          this.data[p].fillColor = backUpcolors[p/3];
      }

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


          //console.log(this);

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