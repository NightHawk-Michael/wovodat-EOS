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

var ccMap = new Map();
var eqMap = new Map();

/**
Switch between single view with comparison View
*/
function switchView(){
	var panel = document.getElementById('volcanoPanel2');
	if($(panel).css('display') == 'block')
		showSingleView();
	else
		showComparisionView();
	
}

/**
Show Single View.
Display 1 map only
*/
function showSingleView(){
	var panel = document.getElementById('volcanoPanel2');
	$(panel).css('display','none');
	$("#volcanoPanel1").css("width","960px");
	var bar = document.getElementById('mapBar1');
	bar.className = "button white extendedButton";
	$(bar).css('width','910px');
	panel = document.getElementById('fixSwitch');
	panel.className = "fixSwitch";
	 $(panel).css('width','470px').css('marginRight','10px');
	$("#Map").css('height','910px');
	google.maps.event.trigger(map[1], "resize");
	$("#switchView").html("Comparision View");
	$("#TimeSeriesView1").show();
	$("#EquakePanel1").show();
	map[1].setCenter(map[1].centerPoint);
	// $("#image").css('width','459px');
}

/**
Show two view per page
*/
function showComparisionView(){
	var panel = document.getElementById('volcanoPanel2');
	$(panel).css('display','block');
	$("#volcanoPanel1").css("width","470px");
	var bar = document.getElementById('mapBar1');
	bar.className = "button white";
	$(bar).css('width','89%');
	panel = document.getElementById('fixSwitch');
	panel.className = "";
	$("#Map").css('height','210px');
	google.maps.event.trigger(map[1], "resize");
	$("#switchView").html("Single View");
	map[1].setCenter(map[1].centerPoint);

}

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
		markers[index].setIcon('/img/pin_' + value + 's_s.png');    
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

function updateAllStationsList(args,tableId,mapId,stationsDatabaseUsed,mapUsed){
	
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
	if(tableId.indexOf('Comp') != -1) id = 2;
	else id = 1;
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
				var j = '';
				if(tableId.indexOf('Comp') == -1) j = 1;
				else j = 2;
				map[j].panTo(new google.maps.LatLng(volcanoInfo[j].lat,volcanoInfo[j].lon));
				if(map[j].getZoom() <= 10)
					map[j].setZoom(10);
				$('#HideStationButton' + id).show();
			}else{
				updateTimeSeriesandStations({action:'delete',type:this.value},stationsDatabaseUsed,mapUsed);
				var j = checkStationChecked(id);
				if(!j) $('#HideStationButton' + id).hide();
			}
		}
	}
}

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

function drawMap(args, volcId, mapId, mapUsed){
	//remove volcano marker
	if (volMarkers[mapUsed])
		volMarkers[mapUsed].setMap(null);
	volMarkers[mapUsed] = null; 
	var volcano = $("#"+volcId).val();
	volcano = volcano.split("&");
	if(args == undefined){
		args = 0;
	}
	var lat = args.lat;
	var lon = args.lon;
	var elev = args.elev;
	var cavw = volcano[1];
	var volName=volcano[0];  //Nang added 
	//Nang added volName                
	volcanoInfo[mapUsed] = {lat:args.lat,lon:args.lon,elev:args.elev,cavw:cavw,volName:volName};                
	
	//    volcanoInfo[mapUsed] = {lat:args.lat,lon:args.lon,elev:args.elev,cavw:cavw};
	// location of singapore
	if(!lat || !lon){
		lat = 1.29;
		lon = 103.85;
	}
	map[mapUsed].setCenter(new google.maps.LatLng(lat,lon));
	map[mapUsed].centerPoint = new google.maps.LatLng(lat,lon);
	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(lat, lon), 
		map: map[mapUsed],
		animation: google.maps.Animation.DROP
	});   
	volMarkers[mapUsed]= marker;
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
	for(;i < list.length;i++){
		list[i] = Wovodat.trim(list[i]);
		if(list[i].length == 0) continue;
		t = list[i].split("&");
		if(t[2] != undefined){
			var temp = t[1];
			t[1] = t[1] + " " + t[2];
			data.push({label:'<div style="text-align:center"><img src="/img/SmallEruptionIcon.png"/><br/><b >' + temp + '</b></div>',position:Wovodat.toDate(t[1]).getTime()});
		}
		eruptions.options[eruptions.options.length] = new Option(temp,t[1]);
	}
	if(selectId == 'CompEruptionList')
		eruptionsData.compEruptions.markdata = data;
	else
		eruptionsData.markdata = data;
}

//changed by Nam
//insert parameter: selectId - id of the "select" option where the list of Volcano is inserted into
function insertVolcanoList(obj, selectId) {
	// console.log(obj);
	var ids = selectId;
	for (var j = 0; j < ids.length; j++) {
		selectId = ids[j];
		// a list of volcanos and their cavw separated by: ;
		var list = obj;
		// get the volcano select list tag
		var volcanos = document.getElementById(selectId);
		console.log(volcanos);
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
			// updateTimeSeriesList(data);
			insertMarkersForStations(data,mapUsed);
			break;
		case 'updateOldData':
			var type = args.type;
			var data = stationsDatabaseUsed[type];
			// update the list of station and the markers on the google map
			// updateTimeSeriesList(data);
			insertMarkersForStations(data,mapUsed);
			break;
		default:
			break;
	}

	function getVnum(){

	}
}

