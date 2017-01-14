<!DOCTYPE html>
<html>
<head>
<style>
button.accordion {
    background-color: #F5F5F5;
    color: black;
    cursor: pointer;
    padding: 18px;
    width: 450px;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

button.accordion.active, button.accordion:hover {
    background-color: #C0C0C0;
}

button.accordion:after {
    content: '\02795';
    font-size: 13px;
    color: #777;
    float: right;
    margin-left: 5px;
}

button.accordion.active:after {
    content: "\2796";
}

div.panel {
    padding: 0 18px;
    background-color: white;
    max-height: 0;
    overflow: hidden;
    transition: 0.6s ease-in-out;
    opacity: 0;
}

li a{
	text-decoration:none;

}

div.panel.show {
    opacity: 1;
    max-height: 500px;  
}
</style>
</head>
<body>

<?php
function showUpdateTableList(){
echo <<< HTMLBLOCK
	
<div style="margin-bottom:180px;">	

	<h2>Upload Data with Online Form</h2>
	
		<button class="accordion">Seismic</button>
		<div class="panel">
			<ul style="padding-left:50px;">
				<li><a href="controller/insert_sn.php">Seismic Network</a></li>
				<li><a href="controller/insert_ss.php">Seismic Staion</a></li>
				<li><a href="controller/insert_si.php">Seismic Instrument</a></li>
				<li><a href="controller/insert_si_compt.php">Seismic Component</a></li>
				<li><a href = "/populate/online_forms/data_forms/main.php?data_type=EarthquakeData">Earthquake count</a></li>
			</ul>	
		</div>

		<button class="accordion">Deformation</button>
			<div class="panel">
				<ul style="padding-left:50px;">
					<li><a href="controller/insert_cn.php?cnType=Deformation">Deformation Network</a></li>
					<li><a href="controller/insert_ds.php">Deformation Staion</a></li>
					<li><a href="controller/insert_di_gen.php">Deformation General Instrument</a></li>
					<li><a href="controller/insert_di_tlt.php">Deformation Tilt/Strain Instrument</a></li>	
					<li><a href = "/populate/online_forms/data_forms/main.php?data_type=GPSData">GPS data</a></li>
				</ul>					
			</div>

		<button class="accordion">Fields</button>
		<div class="panel">
			<ul style="padding-left:50px;">
				<li><a href="controller/insert_cn.php?cnType=Fields">Fields Network</a></li>
				<li><a href="controller/insert_fs.php">Fields Staion</a></li>
				<li><a href="controller/insert_fi.php">Fields Instrument</a></li>
			</ul>				
		</div>

		<button class="accordion">Gas</button>
		<div class="panel">
			<ul style="padding-left:50px;">
				<li><a href="controller/insert_cn.php?cnType=Gas">Gas Network</a></li>
				<li><a href="controller/insert_gs.php">Gas Staion</a></li>
				<li><a href="controller/insert_gi.php">Gas Instrument</a></li>
				<li><a href = "/populate/online_forms/data_forms/main.php?data_type=SampledGasData">Directly Sampled Gas</a></li>
				<li><a href = "/populate/online_forms/data_forms/main.php?data_type=PlumeData">Plume data </a></li>
				<li><a href = "/populate/online_forms/data_forms/main.php?data_type=SoilEffluxData">Soil Efflux</a></li>
			</ul>				
		</div>
		
		
		<button class="accordion">Hydrologic</button>
		<div class="panel">
			<ul style="padding-left:50px;">
				<li><a href="controller/insert_cn.php?cnType=Hydrologic">Hydrologic Network</a></li>
				<li><a href="controller/insert_hs.php">Hydrologic Staion</a></li>
				<li><a href="controller/insert_hi.php">Hydrologic Instrument</a></li>
				<li><a href = "/populate/online_forms/data_forms/main.php?data_type=HydrologicData">Hydrologic sample</a></li>
			</ul>				
		</div>
	

		<button class="accordion">Thermal</button>
		<div class="panel">
			<ul style="padding-left:50px;">
				<li><a href="controller/insert_cn.php?cnType=Thermal">Thermal Network</a></li>
				<li><a href="controller/insert_ts.php">Thermal Staion</a></li>
				<li><a href="controller/insert_ti.php">Thermal Instrument</a></li>
				<li><a href = "/populate/online_forms/data_forms/main.php?data_type=GroundData">Ground Based Thermal Data</a></li>
			</ul>				
		</div>


		<button class="accordion">Meteo</button>
		<div class="panel">
			<ul style="padding-left:50px;">
				<li><a href="controller/insert_cn.php?cnType=Meteo">Meteo Network</a></li>
				<li><a href="controller/insert_ms.php">Meteo Staion</a></li>
				<li><a href="controller/insert_mi.php">Meteo Instrument</a></li>
			</ul>				
		</div>


		<button class="accordion">Inferred processes</button>
		<div class="panel">
			<ul style="padding-left:50px;">	
				<li><a href="controller/insert_ip.php?type=ip_hyd">Hydrothermal system interaction</a></li>
				<li><a href="controller/insert_ip.php?type=ip_mag">Magma movement</a></li>
				<li><a href="controller/insert_ip.php?type=ip_pres">Buildup of magma pressure</a></li>
				<li><a href="controller/insert_ip.php?type=ip_sat">Volatile saturation</a></li>
				<li><a href="controller/insert_ip.php?type=ip_tec">Regional tectonics interaction</a></li>
			</ul>				
		</div>
		
		
		<button class="accordion">Volcano</button>
		<div class="panel">
			<ul style="padding-left:50px;">
				<li><a href="controller/insert_vd.php">Volcano</a></li>
				<li><a href="controller/insert_vd_inf.php">Volcano Information</a></li>
				<li><a href="controller/insert_vd_mag.php">Magma chamber</a></li>
				<li><a href="controller/insert_vd_tec.php">Tectonic setting</a></li>
				<li><a href = "/populate/online_forms/data_forms/main.php?data_type=ImageData">Real Time Image Data</a></li>
				<li><a href = "/populate/online_forms/data_forms/main.php?data_type=VolcanoObservation">Daily Volcano Observation Data</a></li>	
			</ul>				
		</div>
		
		<button class="accordion">Bibliographic</button>
		<div class="panel">
			<ul style="padding-left:50px;">
				<li><a href="controller/insert_cb.php">Bibliographic</a></li>	
			</ul>				
		</div>	
		
		<button class="accordion">Observation about volcanic activity</button>
		<div class="panel">
			<ul style="padding-left:50px;">
				<li><a href="controller/insert_co.php">Observation about volcanic activity</a></li>
			</ul>				
		</div>		
		
		<button class="accordion">Observatory Contact Information</button>
		<div class="panel">
			<ul style="padding-left:50px;">
				<li><a href="controller/insert_cc.php">Observatory Contact Information</a></li>	
			</ul>				
		</div>	
</div>			
HTMLBLOCK;
}
?>
<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].onclick = function(){
        this.classList.toggle("active");
        this.nextElementSibling.classList.toggle("show");
  }
}
</script>