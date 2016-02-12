<?php

// Initialize returned variables
// rsam

$type=ucfirst(substr($datatype,3,strlen($datatype)));

$gd_plu_cnt=array();
$gd_plu_cnt[0]=array();
$gd_plu_cnt[0]['values']=array();
$gd_plu_cnt[0]['points']=TRUE;
$gd_plu_cnt[0]['lines']=FALSE;
$gd_plu_cnt[0]['bars']=FALSE;
$gd_plu_cnt[0]['color']=NULL;
$gd_plu_cnt[0]['label']='SO2 emission';

// Loop on results
while ($row=mysql_fetch_object($result)) {
	if($row->gd_plu_species=="SO2"){
		// x
		$x=($row->t)*1000;
		// y
		$y=$row->gd_plu_emit;

		// New values
			array_push($gd_plu_cnt[0]['values'], array('x' => $x, 'y' => $y));
	}
}


// Prepare div to contain graphs
$pluxdisp="plu_disp".$nvol."_x";
$pluydisp="plu_disp".$nvol."_y";
echo <<<STRING
	<div id="plu_graph" style="float:left;">
		<div style="float:bottom; width:300px;height:150px;align:center;" id="plu_disp$nvol"></div>
			<p style="clear:both; font-size:8px;">Date: <span id="$pluxdisp"></span><span>&nbsp&nbsp Count:</span><span id="$pluydisp"></span></p>
	</div>
STRING;
echo <<<STRING
		<div style="clear:both; visibility:hidden; height:0px;">.</div>
STRING;

// Call flot function for displaying graph
include_once "php/funcs/flot_funcs.php";
flot_plot_time($gd_plu_cnt, "plu_disp$nvol");
?>