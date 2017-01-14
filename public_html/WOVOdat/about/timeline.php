<?php 

include 'php/include/header.php'; 
include 'php/include/menu.php';  
echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > History</div>";

?>

</div>  <!-- header-menu -->


<div class="body">
	<div class="twocolcontent">

		<div class="leftcolumn"><h2 class="pagetitle">Timeline of WOVOdat Development</h2>

			<p><h3>The First Idea</h3>After several eruptions in the late 1970's and early 1980's including that of Mount St. Helens (USA) in 1980, C. Newhall (USGS) and H. Okada (Hokkaido University) began planning how to collect, organize and easily access information on volcanic unrest around the world. They also started discussions with the Smithsonian Institution's Global Volcanism Program (GVP), to interface with information in the GVP database of historical eruptions. Together, WOVOdat and the GVP database are concerned with global occurrences and associations of unrest and eruptions. Practicing doctors and volcanologists can use epidemiological databases to aid their diagnoses, and volcanology needed a similar database for "volcano epidemiology". But technology at that time was a limiting factor, and the effort was set aside. Early proposal of WOVOdat is here <a href="/about/WOVOdat-proposal-2002.pdf">(pdf)</a>.</p>

			<p><h3>From Idea to Design</h3>The concept of WOVOdat was resurrected as technology advanced. Planning workshops were organized in 2000 and 2002. Principal conclusions from these two workshops; Summary of Bali may be found here <a href="/about/WOVOdat-Bali-2000.pdf">(pdf)</a> and Menlo-Park is here <a href="/about/WOVOdat-Menlo-2002.pdf">(pdf)</a>. Funding was sought and partner institutions identified. Existing database efforts and tools were reviewed and discussed with their developers. In the absence of an existing database that could serve the requirements of WOVOdat, Dina Venezky (USGS) took input from these workshops and a number of volunteers and designed WOVOdat 1.0 <a href="/../doc/database/1.0/wovodat10_doc.pdf">(pdf)</a> . </p>

			<p><h3>Further phase 2006-2009</h3>In November 2006, a steering committee was formed to provide scientific oversight. Members were drawn from observatories, government agencies, and research groups. The first steering committee meeting was held in December 2006, chaired by WOVO co-chairman Warner Marzocchi (INGV Italy) and Steve Malone (University of Washington). A technical workshop was held in February 2007, chaired by Florian Schwandner (then at Colorado State Univ) and Steve Malone. Jacopo Selva of INGV (Italy) and Hideki Ueda of NIED (Japan) led a pilot test of WOVOdat 1.0 with small datasets.</p> 
		
		</div>

		<div class="rightcolumn">
			&nbsp;&nbsp;&nbsp;
			<p align="center"><img src="/img/flowChart/WOVOdat_timeline.png" width="460" height="280" alt="schema"></p>
			<p><h3><a href="documentation.php">Documentation</a></h3>
			The database schema and documentation was published in April 2007 ("WOVOdat1.0", of D. Venezky and C.Newhall). And the updated one, (" <a href="/../doc/database/1.1/wovodat11_doc.pdf">WOVOdat1.1</a>") can be downloaded. 
			</p>
			<p><h3><a href="documentation.php">Implementation of WOVOdat</a></h3>
			Since January 2009, <a href="http://www.earthobservatory.sg/">the Earth Observatory of Singapore </a> has hosted the WOVOdat project and is developing the database per the expanded timeline in the figure (above). WOVOdat was opened for initial user access (mainly for data uploads) in November 2010. Recent effort is mainly on data population and tools for data visualization. Since July 2013, (IAVCEI Scientific Assembly in Kagoshima, Japan) registered user able to browse into WOVOdat visualization page, through "<a href="/precursor/index_unrest_devel_v5.php">Volcano</a>". 
			As soon as WOVOdat contains a critical mass of data and adequate set of tools, we will open it for general us.
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