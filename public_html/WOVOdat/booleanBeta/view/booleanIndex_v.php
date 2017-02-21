<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="/css/normalize.css">

		<script src="/js/jquery-1.11.1.min.js"></script>
		<link rel="stylesheet" href="/js/jquery-ui-1.11.0.custom/jquery-ui.min.css">
		<link rel="stylesheet" href="/css/jquery.multiselect.css">
		<!--Import Google Icon Font-->
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="/css/materialize.min.css"  media="screen,projection"/>

		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
		<META HTTP-EQUIV="Expires" CONTENT="-1">
		<link rel="stylesheet" href="/css/bootstrap.min.css">
		<link rel="stylesheet" href="/css/custom.css">
		<link rel="stylesheet" href="/css/nouislider.min.css">

		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<link rel="stylesheet" href="/css/material-datetime-picker.css">
		<script src="/js/bootstrap.min.js"></script>
		<script src="/js/jquery.min.js"></script>

		<script src="/js/jquery-ui-1.11.0.custom/jquery-ui.min.js"></script>
		<script src="/js/jquery-ui-1.11.0.custom/jquery-ui-timepicker-addon.js"></script>
		<script src="/js/jquery.multiselect.min.js"></script>
		<script src="/js/jquery.cookie.js"></script>
		<script src="/js/boolean.js"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="/js/materialize.min.js"></script>
		<script type="text/javascript" src="/js/nouislider.min.js"></script>
		<script src="/js/locationpicker.jquery.js"></script>
		<script src="https://unpkg.com/babel-polyfill@6.2.0/dist/polyfill.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/rome/2.1.22/rome.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.js"></script>
		<script src="/js/material-datetime-picker.js"></script>

		<!-- Google Map Api requires browser key to function! key used here key=AIzaSyCbWJuHGfa_2MzsOL2ARASmqV2JyCpdmm8 -->
		<!-- To upload to server, a modification of browser key may need to be done! -->
		<script type="text/javascript" src='http://maps.google.com/maps/api/js?key=AIzaSyCbWJuHGfa_2MzsOL2ARASmqV2JyCpdmm8&sensor=false&libraries=places'></script>

	</head>


	<body>
		<!--Import jQuery before materialize.js-->
		<link rel="stylesheet" type="text/css" href="/css/jquery.datetimepicker.css"/ >
		<script src="/jquery.js"></script>
		<script src="/js/jquery.datetimepicker.full.min.js"></script>
		<h2>WOVOdat Boolean Search Form (Beta Version)</h2>
		<h4 style="text-align:center">Only Network Events and Sampled Gas options are working</h4>
		<img src="/boolean/view/loader.gif" id="loadingGif">
		<form id="boolean_form" name="boolean_form" method="post" action="">
			<div id="mainCategory " class = "container">
				<!-- VOLCANO SEARCH -->
				<div id="Volcano_Search" class = "  row" data-collapsible="expandable">
					<?php		include 'htmlView/volcano_search.html'; ?>
				</div>
				<!-- ERUPTION SEARCH -->
				<div id="Eruption_Search" class = "row">
					<?php include 'htmlView/eruption_search.html'; ?>
				</div>
				<!-- MONITORING DATA SEARCH -->
				<div id="Monitoring_Data_Search" class="row">
					<button class="btn btn-primary left-align col s4" type="button" data-toggle="collapse" data-target="#Collapse">Monitoring Data Search
						<i class="material-icons right">send</i>
					</button>
					<div id="Collapse" class="innerData collapse col s10 offset-s1">
						<?php include 'htmlView/monitoring_list.html'; ?>
						<div class  = "col s12">
							<button class="btn btn-primary left-align col s4 row " type="button" data-toggle="collapse" data-target="#advSearchId">Advanced Search
								<i class="material-icons right">add</i>
							</button>
						</div>
						<br/>
						<div id="advSearchId" class=" innerData collapse row">
							<div id="searchPeriod" class = "row">
								<div class = "col s3">Priority Time Period: </div>
								<div class = "col s1">Start:</div>
								<input disabled class = "col s2 datetime" type="datetime" name="priorityTimeMin" id="priorityTimeMin" style = "width:18%" >
								<div class = "col s1">End:</div>
								<input disabled  class = "col s3 " type="datetime" name="priorityTimeMax" id="priorityTimeMax" style = "width:18%">
							</div>
							<div id="slider-range" class = "row col s10"></div>


							<br/>
							<!-- START SESIMIC -->
							<div class='dataType row' id = "seimic" style="text-align='center'; display:none"> <h2 style="color:blue; "> Seismic </h2>
								<?php include 'htmlView/sesimic/hypocenter.html';?>
							</div>

							<!-- START DEMFORMATION -->
							<div class='dataType row' id="deformation" style="text-align='center'; display:none"> <h2 style="color:blue;"> Deformation </h2>
								<?php
									include 'htmlView/deformation/electronic_tilt.html';
									include 'htmlView/deformation/electronic_tilt_vector.html';
									include 'htmlView/deformation/strain.html';
									include 'htmlView/deformation/edm.html';
									include 'htmlView/deformation/angle.html';
									include 'htmlView/deformation/gps.html';
									include 'htmlView/deformation/gps_vector.html';
									include 'htmlView/deformation/leveling.html';
								?>
							</div>
							<!-- START GAS -->
							<div class='dataType row' id = "gas" style="text-align='center'; display:none"> <h2 style="color:blue;"> Gas </h2>
								<?php
									include 'htmlView/gas/sample_gas.html';
									include 'htmlView/gas/gas_plume.html';
									include 'htmlView/gas/soil_effux.html';
								?>
							</div>
						</div>   <!-- End Gas Data Type block -->
					</div>   <!-- End advSearchId block -->
				</div>
				<input class = "btn btn-primary teal"  type="submit" value="Search" >
				<input class = "btn btn-primary teal" type="button" value="Clear All Fields" >
			</div>
		</form>
	</body>

</html>
