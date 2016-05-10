/**
Store all function for handle action of Earth Quake event
Store all function to handle the data controller of earthquake
Created by Luis Ngo - 21/2/2016
*/
/*
 * Equake module
 * Handle the event related to the equake panels
 * Provide the function to work with various equake data
 */

/*
 * 
 * Object to store the list of earthquake values that user has requested
 * from the server. These values are organized according to the volcano 
 * that they are close to. That means some data will be duplicated 
 * at the client side this is the problem that the script in the future 
 * needs to address. This data will be used in the future when we 
 * need to filter the equake and redraw the data using Flot. This
 * object is also used to store the information about the GMT output
 * value.
 * First level of this object is the CAVW of the volcano
 * {cavw1,cavw2,cavw3,...}
 * To retrieve: earthquakes[cavw]
 * 
 * The earthquakes[cavw] object contains the following attributes:
 * - vlat: the latitude of the volcano
 * - vlon: the longitude of the volcano
 * - many objects that represent specific earthquakes that happened
 * 
 * Each earthquake event object has the followoing attributes:
 * - marker: show the position of the event in Google Map
 * - infoWindow: showed when mouse hovers over the positon of the marker
 * - eqtype: the type of the earthquake, please refer to the documentation of 
 * WOVOdat to see different type of earthquakes
 * - lat: latitude of the event
 * - lon: longitude of the event
 * - available: to mark if we should display this event on the graph and the map
 * - mag: magnitude of the event
 * - depth: the depth of the event
 * - latDistance: the distance from the event to the volcano projected in the latitude axis
 * - lonDistance: the distance from the event to the volcano projected in the longitude axis
 * - time: the happended time of the event in the standard format
 * - timestamp: the number of milliseconds starting from 1/1/1970 that 
 * this earthquake happens
 */
var earthquakes = {};
// store reference to the plotted graphs in the equake section
// this variable will help us when we need to do the printing
var equakeGraphs = [];
// left graphs
equakeGraphs[1] = {};
// right graphs
equakeGraphs[2] = {};
 


 
 /*
 * This function is used for the filtering of the equake events based on the
 * list of parameter in the filter.
 * All of the event that are filtered will be marked unavailable by
 * setting the available variable to false.
 */
 // parse the data in the start-date and end-date box
function parseDateVal(date){
	date = date.split("/");
	if(date.length != 3)
		return "";
	for(var i = 0 ; i < date.length; i++){
		date[i] = parseInt(date[i]);
	}
	var result = new Date();
	result.setUTCFullYear(date[2], date[0]-1, date[1]);
	result.setUTCHours(0, 0, 0, 0);
	return result.getTime();
}
/*
Create Marker Icon
*/
function createMarkerIcon(depth,size){
    
	// set the shape of the marker
	var color = '../img/blankCircles/pin_';
	if (depth <= 2.5) 
		color += 're'; // Red
	else if (depth >2.5 && depth <= 5) 
		color += 'org'; // Orange
	else if (depth >5 && depth <= 10) 
		color += 'ye'; // Yellow
	else if (depth >10 && depth <= 15) 
		color += 'ge'; // Dark Green
	else if (depth >15 && depth <= 25) 
		color += 'lbe'; // Light BLUE
	else if (depth >25 && depth <= 40) 
		color += 'be'; // BLUE
	else 
		color += 'dbe'; // Dark Blue
	color += '.png';

	// set size of the marker
	var icon = new google.maps.MarkerImage(color,null,null,null,new google.maps.Size(size,size));

	return icon;
}
 




 /*
 * Time series module
 * 
 */
$(function(){
	totalGraph[0]=0;
	totalGraph[1]=0;
	totalGraph[2]=0;
	graphCount[0]=[];
	graphCount[1]=[];
	graphCount[2]=[];
	 // Append EqType to EqType selection list
	// (function(){
	//     Wovodat.getEquakeTypeList(doAdd);
	//     function doAdd(list) {
	//         for(var i=0;i<list.length;i++) {
	//             var s="<option value='"+list[i]['st_eqt_org']+"'>"+list[i]['st_eqt_name']+"</option>";
				
	//             equakeType[list[i]['st_eqt_org']] = list[i]['st_eqt_name'];
	//             $("#EqType1").append(s);
	//             $("#EqType2").append(s);
	//         }
	//     };
	// })();
	/*
	*
	* show/hide the time series panel
	*/
	(function(list){
		var l = list.length;
		var i;
		for(i = 0 ; i < l ; i++){
			var j = list[i];
			$("#TimeSeriesHeader" + j).click([j],function(e){
				var mapUsed = e.data[0];
				$("#TimeSeriesView" + mapUsed).show();
				$(".TimeSeriesGraphPanel" + mapUsed).show();
			});
			$("#HideTimeSeriesPanel" + j).click([j],function(e){
				var mapUsed = e.data[0];
				$("#TimeSeriesView" + mapUsed).hide();
				$(".TimeSeriesGraphPanel" + mapUsed).hide();
				return false;
			});
		}
	})([1,2]);
});


/*
 * Author : Pham Vu Tuan
 * Function to compute the number of earthquake events of a volcano
 */
function computeEquakeEvents(cavw,mapUsed, radius=30){
	var count = 0;
	var vlat = earthquakes[cavw]['vlat'];
	var vlon = earthquakes[cavw]['vlon'];

	for(var i in earthquakes[cavw]){
		var lat = earthquakes[cavw][i]['lat'];
		var lon = earthquakes[cavw][i]['lon'];
		// skip this value when there is no latitude or longitude value 
		// for them

		if(typeof lat == 'undefined' || typeof lon == 'undefined'){
			continue;
		}

		// skip this event when it is not supposed to be displayed
		if(earthquakes[cavw][i]['available'] == 'undefined'){
			continue;
		}
		
		if(!filter(cavw,mapUsed,i)){
			continue;
		}

		// only count earthquakes within the radius given
		if(Wovodat.calculateD(lat, lon, vlat, vlon, 2) > radius){
			continue;
		}
		count++;
	}
	return count;
}


/*
 * Function to format the X-axis for Latitude and Longtitude axises
 * This function will set axis.tickDecimals number after the '.' and
 * append the ' km' part to each tick label.
 */
function kmFormatter(v, axis){
	return v.toFixed(axis.tickDecimals) + " km";
}


 

// toggle function for checkboxes - added by vutuan
function toggle(source, name){
	var checkboxes = document.getElementsByName(name);
	for(var i=0, n=checkboxes.length;i<n;i++) {
		checkboxes[i].checked = source.checked;
	} 
}
function untoggle(source,id,mapUsed){
	if(id === 1){
		var checkboxCC = document.getElementById('cc_id'+mapUsed+'CheckBox0');
		if(!source.checked) checkboxCC.checked = false;
	}else{
		var checkboxEq = document.getElementById('EqType'+mapUsed+'CheckBox0');
		if(!source.checked) checkboxEq.checked = false;
	}         
}


/*
	 * handle the maximum depth for earthquakes event
	 * if there are earthquakes within the range of [0,-20] km then the limit
	 * for the earthquake graph is 20 because it is the default value in 2DGMT
	 * if not, draw all the available earthquakes
*/
function minYAxis(data){
	if(data == undefined)
		return null;
	var length = data.length;
	if(length == 0)
		return null;
	var i = 0;
	var min = data[0][1];
	for(i = 0 ; i < length; i++){
		if(data[i][1] > min)
			min = data[i][1];
	}
	// 20 is the default value in 2D GMT, therefore it set it here as
	// well
	if(min > -20)
		return -20;
	else
		return null;
}


/** Get earthquakes from server */
/*function getEarthquakes(quantity, cavw, lat, lon, startDate, endDate, startDepth, endDepth, elev, width){

	//var baseUrl = "http://localhost/precursor/api/v1/earthquakes";
	/*var baseUrl = "http://localhost/precursor/index.php";
	var query = "?num=" + quantity + "&startDate=" + startDate + "&endDate=" + endDate + "&startDepth=" + startDepth + "&endDepth=" + endDepth + "&width=" + width + "&type=null";
	var request = new XMLHttpRequest();
	console.log(baseUrl+query);
	request.open("GET", baseUrl + query,false);
	//request.open("GET", baseUrl,false);
	request.send();
	console.log(request.responseText);
	if(request.status === 200){
		return JSON.parse(request.responseText);
	}
	else{
		return request.statusText;
	}*/

	/*$.ajax({
		method: "get",
		url: "/php/switch.php",
		data: "get=Earthquakes&qty="+numberOfEvents
		+"&cavw="+volInfo.cavw+"&lat="+volInfo.lat
		+"&lon="+volInfo.lon+"&elev="+volInfo.elev,
		success:function(html){
		if(html.indexOf('Can\'t') >= 0) 
			return;
		if(handlers[0])
			handlers[0](html,volInfo.cavw,mapUsed);
		if(handlers[1])
			handlers[1](volInfo.cavw,"",mapUsed);
		$("#EquakePanel"+mapUsed).show();
	}
	});

}

/* Create HTTP request */
// function getHTTPObject() {
//     if (typeof XMLHttpRequest !== 'undefined') {
//         return new XMLHttpRequest();
//     } try {
//         return new ActiveXObject("Msxml2.XMLHTTP");
//     } catch (e) {
//         try {
//             return new ActiveXObject("Microsoft.XMLHTTP");
//         } catch (e) {}
//     }
//     return false;
// }



function getSizeOfEquake(mag){
	// choose icon size base on magnitude of the equake event
	var size = Math.round(4+((mag)*2)/4);

	if (size<4) 
		size = 4;
	if (size>14) 
		size = 14;
	return size;
}

/*
	Author: Pham Vu Tuan
	This function will filter the data to insert markers on the google map.
*/
function filter(cavw,mapUsed,i){
	// Data from the filter.
	var sDate = parseDateVal($('#SDate' + mapUsed).val());
	var eDate = parseDateVal($('#EDate' + mapUsed).val());
	var dLow = parseFloat($('#DepthLow' + mapUsed).val());
	var dHigh = parseFloat($('#DepthHigh' + mapUsed).val());
	var mLow = parseFloat($('#MagnitudeLow' + mapUsed).val());
	var mHigh = parseFloat($('#MagnitudeHigh' + mapUsed).val());
	var type = document.getElementById('EqType'+mapUsed+'CheckBox0');
	var cc_id = document.getElementById('cc_id'+mapUsed+'CheckBox0');
	// Data retrieved from each earthquake event.
	var eqType = earthquakes[cavw][i]['eqtype'];
	var id = earthquakes[cavw][i]['cc_id'];
	var time = Date.parse(earthquakes[cavw][i]['time']);
	var mag = parseFloat(earthquakes[cavw][i]['mag']);
	var depth = parseFloat(earthquakes[cavw][i]['depth']);
	// Filtering process.
	if(!cc_id.checked){
		var checkboxes = document.getElementsByName('cc_id'+mapUsed);
		for(var i = 0;i<checkboxes.length;i++){
			if(!checkboxes[i].checked&&checkboxes[i].value == id){
				return false;
			}
		}
	}

	if(!type.checked){
		var checkboxes = document.getElementsByName('EqType'+mapUsed);
		for(var i = 0;i<checkboxes.length;i++){
			if(!checkboxes[i].checked&&checkboxes[i].value == eqType){
				return false;
			}
		}
	}

	if(time < sDate || time > eDate){
		// console.log(3);
		return false;
	}

	if(depth < dLow || depth > dHigh){
		// console.log(4);
		return false;
	}

	if(mag < mLow || mag > mHigh){
		// console.log(mag);
		return false;
	}
	return true;
}
/**
	Author: Pham Vu Tuan
	This function will display all the cc_id and
	Eqtype mapping with the earthquakes in filter options
*/
function nameConverter(value, element){
	switch(element){
	case 'cc_id': return ccMap.get(value);

	case 'EqType':
		if(value == "") return 'X'; 
		return eqMap.get(value);
	}
}

/**
 * set filter to avaiable data that we have, especially the start time and
 *end time of all earthquake event
 */
function initializeFilter(data,mapUsed){
	var i, item, startTime, endTime, timestamp;
	for(i in data){
		item = data[i];
		timestamp = item['timestamp'];
		if(startTime == undefined) startTime = timestamp;
		else{
			if(startTime > timestamp) startTime = timestamp;
		}
		if(endTime == undefined) endTime = timestamp;
		else{
			if(endTime < timestamp) endTime = timestamp;
		}
	}
	if(startTime == undefined || endTime == undefined)
		return;
	// no need to reset
	if($("#SDate" + mapUsed ).datepicker( "option", "yearRange" ) == (startTime.getUTCFullYear() + ":" + endTime.getUTCFullYear()))
		return;
	var maxValue = Math.floor(endTime.getTime()-startTime.getTime())/86400000;


	var startTimeString = startTime.getUTCMonth() + 1 + "/" + startTime.getUTCDate() + "/" + startTime.getUTCFullYear();
	$("#SDate" + mapUsed).val(startTimeString);
	var endTimeString = endTime.getUTCMonth() + 1 + "/" + endTime.getUTCDate() + "/" + endTime.getUTCFullYear();
	$("#EDate" + mapUsed).val(endTimeString);

	$("#SDate" + mapUsed).datepicker("option", "yearRange", startTime.getUTCFullYear() + ":" + endTime.getUTCFullYear());
	$("#EDate" + mapUsed).datepicker("option", "yearRange", startTime.getUTCFullYear() + ":" + endTime.getUTCFullYear());

	$("#DateRange" + mapUsed).slider({
		range: true,
		max: maxValue,
		values : [0, maxValue],
		slide: function(event,ui){
			var date = new Date(startTime.getTime());
			date.setDate(date.getDate() + ui.values[0]);
			$("#SDate" + mapUsed).val($.datepicker.formatDate('mm/dd/yy',date));
			date = new Date(startTime.getTime());
			date.setDate(date.getDate() + ui.values[1]);
			$("#EDate" + mapUsed).val($.datepicker.formatDate('mm/dd/yy',date));
		}
	});
}

/**
 * Filter Data
 */
function filterData(cavw,panelUsed){
	// data is not available for filtering
	// console.log(earthquakes[cavw]);
	if(!earthquakes[cavw])
		return;

	// Just modified here
	var nEvent = $("#Evn"+panelUsed).val();
	var sDate = parseDateVal($("#SDate"+panelUsed).val());

	if(sDate == undefined || sDate == "")
		sDate = 0;
	var eDate = parseDateVal($("#EDate"+panelUsed).val());

	// set the end time to be at the end of the end date, not the start of the
	// end date
	if(eDate == undefined || eDate == "")
		eDate = new Date().getTime();
	eDate += Wovodat.ONE_DAY - 1000;// in milliseconds

	// Just modified here
	// Debug
	var dhigh = parseFloat($("#DepthHigh"+panelUsed).val());
	var dlow = parseFloat($("#DepthLow"+panelUsed).val());
	var wkm = parseFloat(document.getElementById("wkm"+panelUsed).value);
	var mhigh = parseFloat($("#MagnitudeHigh"+panelUsed).val());
	var mlow = parseFloat($("#MagnitudeLow"+panelUsed).val());
	// type = type.options[type.selectedIndex].value;
	var count = 0;
	var vlat = earthquakes[cavw]['vlat'], vlon = earthquakes[cavw]['vlon'];
	// some error here, what if i is 'vlat' or 'vlon'
	for (var i in earthquakes[cavw]){

		// console.log(i);
		if(i == 'vlat' || i == 'vlon')
			continue;
		// if we already have enough earthquakes event, the rest of event is
		// ignored even though they satisfy the filter
		if (count > nEvent){
			earthquakes[cavw][i]['available'] = false;
			continue;
		}
		if (earthquakes[cavw][i]['time'] != "" && typeof earthquakes[cavw][i]['time'] != "undefined"){
			var eDepth = parseFloat(earthquakes[cavw][i]['depth']);

			var eTime = Wovodat.convertDate(earthquakes[cavw][i]['time']);

			var elat = earthquakes[cavw][i]['lat'], elon = earthquakes[cavw][i]['lon'];
			var distanceFromVolcano = Wovodat.calculateD(vlat,vlon,elat,elon,2);
			if(distanceFromVolcano > 50)
				console.log(distanceFromVolcano);
			if(distanceFromVolcano > wkm + 0.1){
				earthquakes[cavw][i]['available'] = false;
				continue;
			}

			eTime = eTime.getTime();

			earthquakes[cavw][i]['available'] = false;
			// equake below the dlow
			if(eDepth < dlow){
				continue;
			}
			// equake above the dhigh
			if(eDepth > dhigh){
				continue;
			}
			// event happened after the end date
			if(eTime > eDate){
				continue;
			}
			// event happned before the start date
			if (eTime < sDate){
				continue;
			}
			count++;
			earthquakes[cavw][i]['available'] = true;

		}
	}
}

