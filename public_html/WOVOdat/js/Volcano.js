/*
Store all functions for volcano
READY FUNCTION
*/
$(document).ready(function(){
	$("#image").css('width','459px');
	setupSwitchButton();
	/* get the list of all volcano in our database and insert it into 
	* the dropdown list
	*insertVolcanoList is used as a callback function with 2 parameter: the first 
	*parameter is the list of Volcano, and the second parameter is the ID of the dropdown menu
	*to which data is populated
	*/
	Wovodat.getVolcanoList(insertVolcanoList,["VolcanoList","CompVolcanoList"]);
   Wovodat.getEquakeTypeList(setupEquakeType);
	Wovodat.getCatalogOwner(setupCatalogOwner);
	// store the eruption data for later use
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
	// store the eruption data for the second volcano
	eruptionsData.compEruptions = {
		marks: { 
			show: true,
			color: 'rgb(212,59,62)',
			labelVAlign: 'top' ,
			rows: 1
		}, 
		data: [], 
		markdata: []
	};
	
	lat = 1.29;
	lon = 103.85;
	var myOptions = {
		center: new google.maps.LatLng(lat, lon),
		zoom: 7,
		mapTypeControl:false,
		mapTypeId: google.maps.MapTypeId.TERRAIN,
		streetViewControl:false
	};
	map[1] = new google.maps.Map(document.getElementById("Map"),myOptions);     
	map[2] = new google.maps.Map(document.getElementById("Map2"),myOptions);    
	
	$("#gvp1").click(function() {
		var locat= $("#VolcanoList :selected").text();
		var locati=locat.split("_");
		open("http://www.volcano.si.edu/world/volcano.cfm?vnum="+locati[1]);
		return false;
	});
	$("#gvp2").click(function() {
		var locat= $("#CompVolcanoList :selected").text();
		var locati=locat.split("_");
		open("http://www.volcano.si.edu/world/volcano.cfm?vnum="+locati[1]);
		return false;
	});
	
	$("#HideStationButton1").click(function(){
		hideStation(1);
		$(this).hide();
	});
	$("#HideStationButton2").click(function(){
		hideStation(2);
		$(this).hide();
	});          

	Wovodat.showProcessingIcon($("#loading"));
	// when the volcano option is changed
	$("#VolcanoList").change(function(){
		totalGraph[1]=0;
		graphCount[1]=[];

		hideEarthquakeMarkerButton(1);
		uncheckAllEquakeButton(1);
		//setPrintButtonVisibility(1,false);
		var volcano = $("#VolcanoList").val();
		volcano = volcano.split("&");
		var cavw = volcano[1];
		var cavw_new = volcano[2];//vnum

		if(cavw_new == $("#vnum").val() || $("#vnum").val() == " "){
			Wovodat.getLatLon({handler:drawMap,cavw:cavw,mapUsed:1},"VolcanoList", "Map");
			//initialise value for Number of Events textbox
			resetFilter(1);
			$("#FormFilter1").hide();
			$("#FilterSwitch1").html("Show Filter");
			$("#FlotDisplayLat1").html("");
			$("#FlotDisplayLon1").html("");
			//get the list of neightbors
			//and position them in the map
			Wovodat.getNeighbors(cavw,1,insertMarkersForNeighbors);
			// get the eruption list for that specific volcano
			Wovodat.getEruptionList({
				volcano: $("#VolcanoList").val(),
				handler: insertEruptionList,
				selectId:"EruptionList"
			});
			//get data owner of the volcano
			Wovodat.getCcUrl("1",cavw,insertDataOwnerandStatus);
			// get the location of that volcano and position to it in the
			// google map
			// update the list of available station
			// time-series view
			//compare volcano view
			Wovodat.getAllStationsList({
				cavw:cavw,
				handler:updateAllStationsList,
				tableId:"StationList",
				mapId:"Map",
				stationsDatabaseUsed: stationsDatabase,
				mapUsed:1
			});
			// Insert the list of available data in available time series
			// to the list in the comparison view
			Wovodat.getListOfTimeSeriesForVolcano({
				cavw:cavw,
				handler:updateTimeSeriesList,
				tableId:1
			});
			// delete all the drawn graphs and the time series list
			if ($("#CompVolc").css("display")=="none"){
				for(var i in graphs){
					delete(graphs[i]);
					var div = document.getElementById(i + 'Row');
					div.parentNode.removeChild(div);
				}
				document.getElementById('overviewPanel').style.display = 'none';
				
				document.getElementById('TimeSeriesList').innerHTML = '';
			}else{
				for(var i in graphs){
					var j = side(i);
					if(j == 1){
						delete graphs[i];
						var div = document.getElementById(i.substring(0,i.length-1) + 'Row' + j);
						div.parentNode.removeChild(div);
					}
				}
				document.getElementById('overviewPanel1').style.display = 'none';
				document.getElementById('TimeSeriesList1').innerHTML = '';
			}
			// reset the local list of available stations for each data type
			delete(stationsDatabase);
			stationsDatabase = {};
			
			hideEquakePanel({mapUsed:1});
			hideMarkers({mapUsed:1});
			clearEquakedrawingData({mapUsed:1});
			if ($("#vnum").val() == " ") {
				var selectedVd = $("#VolcanoList").val();
				selectedVd = selectedVd.split("&");
				document.getElementById("vname").value = selectedVd[0];
				document.getElementById("vcavw").value = selectedVd[1];
				document.getElementById("vnum").value = selectedVd[2];
				console.log($("#VolcanoList").val());
			}
		}else{
			var selectedVd = $("#VolcanoList").val();
			selectedVd = selectedVd.split("&");
			document.getElementById("vname").value = selectedVd[0];
			document.getElementById("vcavw").value = selectedVd[1];
			document.getElementById("vnum").value = selectedVd[2];
			var currentUrl = window.location.href;
			currentUrl = currentUrl.split("?");
			$("#volcanoForm").attr("action", currentUrl[0] + "?vnum=" + cavw_new);
			$("#volcanoForm").submit();
		}
		removeElement(1,'cc_id');
		removeElement(1,'EqType');
		if(earthquakes[cavw]){
			var catalogOwner = new Set();
			var eqTypeSet = new Set();
			cachingElement(catalogOwner,cavw,1,'cc_id');
			cachingElement(eqTypeSet,cavw,1,'EqType');
		}
	});
	
	$("#HideVolcanoInformation1").click(function(){
		$("#VolcanoPanel1").hide();
		return false;
	});
	
	$("#VolcanoInformation1").click(function(){
		$("#VolcanoPanel1").show();
		return false;
	});
	$("#HideVolcanoInformation2").click(function(){
		$("#VolcanoPanel2").hide();
		return false;
	});
	$("#VolcanoInformation2").click(function(){
		$("#VolcanoPanel2").show();
		return false;
	});
	$("#CompVolcanoList").change(function(){
		totalGraph[2]=0;
		graphCount[2]=[];

		hideEarthquakeMarkerButton(2);
		uncheckAllEquakeButton(2);
		//setPrintButtonVisibility(2,false);
		var volcano = $("#CompVolcanoList").val();
		volcano = volcano.split("&");
		var cavw = volcano[1];
		Wovodat.getLatLon({cavw:cavw,handler:drawMap,mapUsed:2},"CompVolcanoList", "Map2");
		resetFilter(2);
		$("#FormFilter2").hide();
		$("#FilterSwitch2").html("Show Filter");
		$("#FlotDisplayLat2").html("");
		$("#FlotDisplayLon2").html("");
		
		Wovodat.getEruptionList({
			volcano: $("#CompVolcanoList").val(),
			handler: insertEruptionList,
			selectId:"CompEruptionList"
		});
		//get list of neighbors
		Wovodat.getNeighbors(cavw,2,insertMarkersForNeighbors);
		//get data owner of the volcano
		Wovodat.getCcUrl("2",cavw,insertDataOwnerandStatus);
		Wovodat.getAllStationsList({
			cavw: cavw,
			handler: updateAllStationsList,
			tableId:"CompStationList",
			mapId:"Map2",
			stationsDatabaseUsed:compStationsDatabase,
			mapUsed:2
		});
		Wovodat.getListOfTimeSeriesForVolcano({
			cavw:cavw,
			handler:updateTimeSeriesList,
			tableId:2
		});
		for(var i in graphs){
			var j = side(i);
			if(j == 2){
				delete graphs[i];
				var div = document.getElementById(i.substring(0,i.length-1) + 'Row' + j);
				div.parentNode.removeChild(div);
			}
		}
		document.getElementById('overviewPanel2').style.display = 'none';
		document.getElementById('TimeSeriesList2').innerHTML = '';
		// reset the local list of available stations for each data type
		delete(compStationsDatabase);
		compStationsDatabase = {};
	
	
		hideEquakePanel({mapUsed:2});
		hideMarkers({mapUsed:2});
		clearEquakedrawingData({mapUsed:2});

		removeElement(2,'cc_id');
		removeElement(2,'EqType');
		if(earthquakes[cavw]){
			var catalogOwner = new Set();
			var eqTypeSet = new Set();
			cachingElement(catalogOwner,cavw,2,'cc_id');
			cachingElement(eqTypeSet,cavw,2,'EqType');
		}
	});
	
	// get all the available graph move to the eruption
	$("#EruptionList").change(function(){
		moveGraphsToEruptionTime.apply(this);
	});
	$("#CompEruptionList").change(function(){
		moveGraphsToEruptionTime.apply(this,[2]);
	});
	var buttons = document.getElementsByTagName('button');
	for(var i = 0 ; i < buttons.length ; i++){
		var button = buttons[i];
		button.style.fontSize = '10px';
	}
	$("#ShowMap1").click(function(){
		$("#Map").show();
		$("#map_legend1").show();
	});
	$("#ShowMap2").click(function(){
		$("#Map2").show();
		$("#map_legend2").show();
	});
	$("#HideMap1").click(function(){
		$("#Map").hide();
		$("#map_legend1").hide();
	});
	$("#HideMap2").click(function(){
		$("#Map2").hide();
		$("#map_legend2").hide();
	});
});