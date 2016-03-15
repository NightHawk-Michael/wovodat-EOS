<?php

// Initialize returned variables
// North displacement
$dd_gpv_N=array();
$dd_gpv_N[0]=array();
$dd_gpv_N[0]['values']=array();
$dd_gpv_N[0]['points']=TRUE;
$dd_gpv_N[0]['lines']=TRUE;
$dd_gpv_N[0]['bars']=FALSE;
$dd_gpv_N[0]['color']=NULL;
$dd_gpv_N[0]['label']="North displ.";
$dd_gpv_E=array();
$dd_gpv_E[0]=array();
$dd_gpv_E[0]['values']=array();
$dd_gpv_E[0]['points']=TRUE;
$dd_gpv_E[0]['lines']=TRUE;
$dd_gpv_E[0]['bars']=FALSE;
$dd_gpv_E[0]['color']=NULL;
$dd_gpv_E[0]['label']="East displ.";
$dd_gpv_vert=array();
$dd_gpv_vert[0]=array();
$dd_gpv_vert[0]['values']=array();
$dd_gpv_vert[0]['points']=TRUE;
$dd_gpv_vert[0]['lines']=TRUE;
$dd_gpv_vert[0]['bars']=FALSE;
$dd_gpv_vert[0]['color']=NULL;
$dd_gpv_vert[0]['label']="Vert. displ.";

// Loop on results
while ($row=mysql_fetch_object($result)) {
	// x
	$x=($row->t)*1000;
	
	// y
	$dd_gpv_N_y=$row->dd_gpv_N;
	$dd_gpv_E_y=$row->dd_gpv_E;
	$dd_gpv_vert_y=$row->dd_gpv_vert;
	
	// New values
	array_push($dd_gpv_N[0]['values'], array('x' => $x, 'y' => $dd_gpv_N_y));
	array_push($dd_gpv_E[0]['values'], array('x' => $x, 'y' => $dd_gpv_E_y));
	array_push($dd_gpv_vert[0]['values'], array('x' => $x, 'y' => $dd_gpv_vert_y));
}
// Prepare div to contain graphs
$nxdisp="north_disp".$nvol."_x";
$nydisp="north_disp".$nvol."_y";
$exdisp="east_disp".$nvol."_x";
$eydisp="east_disp".$nvol."_y";
$vxdisp="vert_disp".$nvol."_x";
$vydisp="vert_disp".$nvol."_y";
echo <<<STRING
								<div id="north_graph$nvol" style="float:left;">
									<div style="float:bottom; width:250px;height:100px;align:center;" id="north_disp$nvol"></div>
									<p style="clear:both; font-size:smaller;">Date: <span id="$nxdisp"></span>, displ.:<span id="$nydisp"></span>
								</div>
								<div id="east_graph$nvol" style="float:left; margin-left:5px;">
									<div style="float:bottom; width:250px;height:100px;align:center;" id="east_disp$nvol"></div>
									<p style="clear:both; font-size:smaller;">Date: <span id="$exdisp"></span>, displ.:<span id="$eydisp"></span>
								</div>
								<div id="vert_graph$nvol" style="float:left; margin-top:5px;">
									<div style="float:bottom; width:250px;height:100px;align:center;" id="vert_disp$nvol"></div>
									<p style="clear:both; font-size:smaller;">Date: <span id="$vxdisp"></span>, displ.:<span id="$vydisp"></span>
								</div>
								<div style="clear:both; visibility:hidden; height:0px;">.</div>
STRING;

// Call flot function for displaying graph
include_once "php/funcs/flot_funcs.php";
flot_plot_time($dd_gpv_N, "north_disp$nvol");
flot_plot_time($dd_gpv_E, "east_disp$nvol");
flot_plot_time($dd_gpv_vert, "vert_disp$nvol");
?>