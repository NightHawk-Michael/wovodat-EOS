<!DOCTYPE html>
<html>

	<head>
<title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
        <meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
        <meta name="keywords" content="Volcano, Vulcano, Volcanoes">
        <link href="/css/normalize.css" rel="stylesheet" type="text/css">
        <link href="/gif2/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
        <link href="/css/index.css" rel="stylesheet" type="text/css">
        <script src="/js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="/js/jssor.slider.mini.js"></script>
        <script src="/js/index.js"></script>
<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet"> 
</head>

	<body>
	<div id="pagewrapper">
<div class="header">
<div class="header-logo">  
	<a href="http://www.wovo.org/">
<img src="image/WOVO_logo_side.png" />
	</a>
	</div>
<div class="header-name">
	<a href="http://www.wovodat.org/">
<img src="image/WOVOdat_DataonVolcanicUnrest.gif" alt="WOVOdat - Data on Volcanic Unrest" width="748" height="32" />
</a>
</div>
<div class="clearfix;"></div>
</div>

<div class="header-menu">

<ul class="left-menu">
	<li class="menu-item"><a href="index.php"><span>Home</span></a></li>
	<li class="menu-item"><a href="/"><span>News</span></a></li>
	<li class="menu-item"><a><span>Visualization</span></a></li>
	<li class="menu-item"><a><span>Data Download</span></a></li>
	<li class="menu-item"><a href="submitdata.php"><span>Submit Data</span></a></li>
	<li class="menu-item"><a href="documentation.php"><span>Documentation</a></span></li>
	<li class="menu-item"><a href="contactus.php"><span>Contact</span></a></li>
	<li class="logout menu-item loghide"><a href="#"><span class="heavy">Account</span></a></li>
</ul>
<ul class="right-menu"><li class="menu-item"><span>WOVOdat Tools Index</span> &or;</li></ul>


<ul class="sub-menu sub-menu-1">
	<li class="menu-item"><a href="about.php"><span>More About WOVOdat</span></a></li>
	<li class="menu-item"><a href="timeline.php"><span>History</span></a></li>
	<li class="menu-item"><a href="useofwovodat.php"><span>Uses of WOVOdat</span></a></li>
	<li class="menu-item"><a href="volcanicunrest.php"><span>What is Volcanic Unrest?</span></a></li>
</ul>
<ul class="sub-menu sub-menu-2">
	<li class="menu-item"><a href="singlevolcanoes.php"><span>Single Volcano View</span></a></li>
	<li class="menu-item"><a href="comparevolcanoes.php"><span>Side by Side Comparisons</span></a></li>
	<li class="menu-item"><a href="temporalevolution.php"><span>Temporal Evolution of Unrest</span></a></li>
	<li class="menu-item"><a href="classicepisodes.php"><span>Classic Episodes of Unrest</span></a></li>
</ul>
<ul class="sub-menu sub-menu-3">
	<li class="menu-item"><a href="searchbyvolcano.php"><span>Data Search by Volcano</span></a></li>
	<li class="menu-item"><a href="booleansearch.php"><span>Boolean Searches</span></a></li>
</ul>
<ul class="sub-menu sub-menu-4">
	<li class="menu-item"><a href="#"><span>Register</span></a></li>
</ul>
<ul class="sub-menu sub-menu-5">
	<li class="menu-item"><a href="singlevolcanoes.php"><span>Single volcano view</span></a></li>
	<li class="menu-item"><a href="comparevolcanoes.php"><span>Side by side comparisons</span></a></li>
	<li class="menu-item"><a href="temporalevolution.php"><span>Temporal evolution of unrest</span></a></li>
	<li class="menu-item"><a href="classicepisodes.php"><span>Classic episodes of unrest</span></a></li>
	<li class="menu-item"><a href="searchbyvolcano.php"><span>Data search by volcano</span></a></li>
	<li class="menu-item"><a href="booleansearch.php"><span>Boolean searches</span></a></li>
	<li class="menu-item"><a href="#"><span>Additional Tools</span></a></li>
</ul>
<ul class="sub-menu sub-menu-6">
	<li class="menu-item"><a href="#"><span>My Account</span></a></li>
	<li class="menu-item"><a href="#"><span>Logout</span></a></li>
</ul>




<div id="breadcrumbs"><a href="index.php">Home</a> > Documentation</div>
</div>

<div class="body">
<div class="twocolcontent">

<div class="leftcolumn"><h2 class="pagetitle">Documentation</h2>

<p>WOVOdat Database uses formats and data structure as described in <a href="/doc/database/1.0/wovodat10_doc.pdf">WOVOdat1.0 (Venezky and Newhall, 2007)</a> . The current version is WOVOdat1.1. The overall structure was retained from v1.0 to v1.1; most changes are in the details of parameters.</p>

<p>We use MySQL database system, and convert all submitted data into xml-format (WOVOml).</p> 

<div id="manual"><h3>User Manual</h3>
<ul>
     <li> WOVOdat database Documentation/ Manual 
<p>WOVOdat1.1 Manual <a href="/doc/database/1.1/wovodat11_doc.pdf" title="download WOVOdat pdf file" target="_blank">(pdf)</a>
          </p></li>
     <li> Detail description of WOVOdat Tables  
 <p style="padding: 0px 40px 0px 10px;">WOVOdat1.1 Tables<a href="/doc/database/1.1/index.php" title="view WOVOdat Table on-line"> (online view)</a>
         </p></li>
  
<li> Introduction how to use WOVOdat 
	<p style="padding: 0px 40px 0px 10px;">Introduction to using WOVOdat <a href="/doc/system/IntroductionToUseWOVOda_Feb2014.pdf" title="view WOVOdat Introduction" target="_blank">(pdf)</a>
         </p></li>
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

</div>

<div class="rightcolumn">
<img src="image/WOVOdat_DATA_FLOW.png" alt="WOVOdat Data Flow" />
<p>Details of data flow. From observatories submitting various data formats, through XML conversions with standardized terms, then upload and store into WOVOdat server.</p>
</div>

</div>
	</div>

<div class="footer"><?php include("footer.php"); ?></div>

</div>
</div>
	</body>

</html>