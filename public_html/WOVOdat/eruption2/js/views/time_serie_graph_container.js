define(function(require) {
	'use strict';
	var $ = require('jquery'),
  Backbone = require('backbone'),
        JSZip = require('jszip'),
        hs  = require ('highslide'),
        //fs = require('vendor/zip/dist/FileSaver'),
        template = require('text!templates/time_serie_graph.html'),
        form_submit = require('text!templates/submit_info_form.html'),
  _ = require('underscore');

  var TimeSerieGraph = require("views/time_serie_graph");
  var StackGraphContainer = require("views/stack_time_serie_graph_container")

  return Backbone.View.extend({
  	el: '',
    template: _.template(template),
    submitform: _.template(form_submit),
    events: {
      'click .select_time_range': 'onCheckboxChanged',
      'click .gen-pdf' : 'generatePDF',
      'click .gen-csv' : 'popUpInfoForm',
      'click .stack-graph-btn' : 'generateStackGraph',
      'click .composite-graph-btn' : 'generateCompositeGraph',
      'click .toggle-error-bar' : 'toggleErrorBar',
      'click .submit-form' : 'submitDownloadForm'

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
      this.isErrorBar = false;
      this.token = "a";
      //hs.graphicsDir = '/highslide/graphics/';

    },
    submitDownloadForm : function() {
      var name = document.getElementById('name').value.trim();
      var email = document.getElementById('email').value.trim();
      var institution = document.getElementById('institution').value.trim();
      var filterName =  this.checkedTimeRangeFilter[0].filters.filterAttributes[0].name;
      var volcanoName = this.checkedTimeRangeFilter[0].filters.timeSerie.attributes.volcanoName;
      var dataType = this.checkedTimeRangeFilter[0].filters.timeSerie.attributes.component +" (" + filterName + ")";
      var agreeTerm = $("#agree-term")[0].checked;
      var atpos = email.indexOf("@");
      var dotpos = email.lastIndexOf(".");
      if (name === "") {
        return false;
      }
      if (institution === "") {
        return false;
      }
      if (email == "") {
        return false;
      }
      if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
        return false;
      }
      if (!agreeTerm){
        return false;
      }

      var dataToken = {
        data : "gen_token",
        name : name,
        email : email,
      }
      var URL = "/eruption2/api/";
      var a = this;
      $.getJSON(URL,dataToken, function(data){
        a.token =  data.token;
      });
      this.getDataForSendingEmail(URL, email, name, institution);
      $('#formPopup').closeModal();
      return false;

      //document.getElementById("download").appendChild(input);
      //document.getElementById("download").submit();

    },



    /**
     * Display a pop up to make user fill in their information
     * If user have been keyed in information, just donwload, no popup
     */
    popUpInfoForm : function(){
      var token = this.token;

      var dataToken = {
        data : "check_token",
        token : token,
      }
      var URL = "/eruption2/api/";
      var tokenExists;
      var self = this;
      $.get(URL,dataToken,function(data,status,xhr){
        tokenExists = data;
        if (tokenExists){
          self.getDataForSendingEmail(URL,"","","");

        }else{
          $('#formPopup').openModal();

        }
      },"json")

    },

      /**
       * Prepare data for sending email and add to database
       */
    getDataForSendingEmail : function(URL,name,email,institution){
      var dataType = [];
      var startTimeStr = "";
      var endTimeStr= "";
      for (var i = 0; i < this.checkedTimeRangeFilter.length; i++) {
        var filterName = this.checkedTimeRangeFilter[i].filters.filterAttributes[0].name;
        var monitoringData = this.checkedTimeRangeFilter[i].filters.timeSerie.attributes.component + " (" + filterName + ")";
        dataType.push(monitoringData);
        var data = this.checkedTimeRangeFilter[i].filters.timeSerie.attributes.data.data;
        for (var p = 0 ; p  < data.length; p++){
          if (data[p].filter != filterName) continue;
          var startTime
          var data = this.checkedTimeRangeFilter[i].filters.timeSerie.attributes.data.data;
          var stime =  data[p].time;
          var etime = 0;
          if (stime == undefined) {
            stime = data[p].stime;
            etime = data[p].etime;
          }


          if (stime >= this.serieGraphTimeRange.attributes.startTime && stime <= this.serieGraphTimeRange.attributes.endTime){
            if (startTimeStr == ""){
              var startDateTime = new Date(stime);
              startTimeStr = startDateTime.getDate() + "-" + (startDateTime.getMonth()+1) + "-" + startDateTime.getFullYear() + " " + startDateTime.getHours() + ":" + startDateTime.getMinutes() + ":" +  startDateTime.getSeconds();

            }
            if (etime != 0 ){
              var endDateTime = new Date(etime);
              endTimeStr = endDateTime.getDate() + "-" + (endDateTime.getMonth()+1) + "-" + endDateTime.getFullYear() + " " + endDateTime.getHours() + ":" + endDateTime.getMinutes() + ":" +  endDateTime.getSeconds();
            }
          }

        }
      }
      if (endTimeStr == "") endTimeStr = startTimeStr;

      var volcanoName = this.checkedTimeRangeFilter[0].filters.timeSerie.attributes.volcanoName;
      this.generateCSV();
      var dataDownload = {
        data : "add_user",
        name : name,
        email : email,
        institution: institution,
        vd_name : volcanoName,
        dataType  : dataType,
        startTimeStr: startTimeStr,
        endTimeStr: endTimeStr
      }
      $.get(URL, dataDownload );
    },

      /**
       * Toggle Error bar on individual graph
       */
    toggleErrorBar : function (){
        this.isErrorBar = !this.isErrorBar;
        this.trigger("toggle-error-bar");
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
        var stationName =  this.checkedTimeRangeFilter[i].filters.timeSerie.attributes.station_code1;
        var volcanoName = this.checkedTimeRangeFilter[i].filters.timeSerie.attributes.volcanoName;
        var showingName = this.checkedTimeRangeFilter[i].data[0].label;
        var filterName =  this.checkedTimeRangeFilter[i].filters.filterAttributes[0].name;
        var network =  this.checkedTimeRangeFilter[i].filters.timeSerie.attributes.short_data_type;
        var monitoringData = this.checkedTimeRangeFilter[i].filters.timeSerie.attributes.component +" (" + filterName + ")";


        var data = this.checkedTimeRangeFilter[i].filters.timeSerie.attributes.data.data;
        for (var p = 0 ; p  < data.length; p++){
          if (data[p].filter != filterName) continue;
          var startTimeStr;
          var endTimeStr = "";
          var startTime
          var data = this.checkedTimeRangeFilter[i].filters.timeSerie.attributes.data.data;
          var stime =  data[p].time;
          var etime = 0;
          if (stime == undefined) {
            stime = data[p].stime;
            etime = data[p].etime;
          }

          var startDateTime = new Date(stime);
          var startTimeStr = startDateTime.getDate() + "-" + (startDateTime.getMonth()+1) + "-" + startDateTime.getFullYear() + " " + startDateTime.getHours() + ":" + startDateTime.getMinutes() + ":" +  startDateTime.getSeconds();
          if (etime != 0){
            var endDateTime = new Date(etime);
            endTimeStr = endDateTime.getDate() + "-" + (endDateTime.getMonth()+1) + "-" + endDateTime.getFullYear() + " " + endDateTime.getHours() + ":" + endDateTime.getMinutes() + ":" +  endDateTime.getSeconds();
          }

          var value = data[p].value;
          var dataOwner = [];
          for (var ii = 0 ; ii < data[p].data_owner.length;ii = i+2){
            dataOwner.push(data[p].data_owner[ii]);
          }
          var dataOwner  = dataOwner.join(",");
          var uncertainty = data[p].error;
          if (uncertainty == undefined) uncertainty = "";
          if (stime >= this.serieGraphTimeRange.attributes.startTime && stime <= this.serieGraphTimeRange.attributes.endTime){
            //console.log (value);
            var d = {
              volcano: volcanoName,
              network: network,
              station: stationName,
              monitoringData: monitoringData,
              data : value,
              startTime: startTimeStr,
              endTime: endTimeStr,
              uncertainty : uncertainty,
              dataOwner : dataOwner,
              showingName: showingName
            }
            content.push(d);
          }

        }
        listContent.push(content);
      }

      if (this.data == undefined) return;

      var headers = ['Volcano','Network', 'Station','Monitoring Data (Type)','Data','Start Time','End Time',
        'Data Uncertainty','Data Owner'];
      //var z = new Zip();
      //console.log(z);
      var zip =  new JSZip();
      // for (var i = 0 ; i < listContent.length; i++){
      var csvContent = "data:text/csv;charset=utf-8,";
      for (var ii = 0 ; ii < listContent.length; ii++){
        var content = listContent[ii];
        var total = 0;

        // var content = listContent[i];
        // if (content == undefined) continue;
        var dataString = "";
        for (var p = 0 ; p < content.length; p++){
          total++;
          var d = content[p];
          dataString += d.volcano + ",\"" + d.network + "\",\"" + d.station + "\",\"" + d.monitoringData + " \",\"" + d.data + "\",\""
              + d.startTime + "\",\"" + d.endTime + " \",\"" + d.uncertainty + " \",\"" + d.dataOwner + " \"\n";
        }

        csvContent += "Total number of earthquakes: " + total + " \n";
        csvContent += "(100 km from volcanic vent)\n";
        csvContent += headers.join(",") + "\n";
        csvContent += dataString + "\n";
        var filename = "";
        if (content.length != 0){
          filename = content[0].showingName;
        }else{
          filename = "Blank"
        }
        zip.file(filename +".csv", csvContent);
      }

      //}
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
      w.document.getElementsByClassName("composite-graph-container")[0].style.display = "none";
      w.document.getElementsByClassName("stack-graph-container")[0].style.display = "none";

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
      this.checkedTimeRangeFilter = [];
      for (var i = 0 ; i < this.graphs.length; i++){
          if (count == 4) {

            break;
          }
          if (checkboxes.indexOf(this.graphs[i].serieId) >=0) {
              //console.log (this.graphs[i])
              this.data.push(this.graphs[i].data[0]);
              this.data.push(this.graphs[i].data[1]);
              graphs.push(this.graphs[i]);
              this.checkedTimeRangeFilter.push(this.graphs[i]);
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
        allowErrorbar: this.isErrorBar,
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
      var isChecked  = this.isErrorBar;
      this.$el.append("<div><a style = \"padding-left: 20px; right:0px; \"> <input class = \"toggle-error-bar\"  type=\"checkbox\" id=\"1\" /> <label for=\"1\"></label> Toggle Error Bar</a></div>");
      $(".toggle-error-bar").prop('checked',isChecked);



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

        /*
        Add data Owner
         */
        var dataOwner = "<div>";
        for (var ii = 0 ; ii < this.filters[i].timeSerie.attributes.data.data[0].data_owner.length; ii = ii+2){
          var cc_code = this.filters[i].timeSerie.attributes.data.data[0].data_owner[ii];
          var dataOwnerVal = this.filters[i].timeSerie.attributes.data.data[0].data_owner[ii+1];
          dataOwner +="<a href = \"" + dataOwnerVal + "\" target=\"_blank\" style = \"font-size: 10px;color: black;padding-left: " + padding_left/4 +"px; right:0px; \"> " + cc_code + "</a> "
        }

        dataOwner += " - ";
        for (var ii = 0 ; ii < this.filters[i].timeSerie.attributes.data.data[0].reference.length; ii = ii + 2){
          var reference_code =  this.filters[i].timeSerie.attributes.data.data[0].reference[ii];
          var reference_val =  this.filters[i].timeSerie.attributes.data.data[0].reference[ii+1];
          dataOwner += "<a href = \"" + reference_val + "\" target=\"_blank\" style = \"font-size: 10px;color: black; right:0px; \"> " + reference_code + "</a>"
        }



        dataOwner += "</div>";
        this.$el.append(dataOwner);

        // this.graphs[i].draw();

      }

      /*
       * Add form for user to fill in when user want to download csv
       */

      var button = "<a > <input style = \"background-color:grey; padding:2px 10px 2px 10px; \" class = \"waves-effect waves-light stack-graph-btn btn \"  type=\"button\" value = \"Stacked Graph (no limit)\" /> <label ></label> </a>";
      button += "<a > <input style = \" background-color:grey; padding:2px 10px 2px 10px;right:0px; \" class = \"waves-effect waves-light composite-graph-btn btn\"  type=\"button\" value = \"Composite Graph (max 5 graphs)\"/> <label ></label> </a>";
      button += "<a > <input style = \" background-color:grey; padding:2px 10px 2px 10px;right:0px; \" class = \"waves-effect waves-light btn gen-pdf\"  type=\"button\" value = \"Print PDF\"/> <label ></label> </a>";
      button += "<a  style = \" background-color:grey; padding:2px 10px 2px 10px;right:0px; \" class = \"waves-effect waves-light btn gen-csv modal-trigger\"  type=\"button\" >Print CSV </a>";
      this.$el.append(button);
      this.$el.append(form_submit);
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