<?php 

include 'php/include/header.php'; 
include 'php/include/menu.php';  
 
echo "<div id='breadcrumbs'><a href='http://{$_SERVER['SERVER_NAME']}/index.php'>Home</a> > Documentation</div>";

?>

</div>  <!-- header-menu -->

<div class="body">
	<div class="twocolcontent">

		<div class="leftcolumn">
			<h2 class="pagetitle">Documentation</h2>

			<p>WOVOdat Database uses formats and data structure as described in <a href="/doc/database/1.0/wovodat10_doc.pdf">WOVOdat1.0 (Venezky and Newhall, 2007)</a> . The current version is WOVOdat1.1. The overall structure was retained from v1.0 to v1.1; most changes are in the details of parameters.</p>

			<p>We use MySQL database system, and convert all submitted data into xml-format (WOVOml).</p> 

			<div id="manual">
				<h3>User Manual</h3>
					<ul>
						 <li> WOVOdat database Documentation/ Manual 
							<p>WOVOdat1.1 Manual <a href="/doc/database/1.1/wovodat11_doc.pdf" title="download WOVOdat pdf file" target="_blank">(pdf)</a></p>
					     </li>
						 <li> Detail description of WOVOdat Tables  
							<p style="padding: 0px 40px 0px 10px;">WOVOdat1.1 Tables<a href="/doc/database/1.1/index.php" title="view WOVOdat Table on-line"> (online view)</a></p>
						 </li>
					  
						<li> Introduction how to use WOVOdat 
							<p style="padding: 0px 40px 0px 10px;">Introduction to using WOVOdat <a href="/doc/system/IntroductionToUseWOVOda_Feb2014.pdf" title="view WOVOdat Introduction" target="_blank">(pdf)</a></p>
						</li>
					</ul>
								
				<h3>Database schema and structure</h3>
					<ul>
						 <li>WOVOdat Schema xsd
							 <p style="padding: 0px 40px 0px 10px;">WOVOml1.1.0 Schema <a href="/doc/system/1.1.0/wovoml_schema.xsd" title="view WOVOml descriptions" target="_blank">(online view)</a>
							 </p>
						 </li>
					  
						 <li >WOVOdat structure in XML format and their related MySQL's attributes
							 <p style="padding: 0px 40px 0px 10px;">WOVOdat XML <a href="/doc/system/1.1.0/wovoml_110.php" title="view WOVOml upload descriptions">(online view)</a>
							 </p>
						 </li>
					</ul>
			</div>

		</div>  <!-- leftcolumn -->

		<div class="rightcolumn">
			
			<div style="padding-top:30px;">
				<h4>Download WOVODat Standalone Package</h4>
				<p>
					<a href="/installing/index.php" title="download WOVOdat scripts"></a>
					   For those from observatories willing to develop their database system using <b><u>WOVOdat-like</u></b> format, scripts are available <a href="/installing/"><u>here</u></a>. These are basic scripts that could be used in starting database construction.
				</p>
			</div>
			
			<div style="padding-top:58px;">
				<img src="/img/flowChart/WOVOdat_DATA_FLOW.png" alt="WOVOdat Data Flow" />
				<p>Details of data flow. From observatories submitting various data formats, through XML conversions with standardized terms, then upload and store into WOVOdat server.</p>
			</div>
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