define(function(require) {
	'use strict';
	var $ = require('jquery'),
  Backbone = require('backbone'),
        template = require('text!templates/time_serie_graph.html'),
  _ = require('underscore');

  var TimeSerieGraph = require("views/time_serie_graph");
  var StackTimeSerieGraphContainer = require("views/stack_time_serie_graph_container")

  return Backbone.View.extend({
  	el: '',
    template: _.template(template),
    events: {
      'click .select_time_range': 'updateSelectingTimeRange'
    },
  	initialize : function(options) {
  		this.selectingTimeSeries = options.selectingTimeSeries;
  		this.serieGraphTimeRange = options.serieGraphTimeRange;
      this.eruptionTimeRange = options.eruptionTimeRange;
      this.forecastsGraphTimeRange = options.forecastsGraphTimeRange;
  		this.filterObserver = options.filterObserver;
      this.eruptions =  options.eruptions;
      this.stackTimeSeriesGraphContainer = options.stackTimeSeriesGraphContainer;
      this.compositeGraphContainer = options.compositeGraphContainer;
  		// this.listenTo( this.selectingFilter, "add", this.addGraph );
  		// this.listenTo( this.selectingFilter, "remove", this.removeGraph );
      this.categories = options.categories;
      this.beingShown = false;
  		this.graphs = [];
  	},

    updateSelectingTimeRange: function(){
      /* remove timeseries which are no longer selected*/
      //console.log("Update Time Range");
      var checkboxes = [];
      var checkedTimeRangeFilter = [];
      $('.select_time_range').each(function() {
        if (($(this).context.checked == true)){
          checkboxes.push($(this).context.id);
        }

      });

      if(checkboxes.length == 0){
        this.stackTimeSeriesGraphContainer.hide();
      }
      var data = [];
      for (var i = 0 ; i < this.graphs.length; i++){

          if (checkboxes.indexOf(this.graphs[i].serieId) >=0) {
              //console.log (this.graphs[i])
              data.push(this.graphs[i].data[0]);
            data.push(this.graphs[i].data[1]);
              checkedTimeRangeFilter.push(this.graphs[i].filters);
          }
      }
      //console.log(checkedTimeRange);
      //this.stackTimeSeriesGraphContainer.selectingFiltersChanged(checkedTimeRangeFilter, timeRange);
     // this.compositeGraphContainer.selectingFiltersChanged(this.selectingFilters);
     // this.compositeGraph.selectingFiltersChanged(this.selectingFilters);
      document.getElementById('composite-title').style.display = "block";
      (document.getElementsByClassName("composite-graph-container")[0]).style.display = "block";
      if (data.length >0){
        this.compositeGraphContainer.show(data);
      }else{
        this.compositeGraphContainer.hide();
      }

      //console.log(data);
      //this.trigger('update_composite');

    },

    addGraph : function( filters ) {

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
      this.compositeGraphContainer.timeRange = timeRange;

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
      this.$el.append("<div class = \"individual-graph-title\" style = \"font-weight: bold; color : black; background-color:white; padding-left: 50px; \">Individual graph display</div>");

      //var temp = "<ul id=\"select-options-db1b710c-f8a1-9f8a-19a7-ed5afcfe7c60\" class=\"dropdown-content select-dropdown multiple-select-dropdown active\" style=\"width: 1026px; position: absolute; top: 0px; left: 0px; opacity: 1; display: block;\"><li class=\"active\"><span><input type=\"checkbox\"><label></label>Pinatubo0703-083SeisNet(Earthquake Depth) </span></li><li class=\"active\"><span><input type=\"checkbox\"><label></label>Pinatubo0703-083SeisNet(Earthquake Magnitude) </span></li><li class=\"\"><span><input type=\"checkbox\"><label></label>UBO(Felt Earthquake Counts) </span></li><li class=\"\"><span><input type=\"checkbox\"><label></label>CAB(Earthquake Counts) </span></li><li class=\"\"><span><input type=\"checkbox\"><label></label>CRA(Earthquake Counts) </span></li></ul>";
      //this.$el.append("<ul id=\"select-options-e90cc158-e580-29c7-f252-ab6c6b42c2ad\" class=\"dropdown-content select-dropdown multiple-select-dropdown active\" style=\"width: 1026px; position: absolute; top: 0px; left: 0px; opacity: 1; display: block;\">");
      for (var i = 0; i < this.graphs.length; i++) {
        var checkboxid = this.graphs[i].timeRange.cid;
        var select = "<a style = \"padding-left: 75px;\"> <input class = \"select_time_range\"  type=\"checkbox\" id=\"" +checkboxid +"\" /> <label for=\"" + checkboxid+ "\"></label> </a>";
        //this.$el.append(select);
        this.$el.append(this.graphs[i].$el);

        this.graphs[i].show();
       // this.graphs[i].draw();

      }
      //this.$el.append("</ul>");
      //this.$el.append(temp);
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

    }


  });

});