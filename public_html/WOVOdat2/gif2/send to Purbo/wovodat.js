/*
 * wovodat.js
 * wovodat javascript library
 * author: Van Duy Tuan
 * Created date: 11/6/2012
*/

/*
 * Wovodat javascript object
*/

function Wovodat(){
    
}

Wovodat.THREE_HOURS = 10800000;
Wovodat.ONE_MONTH = 2592000000;
Wovodat.ONE_WEEK = 604800000;

/*
 * Create the trim function for the every string object.
 */
Wovodat.trim = function(text){
    return text.replace(/^\s+|\s+$/g,"");
};

/*
 * Get the domain name. Return format is: http://<domain name>
 * No directory name will be appended.
 */
Wovodat.getDomain = function (){
    var location = window.location.toString();
    var domain;
    var protocol = "http://";
    var i,j;
    location = Wovodat.trim(location);
    if(location.length <= protocol.length){
        throw "Invalid domain";
    }
    i = location.indexOf(protocol);
    if(i != 0)
        throw "This is not a Domain";
    i = i + protocol.length;
    j = location.indexOf("/",i);
    if(j == -1) {
        domain = location;
    }else{
        domain = location.substring(0,j);
    }
    return domain;
};
/*
 * This function is to make sure that wovodat javascript file is properly
 * included
 */
Wovodat.displayLibraryMessage = function (){
    return "The wovodat javascript library is properly included";
};
/*
 * Redirect to link location
 */
Wovodat.redirectPage = function(link){
    window.location = link;
};

/*
 * Get the list of all available volcanoes using ajax
 */
Wovodat.getVolcanoList = function(func,selectId){
    $.ajax({
        method: "get", 
        url: "/php/switch.php",
        data: "get=VolcanoList",
        success: function(html){
            func({
                list:html
            },selectId);
        }
    });
};
/*
 * Get the eruption list of the current volcanos
 */
Wovodat.getEruptionList = function(args){
    var volcano = args.volcano;
    var handler = args.handler;
    var selectId = args.selectId;
    volcano = volcano.split("&");
    var cavw = volcano[1];
    $.ajax({
        method: "get", 
        url: "/php/switch.php",
        data: "get=EruptionList&cavw="+cavw,
        success: function(html){
            handler({
                list:html,
                volcano:volcano
            },selectId);
        }
    });
};

/*
 * Get latitude and longitude of a volcano
 */
Wovodat.getLatLon = function(args, volcId, mapId){
    var cavw = args.cavw;
    var handler = args.handler;
    var mapUsed = args.mapUsed;
    $.ajax({
        method: "get", 
        url: "/php/switch.php",
        data: "get=LatLon&cavw="+cavw,
        success: function(html){
            html = html.split(";");
            handler({
                lat:html[0],
                lon:html[1],
                elev:html[2]
            },volcId, mapId,mapUsed);
        }
    });
};

/*
 * Get available stations for a specific volcano
 * 
 */
Wovodat.getAvailableStations = function (args){
    var cavw = args.cavw;
    var handler = args.handler;
    var tableId = args.tableId;
    $.ajax({
        method: "get", 
        url: "/php/switch.php",
        data: "get=AvailableStations&cavw="+cavw,
        success: function(html){
            html = html.split(";");
            if(html[html.length - 1] == "")
                html.length--;
            handler({
                list:html,
                volcano:args.volcano
            });
        }
    });
};

/*
 * Get latitude and longitude of a volcano
 */
Wovodat.getLatLon = function(args, volcId, mapId, mapUsed){
    var cavw = args.cavw;
    var handler = args.handler;
    var mapUsed = args.mapUsed;
    $.ajax({
        method: "get", 
        url: "/php/switch.php",
        data: "get=LatLon&cavw="+cavw,
        success: function(html){
            html = html.split(";");
            handler({
                lat:html[0],
                lon:html[1],
                elev:html[2]
            },volcId, mapId,mapUsed);
        }
    });
};

/*
 * Get list of available stations for a specific volcano (time-series view)
 * 
 */
Wovodat.getStationsWithDataList = function (args){
    var cavw = args.cavw;
    var handler = args.handler;
    var tableId = args.tableId;
    $.ajax({
        method: "get", 
        url: "/php/switch.php",
        data: "get=StationsWithDataList&cavw="+cavw,
        success: function(html){
            html = html.split(";");
            if(html[html.length - 1] == "")
                html.length--;
            handler({
                list:html
            },tableId);
        }
    });
};
/*
 * Get available stations for a specific type of a specific volcano 
 */

Wovodat.getStations = function(args){
    var cavw = args.cavw;
    var handler = args.handler;
    var type=args.type;
	var stationsDatabaseUsed = args.stationsDatabaseUsed;
    $.ajax({
        method: "get", 
        url: "/php/switch.php",
        data: "get=Stations&cavw="+cavw + "&type=" + type,
        success: function(html){
            var args = {
                data: html,
                type: type,
                action: 'updateNewData'
            };
            handler(args, stationsDatabaseUsed,1);
        }
    });
};

/*
 * Get data for a specific station
 */

Wovodat.getStationData = function(args){
    var type=args.type;
    var table = args.table;
    var code = args.code;
    var component = args.component;
    var referenceData = 1480608000000;
    var handler = args.handler;
    $.ajax({
        method:"get",
        url: "/php/switch.php",
        data: "get=StationData&type=" + type.toLowerCase() + "&table=" + table 
        +"&code="+code + "&component=" + component + "&ref=" + referenceData,
        dataType: "json",
        success: function(html){
            if(handler != undefined)
                handler({
                    data: html,
                    id: type + "&" + table + "&" + code + "&" + component
                });
        }
    });
};
Wovodat.getCcUrl = function(panelUsed, cavw){
    $.ajax({
        method:"get",
        url: "/php/switch.php",
        data:"get=getCcUrl&cavw=" + cavw,
        success:function(html){
            var owner = $("#dataOwner"+panelUsed);
            var vstatus = $("#volcstatus"+panelUsed);
            var list = html.split(";");
            var status = list[1];
            var ccUrl = list[0];
            if (ccUrl!=""){
                owner.attr("href",ccUrl);
                owner.html("("+ccUrl+")");
            }
            if (status!=""){
                vstatus.html(status);
            }
        }
    });
}
/*get list of neighbors of a volcano
*Author: Tran Thien Nam
*2012-07-26
*/
Wovodat.getNeighbors=function(cavw, panelUsed, handler){
    $.ajax({
        method:"get",
        url:"/php/switch.php",
        data:"get=getNeighbors&cavw="+cavw,
        success:function(html){
			list = html.split("&");
			handler(cavw,list,panelUsed);
        }
    });
}
/*
 * get the javascript date object when user pass in a string of type
 * YYYY-MM-DD HH:II:SS UTC
 */
Wovodat.toDate = function(date){
    // for example 2007-09-12 17:21:01 UTC
    var temp = date.split(" ");
    var year = temp[0].split("-");
    var hours = temp[1].split(":");
    var d = new Date();
    for(var i = 0 ; i < 3 ; i++){
        while(true){
            if(year[i][0] == '0' && year[i].length > 1)
                year[i] = year[i].substr(1);
            else 
                break;
        }
        while(true){
            if(hours[i][0] == '0' && hours[i].length > 1)
                hours[i] = hours[i].substr(1);
            else
                break;
        }
        year[i] = parseInt(year[i]);
        hours[i] = parseInt(hours[i]);
    }
    if(year[1] != 0)
        year[1] = year[1] - 1;
    if(year[2] == 0)
        year[2] = 1;
    d.setUTCFullYear(year[0], year[1], year[2]);
    d.setUTCHours(hours[0], hours[1], hours[2], 0);
    return d;
}

/*
 * Show the tooltip when the mouse is hovering over a point in the graph
 * 
 */

Wovodat.showTooltip = function (x, y, contents) {
    $('<div id="tooltip">' + contents + '</div>').css( {
        position: 'absolute',
        display: 'none',
        top: y,
        left: x + 15,
        border: '1px solid #fdd',
        padding: '2px',
        'background-color': '#fee',
        opacity: 0.9
    }).appendTo("body").fadeIn(200);
}

/*
 * show processing bar when the script is making ajax call to server
 */
var busy_counter=0;
Wovodat.showProcessingIcon = function(icon){
    // show the loading icon when ajax is executing
    icon.ajaxSend(function(){
        busy_counter+=1;
        // alert("increase:"+busy_counter);
        if (busy_counter>=1)
            $(this).show();
    });
    // hide the loading icon when ajax is completed
    icon.ajaxComplete(function(){
        if (busy_counter>0){
            busy_counter-=1;
            // alert("decrease:"+busy_counter);
            if (busy_counter==0)
                $(this).hide();
        }
    });
}

/* l
*load the earthquake and display it in the respective map
*author: Tran Thien Nam
* 2012-07-19
qty: limit number of earthquake events loaded
panelUsed: 1 (for the left panel) or 2(for the right panel)
volInfo: all Information of the volcano: cavw, lat, lon, elev
*/
Wovodat.loadEarthquakes = function(qty,panelUsed,volInfo,handler,handler1){
    $.ajax({
        method: "get",
        url: "/php/switch.php",
        data: "get=Earthquakes&qty="+qty+"&cavw="+volInfo.cavw+"&lat="+volInfo.lat+"&lon="+volInfo.lon+"&elev="+volInfo.elev,
        success:function(html){
            handler(html,volInfo.cavw,panelUsed);
            handler1(volInfo.cavw,"",panelUsed);
            $("#FlotEqOption"+panelUsed).show();
            $("#FlotDisplay"+panelUsed).show();
            var flotEqOption = document.getElementById("FlotEqType"+panelUsed);
            flotEqOption.title = volInfo.cavw;
            flotEqOption.options.length = 0;
            flotEqOption.options[flotEqOption.length] = new Option("Show All", "Show All");
            flotEqOption.options[flotEqOption.length] = new Option("Hide All", "Hide All");
            flotEqOption.options[flotEqOption.length] = new Option("Unknown type", "");
            var eqtypes = new Array();
            if (earthquakes[volInfo.cavw]['eqtypes']){
                // alert(earthquakes[volInfo.cavw]['eqtypes'].length);
                for (var j in earthquakes[volInfo.cavw]['eqtypes']){
                    var type = earthquakes[volInfo.cavw]['eqtypes'][j];
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
};
/*
 * Return data may contain many range taht does not have the available data
 * The code needs to identify that region.
 * data is in the format: [[[x1,y1],[x2,y3],[x3,y3]]]
 */
Wovodat.highlightNoDataRange = function(data){
    var ONE_MONTH = 31 * 24 * 3600 * 1000; // (MILLISECONDS)
    var ONE_DAY = ONE_MONTH / 30; // (MILLISECONDS)
    data = data[0];
    var length = data.length;
    var interval = ONE_DAY;
    var distance;
    var newData = [];
    var index;
    index = 0;
    newData.push(data[index++]);
    for(; index < length ; index++){
        distance = data[index-1][0] - data[index][0];
        // the difference between two data must be more than one day time and 
        // either 5 times larger than the previous difference or larger than one month
        if(distance > ONE_DAY && (distance > 5 * interval || distance > ONE_MONTH)){
            newData.push([data[index - 1][0] - distance / 2,null]);
        }
        newData.push(data[index]);
        interval = distance;
    }
    return [newData];
};
/*
 * data is passed in the from: [[x1,y1],[x2,y2],[x3,y3],....,[xn,yn]]
 * x1 > x2 > x3 > ... > xn
 * from < to
 * this function will return the smallest i that xi <= from and 
 * largest j that xj >= to in the format {min:i,max:j}
 * if 
 */
Wovodat.getIndexRange = function(data,from,to){
    // using binary search to search for the position of 'from'
    var start, end, length, mid, temp, maxIndex, minIndex;
    length = data.length;
    start = length - 1;
    end = 0;
    mid = Math.floor((start + end) / 2);
    while(start > end + 1){
        temp = data[mid][0];
        if(from > temp){
            start = mid;
        }else if( from < temp){
            end = mid;
        }else{
            start = mid + 1;
            break;
        }
        mid = Math.floor((start + end) / 2);
    }
    minIndex = start;
    start = length - 1;
    end = 0;
    mid = Math.floor((start + end) / 2);
    while(start > end + 1){
        temp = data[mid][0];
        if(to > temp){
            start = mid;
        }else if( to < temp){
            end = mid;
        }else{
            end = mid - 1;
            break;
        }
        mid = Math.floor((start + end) / 2);
    }
    maxIndex = end;
    return {
        min:minIndex,
        max:maxIndex
    };
}
/*
 * This function returns the maximum and minimun value of the array of data 
 * in the range: [from,to]
 */
Wovodat.getLocalMaxMin = function(data,from,to){
    var o = Wovodat.getIndexRange(data,from,to);
    var i = o.min;
    
    var maxIndex = o.max;
    var min,max;
    while(data[i][1] == null && i >= maxIndex){
        i--;
    }
    if(i < maxIndex) return {
        max:null,
        min:null
    };
    min = data[i][1];
    max = min;
    for(;i>=maxIndex;i--){
        if(data[i][1] == null) continue;
        if(data[i][1] > max) max = data[i][1];
        if(data[i][1] < min) min = data[i][1];
    }
    return {
        max:max,
        min:min
    };
}

/*
 * This function will update the internal data of a graph, make more efficient
 * in displaying the graphs.
 */
Wovodat.redraw = function(plot,generalData,detailedData,graphs,rescale){
    if( detailedData == undefined) detailedData = [generalData[0],generalData[0]];
    var o = Wovodat.getDrawRange(plot);
    var duration = o.max - o.min;
    var zoomLevel = -1;
    var plottingData;
    if(duration < Wovodat.ONE_WEEK){
        zoomLevel = 3;
        plottingData = detailedData[0];
    }else if(duration < Wovodat.ONE_MONTH){
        zoomLevel = 2;
        plottingData = detailedData[1];
    }else{
        zoomLevel = 1;
        plottingData = generalData[0];
    }
    if(plot.zoomLevel != undefined && plot.zoomLevel == zoomLevel){
        // all about the preparedMax, preparedMin
        if(plot.preparedMax - o.max < duration / 2 || o.min - plot.preparedMin < duration / 2){
            plot.preparedMax = o.max + duration;
            plot.preparedMin = o.min - duration;
            Wovodat.updateGraph(plot,graphs,plottingData);
        }else{
            if(rescale != null && rescale == true){
                Wovodat.updateGraph(plot,graphs,plottingData);
            }
        } 
    }else{
        // change the internal data of the graph according to the current zoom level
        // and change the preparedMax, preparedMin
        plot.zoomLevel = zoomLevel;
        plot.preparedMax = o.max + 4 * duration;
        plot.preparedMin = o.min - 4 * duration;
        Wovodat.updateGraph(plot,graphs,plottingData);
    }
}

Wovodat.updateGraph = function(plot,graphs,plotData){
    var placeholder = plot.getPlaceholder();
    var zoomLevel = plot.zoomLevel;
    var id = placeholder.attr('id');
    var i = id.indexOf('Graph');
    id = id.substring(0,i);
    var data = plot.getData();
    var drawRange = Wovodat.getDrawRange(plot);
    var maxMin = Wovodat.getLocalMaxMin(plotData,drawRange.min,drawRange.max);
    var options = plot.getOptions();
    var preparedMax = plot.preparedMax;
    var preparedMin = plot.preparedMin;
    var indexRange = Wovodat.getIndexRange(plotData,preparedMin,preparedMax);
    data[0].data = plotData.slice(indexRange.max,indexRange.min + 1);
    options.yaxes[0].max = maxMin.max;
    options.yaxes[0].min = maxMin.min;
    graphs[id] = $.plot(placeholder,data,options);
    graphs[id].preparedMax = preparedMax;
    graphs[id].preparedMin = preparedMin;
    graphs[id].zoomLevel = zoomLevel;
}
/*
 * 
 */
Wovodat.getDrawRange = function(plot){
    var axes = plot.getAxes();
    var xaxis = axes.xaxis;
    return {
        max:xaxis.max,
        min:xaxis.min
    };
}

/*
 * This function is for getting the detailed data
 */

Wovodat.getDetailedStationData = function(o){
    var id = o.id;
    id = id.split('&');
    var type = id[0];
    var table = id[1];
    var code = id[2];
    var component = id[3];
    var handler = o.handler;
    var referenceTime = o.referenceTime;
    $.ajax({
        method:"get",
        url: "/php/switch.php",
        data: "get=FullStationData&type=" + type.toLowerCase() + "&table=" + table 
        +"&code="+code + "&component=" + component + "&ref=" + referenceTime,
        dataType: "json",
        success: function(html){
            if(handler != undefined){
                Wovodat.processDetailedData({
                    data: html,
                    time: referenceTime,
                    handler: handler
                });
            }
            
        }
    });
}

Wovodat.processDetailedData = function(o){
    var data = o.data;
    var ref = o.referenceTime;
    var temp;
    var THREE_HOURS = 3 * 60 * 60 * 1000 ;
    // jump to the starting point of the data set;
    if(ref == undefined) ref = data[0][0][0];
    else{
        if(ref < data[0][0][0]){
            temp = Math.floor((data[0][0][0] - ref) / THREE_HOURS) ;
            temp = temp + 1;
            ref = ref + temp * THREE_HOURS;
        }else if(ref > data[0][0][0]){
            temp = Math.floor((ref - data[0][0][0]) / THREE_HOURS);
            ref = ref - temp * THREE_HOURS;
        }
    }
    data[1] = [];
    var nextRef = ref - THREE_HOURS;
    var length = data[0].length;
    for(var i = 0 ; i < length ; i++){
        temp = data[0][i];
        if(temp[0] <= nextRef){
            ref = nextRef;
            nextRef = nextRef - THREE_HOURS;
        }
        if(temp[0] <= ref && temp[0] > nextRef){
            data[1].push(temp);
            ref = nextRef;
            nextRef = nextRef - THREE_HOURS;
        }
    }
    o.handler({
        data:data
    });
}
//get all stations for a specific volcano (compare view)
Wovodat.getAllStationsList = function (args){
    var cavw = args.cavw;
    var handler = args.handler;
	var tableId = args.tableId;
	var mapId = args.mapId;
	var mapUsed = args.mapUsed
	var stationsDatabaseUsed = args.stationsDatabaseUsed;
    $.ajax({
        method: "get", 
        url: "/php/switch.php",
        data: "get=AllStationsList&cavw="+cavw,
        success: function(html){
			separate = html.split(";");
            if(html[html.length - 1] == "")
                html.length--;
            handler({
                list:html
            },tableId,mapId, stationsDatabaseUsed,mapUsed);
        }
    });
};
