<html>
<head>
	<script src="/js/jquery-1.4.2.min.js"></script>
	<link rel="stylesheet" href="/js/development-bundle/themes/base/jquery.ui.all.css">	
	<script src="/js/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="/js/development-bundle/ui/jquery.ui.datepicker.js"></script>
	<script language='javascript' type='text/javascript'>
		$(document).ready(function() {
			$("#datepicker").datepicker({dateFormat:'yy-mm-dd'});
			load_volcanoes_list();
			load_earthquake_types_list();
			function load_volcanoes_list() {
				$.ajax({
					method:"GET",
					url:"get_volcanoes_list.php",
					data:"observatory=CVGHM",
					dataType:"json",
					success:function(result) {
						for (var i = 0; i < result.length; i++) {
							$("#volcano").append(new Option(result[i]['name'], result[i]['id']));
						}
					}
				});			
			}

			function load_earthquake_types_list() {
				var value = ['R_D', 'R_L', 'VT_D', 'VT_S', 'LF', 'LF_T', 'H', 'T_G', 'T_H', 'PF', 'MP', 'G', 'RF', 'E', 'U', 'O', 'X'];
				var display = ['Tektonik Jauh (TJ)', 'Tektonik Lokal (TL)', 'Vulkanik Dalam (VA)', 'Vulkanik Dangkal (VB)',
								'Low Frequency (LF)', 'Tornillo', 'Hybrid', 'Tremor (general)', 'Tremor (harmonic)', 
								'Pyroclastic Flow (Awan Panas)', 'Multiphase', 'Hembusan', 'Rockfall (Guguran)', 'Letusan',
								'Unknown origin', 'Other, non volcanic origin', 'Undefined'];
				for (var i = 0; i < value.length; i++) {
					$("#earthquake_type").append(new Option(display[i], value[i]));
				}
			}

			function load_stations_list(volcano) {
				if (!volcano) return;
				$.ajax({
					method:"GET",
					url:"get_stations_list.php",
					data:"data_type=Seismic" + "&volcano_id="+ volcano,
					dataType:"json",
					success:function(result) {
						var sel = $('#station');
						for(var i = 0; i < result.length; i++) {
							sel.append(new Option(result[i]['name'], result[i]['id'] + '$' + result[i]['code']));
						}
					}
				});				
			}

			$("#volcano").change(function() {
				$("#station").empty();
				$("#station").append(new Option("Select station", ""));
				load_stations_list($("#volcano").val());
			});

		    function isNumeric(val){
			    return !isNaN(parseFloat(val)) && isFinite(val);
			}

			function isDigit(d) {
				var digits = "0123456789";
				return digits.indexOf(d) != -1;
			}

			function ok(year, month, day) {
				var num = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
				if (year % 400 == 0 && (year % 100 != 0 && year % 4 == 0)) num[1] = 29;
				return 1 <= day && day <= num[month - 1];
			}

			function validDate(date) {
				if (date.length != 10) return false;
				if (date[4] != '-') return false;
				if (date[7] != '-') return false;
				for (var i = 0; i < 10; i++) if (i != 4 && i != 7 && !isDigit(date[i])) return false;
				var year = parseInt(date.substring(0, 4));
				if (year < 1970 && year > 2100) return false;
				var month = parseInt(date.substring(5, 8));
				if (month < 1 && month > 12) return false;
				var day = parseInt(date.substring(9));
				if (ok(year, month, day))
					return true;
				return true;
			}

			function validTime(time) {
				if (time.length != 8) return false;
				if (time[2] != ':') return false;
				if (time[5] != ':') return false;
				for (var i = 0; i < 8; i++) if (i != 2 && i != 5 && !isDigit(time[i])) return false;
				var hour = parseInt(time.substring(0, 2));
				if (hour > 23) return false;
				var minute = parseInt(time.substring(3, 5));
				if (minute > 59) return false;
				var second = parseInt(time.substring(6));
				if (second > 59) return false;
				return true;				
			}

			function validMillisec(millisec) {
				if (!isNumeric(millisec)) return false;
				var value = parseFloat(millisec);
				return (0 <= value && value < 1);
			}

		    function error(name) {
		    	var val = $('[name="' + name + '"]').val();
		    	switch(name) {
					case 'volcano':
					case 'station':
					 	if (!val) return 1;
						break;
					case 'date':
						if (!val) return 1;
						if (!validDate(val)) return 2;
						break;
					case 'time':
						if (!val) return 1;
						if (!validTime(val)) return 2;
						break;
					case 'millisec':
						if (!val) return 1;
						if (!validMillisec(val)) return 2;
 						break;
					default:
						if (val && !isNumeric(val)) return 2;
				}
		    	return 0;
		    }

		    function get_error_code() {
		    	var list = ['volcano', 'station', 'date', 'time', 'millisec', 'drum_plot_record_no',
		    				'sp_interval', 'duration', 'max_amplitude_of_trace', 'frequency', 'magnitude',
		    				'energy'];
		    	var name = ['Vocano', 'Station', 'Date', 'Time', 'Milli second', 'Drum plot record no.',
		    				'S-P interval', 'Duration', 'Max. amplitude of trace', 'Frequency', 'Magnitude', 'Energy'];
		    	for (var i = 0; i < list.length; i++) {
		    		if (error(list[i])) return [name[i], error(list[i])];
		    	}
		    	return 0;
		    }

		    function display_result(response) {
		    	var title = $('<h2>Uploading Seismic Data Result:</h2>');
		    	var announcement = '';
		    	if (response == 'Existed') {
		    		announcement = $('<h3>Data already existed in the database!</h3>');
		    		var replace = $('<a href = "#"> Replace</a>');

		    		replace.click(function() {
		    			$("#replace").val("YES");
		    			var parent = $(this).parent();
						$.post("upload/Seismic.php",  $("#submit_form").serialize(),
						  	function(data){
						  		parent.append("&nbsp; " + data);
						  	}, "text"
						);		    			
		    			$(this).remove();
		    		});
		    		announcement.append(replace);		    		
		    	}

		    	if (response == 'Success') announcement = $('<h3>Successfully uploaded into the database!</h3>');
		    	if (response == 'Failed') announcement = $('<h3>There is error occured. Please try to upload again!</h3>');
		    	var back = $('<a href = "#"></a>');
		    	back.html('<h3>Go Back!<h3>');
		    	back.click(function() {
		    		location.reload();
		    	});

		    	var res = $('<div></div>');
		    	res.append('<br/><br/>');
		    	res.append(title);
		    	res.append('<br/><br/>');
		    	res.append(announcement);
		    	res.append('<br/><br/>');
		    	res.append(back);
		    	res.css('height', '400px');
		    	return res;
		    }

		    $("#submit_form").submit(function() {
		    	$("#result").html('');
		    	var s = get_error_code();
		    	code = ['Field require', 'Wrong format'];
		    	if (s) {
		    		$("#result").html('There is error in ' + s[0] + ': ' + code[s[1] - 1] + '!');
		    		return false;
		    	}
				var didConfirm = confirm("Are you sure to submit your data?");
				if (didConfirm) {				
					$.post("upload/Seismic.php",  $("#submit_form").serialize(),
					  	function(data){
					  		$('#main_body').css('display','none');
					  		$('#upload_result').append(display_result(data));
					  		$('html, body').animate({ scrollTop: 0 });
					  	},"text"
					);
				}
				return false;
		    });

		});
	</script>
	<style>

		#submit_form td, #result {
			text-align:center;
			font-size: 120%;
			font-weight:bold;
		}

		.align_center {
			margin-left:auto;
			margin-right:auto;
		}

		input {
			width: 175px;
		}

		#result {
			color:red;
		}
	</style>
</head>
<body>
	<div id = "main_body">
	<br/>
	<h2 style = "text-align:center">Upload form for Seismic data</h2>
	<br/><br/>
	<form name = "submit_form" id = "submit_form" action = "" method = "post" enctype="multipart/form-data">
		<input type = "hidden" id = "replace" name = "replace" value = "NO"></input>
		<div>
			<table border = "1" class = "align_center">
				<tr>
					<td> Volcano </td>
					<td> Station </td>
					<td colspan = "3"> Date-time </td>
				</tr> 
				<tr>
					<td>
						<select id = "volcano" name = "volcano" class = "dropdown_list">
							<option value = "">Select volcano</option>
						</select>
					</td>
					<td>
						<select id = "station" name = "station" class = "dropdown_list">
							<option value = "">Select station</option>			
						</select>						
					</td>
					<td> 
						<input name="date" id="datepicker" type = "text" placeholder="YYYY-MM-DD"></input> 
					</td>
					<td>
						<input name = "time" id = "time" type = "text" placeholder="HH:MM:SS"></input> 
					</td>
					<td>
						<input name = "millisec" id = "millisec" type = "text" placeholder = "0.SS"></input>
					</td>
				</tr>
			</table>
		</div>
		<br/><br/>
		<div>
			<table border = "1" class = "align_center">
				<tr>
					<td>Drum plot record no.</td>
					<td>Pick determination</td>
					<td>S-P interval(s)</td>
					<td>Duration(s)</td>
					<td>Max. amplitude of trace</td>
				</tr>

				<tr>
					<td> <input name = "drum_plot_record_no"></input></td>
					<td> 
						<select name = "pick_determination" class = "dropdown_list">
							<option value = "A"> A(automatic picker) </option>
							<option value = "R"> R(Ruler) </option>
							<option value = "H"> H(Human using computer) </option>
							<option value = "U"> U(Unknown) </option>
						</select>
					</td>
					<td> <input name = "sp_interval"></input></td>
					<td> <input name = "duration"></input></td>
					<td> <input name = "max_amplitude_of_trace"></input></td>
				</tr>
			</table>
		</div>
		<br/><br/>
		<div>
			<table border = "1" class = "align_center">
				<tr>
					<td>Frequency(Hz)</td>
					<td>First motion</td>
					<td>Magnitude</td>
					<td>Energy(Erg)</td>
					<td>Earthquake type </td>
				</tr>

				<tr>
					<td> <input name = "frequency"></input></td>
					<td> <select name = "first_motion" class = "dropdown_list">
							<option value = "Up"> Up </option>
							<option value = "Down"> Down </option>
							<option value = "Unknown"> Unknown </option>
						</select>
					</td>
					<td> <input name = "magnitude"></input></td>
					<td> <input name = "energy" placeholder = "Eg. 1.91E+15"></input></td>
					<td> <select id = "earthquake_type" name = "earthquake_type" class = "dropdown_list"></select></td>
				</tr>
			</table>			
		</div>
		<br/><br/>
		<div>
			<table border = 1 class = "align_center">
				<tr>
					<td>
						Remarks/Comments
					</td>
				</tr>
				<tr>
					<td>
						<input name = "comments" style = "width: 400px" maxlength = "255"> </input>
					</td>
				</tr>
			</table>
		</div>
		<br/><br/>
		<div id = "result"> </div>
		<br/><br/>
		<div class = "align_center" style = "width:170px;"><input type = "submit"> </input></div>
	</form>  
	</div>
	<div id = "upload_result"> </div>
</body>	
<html>