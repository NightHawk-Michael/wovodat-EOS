define(function(require) {
	'use strict';
	var $ = require('jquery'),
  Backbone = require('backbone'),
        JSZip = require('vendor/zip/dist/jszip'),
        fs = require('vendor/zip/dist/FileSaver'),
        template = require('text!templates/time_serie_graph.html'),
  _ = require('underscore');

  var TimeSerieGraph = require("views/time_serie_graph");
  var StackGraphContainer = require("views/stack_time_serie_graph_container")

  return Backbone.View.extend({
  	el: '',
    template: _.template(template),
    events: {
      'click .select_time_range': 'onCheckboxChanged',
      'click .gen-pdf' : 'generatePDF',
      'click .gen-csv' : 'generateCSV',
      'click .stack-graph-btn' : 'generateStackGraph',
      'click .composite-graph-btn' : 'generateCompositeGraph'
    },
  	initialize : function(options) {
  		this.selectingTimeSeries = options.selectingTimeSeries;
  		this.serieGraphTimeRange = options.serieGraphTimeRange;
      this.eruptionTimeRange = options.eruptionTimeRange;
      this.forecastsGraphTimeRange = options.forecastsGraphTimeRange;
  		this.filterObserver = options.filterObserver;
      this.eruptions =  options.eruptions;
      this.stackGraphContainer = options.stackGraphContainer;
      this.compositeGraphContainer = options.compositeGraphContainer;
  		// this.listenTo( this.selectingFilter, "add", this.addGraph );
  		// this.listenTo( this.selectingFilter, "remove", this.removeGraph );
      this.categories = options.categories;
      this.beingShown = false;
  		this.graphs = [];
      this.checkedTimeRangeFilter = [];

    },
    /**
     *Generate CSV file when click CSV button
    volcano-name (vd_name),
    station/seismic network name (ds/ss/sn_name),
    date-time (dd_tlt_time),
    code of data (dd_tlt_code, sd_ivl_code, etc.),
    data (dd_tlt1),
    data-uncertainty (dd_tlt_err1),
    data owner (cc_code).
     */
    generateCSV : function (){
      var listContent = [];
      if (this.checkedTimeRangeFilter.length == 0) return;
      for (var i = 0; i < this.checkedTimeRangeFilter.length; i++){
        var content =[];
        var timeSerie = this.checkedTimeRangeFilter[i].timeSerie;
        var url = timeSerie.collection.url;
        var vd_id = url.split("vd_id=")[1];
        var category = timeSerie.attributes.category;
        var stationName =  timeSerie.attributes.station_code1;
        var volcanoName = timeSerie.attributes.volcanoName;
        var showingName = timeSerie.attributes.showingName;
        var dataOwner =  timeSerie.attributes.data_owner.owner1;
        if (timeSerie.attributes.data_owner.owner2 != ""){
          dataOwner = dataOwner  + "-" + timeSerie.attributes.data_owner.owner2;
        }

        var data = timeSerie.attributes.data.data;
        for (var p = 0 ; p  < data.length; p++){
          var time =  data[p].time;
          var value = data[p].value;
          var dataCode = data[p].data_code;
          var uncertainty = data[p].error;
          if (uncertainty == undefined) uncertainty = "";
          if (time >= this.serieGraphTimeRange.attributes.startTime && time <= this.serieGraphTimeRange.attributes.endTime){
            //console.log (value);
            var d = {
              showName: showingName,
              time: new Date(time),
              value : value,
              uncertainty : uncertainty,
              stationName : stationName,
              volcanoName : volcanoName,
              dataOwner : dataOwner,
              dataCode : dataCode,
            }
            content.push(d);
          }

        }
        listContent.push(content);
      }

      if (this.data == undefined) return;

      var headers = ['Volcano Name', 'Station/Seismic Network Name', 'Date time', 'Code of data',
        'Data','Data-uncertainty', 'Data Owner'];
      //var z = new Zip();
      //console.log(z);
      var zip =  new JSZip();
      for (var i = 0 ; i < listContent.length; i++){
        var csvContent = "data:text/csv;charset=utf-8,";
        var total = 0;

        var content = listContent[i];
        var dataString = "";
        for (var p = 0 ; p < content.length; p++){
          total++;
          var d = content[p];
          dataString += d.volcanoName + ",\"" + d.stationName + "\",\"" + d.time + "\",\"" + d.dataCode + " \",\"" + d.value + "\",\""
              + d.uncertainty + "\",\"" + d.dataOwner + " \"\n";
        }

        csvContent += "Total number of earthquakes: " + total + " \n";
        csvContent += "(100 km from volcanic vent)\n";
        csvContent += headers.join(",") + "\n";
        csvContent += dataString + "\n";
        zip.file(content[0].showName +".csv", csvContent);
      }
      zip.generateAsync({type:"blob"})
          .then(function (blob) {
            saveAs(blob, "data.zip");
          });


    },
    generatePDF :function(){

      var obj = document.getElementsByTagName("body")[0].innerHTML;
      var head = document.getElementsByTagName("head")[0].innerHTML;
      var imgDatas = []
      var time_series =  document.getElementsByClassName("time-series-graph-container")[0];
      var canvases = time_series.getElementsByTagName("canvas")
      for (var i = 0 ; i < canvases.length; i++){
        var c  = canvases[i];
        var ctx = c.getContext("2d");
        var imgData = ctx.getImageData(0, 0, 1240, 200);
        imgDatas.push(imgData);

      }

      /*
      Write css file to head
       */
      var url = location.protocol + '//' + location.host + location.pathname;
      head = head.split('src=\"').join('src=\"'+url);
      head = head.split('href=\"').join('href=\"'+url);
      head = head.split('eruption2//').join('');



      var w = window.open();
      var t,i,j;
      w.document.head.innerHTML = head;
      w.document.body.innerHTML = obj;

      /*
       remove redundant part
       */
      w.document.getElementsByClassName("mgt20")[0].innerHTML = "";
      w.document.getElementsByClassName("mgt15")[0].innerHTML = "";
      w.document.getElementsByClassName("overview-graph-container")[0].style.display = "none";
      var checkboxes = w.document.getElementsByTagName("label");
      for (var t = 0 ; t < checkboxes.length; t++){
        checkboxes[t].style.display = "none";
      }
      var btns = w.document.getElementsByClassName("btn");
      for (var t = 0 ; t < btns.length; t++){
        btns[t].style.display = "none";
      }
      var time_serie2 = w.document.getElementsByClassName("time-series-graph-container")[0];
      var canvases2 = time_serie2.getElementsByTagName("canvas")
      for (var i = 0 ; i < canvases2.length; i++){
        var c  = canvases2[i];
        var ctx = c.getContext("2d");
        ctx.putImageData(imgDatas[i],0,0);


      }
      w.window.print();


    },
    onCheckboxChanged : function(){
      this.generateCompositeGraph();
     // this.generateStackGraph();

    },
    updateSelectingTimeRange: function(){
      /* remove timeseries which are no longer selected*/
      var checkboxes = [];
      $('.select_time_range').each(function() {
        if (($(this).context.checked == true)){
          checkboxes.push($(this).context.id);
        }

      });

      //if(checkboxes.length == 0){
      //  this.stackGraphContainer.hide();
      //}
      this.data = [];
      var graphs = [];
      var count = 0;
      for (var i = 0 ; i < this.graphs.length; i++){
          if (count == 4) break;
          if (checkboxes.indexOf(this.graphs[i].serieId) >=0) {
              //console.log (this.graphs[i])
              this.data.push(this.graphs[i].data[0]);
              this.data.push(this.graphs[i].data[1]);
            graphs.push(this.graphs[i]);
              this.checkedTimeRangeFilter.push(this.graphs[i].filters);
              count++;
          }
      }

      this.compositeGraphContainer.data = this.data;
      this.stackGraphContainer.data = this.data;
       this.stackGraphContainer.serieGraphTimeRange =  this.serieGraphTimeRange;
      this.stackGraphContainer.filters =  this.filters;


      //this.stackGraphContainer.graphs = graphs;
      //this.generateStackGraph();
      //this.generateCompositeGraph();


    },

    generateStackGraph : function(){
        this.trigger("update-stack");
    },
    generateCompositeGraph : function(){
      this.trigger("update-composite");
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
        var attributes = this.graphs[i].serieGraphTimeRange.attributes;
        attributes.serieID = this.graphs[i].timeRange.cid;
        this.graphs[i].timeRangeChanged(timeRange);
      };
      this.compositeGraphContainer.timeRange = timeRange;
      this.stackGraphContainer.timeRange =  timeRange;

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
      this.filters =  filters;
      this.stackGraphContainer.filters = filters;
      for (var i = 0; i < filters.length; i++) {
        this.addGraph(filters[i]);
      };

    },
    // render: function(selectingTimeSeries) {
    //   this.overviewGraph.$el.appendTo(this.$el);
    // },
    hide: function(){
      this.$el.html("");
     // this.stackGraphContainer.hide();
    },
    show: function(){
      this.$el.html("");
      this.$el.addClass("time-series-graph-container card-panel");
      this.$el.append("<div class = \"individual-graph-title\" style = \"font-weight: bold; color : black; background-color:white; padding-left: 50px; \">INDIVIDUAL GRAPH<br>Select individual graph to display in \"stacked graph\" or \"composite graph\" by clicking the check box</div>");

      //var temp = "<ul id=\"select-options-db1b710c-f8a1-9f8a-19a7-ed5afcfe7c60\" class=\"dropdown-content select-dropdown multiple-select-dropdown active\" style=\"width: 1026px; position: absolute; top: 0px; left: 0px; opacity: 1; display: block;\"><li class=\"active\"><span><input type=\"checkbox\"><label></label>Pinatubo0703-083SeisNet(Earthquake Depth) </span></li><li class=\"active\"><span><input type=\"checkbox\"><label></label>Pinatubo0703-083SeisNet(Earthquake Magnitude) </span></li><li class=\"\"><span><input type=\"checkbox\"><label></label>UBO(Felt Earthquake Counts) </span></li><li class=\"\"><span><input type=\"checkbox\"><label></label>CAB(Earthquake Counts) </span></li><li class=\"\"><span><input type=\"checkbox\"><label></label>CRA(Earthquake Counts) </span></li></ul>";
      //this.$el.append("<ul id=\"select-options-e90cc158-e580-29c7-f252-ab6c6b42c2ad\" class=\"dropdown-content select-dropdown multiple-select-dropdown active\" style=\"width: 1026px; position: absolute; top: 0px; left: 0px; opacity: 1; display: block;\">");
      var padding_left =this.$el[0].clientWidth-60;
      var padding_top = this.$el[0].clientHeight-10;

      for (var i = 0; i < this.graphs.length; i++) {
        var checkboxid = this.graphs[i].timeRange.cid;


        var select = "<a style = \"padding-left: " + padding_left +"px; right:0px; \"> <input class = \"select_time_range\"  type=\"checkbox\" id=\"" +checkboxid +"\" /> <label for=\"" + checkboxid+ "\"></label> </a>";
        this.$el.append(select);
        this.$el.append(this.graphs[i].$el);

        this.graphs[i].show();
       // this.graphs[i].draw();

      }

      var button = "<a > <input style = \"background-color:grey; padding:2px 10px 2px 10px; \" class = \"waves-effect waves-light stack-graph-btn btn \"  type=\"button\" value = \"Stacked Graph (no limit)\" /> <label ></label> </a>";
      button += "<a > <input style = \" background-color:grey; padding:2px 10px 2px 10px;right:0px; \" class = \"waves-effect waves-light composite-graph-btn btn\"  type=\"button\" value = \"Composite Graph (max 5 graphs)\"/> <label ></label> </a>";
      button += "<a > <input style = \" background-color:grey; padding:2px 10px 2px 10px;right:0px; \" class = \"waves-effect waves-light btn gen-pdf\"  type=\"button\" value = \"Print PDF\"/> <label ></label> </a>";
      button += "<a > <input style = \" background-color:grey; padding:2px 10px 2px 10px;right:0px; \" class = \"waves-effect waves-light btn gen-csv\"  type=\"button\" value = \"Print CSV\"/> <label ></label> </a>";
      this.$el.append(button);
      this.stackGraphContainer.width = this.$el.width();
      this.compositeGraphContainer.width = this.$el.width();
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