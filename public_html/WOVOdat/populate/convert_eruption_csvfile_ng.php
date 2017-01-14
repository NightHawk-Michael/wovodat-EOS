<?php
if (!isset($_SESSION))    // Added on 21-Mar-2013	 
    session_start();  // Start session

if(!isset($_GET['tipedata'])){    // Added on 25-Apr-2012
header('Location: '.$url_root.'home_populate.php');
exit();
}

$ccd=$_SESSION['login']['cc_id'];  // Added on 21-Mar-2013	  
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
		
		function loadconvert() {

			$("#conv").html('<option selected="true" value="">...</option><option value="ed" name="ed">Eruption</option><option value="ed_phs" name="ed_phs">Eruption Phase</option><option value="ed_for" name="ed_for">Eruption forecast</option><option value="ed_vid" name="ed_vid">Eruption video</option>');
       
		}		
		
		
		$("select#conv").live('click', function() {		
			resetall();	
			
			var institute = $("select#observ").val();
			loadvolcano(institute);
		}); 
		

		$("select#vol2").live('click', function() {		
		
			resetall();	
			
			var dataType = $("select#conv").val(); 
			var volcanoName = $("select#vol2").val();

			if(dataType == 'ed_phs' || dataType == 'ed_for' || dataType == 'ed_vid'){ 
				loadEruptionStartTime(dataType,volcanoName);
			}
		}); 

		
		$("select#edStime").live('click', function() {		
		
			//resetall();	
			
			var dataType = $("select#conv").val();	
			
			if(dataType == 'ed_for' || dataType == 'ed_vid'){

				var volcanoName = $("select#vol2").val();
				var edIdValue=$("#edStime option:selected").val();  //get eruption value
				
		       	loadEruptionPhaseStartTime(dataType,edIdValue);
			}
		}); 
		
		function loadvolcano(institute){  
			
			$('#volblockData').load('./convertie/selectVolOfInstitute2_ng.php',"kode=" + institute); 
			return false;
		}
		
		
		function loadEruptionStartTime(dataType,volcanoName){
			
			$('#Submit').removeAttr("disabled");  //Remove disabled="disabled" from sumbit button
				
			$('#edStartTimeform').load('./convertie/selectEruption_ng.php','volcan='+volcanoName+ '&dataType='+dataType,function(result){ 
			
				//show disabled submit button if there is no eruption 
					
				var check = result.substring(11,26);  // To get "noeruptionerror"
				
				if(check == "noeruptionerror"){
												 
					$('#fname').val('');
					$('#Submit').attr("disabled","disabled");
				}
			});	

		}	


		function loadEruptionPhaseStartTime(dataType,edIdValue){
		
			$('#Submit').removeAttr("disabled");  //Remove disabled="disabled" from sumbit button
				
			$('#edPhaseStartTimeform').load('./convertie/selectEruptionPhase_ng.php','&dataType='+dataType+ '&edId='+edIdValue,function(result){ 
			
				//show disabled submit button if there is no eruption phase
					
				var check = result.substring(11,29);  // To get "noeruptionphserror"
				
				if(check == "noeruptionphserror"){    
												 
					$('#fname').val('');
					$('#Submit').attr("disabled","disabled");
				}
			});			
		
		}
		
		
		function resetall(){  
		
			$('select#edStime').remove();
			$('#ped').remove(); 
			$('h1').remove();
			
			$('select#edPhsStime').remove();
			$('#pedPhs').remove(); 			
			
			$('#fname').val('');                    // Clear value of file input 
			$('#Submit').removeAttr("disabled");    //Remove disabled="disabled" from sumbit button
			
		} 
	    
	});
	</script>

<div style="padding:0px 0px 0px 5px;">
<h2>Conversion of Eruption data</h2>
<blockquote>Input: CSV file of eruption data. The data must follow the WOVOdat1.1 standard format</blockquote>

<form name="form1" id="form1" action="./convertie/commonconverteruption_ng.php" method="post" enctype="multipart/form-data">
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
			<p1>Type of Data to convert: </p1><br>
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
		

		<div id="edStartTimeblock" style="width:45%;padding-left:90px;padding-top:20px;">
			<div id="edStartTimeform">
			</div>
		</div>		
	
		<div id="edPhaseStartTimeblock" style="width:45%;padding-left:90px;padding-top:20px;">
			<div id="edPhaseStartTimeform">
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