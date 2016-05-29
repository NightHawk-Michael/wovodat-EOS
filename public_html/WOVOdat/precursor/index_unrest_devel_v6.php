<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<?php
// Start session
session_start();

// if this code run on server then we need to cache the wovodat.js file on the 
// client code. Otherwise, we do not cach it for the purpose of development
$cache = time();
?> 
<html>
<head>
  <title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
  <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
  <meta http-equiv="cache-control" content="no-cache, must-revalidate">
  <meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
  <meta name="keywords" content="Volcano, Vulcano, Volcanoes">
  <link href="/gif2/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">     
  <link href="/css/jquery.jgrowl.css" rel="stylesheet">
  <!--<link href="/css/index.css" rel="stylesheet" type="text/css">-->
  <link href="/css/styles_beta.css" rel="stylesheet" type="text/css">
  <!--<link href="/css/volcano.css" rel="stylesheet" type="text/css"> -->    
  <link href="/css/tooltip.css" rel="stylesheet">
  <link href="/css/css_v5.css" rel="stylesheet">
  <link type="text/css" href="/js/jqueryui/css/custom-theme/jquery-ui-1.8.22.custom.css" rel="stylesheet" />
  <script type="text/javascript" src="/js/jqueryui/js/jquery-1.6.4.min.js"></script>
  <script type="text/javascript" src="/js/jqueryui/js/jquery-ui-1.8.21.custom.min.js"></script>
  <script type="text/javascript" src="/js/flot/jquery.flot.tuan.js"></script>
  <script type="text/javascript" src="/js/flot/jquery.flot.navigate.tuan.js"></script> 
  <script type="text/javascript" src="/js/flot/jquery.flot.selection.js"></script>
  <script type="text/javascript" src="/js/flot/jquery.flot.marks.js"></script>
  <script type="text/javascript" src="/js/wovodat.js?<?php echo $cache; ?>"></script>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCQ9kUvUtmawmFJ62hWVsigWFTh3CKUzzM&sensor=false"></script>
  <script type="text/javascript" src="/js/Tooltip_v3.js"></script>
  <script type="text/javascript" src="/js/jquery.jgrowl.js"></script>
  <script type="text/javascript" src="/js/GraphController.js"></script>
  <script type="text/javascript" src="/js/BasicFunction_V5.js"></script>
  <script type="text/javascript" src="/js/EarthQuakeController.js"></script>
  <script type="text/javascript" src="/js/EarthQuakeUI.js"></script>
  <script type="text/javascript" src="/js/GraphUI.js"></script>
  <script src="http://mrrio.github.io/jsPDF/dist/jspdf.debug.js"></script>
  <script> 
  $(document).ready(function(){
    $("#switchView").click();
    $("#HideTimeSeriesPanel1").click();
  }); 
  </script>
</head>
<body>

  <div class="body" style ="font-size:12px;" id="wrapborder_x">
    <!-- <div id="loading" class="loadingPanel" style ="display:none">Loading ...</div> -->
    <?php
    $vnum = " ";
    $vcavw = " ";
    $vname = " ";
    if (isset($_GET["vnum"])) {
      if ($_GET["vnum"] != "") {
        $vnum = $_GET["vnum"];
        if (isset($_POST["vcavw"])) {
          $vcavw = $_POST["vcavw"];
          $vname = $_POST["vname"];
        } else {
                        // $link = mysql_connect("localhost", "root", "1234567") or die(mysql_error());
                        // mysql_query("SET CHARACTER SET utf8", $link);
                        // mysql_query("SET NAMES utf8", $link);
                        // mysql_select_db("wovodat") or die(mysql_error());
          include 'php/include/db_connect_view.php';/*connect to database*/

          $str = "SELECT vd_name, vd_cavw, vd_num FROM vd WHERE vd_num = " . $vnum;
          $result = mysql_query($str);
          $row = mysql_fetch_array($result);
          $vname = $row[0];
          $vcavw = $row[1];
        }
      }
    }
    echo "<form id='volcanoForm' method='post'>";
    echo "<input type='hidden' id='vname' name='vname' value='" . $vname . "'>";
    echo "<input type='hidden' id='vcavw' name='vcavw' value='" . $vcavw . "'>";
    echo "<input type='hidden' id='vnum' name='vnum' value='" . $vnum . "'>";
    echo "</form>";
    ?>
    <?php include 'php/include/header.php'; ?>
    <!--                <?php //include 'php/include/header_beta.php'; ?> -->
    <div class = "container" id = "wrap_x">
      <div class = "content">
        <div id="switchViewPanel" style = "visibility: hidden">
          <button id="switchView" class="switchViewButton">Single View</button>
        </div>

        <table style="border-collapse: collapse;width: 960px;">
          <tr>
            <td id="volcanoPanel1" class="volcanoPanel">

              <div class="button white" id="mapBar1" style="width:900px;margin-top:0px">
                <div class="CloseButton" id="HideMap1"></div>
                <table>
                  <tr>
                    <td valign="middle">
                      <span class="MapsHeader" id="ShowMap1">
                        <a href="" onclick="return false;"><b>View Map</b></a>
                      </span>
                    </td>
                  </tr>
                </table>
              </div>
              <div id="map_legend1" class="map_legend">
                <div style="float:right">
                  <button id="showHideMarkers1" class="showHideMarkerButton">
                    Hide earthquake
                  </button>
                </div>
                <div style = "font-size:11px;">
                  <img src="/img/pin_ds.png" alt=""/> Deformation
                  <img src="/img/pin_gs.png" alt=""/> Gas
                  <img src="/img/pin_hs.png" alt=""/> Hydrologic
                  <img src="/img/pin_ss.png" alt=""/> Seismic
                  <img src="/img/pin_ts.png" alt=""/> Thermal
                  <img src="/img/pin_ms.png" alt=""/> Meteo
                  <img src="/img/pin_fs.png" alt=""/> Field
                </div>
              </div>
              <div style="" id="Map">
              </div>


              <div id="fixSwitch">
                <div class="button white" style = "width:900px;">
                  <div class="CloseButton" id="HideVolcanoInformation1"></div>
                  <div style="float:right;padding-right: 10px;">
                    <select id="VolcanoList" class="">
                      <option value="">Select...</option>
                    </select>
                  </div>   
                  <table>
                    <tr>
                      <td valign="middle">
                        <span id="VolcanoInformation1" class="VolcanoComparisonHeader">
                          <a href="" onclick="return false;">Volcano Info:</a>
                        </span>
                      </td>
                      <tr>
                      </table>
                    </div>
                    <!-- The section under Volcano Info of the left volcano-->
                    <div id="VolcanoPanel1" class="VolcanoPanel">
                      <table id="MainVolc" style="border-collapse: collapse;width:400px;">
                        <tr>
                          <td rowspan="2">
                            <button class="Gvp" id="gvp1">
                              Go to GVP
                            </button>
                          </td>
                          <td style="text-align:right" id="dataOwnerPanel">

                          </td>
                        </tr>
                        <tr style="height:5px">
                          <td style="text-align:right" ><span id="volcstatus1"></span></td>
                        </tr>
                        <tr>
                          <td style="text-align:right;height:5px" colspan="2"><div style="height:5px;"></div></td>
                        </tr>

                      </table>
                    </div>
                    <!-- END MAP, START GRAPH -->
                    <div>
                      <table>
                        <tr>
                          <td colspan="2" style="height:20px;width:250px">
                            <div class="viewStationPanel">
                              <button id="HideStationButton1" style="float:right;display:none">Hide Stations</button>
                              <b title="Click to show on Map">Data stations:</b>
                            </div>
                            <table id="StationList" class="stationList"></table>
                          </td>
                        </tr>
                      </table>
                    </div>

                    <div class="button white" style = "width:900px;">
                      <div class="CloseButton" id="HideEquake1"></div>
                      <table>
                        <tr>
                          <td valign="middle">
                            <span id="DisplayEquake1" class="VolcanoComparisonHeader">
                              <a href="" onclick="return false;">Earthquakes</a>
                            </span>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div id="EquakePanel1" class="EquakePanel" style="width:960px;">
                      <div class="FilterButton" id="FilterSwitch1">Show Filter</div>
                      <form id="FormFilter1" class="FormFilter" onSubmit="return false;" style="display:none">
                        <div class="pointer"></div>
                        <div class="row">
                          <div class="leftPanel">No of events:</div>
                          <div class="rightPanel">
                            <select id="Evn1">
                              <option value="500">500</option>
                              <option value="1000">1000</option>
                              <option value="1500">1500</option>
                              <option value="2000">2000</option>
                              <option value="2500">2500</option>
                              <option value="3000">3000</option>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="leftPanel">Catalog Owner:</div>
                          <div class="rightPanel">
                            <table id="cc_id1">
                              <tr>
                                <td><input type='checkbox' onClick="toggle(this,'cc_id1')" value="" id="cc_id1CheckBox0" checked/></td>
                                <td>All catalog owners</td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="leftPanel">Period:</div>
                          <div class="rightPanel">
                            <div class="subrow">
                              <table>
                                <tr>
                                  <td>
                                    Start: <input type="text" id="SDate1" class="dateInput" size=10/> 
                                  </td>
                                  <td>
                                    End: <input type="text" id="EDate1" class="dateInput" size=10/>
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div>
                              <div id="DateRange1"></div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="leftPanel">Depth (km):</div>
                          <div class="rightPanel">
                            <div class="subrow">
                              <table>
                                <tr>
                                  <td>
                                    Start: <input type="text" id="DepthLow1" class="numberInput" value="-10" size=4/>
                                  </td>
                                  <td>
                                    End: <input type="text" id="DepthHigh1" class="numberInput" value="40" size=4/>
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div>
                              <div id="DepthRange1"></div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="leftPanel">Magnitude:</div>
                          <div class="rightPanel">
                            <div class="subrow">
                              <table>
                                <tr>
                                  <td>
                                    Start: <input type="text" id="MagnitudeLow1" class="numberInput" value="0" size=4/>
                                  </td>
                                  <td>
                                    End: <input type="text" id="MagnitudeHigh1" class="numberInput" value="9" size=4/>
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div>
                              <div id="MagnitudeRange1"></div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="leftPanel">Type:</div>
                          <div class="rightPanel">
                            <table id="EqType1">
                              <tr>
                                <td><input type='checkbox' onClick="toggle(this,'EqType1')" value="" id="EqType1CheckBox0" checked/></td>
                                <td>All earthquake types</td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="row">
                          <div class="leftPanel">Map Width (km):</div>
                          <div class="rightPanel">
                            <select id="wkm1">
                              <option value="10">10</option>
                              <option value="20">20</option>
                              <option value="30">30</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select>
                          </div>
                        </div>                                          
                        <div class="threeDGMTFilter">
                          For drawing in 3D-GMT only:
                        </div>
                        <div class="row">
                          <div class="leftPanel">Azimuth:</div>
                          <div class="rightPanel">
                            <input type="text" id="azim1" class="numberInput" value="175" size="10"/>
                          </div>
                        </div>
                        <div class="row">
                          <div class="leftPanel">Rotation Degree:</div>
                          <div class="rightPanel">
                            <input type="text" id="degree1" class="numberInput" value="30" size="10"/>
                          </div>
                        </div>
                        <div class="FilterBtnHolder">
                          <button id="FilterBtn1" class="FilterBtn">Filter</button>
                        </div>
                      </form>
                      <div class="equakeButtonsRow">
                        <label for="equakeDisplayType12D" class="equakeDisplayBox equakeDisplayBox1">
                          <input type="radio" name="equakeDisplayType1" id="equakeDisplayType12D" value="2D" onclick="drawEquake({mapUsed:1,source:this})"/>
                          2D
                        </label>
                        <label for="equakeDisplayType12DGMT" class="equakeDisplayBox equakeDisplayBox1">
                          <input type="radio" name="equakeDisplayType1" id="equakeDisplayType12DGMT" value="2D(GMT)" onclick="drawEquake({mapUsed:1,source:this})"/>2D(GMT)
                        </label>
                        <label for="equakeDisplayType13D" class="equakeDisplayBox equakeDisplayBox1">
                          <input type="radio" name="equakeDisplayType1" id="equakeDisplayType13D" value="3D(GMT)" onclick="drawEquake({mapUsed:1,source:this})"/>3D(GMT)
                        </label>
                      </div>
                      <!-- place holders for the Flot graphs and GMT images-->

                      <div id="equakeGraphs1">
                        <div id="twoDEquakeFlotGraph1" class="twoDEquakeFlotGraph" style = "width:960px; background-color: white;">
                          <div class="row">
                            <div class="leftPanel" id="eqEvent1"></div>
                            <div class="leftPanel" id="owner1"></div>
                          </div>
                          <div class="plot-label">
                            <b>E-W</b>
                          </div>
                          <div id="FlotDisplayLat1" class="equakeGraphPlaceholder_v6">

                          </div>
                          <div class="plot-label">
                            <b>N-S</b>
                          </div>
                          <div id="FlotDisplayLon1" class="equakeGraphPlaceholder_v6">
                          </div>
                          <div class="plot-label">
                            <b>Time</b>
                          </div>
                          <div id="FlotDisplayTime1" class="equakeGraphPlaceholder_v6">
                          </div>
                          <div class="PrintButton" onclick="javascript:Wovodat.Printer.print({type:Wovodat.Printer.Printing.Type.TWOD_EQUAKE,element:document.getElementById('equakeGraphs1'),mapUsed:1,equakeGraph:equakeGraphs[1],info:document.getElementById('VolcanoList').value})" >
                            <a title="Print this graphs" href="#" >
                              <span class="app-icon light print-icon"></span>
                              <span class="app-button-text">Print Graph</span>
                            </a>
                          </div>
                          <div class="PrintButton" onclick="javascript:downloadCSV({cavw:document.getElementById('VolcanoList').value})" >
                            <a title="Print this graphs" href="#" >
                              <span class="app-icon light print-icon"></span>
                              <span class="app-button-text">Download CSV</span>
                            </a>
                          </div>
                        </div>
                        <div id="2DGMTEquakeGraph1" class="twoDGMTEquakeFlotGraph">
                          <b class="pointer"></b>
                          <div id="2DImage" class="TwoDImage">
                            <a href="" id="imageLink" target="_blank"><img style="height:auto;width:900px" src="" id="image"/></a>
                          </div>
                          <div class="PrintButton" onclick="javascript:Wovodat.Printer.print({type:Wovodat.Printer.Printing.Type.TWOD_GMT_EQUAKE,link:$('#image',document.getElementById('equakeGraphs1'))[0].src,info:document.getElementById('VolcanoList').value})">
                            <a title="Print this graphs" href="#" >
                              <span class="app-icon light print-icon"></span>
                              <span class="app-button-text">Print Graph</span>
                            </a>
                          </div>
                          <div class="PrintButton" onclick="javascript:downloadCSV({cavw:document.getElementById('VolcanoList').value})" >
                            <a title="Print this graphs" href="#" >
                              <span class="app-icon light print-icon"></span>
                              <span class="app-button-text">Download CSV</span>
                            </a>
                          </div>
                          <div id="additionalInfomation">
                            Additional data:
                            <a id="gifImage" href="" target="_blank">Image file</a>, 
                            <a id="gmtScriptFile" href="" target="_blank">GMT script file</a><br/> 
                          </div>
                        </div>
                        <div id="3DGMTEquakeGraph1" class="threeDGMTEquakeFlotGraph">
                          <b class="pointer"></b>
                          <div id="3DImage" class="ThreeDImage">
                            <div id="navigationBar" class="threeDNavigationBar">

                              <div id="previousButton"></div>
                              <div id="showAnimation"></div>
                              <div id="nextButton"></div>

                            </div>
                            <div id="title"></div>
                            <a href="" id="imageLink" target="_blank"><img height="1000" width="990" src="" id="image"/></a>
                          </div>

                          <div class="PrintButton" onclick="javascript:Wovodat.Printer.print({type:Wovodat.Printer.Printing.Type.THREED_GMT_EQUAKE,link:$('#image',document.getElementById('3DGMTEquakeGraph1'))[0].src,info:document.getElementById('VolcanoList').value})">
                            <a title="Print this graphs" href="#" >
                              <span class="app-icon light print-icon"></span>
                              <span class="app-button-text">Print Graph</span>
                            </a>
                          </div>
                          <div class="PrintButton" onclick="javascript:downloadCSV({cavw:document.getElementById('VolcanoList').value})" >
                            <a title="Print this graphs" href="#" >
                              <span class="app-icon light print-icon"></span>
                              <span class="app-button-text">Download CSV</span>
                            </a>
                          </div>
                          <div id="additionalInfomation">
                            Additional data:
                            <a id="gifImage" href=""  target="_blank">GIF image file</a>, 
                            <a id="gmtScriptFile" href="" target="_blank">GMT script file</a><br/> 
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="flowElement">
                    <div class="button white" style = "width:900px; " >

                      <div class="CloseButton" id="HideTimeSeriesPanel1"></div>
                      <table>
                        <tr>
                          <td valign="middle">
                           <span id="TimeSeriesHeader1" class="TimeSeriesHeader">
                            <a href="" onclick="return false;">Data Plots</a>
                          </span>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div id="TimeSeriesView1" class="timeSeriesView" style = "margin-left: 0px; display: none">
                    <iframe src="/eruption/index.php" frameborder="0", width="960" height="960"> </iframe>

                  </div>
                </div>
              </td>
              <td><div class="separator"></div></td>
              <td id="volcanoPanel2" class="volcanoPanel">
                <div class="button white" id = "mapBar2"style=" width:900px;margin-top:0px">
                  <div class="CloseButton" id="HideMap2"></div>
                  <table>
                    <tr>
                      <td valign="middle">
                        <span class="MapsHeader" id="ShowMap2">
                          <a href="" onclick="return false;"><b>View Map</b></a>
                        </span>
                      </td>
                    </tr>
                  </table>
                </div><div id="map_legend2" class="map_legend">
                <div style="float:right">
                  <button id="showHideMarkers2" class="showHideMarkerButton">
                    Hide earthquake
                  </button>
                </div>
                <div>
                  <img src="/img/pin_ds.png" alt=""/> Deformation
                  <img src="/img/pin_gs.png" alt=""/> Gas
                  <img src="/img/pin_hs.png" alt=""/> Hydrologic
                  <img src="/img/pin_ss.png" alt=""/> Seismic
                  <img src="/img/pin_ts.png" alt=""/> Thermal
                  <img src="/img/pin_ms.png" alt=""/> Meteo
                  <img src="/img/pin_fs.png" alt=""/> Field
                </div>
              </div>
              <div id="Map2">

              </div>
              <div class="button white">
                <div class="CloseButton" id="HideVolcanoInformation2"></div>
                <div style="float:right;padding-right: 10px">
                  <select id="CompVolcanoList">
                    <option value="">Select...</option>
                  </select>
                </div>    
                <table>
                  <tr>
                    <td valign="middle">
                      <span id="VolcanoInformation2" class="VolcanoComparisonHeader">
                        <a href="" onclick="return false;">Volcano Info:</a>
                      </td>
                      <tr>
                      </table>
                    </span>
                  </div>

                  <!-- HTML section of the region below Volcano Info tab of the second volcano -->
                  <div id="VolcanoPanel2" class="VolcanoPanel">

                    <table id="CompVolc" style="border-collapse:collapse;width:400px">

                      <tr>
                        <td rowspan="2">
                          <button class ="Gvp" id="gvp2">
                            Go to GVP
                          </button>
                        </td>
                        <td style="text-align:right" id="dataOwnerPanel">

                        </td>
                      </tr>
                      <tr>
                        <td style="text-align:right;height:5px"><span id="volcstatus2"></span></td>
                      </tr>

                      <tr>
                        <td style="text-align:right" colspan="2"><div style="height:5px"></div></td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <table>
                            <tr>
                              <td valign="top"style="text-align:left;height:5px;width:180px;"><b>Eruption:</b><br/>

                                <select id="CompEruptionList"  class="eruptionList">
                                </select>
                              </td>
                              <td colspan="2" style="height:20px;width:250px">
                                <div class="viewStationPanel">
                                  <button id="HideStationButton2" style="float:right;display:none">Hide Stations</button>
                                  <b title="Click to show on Map">Data stations:</b>
                                </div>
                                <table id="CompStationList" class="stationList"></table>
                              </td>

                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div class="button white">
                    <div class="CloseButton" id="HideEquake2"></div>
                    <table>
                      <tr>
                        <td valign="middle">
                          <span id="DisplayEquake2" class="VolcanoComparisonHeader">
                            <a href="" onclick="return false;">Earthquakes</a>
                          </span>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div id="EquakePanel2" class="EquakePanel">
                    <div class="FilterButton" id="FilterSwitch2"></div>
                    <form id="FormFilter2" class="FormFilter" onSubmit="return false;" style="display:none">
                      <div class="pointer"></div>
                      <div class="row">
                        <div class="leftPanel">No of events:</div>
                        <div class="rightPanel">
                          <select id="Evn2">
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                            <option value="1500">1500</option>
                            <option value="2000">2000</option>
                            <option value="2500">2500</option>
                            <option value="3000">3000</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="leftPanel">Catalog Owner:</div>
                        <div class="rightPanel">
                          <table id="cc_id2">
                            <tr>
                              <td><input type='checkbox' onClick="toggle(this,'cc_id2')" value="" id="cc_id2CheckBox0" checked/></td>
                              <td>All catalog owners</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="row">
                        <div class="leftPanel">Period:</div>
                        <div class="rightPanel">
                          <div class="subrow">
                            <table>
                              <tr>
                                <td>
                                  Start: <input type="text" id="SDate2" class="dateInput" size=10/> 
                                </td>
                                <td>
                                  End: <input type="text" id="EDate2" class="dateInput" size=10/>
                                </td>
                              </tr>
                            </table>
                          </div>
                          <div>
                            <div id="DateRange2"></div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="leftPanel">Depth (km):</div>
                        <div class="rightPanel">
                          <div class="subrow">
                            <table>
                              <tr>
                                <td>
                                  Start: <input type="text" id="DepthLow2" class="numberInput" value="0" size=4/>
                                </td>
                                <td>
                                  End: <input type="text" id="DepthHigh2" class="numberInput" value="40" size=4/>
                                </td>
                              </tr>
                            </table>
                          </div>
                          <div>
                            <div id="DepthRange2"></div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="leftPanel">Magnitude:</div>
                        <div class="rightPanel">
                          <div class="subrow">
                            <table>
                              <tr>
                                <td>
                                  Start: <input type="text" id="MagnitudeLow2" class="numberInput" value="0" size=4/>
                                </td>
                                <td>
                                  End: <input type="text" id="MagnitudeHigh2" class="numberInput" value="9" size=4/>
                                </td>
                              </tr>
                            </table>
                          </div>
                          <div>
                            <div id="MagnitudeRange2"></div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="leftPanel">Type:</div>
                        <div class="rightPanel">
                          <table id="EqType2">
                            <tr>
                              <td><input type='checkbox' onClick="toggle(this,'EqType2')" value="" id="EqType2CheckBox0" checked/></td>
                              <td>All earthquake types</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="row">
                        <div class="leftPanel">Map Width (km):</div>
                        <div class="rightPanel">
                          <select id="wkm2">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                          </select>
                        </div>
                      </div>                      
                      <div class="threeDGMTFilter">
                        For drawing in 3D-GMT only:
                      </div>
                      <div class="row">
                        <div class="leftPanel">Azimuth:</div>
                        <div class="rightPanel">
                          <input type="text" id="azim2" class="numberInput" value="175" size="10"/>
                        </div>
                      </div>
                      <div class="row">
                        <div class="leftPanel">Rotation Degree:</div>
                        <div class="rightPanel">
                          <input type="text" id="degree2" class="numberInput" value="30" size="10"/>
                        </div>
                      </div>
                      <div class="FilterBtnHolder">
                        <button id="FilterBtn2" class="FilterBtn">Filter</button>
                      </div>
                    </form>
                    <div class="equakeButtonsRow">
                      <label for="equakeDisplayType22D" class="equakeDisplayBox equakeDisplayBox2">
                        <input type="radio" name="equakeDisplayType2" id="equakeDisplayType22D" value="2D" onclick="drawEquake({mapUsed:2,source:this})"/>
                        2D
                      </label>
                      <label for="equakeDisplayType22DGMT" class="equakeDisplayBox equakeDisplayBox2">
                        <input type="radio" name="equakeDisplayType2" id="equakeDisplayType22DGMT" value="2D(GMT)" onclick="drawEquake({mapUsed:2,source:this})"/>2D(GMT)
                      </label>
                      <label for="equakeDisplayType23D" class="equakeDisplayBox equakeDisplayBox2">
                        <input type="radio" name="equakeDisplayType2" id="equakeDisplayType23D" value="3D(GMT)" onclick="drawEquake({mapUsed:2,source:this})"/>3D(GMT)
                      </label>
                    </div>
                    <!-- place holders for the 2D Flot graph-->
                    <div id="equakeGraphs2">
                      <div id="twoDEquakeFlotGraph2" class="twoDEquakeFlotGraph">
                        <div class="row">
                          <div class="leftPanel" id="eqEvent2"></div>
                          <div class="leftPanel" id="owner2"></div>
                        </div>
                        <div class="plot-label">
                          <b>E-W</b>
                        </div>
                        <div id="FlotDisplayLat2" class="equakeGraphPlaceholder_v6">

                        </div>
                        <div class="plot-label">
                          <b>N-S</b>
                        </div>
                        <div id="FlotDisplayLon2" class="equakeGraphPlaceholder_v6">
                        </div>
                        <div class="plot-label">
                          <b>Time</b>
                        </div>
                        <div id="FlotDisplayTime2" class="equakeGraphPlaceholder_v6">
                        </div>
                        <div class="PrintButton" onclick="javascript:Wovodat.Printer.print({type:Wovodat.Printer.Printing.Type.TWOD_EQUAKE,element:document.getElementById('equakeGraphs2'),mapUsed:2,equakeGraph:equakeGraphs[2],info:document.getElementById('CompVolcanoList').value})">
                          <a title="Print this graphs" href="#" >
                            <span class="app-icon light print-icon"></span>
                            <span class="app-button-text">Print</span>
                          </a>
                        </div>
                      </div>
                      <div id="2DGMTEquakeGraph2" class="twoDGMTEquakeFlotGraph">
                        <b class="pointer"></b>
                        <div id="2DImage" class="TwoDImage">
                          <a href="" id="imageLink" target="_blank"><img height="707" width="495" src="" id="image"/></a>
                        </div>
                        <div class="PrintButton" onclick="javascript:Wovodat.Printer.print({type:Wovodat.Printer.Printing.Type.TWOD_GMT_EQUAKE,link:$('#image',document.getElementById('equakeGraphs2'))[0].src,info:document.getElementById('CompVolcanoList').value})">
                          <a title="Print this graphs" href="#" >
                            <span class="app-icon light print-icon"></span>
                            <span class="app-button-text">Print</span>
                          </a>
                        </div>
                        <div id="additionalInfomation">
                          Additional data:
                          <a id="gifImage" href="" target="_blank">Image file</a>, 
                          <a id="gmtScriptFile" href="" target="_blank">GMT script file</a><br/> 
                        </div>
                      </div>
                      <div id="3DGMTEquakeGraph2" class="threeDGMTEquakeFlotGraph">
                        <b class="pointer"></b>
                        <div id="3DImage" class="ThreeDImage">
                          <div id="navigationBar" class="threeDNavigationBar">

                            <div id="previousButton"></div>
                            <div id="showAnimation"></div>
                            <div id="nextButton"></div>

                          </div>
                          <div id="title"></div>
                          <a href="" id="imageLink" target="_blank"><img height="500" width="495" src="" id="image"/></a>
                        </div>
                        <div class="PrintButton" onclick="javascript:Wovodat.Printer.print({type:Wovodat.Printer.Printing.Type.THREED_GMT_EQUAKE,link:$('#image',document.getElementById('3DGMTEquakeGraph2'))[0].src,info:document.getElementById('CompVolcanoList').value})">
                          <a title="Print this graphs" href="#" >
                            <span class="app-icon light print-icon"></span>
                            <span class="app-button-text">Print</span>
                          </a>
                        </div>
                        <div id="additionalInfomation">
                          Additional data:
                          <a id="gifImage" href="" target="_blank">GIF image file</a>, 
                          <a id="gmtScriptFile" href="" target="_blank">GMT script file</a><br/> 
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="button white" >
                    <div class="CloseButton" id="HideTimeSeriesPanel2"></div>
                    <table>
                      <tr>
                        <td valign="middle">
                          <span id="TimeSeriesHeader2" class="TimeSeriesHeader">
                            <a href="" onclick="return false;">Data Plots</a>
                          </span>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <div id="TimeSeriesView2" class="timeSeriesView" style = "margin-left: 0px;">
                    <iframe src="/eruption/index.php" frameborder="0", width="470" height="960"> </iframe>

                  </div>
                  <!--                                <div id="TimeSeriesView2" class="timeSeriesView">-->
                  <!--                                    <div id="OptionList2">-->
                  <!--                                        <b>Available time series data (max. 3):</b>-->
                  <!--                                        <div id="OptionList2-1">-->
                  <!--                                            <table id="TimeSeriesList2" class="timeSeriesList">-->
                  <!---->
                  <!--                                            </table>-->
                  <!--                                        </div>-->
                  <!--                                    </div>-->
                  <!--                                    <br/>-->
                  <!--                                    <div id="overviewPanel2" class="overviewPanel">-->
                  <!--                                        <b>Overview (select a range to redraw the graph): </b>-->
                  <!--                                        <div id="overview2"  class="overviewGraph">-->
                  <!---->
                  <!--                                        </div>-->
                  <!--                                        <br/>-->
                  <!--                                    </div>-->
                  <!--                                    <div style="clear:both;" id="PlotArea2">-->
                  <!--                                        <table id="GraphList2">-->
                  <!--                                        </table>-->
                  <!--                                    </div>-->
                  <!--                                    <div class="PrintButton" id="printButton" onclick="javascript:Wovodat.Printer.print({type:Wovodat.Printer.Printing.Type.TIME_SERIES,graphsTable: document.getElementById('GraphList2'),graphsPlot:graphs,info:document.getElementById('CompVolcanoList').value})">-->
                  <!--                                        <a title="Print this graphs" href="#" >-->
                  <!--                                            <span class="app-icon light print-icon"></span>-->
                  <!--                                            <span class="app-button-text">Print</span>-->
                  <!--                                        </a>-->
                  <!--                                    </div>-->
                  <!--                                </div>-->
                </td>
              </tr>

            </table>

          </div><!-- end of content -->
        </div><!-- end of container --> 
        <div class = "push" style = "height:100px"></div>
        <!-- Footer-->
        <div id = "wrapborder_x">
          <!-- <?php //include 'php/include/footer.php'; ?> -->
          <?php include 'php/include/footer_main_beta.php'; ?>
        </div>
        <!-- // <script type="text/javascript" src="js/vendor/requirejs/require.js" data-main="js/main"></script> -->
    </body>
</html>
 