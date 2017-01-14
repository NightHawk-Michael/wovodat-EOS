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
            var compStationsDatabase = {};
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
            var cloneData = [];
            // the variable store the reference to the overview graph
            var overviewGraph;
            // these marks will show the eruption start time 
            // eruptions data
            var eruptionsData = {};
            eruptionsData.compEruptions = [];
            // reference data to since between various graphs
            var referenceTime = null;
            // full details scaled data
            var detailedData = [];

            // Equake type
            var equakeType = [];

            var totalGraph = [];
            var limitTotalGraph = 5;
            var graphCount = [];

            var ownerURL = [];

            var ccMap = new Map();
            var eqMap = new Map();

            function resetFilter(mapUsed){
                
                var dateString = "";
                $("#Evn" + mapUsed).val(500);
                var startDate = new Date(1940, 0, 2, 0, 0, 0, 0);
                dateString = (startDate.getUTCMonth() + 1) + "/" + startDate.getUTCDate() + "/" + startDate.getUTCFullYear();
                $("#SDate" + mapUsed).val(dateString);
                var endDate = new Date();
                dateString = (endDate.getUTCMonth() + 1) + "/" + endDate.getUTCDate() + "/" + endDate.getUTCFullYear();
                $("#EDate" + mapUsed).val(dateString);
                
                $("#SDate" + mapUsed).datepicker({changeMonth:true,changeYear:true,yearRange:"1940:2100"});
                $("#EDate" + mapUsed).datepicker({changeMonth:true,changeYear:true,yearRange:"1940:2100"});
                
                $("#cc_id" + mapUsed).val("");
                $("#EqType" + mapUsed).val("");
                $("#wkm" + mapUsed).val(10);
                $("#azim" + mapUsed).val(175);
                $("#degree" + mapUsed).val(30);
                
                $("#DateRange" + mapUsed).slider({
                    range: true,
                    max: Math.floor(endDate.getTime()-startDate.getTime())/86400000,
                    values : [0, Math.floor(endDate.getTime()-startDate.getTime())/86400000],
                    slide: function(event,ui){
                        var startDate = new Date(1940, 0, 2, 0, 0, 0, 0);
                        var date = new Date(startDate.getTime());
                        date.setDate(date.getDate() + ui.values[0]);
                        $("#SDate" + mapUsed).val($.datepicker.formatDate('mm/dd/yy',date));
                        date = new Date(startDate.getTime());
                        date.setDate(date.getDate() + ui.values[1]);
                        $("#EDate" + mapUsed).val($.datepicker.formatDate('mm/dd/yy',date));
                    }
                });
                // range of max and min depth
                $("#DepthLow" + mapUsed).val(0);
                $("#DepthHigh" + mapUsed).val(40);
                $("#MagnitudeLow" + mapUsed).val(0); // vutuan added
                $("#MagnitudeHigh" + mapUsed).val(9); //vutuan added
                $("#SDate" + mapUsed).change(function(){adjustSlider(mapUsed);});
                $("#EDate" + mapUsed).change(function(){adjustSlider(mapUsed);});
                
            }

            function setupSwitchButton(){
                var button = document.getElementById('switchView');
                var panel = document.getElementById('volcanoPanel2');
                $(button).click(switchView);
                $(panel).css('display','block');
            }

            function switchView(){
                var panel = document.getElementById('volcanoPanel2');
                if($(panel).css('display') == 'block')
                    showSingleView();
                else 
                    showComparisionView();
                
            }

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
                $("#Map").css('height','300px');
                google.maps.event.trigger(map[1], "resize");
                $("#switchView").html("Comparision View");
                $("#TimeSeriesView1").show();
                $("#EquakePanel1").show();
                map[1].setCenter(map[1].centerPoint);
                // $("#image").css('width','459px');
            }

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

            $(document).ready(function(){
                $("#image").css('width','459px');
                setupSwitchButton();
                // get the list of all volcano in our database and insert it into 
                // the dropdown list
                //insertVolcanoList is used as a callback function with 2 parameter: the first 
                //parameter is the list of Volcano, and the second parameter is the ID of the dropdown menu
                //to which data is populated
                Wovodat.getVolcanoList(insertVolcanoList,["VolcanoList","CompVolcanoList"]);
               Wovodat.getEquakeTypeList(setupEquakeType);
                //Wovodat.getCatalogOwner(setupCatalogOwner);
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

            function getCavw(mapUsed){
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
                return cavw;
            }

            function insertMarkersForNeighbors(cavw, list, panelUsed){
                //remove all neighMarkers
                for (var i in neighMarkers[panelUsed])
                    neighMarkers[panelUsed][i].setMap(null);
                neighMarkers[panelUsed]=[];
                if (list[list.length]=="")
                    list.length--;
                for (var index in list){
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
                        var title = this.getTitle();
                        title = title.split('_');
                        title = Wovodat.trim(title[1]);
                        var l = selectDom.options.length;
                        for (var i = 0 ; i < l ; i++){
                            if(selectDom.options[i].text == undefined) 
                                continue;
                            if ((selectDom.options[i].text).indexOf(title) > -1){
                                selectDom.selectedIndex = i;
                                selectj.change();
                                break;
                            }
                        }
                        
                    });
                }
            }


            // when user select a specific eruption, all the graphs will move to 
            // the volcano in the time series
            function moveGraphsToEruptionTime(tableId){
                // get time of the eruption
                if(!tableId){
                    if ($("#Map2").css("display") != "none"){
                        tableId = 1;
                    }else{
                        tableId = '';
                    }
                }
                var value = this.value;
                if(value == "") return;
                value = value.split(' ');
                if(value.length <= 1) {
                    return;
                }
                // convert the time to javascript data object
                var time = Wovodat.toDate(this.value).getTime();
                var range = 0;
                // since we have synchronized all the graphs, all of them must have
                // the same range
                for(var i in graphs){
                    var temp = side(i);
                    if(temp != tableId) continue;
                    var temp = graphs[i].getAxes().xaxis;
                    range = temp.max - temp.min;
                    break;
                }
                // get the duration of the displayed graph
                if(range == '0' ) {
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
                    var temp = side(i);
                    if(temp != tableId) continue;
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
                        yaxis:options.yaxis,
                        zoom:{
                            interactive: true
                        },
                        pan: {
                            interactive: true
                        }
                    };
                    newOptions.xaxis = options.xaxis;
                    newOptions.xaxis.max = maxRange;
                    newOptions.xaxis.min = minRange;
                    placeholder.empty();
                    delete(graphs[i]);
                    if(temp == '2')
                        graphs[i] = $.plot(placeholder,[data,eruptionsData.compEruptions],newOptions);
                    else
                        graphs[i] = $.plot(placeholder,[data,eruptionsData],newOptions);
                }
            }

            //synchronize slide with textbox
            function adjustSlider(id){
                $("#DepthRange"+id).slider("values",[$("#DepthLow"+id).val(),$("#DepthHigh"+id).val()]);
            }
            
            
            // when user select a specific eruption, all the graphs will move to 
            // the volcano in the time series
            function updateTimeSeriesList(data,tableId){
                var timeSeriesList;
                var optionList = document.getElementById('OptionList' + tableId + '-1');
                if(tableId == null){
                    timeSeriesList = document.getElementById('TimeSeriesList');
                }
                else{
                    data = data.split(';');
                    data.length = data.length - 1;
                    timeSeriesList = document.getElementById('TimeSeriesList' + tableId);
                    timeSeriesList.innerHTML = '';
                    // delete all the graph and the overview of tableId side
                    $('#overviewPanel' + tableId).css('display','none');
                    $('#overview' + tableId).html('');
                // get the min and max of 
                    $('#GraphList' + tableId).html('');
                    for(var k in graphs){
                        var m = side(k);
                        if(m == tableId){
                            delete graphs[m];
                        }
                    }
                }

                if(timeSeriesList == null) return;
                var count = 0;
                var t;
                var value;
                var display;
                for(var i in data){
                    count++;
                    value = Wovodat.trim(data[i]);
                    value = value.split('&');

                    
                    //display = value[0] + '_' + value[1] + '_' + value[2];
                    display = value[1];
                    
                    
                    if(value[5] != "undefined" && value[5]!=undefined) {
                        display = display + '-' + value[5];
                    }

                    display+=" (";

                    var code=value[2].split("___");
                    var first=true;

                    for(var j in code) {
                        var k=code[j].indexOf('-');
                        if(k==0) k=-1;
                        var val=code[j].substring(k+1,code[j].length);

                        if(val!="null" && val!=null && val!=undefined) {
                            if(first) first=false;
                            else display+=" - ";
                            display+=val;
                        }

                    }

                    display+=")";
                    

                    //display+= " (" + value[2].replace(/___/g, " - ") + ")";
    
                    value = value[0] + "&" + value[1] + "&" + value[2] + '&' + value[5] + '&' + value[6];


                    t = document.createElement('tr');
                    if(tableId == null)
                        t.id = value + 'Tr';
                    else
                        t.id = value + 'Tr' + tableId;

                    
                    timeSeriesList.appendChild(t);
                    $("[id='" + t.id + "']").html("<td><input type='checkbox' id='" +value +  "' value='" + value + "' onclick='drawTimeSeries(this," + tableId + ")'></td><td>" + display + "</td>");          
                
                }
                if(count == 0){                    
                    $(timeSeriesList).html("<tr><td>No data is available yet.</td></tr>");
                    optionList.style.height = '30px';
                }else{
                    if(count > 3) count = 3;
                    optionList.style.height  = 40 + (count-1)*17 + 'px';
                }
            }

            function getTotalGraph(tableId) {
                var res=0;
                for(var i in graphs) {
                    if(side(i)==tableId) res++;
                }
                return res;
            }

            function drawTimeSeries(obj,tableId){
                var value = obj.value;
                var index = value;
                value = value.split("&");

                var type = value[0];
                var table = value[1];
                var code = value[2];

                
                var component = value[3];
                if(obj.checked){
                    if(totalGraph[tableId]>=limitTotalGraph) {
                        alert('Please choose at most '+limitTotalGraph+' series to draw');
                        obj.checked = false;
                        return;
                    }

                    graphCount[tableId][index]=0;

                    if(graphData[index] != undefined){
                        drawGraph({
                            id: index,
                            data: graphData[index],
                            tableId:tableId
                        });
                    }else{
                        Wovodat.getStationData({
                            type:type,
                            table:table,
                            code:code,
                            component: component,
                            id: index,
                            handler:drawGraph,
                            tableId:tableId
                        });
                        
                    }
                }else{
                    deleteGraph({id:obj.value,tableId:tableId});
                }
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
 /*           
            // main function to draw the time series graph
            // data has the format [[[x1,y1],[x2,y2],[x3,y3]]]
            // id is the string to specify the type of the data
            function drawGraph(args) {
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
*/
/*
            function drawGraph2(args){
                var td = args.container;
                td.html("");
                if(!args.data[0].length) {
                    $(td).append('<span style="color:red;"> Sorry, no data is available.</span>');
                    return;
                }

                var id = args.id;
                // the map used
                var tableId = args.tableId;
                
                // get the label from the list of available time series


                //var label = document.getElementById(id + 'Tr' + tableId).getElementsByTagName('td')[1].innerHTML;

                var label = args.label;
                
                
                var data = args.data;
                

                if(graphData[id] == undefined) {
                    graphData[id] = data;
                    cloneData[id] = data;
                }
                
                // delete the link between data that are too long from each other
                //if(label.indexOf("Leveling") == -1)
                //    data = Wovodat.highlightNoDataRange(data);
                
                // delete the data that are too big compare to its neighbor
                //data = Wovodat.fixBigData(data);
                
                // set up the reference time
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
                    Wovodat.getDetailedStationData({
                        id: id,
                        referenceTime: referenceTime,
                        handler: function(e){
                            detailedData[id] = e.data;
                            // set the graphs to appropriate dataset when 
                            if(graphs[id+tableId]){
                                    
                                graphs[id + tableId].getPlaceholder().bind('plotpan',function(event,plot){
                                    Wovodat.redraw(graphs[id + tableId],graphData[id],e.data,graphs);
                                });
                                graphs[id + tableId].getPlaceholder().bind('plotzoom',function(event,plot){
                                    Wovodat.redraw(graphs[id + tableId],graphData[id],e.data,graphs,true);
                                });
                            }
                            Wovodat.showNotification({message:"Updated detailed data for " + label + " graph.",duration: 10});
                        }
                    });
                }else{
                    isDetailedDataAvailable = true;
                }

                
                
                // dynamically create the table row for drawing the time series graph

                // dynamically create the table row for drawing the time series graph
                
                

                if(args.label) {
                    td.append("<div>" + args.label + "</div>");
                }
                if(args.equakeType) {
                    td.append(" - Earthquake type: " + args.equakeType);
                }


                // div element to draw the graph into
                var div = document.createElement('div');
                div.id = id + "Graph" + tableId;
                div.style.width = '440px';
                div.style.height = '150px';



                div.oncontextmenu=function() {
                    if(ownerURL && ownerURL[args.tableId] && "href" in ownerURL[args.tableId])
                        $.jGrowl("Please contact <a target='_blank' href='"+ownerURL[args.tableId]["href"]+"''>"+ownerURL[args.tableId]["text"]+"</a> to use the data",{ position: "bottom-right", closer:false });
                    return false;
                };

                $(td).append(div);
                if (ownerURL && ownerURL[args.tableId] && "href" in ownerURL[args.tableId]) {
                    var authorDiv = $("<div></div>").css("float","right").append("Data owner: <a target='_blank' href='"+ownerURL[args.tableId]["href"]+"'>"+ownerURL[args.tableId]["text"]+"</a>").appendTo(td);

                    if(data[0][0]["author_info"]) {
                        var name = data[0][0]["author_info"]["name"];
                        var year = data[0][0]["author_info"]["year"];
                        $(authorDiv).append("<br/>Author: "+name+", "+year);
                    }
                }  
                var options=getGraphOptions(id,tableId,data);   
                plotGraph(id,tableId,options,data);
                redrawOtherGraph(id,tableId,options);
                setOnHoverForGraph(id,tableId,label,args.equakeType);
                
                
                $("#overviewPanel" + tableId).css('display','block');
                drawOverviewGraph(tableId);
                // making the overview shown
                
                
                if(isDetailedDataAvailable){
                    graphs[id + tableId].getPlaceholder().bind('plotpan',function(event,plot){
                        Wovodat.redraw(graphs[id + tableId],graphData[id],detailedData[id],graphs);
                    });
                    graphs[id + tableId].getPlaceholder().bind('plotzoom',function(event,plot){
                        Wovodat.redraw(graphs[id + tableId],graphData[id],detailedData[id],graphs,true);
                    });
                }
            }
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
/*
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
			*/
/*
            function redrawOtherGraph(id,tableId,options) {
                // redraw other graphs
                // need to consider the end character of the id
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
*/
/*
            function setOnHoverForGraph(id,tableId,label,equakeType) {
                // showing the tooltip of information for the graphs when
                // user hovers mouse over a point on the graph.
                var previousPoint = null;

                $("[id='" + id + "Graph" + tableId + "']").bind('plothover',function(event,pos,item){
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
                                if(tableId){
                                    var j = index.length;
                                    j = parseInt(index.substring(j-1,j));
                                    if(j != tableId){
                                        continue;
                                    }
                                }
                                graphs[index].unhighlight();
                            }
                            for(index in graphs){
                                if(tableId){
                                    var j = index.length;
                                    j = parseInt(index.substring(j-1,j));
                                    if(j != tableId){
                                        continue;
                                    }
                                }
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
                                    var m = side(index);
                                    index = index.substring(0,index.length-1);

                                    //var k = document.getElementById(index + 'Row' + m).getElementsByTagName('td')[0];
                                    // the text of the graph is the second child node of the row
                                    content += "<br/>" + label + ": " + data[currentIndex][1];
                                    if(equakeType) {
                                        content += "<br/>" + "Earthquake type: " + equakeType;
                                    }
                                }
                            }
                            Wovodat.showTooltip(pos.pageX, pos.pageY,content);
                        }
                    }else{
                        for(index in graphs){
                            if(tableId){
                                var j = index.length;
                                j = parseInt(index.substring(j-1,j));
                                if(j != tableId){
                                    continue;
                                }
                            }
                            graphs[index].unhighlight();
                        }
                        $("#tooltip").remove();
                        previousPoint = null;
                    }
                });
            }
*/
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

 /*           
            // draw overview graph
            function drawOverviewGraph(tableId){
                //setPrintButtonVisibility(tableId,true);
                if(!tableId) {
                    return; 
                }
                var placeholder= document.getElementById('overview' + tableId);
                placeholder.innerHTML = '';
                $(placeholder).show();
                var id;
                var data = [];
                
                // consider two case when we are in comparison view or in single view
                // get the correct id for the graph data, this is different with the graphs id
                for(id in graphs){
                    var j = id.length;
                    j = parseInt(id.substring(j-1,j));
                    if( j != tableId) continue;
                    else id = id.substring(0,id.length -1 );
                    data.push(graphData[id][0]);
                }
                
                var options = {
                    series: {
                        lines: { show: true},
                        shadowSize: 0
                    },
                    xaxis: { mode:'time'},
                    yaxis: { ticks: []}, // no tick for the yaxis
                    selection: { mode: "x", color: '#451A2B' }
                };
                $.plot(placeholder,data,options);
                *
                 * This section of code allow the user to see the updated version
                 * of every graph below the overview graph when user selecs a 
                 * portion of the overview graph.
                 *
                // clear previous handler
                $("#overview" + tableId).unbind('plotselected');
                // draw other main graphs when user select a portion of this graph
                $("#overview" + tableId).bind('plotselected',function(event,ranges){
                    var id;
                    var plot;
                    var options,data,placeholder,newOptions;
                    var to = ranges.xaxis.to;
                    var from = ranges.xaxis.from;
                    for(id in graphs){
                        if(tableId){
                            var j = id.length;
                            j = parseInt(id.substring(j-1,j));
                            if(j != tableId) continue;
                            else id = id.substring(0,id.length-1);
                        }
                        plot = graphs[id + tableId];
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
                            yaxis:{
                                ylabel: options.yaxis.ylabel,
                                panRange: options.yaxis.panRange,
                                zoomRange: options.yaxis.zoomRange,
                                max: maxY,
                                min: minY,
                                color: 'rgb(123,1,100)',
                                //labelWidth: 40,// in pixel
                                labelHeigth: 25,// in pixel
                                //tickDecimals:1
                            },
                            zoom:{
                                interactive: true
                            },
                            pan: {
                                interactive: true
                            }
                        }
                        newOptions.xaxis = options.xaxis;
                        newOptions.xaxis.max = to;
                        newOptions.xaxis.min = from;
                        if(tableId == '2')
                            graphs[id + tableId] = $.plot(placeholder,[data,eruptionsData.compEruptions],newOptions);
                        else
                            graphs[id + tableId] = $.plot(placeholder,[data,eruptionsData],newOptions);
                        Wovodat.redraw(graphs[id + tableId],graphData[id],detailedData[id],graphs,true);
                    }
                });
            }
 */           
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
            // make the graph moves together when user manipulate one graph
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
*/
            function deleteGraph(args){
                var id = args.id;
                var tableId = args.tableId;

                totalGraph[tableId]-=graphCount[tableId][id];
                graphCount[tableId][id]=0;

                if(tableId == undefined) tableId = "";
                delete(graphs[id + tableId]);
                var tr = document.getElementById(id +'Row'  + tableId);
                if(tr)
                    tr.parentNode.removeChild(tr);
                var hideOverview = true;
                for(id in graphs){
                    if(tableId){
                        var j = id.length;
                        j = parseInt(id.substring(j-1,j));
                        if(j!= tableId) continue;
                    }
                    hideOverview = false;
                    break;
                }
                if(hideOverview){
                    $("#overviewPanel" + tableId).css('display','none');
                    //setPrintButtonVisibility(tableId,false);
                }else{
                    drawOverviewGraph(tableId);
                }
            }
            
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

            function hideStation(tableId){
                var stationListName ;
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
                    if(input.checked) input.click();
                }
                //map[tableId].setZoom(7);
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
            console.log(obj);
            var ids = selectId;
            for (var j = 0; j < ids.length; j++) {
                selectId = ids[j];
                // a list of volcanos and their cavw separated by: ;
                var list = obj;
                // get the volcano select list tag
                var volcanos = document.getElementById(selectId);
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
            /*
             * Object to store the queried array of data for the 3D display
             */
            var gmt3DData = {};
            var gmt2DData = {};
            // store reference to the plotted graphs in the equake section
            // this variable will help us when we need to do the printing
            var equakeGraphs = [];
            // left graphs
            equakeGraphs[1] = {};
            // right graphs
            equakeGraphs[2] = {};
            $(document).ready(function(){
                /*
                 * Drop down the display equake panel
                 * Draw the Flot equake graph of current volcano if no display type is selected 
             
                 */
                $("#DisplayEquake1").click(function(){
                    $('#EquakePanel1').show();
                    $("#twoDEquakeFlotGraph1").hide();
                    $("#2DGMTEquakeGraph1").hide();
                    showHideEquakeButton(1);
                });
                $("#DisplayEquake2").click(function(){
                    $("#EquakePanel2").show();
                    $("#twoDEquakeFlotGraph2").hide();
                    $("#2DGMTEquakeGraph2").hide();
                    showHideEquakeButton(2);
                }); 
        
                /*
                 * Hide the entire earthquake panel when the x button is click
                 */
                $("#HideEquake1").click(function(){
                    hideEquakePanel({mapUsed:1});
                    var a = document.getElementById('showHideMarkers1');
                    if($(a).html() == "Hide earthquake"){
                        $(a).click();
                    }
                    $('#showHideMarkers1').hide();
                    uncheckAllEquakeButton(1);
                    return false;
                });
                $("#HideEquake2").click(function(){
                    hideEquakePanel({mapUsed:2});
                    var a = document.getElementById('showHideMarkers2');
                    if($(a).html() == "Hide earthquake"){
                        $(a).click();
                    }
                    $('#showHideMarkers2').hide();
                    uncheckAllEquakeButton(2);
                    return false;
                });
                
                // hide the earth quake map during initialization
                hideEquakePanel({mapUsed:1});
                hideEquakePanel({mapUsed:2});
                
                /*
                 * Javascript to handle button click of 2D, 2D using GMT and 3D using GMT
                 */
                $(".equakeDisplayBox1").click(function() {
                    $(".equakeDisplayBox1").closest("label").removeClass("equakeDisplayButtonChecked");
                    $(this).closest("label").addClass("equakeDisplayButtonChecked");
                });
                $(".equakeDisplayBox2").click(function() {
                    $(".equakeDisplayBox2").closest("label").removeClass("equakeDisplayButtonChecked");
                    $(this).closest("label").addClass("equakeDisplayButtonChecked");
                    
                });
                $("#3DGMTEquakeGraph1, #3DGMTEquakeGraph2").hide();
            
                //handle the Filter buttons
                $("#FilterBtn1").click(function(){
                    registerFilter({mapUsed:1});
                });
                $("#FilterBtn2").click(function(){
                    registerFilter({mapUsed:2});
                });
        
                // this function is trigger when the filter button is clicked.
                function registerFilter(o){
                    var mapUsed = o.mapUsed;
                    if (volcanoInfo[mapUsed]){
                        var cavw = volcanoInfo[mapUsed].cavw;
                        // depend on the graph that is shown when filter button
                        // is clicked, that graph will be redraw according to the the
                        // parameter set by filter value
                        if( document.getElementById('twoDEquakeFlotGraph' + mapUsed).style.display == 'block'){
                            // if the earthquakes list for for this volcano haven't been
                            // retrieved from the server, don't do anything
                            if(!earthquakes[cavw]){
                                return;
                            }

                            // // Filter data based on what filled in the filter
                            filterData(cavw,mapUsed);

                            // Draw Earthquake graph
                            drawEquake({mapUsed:mapUsed,source:document.getElementById('equakeDisplayType' + mapUsed + '2D')});
                        
                        }else if(document.getElementById('3DGMTEquakeGraph' + mapUsed).style.display == 'block'){
                            gmt3DData[cavw] = undefined;
                            drawEquake({mapUsed:mapUsed,
                                source:document.getElementById('equakeDisplayType' + mapUsed + '3D')
                            });
                        }else if(document.getElementById('2DGMTEquakeGraph' + mapUsed).style.display == 'block'){
                            gmt2DData[cavw] = undefined;
                            drawEquake({mapUsed:mapUsed,
                                source:document.getElementById('equakeDisplayType' + mapUsed + '2DGMT')
                            });
                        }else{
                            Wovodat.showNotification({message:'Please click to one of the buttons to retrieve the data.'});
                        }
                        //document.getElementById('FilterSwitch' + mapUsed).click();
                        document.getElementById('DepthLow' + o.mapUsed).scrollIntoView(true);
                    }
                }

                (function(list){
                    var l = list.length;
                    var i = 0;
                    for(i = 0 ; i < l ; i++){
                        $("#FilterSwitch" + list[i]).click([list[i]],function(e){
                            var j = e.data[0];
                            if ($("#FormFilter" + j).css("display")!="none"){
                                $("#FormFilter" + j).hide();
                                $("#FilterSwitch" + j).html("Show Filter");
                            }
                            else{
                                $("#FormFilter" + j).show();
                                $("#FilterSwitch" + j).html("Hide Filter");
                                if ($("#SDate" + j).val() =="" || $("#SDate" + j).val() =="undefined"){
                                    $("#SDate" + j).val("01/01/1900");
                                }
                                if ($("#EDate" + j).val() =="" || $("#EDate" + j).val() =="undefined"){
                                    var today = new Date();
                                    $("#EDate" + j).val($.datepicker.formatDate("m/d/yy",today));
                                }
                            }
                        });
                    }
                })([1,2]);

                (function(list){
                    var l = list.length;
                    var i = 0;
                    for(i = 0; i < l;  i++){
                        $("#showHideMarkers" + list[i]).click([list[i]],function(e){
                            var j = e.data[0];
                            hideMarkers({mapUsed:j,button:this});
                        });
                    }
                })([1,2]);         
            });

            function hideEquakePanel(o){
                $("#EquakePanel" + o.mapUsed).hide();
            }
            function hideEarthquakeMarkerButton(mapUsed){
                // parameter checking
                if(mapUsed == undefined || (mapUsed != 1 && mapUsed != 2))
                    return;
                var button = $("#showHideMarkers" + mapUsed);
                // if the button does not exist, return
                if(button == undefined)
                    return;
                button.css('display','none');
        
            }
            // show the button to hide/show earthquake markers in the graph
            // the function only show the button when we have any marker
            function showHideEquakeButton(mapUsed){
                var cavw = getCavw(mapUsed);
                if(cavw == undefined)
                    return;
                // parameter checking
                if(mapUsed == undefined || (mapUsed != 1 && mapUsed != 2))
                    return;
                var button = $("#showHideMarkers" + mapUsed);
                // if the button does not exist, return
                if(button == undefined)
                    return;
                // if the button is already shown, return
                if(button.css('display') == 'block')
                    return;
                // go through all the earthquakes available for the current vocano
                for (var i in earthquakes[cavw])
                    if (typeof earthquakes[cavw][i]['marker' + mapUsed] != "undefined"){
                        // if there is earthquakes that are shown for on the map, show the 
                        // button and return
                        if(earthquakes[cavw][i]['marker' + mapUsed].getMap() != null){
                            button.css('display','block');
                            return;
                        }
                }
            
                button.css('display','none');
            }
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
            function filterData(cavw,panelUsed){

                // data is not available for filtering
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
            function getSizeOfEquake(mag){
                // choose icon size base on magnitude of the equake event
                var size = Math.round(4+((mag)*2)/4);

                if (size<4) 
                    size = 4;
                if (size>14) 
                    size = 14;
                return size;
            }
            function getCssClassForEquakeMarker(){
                return "earthquakeTooltip";
            }
		/*
            function createMarker(equakeObj,mapUsed){
                var mag,depth,size,icon,lat,lon,marker,time;
                mag = equakeObj['mag'];
                depth = equakeObj['depth'];
                size = getSizeOfEquake(mag);
                icon = createMarkerIcon(depth,size);
                lat = equakeObj['lat'];
                lon = equakeObj['lon'];
                time = equakeObj['time'];
                // set marker
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(lat,lon),
                    icon:icon,
                    map: map[mapUsed]
                });
                var contentText = "<table><tr><td><b>Lat</b> </td><td>" + 
                    lat + "</td></tr><tr><td><b>Lon</b></td><td>" + 
                    lon + "</td></tr><tr><td><b>Time</b></td><td>" + 
                    time + "</td></tr><tr><td><b>Depth</b></td><td>" + 
                    depth + "</td></tr><tr><td><b>Magnitude</b></td><td>" 
                    + mag+"</td></tr></table>";
                // create tooltip
                new Tooltip({marker:marker,content:contentText,cssClass:"earthquakeTooltip"});
    
                return marker;
            }
		*/
            /*
             * Insert markers for earthquakes
             * This function will also show the marker of earthquake event in the
             * Google map of either mapUsed
             * Author: Tran Thien Nam
             * 2012-07-19
             */
			 /*
            function insertMarkersForEarthquakes(data,cavw,mapUsed){
                // the function will initialize the earthquake variable when 
                // there is no equake data stored at the client side for a
                // specific volcano.
                var catalogOwner = new Set();
                var eqTypeSet = new Set(); //vutuan added to store the cc_id of earthquakes
                
                if (!earthquakes[cavw]){
                    earthquakes[cavw]={};
                    // the latitude and longitude of the volcano that this earthquake surround
                    earthquakes[cavw]['vlat']=volcanoInfo[mapUsed]['lat'];
                    earthquakes[cavw]['vlon']=volcanoInfo[mapUsed]['lon'];
                    var equakeSet = {};
                    var vlat = volcanoInfo[mapUsed]['lat'];
                    var vlon = volcanoInfo[mapUsed]['lon'];
                    equakeSet = data.split(";");
                    // eliminate the empty elements at the end of the ajax data
                    while (equakeSet[equakeSet.length-1] == " ")
                        equakeSet.length--;

                    var index,nextQuake,lat,lon,depth,mag,time,type,id;

                    for (var i in equakeSet){
                        index = Wovodat.trim(equakeSet[i]);
                        nextQuake = index.split(",");
                        lat = nextQuake[0];
                        lon = nextQuake[1];
                        depth = nextQuake[2];
                        mag = nextQuake[3];
                        time = nextQuake[4];
                        type = nextQuake[5];
                        id = nextQuake[6]; // Catalog owner cc_id
                        
                        // ignore earthquakes that have no information on depth and/or magnitude
                        if (depth == "" || typeof depth=="undefined" || mag=="" || typeof mag=="undefined")
                            continue;

                        // ignore earthquakes that have no information on type and/or the owner
                        if (type == "" || typeof type=="undefined" || id=="" || typeof id=="undefined")
                            continue;

                        // //vutuan added
                        if(id != undefined && id != "")
                            catalogOwner.add(id);
                        if(type != undefined && type != "")
                            eqTypeSet.add(type);
                        // store the quake data in the earthquakes[cavw] object
                        earthquakes[cavw][index]=[];
                        earthquakes[cavw][index]['eqtype'] = type;
                        earthquakes[cavw][index]['lat']=lat;
                        earthquakes[cavw][index]['lon']=lon;
                        earthquakes[cavw][index]['time']=time;
                        earthquakes[cavw][index]['available'] = true;
                        earthquakes[cavw][index]['mag']=mag;
                        earthquakes[cavw][index]['depth']=depth;
                        earthquakes[cavw][index]['latDistance'] = Wovodat.calculateD(lat,lon,vlat,vlon,0);
                        earthquakes[cavw][index]['lonDistance'] = Wovodat.calculateD(lat,lon,vlat,vlon,1);
                        earthquakes[cavw][index]['timestamp'] = Wovodat.convertDate(time);
                        earthquakes[cavw][index]['cc_id'] = id; // add cc_id attribute to earthquakes object - vutuan
                    }
                    displayElement(catalogOwner,mapUsed,'cc_id');
                    displayElement(eqTypeSet,mapUsed,'EqType');
                    insertMarkersForEarthquakes(null,cavw,mapUsed);
                }
                else{
                    // if we already had the cached data, just display it in the specific 
                    // map
                    initializeFilter(earthquakes[cavw],mapUsed);
                    var marker,count = 1;
                    filterData(cavw,mapUsed);
                    var nEvent = $('#Evn' + mapUsed).val();

                    for (var i in earthquakes[cavw]){
                        if(count > nEvent) break;
                        if(earthquakes[cavw][i]!=undefined){
                            if (earthquakes[cavw][i]['available'] && filter(cavw,mapUsed,i)){
                                marker = createMarker(earthquakes[cavw][i],mapUsed);
                                earthquakes[cavw][i]['marker' + mapUsed] = marker;
                            }
                            else if(typeof earthquakes[cavw][i]['marker' + mapUsed] != "undefined"){
                                earthquakes[cavw][i]['marker' + mapUsed].setMap(null);
                            }
                        }
                        count++;   
                    }
                    var a = document.getElementById('showHideMarkers' + mapUsed);
                    $(a).unbind('click');
                    $(a).html("Hide earthquake");
                    $(a).click(function(){
                        hideMarkers({mapUsed:mapUsed,button:a}); 
                    });
                }   
            }
			*/
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
                            // console.log(1);
                            return false;
                        }
                    }
                }

                if(!type.checked){
                    var checkboxes = document.getElementsByName('EqType'+mapUsed);
                    for(var i = 0;i<checkboxes.length;i++){
                        if(!checkboxes[i].checked&&checkboxes[i].value == eqType){
                            // console.log(2);
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
            /*
                Author: Pham Vu Tuan
                This function will display all the cc_id and
                Eqtype mapping with the earthquakes in filter options
            */
            function nameConverter(value, element){
                switch(element){
                case 'cc_id': return ccMap.get(value);

                case 'EqType': return eqMap.get(value);
                }
            }
/*
            function displayElement(set,mapUsed,element){
                var html="";
                var tableName = element+mapUsed;
                var table = document.getElementById(tableName);
                var tableRows = table.getElementsByTagName('tr');
                var numberOfRows = tableRows.length;
                var i = 1;
                var tableId;
                if(element === 'cc_id') tableId = 1;
                else tableId = 2;
                set.forEach(function(value){
                    var checkBoxId = tableName + 'CheckBox' + i;
                    var row = table.insertRow(numberOfRows);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var clickString = "onClick='untoggle(this,"+tableId+","+mapUsed+")'";
                    cell1.innerHTML = "<input type='checkbox'"+ clickString +
                    " name='" + tableName +"' value='" + value + "' id='" + checkBoxId + "' checked/>";
                    cell2.innerHTML = nameConverter(value,element);
                    numberOfRows++;
                    i++;
                });
            }
		*/

            function removeElement(mapUsed,element){
                var table = document.getElementById(element+mapUsed);
                var tableRows = table.getElementsByTagName('tr');
                var numberOfRows = tableRows.length;
                while(numberOfRows > 1){
                    table.deleteRow(numberOfRows - 1);
                    numberOfRows--;
                }
            }

            function cachingElement(set,cavw,mapUsed,element){
                var table = document.getElementById(element+mapUsed);
                var tableRows = table.getElementsByTagName('tr');
                var numberOfRows = tableRows.length;
                var id;
                if(numberOfRows < 2){
                    for (var i in earthquakes[cavw]){
                        if(earthquakes[cavw][i]['available']){
                            if(element === 'EqType') id = earthquakes[cavw][i]['eqtype'];
                            else id = earthquakes[cavw][i]['cc_id'];
                            if(id != undefined && id != "")
                                set.add(id);
                        }
                    }
                    displayElement(set,mapUsed,element);
                }
            }         
/*			
            // set filter to avaiable data that we have, especially the start time and 
            // end time of all earthquake event
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
*/

            function calculateLatDistance(vlat, vlon, lat, lon){

                // Use 0    
            }

            function calculateLonDistance(vlat, vlon, lat, lon){

                // Use 1
            }

            // function to handle the color generation for earthquakes dot
            function generateColorCode(depth){
                if(depth > 20) depth = 20;
                var r,g,b;

                if(depth <= 10){
                    r = 255;
                    b = 0;
                }else{
                    r = 0;
                    depth = 20 - depth;
                    b = 255;
                }
                
                g = depth / 10.0 * 255;
                g = parseInt(g);
                return 'rgb(' + r + ',' + g + ',' + b + ')';
            }


            /*
             * Plot the equake data
             * The volcano to draw the earthquake data is determined using the cavw and
             * mapUsed parameter
             */
            function plotEarthquakeData(cavw, mapUsed){
                var numberOfEarthquakes = parseInt(document.getElementById('Evn' + mapUsed).value);
                var dHigh = parseFloat($("#DepthHigh"+mapUsed).val());
                var dLow = parseFloat($("#DepthLow"+mapUsed).val());
                var width = parseFloat($('#wkm' + mapUsed).val());
                // skip this function if we can not find the data to draw
                if(!earthquakes[cavw]) 
                    return;
        
                // skip this function if we can not find the side of the map
                if(!mapUsed)
                    return;
            
                // Test send request to get earthquakes
                //getEarthquakes(quantity, cavw, lat, lon, startDate, endDate, startDepth, endDepth, elev, width)
                //var object = getEarthquakes(20, "", "", "", "1980/08/09", "1999/09/08", "-10", "40", "", "60");
                

                filterData(cavw,mapUsed);
                // This is the height and width for the 
                // flot graph. Flot is for 2D javascript drawing

                var CONSTANTS = {
                    fontSize: '9px',
                    labelHeight: '70px',
                    labelWidth: '45px',
                    labelFontSize: '14px',
                    labelPaddingTop: '60px',
                    marginTop: '15px'
                };
          
        
                function drawMagnitude(ctx, x, y, radius, shadow, realRadius, color){
                    ctx.strokeStyle = color;
                    ctx.arc(x,y,realRadius,0,shadow ? Math.PI : Math.PI * 2);
                }

                // Options for drawing time view. 
                var timeOptions = {
                    series:{
                        points:{
                            show:true,
                            lineWidth: 0,
                            symbol: drawMagnitude,
                            fill: false
                        }
                    },
                    colors:["#3a4cb2"],
                    grid:{
                        // this option is for changing the color of the border
                        borderColor: "#9C9C9C",
                        clickable:true,
                        hoverable:true,
                        autoHighlight:true
                    },
                    yaxis:{
                        tickFormatter: kmFormatter,
                        tickSize: (dHigh - dLow)/5.0,
                        min: -dHigh,
                        max: -dLow
                        //labelWidth:40
                    },
                    xaxis:{position:"top", mode:"time",timeformat:"%d/%m/%y",ticks:4},
                    zoom:{ interactive: true},
                    pan: {interactive: true},
                    shadowSize: 0
                }

                // Arrays that store data for the 3 graphs that we are about to draw.
                var latArray = new Array(), lonArray = new Array(), timeArray = new Array();
                // The latitude and longitude of the volcano
                var time, latPlot, lonPlot, timePlot;
                
                // get the data for each earthquakes, put them into arrays for 
                // flot library to draw
                var counter = 0;
                var sizeOfEquakeDot, color, depth;
                for (var i in earthquakes[cavw]){
                    if(counter > numberOfEarthquakes) break;
                    // skip this value when there is no latitude or longitude value 
                    // for them
                    if(typeof lat == 'undefined' || typeof lon == 'undefined')
                        continue;
            
                    // skip this event when it is not supposed to be displayed
                    if(earthquakes[cavw][i]['available'] == 'undefined' || earthquakes[cavw][i]['available'] == false)
                        continue;
                    
                    if(!filter(cavw,mapUsed,i)){
                        continue;
                    }
                    // skip this event when it does not have the earthquake type required
                    // if(earthquakes[cavw][i]['eqtype'] != eqtype && eqtype != "")
                    //     continue;

                    // // skip this event when it does not have the catalog owner type required - vutuan added
                    // if(earthquakes[cavw][i]['cc_id'] != cc_id && cc_id != "")
                    //     continue;

                    // the timestampe of the event
                    time = earthquakes[cavw][i]['timestamp'];
                    if(time == undefined || isNaN(time)) 
                        continue;
                    // count the number of events to display
                    counter++;
                    sizeOfEquakeDot = parseFloat(earthquakes[cavw][i]['mag']);
                    if(sizeOfEquakeDot < 2) sizeOfEquakeDot = 2;
                    if(sizeOfEquakeDot > 6) sizeOfEquakeDot = 6;
                    sizeOfEquakeDot *= 1.2;
            
                    depth = parseFloat(earthquakes[cavw][i]['depth']);
                    latDistance = parseFloat(earthquakes[cavw][i]['latDistance']);
                    lotDistance = parseFloat(earthquakes[cavw][i]['lonDistance']);
                    color = generateColorCode(depth);

                    // set lat, lon coordination
                    // latArray.push([earthquakes[cavw][i]['latDistance'],-earthquakes[cavw][i]['depth'],,,,,sizeOfEquakeDot,color]);
                    latArray.push([latDistance,-depth,,,,,sizeOfEquakeDot,color]);
                    lonArray.push([lotDistance,-depth,,,,,sizeOfEquakeDot,color]);
            
                    // set time coordination
                    //if time is not convertible by javascript native functions
                    //then use own-created function
                    if(isNaN(time)){
                        time = earthquakes[cavw][i]['timestamp'];
                        time = new Date(time.substring(0,4),parseInt(time.substring(5,7))-1,time.substring(8,10),time.substring(11,13),time.substring(14,16),time.substring(17,19),0);
                        time = time.getTime();
                    }
            
                    timeArray.push([time,-depth,,,,,sizeOfEquakeDot,color]);
            
                }
                displayEvent(cavw,mapUsed);


                // prepare the data object for the plot functions
                latPlot = [{
                        data:latArray
                    }];
                lonPlot = [{
                        data:lonArray
                    }];
                timePlot = [{
                        data:timeArray
                    }];

                var minY = minYAxis(latArray);
                // Options for drawing lat-lon plot. Please refer to the documentation
                // of Flot to see the meaning of the each value
                var plotOptions = {
                    series:{
                        points:{
                            show: true,
                            lineWidth: 1,
                            symbol: drawMagnitude,
                            fill: false
                        }
                    },
                    grid:{
                        // this option is for changing the color of the border
                        borderColor: "#9C9C9C",
                        clickable:true,
                        hoverable:true,
                        autoHighlight:true
                    },
                    yaxis:{
                        tickFormatter : kmFormatter,
                        tickSize: (dHigh - dLow)/5.0,
                        min: -dHigh,
                        max: -dLow
                        //labelWidth: 40
                    },
                    xaxis:{
                        position:"top",
                        tickSize: width/5.0,
                        max: width,
                        min: -width,
                        tickFormatter : kmFormatter
                    },
                    zoom:{ interactive: true},
                    pan: {interactive: true},
                    shadowSize: 0
                };
                
                // draw the latitude map
                if(getSelectedEquakesButton(mapUsed) == 1)
                    $('#twoDEquakeFlotGraph' + mapUsed).show();
                var latitudePlotArea = document.getElementById("FlotDisplayLat"+mapUsed);
        
                equakeGraphs[mapUsed].latGraph = $.plot(latitudePlotArea,latPlot,plotOptions);
            

                //Just modified here
                Wovodat.enableTooltip({type:'single',
                    id:"FlotDisplayLat"+mapUsed,
                    firstValueFront:'Distance from volcano',
                    firstValueBack:'km',
                    secondValueFront:'Depth',
                    secondValueBack:'km'
                });
                // draw the longitude map
                var longitudePlotArea =$("#FlotDisplayLon"+mapUsed);
                equakeGraphs[mapUsed].lonGraph = $.plot(longitudePlotArea,lonPlot,plotOptions);
                Wovodat.enableTooltip({type:'single',
                    id:"FlotDisplayLon"+mapUsed,
                    firstValueFront:'Distance from volcano',
                    firstValueBack:'km',
                    secondValueFront:'Depth',
                    secondValueBack:'km'
                });
                // draw the time series map        
                var timePlotArea =$("#FlotDisplayTime"+mapUsed);
                equakeGraphs[mapUsed].timeGraph = $.plot(timePlotArea,timePlot,timeOptions);
                Wovodat.enableTooltip({type:'single',id:"FlotDisplayTime"+mapUsed,
                    firstValueFront:'Time',
                    firstValueBack:'UTC',
                    secondValueFront:'Depth',
                    secondValueBack:'km',
                    xValueType: 'time'
                });
                
                // adjust the flot label for all the graph ('E-W','N-S','Time')
                $('.plot-label').css({
                    'float': 'right',
                    'display': 'block-inline',
                    'height': CONSTANTS.labelHeight,
                    'width': CONSTANTS.labelWidth,
                    'font-size': CONSTANTS.labelFontSize,
                    'vertical-align': 'middle',
                    'padding-top': CONSTANTS.labelPaddingTop
                });
                showHideEquakeButton(mapUsed);       
            }

            /* Get earthquakes from server */
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

            /*
             * hide all the markers when user closes the Earthquakes panel section
             * This function is accomplished by setting the map of each pointer
             * to null value
             */
			 /*
            function hideMarkers(o){
                var mapUsed = o.mapUsed;
                if(volcanoInfo[mapUsed] == undefined) return;
                var cavw = volcanoInfo[mapUsed].cavw;
                var currentEquakeSet = [];
                for (var i in earthquakes[cavw])
                    if (typeof earthquakes[cavw][i]['marker' + mapUsed] != "undefined"){
                        if(earthquakes[cavw][i]['marker' + mapUsed].getMap() != null){
                            currentEquakeSet.push(earthquakes[cavw][i]['marker' + mapUsed]);
                            earthquakes[cavw][i]['marker' + mapUsed].setMap(null);
                        }
                }
                var button = o.button;
                $(button).unbind('click');
                $(button).html("Show earthquake");
                $(button).click(function(){
                    _showMarkers(this);
                });
                function _showMarkers(o){
                    $(o).html('Hide earthquake');
                    var l = currentEquakeSet.length;
                    for(var i = 0 ; i < l ; i++){
                        currentEquakeSet[i].setMap(map[mapUsed]);
                    }
                    $(o).unbind('click');
                    $(o).click(function(){
                        _hideMarkers(o);
                    });
                }
                function _hideMarkers(o){
                    $(o).html('Show earthquake');
                    var l = currentEquakeSet.length;
                    for(var i = 0 ; i < l ; i++){
                        currentEquakeSet[i].setMap(null);
                    }
                    $(o).unbind('click');
                    $(o).click(function(){
                        _showMarkers(o);
                    });
                }
            }
			*/
            /*
             * Function to format the X-axis for Latitude and Longtitude axises
             * This function will set axis.tickDecimals number after the '.' and
             * append the ' km' part to each tick label.
             */
            function kmFormatter(v, axis){
                return v.toFixed(axis.tickDecimals) + " km";
            }
            
            /*
             * Author : Pham Vu Tuan
             * Function to compute the number of earthquake events of a volcano
             */
            function computeEquakeEvents(cavw,mapUsed){
                var count = 0;
                for(var i in earthquakes[cavw]){
                    // skip this value when there is no latitude or longitude value 
                    // for them
                    if(typeof lat == 'undefined' || typeof lon == 'undefined'){
                        continue;
                    }
            
                    // skip this event when it is not supposed to be displayed
                    if(earthquakes[cavw][i]['available'] == 'undefined' || earthquakes[cavw][i]['available'] == false){
                        continue;
                    }
                    
                    if(!filter(cavw,mapUsed,i)){
                        continue;
                    }
                    count++;
                }
                return count;
            }

            function displayEvent(cavw,mapUsed){
                // vutuan added to display info of earthquake events.
                var nEvent = $('#Evn'+mapUsed).val();
                var actualEvent = computeEquakeEvents(cavw,mapUsed);
                if(parseInt(nEvent) > parseInt(actualEvent)){
                    document.getElementById("eqEvent" + mapUsed).innerHTML 
                    = 'Earthquake events: ' + actualEvent + ' of ' + actualEvent;
                }else{
                    document.getElementById("eqEvent" + mapUsed).innerHTML 
                    = 'Earthquake events: ' + nEvent + ' of ' + actualEvent;
                }
            }
    
            /*
             * Draw the equake graphs under the equake panels
             */
			 /*
            function drawEquake(o){


                hideMarkers(o);

                var source = o.source;
                var id = source.id;
                $("#twoDEquakeFlotGraph" + o.mapUsed).hide();
                $("#2DGMTEquakeGraph" + o.mapUsed).hide();
                $("#3DGMTEquakeGraph" + o.mapUsed).hide();


                if(id.indexOf('3D') >0)
                    drawEquake3DGMT(o);
                else if(id.indexOf('2DGMT') >0)
                    drawEquake2DGMT(o);
                else drawEquake2D(o);
                map[o.mapUsed].setZoom(10);
                map[o.mapUsed].setCenter(map[o.mapUsed].centerPoint);
            }
			*/
            /*
             * Help function to draw equake in 2 dimensions using Flot
             */
			 /*
            function drawEquake2D(o){
                var cavw = volcanoInfo[o.mapUsed].cavw;
                var mapUsed = o.mapUsed;
                if (!earthquakes[cavw]){
                    Wovodat.loadEarthquakes({
                        numberOfEvents: $("#Evn"+mapUsed).val(),
                        mapUsed: mapUsed,
                        volInfo: volcanoInfo[mapUsed],
                        handlers: [insertMarkersForEarthquakes,plotEarthquakeData]
                    });
                }
                else{
                    insertMarkersForEarthquakes("",cavw,mapUsed);
                    plotEarthquakeData(cavw,mapUsed);
                }  
            }
*/

            function uncheckAllEquakeButton(mapUsed){
                function removeClassName(element){
                    if(element == null)
                        return;
                    var parent = element.parentNode;
                    if(parent == null)
                        return;
                    parent.className = parent.className.replace('equakeDisplayButtonChecked','');
                }
                var element;
                var ids = ["2D","2DGMT","3D"];
                var length = ids.length;
                var i = 0;
                for(i = 0 ; i < length; i++){
                    ids[i] = "equakeDisplayType" + mapUsed + ids[i];
                }
                for(i = 0 ; i < length; i++){
                    element = document.getElementById(ids[i]);
                    if(element == null) continue;
                    removeClassName(element);
                }
        
            }
            /*
             * Get the current selected button in the list of button for earth quakes
             * 1: 2D
             * 2: 2DGMT
             * 3: 3DGMT
             * 4: No button is selected
             */
			 /*
            function getSelectedEquakesButton(mapUsed){
                var tempElement = document.getElementById('EquakePanel' + mapUsed);
                if(tempElement == undefined) return;
                tempElement = $(".equakeButtonsRow",tempElement);
                if(tempElement == undefined) return;
                tempElement = tempElement[0];
                if(tempElement == undefined) return;
                tempElement = $("label",tempElement);
                if(tempElement == undefined) return;
                var tempElements = tempElement;
                var i = 0, length = tempElements.length;
                var className;
                for(i = 0 ; i < length; i++){
                    tempElement = tempElements[i];
                    className = tempElement.className;
                    if(className.match(/equakeDisplayButtonChecked/))
                        break;
                }
                return i + 1;
            }
			*/
            /*
             * Draw the earthquakes around the volcano displayed in the
             * map in two dimensions. This function is using GMT to draw the map in case
             * the user don't have access to googel map
             */
			 /*
            function drawEquake2DGMT(o){
                var mapUsed = o.mapUsed;
        
                var cavw = volcanoInfo[mapUsed].cavw;
                var volName = volcanoInfo[mapUsed].volName;                  //Nang added   
                var vlat = volcanoInfo[mapUsed].lat;                         //Nang added
                var vlon = volcanoInfo[mapUsed].lon;                         //Nang added               

                var id = o.source.id;
                var placeholder = document.getElementById('2DGMTEquakeGraph' + mapUsed);   
 
                if(gmt2DData[cavw] == undefined){
                    Wovodat.get2DGMTMap({
                        cavw: cavw,
                        qty: document.getElementById('Evn' + mapUsed).value,
                        date_start: document.getElementById('SDate' + mapUsed).value,
                        date_end: document.getElementById('EDate' + mapUsed).value,
                        dr_start: document.getElementById('DepthLow' + mapUsed).value,
                        dr_end: document.getElementById('DepthHigh' + mapUsed).value,
                        eqtype: document.getElementById('EqType' + mapUsed).value,
                        wkm: document.getElementById('wkm' + mapUsed).value,   // Nang added
                        vname:volName,                         // Nang added
                        vlat:vlat,                             //Nang added
                        vlon:vlon,                             //Nang added                 
                        //Only 3D GMT needs these two degree & init_azim.               
                        //  degree: document.getElementById('degree' + mapUsed).value, 
                        //  init_azim: document.getElementById('azim' + mapUsed).value,         

                        handler: function(ar){
                            gmt2DData[cavw] = ar; 
                            show2DGMT(ar);
                        }
                    });
                
                }else{
                    show2DGMT(gmt2DData[cavw]);
                }
                function show2DGMT(ar){
                    var directory = ar['directory'];
                    $("#imageLink",placeholder).attr('href',directory + "/" + ar['imageSrc']);
                    $("#image",placeholder).attr('src',directory + "/" + ar['imageSrc']);
                    $("#gifImage",placeholder).attr('href',directory + "/" + ar['imageSrc']);
                    $("#gmtScriptFile",placeholder).attr('href',ar['gmtScriptFile']);
                    if(getSelectedEquakesButton(mapUsed) == 2)
                        placeholder.style.display = 'block';
                }
                if (!earthquakes[cavw]){
                    Wovodat.loadEarthquakes({
                        numberOfEvents: document.getElementById('Evn' + mapUsed).value,
                        mapUsed: o.mapUsed,
                        volInfo: volcanoInfo[o.mapUsed],
                        handlers: [insertMarkersForEarthquakes]
                    });
                }
                else{
                    insertMarkersForEarthquakes("",cavw,o.mapUsed);
                }
            }
			*/
            
            /*
             * Draw the earthquakes around the volcano displayed in the
             * map in three dimensions. This function is using GMT to draw the map in case
             * the user don't have access to googel map.
             * 
             */
			 /*
            function drawEquake3DGMT(o){
                var mapUsed = o.mapUsed;
                var cavw = volcanoInfo[mapUsed].cavw;
        
                var volName = volcanoInfo[mapUsed].volName;         //Nang added 
                var vlat = volcanoInfo[mapUsed].lat;                //Nang added
                var vlon = volcanoInfo[mapUsed].lon;                //Nang added                
        
                if(gmt3DData[cavw] == undefined){
                    Wovodat.get3DMap({
                        cavw: cavw,
                        qty: document.getElementById('Evn' + mapUsed).value,                    
                        date_start: document.getElementById('SDate' + mapUsed).value,
                        date_end: document.getElementById('EDate' + mapUsed).value,
                        dr_start: document.getElementById('DepthLow' + mapUsed).value,
                        dr_end: document.getElementById('DepthHigh' + mapUsed).value,
                        eqtype: document.getElementById('EqType' + mapUsed).value,
                        wkm: document.getElementById('wkm' + mapUsed).value,   // Nang added    
                        vname:volName,                // Nang added
                        vlat:vlat,                    //Nang added
                        vlon:vlon,                    //Nang added                                  
                        degree: document.getElementById('degree' + mapUsed).value,
                        init_azim: document.getElementById('azim' + mapUsed).value,
                        handler: function(ar){
                            gmt3DData[cavw] = ar; 
                            show3DGMT(ar);
                        }
                    });
                }else{
                    show3DGMT(gmt3DData[cavw]);
                }
                *
                 * Private function to help putting the 3D images and information
                 * on the equake panel
                 * This function will set the image , add the function for the 
                 *
                function show3DGMT(ar){
                    function padding(value){
                        value = value + "";
                        var l = value.length;
                        l = 6 - l;
                        while(l > 0){
                            value = "0" + value;
                            l--;
                        }
                        return "/frame_" + value + ".jpg";
                    }
                    var placeholder = $('#3DGMTEquakeGraph' + mapUsed);
                    var numberOfImages = ar['numberOfImages'];
                    var imageLink = ar['directory'] + '/frame_000000.jpg';
                    var currentLink = 0;
                    $("#3DImage #title",placeholder).html(ar['title']);
                    $("#3DImage #image",placeholder).attr('src',imageLink);
                    $("#3DImage #imageLink",placeholder).attr('href',imageLink);
                    
                    // clear previous registered handlers
                    $("#showAnimation",placeholder).unbind('click');
                    $("#previousButton",placeholder).unbind('click');
                    $("#nextButton",placeholder).unbind('click');
                    
                    // add handlers for navigation button
                    $("#showAnimation",placeholder).click(function(){
                        $("#3DImage #image",placeholder).attr('src',ar['animationImage']);
                        $("#3DImage #imageLink",placeholder).attr('href',ar['animationImage']);
                    });
                    $("#previousButton",placeholder).click(function(){
                        currentLink = (currentLink - 1 + numberOfImages) % numberOfImages;
                        $("#3DImage #image",placeholder).attr('src',ar['directory'] + padding(currentLink));
                        $("#3DImage #imageLink",placeholder).attr('href',ar['directory'] + padding(currentLink));
                    });
                    $("#nextButton",placeholder).click(function(){
                        currentLink = (currentLink + 1 + numberOfImages) % numberOfImages;
                        $("#3DImage #image",placeholder).attr('src',ar['directory'] + padding(currentLink));
                        $("#3DImage #imageLink",placeholder).attr('href',ar['directory'] + padding(currentLink));
                    });
                    
                    
                    $("#gifImage",placeholder).attr('href',ar['animationImage']);
                    $("#gmtScriptFile",placeholder).attr('href',ar['gmtScriptFile']);
                    if(getSelectedEquakesButton(mapUsed) == 3)
                        placeholder.show();
                }
                if (!earthquakes[cavw]){
                    Wovodat.loadEarthquakes({
                        numberOfEvents: document.getElementById('Evn' + mapUsed).value,
                        mapUsed: o.mapUsed,
                        volInfo: volcanoInfo[o.mapUsed],
                        handlers: [insertMarkersForEarthquakes]
                    });
                }
                else{
                    insertMarkersForEarthquakes("",cavw,o.mapUsed);
                }
            }
			*/
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
             */
            function clearEquakedrawingData(o){
                var mapUsed = o.mapUsed;
                var placeholder = $("#equakeGraphs" + mapUsed);
                var tmp = $("#twoDEquakeFlotGraph" + mapUsed,placeholder)
                tmp.hide();
                $("#FlotDisplayLat" + mapUsed).html('');
                $("#FlotDisplayLon" + mapUsed).html('');
                $("#FlotDisplayTime" + mapUsed).html('');
                tmp = $("#2DGMTEquakeGraph" + mapUsed,placeholder);
                tmp.hide()
                $("#imageLink",tmp).attr('href','');
                $("#image",tmp).attr('src','');
                $("#gifImage",tmp).attr('href','');
                $("#gmtScriptFile",tmp).attr('href','');
                tmp = $("#3DGMTEquakeGraph" + mapUsed,placeholder);
                tmp.hide()
                $("#imageLink",tmp).attr('href','');
                $("#image",tmp).attr('src','');
                $("#gifImage",tmp).attr('href','');
                $("#gmtScriptFile",tmp).attr('href','');
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


                // show/hide the time series panel
                (function(list){
                    var l = list.length;
                    var i = 0;
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
            
  
