<?php
class ThinClientSpecificTiltConversionView {
    protected $converter;
    public function __construct() {
    }
    public function setConverter($converter) {
        $this->converter = $converter;
    }
    public function drawGui() {
        $converter = $this->converter;
        if(!isset($converter))
            throw new Exception("No converter is set for this view");
        $uname="";
        if (isset($_SESSION['login'])) {
            $uname=$_SESSION['login']['cr_uname'];
        }
        ?>
<script language="javascript" type="text/javascript" src="/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="/js/jquery.flot.tuan.js"></script>
<script language="javascript" type="text/javascript" src="/js/jquery.flot.navigate.tuan.js"></script>

<div>
    <div id="top" align="left">
        <!-- Aligned to the right: You are logged in as username (FName LName | Obs) | Logout -->
        <p align="right">Login as: <b><?php print $uname; ?></b>|<a href="/populate/logout.php">Logout</a></p>
    </div>
    <div style="float: right;width:600px">
        X component:<br/>
        <div id="xComponent" style="width:600px;height:300px">

        </div>
        Y component:<br/>
        <div id="yComponent" style="width:600px;height:300px">

        </div>
    </div>
    <div style="width:400px;">
        <table>
            <tr>
                <td>Observatory Name:</td>
                <td><?php echo $_POST["owner1"]?></td>
            </tr>

            <tr>
                <td>Volcano Name:</td>
                <td><?php echo $_POST["vol2"]?></td>
            </tr>
            <tr>
                <td>File Type:</td>
                <td>ElectronicTiltData (Post Processed)</td>
            </tr>
            <tr>
                <td>Station Name:</td>
                <td><?php echo substr($_POST['station'],strpos($_POST['station'], "_sflag_")+7)?></td>    <!-- show station name -->
            </tr>
            <tr>
            <tr>
                <td>Instrument:</td>
                <td><?php echo $_POST["instrument"]?></td>
            </tr>
            <tr>
                <td>Sampling Rate:</td>
                <td><?php echo $_POST["SamplingRate"] . " minutes"?></td>
            </tr>
            <tr>
                <td>Records/XML file:</td>
                <td><?php echo $converter->getOutputSize() ?> (record)</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>
            <tr>
                <td>First File Info: </td>
            </tr>
            <tr>
                <td>Input File Name: </td>
                <td id="FirstFileName"></td>
            </tr>
            <tr>
                <td>Uploaded Total Rows: </td>
                <td id="FirstFileRows"></td>
            </tr>
            <tr>
                <td>Input File Size: </td>
                <td id="FirstFileSize"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>
            <tr>
                <td>Second File Info: </td>
                <td></td>
            </tr>
            <tr>
                <td>Input File Name: </td>
                <td id="SecondFileName"></td>
            </tr>
            <tr>
                <td>Uploaded Total Rows: </td>
                <td id="SecondFileRows"></td>
            </tr>
            <tr>
                <td>Input File Size: </td>
                <td id="SecondFileSize"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
            </tr>
	<!--   <tr>
                <td>Convert File Name: </td>
                <td></td>
			</tr>
    -->     
        </table>
       <div id="explanation" style="text-align:left;">Successfully converted from and to file...</div>
        <br/>If you would like to see the result, please click here <br/>to dowload it:
		<br/><br/>
        <div>
            <button id="downloadXmlFile">Download XML file</button>
            <a id="downloadLink" href="switch.php?download=<?php echo $converter->getZipFile() ?>" ></a>
        </div>
    </div>

</div>
<div id="code">

</div>
<script type="text/javascript">
    function getFileName(path) {
        return path.match(/[-._\w]+[.][\w]+$/i)[0];
    }
    function toDate(date){
        //2007-09-12 17:21:01
        var temp = date.split(" ");
        var year = temp[0].split("-");
        var hours = temp[1].split(":");
        return new Date(year[0],year[1],year[2],hours[0],hours[1],hours[2],0);
    }
    $(document).ready(function(){
        var data = <?php $converter->generateJsonData()?>;
        var xComponent = data.xComponent;
        var yComponent = data.yComponent;
        var startTime = data.startTime.date;
        var samplingRate = data.sampleRate * 60 * 1000;
        var numberOfRecords = data.numberOfRecords;
        var outputSize = data.outputSize;
        $("#FirstFileName").html(data.files[0].fileName);
        $("#FirstFileRows").html(data.files[0].rows + ' rows');
        $("#FirstFileSize").html(data.files[0].size.toFixed(2) + ' kbytes');
        $("#SecondFileName").html(data.files[1].fileName);
        $("#SecondFileRows").html(data.files[1].rows + ' rows');
        $("#SecondFileSize").html(data.files[1].size.toFixed(2) + ' kbytes');
        $("#explanation").html("Successfully converted from " +  data.files[0].fileName + " and " + data.files[1].fileName + " to " + getFileName(data.downloadLink) + " file...")
        var current = toDate(startTime);
        current = current.getTime();
        var i = 0;

        var d1 = [], d2 = [];
        for(i = 0 ; i < numberOfRecords;i++){
            d1[i] = [current,parseFloat(xComponent[i])];
            d2[i] = [current,parseFloat(yComponent[i])];
            current = current + samplingRate;
        }
        var xData = {
            data: d1,
            label: "Tilt 1"
        };
        var yData = {
            data: d2,
            label: "Tilt 2"
        }
        var options = {
            series:{
                lines: {show:true},
                points: {show:false}
            },
            grid:{
                hoverable: true,
                clickable: true
            },
            yaxis:{
                //tickDecimals: 4
            },
            xaxis:{
                mode: "time",
                timeformat: "%m/%d/%y %h UTC"
            },
            zoom:{
                interactive: true
            },
            pan: {
                interactive: true
            }
        };
        // draw the x component
        var xGraph = $.plot($("#xComponent"),[xData],options);
        // draw the y component
        var yGraph = $.plot($("#yComponent"),[yData],options);
        //download the xml files
        $("#downloadXmlFile").click(function(){
            window.location = document.getElementById('downloadLink');
        });
        var previousPoint = null;
        $("#xComponent,#yComponent").bind("plothover", function (event, pos, item) {

            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    $("#tooltip").remove();
                    var x = new Date(item.datapoint[0]),
                    y = item.datapoint[1].toFixed(2);
                    x = (x.getMonth() + 1) + "/" + x.getDate() + "/" + x.getFullYear() + " " + x.getHours() + ":" + x.getMinutes() + ":" + x.getSeconds();
                    showTooltip(item.pageX, item.pageY, "Date: " + x + " UTC<br/>Tilt 1: " + xData.data[item.dataIndex][1].toFixed(2) + "<br/>Tilt 2: " + yData.data[item.dataIndex][1].toFixed(2));
                    xGraph.unhighlight();
                    yGraph.unhighlight();
                    xGraph.highlight(0,item.dataIndex);
                    yGraph.highlight(0,item.dataIndex);
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;
            }
        });
        $("#xComponent").bind("plotzoom", function (event, plot,args) {
            args.preventEvent = true;
            yGraph.zoom(args);
        });
        $("#yComponent").bind("plotzoom", function (event, plot,args) {
            args.preventEvent = true;
            xGraph.zoom(args);
        });
        $("#xComponent").bind("plotpan", function (event, plot,args) {
            args.preventEvent = true;
            yGraph.pan(args);
        });
        $("#yComponent").bind("plotpan", function (event,plot,args){
            args.preventEvent = true;
            xGraph.pan(args);
        });
    });
    function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
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

</script>
<br/>
<br/>
        <?php

    }
}
?>
