<html>
	<head>
		<script src="/js/jquery-1.11.1.min.js"></script>
		<link rel="stylesheet" href="/js/jquery-ui-1.11.0.custom/jquery-ui.min.css">
		<script src="/js/jquery-ui-1.11.0.custom/jquery-ui.min.js"></script>
		<script src="/js/jquery-ui-1.11.0.custom/jquery-ui-timepicker-addon.js"></script>
		<script language='javascript' type='text/javascript'>

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

			var append_table_1 = function() {
				var list = ["TJ","TL","VA","VB","LF","Tornillo","Hybrid","Tremor","Tremor Harmonik"];
				var $row1 = $("<tr></tr>");
				var $row2 = $("<tr></tr>");
				for(var i=0; i<list.length; i++) {
					var data = list[i];
					$row1.append("<td> "+data+" </td>");
					$row2.append('<td><input type="text" name="'+data+'"style="width:100px;"></td>')
				}
				$("#submit_form div:nth-of-type(2) table").attr("border","1").append($row1).css("margin-top","10px").append($row2);
				$("#submit_form div:nth-of-type(2) table tr td").attr("width","100px");
			}

			var append_table_2 = function() {
				var list = ["Awan Panas","Hembusan","Guguran","Letusan","Multiphase","Unknown","Non Volcanic","Undefined"];
				var $row1 = $("<tr></tr>");
				var $row2 = $("<tr></tr>");
				for(var i=0; i<list.length; i++) {
					var data = list[i];
					$row1.append("<td> "+data+" </td>");
					$row2.append('<td><input type="text" name="'+data+'"style="width:114px;"></td>')
				}
				$("#submit_form div:nth-of-type(3) table").attr("border","1").append($row1).css("margin-top","10px").append($row2);
				$("#submit_form div:nth-of-type(3) table tr td").attr("width","100px");
			}

			$(document).ready(function() {
				append_table_1();
				append_table_2();

				$(".datepicker").datepicker({dateFormat:'yy-mm-dd'});
				
				$('.timepicker').timepicker({
					timeFormat: "HH:mm:ss"
				});

				load_volcanoes_list();

				$("#volcano").change(function() {
					$("#station").empty();
					$("#station").append(new Option("Select station", ""));
					load_stations_list($("#volcano").val());
				});
			})

		</script>
		<style>
		
		#submit_form td, #result, p.table_header {
			text-align:center;
			font-size: 120%;
			font-weight:bold;
		}
		p.table_header {
			font-size: 144%;
		}
		.align_center {
			margin-left:auto;
			margin-right:auto;
		}

		input.datepicker, input.timepicker {
			width: 120px;
		}
		#result {
			color:red;
		}
		#submit_form div:first-of-type table tr:first-of-type {
			font-size: 120%;
		}
		#submit_form div:first-of-type table {
			display:inline-table;
		}
		#submit_form div:first-of-type table:nth-of-type(-n+2) {
			margin-right: 20px;
		}
		#submit_form div:nth-of-type(n+2) {
			margin-top: 40px;
		}
		</style>
	</head>
	<body>
		<div id="main_body">
			<br/>
			<h2 style = "text-align:center">Upload form for earthquake counts</h2>
			<br/>
			<br/>

			<form name="submit_form" id="submit_form" action="" method="post" enctype="multipart/form-data">

				<input type = "hidden" id = "replace" name = "replace" value = "NO"></input>

				<div style="text-align:center;">
					<table  class="align_center">
						<tr>
							<td> Volcano </td>
							<td> Station </td>
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
						</tr>
					<table class="align_center">
						<tr>
							<td colspan="2"> Start time </td>
						</tr>
						<tr>
							<td> 
								<input name="start_date" class="datepicker" type = "text" placeholder="YYYY-MM-DD"></input> 
							</td>
							<td>
								<input name = "start_time" class = "timepicker" type = "text" placeholder="HH:MM:SS"></input>
							</td>
						</tr>
					</table>
					<table class="align_center">
						<tr>		
							<td colspan="2"> End time </td>
						</tr>
						<tr>
							<td> 
								<input name="end_date" class="datepicker" type = "text" placeholder="YYYY-MM-DD"></input> 
							</td>
							<td>
								<input name = "end_time" class = "timepicker" type = "text" placeholder="HH:MM:SS"></input>
							</td>
						</tr>
					</table>
				</div>

				<div>
					<p class="table_header">Earthquake type</p>
					<table class="align_center">
					</table>
				</div>

				<div>
					<p class="table_header">Earthquake type</p>
					<table class="align_center">
					</table>
				</div>

				<div>
					<table border="1" class="align_center">
						<tr>
							<td>
								Remarks/Comments
							</td>
						</tr>
						<tr>
							<td>
								<input name = "comments" style = "width: 600px" maxlength = "255"> </input>
							</td>
						</tr>
					</table>
				</div>
				<div id = "result"> </div>
				<div class = "align_center" style = "width:170px;">
					<input type = "submit" value="Submit query"> </input>
				</div>
			</form>
		</div>
		<div id = "upload_result"> </div>
	</body>
</html>