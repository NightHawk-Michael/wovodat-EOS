<!DOCTYPE html>
<html>
<head> 
	<title></title>
	<link rel="stylesheet" href="/css/normalize.css">
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="/js/materialize.min.js"></script>
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
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/jquery.min.js"></script>
	<script src="/js/locationpicker.jquery.js"></script>

	<!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    -->
	<script src="/js/jquery-ui-1.11.0.custom/jquery-ui.min.js"></script>
	<script src="/js/jquery-ui-1.11.0.custom/jquery-ui-timepicker-addon.js"></script>
	<script src="/js/jquery.multiselect.min.js"></script>
	<script src="/js/jquery.cookie.js"></script>
    <script src="/js/boolean.js"></script>

	<!-- Google Map Api requires browser key to function! key used here key=AIzaSyCbWJuHGfa_2MzsOL2ARASmqV2JyCpdmm8 -->
	<!-- To upload to server, a modification of browser key may need to be done! -->
	<script type="text/javascript" src='http://maps.google.com/maps/api/js?key=AIzaSyCbWJuHGfa_2MzsOL2ARASmqV2JyCpdmm8&sensor=false&libraries=places'></script>

</head>


<body>
	<!--Import jQuery before materialize.js-->

	<h2>WOVOdat Boolean Search Form (Beta Version)</h2>
	<h4 style="text-align:center">Only Network Events and Sampled Gas options are working</h4>
	<img src="/boolean/view/loader.gif" id="loadingGif">
	<form id="boolean_form" name="boolean_form" method="post" action="">
		<div id="mainCategory container">
            <!-- VOLCANO SEARCH -->
			<div id="Volcano_Search" class = "  row" data-collapsible="expandable">
                <button class="btn btn-primary left-align col s5 offset-s1 " type="button" data-toggle="collapse" data-target="#Volcano_Inner_Group">Volcano Search
                    <i class="material-icons right">send</i>
                </button>
                <div id="Volcano_Inner_Group" class="innerData collapse col s10 offset-s2 ">
                    <!-- FEATURE -->
                    <div id="feature_wrapper" class="hidden_data data-wrapper row" style="display: block;">
                        <p class="data-header col s4">Feature:</p>
                        <select id="featureSelect" name="feature[]" multiple="multiple">
                            <optgroup id="feature" label="Feature"></optgroup>
                        </select>
                    </div>


                    <!--ROCK TYPE-->
                    <div id="rock_wrapper" class="data-wrapper row">
                        <p class="data-header col s4">Rock Types: </p>
                        <select class = "col s4" id="rockSelect" name="rock[]" multiple="multiple">
                            <div id="rock" label="Rock">
                                <optgroup label="Mafic">
                                    <option value="Basalt">Basalt</option>
                                    <option value="Tephrite Basanite">Tephrite Basanite</option>
                                    <option value="Foidite">Foidite</option>
                                    <option value="Trachybasalt">Trachybasalt</option>
                                    <option value="Picobrasalt">Picrobasalt</option>
                                </optgroup>
                                <optgroup label="Intermediate">
                                    <option value="Basaltic Andesite">Basaltic Andesite</option>
                                    <option value="Basaltic Trachyandesite">Basaltic Trachyandesite</option>
                                    <option value="Phonotephrite">Phonotephrite</option>
                                    <option value="Andesite">Andesite </option>
                                    <option value="Trachyandesite">Trachyandesite</option>
                                    <option value="Tephra-phonolite">Tephra-phonolite</option>
                                </optgroup>
                                <optgroup label="Felsic">
                                    <option value="Dacite">Dacite</option>
                                    <option value="Trachyte">Trachyte</option>
                                    <option value="Trachydacite ">Trachydacite</option>
                                    <option value="Phonolite ">Phonolite </option>
                                    <option value="Rhyolite ">Rhyolite</option>
                                </optgroup>
                            </div>
                        </select>
                    </div>

                    <!-- GOOGLE MAP LOCATION -->
                    <div id="location_wrapper" class=" data-wrapper row">
                        <p class="data-header col s4">Location:</p>
                        <img cursor='pointer' id='map_location' src='/img/Maps-icon.png' width='10%' height='10%'>(Click map icon to set location)</img><br>
                        <div id="location"></div>
                    </div>

                </div>
			</div>
            <!-- ERUPTION SEARCH -->
			<div id="Eruption_Search" class = "row">
				<button class="btn btn-primary left-align col s5 offset-s1" type="button" data-toggle="collapse" data-target="#Eruption_Inner_Group">Eruption Search
					<i class="material-icons right">send</i>
				</button>
				<div id="Eruption_Inner_Group" class="innerData collapse col s10 offset-s2">
                    <!-- ERUPTION PHASE TYPE -->
					<div id="edPhase_wrapper" class=" data-wrapper row">
						<p class="data-header col s4">Eruption Phase Type: </p>
						<select class = "col s4" id="eruptionSelect" name="eruption[]" multiple="multiple">
							<optgroup id="edPhase" label="Eruption Phase Type"></optgroup>
						</select>
					</div>
                    <!-- VEI -->
					<div id="vei_wrapper" class=" data-wrapper row" style="display: block;">
						<p class="data-header col s4">VEI:</p>
                        <div class="input-field inline"><input class = "col s3 " type="text" name="veiMin" id="veiMin" style = 'font-size:inherit;' ></div>
						<p class="col s2 " style = "width:11%">&lt;=Range&lt;=</p>
                        <div class="input-field inline"><input class = "col s3" type="text" name="veiMax" id="veiMax" style = 'font-size:inherit;' ></div>

					</div>
					<div id="edTime_wrapper" class=" data-wrapper row">
						<p class="data-header col s4">Eruption Time:</p>
						<input class = "col s3" type="text" name="edTimeMin" id="edTimeMin"  style = 'font-size:inherit;'>
						<p class="col s2" style ="width:11%">&lt;=Range&lt;= </p>
						<input class = "col s3" type="text" name="edTimeMax" id="edTimeMax"  style = 'font-size:inherit;'>
					</div>
				</div>

			</div>
			<!-- MONITORING DATA SEARCH -->
			<div id="Monitoring_Data_Search" class="row">
                <button class="btn btn-primary left-align col s5 offset-s1" type="button" data-toggle="collapse" data-target="#Collapse">Monitoring Data Search
                    <i class="material-icons right">send</i>
                </button>

			    <div id="Collapse" class="innerData collapse col s10 offset-s1">
				    <div id="Monitoring_Data_Lists" class="monitoring_data row">
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
                    <button class="btn btn-primary left-align col s3 row " type="button" data-toggle="collapse" data-target="#advSearchId">Advanced Search
                        <i class="material-icons right">add</i>
                    </button>
                    <div class  = "col s3"></div>
					<!-- <div id="wrapHiddenData" class="wrapper hidden_data"></div>
					</div> -->
					<div id="advSearchId" class=" innerData collapse row">
						<div id="searchPeriod" class = "row">
                            <br>
                            <br>
                            <div class = "col s3">Priority Time Period: </div>
                            <div class = "col s1">Start:</div>
                            <input disabled class = "col s2 " type="datetime" name="timeMin" id="timeMin" style = "width:18%" >
                            <div class = "col s1">End:</div>
                            <input disabled  class = "col s3 " type="datetime" name="timeMax" id="timeMax" style = "width:18%">
						</div>
                        <div id="slider-range" class = "row col s10"></div>



                        <div class='dataType' style="text-align='center';"> <h2 style="color:blue; display:none"> Seismic </h2>

							<div id='sd_evn_wrapper' class="hiddenData data-wrapper" style="display: none;">
								<h3>Hypocenter </h3><br>

								<div id='MapWidth' class='selectOpt'>
									<label>Map Width (km):</label>
									<select id="sd_evn_distance" name="sd_evn_distance">
										<option value="10">10</option>
										<option value="20">20</option>
										<option value="30">30</option>
										<option value="50">50</option>
										<option value="100">100</option>
									</select>
								</div>
								<br>

								<div id='Depth' class='range'>
									<label>Depth (km):</label>
									<input type="text" name="sd_evn_edep_min" id="sd_evn_edep_min">
									<p style="display:inline">to</p>
									<input type="text" name="sd_evn_edep_max" id="sd_evn_edep_max">
								</div>
								<br>
								<br>

								<div id='Magnitude' class='range'>
									<label>Magnitude:</label>
									<input type="text" name="sd_evn_pmag_min" id="sd_evn_pmag_min" >
									<p style="display:inline">to</p>
									<input type="text" name="sd_evn_pmag_max" id="sd_evn_pmag_max" >
								</div>
								<br>

								<div id='EqType' class='selectOptNoRange'>
									<label>Earthquake Type:</label>
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

							</div>   <!-- End Hypocenter Data Type block -->
						</div>	 <!-- End Seismic Data Type block -->
						
<!--//<br/>Remaining tasks to do  (all Deformation types, gd_plu and gd_sol data types)			-->
<!-- <br/>
	Remaining tasks to do 
	=>  When the user selects  Electronic Tilt check box, then Electronin Titl filter appears in the advance search placement. 
	=>  <br/> Same idea for the remaining data types <br/>
	
-->		

						
<div style="text-align='center';"> <h2 style="color:blue;"> Deformation </h2> 

	<h3> Electronic Tilt </h3><br>
	
		<label>Radial/X-axis:</label>	  
		<input type="text" name="dd_tlt1_min" id="dd_tlt1_min">
		<p style="display:inline">to</p>
		<input type="text" name="dd_tlt1_max" id="dd_tlt1_max">
		<br>
		<br>
		
		
		<label>Tangential/Y-axis:</label>	  
		<input type="text" name="dd_tlt2_min" id="dd_tlt2_min">
		<p style="display:inline">to</p>
		<input type="text" name="dd_tlt2_max" id="dd_tlt2_max">
		<br>
		<br>

		<label>Tilt Temperature:</label>	  
		<input type="text" name="dd_tlt_temp_min" id="dd_tlt_temp_min">
		<p style="display:inline">to</p>
		<input type="text" name="dd_tlt_temp_max" id="dd_tlt_temp_max">
		<br>
		<br>

	<!-- End Tilt block -->
	
	-----------------------------------	
	
	<h3> Electronic Tilt Vector </h3><br>
	
	<label>Tilt Vector:</label>	  
	<input type="text" name="dd_tlv_mag_min" id="dd_tlv_mag_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_tlv_mag_max" id="dd_tlv_mag_max">
	<br>
	<br>
	
	
	<label>Tilt Azimuth:</label>	  
	<input type="text" name="dd_tlv_azi_min" id="dd_tlv_azi_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_tlv_azi_max" id="dd_tlv_azi_max">
	<br>
	<br>


	<!-- End Tilt Vector block -->
	
	-----------------------------------	
	
	<h3> Strain </h3><br>
	
	<label>Strain Component 1:</label>	  
	<input type="text" name="dd_str_comp1_min" id="dd_str_comp1_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_str_comp1_max" id="dd_str_comp1_max">
	<br>
	<br>
	
	<label>Strain Component 2:</label>	  
	<input type="text" name="dd_str_comp2_min" id="dd_str_comp2_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_str_comp2_max" id="dd_str_comp2_max">
	<br>
	<br>
	
	<label>Strain Component 3:</label>	  
	<input type="text" name="dd_str_comp3_min" id="dd_str_comp3_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_str_comp3_max" id="dd_str_comp3_max">
	<br>
	<br>
	
	<label>Strain Component 4:</label>	  
	<input type="text" name="dd_str_comp4_min" id="dd_str_comp4_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_str_comp4_max" id="dd_str_comp4_max">
	<br>
	<br>
	
	
	<label>Volumetric Strain:</label>	  
	<input type="text" name="dd_str_vdstr_min" id="dd_str_vdstr_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_str_vdstr_max" id="dd_str_vdstr_max">
	<br>
	<br>	

	<label>Shear Strain Axis 1:</label>	  
	<input type="text" name="dd_str_sstr_ax1_min" id="dd_str_sstr_ax1_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_str_sstr_ax1_max" id="dd_str_sstr_ax1_max">
	<br>
	<br>

	<label>Shear Strain Axis 2:</label>	  
	<input type="text" name="dd_str_sstr_ax2_min" id="dd_str_sstr_ax2_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_str_sstr_ax2_max" id="dd_str_sstr_ax2_max">
	<br>
	<br>
	
	<label>Shear Strain Axis 3:</label>	  
	<input type="text" name="dd_str_sstr_ax3_min" id="dd_str_sstr_ax3_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_str_sstr_ax3_max" id="dd_str_sstr_ax3_max">
	<br>
	<br>

	<label>Strain Azimuth Axis 1:</label>	  
	<input type="text" name="dd_str_azi_ax1_min" id="dd_str_azi_ax1_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_str_azi_ax1_max" id="dd_str_azi_ax1_max">
	<br>
	<br>

	<label>Strain Azimuth Axis 2:</label>	  
	<input type="text" name="dd_str_azi_ax2_min" id="dd_str_azi_ax2_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_str_azi_ax2_max" id="dd_str_azi_ax2_max">
	<br>
	<br>

	<label>Strain Azimuth Axis 3:</label>	  
	<input type="text" name="dd_str_azi_ax3_min" id="dd_str_azi_ax3_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_str_azi_ax3_max" id="dd_str_azi_ax3_max">
	<br>
	<br>

	<label>Min Strain:</label>	  
	<input type="text" name="dd_str_pmin_min" id="dd_str_pmin_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_str_pmin_max" id="dd_str_pmin_max">
	<br>
	<br>

	
	<label>Max Strain:</label>	  
	<input type="text" name="dd_str_pmax_min" id="dd_str_pmax_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_str_pmax_max" id="dd_str_pmax_max">
	<br>
	<br>

	<label>Min Strain Direction:</label>	  
	<input type="text" name="dd_str_pmin_dir_min" id="dd_str_pmin_dir_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_str_pmin_dir_max" id="dd_str_pmin_dir_max">
	<br>
	<br>
	
	<label>Max Strain Direction:</label>	  
	<input type="text" name="dd_str_pmax_dir_min" id="dd_str_pmax_dir_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_str_pmax_dir_max" id="dd_str_pmax_dir_max">
	<br>
	<br>		

	<label>Barometric Pressure:</label>	  
	<input type="text" name="dd_str_bpres_min" id="dd_str_bpres_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_str_bpres_max" id="dd_str_bpres_max">
	<br>
	<br>		
	<!-- End Strain block -->
	
	-----------------------------------	
	
	<h3> EDM </h3><br>
	
	<label>EDM Line Length:</label>	  
	<input type="text" name="dd_edm_line_min" id="dd_edm_line_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_edm_line_max" id="dd_edm_line_max">
	<br>
	<br>
	
	<!-- End EDM block -->
	
	-----------------------------------	
	
	<h3> Angle </h3><br>
	
	<label>Horizontal Angle to Target 1:</label>	  
	<input type="text" name="dd_ang_hort1_min" id="dd_ang_hort1_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_ang_hort1_max" id="dd_ang_hort1_max">
	<br>
	<br>
	
	<label>Horizontal Angle to Target 2:</label>	  
	<input type="text" name="dd_ang_hort2_min" id="dd_ang_hort2_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_ang_hort2_max" id="dd_ang_hort2_max">
	<br>
	<br>
	
	<label>Vertical Angle to Target 1:</label>	  
	<input type="text" name="dd_ang_vert1_min" id="dd_ang_vert1_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_ang_vert1_max" id="dd_ang_vert1_max">
	<br>
	<br>
	
	<label>Vertical Angle to Target 2:</label>	  
	<input type="text" name="dd_ang_vert2_min" id="dd_ang_vert2_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_ang_vert2_max" id="dd_ang_vert2_max">
	<br>
	<br>	
	
	
	<!-- End Angle block -->
	
	-----------------------------------	
	
	<h3> GPS </h3><br>
	
	<label>GPS Latitude:</label>	  
	<input type="text" name="dd_gps_lat_min" id="dd_gps_lat_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_gps_lat_max" id="dd_gps_lat_max">
	<br>
	<br>
	
	<label>GPS Longitude:</label>	  
	<input type="text" name="dd_gps_lon_min" id="dd_gps_lon_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_gps_lon_max" id="dd_gps_lon_max">
	<br>
	<br>
	
	<label>GPS Elevation:</label>	  
	<input type="text" name="dd_gps_elev_min" id="dd_gps_elev_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_gps_elev_max" id="dd_gps_elev_max">
	<br>
	<br>
	
	<label>GPS baseline:</label>	  
	<input type="text" name="dd_gps_slope_min" id="dd_gps_slope_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_gps_slope_max" id="dd_gps_slope_max">
	<br>
	<br>	
	
	
	<!-- End GPS block -->
	
	-----------------------------------	
	
	<h3> GPS Vector </h3><br>
	
	<label>GPS Displacement:</label>	  
	<input type="text" name="dd_gpv_dmag_min" id="dd_gpv_dmag_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_gpv_dmag_max" id="dd_gpv_dmag_max">
	<br>
	<br>
	
	<label>GPS Displacement Azimuth:</label>	  
	<input type="text" name="dd_gpv_daz_min" id="dd_gpv_daz_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_gpv_daz_max" id="dd_gpv_daz_max">
	<br>
	<br>
	
	<label>GPS Displacement Inclination:</label>	  
	<input type="text" name="dd_gpv_vincl_min" id="dd_gpv_vincl_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_gpv_vincl_max" id="dd_gpv_vincl_max">
	<br>
	<br>
	
	<label>GPS N-S Displacement:</label>	  
	<input type="text" name="dd_gpv_N_min" id="dd_gpv_N_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_gpv_N_max" id="dd_gpv_N_max">
	<br>
	<br>
	
	
	<label>GPS E-W Displacement:</label>	  
	<input type="text" name="dd_gpv_E_min" id="dd_gpv_E_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_gpv_E_max" id="dd_gpv_E_max">
	<br>
	<br>	

	<label>GPS Vertical Displacement:</label>	  
	<input type="text" name="dd_gpv_vert_min" id="dd_gpv_vert_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_gpv_vert_max" id="dd_gpv_vert_max">
	<br>
	<br>

	<label>GPS N-S Velocity:</label>	  
	<input type="text" name="dd_gpv_staVelNorth_min" id="dd_gpv_staVelNorth_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_gpv_staVelNorth_max" id="dd_gpv_staVelNorth_max">
	<br>
	<br>
	
	<label>GPS E-W Velocity:</label>	  
	<input type="text" name="dd_gpv_staVelEast_min" id="dd_gpv_staVelEast_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_gpv_staVelEast_max" id="dd_gpv_staVelEast_max">
	<br>
	<br>

	<label>GPS Vertical Velocity:</label>	  
	<input type="text" name="dd_gpv_staVelVert_min" id="dd_gpv_staVelVert_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_gpv_staVelVert_max" id="dd_gpv_staVelVert_max">
	<br>
	<br>
	
	<!-- End GPV block -->
	
	-----------------------------------	
	
	<h3> Leveling </h3><br>
	
	<label>Elevation Change:</label>	  
	<input type="text" name="dd_lev_delev_min" id="dd_lev_delev_min">
	<p style="display:inline">to</p>
	<input type="text" name="dd_lev_delev_max" id="dd_lev_delev_max">
	<br>
	<br>
	
	<!-- End EDM block -->
	
</div>	 <!-- End Deformation Data Type block -->

-----------------------------------							
						
		
						
						<div class="dataType" style="text-align='center';"> <h2 style="color:blue; display:none"> Gas </h2> 
							
							<div id="gd_wrapper" class="hiddenData data-wrapper" style="display: none;">
								<h3>Sample Gas </h3><br>
								
								<div id="gasTemp" class="range">
									<label>Gas Temperature (C):</label>	
									<input type="text" name="gd_gtemp_min" id="gd_gtemp_min">
									<p style="display:inline">to</p>
									<input type="text" name="gd_gtemp_max" id="gd_gtemp_max">
									<br>
									<br>
								</div>

								<div id="atmPres" class="range">
									<label>Atmospheric Pressure (mbar):</label>	 
									<input type="text" name="gd_bp_min" id="gd_bp_min">
									<p style="display:inline">to</p>
									<input type="text" name="gd_bp_max" id="gd_bp_max">
									<br>
									<br>
								</div>
								
								<div id="gasEmiss" class="range">
									<label>Gas Emission:</label>	 
									<input type="text" name="gd_flow_min" id="gd_flow_min">
									<p style="display:inline">to</p>
									<input type="text" name="gd_flow_max" id="gd_flow_max">
									<br>
									<br>
								</div>
								
								<div id="gasCon" class="selectOpt">
									<label>Gas Concentration:</label>	
									<select id="gdConFlag" class="wowSpecies">
									  <option value="thresholdWithoutSpe">Apply Threshold without species</option>
									  <option value="thresholdWithSpe">Apply Threshold with species such as CO2,SO2,etc.</option>
									</select>
									<br><br>

									<div id="gdCon" style="padding-left:140px; width:700px; ">
										<div id="thresholdWithoutSpe">
											<label style="display:block">Apply Threshold without species</label>
											<input type="text" name="gd_concentration_min" id="gd_concentration_min">
											<p style="display:inline">to</p>
											<input type="text" name="gd_concentration_max" id="gd_concentration_max">
											<br><br>
										</div>	

										<div id="thresholdWithSpe">
											<label>Apply Threshold with species</label>
											<select id="gd_concentration" multiple="multiple" name="gd_concentration[]" style="display: block;">
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
											<br><br>

											<div id="selected">
											<!-- 	<label>CO2:</label>	
												<input type="text" name="gd_concentration_min_CO2" id="gd_concentration_min_CO2">
												<p style="display:inline">to</p>
												<input type="text" name="gd_concentration_max_CO2" id="gd_concentration_max_CO2">
												<br>
												<br>
																
																
												<label>SO2:</label>	
												<input type="text" name="gd_concentration_min_SO2" id="gd_concentration_min_SO2">
												<p style="display:inline">to</p>
												<input type="text" name="gd_concentration_max_SO2" id="gd_concentration_max_SO2">
												<br>
												<br>	

												<label>H2S:</label>	
												<br> continue for the rest .....		 -->
											</div>
										</div>
									</div> <!-- End gdCon block -->
								</div>
							</div> <!-- End sampleGas block -->
							

---------------------------------- <br/>
// Remaining tasks to do (gd_plu)

<h3> Gas Plume </h3><br>

	<label>Plume Height (km):</label>	
	<input type="text" name="gd_plu_height_min" id="gd_plu_height_min">
	<p style="display:inline">to</p>
	<input type="text" name="gd_plu_height_max" id="gd_plu_height_max">
	<br>
	<br>	

	<label>Gas Emission Rate:</label>	
	<select id="gdPluEmitFlag" name="gdPluEmitFlag">
	  <option value="thresholdWithSpe">Apply Threshold without species</option>
	  <option value="thresholdWithoutSpe">Apply Threshold with species such as CO2,SO2,etc.</option>
	</select>
	<br><br>

	<div id="gdEmit" style="padding-left:140px; width:700px;">
		<input type="text" name="gd_plu_emit_min" id="gd_plu_emit_min">
		<p style="display:inline">to</p>
		<input type="text" name="gd_plu_emit_max" id="gd_plu_emit_max">
		<br><br>
		
		<select id="gd_plu_emit" multiple="multiple" name="gd_plu_emit[]" style="display: block;">
			<option value="CO2">CO2</option>
			<option value="SO2">SO2</option>
			<option value="H2S">H2S</option>
			<option value="HCl">HCl</option>
			<option value="HF">HF</option>
			<option value="CO">CO</option>
			<option value="CO2/SO2">CO2/SO2</option>
		</select>
		<br><br>

		<label>CO2:</label>	  
		<input type="text" name="gd_plu_emit_min_CO2" id="gd_plu_emit_min_CO2">
		<p style="display:inline">to</p>
		<input type="text" name="gd_plu_emit_max_CO2" id="gd_plu_emit_max_CO2">
		<br>
		<br>	

		<label>SO2:</label>	
		<input type="text" name="gd_plu_emit_min_SO2" id="gd_plu_emit_min_SO2">
		<p style="display:inline">to</p>
		<input type="text" name="gd_plu_emit_max_SO2" id="gd_plu_emit_max_SO2">
		<br>
		<br> continue for the rest .....	

	
	</div>   <!-- End gd_plu_emit block -->
		 
		 
	<label>Gas Emission Mass:</label>	
		<select id="gdPluMassFlag" name="gdPluMassFlag">
		  <option value="thresholdWithSpe">Apply Threshold without species</option>
		  <option value="thresholdWithoutSpe">Apply Threshold with species such as CO2,SO2,etc.</option>
		</select>
		<br><br>
		
		<div id="gdPluEmissMass" style="padding-left:140px; width:700px; ">
				<input type="text" name="gd_plu_mass_min" id="gd_plu_mass_min">
				<p style="display:inline">to</p>
				<input type="text" name="gd_plu_mass_max" id="gd_plu_mass_max">
				<br><br>
				
				<select id="gd_plu_mass" multiple="multiple" name="gd_plu_mass[]" style="display: block;">
					<option value="CO2">CO2</option>
					<option value="SO2">SO2</option>
					<option value="H2S">H2S</option>
					<option value="HCl">HCl</option>
					<option value="HF">HF</option>
					<option value="CO">CO</option>
					<option value="CO2/SO2">CO2/SO2</option>
				</select>
				<br><br>
			
				<label>CO2:</label>	
				<input type="text" name="gd_plu_mass_min_CO2" id="gd_plu_mass_min_CO2">
				<p style="display:inline">to</p>
				<input type="text" name="gd_plu_mass_max_CO2" id="gd_plu_mass_max_CO2">
				<br>
				<br>	

				<label>SO2:</label>	
				<br> continue for the rest .....		
	</div>   <!-- End gd_plu_mass block -->	
		
		
	<label>Total Gas Emission:</label>	
	
		<select id="gdPluTotalGasFlag" name="gdPluTotalGasFlag">
		  <option value="thresholdWithSpe">Apply Threshold without species</option>
		  <option value="thresholdWithoutSpe">Apply Threshold with species such as CO2,SO2,etc.</option>
		</select>
		<br><br>
		
		<div id="gdPluTotalGas" style="padding-left:140px; width:700px; ">
				<input type="text" name="gd_plu_etot_min" id="gd_plu_etot_min">
				<p style="display:inline">to</p>
				<input type="text" name="gd_plu_etot_max" id="gd_plu_etot_max">
				<br><br>
				
				<select id="gd_plu_etot" multiple="multiple" name="gd_plu_etot[]" style="display: block;">
					<option value="CO2">CO2</option>
					<option value="SO2">SO2</option>
					<option value="H2S">H2S</option>
					<option value="HCl">HCl</option>
					<option value="HF">HF</option>
					<option value="CO">CO</option>
					<option value="CO2/SO2">CO2/SO2</option>
				</select>
				<br><br>
			
				<label>CO2:</label>	
				<input type="text" name="gd_plu_etot_min_CO2" id="gd_plu_etot_min_CO2">
				<p style="display:inline">to</p>
				<input type="text" name="gd_plu_etot_max_CO2" id="gd_plu_etot_max_CO2">
				<br>
				<br>	

				<label>SO2:</label>	
				<br> continue for the rest .....		
	</div>   <!-- End gd_plu_etot block -->	
		
		
-----------------------------------

// Remaining tasks to do (gd_sol)
		
<h3> Soil Efflux </h3><br>
		
	<label>Total Gas Flux:</label>	
	<select id="totalGasFluxFlag" name="totalGasFluxFlag">
	  <option value="thresholdWithSpe">Apply Threshold without species</option>
	  <option value="thresholdWithoutSpe">Apply Threshold with species such as CO2,SO2,etc.</option>
	</select>
	<br><br>
		
	<div id="gdSolTflux" style="padding-left:140px; width:700px; ">

		<input type="text" name="gd_sol_tflux_min" id="gd_sol_tflux_min">
		<p style="display:inline">to</p>
		<input type="text" name="gd_sol_tflux_max" id="gd_sol_tflux_max">
		<br>
		<br>	
			
		<select id="gd_sol_tflux" multiple="multiple" name="gd_sol_tflux[]" style="display:block;">
			<option value="CO2">CO2</option>
			<option value="SO2">SO2</option>
			<option value="H2S">H2S</option>
			<option value="HCl">HCl</option>
			<option value="HF">HF</option>
			<option value="CO">CO</option>
			<option value="CO2/SO2">CO2/SO2</option>
		</select>
		<br><br>
			
		<label>CO2:</label>	
		<input type="text" name="gd_sol_tflux_min_CO2" id="gd_sol_tflux_min_CO2">
		<p style="display:inline">to</p>
		<input type="text" name="gd_sol_tflux_max_CO2" id="gd_sol_tflux_max_CO2">
		<br>
		<br>	

		<label>SO2:</label>	
		<br> continue for the rest .....	
		
	 </div>   <!-- End gd_sol_tflux block -->	
		

	<label>Highest Gas Flux:</label>
	
		<select id="highestGasFluxFlag" name="highestGasFluxFlag">
		  <option value="thresholdWithSpe">Apply Threshold without species</option>
		  <option value="thresholdWithoutSpe">Apply Threshold with species such as CO2,SO2,etc.</option>
		</select>
		<br><br>
		
		<div id="gdSolHigh" style="padding-left:140px; width:700px; ">

			<input type="text" name="gd_sol_high_min" id="gd_sol_high_min">
			<p style="display:inline">to</p>
			<input type="text" name="gd_sol_high_max" id="gd_sol_high_max">
			<br>
			<br>	
				
				<select id="gd_sol_high" multiple="multiple" name="gd_sol_high[]" style="display:block;">
					<option value="CO2">CO2</option>
					<option value="SO2">SO2</option>
					<option value="H2S">H2S</option>
					<option value="HCl">HCl</option>
					<option value="HF">HF</option>
					<option value="CO">CO</option>
					<option value="CO2/SO2">CO2/SO2</option>
				</select>
				<br><br>
			
				<label>CO2:</label>	
				<input type="text" name="gd_sol_high_min_CO2" id="gd_sol_high_min_CO2">
				<p style="display:inline">to</p>
				<input type="text" name="gd_sol_high_max_CO2" id="gd_sol_high_max_CO2">
				<br>
				<br>	

				<label>SO2:</label>	
				<br> continue for the rest .....	
			
	</div>   <!-- End gd_sol_high block -->	
		
		
	<label>Highest Temperature:</label>	
		<select id="highestTempFlag" name="highestTempFlag">
		  <option value="thresholdWithSpe">Apply Threshold without species</option>
		  <option value="thresholdWithoutSpe">Apply Threshold with species such as CO2,SO2,etc.</option>
		</select>
		<br><br>
		
		<div id="gdSolHtemp" style="padding-left:140px; width:700px; ">

			<input type="text" name="gd_sol_htemp_min" id="gd_sol_htemp_min">
			<p style="display:inline">to</p>
			<input type="text" name="gd_sol_htemp_max" id="gd_sol_htemp_max">
			<br>
			<br>	
				
			<select id="gd_sol_htemp" multiple="multiple" name="gd_sol_htemp[]" style="display:block;">
				<option value="CO2">CO2</option>
				<option value="SO2">SO2</option>
				<option value="H2S">H2S</option>
				<option value="HCl">HCl</option>
				<option value="HF">HF</option>
				<option value="CO">CO</option>
				<option value="CO2/SO2">CO2/SO2</option>
			</select>
			<br><br>
			
			<label>CO2:</label>	
			<input type="text" name="gd_sol_htemp_min_CO2" id="gd_sol_htemp_min_CO2">
			<p style="display:inline">to</p>
			<input type="text" name="gd_sol_htemp_max_CO2" id="gd_sol_htemp_max_CO2">
			<br>
			<br>	

			<label>SO2:</label>	
			<br> continue for the rest .....	
			
	</div>   <!-- End gd_sol_htemp block -->	
		
----------------------------------							
							
						</div>   <!-- End Gas Data Type block -->
									
					</div>   <!-- End advSearchId block -->

				</div>
		</div>
		<input class = "btn btn-primary teal"  type="submit" value="Search" >
		<input class = "btn btn-primary teal" type="button" value="Clear All Fields" >
			
	</form>

</body>
</html>
