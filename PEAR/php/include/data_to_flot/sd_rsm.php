<?php

// Initialize returned variables
// rsam

$type=ucfirst(substr($datatype,3,strlen($datatype)));

$sd_rsam_cnt=array();
$sd_rsam_cnt[0]=array();
$sd_rsam_cnt[0]['values']=array();
$sd_rsam_cnt[0]['points']=TRUE;
$sd_rsam_cnt[0]['lines']=FALSE;
$sd_rsam_cnt[0]['bars']=FALSE;
$sd_rsam_cnt[0]['color']=NULL;
$sd_rsam_cnt[0]['label']=$type;

// Loop on results
while ($row=mysql_fetch_object($result)) {
    // x
    $x=($row->t)*1000;
    // y
    $sd_rsm_count_y=$row->sd_rsm_count;

    // New values
    array_push($sd_rsam_cnt[0]['values'], array('x' => $x, 'y' => $sd_rsm_count_y));
}
// Prepare div to contain graphs
$rsamxdisp="rsam_disp".$nvol."_x";
$rsamydisp="rsam_disp".$nvol."_y";
echo <<<STRING
	<div id="rsam_graph" style="float:left;">
		<div style="float:bottom; width:300px;height:150px;align:center;" id="rsam_disp$nvol"></div>
			<p style="clear:both; font-size:8px;">Date: <span id="$rsamxdisp"></span><span>&nbsp&nbsp Rsam:</span><span id="$rsamydisp"></span></p>
	       <div style="text-align:center;font-size:8px">
            <button type="submit" onclick="undoPlotGraph$nvol()">
                <img src="/img/undo.png" alt="Undo"align="absmiddle" style="height:8px;width:8px;"/>
            </button>
            <button type="submit" onclick="redoPlotGraph$nvol()">
                <img src="/img/redo.png" alt="Redo"align="absmiddle" style="height:8px;width:8px;"/>
            </button>
            <input type="radio" name="graphExpandMethod$nvol" class ="graphExpandMethod$nvol" id="panGraphExpandMethod$nvol" checked="checked" onchange="changeGraphExpandMethod$nvol();">Pan
            <input type="radio" name="graphExpandMethod$nvol" class ="graphExpandMethod$nvol" id="rectangleGraphExpandMethod$nvol"onchange="changeGraphExpandMethod$nvol()">Zoom
        </div>
</div>
STRING;
echo <<<STRING
		<div style="clear:both; visibility:hidden; height:0px;">.</div>
STRING;

?>

<?php

// Call flot function for displaying graph
include_once "php/funcs/flot_funcs.php";
?>
<?php
flot_plot_time($sd_rsam_cnt, "rsam_disp$nvol");
?>

