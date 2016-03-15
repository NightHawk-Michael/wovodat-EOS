<?php

// Initialize returned variables
// rsam

$type=ucfirst(substr($datatype,3,strlen($datatype)));

$td_val=array();
$td_val[0]=array();
$td_val[0]['values']=array();
$td_val[0]['points']=TRUE;
$td_val[0]['lines']=FALSE;
$td_val[0]['bars']=FALSE;
$td_val[0]['color']=NULL;
$td_val[0]['label']='Temperature';

// Loop on results
while ($row=mysql_fetch_object($result)) {
		// x
		$x=($row->t)*1000;
		// y
		$y=$row->td_temp;

		// New values
			array_push($td_val[0]['values'], array('x' => $x, 'y' => $y));
}


// Prepare div to contain graphs
$thexdisp="the_disp".$nvol."_x";
$theydisp="the_disp".$nvol."_y";
echo <<<STRING
	<div id="the_graph" style="float:left;">
		<div style="float:bottom; width:300px;height:150px;align:center;" id="the_disp$nvol"></div>
			<p style="clear:both; font-size:8px;">Date: <span id="$thexdisp"></span><span>&nbsp&nbsp Count:</span><span id="$theydisp"></span></p>
	</div>
STRING;
echo <<<STRING
		<div style="clear:both; visibility:hidden; height:0px;">.</div>
STRING;

// Call flot function for displaying graph
include_once "php/funcs/flot_funcs.php";
flot_plot_time($td_val, "the_disp$nvol");
?>