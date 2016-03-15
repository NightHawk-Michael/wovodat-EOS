/**
 * Class store all functions to handle action events related to Graph
 */
// this is the list of available station type for each volcano,
// this list will be initialize when the volcano is selected and
// it will be deleted when this volcano is deselected.
// the google maps (for both Time Series view and Compare Volcano view
var map=[];
// the list of station for each station type
var stationsDatabase = {};
// the list of station for each station type - The second volcano - in Compare Volcano view
var compStationsDatabase = {};
// this link to all the plotted graph
var graphs = [];
// this link to all the plot data for each graph
var graphData = [];
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
var totalGraph = [];
var graphCount = [];

var ccMap = new Map();
var eqMap = new Map();
/**
 * when user select a specific eruption, all the graphs will move to
 * the volcano in the time series
 */
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

/**
 *showing the tooltip of information for the graphs when
 * user hovers mouse over a point on the graph.
 */
function setOnHoverForGraph(id,tableId,label,equakeType) {

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