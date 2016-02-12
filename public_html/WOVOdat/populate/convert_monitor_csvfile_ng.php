<?php
if (!isset($_SESSION))   	 
    session_start();  

if(!isset($_GET['tipedata'])){    
header('Location: '.$url_root.'home_populate.php');
exit();
}

$ccd=$_SESSION['login']['cc_id']; 
?>
<html>

<style type="text/css">
label.error {font-size:12px; display:block; float: none; color: red;}
</style>

	<script src="/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/js/jquery.validate.js"></script>
	<script language='javascript' type='text/javascript'>

	$(document).ready(function(){
	
		$("#form1").validate();
		
		$("#observ").change(function(){
			resetall();
			$('select#vol2').remove();                  //Remove volcano drop down box 
			$('#pvol').remove();                        //Remove volcano text 
            $('#vol2,label[for="vol2"]').remove();    	//Remove validation error 
			loadconvert ();  
		});	
		

		$("select#conv").live('click', function() {		
			var dataType = $("select#conv").val();
			var institute = $("select#observ").val();

			if(dataType != '')
		       	loadvolcano(dataType,institute);
		}); 

		
		function loadvolcano(dataType,institute){ 	//Changed coz of vol list on 18-Mar-2013 
			resetall();	
			
			$('#volblockMonitor').load('./convertie/selectVolOfInstitute2_ng.php',"kode=" + institute+'&dataType='+dataType ,function(response, status, xhr) {
				if (status == "error") {
					var msg = "Sorry but there was an error: ";
					$("#volblockMonitor").html(msg + xhr.status + " " + xhr.statusText);
				}
			});
			return false;
		}
//Changed line 39-78 coz of vol list on 18-Mar-2013 	

		function loadconvert( ) {

			$("#conv").html('<option selected="true" value="">...</option><option value="SeismicNetwork" name="Seismic">SeismicNetwork</option><option value="SeismicStation" name="Seismic">SeismicStation</option><option value="SeismicInstrument" name="Seismic">SeismicInstrument</option><option value="SeismicComponent" name="Seismic">SeismicComponent</option><option value="DeformationNetwork" name="Deformation">DeformationNetwork</option><option value="DeformationStation" name="Deformation">DeformationStation</option><option value="DeformationInstrument_General" name="Deformation">DeformationInstrument_General</option><option value="DeformationInstrument_Tilt/Strain" name="Deformation">DeformationInstrument_Tilt/Strain</option><option value="GasNetwork" name="Gas">GasNetwork</option><option value="GasStation" name="Gas">GasStation</option><option value="GasInstrument" name="Gas">GasInstrument</option><option value="HydrologicNetwork" name="Hydrologic">HydrologicNetwork</option><option value="HydrologicStation" name="Hydrologic">HydrologicStation</option><option value="HydrologicInstrument" name="Hydrologic">HydrologicInstrument</option><option value="ThermalNetwork" name="Thermal">ThermalNetwork</option><option value="ThermalStation" name="Thermal">ThermalStation</option><option value="ThermalInstrument" name="Thermal">ThermalInstrument</option><option value="FieldsNetwork" name="Fields">FieldsNetwork</option><option value="FieldsStation" name="Fields">FieldsStation</option><option value="FieldsInstrument" name="Fields">FieldsInstrument</option><option value="MeteoNetwork" name="Meteo">MeteorologicalNetwork</option><option value="MeteoStation" name="Meteo">MeteorologicalStation</option><option value="MeteoInstrument" name="Meteo">MeteorologicalInstrument</option><option value="Airplane" name="Airplane">Airplane</option><option value="Satellite" name="Satellite">Satellite</option>');
       
		}
		
		function resetall(){  
		
			$('select#network').remove();
			$('select#station').remove(); 
			$('select#instrument').remove(); 
			
			$('#pnet').remove(); 
			$('#pstat').remove(); 
			$('#pinst').remove(); 
			$('h1').remove();
			
			$('#kmeter').val('40');
						
			$('#kilometer').css("display","none");
			$('#digen_div').css("display","none");
			$('#ditltstrain_div').css("display","none"); 
		
			$('#station_airborne').css("display","none");
			$('#sta_borne_select').val('');
			
			$('#airborne_type').css("display","none");
			$('#borne_type_select').val('');
			
			$('select#satellite').remove();
			$('select#airplane').remove();
			$('#id_air_sat_select').remove();
				
			/*from line 97-104 these scripts need coz of validation */
			$('#network,label[for="network"]').remove();    	//Remove validation error =>added on 17-may-2012
			$('#station,label[for="station"]').remove();  		//Remove validation error =>added on 17-may-2012
			$('#instrument,label[for="instrument"]').remove();   //Remove validation error =>added on 17-may-2012
	
			$('.class,label[for="digen_select"]').css("display","none"); //display=none for validation error =>added 17may2012
			$('.class,label[for="ditltstrain_select"]').css("display","none");//display=none for validation error =>17may2012
			$('.class,label[for="borne_type_select"]').css("display","none"); //display=none for validation error =>1june2012
			$('.class,label[for="satellite"]').css("display","none");  //display=none for validation error =>1june2012
			$('.class,label[for="airplane"]').css("display","none"); //display=none for validation error =>1june2012
			
			/*TO line 97-104 these scripts need coz of validation */
			
			
			/*from line 110-112 these scripts need coz show disable submit button if no net/station/instrument */
			
			$('#fname').val('');                    // Clear value of file input => added on 17-may-2012
			$('#Submit').removeAttr("disabled");  //Remove disabled="disabled" from sumbit button => added on 17-may-2012
			
		} 
	    
		//Changed from "select#conv" to "select#vol2" coz of vol list on 18-Mar-2013 				
		$("select#vol2").live('click', function() {
	
			var stationvalue=$('#conv').attr('value');   //get File content to convert value 
			var volcanovalue=$('#vol2').attr('value');
			
			resetall();			
			
			if(stationvalue != '' || volcanovalue != ''){    //changed from  stationvalue != '...' on 3-may-2012
			
				var sg = document.form1.vol2.selectedIndex;       // get volcano index 
				var sgu = document.form1.vol2.options[sg].value;  //get volcano value
		
				var stationvalue=$('#conv').attr('value');   //get File content to convert value 	
				var stationdisplay=$("#conv option:selected").text();  //get station "display" value
			
				if(stationdisplay=="SeismicStation" || stationdisplay=="DeformationStation" || stationdisplay=="GasStation" || stationdisplay=="HydrologicStation" || stationdisplay=="ThermalStation" || stationdisplay=="FieldsStation" || stationdisplay=="MeteorologicalStation"){
					
					$('#networkform').load('./convertie/selectNetwork_ng.php','volcan='+sgu+ '&stationdisplay='+stationdisplay+ '&stationvalue='+stationvalue,function(result){ 
						
						//show disabled submit button if there is no network/station/instrument
			  				
						var check = result.substring(11,25);  // To get "nonetworkerror/nostationerror/noinstrumenter"
						
						if(check == "nonetworkerror" || check == "nostationerror" || check == "noinstrumenter"){
														
							$('#fname').val('');
							$('#Submit').attr("disabled","disabled");
						}
					});	
	
				}
				else if(stationdisplay=="SeismicInstrument" || stationdisplay=="SeismicComponent" || stationdisplay=="DeformationInstrument_General" || stationdisplay=="DeformationInstrument_Tilt/Strain" || stationdisplay=="HydrologicInstrument" || stationdisplay=="FieldsInstrument" || stationdisplay=="MeteorologicalInstrument"){				
					
					$('#networkform').load('./convertie/selectInstrument_ng.php','volcan='+sgu+ '&stationdisplay='+stationdisplay+ '&stationvalue='+stationvalue+'&networkdisplay=none&stationcheck=check1&instrucomponent=noinstru1&kilometer=nokilometer',function(result){ 
					
						//show disabled submit button if there is no network/station/instrument
						
						var check = result.substring(11,25);
						
						if(check == "nonetworkerror" || check == "nostationerror" || check == "noinstrumenter"){
													
							$('#fname').val('');
							$('#Submit').attr("disabled","disabled");
						}
					});	
				}
				else if(stationdisplay=="GasInstrument" || stationdisplay=="ThermalInstrument"){

					if(volcanovalue != ''){
						$('#station_airborne').css('display','block');
						$('#sta_borne_select').attr('class','required');
					}
				}					
			}else{	
				resetall();
			}
		}); 
		
		$("select#network").live('click', function() {
			
			$('#Submit').removeAttr("disabled");  //Remove disabled="disabled" from sumbit button => added on 17-may-2012
			
			var stationdisplay=$("#conv option:selected").text();  //get station "display" value
			
			if(stationdisplay=="SeismicInstrument" || stationdisplay=="SeismicComponent" || stationdisplay=="DeformationInstrument_General" || stationdisplay=="DeformationInstrument_Tilt/Strain" ||  stationdisplay=="HydrologicInstrument"  || stationdisplay=="FieldsInstrument" || stationdisplay=="MeteorologicalInstrument" || stationdisplay=="GasInstrument" || stationdisplay=="ThermalInstrument"){
				
				var networkdisplay=$('#network').attr('value');
				
				if(networkdisplay !=''){  //changed from  networkdisplay != 'Choose Network' on 3-may-2012
					//loadstation();
					
					$('#kilometer').css("display","block");
					showkilometer();
				}
				else{
				
					$('select#station').remove(); 
					$('select#instrument').remove(); 
					$('#pstat').remove(); 
					$('#pinst').remove(); 
					$('h1').remove();
					
					$('#kmeter').val('40');
					$('#kilometer').css("display","none");
					$('#digen_div').css("display","none");
					$('#ditltstrain_div').css("display","none");
					
					$('#station,label[for="station"]').remove();
					$('#instrument,label[for="instrument"]').remove(); 

				}	
			}
		});


		$("select#sta_borne_select").live('click', function() {

			var $station_borne=$('select#sta_borne_select').val();
			
			if($station_borne == 'ground_based'){
			
				$('#airborne_type').css("display","none");

				var sg = document.form1.vol2.selectedIndex;       // get volcano index 
				var sgu = document.form1.vol2.options[sg].value;  //get volcano value
		
				var stationvalue=$('#conv').attr('value');   //get File content to convert value 	
				var stationdisplay=$("#conv option:selected").text();  //get station "display" value

				
				$('select#satellite').remove();
				$('select#airplane').remove();
				$('#id_air_sat_select').remove();
				$('h1').remove();
				
				$('.class,label[for="borne_type_select"]').css("display","none");  
				$('.class,label[for="satellite"]').css("display","none");  
				$('.class,label[for="airplane"]').css("display","none"); 
				$('#Submit').removeAttr("disabled");  //Reset enable button

					
				$('#networkform').load('./convertie/selectInstrument_ng.php','volcan='+sgu+ '&stationdisplay='+stationdisplay+ '&stationvalue='+stationvalue+'&networkdisplay=none&stationcheck=check1&instrucomponent=noinstru1&kilometer=nokilometer',function(result){ 
				
					//show disabled submit button if there is no network/station/instrument
					
					var check = result.substring(11,25);
					
					if(check == "nonetworkerror" || check == "nostationerror" || check == "noinstrumenter"){
												
						$('#fname').val('');
						$('#Submit').attr("disabled","disabled");
					}
				});	
				
				//loadstation();
			}
			else if($station_borne == 'cs'){
			
				$('#airborne_type').css("display","block"); 
				$('#borne_type_select').attr('class', 'required');  
				$('select#borne_type_select').val('');

				$('select#network').remove();    // Nang 21-Mar-2012
				$('#pnet').remove();            // Nang 21-Mar-2012
				
				$('select#station').remove();                            
				$('#pstat').remove();
				$('#kmeter').val('40');
				$('#kilometer').css("display","none");
				$('h1').remove();
				
				$('.class,label[for="network"]').css("display","none");   // Nang 21-Mar-2012
				$('.class,label[for="station"]').css("display","none");  
				$('#Submit').removeAttr("disabled");  //Reset enable button			
			
				loadairsatellite();
			
			}
			else{
			
				$('#sta_borne_select').val('');

				$('select#network').remove();     // Nang 21-Mar-2012
				$('#pnet').remove();              // Nang 21-Mar-2012
				
				$('select#station').remove();
				$('#pstat').remove();
				$('#kmeter').val('40');
				$('#kilometer').css("display","none");
				$('h1').remove();
			
				$('#airborne_type').css("display","none");
				$('select#satellite').remove();
				$('select#airplane').remove();
				$('#id_air_sat_select').remove();
				
				$('.class,label[for="network"]').css("display","none");   // Nang 21-Mar-2012
				$('.class,label[for="station"]').css("display","none");  
				$('.class,label[for="satellite"]').css("display","none");  
				$('.class,label[for="airplane"]').css("display","none"); 			
				
				$('#Submit').removeAttr("disabled");  //Reset enable button
			
			}
		
		});

		$("select#borne_type_select").live('click', function() {
				
				$('#Submit').removeAttr("disabled");
				$('h1').remove();
				
				loadairsatellite();
		});
		
		function loadairsatellite(){
			
			$('#Submit').removeAttr("disabled");
		
			var air_sate=$('#borne_type_select').attr('value');
			
			if(air_sate != ''){
				$('#sate_air_select').load('./convertie/selectStation_ng.php','airplane_sate='+air_sate,function(){ 
				
					var check= $("#sate_air_select h1").attr("class");	// To get nosatelliteerror 			
			
					if(check == "nosatelliteerror"){   
					
						$('#fname').val('');     
						$('#Submit').attr("disabled","disabled");
						
					}
				});	
			}	
		}
	
		$("select#kmeter").live('click', function() {
			showkilometer();
		});
		
		
		function showkilometer(){
		
			$('#Submit').removeAttr("disabled");  //Reset enable button
		
			$('#digen_div').css("display","none");
			$('#ditltstrain_div').css("display","none");
		
			var kilometervalue=$('#kmeter').attr('value');   //get kilo meter value
			
			var sg = document.form1.vol2.selectedIndex;   // get volcano index 
			var sgu = document.form1.vol2.options[sg].value;  //get volcano value
			
			var stationvalue=$('#conv').attr('value');   //get File content to convert value 	
			
			var stationdisplay=$("#conv option:selected").text();  //get station "display" value
			var networkdisplay=$('#network').attr('value');
			
			$('#stationform').load('./convertie/selectInstrument_ng.php','volcan='+sgu+ '&stationdisplay='+stationdisplay+ '&stationvalue='+stationvalue+'&networkdisplay=' +networkdisplay+			'&stationcheck=check2&instrucomponent=noinstru2&kilometer=' +kilometervalue,function(result){ 
					
				//show disabled submit button if there is no network/station/instrument
				
				var check = result.substring(11,25);
				
				if(check == "nonetworkerror" || check == "nostationerror" || check == "noinstrumenter"){
										
					$('#fname').val('');
					$('#Submit').attr("disabled","disabled");
				}
			});	
		}
			 
		$("select#station").live('click', function() {
			
			$('#Submit').removeAttr("disabled");  //Reset enable button
			
			var stationdisplay=$("#conv option:selected").text();  //get station "display" value
			var stationcheck=$('#station').attr('value');
				
			if(stationcheck !=''){	 // changed form stationcheck !='Choose Station' on 3-May-2012
		
				if(stationdisplay=="SeismicComponent"){
					loadinstrument();
				}
				else if(stationdisplay=="DeformationInstrument_General" || stationdisplay=="DeformationInstrument_Tilt/Strain"){
					digen_tilstrain(stationdisplay);
				}	
			}
			else{
				
				$('select#instrument').remove();
				$('#pinst').remove(); 
				$('h1').remove();
				
				$('#digen_select').val(''); //Changed from val('Choose Instrument type') on 3-May-2012
				$('#ditltstrain_select').val(''); //Changed from val('Choose Instrument type') on 3-May-2012
			}
		
		
		}); 
		
		
		function digen_tilstrain(stationdisplay){ 
		
			$('#Submit').removeAttr("disabled"); //Reset enable button
			
		   	$('#digen_select').val(''); //Changed from val('Choose Instrument type') on 3-May-2012
			$('#ditltstrain_select').val(''); //Changed from val('Choose Instrument type') on 3-May-2012
			
			if(stationdisplay=="DeformationInstrument_General"){
			
				$('#digen_select').attr('class', 'required');  // Added class="required" to digen_select select tag
			
				$('#digen_div').css("display","block");
			}
			else if(stationdisplay=="DeformationInstrument_Tilt/Strain"){
			
				$('#ditltstrain_select').attr('class', 'required');  // Added class="required" to ditltstrain_select select tag
				
				$('#ditltstrain_div').css("display","block");
			}	
		} 
	
		function loadinstrument(){
			
			$('#Submit').removeAttr("disabled");
			
			var networkdisplay=$('#network').attr('value');
			var station=$('#station').attr('value');
			var kilometervalue=$('#kmeter').attr('value');   //get kilo meter value
			
			var sg = document.form1.vol2.selectedIndex;   // get volcano index 
			var sgu = document.form1.vol2.options[sg].value;  //get volcano value
			
			var stationvalue=$('#conv').attr('value');   //get File content to convert value 	
			var stationdisplay=$("#conv option:selected").text();  //get station "display" value

			$('#instruform').load('./convertie/selectInstrument_ng.php','volcan='+sgu+ '&stationdisplay='+stationdisplay+ '&stationvalue='+stationvalue+'&networkdisplay=' +networkdisplay+'&stationcheck='+station+ '&instrucomponent=noinstru3&kilometer=' +kilometervalue,function(result){ 
				
				//show disabled submit button if there is no network/station/instrument	
										
				var check = result.substring(11,25);
				
				if(check == "nonetworkerror" || check == "nostationerror" || check == "noinstrumenter"){
										
					$('#fname').val('');
					$('#Submit').attr("disabled","disabled");
				}
			});	
		}

		// This part is not very necessary but double check to get more validation
	
		$('#form1').submit(function() {
			var check=$('h1').attr('class');
			
			if(check == "nonetworkerror" || check == "nonetworkerror2" || check == "nostationerror" || check == "noinstrumenterror"){
			
				$('#fname').val('');
				$('#Submit').attr("disabled","disabled");
				
			}
		});  
	});
</script>

<div style="padding:5px 0px 0px 5px;">
<h2>Conversion of Monitoring System</h2>
<blockquote>Input: CSV file of network, station, or instrument information. The data must follow the WOVOdat1.1 standard format</blockquote>

<form name="form1" id="form1" action="./convertie/commonconvertfile_ng.php" method="post" enctype="multipart/form-data">
		<div id="lfleft" style="width:5%;"></div>
		<div style="width:40%;  padding-left:90px;">
			<p1>Observatory (data owner): </p1><br>
			<div id='observo'>
				<select name='observ' id='observ' style="width:180px;" class="required">
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
			<p1>Conversion Data Type: </p1><br>
			<div id="convertblock">
				<select name='conv' id='conv' style="width:180px;" class="required">
				<option value=''> ... </option>
				</select>
			</div>
		</div>

		
		<div style="width:10%;">&nbsp;</div>
		<div id="volDiv" style="width:45%; padding-left:90px;">
			<div id="volblockMonitor">
			</div>
		</div>
	

		<div id="station_airborne" style="display:none; padding-left:90px;">
			<br/><p1>Please choose Ground_Based Station (OR) Airborne:</p1>
			<select id='sta_borne_select' name='sta_borne_select' style='width:180px;'>
				<option value='' selected='true'>...</option>
				<option value='ground_based'>Ground_Based Station</option>
				<option value='cs'>Airborne</option> 
			</select>
		</div>		

		
		<div id="airborne_type" style="display:none; padding-left:90px;">
			<br/><p1>Please choose Airborne Type:</p1><br/>
			<select id='borne_type_select' name='borne_type_select' style='width:180px;'>
				<option value='' selected='true'>...</option>
				<option value='A'>Airplane</option>
				<option value='S'>Satellite</option>
			</select>
		</div>		

		<div id="sate_air" style="width:45%;padding-left:90px;">
			<div id="sate_air_select">
			</div>
		</div>	
			
		<div id="networkblock" style="width:45%;padding-left:90px;padding-top:20px;">
			<div id="networkform">
			</div>
		</div>		
	
		<div style="width:10%;">&nbsp;</div>
		<div id="kilometer" style="width:45%; padding-left:90px;display:none;">
			<p1>Choose Kilometer to see station: </p1><br>
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
		
		<div style="width:10%;">&nbsp;</div>
		<div id="digen_div" style="width:45%; padding-left:90px;display:none;">
			<p1>Please Choose Instrument types: </p1><br>
			<div id="digen_id">
				<select name='digen_select' id='digen_select' style="width:180px;">
					<option value='' selected='ture'>Choose Instrument type</option>
					<option value='Angle'>Angle</option>
					<option value='CGPS'>CGPS</option>
					<option value='EDM'>EDM</option>
					<option value='EDM_Reflector'>EDM Reflector</option>
					<option value='GPS'>GPS</option>
					<option value='Total_Station'>Total Station</option>
					<option value='OtherTypes'>Other instrument types</option>
				</select>
			</div>
		</div>
		
		<div id="ditltstrain_div" style="width:45%; padding-left:90px;display:none;">
			<p1>Please Choose Instrument types: </p1><br>
			<div id="ditltstrain_id">
				<select name='ditltstrain_select' id='ditltstrain_select' style="width:180px;">
					<option value='' selected='ture'>Choose Instrument type</option>
					<option value='Tilt'>Tilt</option>
					<option value='Strain'>Strain</option> 
				</select>
			</div>
		</div>	
		
		
		<div style="width:10%;">&nbsp;</div>
		<div id="instrublock" style="width:45%;padding-left:90px;">
			<div id="instruform">
			</div>
		</div>
		

		
	<div style="width:10%;">&nbsp;</div>
	<div id="formfname" style="float:left;">
		<div style="padding-left:20px;">
			Browse file to convert:<br>
			<input name="MAX_FILE_SIZE" type="hidden" value="2000000">
			<input name="fname" id="fname" type="file" size="45" maxlength="100" class="required">
			<br>
			<input type="submit" name="Submit" id="Submit" value="Select">
		</div>
	</div> 
	</form>  
</div>


</html>