<?php
if (!isset($_SESSION))   // Added on 21-Mar-2013	 
    session_start();  // Start session

/* Nang commented on 25-Feb-2013
session_regenerate_id(true);// Regenerate session ID
$uname="";
$ccd="";

if(isset($_SESSION['login'])) {
	$uname=$_SESSION['login']['cr_uname'];
	$ccd=$_SESSION['login']['cc_id'];
}
else{
header('Location: '.$url_root.'login_required.php');// Session was not yet started.... Redirect to login required page
exit();
}
*/

if(!isset($_GET['obs'])){
header('Location: '.$url_root.'home_populate.php');
exit();
}

$ccd=$_SESSION['login']['cc_id'];   // Added on 21-Mar-2013	 
?>
<html>
<script src="/js/jquery-1.4.2.min.js"></script>
<script language='javascript' type='text/javascript'>
	
	$(document).ready(function(){
		
		$("form").submit(function (event) {

			if ($("select#conv").val() == "") {
				alert("Select a datatype");
				event.preventDefault();
			}

			return true;
		});

		loadconvert();

		
		$("select#conv").live('click', function() {		
			checkvolcano();
		}); 
		
		
		function checkvolcano(){    // if nothing select in volcano box, then don't load convert value..
			
			var dataType = $("select#conv").val();
			var institute = $("select#observ").val();
			if(dataType != ''){
				loadvolcano(institute);   
			}else{
				$('select#vol2').remove();                  //Remove volcano drop down box 
				$('#pvol').remove();                        //Remove volcano text 
			}	
			resetall();

		}
		
		function resetall(){
			
			$('select#station').remove();
			$('#id_net_stat_text').remove();
			$('h1').remove();
			
			$('#kmeter').val('40');
			$('#kilometer').css("display","none");			
			$('.spaceid').remove();
		
			$('select#instrument').remove();
			$('#id_inst_text').remove();
			
			$('#dd_tlt_processtype').val('P');
			$('#processtype').css("display","none");

			$('#SamplingRate').val('1');	
			$('#SamplingRateDiv').css("display","none");
			
			$('#CodeOfRsam').val('');	
			$('#RsamDiv').css("display","none");			
			
		}


		function loadvolcano(institute){
			
			$('#volblockSpecific').load('./convertie/selectVolOfInstitute2_ng.php',"kode=" + institute); 
			return false;
		}

		function loadconvert() {

			$('#conv').html('<option selected="selected" value="" >...</option><option value="IntervalSwarmData">IntervalSwarmData</option><option value="ElectronicTiltData">ElectronicTiltData</option><option value="PostElectronicTiltData">ElectronicTiltData(Post Processed)</option><option value="RSAM">RSAM</option>');
		}
		

		function changeFormActionSubmit(stationvalue){
		
			if (stationvalue == "IntervalSwarmData" || stationvalue == "ElectronicTiltData") {
				$("form").attr("action","./convertie/phivolcs/commonconvertspecific_phivolcs.php");
				oneFile();
				
			}
			else if (stationvalue == "PostElectronicTiltData") {
				$("form").attr("action","./convertie/phivolcs/ConversionToXml.php?monidata=specific");
				twoFile();
		
			}
			else if (stationvalue == "RSAM") {
				$("form").attr("action","./convertie/phivolcs/ConversionToXml.php?monidata=specific");
				oneFile();
			}
		} 


		function oneFile(){
			$('#submit_form2').remove();
			$('#uploadfile').html('<div id="submit_form" style="padding-left:20px;">Browse file to convert:<br><input name="MAX_FILE_SIZE" type="hidden" value="2000000"/><input name="fileLinks" type="hidden" value ="fname"><input name="fname" type="file" size="45" maxlength="100"><br><input type="submit" name="Submit" id="Submit" value="Select">');		
		
		}
		
		function twoFile(){
			$('#submit_form').remove();
			$('#uploadfile').html('<div id="submit_form2" style="padding-left:20px;">Browse Radial or X Component file  to convert:<br><input name="MAX_FILE_SIZE" type="hidden" value="2000000"/><input name="fileLinks" type="hidden" value ="fname"><input name="fname[]" type="file" size="45" maxlength="100"><br>Browse Tangential or Y Component file to convert:<br><input name="fname[]" type="file" size="45" maxlength="100"><br><input type="submit" name="Submit" id="Submit" value="Select">');		
		}


		$("select#vol2").live('click', function() {	
		
			var stationvalue=$('#conv').attr('value');   //get File content to convert value 
	
			resetall();		 // Reset all like first time page starts loading		
		
			changeFormActionSubmit(stationvalue);            //change form action
		
			if(stationvalue != ''){
			
				var sg = document.form1.vol2.selectedIndex;   // get volcano index 
				var sgu = document.form1.vol2.options[sg].value;  //get volcano value
				
				var stationdisplay=$("#conv option:selected").val();  //get station "display" value
			
				if(stationvalue == "ElectronicTiltData" || stationvalue=="IntervalSwarmData" || stationvalue == "PostElectronicTiltData" || stationvalue == "RSAM" ){
					
					
					$.get('./convertie/selectcheckstation_specific_ng.php','volcan='+sgu+ '&stationdisplay='+stationvalue,function(result){  
					
						var check_sn_jj = result;
									
						if(check_sn_jj == "true"){
						
							$('#stationform').load('./convertie/selectStation_specific_ng.php','volcan='+sgu+ '&stationdisplay='+stationvalue+ '&kilometer=nokilometer');
									
						}
						else{
							$('#kilometer').css("display","block");
							showkilometer();
						}
					});					
				}     

			}else{	
				resetall();		 // Reset all like first time page starts loading
			}
		}); 

		$("select#kmeter").live('click', function() {
			showkilometer();
		});
		
		function showkilometer(){
		
			$('#Submit').removeAttr("disabled");  //Reset enable button
					
			var kilometervalue=$('#kmeter').attr('value');   //get kilo meter value
			
			var sg = document.form1.vol2.selectedIndex;   // get volcano index 
			var sgu = document.form1.vol2.options[sg].value;  //get volcano value
			
			var stationvalue=$('#conv').attr('value');   //get File content to convert value 

			$('#stationform').load('./convertie/selectStation_specific_ng.php','volcan='+sgu+'&stationdisplay='+stationvalue+ '&kilometer=' +kilometervalue);
		
		}			
				
		$("select#station").live('click',function() {   // click station dropdown
			
			$('select#instrument').remove();
			$('#id_inst_text').remove();
			
			var stationname=$("#station option:selected").text();  //get station name		
			
			var sg = document.form1.vol2.selectedIndex;   // get volcano index 
			var sgu = document.form1.vol2.options[sg].value;  //get volcano value		

			var contypevalue=$('#conv').attr('value');   //get File content to convert value 
			var stationdisplay=$("#conv option:selected").text();  //get station "display" value
		
			var station_value=$('#station').attr('value');    // Get station value 
			
			if(contypevalue == "ElectronicTiltData") {
			
				$('#dd_tlt_processtype').val('P');
				$('#processtype').css("display","block");

				if(station_value != 'Choose Station'){
				
					$('#instrumentform').load('./convertie/selectInstrument_specific_ng.php','volcan='+sgu+ '&stationdisplay='+contypevalue+ '&staname='+stationname);
				}
			}
			else if(contypevalue == "PostElectronicTiltData") {
			
				$('#SamplingRate').val('1');	
				$('#SamplingRateDiv').css("display","block");
				
		
				if(station_value != 'Choose Station'){
				
					$('#instrumentform').load('./convertie/selectInstrument_specific_ng.php','volcan='+sgu+ '&stationdisplay='+contypevalue+ '&staname='+stationname);
				}
			}
			else if(contypevalue == "RSAM") {
			
				$('#CodeOfRsam').val('');	
				$('#RsamDiv').css("display","block");
			}			
		});
	});
		
	</script>

<div style="padding:0px 0px 0px 5px;">
<h2>Conversion of Customary-format Data </h2>
<br/>

<form name="form1" id="form1" action="" method="post" enctype="multipart/form-data">

	<div id="lfleft" style="width:5%;"></div>
        <div style="width:40%;  padding-left:90px;">
            <p1>Observatory (data owner): </p1><br>
            <div id='observo'>
                <select name='observ' id='observ' style="width:180px;">
                <option selected="selected" value="PHIVOLCS" title="Philippine Institute of Volcanology and          Seismology">Philippines,PHIVOLCS</option>
                </select>
            </div>
        </div>
		
		<div style="width:10%;">&nbsp;</div>
		<div style="width:40%;  padding-left:90px;">
			<p1>Data owner 2 (Optional): </p1><br>
			<div id='owner2'>
				<select name='owner2' id='owner2' style="width:180px;">
					<option value="">...</option> 
<?php
						$v_arr =$_SESSION['obsSession'];
						
						for($i=0;$i<sizeof($v_arr);$i++){	
						
							if(!is_numeric($v_arr[$i]['cc_code'])){
								$titles=htmlentities($v_arr[$i]['cc_obs'], ENT_COMPAT, "cp1252");
								
								if($v_arr[$i]['cc_country']==""){
									if($v_arr[$i]['cc_id']==$ccd){
										echo "<option value=\"{$v_arr[$i]['cc_code']}\" title=\"$titles\" selected=\"selected\">".$v_arr[$i]['cc_code']."</option>";
									}else{
										echo "<option value=\"{$v_arr[$i]['cc_code']}\" title=\"$titles\">".$v_arr[$i]['cc_code']."</option>";}
								}else{
									if($v_arr[$i]['cc_id']==$ccd){
										echo "<option value=\"{$v_arr[$i]['cc_code']}\" title=\"$titles\" selected=\"selected\">".$v_arr[$i]['cc_country'].",".$v_arr[$i]['cc_code']."</option>";
									}else{
										echo "<option value=\"{$v_arr[$i]['cc_code']}\" title=\"$titles\">".$v_arr[$i]['cc_country'].",".$v_arr[$i]['cc_code']."</option>";
									}
								}
							}
						}
?>
				</select>
			</div>
		</div>

		
		<div style="width:10%;">&nbsp;</div>
		<div style="width:40%;  padding-left:90px;">
			<p1>Data owner 3 (Optional): </p1><br>
			<div id='owner3'>
				<select name='owner3' id='owner3' style="width:180px;">
					<option value="">...</option>
		
<?php
						$v_arr =$_SESSION['obsSession'];
						
						for($i=0;$i<sizeof($v_arr);$i++){	
						
							if(!is_numeric($v_arr[$i]['cc_code'])){
								$titles=htmlentities($v_arr[$i]['cc_obs'], ENT_COMPAT, "cp1252");
								
								if($v_arr[$i]['cc_country']==""){
									if($v_arr[$i]['cc_id']==$ccd){
										echo "<option value=\"{$v_arr[$i]['cc_code']}\" title=\"$titles\" selected=\"selected\">".$v_arr[$i]['cc_code']."</option>";
									}else{
										echo "<option value=\"{$v_arr[$i]['cc_code']}\" title=\"$titles\">".$v_arr[$i]['cc_code']."</option>";}
								}else{
									if($v_arr[$i]['cc_id']==$ccd){
										echo "<option value=\"{$v_arr[$i]['cc_code']}\" title=\"$titles\" selected=\"selected\">".$v_arr[$i]['cc_country'].",".$v_arr[$i]['cc_code']."</option>";
									}else{
										echo "<option value=\"{$v_arr[$i]['cc_code']}\" title=\"$titles\">".$v_arr[$i]['cc_country'].",".$v_arr[$i]['cc_code']."</option>";
									}
								}
							}
						} 
?>
				</select>
			</div>
		</div>		
		
		<div style="width:10%;">&nbsp;</div>
		<div id="convertid" style="width:45%;padding-left:90px;">
			<p1>File content to convert: </p1><br>
			<div id="convertblock">
				<select name='conv' id='conv' style="width:180px;">
				<option value=''> ... </option>
				</select>
			</div>
		</div>		
	
		<div style="width:10%;">&nbsp;</div>
		<div id="volDiv" style="width:45%; padding-left:90px;">
			<div id="volblockSpecific">
			</div>
		</div>	


		<div id="kilometer" style="width:45%; padding-left:90px;display:none;">
			<br/><p1>Choose Kilometer to see station: </p1><br/>
			<div id="kmeter_id">
				<select name='kmeter' id='kmeter' style="width:180px;">
					<option value='40' selected='ture'>40</option>
					<option value='80'>80</option>
					<option value='100'>100</option>
					<option value='all'>See all stations</option>
				</select>
			</div>
		</div>

		
		<div id="stationblock" style="width:45%;padding-left:90px;">
			<div id="stationform">
			</div>
		</div>
		
		<div id="processtype" style="display:none; padding-left:90px;">
			<br/><p1>Please choose Process Type:</p1><br/>
			<select id='dd_tlt_processtype' name='dd_tlt_processtype' style='width:180px;'>
				<option value='P'>Processed</option>
				<option value='R'>Raw</option>
			</select>
		</div>	
		
		
		<div id="RsamDiv" style="width:45%;padding-left:90px;clear:both;display:none;">
			<br/><p1> Please Enter RSAMSSAM Code here:</p1><br/>
            <input type="text" id="CodeOfRsam" name="CodeOfRsam" style='width:180px;'>
        </div>
		
		
		<div id="SamplingRateDiv" style="padding-left:90px;display:none;">
			<br/><p1>Please choose Interval length:</p1><br/>
			<select id='SamplingRate' name='SamplingRate' style='width:180px;'>
                <option value="1">1 minute</option>
                <option value="10">10 minutes</option>
                <option value="20">20 minutes</option>
                <option value="60">1 hour</option>
                <option value="120">2 hours</option>
            </select>
        </div>		
		
		<div id="instrblock" style="width:45%;padding-left:90px;">
			<div id="instrumentform">
			</div>
		</div>		
		
	<div style="width:10%;">&nbsp;</div><div style="width:10%;">&nbsp;</div>
	<div id='uploadfile' style="float:left;">
		<div id='submit_form' style="padding-left:20px;">
			Browse file to convert:<br>
			<input name="MAX_FILE_SIZE" type="hidden" /> 
			<input name="fname" id="fname" type="file" size="45" maxlength="100">
			<br>
			<input type="submit" name="Submit" id="Submit" value="Select">
		</div>
	</div>  
	
	</form>  
</div>
</html>