define(function(require) {
	'use strict';
	var $ = require('jquery'),
  Backbone = require('backbone'),
        //template = require('text!templates/stack_time_serie_graph.html'),
  _ = require('underscore');

  var StackTimeSerieGraph = require("views/stack_time_serie");

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
      this.stackGraph = options.stackGraph;
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
    //addGraph : function( filters ) {
    //  // var val = filter.get("filter");
    //  // selectingTimeSeries.
    //  // timeSerie.fetch({
    //  //   success: function(collection, response) {
    //  //     // console.log(e);
    //  //     console.log(response);
    //
    //  //   }
    //  // });
    //  var timeSerieGraph = new StackTimeSerieGraph( {
    //    // timeRange : this.timeRange,
    //    filters: filters,
    //    eruptionTimeRange: this.eruptionTimeRange,
    //    serieGraphTimeRange: this.serieGraphTimeRange,
    //    forecastsGraphTimeRange: this.forecastsGraphTimeRange,
    //    eruptions : this.eruptions,
    //  });
    //
    //  this.graphs.push(timeSerieGraph);
    //  // this.show();
    //
    //  // this.graphs[val].filter.trigger("change");
    //
    //  // this.filterObserver.trigger("filter-change");
    //},

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

    selectingFiltersChanged: function(selectingFilters){
      this.selectingFilters = selectingFilters;
      if (this.selectingFilters.empty) {
        this.hide();
      }else{

        this.show();
      }
    },
    // render: function(selectingTimeSeries) {
    //   this.overviewGraph.$el.appendTo(this.$el);
    // },
    hide: function(){

      this.$el.html("");
      this.$el.addClass("stack-graph-container card-panel");

      this.$el.append("<div id = \"stack-graph-title\" style = \"font-weight: bold; color : black; background-color:white; padding-left: 50px; \">Stack graph display</div>");
      //this.selectingFiltersChanged();


      //for (var i = 0; i < this.graphs.length; i++) {
      //
      //  this.$el.append(this.graphs[i].$el);
      //
      //  this.graphs[i].show();
      //
      //}
      (document.getElementsByClassName("stack-graph-container")[0]).style.display = "none";
      document.getElementById('stack-graph-title').style.visibility = "collapse";
    },
    show: function(){
      this.stackGraph.data = this.data;
      this.stackGraph.timeRange = this.timeRange;
      this.render();
    },
    update : function(){
      this.show();
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
    handleTimeSerie : function(){
        console.log("Test");
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

    },

    render: function() {
      //console.log(this.overviewGraph);

      this.stackGraph.render();
      this.stackGraph.$el.appendTo(this.$el);
      var button = "<a > <input style = \"margin-left:50px;pading:2px 10px 2px 10px;right:0px; \" class = \"waves-effect waves-light btn gen-pdf\"  type=\"button\" value = \"Print PDF\"/> <label ></label> </a>";
      if (this.data != undefined && this.$el.context.childNodes.length <=2) this.$el.append(button);
      //var button = "<a style = \"right:0px; \"> <input class = \"waves-effect waves-light btn\"  type=\"button\" id=\"\"  value = \"Print PDF\"/> <label for=\"\"></label> </a>";
      //this.$el.append(button);
    }


  });

});