define(['require','views/series_tooltip','text!templates/tooltip_serie.html'],
  function(require) {
  'use strict';
  var 
  $ = require('jquery'),
      Backbone = require('backbone'),
      _ = require('underscore'),
      // flot = require(['jquery.flot', 'jquery.flot.time', 'jquery.flot.navigate', 'jquery.flot.selection', 'jquery.flot.errorbars', 'jquery.flot.axislabels','jquery.flot.legendoncanvas']),

      serieTooltipTemplate = require('text!templates/tooltip_serie.html'),
      Tooltip = require('views/series_tooltip'),
      TimeRange = require('models/time_range'),
      GraphHelper = require('helper/graph');
       // materialize = require('material');

  return Backbone.View.extend({
    initialize: function(options) {
      this.filters = options.filters;
      this.eruptionTimeRange = options.eruptionTimeRange;
      this.serieGraphTimeRange = options.serieGraphTimeRange;
      this.forecastsGraphTimeRange = options.forecastsGraphTimeRange;
      this.eruptions =  options.eruptions;
      this.timeRange = new TimeRange();
      this.allowErrorbar = options.allowErrorbar;
      // console.log(Tooltip);
      this.tooltip = new Tooltip({
        template: serieTooltipTemplate
      });
      // console.log(this.serieGraphTimeRange);
      this.prepareData();
    },

    timeRangeChanged: function(TimeRange){
      if(TimeRange == undefined){
        return;
      }
      this.minX = TimeRange.get('startTime');
      this.maxX = TimeRange.get('endTime');
      this.serieId = TimeRange.get('serieID');
      this.isTrigger = true;
      //  this.trigger("update_time-range-composite");

      this.overviewGraphMinX = TimeRange.get('overviewGraphMinX');
      this.overviewGraphMaxX = TimeRange.get('overviewGraphMaxX');

      /*
      Start and end time which is selected in overview graph
      cannot zoom out of this range
       */
      this.startSelectTime = this.minX;
      this.endSelectTime = this.maxX;

      //this.render();
      //console.log(this.filters);
      // put this new time range into filter as attributes. 
      //this.prepareData();
    },

    onPan : function(event,plot){

      var option = event.data.original_option;
      var xaxis = plot.getXAxes()[0];
      var data = event.data.data;
      var self = event.data.self;
      /* The zooming range cannot wider than the selected range */
      //console.log(xaxis.min + "\t"+ event.data.startSelectTime);
      if(xaxis.min<event.data.startSelectTime || xaxis.max > event.data.endSelectTime){
        var diffTime =  xaxis.max - xaxis.min;
        if (xaxis.min < event.data.startSelectTime){
          option.xaxis.min = event.data.startSelectTime;
          option.xaxis.max = event.data.startSelectTime + diffTime;
        }else if (xaxis.max > event.data.endSelectTime){
          option.xaxis.max = event.data.endSelectTime;
          option.xaxis.min = event.data.endSelectTime - diffTime;
        }
        event.data.graph = $.plot(event.data.el,data,option);
        self.setUpTimeranges(option.xaxis.min,option.xaxis.max);
      }else{

        self.setUpTimeranges(xaxis.min,xaxis.max);
      }
    },
    onHover: function(event, pos, item) {
      // if(item!=null){
        var tooltip = event.data;
      tooltip.update(pos, item);
      // }
      
    },
    show: function(){
      
      //this.timeRangeChanged(this.timeRange);
      this.render();
    },
    render: function() {
      if(this.data==undefined){
        return;
      }
      this.$el.html("");
      var unit = undefined;
      for(var i=0;i<this.data.length;i++){
        if(this.data[i].yaxis.axisLabel != undefined){
          unit = this.data[i].yaxis.axisLabel;
        }
      };

      // change yaxix of timeseriesgraph according to zoomed in data

      var zoomedDataMinY = undefined;
      var zoomedDataMaxY = undefined;
      for(var j=0;j<this.data.length;j++){
        for(var k=0;k<this.data[j].data.length;k++){
                var currentData = this.data[j].data[k];
                var previousData = this.data[j].data[k-1];
                if(this.data[j].points.show){
                  if(currentData[0]>=this.minX&&currentData[0]<=this.maxX){
                    if(zoomedDataMinY == undefined){
                      zoomedDataMinY = currentData[1]-currentData[2];
                    }
                    else if(currentData[1]-currentData[2]<zoomedDataMinY){
                      zoomedDataMinY = currentData[1]-currentData[2];
                    };
                  }

                  if(currentData[0]<=this.maxX&&currentData[0]>=this.minX){
                    if(zoomedDataMaxY == undefined){
                      zoomedDataMaxY = currentData[1]+currentData[2];
                    }
                    else if(currentData[1]+currentData[2]>zoomedDataMaxY){
                      zoomedDataMaxY = currentData[1]+currentData[2];
                    };
                  }
                }
                else if(this.data[j].bars.show){
                  if(currentData[0]>=this.minX&&currentData[1]<=this.maxX){
                    if(zoomedDataMinY == undefined){
                      zoomedDataMinY = currentData[3]-currentData[4];
                    }
                    else if((currentData[3]-currentData[4])<zoomedDataMinY){
                      zoomedDataMinY = currentData[3]-currentData[4];
                    };
                  }

                  if(currentData[1]<=this.maxX&&currentData[0]>=this.minX){
                    if(zoomedDataMaxY == undefined){
                      zoomedDataMaxY = currentData[2]+currentData[4];
                    }
                    else if((currentData[2]+currentData[4])>zoomedDataMaxY){
                      zoomedDataMaxY = currentData[2]+currentData[4];
                    };
                  }
                }
        }
      };
      if(zoomedDataMaxY>=0&&zoomedDataMinY>=0){
        this.minY = zoomedDataMinY*0.95;
        this.maxY = zoomedDataMaxY*1.05;
      }
      else if(zoomedDataMaxY<0&&zoomedDataMinY<0){
        this.minY = zoomedDataMinY*1.05;
        this.maxY = zoomedDataMaxY*0.95;
      }
      else if(zoomedDataMaxY>0&&zoomedDataMinY<0){
        this.minY = zoomedDataMinY*1.05;
        this.maxY = zoomedDataMaxY*1.05;
      }
      /*
      Config Y-value of eruption
       */
      var eruptionData = this.data[1].data;
      for (var i = 0 ; i < eruptionData.length;i++){
        eruptionData[i][1] = this.maxY;
      }
      this.data.minY = this.minY;
      var options = {
            grid:{
             // margin: 50,
              hoverable: true,
            },
            xaxis: { 
              mode:'time',
              timeformat: "%d-%b<br>%Y",
              min: this.minX,
              max: this.maxX,

              autoscale: true,
              canvas: true,
              ticks: 6,
              zoomRange: [30000000],
            },
            yaxis: {
              show: true,
              min: this.minY,
              max: this.maxY,
              ticks: 6, //this.ticks
              labelWidth: 60,
              tickFormatter: function (val, axis) {
                var string = val.toString();
                if(string.length >7){
                  return val.toPrecision(2);
                }
                return val;
              },
              zoomRange: false,
              panRange: false,
              axisLabel: unit,
              canvas: true,
              autoscaleMargin: 5,
            },

            zoom: {
              interactive: true,
              
            },
            pan: {
              interactive: true,

            },
            tooltip:{
              show: false,
            },
            
          }; 
      if (!this.data || !this.data.length) {
        this.$el.html('');
        return;
      }

      this.$el.width('auto');
      this.$el.height(200);

      this.$el.addClass('time-serie-graph');
      // plot the time series graph after being selected (eg. onSelect in OverViewGraph).
      // config graph theme colors
      options.colors = ["#000000", "#afd8f8", "#cb4b4b", "#4da74d", "#9440ed"];

      //Push data eruption

      //this.data.push


      this.graph = $.plot(this.$el, this.data, options);
      //console.log(this.$el);

      //this.$el.append("<div><input type=\"checkbox\" >aaa</div>");
      this.$el.bind('plothover', this.tooltip,this.onHover);
      //this.tooltip.update()

      var   eventData = {
        startTime: this.minX,
        endTime: this.maxX,
        startSelectTime: this.startSelectTime,
        endSelectTime: this.endSelectTime,
        data: this.data,
        graph: this.graph,
        el: this.$el,
        self: this,
        original_option: options,
        timeRange: this.serieGraphTimeRange,
       // isTrigger : this.isTrigger,
      }
    // this.eventData =  eventData;


      this.$el.bind('plotzoom',eventData, this.onZoom);
      this.$el.bind('plotpan',eventData, this.onPan);


    },
    /*
    Same as render but remove binding
    remove checking pf value of minX,maxX, minY, maxY because the input is checked before
     */
    update: function() {

      if(this.data==undefined){
        return;
      }
      this.$el.html("");
      var unit = undefined;
      for(var i=0;i<this.data.length;i++){
        if(this.data[i].yaxis.axisLabel != undefined){
          unit = this.data[i].yaxis.axisLabel;
        }
      };
      //this.data.yaxis = 1;


      var options = {
        grid:{
        //  margin: 50,
          hoverable: true,
        },
        xaxis: {
          mode:'time',
          timeformat: "%d-%b<br>%Y",
          min: this.minX,
          max: this.maxX,

          autoscale: true,
          canvas: true,
          ticks: 6,
          zoomRange: [30000000],
        },
        yaxis: {
          show: true,
          min: this.minY,
          max: this.maxY,
          ticks: 6, //this.ticks
          labelWidth: 60,
          tickFormatter: function (val, axis) {
            var string = val.toString();
            if(string.length >7){
              return val.toPrecision(2);
            }
            return val;
          },
          zoomRange: false,
          panRange: false,
          axisLabel: unit,
          //label : "test",
          canvas: true,
          autoscaleMargin: 15,
        },

        zoom: {
          interactive: true,

        },
        pan: {
          interactive: true,

        },
        tooltip:{
          show: true,
        },

      };
      if (!this.data || !this.data.length) {
        this.$el.html('');
        return;
      }

      this.$el.width('auto');
      this.$el.height(200);
      this.$el.addClass('time-serie-graph');
      //this.$el.append(' Individual graph display </br>');
      // plot the time series graph after being selected (eg. onSelect in OverViewGraph).
      // config graph theme colors
      options.colors = ["#000000", "#afd8f8", "#cb4b4b", "#4da74d", "#9440ed"];

      //Push data eruption

      //this.data.push
      this.graph = $.plot(this.$el, this.data, options);


    },
    onZoom: function(event,plot){
     // console.log("zoom");
      var option = event.data.original_option;
      var xaxis = plot.getXAxes()[0];
      var data = event.data.data;
      var self = event.data.self;
      /* The zooming range cannot wider than the selected range */

      if(xaxis.min<event.data.startSelectTime || xaxis.max > event.data.endSelectTime){
        option.xaxis.min = event.data.startSelectTime;
        option.xaxis.max = event.data.endSelectTime;

        event.data.graph = $.plot(event.data.el,data,option);
        //console.log(1);
        self.setUpTimeranges(option.xaxis.min,option.xaxis.max);
      }else{
        //console.log(2);
        self.setUpTimeranges(xaxis.min,xaxis.max);
      }

    },
    setUpTimeranges: function(startTime, endTime){

       this.serieGraphTimeRange.set({
         'startTime': startTime,
         'endTime': endTime,
         'serieID' : this.serieId,
       });


        this.serieGraphTimeRange.trigger('nav',this.serieGraphTimeRange);




    },

    prepareData: function() {
      if(this.filters == undefined){
        this.data = undefined;
        return;
      }
      var filters = [this.filters];

      var allowAxisLabel =true;
      var limitNumberOfData =false;
      var eruptions =  this.eruptions;
      //formatData: function(graph,filters,allowErrorbar,allowAxisLabel,limitNumberOfData)
     // console.log(this.filters);
      //console.log(eruptions);
      //GraphHelper.formatDataEruption(this,this.eruptions);
      console.log (this.allowErrorbar);
      GraphHelper.formatData(this,filters,this.allowErrorbar,allowAxisLabel,limitNumberOfData, eruptions);
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
