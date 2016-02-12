<?php
class ThinClientSpecificRsamConversionView {
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
<div>
    <script language="javascript" type="text/javascript" src="/js/jquery.js"></script>
    <script language="javascript" type="text/javascript" src="/js/jquery.flot.tuan.js"></script>
    <script language="javascript" type="text/javascript" src="/js/jquery.flot.navigate.tuan.js"></script>
</div>
<div>
    <div id="top" align="left">
        <!-- Aligned to the right: You are logged in as username (FName LName | Obs) | Logout -->
        <p align="right">Login as: <b><?php print $uname; ?></b>|<a href="/populate/logout.php">Logout</a></p>
    </div>
    <div style="float: right;width:500px;">
        Rsam:<br/>
        <div id="Rsam" style="width:500px;height:300px">

        </div>
    </div>
    <div style="width:400px;">
        <table>
            <tr>
                <td>Observatory Name:</td>
                <td><?php echo  $_POST["owner1"] ?></td>
            </tr>

            <tr>
                <td>Volcano Name:</td>
                <td><?php echo $_POST["vol2"]?></td>
           </tr>
            <tr>
                <td>File Type:</td>
                <td>RSAM</td>
            </tr>
            <tr>
               <td>Station Name:</td>   <!-- Nang added -->
               <td><?php echo substr($_POST['station'],strpos($_POST['station'], "_sflag_")+7)?></td>    <!-- show station name -->
            </tr>
            <tr>
                <td>Code of RSAM:</td>
                <td><?php echo $_POST["CodeOfRsam"]?></td>
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
                <td>File Info: </td>
            </tr>
            <tr>
                <td>Input File Name: </td>
                <td id="FileName"></td>
            </tr>
            <tr>
                <td>Uploaded Total Rows: </td>
                <td id="FileRows"></td>
            </tr>
            <tr>
                <td>Input File Size: </td>
                <td id="FileSize"></td>
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
            <a id="downloadLink" href="switch.php?download=<?php echo $converter->getZipFile()?>" ></a>
        </div>			
		
    </div>

</div>
<script type="text/javascript">
    function toDate(date){
        //2007-09-12 17:21:01
        var temp = date.split(" ");
        var year = temp[0].split("-");
        var hours = temp[1].split(":");
        return new Date(year[0],year[1],year[2],hours[0],hours[1],hours[2],0);
    }
    $(document).ready(function(){


       var data = <?php $converter->generateJsonData(); ?>;
       var rsam = data.data;
       var time = data.time;
       var file = data.file;
        $("#FileName").html(file.fileName);
        $("#FileRows").html(file.rows + ' rows');
        $("#FileSize").html(file.size.toFixed(2) + ' kbytes');
        $("#explanation").html("Successfully converted from " +  file.fileName  + " to " + getFileName(data.downloadLink) + " file...")
        var numberOfRecords = data.numberOfRecords;
        var i, d1 = [];
        for(i = 0 ; i < numberOfRecords;i++){
            d1[i] = [toDate(time[i].date).getTime(),Math.round(parseFloat(rsam[i]))];
        }
        var rsamData = {
            data: d1,
            label: "Rsam"
        };
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
        var rsamGraph = $.plot($("#Rsam"),[rsamData],options);
        //download the xml files
        $("#downloadXmlFile").click(function(){
            window.location = document.getElementById('downloadLink');
        });
        var previousPoint = null;
        $("#Rsam").bind("plothover", function (event, pos, item) {
            if (item) {
                if (previousPoint != item.dataIndex) {
                    previousPoint = item.dataIndex;
                    $("#tooltip").remove();
                    var x = new Date(item.datapoint[0]),
                    y = item.datapoint[1].toFixed(2);
                    x = (x.getMonth() + 1) + "/" + x.getDate() + "/" + x.getFullYear() + " " + x.getHours() + ":" + x.getMinutes() + ":" + x.getSeconds();
                    showTooltip(item.pageX, item.pageY, "Date: " + x + " UTC<br/>Rsam: " + rsamData.data[item.dataIndex][1].toFixed(2));
                }
            }
            else {
                $("#tooltip").remove();
                previousPoint = null;
            }
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
    function getFileName(path) {
        return path.match(/[-._\w]+[.][\w]+$/i)[0];
    }

</script>
<br/>
<br/>
        <?php
    }
}
?>
