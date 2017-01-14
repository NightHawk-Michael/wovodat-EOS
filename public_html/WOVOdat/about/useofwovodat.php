<?php 

include 'php/include/header.php'; 
include 'php/include/menu.php';  
echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> >  Uses of WOVOdat</div>";

?>

</div>  <!-- header-menu -->

<div class="body">
	<div class="twocolcontent">

		<div class="leftcolumn"><h2 class="pagetitle">Uses of WOVOdat</h2>

			<p>During periods of volcanic unrest, forecasting of further activity is aided by knowledge of previous activity at the restless volcano and knowledge of unrest and eruptions at similar volcanoes. WOVOdat expands access to that information. For example, a volcanologist responding to a crisis will usually ask, "Where has unrest like (the present) been seen before, and what happened?" Statistics of previous outcomes might be used in probabilistic event trees.</p>

			<p>For research, volcanologists might well ask, "What do the systematic of unrest between and leading up to eruptions tell us about processes by which volcanoes prepare to erupt?" Or, for another example, "What are the systematics differences between intrusions that erupt and those that don't?" In case of puzzling type of unrest, a researcher might look for systematic in other cases of such unrest.</p>

			<p>The more data in WOVOdat, the more useful it will be. Please click "<a href="/populate/index.php">SubmitData</a>" to contribute data! </p> 

			<p>Various visualization tools will help users to query and view the data. At present, users can display data. Later we will add tools for Boolean search and searches based on pattern recognition.</p>
		</div>

		<div class="rightcolumn">
			<p ><img src="/img/flowChart/data_visualization_example.jpg" align="right" width="450" height="550" alt="schema">
			Example of visualization: Comparison of precursory data from Redoubt (2009) and St. Helens (2004) eruptions.</p>
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