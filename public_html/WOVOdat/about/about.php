<?php 

include 'php/include/header.php'; 
include 'php/include/menu.php';   
echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > More About WOVODat</div>";

?>

</div>  <!-- header-menu -->

<div class="body">
	<div class="twocolcontent">
		<div class="leftcolumn">
			<h2 class="pagetitle">More About WOVOdat</h2>

			<p><span class="logo">WOVOdat</span> is a Database of Volcanic Unrest; instrumentally and visually recorded changes in seismicity, ground deformation, gas emission, and other parameters from their normal baselines. The database is created per the structure and format as described in the WOVOdat 1.0 report of Venezky and Newhall (USGS Openfile report 2007-1117) , updated in WOVOdat 1.1 (here). </p>

			<p>Data are recorded first at stations, and stations for which we already have some data may be seen by clicking Volcano, above, and using the scroll-down menu to locate your favorite volcano. If the data from a station have physical significance by themselves, they are reported in WOVOdat in tables of Station data. Other data, e.g., earthquake hypocenters, are more meaningful when considered across a network. These are presented in WOVOdat as network data. Tables are organized mainly by the parameters which are measured, e.g., seismicity, ground deformation, etc. </p>

			<p>Nearly all data in WOVOdat will be time-stamped and georeferenced, so that they can be studied in both space and time.
			WOVOdat stores mainly historical data. Active data that are younger than a 2-year grace period are generally not available, and they are still being used by Observatories and other contributors. WOVOdat welcomes more current data, but it respects the prerogative of those who collect the data to have first option in interpretation and publication.</p> 
		</div>

		<div class="rightcolumn">
			<img src="/img/flowChart/SIMPLIFIED_WOVOdat_SCHEMA.png" alt="Simplified WOVOdat Schema" width="420" height="530" />
		</div>  

	</div>
</div>

<div class="footer">
	<?php include 'php/include/footer.php'; ?>
</div>

</div>   <!-- header From header.php -->
</div>   <!-- pagewrapper From header.php  -->
</body>  <!-- body From header.php  -->

</html>  <!-- html From header.php  -->