<?php
//========================= function for plotting wovoml array w/ jquery -->
function flotwomlplot($arry,$technic,$divId){ //array must be in wovoml structure
	require "./flot_woml2serial.php";
	require_once "./f2genfunc/funcgen_datetime.php";	
	$fnm="woml2".$technic."serial"; //------ construct function name
	echo "TRIAL 3:".$fnm;
	$dataflot=$fnm($arry); //------ read $arry and create flot's series
	echo "TRIAL 4";
	print_ary($dataflot,1);

		
	echo '<script type="text/javascript">/* <![CDATA[ */'; // copy to javascript array
  echo 'var datan = '.json_encode($dataflot);
  echo '/* ]]> */</script>';
?>

<script language="javascript" type="text/javascript">
	function aryofobject(label,data){
		this.label=label;
		this.data=data;
	};
	$(function(){
		var a=datan.length;
		var b=datan[0].length; b=(b-1)/2;
		var data = new Array();	//Create a new 1D array
	
		for(i=0;i<a;i++){
			data[i] = new Array();	//Create another array inside data[] array
	 		for(j=0;j<b;j++){
				var k=j*2+1; var l=k+1; // data starts from "1"; dataflot[0] is only label
				data[i][j] = new Array();	//Create another array inside data[] array
				data[i][j][0] = datan[i][k];	//Adding even index data to the X data array
				data[i][j][1] = datan[i][l];	//Adding odd index data to the Y data array
		}	}

		var iselect=0;var isel=3; // for future selection if necessary
		for(i=0;i<a;i++){
			var labl=datan[i][0];
			if(iselect==1){
				if(i==isel)data[0]=new aryofobject(labl,data[i]);
			}else{
				data[i]=new aryofobject(labl,data[i]);}
		}

		var options = {
			legend: {show:true},
			series: {points: {show:true,radius:1},lines: {show:true, lineWidth:1},bars: {show:false,barWidth:0.5, series_spread: true, align: "center" }},
			colors:["#994444"],
			grid:{backgroundColor:{colors:["#eeeedd","#ffffcc"]},clickable: true,autoHighlight: true}
		};

		var plotarea=$("#"+"<?= $divId ?>");
		plotarea.css("height", "180px"); plotarea.css("width", "360px");
		$.plot( plotarea, data, options);
		$("#"+"<?= $divId ?>").bind("plotclick", function (event, pos, item){
			var posx=pos.x; var posy=pos.y;
			var pox=posx.toFixed(2);	
			var poy=posy.toFixed(2);	
			alert("Point "+ pox + ", " +poy);
		});
	});
</script>

<?php 
}
// function for plotting simple($ar="1") or x-y($ar="2") series w/ jquery -->
//================== array(x1,y1,x2,y2,x3,y3,...etc) 
function flotseriesplot($ary,$divId,$ar){ //array must be in wovoml structure
	print_ary($ary,1);
	echo '<script type="text/javascript">/* <![CDATA[ */'; //pass into javascript array
  echo 'var datan = '.json_encode($ary);
  echo '/* ]]> */</script>';
?>
<script language="javascript" type="text/javascript">
	function aryofobject(label,data){
		this.label=label;
		this.data=data;
	};
	$(function(){
		var sr="<?= $ar ?>";
		var b=datan.length; if(sr==2)b=b/2;
		var data = new Array();	//Create a new 1D array
		data[0] = new Array();	//Create another array inside data[] array
	 		for(j=0;j<b;j++){
				if(sr==2){
					var k=j*2; var l=k+1; // data starts from "1"; dataflot[0] is only label
					data[0][j] = new Array();	//Create another array inside data[] array
					data[0][j][0] = datan[k];	//Adding even index data to the X data array
					data[0][j][1] = datan[l];	//Adding odd index data to the Y data array
				}else{
					data[0][j] = new Array();	//Create another array inside data[] array
					data[0][j][0] = j;	//Adding even index data to the X data array
					data[0][j][1] = datan[j];	//Adding odd index data to the Y data array
				}
			}
		var labl="series";
		data[0]=new aryofobject(labl,data[0]);

		var options = {
			legend: {show:true},
			series: {points: {show:true,radius:2},lines: {show:true,lineWidth:1},bars: {show:false,barWidth:1.0 }},
			colors:["#994444"],
			grid:{backgroundColor:{colors:["#eeeedd","#ffffcc"]},clickable: true,autoHighlight: true}
		};

		var plotarea=$("#"+"<?= $divId ?>");
		plotarea.css("height", "180px"); plotarea.css("width", "360px");
		$.plot( plotarea, data, options);
		$("#"+"<?= $divId ?>").bind("plotclick", function (event, pos, item){
			var posx=pos.x; var posy=pos.y;
			var pox=posx.toFixed(2);	
			var poy=posy.toFixed(2);	
			alert("Point "+ pox + ", " +poy);
		});
	});
</script>
<?php 
}
?>


