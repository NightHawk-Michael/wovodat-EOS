/**
* Store every javaScript functions to draw Graph for php file
*Created by Luis Ngo - 21/2/2016
*/
// this is the list of available station type for each volcano,
// this list will be initialize when the volcano is selected and 
// it will be deleted when this volcano is deselected.

// this link to all the plotted graph
var graphs = [];
// this link to all the plot data for each graph
var graphData = []; 
var cloneData = [];

// these marks will show the eruption start time 
// eruptions data
var eruptionsData = {};
eruptionsData.compEruptions = [];
// reference data to since between various graphs
var referenceTime = null;
// full details scaled data
var detailedData = [];
var totalGraph = [];
var limitTotalGraph = 5;
var graphCount = [];

var ownerURL = [];

/**
 *  main function to draw the time series graph
 * data has the format [[[x1,y1],[x2,y2],[x3,y3]]]
 *
 * id is the string to specify the type of the data
*/
function drawGraph(args) {
	alert(args);
	function getDisplayLabel(id,tableId) {
		var display = id.split("&");

		var res = document.getElementById(id + 'Tr' + tableId).getElementsByTagName('td')[1].innerHTML;
	
		
		if(display[4] && display[4]!='undefined') {
			res += " (" + Wovodat.htmlUnit(display[4]) + ")";
		}
	
		return res;
	}

	var id = args.id;
	var tableId = args.tableId;

	
	var tr = $(document.createElement('tr'));
	var td = $(document.createElement('td'));


	$(tr).attr("id", id + "Row" + tableId);
	$(tr).append(td);

	$(td).html(getDisplayLabel(id,tableId));
	$(td).width(450);

	args.container=td;
	args.label = getDisplayLabel(id,tableId);
	$("#GraphList"+ tableId).append(tr);

	totalGraph[args.tableId]++;
	graphCount[args.tableId][args.id]++;
	
	
	if(!args.data[0].length) {
		$(td).append('<span style="color:red;"> Sorry, no data is available.</span>');
	} else {
		if(id.indexOf("Seismic") !=-1 || id.indexOf("Gas")!=-1 || (id.indexOf("Meteo")!=-1 && id.indexOf("prec")!=-1) ) {
			args.td=td;    
			appendFilter(args);
		} else {
			drawGraph2(args);
		}
	}
}

/*
*
*/
//  function drawGraph2(args){
// 	var td = args.container;
// 	td.html("");
// 	if(!args.data[0].length) {
// 		$(td).append('<span style="color:red;"> Sorry, no data is available.</span>');
// 		return;
// 	}

// 	var id = args.id;
// 	// the map used
// 	var tableId = args.tableId;
	
// 	// get the label from the list of available time series
// 	//var label = document.getElementById(id + 'Tr' + tableId).getElementsByTagName('td')[1].innerHTML;

// 	var label = args.label;
// 	var data = args.data;
// 	if(graphData[id] == undefined) {
// 		graphData[id] = data;
// 		cloneData[id] = data;
// 	}
	
// 	// delete the link between data that are too long from each other
// 	//if(label.indexOf("Leveling") == -1)
// 	//    data = Wovodat.highlightNoDataRange(data);
	
// 	// delete the data that are too big compare to its neighbor
// 	//data = Wovodat.fixBigData(data);
	
// 	// set up the reference time
// 	if(referenceTime == null){
// 		referenceTime = data[0][0][0];
// 	}
// 	// get detailed scaled data for the graph 
// 	// the data is divied into two scale: minimized scale and full scale
// 	// full scale contains resampling version of entire data in 12 hours period
// 	// minimized scale contains all data without any resampling.
// 	// the minimized scale will be used when the graph have to draw data 
// 	// with a range of less than month. This will efficiently improve then
// 	// running time of the javascript when perform drawing.

	
// 	var isDetailedDataAvailable = false;
// 	if(detailedData[id] == null){
// 		Wovodat.getDetailedStationData({
// 			id: id,
// 			referenceTime: referenceTime,
// 			handler: function(e){
// 				detailedData[id] = e.data;
// 				// set the graphs to appropriate dataset when 
// 				if(graphs[id+tableId]){
						
// 					graphs[id + tableId].getPlaceholder().bind('plotpan',function(event,plot){
// 						Wovodat.redraw(graphs[id + tableId],graphData[id],e.data,graphs);
// 					});
// 					graphs[id + tableId].getPlaceholder().bind('plotzoom',function(event,plot){
// 						Wovodat.redraw(graphs[id + tableId],graphData[id],e.data,graphs,true);
// 					});
// 				}
// 				Wovodat.showNotification({message:"Updated detailed data for " + label + " graph.",duration: 10});
// 			}
// 		});
// 	}else{
// 		isDetailedDataAvailable = true;
// 	}
// 	// dynamically create the table row for drawing the time series graph

// 	// dynamically create the table row for drawing the time series graph
// 	if(args.label) {
// 		td.append("<div>" + args.label + "</div>");
// 	}
// 	if(args.equakeType) {
// 		td.append(" - Earthquake type: " + args.equakeType);
// 	}
// 	// div element to draw the graph into
// 	var div = document.createElement('div');
// 	div.id = id + "Graph" + tableId;
// 	div.style.width = '440px';
// 	div.style.height = '150px';
// 	div.oncontextmenu=function() {
// 		if(ownerURL && ownerURL[args.tableId] && "href" in ownerURL[args.tableId])
// 			$.jGrowl("Please contact <a target='_blank' href='"+ownerURL[args.tableId]["href"]+"''>"+ownerURL[args.tableId]["text"]+"</a> to use the data",{ position: "bottom-right", closer:false });
// 		return false;
// 	};
// 	$(td).append(div);
// 	if (ownerURL && ownerURL[args.tableId] && "href" in ownerURL[args.tableId]) {
// 		var authorDiv = $("<div></div>").css("float","right").append("Data owner: <a target='_blank' href='"+ownerURL[args.tableId]["href"]+"'>"+ownerURL[args.tableId]["text"]+"</a>").appendTo(td);

// 		if(data[0][0]["author_info"]) {
// 			var name = data[0][0]["author_info"]["name"];
// 			var year = data[0][0]["author_info"]["year"];
// 			$(authorDiv).append("<br/>Author: "+name+", "+year);
// 		}
// 	}  
// 	var options=getGraphOptions(id,tableId,data);   
// 	plotGraph(id,tableId,options,data);
// 	redrawOtherGraph(id,tableId,options);
// 	setOnHoverForGraph(id,tableId,label,args.equakeType);
// 	// $("#overviewPanel" + tableId).css('display','block');
// 	drawOverviewGraph(tableId);
// 	// making the overview shown
	
	
// 	if(isDetailedDataAvailable){
// 		graphs[id + tableId].getPlaceholder().bind('plotpan',function(event,plot){
// 			Wovodat.redraw(graphs[id + tableId],graphData[id],detailedData[id],graphs);
// 		});
// 		graphs[id + tableId].getPlaceholder().bind('plotzoom',function(event,plot){
// 			Wovodat.redraw(graphs[id + tableId],graphData[id],detailedData[id],graphs,true);
// 		});
// 	}
// }

/**
Plot graph
*/
function plotGraph(id,tableId,options,data) {
	data = {
		data: data[0]
	};
	if(!tableId) data.label = label; 
	if(tableId == 2)
		graphs[id + tableId] = $.plot($("[id='" + id + "Graph" + tableId + "']"),[data,eruptionsData.compEruptions],options);
	else {
		graphs[id + tableId] = $.plot($("[id='" + id + "Graph" + tableId + "']"),[data,eruptionsData],options);

	}
	
	graphs[id + tableId].getPlaceholder().bind('plotpan',function(event,plot){                    
		Wovodat.redraw(graphs[id + tableId],graphData[id],detailedData[id],graphs);
	});
	graphs[id + tableId].getPlaceholder().bind('plotzoom',function(event,plot){
		Wovodat.redraw(graphs[id + tableId],graphData[id],detailedData[id],graphs,true);
	});                
}

/**
 *Redraw graph
 * redraw other graphs
 * need to consider the end character of the id
*/
function redrawOtherGraph(id,tableId,options) {

	var placeholder;
	var temp;
	for( i in graphs){
		// do not redraw itself
		if( i == (id + tableId)) continue;
		var j = side(i);
		// only redraw the graph that is on the similar side with this
		// graph
		if(j == tableId){
			placeholder = graphs[i].getPlaceholder();
			temp = graphs[i].getOptions();
			options.yaxis.panRange = temp.yaxis.panRange;
			options.yaxis.zoomRange = temp.yaxis.zoomRange;
			options.yaxis.max = temp.yaxis.max;
			options.yaxis.min = temp.yaxis.min;
			options.series.bars = temp.series.bars;
			options.series.lines = temp.series.lines;
			data = graphs[i].getData();
			data = {
				data: data[0].data,
				label: data[0].label
			};
			graphs[i] = $.plot(placeholder,[data],options);
		}
	}

	// this part is for synchronize the pan and zoom of the graphs
	for( i in graphs){
		var temp = side(i);
		if(temp == tableId){
			if(i != id + tableId)
				synchronizeGraph(i,id + '' + tableId);
		}
	}
}



/**
*draw overview graph
*
*/
// function drawOverviewGraph(tableId){
// 	//setPrintButtonVisibility(tableId,true);
// 	if(!tableId) {
// 		return; 
// 	}
// 	var placeholder= document.getElementById('overview' + tableId);
// 	placeholder.innerHTML = '';
// 	$(placeholder).show();
// 	var id;
// 	var data = [];
	
// 	// consider two case when we are in comparison view or in single view
// 	// get the correct id for the graph data, this is different with the graphs id
// 	for(id in graphs){
// 		var j = id.length;
// 		j = parseInt(id.substring(j-1,j));
// 		if( j != tableId) continue;
// 		else id = id.substring(0,id.length -1 );
// 		data.push(graphData[id][0]);
// 	}
	
// 	var options = {
// 		series: {
// 			lines: { show: true},
// 			shadowSize: 0
// 		},
// 		xaxis: { mode:'time'},
// 		yaxis: { ticks: []}, // no tick for the yaxis
// 		selection: { mode: "x", color: '#451A2B' }
// 	};
// 	$.plot(placeholder,data,options);
// 	/*
// 	 * This section of code allow the user to see the updated version
// 	 * of every graph below the overview graph when user selecs a 
// 	 * portion of the overview graph.
// 	 */
// 	// clear previous handler
// 	$("#overview" + tableId).unbind('plotselected');
// 	// draw other main graphs when user select a portion of this graph
// 	$("#overview" + tableId).bind('plotselected',function(event,ranges){
// 		var id;
// 		var plot;
// 		var options,data,placeholder,newOptions;
// 		var to = ranges.xaxis.to;
// 		var from = ranges.xaxis.from;
// 		for(id in graphs){
// 			if(tableId){
// 				var j = id.length;
// 				j = parseInt(id.substring(j-1,j));
// 				if(j != tableId) continue;
// 				else id = id.substring(0,id.length-1);
// 			}
// 			plot = graphs[id + tableId];
// 			if(plot == undefined) continue;
// 			placeholder = plot.getPlaceholder();
// 			placeholder.empty();
// 			// this is for the label
// 			var data = plot.getData();
// 			// when user select a section on the overview graph, the data
// 			// will reset to the initial data which is 12 hours re-sampling data
// 			data = {
// 				data: graphData[id][0],
// 				label: data[0].label
// 			};
// 			var o = Wovodat.getLocalMaxMin(data.data,from,to);
// 			var maxY,minY;
// 			maxY = o.max;
// 			minY = o.min;

// 			options = plot.getOptions();
// 			newOptions = {
// 				series: options.series,
// 				grid: options.grid,
// 				yaxis:{
// 					ylabel: options.yaxis.ylabel,
// 					panRange: options.yaxis.panRange,
// 					zoomRange: options.yaxis.zoomRange,
// 					max: maxY,
// 					min: minY,
// 					color: 'rgb(123,1,100)',
// 					//labelWidth: 40,// in pixel
// 					labelHeigth: 25,// in pixel
// 					//tickDecimals:1
// 				},
// 				zoom:{
// 					interactive: true
// 				},
// 				pan: {
// 					interactive: true
// 				}
// 			}
// 			newOptions.xaxis = options.xaxis;
// 			newOptions.xaxis.max = to;
// 			newOptions.xaxis.min = from;
// 			if(tableId == '2')
// 				graphs[id + tableId] = $.plot(placeholder,[data,eruptionsData.compEruptions],newOptions);
// 			else
// 				graphs[id + tableId] = $.plot(placeholder,[data,eruptionsData],newOptions);
// 			Wovodat.redraw(graphs[id + tableId],graphData[id],detailedData[id],graphs,true);
// 		}
// 	});
// }



/**
Draw Time Series
*/
// function drawTimeSeries(obj,tableId){
// 	var value = obj.value;
// 	var index = value;
// 	value = value.split("&");

// 	var type = value[0];
// 	var table = value[1];
// 	var code = value[2];

	
// 	var component = value[3];
// 	if(obj.checked){
// 		if(totalGraph[tableId]>=limitTotalGraph) {
// 			alert('Please choose at most '+limitTotalGraph+' series to draw');
// 			obj.checked = false;
// 			return;
// 		}

// 		graphCount[tableId][index]=0;

// 		if(graphData[index] != undefined){
// 			drawGraph({
// 				id: index,
// 				data: graphData[index],
// 				tableId:tableId
// 			});
// 		}else{
// 			Wovodat.getStationData({
// 				type:type,
// 				table:table,
// 				code:code,
// 				component: component,
// 				id: index,
// 				handler:drawGraph,
// 				tableId:tableId
// 			});
			
// 		}
// 	}else{
// 		deleteGraph({id:obj.value,tableId:tableId});
// 	}
// }

// /**
//  * Delete Graph
// */
// function deleteGraph(args){
// 	var id = args.id;
// 	var tableId = args.tableId;

// 	totalGraph[tableId]-=graphCount[tableId][id];
// 	graphCount[tableId][id]=0;

// 	if(tableId == undefined) tableId = "";
// 	delete(graphs[id + tableId]);
// 	var tr = document.getElementById(id +'Row'  + tableId);
// 	if(tr)
// 		tr.parentNode.removeChild(tr);
// 	var hideOverview = true;
// 	for(id in graphs){
// 		if(tableId){
// 			var j = id.length;
// 			j = parseInt(id.substring(j-1,j));
// 			if(j!= tableId) continue;
// 		}
// 		hideOverview = false;
// 		break;
// 	}
// 	if(hideOverview){
// 		$("#overviewPanel" + tableId).css('display','none');
// 		//setPrintButtonVisibility(tableId,false);
// 	}else{
// 		drawOverviewGraph(tableId);
// 	}
// }


/**
 *
 *synchronize slide with textbox
 */
function adjustSlider(id){
	$("#DepthRange"+id).slider("values",[$("#DepthLow"+id).val(),$("#DepthHigh"+id).val()]);
}

/**
* when user select a specific eruption, all the graphs will move to 
* the volcano in the time series
*/
// function updateTimeSeriesList(data,tableId){
// 	var timeSeriesList;
// 	var optionList = document.getElementById('OptionList' + tableId + '-1');
// 	if(tableId == null){
// 		timeSeriesList = document.getElementById('TimeSeriesList');
// 	}
// 	else{
// 		data = data.split(';');
// 		data.length = data.length - 1;
// 		timeSeriesList = document.getElementById('TimeSeriesList' + tableId);
// 		timeSeriesList.innerHTML = '';
// 		// delete all the graph and the overview of tableId side
// 		$('#overviewPanel' + tableId).css('display','none');
// 		$('#overview' + tableId).html('');
// 	// get the min and max of 
// 		$('#GraphList' + tableId).html('');
// 		for(var k in graphs){
// 			var m = side(k);
// 			if(m == tableId){
// 				delete graphs[m];
// 			}
// 		}
// 	}

// 	if(timeSeriesList == null) return;
// 	var count = 0;
// 	var t;
// 	var value;
// 	var display;
// 	for(var i in data){
// 		count++;
// 		value = Wovodat.trim(data[i]);
// 		value = value.split('&');

		
// 		//display = value[0] + '_' + value[1] + '_' + value[2];
// 		display = value[1];
		
		
// 		if(value[5] != "undefined" && value[5]!=undefined) {
// 			display = display + '-' + value[5];
// 		}

// 		display+=" (";

// 		var code=value[2].split("___");
// 		var first=true;

// 		for(var j in code) {
// 			var k=code[j].indexOf('-');
// 			if(k==0) k=-1;
// 			var val=code[j].substring(k+1,code[j].length);

// 			if(val!="null" && val!=null && val!=undefined) {
// 				if(first) first=false;
// 				else display+=" - ";
// 				display+=val;
// 			}

// 		}

// 		display+=")";
// 		value = value[0] + "&" + value[1] + "&" + value[2] + '&' + value[5] + '&' + value[6];
// 		t = document.createElement('tr');
// 		if(tableId == null)
// 			t.id = value + 'Tr';
// 		else
// 			t.id = value + 'Tr' + tableId;
// 		timeSeriesList.appendChild(t);
// 		$("[id='" + t.id + "']").html("<td><input type='checkbox' id='" +value +  "' value='" + value + "' onclick='drawTimeSeries(this," + tableId + ")'></td><td>" + display + "</td>");          
	
// 	}
// 	if(count == 0){                    
// 		$(timeSeriesList).html("<tr><td>No data is available yet.</td></tr>");
// 		optionList.style.height = '30px';
// 	}else{
// 		if(count > 3) count = 3;
// 		optionList.style.height  = 40 + (count-1)*17 + 'px';
// 	}
// }

function getTotalGraph(tableId) {
	var res=0;
	for(var i in graphs) {
		if(side(i)==tableId) res++;
	}
	return res;
}

function appendFilter(args) {
	var filterForm = $(document.createElement('form')).addClass("FormFilter");
	var pointer = $(document.createElement('div')).addClass("pointer1").appendTo(filterForm);
	var filterButton = $(document.createElement('div')).addClass("ShowHideFilterButton1");

	if($(filterForm).css("display")=="none") {
		$(filterButton).html("Show filter");
	} else {
		$(filterButton).html("Hide filter");
	}

	$(filterButton).click(function() {
		if($(filterForm).css("display")=="none") {
			$(filterForm).css("display","block");
			$(filterButton).html("Hide filter");
		} else {
			$(filterForm).css("display","none");
			$(filterButton).html("Show filter");
		}
	});

	$(args.td).append(filterButton);
	$(args.td).append(filterForm);

	args.filterForm=filterForm;

	if(args.id.indexOf("Seismic")!=-1) {
		if(args.id.indexOf("Interval")!=-1 || args.id.indexOf("EVS")!=-1) {
			addOptionForFilterEQType(args);
			return;
		} else if(args.id.indexOf("TRM")!=-1) {
			addOptionForFitlerTRM(args);
			return;
		}
	}

	if(args.id.indexOf("Gas")!=-1) {
		if(args.id.indexOf("gd_concentration")!=-1 || args.id.indexOf("gd_sol_tflux")!=-1 || args.id.indexOf("gd_plu_emit")!=-1) {
			addOptionForFilterGasSpecies(args);
			return;
		}
	}

	if(args.id.indexOf("Meteo")!=-1) {
		if(args.id.indexOf("prec")!=-1) {
			addOptionForFilterPrec(args);
			return;
		}
	}

	filterForm.css("display","none");
	filterButton.css("display","none");
	args.td.html("");

	args.container=$("<div></div>").appendTo(args.td);
	drawGraph2(args);
}

/**
 * Get option of the graph
 * @param id
 * @param tableId
 * @param data
 * @returns {{series: {points: {show: boolean}, color: string}, grid: {hoverable: boolean, clickable: boolean, backgroundColor: {colors: string[]}}, xaxis: {max: Number, min: (number|*), panRange: *[], zoomRange: *[], ticks: tickGenerator, labelWidth: number, show: boolean}, yaxis: {panRange: *[], zoomRange: *[], max: *, min: *, color: string}, zoom: {interactive: boolean}, pan: {interactive: boolean}}}
 */
function getGraphOptions(id,tableId,data) {
	var minValue ,maxValue;
	var maxXValue = Number.MIN_VALUE;
	var sixMonths = 6*30*24*60*60*1000; // in milliseconds
	var minXValue,xRangeMin;
	var i;
	var length = data[0].length;
	maxXValue = data[0][0][0];

	minValue = data[0][0][1];
	maxValue = minValue;

	xRangeMin = data[0][length-1][0];

	// get the min and max of y for current graph
	for(i = 0 ; i < length; i++){
		if(data[0][i][1] == null)
			continue;
		if(data[0][i][1] > maxValue) maxValue = data[0][i][1];
		if(data[0][i][1] < minValue) minValue = data[0][i][1];
	}

	// get the maxXValue of every graph that is currently displayed
	for(var b in graphs){
		// do not consider the graph that is not in the same side
		if(tableId != side(b)) continue;

		for(var a in graphData){
			if (b.indexOf(a) >= 0){
				var temp = graphData[a][0][0][0];
				if(temp > maxXValue ) maxXValue = temp;
				var l = graphData[a][0].length;
				var t = graphData[a][0][l-1][0];
				if(t < xRangeMin) xRangeMin = t;
			}
		}
	}
	minXValue = maxXValue - sixMonths;
	minXValue = minXValue > data[0][length-1][0]? minXValue : data[0][length-1][0];

	for(var a in graphData){
		if(tableId != side(a)) continue;

		for(var b in graphs){
			if( b.indexOf(a) >= 0){
				var temp = graphData[a][0][graphData[a][0].length -1][0];
				if( minXValue > temp) minXValue = temp;
			}
		}
	}

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
			panRange:[xRangeMin,maxXValue],
			zoomRange:[Wovodat.ONE_DAY,maxXValue - xRangeMin],
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
			//,tickDecimals: 1
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

	return options;
}

/**
 *make the graph moves together when user manipulate one graph
 *
 */
function synchronizeGraph(i,j){
	var temp = side(i);
	if(temp != side(j)) return;
	var i1 = i.replace(/&/g,"\\&").replace(/=/g,"\\=");
	var j1 = j.replace(/&/g,"\\&").replace(/=/g,"\\=");
	var i2,j2;
	if(temp == '1' || temp == '2'){
		var t = i.length;
		i2 = i.substring(0,t-1);
		t = j.length;
		j2 = j.substring(0,t-1);
		var t = i1.length;
		i1 = i1.substring(0,t-1);
		t = j1.length;
		j1 = j1.substring(0,t-1);
	}else{
		i2 = i;
		j2 = j;
	}
	$("#" + i1 + "Graph" + temp).bind('plotzoom',function(event,plot,args){
		if(graphs[j] == undefined) return;
		if(args[j] && args[j] == true)
			return;
		args[j] = true;
		args.preventEvent = true;
		graphs[j].zoom(args);
		Wovodat.redraw(graphs[j],graphData[j2],detailedData[j2],graphs,true);
	});
	$("#" + i1 + "Graph"  + temp).bind('plotpan',function(event,plot,args){
		if(graphs[j] == undefined) return;
		if(args[j] && args[j] == true)
			return;
		args[j] = true;
		args.preventEvent = true;
		graphs[j].pan(args);
		Wovodat.redraw(graphs[j],graphData[j2],detailedData[j2],graphs);
	});
	$("#" + j1 + "Graph" + temp).bind('plotzoom',function(event,plot,args){
		if(graphs[i] == undefined) return;
		if(args[i] && args[i] == true)
			return;
		args[i] = true;
		graphs[i].zoom(args);
		Wovodat.redraw(graphs[i],graphData[i2],detailedData[i2],graphs,true);
	});
	$("#" + j1 + "Graph" + temp).bind('plotpan',function(event,plot,args){
		if(graphs[i] == undefined) return;
		if(args[i] && args[i] == true)
			return;
		args[i] = true;
		args.preventEvent = true;
		graphs[i].pan(args);
		Wovodat.redraw(graphs[i],graphData[i2],detailedData[i2],graphs);
	});
}