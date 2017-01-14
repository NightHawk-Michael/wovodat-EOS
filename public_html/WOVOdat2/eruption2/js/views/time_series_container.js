define(function(require) {
  'use strict';
  var $ = require('jquery'),
      Backbone = require('backbone'),
      _ = require('underscore'),
      Serie = require('models/serie'),
      OverviewGraph = require('views/overview_graph'),
      FilterSelect = require('views/filter_select'),
      SelectingFilter = require('collections/selecting_filter'),      
      TimeRange = require('models/time_range');

  return Backbone.View.extend({
    el: '',
    
    initialize: function(options) {
      // _(this).bindAll('addSerie', 'removeSerie', 'clear');

      this.timeRange = options.timeRange;
      this.overviewSelectingTimeRange = new TimeRange();
      this.render();
    },

     clear: function() {
       if (this.collection.length === 0) {
         // this.overviewGraph.destroy();
         for (var g in this.graphs) {
           if (this.graphs.hasOwnProperty(g)) {
             this.graphs[g].destroy();
           }
         }
         this.graphs = {};
         this.render();
       }
     },



    render: function() {
       this.overviewGraph = new OverviewGraph({
         collection: this.collection,
         timeRange: this.timeRange,
         selectingTimeRange: this.overviewSelectingTimeRange
       });
       this.overviewGraph.$el.appendTo(this.$el);
    }
  });
});