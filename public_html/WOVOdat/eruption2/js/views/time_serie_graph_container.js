define(function(require) {
	'use strict';
	var $ = require('jquery'),
  Backbone = require('backbone'),
        JSZip = require('jszip'),
        //fs = require('vendor/zip/dist/FileSaver'),
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
      'click .gen-csv' : 'popUpInfoForm',
     // 'click .gen-csv' : 'generateCSV',
      'click .stack-graph-btn' : 'generateStackGraph',
      'click .composite-graph-btn' : 'generateCompositeGraph',
      'click .toggle-error-bar' : 'toggleErrorBar'

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

    },
    submitDownloadForm : function(id, element) {
      var name = document.getElementById('name' + id).value.trim();
      var email = document.getElementById('email_id' + id).value.trim();
      var phone = document.getElementById('phone' + id).value.trim();
      var rec = document.getElementById('requirement' + id).value.trim();
      var atpos = email.indexOf("@");
      var dotpos = email.lastIndexOf(".");
      if (name === "") {
        alert('Enter Your Name for Enquiry!');
        document.getElementById('name' + id).focus();
        hs.close(element);
        return false;
      }
      if (email == "") {
        alert('Enter Your Mail Id for Enquiry!');
        document.getElementById('email_id' + id).focus();
        hs.close(element);
        return false;
      }
      if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
        alert("Not a valid e-mail address");
        hs.close(element);
        return false;
      }
      var form = document.createElement("form");
      form.setAttribute("type", "hidden");
      form.setAttribute("name", "download");
      form.setAttribute("id", "download");
      form.setAttribute("method", "post");
      form.setAttribute("action", "download-single");
      var input = document.createElement("input");
      input2.setAttribute("type", "hidden");
      input2.setAttribute("name", "id");
      input2.setAttribute("value", id);
      var input2 = document.createElement("input");
      input2.setAttribute("type", "hidden");
      input2.setAttribute("name", "name");
      input2.setAttribute("value", name);
      var input3 = document.createElement("input");
      input3.setAttribute("type", "hidden");
      input3.setAttribute("name", "email");
      input3.setAttribute("value", email);
      var input4 = document.createElement("input");
      input4.setAttribute("type", "hidden");
      input4.setAttribute("name", "phone");
      input4.setAttribute("value", phone);
      var input5 = document.createElement("input");
      input5.setAttribute("type", "hidden");
      input5.setAttribute("name", "rec");
      input5.setAttribute("value", rec);
      document.getElementById("download").appendChild(input);
      document.getElementById("download").appendChild(input2);
      document.getElementById("download").appendChild(input3);
      document.getElementById("download").appendChild(input4);
      document.getElementById("download").appendChild(input5);
      document.getElementById("download").submit();

    },
    enquiry_submit_validate : function(id, element) {
      var frm = document.getElementById('frm' + id);
      var name = document.getElementById('name' + id).value.trim();
      var email_id = document.getElementById('email_id' + id).value.trim();
      var atpos = email_id.indexOf("@");
      var dotpos = email_id.lastIndexOf(".");
      if (name == "") {
        alert('Enter Your Name for Enquiry!');
        document.getElementById('name' + id).focus();
        return false;
      }

      if (email_id == "") {
        alert('Enter Your Mail Id for Enquiry!');
        document.getElementById('email_id' + id).focus();
        return false;
      }
      if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email_id.length) {
        alert("Not a valid e-mail address");
        return false;
      }
      hs.close(element);
      return true;
    },
    /**
     * Display a pop up to make user fill in their information
     */
    popUpInfoForm : function(){
      return hs.htmlExpand(this)
      var forTemplate = "<div class=\"highslide-maincontent\">" +
          "<table style=\"width:100%; taxt-align:left;\">" +
          "<tr style=\"display:none;\"><th></th></tr>" +
          "<tbody><tr><td>"
      "<table>"
      "<tr style=\"\"><th><br></th></tr>" +
      "<tr><td style=\"color:#333333; color:#333333; font-family:Oxygen-Bold,Verdana, Arial, Helvetica, sans-serif; font-size:14px; margin-bottom:10px; text-align:center;\" colspan=\"2\" >Please provide information before starting data download. </td></tr>" +
      "<tr><td style=\"color:#333333; font-family:Oxygen-Bold,Verdana, Arial, Helvetica, sans-serif; font-size:12px;\">Name<span style=\"color:#FF0000\">*</span>  :</td><td><input name=\"name\"  maxlength=\"150\" style=\"width: 190px;margin-bottom:3px; margin-top: 5px;\" type=\"text\" title=\"Name\"></td></tr>" +
      "<tr><td style=\"color:#333333; font-family:Oxygen-Bold, Verdana, Arial, Helvetica, sans-serif; font-size:12px;\">E-Mail<span style=\"color:#FF0000\">*</span>  :</td><td><input name=\"email_id\"  maxlength=\"250\" style=\"width: 190px; margin-bottom:3px;\" type=\"text\" title=\"Email\"></td></tr>" +
      "<tr><td style=\"color:#333333; font-family:Oxygen-Bold, Verdana, Arial, Helvetica, sans-serif; font-size:12px;\">Institution/Observatory:</td><td><input  name=\"institute\" maxlength=\"150\" style=\"width: 190px; margin-bottom:3px;\" type=\"text\" title=\"Institution/Observatory\"></td></tr>" +
      "<tr><td style=\"color:#333333; font-family:Oxygen-Bold,Verdana, Arial, Helvetica, sans-serif; font-size:12px;\">I agree to WOVOdat Data Policy</td><td><input type = \"checkbox\" name = \"agree\" value = \"acceptData\" style=\"width: 190px; margin-bottom:3px;\"</input></td></tr>" +
      "<tr><td>&nbsp;</td>" +
      "<td style=\"vertical-align:top;\">" +
      "<table>"
      "<tr style=\"display:none;\"><th></th></tr>" +
      "<tr><td><input name=\"submit\" id=\"submit\" value=\"Submit\"  onclick=\"javascript:submitDownloadData(this);\" onkeypress=\"javascript:submitDownloadData(this);\" ></td></tr></tbody></table>" +
      "</td></tr></tbody></table>" +
      "</td></tr>" +
      "</tbody></table></div>";
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

        var data = this.checkedTimeRangeFilter[i].filters.timeSerie.attributes.data.data;
        for (var p = 0 ; p  < data.length; p++){
          if (data[p].filter != filterName) continue;
          var stime =  data[p].time;
          var etime = 0;
          if (stime == undefined) {
            stime = data[p].stime;
            etime = data[p].etime;
          }
          var value = data[p].value;
          var dataOwner  =   data[p].data_owner.join(",");
          var dataCode = data[p].data_code;
          var uncertainty = data[p].error;
          if (uncertainty == undefined) uncertainty = "";
          var startDateTime = new Date(stime);
          var dateStartStr = startDateTime.getDate() + "-" + (startDateTime.getMonth()+1) + "-" + startDateTime.getFullYear() + " " + startDateTime.getHours() + ":" + startDateTime.getMinutes() + ":" +  startDateTime.getSeconds();
          var dateEndStr = "";
          if (etime != 0){
            var endDateTime = new Date(etime);
            dateEndStr = endDateTime.getDate() + "-" + (endDateTime.getMonth()+1) + "-" + endDateTime.getFullYear() + " " + endDateTime.getHours() + ":" + endDateTime.getMinutes() + ":" +  endDateTime.getSeconds();
          }


          if (stime >= this.serieGraphTimeRange.attributes.startTime && etime <= this.serieGraphTimeRange.attributes.endTime){
            //console.log (value);
            var d = {
              showName: showingName,
              stime: dateStartStr,
              etime: dateEndStr,
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

      var headers = ['Volcano Name', 'Station/Seismic Network Name', 'Start time','End time',  'Code of data',
        'Data','Data-uncertainty', 'Data Owner'];
      //var z = new Zip();
      //console.log(z);
      var zip =  new JSZip();
      for (var i = 0 ; i < listContent.length; i++){
        var csvContent = "data:text/csv;charset=utf-8,";
        var total = 0;

        var content = listContent[i];
        if (content == undefined) continue;
        var dataString = "";
        for (var p = 0 ; p < content.length; p++){
          total++;
          var d = content[p];
          dataString += d.volcanoName + ",\"" + d.stationName + "\",\"" + d.stime + "\",\"" + d.etime + "\", \"" + d.dataCode + " \",\"" + d.value + "\",\""
              + d.uncertainty + "\",\"" + d.dataOwner + " \"\n";
        }

        csvContent += "Total number of earthquakes: " + total + " \n";
        csvContent += "(100 km from volcanic vent)\n";
        csvContent += headers.join(",") + "\n";
        csvContent += dataString + "\n";
        var filename = "";
        if (content.length != 0){
          filename = content[0].showName;
        }else{
          filename = "Blank"
        }
        zip.file(filename +".csv", csvContent);
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
        var cc_code = this.filters[i].timeSerie.attributes.data.data[0].data_owner[0];
        var dataOwnerVal = this.filters[i].timeSerie.attributes.data.data[0].data_owner[1];
        var reference_code =  this.filters[i].timeSerie.attributes.data.data[0].reference[0];
        var reference_val =  this.filters[i].timeSerie.attributes.data.data[0].reference[1];


        var dataOwner = "<div>" +
            "<a href = \"" + dataOwnerVal + "\" target=\"_blank\" style = \"font-size: 10px;color: black;padding-left: " + padding_left/4*3 +"px; right:0px; \"> " + cc_code + "</a> " +
            "- <a href = \"" + reference_val + "\" target=\"_blank\" style = \"font-size: 10px;color: black; right:0px; \"> " + reference_code + "</a>" +
            "</div>";
        this.$el.append(dataOwner);

        // this.graphs[i].draw();

      }

      /*
       * Add form for user to fill in when user want to download csv
       */

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