define(function(require) {
  'use strict';
  var $ = require('jquery'),
      Backbone = require('backbone'),
      Eruption = require('models/eruption');

  return Backbone.Collection.extend({
    model: Eruption,
    
    initialize: function(options) {
      this.offline = options.offline;
    },

    changeVolcano: function(vd_id, handler) {
      if(this.offline){
        this.url = 'offline-data/eruption_list.json';
      }else{
        this.url = 'api/?data=eruption_list&vd_id=' + vd_id;
      }
      
      this.fetch({
        success: function(e){
          e.trigger("fetched");
        }
      });
    },
    getAvailableEruptions: function(timeRange){
      
      if(timeRange == undefined){
        // console.log(this.models);
        return this.models;
      }else{
        var result = [];
        var startTime = timeRange.get('minX');
        var endTime = timeRange.get('maxX');
        for(var i=0;i<this.models.length;i++){
          var mo =  this.models[i];
          var edStime  =  mo.get('ed_stime');
          var edEtime  =  mo.get('ed_etime');
          if (edStime<endTime && edEtime> startTime){
            result.push(mo);
          }
        }

        // console.log(this.models.length);
        return result;
      }
    }
  });
});
