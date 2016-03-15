<?php

// Initialize returned variables
// Edm displacement

$type=ucfirst(substr($datatype,3,strlen($datatype)));
$sd_sam_count=array();
$sd_sam_count[0]=array();
$sd_sam_count[0]['values']=array();
$sd_sam_count[0]['points']=TRUE;
$sd_sam_count[0]['lines']=FALSE;
$sd_sam_count[0]['bars']=FALSE;
$sd_sam_count[0]['color']=NULL;
$sd_sam_count[0]['label']=$type;

// Loop on results
while ($row=mysql_fetch_object($result)) {
	// x
	$x=($row->t)*1000;
	
	// y
	$sd_sam_count_y=$row->sd_rsm_count;

	// New values
		array_push($sd_sam_count[0]['values'], array('x' => $x, 'y' => $sd_sam_count_y));
}
// Prepare div to contain graphs
$samxdisp="sam_disp".$nvol."_x";
$samydisp="sam_disp".$nvol."_y";
echo <<<STRING
	<div id="sam_graph" style="float:left;">
		<div style="float:bottom; width:300px;height:150px;align:center;" id="sam_disp$nvol"></div>
			<p style="clear:both; font-size:smaller;">Date: <span id="$samxdisp"></span><span>&nbsp&nbsp</span><span id="$samydisp"></span>
	</div>
STRING;
echo <<<STRING
		<div style="clear:both; visibility:hidden; height:0px;">.</div>
STRING;

// Call flot function for displaying graph
include_once "php/funcs/flot_funcs.php";
flot_plot_time($sd_sam_count, "sam_disp$nvol");
?>