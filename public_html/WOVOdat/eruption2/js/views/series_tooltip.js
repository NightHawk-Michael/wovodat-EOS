define(function(require) {
  'use strict';
  var $ = require('jquery'),
      _ = require('underscore'),
      Backbone = require('backbone'),
      

      DateHelper = require('helper/date');

  return Backbone.View.extend({
    el: '',
    initialize: function(options) {
      this.template = _.template(options.template);
      _(this).bindAll('remove');
      
      
    },

    move: function(x, y) {
      // console.log(x,y);
      this.$el.css({
        top: y + 5,
        left: x + 20,
      });
      this.$el.show();
    },

    show: function() {
      this.$el.show();      
    },

    hide: function() {
      this.$el.hide();
    },

    render: function(x, y, content) {
      this.$el.html(content);
      this.move(x, y);
      this.$el.appendTo('body');
      this.$el.addClass("graph-tooltip");
    },

    previous: {
      item : undefined
    },

    update: function(pos, item) {

      if (item) {
        if (JSON.stringify(this.previous.item) === JSON.stringify(item) ) {
          this.move(pos.pageX, pos.pageY);
        } else {
          this.previous.item = item;
          switch(item.datapoint.length){
            case 5: case 4:
              this.html = this.template({
                type: "bar",
                stime: DateHelper.formatDate(item.datapoint[0]),
                etime: DateHelper.formatDate(item.datapoint[1]),
                value: (item.datapoint[2] + item.datapoint[3])/2,
                error: item.datapoint[4]

              })
            this.render(pos.pageX, pos.pageY, this.html);
            break;
            case 3: case 2:
              //var symbol = item.series.points.symbol;
              //this.html = this.template({
              //  type: "point",
              //  symbol : symbol,
              //  //time: DateHelper.formatDate(item.datapoint[0]),
              //  value: item.datapoint[1],
              //  error: item.datapoint[2]
              //})
          }
          
        }
      } else {
        this.hide();
      }
    }
  });
});