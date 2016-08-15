require.config({
  paths: {
    // Vendors.
    'jquery': 'vendor/jquery/jquery.min',
    'backbone': 'vendor/backbone/backbone-min',
    'underscore': 'vendor/underscore/underscore-min',
    'text': 'vendor/require-text/text.min',
    'moment': 'vendor/momentjs/moment.min',
    'material':'vendor/materialize/materialize.min',
    'hammer':'vendor/materialize/hammer.min',
    // 'velocity':'vendor/materialize/velocity.min',
    //'JSZip' : 'vendor/zip/dist/jszip',
    'pace': 'vendor/pace/pace.min',
    'jquery.flot': 'vendor/jquery-flot/src/jquery.flot',
    'jquery.colorhelpers' : 'vendor/jquery-flot/lib/jquery.colorhelpers',
    'jquery.drag' : 'vendor/jquery-flot/lib/jquery.drag',
    'jquery.mousewheel' : 'vendor/jquery-flot/lib/jquery.mousewheel',
    'jquery.resize' : 'vendor/jquery-flot/lib/jquery.resize',
    'jquery.flot.navigate': 'vendor/jquery-flot/src/plugins/jquery.flot.navigate',
    'jquery.flot.selection': 'vendor/jquery-flot/src/plugins/jquery.flot.selection',
    'jquery.flot.symbol': 'vendor/jquery-flot/src/plugins/jquery.flot.symbol',
    'jquery.flot.time': 'vendor/jquery-flot/src/plugins/jquery.flot.time',
    'excanvas' : 'vendor/jquery-flot/lib/excanvas.min',
    'jquery.flot.tickrotor': 'vendor/jquery-flot/src/plugins/jquery.flot.tickrotor',
    'jquery.flot.errorbars': 'vendor/jquery-flot/src/plugins/jquery.flot.errorbars',
    'jquery.flot.axislabels': 'vendor/jquery-flot/src/plugins/jquery.flot.axislabels',
    'jquery.flot.legendoncanvas' :'vendor/jquery-flot/src/plugins/jquery.flot.legendoncanvas',
    'handlebars' : 'vendor/handlebars/handlebars.amd.min',

  },
  shim: {
    'jquery' : {
      exports: '$'
    },
    'backbone': {
      deps: ['underscore', 'jquery'],
      exports: 'Backbone'
    },
    'material': {
      deps: ['jquery', 'hammer']
    },
    'jquery.colorhelpers': {
      deps: ['jquery']
    },
    'jquery.resize': {
      deps: ['jquery']
    },
    'jquery.mousewheel': {
      deps: ['jquery']
    },
    'jquery.flot': {
      deps: ['jquery','excanvas','jquery.colorhelpers','jquery.mousewheel','jquery.resize'],
      exports: '$.flot'
    },
    'jquery.flot.selection': {
      deps: ['jquery.flot']
    },
    'jquery.flot.time': {
      deps: ['jquery.flot']
    },
    'jquery.flot.navigate': {
      deps: ['jquery.flot']
    },
    'jquery.flot.errorbars': {
      deps: ['jquery.flot']
    },
    'jquery.flot.symbol': {
      deps: ['jquery.flot']
    },
    'jquery.flot.axislabels': {
      deps: ['jquery.flot']
    },

    'jquery.flot.legendoncanvas': {
      deps: ['jquery.flot']
    },

  },
  config: {
      moment: {
          noGlobal: true
      }
  }
});
define(function(require) {
  require(['routes/router','jquery','backbone','jquery.flot'], function(App) {
    'use strict';
    new App();
  });
})