define(function(require) {
	'use strict';
	var $ = require('jquery'),
  Backbone = require('backbone'),
  _ = require('underscore');

  var TimeSerieGraph = require("views/time_serie_graph"); 

  return Backbone.View.extend({
  	el: '',
  	initialize : function(options) {
  		this.selectingTimeSeries = options.selectingTimeSeries;
  		this.serieGraphTimeRange = options.serieGraphTimeRange;
      this.eruptionTimeRange = options.eruptionTimeRange;
      this.forecastsGraphTimeRange = options.forecastsGraphTimeRange;
  		this.filterObserver = options.filterObserver;
      this.eruptions =  options.eruptions;
  		// this.listenTo( this.selectingFilter, "add", this.addGraph );
  		// this.listenTo( this.selectingFilter, "remove", this.removeGraph );
      this.categories = options.categories;
      this.beingShown = false;
  		this.graphs = [];
  	},

  	// addGraph : function( filter ) {
  	// 	var val = filter.get("filter");

  	// 	this.graphs[val] = new TimeSerieGraph( {
  	// 		timeRange : this.timeRange,
  	// 		model : this.model,
  	// 		filter : filter
  	// 	});
  	// 	this.$el.append(this.graphs[val].$el);

  	// 	this.graphs[val].filter.trigger("change");

  	// 	this.filterObserver.trigger("filter-change");
  	// },
    addGraph : function( filters ) {
      // var val = filter.get("filter");
      // selectingTimeSeries.
      // timeSerie.fetch({
      //   success: function(collection, response) {
      //     // console.log(e);
      //     console.log(response);

      //   }
      // });
      var timeSerieGraph = new TimeSerieGraph( {
        // timeRange : this.timeRange,
        filters: filters,
        eruptionTimeRange: this.eruptionTimeRange,
        serieGraphTimeRange: this.serieGraphTimeRange,
        forecastsGraphTimeRange: this.forecastsGraphTimeRange,
        eruptions : this.eruptions,
      });

      this.graphs.push(timeSerieGraph);
      // this.show();

      // this.graphs[val].filter.trigger("change");

      // this.filterObserver.trigger("filter-change");
    },

  	// removeGraph : function( timeSerie ) {
  	// 	// var val = filter.get("filter");
  	// 	// this.graphs[val].destroy();
   //    for (var i = 0; i < this.graphs.length; i++) {
   //      if(this.graphs[i].timeSerie.id == timeSerie.id){
   //        this.graphs[i].destroy();
   //        this.graphs.splice(i,i+1); //remove graph
   //        break;
   //      }
   //    };
  	// 	// this.filterObserver.trigger("filter-change");
  	// },
    serieGraphTimeRangeChanged: function(timeRange){
      for (var i = 0; i < this.graphs.length; i++) {
      //     console.log(this.graphs[i]);
        var attributes = this.graphs[i].serieGraphTimeRange.attributes;
        attributes.serieID = this.graphs[i].timeRange.cid;
        this.graphs[i].timeRangeChanged(timeRange);
      };
      //console.log(this.graphs);
      this.show();
    },
    selectingFiltersChanged: function(selectingFilters){
      this.graphs.length =0;
      this.$el.html("");
      var filters =[];
      var categories=this.categories;
      for(var i=0;i<categories.length;i++){
        if(selectingFilters[categories[i]]!=undefined){
          filters = filters.concat(selectingFilters.getAllFilters(categories[i]));   
        }
      }
      for (var i = 0; i < filters.length; i++) {
        this.addGraph(filters[i]);
      };
    },
    // render: function(selectingTimeSeries) {
    //   this.overviewGraph.$el.appendTo(this.$el);
    // },
    hide: function(){
      this.$el.html("");
    },
    show: function(){
      this.$el.html("");
      this.$el.addClass("time-series-graph-container card-panel");
      this.$el.append("<div style = \"font-weight: bold; color : black; background-color:white; padding-left: 50px; \">Individual graph display</div>");


      for (var i = 0; i < this.graphs.length; i++) {
        var select = "<a class=\"\" style = \"padding-left:75px;\" onclick='selectGraph()'><span><input type=\"checkbox\"><label></label> </span></a>";
        this.$el.append(select);
        this.$el.append(this.graphs[i].$el);

        this.graphs[i].show();
       // this.graphs[i].draw();
        
      };
    },

    destroy: function() {
      // From StackOverflow with love.
      //console.log("destroy");
      for(var g in this.graphs) {
      	if (this.graphs.hasOwnProperty(g)) {
            this.graphs[g].destroy();
        }
      }
      this.undelegateEvents();
      this.$el.removeData().unbind(); 
      this.remove();  
      Backbone.View.prototype.remove.call(this);
    },
    updateTimeSerie: function(currentID){
      var graphs = this.graphs;
      var currentTimeSerie = null;
      for (var i = 0 ; i < graphs.length; i++){
        if (graphs[i].timeRange.cid == currentID){
          currentTimeSerie = graphs[i].serieGraphTimeRange.attributes;
          break;
        }
      }
      for (var i = 0 ; i < graphs.length; i++){
        if (graphs[i].timeRange.cid != currentID){
          graphs[i].maxX = currentTimeSerie.endTime;
          graphs[i].minX = currentTimeSerie.startTime;

          graphs[i].update();

        }
      }

    }

  });

});