/*
java script file for v5
*/
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
//var compStationsDatabase = {};
// the markers and infowindows for volcano stations
var markers = [],infoWindows = [];
//the markers for volcanoes
var volMarkers  = [];
//the markers for neighbors
var neighMarkers=[], neighInfoWindows = [];
// this inforWindow is for the volcano
var infowindowVolcano=[];
//All information of the loaded volcano
var volcanoInfo = {};
// this link to all the plotted graph
var graphs = [];
// this link to all the plot data for each graph
var graphData = []; 
// var cloneData = [];
// the variable store the reference to the overview graph
//var overviewGraph;
// these marks will show the eruption start time 
// eruptions data
var eruptionsData = {};
eruptionsData.compEruptions = [];
// reference data to since between various graphs
// var referenceTime = null;
// full details scaled data
//var detailedData = [];

// Equake type
var equakeType = [];

var totalGraph = [];
var limitTotalGraph = 5;
var graphCount = [];

var ownerURL = [];

var WIDTH = 950;
var HEIGHT = 950;

var ccMap = new Map();
var eqMap = new Map();

// holds the data points for tooltips to appear
// has 3 variables for each data point: x_position, y_position, tooltip_text 
var tooltips = [];

function setupEquakeType(list){
	for(var i = 0;i<list.length;i++){
		eqMap.set(list[i].value, list[i].name);
	}
}

function setupCatalogOwner(list){
	for(var i = 0;i<list.length;i++){
		ccMap.set(list[i].value, list[i].name);
	}
}



function getCavw(mapUsed){
	//alert("A");
	if(mapUsed == undefined || (mapUsed !=1 && mapUsed != 2))
		return ;
	var dropdownList;
	if(mapUsed == 1){
		dropdownList = document.getElementById('VolcanoList');
	}else{
		dropdownList = document.getElementById('CompVolcanoList');
	}
	var value = dropdownList.value;
	if(value == undefined)
		return;
	var list = value.split("&");
	if(list.length != 2)
		return;
	var cavw = list[1];
	//alert(cavw);
	return cavw;
}


// get the list of owners based on the data         
function getOwnerList(data){
	var mySet = {}, temp;
	var length = data[0].length;
	if(length == 0) 
		return;
	var i,j;
	for( i = 0 ; i < length; i++){
		for(j = 3; j <6; j++){
			temp = data[0][i][j];
			mySet[temp] = true;
		}
	}
	var ownerList = [];
	j = 0;
	for(i in mySet){
		if(i != '0' && i != 'undefined')
			ownerList[j++] = parseInt(i);
	}
	return ownerList;
}            





function addOptionForFilter(args) {
	var id = args.id;
	var tableId = args.tableId;                
	var data = args.data;
	var length = data[0].length;

	var row=$(document.createElement('div')).appendTo(args.filterForm);
	var left1=$(document.createElement('div')).addClass("leftPanel").html("Earthquake type:").appendTo(row);
	var right1=$(document.createElement('div')).addClass("rightPanel").appendTo(row);


	var list=[];
	for(var i=0; i<length; i++){
		list.push(data[0][i]['eqtype']);
	}
	list.sort();

	var container=[];
	var containers=$('<div></div>');

	for(var i=0; i<length; i++) 
		if(i==0 || list[i]!=list[i-1]) {               
			var labelCB=list[i],valueCB=list[i];
			if(list[i]!=null) {
				if(equakeType[list[i]]) labelCB=equakeType[list[i]];
			} else {
				valueCB="Undefined";
				labelCB="Undefined";                        
			}
			
			var div=$('<div></div>').appendTo(right1);
			var checkBox = $('<input />', { type: 'checkbox', value: valueCB }).appendTo(div);
			var text = $('<label />', { text: labelCB }).appendTo(div);
			
			container[valueCB]=$(document.createElement("div")).appendTo(containers);

			checkBox.change(function() {
				var typeFilter=$(this).attr('value');
				
				if ($(this).is(':checked')) {
					if(totalGraph[tableId]>=limitTotalGraph) {
						$(this).prop('checked',false);
						return;
					}
					totalGraph[tableId]++;
					graphCount[tableId][id]++;
					var tmpData=[];
					tmpData[0]=[];
					
					for(var i=0;i<data[0].length;i++) {
						if(typeFilter=='*' || ((typeFilter=="Undefined" || typeFilter=="null") &&  (data[0][i]['eqtype']==null || data[0][i]['eqtype']=="null")) || data[0][i]['eqtype'] == typeFilter) {
							tmpData[0].push(data[0][i]);                                        
						}
					}

					var tmpArgs = {};
					$.extend(tmpArgs,args);
					tmpArgs.id+="&"+typeFilter;
					tmpArgs.data=tmpData;
					tmpArgs.equakeType=typeFilter;
					tmpArgs.container=container[typeFilter];

					drawGraph2(tmpArgs);
				} else {
					totalGraph[tableId]--;
					graphCount[tableId][id]--;
					$(container[typeFilter]).html("");
				}
				
			});

		}

	$(args.td).append(containers); 
}

function addOptionForFitlerTRM(args) {
	var id = args.id;
	var tableId = args.tableId;                
	var data = args.data[0];
	var length = data.length;

	var row=$(document.createElement('div')).appendTo(args.filterForm);

	var left1=$(document.createElement('div')).addClass("leftPanel").html("TRM type:").appendTo(row);
	var right1=$(document.createElement('div')).addClass("rightPanel").appendTo(row);

	var left2=$(document.createElement('div')).addClass("leftPanel").html("QDepth:").appendTo(row);
	var right2=$(document.createElement('div')).addClass("rightPanel").appendTo(row);

	

	var TRMTypeList,QDepthList;

	function getTRMTypeList() {
		var list=[];
		list.push("Show all");

		for(var i in data) {
			if($.inArray(data[i]["trm_type"],list)==-1) {
				list.push(data[i]["trm_type"]);
			}
		}

		
		return list;
	}

	function generateTRMTypeList() {
		TRMTypeList=$("<select></select>").appendTo(right1);
		var list=getTRMTypeList();

		for(var i in list) {
			$(TRMTypeList).append($('<option></option>').attr("value",list[i]).text(list[i]));
		}
	}

	function generateQDepthList() {
		QDepthList=$("<select></select>").appendTo(right2);
		var list=["Show all","D","I","U","S","U"];
		var text=["Show all","More than 10 km","4 to 10 km","Less than 4 km","Unknown"];

		for(var i in list) {
			$(QDepthList).append($('<option></option>').attr("value",list[i]).text(text[i]));
		}
	}

	function appendFilterButton() {
		var button=$("<button></button>").text("Filter").addClass("FilterBtn").css("font-size","10px").appendTo($("<div></div>").addClass("FilterBtnHolder").appendTo(args.filterForm));
		var container=$("<div></div>").appendTo(args.td);

		$(button).click(function(){
			$(container).html("");

			var TRMType=$(TRMTypeList).val();
			var QDepth=$(QDepthList).val();
					
			var tmpData=[];
			tmpData[0]=[];
			
			for(var i in data) {
				if(data[i]["trm_type"]==TRMType || TRMType=="Show all")
					if((data[i]["qdepth"]=="Undefined" && QDepth=="U") || data[i]["qdepth"]==QDepth || QDepth=="Show all") {
						tmpData[0].push(data[i]);
					}
			}
	
			var tmpArgs = {};
			$.extend(tmpArgs,args);

			tmpArgs.data=tmpData;

			tmpArgs.container=container;
			
			drawGraph2(tmpArgs);

			return false;
		});

		$(button).click();
	}
	
	generateTRMTypeList();
	generateQDepthList();
	appendFilterButton();
}

function addOptionForFilterGasSpecies(args) {
	var id = args.id;
	var tableId = args.tableId;                
	var data = args.data[0];
	var length = data.length;

	var row=$(document.createElement('div')).appendTo(args.filterForm);

	var left1=$(document.createElement('div')).addClass("leftPanel").html("Gas species:").appendTo(row);
	var right1=$(document.createElement('div')).addClass("rightPanel").appendTo(row);
	var gasList=$("<select></select>").appendTo(right1);
	var container=$("<div></div>").appendTo(args.td);

	function generateGasList() {
		var list=[];
		for(var i in data) {
			if($.inArray(data[i]["gas_species"],list)==-1) {
				list.push(data[i]["gas_species"]);
			}
		}

		for(var i in list) {
			$(gasList).append($('<option></option>').attr("value",list[i]).text(list[i]));
		}
	}

	generateGasList();

	$(gasList).change(function(){
		var gas=$(gasList).val();
		if(gas) {
			var tmpData=[];
			tmpData[0]=[];
			
			for(var i=0;i<data.length;i++) {
				if(data[i]["gas_species"]==gas)
					tmpData[0].push(data[i]);                                
			}

			
			var tmpArgs = {};
			$.extend(tmpArgs,args);

			tmpArgs.data=tmpData;

			tmpArgs.container=container;
			
			drawGraph2(tmpArgs);
		}
	});

	$(gasList).change();
}

function addOptionForFilterEQType(args) {
	var id = args.id;
	var tableId = args.tableId;                
	var data = args.data[0];
	var length = data.length;

	var row=$(document.createElement('div')).appendTo(args.filterForm);

	var left1=$(document.createElement('div')).addClass("leftPanel").html("Earthquake type:").appendTo(row);
	var right1=$(document.createElement('div')).addClass("rightPanel").appendTo(row);
	var eqtypeList=$("<select></select>").appendTo(right1);
	var container=$("<div></div>").appendTo(args.td);

	function generateEQTypeList() {
		var list=[];
		for(var i in data) {
			if($.inArray(data[i]["eqtype"],list)==-1) {
				list.push(data[i]["eqtype"]);
			}
		}

		for(var i in list) {
			$(eqtypeList).append($('<option></option>').attr("value",list[i]).text(list[i]));
		}
	}

	generateEQTypeList();

	$(eqtypeList).change(function(){
		var type=$(this).val();
		if(type) {
			var tmpData=[];
			tmpData[0]=[];
			
			for(var i=0;i<data.length;i++) {
				if(data[i]["eqtype"]==type)
					tmpData[0].push(data[i]);                                
			}

			
			var tmpArgs = {};
			$.extend(tmpArgs,args);
			tmpArgs.data=tmpData;
			tmpArgs.container=container;                        
			drawGraph2(tmpArgs);
		}
	});

	$(eqtypeList).change();
}

function addOptionForFilterPrec(args) {
	var id = args.id;
	var tableId = args.tableId;                
	var data = args.data[0];
	var length = data.length;

	var row=$(document.createElement('div')).appendTo(args.filterForm);

	var left1=$(document.createElement('div')).addClass("leftPanel").html("Precipitation type:").appendTo(row);
	var right1=$(document.createElement('div')).addClass("rightPanel").appendTo(row);
	var prectypeList=$("<select></select>").appendTo(right1);
	var container=$("<div></div>").appendTo(args.td);

	function generatePrectypeList() {
		var list=[];
		for(var i in data) {
			if($.inArray(data[i]["tprec"],list)==-1) {
				list.push(data[i]["tprec"]);
			}
		}

		for(var i in list) {
			$(prectypeList).append($('<option></option>').attr("value",list[i]).text(list[i]));
		}
	}

	generatePrectypeList();

	$(prectypeList).change(function(){
		var type=$(this).val();
		if(type) {
			var tmpData=[];
			tmpData[0]=[];
			
			for(var i=0;i<data.length;i++) {
				if(data[i]["tprec"]==type)
					tmpData[0].push(data[i]);                                
			}

			
			var tmpArgs = {};
			$.extend(tmpArgs,args);
			tmpArgs.data=tmpData;
			tmpArgs.container=container;                        
			drawGraph2(tmpArgs);
		}
	});

	$(prectypeList).change();
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

// get the map used: 1 or 2
function side(a){
	var m = a.length;
	// thing get complicated with tilt data
	// if(a.indexOf('Tilt') > 0) m = m - 1;
	var k = a.substring(m-1,m);
	if(k == '1' || k == '2') return k;
	else{
		return '';
	}
}


/*
Set Print button is visible or invisible
*/
function setPrintButtonVisibility(mapUsed, isShowed){
	var tempPanel = $("#TimeSeriesView" + mapUsed);
	if(tempPanel == undefined)
		return;
	tempPanel = tempPanel[0];
	if(tempPanel == undefined)
		return;
	var button = $("#printButton",tempPanel);
	if(button == undefined) return;
	button = button[0];
	if(isShowed){
		$(button).show();
	}else{
		$(button).hide();
	}
}


function insertMarkersForStations(stationsDatabaseUsed,mapUsed,zoom_level){
	var value;
	var index;
	console.log("DATA");
	console.log(stationsDatabaseUsed);
	//reset all stations data
	var stationsMarkers = [];
	stationsMarkers[mapUsed] = [];

	// 0: Deformation  1: Gas  2: Hydrologic  3: Seismic  4: Thermal  5: Meteo  6: Field
	stationsMarkers[mapUsed][0] = [];
	stationsMarkers[mapUsed][1] = [];
	stationsMarkers[mapUsed][2] = [];
	stationsMarkers[mapUsed][3] = [];
	stationsMarkers[mapUsed][4] = [];
	stationsMarkers[mapUsed][5] = [];
	stationsMarkers[mapUsed][6] = [];

	var vlat = parseFloat(volcanoInfo[mapUsed].lat);
	var vlon = parseFloat(volcanoInfo[mapUsed].lon);

	// same settings as the drawMap function
	var min_lat = vlat - 180/(Math.pow(2,zoom_level));
	var max_lat = vlat + 180/(Math.pow(2,zoom_level));
	var min_lon = vlon - 180/(Math.pow(2,zoom_level));
	var max_lon = vlon + 180/(Math.pow(2,zoom_level));

	// remove all previously added stations tooltips
	for (var i = tooltips[mapUsed].length; i--;) {
		if (tooltips[mapUsed][i][3] == "stations") {
			tooltips[mapUsed].splice(i, 1);
		}
	}

	for(var i in stationsDatabaseUsed){
		// each index is data for 1 type
		index = stationsDatabaseUsed[i];

		// no data for this type
		if (index == "") continue;

		var data = index.split(";");


		for (var j in data){
			if (data[j] == "") continue;
			value = data[j].split("&");
			var stationType = value[0];
			var code = value[2];
			var lat = value[3];
			var lon = value[4];

			var tooltipText = "Station Type: " + stationType + "\n";
			tooltipText += "Station Code: " + code + "\n";
			tooltipText += "Lattitude: " + lat + "\n";
			tooltipText += "Longitude: " + lon;

			// the station is not in current map
			if (lat > max_lat || lat < min_lat || lon < min_lon || lon > max_lon) continue;

			var type = index.substr(0,1);
			type = type.toLowerCase();
			var icon = ('/img/pin_' + type + 's_s.png');    

			switch(type){
				case 'd':
					stationsMarkers[mapUsed][0].push([lat,lon,icon]);
					break;
				case 'g':
					stationsMarkers[mapUsed][1].push([lat,lon,icon]);
					break;								
				case 'h':
					stationsMarkers[mapUsed][2].push([lat,lon,icon]);				
					break;
				case 's':
					stationsMarkers[mapUsed][3].push([lat,lon,icon]);
					break;							
				case 't':
					stationsMarkers[mapUsed][4].push([lat,lon,icon]);	
					break;
				case 'm':
					stationsMarkers[mapUsed][5].push([lat,lon,icon]);	
					break;
				case 'f':
					stationsMarkers[mapUsed][6].push([lat,lon,icon]);
					break;	
			}
			var added = false;
			for (var i in tooltips[mapUsed]){
				if (tooltips[mapUsed][i][2] == tooltipText) {
					added = true;
					break;
				}
			}
			if (!added){
				tooltips[mapUsed].push([lat, lon, tooltipText, "stations"]);
			}
		}
	}
	// console.log("in stations");
	// console.log(tooltips);

	// re set up canvas tooltips
	setUpTooltips(mapUsed);
	var markersDeformationLayer;
	var markersGasLayer;
	var markersHydrologicLayer;
	var markersSeismicLayer;
	var markersThermalLayer;
	var markerMeteoLayer;
	var markersFieldLayer;

	var markersDeformationContext;
	var markersGasContext;
	var markersHydrologicContext;
	var markersSeismicContext;
	var markersThermalContext;
	var markerMeteoContext;
	var markersFieldContext;

	var STATION_PIN_WIDTH = 12;
	var STATION_PIN_HEIGHT = 14;
	
	var scale = WIDTH / (max_lon - min_lon);
	// var lat_scale = 
	// var lon_scale = 
	// 0: Deformation  1: Gas  2: Hydrologic  3: Seismic  4: Thermal  5: Meteo  6: Field

	var Deformation = new Image();
	var Gas = new Image();
	var Hydrologic = new Image();
	var Seismic = new Image();
	var Thermal = new Image();
	var Meteo = new Image();
	var Field = new Image();

	Deformation.src = '/img/pin_ds_s.png';    
	Gas.src = '/img/pin_gs_s.png';    
	Hydrologic.src = '/img/pin_hs_s.png';    
	Seismic.src = '/img/pin_ss_s.png';    
	Thermal.src = '/img/pin_ts_s.png';    
	Meteo.src = '/img/pin_ms_s.png';    
	Field.src = '/img/pin_fs_s.png';    

	markersDeformationLayer = document.getElementById("Deformation"+mapUsed);
	markersDeformationContext = markersDeformationLayer.getContext("2d");
	markersGasLayer = document.getElementById("Gas"+mapUsed);
	markersGasContext = markersGasLayer.getContext("2d");
	markersHydrologicLayer = document.getElementById("Hydrologic"+mapUsed);
	markersHydrologicContext = markersHydrologicLayer.getContext("2d");
	markersSeismicLayer = document.getElementById("Seismic"+mapUsed);
	markersSeismicContext = markersSeismicLayer.getContext("2d");
	markersThermalLayer = document.getElementById("Thermal"+mapUsed);
	markersThermalContext = markersThermalLayer.getContext("2d");
	markerMeteoLayer = document.getElementById("Meteo"+mapUsed);
	markerMeteoContext = markerMeteoLayer.getContext("2d");
	markersFieldLayer = document.getElementById("Field"+mapUsed);
	markersFieldContext = markersFieldLayer.getContext("2d");

	Deformation.onload = function(){
		drawMarkersForStations(markersDeformationContext, WIDTH, HEIGHT,
			scale, min_lon, max_lat, stationsMarkers[mapUsed], 0, Deformation,
			STATION_PIN_WIDTH, STATION_PIN_HEIGHT);
	}
	Gas.onload = function(){
		drawMarkersForStations(markersGasContext, WIDTH, HEIGHT,
			scale, min_lon, max_lat, stationsMarkers[mapUsed], 1, Gas,
			STATION_PIN_WIDTH, STATION_PIN_HEIGHT);
	}
	Hydrologic.onload = function(){
		drawMarkersForStations(markersHydrologicContext, WIDTH, HEIGHT,
			scale, min_lon, max_lat, stationsMarkers[mapUsed], 2, Hydrologic,
			STATION_PIN_WIDTH, STATION_PIN_HEIGHT);
	}
	Seismic.onload = function(){
		drawMarkersForStations(markersSeismicContext, WIDTH, HEIGHT,
			scale, min_lon, max_lat, stationsMarkers[mapUsed], 3, Seismic,
			STATION_PIN_WIDTH, STATION_PIN_HEIGHT);
	}
	Thermal.onload = function(){
		drawMarkersForStations(markersThermalContext, WIDTH, HEIGHT,
			scale, min_lon, max_lat, stationsMarkers[mapUsed], 4, Thermal,
			STATION_PIN_WIDTH, STATION_PIN_HEIGHT);
	}
	Meteo.onload = function(){
		drawMarkersForStations(markerMeteoContext, WIDTH, HEIGHT,
			scale, min_lon, max_lat, stationsMarkers[mapUsed], 5, Meteo,
			STATION_PIN_WIDTH, STATION_PIN_HEIGHT);
	}
	Field.onload = function(){
		drawMarkersForStations(markersFieldContext, WIDTH, HEIGHT,
			scale, min_lon, max_lat, stationsMarkers[mapUsed], 6, Field,
			STATION_PIN_WIDTH, STATION_PIN_HEIGHT);
	}
}

function drawMarkersForStations(context, width, height, scale, min_lon, max_lat, data, type, image, pin_width, pin_height){
	context.clearRect(0, 0, width, height);
	for (var index in data[type]){
		var marker = data[type][index];
		// calculate position of icon on map
		var lat = marker[0];
		var lon = marker[1];
		var icon = marker[2];

		var x = scale * (lon - min_lon);
		var y = scale * (max_lat - lat); // (0,0) at top left corner

		// (x, y) will be the bottom middle of the image
		// calculate the top left position of the image
		var x_image = x - pin_width/2;
		var y_image = y - pin_height;
		context.drawImage(image, x_image, y_image, pin_width, pin_height);
	}
}

function toRad(number){
	// from degree to radian, mathematic function
	return number * Math.PI /180;
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



function randomSelectVolcano(selectedId){
	var list = document.getElementById(selectedId);
	var length = list.options.length;
	var i = Math.floor(Math.random()*length);
	list.options[i].selected = 'selected';
	$("#"+selectedId).change();
}


function updateAllStationsList(args,tableId,mapId,stationsDatabaseUsed,mapUsed,zoom_level){
	stationTypeList.length = 0;
	stationTypeList = args.list.split(";");
	var stationsTable = $("#"+tableId);
	if (stationTypeList[stationTypeList.length-1] =="")
		stationTypeList.length--;
	//count number of stations of each type
	var typeList={};
	var dataList={};
	for (var i in stationTypeList){
		stationTypeList[i] = Wovodat.trim(stationTypeList[i]);
		if(stationTypeList[i] == "") continue;
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

	// insert the list of stations to the page
	for (var i in typeList){
		got_station = true;
		var checkBoxId = tableId + i +"Checkbox";
		html += "<tr><td><input type='checkbox' value='" + i + "' id='" + checkBoxId + "'/></td><td>" + formatReturnStations(i) +  ":" + typeList[i]+ "</td></tr>";
	}
	stationsTable.html(html);
	if(stationTypeList.length == 0 || !got_station){
		html="<tr><td></td><td>No data</td></tr>";
		stationsTable.html(html);
	}

	var id;
	if(tableId.indexOf('Alt') != -1) id = 2;
	else id = 1;
	console.log(tableId);
	for(var i in typeList){
		// everytime the checkbox clicked should update the data 
		document.getElementById(tableId + i +"Checkbox").onclick = function(){
			if(this.checked){
				updateTimeSeriesandStations({
					type:   this.value,
					action: 'update',
					data: dataList[this.value]
				}, stationsDatabaseUsed, mapUsed, zoom_level);
				$('#HideStationButton' + id).show();
			}else{
				updateTimeSeriesandStations({
					action:'delete',
					type:this.value
				}, stationsDatabaseUsed,mapUsed, zoom_level);
				var j = checkStationChecked(id);
				if(!j) $('#HideStationButton' + id).hide();
			}
		}
	}
}



//make offline
function checkStationChecked(tableId){
	var stationListName;
	// get the 'id of table contains the list of station type'
	if(tableId == 1){
		stationListName = '';
	}else{
		stationListName = 'Comp';
	}
	stationListName += 'StationList';
	var stationList = document.getElementById(stationListName).getElementsByTagName('tbody')[0].childNodes;
	for(var i= 0; i <  stationList.length ;i++){
		var input = stationList[i].getElementsByTagName('input')[0];
		if(input.checked) return true;
	}
	return false;
}



function formatReturnStations(name){
	name = name + " stations";
	name = name.substr(0,1).toUpperCase() + name.substr(1);
	return name;
}


//make offline
function drawLatLonOnMaps(pos,mapId,value){
	separate = pos.split(",");
	if (separate[separate.length-1]=="") separate.length--;
	for (var i in separate){
		info = separate[i].split("X");
		lat = info[0];
		lon = info[1];
		
		// lat and long of Singapore as default location
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

function drawMap(args, volcId, mapId, mapUsed, zoom_level){

	var volcano = $("#"+volcId).val();
	volcano = volcano.split("&");
	if(args == undefined){
		args = 0;
	}
	var lat = parseFloat(args.lat);
	var lon = parseFloat(args.lon);
	var elev = args.elev;
	var cavw = volcano[1];
	var volName=volcano[0];  //Nang added 
	//Nang added volName

	var coastline = document.getElementById('coastlineCheckbox'+mapUsed).checked;

	delete(tooltips[mapUsed]);
	tooltips[mapUsed] = []

	volcanoInfo[mapUsed] = {lat:args.lat,lon:args.lon,elev:args.elev,cavw:cavw,volName:volName};                
	
	tooltipsText = volName + "\n";
	tooltipsText += cavw + "\n";
	tooltipsText += lat + " , " + lon + " , " + elev;

	tooltips[mapUsed].push([lat, lon, tooltipsText, "main volcano"]);
	//    volcanoInfo[mapUsed] = {lat:args.lat,lon:args.lon,elev:args.elev,cavw:cavw};
	// location of singapore
	if(!lat || !lon){
		lat = 1.29;
		lon = 103.85;
	}
	// get the map from geoserver
	var baseLayer;
	var baseContext;

	var selectedVolcanoLayer;
	var selectedVolcanoContext;


	var SELECTED_PIN_SIZE = 40;

	var baseMap = new Image();
	var pin = new Image();

	// get map based on lat lon of the volcano
	min_lat = lat - 180/(Math.pow(2,zoom_level));
	max_lat = lat + 180/(Math.pow(2,zoom_level));
	min_lon = lon - 180/(Math.pow(2,zoom_level));
	max_lon = lon + 180/(Math.pow(2,zoom_level));

	// currently we have 2 maps, first one is the world map with low resolution served from 
	// layer Wovodat:GEBCO_08 and Wovodat:GEBCO_08_hs
	// second one is the map for indonesia with very high resolution served from
	// layer Wovodat:indo and Wovodat:indo_hs

	// the second map will have latitude from -12 to 0 and longitude from 139 to 158
	// we do the checking to choose which map to use
	var link;
	if (min_lat >= -12.0 && max_lat <= 0.0 && min_lon >= 139.0 && max_lon <= 158.0 ){
		link ="http://localhost:8080/geoserver/Wovodat/wms?service=WMS&version=1.1.0&request=GetMap&layers=Wovodat:png,Wovodat:png_hs"
		console.log("using papua new guinea");
	} else {
		link ="http://localhost:8080/geoserver/Wovodat/wms?service=WMS&version=1.1.0&request=GetMap&layers=Wovodat:GEBCO_08,Wovodat:GEBCO_08_hs"				
		console.log("using world");
	}

	if (coastline){
		link += ",Wovodat:GSHHS_f_L1";
	}

	link += "&styles=&bbox="+min_lon+","+min_lat+","+max_lon+","+max_lat+"&width=950&height=950&srs=EPSG:404000&format=image/png";

	baseMap.src = link;
	pin.src = "/img/pin_volcano_selected-org.png";

	console.log(baseMap.src);
	baseLayer = document.getElementById("baseMap"+mapUsed);
	baseContext = baseLayer.getContext("2d");
	selectedVolcanoLayer = document.getElementById("selected"+mapUsed);
	selectedVolcanoContext = selectedVolcanoLayer.getContext("2d");

	baseMap.onload = function() {
		baseContext.clearRect(0, 0, WIDTH, HEIGHT);
		baseContext.drawImage(baseMap, 0, 0);
	}

	pin.onload = function(){
		selectedVolcanoContext.clearRect(0, 0, WIDTH, HEIGHT);
		selectedVolcanoContext.drawImage(pin, (WIDTH-SELECTED_PIN_SIZE)/2, (HEIGHT/2)-SELECTED_PIN_SIZE, SELECTED_PIN_SIZE, SELECTED_PIN_SIZE);
	}
}


//changed by Nam
//insert parameter: selectId - id of the "select" option where the list of Volcano is inserted into
function insertVolcanoList(obj, selectId) {

	var ids = selectId;
	for (var j = 0; j < ids.length; j++) {
		selectId = ids[j];
		// a list of volcanos and their cavw separated by: ;
		var list = obj;
		// get the volcano select list tag
		var volcanos = document.getElementById(selectId);
		//console.log(volcanos);
		// reset the volcano list
		volcanos.options = [];
		// assign new list
		var i = 0;
		// insert the list of volcano
		volcanos.options[0] = new Option("Select...", "");
		var vd_name = "";
		var vd_cavw = "";
		var vd_cavw_new = "";
		for (; i < list.length; i++) {
			vd_name = list[i]['1'];
			vd_cavw = list[i]['2'];
			vd_cavw_new = list[i]['3'];
			if (vd_name.indexOf('Unnamed') != -1)
				continue;
			volcanos.options[volcanos.options.length] = new Option(vd_name + '_' + vd_cavw,vd_name + '&' + vd_cavw + '&' + vd_cavw_new);
		}

		if (document.getElementById("vnum").value == " " || selectId != "VolcanoList"){
			// randomly select one volcano
			randomSelectVolcano(selectId);
		} else {
			var selectedVd = document.getElementById("vname").value;
			selectedVd = selectedVd +"&"+ document.getElementById("vcavw").value;
			selectedVd = selectedVd +"&"+ document.getElementById("vnum").value;
			$("#"+selectId+" option[value='"+selectedVd+"']").prop('selected', true).trigger("change");
		}
	}
}
/*
 * Volcano information module
 */  

function insertDataOwnerandStatus(o){
	var mapUsed = o.mapUsed;
	function getDataOwnerPanel(mapUsed){
		var holder = document.getElementById('VolcanoPanel' + mapUsed);
		var panel = $("#dataOwnerPanel",holder);
		panel = panel[0];
		return panel;
	}
	function createDataOwnerLink(url){
		url = url + "";
		if(url == undefined || url.length == 0)
			return;
		var a = document.createElement('a');
		a.className = 'dataOwner';
		a.innerHTML = format(url);
		a.href = fixUrl(url);
		return a;
	}
	function fixUrl(url){
		if(url.substring(0,7) != "http://")
			url = "http://" + url;
		return url;
	}
	function format(url){
		if(url == undefined || url == "null")
			return "&nbsp;";
		var text = url;
		var i = text.indexOf('//');
		if(i == -1)
			i = 0;
		else 
			i = i + 2;
		var i1 = text.indexOf('www',i);
		if(i1 != -1) i = i + 3;
		var j = text.indexOf('/',i);
		if(j == -1) j = text.length;
		if(text[i] == '.')
			return text.substring(i+1,j);
		else return text.substring(i,j);
	}
	function insertDataOwners(o){
		var panel = getDataOwnerPanel(mapUsed);
		$(panel).empty();
		var a = createDataOwnerLink(o['owner1']);


		if(a == undefined)
			return;
		panel.appendChild(a);

		ownerURL[o.mapUsed] = [];
		ownerURL[o.mapUsed]["href"]=$(a).attr("href");
		ownerURL[o.mapUsed]["text"]=$(a).text();

		var a = createDataOwnerLink(o['owner2']);
		if(a == undefined)
			return;
		$(panel).html($(panel).html() + " - ");
		panel.appendChild(a);
	}
	function insertStatus(o){
		$("#volcstatus" + mapUsed).html(o['status']);
	}

	insertDataOwners(o);
	insertStatus(o);


}


function updateTimeSeriesandStations(args,stationsDatabaseUsed,mapUsed,zoom_level){
	var action = args.action;
	switch(action){
		case 'delete':
			var type = args.type;
			stationsDatabaseUsed[type]="";
			break;
		case 'update':
			var type =args.type;
			var data = args.data;
			stationsDatabaseUsed[type] = data;
			break;
		default:
			break;
	}
	// console.log(stationsDatabaseUsed);
	insertMarkersForStations(stationsDatabaseUsed,mapUsed,zoom_level);

	function getVnum(){

	}
}

function setUpTooltips(mapUsed){
	var baseCanvas = document.getElementById("baseTooltips"+mapUsed);
	var baseContext = baseCanvas.getContext("2d");

	var popUpCanvas = document.getElementById("tooltips"+mapUsed);
	var popUpContext = popUpCanvas.getContext("2d");
	// clear canvas 


	// bind again
	$("#baseTooltips"+mapUsed).mousemove(function (e) {
	    handleMouseMove(e);
	});

	var vlat = parseFloat(volcanoInfo[mapUsed].lat);
	var vlon = parseFloat(volcanoInfo[mapUsed].lon);

	var zoom_level = parseInt(document.getElementById("ZoomLevel"+mapUsed).innerHTML);
	// same settings as the drawMap function
	var min_lat = vlat - 180/(Math.pow(2,zoom_level));
	var max_lat = vlat + 180/(Math.pow(2,zoom_level));
	var min_lon = vlon - 180/(Math.pow(2,zoom_level));
	var max_lon = vlon + 180/(Math.pow(2,zoom_level));


	// scaling factor 
	// will need 2 scales if decide to change the viewport to different dimension 
	// and min max settings for lat lon 
	var scale = WIDTH / (max_lon - min_lon);

	function getMousePos(canvas, evt) {
		var rect = canvas.getBoundingClientRect();
		return {
			x: Math.round((evt.clientX-rect.left)/(rect.right-rect.left)*canvas.width),
			y: Math.round((evt.clientY-rect.top)/(rect.bottom-rect.top)*canvas.height)
		};
	}
	// show tooltip when mouse hovers over dot
	function handleMouseMove(e) {
		var mousePos = getMousePos(baseCanvas, e);
	    mouseX = mousePos.x;
	    mouseY = mousePos.y
	    // Put your mousemove stuff here
	    var hit = false;
	    for (var i = 0; i < tooltips[mapUsed].length; i++) {
	        var item = tooltips[mapUsed][i];
	        var lat = parseFloat(item[0]);
	        var lon = parseFloat(item[1]);
	        var text = item[2];
	        var size_x, size_y;

	        if (item[3] == "main volcano") {
	        	size_x = 40;
	        	size_y = 40;
	        } else if (item[3] == "neighbors"){
	        	size_x = 8;
	        	size_y = 13;
	        } else if (item[3] == "stations") {
	        	size_x = 12;
	        	size_y = 14;
	        } else {
	        	size_x = 0;
	        	size_y = 0;
	        }

			var x = scale * (lon - min_lon);
			var y = scale * (max_lat - lat); // (0,0) at top left corner

	        var dx = Math.abs(mouseX - x);
	        var dy = y - mouseY;

	        if (dx < (size_x/2) && dy < size_y/2 && dy >= 0) {

	        	// console.log(text);
  				popUpContext.font="20px Georgia";

	        	popUpCanvas.style.visibility = "";
	        	if (x > 600){
	        		popUpCanvas.style.left = (x - 40 - 350) + "px"; // 350 is the width of popup canvas
	        	} else {
	        		popUpCanvas.style.left = (x + 40) + "px";
	        	}
	            
	            if (y > 830) {
	            	popUpCanvas.style.top = (y - 40 - 120) + "px"; // 120 is the height of popup canvas
	            } else {
	            	popUpCanvas.style.top = (y + 40) + "px";
	            }
	            split_text = text.split("\n");
	            var y_pos = 25;
	            popUpContext.clearRect(0, 0, popUpCanvas.width, popUpCanvas.height);

	            for (var i in split_text){
	            	line_text = split_text[i];
	            	popUpContext.fillText(line_text, 25, y_pos);
	            	y_pos += 25;
	            }
	            hit = true;
	            //get the first match only, avoid overloading the cpu
	            //very important if comment out the break chrome will hang
	            break;
	        }
	    }
	    if (!hit) {
	        popUpCanvas.style.visibility = "hidden";
	    }
	}

}