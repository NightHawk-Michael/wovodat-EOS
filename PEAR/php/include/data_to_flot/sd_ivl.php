<?php

// Initialize returned variables
// rsam

$type=ucfirst(substr($datatype,3,strlen($datatype)));

$sd_ivl_cnt=array();
$sd_ivl_cnt[0]=array();
$sd_ivl_cnt[0]['values']=array();
$sd_ivl_cnt[0]['points']=FALSE;
$sd_ivl_cnt[0]['lines']=FALSE;
$sd_ivl_cnt[0]['bars']=TRUE;
$sd_ivl_cnt[0]['color']=NULL;
$sd_ivl_cnt[0]['label']='Seismic Count';

// Loop on results
while ($row=mysql_fetch_object($result)) {
	// x
	$x=($row->t)*1000;
	// y
	$y=$row->sd_ivl_nrec;

	// New values
		array_push($sd_ivl_cnt[0]['values'], array('x' => $x, 'y' => $y));
}


// Prepare div to contain graphs
$ivlxdisp="ivl_disp".$nvol."_x";
$ivlydisp="ivl_disp".$nvol."_y";
echo <<<STRING
	<div id="ivl_graph" style="float:left;">
		<div style="float:bottom; width:300px;height:150px;align:center;" id="ivl_disp$nvol"></div>
			<p style="clear:both; font-size:8px;">Date: <span id="$ivlxdisp"></span><span>&nbsp&nbsp Count:</span><span id="$ivlydisp"></span></p>
	</div>
STRING;
echo <<<STRING
		<div style="clear:both; visibility:hidden; height:0px;">.</div>
STRING;

// Call flot function for displaying graph
include_once "php/funcs/flot_funcs.php";
flot_plot_time($sd_ivl_cnt, "ivl_disp$nvol");
?>