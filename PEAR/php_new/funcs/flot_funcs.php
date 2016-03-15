<?php

// Required scripts
include_once "php/include/flot_woml2serial.php";
include_once "php/include/funcgen_printarray.php";
include_once "php/include/funcgen_datetime.php";
include_once "php/include/func_xmlparse.php";

//========================= function for plotting wovoml array w/ jquery -->
function flotwomlplot($arry,$technic,$divId){ //array must be in wovoml structure
require_once "./flot_woml2serial.php";
	$fnm="woml2".$technic."serial"; //------ construct function name
	$dataflot=$fnm($arry); //------ read $arry and create flot's series
	print_ary($dataflot,1);
	echo '<script type="text/javascript">/* <![CDATA[ */'; // copy to javascript array
  echo 'var datan = '.json_encode($dataflot);
  echo '/* ]]> */</script>';
?>

<script language="javascript" type="text/javascript">
	function aryofobject(label,data){
		this.label=label;
		this.data=data;
	};
	$(function(){
		var a=datan.length;
		var b=datan[0].length; b=(b-1)/2;
		var data = new Array();	//Create a new 1D array
	
		for(i=0;i<a;i++){
			data[i] = new Array();	//Create another array inside data[] array
	 		for(j=0;j<b;j++){
				var k=j*2+1; var l=k+1; // data starts from "1"; dataflot[0] is only label
				data[i][j] = new Array();	//Create another array inside data[] array
				data[i][j][0] = datan[i][k];	//Adding even index data to the X data array
				data[i][j][1] = datan[i][l];	//Adding odd index data to the Y data array
		}	}

		var iselect=0;var isel=3; // for future selection if necessary
		for(i=0;i<a;i++){
			var labl=datan[i][0];
			if(iselect==1){
				if(i==isel)data[0]=new aryofobject(labl,data[i]);
			}else{
				data[i]=new aryofobject(labl,data[i]);}
		}

		var options = {
			legend: {show:true},
			series: {points: {show:true,radius:1},lines: {show:true, lineWidth:1},bars: {show:false,barWidth:0.5, series_spread: true, align: "center" }},
			colors:["#994444"],
			grid:{backgroundColor:{colors:["#eeeedd","#ffffcc"]},clickable: true,autoHighlight: true}
		};

		var plotarea=$("#"+"<?= $divId ?>");
		plotarea.css("height", "180px"); plotarea.css("width", "360px");
		$.plot( plotarea, data, options);
		$("#"+"<?= $divId ?>").bind("plotclick", function (event, pos, item){
			var posx=pos.x; var posy=pos.y;
			var pox=posx.toFixed(2);	
			var poy=posy.toFixed(2);	
			alert("Point "+ pox + ", " +poy);
		});
	});
</script>

<?php 
}
// function for plotting simple($ar="1") or x-y($ar="2") series w/ jquery -->
//================== array(x1,y1,x2,y2,x3,y3,...etc) 
function flotseriesplot($ary,$divId,$ar){ //array must be in wovoml structure
	print_ary($ary,1);
	echo '<script type="text/javascript">/* <![CDATA[ */'; //pass into javascript array
  echo 'var datan = '.json_encode($ary);
  echo '/* ]]> */</script>';
?>

<script language="javascript" type="text/javascript">
	function aryofobject(label,data){
		this.label=label;
		this.data=data;
	};
	$(function(){
		var sr="<?= $ar ?>";
		var b=datan.length; if(sr==2)b=b/2;
		var data = new Array();	//Create a new 1D array
		data[0] = new Array();	//Create another array inside data[] array
	 		for(j=0;j<b;j++){
				if(sr==2){
					var k=j*2; var l=k+1; // data starts from "1"; dataflot[0] is only label
					data[0][j] = new Array();	//Create another array inside data[] array
					data[0][j][0] = datan[k];	//Adding even index data to the X data array
					data[0][j][1] = datan[l];	//Adding odd index data to the Y data array
				}else{
					data[0][j] = new Array();	//Create another array inside data[] array
					data[0][j][0] = j;	//Adding even index data to the X data array
					data[0][j][1] = datan[j];	//Adding odd index data to the Y data array
				}
			}
		var labl="series";
		data[0]=new aryofobject(labl,data[0]);

		var options = {
			legend: {show:true},
			series: {points: {show:true,radius:2},lines: {show:true,lineWidth:1},bars: {show:false,barWidth:1.0 }},
			colors:["#994444"],
			grid:{backgroundColor:{colors:["#eeeedd","#ffffcc"]},clickable: true,autoHighlight: true}
		};

		var plotarea=$("#"+"<?= $divId ?>");
		plotarea.css("height", "180px"); plotarea.css("width", "360px");
		$.plot( plotarea, data, options);
		$("#"+"<?= $divId ?>").bind("plotclick", function (event, pos, item){
			var posx=pos.x; var posy=pos.y;
			var pox=posx.toFixed(2);	
			var poy=posy.toFixed(2);	
			alert("Point "+ pox + ", " +poy);
		});
	});
</script>
<?php 
}

/******************************************************************************************************
* Function for plotting time series
* Input:	- $data: an array containing the sets of data (format: data[0]['values'][0]['x']=>x ; data[0]['points']=>TRUE/FALSE ; data[0]['label']=>"SO2")
* 			- $div_id: the id of div element where graph shall be displayed
******************************************************************************************************/
function flot_plot_time($data, $div_id) {
    $num = $div_id[strlen($div_id) - 1];
    // javascript for the left side of displayed graph and map panel
    if ($num == 1) {
        ?>

<script language="javascript" type="text/javascript">
    var numberOfTicks1 = 5;
    var options1={
        legend:{position:"nw"},
        series:{points:{show:true,radius: 0.6}},
        colors:["#3a4cb2"],
        grid:{
            backgroundColor:{colors:["#f3ffed","#f3ffdc"]},
            // this option is for changing the color of the border
            borderColor: ["white"],
            clickable:true,
            hoverable:true,
            autoHighlight:true
        },
        xaxis:{mode:"time",timeformat:"%d/%m/%y",ticks:numberOfTicks1},
        zoom:{ interactive: false},
        pan: {interactive: true},
        selection: {mode: null}
    };
    var plotarea1=$("#"+"<?= $div_id ?>");
    plotarea1.css("height", "135px");
    plotarea1.css("font-size", "8px");
    var data1 =[
        <?php
        $reloop_set=FALSE;
// Loop on data sets
        foreach ($data as $set) {
            if ($reloop_set)
                print ",";
            // Open data set
            print "{data:[";
            // Loop on values
            $reloop_value=FALSE;
            foreach ($set['values'] as $value) {
                if ($reloop_value) print ", ";
                print "[".$value['x'].", ".$value['y']."]";
                if (!$reloop_value) $reloop_value=TRUE;
            }
            print "]";
            if ($set['points']) print ",points: {show:true}";
            if ($set['lines']) print ",lines: {show:true}";
            if ($set['bars']) print ",bars: {show:true}";
            if (!empty($set['label'])) print ",\n\t\t\t\tlabel: \"".$set['label']."\"";
            if (!empty($set['color'])) print ",\n\t\t\t\tcolor: \"".$set['color']."\"";
            print "}";
            if (!$reloop_set) $reloop_set=TRUE;
        }

        ?>
            ];
            function showTooltip1(x, y, contents) {
                $('<div id="tooltip1">' + contents + '</div>').css( {
                    position: 'absolute',
                    display: 'none',
                    top: y + 5,
                    left: x + 5,
                    border: '1px solid #fdd',
                    padding: '2px',
                    'background-color': '#fee',
                    opacity: 0.80
                }).appendTo("body").fadeIn(200);
            }
            var plot1;
            // to store the last position of the screen
            var xCordinate1 = new Object(),yCordinate1 = new Object();
            xCordinate1.min = null;
            xCordinate1.max = null;
            yCordinate1.min = null;
            yCordinate1.max = null;
            var deleteOldRedoData1 = false;
            $(function(){

                changeGraphExpandMethod1();
                //var plot = $.plot(plotarea,data,options);
                var previousPoint1 = null;

                $(plotarea1).bind("plothover", function (event, pos, item) {
                    var date1 = new Date(parseInt(pos.x.toFixed(2)));
                    var year1 = date1.getFullYear();
                    var month1 = date1.getMonth()+1;
                    if (month1.toString().length == 1) month1="0" + month1;
                    var day1 = date1.getDate();
                    if (day1.toString().length == 1) day1="0" + day1;
                    var hour1 = date1.getHours();
                    if (hour1.toString().length == 1) hour1="0" + hour1;
                    var minute1 = date1.getMinutes();
                    if (minute1.toString().length == 1) minute1="0" + minute1;
                    var second1 = date1.getSeconds();
                    if (second1.toString().length == 1) second1="0" + second1;
                    //var x1 = year1 + "-" + month1 + "-" + day1 + " " + hour1 + ":" + minute1 + ":" + second1;
                    var x1 = year1 + "-" + month1 + "-" + day1 + " " + hour1 + ":" + minute1;
                    var y1 = pos.y.toFixed(2);
                    $("#"+"<?= $div_id ?>"+"_x").text(x1);
                    $("#"+"<?= $div_id ?>"+"_y").text(y1);

                    if (item) {
                        if (previousPoint1 != item.datapoint) {
                            previousPoint1 = item.datapoint;

                            $("#tooltip1").remove();

                            var date = new Date(parseInt(item.datapoint[0].toFixed(2)));
                            var year = date.getFullYear();
                            var month = date.getMonth()+1;
                            if (month.toString().length == 1) month="0" + month;
                            var day = date.getDate();
                            if (day.toString().length == 1) day="0" + day;
                            var hour = date.getHours();
                            if (hour.toString().length == 1) hour="0" + hour;
                            var minute = date.getMinutes();
                            if (minute.toString().length == 1) minute="0" + minute;
                            var second = date.getSeconds();
                            if (second.toString().length == 1) second="0" + second;
                            var x = year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
                            var y = item.datapoint[1].toFixed(2);
                            showTooltip1(item.pageX, item.pageY,item.series.label + " on " + x + " = " + y);
                        }
                    }
                    else {
                        $("#tooltip1").remove();
                        previousPoint1 = null;
                    }
                });
                $(plotarea1).bind("plotpan",function(event, plot){
                    var axes1 = plot.getAxes();
                    deleteOldRedoData1 = true;
                    recordUndoEvent1();
                    xCordinate1.min =  axes1.xaxis.min;
                    xCordinate1.max =  axes1.xaxis.max;
                    yCordinate1.min =  axes1.yaxis.min;
                    yCordinate1.max =  axes1.yaxis.max;
                });
                $(plotarea1).bind("plotselected",function(event,ranges){
                    deleteOldRedoData1 = true;
                    recordUndoEvent1();
                    if ($("#rectangleGraphExpandMethod1").attr('checked') == 'checked'){
                        options1.xaxis = new Object();
                        options1.xaxis.min = ranges.xaxis.from;
                        options1.xaxis.max = ranges.xaxis.to;
                        setXaxisOfOption1();
                        options1.yaxis = new Object();
                        options1.yaxis.min = ranges.yaxis.from;
                        options1.yaxis.max = ranges.yaxis.to;
                        xCordinate1.min =ranges.xaxis.from;
                        xCordinate1.max =ranges.xaxis.to;
                        yCordinate1.min =ranges.yaxis.from;
                        yCordinate1.max =ranges.yaxis.to;
                    }
                    plot1 = $.plot(plotarea1, data1,options1);

                });
            });
            function setResizable1(){
                $(plotarea1).resizable({maxHeight:300,maxWidth:320});
                $(plotarea1).bind("resize",function(event,ui){
                    setXaxisOfOption1();
                    plot1 = $.plot(plotarea1, data1,options1);
                });
            }
            function setXaxisOfOption1(){
                options1.xaxis.mode = "time";
                options1.xaxis.timeformat = "%h-%d/%m/%y";
                options1.xaxis.ticks = numberOfTicks1;
            }
            function changeGraphExpandMethod1(){
                if ($("#panGraphExpandMethod1").attr('checked') == 'checked'){ 
                    options1.pan.interactive = true;
                    options1.selection.mode = null;
                    if (options1.xaxis == undefined)
                        options1.xaxis = new Object();
                    setXaxisOfOption1();
                }
                else if ($("#rectangleGraphExpandMethod1").attr('checked') == 'checked'){
                    options1.xaxis = new Object();
                    options1.xaxis.min = xCordinate1.min;
                    options1.xaxis.max = xCordinate1.max;
                    setXaxisOfOption1();
                    options1.yaxis = new Object();
                    options1.yaxis.min = yCordinate1.min;
                    options1.yaxis.max = yCordinate1.max;
                    options1.pan.interactive = false;
                    options1.selection.mode = "xy";
                }
                plot1 = $.plot(plotarea1,data1,options1);
                setResizable1();
            }

            function recordUndoEvent1(){
                if (deleteOldRedoData1 == true){
                    clearRedoData1();
                    deleteOldRedoData1 = false;
                }
                var a = new Object();
                a.xmin = xCordinate1.min;
                a.xmax = xCordinate1.max;
                a.ymin = yCordinate1.min;
                a.ymax = yCordinate1.max;
                undoStack1.push1(a);
            }
            function recordRedoEvent1(){
                var a = new Object();
                a.xmin = xCordinate1.min;
                a.xmax = xCordinate1.max;
                a.ymin = yCordinate1.min;
                a.ymax = yCordinate1.max;
                redoStack1.push1(a);
            }
            function undoPlotGraph1(){
                if ( undoStack1.top1() != undefined){
                    recordRedoEvent1();
                    var a = undoStack1.pop1();
                    options1.xaxis = new Object();
                    options1.xaxis.min = a.xmin;
                    options1.xaxis.max = a.xmax;
                    setXaxisOfOption1();
                    options1.yaxis = new Object();
                    options1.yaxis.min = a.ymin;
                    options1.yaxis.max = a.ymax;
                    xCordinate1.min =  a.xmin;
                    xCordinate1.max =  a.xmax;
                    yCordinate1.min =  a.ymin;
                    yCordinate1.max =  a.ymax;
                    plot1 = $.plot(plotarea1,data1,options1);
                }
            }
            function redoPlotGraph1(){
                if ( redoStack1.top1() != undefined){
                    recordUndoEvent1();
                    var a = redoStack1.pop1();
                    options1.xaxis = new Object();
                    options1.xaxis.min = a.xmin;
                    options1.xaxis.max = a.xmax;
                    setXaxisOfOption1();
                    options1.yaxis = new Object();
                    options1.yaxis.min = a.ymin;
                    options1.yaxis.max = a.ymax;
                    xCordinate1.min =  a.xmin;
                    xCordinate1.max =  a.xmax;
                    yCordinate1.min =  a.ymin;
                    yCordinate1.max =  a.ymax;
                    plot1 = $.plot(plotarea1,data1,options1);

                }
            }
            function clearRedoData1(){
                redoStack1.clear1();
            }

            // Stack data structure for implementing
            function Stack1(){
                this.states1 = new Array();
                this.push1 = pushdata1;
                this.pop1 = popdata1;
                this.printStack1 = showStackData1;
                this.top1 = topdata1;
                this.clear1 = cleardata1;
            }
            function cleardata1(){
                this.states1 = new Array();
            }
            function topdata1(){
                return this.states1[this.states1.length-1];
            }
            function pushdata1(data)
            {
                this.states1.push(data);
            }
            function popdata1()
            {
                return this.states1.pop();
            }
            function showStackData1()
            {
                return this.states1;
            }
            var undoStack1 = new Stack1();
            var redoStack1 = new Stack1();
</script>
        <?php
    }
    // javascript for the right side of displayed graph and map panel
    else if ( $num == 2) {
        ?>

<script language="javascript" type="text/javascript">
    var numberOfTicks2 = 5;
    var options2={
        legend:{position:"nw"},
        series:{points:{show:true,radius: 0.5}},
        colors:["##6d82ff"],
        grid:{
            backgroundColor:{colors:["#f3ffed","#f3ffdc"]},
            // this option is for changing the color of the border
            borderColor: ["white"],
            clickable:true,
            hoverable:true,
            autoHighlight:true
        },
        xaxis:{mode:"time",timeformat:"%d/%m/%y",ticks:numberOfTicks2},
        zoom:{ interactive: false},
        pan: {interactive: true},
        selection: {mode: null}
    };
    var plotarea2=$("#"+"<?= $div_id ?>");
    plotarea2.css("height", "135px");
    plotarea2.css("font-size", "8px");
    var data2 =[
        <?php
        $reloop_set=FALSE;
// Loop on data sets
        foreach ($data as $set) {
            if ($reloop_set)
                print ",";
            // Open data set
            print "{data:[";
            // Loop on values
            $reloop_value=FALSE;
            foreach ($set['values'] as $value) {
                if ($reloop_value) print ", ";
                print "[".$value['x'].", ".$value['y']."]";
                if (!$reloop_value) $reloop_value=TRUE;
            }
            print "]";
            if ($set['points']) print ",points: {show:true}";
            if ($set['lines']) print ",lines: {show:true}";
            if ($set['bars']) print ",bars: {show:true}";
            if (!empty($set['label'])) print ",\n\t\t\t\tlabel: \"".$set['label']."\"";
            if (!empty($set['color'])) print ",\n\t\t\t\tcolor: \"".$set['color']."\"";
            print "}";
            if (!$reloop_set) $reloop_set=TRUE;
        }

        ?>
            ];
            function showTooltip2(x, y, contents) {
                $('<div id="tooltip2">' + contents + '</div>').css( {
                    position: 'absolute',
                    display: 'none',
                    top: y + 5,
                    left: x + 5,
                    border: '1px solid #fdd',
                    padding: '2px',
                    'background-color': '#fee',
                    opacity: 0.80
                }).appendTo("body").fadeIn(200);
            }
            var plot2;
            // to store the last position of the screen
            var xCordinate2 = new Object(),yCordinate2 = new Object();
            xCordinate2.min = null;
            xCordinate2.max = null;
            yCordinate2.min = null;
            yCordinate2.max = null;
            var deleteOldRedoData2 = false;
            $(function(){

                changeGraphExpandMethod2();
                //var plot = $.plot(plotarea,data,options);
                var previousPoint2 = null;

                $(plotarea2).bind("plothover", function (event, pos, item) {
                    var date1 = new Date(parseInt(pos.x.toFixed(2)));
                    var year1 = date1.getFullYear();
                    var month1 = date1.getMonth()+1;
                    if (month1.toString().length == 1) month1="0" + month1;
                    var day1 = date1.getDate();
                    if (day1.toString().length == 1) day1="0" + day1;
                    var hour1 = date1.getHours();
                    if (hour1.toString().length == 1) hour1="0" + hour1;
                    var minute1 = date1.getMinutes();
                    if (minute1.toString().length == 1) minute1="0" + minute1;
                    var second1 = date1.getSeconds();
                    if (second1.toString().length == 1) second1="0" + second1;
                    //var x1 = year1 + "-" + month1 + "-" + day1 + " " + hour1 + ":" + minute1 + ":" + second1;
                    var x1 = year1 + "-" + month1 + "-" + day1 + " " + hour1 + ":" + minute1;
                    var y1 = pos.y.toFixed(2);
                    $("#"+"<?= $div_id ?>"+"_x").text(x1);
                    $("#"+"<?= $div_id ?>"+"_y").text(y1);

                    if (item) {
                        if (previousPoint2 != item.datapoint) {
                            previousPoint2 = item.datapoint;

                            $("#tooltip2").remove();

                            var date = new Date(parseInt(item.datapoint[0].toFixed(2)));
                            var year = date.getFullYear();
                            var month = date.getMonth()+1;
                            if (month.toString().length == 1) month="0" + month;
                            var day = date.getDate();
                            if (day.toString().length == 1) day="0" + day;
                            var hour = date.getHours();
                            if (hour.toString().length == 1) hour="0" + hour;
                            var minute = date.getMinutes();
                            if (minute.toString().length == 1) minute="0" + minute;
                            var second = date.getSeconds();
                            if (second.toString().length == 1) second="0" + second;
                            var x = year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
                            var y = item.datapoint[1].toFixed(2);
                            showTooltip2(item.pageX, item.pageY,item.series.label + " on " + x + " = " + y);
                        }
                    }
                    else {
                        $("#tooltip2").remove();
                        previousPoint2 = null;
                    }
                });
                $(plotarea2).bind("plotpan",function(event, plot){
                    var axes2 = plot.getAxes();
                    deleteOldRedoData2 = true;
                    recordUndoEvent2();
                    xCordinate2.min =  axes2.xaxis.min;
                    xCordinate2.max =  axes2.xaxis.max;
                    yCordinate2.min =  axes2.yaxis.min;
                    yCordinate2.max =  axes2.yaxis.max;
                });
                $(plotarea2).bind("plotselected",function(event,ranges){
                    deleteOldRedoData2 = true;
                    recordUndoEvent2();
                    if ($("#rectangleGraphExpandMethod2").attr('checked') == 'checked'){
                        options2.xaxis = new Object();
                        options2.xaxis.min = ranges.xaxis.from;
                        options2.xaxis.max = ranges.xaxis.to;
                        setXaxisOfOption2();
                        options2.yaxis = new Object();
                        options2.yaxis.min = ranges.yaxis.from;
                        options2.yaxis.max = ranges.yaxis.to;
                        xCordinate2.min =ranges.xaxis.from;
                        xCordinate2.max =ranges.xaxis.to;
                        yCordinate2.min =ranges.yaxis.from;
                        yCordinate2.max =ranges.yaxis.to;
                    }
                    plot2 = $.plot(plotarea2, data2,options2);

                });
            });
            function setResizable2(){
                $(plotarea2).resizable({maxHeight:300,maxWidth:320});
                $(plotarea2).bind("resize",function(event,ui){
                    setXaxisOfOption2();
                    plot2 = $.plot(plotarea2, data2,options2);
                });
            }
            function setXaxisOfOption2(){
                options2.xaxis.mode = "time";
                options2.xaxis.timeformat = "%h-%d/%m/%y";
                options2.xaxis.ticks = numberOfTicks2;
            }
            function changeGraphExpandMethod2(){
                if ($("#panGraphExpandMethod2").attr('checked') == 'checked'){
                    options2.pan.interactive = true;
                    options2.selection.mode = null;
                    if (options2.xaxis == undefined)
                        options2.xaxis = new Object();
                    setXaxisOfOption2();
                }
                else if ($("#rectangleGraphExpandMethod2").attr('checked') == 'checked'){
                    options2.xaxis = new Object();
                    options2.xaxis.min = xCordinate2.min;
                    options2.xaxis.max = xCordinate2.max;
                    setXaxisOfOption2();
                    options2.yaxis = new Object();
                    options2.yaxis.min = yCordinate2.min;
                    options2.yaxis.max = yCordinate2.max;
                    options2.pan.interactive = false;
                    options2.selection.mode = "xy";
                }
                plot2 = $.plot(plotarea2,data2,options2);
                setResizable2();
            }

            function recordUndoEvent2(){
                if (deleteOldRedoData2 == true){
                    clearRedoData2();
                    deleteOldRedoData2 = false;
                }
                var a = new Object();
                a.xmin = xCordinate2.min;
                a.xmax = xCordinate2.max;
                a.ymin = yCordinate2.min;
                a.ymax = yCordinate2.max;
                undoStack2.push2(a);
            }
            function recordRedoEvent2(){
                var a = new Object();
                a.xmin = xCordinate2.min;
                a.xmax = xCordinate2.max;
                a.ymin = yCordinate2.min;
                a.ymax = yCordinate2.max;
                redoStack2.push2(a);
            }
            function undoPlotGraph2(){
                if ( undoStack2.top2() != undefined){
                    recordRedoEvent2();
                    var a = undoStack2.pop2();
                    options2.xaxis = new Object();
                    options2.xaxis.min = a.xmin;
                    options2.xaxis.max = a.xmax;
                    setXaxisOfOption2();
                    options2.yaxis = new Object();
                    options2.yaxis.min = a.ymin;
                    options2.yaxis.max = a.ymax;
                    xCordinate2.min =  a.xmin;
                    xCordinate2.max =  a.xmax;
                    yCordinate2.min =  a.ymin;
                    yCordinate2.max =  a.ymax;
                    plot2 = $.plot(plotarea2,data2,options2);
                }
            }
            function redoPlotGraph2(){
                if ( redoStack2.top2() != undefined){
                    recordUndoEvent2();
                    var a = redoStack2.pop2();
                    options2.xaxis = new Object();
                    options2.xaxis.min = a.xmin;
                    options2.xaxis.max = a.xmax;
                    setXaxisOfOption2();
                    options2.yaxis = new Object();
                    options2.yaxis.min = a.ymin;
                    options2.yaxis.max = a.ymax;
                    xCordinate2.min =  a.xmin;
                    xCordinate2.max =  a.xmax;
                    yCordinate2.min =  a.ymin;
                    yCordinate2.max =  a.ymax;
                    plot2 = $.plot(plotarea2,data2,options2);
                }
            }
            function clearRedoData2(){
                redoStack2.clear2();
            }
            // Stack data structure for implementing
            function Stack2(){
                this.states2 = new Array();
                this.push2 = pushdata2;
                this.pop2 = popdata2;
                this.printStack2 = showStackData2;
                this.top2 = topdata2;
                this.clear2 = cleardata2;
            }
            function cleardata2(){
                this.states2 = new Array();
            }
            function topdata2(){
                return this.states2[this.states2.length-1];
            }
            function pushdata2(data)
            {
                this.states2.push(data);
            }
            function popdata2()
            {
                return this.states2.pop();
            }
            function showStackData2()
            {
                return this.states2;
            }
            var undoStack2 = new Stack2();
            var redoStack2 = new Stack2();
</script>
        <?php
    } else{
    }
}
?>