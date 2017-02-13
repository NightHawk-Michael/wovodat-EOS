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


	<!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    -->
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
                <button class="btn btn-primary left-align col s4 " type="button" data-toggle="collapse" data-target="#Volcano_Inner_Group">Volcano Search
                    <i class="material-icons right">send</i>
                </button>
                <div id="Volcano_Inner_Group" class="innerData collapse col s10 offset-s2 ">
                    <!-- FEATURE -->
                    <br/>
                    <div id="feature_wrapper" class=" row">
                        <p class="data-header col s3">Feature:</p>
                        <div id = "feature_select" class="input-field col s5">
                            <select id="feature" name="feature[]"  multiple >
                                <option value="" disabled selected>Choose your option</option>
                            </select>
                        </div>
                        <div class ="col s2">
                            <input type="checkbox" id ="feature_checkAll"/><label style = "color:black" for="feature_checkAll">Check All</label>
                        </div>
                    </div>


                    <!--ROCK TYPE-->
                    <div id="rock_wrapper" class="row">
                        <p class="data-header col s3">Rock Types: </p>
                        <div  id = "rock_select" class="input-field col s5">
                            <select id="rock" name="rock[]" multiple>
                                <option value=""  label = "Choose your option" disabled selected>Choose your option</option>
                                <optgroup id = "Mafic" disabled label="Mafic">Mafic</optgroup>
                                    <option value="Basalt">Basalt</option>
                                    <option value="Tephrite Basanite">Tephrite Basanite</option>
                                    <option value="Foidite">Foidite</option>
                                    <option value="Trachybasalt">Trachybasalt</option>
                                    <option value="Picobrasalt">Picrobasalt</option>
                                <optgroup id = "Intermediate" label="Intermediate" disabled ></optgroup>
                                    <option value="Basaltic Andesite">Basaltic Andesite</option>
                                    <option value="Basaltic Trachyandesite">Basaltic Trachyandesite</option>
                                    <option value="Phonotephrite">Phonotephrite</option>
                                    <option value="Andesite">Andesite </option>
                                    <option value="Trachyandesite">Trachyandesite</option>
                                    <option value="Tephra-phonolite">Tephra-phonolite</option>
                                <optgroup id = "Felsic" label="Felsic"></optgroup>
                                    <option value="Dacite">Dacite</option>
                                    <option value="Trachyte">Trachyte</option>
                                    <option value="Trachydacite ">Trachydacite</option>
                                    <option value="Phonolite ">Phonolite </option>
                                    <option value="Rhyolite ">Rhyolite</option>

                            </select>
                        </div>
                        <div class ="col s2">
                            <input type="checkbox" id ="rock_checkAll"/><label style = "color:black" for="rock_checkAll">Check All</label>
                        </div>
                    </div>

                    <!-- GOOGLE MAP LOCATION -->
                    <div id="location_wrapper" class="row">
                        <p class="data-header col s3">Location:</p>
                        <img cursor='pointer' id='map_location' src='/img/Maps-icon.png' width='10%' height='10%'>(Click map icon to set location)</img><br>
                        <div id="location"></div>
                    </div>

                </div>
			</div>
            <!-- ERUPTION SEARCH -->
			<div id="Eruption_Search" class = "row">
				<button class="btn btn-primary left-align col s4" type="button" data-toggle="collapse" data-target="#Eruption_Inner_Group">Eruption Search
					<i class="material-icons right">send</i>
				</button>
				<div id="Eruption_Inner_Group" class="innerData collapse col s10 offset-s2">
                    <!-- ERUPTION PHASE TYPE -->
					<br>
					<div id="edPhase_wrapper" class=" row">
						<p class="data-header col s3">Eruption Phase Type: </p>
						<div id = "edPhaseSelect" class="input-field col s5">
							<select id = "edPhase" class = "col s12" id="eruptionSelect" name="eruption[]" multiple >
								<option value=""  label = "Choose your option" disabled selected>Choose your option</option>
							</select>
						</div>
						<div class ="col s2">
							<input type="checkbox" id ="edPhase_checkAll"/><label style = "color:black" for="edPhase_checkAll">Check All</label>
						</div>
					</div>
                    <!-- VEI -->
					<div id="vei_wrapper" class="row" style="display: block;">
						<p class="data-header col s3">VEI:</p>
                        <input class = "col s3 " type="text" name="veiMin" id="veiMin" style = 'font-size:inherit;width: 19%' >
						<p class="col s2 " style = "width:11%">&lt;=Range&lt;=</p>
                        <input class = "col s3" type="text" name="veiMax" id="veiMax" style = 'font-size:inherit;width: 19%' >

					</div>
					<div id="edTime_wrapper" class="row">
						<p class="data-header col s3">Eruption Time:</p>
						<div class = "col s2">
							<input id="edTimeMin" type="text" name = "edTimeMin" style  = "font-size: inherit">
						</div>
						<p class="col s2" style ="width:11%">&lt;=Range&lt;= </p>
						<div class = "col s2">
							<input id="edTimeMax" type="text" name = "edTimeMax" style  = "font-size: inherit">
						</div>
					</div>
				</div>

			</div>
			<!-- MONITORING DATA SEARCH -->
			<div id="Monitoring_Data_Search" class="row">
                <button class="btn btn-primary left-align col s4" type="button" data-toggle="collapse" data-target="#Collapse">Monitoring Data Search
                    <i class="material-icons right">send</i>
                </button>

			    <div id="Collapse" class="innerData collapse col s10 offset-s1">
				    <div id="Monitoring_Data_Lists" class="monitoring_data row col s11" onchange="checkAdvanceSearch();">
				    	<p class="seismic">
				    		<input id="radioButton" type="radio" name="Seismic" checked>Seismic<br>
				    		<input class="checkBox" type="checkbox" name="sd_evn" id="sd_evn">
				    			<label for="sd_evn">Network Events</label><br>
				    		<input class="checkBox" type="checkbox" name="sd_evs" id="sd_evs">
				    			<label for="sd_evs">Single Station Events</label><br>
				    		<input class="checkBox" type="checkbox" name="sd_int" id="sd_int">
				    			<label for="sd_int">Seismic Intensity</label><br>
				    		<input class="checkBox" type="checkbox" name="sd_ivl" id="sd_ivl">
				    			<label for="sd_ivl">Interval (Swarm)</label><br>
				    		<input class="checkBox" type="checkbox" name="sd_trm" id="sd_trm">
				    			<label for="sd_trm">Tremor</label><br>
				    		<input class="checkBox" type="checkbox" name="sd_rsm" id="sd_rsm">
				    			<label for="sd_rsm">RSAM</label><br>
				    		<input class="checkBox" type="checkbox" name="sd_ssm" id="sd_ssm">
				    			<label for="sd_ssm">SSAM</label><br>
				    	</p>

				    	<p class="deformation">
				    		<input id="radioButton" type="radio" name="Deformation" checked>Deformation<br>
				    		<input class="checkBox" type="checkbox" name="dd_ang" id="dd_ang">
				    			<label for="dd_ang">Angle</label><br>
				    		<input class="checkBox" type="checkbox" name="dd_edm" id="dd_edm">
				    			<label for="dd_edm">EDM</label><br>
				    		<input class="checkBox" type="checkbox" name="dd_gps" id="dd_gps">
				    			<label for="dd_gps">GPS</label><br>
				    		<input class="checkBox" type="checkbox" name="dd_gpv" id="dd_gpv">
				    			<label for="dd_gpv">GPS vector</label><br>
				    		<input class="checkBox" type="checkbox" name="dd_lev" id="dd_lev">
				    			<label for="dd_lev">Leveling</label><br>
				    		<input class="checkBox" type="checkbox" name="dd_str" id="dd_str">
				    			<label for="dd_str">Strain</label><br>
				    		<input class="checkBox" type="checkbox" name="dd_tlt" id="dd_tlt">
				    			<label for="dd_tlt">Tilt</label><br>
				    		<input class="checkBox" type="checkbox" name="dd_tlv" id="dd_tlv">
				    			<label for="dd_tlv">Tilt vector</label><br>
				    	</p>

				    	<p class="field">
				    		<input id="radioButton" type="radio" name="Field" checked>Field<br>
				    		<input class="checkBox" type="checkbox" name="fd_ele" id="fd_ele">
				    			<label for="fd_ele">Electricity (SP)</label><br>
				    		<input class="checkBox" type="checkbox" name="fd_gra" id="fd_gra">
				    			<label for="fd_gra">Gravity</label><br>
				    		<input class="checkBox" type="checkbox" name="fd_mag" id="fd_mag">
				    			<label for="fd_mag">Magnetic Fields</label><br>
				    		<input class="checkBox" type="checkbox" name="fd_mgv" id="fd_mgv">
				    			<label for="fd_mgv">Magnetic Vector</label><br>
				    	</p>

				    	<p class="gas">
				    		<input id="radioButton" type="radio" name="Gas" checked>Gas<br>
				    		<input class="checkBox" type="checkbox" name="gd" id="gd">
				    			<label for="gd">Sampled Gas</label><br>
				    		<input class="checkBox" type="checkbox" name="gd_plu" id="gd_plu">
				    			<label for="gd_plu">Plume</label><br>


				    		<input class="checkBox" type="checkbox" name="gd_sol" id="gd_sol">
				    			<label for="gd_sol">Soil Effux</label><br>
				    	</p>

				    	<p class="hydrologic">
				    		<input id="radioButton" type="radio" name="Hydrologic" checked>Hydrologic<br>
				    		<input class="checkBox" type="checkbox" name="hd" id="hd">
				    			<label for="hd">Hydrologic Sampled Data</label><br>
				    	</p>

				    	<p class="thermal">
				    		<input id="radioButton" type="radio" name="Thermal" checked>Thermal<br>
				    		<input class="checkBox" type="checkbox" name="td" id="td">
				    			<label for="td">Thermal Data</label><br>
				    	</p>

				    	<p class="meteo">
				    		<input id="radioButton" type="radio" name="Meteo" checked>Meteo<br>
				    		<input class="checkBox" type="checkbox" name="med" id="med">
				    			<label for="med">Meteo Data</label><br>
				    	</p>

				    </div>

                    <div class  = "col s12">
                        <button class="btn btn-primary left-align col s4 row " type="button" data-toggle="collapse" data-target="#advSearchId">Advanced Search
                            <i class="material-icons right">add</i>
                        </button>
                    </div>
                    <div class  = "col s12">

                    </div>
                    <br/>
					<!-- <div id="wrapHiddenData" class="wrapper hidden_data"></div>
					</div> -->
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
							<div id='sd_evn_wrapper' class="hiddenData data-wrapper">
								<h3 >Hypocenter </h3><br>
								<!-- Map Width -->
								<div id="MapWidth" class=" selectOpt row col s10 ">
									<p class="data-header col s3">Map Width (km):</p>
									<div id = "feature_select" class="input-field col s5" style="font-size:inherit">
										<select id="sd_evn_distance" name="sd_evn_distance">
											<option value="10" style="font-size:inherit">10</option>
											<option value="20">20</option>
											<option value="30">30</option>
											<option value="50">50</option>
											<option value="100">100</option>
										</select>
									</div>
								</div>
								<div class ="col s2"><br/></div>

								<!-- Depth(km) -->
								<div class = "row col s10">
									<p class = "data-header col s3">Depth (km):</p>
									<div id='Depth' class='col s5'>
										<input class = "col s5" type="text" name="sd_evn_edep_min" id="sd_evn_edep_min">
										<p class = "col s2" style="display:inline">to</p>
										<input class=  "col s5" type="text" name="sd_evn_edep_max" id="sd_evn_edep_max">
									</div>
								</div>
								<!-- Magnitude -->
								<div class = "row col s10">
									<p class = "data-header col s3">Magnitude:</p>
									<div id='Magnitude' class='row col s5'>
										<input class = "col s5" type="text" name="sd_evn_pmag_min" id="sd_evn_pmag_min" >
										<p class = "col s2" >to</p>
										<input class = "col s5" type="text" name="sd_evn_pmag_max" id="sd_evn_pmag_max" >
									</div>
								</div>

								<!-- Earthquake type -->
								<div class = "row col s10">
									<p class = "data-header col s3">Earthquake Type:</p>
									<div id='EqType' class='selectOptNoRange row col s5'>
										<select id="sd_evn_eqtype" multiple="multiple" name="sd_evn_eqtype[]">
											<option value="R">R</option>
											<option value="Q">Q</option>
											<option value="V">V</option>
											<option value="VT">VT</option>
											<option value="VT_D">VT_D</option>
											<option value="VT_S">VT_S</option>
											<option value="H">H</option>
											<option value="H_HLF">H_HLF</option>
											<option value="H_LHF">H_LHF</option>
											<option value="LF">LF</option>
											<option value="LF_LP">LF_LP</option>
											<option value="LF_T">LF_T</option>
											<option value="LF_ILF">LF_ILF</option>
											<option value="VLP">VLP</option>
											<option value="RF">RF</option>
											<option value="E">E</option>
											<option value="U">U</option>
											<option value="O">O</option>
											<option value="X">X</option>
											<option value="G">G</option>
											<option value="PF">PF</option>
										</select>

										<div id='selected' style='display:inline-block'>

										</div>
									</div>
								</div>

							</div>   <!-- End Hypocenter Data Type block -->
						</div>	 <!-- End Seismic Data Type block -->


						<!-- START DEMFORMATION -->
						<div class='dataType row' id="deformation" style="text-align='center'; display:none"> <h2 style="color:blue;"> Deformation </h2>
							<!-- Electronic Tilt -->
							<div id='dd_tlt_wrapper' class="hiddenData data-wrapper col s10">
								<h3> Electronic Tilt </h3><br>
								<div class = "row col s10">
									<p class = "data-header col s4">Radial/X-axis:</p>
									<div id='Radial_X-axis' class='row col s6'>
										<input class= "col s5" type="text" name="dd_tlt1_min" id="dd_tlt1_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_tlt1_max" id="dd_tlt1_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Tangential/Y-axis:</p>
									<div id='Tangential/Y-axis' class='row col s6'>
										<input class= "col s5" type="text" name="dd_tlt2_min" id="dd_tlt2_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_tlt2_max" id="dd_tlt2_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Tilt Temperature:</p>
									<div id='Tilt_Temperature' class='row col s6'>
										<input class= "col s5" type="text" name="dd_tlt_temp_min" id="dd_tlt_temp_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_tlt_temp_max" id="dd_tlt_temp_max">
									</div>
								</div>
							</div>

							<!-- ELECTRONIC TILT VECTOR -->
							<div id='dd_tlv_wrapper' class="hiddenData data-wrapper col s10">
								<h3> Electronic Tilt Vector </h3><br>
								<div class = "row col s10">
									<p class = "data-header col s4">Tilt Vector:</p>
									<div id='Tilt_Vector' class='row col s6'>
										<input class= "col s5" type="text" name="dd_tlv_mag_min" id="dd_tlv_mag_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_tlv_mag_max" id="dd_tlv_mag_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Tilt Azimuth:</p>
									<div id='Tilt_Azimuth' class='row col s6'>
										<input class= "col s5" type="text" name="dd_tlv_azi_min" id="dd_tlv_azi_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_tlv_azi_max" id="dd_tlv_azi_max">
									</div>
								</div>
							</div>

							<!--STRAIN-->
							<div id='dd_str_wrapper' class="hiddenData data-wrapper col s10">
								<h3> Strain </h3><br>
								<div class = "row col s10">
									<p class = "data-header col s4">Strain Component 1:</p>
									<div id='Strain_Component_1' class='row col s6'>
										<input class= "col s5" type="text" name="dd_str_comp1_min" id="dd_str_comp1_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_str_comp1_max" id="dd_str_comp1_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Strain Component 2:</p>
									<div id='Strain_Component_2' class='row col s6'>
										<input class= "col s5" type="text" name="dd_str_comp2_min" id="dd_str_comp2_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_str_comp2_max" id="dd_str_comp2_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Strain Component 3:</p>
									<div id='Strain_Component_3' class='row col s6'>
										<input class= "col s5" type="text" name="dd_str_comp3_min" id="dd_str_comp3_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_str_comp3_max" id="dd_str_comp3_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Strain Component 4:</p>
									<div id='Strain_Component_4' class='row col s6'>
										<input class= "col s5" type="text" name="dd_str_comp4_min" id="dd_str_comp4_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_str_comp4_max" id="dd_str_comp4_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Volumetric Strain:</p>
									<div id='Volumetric_Strain' class='row col s6'>
										<input class= "col s5" type="text" name="dd_str_vdstr_min" id="dd_str_vdstr_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_str_vdstr_max" id="dd_str_vdstr_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Shear Strain Axis 1:</p>
									<div id='Shear_Strain_Axis_1' class='row col s6'>
										<input class= "col s5" type="text" name="dd_str_sstr_ax1_min" id="dd_str_sstr_ax1_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_str_sstr_ax1_max" id="dd_str_sstr_ax1_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Shear Strain Axis 2:</p>
									<div id='Shear_Strain_Axis_2' class='row col s6'>
										<input class= "col s5" type="text" name="dd_str_sstr_ax2_min" id="dd_str_sstr_ax2_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_str_sstr_ax2_max" id="dd_str_sstr_ax2_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Shear Strain Axis 3:</p>
									<div id='Shear_Strain_Axis_3' class='row col s6'>
										<input class= "col s5" type="text" name="dd_str_sstr_ax3_min" id="dd_str_sstr_ax3_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_str_sstr_ax3_max" id="dd_str_sstr_ax3_max">
									</div>
								</div>

								<div class = "row col s10">
									<p class = "data-header col s4">Strain Azimuth Axis 1:</p>
									<div id='Strain_Azimuth_Axis_1' class='row col s6'>
										<input class= "col s5" type="text" name="dd_str_azi_ax1_min" id="dd_str_azi_ax1_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_str_azi_ax1_max" id="dd_str_azi_ax1_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Strain Azimuth Axis 2:</p>
									<div id='Strain_Azimuth_Axis_2' class='row col s6'>
										<input class= "col s5" type="text" name="dd_str_azi_ax2_min" id="dd_str_azi_ax2_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_str_azi_ax2_max" id="dd_str_azi_ax2_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Strain Azimuth Axis 3:</p>
									<div id='Strain_Azimuth_Axis_3' class='row col s6'>
										<input class= "col s5" type="text" name="dd_str_azi_ax3_min" id="dd_str_azi_ax3_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_str_azi_ax3_max" id="dd_str_azi_ax3_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Min Strain:</p>
									<div id='Min_Strain' class='row col s6'>
										<input class= "col s5" type="text" name="dd_str_pmin_min" id="dd_str_pmin_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_str_pmin_max" id="dd_str_pmin_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Max Strain:</p>
									<div id='Max_Strain' class='row col s6'>
										<input class= "col s5" type="text" name="dd_str_pmax_min" id="dd_str_pmax_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_str_pmax_max" id="dd_str_pmax_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Min Strain Direction:</p>
									<div id='Min_Strain_Direction' class='row col s6'>
										<input class= "col s5" type="text" name="dd_str_pmin_dir_min" id="dd_str_pmin_dir_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_str_pmin_dir_max" id="dd_str_pmin_dir_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Max Strain Direction:</p>
									<div id='Max_Strain_Direction' class='row col s6'>
										<input class= "col s5" type="text" name="dd_str_pmax_dir_min" id="dd_str_pmax_dir_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_str_pmax_dir_max" id="dd_str_pmax_dir_max">
									</div>
								</div>
								<div class = "row col s10">
									<p class = "data-header col s4">Barometric Pressure:</p>
									<div id='Barometric_Pressure' class='row col s6'>
										<input class= "col s5" type="text" name="dd_str_bpres_min" id="dd_str_bpres_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="dd_str_bpres_max" id="dd_str_bpres_max">
									</div>
								</div>
							</div>

                            <!-- EDM Block -->
                            <div id='dd_edm_wrapper' class="hiddenData data-wrapper col s10">
                                <h3> EDM </h3><br>
                                <div class = "row col s10">
                                    <p class = "data-header col s4">EDM Line Length:</p>
                                    <div id='EDM_Line_Length' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_edm_line_min" id="dd_edm_line_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_edm_line_max" id="dd_edm_line_max">
                                    </div>
                                </div>
                            </div>
	                        <!-- Angle -->
                            <div id='dd_ang_wrapper' class="hiddenData data-wrapper col s10">
                                <h3> Angle </h3><br>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">Horizontal Angle to Target 1:</p>
                                    <div id='Horizontal_Angle_1' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_ang_hort1_min" id="dd_ang_hort1_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_ang_hort1_max" id="dd_ang_hort1_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">Horizontal Angle to Target 2:</p>
                                    <div id='Horizontal_Angle_2' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_ang_hort2_min" id="dd_ang_hort2_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_ang_hort2_max" id="dd_ang_hort2_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">Vertical Angle to Target 1:</p>
                                    <div id='Vertical_Angle_1' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_ang_vert1_min" id="dd_ang_vert1_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_ang_vert1_max" id="dd_ang_vert1_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">Vertical Angle to Target 2:</p>
                                    <div id='Vertical_Angle_2' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_ang_vert2_min" id="dd_ang_vert2_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_ang_vert2_max" id="dd_ang_vert2_max">
                                    </div>
                                </div>

                            </div>
                            <!-- GPS Block-->
                            <div id='dd_ang_wrapper' class="hiddenData data-wrapper col s10">
                                <h3> GPS </h3><br>
                                <div class = "row col s10">
                                    <p class = "data-header col s4">GPS Latitude:</p>
                                    <div id='GPS_Latitude' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_gps_lat_min" id="dd_gps_lat_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_gps_lat_max" id="dd_gps_lat_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s4">GPS Longitude:</p>
                                    <div id='GPS_Longitude' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_gps_lon_min" id="dd_gps_lon_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_gps_lon_max" id="dd_gps_lon_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s4">GPS Elevation:</p>
                                    <div id='GPS_Elevation' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_gps_elev_min" id="dd_gps_elev_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_gps_elev_max" id="dd_gps_elev_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s4">GPS Baseline:</p>
                                    <div id='GPS_Baseline' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_gps_slope_min" id="dd_gps_slope_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_gps_slope_max" id="dd_gps_slope_max">
                                    </div>
                                </div>
                            </div>
                            <!-- GPS Vector -->
                            <div id='dd_gpv_wrapper' class="hiddenData data-wrapper col s10">
                                <h3> GPS Vector </h3><br>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">GPS Displacement:</p>
                                    <div id='GPS_Displacement' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_gpv_dmag_min" id="dd_gpv_dmag_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_gpv_dmag_max" id="dd_gpv_dmag_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">GPS Displacement Azimuth:</p>
                                    <div id='GPS_Displacement_Azimuth' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_gpv_daz_min" id="dd_gpv_daz_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_gpv_daz_max" id="dd_gpv_daz_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">GPS Displacement Inclination:</p>
                                    <div id='GPS_Displacement_Inclination' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_gpv_vincl_min" id="dd_gpv_vincl_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_gpv_vincl_max" id="dd_gpv_vincl_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">GPS N-S Displacement:</p>
                                    <div id='GPS_N-S_Displacement' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_gpv_N_min" id="dd_gpv_N_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_gpv_N_max" id="dd_gpv_N_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">GPS E-W Displacement:</p>
                                    <div id='GPS_E-W_Displacement' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_gpv_E_min" id="dd_gpv_E_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_gpv_E_max" id="dd_gpv_E_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">GPS Vertical Displacement:</p>
                                    <div id='GPS_Vertical_Displacement:' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_gpv_vert_min" id="dd_gpv_vert_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_gpv_vert_max" id="dd_gpv_vert_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">GPS N-S Velocity:</p>
                                    <div id='GPS_N-S_Velocity:' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_gpv_staVelNorth_min" id="dd_gpv_staVelNorth_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_gpv_staVelNorth_min" id="dd_gpv_staVelNorth_min">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">GPS E-W Velocity:</p>
                                    <div id='GPS_E-W_Velocity:' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_gpv_staVelEast_min" id="dd_gpv_staVelEast_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_gpv_staVelEast_max" id="dd_gpv_staVelEast_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">GPS Vertical Velocity:</p>
                                    <div id='GPS_Vertical_Velocity:' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_gpv_staVelVert_min" id="dd_gpv_staVelVert_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_gpv_staVelVert_max" id="dd_gpv_staVelVert_max">
                                    </div>
                                </div>
                            </div>

	                        <!-- Leveling -->
                            <div id='dd_lev_wrapper' class="hiddenData data-wrapper col s10">
                                <h3> Leveling </h3><br>
                                <div class = "row col s10">
                                    <p class = "data-header col s4">Elevation Change:</p>
                                    <div id='Elevation_Change' class='row col s6'>
                                        <input class= "col s5" type="text" name="dd_lev_delev_min" id="dd_lev_delev_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="dd_lev_delev_max" id="dd_lev_delev_max">
                                    </div>
                                </div>
                            </div>
                        </div>	 <!-- End Deformation Data Type block -->

                        <!-- START GAS -->
                        <div class='dataType row' id = "gas" style="text-align='center'; display:none"> <h2 style="color:blue;"> Gas </h2>
							<!-- Sample Gas -->
                            <div id='gd_wrapper' class="hiddenData data-wrapper col s10" style="display: none">
								<h3>Sample Gas </h3><br>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">Gas Temperature (C):</p>
                                    <div id='gasTemp' class='row col s6'>
                                        <input class= "col s5" type="text" name="gd_gtemp_min" id="gd_gtemp_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="gd_gtemp_max" id="gd_gtemp_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">Atmospheric Pressure (mbar):</p>
                                    <div id='atmPres' class='row col s6'>
                                        <input class= "col s5" type="text" name="gd_bp_min" id="gd_bp_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="gd_bp_max" id="gd_bp_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">Gas Emission:</p>
                                    <div id='gasEmiss' class='row col s6'>
                                        <input class= "col s5" type="text" name="gd_flow_min" id="gd_flow_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="gd_flow_max" id="gd_flow_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">Gas Concentration:</p>
                                    <div id='gasCon' class='row col s6'>
                                        <input class= "col s5" type="text" name="gd_flow_min" id="gd_flow_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="gd_flow_max" id="gd_flow_max">
                                    </div>
                                </div>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">Apply Threshold without species:</p>
                                    <div id='thresholdWithoutSpe' class='row col s6'>
                                        <input class= "col s5" type="text" name="gd_concentration_min" id="gd_concentration_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="gd_concentration_max" id="gd_concentration_max">
                                    </div>
                                </div>
                                <div class=" selectOpt row col s10 ">
                                    <p class="data-header col s3">Apply Threshold with species:</p>
                                    <div id = "thresholdWithSpe" class="input-field col s5" style="font-size:inherit">
                                        <select id="gd_concentration" name="gd_concentration">
                                            <option value="CO2">CO2</option>
                                            <option value="SO2">SO2</option>
                                            <option value="H2S">H2S</option>
                                            <option value="HCl">HCl</option>
                                            <option value="HF">HF</option>
                                            <option value="CH4">CH4</option>
                                            <option value="H2">H2</option>
                                            <option value="CO">CO</option>
                                            <option value="3He4He">3He4He</option>
                                            <option value="d13C">d13C</option>
                                            <option value="d34S">d34S</option>
                                            <option value="d18O">d18O</option>
                                            <option value="dD">dD</option>
                                            <option value="NH3">NH3</option>
                                            <option value="N2">N2</option>
                                            <option value="Ar">Ar</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="thresholdWithSpe">

								</div>
							</div> <!-- End sampleGas block -->
                            <!-- Gas Plume -->
                            <div id='gd_plu_wrapper' class="hiddenData data-wrapper col s10" style ="display:none">
                                <h3> Gas Plume </h3><br>
                                <div class = "row col s10">
                                    <p class = "data-header col s5">Plume Height (km):</p>
                                    <div id='plumeHeight' class='row col s6'>
                                        <input class= "col s5" type="text" name="gd_plu_height_min" id="gd_plu_height_min">
                                        <p class= "col s2" style="display:inline">to</p>
                                        <input class= "col s5" type="text" name="gd_plu_height_max" id="gd_plu_height_max">
                                    </div>
                                </div>
                                <div class = "row col s12">
                                    <p class="data-header col s4">Gas Emission Rate:</p>

									<div id = "gdPluEmitFlagSelect" class="input-field col s6">
										<select id="gdPluEmitFlag" name="gdPluEmitFlag" onchange="checkgdPluFlag('Emit')">
											<option  value="thresholdWithoutSpe">Apply Threshold without species</option>
											<option value="thresholdWithSpe">Apply Threshold with species such as CO2,SO2,etc.</option>
										</select>
									</div>

									<p class = "data-header col s4"></p>
									<div id="gd_plu_emit_without_spec" class = 'row col s6'>
										<input class= "col s5" type="text" name="gd_plu_emit_min" id="gd_plu_emit_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="gd_plu_emit_max" id="gd_plu_emit_max">
									</div>
									<div id='gd_plu_emit_with_spec' class='row col s6' style = "display:none">
										<div id = "gd_plu_emitSelect" class = "col s8">
											<select id="gd_plu_emit" name="gd_plu_emit[]" multiple onchange="checkgdPluSpec('gd_plu_emit')">
												<option value="" disabled selected>Choose your option</option>
												<option value="CO2">CO2</option>
												<option value="SO2">SO2</option>
												<option value="H2S">H2S</option>
												<option value="HCl">HCl</option>
												<option value="HF">HF</option>
												<option value="CO">CO</option>
												<option value="CO2/SO2">CO2/SO2</option>
											</select>
										</div>
										<div class ="col s4">
											<input type="checkbox" id ="gd_plu_emit_checkAll"/><label style = "color:black" for="gd_plu_emit_checkAll">Check All</label>
										</div>
										<div id = "gd_plu_emit_spec">

										</div>

									</div>
                                </div>
                                <div class = "row col s10">
									<p class="data-header col s5">Gas Emission Mass:</p>
									<div id = "" class="row col s6" >
										<select id="gdPluMassFlag" name="gdPluMassFlag" onchange="checkgdPluFlag('Mass')">
											<option value="thresholdWithoutSpe">Apply Threshold without species</option>
											<option value="thresholdWithSpe">Apply Threshold with species such as CO2,SO2,etc.</option>
										</select>
									</div>
									<p class = "data-header col s5"></p>
									<div id="gd_plu_mass_without_spec" class = 'row col s6'>
										<input class= "col s5" type="text" name="gd_plu_mass_min" id="gd_plu_mass_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="gd_plu_mass_max" id="gd_plu_mass_max">
									</div>
									<div id='gd_plu_mass_with_spec' class='row col s6' style = "display:none">
										<div id = "gd_plu_emitSelect" class = "col s8">

											<select id="gd_plu_mass" name="gd_plu_mass[]" multiple onchange="checkgdPluSpec('gd_plu_mass')">
												<option value="" disabled selected>Choose your option</option>
												<option value="CO2">CO2</option>
												<option value="SO2">SO2</option>
												<option value="H2S">H2S</option>
												<option value="HCl">HCl</option>
												<option value="HF">HF</option>
												<option value="CO">CO</option>
												<option value="CO2/SO2">CO2/SO2</option>
											</select>
										</div>
										<div class ="col s4">
											<input type="checkbox" id ="gd_plu_mass_checkAll"/><label style = "color:black" for="gd_plu_mass_checkAll">Check All</label>
										</div>
										<div id = "gd_plu_mass_spec">

										</div>

									</div>
								</div>

								<div class = "row col s10">
									<p class="data-header col s5">Total Gas Emission:</p>
									<div id = "" class="row col s6" >
										<select id="gdPluETotFlag" name="gdPluETotFlag" onchange="checkgdPluFlag('ETot')">
											<option value="thresholdWithoutSpe">Apply Threshold without species</option>
											<option value="thresholdWithSpe">Apply Threshold with species such as CO2,SO2,etc.</option>
										</select>
									</div>
									<p class = "data-header col s5"></p>
									<div id="gd_plu_etot_without_spec" class = 'row col s6'>
										<input class= "col s5" type="text" name="gd_plu_etot_min" id="gd_plu_etot_min">
										<p class= "col s2" style="display:inline">to</p>
										<input class= "col s5" type="text" name="gd_plu_etot_max" id="gd_plu_etot_max">
									</div>
									<div id='gd_plu_etot_with_spec' class='row col s6' style = "display:none">
										<div id = "gd_plu_etotSelect" class = "col s8">
											<select id="gd_plu_etot" name="gd_plu_etot[]" multiple onchange="checkgdPluSpec('gd_plu_etot')">
												<option value="" disabled selected>Choose your option</option>
												<option value="CO2">CO2</option>
												<option value="SO2">SO2</option>
												<option value="H2S">H2S</option>
												<option value="HCl">HCl</option>
												<option value="HF">HF</option>
												<option value="CO">CO</option>
												<option value="CO2/SO2">CO2/SO2</option>
											</select>
										</div>
										<div class ="col s4">
											<input type="checkbox" id ="gd_plu_etot_checkAll"/><label style = "color:black" for="gd_plu_etot_checkAll">Check All</label>
										</div>
										<div id = "gd_plu_etot_spec">

										</div>

									</div>
								</div>
                            </div>
                        </div>

		
<!--<h3> Soil Efflux </h3><br>-->
<!--		-->
<!--	<label>Total Gas Flux:</label>	-->
<!--	<select id="totalGasFluxFlag" name="totalGasFluxFlag">-->
<!--	  <option value="thresholdWithSpe">Apply Threshold without species</option>-->
<!--	  <option value="thresholdWithoutSpe">Apply Threshold with species such as CO2,SO2,etc.</option>-->
<!--	</select>-->
<!--	<br><br>-->
<!--		-->
<!--	<div id="gdSolTflux" style="padding-left:140px; width:700px; ">-->
<!---->
<!--		<input type="text" name="gd_sol_tflux_min" id="gd_sol_tflux_min">-->
<!--		<p style="display:inline">to</p>-->
<!--		<input type="text" name="gd_sol_tflux_max" id="gd_sol_tflux_max">-->
<!--		<br>-->
<!--		<br>	-->
<!--			-->
<!--		<select id="gd_sol_tflux" multiple="multiple" name="gd_sol_tflux[]" style="display:block;">-->
<!--			<option value="CO2">CO2</option>-->
<!--			<option value="SO2">SO2</option>-->
<!--			<option value="H2S">H2S</option>-->
<!--			<option value="HCl">HCl</option>-->
<!--			<option value="HF">HF</option>-->
<!--			<option value="CO">CO</option>-->
<!--			<option value="CO2/SO2">CO2/SO2</option>-->
<!--		</select>-->
<!--		<br><br>-->
<!--			-->
<!--		<label>CO2:</label>	-->
<!--		<input type="text" name="gd_sol_tflux_min_CO2" id="gd_sol_tflux_min_CO2">-->
<!--		<p style="display:inline">to</p>-->
<!--		<input type="text" name="gd_sol_tflux_max_CO2" id="gd_sol_tflux_max_CO2">-->
<!--		<br>-->
<!--		<br>	-->
<!---->
<!--		<label>SO2:</label>	-->
<!--		<br> continue for the rest .....	-->
<!--		-->
<!--	 </div>   <!-- End gd_sol_tflux block -->	-->
<!--		-->
<!---->
<!--	<label>Highest Gas Flux:</label>-->
<!--	-->
<!--		<select id="highestGasFluxFlag" name="highestGasFluxFlag">-->
<!--		  <option value="thresholdWithSpe">Apply Threshold without species</option>-->
<!--		  <option value="thresholdWithoutSpe">Apply Threshold with species such as CO2,SO2,etc.</option>-->
<!--		</select>-->
<!--		<br><br>-->
<!--		-->
<!--		<div id="gdSolHigh" style="padding-left:140px; width:700px; ">-->
<!---->
<!--			<input type="text" name="gd_sol_high_min" id="gd_sol_high_min">-->
<!--			<p style="display:inline">to</p>-->
<!--			<input type="text" name="gd_sol_high_max" id="gd_sol_high_max">-->
<!--			<br>-->
<!--			<br>	-->
<!--				-->
<!--				<select id="gd_sol_high" multiple="multiple" name="gd_sol_high[]" style="display:block;">-->
<!--					<option value="CO2">CO2</option>-->
<!--					<option value="SO2">SO2</option>-->
<!--					<option value="H2S">H2S</option>-->
<!--					<option value="HCl">HCl</option>-->
<!--					<option value="HF">HF</option>-->
<!--					<option value="CO">CO</option>-->
<!--					<option value="CO2/SO2">CO2/SO2</option>-->
<!--				</select>-->
<!--				<br><br>-->
<!--			-->
<!--				<label>CO2:</label>	-->
<!--				<input type="text" name="gd_sol_high_min_CO2" id="gd_sol_high_min_CO2">-->
<!--				<p style="display:inline">to</p>-->
<!--				<input type="text" name="gd_sol_high_max_CO2" id="gd_sol_high_max_CO2">-->
<!--				<br>-->
<!--				<br>	-->
<!---->
<!--				<label>SO2:</label>	-->
<!--				<br> continue for the rest .....	-->
<!--			-->
<!--	</div>   <!-- End gd_sol_high block -->	-->
<!--		-->
<!--		-->
<!--	<label>Highest Temperature:</label>	-->
<!--		<select id="highestTempFlag" name="highestTempFlag">-->
<!--		  <option value="thresholdWithSpe">Apply Threshold without species</option>-->
<!--		  <option value="thresholdWithoutSpe">Apply Threshold with species such as CO2,SO2,etc.</option>-->
<!--		</select>-->
<!--		<br><br>-->
<!--		-->
<!--		<div id="gdSolHtemp" style="padding-left:140px; width:700px; ">-->
<!---->
<!--			<input type="text" name="gd_sol_htemp_min" id="gd_sol_htemp_min">-->
<!--			<p style="display:inline">to</p>-->
<!--			<input type="text" name="gd_sol_htemp_max" id="gd_sol_htemp_max">-->
<!--			<br>-->
<!--			<br>	-->
<!--				-->
<!--			<select id="gd_sol_htemp" multiple="multiple" name="gd_sol_htemp[]" style="display:block;">-->
<!--				<option value="CO2">CO2</option>-->
<!--				<option value="SO2">SO2</option>-->
<!--				<option value="H2S">H2S</option>-->
<!--				<option value="HCl">HCl</option>-->
<!--				<option value="HF">HF</option>-->
<!--				<option value="CO">CO</option>-->
<!--				<option value="CO2/SO2">CO2/SO2</option>-->
<!--			</select>-->
<!--			<br><br>-->
<!--			-->
<!--			<label>CO2:</label>	-->
<!--			<input type="text" name="gd_sol_htemp_min_CO2" id="gd_sol_htemp_min_CO2">-->
<!--			<p style="display:inline">to</p>-->
<!--			<input type="text" name="gd_sol_htemp_max_CO2" id="gd_sol_htemp_max_CO2">-->
<!--			<br>-->
<!--			<br>	-->
<!---->
<!--			<label>SO2:</label>	-->
<!--			<br> continue for the rest .....	-->
<!--			-->
<!--	</div>   <!-- End gd_sol_htemp block -->	-->
		
<!------------------------------------							-->
							
						</div>   <!-- End Gas Data Type block -->
									
					</div>   <!-- End advSearchId block -->

				</div>
		</div>
		<input class = "btn btn-primary teal"  type="submit" value="Search" >
		<input class = "btn btn-primary teal" type="button" value="Clear All Fields" >
			
	</form>

</body>
</html>
