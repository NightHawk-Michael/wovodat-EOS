<html>
<head>
	<title>Form</title>
	<link rel="stylesheet" href="/css/normalize.css">
	<script src="/js/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" href="/js/jquery-ui-1.11.0.custom/jquery-ui.min.css">
	<link rel="stylesheet" href="/css/jquery.multiselect.css">
	<script src="/js/jquery-ui-1.11.0.custom/jquery-ui.min.js"></script>
	<script src="/js/jquery-ui-1.11.0.custom/jquery-ui-timepicker-addon.js"></script>
	<script src="/js/jquery.multiselect.min.js"></script>
	<script src="/js/jquery.cookie.js"></script>

	<script language="javascript" type='text/javascript'>

		var booleanStorage = {};
		if ( $.cookie('booleanData') )
			booleanStorage = JSON.parse($.cookie('booleanData'));
	
		/*************************************************
		* indicate that which datatype had dropdown box
		**************************************************/
		var has_dropdownbox= ["feature","rock","edPhase","sd_evn","sd_evs","sd_ivl","sd_trm","gd","gd_plu","gd_sol","hd"];


		/*************************************************
		* Number of selected optioned allowed in MainCategory
		**************************************************/
		var maxSelectedMainCategory = 6;

		/*************************************************
		* Number of selected optioned allowed in dropdownbox
		**************************************************/
		var maxSelectedDropdownbox = 2;

		/*************************************************************************
		* Choose which type will be disable, not allowed to check in MainCategory.
		**************************************************************************/
//		var disabled_type = [ "sd_evs", "sd_int", "sd_trm","sd_rsm","sd_ssm","dd_ang","dd_edm","dd_gpv","dd_lev","dd_sar","dd_str","fd_ele","fd_gra","fd_mag","fd_mgv","gd","gd_sol","td","med"];	
		var disabled_type = [ ""];

		/**************************************************************************
		*  option for dateTimePicker
		**************************************************************************/
		var datetimepicker_option = {
			dateFormat: "yy-mm-dd",
			timeFormat: "HH:mm:ss",
			changeMonth: true,
			changeYear:true,
			yearRange: "-200:+0" 
		}

		/**************************************************************************
		*  File to process submit on server
		**************************************************************************/
	//	var file_to_submit = "../booleanSubmit.php";
		var file_to_submit = "booleanSubmit.php";

		$(document).ready(function() {
			// add Header
			$("div#select_mainCategory p:first-of-type").html("Criteria that you can select<br/>(Maximum "+maxSelectedMainCategory+" criteria are able to select simultaneously)")

			// add Multiselect for MainCategory dropdown box
			$("select[name^='mainCategory']").multiselect({
				header:false,
				minWidth:400,
				height:300,
				click : function(e,ui) {
					if( $(this).multiselect("widget").find("input:checked").length > maxSelectedMainCategory )
						return false;
					
					if (ui.checked) {
						turn_on_display(ui.value+"_wrapper");
						$("input[name='"+ui.value+"']").attr('disabled', false);
						if (ui.value == "vei") {

						}
					}
					else  {
						turn_off_display(ui.value+"_wrapper");
						$("#"+ui.value+"_wrapper div.validation_alert").css("display","none");
					}

					turn_off_display("Volcano");
					turn_off_display("Eruption");
					turn_off_display("Monitoring");
					$("input.date").val("");

					$("input[name='edTimeMin']").attr("disabled",false);
					$("input[name='edTimeMax']").attr("disabled",false);

					$("input[name='veiMin']").attr("disabled",false);
					$("input[name='veiMax']").attr("disabled",false);
			

					turn_off_display("edTime_wrapper");

					$list = $(this).multiselect("getChecked");
					var check = false;
					$list.each(function() {
						var $li = $(this).parent().parent();
						var id = $li.index();
						if (id<=2) turn_on_display("Volcano");
						else if (4<=id && id<=6)  {
							turn_on_display("Eruption");
							check=true;
						} 
						else {
							turn_on_display("Monitoring");
							check=true;
						}
					});

					if (check) {
						turn_on_display("Eruption");
						turn_on_display("edTime_wrapper");
						$("#edTime_wrapper div.validation_alert").css("display","none");
					}

					return true;
				},
				beforeoptgrouptoggle :function(e,ui) {
					return false;
				}
			});

			// add datepicker for date input type
			$("input.date").attr("placeholder","").datetimepicker(datetimepicker_option);

			$("select[name^='mainCategory']").multiselect("uncheckAll");

			disabledDataType();

			adjust();

			build_all_data();

			$("#edTime_wrapper").find("input").change(function() {
				var okay = 1;
				$("#edTime_wrapper").find("input").each(function() {
					if ($(this).val() == "" ) okay=0;	
				});
				if (okay==1) 
					$("#edTime_wrapper div.validation_alert").css("display","none");
			});


			$("input[type='button']").click(function( e ) {
				clearAllData();
			});

			

			$("#boolean_form").submit(function() {
				$(this).attr("action",file_to_submit);
				if (!validation()) return false;

				saveAllData();

				//loadAllData();

				remove_redundant_data_when_submit();

				return true;
			});

			loadAllData();

		});

		var saveAllData = function() {
			var booleanStorage = {};
			booleanStorage.mainCategory = $("select[name^='mainCategory']").val();

			var list = ["Volcano","Eruption","Monitoring"];
			for (var i = 0; i<list.length; i++) 
			$("optgroup[label='"+list[i]+" Criteria']").find("option").each(function() {
				var val = $(this).val();
				if ( $.inArray(val,has_dropdownbox) != -1 ) {
					if ($("select[name^='"+val+"']").val())
						booleanStorage[val] = $("select[name^='"+val+"']").val();
				}
				else if (val=="vei") {
					booleanStorage.veiMin = $("input[name='veiMin']").val();
					booleanStorage.veiMax = $("input[name='veiMax']").val();
				}
			});

			booleanStorage.edTimeMin = $("input[name='edTimeMin']").val();
			booleanStorage.edTimeMax = $("input[name='edTimeMax']").val();

			$.cookie('booleanData', JSON.stringify(booleanStorage) , {expires : 7, path: '/'});
		}

		var loadAllData = function(  ) {
			
			loadSpecificSelectData( 'mainCategory' );

			loadVeiData(  );

			loadEruptionTime(  );
		}

		var loadSpecificSelectData = function (  value  ) {

			var select = $("select[name^='"+value+"']").multiselect("widget");
			var vals = booleanStorage[value] || [];
			for(var i = 0; i < vals.length; i++) {
			 	var val = vals[i];
			 	select.find("input[value='"+val+"']").each(function() {
					this.click();
				});
			}
		}

		var loadVeiData = function(  ) {
			var veiMinVal = booleanStorage.veiMin || "";
			$("input[name='veiMin']").val(veiMinVal);
			var veiMaxVal = booleanStorage.veiMax || "";
			$("input[name='veiMax']").val(veiMaxVal);
		}

		var loadEruptionTime = function(  ) {
			var edTimeMin = booleanStorage.edTimeMin || "";
			$("input[name='edTimeMin']").datetimepicker( "setDate", edTimeMin );
			var edTimeMax = booleanStorage.edTimeMax || "";
			$("input[name='edTimeMax']").datetimepicker( "setDate", edTimeMax );
		}

		var clearAllData = function() {

			var list = ["Volcano","Eruption","Monitoring"];
			for (var i = 0; i<list.length; i++) 
			$("optgroup[label='"+list[i]+" Criteria']").find("option").each(function() {
				var val = $(this).val();
				if ( $.inArray(val,has_dropdownbox) != -1 ) {
					$("select[name^='"+val+"']").multiselect("uncheckAll");
					$("#"+val+"_wrapper p.selected_list").text("");
				}
				else if (val=="vei") {
					$("input[name='veiMin']").val("");
					$("input[name='veiMax']").val("");
				}
			});

			$("input[name='edTimeMin']").datetimepicker( "setDate", "" );
			$("input[name='edTimeMax']").datetimepicker( "setDate", "" );
		}

		var disabledDataType = function() {
			$("select[name^='mainCategory']").multiselect("widget").find("input").each(function() {
				var val = $(this).val();
				if ( $.inArray(val,disabled_type) !=-1  ) {
					$(this).attr("disabled","true");
				}
			});
		}

		var remove_redundant_data_when_submit = function () {
			$list = $("select[name^='mainCategory']").multiselect("widget").find("input");
			$list.each(function() {
				var val = $(this).val();
				if ($(this).prop("checked")) {
					// do something here when check
					
				} else {
					// do something here when uncheck
					
					if ( $.inArray(val,has_dropdownbox) !=-1  ) {
						$("select[name='"+val+"[]']").multiselect("uncheckAll");
						$("#"+val+"_wrapper p.selected_list").text("");
						//console.log(val+":remove dropdown");
					} else if (val=="vei") {
						$("input[name='veiMin']").attr("disabled","disabled");
						$("input[name='veiMax']").attr("disabled","disabled");
					} else {
						$("input[name='"+val+"']").attr("disabled","disabled");
					}
				}
			});

			if ( $("#edTime_wrapper").css("display") == "none" ) {
				$("input[name='edTimeMin']").attr("disabled","disabled");
				$("input[name='edTimeMax']").attr("disabled","disabled");
			}

		}   

		var validation = function() {
			var check = 1;

			// check dropdown box
			$list = $("select[name^='mainCategory']").multiselect("getChecked");
			
			if ( $list.length == 0 ) return 0;

			$list.each(function() {
				var val = $(this).val();
				
				if ( $.inArray(val,has_dropdownbox) != -1 ) {

					
					if ($("select[name='"+val+"[]']").multiselect("getChecked").length==0) {
						check=0;
						$("#"+val+"_wrapper div.validation_alert").css("display","inline-block");
					} else {
						$("#"+val+"_wrapper div.validation_alert").css("display","none");
					}
				}
			});

			// check eruption start and end time
			if ( $("#edTime_wrapper").css("display") == "block" ) {
				$("#edTime_wrapper").find("input").each(function() {
					if ($(this).val() == "") {
						check=0;
						$("#edTime_wrapper div.validation_alert").css("display","inline-block");
					}
				});
			}
			
			return check;
		}

		var adjust = function() {
			$("div.ui-multiselect-menu").first().find("li").css("margin-left","30px");
			$("div.ui-multiselect-menu").first().find("li.ui-multiselect-optgroup-label")
				.css("margin-left","5px");
			var list = ["Seismic","Deformation","Field","Gas","Hydrologic","Thermal","Meteo"];
			var pos = [8,16,25,30,34,36,38];
			for (var i=0;i<list.length;i++) {
				$li = $("<li></li>");
				$li.css("font-weight","bold").css("margin-left","15px").css("margin-top","2px").css("font-size","0.9em");
				$li.append(list[i]);
				$("div.ui-multiselect-menu").first().find("li").eq(pos[i]-1).after($li);
			}
		}

		var build_all_data = function() {
			var list = ["Volcano","Eruption","Monitoring"];
			for (var i = 0; i<list.length; i++) 
				$("optgroup[label='"+list[i]+" Criteria']").find("option").each(function() {
					$("#"+list[i]).append( build_data( $(this).val(), $(this).text() ) ); 
				});
			$("#Eruption").append( build_data("edTime" , "Eruption Time") );
		}

		var build_data = function(val,text) {
			var $container = $("<div id='"+val+"_wrapper'></div>");
			$container.addClass("hidden_data data-wrapper");

			var $header = $("<p>"+text+": </p>");
			$header.addClass("data-header");
			

			$container.append($header);

			if ( $.inArray(val,has_dropdownbox)!=-1 ) {
				addDropdownBox($container, val);

			}  else if (val=="vei") {
				addVEIRange($container);
			} else if (val=="edTime") {
				addTime($container);
				var $div_validation2 = $("<div></div>");
				$div_validation2.addClass("validation_alert hidden_data").append("Time must not be blank!").css("margin-left","20px");
				$container.append($div_validation2);
			} else 
				addHiddenInput($container, val);
			
			return $container;
		}

		var addDropdownBox = function ( $container,val ) {

			var limit_select_value = function(e,ui) {
					if( $(this).multiselect("widget").find("input:checked").length > 0 ){
						$("#"+val+"_wrapper div.validation_alert").css("display","none");
					}
					if( $(this).multiselect("widget").find("input:checked").length > maxSelectedDropdownbox ){
						return false;
					}
					var $p = $("#"+val+"_wrapper p.selected_list");
					$p.text("");
					$(this).multiselect("widget").find("input:checked").each(function() {
						if ( $p.text() != "" ) $p.append(", ");
						$p.append($(this).attr("title"));	
					});
					return true;
			};

			var $select = $("<select name='"+val+"[]' multiple='multiple'></select>");

			$.ajax({
				type:"GET",
				dataType:"json",
				url:"model/booleanIndex_m.php",
				data: "dataType="+val,
				success:function(result) {
					if (result.length == 0) {
			 			$select.append(new Option("Nodata","Nodata"));
					} else {
						if ( val == "sd_evn" || val == "sd_evs" || val ==  "sd_ivl" ) {
							for(var i = 0; i < result.length; i++)
								$select.append(new Option(result[i][0], result[i][1]));
						}  else {
							for(var i  = 0; i < result.length; i++) {
								$select.append(new Option(result[i],result[i]));
							}
						}
					}

					var $div_validation = $("<div>Please select at least one option!</div>");
					$div_validation.addClass("validation_alert hidden_data");

					$selected_list = $("<p></p>");
					$selected_list.addClass("selected_list");
					$container.append($select).append($selected_list);

					$select.multiselect({
						header:false,
						minWidth:350,
						height:150,
						noneSelectedText: "Maximum "+maxSelectedDropdownbox+" criteria are able to select",
						selectedText: "Maximum "+maxSelectedDropdownbox+" criteria are able to select",
						click: limit_select_value
					});

					//$container.find("button").css("display","inline-block");
					$container.append($div_validation);

					loadSpecificSelectData(val);
				}
			});

		}


		var addHiddenInput = function($container, val) {
			var $input = $("<input type='hidden' value='' name="+val+">");
			$container.append($input);
		} 

		var addVEIRange = function( $div_wrapper ) {
			var $lower = $("<input type='text' name='veiMin'>").addClass("vei-input");
			
			var $p = $("<p class='range'> &lt;= Range &lt;= </p>").addClass("eruption-time-text");
			
			var $upper = $("<input type='text' name='veiMax'>").addClass("vei-input");

			$div_wrapper.append($lower).append($p).append($upper);
		}

		var addTime = function($div_wrapper) {
			var $p = $("<p>Start: </p>").addClass('eruption-time-text').css("margin-right","10px");
			$div_wrapper.append($p);

			var $input_start = $("<input type='text' name='edTimeMin' placeholder=''>");
			$input_start.addClass("eruption-time-input").datetimepicker(datetimepicker_option);
			$div_wrapper.append($input_start);

			var $p = $("<p>End: </p>").addClass('eruption-time-text')
				.css("margin-right","10px").css("margin-left","20px");
			$div_wrapper.append($p);

			var $input_end = $("<input type='text' name='edTimeMax' placeholder=''>");
			$input_end.addClass("eruption-time-input").datetimepicker(datetimepicker_option);	
			$div_wrapper.append($input_end);
		}

		var turn_on_display = function(id) {
			$("#"+id).css("display","block");
		}
		var turn_off_display = function(id) {
			$("#"+id).css("display","none");
		}

		function sleep(milliseconds) {
		  	var start = new Date().getTime();
		  	for (var i = 0; i < 1e9; i++) {
		    	if ((new Date().getTime() - start) > milliseconds){
		    	  	break;
		    	}
		  	}
		}


	</script>

	<style>
		.hidden_data {
			display:none;
		}
		u {
			font-size: 1.1em;
			display: block;
		}
		form {
			margin-left:5px; 
		}
		.wrapper {
			margin-top: 20px;
			margin-left: 20px;
		}
		.ui-datepicker {
			width:230px;
			font-size: 0.9em;
		}
		.validation_alert {
			/*border-radius: 5px;
			border: 1px #F5142E solid;
			height:20px;
			width: 250px;
			background-color: #dddddd;
			text-align: center;
			padding-top: 5px;*/
			font-size: 0.8em;
			font-style: italic;
			color:red;

		}
		div#select_mainCategory {
			text-align: center;
		}
		body h2:first-of-type {
			text-align: center;
		}
		input[type="submit"] {
			margin-left: 40%;
		}
		button.ui-multiselect {

		}
		.data-wrapper {
			font-size: 15px;
			margin-left: 10px;
			margin-top: 10px;
		}
		.data-header {
			display: inline-block;
			margin-right: 25px;
			width: 175px;
		}
		.selected_list {
			display: inline-block;
			margin-left: 20px;
		}
		.vei-input {
			display: inline-block;
			width: 100px;
		}
		.eruption-time-text {
			display: inline-block;
			font-size: 0.8em;
		}
		.eruption-time-input {
			width: 180px;
			display: inline-block;
		}
		button span {
			font-size: 13px;
		}
	</style>
</head>
<body>
	<h2>WOVOdat Boolean Search Form</h2>

	<form id="boolean_form" name="boolean_form" method="post" action="">
		<div id="select_mainCategory">
			<p></p>
			<select name="mainCategory[]" multiple="multiple">
				<optgroup label="Volcano Criteria">
					<option value="feature">Features</option>
					<option value="rock">Rock Types</option>
				</optgroup>
				<optgroup label="Eruption Criteria">
					<option value="edPhase">Eruption Phases</option>
					<option value="vei">VEI</option>
					<!--<option value="edTime">Eruption Time</option> -->
				</optgroup>
		
	
				<optgroup label="Monitoring Criteria">
					
						<option value="sd_evn">Network Events</option>
						<option value="sd_evs">Single Station Events</option>
						<option value="sd_int">Seismic Intensity</option>
						<option value="sd_ivl">Interval (Swarm)</option>
						<option value="sd_trm">Tremor</option>
						<option value="sd_rsm">RSAM</option>
						<option value="sd_ssm">SSAM</option>
					
						<option value="dd_ang">Angle</option>
						<option value="dd_edm">EDM</option>
						<option value="dd_gps">GPS</option>
						<option value="dd_gpv">GPS vector</option>
						<option value="dd_lev">Leveling</option>
						<!-- <option value="dd_sar">InSAR</option> -->
						<option value="dd_str">Strain</option>
						<option value="dd_tlt">Tilt</option>
						<option value="dd_tlv">Tilt vector</option>
					
						<option value="fd_ele">Electricity (SP)</option>
						<option value="fd_gra">Gravity</option>
						<option value="fd_mag">Magnetic Fields</option>
						<option value="fd_mgv">Magnetic Vector</option>
					
						<option value="gd">Sampled Gas</option>
						<option value="gd_plu">Plume</option>
						<option value="gd_sol">Soil Effux</option>
					
						<option value="hd">Hydrologic Sampled Data</option>
					
						<option value="td">Thermal Data</option>
					
						<option value="med">Meteo Data</option>
					
				</optgroup>
			</select>
		</div>
		<div id="Volcano" class="wrapper hidden_data">
			<u style="font-weight:bold;font-size:15px;text-decoration:none;">Volcano Criteria:</u>
		</div>
		<div id="Eruption" class="wrapper hidden_data" >
			<u style="font-weight:bold;font-size:15px;text-decoration:none;">Eruption Criteria:</u>
		</div>
		<div id="Monitoring" class="wrapper hidden_data">
			<u style="font-weight:bold;font-size:15px;text-decoration:none;">Monitoring Criteria:</u><br/>
		</div>
		<input type="submit" value="Search" style="margin-top:30px;width:100px;font-size:15px;">
		<input type="button" value="Clear All Fields" style="margin-left:30px;width:120px;font-size:15px;">
	</form>


	
</body>
</html>

<?php
//}
	
?>

