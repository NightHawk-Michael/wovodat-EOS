define(['jquery', 'backbone'], function($, Backbone) {
  'use strict';

  return Backbone.Model.extend({
    idAttribute: 'ed_id',
    
    initialize: function(options) {

     // console.log(options.startTime);
      this.set({
        'startTime': options ? options.startTime : undefined,
        'endTime': options ? options.endTime : undefined,
        'startSelectTime': options ? options.startSelectTime : undefined,
        'endSelectTime' : options ? options.endSelectTime : undefined,
      });
    }
  });
});