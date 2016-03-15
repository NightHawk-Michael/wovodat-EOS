<?php

// Initialize returned variables
// Edm displacement

$type=ucfirst(substr($datatype,3,strlen($datatype)));
$dd_edm_line=array();
$dd_edm_line[0]=array();
$dd_edm_line[0]['values']=array();
$dd_edm_line[0]['points']=TRUE;
$dd_edm_line[0]['lines']=TRUE;
$dd_edm_line[0]['bars']=FALSE;
$dd_edm_line[0]['color']=NULL;
$dd_edm_line[0]['label']=$type;

$dd_edm_line2=array();
$dd_edm_line2[0]=array();
$dd_edm_line2[0]['values']=array();
$dd_edm_line2[0]['points']=TRUE;
$dd_edm_line2[0]['lines']=TRUE;
$dd_edm_line2[0]['bars']=FALSE;
$dd_edm_line2[0]['color']=NULL;
$dd_edm_line2[0]['label']=$type;

$dd_edm_line3=array();
$dd_edm_line3[0]=array();
$dd_edm_line3[0]['values']=array();
$dd_edm_line3[0]['points']=TRUE;
$dd_edm_line3[0]['lines']=TRUE;
$dd_edm_line3[0]['bars']=FALSE;
$dd_edm_line3[0]['color']=NULL;
$dd_edm_line3[0]['label']=$type;

$refl1="";
$refl2="";
$refl3="";
// Loop on results
while ($row=mysql_fetch_object($result)) {
	$s++;
	$refl=$row->ds_id2;
	$reflname=$row->ds_name;
	if($s==1) {
		$nref==1;
		$refl1=$refl;
		$refl1name=$reflname;
	}else{
		if($refl!=$refl1) {
			$nref=2;
			$refl2=$refl;
			$refl2name=$reflname;
		}
		if($nref==2 && $refl!=$refl1 && $refl!=$refl2){
			$nref=3;
			$refl3=$refl;
			$refl3name=$reflname;
		}
	}
	// x
	$x=($row->t)*1000;
	
	// y
	$dd_edm_line_y=$row->dd_edm_line;

	// New values
	if($refl==$refl1){
		array_push($dd_edm_line[0]['values'], array('x' => $x, 'y' => $dd_edm_line_y));
	}else{
		if($refl==$refl2){
			array_push($dd_edm_line2[0]['values'], array('x' => $x, 'y' => $dd_edm_line_y));
		}else{
			array_push($dd_edm_line3[0]['values'], array('x' => $x, 'y' => $dd_edm_line_y));
		}
	}
}
// Prepare div to contain graphs
echo <<<STRING
	<div id="edm_graph" style="float:left;">
		<div style="float:bottom; width:300px;height:150px;align:center;" id="edm_disp"></div>
			<p style="clear:both; font-size:smaller;">Reflector: '$refl1name'&nbsp&nbsp<span id="edm_disp_x"></span><span>&nbsp&nbsp</span><span id="edm_disp_y"></span>
	</div>
STRING;
if($nref>=2){
echo <<<STRING
	<div id="edm2_graph" style="float:left; margin-left:5px;">
		<div style="float:bottom; width:300px;height:150px;align:center;" id="edm2_disp"></div>
			<p style="clear:both; font-size:smaller;">Reflector: '$refl2name'&nbsp&nbsp<span id="edm2_disp_x"></span><span>&nbsp&nbsp</span><span id="edm2_disp_y"></span>
	</div>
STRING;
}
echo <<<STRING
		<div style="clear:both; visibility:hidden; height:0px;">.</div>
STRING;

// Call flot function for displaying graph
include_once "php/funcs/flot_funcs.php";
flot_plot_time($dd_edm_line, "edm_disp");
flot_plot_time($dd_edm_line2, "edm2_disp");
?>