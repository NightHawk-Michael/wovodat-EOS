<?php
if (!isset($_SESSION))
    session_start();  

if(!isset($_GET['tipedata'])){         
header('Location: '.$url_root.'home_populate.php');
exit();
}

$ccd=$_SESSION['login']['cc_id']; 
?>
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
		       	loadvolcano(institute);
		}); 
		
		function resetall(){
			
			$('select#network').remove();
			$('select#stat').remove();
			$('#id_net_stat_text').remove();
			$('select#stat2').remove();
			$('#id_net_stat_text2').remove();
			$('select#stat3').remove();
			$('#id_net_stat_text3').remove();		
			$('select#gpsStat2').remove();              // Nang added on 26-Feb-2013 bcoz of GPS station2 and station3
			$('#id_net_stat_text4').remove();           // Nang added on 26-Feb-2013 bcoz of GPS station2 and station3
			$('select#gpsStat3').remove();             // Nang added on 26-Feb-2013 bcoz of GPS station2 and station3
			$('#id_net_stat_text5').remove();          // Nang added on 26-Feb-2013 bcoz of GPS station2 and station3
			$('h1').remove();
			
			$('#trm_ivl_select').val('Network');
			$('#eventtype_waveselect').val(''); 
			$('#eventcode').val('');			
					
			$('#kmeter').val('40');
			$('#kilometer').css("display","none");			
			$('#trm_ivl').css("display","none");
			$('.spaceid').remove();
			$('.spaceclass2').remove();
			$('.spaceclass3').remove();
			$('.spaceclass4').remove();
			$('.spaceclass5').remove();
			$('.spaceclass6').remove();               // Nang added on 26-Feb-2013 bcoz of GPS station2 and station3
			$('.spaceclass7').remove();               // Nang added on 26-Feb-2013 bcoz of GPS station2 and station3
			$('#rsam_ssam').css("display","none");
			$('#rsam_ssamcode').val('');
			
			$('#uploadfile').css("display","block");
			$('#uploadfile2').css("display","none");

			$('#wave_textfield').css("display","none");
			
			$('#gd_plume').css("display","none");
			$('#satellite_type').css("display","none");
			$('select#gd_plume_select').val('');
			$('select#sate_type_select').val('');  
			$('select#satellite').remove();
			$('select#airplane').remove();
			$('#id_air_sat_select').remove();
			
			$('select#instrument').remove();
			$('#id_inst_text').remove();
			
			/*from line 104-119 these scripts diable "validation error" */

			$('.class,label[for="network"]').css("display","none"); 
			$('.class,label[for="stat"]').css("display","none"); 
			$('.class,label[for="stat2"]').css("display","none"); 
			$('.class,label[for="stat3"]').css("display","none");
			$('.class,label[for="instrument"]').css("display","none");			
			$('.class,label[for="trm_ivl_select"]').css("display","none"); 
			$('.class,label[for="eventtype_waveselect"]').css("display","none"); 
			$('.class,label[for="eventcode"]').css("display","none"); 
			$('.class,label[for="rsam_ssamcode"]').css("display","none"); 
		//	$('.class,label[for="gd_plume_select"]').css("display","none"); 
			
			$('#gd_plume_select').removeAttr('class');
			$('.class,label[for="sate_type_select"]').css("display","none"); 
			$('.class,label[for="airplane"]').css("display","none"); 
			$('.class,label[for="satellite"]').css("display","none"); 


			/*from line 110-112 these scripts need coz show disable submit button if no net/station/instrument/satllite */
			
			$('#fname1').val('');                    // Clear value of file input => added on 17-may-2012
			$('#Submit1file').removeAttr("disabled"); //Remove disabled="disabled" from sumbit button=> 17-may-2012		
			$('#fname1').attr('class','required');	 // Put it back class='required' for first form submit
			
			
			$('#fname').val('');                   		 // Clear value of file input => added on 17-may-2012
			$('#secondname').val('');                    // Clear value of file input => added on 17-may-2012
			$('#submit2files').removeAttr("disabled"); //Remove disabled="disabled" from sumbit button=> 17-may-2012
			$('#fname').removeAttr('class');
			$('#secondname').removeAttr('class');
		}

		function resetfirstformsubmit(){

			// Disable action for first form submit
			$('#fname1').val(''); 
			$('#fname1').removeAttr("disabled");  //Reset enable button
		
		//	$('.class,label[for="fname1"]').css('display','none'); // disable validation for frist form 

			$('#fname1').removeAttr('class');
	
	
			// Active for second form submit
			$('#fname').attr('class', 'required');     // To add class='required' for 2 file submission
			$('#secondname').attr('class', 'required');   // To add class='required' for 2 file submission		

		}
		
		function loadvolcano(institute){  
			resetall();	
		//	var institute = $("select#observ").val();
			$('#volblockData').load('./convertie/selectVolOfInstitute2_ng.php',"kode=" + institute); 
			return false;
		}

		function loadconvert( ) {
			
		//	$('#conv').load('./convertie/wovodatdatatablelist.php');
		//	return false;   
		
			$('#conv').html('<option option="selected" value="">...</option><option value="EventDataFromNetwork">EventDataFromNetwork</option><option value="EventDataFromSingleStation">EventDataFromSingleStation</option><option value="IntensityData">IntensityData</option><option value="SeismicTremor">SeismicTremor</option><option value="IntervalSwarmData">IntervalSwarmData</option><option value="RSAMData">RSAMData</option><option value="SSAMData">SSAMData</option><option value="RepresentativeWaveform">RepresentativeWaveform</option><option value="ElectronicTiltData">ElectronicTiltData</option><option value="TiltVectorData">TiltVectorData</option><option value="StrainMeterData">StrainMeterData</option><option value="EDMData">EDMData</option><option value="AngleData">AngleData</option><option value="GPSData">GPSData</option><option value="GPSVectors">GPSVectors</option><option value="LevelingData">LevelingData</option><option value="InSARImage and InSARData">InSARImage and InSARData</option><option value="DirectlySampledGas">DirectlySampledGas</option><option value="SoilEffluxData">SoilEffluxData</option><option value="PlumeData">PlumeData</option><option value="HydrologicData">HydrologicData</option><option value="MagneticFieldsData">MagneticFieldsData</option><option value="MagnetorVectorData">MagnetorVectorData</option><option value="ElectricFieldsData">ElectricFieldsData</option><option value="GravityData">GravityData</option><option value="GroundBasedThermalData">GroundBasedThermalData</option><option value="ThermalImage and ThermalImageData">ThermalImage and ThermalImageData</option><option value="MeteoData">MeteorologicalData</option>');
		}
	
		
	
		$("select#vol2").live('click', function() {	  

			var stationvalue=$('#conv').attr('value');   //get File content to convert value 
			var volcanovalue=$('#vol2').attr('value');
			
			resetall();		 // Reset all like first time page starts loading		
		
			if(stationvalue != '' || volcanovalue != ''){
			
				var sg = document.form1.vol2.selectedIndex;   // get volcano index 
				var sgu = document.form1.vol2.options[sg].value;  //get volcano value
				
				var stationvalue=$('#conv').attr('value');   //get File content to convert value 	
				var stationdisplay=$("#conv option:selected").text();  //get station "display" value
			
				
				if(stationdisplay=="EventDataFromNetwork"){
	
					$('#networkform').load('./convertie/selectNetwork_data_ng.php','volcan='+sgu+ '&stationdisplay='+stationdisplay+ '&stationvalue='+stationvalue,function(result){ 
					
						//show disabled submit button if there is no network
						
						var check = result.substring(11,25);
						
						if(check == "nonetworkerror"){
														
							$('#fname1').val('');
							$('#Submit1file').attr("disabled","disabled");
						}
					});	
					
				}	
				else if(stationdisplay=="EventDataFromSingleStation" || stationdisplay =="RSAMData" || stationdisplay =="SSAMData" || stationdisplay=="RepresentativeWaveform" || stationdisplay == "ElectronicTiltData" || stationdisplay == "TiltVectorData" || stationdisplay == "StrainMeterData" || stationdisplay=="EDMData" || stationdisplay =="AngleData" || stationdisplay =="GPSData" || stationdisplay == "GPSVectors" || stationdisplay == "DirectlySampledGas" || stationdisplay == "SoilEffluxData" || stationdisplay == "HydrologicData" || stationdisplay == "MagneticFieldsData" || stationdisplay == "MagnetorVectorData" || stationdisplay == "ElectricFieldsData" || stationdisplay == "GravityData" ||stationdisplay == "GroundBasedThermalData" || stationdisplay == "MeteorologicalData" || stationdisplay == "LevelingData"){  
				// Added  stationdisplay == "MeteorologicalData" on 9-May-2012
					
					$('#kilometer').css("display","block");
					showkilometer();				
				}     
				else if(stationdisplay=="SeismicTremor" || stationdisplay=="IntervalSwarmData"){				
										
					$('#trm_ivl').css("display","block");
					load_trm_ivl();

				}  
				else if(stationdisplay=="PlumeData" || stationdisplay=="ThermalImage and ThermalImageData"){ 
				
					$('#gd_plume').css("display","block");
					$('#gd_plume_select').attr('class', 'required');
					
					if(stationdisplay=="ThermalImage and ThermalImageData"){
						$('#uploadfile').css('display','none');
						$('#uploadfile2').css('display','block');
						$('#text1').text("Browse Thermal Image file to convert:");
						$('#text2').text("Browse Thermal Pixels file to convert:"); 
						
						resetfirstformsubmit();	
					}
					
					load_gd_plume();
				}
				else if(stationdisplay=="InSARImage and InSARData" ){
					$('#uploadfile').css('display','none');
					$('#uploadfile2').css('display','block');
					
					$('#text1').text("Browse InSAR Image file to convert:");
					$('#text2').text("Browse InSAR Data file to convert:");				
					
					resetfirstformsubmit();
		
					
					$('#sate_air_select').load('./convertie/selectStation_data_ng.php','volcan='+sgu+ '&stationdisplay='+stationdisplay+ '&kilometer=none&satellitetype=S',function(){ 
						
						//show disabled submit button if there is no satellite
					
					  	var check= $("#sate_air_select h1").attr("class");	// To get "nosatelliteerror"			
				
						if(check == "nosatelliteerror"){   
						
							$('#fname').val('');
							$('#secondname').val('');
							$('#submit2files').attr("disabled","disabled");
							
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
		
			$('#Submit1file').removeAttr("disabled");  //Reset enable button
			$('#submit2files').removeAttr("disabled");  //Reset enable button
			
			var kilometervalue=$('#kmeter').attr('value');   //get kilo meter value
			
			var sg = document.form1.vol2.selectedIndex;   // get volcano index 
			var sgu = document.form1.vol2.options[sg].value;  //get volcano value
			
			var stationdisplay=$("#conv option:selected").text();  //get station "display" value
			
			if(stationdisplay =="EDMData" || stationdisplay == "MagneticFieldsData" || stationdisplay == "ElectricFieldsData" || stationdisplay == "GravityData"){			

				$('#stationform').load('./convertie/selectStation_data_ng.php','volcan='+sgu+'&stationdisplay='+stationdisplay+ '&kilometer=' +kilometervalue,function(){

					var currentId= $("#stationform h1").attr("id");
				
					if(currentId != "nostation" ){	

						$('#stationform2').load('./convertie/selectStation_data_ng.php','volcan='+sgu+'&stationdisplay='+stationdisplay+ '&kilometer=' +kilometervalue+ '&station2=stat2');	
					}
					else{
						$('#fname1').val('');     
						$('#Submit1file').attr("disabled","disabled");
					}
				});	
			}
			else if(stationdisplay =="AngleData" || stationdisplay =="GPSData" || stationdisplay == "LevelingData"){			
				
				$('#stationform').load('./convertie/selectStation_data_ng.php','volcan='+sgu+'&stationdisplay='+stationdisplay+ '&kilometer=' +kilometervalue,function(){

					var currentId= $("#stationform h1").attr("id");
					
					if(currentId != "nostation" ){

//Nang added line 381-392 on 26-Feb-2013. Because GPS needs to put option value for station 2 and station 3.
						if(stationdisplay =="GPSData"){
					
							$('#stationform2').load('./convertie/selectStation_data_ng.php','volcan='+sgu+'&stationdisplay='+stationdisplay+ '&kilometer=' +kilometervalue+ '&gpsStation2=stat2');				
						
							$('#stationform3').load('./convertie/selectStation_data_ng.php','volcan='+sgu+'&stationdisplay='+stationdisplay+ '&kilometer=' +kilometervalue+ '&gpsStation3=stat3');
						}else{
							
							$('#stationform2').load('./convertie/selectStation_data_ng.php','volcan='+sgu+'&stationdisplay='+stationdisplay+ '&kilometer=' +kilometervalue+ '&station2=stat2');				
						
							$('#stationform3').load('./convertie/selectStation_data_ng.php','volcan='+sgu+'&stationdisplay='+stationdisplay+ '&kilometer=' +kilometervalue+ '&station3=stat3');						
						}
					}
					else{
						$('#fname1').val('');     
						$('#Submit1file').attr("disabled","disabled");
					}					
				});	
			}
			else{
				
				$('#stationform').load('./convertie/selectStation_data_ng.php','volcan='+sgu+'&stationdisplay='+stationdisplay+ '&kilometer=' +kilometervalue,function(){ 
					
					//show disabled submit button if there is no network/station/instrument
				
					var check= $("#stationform h1").attr("class");	// To get nosatelliteerror/nostationerror 			
			
					if(check == "nosatelliteerror" || check == "nostationerror"){   
					
						$('#fname1').val('');     
						$('#Submit1file').attr("disabled","disabled");
						
						$('#fname').val('');
						$('#secondname').val('');
						$('#submit2files').attr("disabled","disabled");
						
					}
				});
			}
		}	

		
		$("select#trm_ivl_select").live('click', function() {
			load_trm_ivl(); 
		});
			

		function load_trm_ivl(){	   // Tremor / Interval case 
		
			$('.spaceid').remove();
			$('#Submit1file').removeAttr("disabled");  //Reset enable button
			$('#submit2files').removeAttr("disabled");  //Reset enable button
			
			var trm_ivl_value=$('#trm_ivl_select').attr('value');   

			var sg = document.form1.vol2.selectedIndex;   // get volcano index 
			var sgu = document.form1.vol2.options[sg].value;  //get volcano value
			var stationvalue=$('#conv').attr('value');   //get File content to convert value 	
			var stationdisplay=$("#conv option:selected").text();  //get station "display" value

			if(trm_ivl_value == 'Network'){	
			
				$('select#stat').remove();
				$('#id_net_stat_text').remove();
				
				$('#kmeter').val('40');
				$('#kilometer').css("display","none");
				$('h1').remove();
				
				$('.class,label[for="stat"]').css("display","none");   //added on 18-May-2012
				
				$('#networkform').load('./convertie/selectNetwork_data_ng.php','volcan='+sgu+ '&stationdisplay='+	stationdisplay+ '&stationvalue='+stationvalue);
			}
			else if(trm_ivl_value == 'Station'){

				$('select#network').remove();
				$('#id_net_stat_text').remove();
				$('h1').remove();
				
				$('.class,label[for="network"]').css("display","none");  		  //added on 18-May-2012
				
				$('#kilometer').css("display","block");
				showkilometer();
			}
			else{
				$('select#network').remove();
				$('select#stat').remove();
				$('#id_net_stat_text').remove();
				$('#kmeter').val('40');
				$('#kilometer').css("display","none");
				$('.spaceid').remove();
				$('h1').remove();
				
				$('.class,label[for="network"]').css("display","none");   //added on 18-May-2012
				$('.class,label[for="stat"]').css("display","none");      //added on 18-May-2012
			}
		
		}
		
		
		
		$("select#gd_plume_select").live('click', function() {
			load_gd_plume();
		});
			

		function load_gd_plume(){   // only for Thermal Image data (gd_plume mar station nae instrument pae shi tot dae)
		
			var gd_plume_value=$('#gd_plume_select').attr('value');   

			var sg = document.form1.vol2.selectedIndex;   // get volcano index 
			var sgu = document.form1.vol2.options[sg].value;  //get volcano value
			var stationvalue=$('#conv').attr('value');   //get File content to convert value 	
			var stationdisplay=$("#conv option:selected").text();  //get station "display" value		
		
			if(gd_plume_value == "cs"){
				
				$('#satellite_type').css("display","block"); 
				
				$('#sate_type_select').attr('class', 'required');  
				
				$('select#sate_type_select').val('');
				
				$('select#stat').remove();
				$('#id_net_stat_text').remove();
				$('#kmeter').val('40');
				$('#kilometer').css("display","none");
				$('h1').remove();
				
				$('.class,label[for="stat"]').css("display","none");  
				
				$('#Submit1file').removeAttr("disabled");  //Reset enable button
				$('#submit2files').removeAttr("disabled");  //Reset enable button
				
				load_satellite();
			}
			else if(gd_plume_value == 'ground_based'){
				
				$('#satellite_type').css("display","none");
				
				$('select#satellite').remove();
				$('select#airplane').remove();
				$('#id_air_sat_select').remove();
				$('h1').remove();
				$('select#instrument').remove();
				$('#id_inst_text').remove();
				
				$('.class,label[for="instrument"]').css("display","none");	
				$('#sate_type_select').removeAttr('class');
				$('.class,label[for="satellite"]').css("display","none");  
				$('.class,label[for="airplane"]').css("display","none"); 
				
				$('#Submit1file').removeAttr("disabled");  //Reset enable button
				$('#submit2files').removeAttr("disabled");  //Reset enable button
				
				
				$('#kilometer').css("display","block");
				showkilometer();			
			}
			else{

				$('#satellite_type').css("display","none");
				$('select#sate_type_select').val('');

				$('select#stat').remove();
				$('#id_net_stat_text').remove();	
				$('#kmeter').val('40');
				$('#kilometer').css("display","none");
				
				$('select#satellite').remove();
				$('select#airplane').remove();
				$('#id_air_sat_select').remove();
				$('h1').remove();
				
				$('select#instrument').remove();
				$('#id_inst_text').remove();
				
				$('.class,label[for="instrument"]').css("display","none");		
				
				$('#sate_type_select').removeAttr('class');
				$('.class,label[for="stat"]').css("display","none");  
				$('.class,label[for="satellite"]').css("display","none");  
				$('.class,label[for="airplane"]').css("display","none"); 
			}
		}
	
		$("select#sate_type_select").live('click', function() {
			$('select#satellite').remove();
			$('select#airplane').remove();
			$('#id_air_sat_select').remove();
			$('h1').remove();
			
			$('select#instrument').remove();
			$('#id_inst_text').remove();
			
			$('.class,label[for="satellite"]').css("display","none");  
			$('.class,label[for="airplane"]').css("display","none"); 
			load_satellite();
		});		
		
		
		function load_satellite(){   
			
			$('#Submit1file').removeAttr("disabled");  //Reset enable button
			$('#submit2files').removeAttr("disabled");  //Reset enable button
			
			var sate_type_value=$('#sate_type_select').attr('value');   
			
			var sg = document.form1.vol2.selectedIndex;   // get volcano index 
			var sgu = document.form1.vol2.options[sg].value;  //get volcano value
			var stationdisplay=$("#conv option:selected").text();  //get station "display" value	
			
			if(sate_type_value != ''){
				$('#sate_air_select').load('./convertie/selectStation_data_ng.php','volcan='+sgu+ '&stationdisplay='+stationdisplay+ '&kilometer=none&satellitetype=' +sate_type_value,function(){ 
						
					//show disabled submit button if there is no network/station/instrument
				
					var check= $("#sate_air_select h1").attr("class");	// To get nosatelliteerror/nostationerror 			
			
					if(check == "nosatelliteerror" || check == "nostationerror"){   
					
						$('#fname1').val('');     
						$('#Submit1file').attr("disabled","disabled");
						
						$('#fname').val('');
						$('#secondname').val('');
						$('#submit2files').attr("disabled","disabled");
						
					}
				});	
			}	
		}
	
		$("select#airplane").live('click', function() {
			
			var satellitename=$('#airplane').attr('value');
			 load_satellite_instrument(satellitename);
		});	
		
		function load_satellite_instrument(satellitename){
			
			$('#Submit1file').removeAttr("disabled");  //Reset enable button
			$('#submit2files').removeAttr("disabled");  //Reset enable button
			
			$('select#instrument').remove();
			$('#id_inst_text').remove();
			$('h1').remove();
	
			var sate_type_value=$('select#sate_type_select').attr('value'); 
			
			var sg = document.form1.vol2.selectedIndex;   // get volcano index 
			var sgu = document.form1.vol2.options[sg].value;  //get volcano value
			var stationdisplay=$("#conv option:selected").text();  //get station "display" value	
			
			if(satellitename != ''){
				$('#instrumentform').load('./convertie/selectInstrument_data_ng.php','volcan='+sgu+ '&stationdisplay='+stationdisplay+ '&staname='+satellitename+'&satellitetype='+sate_type_value,function(){ 
						
					//show disabled submit button if there is no network/station/instrument
				
					var check= $("#sate_air_select h1").attr("class");	// To get noinstrumenterror		
			
					if(check == "noinstrumenterror"){   
					
						$('#fname1').val('');     
						$('#Submit1file').attr("disabled","disabled");
						
						$('#fname').val('');
						$('#secondname').val('');
						$('#submit2files').attr("disabled","disabled");
						
					}
				});	
			}		
		}
	
		$("select#stat").live('click',function() {   // click station dropdown
			
			$('select#instrument').remove();
			$('#id_inst_text').remove();
		
			$('#Submit1file').removeAttr("disabled");  //Reset enable button
			$('#submit2files').removeAttr("disabled");  //Reset enable button				
			
			var stationname=$("#stat option:selected").text();  //get station name		

			var sg = document.form1.vol2.selectedIndex;   // get volcano index 
			var sgu = document.form1.vol2.options[sg].value;  //get volcano value		
			var stationdisplay=$("#conv option:selected").text();  //get station "display" value

			
			if(stationdisplay== "RSAMData" || stationdisplay== "SSAMData"){
				$("#rsam_ssam").css("display","block");  
				$('#rsam_ssamcode').attr('class', 'required');  
				
			}else if(stationdisplay=="RepresentativeWaveform"){
				$('#wave_textfield').css("display","block");
				$('#eventtype_waveselect').val('');
				$('#eventcode').val(''); 
				$('#eventtype_waveselect').attr('class', 'required');  
				$('#eventcode').attr('class', 'required');  
			}
			else if(stationdisplay == "ElectronicTiltData" || stationdisplay == "TiltVectorData" || stationdisplay == "StrainMeterData" || stationdisplay =="EDMData" || stationdisplay == "AngleData" || stationdisplay == "GPSData" || stationdisplay == "GPSVectors" || stationdisplay == "DirectlySampledGas" || stationdisplay == "SoilEffluxData" || stationdisplay == "PlumeData" || stationdisplay == "HydrologicData" || stationdisplay == "MagneticFieldsData" || stationdisplay == "MagnetorVectorData" || stationdisplay == "ElectricFieldsData" || stationdisplay == 
			"GravityData" || stationdisplay == "GroundBasedThermalData" || stationdisplay== "ThermalImage and ThermalImageData" || stationdisplay == "MeteorologicalData" || stationdisplay == "LevelingData"){   // Added stationdisplay=="PlumeData" on 9-May-2012
			
			
				var station_value=$('#stat').attr('value');    // Get station value 
				
				if(station_value != 'Choose Station'){
					$('#instrumentform').load('./convertie/selectInstrument_data_ng.php','volcan='+sgu+ '&stationdisplay='+stationdisplay+ '&staname='+stationname,function(){ 
						
						//show disabled submit button if there is no network/station/instrument
					
						var check= $("#instrumentform h1").attr("class");	// To get noinstrumenterror		
				
						if(check == "noinstrumenterror"){   
						
							$('#fname1').val('');     
							$('#Submit1file').attr("disabled","disabled");
							
							$('#fname').val('');
							$('#secondname').val('');
							$('#submit2files').attr("disabled","disabled");
							
						}
					});	
				}
			}
						
		});
		
	});
		
	</script>

	<div style="padding:5px 0px 0px 5px;">
	<h2>Conversion of Monitoring Data</h2>
	<p><blockquote>Input: CSV file of seismic, deformation, gas, hydrology, field, thermal or meteo data. The data must follow WOVOdat1.1 standard format</blockquote></p>

	<form name="form1" id="form1" action="./convertie/commonconvertdata_ng.php" method="post" enctype="multipart/form-data">
		<div id="lfleft" style="width:5%;"></div>
		<div style="width:40%;  padding-left:90px;">
			<p1>Observatory (data owner): </p1><br>
			<div id='observo'> 
				<select name='observ' id='observ' style="width:180px" class="required">
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
				<select name='conv' id='conv' style="width:180px;" class="required">
				<option value=''> ... </option>
				</select>
			</div>
		</div>

		
		<div style="width:10%;">&nbsp;</div>
		<div id="volDiv" style="width:45%; padding-left:90px;">
			<div id="volblockData">
			</div>
		</div>


		<div id="trm_ivl" style="display:none; padding-left:90px;">
			<div id="trm_ivl_form">
			<p> If an event is located by a network (or) by a single station, please select "Network" (or) "Station" respectively from a below drop down. </p>
			<select id='trm_ivl_select' name='trm_ivl_select' style='width:180px' class='required'>
				<option value=''>...</option>
				<option value='Network' selected='true'>Network</option>
				<option value='Station'>Station</option>
			</select>	
			</div>
		</div>

		<div id="gd_plume" style="display:none; padding-left:90px;">
			<br/><p1>Please choose Ground_Based Station (OR) Airborne:</p1>
			<select id='gd_plume_select' name='gd_plume_select' style='width:180px;'>
				<option value='' selected='true'>...</option>
				<option value='ground_based'>Ground_Based Station</option>
				<option value='cs'>Airborne</option> 
			</select>
		</div>		
		
		<div id="satellite_type" style="display:none; padding-left:90px;">
			<br/><p1>Please choose Airborne Type:</p1><br/>
			<select id='sate_type_select' name='sate_type_select' style='width:180px;'>
				<option value='' selected='true'>...</option>
				<option value='A'>Airplane</option>
				<option value='S'>Satellite</option>
			</select>
		</div>		
		
	
		<div id="sate_air" style="width:45%;padding-left:90px;">
			<div id="sate_air_select">
			</div>
		</div>		
		
		<div id="networkblock" style="width:45%;padding-left:90px;">
			<div id="networkform">
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
		

		<div id="stationblock" style="width:45%;padding-left:90px;">
			<div id="stationform2">
			</div>
		</div>		

		<div id="stationblock" style="width:45%;padding-left:90px;">
			<div id="stationform3">
			</div>
		</div>
		
		<div id="instrblock" style="width:45%;padding-left:90px;">
			<div id="instrumentform">
			</div>
		</div>
		
		<div id="rsam_ssam" style="display:none; padding-left:90px;">
			<br/><p1>Please Enter RSAMSSAM Code here:</p1><br/>
			<input type="text" name="rsam_ssamcode" id="rsam_ssamcode" maxlength="30" style='width:180px'/>
		</div>		

		
		<div id="wave_textfield" style="display:none; padding-left:90px;">
			<div>
				<br/>Please Select Event you want to upload waveform:<br/>
				<select id="eventtype_waveselect" style="width:180px;" name="eventtype_waveselect">
				<option selected="true" value=""> ... </option>
				<option value="EventDataFromNetwork">EventDataFromNetwork</option>
				<option value="EventDataFromSingleStation">EventDataFromSingleStation </option>
				<option value="SeismicTremor">SeismicTremor</option>
				</select>			
			</div>
			<br/>
			Please Enter Event Code here:<br/>
			<input type="text" name="eventcode" id="eventcode" maxlength="30" style='width:180px'/>
		</div>		
		
	
	<div style="width:10%;">&nbsp;</div><div style="width:10%;">&nbsp;</div>
	
	<div id='uploadfile' style="float:left;display:block;">
		<div id='submit_form' style="padding-left:20px;">
			Browse file to convert:<br>
			<input name="MAX_FILE_SIZE" type="hidden" value="2000000"/>
			<input id="fname1" name="fname1" type="file" size="45" maxlength="100"/>
			<br>  
			<input type="submit" name="Submit1file" id="Submit1file" value="Select"/>
		</div>
	</div>  

	<div id='uploadfile2' style="float:left;display:none;">
		<div id='submit_form' style="padding-left:20px;">
			<div id='text1'></div>
			<input name="MAX_FILE_SIZE" type="hidden" value="2000000"/>
			<input id="fname" name="fname" type="file" size="45" maxlength="100"/>
			<br>  
			<div id='text2'></div>
			<input id="secondname" name="secondname" type="file" size="45" maxlength="100"/>
			<br>  			
			<input type="submit" name="submit2files" id="submit2files" value="Select"/>
		</div>
	</div>  
	
	</form>  
</div>
</html>