<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<?php
// Start session
session_start();
// Regenerate session ID
session_regenerate_id(true);
$uname = "";
// If session was already started
if (isset($_SESSION['login'])) {
    // Get login ID and user name
    $uname = $_SESSION['login']['cr_uname'];
}
?>
<html>
    <head>
        <title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
        <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
        <meta http-equiv="cache-control" content="no-cache, must-revalidate">
        <meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
        <meta name="keywords" content="Volcano, Vulcano, Volcanoes, Vulcanoes, Volcan, Vulkan, eruption, 
              forecasting, forecast, predict, prediction, hazard, desaster, disaster, desasters, disasters, 
              database, data warehouse, format, formats, WOVO, WOVOdat, IAVCEI, sharing, streaming, earthquake, 
              earthquakes, seismic, seismicity, seismology, deformation, INSar, GPS, uplift, caldera, stratovolcano, 
              stratovulcano">
        <link href="/css/styles_beta.css" rel="stylesheet"> 
        <link type="text/css" href="/js/jqueryui/css/ui-lightness/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
        <script type="text/javascript" src="/js/jqueryui/js/jquery-1.6.4.min.js"></script>
        <script type="text/javascript" src="/js/jqueryui/js/jquery-ui-1.8.21.custom.min.js"></script>
        <script type="text/javascript" src="/js/jquery.flot.tuan.js"></script>
        <script type="text/javascript" src="/js/jquery.flot.navigate.tuan.js"></script> 
        <script type="text/javascript" src="/js/flot/jquery.flot.selection.js"></script>
        <script type="text/javascript" src="/js/flot/jquery.flot.marks.js"></script>
        <!--<script type="text/javascript" src="/js/flot/jquery.flot.navigate.js"></script> -->
        <!-- this is to prevent caching of js file, will need to amend when produce for production -->
        <script type="text/javascript" src="/js/wovodat.js"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCQ9kUvUtmawmFJ62hWVsigWFTh3CKUzzM&sensor=false"></script>
        <script type="text/javascript">
            // this is the list of available station type for each volcano,
            // this list will be initialize when the volcano is selected and 
            // it will be deleted when this volcano is deselected.
            var stationTypeList = [];
            // this list of available time series list
            var timeSeriesList = [];
            // the google maps (for both Time Series view and Compare Volcano view
            var map=[];
            // the list of station for each station type
            var stationsDatabase = {};
            // the list of station for each station type - The second volcano - in Compare Volcano view
            var compStationsDatabase = {};
            // the markers and infowindows for google maps
            var markers = [],infoWindows = [];
			//the markers for neighbors
			var neighMarkers=[], neighInfoWindows = [];
            // this inforWindow is for the volcano
            var infowindowVolcano=[];
            // the earthquakes loaded
            var earthquakes = {};
            //All information of the loaded volcano
            var volcanoInfo = {};
            // this link to all the plot graph
            var graphs = [];
            // this link to all the plot data for each graph
            var graphData = [];	
            // the variable store the reference to the overview graph
            var overviewGraph;
            // these marks will show the eruption start time 
            // eruptions data
            var eruptionsData = {};
            // reference data to since between various graphs
            var referenceTime = null;
            // full details scaled data
            var detailedData = [];
            $(document).ready(function(){
                //$("button").button();
                // initialize
                eruptionsData = {
                    marks: { 
                        show: true,
                        color: 'rgb(212,59,62)',
                        labelVAlign: 'top' ,
                        rows: 1
                    }, 
                    data: [], 
                    markdata: []
                };
                //register toRad function
                if (typeof(Number.prototype.toRad) === "undefined") {
                    Number.prototype.toRad = function() {
                        return this * Math.PI / 180;
                    }
                }
			
                //handle the behavior of the "Switch View" button
                $("#precursor_switch_button").click(function(){
                    if ($("#Map2").css("display") !="none"){
                        $("#Map").css("width","500px");
                        $("#CompVolcanoList").change();
                        $("#Map2").hide();
                        $("#OptionList").fadeIn(500);
                        $("#CompVolc").hide();
                        $("#CompStationList").hide();
                        $("#PlotArea").show();
                        $("#VolcanoList").change();
                        $("#EquakePanel1").hide();
                        $("#EquakePanel2").hide();
                    }
                    else{
                        $("#OptionList").hide();
                        $("#Map").css("width","400px");
                        $("#Map2").show();
                        $("#CompVolcanoList").change();
                        $("#CompVolc").show();
                        $("#CompStationList").show();
                        $("#PlotArea").hide();
                        $("#VolcanoList").change();
                        $("#EquakePanel1").show();
                        $("#EquakePanel2").show();
                        $("#overviewPanel").hide();
                    }
                });


                //handle the "Show Filter" button
                $("#FilterSwitch1").click(function(){
                    if ($("#FormFilter1").css("display")!="none"){
                        $("#FormFilter1").hide();
                        $("#FilterSwitch1").html("Show Filter");
                    }
                    else{
                        $("#FormFilter1").show();
                        $("#FilterSwitch1").html("Hide Filter");
                        if ($("#SDate1").val() =="" || $("#SDate1").val() =="undefined"){
                            $("#SDate1").val("01/01/1900");
                        }
                        if ($("#EDate1").val() =="" || $("#EDate1").val() =="undefined"){
                            var today = new Date();
                            $("#EDate1").val($.datepicker.formatDate("m/d/yy",today));
                        }
                    }
                });
                $("#FilterSwitch2").click(function(){
                    if ($("#FormFilter2").css("display")!="none"){
                        $("#FormFilter2").hide();
                        $("#FilterSwitch2").html("Show Filter");
                    }
                    else{
                        $("#FormFilter2").show();
                        $("#FilterSwitch2").html("Hide Filter");
                    }
                    if ($("#SDate2").val() =="" || $("#SDate2").val() =="undefined"){
                        $("#SDate2").val("01/01/1900");
                    }
                    if ($("#EDate2").val() =="" || $("#EDate2").val() =="undefined"){
                        var today = new Date();
                        $("#EDate2").val($.datepicker.formatDate("m/d/yy",today));
                    }
                });
				
                //hide the filter form
                $("#FormFilter1").hide();
                $("#FormFilter2").hide();
				
                //handle the DisplayEarthquake button
                $("#DisplayEquake1").click(function(){
                    var cavw = volcanoInfo[1].cavw;
                    if (!earthquakes[cavw]){
                        Wovodat.loadEarthquakes(500,1,volcanoInfo[1],insertMarkersForEarthquakes, plotEarthquakeData);
                    }
                    else{
                        insertMarkersForEarthquakes("",cavw,1);
                        plotEarthquakeData(cavw,"",1);
						
                        $("#FlotEqOption1").show();
                        $("#FlotDisplay1").show();
                        var flotEqOption = document.getElementById("FlotEqType1");
                        flotEqOption.title = cavw;
                        flotEqOption.options.length = 0;
                        flotEqOption.options[flotEqOption.length] = new Option("Show All", "Show All");
                        flotEqOption.options[flotEqOption.length] = new Option("Hide All", "Hide All");
                        flotEqOption.options[flotEqOption.length] = new Option("Unknown type", "");
                        var eqtypes = new Array();
                        if (earthquakes[cavw]['eqtypes']){
                            for (var j in earthquakes[cavw]['eqtypes']){
                                var type = earthquakes[cavw]['eqtypes'][j];
                                flotEqOption.options[flotEqOption.length]= new Option(type,type);
                            }
                        }
                        flotEqOption.onchange = function(){
                            var id = this.id;
                            var cavw = this.title;
                            var eqtype = this.options[this.selectedIndex].value;
                            plotEarthquakeData(cavw,eqtype,id.substring(id.length-1));
                        };
                    }
                });
                $("#DisplayEquake2").click(function(){
                    var cavw = volcanoInfo[2].cavw;
                    if (!earthquakes[cavw]){
                        Wovodat.loadEarthquakes(500,2,volcanoInfo[2],insertMarkersForEarthquakes, plotEarthquakeData);
                    }
                    else{
                        insertMarkersForEarthquakes("",cavw,2);
                        plotEarthquakeData(cavw,"",2);
						
                        $("#FlotEqOption2").show();
                        $("#FlotDisplay2").show();
                        var flotEqOption = document.getElementById("FlotEqType2");
                        flotEqOption.title = cavw;
                        flotEqOption.options.length = 0;
                        flotEqOption.options[flotEqOption.length] = new Option("Show All", "Show All");
                        flotEqOption.options[flotEqOption.length] = new Option("Hide All", "Hide All");
                        flotEqOption.options[flotEqOption.length] = new Option("Unknown type", "");
                        var eqtypes = new Array();
                        if (earthquakes[cavw]['eqtypes']){
                            for (var j in earthquakes[cavw]['eqtypes']){
                                var type = earthquakes[cavw]['eqtypes'][j];
                                flotEqOption.options[flotEqOption.length]= new Option(type,type);
                            }
                        }
                        flotEqOption.onchange = function(){
                            var id = this.id;
                            var cavw = this.title;
                            var eqtype = this.options[this.selectedIndex].value;
                            plotEarthquakeData(cavw,eqtype,id.substring(id.length-1));
                        };
                    }
                });
                //Handle the GotoGVP Buttons
                $("#GotoGVP1").click(function() {
                    var locat= $("#VolcanoList :selected").text();
                    var locati=locat.split("_");
                    open("http://www.volcano.si.edu/world/volcano.cfm?vnum="+locati[1]);
                });
                $("#GotoGVP2").click(function() {
                    var locat= $("#CompVolcanoList :selected").text();
                    var locati=locat.split("_");
                    open("http://www.volcano.si.edu/world/volcano.cfm?vnum="+locati[1]);
                });
                //handle the Filter buttons
                $("#FilterBtn1").click(function(){
                    var cavw;
                    if (volcanoInfo[1]){
                        cavw = volcanoInfo[1].cavw;
                        if (earthquakes[cavw]){
                            filterData(cavw,1);
                            $("#DisplayEquake1").click();
                            $("#FlotEqType1").change();
                        }
                        else{
                            $("#DisplayEquake1").click();
                            cavw = volcanoInfo[1].cavw;
                            filterData(cavw,1);
                            $("#DisplayEquake1").click();
                            $("#FlotEqType1").change();
                        }
                    }
                });
                $("#FilterBtn2").click(function(){
                    if (volcanoInfo[2]){
                        var cavw = volcanoInfo[2].cavw;
                        if (earthquakes[cavw]){
                            filterData(cavw,2);
                            $("#DisplayEquake2").click();
                            $("#FlotEqType2").change();
                        }
                        else{
                            $("#DisplayEquake2").click();
                            $("#FlotEqType2").change();
                        }
                    }
                });
                Wovodat.showProcessingIcon($("#loading"));
                //load the Compare Volcanos view
				
                // get the list of all volcano in our database and insert it into 
                // the dropdown list
                //insertVolcanoList is used as a callback function with 2 parameter: the first 
                //parameter is the list of Volcano, and the second parameter is the ID of the dropdown menu
                //to which data is populated
                Wovodat.getVolcanoList(insertVolcanoList,"VolcanoList");
                Wovodat.getVolcanoList(insertVolcanoList,"CompVolcanoList");
				
                // when the volcano option is changed
                $("#VolcanoList").change(function(){
                    //initialise value for Number of Events textbox
                    $("#Evn1").val(500);
                    $("#SDate1").datepicker({changeMonth:true,changeYear:true,yearRange:"1900:2100"});
                    $("#EDate1").datepicker({changeMonth:true,changeYear:true,yearRange:"1900:2100"});
                    $("#DepthRange1").slider({
                        range: true,
                        min: 0,
                        max: 500,
                        values : [0,500],
                        slide: function(event,ui){
                            $("#DepthLow1").val(ui.values[0]);
                            $("#DepthHigh1").val(ui.values[1]);
                        }
                    });
                    $("#DepthLow1").val(0);
                    $("#DepthHigh1").val(500);
                    $("#DepthLow1").change(function(){adjustSlider("1");});
                    $("#DepthHigh1").change(function(){adjustSlider("1");});
                    $("#SDate1").val("01/01/1900");
                    var today = new Date();
                    $("#EDate1").val($.datepicker.formatDate("m/d/yy", today));
                    //reset the flotEqOption and FlotDisplay
                    $("#FlotEqOption1").find('option').remove().end();
                    $("#FlotDisplayLat1").html("");
                    $("#FlotDisplayLon1").html("");
                    $("#FlotEqOption1").hide();
                    $("#FlotDisplay1").hide();
                    var volcano = $("#VolcanoList").val();
                    volcano = volcano.split("&");
                    var cavw = volcano[1];
                    //get the list of neightbors
					//and position them in the map
					neighMarkers[1] = [];
					neighInfoWindows[1] = [];
					Wovodat.getNeighbors(cavw,1,insertMarkersForNeighbors);
                    // get the eruption list for that specific volcano
                    Wovodat.getEruptionList({
                        volcano: $("#VolcanoList").val(),
                        handler: insertEruptionList,
                        selectId:"EruptionList"
                    });
                    //get data owner of the volcano
                    Wovodat.getCcUrl("1",cavw);
                    // get the location of that volcano and position to it in the
                    // google map
                    Wovodat.getLatLon({cavw:cavw,handler:drawMap,mapUsed:1},"VolcanoList", "Map");
                    // update the list of available station
                    // time-series view
                    if ($("#CompVolc").css("display")=="none"){
                        Wovodat.getStationsWithDataList({
                            cavw: cavw,
                            handler: updateStationsWithDataList,
                            tableId:"StationList"
                        });
                    }
                    //compare volcano view
                    else{
                        Wovodat.getAllStationsList({
                            cavw:cavw,
                            handler:updateAllStationsList,
                            tableId:"StationList",
                            mapId:"Map",
                            stationsDatabaseUsed: stationsDatabase,
                            mapUsed:1
                        });
                    }
                    // delete all the drawn graphs and the time series list
                    if ($("#CompVolc").css("display")=="none"){
                        for(var i in graphs){
                            delete(graphs[i]);
                            var div = document.getElementById(i + 'Row');
                            div.parentNode.removeChild(div);
                        }
                        document.getElementById('overviewPanel').style.display = 'none';
                        document.getElementById('TimeSeriesList').innerHTML = '';
                    }
                    // reset the local list of available stations for each data type
                    delete(stationsDatabase);
                    stationsDatabase = {};
                });
                
                $("#CompVolcanoList").change(function(){
					neighMarkers[2]=[];
					neighInfoWindows[2]=[];
                    //reset the flotEqOption and FlotDisplay
                    $("#FlotEqOption2").find('option').remove().end();
                    $("#FlotDisplayLat2").html("");
                    $("#FlotDisplayLon2").html("");
                    $("#FlotEqOption2").hide();
                    $("#FlotDisplay2").hide();
                    //initialize Number of events textbox
                    $("#Evn2").val(500);
                    //create date picker for earthquake filter form
                    $("#SDate2").val("01/01/1900");
                    var today = new Date();
                    $("#EDate2").val($.datepicker.formatDate("m/d/yy", today));
                    $("#SDate2").datepicker({changeMonth:true,changeYear:true,yearRange:"1900:2100"});
                    $("#EDate2").datepicker({changeMonth:true,changeYear:true,yearRange:"1900:2100"});
                    //Create slider for earthquake filter form
                    $("#DepthLow2").val(0);
                    $("#DepthHigh2").val(500);
                    $("#DepthLow2").change(function(){adjustSlider("2");});
                    $("#DepthHigh2").change(function(){adjustSlider("2");});
                    $("#DepthRange2").slider({
                        range: true,
                        min: 0,
                        max: 500,
                        values : [0,500],
                        slide: function(event,ui){
                            $("#DepthLow2").val(ui.values[0]);
                            $("#DepthHigh2").val(ui.values[1]);
                        }
                    });
                    Wovodat.getEruptionList({
                        volcano: $("#CompVolcanoList").val(),
                        handler: insertEruptionList,
                        selectId:"CompEruptionList"
                    });
                    var volcano = $("#CompVolcanoList").val();
                    volcano = volcano.split("&");
                    var cavw = volcano[1];
                    //get data owner of the volcano
                    Wovodat.getCcUrl("2",cavw);
                    Wovodat.getLatLon({cavw:cavw,handler:drawMap,mapUsed:2},"CompVolcanoList", "Map2");
					Wovodat.getNeighbors(cavw,2,insertMarkersForNeighbors);
                    Wovodat.getAllStationsList({
                        cavw: cavw,
                        handler: updateAllStationsList,
                        tableId:"CompStationList",
                        mapId:"Map2",
                        stationsDatabaseUsed:compStationsDatabase,
                        mapUsed:2
                    });
                    // reset the local list of available stations for each data type
                    delete(compStationsDatabase);
                    compStationsDatabase = {};
                });
                // get all the available graph move to the eruption
                $("#EruptionList").change(moveGraphsToEruptionTime);
            });
            // when user select a specific eruption, all the graphs will move to 
            // the volcano in the time series
            function moveGraphsToEruptionTime(){
                // get time of the eruption
                var value = this.value;
                if(value == "") return;
                value = value.split(' ');
                if(value.length <= 1) {
                    alert('No available data for this eruption');
                    return;
                }
                // convert the time to javascript data object
                var time = Wovodat.toDate(this.value).getTime();
                var range = 0;
                // since we have synchronized all the graphs, all of them must have
                // the same range
                for(var i in graphs){
                    var temp = graphs[i].getAxes().xaxis;
                    range = temp.max - temp.min;
                    break;
                }
                // get the duration of the displayed graph
                if(range == '0' ) {
                    alert('Please select at least one type of time series.')
                    return;
                }
                // the eruption will be displayed at the center of the time series.
                var minRange;
                var maxRange;
                range = range / 2;
                minRange = time - range;
                maxRange = time + range;
                var data;
                var placeholder;
                var options,newOptions;
                var tempGraph;
                for(var i in graphs){
                    tempGraph = graphs[i];
                    data = tempGraph.getData();
                    placeholder = tempGraph.getPlaceholder();
                    data = {
                        data: data[0].data,
                        label: data[0].label,
                        xaxis:{
                            max: maxRange,
                            min: minRange
                        }
                    };
                    options = tempGraph.getOptions();
                    newOptions = {
                        series: options.series,
                        grid: options.grid,
                        xaxis:{
                            max: maxRange,
                            min: minRange,
                            ticks: tickGenerator
                            ,
                            labelWidth: 50
                            ,
                            show: true
                        },
                        yaxis:options.yaxis,
                        zoom:{
                            interactive: true
                        },
                        pan: {
                            interactive: true
                        }
                    };
                    placeholder.empty();
                    delete(graphs[i]);
                    graphs[i] = $.plot(placeholder,[data,eruptionsData],newOptions);
                }
            }
            //synchronize slide with textbox
            function adjustSlider(id){
                $("#DepthRange"+id).slider("values",[$("#DepthLow"+id).val(),$("#DepthHigh"+id).val()]);
            }
			
            //filter loaded data
            function filterData(cavw,panelUsed){
                if (earthquakes[cavw]){
                    var nEvent = $("#Evn"+panelUsed).val();
                    var sDate = parseDateVal($("#SDate"+panelUsed).val());
                    var eDate = parseDateVal($("#EDate"+panelUsed).val());
                    var dhigh = parseFloat($("#DepthHigh"+panelUsed).val());
                    var dlow = parseFloat($("#DepthLow"+panelUsed).val());
                    var type = document.getElementById("EqType"+panelUsed);
                    type = type.options[type.selectedIndex].value;
                    var count = 0;
                    for (var i in earthquakes[cavw]){
                        if (count>nEvent){
                            earthquakes[cavw][i]['available'] = false;
                            continue;
                        }
                        if (typeof earthquakes[cavw][i]['marker']!="undefined"&& earthquakes[cavw][i]['time']!="" && typeof earthquakes[cavw][i]['time']!="undefined"){
                            var eType = earthquakes[cavw][i]['eqtype'];
                            var eDepth = parseFloat(earthquakes[cavw][i]['depth']);
                            var eMag = earthquakes[cavw][i]['mag'];
                            var eTime = parseDateVal(earthquakes[cavw][i]['time']);
                            var chosen = true;
                            earthquakes[cavw][i]['available'] = false;
                            if ((eType!=type && type!="") || (eDepth>dhigh || eDepth<dlow) || (eTime>eDate || eTime<sDate))
                            chosen = false;
                            if (chosen){
                                count++;
                                earthquakes[cavw][i]['available'] = true;
                            }
                        }
                    }
                }
            }
            // when user select a specific eruption, all the graphs will move to 
            // the volcano in the time series
            function moveGraphsToEruptionTime(){
                // get time of the eruption
                var value = this.value;
                if(value == "") return;
                value = value.split(' ');
                if(value.length <= 1) {
                    alert('No available data for this eruption');
                    return;
                }
                // convert the time to javascript data object
                var time = Wovodat.toDate(this.value).getTime();
                var range = 0;
                // since we have synchronized all the graphs, all of them must have
                // the same range
                for(var i in graphs){
                    var temp = graphs[i].getAxes().xaxis;
                    range = temp.max - temp.min;
                    break;
                }
                // get the duration of the displayed graph
                if(range == '0' ) {
                    alert('Please select at least one type of time series.')
                    return;
                }
                // the eruption will be displayed at the center of the time series.
                var minRange;
                var maxRange;
                range = range / 2;
                minRange = time - range;
                maxRange = time + range;
                var data;
                var placeholder;
                var options,newOptions;
                var tempGraph;
                for(var i in graphs){
                    tempGraph = graphs[i];
                    data = tempGraph.getData();
                    placeholder = tempGraph.getPlaceholder();
                    data = {
                        data: data[0].data,
                        label: data[0].label,
                        xaxis:{
                            max: maxRange,
                            min: minRange
                        }
                    };
                    options = tempGraph.getOptions();
                    newOptions = {
                        series: options.series,
                        grid: options.grid,
                        xaxis:{
                            max: maxRange,
                            min: minRange,
                            ticks: tickGenerator
                            ,
                            labelWidth: 50
                            ,
                            show: true
                        },
                        yaxis:options.yaxis,
                        zoom:{
                            interactive: true
                        },
                        pan: {
                            interactive: true
                        }
                    };
                    placeholder.empty();
                    delete(graphs[i]);
                    graphs[i] = $.plot(placeholder,[data,eruptionsData],newOptions);
                }
            }
            function updateTimeSeriesList(data){
                var timeSeriesList = document.getElementById('TimeSeriesList');
                var t;
                var value;
                var display;
                for(var i in data){
                    value = data[i];
                    value = value.split('&');
                    //display = value[0] + '_' + value[1] + '_' + value[2];
                    display = value[1];
                    if(value[5] != undefined)
                        display = display + '-' + value[5];
                    display += " (" + value[2] + ")";
                    value = value[0] + "&" + value[1] + "&" + value[2] + '&' + value[5];
                    t = document.createElement('tr');
                    t.id = value + 'Tr';
                    timeSeriesList.appendChild(t);
                    $("#" + value.replace(/&/g,"\\&").replace(/=/g,"\\=") + 'Tr').html("<td><input type='checkbox' id='" +value +  "' value='" + value + "' onclick='drawTimeSeries(this)'></td><td>" + display + "</td>");          
                }
            }
            function drawTimeSeries(obj){
                
                var value = obj.value;
                var index = value;
                value = value.split("&");
                var type = value[0];
                var table = value[1];
                var code = value[2];
                var component = value[3];
                if(obj.checked ){
                    var count = 0;
                    for(var i in graphs){
                        count++;
                    }
                    if(count >= 5){
                        alert('Please choose at most 5 time series to draw');
                        obj.checked = false;
                        return;
                    }
                    if(graphData[index] != undefined){
                        drawGraph({
                            id: index,
                            data: graphData[index]
                        });
                    }else{
                        Wovodat.getStationData({
                            type:type,
                            table:table,
                            code:code,
                            component: component,
                            handler:drawGraph
                        });
                        
                    }
                }else{
                    deleteGraph({id:obj.value});
                }
            }
            // data has the format [[[x1,y1],[x2,y2],[x3,y3]]]
            // id is the string to specify the type of the data
            function drawGraph(args){
                var id = args.id;
                // get the label from the list of available time series
                var label = document.getElementById(id + 'Tr').getElementsByTagName('td')[1].innerHTML;
                
                var data = Wovodat.highlightNoDataRange(args.data);
                // set up the reference time if that 
                if(referenceTime == null){
                    referenceTime = data[0][0][0];
                }
                // get detailed scaled data for the graph 
                // the data is divied into two scale: minimized scale and full scale
                // full scale contains resampling version of entire data in 12 hours period
                // minimized scale contains all data without any resampling.
                // the minimized scale will be used when the graph have to draw data 
                // with a range of less than month. This will efficiently improve then
                // running time of the javascript when perform drawing.
                var isDetailedDataAvailable = false;
                if(detailedData[id] == null){
                    try{
                        var worker = new Worker('/js/GetStationDataWorker.js');
                        worker.postMessage({id:id});
                        worker.onmessage = function(e){
                            detailedData[id] = e.data.data;
                            // set the graphs to appropriate dataset when 
                            graphs[id].getPlaceholder().bind('plotpan',function(event,plot){
                                Wovodat.redraw(graphs[id],graphData[id],e.data.data,graphs);
                            });
                            graphs[id].getPlaceholder().bind('plotzoom',function(event,plot){
                                Wovodat.redraw(graphs[id],graphData[id],e.data.data,graphs,true);
                            });
                        };
                    }catch(e){
                        Wovodat.getDetailedStationData({
                            id: id,
                            handler: function(e){
                                detailedData[id] = e.data;
                                // set the graphs to appropriate dataset when 
                                graphs[id].getPlaceholder().bind('plotpan',function(event,plot){
                                    Wovodat.redraw(graphs[id],graphData[id],e.data,graphs);
                                });
                                graphs[id].getPlaceholder().bind('plotzoom',function(event,plot){
                                    Wovodat.redraw(graphs[id],graphData[id],e.data,graphs,true);
                                });
                            }
                        });
                    }
                }else{
                    isDetailedDataAvailable = true;
                }
                
                if(graphData[id] == undefined)
                    graphData[id] = data;
                var minValue ,maxValue;
                var maxXValue = Number.MIN_VALUE;
                var sixMonths = 6*30*24*60*60*1000; // in milliseconds
                var minXValue;
                var i;
                var length = data[0].length;
                maxXValue = data[0][0][0];
                minValue = data[0][0][1];
                maxValue = minValue;
                
                for(i = 0 ; i < length; i++){
                    if(data[0][i][1] > maxValue) maxValue = data[0][i][1];
                    if(data[0][i][1] < minValue) minValue = data[0][i][1];
                }
                // get the maxXValue of every graph
                for(var a in graphData){
                    for(var b in graphs){
                        if (b == a){
                            var temp = graphData[a][0][0][0];
                            if(temp > maxXValue ) maxXValue = temp;
                        }
                    }
                }
                minXValue = maxXValue - sixMonths;
                minXValue = minXValue > data[0][length-1][0]? minXValue : data[0][length-1][0];
                for(var a in graphData){
                    for(var b in graphs){
                        if( b == a){
                            var temp = graphData[a][0][graphData[a][0].length -1][0];
                            if( minXValue < temp) minXValue = temp;
                        }
                    }
                }
                var tr = document.createElement('tr');
                tr.id = id + "Row";
                document.getElementById("GraphList").appendChild(tr);
                var display = id.split("&");
                if(display[3] != 'undefined'){
                    display = id;
                }else{
                    display = display[0]  + "&" + display[1] + "&" + display[2];
                }
                var td = document.createElement('td');
                var div = document.createElement('div');
                div.id = id + "Graph";
                div.style.width = '650px';
                div.style.height = '200px';
                td.appendChild(div);
                tr.appendChild(td);
                // temporarily hide the graph
                $(tr).css('display','none');
                
                // these marks will show the eruption start time 
                
                if(maxValue == minValue){
                    minValue = minValue - 1;
                    maxValue = maxValue + 1;
                }
                var options = {
                    series:{
                        points: {show:false},
                        color: 'rgb(60, 10, 255)'
                    },
                    grid:{
                        hoverable: true,
                        clickable: true,
                        backgroundColor:{
                            colors: ['#fff','#eee']
                        }
                    },
                    xaxis:{
                        max: maxXValue,
                        min: minXValue,
                        ticks: tickGenerator,
                        labelWidth: 50,
                        show: true
                    },
                    yaxis:{
                        panRange:[minValue,maxValue],  
                        zoomRange:[maxValue-minValue,maxValue-minValue],
                        max: maxValue,
                        min: minValue,
                        color: 'rgb(123,1,100)',
                        labelWidth: 25,
                        tickDecimals: 1
                    },
                    zoom:{
                        interactive: true
                    },
                    pan: {
                        interactive: true
                    }
                };
                if(id.indexOf('Seismic') > -1){
                    options.series.bars = {};
                    options.series.bars.show = true;
                    options.series.bars.barType = 'continued';
                }else{
                    options.series.lines = {};
                    options.series.lines.show = true;
                }
                data = {
                    data: data[0],
                    label: label
                };
                graphs[id] = $.plot($("#" + id.replace(/&/g,"\\&") + "Graph"),[data,eruptionsData],options);
                graphs[id].getPlaceholder().bind('plotpan plotzoom',function(event,plot){
                    Wovodat.redraw(graphs[id],graphData[id],detailedData[id],graphs);
                });
                // redraw other graphs
                var placeholder;
                var temp;
                for( i in graphs){
                    if( i == id) continue;
                    placeholder = graphs[i].getPlaceholder();
                    temp = graphs[i].getOptions();
                    options.yaxis.panRange = temp.yaxis.panRange;
                    options.yaxis.zoomRange = temp.yaxis.zoomRange;
                    options.yaxis.max = temp.yaxis.max;
                    options.yaxis.min = temp.yaxis.min;
                    data = graphs[i].getData();
                    data = {
                        data: data[0].data,
                        label: data[0].label
                    };
                    graphs[i] = $.plot(placeholder,[data,eruptionsData],options);
                }
                // this part is for synchronize the pan and zoom of the graphs
                for( i in graphs){
                    if(i != id){
                        synchronizeGraph(i,id);
                    }
                }
                
                $("#GraphList").sortable();
                
                // showing the tooltip of information for the graphs when
                // user hovers mouse over a point on the graph.
                var previousPoint = null;
                $("#" + id.replace(/&/g,"\\&") + "Graph").bind('plothover',function(event,pos,item){
                    if(item){
                        if(previousPoint != item.dataIndex){
                            previousPoint = item.dataIndex;
                            $("#tooltip").remove();
                            var x = new Date(item.datapoint[0]);
                            var currentTime = item.datapoint[0];
                            var index = 0;
                            x = x.getUTCDate() + "/" + (x.getUTCMonth() + 1) + "/" + x.getUTCFullYear() + " " + x.getUTCHours() + ":" + x.getUTCMinutes() + ":" + x.getUTCSeconds();
                            var content = "Time: " + x + " UTC";
                            var id = this.id;
                            index = id.indexOf("Graph");
                            id = id.substr(0,index);
                            for(index in graphs){
                                graphs[index].unhighlight();
                            }
                            for(index in graphs){
                                var data = graphs[index].getData();
                                data = data[0].data;
                                var currentIndex = -1;
                                if(index == id){
                                    graphs[index].highlight(0,item.dataIndex);
                                    currentIndex = item.dataIndex;
                                }
                                else{
                                    // searching for the value at the position x of 
                                    // graphs[index] using binary search
                                    var start = 0, end = data.length - 1;
                                    var mid = Math.floor((start + end) / 2);
                                    if(currentTime < data[end][0] || currentTime > data[start][0]){
                                        end = start - 1;
                                        currentIndex = -1;
                                    }
                                    while(start <= end){
                                        if(currentTime == data[mid][0]){
                                            graphs[index].highlight(0,mid);
                                            currentIndex = mid;
                                            break;
                                        }else{
                                            if(currentTime > data[mid][0]){
                                                end = mid - 1;
                                            }else{
                                                start = mid + 1;
                                            }
                                        }
                                        mid = Math.floor((start + end) / 2);
                                        if(end < start){
                                            currentIndex = -1;
                                        }
                                    }
                                }
                                if(currentIndex > 0){
                                    content += "<br/>" + graphs[index].getData()[0].label + ": " + data[currentIndex][1];
                                }
                            }
                            Wovodat.showTooltip(item.pageX, item.pageY,content);
                        }
                    }else{
                        for(index in graphs){
                            graphs[index].unhighlight();
                        }
                        $("#tooltip").remove();
                        previousPoint = null;
                    }
                });
                drawOverviewGraph();
                // making the overview shown
                $(tr).slideDown('slow');
                
                $("#overviewPanel").css('display','block');
                if(isDetailedDataAvailable){
                    graphs[id].getPlaceholder().bind('plotpan',function(event,plot){
                        Wovodat.redraw(graphs[id],graphData[id],detailedData[id],graphs);
                    });
                    graphs[id].getPlaceholder().bind('plotzoom',function(event,plot){
                        Wovodat.redraw(graphs[id],graphData[id],detailedData[id],graphs,true);
                    });
                }
            }
            // draw overview graph
            function drawOverviewGraph(){
                if(overviewGraph != undefined){
                    $("#overview").empty();
                    delete(overviewGraph);
                }
                var id;
                var data = [];
                for(id in graphs){
                    data.push(graphData[id][0]);
                }
                var options = {
                    series: {
                        lines: { show: true},
                        shadowSize: 0
                    },
                    xaxis: { mode:'time'},
                    yaxis: { ticks: []},
                    selection: { mode: "x", color: '#451A2B' }
                };
                overviewGraph = $.plot($("#overview"),data,options);
                // clear previous handler
                $("#overview").unbind('plotselected');
                
                // draw other main graphs when user select a portion of this graph
                $("#overview").bind('plotselected',function(event,ranges){
                    var id;
                    var plot;
                    var options,data,placeholder,newOptions;
                    var to = ranges.xaxis.to;
                    var from = ranges.xaxis.from;
                    for(id in graphs){
                        plot = graphs[id];
                        if(plot == undefined) continue;
                        placeholder = plot.getPlaceholder();
                        placeholder.empty();
                        // this is for the label
                        var data = plot.getData();
                        // when user select a section on the overview graph, the data
                        // will reset to the initial data which is 12 hours re-sampling data
                        data = {
                            data: graphData[id][0],
                            label: data[0].label
                        };
                        var o = Wovodat.getLocalMaxMin(data.data,from,to);
                        var maxY,minY;
                        maxY = o.max;
                        minY = o.min;
                        options = plot.getOptions();
                        newOptions = {
                            series: options.series,
                            grid: options.grid,
                            xaxis:{
                                max: to,
                                min: from,
                                ticks: tickGenerator,
                                labelWidth: 50,
                                show: true
                            },
                            yaxis:{
                                panRange: options.yaxis.panRange,
                                zoomRange: options.yaxis.zoomRange,
                                max: maxY,
                                min: minY,
                                color: 'rgb(123,1,100)',
                                labelWidth: 25,
                                tickDecimals:1
                            },
                            zoom:{
                                interactive: true
                            },
                            pan: {
                                interactive: true
                            }
                        }
                        graphs[id] = $.plot(placeholder,[data,eruptionsData],newOptions);
                        Wovodat.redraw(graphs[id],graphData[id],detailedData[id],graphs,true);
                    }
                });
            }
            // prints the available graphs
            function printGraphs(){
                var graphsArea = document.getElementById("PlotArea");
                graphsArea = graphsArea.cloneNode(true);
                var newWindow = window.open('');
                var doc = newWindow.document;
                var t;
                t = doc.createElement('div');
                t.style.margin = '0px 0px 0px 20px';
                t.innerHTML = '<b>www.WOVOdat.org</b>: Database of Volcanic Unrest<br/> Brought to You by the Earth Observatory of Singapore <br/><br/>';
                var volcano = $("#VolcanoList").val();
                volcano = volcano.split('&');
                var cavw = volcano[1];
                volcano = volcano[0];
                t.innerHTML += '<table><tr><td>Vocano: </td><td>' + volcano + '</td></tr><tr><td>CAVW: </td><td>' + cavw + '</td></tr></table>';
                doc.body.appendChild(t);
                t = doc.createElement('table');
                doc.body.appendChild(t);
                var tr,td,div;
                for(var i in graphs){
                    div = doc.createElement('div');
                    div.id = i + 'Graph';
                    div.style.width = '700px';
                    div.style.height = '200px';
                    td = doc.createElement('td');
                    tr = doc.createElement('tr');
                    tr.appendChild(td);
                    td.appendChild(div);
                    t.appendChild(tr);
                    $.plot(div,graphs[i].getData(),graphs[i].getOptions());
                }
                newWindow.print();
                newWindow.close();
            }
            
            function tickGenerator(axis){
                var ticks = 6;
                var size = axis.max - axis.min;
                size = size/ticks;
                var start = size * Math.floor(axis.min / size);
                var value = Number.Nan;
                var da;
                var res = [];
                for(var i = 0 ; i < ticks + 1 ; i++){
                    value = start + size * i;
                    value = value.toFixed(0);
                    value = Math.round(value);
                    da = new Date(value);
                    res.push([value, da.getUTCDate() + "/" + (da.getUTCMonth() + 1) + "/" + ("" + da.getUTCFullYear()).substr(0) + " " + da.getUTCHours() + ":" + da.getUTCMinutes() + ":" + da.getUTCSeconds()]);
                } 
                return res.sort();
            }
            // make the graph moves together
            function synchronizeGraph(i,j){
                var i1 = i.replace(/&/g,"\\&").replace(/=/g,"\\=");
                var j1 = j.replace(/&/g,"\\&").replace(/=/g,"\\=");
                $("#" + i1 + "Graph").bind('plotzoom',function(event,plot,args){
                    if(graphs[j] == undefined) return;
                    if(args[j] && args[j] == true)
                        return;
                    args[j] = true;
                    args.preventEvent = true;
                    graphs[j].zoom(args);
                    Wovodat.redraw(graphs[j],graphData[j],detailedData[j],graphs,true);
                });
                $("#" + i1 + "Graph").bind('plotpan',function(event,plot,args){
                    if(graphs[j] == undefined) return;
                    if(args[j] && args[j] == true)
                        return;
                    args[j] = true;
                    args.preventEvent = true;
                    graphs[j].pan(args);
                    Wovodat.redraw(graphs[j],graphData[j],detailedData[j],graphs);
                });
                $("#" + j1 + "Graph").bind('plotzoom',function(event,plot,args){
                    if(graphs[i] == undefined) return;
                    if(args[i] && args[i] == true)
                        return;
                    args[i] = true;
                    graphs[i].zoom(args);
                    Wovodat.redraw(graphs[i],graphData[i],detailedData[i],graphs,true);
                });
                $("#" + j1 + "Graph").bind('plotpan',function(event,plot,args){
                    if(graphs[i] == undefined) return;
                    if(args[i] && args[i] == true)
                        return;
                    args[i] = true;
                    args.preventEvent = true;
                    graphs[i].pan(args);
                    Wovodat.redraw(graphs[i],graphData[i],detailedData[i],graphs);
                });
            }
            function deleteGraph(args){
                var id = args.id;
                delete(graphs[id]);
                var tr = document.getElementById(id +'Row');
                if(tr)
                    tr.parentNode.removeChild(tr);
                var hideOverview = true;
                for(id in graphs){
                    hideOverview = false;
                    break;
                }
                if(hideOverview){
                    $("#overviewPanel").css('display','none');
                }else{
                    drawOverviewGraph();
                }
            }
            function deleteTimeSeriesList(type){
                var value;
                var id;
                var element;
                for(var t in stationsDatabase[type]){
                    value = stationsDatabase[type][t];
                    value = value.split("&");
                    id = value[0] + '&' + value[1] + '&' + value[2];
                    id = id + '&' + value[5];
                    deleteGraph({id:id});
                    element = document.getElementById(id + 'Tr');
                    element.parentNode.removeChild(element);
                }
            }
            function insertMarkersForStations(data,mapUsed){
                var value;
                var index;
                for(var i in data){
                    index = data[i];
                    value = index.split("&");
                    markers[index] = new google.maps.Marker({
                        position: new google.maps.LatLng(value[3], value[4]), 
                        map: map[mapUsed],
                        animation: google.maps.Animation.DROP
                    });
                    markers[index].index = index;
                    value = "Station type: " + value[0] + "<br/>Station code: " + value[2] + "<br/>Latitude: " + parseFloat(value[3]).toFixed(4)
                        + "<br/>Longitude: " + parseFloat(value[4]).toFixed(3);
                    infoWindows[index] = new google.maps.InfoWindow({
                        content:value 
                    });
                    google.maps.event.addListener(markers[index], 'click', function() {
                        for(var i in infoWindows){
                            infoWindows[i].close();
                            if(typeof infoWindow != 'undefined'){
                                if(typeof infoWindow.close != 'undefined'){
                                    infoWindow.close();
                                }
                            }
                        }
                            
                        infoWindows[this.index].open(map[mapUsed],markers[this.index]);
                    });
                    value = index.substr(0,1);
                    value = value.toLowerCase();
                    if(value == 't' || value == 'f'){
                        markers[index].setIcon('');
                    }else{
                        markers[index].setIcon('/img/pin_' + value + 's_s.png');
                    }
                }
            }
			function insertMarkersForNeighbors(cavw, list, panelUsed){
				if (list[list.length]=="")
					list.length--;
				for (var index in list){
					// alert(list[index]);
					var info_split = list[index].split(";");
					var neighCavw = info_split[0];
					var name = info_split[1];
					var lat = info_split[2];
					var lon = info_split[3];
					var marker = new google.maps.Marker({
					position:new google.maps.LatLng(lat,lon)
					});
					marker.setIcon("/img/pin.png");
					marker.setMap(map[panelUsed]);
					marker.setTitle(name+"_"+neighCavw);
					neighMarkers[panelUsed].push(marker);
					google.maps.event.addListener(marker,"click",function(){
						var selectDom;
						var selectj;
						if (panelUsed==1){
							selectDom = document.getElementById("VolcanoList");
							selectj = $("#VolcanoList");
						}
						else{
							selectDom = document.getElementById("CompVolcanoList");
							selectj = $("#CompVolcanoList");
						}
						for (var i in selectDom.options){
							if (selectDom.options[i].text==this.getTitle()){
								selectDom.selectedIndex = i;
								selectj.change();
							}
						}
						
					});
				}
			}
            /*insert markers for earthquakes
             *author: Tran Thien Nam
             *2012-07-19
             */
            function insertMarkersForEarthquakes(data,cavw, mapUsed){
                //load new data
                if (!earthquakes[cavw]){
                    earthquakes[cavw]={};
                    earthquakes[cavw]['vlat']=volcanoInfo[mapUsed]['lat'];
                    earthquakes[cavw]['vlon']=volcanoInfo[mapUsed]['lon'];
                    earthquakes[cavw]['eqtypes'] = [];
                    var equakeSet = {};
                    equakeSet = data.split(";");
                    if (equakeSet[equakeSet.length]="")
                        equakeSet.length--;
                    for (var i in equakeSet){
                        index = equakeSet[i];
							
                        nextQuake = index.split(",");
                        lat = nextQuake[0];
                        lon = nextQuake[1];
                        depth = nextQuake[2];
                        mag = nextQuake[3];
                        time = nextQuake[4];
                        type = nextQuake[5];
							
                        //choose icon size base on magnitude
                        size = Math.round(mag*2);
                        if (size<5) size = 5;
                        //choose icon image base on depth
                        if (depth <= 2.5) color = '../img/pin_ge.png'; // Green
                        else if (depth >2.5 && depth <= 5) color = '../img/pin_ye.png'; // YELLOW
                        else if (depth >5 && depth <= 10) color = '../img/pin_re.png'; // Red
                        else if (depth >10 && depth <= 50) color ='../img/pin_be.png'; // BLUE
                        else color = '../img/pin_dbe.png'; // DARK BLUE
							
                        //set icon
                        icon=new google.maps.MarkerImage(color,null,null,null,new google.maps.Size(size,size));
                        var marker = new google.maps.Marker({
                            position: new google.maps.LatLng(lat,lon),
                            map: map[mapUsed],
                            icon:icon,
                        });
                        marker.setTitle(cavw+";"+index);
                        var contentText = "Lat: " + lat + "<br/>Lon:" + lon + "<br/>Event Time:" + time + "<br/>Depth:" + depth + "<br/>Magnitude:" + mag;
                        var infoWindow = new google.maps.InfoWindow({content:contentText,});
							
                        //event triggered when an earthquake marker is clicked
                        google.maps.event.addListener(marker, 'click', function(){
                            var title = this.getTitle().split(";");
                            var cavw = title[0];
                            var infoWindow  = earthquakes[cavw][title[1]]['infoWindow'];
								
                            //close all recently opened window
                            for (var i in earthquakes[cavw]){
                                if (typeof  earthquakes[cavw][i]['infoWindow']!='undefined')
                                    earthquakes[cavw][i]['infoWindow'].setMap(null);
                            }
                            infoWindow.open(this.getMap(),this);
                        });
                        earthquakes[cavw][index]=[];
                        earthquakes[cavw][index]['marker']= marker;
                        earthquakes[cavw][index]['infoWindow']= infoWindow;
                        earthquakes[cavw][index]['eqtype'] = type;
                        earthquakes[cavw][index]['lat']=lat;
                        earthquakes[cavw][index]['lon']=lon;
                        if (depth=="" || typeof depth=="undefined")
                            earthquakes[cavw][index]['depth']=0;
                        else
                            earthquakes[cavw][index]['depth']=depth;
                        if (mag=="" || typeof mag=="undefined")
                            earthquakes[cavw][index]['mag'];
                        else
                            earthquakes[cavw][index]['mag']=mag;
                        earthquakes[cavw][index]['time']=time;
                        earthquakes[cavw][index]['available'] = true;
                        // alert(contains(type,earthquakes[cavw][index]['options']));
                        if ((type!="") && (typeof type!="undefined") && (contains(earthquakes[cavw]['eqtypes'],type)==false)){
                            earthquakes[cavw]['eqtypes'].push(type);
                        }
                    }
                }
                //display already loaded data
                else{
                    //load cached data
                    for (var i in earthquakes[cavw]){
                        if (typeof earthquakes[cavw][i]['marker']!="undefined"){
                            if (earthquakes[cavw][i]['available']==true)
                                earthquakes[cavw][i]['marker'].setMap(map[mapUsed]);
                            else{
                                earthquakes[cavw][i]['marker'].setMap(null);
                            }	
                        }	
                    }
                }
            }
            function parseDateVal(date){
                var result = Date.parse(date);
                if (isNaN(result)){
                    result = new Date(date.substring(0,4),parseInt(date.substring(5,7))-1,date.substring(8,10),date.substring(11,13),date.substring(14,16),date.substring(17,19),0);
                    result = result.getTime();
                }
                return result;
            }
            function plotEarthquakeData(cavw, eqtype, mapUsed){
                //define CONSTANTS and Plot Options
                var CONSTANTS = {};
                CONSTANTS.height = "130px";
                CONSTANTS.width = "300px";
                //option for lat-lon plot
                var plotOptions = {
                    legend:{position:"nw"},
                    series:{points:{show:true,radius: 1.0}},
                    colors:["#3a4cb2"],
                    grid:{
                        backgroundColor:{colors:["#f3ffed","#f3ffdc"]},
                        // this option is for changing the color of the border
                        borderColor: ["white"],
                        clickable:true,
                        hoverable:true,
                        autoHighlight:true
                    },
                    yaxis:{
                        tickFormatter : kmFormatter,
                        tickDecimals:0
                    },
                    xaxis:{
                        position:"top",
                        tickDecimals:0,
                        tickFormatter : kmFormatter
                    },
                    zoom:{ interactive: false},
                    pan: {interactive: true}
                };
                //options for time view plot
                var timeOptions = {
                    legend:{position:"nw"},
                    series:{points:{show:true,radius: 1.0}},
                    colors:["#3a4cb2"],
                    grid:{
                        backgroundColor:{colors:["#f3ffed","#f3ffdc"]},
                        // this option is for changing the color of the border
                        borderColor: ["white"],
                        clickable:true,
                        hoverable:true,
                        autoHighlight:true
                    },
                    yaxis:{
                        tickFormatter: kmFormatter,
                        tickDecimals:0
                    },
                    xaxis:{position:"top", mode:"time",timeformat:"%d/%m/%y",ticks:4},
                    zoom:{ interactive: false},
                    pan: {interactive: true},
                    selection: {mode: null}
                }
                var latArray = new Array();
                var lonArray = new Array();
                var timeArray = new Array();
                if (earthquakes[cavw]){
                    var vlat;
                    var vlon;
                    vlat = earthquakes[cavw]['vlat'];
                    vlon = earthquakes[cavw]['vlon'];
                    for (var i in earthquakes[cavw]){
                        if ((earthquakes[cavw][i]['eqtype']==eqtype || (typeof earthquakes[cavw][i]['lat']!="undefined" && earthquakes[cavw][i]['lat']!="" && eqtype=="Show All")) && eqtype!="Hide All" && earthquakes[cavw][i]['available']==true){
                            var lat = earthquakes[cavw][i]['lat'];
                            var lon = earthquakes[cavw][i]['lon'];
                            var time = Date.parse(earthquakes[cavw][i]['time'])*1000;
                            // set lat, lon coordination
                            latArray.push([calculateD(lat,lon,vlat,vlon,0),earthquakes[cavw][i]['depth']]);
                            lonArray.push([calculateD(lat,lon,vlat,vlon,1),earthquakes[cavw][i]['depth']]);
                            // set time coordination
                            //if time is not convertible by javascript native functions
                            //then use own-created function
                            if(isNaN(time)){
                                time = earthquakes[cavw][i]['time'];
                                time = new Date(time.substring(0,4),parseInt(time.substring(5,7))-1,time.substring(8,10),time.substring(11,13),time.substring(14,16),time.substring(17,19),0);
                                time = time.getTime();
                            }
                            timeArray.push([time,earthquakes[cavw][i]['depth']]);
                        }		
                    }
                    // for (var i in latArray)
                    // alert(latArray[i][0]+":"+latArray[i][1]);
                    // for (var i in lonArray)
                    // alert(lonArray[i][0]+":"+lonArray[i][1]);
                    var latPlot = [{
                            data:latArray
                        }];
                    var lonPlot = [{
                            data:lonArray
                        }];
                    var timePlot = [{
                            data:timeArray,
                        }];
				
                    var latitudePlotArea =$("#FlotDisplayLat"+mapUsed);
                    latitudePlotArea.css("height", CONSTANTS.height);
                    latitudePlotArea.css("width",CONSTANTS.width);
                    latitudePlotArea.css("font-size", "8px");
                    $.plot(latitudePlotArea,latPlot,plotOptions);
				
                    var longitudePlotArea =$("#FlotDisplayLon"+mapUsed);
                    longitudePlotArea.css("height", CONSTANTS.height);
                    longitudePlotArea.css("width",CONSTANTS.width);
                    longitudePlotArea.css("font-size", "8px");
                    $.plot(longitudePlotArea,lonPlot,plotOptions);
				
                    var timePlotArea =$("#FlotDisplayTime"+mapUsed);
                    timePlotArea.css("height", CONSTANTS.height);
                    timePlotArea.css("width",CONSTANTS.width);
                    timePlotArea.css("font-size", "8px");
                    $.plot(timePlotArea,timePlot,timeOptions);
                }
				
            }
            function calculateD(lat,lon,vlat,vlon,option){
                var R = 6371; //earth radius
                if (typeof lat=="undefined" || typeof lon=="undefined" || typeof vlat=="undefined" || typeof vlon=="undefined"){
                    return 0;
                }
                var dLat;
                var dLon;
                var diff;
                var tlat1;
                var tlat2;
                switch (option){
                    case 0:
                        dLat = 0;
                        dLon = (lon-vlon).toRad();
                        tlat1 = toRad(vlat);
                        tlat2 = toRad(vlat);
                        diff = lon - vlon;
                        break;
                    case 1:
                        dLon = 0;
                        dLat = (lat-vlat).toRad();
                        diff = lat - vlat;
                        tlat1 = toRad(vlat);
                        tlat2 = toRad(lat);
                        break;
                }
                // alert("tlat:"+tlat);
                var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                    Math.sin(dLon/2) * Math.sin(dLon/2) * Math.cos(tlat1) * Math.cos(tlat2);
                // alert("a:"+a);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
                // alert("c:"+c);
                var d = R * c;
                // alert("d:"+d);
                if ((diff<0&&diff>-180)||diff>90)
                    d = -d;
                return d;
            }
            function toRad(number){
                return number * Math.PI /180;
            }
            function kmFormatter(v, axis){
                return v.toFixed(axis.tickDecimals) + "km";
            }
            function contains(a, obj) {
                var i = a.length;
                while (i--) {
                    if (a[i] === obj) {
                        return true;
                    }
                }
                return false;
            }
            function openInfoWindow(){
                var marker = openInfoWindow.marker;
                var infoWindow = openInfoWindow.infoWindow;
                infoWindow.open(marker.getMap(),marker);
            }
			
            function ImageExist(url) {
                var img = new Image();
                img.src = url;
                return img.height != 0;
            }
            function updateTimeSeriesandStations(args,stationsDatabaseUsed,mapUsed){
                var action = args.action;
                switch(action){
                    case 'delete':
                        var type = args.type;
                        var index = '';// delete the available markers for this specific type
                        for(var i in stationsDatabaseUsed[type]){
                            index = stationsDatabaseUsed[type][i];
                            markers[index].setMap(null);
                        }
                        deleteTimeSeriesList(type);
                        break;
                    case 'updateNewData':
                        var type =args.type;
                        var data = args.data;
                        data = data.split(";");
                        data.length--;
                        stationsDatabaseUsed[type] = data;
                        // udpate the list of station nad the markers on the custom google map 
                        updateTimeSeriesList(data);
                        insertMarkersForStations(data,mapUsed);
                        break;
                    case 'updateOldData':
                        var type = args.type;
                        var data = stationsDatabaseUsed[type];
                        // update the list of station and the markers on the google map
                        updateTimeSeriesList(data);
                        insertMarkersForStations(data,mapUsed);
                        break;
                    default:
                        break;
                }
            }
            
            function selectAllAvailableVolcanoWithStationData(){
                var list = document.getElementById('VolcanoList');
                var length = list.options.length;
                var t;
                var i = -1;
                var f = function(){
                    var list = document.getElementById('VolcanoList');
                    i++;
                    if(i == length) return;
                    list.options[i].selected = 'selected';
                    t = $("#VolcanoList").val().split('&')
                    Wovodat.getAvailableStations({
                        cavw: t[1],
                        handler: function(o){
                            list = o.list;
                            if(list != undefined && list.length >= 1) {
                                console.log(list);
                                console.log(o.volcano);
                            }
                        },
                        volcano: t[0]
                    });
                    setTimeout(function(){
                        f();
                    },200);    
                };
                f();
            }
            function randomSelectVolcano(selectedId){
                var list = document.getElementById(selectedId);
                var length = list.options.length;
                var i = Math.floor(Math.random()*length);
                list.options[i].selected = 'selected';
                $("#"+selectedId).change();
            }
            function updateStationsWithDataList(args, tableId){
                stationTypeList.length = 0;
                stationTypeList = args.list;
                var stationsTable = $("#"+tableId);
                var html="";
                if(stationTypeList.length == 0){
                    html="<tr><td></td><td>No station that has data near this volcano.</td></tr>";
                    stationsTable.html(html);
                    return;
                }
                for (var i in stationTypeList){
                    html += "<tr><td><input type='checkbox' value='" + stationTypeList[i] + "' id='" + stationTypeList[i]+"Checkbox'/></td><td>" 
                        + formatReturnStations(stationTypeList[i])+  "</td></tr>";
                }
                stationsTable.html(html);
                for(var i in stationTypeList){
                    document.getElementById(stationTypeList[i] + "Checkbox").onclick = function(){
                        if(this.checked){
                            if(stationsDatabase[this.value]){
                                updateTimeSeriesandStations({
                                    type:   this.value,
                                    action: 'updateOldData'
                                }, stationsDatabase,1);
                            }else{
                                var volcano = $("#VolcanoList").val();
                                volcano = volcano.split("&");
                                var cavw = volcano[1];
                                Wovodat.getStations({
                                    cavw: cavw,
                                    type: this.value,
                                    handler: updateTimeSeriesandStations,
                                    stationsDatabaseUsed: stationsDatabase
                                });
                            }
                        }else{
                            updateTimeSeriesandStations({action:'delete',type:this.value}, stationsDatabase,1);
                        }
                    }
                }
            }
            function updateAllStationsList(args,tableId,mapId, stationsDatabaseUsed,mapUsed){
                stationTypeList.length = 0;
                stationTypeList = args.list.split(";");
                var stationsTable = $("#"+tableId);
                if (stationTypeList[stationTypeList.length-1] =="")
                    stationTypeList.length--;
                //count number of stations of each type
                var typeList={};
                var dataList={};
                for (var i in stationTypeList){
                    nextEntry = stationTypeList[i].split("&");
                    stationType = nextEntry[0];
                    if (typeList[stationType]){
                        typeList[stationType]++;
                        dataList[stationType]+=stationTypeList[i]+";";
                    }
                    else{
                        typeList[stationType]=1;
                        dataList[stationType] = stationTypeList[i]+";";
                    }
                }
                var html="";
                got_station = false;
                for (var i in typeList){
                    got_station = true;
                    var checkBoxId = tableId + i +"Checkbox";
                    html += "<tr><td><input type='checkbox' value='" + i + "' id='" + checkBoxId + "'/></td><td>" + formatReturnStations(i) +  ":" + typeList[i]+ "</td></tr>";
                }
                stationsTable.html(html);
                if(stationTypeList.length == 0 || !got_station){
                    html="<tr><td></td><td>No station that has data near this volcano.</td></tr>";
                    stationsTable.html(html);
                }
                for(var i in typeList){
                    document.getElementById(tableId + i +"Checkbox").onclick = function(){
                        if(this.checked){
                            if(stationsDatabaseUsed[this.value]){
                                updateTimeSeriesandStations({
                                    type:   this.value,
                                    action: 'updateOldData'
                                }, stationsDatabaseUsed, mapUsed);
                            }else{
                                updateTimeSeriesandStations({data:dataList[this.value],type:this.value,action:'updateNewData'}, stationsDatabaseUsed,mapUsed);
                            }
                        }else{
                            updateTimeSeriesandStations({action:'delete',type:this.value},stationsDatabaseUsed,mapUsed);
                        }
                    }
                }
            }
            function formatReturnStations(name){
                name = name + " stations";
                name = name.substr(0,1).toUpperCase() + name.substr(1);
                return name;
            }
            function drawLatLonOnMaps(pos,mapId,value){
                separate = pos.split(",");
                if (separate[separate.length-1]=="") separate.length--;
                for (var i in separate){
                    info = separate[i].split("X");
                    lat = info[0];
                    lon = info[1];
					
                    if(!lat || !lon){
                        lat = 1.29;
                        lon = 103.85;
                    }
                    var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(lat, lon), 
                        map: map,
                        animation: google.maps.Animation.DROP
                    });  
                    value = value.substr(0,1);
                    value = value.toLowerCase();
                    if(value == 't' || value == 'f'){
                        marker.setIcon('');
                    }else{
                        marker.setIcon('/img/pin_' + value + 's_s.png');
                    }
                    var contentString = "Volcano: " ;
                    infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        for(var i in infoWindows)
                            infoWindows[i].close();
                        infowindow.open(map,marker);
                    });
                }
            }
            function drawMap(args, volcId, mapId, mapUsed){
                var volcano = $("#"+volcId).val();
                volcano = volcano.split("&");
                if(args == undefined){
                    args = 0;
                }
                var lat = args.lat;
                var lon = args.lon;
                var elev = args.elev;
                var cavw = volcano[1];
                volcanoInfo[mapUsed] = {lat:args.lat,lon:args.lon,elev:args.elev,cavw:cavw};
                // location of singapore
                if(!lat || !lon){
                    lat = 1.29;
                    lon = 103.85;
                }
                var myOptions = {
                    center: new google.maps.LatLng(lat, lon),
                    zoom: 7,
                    mapTypeControl:false,
                    mapTypeId: google.maps.MapTypeId.SATELLITE,
                    streetViewControl:false
                };
                map[mapUsed] = new google.maps.Map(document.getElementById(mapId),myOptions);
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(lat, lon), 
                    map: map[mapUsed],
                    animation: google.maps.Animation.DROP
                });   
                var contentString = "Volcano: " + volcano[0] + "<br/>CAVW: " + volcano[1] +"<br/>Lat: " + parseFloat(lat).toFixed(3) + " N<br/>Lon: " + parseFloat(lon).toFixed(3)
                    + " E<br/>Elev: " + elev + "(meters)";
                infowindowVolcano[mapUsed] = new google.maps.InfoWindow({
                    content: contentString
                });
                google.maps.event.addListener(marker, 'click', function() {
                    for(var i in infoWindows)
                        infoWindows[i].close();
                    infowindowVolcano[mapUsed].open(map[mapUsed],marker);
                });
            }
            function insertEruptionList(obj,selectId){
                var data = [];
                var list = obj.list;
                list = list.split(";");
                var eruptions = document.getElementById(selectId);
                eruptions.options.length = 0;
                eruptions.options = [];
                var i = 0;
                var t;
                eruptions.options[0] = new Option("Select...","");
                for(;i < list.length;i++){
                    if(list[i].length == 0) continue;
                    t = list[i].split("&");
                    if(t[2] != undefined){
                        t[1] = t[1] + " " + t[2];
                        data.push({label:'<img src="/img/EruptionIcon.png"/><br/><b>Eruption<br/>' + t[1] + '</b>',position:Wovodat.toDate(t[1]).getTime()});
                    }
                    eruptions.options[eruptions.options.length] = new Option(t[1],t[1]);
                }
                eruptionsData.markdata = data;
            }
            //changed by Nam
            //insert parameter: selectId - id of the "select" option where the list of Volcano is inserted into
            function insertVolcanoList(obj, selectId){
                // a list of volcanos and their cawv separated by: ;
                var list = obj.list;
                list = list.split(";");
                // get the volcano select list tag
                var volcanos = document.getElementById(selectId);
                // reset the volcano list
                volcanos.options = [];
                // assign new list
                var i = 0;
                volcanos.options[0] = new Option("Select...","");
                for(;i < list.length;i++){
                    if (list[i].indexOf("Unnamed")==-1)
                        volcanos.options[volcanos.options.length] = new Option(list[i].replace('&','_'),list[i]);
                }
                randomSelectVolcano(selectId);
            }
			
        </script>
        <style type="text/css">
            #contentrview_x td{
                height: 30px;
            }
            #contentrview_x #StationList td{
                height: 20px;
            }
            #contentrview_x #StationList tr td:first-child{
                width: 50px;
                text-align: right;
            }
            #contentrview_x #CompStationList td{
                height: 20px;
            }
            #contentrview_x #CompStationList tr td:first-child{
                width: 50px;
                text-align: right;
            }
            #Evn1, #SDate1, #EDate1, #DepthLow1, #DepthHigh1, #EqType1, #Evn2, #SDate2, #EDate2, #DepthLow2, #DepthHigh2, #EqType2{
                font-size:13px;
            }
            #GraphList{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div id="wrapborder_x">
            <div id="wrap_x">
                <?php include 'php/include/header_beta.php'; ?>
                <div id="content_x">
                    <div id="contentrview_x">
                        <div style="height:70px;font-size:8px;">
                            <table id="username_logout" >
                                <tr>
                                    <td>
                                        <table id="loading" style="display:none">
                                            <tr>
                                                <td><img src="/gif2/loadinfo.net.gif"/></td>
                                                <td><h1>   Loading ...</h1></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr valign="middle">
                                    <td>Login as:<a href="/populate/my_account.php"><?php echo $uname; ?></a><a href="'/populate/logout.php'">|Logout</a></td>
                                </tr>
                            </table>
                        </div>
                        <!-- Data input -->
                        <table id="MainVolc">
                            <tr>
                                <td style="width:100px"><b>Volcano:</b></td>
                                <td>
                                    <select id="VolcanoList" style="width:140px">
                                        <option value="">Select...</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="height:6px" colspan=2><em><a href="#" id="dataOwner1">Data Owner</a></em></td>
                            </tr>
                            <tr>
                                <td style="height:6px" colspan=2><span id="volcstatus1"></span></td>
                            </tr>
                            <tr>
                                <td><b>Eruption:</b></td>
                                <td>
                                    <select id="EruptionList" style="width:140px">
                                        <option value="">Select...</option>
                                    </select>
                                </td>
                            </tr>


                            <tr>
                                <td colspan=2><b>View stations:</b></td>
                            </tr>
                            <tr>
                                <td colspan=2><table id="StationList"></table></td>
                            </tr>
                        </table>

                        <table id="CompVolc">
                            <tr>
                                <td style="width:100px"><b>Volcano:</b></td>
                                <td>
                                    <select id="CompVolcanoList" style="width:140px">
                                        <option value="">Select...</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Eruption:</b></td>
                                <td>
                                    <select id="CompEruptionList" style="width:140px">
                                        <option value="">Select...</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="height:6px" colspan=2><em><a href="#" id="dataOwner2">Data Owner</a></em></td>
                            </tr>
                            <tr>
                                <td style="height:6px" colspan=2><span id="volcstatus2"></span></td>
                            </tr>
                            <tr>
                                <td colspan=2><b>View stations:</b></td>
                            </tr>
                            <tr>
                                <td colspan=2><table id="CompStationList"></table></td>
                            </tr>
                        </table>						
                    </div>
                    <div id="contentlview_x">
                        <br/>
                        <!-- Google map -->
                        <table style="width:100%">
                            <tr>
                                <td><button id="precursor_switch_button">Switch View</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="width:400px;height:300px;float:left" id="Map" style="width:100%;">
                                    </div>
                                </td>
                                <td>
                                    <!-- Available options -->
                                    <div id="OptionList"  style="width:280px;height:320px;float:left;display:none;background-color:transparent">
                                        <ul style="background-color: #2042c1;border: #2042c1;height:30px;line-height:30px; ">
                                            <li style="color: white;vertical-align:middle;">Available time series data (max. 5)</li>
                                        </ul>
                                        <div style="
                                             overflow:auto;height:250px;
                                             margin-top:15px;
                                             margin-left: 2px;
                                             margin-right:2px;
                                             background-color:transparent;
                                             border: 1px solid #b0a9a9;
                                             " id="OptionList-1">
                                            <table id="TimeSeriesList" style="">

                                            </table>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div style="width:400px;height:300px;float:left" id="Map2">

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <div id="EquakePanel1">
                                        <table>
                                            <tr>
                                                <td colspan=2>
                                                    <button id="DisplayEquake1" >Display Earthquake</button>
                                                    <button id="FilterSwitch1">Show Filter</button>
                                                    <button id="GotoGVP1"> Go to GVP</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <form id="FormFilter1" onSubmit="return false;">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <label for="Evn1">Number of events</label>
                                                                </td>
                                                                <td>
                                                                    <select id="Evn1">
                                                                        <option value="100">100</option>
                                                                        <option value="200">200</option>
                                                                        <option value="300">300</option>
                                                                        <option value="400">400</option>
                                                                        <option value="500">500</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <label for="SDate1">Start date:</label>
                                                                </td>
                                                                <td>
                                                                    <input type="text" id="SDate1" size=10/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <label for="EDate1">End date:</label>
                                                                </td>
                                                                <td>
                                                                    <input type="text" id="EDate1" size=10/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <label for="DepthLow1">Depth Low:</label>
                                                                </td>
                                                                <td>
                                                                    <input type="text" id="DepthLow1" value="0" size=4/>
                                                                    <label for="DepthHigh1">High:</label>
                                                                    <input type="text" id="DepthHigh1" value="500" size=4/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan=3><div id="DepthRange1"></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <label for="EqType1">Type</label>
                                                                </td>
                                                                <td>
                                                                    <select id="EqType1">
                                                                        <option value="">All</option>
                                                                        <option value="R">Regional</option>
                                                                        <option value="Q">Quary Blast</option>
                                                                        <option value="VT">Volcano Tectonic</option>
                                                                        <option value="H">Hybrid</option>
                                                                        <option value="LF">Low Frequency</option>
                                                                        <option value="VLP">Very Long Period</option>
                                                                        <option value="E">Explosion</option>
                                                                        <option value="T">Tremor</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><button id="FilterBtn1">Filter</button></td>
                                                            </tr>
                                                        </table>
                                                    </form>
                                                </td>
                                            </tr>
                                            <tr id="FlotEqOption1" style="display:none">
                                                <td>
                                                    Earthquake Type:
                                                </td>
                                                <td>
                                                    <select id="FlotEqType1">
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr >
                                                <td colspan=2>
                                                    <table id="FlotDisplay1" style="display:none">
                                                        <tr>
                                                            <td colspan=2>
                                                                <h3>Latitude view (E-W)</h3>
                                                                <div id="FlotDisplayLat1">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan=2>
                                                                <h3>Longitude view (S-N)</h3>
                                                                <div id="FlotDisplayLon1">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan=2>
                                                                <h3>Time view</h3>
                                                                <div id="FlotDisplayTime1">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </td>
                                <td>
                                </td>
                                <td valign="top">
                                    <div id="EquakePanel2">
                                        <table>
                                            <tr>
                                                <td colspan=2>
                                                    <button id="DisplayEquake2">Display Earthquake</button>
                                                    <button id="FilterSwitch2">Show Filter</button>
                                                    <button id="GotoGVP2"> Go to GVP</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan=2>
                                                    <form id="FormFilter2" onSubmit="return false;">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <label for="Evn2">Number of events</label>
                                                                </td>
                                                                <td>
                                                                    <select id="Evn2">
                                                                        <option value="100">100</option>
                                                                        <option value="200">200</option>
                                                                        <option value="300">300</option>
                                                                        <option value="400">400</option>
                                                                        <option value="500">500</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <label for="SDate2">Start date:</label>
                                                                </td>
                                                                <td>
                                                                    <input type="text" id="SDate2" size=10/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <label for="EDate2">End date:</label>
                                                                </td>
                                                                <td>
                                                                    <input type="text" id="EDate2" size=10/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <label for="Depth2">Depth Low:</label>
                                                                </td>
                                                                <td>
                                                                    <input type="text" id="DepthLow2" value="0" size=4/>
                                                                    <label for="Depth2">High:</label>
                                                                    <input type="text" id="DepthHigh2" value="500" size=4/>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan=3><div id="DepthRange2"></div></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <label for="EqType2">Type</label>
                                                                </td>
                                                                <td>
                                                                    <select id="EqType2">
                                                                        <option value="">All</option>
                                                                        <option value="R">Regional</option>
                                                                        <option value="Q">Quary Blast</option>
                                                                        <option value="VT">Volcano Tectonic</option>
                                                                        <option value="H">Hybrid</option>
                                                                        <option value="LF">Low Frequency</option>
                                                                        <option value="VLP">Very Long Period</option>
                                                                        <option value="E">Explosion</option>
                                                                        <option value="T">Tremor</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><button id="FilterBtn2">Filter</button></td>
                                                            </tr>
                                                        </table>
                                                    </form>
                                                </td>
                                            </tr>
                                            <tr id="FlotEqOption2" style="display:none">
                                                <td>
                                                    Earthquake Type:
                                                </td>
                                                <td>
                                                    <select id="FlotEqType2">
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr >
                                                <td colspan=2>
                                                    <table id="FlotDisplay2" style="display:none">
                                                        <tr>
                                                            <td colspan=2>
                                                                <h3>Latitude view</h3>
                                                                <div id="FlotDisplayLat2">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h3 colspan=2>>Longitude view</h3>
                                                                <div id="FlotDisplayLon2">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan=2>
                                                                <h3>Time view</h3>
                                                                <div id="FlotDisplayTime2">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <!-- plotting area -->

                                <td colspan=2>
                                    <br/>
                                    <div id="overviewPanel" style="padding-left: 50px;padding-bottom: 10px;float:left;width:610px;display:none">
                                        <div style="text-align: right;float: right">
                                            <button id="printGraphs" style="height:40px"onclick="printGraphs()">Print Graphs</button>
                                        </div>
                                        <b>Overview (select a range to redraw the graph): </b>
                                        <div id="overview" style="width:400px;height:40px;">

                                        </div>
                                        <br/>

                                    </div>
                                    <div style="clear:both;" id="PlotArea">
                                        <table id="GraphList">
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <?php include 'php/include/footer_beta.php'; ?>
        </div>
    </body>
</html>
