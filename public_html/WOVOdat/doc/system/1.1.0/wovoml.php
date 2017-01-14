<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
	<meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
	<meta name="keywords" content="Volcano, Vulcano, Volcanoes, Vulcanoes, Volcan, Vulkan, eruption, forecasting, forecast, predict, prediction, hazard, desaster, disaster, desasters, disasters, database, data warehouse, format, formats, WOVO, WOVOdat, IAVCEI, sharing, streaming, earthquake, earthquakes, seismic, seismicity, seismology, deformation, INSar, GPS, uplift, caldera, stratovolcano, stratovulcano">
	<link href="/css/styles_beta.css" rel="stylesheet">
	<link href="/js2/navig.css" rel="stylesheet">
	<link href="/gif/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
	<script language="javascript" type="text/javascript" src="/js/scripts.js"></script>
</head>
<body>

	<div id="wrapborder">
	<div id="wrap">
		<div id="headershadow">
			<?php include 'php/include/header_beta.php'; ?>
		</div>

		<!-- Content -->
		<div id="content">
		<div id="content_ref">
		
		<h1 class="page_title"><a name="top" id="top"></a>WOVOML Reference</h1>
		
		<p>This section contains a reference for all WOVOML elements defined in WOVOML version 1.1.0.</p>
		<p>WOVOML was initially built for importing data to WOVOdat. The goal of this project is to have a database containing data of world's volcanoes unrest. This project is still in progress.</p>
		<p>The complete XML schema for WOVOML can be found <a href="/doc/system/1.1.0/wovoml_schema.xsd">here</a>.</p>
		<p>Because WOVOML is an XML grammar and file format, tag names are case-sensitive and must appear exactly as shown here. If you're familiar with XML, you will also be interested in the <a href="/doc/system/1.1.0/wovoml_schema.xsd">WOVOML 1.1.0 Schema</a>. When you are editing WOVOML text files, you can load this Schema into any XML editor and validate your WOVOML code with it.</p>
		<p>You may also be interested in this <a href="/doc/system/1.1.0/wovoml_example.xml">WOVOML 1.1.0 Example</a> which you can edit in-co-ordination with this reference for creating your own WOVOML file.</p>

		<p><strong>Compatibility</strong></p>
		<p><span>WOVOML versions have a double numbering system: <em>databaseVersion.XMLVersion</em>. Example: WOVOML version 1.1.0 is related to WOVOdat version 1.1 and is the initial XML version.</span></p>

		<h2>About this reference</h2>
		<p>This reference presents all classes (tags) defined in WOVOML version 1.1.0. The first tag to start with is <a href="#wovoml">andlt;wovomlandgt;</a>. This is the root element for WOVOML and it contains all the other elements.</p>
		<p>Each reference entry includes the following:</p>
		<ul>
			<li>A <b>Template</b> section which lists the possible elements contained. There is a link to the description of these elements if they are of a complex type (i.e. if they contain elements).
			<br/>This section can be copied and used as a template in a WOVOML file.</li>
			<li>A <b>Description</b> of the class</li>
			<li>A list of possible <b>Attributes</b> of the class. For each of these attributes, the following information is given:
				<ul>
					<li>Description: a description of the attribute</li>
					<li>Type: the type or possible values of the attribute</li>
					<li>Required: whether this attribute is required</li>
				</ul>
			</li>
			<li>A list of possible <b>Elements</b> of the class. For each of these elements, the following information is given:
				<ul>
					<li>Description: a description of the element, or a link to its entry in the reference if the element is a class (i.e. if it contains elements)</li>
					<li>Type: the type or possible values of the element</li>
					<li>Unit: the unit in which the element's value should be given (for decimal and integer values only)</li>
					<li>Number of occurrences: the number of times this element can be repeated</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- wovoml (root) -->
		<h2 class="wovomlclass"><a name="wovoml" id="wovoml"></a>andlt;wovomlandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;wovoml version=andquot;1.1.0andquot; owner1="..." owner2="..." owner3="..." pubDate="..." xmlns=andquot;http://www.w3.org/2001/XMLSchema-instanceandquot; xmlns:xsi=andquot;http://www.w3.org/2001/XMLSchema-instanceandquot; xsi:schemaLocation=andquot;http://www.wovodat.org WOVOdatV1.xsdandquot;andgt;</strong>
	<a href="#observations">andlt;Observationsandgt;...andlt;/Observationsandgt;</a>
	<a href="#inferredprocesses">andlt;InferredProcessesandgt;...andlt;/InferredProcessesandgt;</a>
	<a href="#eruptions">andlt;Eruptionsandgt;...andlt;/Eruptionsandgt;</a>
	<a href="#monitoringsystems">andlt;MonitoringSystemsandgt;...andlt;/MonitoringSystemsandgt;</a>
	<a href="#data">andlt;Dataandgt;...andlt;/Dataandgt;</a>
<strong>andlt;/wovomlandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This is the root element for a WOVOML file. It cannot be contained in any element and must appear once (and only once) in the file.</p>
		
		<h3>Attributes</h3>
		<ul>
			<li>andlt;versionandgt;
				<ul>
					<li>Description: The version of this WOVOML file.</li>
					<li>Type: string</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this WOVOML file.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this WOVOML file (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this WOVOML file (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The general publish date for the data contained in this WOVOML file.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>andlt;xmlnsandgt;
				<ul>
					<li>Description: The namespace location.</li>
					<li>Type: string</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>andlt;xmlns:xsiandgt;
				<ul>
					<li>Description: The XML namespace location.</li>
					<li>Type: string</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>andlt;xsi:schemaLocationandgt;
				<ul>
					<li>Description: The schema location.</li>
					<li>Type: string</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;Observationsandgt;
				<ul>
					<li>Description: See <a href="#observations">andlt;Observationsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;InferredProcessesandgt;
				<ul>
					<li>Description: See <a href="#inferredprocesses">andlt;InferredProcessesandgt;</a>.</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Eruptionsandgt;
				<ul>
					<li>Description: See <a href="#eruptions">andlt;Eruptionsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;MonitoringSystemsandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;Dataandgt;
				<ul>
					<li>Description: See <a href="#data">andlt;Dataandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Observations -->
		<h2 class="wovomlclass"><a name="observations" id="observations"></a><a href="#wovoml">andlt;wovomlandgt;</a> | andlt;Observationsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Observations volcano=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#observation">andlt;Observationandgt;...andlt;/Observationandgt;</a>
<strong>andlt;/Observationsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information for observations about volcanic activity.</p>

		<h3>Attributes</h3>
		<ul>
			<li>volcano
				<ul>
					<li>Description: The CAVW number of the volcano to which these data refer.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;Observationandgt;
				<ul>
					<li>Description: See <a href="#observation">andlt;Observationandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Observations - Observation -->
		<h2 class="wovomlclass"><a name="observation" id="observation"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#observations">andlt;Observationsandgt;</a> | andlt;Observationandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Observation code=andquot;...andquot; volcano=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
<strong>andlt;/Observationandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information for observations about volcanic activity.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>volcano
				<ul>
					<li>Description: The CAVW number of the volcano to which these data refer.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the observation.</li>
					<li>Type: string</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The time the observation was made.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the time the observation was made.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The end time the observation was made.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the end time the observation was made.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Inferred processes -->
		<h2 class="wovomlclass"><a name="inferredprocesses" id="inferredprocesses"></a><a href="#wovoml">andlt;wovomlandgt;</a> | andlt;InferredProcessesandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;InferredProcesses volcano=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#inferredprocesses_magmamovement">andlt;MagmaMovementandgt;...andlt;/MagmaMovementandgt;</a>
	<a href="#inferredprocesses_volatilesat">andlt;VolatileSatandgt;...andlt;/VolatileSatandgt;</a>
	<a href="#inferredprocesses_magmapressure">andlt;MagmaPressureandgt;...andlt;/MagmaPressureandgt;</a>
	<a href="#inferredprocesses_hydrothermal">andlt;Hydrothermalandgt;...andlt;/Hydrothermalandgt;</a>
	<a href="#inferredprocesses_regionaltectonics">andlt;RegionalTectonicsandgt;...andlt;/RegionalTectonicsandgt;</a>
<strong>andlt;/InferredProcessesandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about historical (in most cases, published) inferences about processes causing volcanic unrest.</p>

		<h3>Attributes</h3>
		<ul>
			<li>volcano
				<ul>
					<li>Description: The CAVW number of the volcano to which these data refer.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;MagmaMovementandgt;
				<ul>
					<li>Description: See <a href="#inferredprocesses_magmamovement">andlt;MagmaMovementandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;VolatileSatandgt;
				<ul>
					<li>Description: See <a href="#inferredprocesses_volatilesat">andlt;VolatileSatandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;MagmaPressureandgt;
				<ul>
					<li>Description: See <a href="#inferredprocesses_magmapressure">andlt;MagmaPressureandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;Hydrothermalandgt;
				<ul>
					<li>Description: See <a href="#inferredprocesses_hydrothermal">andlt;Hydrothermalandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;RegionalTectonicsandgt;
				<ul>
					<li>Description: See <a href="#inferredprocesses_regionaltectonics">andlt;RegionalTectonicsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Inferred processes - Magma movement -->
		<h2 class="wovomlclass"><a name="inferredprocesses_magmamovement" id="inferredprocesses_magmamovement"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#inferredprocesses">andlt;InferredProcessesandgt;</a> | andlt;MagmaMovementandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;MagmaMovement code=andquot;...andquot; volcano=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;inferTimeandgt;...andlt;/inferTimeandgt;
	andlt;inferTimeUncandgt;...andlt;/inferTimeUncandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;deepSuppandgt;...andlt;/deepSuppandgt;
	andlt;ascentandgt;...andlt;/ascentandgt;
	andlt;convecBelowandgt;...andlt;/convecBelowandgt;
	andlt;convecAboveandgt;...andlt;/convecAboveandgt;
	andlt;magmaMixandgt;...andlt;/magmaMixandgt;
	andlt;dikeIntruandgt;...andlt;/dikeIntruandgt;
	andlt;pipeIntruandgt;...andlt;/pipeIntruandgt;
	andlt;sillIntruandgt;...andlt;/sillIntruandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/MagmaMovementandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about processes related to the movement of magma.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>volcano
				<ul>
					<li>Description: The CAVW number of the volcano to which these data refer.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;inferTimeandgt;
				<ul>
					<li>Description: The date and time of the inference in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;inferTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date and time of the inference.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date and time at which this inferred process started in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date and time at which this inferred process started.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date and time at which (or by which) this inferred process stopped in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date and time at which this inferred process ended.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;deepSuppandgt;
				<ul>
					<li>Description: New or renewed supply of magma from depth.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ascentandgt;
				<ul>
					<li>Description: Magma ascent, up from reservoir.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;convecBelowandgt;
				<ul>
					<li>Description: Magma convection/overturn induced from below by an intrusion at the base. The magma convection can be within the conduit and/or in underlying reservoir. If magma in a conduit convects to shallow depth, it may foam and release a substantial part of its gas.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;convecAboveandgt;
				<ul>
					<li>Description: Magma convection/overturn induced from above, by settling of a dense crystal-rich mass. In conduit and/or reservoir, with potential foaming, as above.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;magmaMixandgt;
				<ul>
					<li>Description: Magma mixing.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;dikeIntruandgt;
				<ul>
					<li>Description: Dike intrusion. In many cases this will be new intrusion through country rock; in some instances, magmas will flow anew through existing dikes.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;pipeIntruandgt;
				<ul>
					<li>Description: Intrusion through a pipe-like cylindrical conduit. As above, may be a new intrusion through country rock or renewed flow in an existing conduit.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;sillIntruandgt;
				<ul>
					<li>Description: Sill intrusion.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Added comments on magma movement.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Inferred processes - Volatile saturation -->
		<h2 class="wovomlclass"><a name="inferredprocesses_volatilesat" id="inferredprocesses_volatilesat"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#inferredprocesses">andlt;InferredProcessesandgt;</a> | andlt;VolatileSatandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;VolatileSat code=andquot;...andquot; volcano=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;inferTimeandgt;...andlt;/inferTimeandgt;
	andlt;inferTimeUncandgt;...andlt;/inferTimeUncandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;CO2Satandgt;...andlt;/CO2Satandgt;
	andlt;H2OSatandgt;...andlt;/H2OSatandgt;
	andlt;decompressandgt;...andlt;/decompressandgt;
	andlt;fugacityandgt;...andlt;/fugacityandgt;
	andlt;volatileAddandgt;...andlt;/volatileAddandgt;
	andlt;crystalOr2ndBoilandgt;...andlt;/crystalOr2ndBoilandgt;
	andlt;vesiculandgt;...andlt;/vesiculandgt;
	andlt;devesiculandgt;...andlt;/devesiculandgt;
	andlt;degasandgt;...andlt;/degasandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/VolatileSatandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about processes related to volatiles in the magma.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>volcano
				<ul>
					<li>Description: The CAVW number of the volcano to which these data refer.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;inferTimeandgt;
				<ul>
					<li>Description: The date and time of the inference in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;inferTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date and time of the inference.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date and time at which this inferred process started in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date and time at which this inferred process started.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date and time at which (or by which) this inferred process stopped in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date and time at which this inferred process ended.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;CO2Satandgt;
				<ul>
					<li>Description: Magma became saturated with CO<sub>2</sub> before an eruption and contributed to preeruption unrest. Saturation induced by any cause.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;H2OSatandgt;
				<ul>
					<li>Description: Magma became saturated with H<sub>2</sub>O before an eruption and contributed to preeruption unrest. Saturation induced by any cause.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;decompressandgt;
				<ul>
					<li>Description: Volatile saturation by decompression.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;fugacityandgt;
				<ul>
					<li>Description: Volatile saturation by change in fO<sub>2</sub>.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;volatileAddandgt;
				<ul>
					<li>Description: Volatile saturation by volatile addition.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;crystalOr2ndBoilandgt;
				<ul>
					<li>Description: Volatile saturation by crystallization or second boiling.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;vesiculandgt;
				<ul>
					<li>Description: Subsurface, preeruptive increases in vesiculation, thereby decreasing density. This would include extreme vesiculation to permeable foam.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;devesiculandgt;
				<ul>
					<li>Description: Subsurface, preeruptive decreases in vesiculation, thereby increasing density. This would include collapse of newly-degassed foam.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;degasandgt;
				<ul>
					<li>Description: Deep and near-surface degassing including gas explosion events.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Additional comments on volatile saturation.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Inferred processes - Magma pressure -->
		<h2 class="wovomlclass"><a name="inferredprocesses_magmapressure" id="inferredprocesses_magmapressure"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#inferredprocesses">andlt;InferredProcessesandgt;</a> | andlt;MagmaPressureandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;MagmaPressure code=andquot;...andquot; volcano=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;inferTimeandgt;...andlt;/inferTimeandgt;
	andlt;inferTimeUncandgt;...andlt;/inferTimeUncandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;gasInducedandgt;...andlt;/gasInducedandgt;
	andlt;tectInducedandgt;...andlt;/tectInducedandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/MagmaPressureandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about processes related to an increase in magmatic pressure.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>volcano
				<ul>
					<li>Description: The CAVW number of the volcano to which these data refer.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;inferTimeandgt;
				<ul>
					<li>Description: The date and time of the inference in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;inferTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date and time of the inference.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date and time at which this inferred process started in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date and time at which this inferred process started.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date and time at which (or by which) this inferred process stopped in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date and time at which this inferred process ended.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;gasInducedandgt;
				<ul>
					<li>Description: Gas-induced overpressure.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;tectInducedandgt;
				<ul>
					<li>Description: Magma or tectonically induced overpressures.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the buildup of magma pressure.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Inferred processes - Hydrothermal -->
		<h2 class="wovomlclass"><a name="inferredprocesses_hydrothermal" id="inferredprocesses_hydrothermal"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#inferredprocesses">andlt;InferredProcessesandgt;</a> | andlt;Hydrothermalandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Hydrothermal code=andquot;...andquot; volcano=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;inferTimeandgt;...andlt;/inferTimeandgt;
	andlt;inferTimeUncandgt;...andlt;/inferTimeUncandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;heatGwaterandgt;...andlt;/heatGwaterandgt;
	andlt;poreDestabandgt;...andlt;/poreDestabandgt;
	andlt;poreDeformandgt;...andlt;/poreDeformandgt;
	andlt;hydrofractandgt;...andlt;/hydrofractandgt;
	andlt;boilTremorandgt;...andlt;/boilTremorandgt;
	andlt;absorSolGasandgt;...andlt;/absorSolGasandgt;
	andlt;speciesEqbChangeandgt;...andlt;/speciesEqbChangeandgt;
	andlt;boilDryChimneysandgt;...andlt;/boilDryChimneysandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/Hydrothermalandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about magmatic interactions with the hydrothermal system.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>volcano
				<ul>
					<li>Description: The CAVW number of the volcano to which these data refer.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;inferTimeandgt;
				<ul>
					<li>Description: The date and time of the inference in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;inferTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date and time of the inference.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date and time at which this inferred process started in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date and time at which this inferred process started.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date and time at which (or by which) this inferred process stopped in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date and time at which this inferred process ended.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;heatGwaterandgt;
				<ul>
					<li>Description: Convective heating of groundwater.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;poreDestabandgt;
				<ul>
					<li>Description: Destabilization of edifice by pore pressure increase.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;poreDeformandgt;
				<ul>
					<li>Description: Elastic deformation induced by pore pressure change.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;hydrofractandgt;
				<ul>
					<li>Description: Hydrofracturing.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;boilTremorandgt;
				<ul>
					<li>Description: Boiling-induced tremor.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;absorSolGasandgt;
				<ul>
					<li>Description: Absorption of soluble gases.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;speciesEqbChangeandgt;
				<ul>
					<li>Description: Changing the equilibrium species.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;boilDryChimneysandgt;
				<ul>
					<li>Description: Boiling until dry chimneys are formed.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on interaction with the hydrothermal system.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Regional tectonics -->
		<h2 class="wovomlclass"><a name="inferredprocesses_regionaltectonics" id="inferredprocesses_regionaltectonics"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#inferredprocesses">andlt;InferredProcessesandgt;</a> | andlt;RegionalTectonicsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;RegionalTectonics code=andquot;...andquot; volcano=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;inferTimeandgt;...andlt;/inferTimeandgt;
	andlt;inferTimeUncandgt;...andlt;/inferTimeUncandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;tectonicChangesandgt;...andlt;/tectonicChangesandgt;
	andlt;staticStressandgt;...andlt;/staticStressandgt;
	andlt;dynamicStrainandgt;...andlt;/dynamicStrainandgt;
	andlt;localShearandgt;...andlt;/localShearandgt;
	andlt;slowEarthquakeandgt;...andlt;/slowEarthquakeandgt;
	andlt;distalPressureandgt;...andlt;/distalPressureandgt;
	andlt;distalDepressureandgt;...andlt;/distalDepressureandgt;
	andlt;hydrothermalLubricationandgt;...andlt;/hydrothermalLubricationandgt;
	andlt;earthTideandgt;...andlt;/earthTideandgt;
	andlt;atmosInfluenceandgt;...andlt;/atmosInfluenceandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/RegionalTectonicsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about processes related to regional tectonic events.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>volcano
				<ul>
					<li>Description: The CAVW number of the volcano to which these data refer.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;inferTimeandgt;
				<ul>
					<li>Description: The date and time of the inference in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;inferTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date and time of the inference.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date and time at which this inferred process started in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date and time at which this inferred process started.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date and time at which (or by which) this inferred process stopped in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date and time at which this inferred process ended.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;tectonicChangesandgt;
				<ul>
					<li>Description: Tectonically induced changes in magma/hydrothermal system (any mechanism).</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;staticStressandgt;
				<ul>
					<li>Description: Changes induced by changes in static stress after large regional earthquakes (incl. Viscoelastic processes).</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;dynamicStrainandgt;
				<ul>
					<li>Description: Changes induced by dynamic strain, associated with passage of earthquake waves from distal sources.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;localShearandgt;
				<ul>
					<li>Description: Changes induced by local fault shear or other deformation of the cone.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;slowEarthquakeandgt;
				<ul>
					<li>Description: Changes induced by "slow earthquake" as recorded in a GPS or other strain network.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;distalPressureandgt;
				<ul>
					<li>Description: Changes induced by pressurization of magma or hydrothermal reservoir located several kilometers or more from the apparent center of unrest. May include Distal VT earthquakes.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;distalDepressureandgt;
				<ul>
					<li>Description: Changes induced by depressurization of magma or hydrothermal reservoir located several kilometers or more from the apparent center of unrest. May include Distal VT earthquakes.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;hydrothermalLubricationandgt;
				<ul>
					<li>Description: Changes induced by increased hydrothermal pore pressures ("lubrication") along faults beneath or near the volcano.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;earthTideandgt;
				<ul>
					<li>Description: Earth tide interaction with magma/hydrothermal systems. Typically inferred from correlations between unrest and semi-diurnal or fortnightly earth tides.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;atmosInfluenceandgt;
				<ul>
					<li>Description: Interaction of the volcanic system with changes in atmospheric pressure, rainfall, wind, etc.</li>
					<li>Type: Y, N, M, U <em>(Yes, No, Maybe, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on interaction between the magma/hydrothermal system and regional tectonics.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Eruptions -->
		<h2 class="wovomlclass"><a name="eruptions" id="eruptions"></a><a href="#wovoml">andlt;wovomlandgt;</a> | andlt;Eruptionsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Eruptions volcano=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#eruption">andlt;Eruptionandgt;...andlt;/Eruptionandgt;</a>
	<a href="#phases">andlt;Phasesandgt;...andlt;/Phasesandgt;</a>
	<a href="#video">andlt;Videoandgt;...andlt;/Videoandgt;</a>
	<a href="#forecast">andlt;Forecastandgt;...andlt;/Forecastandgt;</a>
<strong>andlt;/Eruptionsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains eruption data.</p>

		<h3>Attributes</h3>
		<ul>
			<li>volcano
				<ul>
					<li>Description: The CAVW number of the volcano to which these data refer.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;Eruptionandgt;
				<ul>
					<li>Description: See <a href="#eruption">andlt;Eruptionandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;Phasesandgt;
				<ul>
					<li>Description: See <a href="#phases">andlt;Phasesandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;Videoandgt;
				<ul>
					<li>Description: See <a href="#video">andlt;Videoandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;Forecastandgt;
				<ul>
					<li>Description: See <a href="#forecast">andlt;Forecastandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Eruption -->
		<h2 class="wovomlclass"><a name="eruption" id="eruption"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#eruptions">andlt;Eruptionsandgt;</a> | andlt;Eruptionandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Eruption code=andquot;...andquot; volcano=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;narrativeandgt;...andlt;/narrativeandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;climaxTimeandgt;...andlt;/climaxTimeandgt;
	andlt;climaxTimeUncandgt;...andlt;/climaxTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	<a href="#eruption_video">andlt;Videoandgt;...andlt;/Videoandgt;</a>
	<a href="#eruption_phase">andlt;Phaseandgt;...andlt;/Phaseandgt;</a>
<strong>andlt;/Eruptionandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains general information about an eruption such as a narrative and time span.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>volcano
				<ul>
					<li>Description: The CAVW number of the volcano to which these data refer.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name (other than eruption year) that is often used to refer to the eruption (e.g., the Hoei eruption of Fuji or the VTTS eruption of Novarupta/Katmai).</li>
					<li>Type: string of at most 60 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;narrativeandgt;
				<ul>
					<li>Description: A narrative of eruption.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The eruption start time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the eruption start time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The eruption end time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the eruption end time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;climaxTimeandgt;
				<ul>
					<li>Description: The onset of eruption climax in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;climaxTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the time of the onset of eruption climax.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments and additional information about the eruption.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Videoandgt;
				<ul>
					<li>Description: See <a href="#eruption_video">andlt;Videoandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;Phaseandgt;
				<ul>
					<li>Description: See <a href="#eruption_phase">andlt;Phaseandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Eruption - Video -->
		<h2 class="wovomlclass"><a name="eruption_video" id="eruption_video"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#eruptions">andlt;Eruptionsandgt;</a> | <a href="#eruption">andlt;Eruptionandgt;</a> | andlt;Videoandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Video code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;linkandgt;...andlt;/linkandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;lengthandgt;...andlt;/lengthandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/Videoandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about a video clip of the eruption.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;linkandgt;
				<ul>
					<li>Description: A link to the video clip or information about where to find the video clip.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The start time of the video clip in UTC</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the start time of the video clip.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;lengthandgt;
				<ul>
					<li>Description: The length of the video clip.</li>
					<li>Type: HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A short description of the video, e.g., strombolian eruption footage taken from northwest of the vent at a distance of 5km. This should contain enough information to allow the user to determine if the video will be useful to them.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Additional information about the video including copyright information.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Eruption - Phase -->
		<h2 class="wovomlclass"><a name="eruption_phase" id="eruption_phase"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#eruptions">andlt;Eruptionsandgt;</a> | <a href="#eruption">andlt;Eruptionandgt;</a> | andlt;Phaseandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Phase code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;phaseNumberandgt;...andlt;/phaseNumberandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;veiandgt;...andlt;/veiandgt;
	andlt;maxLavaExtruandgt;...andlt;/maxLavaExtruandgt;
	andlt;maxExpMassDisandgt;...andlt;/maxExpMassDisandgt;
	andlt;dreandgt;...andlt;/dreandgt;
	andlt;magmaMixandgt;...andlt;/magmaMixandgt;
	andlt;maxColHeightandgt;...andlt;/maxColHeightandgt;
	andlt;colHeightDetandgt;...andlt;/colHeightDetandgt;
	andlt;minSiO2MatrixGlassandgt;...andlt;/minSiO2MatrixGlassandgt;
	andlt;maxSiO2MatrixGlassandgt;...andlt;/maxSiO2MatrixGlassandgt;
	andlt;minSiO2WholeRockandgt;...andlt;/minSiO2WholeRockandgt;
	andlt;maxSiO2WholeRockandgt;...andlt;/maxSiO2WholeRockandgt;
	andlt;totCrystalandgt;...andlt;/totCrystalandgt;
	andlt;phenoContentandgt;...andlt;/phenoContentandgt;
	andlt;phenoAssembandgt;...andlt;/phenoAssembandgt;
	andlt;preErupH2OContentandgt;...andlt;/preErupH2OContentandgt;
	andlt;phenoMeltInclusionandgt;...andlt;/phenoMeltInclusionandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	<a href="#eruption_phase_video">andlt;Videoandgt;...andlt;/Videoandgt;</a>
	<a href="#eruption_phase_forecast">andlt;Forecastandgt;...andlt;/Forecastandgt;</a>
<strong>andlt;/Phaseandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains specific information about the eruption such as the size of the phase and composition of magma.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;phaseNumberandgt;
				<ul>
					<li>Description: The observatory defined phase number starting with number 1 for the first phase of the eruption.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The start time of this phase in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the start time of this phase.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The end time of this phase in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the end time of this phase.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the eruption characteristics for this phase (please include the word climax for the climax of the eruption for search purposes).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;veiandgt;
				<ul>
					<li>Description: The volcanic explosivity index (VEI) for this phase taken from the Smithsonian.</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxLavaExtruandgt;
				<ul>
					<li>Description: The maximum lava extrusion rate in m<sup>3</sup>/s.</li>
					<li>Type: float</li>
					<li>Unit: m<sup>3</sup>/s</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxExpMassDisandgt;
				<ul>
					<li>Description: The maximum explosive mass discharge rate in kg/s andtimes; 10<sup>6</sup>.</li>
					<li>Type: float</li>
					<li>Unit: kg/s andtimes; 10<sup>6</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;dreandgt;
				<ul>
					<li>Description: The volume of material erupted or DRE in m<sup>3</sup> andtimes; 10<sup>6</sup>.</li>
					<li>Type: float</li>
					<li>Unit: m<sup>3</sup> andtimes; 10<sup>6</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;magmaMixandgt;
				<ul>
					<li>Description: A text field to indicate if there is evidence of magma mixing. Use Y for detected, N for not seen, or U for unknown. You can also give a short description of the evidence for magma mixing.</li>
					<li>Type: Y, N, U <em>(Yes, No, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxColHeightandgt;
				<ul>
					<li>Description: The maximum height of the eruption column in kilometers above sea level.</li>
					<li>Type: float</li>
					<li>Unit: km</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;colHeightDetandgt;
				<ul>
					<li>Description: The method used to determine the maximum height of the eruption column.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;minSiO2MatrixGlassandgt;
				<ul>
					<li>Description: The minimum SiO<sub>2</sub> of the matrix glass as a weight percent (xx.xx%).</li>
					<li>Type: float</li>
					<li>Unit: %</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxSiO2MatrixGlassandgt;
				<ul>
					<li>Description: The maximum SiO<sub>2</sub> of the matrix glass as a weight percent (xx.xx%).</li>
					<li>Type: float</li>
					<li>Unit: %</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;minSiO2WholeRockandgt;
				<ul>
					<li>Description: The minimum SiO<sub>2</sub> of the whole rock as a weight percent (xx.xx%).</li>
					<li>Type: float</li>
					<li>Unit: %</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxSiO2WholeRockandgt;
				<ul>
					<li>Description: The maximum SiO<sub>2</sub> of the whole rock as a weight percent (xx.xx%).</li>
					<li>Type: float</li>
					<li>Unit: %</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;totCrystalandgt;
				<ul>
					<li>Description: The total crystallinity of the dominant rock type in volume % (xx %).</li>
					<li>Type: float</li>
					<li>Unit: %</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;phenoContentandgt;
				<ul>
					<li>Description: The percentage of phenocrysts in the dominant rock type (xx%).</li>
					<li>Type: float</li>
					<li>Unit: %</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;phenoAssembandgt;
				<ul>
					<li>Description: The phenocryst assemblage listed in order of most abundant to least abundant.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;preErupH2OContentandgt;
				<ul>
					<li>Description: Pre-eruption water content in melt, as analyzed in melt inclusions in phenocrysts.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;phenoMeltInclusionandgt;
				<ul>
					<li>Description: A description of the phenocryst and the melt inclusion that was analyzed to determine the pre-eruption water content along with the method used.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Additional information about this eruptive phase including descriptions of the rocks, phenocrysts, and inclusions.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Videoandgt;
				<ul>
					<li>Description: See <a href="#eruption_phase_video">andlt;Videoandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;Forecastandgt;
				<ul>
					<li>Description: See <a href="#eruption_phase_forecast">andlt;Forecastandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Eruption - Phase - Video -->
		<h2 class="wovomlclass"><a name="eruption_phase_video" id="eruption_phase_video"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#eruptions">andlt;Eruptionsandgt;</a> | <a href="#eruption">andlt;Eruptionandgt;</a> |  <a href="#eruption_phase">andlt;Phaseandgt;</a> | andlt;Videoandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Video code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;linkandgt;...andlt;/linkandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;lengthandgt;...andlt;/lengthandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/Videoandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about a video clip of the eruption.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;linkandgt;
				<ul>
					<li>Description: A link to the video clip or information about where to find the video clip.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The start time of the video clip in UTC</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the start time of the video clip.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;lengthandgt;
				<ul>
					<li>Description: The length of the video clip.</li>
					<li>Type: HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A short description of the video, e.g., strombolian eruption footage taken from northwest of the vent at a distance of 5km. This should contain enough information to allow the user to determine if the video will be useful to them.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Additional information about the video including copyright information.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Eruption - Phase - Forecast -->
		<h2 class="wovomlclass"><a name="eruption_phase_forecast" id="eruption_phase_forecast"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#eruptions">andlt;Eruptionsandgt;</a> | <a href="#eruption">andlt;Eruptionandgt;</a> |  <a href="#eruption_phase">andlt;Phaseandgt;</a> | andlt;Forecastandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Forecast code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;earliestStartTimeandgt;...andlt;/earliestStartTimeandgt;
	andlt;earliestStartTimeUncandgt;...andlt;/earliestStartTimeUncandgt;
	andlt;latestStartTimeandgt;...andlt;/latestStartTimeandgt;
	andlt;latestStartTimeUncandgt;...andlt;/latestStartTimeUncandgt;
	andlt;issueTimeandgt;...andlt;/issueTimeandgt;
	andlt;issueTimeUncandgt;...andlt;/issueTimeUncandgt;
	andlt;timeSuccessandgt;...andlt;/timeSuccessandgt;
	andlt;magniSuccessandgt;...andlt;/magniSuccessandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/Forecastandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about forecasts made for a phase of the eruption, such as an overview of the forecast and the times forecasted. The forecasts give an insight into what was thought would occur at specific times during unrest. WOVOdat should provide the opportunity to analyze forecasts with monitoring data and event outcomes for future crisis situations.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A short description of the forecast for this phase. Please include the forecast type and magnitude.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;earliestStartTimeandgt;
				<ul>
					<li>Description: The earliest expected start time of the eruption in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;earliestStartTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the earliest expected start time of the eruption.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latestStartTimeandgt;
				<ul>
					<li>Description: The latest expected start time of the eruption in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latestStartTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the latest expected start time of the eruption.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;issueTimeandgt;
				<ul>
					<li>Description: The time the forecast was issued in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;issueTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the time the forecast was issued.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;timeSuccessandgt;
				<ul>
					<li>Description: A flag and comments on the success of the forecasted time of the eruption. Use the letters Y for yes, N for no, or P for Partly..</li>
					<li>Type: Y, N, P <em>(Yes, No, Partly)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;magniSuccessandgt;
				<ul>
					<li>Description: A flag and cmments on the success of the forecasted type and magnitude of the eruption. Use the letters Y for yes, N for no, or P for Partly.</li>
					<li>Type: Y, N, P <em>(Yes, No, Partly)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Any comments or additional information about the forecast, including what aspects were or were not successful.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Phases -->
		<h2 class="wovomlclass"><a name="phases" id="phases"></a><a href="#wovoml">andlt;wovomlandgt;</a> | andlt;Phasesandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Phases eruption=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#phase">andlt;Phaseandgt;...andlt;/Phaseandgt;</a>
<strong>andlt;/Phasesandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains phase data.</p>

		<h3>Attributes</h3>
		<ul>
			<li>andlt;eruptionandgt;
				<ul>
					<li>Description: The code of the eruption to which these data refer.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;Phaseandgt;
				<ul>
					<li>Description: See <a href="#phase">andlt;Phaseandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Phase -->
		<h2 class="wovomlclass"><a name="phase" id="phase"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#eruptions">andlt;Eruptionsandgt;</a> | andlt;Phaseandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Phase code=andquot;...andquot; eruption=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;phaseNumberandgt;...andlt;/phaseNumberandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;veiandgt;...andlt;/veiandgt;
	andlt;maxLavaExtruandgt;...andlt;/maxLavaExtruandgt;
	andlt;maxExpMassDisandgt;...andlt;/maxExpMassDisandgt;
	andlt;dreandgt;...andlt;/dreandgt;
	andlt;magmaMixandgt;...andlt;/magmaMixandgt;
	andlt;maxColHeightandgt;...andlt;/maxColHeightandgt;
	andlt;colHeightDetandgt;...andlt;/colHeightDetandgt;
	andlt;minSiO2MatrixGlassandgt;...andlt;/minSiO2MatrixGlassandgt;
	andlt;maxSiO2MatrixGlassandgt;...andlt;/maxSiO2MatrixGlassandgt;
	andlt;minSiO2WholeRockandgt;...andlt;/minSiO2WholeRockandgt;
	andlt;maxSiO2WholeRockandgt;...andlt;/maxSiO2WholeRockandgt;
	andlt;totCrystalandgt;...andlt;/totCrystalandgt;
	andlt;phenoContentandgt;...andlt;/phenoContentandgt;
	andlt;phenoAssembandgt;...andlt;/phenoAssembandgt;
	andlt;preErupH2OContentandgt;...andlt;/preErupH2OContentandgt;
	andlt;phenoMeltInclusionandgt;...andlt;/phenoMeltInclusionandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	<a href="#phase_video">andlt;Videoandgt;...andlt;/Videoandgt;</a>
	<a href="#phase_forecast">andlt;Forecastandgt;...andlt;/Forecastandgt;</a>
<strong>andlt;/Phaseandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains specific information about an eruption such as the size of the phase and composition of magma.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>andlt;eruptionandgt;
				<ul>
					<li>Description: The code of the eruption to which these data refer.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;phaseNumberandgt;
				<ul>
					<li>Description: The observatory defined phase number starting with number 1 for the first phase of the eruption.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The start time of this phase in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the start time of this phase.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The end time of this phase in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the end time of this phase.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the eruption characteristics for this phase (please include the word climax for the climax of the eruption for search purposes).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;veiandgt;
				<ul>
					<li>Description: The volcanic explosivity index (VEI) for this phase taken from the Smithsonian.</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxLavaExtruandgt;
				<ul>
					<li>Description: The maximum lava extrusion rate in m<sup>3</sup>/s.</li>
					<li>Type: float</li>
					<li>Unit: m<sup>3</sup>/s</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxExpMassDisandgt;
				<ul>
					<li>Description: The maximum explosive mass discharge rate in kg/s andtimes; 10<sup>6</sup>.</li>
					<li>Type: float</li>
					<li>Unit: kg/s andtimes; 10<sup>6</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;dreandgt;
				<ul>
					<li>Description: The volume of material erupted or DRE in m<sup>3</sup> andtimes; 10<sup>6</sup>.</li>
					<li>Type: float</li>
					<li>Unit: m<sup>3</sup> andtimes; 10<sup>6</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;magmaMixandgt;
				<ul>
					<li>Description: A text field to indicate if there is evidence of magma mixing. Use Y for detected, N for not seen, or U for unknown. You can also give a short description of the evidence for magma mixing.</li>
					<li>Type: Y, N, U <em>(Yes, No, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxColHeightandgt;
				<ul>
					<li>Description: The maximum height of the eruption column in kilometers above sea level.</li>
					<li>Type: float</li>
					<li>Unit: km</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;colHeightDetandgt;
				<ul>
					<li>Description: The method used to determine the maximum height of the eruption column.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;minSiO2MatrixGlassandgt;
				<ul>
					<li>Description: The minimum SiO<sub>2</sub> of the matrix glass as a weight percent (xx.xx%).</li>
					<li>Type: float</li>
					<li>Unit: %</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxSiO2MatrixGlassandgt;
				<ul>
					<li>Description: The maximum SiO<sub>2</sub> of the matrix glass as a weight percent (xx.xx%).</li>
					<li>Type: float</li>
					<li>Unit: %</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;minSiO2WholeRockandgt;
				<ul>
					<li>Description: The minimum SiO<sub>2</sub> of the whole rock as a weight percent (xx.xx%).</li>
					<li>Type: float</li>
					<li>Unit: %</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxSiO2WholeRockandgt;
				<ul>
					<li>Description: The maximum SiO<sub>2</sub> of the whole rock as a weight percent (xx.xx%).</li>
					<li>Type: float</li>
					<li>Unit: %</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;totCrystalandgt;
				<ul>
					<li>Description: The total crystallinity of the dominant rock type in volume % (xx %).</li>
					<li>Type: float</li>
					<li>Unit: %</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;phenoContentandgt;
				<ul>
					<li>Description: The percentage of phenocrysts in the dominant rock type (xx%).</li>
					<li>Type: float</li>
					<li>Unit: %</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;phenoAssembandgt;
				<ul>
					<li>Description: The phenocryst assemblage listed in order of most abundant to least abundant.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;preErupH2OContentandgt;
				<ul>
					<li>Description: Pre-eruption water content in melt, as analyzed in melt inclusions in phenocrysts.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;phenoMeltInclusionandgt;
				<ul>
					<li>Description: A description of the phenocryst and the melt inclusion that was analyzed to determine the pre-eruption water content along with the method used.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Additional information about this eruptive phase including descriptions of the rocks, phenocrysts, and inclusions.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Videoandgt;
				<ul>
					<li>Description: See <a href="#phase_video">andlt;Videoandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;Forecastandgt;
				<ul>
					<li>Description: See <a href="#phase_forecast">andlt;Forecastandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Phase - Video -->
		<h2 class="wovomlclass"><a name="phase_video" id="phase_video"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#eruptions">andlt;Eruptionsandgt;</a> | <a href="#phase">andlt;Phaseandgt;</a> | andlt;Videoandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Video code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;linkandgt;...andlt;/linkandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;lengthandgt;...andlt;/lengthandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/Videoandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about a video clip of the eruption phase.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;linkandgt;
				<ul>
					<li>Description: A link to the video clip or information about where to find the video clip.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The start time of the video clip in UTC</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the start time of the video clip.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;lengthandgt;
				<ul>
					<li>Description: The length of the video clip.</li>
					<li>Type: HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A short description of the video, e.g., strombolian eruption footage taken from northwest of the vent at a distance of 5km. This should contain enough information to allow the user to determine if the video will be useful to them.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Additional information about the video including copyright information.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Phase - Forecast -->
		<h2 class="wovomlclass"><a name="phase_forecast" id="phase_forecast"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#eruptions">andlt;Eruptionsandgt;</a> | <a href="#phase">andlt;Phaseandgt;</a> | andlt;Forecastandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Forecast code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;earliestStartTimeandgt;...andlt;/earliestStartTimeandgt;
	andlt;earliestStartTimeUncandgt;...andlt;/earliestStartTimeUncandgt;
	andlt;latestStartTimeandgt;...andlt;/latestStartTimeandgt;
	andlt;latestStartTimeUncandgt;...andlt;/latestStartTimeUncandgt;
	andlt;issueTimeandgt;...andlt;/issueTimeandgt;
	andlt;issueTimeUncandgt;...andlt;/issueTimeUncandgt;
	andlt;timeSuccessandgt;...andlt;/timeSuccessandgt;
	andlt;magniSuccessandgt;...andlt;/magniSuccessandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/Forecastandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about forecasts made for a phase of the eruption, such as an overview of the forecast and the times forecasted. The forecasts give an insight into what was thought would occur at specific times during unrest. WOVOdat should provide the opportunity to analyze forecasts with monitoring data and event outcomes for future crisis situations.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A short description of the forecast for this phase. Please include the forecast type and magnitude.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;earliestStartTimeandgt;
				<ul>
					<li>Description: The earliest expected start time of the eruption in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;earliestStartTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the earliest expected start time of the eruption.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latestStartTimeandgt;
				<ul>
					<li>Description: The latest expected start time of the eruption in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latestStartTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the latest expected start time of the eruption.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;issueTimeandgt;
				<ul>
					<li>Description: The time the forecast was issued in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;issueTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the time the forecast was issued.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;timeSuccessandgt;
				<ul>
					<li>Description: A flag and comments on the success of the forecasted time of the eruption. Use the letters Y for yes, N for no, or P for Partly..</li>
					<li>Type: Y, N, P <em>(Yes, No, Partly)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;magniSuccessandgt;
				<ul>
					<li>Description: A flag and cmments on the success of the forecasted type and magnitude of the eruption. Use the letters Y for yes, N for no, or P for Partly.</li>
					<li>Type: Y, N, P <em>(Yes, No, Partly)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Any comments or additional information about the forecast, including what aspects were or were not successful.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Video -->
		<h2 class="wovomlclass"><a name="video" id="video"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#eruptions">andlt;Eruptionsandgt;</a> | andlt;Videoandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Video code=andquot;...andquot; volcano=andquot;...andquot; eruption=andquot;...andquot; phase=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;linkandgt;...andlt;/linkandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;lengthandgt;...andlt;/lengthandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/Videoandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about a video clip of the eruption.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>volcano
				<ul>
					<li>Description: The CAVW number of the volcano to which the data refer.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>eruption
				<ul>
					<li>Description: The code of the eruption to which the data refer.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>phase
				<ul>
					<li>Description: The code of the phase to which the data refer.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;linkandgt;
				<ul>
					<li>Description: A link to the video clip or information about where to find the video clip.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The start time of the video clip in UTC</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the start time of the video clip.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;lengthandgt;
				<ul>
					<li>Description: The length of the video clip.</li>
					<li>Type: HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A short description of the video, e.g., strombolian eruption footage taken from northwest of the vent at a distance of 5km. This should contain enough information to allow the user to determine if the video will be useful to them.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Additional information about the video including copyright information.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Forecast -->
		<h2 class="wovomlclass"><a name="forecast" id="forecast"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#eruptions">andlt;Eruptionsandgt;</a> | andlt;Forecastandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Forecast code=andquot;...andquot; volcano=andquot;...andquot; phase=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;earliestStartTimeandgt;...andlt;/earliestStartTimeandgt;
	andlt;earliestStartTimeUncandgt;...andlt;/earliestStartTimeUncandgt;
	andlt;latestStartTimeandgt;...andlt;/latestStartTimeandgt;
	andlt;latestStartTimeUncandgt;...andlt;/latestStartTimeUncandgt;
	andlt;issueTimeandgt;...andlt;/issueTimeandgt;
	andlt;issueTimeUncandgt;...andlt;/issueTimeUncandgt;
	andlt;timeSuccessandgt;...andlt;/timeSuccessandgt;
	andlt;magniSuccessandgt;...andlt;/magniSuccessandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/Forecastandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about forecasts made for a phase of the eruption, such as an overview of the forecast and the times forecasted. The forecasts give an insight into what was thought would occur at specific times during unrest. WOVOdat should provide the opportunity to analyze forecasts with monitoring data and event outcomes for future crisis situations.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>volcano
				<ul>
					<li>Description: The CAVW number of the volcano to which the data refer.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>eruption
				<ul>
					<li>Description: The code of the eruption to which the data refer.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>phase
				<ul>
					<li>Description: The code of the phase to which the data refer.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A short description of the forecast for this phase. Please include the forecast type and magnitude.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;earliestStartTimeandgt;
				<ul>
					<li>Description: The earliest expected start time of the eruption in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;earliestStartTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the earliest expected start time of the eruption.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latestStartTimeandgt;
				<ul>
					<li>Description: The latest expected start time of the eruption in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latestStartTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the latest expected start time of the eruption.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;issueTimeandgt;
				<ul>
					<li>Description: The time the forecast was issued in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;issueTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the time the forecast was issued.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;timeSuccessandgt;
				<ul>
					<li>Description: A flag and comments on the success of the forecasted time of the eruption. Use the letters Y for yes, N for no, or P for Partly..</li>
					<li>Type: Y, N, P <em>(Yes, No, Partly)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;magniSuccessandgt;
				<ul>
					<li>Description: A flag and cmments on the success of the forecasted type and magnitude of the eruption. Use the letters Y for yes, N for no, or P for Partly.</li>
					<li>Type: Y, N, P <em>(Yes, No, Partly)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Any comments or additional information about the forecast, including what aspects were or were not successful.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems -->
		<h2 class="wovomlclass"><a name="monitoringsystems" id="monitoringsystems"></a><a href="#wovoml">andlt;wovomlandgt;</a> | andlt;MonitoringSystemsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;MonitoringSystems owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_airplane">andlt;Airplaneandgt;...andlt;/Airplaneandgt;</a>
	<a href="#monitoringsystems_deformationnetwork">andlt;DeformationNetworkandgt;...andlt;/DeformationNetworkandgt;</a>
	<a href="#monitoringsystems_deformationstations">andlt;DeformationStationsandgt;...andlt;/DeformationStationsandgt;</a>
	<a href="#monitoringsystems_deformationinstruments">andlt;DeformationInstrumentsandgt;...andlt;/DeformationInstrumentsandgt;</a>
	<a href="#monitoringsystems_gasnetwork">andlt;GasNetworkandgt;...andlt;/GasNetworkandgt;</a>
	<a href="#monitoringsystems_gasstations">andlt;GasStationsandgt;...andlt;/GasStationsandgt;</a>
	<a href="#monitoringsystems_gasinstruments">andlt;GasInstrumentsandgt;...andlt;/GasInstrumentsandgt;</a>
	<a href="#monitoringsystems_hydrologicnetwork">andlt;HydrologicNetworkandgt;...andlt;/HydrologicNetworkandgt;</a>
	<a href="#monitoringsystems_hydrologicstations">andlt;HydrologicStationsandgt;...andlt;/HydrologicStationsandgt;</a>
	<a href="#monitoringsystems_hydrologicinstruments">andlt;HydrologicInstrumentsandgt;...andlt;/HydrologicInstrumentsandgt;</a>
	<a href="#monitoringsystems_fieldsnetwork">andlt;FieldsNetworkandgt;...andlt;/FieldsNetworkandgt;</a>
	<a href="#monitoringsystems_fieldsstations">andlt;FieldsStationsandgt;...andlt;/FieldsStationsandgt;</a>
	<a href="#monitoringsystems_fieldsinstruments">andlt;FieldsInstrumentsandgt;...andlt;/FieldsInstrumentsandgt;</a>
	<a href="#monitoringsystems_thermalnetwork">andlt;ThermalNetworkandgt;...andlt;/ThermalNetworkandgt;</a>
	<a href="#monitoringsystems_thermalstations">andlt;ThermalStationsandgt;...andlt;/ThermalStationsandgt;</a>
	<a href="#monitoringsystems_thermalinstruments">andlt;ThermalInstrumentsandgt;...andlt;/ThermalInstrumentsandgt;</a>
	<a href="#monitoringsystems_seismicnetwork">andlt;SeismicNetworkandgt;...andlt;/SeismicNetworkandgt;</a>
	<a href="#monitoringsystems_seismicstations">andlt;SeismicStationsandgt;...andlt;/SeismicStationsandgt;</a>
	<a href="#monitoringsystems_seismicinstruments">andlt;SeismicInstrumentsandgt;...andlt;/SeismicInstrumentsandgt;</a>
	<a href="#monitoringsystems_seismiccomponents">andlt;SeismicComponentsandgt;...andlt;/SeismicComponentsandgt;</a>
<strong>andlt;/MonitoringSystemsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about all monitoring systems used for a volcano.</p>

		<h3>Attributes</h3>
		<ul>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;Airplaneandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_airplane">andlt;Airplaneandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;DeformationNetworkandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_deformationnetwork">andlt;DeformationNetworkandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;DeformationStationsandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_deformationstations">andlt;DeformationStationsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;DeformationInstrumentsandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_deformationinstruments">andlt;DeformationInstrumentsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;GasNetworkandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_gasnetwork">andlt;GasNetworkandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;GasStationsandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_gasstations">andlt;GasStationsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;GasInstrumentsandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_gasinstruments">andlt;GasInstrumentsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;HydrologicNetworkandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_hydrologicnetwork">andlt;HydrologicNetworkandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;HydrologicStationsandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_hydrologicstations">andlt;HydrologicStationsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;HydrologicInstrumentsandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_hydrologicinstruments">andlt;HydrologicInstrumentsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;FieldsNetworkandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_fieldsnetwork">andlt;FieldsNetworkandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;FieldsStationsandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_fieldsstations">andlt;FieldsStationsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;FieldsInstrumentsandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_fieldsinstruments">andlt;FieldsInstrumentsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;ThermalNetworkandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_thermalnetwork">andlt;ThermalNetworkandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;ThermalStationsandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_thermalstations">andlt;ThermalStationsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;ThermalInstrumentsandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_thermalinstruments">andlt;ThermalInstrumentsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;SeismicNetworkandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_seismicnetwork">andlt;SeismicNetworkandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;SeismicStationsandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_seismicstations">andlt;SeismicStationsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;SeismicInstrumentsandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_seismicinstruments">andlt;SeismicInstrumentsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;SeismicComponentsandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_seismiccomponent">andlt;SeismicComponentsandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Airplane -->
		<h2 class="wovomlclass"><a name="monitoringsystems_airplane" id="monitoringsystems_airplane"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;Airplaneandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Airplane code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	<a href="#monitoringsystems_airplane_gasinstrument">andlt;GasInstrumentandgt;...andlt;/GasInstrumentandgt;</a>
	<a href="#monitoringsystems_airplane_thermalinstrument">andlt;ThermalInstrumentandgt;...andlt;/ThermalInstrumentandgt;</a>
<strong>andlt;/Airplaneandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about airplanes that are used for collecting data from above the surface of the earth.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the airplane.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the airplane including where to find additional information.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the airplane was first used in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the airplane was first used.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date the airplane was permanently decommissioned or the time this set of information became invalid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the airplane was permanently decommissioned or the time this set of information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;GasInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_airplane_gasinstrument">andlt;GasInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;ThermalInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_airplane_thermalinstrument">andlt;ThermalInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Airplane - Gas instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_airplane_gasinstrument" id="monitoringsystems_airplane_gasinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_airplane">andlt;Airplaneandgt;</a> | andlt;GasInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;GasInstrument code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;permanentandgt;...andlt;/permanentandgt;
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;signalToNoiseandgt;...andlt;/signalToNoiseandgt;
	andlt;calibrationandgt;...andlt;/calibrationandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/GasInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the instruments used to collect ground-based and remote gas data along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;permanentandgt;
				<ul>
					<li>Description: A single character field to know if the instrument is part of a permanent installation (use P for permanent) or part of a campaign (use C for campaign).</li>
					<li>Type: P, C <em>(Permanent, Campaign)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: Typical instrumental measuring precision.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;signalToNoiseandgt;
				<ul>
					<li>Description: An instrument specific signal to noise ratio.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;calibrationandgt;
				<ul>
					<li>Description: The calibration method.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Airplane - Thermal instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_airplane_thermalinstrument" id="monitoringsystems_airplane_thermalinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_airplane">andlt;Airplaneandgt;</a> | andlt;ThermalInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;ThermalInstrument code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;signalToNoiseandgt;...andlt;/signalToNoiseandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/ThermalInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the instruments used to collect ground-based and remote thermal data.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: Typical instrumental measuring precision.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;signalToNoiseandgt;
				<ul>
					<li>Description: An instrument specific signal to noise ratio.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Deformation network -->
		<h2 class="wovomlclass"><a name="monitoringsystems_deformationnetwork" id="monitoringsystems_deformationnetwork"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;DeformationNetworkandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;DeformationNetwork code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_deformationnetwork_volcanoes">andlt;Volcanoesandgt;...andlt;/Volcanoesandgt;</a>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;areaandgt;...andlt;/areaandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	<a href="#monitoringsystems_deformationnetwork_deformationstation">andlt;DeformationStationandgt;...andlt;/DeformationStationandgt;</a>
<strong>andlt;/DeformationNetworkandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the network of stations that collect deformation data at a particular site, in general at one volcano.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;Volcanoesandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_deformationnetwork_volcanoes">andlt;Volcanoesandgt;</a>.</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the network.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;areaandgt;
				<ul>
					<li>Description: The volcano and approximate area in km<sup>2</sup> covered by the network.</li>
					<li>Type: float</li>
					<li>Unit: km<sup>2</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the network including permanent stations and types of instruments.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the network was set up and activated in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the network was set up and activated.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date the network was permanently decommissioned or the time this set of information became invalid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the network was permanently decommissioned or the time this set of information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: Time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about the network including minor updates to the network over time and future plans.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;DeformationStationandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_deformationnetwork_deformationstation">andlt;DeformationStationandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Deformation network - Volcanoes -->
		<h2 class="wovomlclass"><a name="monitoringsystems_deformationnetwork_volcanoes" id="monitoringsystems_deformationnetwork_volcanoes"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_deformationnetwork">andlt;DeformationNetworkandgt;</a> | andlt;Volcanoesandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Volcanoesandgt;</strong>
	andlt;volcanoCodeandgt;...andlt;/volcanoCodeandgt;
<strong>andlt;/Volcanoesandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains a list of volcano codes.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;volcanoCodeandgt;
				<ul>
					<li>Description: The CAVW number of a volcano.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Deformation network - Deformation station -->
		<h2 class="wovomlclass"><a name="monitoringsystems_deformationnetwork_deformationstation" id="monitoringsystems_deformationnetwork_deformationstation"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_deformationnetwork">andlt;DeformationNetworkandgt;</a> | andlt;DeformationStationandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;DeformationStation code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;permInstandgt;...andlt;/permInstandgt;
	andlt;latandgt;...andlt;/latandgt;
	andlt;lonandgt;...andlt;/lonandgt;
	andlt;elevandgt;...andlt;/elevandgt;
	andlt;horizPrecisionandgt;...andlt;/horizPrecisionandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	andlt;refStationandgt;...andlt;/refStationandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	<a href="#monitoringsystems_deformationnetwork_deformationstation_deformationinstrument">andlt;DeformationInstrumentandgt;...andlt;/DeformationInstrumentandgt;</a>
	<a href="#monitoringsystems_deformationnetwork_deformationstation_tiltstraininstrument">andlt;TiltStrainInstrumentandgt;...andlt;/TiltStrainInstrumentandgt;</a>
<strong>andlt;/DeformationStationandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as a location, name, and description for stations where deformation or geodetic data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the benchmark or station given by the observatory.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;permInstandgt;
				<ul>
					<li>Description: A list of any permanent instruments installed at this site.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latandgt; AND andlt;lonandgt;
				<ul>
					<li>Description: The latitude and longitude in decimal degrees.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevandgt;
				<ul>
					<li>Description: The nominal elevation of the station in meters.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;horizPrecisionandgt;
				<ul>
					<li>Description: The horizontal precision of nominal location for GPS.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the station was set up and activated or the time this new information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was set up and activated or the time this new information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: The time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;refStationandgt;
				<ul>
					<li>Description: A flag indicating that this station is used as a reference station.</li>
					<li>Type: Y, N <em>(Yes, No)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the station or any comments.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;DeformationInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_deformationnetwork_deformationstation_deformationinstrument">andlt;DeformationInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;TiltStrainInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_deformationnetwork_deformationstation_tiltstraininstrument">andlt;TiltStrainInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Deformation network - Deformation station - Deformation instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_deformationnetwork_deformationstation_deformationinstrument" id="monitoringsystems_deformationnetwork_deformationstation_deformationinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_deformationnetwork">andlt;DeformationNetworkandgt;</a> | <a href="#monitoringsystems_deformationnetwork_deformationstation">andlt;DeformationStationandgt;</a> | andlt;DeformationInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;DeformationInstrument code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;signalToNoiseandgt;...andlt;/signalToNoiseandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/DeformationInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about each individual instrument along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument chosen from a standard set of instruments.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: Typical instrumental measuring precision.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;signalToNoiseandgt;
				<ul>
					<li>Description: An instrument specific signal to noise ratio.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this new information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this new information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument including anything unusual, for example, modifications.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Deformation network - Deformation station - Tilt/Strain instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_deformationnetwork_deformationstation_tiltstraininstrument" id="monitoringsystems_deformationnetwork_deformationstation_tiltstraininstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_deformationnetwork">andlt;DeformationNetworkandgt;</a> | <a href="#monitoringsystems_deformationnetwork_deformationstation">andlt;DeformationStationandgt;</a> | andlt;TiltStrainInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;TiltStrainInstrument code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;depthandgt;...andlt;/depthandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;direction1andgt;...andlt;/direction1andgt;
	andlt;direction2andgt;...andlt;/direction2andgt;
	andlt;direction3andgt;...andlt;/direction3andgt;
	andlt;direction4andgt;...andlt;/direction4andgt;
	andlt;electroConv1andgt;...andlt;/electroConv1andgt;
	andlt;electroConv2andgt;...andlt;/electroConv2andgt;
	andlt;electroConv3andgt;...andlt;/electroConv3andgt;
	andlt;electroConv4andgt;...andlt;/electroConv4andgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/TiltStrainInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about each individual instrument and provides the necessary data to process raw tilt and strain data.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;depthandgt;
				<ul>
					<li>Description: The depth of instrument.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: The analog to digitizer resolution.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;direction1andgt;
				<ul>
					<li>Description: The azimuth of direction 1 (or x for tiltmeters) using geographic north in degrees from 0 to 360.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;direction2andgt;
				<ul>
					<li>Description: The azimuth of direction 2 (or y for tiltmeters) using geographic north in degrees from 0 to 360.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;direction3andgt;
				<ul>
					<li>Description: The azimuth of direction 3 using geographic north in degrees from 0 to 360.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;direction4andgt;
				<ul>
					<li>Description: The azimuth of direction 4 using geographic north in degrees from 0 to 360.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;electroConv1andgt;
				<ul>
					<li>Description: The electronic conversion (scale factor) for component 1. The tilt conversion will be from mV to microradians and the strain conversion should be from mV to microstrain.</li>
					<li>Type: float</li>
					<li>Unit: andmu;rad/mV or andmu;strain/mV</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;electroConv2andgt;
				<ul>
					<li>Description: The electronic conversion (scale factor) for component 2. The tilt conversion should be from mV to microradian conversion and the strain conversion should be from mV to microstrain.</li>
					<li>Type: float</li>
					<li>Unit: andmu;rad/mV or andmu;strain/mV</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;electroConv3andgt;
				<ul>
					<li>Description: The electronic conversion (scale factor) for component 3, if applicable. The tilt conversion should be from mV to microradian conversion and the strain conversion should be from mV to microstrain.</li>
					<li>Type: float</li>
					<li>Unit: andmu;rad/mV or andmu;strain/mV</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;electroConv4andgt;
				<ul>
					<li>Description: The electronic conversion (scale factor) for component 4, if applicable. The tilt conversion should be from mV to microradian conversion and the strain conversion should be from mV to microstrain.</li>
					<li>Type: float</li>
					<li>Unit: andmu;rad/mV or andmu;strain/mV</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The time this instrument information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the time this instrument information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The time this instrument information changed in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the time this instrument information changed.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Deformation stations -->
		<h2 class="wovomlclass"><a name="monitoringsystems_deformationstations" id="monitoringsystems_deformationstations"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;DeformationStationsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;DeformationStations network=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_deformationstation">andlt;DeformationStationandgt;...andlt;/DeformationStationandgt;</a>
<strong>andlt;/DeformationStationsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as a location, name, and description for stations where deformation or geodetic data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>network
				<ul>
					<li>Description: The code of the network to which these stations belong.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these stations.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these stations (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these stations (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;DeformationStationandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystemss_deformationstation">andlt;DeformationStationandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Deformation station -->
		<h2 class="wovomlclass"><a name="monitoringsystems_deformationstation" id="monitoringsystems_deformationstation"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_deformationstations">andlt;DeformationStationsandgt;</a> | andlt;DeformationStationandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;DeformationStation code=andquot;...andquot; network=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;permInstandgt;...andlt;/permInstandgt;
	andlt;latandgt;...andlt;/latandgt;
	andlt;lonandgt;...andlt;/lonandgt;
	andlt;elevandgt;...andlt;/elevandgt;
	andlt;horizPrecisionandgt;...andlt;/horizPrecisionandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	andlt;refStationandgt;...andlt;/refStationandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	<a href="#monitoringsystems_deformationstation_deformationinstrument">andlt;DeformationInstrumentandgt;...andlt;/DeformationInstrumentandgt;</a>
	<a href="#monitoringsystems_deformationstation_tiltstraininstrument">andlt;TiltStrainInstrumentandgt;...andlt;/TiltStrainInstrumentandgt;</a>
<strong>andlt;/DeformationStationandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as a location, name, and description for stations where deformation or geodetic data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>network
				<ul>
					<li>Description: The code of the network to which this station belongs.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this station.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the benchmark or station given by the observatory.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;permInstandgt;
				<ul>
					<li>Description: A list of any permanent instruments installed at this site.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latandgt; AND andlt;lonandgt;
				<ul>
					<li>Description: The latitude and longitude in decimal degrees.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevandgt;
				<ul>
					<li>Description: The nominal elevation of the station in meters.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;horizPrecisionandgt;
				<ul>
					<li>Description: The horizontal precision of nominal location for GPS.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the station was set up and activated or the time this new information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was set up and activated or the time this new information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: The time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;refStationandgt;
				<ul>
					<li>Description: A flag indicating that this station is used as a reference station.</li>
					<li>Type: Y, N <em>(Yes, No)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the station or any comments.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;DeformationInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_deformationstation_deformationinstrument">andlt;DeformationInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;TiltStrainInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_deformationstation_tiltstraininstrument">andlt;TiltStrainInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Deformation station - Deformation instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_deformationstation_deformationinstrument" id="monitoringsystems_deformationstation_deformationinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_deformationstations">andlt;DeformationStationsandgt;</a> | <a href="#monitoringsystems_deformationstation">andlt;DeformationStationandgt;</a> | andlt;DeformationInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;DeformationInstrument code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;signalToNoiseandgt;...andlt;/signalToNoiseandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/DeformationInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about each individual instrument along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this instrument.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument chosen from a standard set of instruments.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: Typical instrumental measuring precision.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;signalToNoiseandgt;
				<ul>
					<li>Description: An instrument specific signal to noise ratio.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this new information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this new information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument including anything unusual, for example, modifications.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Deformation station - Tilt/Strain instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_deformationstation_tiltstraininstrument" id="monitoringsystems_deformationstation_tiltstraininstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_deformationstations">andlt;DeformationStationsandgt;</a> | <a href="#monitoringsystems_deformationstation">andlt;DeformationStationandgt;</a> | andlt;TiltStrainInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;TiltStrainInstrument code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;depthandgt;...andlt;/depthandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;direction1andgt;...andlt;/direction1andgt;
	andlt;direction2andgt;...andlt;/direction2andgt;
	andlt;direction3andgt;...andlt;/direction3andgt;
	andlt;direction4andgt;...andlt;/direction4andgt;
	andlt;electroConv1andgt;...andlt;/electroConv1andgt;
	andlt;electroConv2andgt;...andlt;/electroConv2andgt;
	andlt;electroConv3andgt;...andlt;/electroConv3andgt;
	andlt;electroConv4andgt;...andlt;/electroConv4andgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/TiltStrainInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about each individual instrument and provides the necessary data to process raw tilt and strain data.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this instrument.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;depthandgt;
				<ul>
					<li>Description: The depth of instrument.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: The analog to digitizer resolution.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;direction1andgt;
				<ul>
					<li>Description: The azimuth of direction 1 (or x for tiltmeters) using geographic north in degrees from 0 to 360.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;direction2andgt;
				<ul>
					<li>Description: The azimuth of direction 2 (or y for tiltmeters) using geographic north in degrees from 0 to 360.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;direction3andgt;
				<ul>
					<li>Description: The azimuth of direction 3 using geographic north in degrees from 0 to 360.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;direction4andgt;
				<ul>
					<li>Description: The azimuth of direction 4 using geographic north in degrees from 0 to 360.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;electroConv1andgt;
				<ul>
					<li>Description: The electronic conversion (scale factor) for component 1. The tilt conversion will be from mV to microradians and the strain conversion should be from mV to microstrain.</li>
					<li>Type: float</li>
					<li>Unit: andmu;rad/mV or andmu;strain/mV</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;electroConv2andgt;
				<ul>
					<li>Description: The electronic conversion (scale factor) for component 2. The tilt conversion should be from mV to microradian conversion and the strain conversion should be from mV to microstrain.</li>
					<li>Type: float</li>
					<li>Unit: andmu;rad/mV or andmu;strain/mV</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;electroConv3andgt;
				<ul>
					<li>Description: The electronic conversion (scale factor) for component 3, if applicable. The tilt conversion should be from mV to microradian conversion and the strain conversion should be from mV to microstrain.</li>
					<li>Type: float</li>
					<li>Unit: andmu;rad/mV or andmu;strain/mV</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;electroConv4andgt;
				<ul>
					<li>Description: The electronic conversion (scale factor) for component 4, if applicable. The tilt conversion should be from mV to microradian conversion and the strain conversion should be from mV to microstrain.</li>
					<li>Type: float</li>
					<li>Unit: andmu;rad/mV or andmu;strain/mV</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The time this instrument information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the time this instrument information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The time this instrument information changed in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the time this instrument information changed.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Deformation instruments -->
		<h2 class="wovomlclass"><a name="monitoringsystems_deformationinstruments" id="monitoringsystems_deformationinstruments"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;DeformationInstrumentsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;DeformationInstruments station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_deformationinstrument">andlt;DeformationInstrumentandgt;...andlt;/DeformationInstrumentandgt;</a>
<strong>andlt;/DeformationInstrumentsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about each individual instrument along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>station
				<ul>
					<li>Description: The code of the station to which these instruments belong.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these instruments.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these instruments (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these instruments (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;DeformationInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_deformationinstrument">andlt;DeformationInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Deformation instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_deformationinstrument" id="monitoringsystems_deformationinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_deformationinstruments">andlt;DeformationInstrumentsandgt;</a> | andlt;DeformationInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;DeformationInstrument code=andquot;...andquot; station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;signalToNoiseandgt;...andlt;/signalToNoiseandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/DeformationInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about each individual instrument along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station to which this instrument belongs.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument chosen from a standard set of instruments.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: Typical instrumental measuring precision.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;signalToNoiseandgt;
				<ul>
					<li>Description: An instrument specific signal to noise ratio.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this new information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this new information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument including anything unusual, for example, modifications.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Tilt/Strain instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_tiltstraininstrument" id="monitoringsystems_tiltstraininstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_deformationinstruments">andlt;DeformationInstrumentsandgt;</a> | andlt;TiltStrainInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;TiltStrainInstrument code=andquot;...andquot; station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;depthandgt;...andlt;/depthandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;direction1andgt;...andlt;/direction1andgt;
	andlt;direction2andgt;...andlt;/direction2andgt;
	andlt;direction3andgt;...andlt;/direction3andgt;
	andlt;direction4andgt;...andlt;/direction4andgt;
	andlt;electroConv1andgt;...andlt;/electroConv1andgt;
	andlt;electroConv2andgt;...andlt;/electroConv2andgt;
	andlt;electroConv3andgt;...andlt;/electroConv3andgt;
	andlt;electroConv4andgt;...andlt;/electroConv4andgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/TiltStrainInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about each individual instrument and provides the necessary data to process raw tilt and strain data.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station to which this instrument belongs.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;depthandgt;
				<ul>
					<li>Description: The depth of instrument.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: The analog to digitizer resolution.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;direction1andgt;
				<ul>
					<li>Description: The azimuth of direction 1 (or x for tiltmeters) using geographic north in degrees from 0 to 360.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;direction2andgt;
				<ul>
					<li>Description: The azimuth of direction 2 (or y for tiltmeters) using geographic north in degrees from 0 to 360.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;direction3andgt;
				<ul>
					<li>Description: The azimuth of direction 3 using geographic north in degrees from 0 to 360.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;direction4andgt;
				<ul>
					<li>Description: The azimuth of direction 4 using geographic north in degrees from 0 to 360.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;electroConv1andgt;
				<ul>
					<li>Description: The electronic conversion (scale factor) for component 1. The tilt conversion will be from mV to microradians and the strain conversion should be from mV to microstrain.</li>
					<li>Type: float</li>
					<li>Unit: andmu;rad/mV or andmu;strain/mV</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;electroConv2andgt;
				<ul>
					<li>Description: The electronic conversion (scale factor) for component 2. The tilt conversion should be from mV to microradian conversion and the strain conversion should be from mV to microstrain.</li>
					<li>Type: float</li>
					<li>Unit: andmu;rad/mV or andmu;strain/mV</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;electroConv3andgt;
				<ul>
					<li>Description: The electronic conversion (scale factor) for component 3, if applicable. The tilt conversion should be from mV to microradian conversion and the strain conversion should be from mV to microstrain.</li>
					<li>Type: float</li>
					<li>Unit: andmu;rad/mV or andmu;strain/mV</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;electroConv4andgt;
				<ul>
					<li>Description: The electronic conversion (scale factor) for component 4, if applicable. The tilt conversion should be from mV to microradian conversion and the strain conversion should be from mV to microstrain.</li>
					<li>Type: float</li>
					<li>Unit: andmu;rad/mV or andmu;strain/mV</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The time this instrument information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the time this instrument information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The time this instrument information changed in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the time this instrument information changed.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Gas network -->
		<h2 class="wovomlclass"><a name="monitoringsystems_gasnetwork" id="monitoringsystems_gasnetwork"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;GasNetworkandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;GasNetwork code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_gasnetwork_volcanoes">andlt;Volcanoesandgt;...andlt;/Volcanoesandgt;</a>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;areaandgt;...andlt;/areaandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	<a href="#monitoringsystems_gasnetwork_gasstation">andlt;GasStationandgt;...andlt;/GasStationandgt;</a>
<strong>andlt;/GasNetworkandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the network of stations that collect gas data at a particular site, in general at one volcano.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this network.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this network (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this network (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;Volcanoesandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_gasnetwork_volcanoes">andlt;Volcanoesandgt;</a>.</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the network.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;areaandgt;
				<ul>
					<li>Description: The volcano and approximate area in km<sup>2</sup> covered by the network.</li>
					<li>Type: float</li>
					<li>Unit: km<sup>2</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the network including permanent stations and types of instruments.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the network was set up and activated in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the network was set up and activated.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date the network was permanently decommissioned or the time this set of information became invalid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the network was permanently decommissioned or the time this set of information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: Time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about the network including minor updates to the network over time and future plans.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the person responsible for the station.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Gas network - Volcanoes -->
		<h2 class="wovomlclass"><a name="monitoringsystems_gasnetwork_volcanoes" id="monitoringsystems_gasnetwork_volcanoes"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_gasnetwork">andlt;GasNetworkandgt;</a> | andlt;Volcanoesandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Volcanoesandgt;</strong>
	andlt;volcanoCodeandgt;...andlt;/volcanoCodeandgt;
<strong>andlt;/Volcanoesandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains a list of volcano codes.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;volcanoCodeandgt;
				<ul>
					<li>Description: The CAVW number of a volcano in WOVOdat.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Gas network - Gas station -->
		<h2 class="wovomlclass"><a name="monitoringsystems_gasnetwork_gasstation" id="monitoringsystems_gasnetwork_gasstation"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_gasnetwork">andlt;GasNetworkandgt;</a> | andlt;GasStationandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;GasStation code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;permInstandgt;...andlt;/permInstandgt;
	andlt;latandgt;...andlt;/latandgt;
	andlt;lonandgt;...andlt;/lonandgt;
	andlt;elevandgt;...andlt;/elevandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	<a href="#monitoringsystems_gasnetwork_gasstation_gasinstrument">andlt;GasInstrumentandgt;...andlt;/GasInstrumentandgt;</a>
<strong>andlt;/GasStationandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as a location, type of gas body monitored, and a description of the stations where gas data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this station.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of gas body found at the station, for example fumarole or diffuse soil degassing or if the station is used to collect remote plume data.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;permInstandgt;
				<ul>
					<li>Description: A list of permanent instruments, if applicable, installed at this site.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latandgt; AND andlt;lonandgt;
				<ul>
					<li>Description: The latitude and longitude in decimal degrees.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevandgt;
				<ul>
					<li>Description: The elevation of the land surface in meters above sea level.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the station was set up and activated or the time this new information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was set up and activated or the time this new information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: The time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the station and any comments.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;GasInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_gasnetwork_gasstation_gasinstrument">andlt;GasInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Gas network - Gas station - Gas instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_gasnetwork_gasstation_gasinstrument" id="monitoringsystems_gasnetwork_gasstation_gasinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_gasnetwork">andlt;GasNetworkandgt;</a> | <a href="#monitoringsystems_gasnetwork_gasstation">andlt;GasStationandgt;</a> | andlt;GasInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;GasInstrument code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;signalToNoiseandgt;...andlt;/signalToNoiseandgt;
	andlt;calibrationandgt;...andlt;/calibrationandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/GasInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the instruments used to collect ground-based and remote gas data along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this instrument.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: Typical instrumental measuring precision.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;signalToNoiseandgt;
				<ul>
					<li>Description: An instrument specific signal to noise ratio.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;calibrationandgt;
				<ul>
					<li>Description: The calibration method.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Gas stations -->
		<h2 class="wovomlclass"><a name="monitoringsystems_gasstations" id="monitoringsystems_gasstations"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;GasStationsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;GasStations network=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_gasstation">andlt;GasStationandgt;...andlt;/GasStationandgt;</a>
<strong>andlt;/GasStationsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as a location, type of gas body monitored, and a description of the stations where gas data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>network
				<ul>
					<li>Description: The code of the network to which these stations belong.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these stations.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these stations (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these stations (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;GasStationandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystemss_gasstation">andlt;GasStationandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Gas station -->
		<h2 class="wovomlclass"><a name="monitoringsystems_gasstation" id="monitoringsystems_gasstation"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_gasstations">andlt;GasStationsandgt;</a> | andlt;GasStationandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;GasStation code=andquot;...andquot; network=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;networkCodeandgt;...andlt;/networkCodeandgt;
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;permInstandgt;...andlt;/permInstandgt;
	andlt;latandgt;...andlt;/latandgt;
	andlt;lonandgt;...andlt;/lonandgt;
	andlt;elevandgt;...andlt;/elevandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	<a href="#monitoringsystems_gasstation_gasinstrument">andlt;GasInstrumentandgt;...andlt;/GasInstrumentandgt;</a>
<strong>andlt;/GasStationandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as a location, type of gas body monitored, and a description of the stations where gas data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>network
				<ul>
					<li>Description: The code of the network to which this station belongs.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this station.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of gas body found at the station, for example fumarole or diffuse soil degassing or if the station is used to collect remote plume data.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;permInstandgt;
				<ul>
					<li>Description: A list of permanent instruments, if applicable, installed at this site.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latandgt; AND andlt;lonandgt;
				<ul>
					<li>Description: The latitude and longitude in decimal degrees.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevandgt;
				<ul>
					<li>Description: The elevation of the land surface in meters above sea level.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the station was set up and activated or the time this new information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was set up and activated or the time this new information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: The time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the station and any comments.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;GasInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_gasstation_gasinstrument">andlt;GasInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Gas station - Gas instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_gasstation_gasinstrument" id="monitoringsystems_gasstation_gasinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_gasstations">andlt;GasStationsandgt;</a> | <a href="#monitoringsystems_gasnetwork_gasstation">andlt;GasStationandgt;</a> | andlt;GasInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;GasInstrument code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;signalToNoiseandgt;...andlt;/signalToNoiseandgt;
	andlt;calibrationandgt;...andlt;/calibrationandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/GasInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the instruments used to collect ground-based and remote gas data along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this instrument.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: Typical instrumental measuring precision.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;signalToNoiseandgt;
				<ul>
					<li>Description: An instrument specific signal to noise ratio.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;calibrationandgt;
				<ul>
					<li>Description: The calibration method.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Gas instruments -->
		<h2 class="wovomlclass"><a name="monitoringsystems_gasinstruments" id="monitoringsystems_gasinstruments"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;GasInstrumentsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;GasInstruments station=andquot;...andquot; airplane=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_gasinstrument">andlt;GasInstrumentandgt;...andlt;/GasInstrumentandgt;</a>
<strong>andlt;/GasInstrumentsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the instruments used to collect ground-based and remote gas data along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>station
				<ul>
					<li>Description: The code of the station where these instruments are installed.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>airplane
				<ul>
					<li>Description: The code of the airplane where these instruments are installed.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these instruments.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these instruments (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these instruments (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;GasInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_gasinstrument">andlt;GasInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Gas instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_gasinstrument" id="monitoringsystems_gasinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_gasinstruments">andlt;GasInstrumentsandgt;</a> | andlt;GasInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;GasInstrument code=andquot;...andquot; station=andquot;...andquot; airplane=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;signalToNoiseandgt;...andlt;/signalToNoiseandgt;
	andlt;calibrationandgt;...andlt;/calibrationandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/GasInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the instruments used to collect ground-based and remote gas data along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where this instrument is installed.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>airplane
				<ul>
					<li>Description: The code of the airplane where this instrument is installed.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this instrument.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: Typical instrumental measuring precision.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;signalToNoiseandgt;
				<ul>
					<li>Description: An instrument specific signal to noise ratio.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;calibrationandgt;
				<ul>
					<li>Description: The calibration method.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Hydrologic network -->
		<h2 class="wovomlclass"><a name="monitoringsystems_hydrologicnetwork" id="monitoringsystems_hydrologicnetwork"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;HydrologicNetworkandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;HydrologicNetwork code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_hydrologicnetwork_volcanoes">andlt;Volcanoesandgt;...andlt;/Volcanoesandgt;</a>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;areaandgt;...andlt;/areaandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	<a href="#monitoringsystems_hydrologicnetwork_hydrologicstation">andlt;HydrologicStationandgt;...andlt;/HydrologicStationandgt;</a>
<strong>andlt;/HydrologicNetworkandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the network of stations that collect hydrologic data at a particular site, in general at one volcano.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this network.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this network (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this network (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;Volcanoesandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_hydrologicnetwork_volcanoes">andlt;Volcanoesandgt;</a>.</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the network.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;areaandgt;
				<ul>
					<li>Description: The volcano and approximate area in km<sup>2</sup> covered by the network.</li>
					<li>Type: float</li>
					<li>Unit: km<sup>2</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the network including permanent stations and types of instruments.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the network was set up and activated in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the network was set up and activated.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date the network was permanently decommissioned or the time this set of information became invalid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the network was permanently decommissioned or the time this set of information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: Time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about the network including minor updates to the network over time and future plans.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;HydrologicStationandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_hydrologicnetwork_hydrologicstation">andlt;HydrologicStationandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Hydrologic network - Volcanoes -->
		<h2 class="wovomlclass"><a name="monitoringsystems_hydrologicnetwork_volcanoes" id="monitoringsystems_hydrologicnetwork_volcanoes"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_hydrologicnetwork">andlt;HydrologicNetworkandgt;</a> | andlt;Volcanoesandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Volcanoesandgt;</strong>
	andlt;volcanoCodeandgt;...andlt;/volcanoCodeandgt;
<strong>andlt;/Volcanoesandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains a list of volcano codes.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;volcanoCodeandgt;
				<ul>
					<li>Description: The CAVW number of a volcano.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Hydrologic network - Hydrologic station -->
		<h2 class="wovomlclass"><a name="monitoringsystems_hydrologicnetwork_hydrologicstation" id="monitoringsystems_hydrologicnetwork_hydrologicstation"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_hydrologicnetwork">andlt;HydrologicNetworkandgt;</a> | andlt;HydrologicStationandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;HydrologicStation code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;waterBodyTypeandgt;...andlt;/waterBodyTypeandgt;
	andlt;permInstandgt;...andlt;/permInstandgt;
	andlt;screenTopandgt;...andlt;/screenTopandgt;
	andlt;screenBottomandgt;...andlt;/screenBottomandgt;
	andlt;wellDepthandgt;...andlt;/wellDepthandgt;
	andlt;latandgt;...andlt;/latandgt;
	andlt;lonandgt;...andlt;/lonandgt;
	andlt;elevandgt;...andlt;/elevandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	<a href="#monitoringsystems_hydrologicnetwork_hydrologicstation_hydrologicinstrument">andlt;HydrologicInstrumentandgt;...andlt;/HydrologicInstrumentandgt;</a>
<strong>andlt;/HydrologicStationandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as location, type of water body, and descriptions for stations where hydrologic data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this station.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name or code of the station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;waterBodyTypeandgt;
				<ul>
					<li>Description: The type of water body (well, lake, spring, etc.).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;permInstandgt;
				<ul>
					<li>Description: A list of permanent instruments, if applicable, installed at this site.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;screenTopandgt;
				<ul>
					<li>Description: The top of the interval open to inflow in meters below the surface.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;screenBottomandgt;
				<ul>
					<li>Description: The bottom of the interval open to inflow in meters below the surface.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;wellDepthandgt;
				<ul>
					<li>Description: The total depth of well in meters below the surface.</li>
					<li>Type: double</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latandgt; AND andlt;lonandgt;
				<ul>
					<li>Description: The latitude and longitude in decimal degrees.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevandgt;
				<ul>
					<li>Description: The elevation of the land surface in meters.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the station was set up and activated or the time this new information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was set up and activated or the time this new information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: The time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the station, please include information about environmental factors, e.g., nearby pumping, ocean tides, or anything else that might affect the water measurements.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;HydrologicInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_hydrologicnetwork_hydrologicstation_hydrologicinstrument">andlt;HydrologicInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Hydrologic network - Hydrologic station - Hydrologic instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_hydrologicnetwork_hydrologicstation_hydrologicinstrument" id="monitoringsystems_hydrologicnetwork_hydrologicstation_hydrologicinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_hydrologicnetwork">andlt;HydrologicNetworkandgt;</a> | <a href="#monitoringsystems_hydrologicnetwork_hydrologicstation">andlt;HydrologicStationandgt;</a> | andlt;HydrologicInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;HydrologicInstrument code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;pressureMeasTypeandgt;...andlt;/pressureMeasTypeandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/HydrologicInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about each individual hydrologic instrument along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this instrument.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the instrument including the model and manufacturer.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;pressureMeasTypeandgt;
				<ul>
					<li>Description: A single character (A or V) to know whether the pressure transducer measurement is absolute (non-vented) or vented (gauge).</li>
					<li>Type: A, V <em>(Absolute, Vented)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument (float, pressure transducer, bubbler, rain gage, barometer, flow meter, pH or conductivity meter).</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: The measurement resolution or precision.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: A description of or comments about the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Hydrologic stations -->
		<h2 class="wovomlclass"><a name="monitoringsystems_hydrologicstations" id="monitoringsystems_hydrologicstations"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;HydrologicStationsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;HydrologicStations network=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_hydrologicstation">andlt;HydrologicStationandgt;...andlt;/HydrologicStationandgt;</a>
<strong>andlt;/HydrologicStationsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as location, type of water body, and descriptions for stations where hydrologic data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>network
				<ul>
					<li>Description: The code of the network to which these stations belong.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these stations.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these stations (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these stations (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;HydrologicStationandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystemss_hydrologicstation">andlt;HydrologicStationandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Hydrologic station -->
		<h2 class="wovomlclass"><a name="monitoringsystems_hydrologicstation" id="monitoringsystems_hydrologicstation"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_hydrologicstations">andlt;HydrologicStationsandgt;</a> | andlt;HydrologicStationandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;HydrologicStation code=andquot;...andquot; network=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;waterBodyTypeandgt;...andlt;/waterBodyTypeandgt;
	andlt;permInstandgt;...andlt;/permInstandgt;
	andlt;screenTopandgt;...andlt;/screenTopandgt;
	andlt;screenBottomandgt;...andlt;/screenBottomandgt;
	andlt;wellDepthandgt;...andlt;/wellDepthandgt;
	andlt;latandgt;...andlt;/latandgt;
	andlt;lonandgt;...andlt;/lonandgt;
	andlt;elevandgt;...andlt;/elevandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	<a href="#monitoringsystems_hydrologicstation_hydrologicinstrument">andlt;HydrologicInstrumentandgt;...andlt;/HydrologicInstrumentandgt;</a>
<strong>andlt;/HydrologicStationandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as location, type of water body, and descriptions for stations where hydrologic data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>network
				<ul>
					<li>Description: The code of the network to which this station belongs.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this station.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name or code of the station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;waterBodyTypeandgt;
				<ul>
					<li>Description: The type of water body (well, lake, spring, etc.).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;permInstandgt;
				<ul>
					<li>Description: A list of permanent instruments, if applicable, installed at this site.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;screenTopandgt;
				<ul>
					<li>Description: The top of the interval open to inflow in meters below the surface.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;screenBottomandgt;
				<ul>
					<li>Description: The bottom of the interval open to inflow in meters below the surface.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;wellDepthandgt;
				<ul>
					<li>Description: The total depth of well in meters below the surface.</li>
					<li>Type: double</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latandgt; AND andlt;lonandgt;
				<ul>
					<li>Description: The latitude and longitude in decimal degrees.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevandgt;
				<ul>
					<li>Description: The elevation of the land surface in meters.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the station was set up and activated or the time this new information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was set up and activated or the time this new information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: The time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the station, please include information about environmental factors, e.g., nearby pumping, ocean tides, or anything else that might affect the water measurements.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;HydrologicInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_hydrologicstation_hydrologicinstrument">andlt;HydrologicInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Hydrologic station - Hydrologic instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_hydrologicstation_hydrologicinstrument" id="monitoringsystems_hydrologicstation_hydrologicinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_hydrologicstations">andlt;HydrologicStationsandgt;</a> | <a href="#monitoringsystems_hydrologicstation">andlt;HydrologicStationandgt;</a> | andlt;HydrologicInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;HydrologicInstrument code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;pressureMeasTypeandgt;...andlt;/pressureMeasTypeandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/HydrologicInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about each individual hydrologic instrument along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this instrument.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the instrument including the model and manufacturer.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;pressureMeasTypeandgt;
				<ul>
					<li>Description: A single character (A or V) to know whether the pressure transducer measurement is absolute (non-vented) or vented (gauge).</li>
					<li>Type: A, V <em>(Absolute, Vented)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument (float, pressure transducer, bubbler, rain gage, barometer, flow meter, pH or conductivity meter).</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: The measurement resolution or precision.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: A description of or comments about the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Hydrologic instruments -->
		<h2 class="wovomlclass"><a name="monitoringsystems_hydrologicinstruments" id="monitoringsystems_hydrologicinstruments"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;HydrologicInstrumentsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;HydrologicInstruments station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_hydrologicinstrument">andlt;HydrologicInstrumentandgt;...andlt;/HydrologicInstrumentandgt;</a>
<strong>andlt;/HydrologicInstrumentsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about each individual hydrologic instrument along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>station
				<ul>
					<li>Description: The code of the station to which these instruments belong.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these instruments.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these instruments (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these instruments (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;HydrologicInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_hydrologicinstrument">andlt;HydrologicInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Hydrologic instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_hydrologicinstrument" id="monitoringsystems_hydrologicinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_hydrologicinstruments">andlt;HydrologicInstrumentsandgt;</a> | andlt;HydrologicInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;HydrologicInstrument code=andquot;...andquot; station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;pressureMeasTypeandgt;...andlt;/pressureMeasTypeandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/HydrologicInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about each individual hydrologic instrument along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where this instrument is installed.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this instrument.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the instrument including the model and manufacturer.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;pressureMeasTypeandgt;
				<ul>
					<li>Description: A single character (A or V) to know whether the pressure transducer measurement is absolute (non-vented) or vented (gauge).</li>
					<li>Type: A, V <em>(Absolute, Vented)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument (float, pressure transducer, bubbler, rain gage, barometer, flow meter, pH or conductivity meter).</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: The measurement resolution or precision.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: A description of or comments about the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Fields network -->
		<h2 class="wovomlclass"><a name="monitoringsystems_fieldsnetwork" id="monitoringsystems_fieldsnetwork"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;FieldsNetworkandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;FieldsNetwork code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_fieldsnetwork_volcanoes">andlt;Volcanoesandgt;...andlt;/Volcanoesandgt;</a>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;areaandgt;...andlt;/areaandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	<a href="#monitoringsystems_fieldsnetwork_fieldsstation">andlt;FieldsStationandgt;...andlt;/FieldsStationandgt;</a>
<strong>andlt;/FieldsNetworkandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the network of stations that collect fields data at a particular site, in general at one volcano.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this network.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this network (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this network (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;Volcanoesandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_fieldsnetwork_volcanoes">andlt;Volcanoesandgt;</a>.</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the network.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;areaandgt;
				<ul>
					<li>Description: The volcano and approximate area in km<sup>2</sup> covered by the network.</li>
					<li>Type: float</li>
					<li>Unit: km<sup>2</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the network including permanent stations and types of instruments.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the network was set up and activated in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the network was set up and activated.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date the network was permanently decommissioned or the time this set of information became invalid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the network was permanently decommissioned or the time this set of information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: Time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about the network including minor updates to the network over time and future plans.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;FieldsStationandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_fieldsnetwork_fieldsstation">andlt;FieldsStationandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Fields network - Volcanoes -->
		<h2 class="wovomlclass"><a name="monitoringsystems_fieldsnetwork_volcanoes" id="monitoringsystems_fieldsnetwork_volcanoes"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_fieldsnetwork">andlt;FieldsNetworkandgt;</a> | andlt;Volcanoesandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Volcanoesandgt;</strong>
	andlt;volcanoCodeandgt;...andlt;/volcanoCodeandgt;
<strong>andlt;/Volcanoesandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains a list of volcano codes.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;volcanoCodeandgt;
				<ul>
					<li>Description: The CAVW number of a volcano.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Fields network - Fields station -->
		<h2 class="wovomlclass"><a name="monitoringsystems_fieldsnetwork_fieldsstation" id="monitoringsystems_fieldsnetwork_fieldsstation"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_fieldsnetwork">andlt;FieldsNetworkandgt;</a> | andlt;FieldsStationandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;FieldsStation code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;permInstandgt;...andlt;/permInstandgt;
	andlt;latandgt;...andlt;/latandgt;
	andlt;lonandgt;...andlt;/lonandgt;
	andlt;elevandgt;...andlt;/elevandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	<a href="#monitoringsystems_fieldsnetwork_fieldsstation_fieldsinstrument">andlt;FieldsInstrumentandgt;...andlt;/FieldsInstrumentandgt;</a>
<strong>andlt;/FieldsStationandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as a location, conversion from local time to UTC, and a description of the stations where fields data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this station.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the benchmark or station given by the observatory.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;permInstandgt;
				<ul>
					<li>Description: A list of permanent instruments, if applicable, installed at this site.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latandgt; AND andlt;lonandgt;
				<ul>
					<li>Description: The latitude and longitude in decimal degrees.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevandgt;
				<ul>
					<li>Description: The elevation of the land surface in meters.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the station was set up and activated or the time this new information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was set up and activated or the time this new information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: The time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the station or any comments.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;FieldsInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_fieldsnetwork_fieldsstation_fieldsinstrument">andlt;FieldsInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Fields network - Fields station - Fields instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_fieldsnetwork_fieldsstation_fieldsinstrument" id="monitoringsystems_fieldsnetwork_fieldsstation_fieldsinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_fieldsnetwork">andlt;FieldsNetworkandgt;</a> | <a href="#monitoringsystems_fieldsnetwork_fieldsstation">andlt;FieldsStationandgt;</a> | andlt;FieldsInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;FieldsInstrument code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;permanentandgt;...andlt;/permanentandgt;
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;sampleRateandgt;...andlt;/sampleRateandgt;
	andlt;filterTypeandgt;...andlt;/filterTypeandgt;
	andlt;orientationandgt;...andlt;/orientationandgt;
	andlt;calculationandgt;...andlt;/calculationandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/FieldsInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the instruments used to collect magnetic, electric, and gravity data along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this instrument.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;permanentandgt;
				<ul>
					<li>Description: A single character field to know if the instrument is part of a permanent installation (use P for permanent) or part of a campaign (use C for campaign).</li>
					<li>Type: P, C <em>(Permanent, Campaign)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument or instrument package, for example magnetometers may consist of one instrument for gathering vectorial data and another for total intensity of the field.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument(s) and the units each instrument measures.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: The resolution of each individual instrument in the instrument package. Please give the instrument name and then the resolution.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;sampleRateandgt;
				<ul>
					<li>Description: The sampling rate for the instrument(s).</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;filterTypeandgt;
				<ul>
					<li>Description: The filter type, if applicable.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;orientationandgt;
				<ul>
					<li>Description: The orientation of the instrument, if applicable (for permanent stations only).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;calculationandgt;
				<ul>
					<li>Description: Any processing used to convert and clean or correct the raw data collected by this instrument to the data stored in the fields data tables. Please note corrections made for atmospheric conditions, ground deformation, noise, thermal stability, and/or long term instability of the instrument(s).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument(s).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Fields stations -->
		<h2 class="wovomlclass"><a name="monitoringsystems_fieldsstations" id="monitoringsystems_fieldsstations"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;FieldsStationsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;FieldsStations network=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_fieldsstation">andlt;FieldsStationandgt;...andlt;/FieldsStationandgt;</a>
<strong>andlt;/FieldsStationsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as a location, conversion from local time to UTC, and a description of the stations where fields data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>network
				<ul>
					<li>Description: The code of the network to which these stations belong.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these stations.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these stations (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these stations (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;FieldsStationandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystemss_fieldsstation">andlt;FieldsStationandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Fields station -->
		<h2 class="wovomlclass"><a name="monitoringsystems_fieldsstation" id="monitoringsystems_fieldsstation"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_fieldsstations">andlt;FieldsStationsandgt;</a> | andlt;FieldsStationandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;FieldsStation code=andquot;...andquot; network=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;permInstandgt;...andlt;/permInstandgt;
	andlt;latandgt;...andlt;/latandgt;
	andlt;lonandgt;...andlt;/lonandgt;
	andlt;elevandgt;...andlt;/elevandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	<a href="#monitoringsystems_fieldsstation_fieldsinstrument">andlt;FieldsInstrumentandgt;...andlt;/FieldsInstrumentandgt;</a>
<strong>andlt;/FieldsStationandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as a location, conversion from local time to UTC, and a description of the stations where fields data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>network
				<ul>
					<li>Description: The code of the network to which this station belongs.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this station.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the benchmark or station given by the observatory.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;permInstandgt;
				<ul>
					<li>Description: A list of permanent instruments, if applicable, installed at this site.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latandgt; AND andlt;lonandgt;
				<ul>
					<li>Description: The latitude and longitude in decimal degrees.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevandgt;
				<ul>
					<li>Description: The elevation of the land surface in meters.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the station was set up and activated or the time this new information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was set up and activated or the time this new information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: The time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the station or any comments.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;FieldsInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_fieldsstation_fieldsinstrument">andlt;FieldsInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Fields station - Fields instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_fieldsstation_fieldsinstrument" id="monitoringsystems_fieldsstation_fieldsinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_fieldsstations">andlt;FieldsStationsandgt;</a> | <a href="#monitoringsystems_fieldsnetwork_fieldsstation">andlt;FieldsStationandgt;</a> | andlt;FieldsInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;FieldsInstrument code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;sampleRateandgt;...andlt;/sampleRateandgt;
	andlt;filterTypeandgt;...andlt;/filterTypeandgt;
	andlt;orientationandgt;...andlt;/orientationandgt;
	andlt;calculationandgt;...andlt;/calculationandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/FieldsInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the instruments used to collect magnetic, electric, and gravity data along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this instrument.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument or instrument package, for example magnetometers may consist of one instrument for gathering vectorial data and another for total intensity of the field.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument(s) and the units each instrument measures.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: The resolution of each individual instrument in the instrument package. Please give the instrument name and then the resolution.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;sampleRateandgt;
				<ul>
					<li>Description: The sampling rate for the instrument(s).</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;filterTypeandgt;
				<ul>
					<li>Description: The filter type, if applicable.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;orientationandgt;
				<ul>
					<li>Description: The orientation of the instrument, if applicable (for permanent stations only).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;calculationandgt;
				<ul>
					<li>Description: Any processing used to convert and clean or correct the raw data collected by this instrument to the data stored in the fields data tables. Please note corrections made for atmospheric conditions, ground deformation, noise, thermal stability, and/or long term instability of the instrument(s).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument(s).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Fields instruments -->
		<h2 class="wovomlclass"><a name="monitoringsystems_fieldsinstruments" id="monitoringsystems_fieldsinstruments"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;FieldsInstrumentsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;FieldsInstruments station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_fieldsinstrument">andlt;FieldsInstrumentandgt;...andlt;/FieldsInstrumentandgt;</a>
<strong>andlt;/FieldsInstrumentsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the instruments used to collect magnetic, electric, and gravity data along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>station
				<ul>
					<li>Description: The code of the station to which these instruments belong.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these instruments.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these instruments (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these instruments (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;FieldsInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_fieldsinstrument">andlt;FieldsInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Fields instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_fieldsinstrument" id="monitoringsystems_fieldsinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_fieldsinstruments">andlt;FieldsInstrumentsandgt;</a> | andlt;FieldsInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;FieldsInstrument code=andquot;...andquot; station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;sampleRateandgt;...andlt;/sampleRateandgt;
	andlt;filterTypeandgt;...andlt;/filterTypeandgt;
	andlt;orientationandgt;...andlt;/orientationandgt;
	andlt;calculationandgt;...andlt;/calculationandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/FieldsInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the instruments used to collect magnetic, electric, and gravity data along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where this instrument is installed.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this instrument.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument or instrument package, for example magnetometers may consist of one instrument for gathering vectorial data and another for total intensity of the field.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument(s) and the units each instrument measures.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: The resolution of each individual instrument in the instrument package. Please give the instrument name and then the resolution.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;sampleRateandgt;
				<ul>
					<li>Description: The sampling rate for the instrument(s).</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;filterTypeandgt;
				<ul>
					<li>Description: The filter type, if applicable.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;orientationandgt;
				<ul>
					<li>Description: The orientation of the instrument, if applicable (for permanent stations only).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;calculationandgt;
				<ul>
					<li>Description: Any processing used to convert and clean or correct the raw data collected by this instrument to the data stored in the fields data tables. Please note corrections made for atmospheric conditions, ground deformation, noise, thermal stability, and/or long term instability of the instrument(s).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument(s).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Thermal network -->
		<h2 class="wovomlclass"><a name="monitoringsystems_thermalnetwork" id="monitoringsystems_thermalnetwork"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;ThermalNetworkandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;ThermalNetwork code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_thermalnetwork_volcanoes">andlt;Volcanoesandgt;...andlt;/Volcanoesandgt;</a>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;areaandgt;...andlt;/areaandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	<a href="#monitoringsystems_thermalnetwork_thermalstation">andlt;ThermalStationandgt;...andlt;/ThermalStationandgt;</a>
<strong>andlt;/ThermalNetworkandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the network of stations that collect thermal data at a particular site, in general at one volcano.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this network.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this network (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this network (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;Volcanoesandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_thermalnetwork_volcanoes">andlt;Volcanoesandgt;</a>.</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the network.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;areaandgt;
				<ul>
					<li>Description: The volcano and approximate area in km<sup>2</sup> covered by the network.</li>
					<li>Type: float</li>
					<li>Unit: km<sup>2</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the network including permanent stations and types of instruments.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the network was set up and activated in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the network was set up and activated.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date the network was permanently decommissioned or the time this set of information became invalid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the network was permanently decommissioned or the time this set of information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: Time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about the network including minor updates to the network over time and future plans.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ThermalStationandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_thermalnetwork_thermalstation">andlt;ThermalStationandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Thermal network - Volcanoes -->
		<h2 class="wovomlclass"><a name="monitoringsystems_thermalnetwork_volcanoes" id="monitoringsystems_thermalnetwork_volcanoes"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_thermalnetwork">andlt;ThermalNetworkandgt;</a> | andlt;Volcanoesandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Volcanoesandgt;</strong>
	andlt;volcanoCodeandgt;...andlt;/volcanoCodeandgt;
<strong>andlt;/Volcanoesandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains a list of volcano codes.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;volcanoCodeandgt;
				<ul>
					<li>Description: The CAVW number of a volcano.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Thermal network - Thermal station -->
		<h2 class="wovomlclass"><a name="monitoringsystems_thermalnetwork_thermalstation" id="monitoringsystems_thermalnetwork_thermalstation"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_thermalnetwork">andlt;ThermalNetworkandgt;</a> | andlt;ThermalStationandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;ThermalStation code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;thermalFeatTypeandgt;...andlt;/thermalFeatTypeandgt;
	andlt;groundTypeandgt;...andlt;/groundTypeandgt;
	andlt;permInstandgt;...andlt;/permInstandgt;
	andlt;latandgt;...andlt;/latandgt;
	andlt;lonandgt;...andlt;/lonandgt;
	andlt;elevandgt;...andlt;/elevandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	<a href="#monitoringsystems_thermalnetwork_thermalstation_thermalinstrument">andlt;ThermalInstrumentandgt;...andlt;/ThermalInstrumentandgt;</a>
<strong>andlt;/ThermalStationandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as a location, name, and a description for stations where thermal data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this station.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the benchmark or station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;thermalFeatTypeandgt;
				<ul>
					<li>Description: The type of thermal feature at the site (soil, fumarole, surface or crack in a dome, spring, crater lake, etc.) or if the station is used to collect remote image data.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;groundTypeandgt;
				<ul>
					<li>Description: The soil or ground type.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;permInstandgt;
				<ul>
					<li>Description: A list of permanent instruments, if applicable, installed at this site.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latandgt; AND andlt;lonandgt;
				<ul>
					<li>Description: The latitude and longitude in decimal degrees.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevandgt;
				<ul>
					<li>Description: The nominal elevation of the station in meters.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the station was set up and activated or the time this new information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was set up and activated or the time this new information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: The time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the station or comments.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ThermalInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_thermalnetwork_thermalstation_thermalinstrument">andlt;ThermalInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Thermal network - Thermal station - Thermal instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_thermalnetwork_thermalstation_thermalinstrument" id="monitoringsystems_thermalnetwork_thermalstation_thermalinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_thermalnetwork">andlt;ThermalNetworkandgt;</a> | <a href="#monitoringsystems_thermalnetwork_thermalstation">andlt;ThermalStationandgt;</a> | andlt;ThermalInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;ThermalInstrument code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;signalToNoiseandgt;...andlt;/signalToNoiseandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/ThermalInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the instruments used to collect ground-based and remote thermal data.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this instrument.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: Typical instrumental measuring precision.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;signalToNoiseandgt;
				<ul>
					<li>Description: An instrument specific signal to noise ratio.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Thermal stations -->
		<h2 class="wovomlclass"><a name="monitoringsystems_thermalstations" id="monitoringsystems_thermalstations"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;ThermalStationsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;ThermalStations network=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_thermalstation">andlt;ThermalStationandgt;...andlt;/ThermalStationandgt;</a>
<strong>andlt;/ThermalStationsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as a location, name, and a description for stations where thermal data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>network
				<ul>
					<li>Description: The code of the network to which these stations belong.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these stations.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these stations (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these stations (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;ThermalStationandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_thermalstation">andlt;ThermalStationandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Thermal station -->
		<h2 class="wovomlclass"><a name="monitoringsystems_thermalstation" id="monitoringsystems_thermalstation"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_thermalstations">andlt;ThermalStationsandgt;</a> | andlt;ThermalStationandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;ThermalStation code=andquot;...andquot; network=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;thermalFeatTypeandgt;...andlt;/thermalFeatTypeandgt;
	andlt;groundTypeandgt;...andlt;/groundTypeandgt;
	andlt;permInstandgt;...andlt;/permInstandgt;
	andlt;latandgt;...andlt;/latandgt;
	andlt;lonandgt;...andlt;/lonandgt;
	andlt;elevandgt;...andlt;/elevandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	<a href="#monitoringsystems_thermalstation_thermalinstrument">andlt;ThermalInstrumentandgt;...andlt;/ThermalInstrumentandgt;</a>
<strong>andlt;/ThermalStationandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as a location, name, and a description for stations where thermal data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>network
				<ul>
					<li>Description: The code of the network to which this station belongs.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this station.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the benchmark or station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;thermalFeatTypeandgt;
				<ul>
					<li>Description: The type of thermal feature at the site (soil, fumarole, surface or crack in a dome, spring, crater lake, etc.) or if the station is used to collect remote image data.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;groundTypeandgt;
				<ul>
					<li>Description: The soil or ground type.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;permInstandgt;
				<ul>
					<li>Description: A list of permanent instruments, if applicable, installed at this site.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latandgt; AND andlt;lonandgt;
				<ul>
					<li>Description: The latitude and longitude in decimal degrees.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevandgt;
				<ul>
					<li>Description: The nominal elevation of the station in meters.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the station was set up and activated or the time this new information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was set up and activated or the time this new information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: The time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the station or comments.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ThermalInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_thermalstation_thermalinstrument">andlt;ThermalInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Thermal station - Thermal instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_thermalstation_thermalinstrument" id="monitoringsystems_thermalstation_thermalinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_thermalstations">andlt;ThermalStationsandgt;</a> | <a href="#monitoringsystems_thermalstation">andlt;ThermalStationandgt;</a> | andlt;ThermalInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;ThermalInstrument code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;signalToNoiseandgt;...andlt;/signalToNoiseandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/ThermalInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the instruments used to collect ground-based and remote thermal data.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this station.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: Typical instrumental measuring precision.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;signalToNoiseandgt;
				<ul>
					<li>Description: An instrument specific signal to noise ratio.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Thermal instruments -->
		<h2 class="wovomlclass"><a name="monitoringsystems_thermalinstruments" id="monitoringsystems_thermalinstruments"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;ThermalInstrumentsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;ThermalInstruments station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_thermalinstrument">andlt;ThermalInstrumentandgt;...andlt;/ThermalInstrumentandgt;</a>
<strong>andlt;/ThermalInstrumentsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the instruments used to collect ground-based and remote thermal data.</p>

		<h3>Attributes</h3>
		<ul>
			<li>station
				<ul>
					<li>Description: The code of the station to which these instruments belong.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these instruments.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these instruments (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these instruments (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;ThermalInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_thermalinstrument">andlt;ThermalInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Thermal instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_thermalinstrument" id="monitoringsystems_thermalinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_thermalinstruments">andlt;ThermalInstrumentsandgt;</a> | andlt;ThermalInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;ThermalInstrument code=andquot;...andquot; station=andquot;...andquot; airplane=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;resolutionandgt;...andlt;/resolutionandgt;
	andlt;signalToNoiseandgt;...andlt;/signalToNoiseandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/ThermalInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the instruments used to collect ground-based and remote thermal data.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where this instrument is installed.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>airplane
				<ul>
					<li>Description: The code of the airplane where this instrument is installed.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this instrument.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units the instrument measures.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;resolutionandgt;
				<ul>
					<li>Description: Typical instrumental measuring precision.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;signalToNoiseandgt;
				<ul>
					<li>Description: An instrument specific signal to noise ratio.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Seismic network -->
		<h2 class="wovomlclass"><a name="monitoringsystems_seismicnetwork" id="monitoringsystems_seismicnetwork"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;SeismicNetworkandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SeismicNetwork code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_seismicnetwork_volcanoes">andlt;Volcanoesandgt;...andlt;/Volcanoesandgt;</a>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;velocityModelandgt;...andlt;/velocityModelandgt;
	andlt;zeroDepthandgt;...andlt;/zeroDepthandgt;
	andlt;fixedDepthandgt;...andlt;/fixedDepthandgt;
	andlt;fixedDepthDescandgt;...andlt;/fixedDepthDescandgt;
	andlt;numberOfSeismoandgt;...andlt;/numberOfSeismoandgt;
	andlt;numberOfBBSeismoandgt;...andlt;/numberOfBBSeismoandgt;
	andlt;numberOfSMPSeismoandgt;...andlt;/numberOfSMPSeismoandgt;
	andlt;numberOfDigiSeismoandgt;...andlt;/numberOfDigiSeismoandgt;
	andlt;numberOfAnaSeismoandgt;...andlt;/numberOfAnaSeismoandgt;
	andlt;numberOf3CompSeismoandgt;...andlt;/numberOf3CompSeismoandgt;
	andlt;numberOfMicroandgt;...andlt;/numberOfMicroandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	<a href="#monitoringsystems_seismicnetwork_seismicstation">andlt;SeismicStationandgt;...andlt;/SeismicStationandgt;</a>
<strong>andlt;/SeismicNetworkandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the seismic network such as the velocity model used for computing the event locations and a general overview of the types of instruments used.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this network.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this network (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this network (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;Volcanoesandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_seismicnetwork_volcanoes">andlt;Volcanoesandgt;</a>.</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the network given by the observatory.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: Additional description of the network that should include azimuthal coverage, how the data are relayed, status information and any other descriptive information that could be helpful.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;velocityModelandgt;
				<ul>
					<li>Description: A description the velocity model if it is a simple 2D model.</li>
					<li>Type: string of at most 511 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;zeroDepthandgt;
				<ul>
					<li>Description: The elevation of the zero km "depth", in meters above sea level. For some networks the zero km value will be sea level whereas other networks use a local base level or average elevation of stations in the network. Please also describe what negative depths mean, if applicable.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;fixedDepthandgt;
				<ul>
					<li>Description: A flag whether depths data are held fixed.</li>
					<li>Type: Y, N, U <em>(Yes, No, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;fixedDepthDescandgt;
				<ul>
					<li>Description: A description of whether and how depths data are held fixed by the location algorithm.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numberOfSeismoandgt;
				<ul>
					<li>Description: The number of permanent seismometers in the network.</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numberOfBBSeismoandgt;
				<ul>
					<li>Description: The number of broadband seismometers in network (corner period andgt;10 s).</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numberOfSMPSeismoandgt;
				<ul>
					<li>Description: The number of short- and mid-period seismometers in network (corner period andlt;10 s).</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numberOfDigiSeismoandgt;
				<ul>
					<li>Description: The number of digital seismometers in the network (not including analog seismometers whose signal is later converted to digital).</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numberOfAnaSeismoandgt;
				<ul>
					<li>Description: The number of analog seismometers including those whose signal is later converted to digital.</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numberOf3CompSeismoandgt;
				<ul>
					<li>Description: The number of 3-component seismometers in the network.</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numberOfMicroandgt;
				<ul>
					<li>Description: The number of microphones in the network (for recording air waves, acoustic signals).</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the network was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the network was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date the network was permanently decommissioned or the time this set of information became invalid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the network was permanently decommissioned or the time this set of information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: Time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;SeismicStationandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_seismicnetwork_seismicstation">andlt;SeismicStationandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Seismic network - Volcanoes -->
		<h2 class="wovomlclass"><a name="monitoringsystems_seismicnetwork_volcanoes" id="monitoringsystems_seismicnetwork_volcanoes"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_seismicnetwork">andlt;SeismicNetworkandgt;</a> | andlt;Volcanoesandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Volcanoesandgt;</strong>
	andlt;volcanoCodeandgt;...andlt;/volcanoCodeandgt;
<strong>andlt;/Volcanoesandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains a list of volcano codes.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;volcanoCodeandgt;
				<ul>
					<li>Description: The CAVW number of a volcano.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Seismic network - Seismic station -->
		<h2 class="wovomlclass"><a name="monitoringsystems_seismicnetwork_seismicstation" id="monitoringsystems_seismicnetwork_seismicstation"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_seismicnetwork">andlt;SeismicNetworkandgt;</a> | andlt;SeismicStationandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SeismicStation code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;instDepthandgt;...andlt;/instDepthandgt;
	andlt;instTypeandgt;...andlt;/instTypeandgt;
	andlt;systemGainandgt;...andlt;/systemGainandgt;
	andlt;latandgt;...andlt;/latandgt;
	andlt;lonandgt;...andlt;/lonandgt;
	andlt;elevandgt;...andlt;/elevandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	<a href="#monitoringsystems_seismicnetwork_seismicstation_seismicinstrument">andlt;SeismicInstrumentandgt;...andlt;/SeismicInstrumentandgt;</a>
<strong>andlt;/SeismicStationandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as a location, name, system gain, and comments about the stations where the data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this station.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the station given by the observatory.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the station including the type of material it is set in, any issues with the installation and/or function, how the data are relayed, and any additional descriptive information.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about the station including information about status.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;instDepthandgt;
				<ul>
					<li>Description: The depth of the instrument in meters below the elevation of station. If there are multiple components at different depths, please give a list of depths.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;instTypeandgt;
				<ul>
					<li>Description: The type(s) of instruments installed at this station.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;systemGainandgt;
				<ul>
					<li>Description: Total gain from seismometer, telemetry, and recorder.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latandgt; AND andlt;lonandgt;
				<ul>
					<li>Description: The latitude and longitude in decimal degrees.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevandgt;
				<ul>
					<li>Description: The elevation of the land surface in meters above sea level.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the station was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: The time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;SeismicInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_seismicnetwork_seismicstation_seismicinstrument">andlt;SeismicInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Seismic network - Seismic station - Seismic instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_seismicnetwork_seismicstation_seismicinstrument" id="monitoringsystems_seismicnetwork_seismicstation_seismicinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_seismicnetwork">andlt;SeismicNetworkandgt;</a> | <a href="#monitoringsystems_seismicnetwork_seismicstation">andlt;SeismicStationandgt;</a> | andlt;SeismicInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SeismicInstrument code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;dynamicRangeandgt;...andlt;/dynamicRangeandgt;
	andlt;gainandgt;...andlt;/gainandgt;
	andlt;filtersandgt;...andlt;/filtersandgt;
	andlt;numberOfCompandgt;...andlt;/numberOfCompandgt;
	andlt;respOverviewandgt;...andlt;/respOverviewandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	<a href="#monitoringsystems_seismicnetwork_seismicstation_seismicinstrument_seismiccomponent">andlt;SeismicComponentandgt;...andlt;/SeismicComponentandgt;</a>
<strong>andlt;/SeismicInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as the seismic instrument name, model, number of components and response time.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this instrument.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument (recorder).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument. This field should include if the instrument is analog or digital.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;dynamicRangeandgt;
				<ul>
					<li>Description: The dynamic range of the instrument, please provide the units.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;gainandgt;
				<ul>
					<li>Description: The instrument gain.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;filtersandgt;
				<ul>
					<li>Description: Information about filters if they have been applied.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numberOfCompandgt;
				<ul>
					<li>Description: The number of components.</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;respOverviewandgt;
				<ul>
					<li>Description: An overview of the response for the instrument (poles and zeros).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;SeismicComponentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_seismicnetwork_seismicstation_seismicinstrument_seismiccomponent">andlt;SeismicComponentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Seismic network - Seismic station - Seismic instrument - Seismic component -->
		<h2 class="wovomlclass"><a name="monitoringsystems_seismicnetwork_seismicstation_seismicinstrument_seismiccomponent" id="monitoringsystems_seismicnetwork_seismicstation_seismicinstrument_seismiccomponent"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_seismicnetwork">andlt;SeismicNetworkandgt;</a> | <a href="#monitoringsystems_seismicnetwork_seismicstation">andlt;SeismicStationandgt;</a> | <a href="#monitoringsystems_seismicnetwork_seismicstation_seismicinstrument">andlt;SeismicInstrumentandgt;</a> | andlt;SeismicComponentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SeismicComponent code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;respDescandgt;...andlt;/respDescandgt;
	andlt;sampleRateandgt;...andlt;/sampleRateandgt;
	andlt;seedBandCodeandgt;...andlt;/seedBandCodeandgt;
	andlt;seedInstCodeandgt;...andlt;/seedInstCodeandgt;
	andlt;seedOrientCodeandgt;...andlt;/seedOrientCodeandgt;
	andlt;sensitivityandgt;...andlt;/sensitivityandgt;
	andlt;depthandgt;...andlt;/depthandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
<strong>andlt;/SeismicComponentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about an individual component (geophone) that sends data to the instrument or recorder such as the component name, model, orientation, band type, and sampling rate.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this component.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this component (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this component (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the component given by the observatory, if applicable.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of geophone.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the component.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;respDescandgt;
				<ul>
					<li>Description: A description of the response of the component.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;sampleRateandgt;
				<ul>
					<li>Description: The sample rate for the component, in Hz.</li>
					<li>Type: float</li>
					<li>Unit: Hz</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;seedBandCodeandgt;
				<ul>
					<li>Description: The band type for this component. Please follow the SEED convention for Band Code (S, B, V, etc).</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;seedInstCodeandgt;
				<ul>
					<li>Description: The instrument code for this component. Please follow the SEED convention for Instrument Code.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;seedOrientCodeandgt;
				<ul>
					<li>Description: The orientation code for this component. Please follow the SEED convention for Instrument Code (Z, N, E, A, B C, etc).</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;sensitivityandgt;
				<ul>
					<li>Description: The sensitivity of the component, please include the units.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;depthandgt;
				<ul>
					<li>Description: The depth of the component in meters.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the component was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the component was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the component was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the component was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Seismic stations -->
		<h2 class="wovomlclass"><a name="monitoringsystems_seismicstations" id="monitoringsystems_seismicstations"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;SeismicStationsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SeismicStations network=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_seismicstation">andlt;SeismicStationandgt;...andlt;/SeismicStationandgt;</a>
<strong>andlt;/SeismicStationsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as a location, name, system gain, and comments about the stations where the data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>network
				<ul>
					<li>Description: The code of the network to which these stations belong.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these stations.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these stations (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these stations (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;SeismicStationandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_seismicstation">andlt;SeismicStationandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Seismic station -->
		<h2 class="wovomlclass"><a name="monitoringsystems_seismicstation" id="monitoringsystems_seismicstation"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_seismicstations">andlt;SeismicStationsandgt;</a> | andlt;SeismicStationandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SeismicStation code=andquot;...andquot; network=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;instDepthandgt;...andlt;/instDepthandgt;
	andlt;instTypeandgt;...andlt;/instTypeandgt;
	andlt;systemGainandgt;...andlt;/systemGainandgt;
	andlt;latandgt;...andlt;/latandgt;
	andlt;lonandgt;...andlt;/lonandgt;
	andlt;elevandgt;...andlt;/elevandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;diffUTCandgt;...andlt;/diffUTCandgt;
	<a href="#monitoringsystems_seismicstation_seismicinstrument">andlt;SeismicInstrumentandgt;...andlt;/SeismicInstrumentandgt;</a>
<strong>andlt;/SeismicStationandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as a location, name, system gain, and comments about the stations where the data are collected.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>network
				<ul>
					<li>Description: The code of the network to which this station belongs.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this station.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this station (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;networkCodeandgt;
				<ul>
					<li>Description: The code of the network to which this station belongs.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the station given by the observatory.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the station including the type of material it is set in, any issues with the installation and/or function, how the data are relayed, and any additional descriptive information.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about the station including information about status.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;instDepthandgt;
				<ul>
					<li>Description: The depth of the instrument in meters below the elevation of station. If there are multiple components at different depths, please give a list of depths.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;instTypeandgt;
				<ul>
					<li>Description: The type(s) of instruments installed at this station.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;systemGainandgt;
				<ul>
					<li>Description: Total gain from seismometer, telemetry, and recorder.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latandgt; AND andlt;lonandgt;
				<ul>
					<li>Description: The latitude and longitude in decimal degrees.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevandgt;
				<ul>
					<li>Description: The elevation of the land surface in meters above sea level.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the station was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the station was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;diffUTCandgt;
				<ul>
					<li>Description: The time zone relative to UTC. Please enter the number of hours from GMT, using a negative sign (-) for hours before GMT and no sign for positive numbers.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;SeismicInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_seismicstation_seismicinstrument">andlt;SeismicInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Seismic station - Seismic instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_seismicstation_seismicinstrument" id="monitoringsystems_seismicstation_seismicinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_seismicstations">andlt;SeismicStationsandgt;</a> | <a href="#monitoringsystems_seismicstation">andlt;SeismicStationandgt;</a> | andlt;SeismicInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SeismicInstrument code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;dynamicRangeandgt;...andlt;/dynamicRangeandgt;
	andlt;gainandgt;...andlt;/gainandgt;
	andlt;filtersandgt;...andlt;/filtersandgt;
	andlt;numberOfCompandgt;...andlt;/numberOfCompandgt;
	andlt;respOverviewandgt;...andlt;/respOverviewandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	<a href="#monitoringsystems_seismicstation_seismicinstrument_seismiccomponent">andlt;SeismicComponentandgt;...andlt;/SeismicComponentandgt;</a>
<strong>andlt;/SeismicInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as the seismic instrument name, model, number of components and response time.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this instrument.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument (recorder).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument. This field should include if the instrument is analog or digital.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;dynamicRangeandgt;
				<ul>
					<li>Description: The dynamic range of the instrument, please provide the units.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;gainandgt;
				<ul>
					<li>Description: The instrument gain.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;filtersandgt;
				<ul>
					<li>Description: Information about filters if they have been applied.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numberOfCompandgt;
				<ul>
					<li>Description: The number of components.</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;respOverviewandgt;
				<ul>
					<li>Description: An overview of the response for the instrument (poles and zeros).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;SeismicComponentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_seismicstation_seismicinstrument_seismiccomponent">andlt;SeismicComponentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Seismic station - Seismic instrument - Seismic component -->
		<h2 class="wovomlclass"><a name="monitoringsystems_seismicstation_seismicinstrument_seismiccomponent" id="monitoringsystems_seismicstation_seismicinstrument_seismiccomponent"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_seismicstations">andlt;SeismicStationsandgt;</a> | <a href="#monitoringsystems_seismicstation">andlt;SeismicStationandgt;</a> | <a href="#monitoringsystems_seismicstation_seismicinstrument">andlt;SeismicInstrumentandgt;</a> | andlt;SeismicComponentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SeismicComponent code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;respDescandgt;...andlt;/respDescandgt;
	andlt;sampleRateandgt;...andlt;/sampleRateandgt;
	andlt;seedBandCodeandgt;...andlt;/seedBandCodeandgt;
	andlt;seedInstCodeandgt;...andlt;/seedInstCodeandgt;
	andlt;seedOrientCodeandgt;...andlt;/seedOrientCodeandgt;
	andlt;sensitivityandgt;...andlt;/sensitivityandgt;
	andlt;depthandgt;...andlt;/depthandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
<strong>andlt;/SeismicComponentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about an individual component (geophone) that sends data to the instrument or recorder such as the component name, model, orientation, band type, and sampling rate.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this component.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this component (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this component (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the component given by the observatory, if applicable.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of geophone.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the component.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;respDescandgt;
				<ul>
					<li>Description: A description of the response of the component.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;sampleRateandgt;
				<ul>
					<li>Description: The sample rate for the component, in Hz.</li>
					<li>Type: float</li>
					<li>Unit: Hz</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;seedBandCodeandgt;
				<ul>
					<li>Description: The band type for this component. Please follow the SEED convention for Band Code (S, B, V, etc).</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;seedInstCodeandgt;
				<ul>
					<li>Description: The instrument code for this component. Please follow the SEED convention for Instrument Code.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;seedOrientCodeandgt;
				<ul>
					<li>Description: The orientation code for this component. Please follow the SEED convention for Instrument Code (Z, N, E, A, B C, etc).</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;sensitivityandgt;
				<ul>
					<li>Description: The sensitivity of the component, please include the units.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;depthandgt;
				<ul>
					<li>Description: The depth of the component in meters.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the component was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the component was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the component was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the component was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Seismic instruments -->
		<h2 class="wovomlclass"><a name="monitoringsystems_seismicinstruments" id="monitoringsystems_seismicinstruments"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;SeismicInstrumentsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SeismicInstruments station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_seismicinstrument">andlt;SeismicInstrumentandgt;...andlt;/SeismicInstrumentandgt;</a>
<strong>andlt;/SeismicInstrumentsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as the seismic instrument name, model, number of components and response time.</p>

		<h3>Attributes</h3>
		<ul>
			<li>station
				<ul>
					<li>Description: The code of the station to which these instruments belong.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these instruments.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these instruments (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these instruments (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;SeismicInstrumentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_seismicinstrument">andlt;SeismicInstrumentandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Seismic instrument -->
		<h2 class="wovomlclass"><a name="monitoringsystems_seismicinstrument" id="monitoringsystems_seismicinstrument"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_seismicinstruments">andlt;SeismicInstrumentsandgt;</a> | andlt;SeismicInstrumentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SeismicInstrument code=andquot;...andquot; station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;dynamicRangeandgt;...andlt;/dynamicRangeandgt;
	andlt;gainandgt;...andlt;/gainandgt;
	andlt;filtersandgt;...andlt;/filtersandgt;
	andlt;numberOfCompandgt;...andlt;/numberOfCompandgt;
	andlt;respOverviewandgt;...andlt;/respOverviewandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	<a href="#monitoringsystems_seismicinstrument_seismiccomponent">andlt;SeismicComponentandgt;...andlt;/SeismicComponentandgt;</a>
<strong>andlt;/SeismicInstrumentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information such as the seismic instrument name, model, number of components and response time.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where this instrument is installed.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this instrument.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this instrument (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name, model, and manufacturer of the instrument (recorder).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of instrument. This field should include if the instrument is analog or digital.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the instrument.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;dynamicRangeandgt;
				<ul>
					<li>Description: The dynamic range of the instrument, please provide the units.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;gainandgt;
				<ul>
					<li>Description: The instrument gain.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;filtersandgt;
				<ul>
					<li>Description: Information about filters if they have been applied.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numberOfCompandgt;
				<ul>
					<li>Description: The number of components.</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;respOverviewandgt;
				<ul>
					<li>Description: An overview of the response for the instrument (poles and zeros).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the instrument was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the instrument was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;SeismicComponentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_seismicinstrument_seismiccomponent">andlt;SeismicComponentandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Seismic instrument - Seismic component -->
		<h2 class="wovomlclass"><a name="monitoringsystems_seismicinstrument_seismiccomponent" id="monitoringsystems_seismicinstrument_seismiccomponent"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_seismicinstruments">andlt;SeismicInstrumentsandgt;</a> | <a href="#monitoringsystems_seismicinstrument">andlt;SeismicInstrumentandgt;</a> | andlt;SeismicComponentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SeismicComponent code=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;respDescandgt;...andlt;/respDescandgt;
	andlt;sampleRateandgt;...andlt;/sampleRateandgt;
	andlt;seedBandCodeandgt;...andlt;/seedBandCodeandgt;
	andlt;seedInstCodeandgt;...andlt;/seedInstCodeandgt;
	andlt;seedOrientCodeandgt;...andlt;/seedOrientCodeandgt;
	andlt;sensitivityandgt;...andlt;/sensitivityandgt;
	andlt;depthandgt;...andlt;/depthandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
<strong>andlt;/SeismicComponentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about an individual component (geophone) that sends data to the instrument or recorder such as the component name, model, orientation, band type, and sampling rate.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this component.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this component (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this component (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the component given by the observatory, if applicable.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of geophone.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the component.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;respDescandgt;
				<ul>
					<li>Description: A description of the response of the component.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;sampleRateandgt;
				<ul>
					<li>Description: The sample rate for the component, in Hz.</li>
					<li>Type: float</li>
					<li>Unit: Hz</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;seedBandCodeandgt;
				<ul>
					<li>Description: The band type for this component. Please follow the SEED convention for Band Code (S, B, V, etc).</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;seedInstCodeandgt;
				<ul>
					<li>Description: The instrument code for this component. Please follow the SEED convention for Instrument Code.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;seedOrientCodeandgt;
				<ul>
					<li>Description: The orientation code for this component. Please follow the SEED convention for Instrument Code (Z, N, E, A, B C, etc).</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;sensitivityandgt;
				<ul>
					<li>Description: The sensitivity of the component, please include the units.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;depthandgt;
				<ul>
					<li>Description: The depth of the component in meters.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the component was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the component was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the component was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the component was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Seismic components -->
		<h2 class="wovomlclass"><a name="monitoringsystems_seismiccomponents" id="monitoringsystems_seismiccomponents"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | andlt;SeismicComponentsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SeismicComponents instrument=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#monitoringsystems_seismiccomponent">andlt;SeismicComponentandgt;...andlt;/SeismicComponentandgt;</a>
<strong>andlt;/SeismicComponentsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about components (geophones) that sends data to seismic instruments.</p>

		<h3>Attributes</h3>
		<ul>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument to which these components belong.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these components.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these components (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these components (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;SeismicComponentandgt;
				<ul>
					<li>Description: See <a href="#monitoringsystems_seismiccomponent">andlt;SeismicComponentandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Monitoring systems - Seismic component -->
		<h2 class="wovomlclass"><a name="monitoringsystems_seismiccomponent" id="monitoringsystems_seismiccomponent"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#monitoringsystems">andlt;MonitoringSystemsandgt;</a> | <a href="#monitoringsystems_seismiccomponents">andlt;SeismicComponentsandgt;</a> | andlt;SeismicComponentandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SeismicComponent code=andquot;...andquot; instrument=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;nameandgt;...andlt;/nameandgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;respDescandgt;...andlt;/respDescandgt;
	andlt;sampleRateandgt;...andlt;/sampleRateandgt;
	andlt;seedBandCodeandgt;...andlt;/seedBandCodeandgt;
	andlt;seedInstCodeandgt;...andlt;/seedInstCodeandgt;
	andlt;seedOrientCodeandgt;...andlt;/seedOrientCodeandgt;
	andlt;sensitivityandgt;...andlt;/sensitivityandgt;
	andlt;depthandgt;...andlt;/depthandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
<strong>andlt;/SeismicComponentandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about an individual component (geophone) that sends data to the instrument or recorder such as the component name, model, orientation, band type, and sampling rate.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument to which this component belongs.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of this component.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of this component (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of this component (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;nameandgt;
				<ul>
					<li>Description: The name of the component given by the observatory, if applicable.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type of geophone.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the component.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;respDescandgt;
				<ul>
					<li>Description: A description of the response of the component.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;sampleRateandgt;
				<ul>
					<li>Description: The sample rate for the component, in Hz.</li>
					<li>Type: float</li>
					<li>Unit: Hz</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;seedBandCodeandgt;
				<ul>
					<li>Description: The band type for this component. Please follow the SEED convention for Band Code (S, B, V, etc).</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;seedInstCodeandgt;
				<ul>
					<li>Description: The instrument code for this component. Please follow the SEED convention for Instrument Code.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;seedOrientCodeandgt;
				<ul>
					<li>Description: The orientation code for this component. Please follow the SEED convention for Instrument Code (Z, N, E, A, B C, etc).</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;sensitivityandgt;
				<ul>
					<li>Description: The sensitivity of the component, please include the units.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;depthandgt;
				<ul>
					<li>Description: The depth of the component in meters.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The date the component was set up and activated or the time this information became valid in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the component was set up and activated or the time this information became valid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The date (UTC) the component was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date the component was permanently decommissioned or the time this information became invalid.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data -->
		<h2 class="wovomlclass"><a name="data" id="data"></a><a href="#wovoml">andlt;wovomlandgt;</a> | andlt;Dataandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Dataandgt;</strong>
	<a href="#data_deformation">andlt;Deformationandgt;...andlt;/Deformationandgt;</a>
	<a href="#data_gas">andlt;Gasandgt;...andlt;/Gasandgt;</a>
	<a href="#data_hydrologic">andlt;Hydrologicandgt;...andlt;/Hydrologicandgt;</a>
	<a href="#data_fields">andlt;Fieldsandgt;...andlt;/Fieldsandgt;</a>
	<a href="#data_thermal">andlt;Thermalandgt;...andlt;/Thermalandgt;</a>
	<a href="#data_seismic">andlt;Seismicandgt;...andlt;/Seismicandgt;</a>
<strong>andlt;/Dataandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about all data for a volcano.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;Deformationandgt;
				<ul>
					<li>Description: See <a href="#data_deformation">andlt;Deformationandgt;</a>.</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Gasandgt;
				<ul>
					<li>Description: See <a href="#data_gas">andlt;Gasandgt;</a>.</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Hydrologicandgt;
				<ul>
					<li>Description: See <a href="#data_hydrologic">andlt;Hydrologicandgt;</a>.</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Fieldsandgt;
				<ul>
					<li>Description: See <a href="#data_fields">andlt;Fieldsandgt;</a>.</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Thermalandgt;
				<ul>
					<li>Description: See <a href="#data_thermal">andlt;Thermalandgt;</a>.</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Seismicandgt;
				<ul>
					<li>Description: See <a href="#data_seismic">andlt;Seismicandgt;</a>.</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation -->
		<h2 class="wovomlclass"><a name="data_deformation" id="data_deformation"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | andlt;Deformationandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Deformationandgt;</strong>
	<a href="#data_deformation_electronictiltds">andlt;ElectronicTiltDatasetandgt;...andlt;/ElectronicTiltDatasetandgt;</a>
	<a href="#data_deformation_tiltvectords">andlt;TiltVectorDatasetandgt;...andlt;/TiltVectorDatasetandgt;</a>
	<a href="#data_deformation_strainds">andlt;StrainDatasetandgt;...andlt;/StrainDatasetandgt;</a>
	<a href="#data_deformation_edmds">andlt;EDMDatasetandgt;...andlt;/EDMDatasetandgt;</a>
	<a href="#data_deformation_angleds">andlt;AngleDatasetandgt;...andlt;/AngleDatasetandgt;</a>
	<a href="#data_deformation_gpsds">andlt;GPSDatasetandgt;...andlt;/GPSDatasetandgt;</a>
	<a href="#data_deformation_gpsvectords">andlt;GPSVectorDatasetandgt;...andlt;/GPSVectorDatasetandgt;</a>
	<a href="#data_deformation_levelingds">andlt;LevelingDatasetandgt;...andlt;/LevelingDatasetandgt;</a>
	<a href="#data_deformation_insarimageds">andlt;InSARImageDatasetandgt;...andlt;/InSARImageDatasetandgt;</a>
<strong>andlt;/Deformationandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about all deformation data for a volcano.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;ElectronicTiltDatasetandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_electronictiltds">andlt;ElectronicTiltDatasetandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;TiltVectorDatasetandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_tiltvectords">andlt;TiltVectorDatasetandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;StrainDatasetandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_strainds">andlt;StrainDatasetandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;EDMDatasetandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_edmds">andlt;EDMDatasetandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;AngleDatasetandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_angleds">andlt;AngleDatasetandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;GPSDatasetandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_gpsds">andlt;GPSDatasetandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;GPSVectorDatasetandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_gpsvectords">andlt;GPSVectorDatasetandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;LevelingDatasetandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_levelingds">andlt;LevelingDatasetandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;InSARImageDatasetandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_insarimageds">andlt;InSARImageDatasetandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - Electronic tilt dataset -->
		<h2 class="wovomlclass"><a name="data_deformation_electronictiltds" id="data_deformation_electronictiltds"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | andlt;ElectronicTiltDatasetandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;ElectronicTiltDataset instrument=andquot;...andquot; station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#data_deformation_electronictilt">andlt;ElectronicTiltandgt;...andlt;/ElectronicTiltandgt;</a>
<strong>andlt;/ElectronicTiltDatasetandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains tilt data that are either raw or processed.</p>

		<h3>Attributes</h3>
		<ul>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where these data were recorded.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;ElectronicTiltandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_electronictilt">andlt;ElectronicTiltandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - Electronic tilt -->
		<h2 class="wovomlclass"><a name="data_deformation_electronictilt" id="data_deformation_electronictilt"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | <a href="#data_deformation_electronictiltds">andlt;ElectronicTiltDatasetandgt;</a> | andlt;ElectronicTiltandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;ElectronicTilt code=andquot;...andquot; instrument=andquot;...andquot; station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;measTimeandgt;...andlt;/measTimeandgt;
	andlt;measTimeUncandgt;...andlt;/measTimeUncandgt;
	andlt;sampleRateandgt;...andlt;/sampleRateandgt;
	andlt;tilt1andgt;...andlt;/tilt1andgt;
	andlt;tilt1Uncandgt;...andlt;/tilt1Uncandgt;
	andlt;tilt2andgt;...andlt;/tilt2andgt;
	andlt;tilt2Uncandgt;...andlt;/tilt2Uncandgt;
	andlt;processedandgt;...andlt;/processedandgt;
<strong>andlt;/ElectronicTiltandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains tilt data that are either raw or processed.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where these data were recorded.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;measTimeandgt;
				<ul>
					<li>Description: The measurement time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS.SSSS* (unlimited number of digits for sub-seconds)</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;measTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the measurement time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS.SSSS* (unlimited number of digits for sub-seconds)</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;sampleRateandgt;
				<ul>
					<li>Description: The sampling rate for these data in seconds.</li>
					<li>Type: double</li>
					<li>Unit: s</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;tilt1andgt;
				<ul>
					<li>Description: Tilt measurement 1 or x (positive is down to the north).</li>
					<li>Type: double</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;tilt1Uncandgt;
				<ul>
					<li>Description: The error from all sources (instrument, rain, diurnal heating, etc) for processed tilt 1 data or error from environmental factors only if the raw data are provided.</li>
					<li>Type: double</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;tilt2andgt;
				<ul>
					<li>Description: Tilt measurement 2 or y (positive is down to the east).</li>
					<li>Type: double</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;tilt2Uncandgt;
				<ul>
					<li>Description: The error from all sources (instrument, rain, diurnal heating, etc) for processed tilt 2 data or error from environmental factors only if the raw data are provided.</li>
					<li>Type: double</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;processedandgt;
				<ul>
					<li>Description: A single character field to indicate that these data have already been processed and do not require a link to the instrument table for conversions. Use P for processed data or R for raw data.</li>
					<li>Type: P, R <em>(Processed, Raw)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - Tilt vector dataset -->
		<h2 class="wovomlclass"><a name="data_deformation_tiltvectords" id="data_deformation_tiltvectords"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | andlt;TiltVectorDatasetandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;TiltVectorDataset instrument=andquot;...andquot; station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#data_deformation_tiltvector">andlt;TiltVectorandgt;...andlt;/TiltVectorandgt;</a>
<strong>andlt;/TiltVectorDatasetandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains tilt information from sources where we do not have the raw or semi-processed data and only have access to tilt vectors.</p>

		<h3>Attributes</h3>
		<ul>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where these data were recorded.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;TiltVectorandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_tiltvector">andlt;TiltVectorandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - Tilt vector -->
		<h2 class="wovomlclass"><a name="data_deformation_tiltvector" id="data_deformation_tiltvector"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | <a href="#data_deformation_tiltvectords">andlt;TiltVectorDatasetandgt;</a> | andlt;TiltVectorandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;TiltVector code=andquot;...andquot; instrument=andquot;...andquot; station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;magnitudeandgt;...andlt;/magnitudeandgt;
	andlt;magnitudeUncandgt;...andlt;/magnitudeUncandgt;
	andlt;azimuthandgt;...andlt;/azimuthandgt;
	andlt;azimuthUncandgt;...andlt;/azimuthUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/TiltVectorandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains tilt information from sources where we do not have the raw or semi-processed data and only have access to tilt vectors.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where these data were recorded.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: Start time of measurement in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty of the start time of measurement.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: End time of measurement in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty of the end time of measurement.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;magnitudeandgt;
				<ul>
					<li>Description: The magnitude of the tilt vector (the length) in microradians.</li>
					<li>Type: float</li>
					<li>Unit: andmu;rad</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;magnitudeUncandgt;
				<ul>
					<li>Description: The magnitude error in microradians.</li>
					<li>Type: float</li>
					<li>Unit: andmu;rad</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;azimuthandgt;
				<ul>
					<li>Description: The azimuth of downward tilt (the direction) in degrees (0-360).</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;azimuthUncandgt;
				<ul>
					<li>Description: The azimuth error in degrees.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about possible artifacts and instrument details.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - Strain dataset -->
		<h2 class="wovomlclass"><a name="data_deformation_strainds" id="data_deformation_strainds"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | andlt;StrainDatasetandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;StrainDataset instrument=andquot;...andquot; station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#data_deformation_strain">andlt;Strainandgt;...andlt;/Strainandgt;</a>
<strong>andlt;/StrainDatasetandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains both raw and processed strainmeter data.</p>

		<h3>Attributes</h3>
		<ul>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where these data were recorded.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;Strainandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_strain">andlt;Strainandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - Strain -->
		<h2 class="wovomlclass"><a name="data_deformation_strain" id="data_deformation_strain"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | <a href="#data_deformation_strainds">andlt;StrainDatasetandgt;</a> | andlt;Strainandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Strain code=andquot;...andquot; instrument=andquot;...andquot; station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;measTimeandgt;...andlt;/measTimeandgt;
	andlt;measTimeUncandgt;...andlt;/measTimeUncandgt;
	andlt;component1andgt;...andlt;/component1andgt;
	andlt;component1Uncandgt;...andlt;/component1Uncandgt;
	andlt;component2andgt;...andlt;/component2andgt;
	andlt;component2Uncandgt;...andlt;/component2Uncandgt;
	andlt;component3andgt;...andlt;/component3andgt;
	andlt;component3Uncandgt;...andlt;/component3Uncandgt;
	andlt;component4andgt;...andlt;/component4andgt;
	andlt;component4Uncandgt;...andlt;/component4Uncandgt;
	andlt;volumetricStrainandgt;...andlt;/volumetricStrainandgt;
	andlt;volumetricStrainUncandgt;...andlt;/volumetricStrainUncandgt;
	andlt;shearStrainAxis1andgt;...andlt;/shearStrainAxis1andgt;
	andlt;shearStrainAxis1Uncandgt;...andlt;/shearStrainAxis1Uncandgt;
	andlt;azimuthAxis1andgt;...andlt;/azimuthAxis1andgt;
	andlt;shearStrainAxis2andgt;...andlt;/shearStrainAxis2andgt;
	andlt;shearStrainAxis2Uncandgt;...andlt;/shearStrainAxis2Uncandgt;
	andlt;azimuthAxis2andgt;...andlt;/azimuthAxis2andgt;
	andlt;shearStrainAxis3andgt;...andlt;/shearStrainAxis3andgt;
	andlt;shearStrainAxis3Uncandgt;...andlt;/shearStrainAxis3Uncandgt;
	andlt;azimuthAxis3andgt;...andlt;/azimuthAxis3andgt;
	andlt;minPrincipalStrainandgt;...andlt;/minPrincipalStrainandgt;
	andlt;minPrincipalStrainUncandgt;...andlt;/minPrincipalStrainUncandgt;
	andlt;maxPrincipalStrainandgt;...andlt;/maxPrincipalStrainandgt;
	andlt;maxPrincipalStrainUncandgt;...andlt;/maxPrincipalStrainUncandgt;
	andlt;minPrincipalStrainDirandgt;...andlt;/minPrincipalStrainDirandgt;
	andlt;minPrincipalStrainDirUncandgt;...andlt;/minPrincipalStrainDirUncandgt;
	andlt;maxPrincipalStrainDirandgt;...andlt;/maxPrincipalStrainDirandgt;
	andlt;maxPrincipalStrainDirUncandgt;...andlt;/maxPrincipalStrainDirUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/Strainandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains both raw and processed strainmeter data.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where these data were recorded.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;measTimeandgt;
				<ul>
					<li>Description: The measurement time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;measTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the measurement time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;component1andgt;
				<ul>
					<li>Description: The strainmeter data for component 1 in microstrain where contraction is positive and dilatation is negative.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;component1Uncandgt;
				<ul>
					<li>Description: The error in measurement of component 1 in microstrain.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;component2andgt;
				<ul>
					<li>Description: The strainmeter data for component 2 in microstrain where contraction is positive and dilatation is negative.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;component2Uncandgt;
				<ul>
					<li>Description: The error in measurement of component 2 in microstrain.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;component3andgt;
				<ul>
					<li>Description: The strainmeter data for component 3 in microstrain where contraction is positive and dilatation is negative.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;component3Uncandgt;
				<ul>
					<li>Description: The error in measurement of component 3 in microstrain.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;component4andgt;
				<ul>
					<li>Description: The strainmeter data for component 4 in microstrain where contraction is positive and dilatation is negative.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;component4Uncandgt;
				<ul>
					<li>Description: The error in measurement of component 4 in microstrain.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;volumetricStrainandgt;
				<ul>
					<li>Description: The volumetric strain in microstrain (contraction is positive and dilatation is negative).</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;volumetricStrainUncandgt;
				<ul>
					<li>Description: The error associated with the volumetric strain in microstrain.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;shearStrainAxis1andgt;
				<ul>
					<li>Description: The shear strain of axis 1 (gamma 1) in microstrain.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;shearStrainAxis1Uncandgt;
				<ul>
					<li>Description: The uncertainty in the strain for axis 1 in microstrain.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;azimuthAxis1andgt;
				<ul>
					<li>Description: Theazimuth of axis 1 (gamma 1) in degrees (0-360) measuring with respect to North with clockwise rotation as positive.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;shearStrainAxis2andgt;
				<ul>
					<li>Description: The shear strain of axis 2 (gamma 2) in microstrain.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;shearStrainAxis2Uncandgt;
				<ul>
					<li>Description: The uncertainty in the strain for axis 2 in microstrain.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;azimuthAxis2andgt;
				<ul>
					<li>Description: The azimuth of axis 2 (gamma 2) in degrees (0-360) measuring with respect to North with clockwise rotation as positive.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;shearStrainAxis3andgt;
				<ul>
					<li>Description: The shear strain of axis 3 (gamma 3) in microstrain (for 3D strainmeters).</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;shearStrainAxis3Uncandgt;
				<ul>
					<li>Description: The uncertainty in the strain for axis 3 in microstrain.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;azimuthAxis3andgt;
				<ul>
					<li>Description: The azimuth of axis 3 (gamma 3) in degrees (0-360) measuring with respect to North with clockwise rotation as positive.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;minPrincipalStrainandgt;
				<ul>
					<li>Description: The minimum principal strain in microstrain.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;minPrincipalStrainUncandgt;
				<ul>
					<li>Description: The uncertainty in the minimum principal strain in microstrain.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxPrincipalStrainandgt;
				<ul>
					<li>Description: The maximum principal strain in microstrain.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxPrincipalStrainUncandgt;
				<ul>
					<li>Description: The uncertainty in the maximum principal strain in microstrain.</li>
					<li>Type: double</li>
					<li>Unit: andmu;strain</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;minPrincipalStrainDirandgt;
				<ul>
					<li>Description: The direction of the minimum principal strain 3 in degrees.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;minPrincipalStrainDirUncandgt;
				<ul>
					<li>Description: The uncertainty in the minimum principal strain direction.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxPrincipalStrainDirandgt;
				<ul>
					<li>Description: The direction of the maximum principal strain 1 in degrees (0-360).</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxPrincipalStrainDirUncandgt;
				<ul>
					<li>Description: The uncertainty in the maximum principal strain direction.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Any additionnal comment about the data.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - EDM dataset -->
		<h2 class="wovomlclass"><a name="data_deformation_edmds" id="data_deformation_edmds"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | andlt;EDMDatasetandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;EDMDataset instrument=andquot;...andquot; station=andquot;...andquot; targetStation=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#data_deformation_edm">andlt;EDMandgt;...andlt;/EDMandgt;</a>
<strong>andlt;/EDMDatasetandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains EDM data that were collected between two stations, an instrument station and a target or reflector station.</p>
		
		<h3>Attributes</h3>
		<ul>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where these data were recorded.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>targetStation
				<ul>
					<li>Description: The code of the target or reflector station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;EDMandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_edm">andlt;EDMandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - EDM -->
		<h2 class="wovomlclass"><a name="data_deformation_edm" id="data_deformation_edm"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | <a href="#data_deformation_edmds">andlt;EDMDatasetandgt;</a> | andlt;EDMandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;EDM code=andquot;...andquot; instrument=andquot;...andquot; station=andquot;...andquot; targetStation=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;measTimeandgt;...andlt;/measTimeandgt;
	andlt;measTimeUncandgt;...andlt;/measTimeUncandgt;
	andlt;lineLengthandgt;...andlt;/lineLengthandgt;
	andlt;constantErrandgt;...andlt;/constantErrandgt;
	andlt;scaleErrandgt;...andlt;/scaleErrandgt;
<strong>andlt;/EDMandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains EDM data that were collected between two stations, an instrument station and a target or reflector station.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where these data were recorded.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>targetStation
				<ul>
					<li>Description: The code of the target or reflector station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;measTimeandgt;
				<ul>
					<li>Description: The measurement time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;measTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the measurement time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;lineLengthandgt;
				<ul>
					<li>Description: The mark-to-mark line length in meters.</li>
					<li>Type: double</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;constantErrandgt;
				<ul>
					<li>Description: The constant error in meters, an indication of the instrument and reflector error.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;scaleErrandgt;
				<ul>
					<li>Description: The scale error in ppm, an indication of the error in line length due to temperature, and pressure.</li>
					<li>Type: float</li>
					<li>Unit: ppm</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - Angle dataset -->
		<h2 class="wovomlclass"><a name="data_deformation_angleds" id="data_deformation_angleds"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | andlt;AngleDatasetandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;AngleDataset instrument=andquot;...andquot; station=andquot;...andquot; targetStation1=andquot;...andquot; targetStation2=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#data_deformation_angle">andlt;Angleandgt;...andlt;/Angleandgt;</a>
<strong>andlt;/AngleDatasetandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains a few angles from early geodetic surveys where someone would stand on a high point (on top of a mountain) and measure the horizontal and vertical angles to prominent features in the area. Today, angles are measured to describe dramatic vertical or horizontal deformation of points on which GPS receivers and other modern instruments cannot safely be installed (e.g., on growing lava domes).</p>

		<h3>Attributes</h3>
		<ul>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where these data were recorded.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>targetStation1
				<ul>
					<li>Description: The code of the first target station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>targetStation2
				<ul>
					<li>Description: The code of the second target station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;Angleandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_angle">andlt;Angleandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - Angle -->
		<h2 class="wovomlclass"><a name="data_deformation_angle" id="data_deformation_angle"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | <a href="#data_deformation_angleds">andlt;AngleDatasetandgt;</a> | andlt;Angleandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Angle code=andquot;...andquot; instrument=andquot;...andquot; station=andquot;...andquot; targetStation1=andquot;...andquot; targetStation2=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;measTimeandgt;...andlt;/measTimeandgt;
	andlt;measTimeUncandgt;...andlt;/measTimeUncandgt;
	andlt;hAngle1andgt;...andlt;/hAngle1andgt;
	andlt;hAngle1Uncandgt;...andlt;/hAngle1Uncandgt;
	andlt;hAngle2andgt;...andlt;/hAngle2andgt;
	andlt;hAngle2Uncandgt;...andlt;/hAngle2Uncandgt;
	andlt;vAngle1andgt;...andlt;/vAngle1andgt;
	andlt;vAngle1Uncandgt;...andlt;/vAngle1Uncandgt;
	andlt;vAngle2andgt;...andlt;/vAngle2andgt;
	andlt;vAngle2Uncandgt;...andlt;/vAngle2Uncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/Angleandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains a few angles from early geodetic surveys where someone would stand on a high point (on top of a mountain) and measure the horizontal and vertical angles to prominent features in the area. Today, angles are measured to describe dramatic vertical or horizontal deformation of points on which GPS receivers and other modern instruments cannot safely be installed (e.g., on growing lava domes).</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where these data were recorded.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>targetStation1
				<ul>
					<li>Description: The code of the first target station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>targetStation2
				<ul>
					<li>Description: The code of the second target station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;measTimeandgt;
				<ul>
					<li>Description: The measurement time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;measTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the measurement time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;hAngle1andgt;
				<ul>
					<li>Description: The horizontal angle as measured by theodolite or total station (in degrees, 0-360) to target 1.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;hAngle1Uncandgt;
				<ul>
					<li>Description: The error on the horizontal angle to target 1.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;hAngle2andgt;
				<ul>
					<li>Description: The horizontal angle as measured by theodolite or total station (in degrees, 0-360) to target 2.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;hAngle2Uncandgt;
				<ul>
					<li>Description: The error on the horizontal angle to target 2.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;vAngle1andgt;
				<ul>
					<li>Description: The vertical angle as measured by theodolite or total station (in degrees, -90 to +90) to target 1.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;vAngle1Uncandgt;
				<ul>
					<li>Description: The error on the vertical angle to target 1.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;vAngle2andgt;
				<ul>
					<li>Description: The vertical angle as measured by theodolite or total station (in degrees, -90 to +90) to target 2.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;vAngle2Uncandgt;
				<ul>
					<li>Description: The error on the vertical angle to target 2.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about the angle data including information on how well we know the location and time of measurement.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - GPS dataset -->
		<h2 class="wovomlclass"><a name="data_deformation_gpsds" id="data_deformation_gpsds"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | andlt;GPSDatasetandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;GPSDataset instrument=andquot;...andquot; station=andquot;...andquot; refStation1=andquot;...andquot; refStation2=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#data_deformation_gps">andlt;GPSandgt;...andlt;/GPSandgt;</a>
<strong>andlt;/GPSDatasetandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about each individual instrument along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where these data were recorded.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>refStation1
				<ul>
					<li>Description: The code of the first reference (fixed) station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>refStation2
				<ul>
					<li>Description: The code of the second reference (fixed) station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;GPSandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_gps">andlt;GPSandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - GPS -->
		<h2 class="wovomlclass"><a name="data_deformation_gps" id="data_deformation_gps"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | <a href="#data_deformation_gpsds">andlt;GPSDatasetandgt;</a> | andlt;GPSandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;GPS code=andquot;...andquot; instrument=andquot;...andquot; station=andquot;...andquot; refStation1=andquot;...andquot; refStation2=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;measTimeandgt;...andlt;/measTimeandgt;
	andlt;measTimeUncandgt;...andlt;/measTimeUncandgt;
	andlt;latandgt;...andlt;/latandgt;
	andlt;lonandgt;...andlt;/lonandgt;
	andlt;elevandgt;...andlt;/elevandgt;
	andlt;N-SErrandgt;...andlt;/N-SErrandgt;
	andlt;E-WErrandgt;...andlt;/E-WErrandgt;
	andlt;verticalErrandgt;...andlt;/verticalErrandgt;
	andlt;softwareandgt;...andlt;/softwareandgt;
	andlt;orbitsandgt;...andlt;/orbitsandgt;
	andlt;durationandgt;...andlt;/durationandgt;
	andlt;qualityandgt;...andlt;/qualityandgt;
<strong>andlt;/GPSandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains continuous and periodic data collected at a single station and referenced to two reference stations. These data are collected either by a temporary GPS instrument for a period of time or by an instrument that records the position continuously.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where these data were recorded.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>refStation1
				<ul>
					<li>Description: The code of the first reference (fixed) station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>refStation2
				<ul>
					<li>Description: The code of the second reference (fixed) station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;measTimeandgt;
				<ul>
					<li>Description: The measurement time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;measTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the measurement time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latandgt; AND andlt;lonandgt;
				<ul>
					<li>Description: The latitude and longitude in decimal degrees.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevandgt;
				<ul>
					<li>Description: The measured elevation in meters (above sea level).</li>
					<li>Type: double</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;N-SErrandgt;
				<ul>
					<li>Description: The north-south error in degrees.</li>
					<li>Type: double</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;E-WErrandgt;
				<ul>
					<li>Description: The east-west error in degrees.</li>
					<li>Type: double</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;verticalErrandgt;
				<ul>
					<li>Description: The vertical error in meters.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;softwareandgt;
				<ul>
					<li>Description: The software used to determine the positions, e.g., GIPSY, BERNESE, other.</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;orbitsandgt;
				<ul>
					<li>Description: The orbits used to determine the positions (source, and corrections applied). Please provide whose orbits and which ones.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;durationandgt;
				<ul>
					<li>Description: The duration of the solution in minutes. For continuous data, please give the frequency of measurement and the duration of time used to calculate each position, e.g., For example, data collected every 10 seconds and each position computed from 24 hours of data. For periodic (campaign) data, please give the duration of dataused to calculate this position.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;qualityandgt;
				<ul>
					<li>Description: An indicator of the quality for this measurement (use E for excellent, G for good, P for poor, and U for unknown).</li>
					<li>Type: E, G, P, U <em>(Excellent, Good, Poor, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - GPS vector dataset -->
		<h2 class="wovomlclass"><a name="data_deformation_gpsvectords" id="data_deformation_gpsvectords"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | andlt;GPSVectorDatasetandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;GPSVectorDataset instrument=andquot;...andquot; station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#data_deformation_gpsvector">andlt;GPSVectorandgt;...andlt;/GPSVectorandgt;</a>
<strong>andlt;/GPSVectorDatasetandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about each individual instrument along with a flag to indicate if the instrument is installed permanently or is used periodically as part of a campaign.</p>

		<h3>Attributes</h3>
		<ul>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where these data were recorded.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;GPSVectorandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_gpsvector">andlt;GPSVectorandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - GPS vector -->
		<h2 class="wovomlclass"><a name="data_deformation_gpsvector" id="data_deformation_gpsvector"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | <a href="#data_deformation_gpsvectords">andlt;GPSVectorDatasetandgt;</a> | andlt;GPSVectorandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;GPSVector code=andquot;...andquot; instrument=andquot;...andquot; station=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;magnitudeandgt;...andlt;/magnitudeandgt;
	andlt;azimuthandgt;...andlt;/azimuthandgt;
	andlt;inclinationandgt;...andlt;/inclinationandgt;
	andlt;northDisplandgt;...andlt;/northDisplandgt;
	andlt;northDisplErrandgt;...andlt;/northDisplErrandgt;
	andlt;eastDisplandgt;...andlt;/eastDisplandgt;
	andlt;eastDisplErrandgt;...andlt;/eastDisplErrandgt;
	andlt;vertDisplandgt;...andlt;/vertDisplandgt;
	andlt;vertDisplErrandgt;...andlt;/vertDisplErrandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/GPSVectorandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains vectors that were computed from GPS data where the actual positions are not available.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>station
				<ul>
					<li>Description: The code of the station where these data were recorded.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: Start time of measurement in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty of the start time of measurement.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: End time of measurement in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty of the end time of measurement.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;magnitudeandgt;
				<ul>
					<li>Description: The magnitude of the displacement in mm, if vector is described by displacement magnitude, azimuth, and vector inclination.</li>
					<li>Type: float</li>
					<li>Unit: mm</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;azimuthandgt;
				<ul>
					<li>Description: The displacement azimuth in degrees (0-360), if vector is so described.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;inclinationandgt;
				<ul>
					<li>Description: The inclination of displacement vector in degrees (0-90), if vector is so described.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 90 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;northDisplandgt;
				<ul>
					<li>Description: The displacement to the north in mm, if vector is described in terms of North, East, and Vertical displacement.</li>
					<li>Type: float</li>
					<li>Unit: mm</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;northDisplErrandgt;
				<ul>
					<li>Description: The error in displacement to the north in mm.</li>
					<li>Type: float</li>
					<li>Unit: mm</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;eastDisplandgt;
				<ul>
					<li>Description: The displacement to the east in mm, if vector is so described.</li>
					<li>Type: float</li>
					<li>Unit: mm</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;eastDisplErrandgt;
				<ul>
					<li>Description: The error in displacement to the east in mm.</li>
					<li>Type: float</li>
					<li>Unit: mm</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;vertDisplandgt;
				<ul>
					<li>Description: The vertical displacement in mm, if vector is so described.</li>
					<li>Type: float</li>
					<li>Unit: mm</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;vertDisplErrandgt;
				<ul>
					<li>Description: The error in vertical displacement in mm.</li>
					<li>Type: float</li>
					<li>Unit: mm</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about the vector data including locations of the instrument and target stations, information about the instruments used, and information on how well we know the location and time of measurement.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - Leveling dataset -->
		<h2 class="wovomlclass"><a name="data_deformation_levelingds" id="data_deformation_levelingds"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | andlt;LevelingDatasetandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;LevelingDataset instrument=andquot;...andquot; refStation=andquot;...andquot; secondBMStation=andquot;...andquot; secondBMStation=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#data_deformation_leveling">andlt;Levelingandgt;...andlt;/Levelingandgt;</a>
<strong>andlt;/LevelingDatasetandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains elevation changes between successive benchmarks of a leveling line.</p>

		<h3>Attributes</h3>
		<ul>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>refStation
				<ul>
					<li>Description: The code of the reference station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>firstBMStation
				<ul>
					<li>Description: The code of the first benchmark.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>secondBMStation
				<ul>
					<li>Description: The code of the second benchmark.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;Levelingandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_leveling">andlt;Levelingandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - Leveling -->
		<h2 class="wovomlclass"><a name="data_deformation_leveling" id="data_deformation_leveling"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | <a href="#data_deformation_levelingds">andlt;LevelingDatasetandgt;</a> | andlt;Levelingandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Leveling code=andquot;...andquot; instrument=andquot;...andquot; refStation=andquot;...andquot; secondBMStation=andquot;...andquot; secondBMStation=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	andlt;orderandgt;...andlt;/orderandgt;
	andlt;classandgt;...andlt;/classandgt;
	andlt;measTimeandgt;...andlt;/measTimeandgt;
	andlt;measTimeUncandgt;...andlt;/measTimeUncandgt;
	andlt;elevChangeandgt;...andlt;/elevChangeandgt;
	andlt;elevChangeUncandgt;...andlt;/elevChangeUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
<strong>andlt;/Levelingandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains elevation changes between successive benchmarks of a leveling line.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>refStation
				<ul>
					<li>Description: The code of the reference station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>firstBMStation
				<ul>
					<li>Description: The code of the first benchmark.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>secondBMStation
				<ul>
					<li>Description: The code of the second benchmark.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;orderandgt;
				<ul>
					<li>Description: The order of the survey.</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;classandgt;
				<ul>
					<li>Description: The class of the survey.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measTimeandgt;
				<ul>
					<li>Description: The survey time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;measTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the survey time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevChangeandgt;
				<ul>
					<li>Description: The elevation change in mm from the first benchmark to the second benchmark.</li>
					<li>Type: float</li>
					<li>Unit: mm</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevChangeUncandgt;
				<ul>
					<li>Description: The estimated error in the elevation change in mm from the first benchmark to the second benchmark.</li>
					<li>Type: float</li>
					<li>Unit: mm</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about the data including the original level of detail for the survey date (the year, the month, or the day).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - InSAR image dataset -->
		<h2 class="wovomlclass"><a name="data_deformation_insarimageds" id="data_deformation_insarimageds"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | andlt;InSARImageDatasetandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;InSARImageDataset instrument=andquot;...andquot; volcano=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#data_deformation_insarimage">andlt;InSARImageandgt;...andlt;/InSARImageandgt;</a>
<strong>andlt;/InSARImageDatasetandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about radar interferograms that show deformation of volcanoes. The original data are pairs of radar images, currently from a satellite such as ERS1, ERS2, Envisat, JERS, Radarsat, or (soon) PalSAR.</p>

		<h3>Attributes</h3>
		<ul>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>volcano
				<ul>
					<li>Description: The CAVW number of the volcano concerned by these data.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;InSARImageandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_insarimage">andlt;InSARImageandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - InSAR image -->
		<h2 class="wovomlclass"><a name="data_deformation_insarimage" id="data_deformation_insarimage"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | <a href="#data_deformation_insarimageds">andlt;InSARImageDatasetandgt;</a> | andlt;InSARImageandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;InSARImage code=andquot;...andquot; instrument=andquot;...andquot; volcano=andquot;...andquot; owner1=andquot;...andquot; owner2=andquot;...andquot; owner3=andquot;...andquot; pubDate=andquot;...andquot;andgt;</strong>
	<a href="#data_deformation_insarimage_satellites">andlt;Satellitesandgt;...andlt;/Satellitesandgt;</a>
	andlt;startLatandgt;...andlt;/startLatandgt;
	andlt;startLonandgt;...andlt;/startLonandgt;
	andlt;startPositionandgt;...andlt;/startPositionandgt;
	andlt;rowOrderandgt;...andlt;/rowOrderandgt;
	andlt;numbOfRowsandgt;...andlt;/numbOfRowsandgt;
	andlt;numbOfColsandgt;...andlt;/numbOfColsandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;nullValueandgt;...andlt;/nullValueandgt;
	andlt;locationandgt;...andlt;/locationandgt;
	andlt;pairandgt;...andlt;/pairandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;DEMandgt;...andlt;/DEMandgt;
	andlt;bytesOrderandgt;...andlt;/bytesOrderandgt;
	andlt;img1Timeandgt;...andlt;/img1Timeandgt;
	andlt;img1TimeUncandgt;...andlt;/img1TimeUncandgt;
	andlt;img2Timeandgt;...andlt;/img2Timeandgt;
	andlt;img2TimeUncandgt;...andlt;/img2TimeUncandgt;
	andlt;metersPixelSizeandgt;...andlt;/metersPixelSizeandgt;
	andlt;degreesPixelSizeandgt;...andlt;/degreesPixelSizeandgt;
	andlt;lookAngleandgt;...andlt;/lookAngleandgt;
	andlt;limbandgt;...andlt;/limbandgt;
	andlt;processMethodandgt;...andlt;/processMethodandgt;
	andlt;softwareandgt;...andlt;/softwareandgt;
	andlt;DEMQualityandgt;...andlt;/DEMQualityandgt;
	<a href="#data_deformation_insarimage_insarpixels">andlt;InSARPixelsandgt;...andlt;/InSARPixelsandgt;</a>
<strong>andlt;/InSARImageandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about radar interferograms that show deformation of volcanoes. The original data are pairs of radar images, currently from a satellite such as ERS1, ERS2, Envisat, JERS, Radarsat, or (soon) PalSAR.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
			<li>instrument
				<ul>
					<li>Description: The code of the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>volcano
				<ul>
					<li>Description: The CAVW number of the volcano concerned by these data.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner1
				<ul>
					<li>Description: The main owner of these data.</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner2
				<ul>
					<li>Description: The second owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>owner3
				<ul>
					<li>Description: The third owner of these data (if any).</li>
					<li>Type: string of at most 15 characters</li>
					<li>Required: No</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The publish date for these data.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Required: No</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;Satellitesandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_insarimage_satellites">andlt;Satellitesandgt;</a>.</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startLatandgt; AND andlt;startLonandgt;
				<ul>
					<li>Description: The latitude and longitude of the starting corner.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startPositionandgt;
				<ul>
					<li>Description: The starting position. Use BLC for bottom left corner or TLC for top left corner.</li>
					<li>Type: BLC, TLC <em>(Bottom Left Corner, Top Left Corner)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;rowOrderandgt;
				<ul>
					<li>Description: The order of the rows for example, left to right.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numbOfRowsandgt;
				<ul>
					<li>Description: The number of rows in the image.</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numbOfColsandgt;
				<ul>
					<li>Description: The number of columns in the image.</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units used in the image (e.g., mm).</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;nullValueandgt;
				<ul>
					<li>Description: The number used for fields without data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;locationandgt;
				<ul>
					<li>Description: The location of the image (e.g., This is Yellowstone).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;pairandgt;
				<ul>
					<li>Description: A flag indicating if the image is composed of a pair (P) of data, stacked data (S), or unknown (U).</li>
					<li>Type: P, S, U <em>(Pair, Stacked, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the image including a set of standard features, the number of satellite passes, and the time frame covered by the image (e.g., Norris uplift anomaly includes 3 images, one from Sept. 1996 to Sept 2000, one from Aug. 2000 to Aug 2001, and one from July 2001 to July 2002).</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;DEMandgt;
				<ul>
					<li>Description: The DEM used (e.g., 30m NED or SRTM).</li>
					<li>Type: string of at most 50 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;bytesOrderandgt;
				<ul>
					<li>Description: The order in which the bytes are stored and which bytes are most significant in multi-byte data types (e.g., big endian or little endian).</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;img1Timeandgt;
				<ul>
					<li>Description: The date of image 1 in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;img1TimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date of image 1.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;img2Timeandgt;
				<ul>
					<li>Description: The date of image 2 in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;img2TimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the date of image 2.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;metersPixelSizeandgt;
				<ul>
					<li>Description: The pixel size in meters.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;degreesPixelSizeandgt;
				<ul>
					<li>Description: The pixel size in decimal degrees.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;lookAngleandgt;
				<ul>
					<li>Description: The look angle.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;limbandgt;
				<ul>
					<li>Description: The limb. Use ASC for ascending or DES for descending.</li>
					<li>Type: ASC, DES <em>(ASCending, DEScending)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;processMethodandgt;
				<ul>
					<li>Description: The processing method.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;softwareandgt;
				<ul>
					<li>Description: The software used.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;DEMQualityandgt;
				<ul>
					<li>Description: The DEM quality, Use excellent (E) for 1m, good (G) for 10m, fair (F) for 100m, or unknown (U).</li>
					<li>Type: E, G, P, U <em>(Excellent (1m), Good (10m), Fair (100m), Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;InSARPixelsandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_insarimage_insarpixels">andlt;InSARPixelsandgt;</a>.</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - InSAR image - Satellites -->
		<h2 class="wovomlclass"><a name="data_deformation_insarimage_satellites" id="data_deformation_insarimage_satellites"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | <a href="#data_deformation_insarimageds">andlt;InSARImageDatasetandgt;</a> | <a href="#data_deformation_insarimage">andlt;InSARImageandgt;</a> | andlt;Satellitesandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Satellitesandgt;</strong>
	andlt;satelliteCodeandgt;...andlt;/satelliteCodeandgt;
<strong>andlt;/Satellitesandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains a list of satellite codes.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;satelliteCodeandgt;
				<ul>
					<li>Description: The code of a satellite in WOVOdat.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - InSAR image - InSAR image pixels -->
		<h2 class="wovomlclass"><a name="data_deformation_insarimage_insarpixels" id="data_deformation_insarimage_insarpixels"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | <a href="#data_deformation_insarimageds">andlt;InSARImageDatasetandgt;</a> | <a href="#data_deformation_insarimage">andlt;InSARImageandgt;</a> | andlt;InSARPixelsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;InSARPixelsandgt;</strong>
	<a href="#data_deformation_insarimage_insarpixels_insarpixel">andlt;InSARPixelandgt;...andlt;/InSARPixelandgt;</a>
<strong>andlt;/InSARPixelsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains the pixels collected by two satellites to create an InSAR image.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;InSARPixelandgt;
				<ul>
					<li>Description: See <a href="#data_deformation_insarimage_insarpixels_insarpixel">andlt;InSARPixelandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Deformation - InSAR image - InSAR image pixels - InSAR image pixel -->
		<h2 class="wovomlclass"><a name="data_deformation_insarimage_insarpixels_insarpixel" id="data_deformation_insarimage_insarpixels_insarpixel"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_deformation">andlt;Deformationandgt;</a> | <a href="#data_deformation_insarimage">andlt;InSARImageandgt;</a> | <a href="#data_deformation_insarimage_insarpixels">andlt;InSARPixelsandgt;</a> | andlt;InSARPixelandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;InSARPixel number=andquot;...andquot;andgt;</strong>
	andlt;rangeOfChangeandgt;...andlt;/rangeOfChangeandgt;
<strong>andlt;/InSARPixelandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains the data collected by two satellites to create an InSAR image.</p>

		<h3>Attributes</h3>
		<ul>
			<li>number
				<ul>
					<li>Description: The pixel number.</li>
					<li>Type: integer number</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;rangeOfChangeandgt;
				<ul>
					<li>Description: The range of change in mm.</li>
					<li>Type: float</li>
					<li>Unit: mm</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Gas -->
		<h2 class="wovomlclass"><a name="data_gas" id="data_gas"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | andlt;Gasandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Gasandgt;</strong>
	<a href="#data_gas_directlysampled">andlt;DirectlySampledandgt;...andlt;/DirectlySampledandgt;</a>
	<a href="#data_gas_soilefflux">andlt;SoilEffluxandgt;...andlt;/SoilEffluxandgt;</a>
	<a href="#data_gas_plume">andlt;Plumeandgt;...andlt;/Plumeandgt;</a>
<strong>andlt;/Gasandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about all gas data for a volcano.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;DirectlySampledandgt;
				<ul>
					<li>Description: See <a href="#data_gas_directlysampled">andlt;DirectlySampledandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;SoilEffluxandgt;
				<ul>
					<li>Description: See <a href="#data_gas_soilefflux">andlt;SoilEffluxandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;Plumeandgt;
				<ul>
					<li>Description: See <a href="#data_gas_plume">andlt;Plumeandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Gas - Directly sampled -->
		<h2 class="wovomlclass"><a name="data_gas_directlysampled" id="data_gas_directlysampled"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_gas">andlt;Gasandgt;</a> | andlt;DirectlySampledandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;DirectlySampled code=andquot;...andquot;andgt;</strong>
	andlt;instrumentCodeandgt;...andlt;/instrumentCodeandgt;		andlt;!-- OR andlt;stationCodeandgt;...andlt;/stationCodeandgt; --andgt;
	andlt;measTimeandgt;...andlt;/measTimeandgt;
	andlt;measTimeUncandgt;...andlt;/measTimeUncandgt;
	andlt;temperatureandgt;...andlt;/temperatureandgt;
	andlt;atmosPressandgt;...andlt;/atmosPressandgt;
	andlt;emissionRateandgt;...andlt;/emissionRateandgt;
	andlt;speciesandgt;...andlt;/speciesandgt;
	andlt;waterFreeandgt;...andlt;/waterFreeandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;concentrationandgt;...andlt;/concentrationandgt;
	andlt;concentrationUncandgt;...andlt;/concentrationUncandgt;
	andlt;recalculatedandgt;...andlt;/recalculatedandgt;
	andlt;environFactorsandgt;...andlt;/environFactorsandgt;
	andlt;sublimateMineralsandgt;...andlt;/sublimateMineralsandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
<strong>andlt;/DirectlySampledandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains gas data collected at ground sites. Data include the gas temperature, concentrations, and environmental factors.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;instrumentCodeandgt; OR andlt;stationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the instrument/station which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;continuousandgt;
				<ul>
					<li>Description: A single character field used to identify continuous data. Use C for data that were collected continuously or P for data that were collected periodically.</li>
					<li>Type: C, P <em>(Continuous, Periodically)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measTimeandgt;
				<ul>
					<li>Description: The measurement time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the measurement time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;temperatureandgt;
				<ul>
					<li>Description: The gas temperature in degrees Celsius.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;C</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;atmosPressandgt;
				<ul>
					<li>Description: The atmospheric pressure in millibars at the time of measurement.</li>
					<li>Type: float</li>
					<li>Unit: mbar</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;emissionRateandgt;
				<ul>
					<li>Description: The measured gas emission rate.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;speciesandgt;
				<ul>
					<li>Description: Species or ratio of gas reported.</li>
					<li>Type: CO2, SO2, H2S, HCl, HF, CH4, H2, CO, 3He4He, d13C, d34S, d18O, dD</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;waterFreeandgt;
				<ul>
					<li>Description: A single character field used to indicate whether the value is calculated for water-free regime.</li>
					<li>Type: Y, N <em>(Yes, No)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units reported for the species below, e.g., vol % or wt %.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;concentrationandgt;
				<ul>
					<li>Description: The measured concentration.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;concentrationUncandgt;
				<ul>
					<li>Description: The estimated uncertainty in concentration.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;recalculatedandgt;
				<ul>
					<li>Description: A single character field used to know if the value is directly from measurement (O for Original) or recalculated from other parameters (R for Recalculated).</li>
					<li>Type: O, R <em>(Original, Recalculated)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;environFactorsandgt;
				<ul>
					<li>Description: Comments on environmental factors, e.g., snowpack, groundwater masking.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;sublimateMineralsandgt;
				<ul>
					<li>Description: Information on sublimate minerals.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Additional comments, e.g., tree kill, dead animals, etc.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Gas - Soil efflux -->
		<h2 class="wovomlclass"><a name="data_gas_soilefflux" id="data_gas_soilefflux"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_gas">andlt;Gasandgt;</a> | andlt;SoilEffluxandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SoilEfflux code=andquot;...andquot;andgt;</strong>
	andlt;instrumentCodeandgt;...andlt;/instrumentCodeandgt;		andlt;!-- OR andlt;stationCodeandgt;...andlt;/stationCodeandgt; --andgt;
	andlt;measTimeandgt;...andlt;/measTimeandgt;
	andlt;measTimeUncandgt;...andlt;/measTimeUncandgt;
	andlt;speciesandgt;...andlt;/speciesandgt;
	andlt;totalFluxandgt;...andlt;/totalFluxandgt;
	andlt;totalFluxUncandgt;...andlt;/totalFluxUncandgt;
	andlt;numberOfPointsandgt;...andlt;/numberOfPointsandgt;
	andlt;areaandgt;...andlt;/areaandgt;
	andlt;highestFluxandgt;...andlt;/highestFluxandgt;
	andlt;highestTempandgt;...andlt;/highestTempandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
<strong>andlt;/SoilEffluxandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains a daily total flux value for an individual gas species.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;instrumentCodeandgt; OR andlt;stationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the instrument/station which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;measTimeandgt;
				<ul>
					<li>Description: The measurement time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the measurement time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;speciesandgt;
				<ul>
					<li>Description: The type of gas measured (CO<sub>2</sub>, Radon, etc.).</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;totalFluxandgt;
				<ul>
					<li>Description: The total flux value in t/d.</li>
					<li>Type: float</li>
					<li>Unit: t/d</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;totalFluxUncandgt;
				<ul>
					<li>Description: The uncertainty in the flux value in t/d.</li>
					<li>Type: float</li>
					<li>Unit: t/d</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numberOfPointsandgt;
				<ul>
					<li>Description: The number of points measured.</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;areaandgt;
				<ul>
					<li>Description: The area measured in m<sup>2</sup>.</li>
					<li>Type: float</li>
					<li>Unit: m<sup>2</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;highestFluxandgt;
				<ul>
					<li>Description: The highest individual flux for the measured species in g/m<sup>2</sup>/d.</li>
					<li>Type: float</li>
					<li>Unit: g/m<sup>2</sup>/d</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;highestTempandgt;
				<ul>
					<li>Description: The highest measured temperature in degrees Celsius if the measurement was from a geothermal area.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;C</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about the measurement including information about the weather such as snow on the ground.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Gas - Plume -->
		<h2 class="wovomlclass"><a name="data_gas_plume" id="data_gas_plume"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_gas">andlt;Gasandgt;</a> | andlt;Plumeandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Plume code=andquot;...andquot;andgt;</strong>
	andlt;volcanoCodeandgt;...andlt;/volcanoCodeandgt;
	andlt;instrumentCodeandgt;...andlt;/instrumentCodeandgt;		andlt;!-- OR andlt;stationCodeandgt;...andlt;/stationCodeandgt; --andgt;
	andlt;latandgt;...andlt;/latandgt;
	andlt;lonandgt;...andlt;/lonandgt;
	andlt;heightandgt;...andlt;/heightandgt;
	andlt;heightDeterminationandgt;...andlt;/heightDeterminationandgt;
	andlt;measTimeandgt;...andlt;/measTimeandgt;
	andlt;measTimeUncandgt;...andlt;/measTimeUncandgt;
	andlt;speciesandgt;...andlt;/speciesandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;emissionRateandgt;...andlt;/emissionRateandgt;
	andlt;emissionRateUncandgt;...andlt;/emissionRateUncandgt;
	andlt;recalculatedandgt;...andlt;/recalculatedandgt;
	andlt;windSpeedandgt;...andlt;/windSpeedandgt;
	andlt;weatherNotesandgt;...andlt;/weatherNotesandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
<strong>andlt;/Plumeandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains gas data collected from a plume including the location of the vent, the height of the plume, and the gas emission rates.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;volcanoCodeandgt;
				<ul>
					<li>Description: The code of the volcano to which the data refer.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;instrumentCodeandgt; OR andlt;stationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the instrument/station which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;latandgt; AND andlt;lonandgt;
				<ul>
					<li>Description: The latitude and longitude in decimal degrees.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;heightandgt;
				<ul>
					<li>Description: The height of the plume in km.</li>
					<li>Type: float</li>
					<li>Unit: km</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;heightDeterminationandgt;
				<ul>
					<li>Description: The method used to determine the height of the plume.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measTimeandgt;
				<ul>
					<li>Description: The measurement time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the measurement time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;speciesandgt;
				<ul>
					<li>Description: Species of gas reported.</li>
					<li>Type: CO2, SO2, H2S, HCl, HF, CO</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units reported for the species below, e.g., vol % or wt %.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;emissionRateandgt;
				<ul>
					<li>Description: The gas emission rate in the plume in the units reported in gd_plu_units.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;emissionRateUncandgt;
				<ul>
					<li>Description: The gas standard error in the units reported in gd_plu_units.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;recalculatedandgt;
				<ul>
					<li>Description: A single character field used to know if the value is directly from measurement (O for Original) or recalculated from other parameters (R for Recalculated).</li>
					<li>Type: O, R <em>(Original, Recalculated)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;windSpeedandgt;
				<ul>
					<li>Description: The estimated wind speed at plume height in m/s.</li>
					<li>Type: float</li>
					<li>Unit: m/s</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;weatherNotesandgt;
				<ul>
					<li>Description: Notes on the weather for example information on cloud cover, rain, ambient temperature, etc.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Additional comments about the plume such as the shape and size, and how the plume data was collected.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Hydrologic -->
		<h2 class="wovomlclass"><a name="data_hydrologic" id="data_hydrologic"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | andlt;Hydrologicandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Hydrologicandgt;</strong>
	<a href="#data_hydrologic_sample">andlt;Sampleandgt;...andlt;/Sampleandgt;</a>
<strong>andlt;/Hydrologicandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains all of the water data including daily data and data obtained from sample analysis.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;Sampleandgt;
				<ul>
					<li>Description: See <a href="#data_hydrologic_sample">andlt;Sampleandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Hydrologic - Sample -->
		<h2 class="wovomlclass"><a name="data_hydrologic_sample" id="data_hydrologic_sample"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_hydrologic">andlt;Hydrologicandgt;</a> | andlt;Sampleandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Sample code=andquot;...andquot;andgt;</strong>
	andlt;instrumentCodeandgt;...andlt;/instrumentCodeandgt;		andlt;!-- OR andlt;stationCodeandgt;...andlt;/stationCodeandgt; --andgt;
	andlt;measTimeandgt;...andlt;/measTimeandgt;
	andlt;measTimeUncandgt;...andlt;/measTimeUncandgt;
	andlt;temperatureandgt;...andlt;/temperatureandgt;
	andlt;elevandgt;...andlt;/elevandgt;
	andlt;depthandgt;...andlt;/depthandgt;
	andlt;waterLevelChangeandgt;...andlt;/waterLevelChangeandgt;
	andlt;atmosPressandgt;...andlt;/atmosPressandgt;
	andlt;springDischRateandgt;...andlt;/springDischRateandgt;
	andlt;precipitationandgt;...andlt;/precipitationandgt;
	andlt;dailyPrecipitationandgt;...andlt;/dailyPrecipitationandgt;
	andlt;precipitationTypeandgt;...andlt;/precipitationTypeandgt;
	andlt;pHandgt;...andlt;/pHandgt;
	andlt;pHUncandgt;...andlt;/pHUncandgt;
	andlt;conductivityandgt;...andlt;/conductivityandgt;
	andlt;conductivityUncandgt;...andlt;/conductivityUncandgt;
	andlt;speciesandgt;...andlt;/speciesandgt;
	andlt;unitsandgt;...andlt;/unitsandgt;
	andlt;contentandgt;...andlt;/contentandgt;
	andlt;contentUncandgt;...andlt;/contentUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
<strong>andlt;/Sampleandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains hydrologic data from sample analysis.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;instrumentCodeandgt; OR andlt;stationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the instrument/station which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;measTimeandgt;
				<ul>
					<li>Description: The measurement time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the measurement time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;temperatureandgt;
				<ul>
					<li>Description: The temperature of the water in degrees Celsius.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;C</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevandgt;
				<ul>
					<li>Description: The elevation of the water level in meters above sea level, if available.</li>
					<li>Type: double</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;depthandgt;
				<ul>
					<li>Description: The water depth in meters below the ground surface, if available.</li>
					<li>Type: double</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;waterLevelChangeandgt;
				<ul>
					<li>Description: The change in water level in meters if the water depth and water elevation are not available.</li>
					<li>Type: double</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;atmosPressandgt;
				<ul>
					<li>Description: The atmospheric pressure in millibars at the time of measurement.</li>
					<li>Type: float</li>
					<li>Unit: mbar</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;springDischRateandgt;
				<ul>
					<li>Description: The measured spring discharge rate in liters per second.</li>
					<li>Type: double</li>
					<li>Unit: L/s</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;precipitationandgt;
				<ul>
					<li>Description: The amount of precipitation in millimeters for this measurement.</li>
					<li>Type: float</li>
					<li>Unit: mm</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;dailyPrecipitationandgt;
				<ul>
					<li>Description: The precipitation in millimeters for the preceding day.</li>
					<li>Type: float</li>
					<li>Unit: mm</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;precipitationTypeandgt;
				<ul>
					<li>Description: The precipitation type. Use R for rain, FR for freezing rain or sleet, S for snow, H for hail, or any combination of the above.</li>
					<li>Type: R, FR, S, H, R-FR, R-S, R-H, FR-R, FR-S, FR-H, S-R, S-FR, S-H, H-R, H-FR, H-S <em>(Rain, Freezing Rain, Snow, Hail, combinations of those)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;pHandgt;
				<ul>
					<li>Description: The pH of the water.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;pHUncandgt;
				<ul>
					<li>Description: The standard error in the measured pH of the water.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;conductivityandgt;
				<ul>
					<li>Description: The measured conductivity in micromhos/cm (microSiemens/cm).</li>
					<li>Type: float</li>
					<li>Unit: andmu;mhos/cm, andmu;S/cm</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;conductivityUncandgt;
				<ul>
					<li>Description: The standard error in measured conductivity in micromhos/cm (microSiemens/cm).</li>
					<li>Type: float</li>
					<li>Unit: andmu;mhos/cm, andmu;S/cm</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;speciesandgt;
				<ul>
					<li>Description: Type of compound, kation, anion or ratio.</li>
					<li>Type: SO4, H2S, Cl, F, HCO3, Mg, Fe, Ca, Na, K, 3He4He, c3He4He, d13C, d34S, dD, d18O</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;unitsandgt;
				<ul>
					<li>Description: The units reported for the emission rates below, e.g., t/d or kg/s.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;contentandgt;
				<ul>
					<li>Description: The measured content in unit mentioned in hd_comp_units.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;contentUncandgt;
				<ul>
					<li>Description: The measured content standard error in unit mentioned in hd_comp_units.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about the measurement and about precipitation over the past month.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Fields -->
		<h2 class="wovomlclass"><a name="data_fields" id="data_fields"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | andlt;Fieldsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Fieldsandgt;</strong>
	<a href="#data_fields_magnetic">andlt;Magneticandgt;...andlt;/Magneticandgt;</a>
	<a href="#data_fields_magneticvector">andlt;MagneticVectorandgt;...andlt;/MagneticVectorandgt;</a>
	<a href="#data_fields_electric">andlt;Electricandgt;...andlt;/Electricandgt;</a>
	<a href="#data_fields_gravity">andlt;Gravityandgt;...andlt;/Gravityandgt;</a>
<strong>andlt;/Fieldsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about all fields data for a volcano.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;Magneticandgt;
				<ul>
					<li>Description: See <a href="#data_fields_magnetic">andlt;Magneticandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;MagneticVectorandgt;
				<ul>
					<li>Description: See <a href="#data_fields_magneticvector">andlt;MagneticVectorandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;Electricandgt;
				<ul>
					<li>Description: See <a href="#data_fields_electric">andlt;Electricandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;Gravityandgt;
				<ul>
					<li>Description: See <a href="#data_fields_gravity">andlt;Gravityandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Fields - Magnetic -->
		<h2 class="wovomlclass"><a name="data_fields_magnetic" id="data_fields_magnetic"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_fields">andlt;Fieldsandgt;</a> | andlt;Magneticandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Magnetic code=andquot;...andquot;andgt;</strong>
	andlt;instrumentCodeandgt;...andlt;/instrumentCodeandgt;		andlt;!-- OR andlt;stationCodeandgt;...andlt;/stationCodeandgt; --andgt;
	andlt;refStationCodeandgt;...andlt;/refStationCodeandgt;
	andlt;measTimeandgt;...andlt;/measTimeandgt;
	andlt;measTimeUncandgt;...andlt;/measTimeUncandgt;
	andlt;Fandgt;...andlt;/Fandgt;
	andlt;FUncandgt;...andlt;/FUncandgt;
	andlt;Xandgt;...andlt;/Xandgt;
	andlt;XUncandgt;...andlt;/XUncandgt;
	andlt;Yandgt;...andlt;/Yandgt;
	andlt;YUncandgt;...andlt;/YUncandgt;
	andlt;Zandgt;...andlt;/Zandgt;
	andlt;ZUncandgt;...andlt;/ZUncandgt;
	andlt;highPassandgt;...andlt;/highPassandgt;
	andlt;lowPassandgt;...andlt;/lowPassandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
<strong>andlt;/Magneticandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains magnetic data that were collected digitally.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;instrumentCodeandgt; OR andlt;stationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the instrument/station which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;refStationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the reference station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measTimeandgt;
				<ul>
					<li>Description: The measurement time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the measurement time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Fandgt;
				<ul>
					<li>Description: The total field strength in nanoteslas.</li>
					<li>Type: double</li>
					<li>Unit: nT</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;FUncandgt;
				<ul>
					<li>Description: The total field strength uncertainty in nanoteslas.</li>
					<li>Type: float</li>
					<li>Unit: nT</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Xandgt;
				<ul>
					<li>Description: The x component in nanoteslas.</li>
					<li>Type: double</li>
					<li>Unit: nT</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;XUncandgt;
				<ul>
					<li>Description: The uncertainty in the x component measurement in nanoteslas.</li>
					<li>Type: float</li>
					<li>Unit: nT</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Yandgt;
				<ul>
					<li>Description: The y component in nanoteslas.</li>
					<li>Type: double</li>
					<li>Unit: nT</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;YUncandgt;
				<ul>
					<li>Description: The uncertainty in the y component measurement in nanoteslas.</li>
					<li>Type: float</li>
					<li>Unit: nT</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Zandgt;
				<ul>
					<li>Description: The z component in nanoteslas.</li>
					<li>Type: double</li>
					<li>Unit: nT</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ZUncandgt;
				<ul>
					<li>Description: The uncertainty in the z component measurement in nanoteslas.</li>
					<li>Type: float</li>
					<li>Unit: nT</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;highPassandgt;
				<ul>
					<li>Description: The high pass filter frequency value in Hz above which signals are used (passed).</li>
					<li>Type: float</li>
					<li>Unit: Hz</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;lowPassandgt;
				<ul>
					<li>Description: The low pass filter frequency value in Hz below which signals are used (passed).</li>
					<li>Type: float</li>
					<li>Unit: Hz</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments on the magnetic measurements.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Fields - Magnetic vector -->
		<h2 class="wovomlclass"><a name="data_fields_magneticvector" id="data_fields_magneticvector"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_fields">andlt;Fieldsandgt;</a> | andlt;MagneticVectorandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;MagneticVector code=andquot;...andquot;andgt;</strong>
	andlt;instrumentCodeandgt;...andlt;/instrumentCodeandgt;		andlt;!-- OR andlt;stationCodeandgt;...andlt;/stationCodeandgt; --andgt;
	andlt;refStationCodeandgt;...andlt;/refStationCodeandgt;
	andlt;continuousandgt;...andlt;/continuousandgt;
	andlt;measTimeandgt;...andlt;/measTimeandgt;
	andlt;measTimeUncandgt;...andlt;/measTimeUncandgt;
	andlt;Fandgt;...andlt;/Fandgt;
	andlt;FUncandgt;...andlt;/FUncandgt;
	andlt;Xandgt;...andlt;/Xandgt;
	andlt;XUncandgt;...andlt;/XUncandgt;
	andlt;Yandgt;...andlt;/Yandgt;
	andlt;YUncandgt;...andlt;/YUncandgt;
	andlt;Zandgt;...andlt;/Zandgt;
	andlt;ZUncandgt;...andlt;/ZUncandgt;
	andlt;highPassandgt;...andlt;/highPassandgt;
	andlt;lowPassandgt;...andlt;/lowPassandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
<strong>andlt;/MagneticVectorandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains magnetic vector data for which the data for the individual components is unavailable.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;instrumentCodeandgt; OR andlt;stationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the instrument/station which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;measTimeandgt;
				<ul>
					<li>Description: The measurement time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the measurement time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;declinationandgt;
				<ul>
					<li>Description: The declination in degrees from 0 to 360.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;inclinationandgt;
				<ul>
					<li>Description: The inclination in degrees from 0 to 90.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 90 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Fields - Electric -->
		<h2 class="wovomlclass"><a name="data_fields_electric" id="data_fields_electric"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_fields">andlt;Fieldsandgt;</a> | andlt;Electricandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Electric code=andquot;...andquot;andgt;</strong>
	andlt;instrumentCodeandgt;...andlt;/instrumentCodeandgt;
	andlt;refStation1Codeandgt;...andlt;/refStation1Codeandgt;
	andlt;refStation2Codeandgt;...andlt;/refStation2Codeandgt;
	andlt;measTimeandgt;...andlt;/measTimeandgt;
	andlt;measTimeUncandgt;...andlt;/measTimeUncandgt;
	andlt;fieldandgt;...andlt;/fieldandgt;
	andlt;fieldUncandgt;...andlt;/fieldUncandgt;
	andlt;directionandgt;...andlt;/directionandgt;
	andlt;highPassandgt;...andlt;/highPassandgt;
	andlt;lowPassandgt;...andlt;/lowPassandgt;
	andlt;selfPotentialandgt;...andlt;/selfPotentialandgt;
	andlt;selfPotentialUncandgt;...andlt;/selfPotentialUncandgt;
	andlt;apparentResistivityandgt;...andlt;/apparentResistivityandgt;
	andlt;apparentResistivityUncandgt;...andlt;/apparentResistivityUncandgt;
	andlt;directResistivityandgt;...andlt;/directResistivityandgt;
	andlt;directResistivityUncandgt;...andlt;/directResistivityUncandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
<strong>andlt;/Electricandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains electric data in digital form.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;instrumentCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the instrument which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;refStation1Codeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the electric fields station information from which the electrode is subtracted (station A in the equation A - B).</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;refStation2Codeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the electric fields station information for the electrode that's being subtracted (station B in the equation A - B).</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measTimeandgt;
				<ul>
					<li>Description: The measurement time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the measurement time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;fieldandgt;
				<ul>
					<li>Description: The electric field in mV (difference/distance).</li>
					<li>Type: float</li>
					<li>Unit: mV</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;fieldUncandgt;
				<ul>
					<li>Description: Electric field uncertainty in mV.</li>
					<li>Type: float</li>
					<li>Unit: mV</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;directionandgt;
				<ul>
					<li>Description: The direction from station 1 to station 2 in degrees from 0 to 360 with respect to geodetic north.</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;highPassandgt;
				<ul>
					<li>Description: The high pass filter frequency value in Hz above which signals are used (passed).</li>
					<li>Type: float</li>
					<li>Unit: Hz</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;lowPassandgt;
				<ul>
					<li>Description: The low pass filter frequency value in Hz below which signals are used (passed).</li>
					<li>Type: float</li>
					<li>Unit: Hz</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;selfPotentialandgt;
				<ul>
					<li>Description: The self potential in mV between station 1 (A) and station 2 (B) (i.e., 1-2, or A-B).</li>
					<li>Type: float</li>
					<li>Unit: mV</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;selfPotentialUncandgt;
				<ul>
					<li>Description: The self potential uncertainty in mV.</li>
					<li>Type: float</li>
					<li>Unit: mV</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;apparentResistivityandgt;
				<ul>
					<li>Description: The apparent resistivity in ohm-m.</li>
					<li>Type: float</li>
					<li>Unit: andOmega; m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;apparentResistivityUncandgt;
				<ul>
					<li>Description: The uncertainty in apparent resistivity in ohm-m.</li>
					<li>Type: float</li>
					<li>Unit: andOmega; m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;directResistivityandgt;
				<ul>
					<li>Description: The direct resistivity in ohm-m.</li>
					<li>Type: float</li>
					<li>Unit: andOmega; m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;directResistivityUncandgt;
				<ul>
					<li>Description: The uncertainty in direct resistivity in ohm-m.</li>
					<li>Type: float</li>
					<li>Unit: andOmega; m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Any comments about the measurements.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Fields - Gravity -->
		<h2 class="wovomlclass"><a name="data_fields_gravity" id="data_fields_gravity"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_fields">andlt;Fieldsandgt;</a> | andlt;Gravityandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Gravity code=andquot;...andquot;andgt;</strong>
	andlt;instrumentCodeandgt;...andlt;/instrumentCodeandgt;		andlt;!-- OR andlt;stationCodeandgt;...andlt;/stationCodeandgt; --andgt;
	andlt;refStationCodeandgt;...andlt;/refStationCodeandgt;
	andlt;measTimeandgt;...andlt;/measTimeandgt;
	andlt;measTimeUncandgt;...andlt;/measTimeUncandgt;
	andlt;fieldStrengthandgt;...andlt;/fieldStrengthandgt;
	andlt;fieldStrengthUncandgt;...andlt;/fieldStrengthUncandgt;
	andlt;assocVertDisplandgt;...andlt;/assocVertDisplandgt;
	andlt;assocGWaterLevelandgt;...andlt;/assocGWaterLevelandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
<strong>andlt;/Gravityandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains gravity data such as field strength and associated vertical displacement.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;instrumentCodeandgt; OR andlt;stationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the instrument/station which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;refStationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the reference station.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measTimeandgt;
				<ul>
					<li>Description: The measurement time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the measurement time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;fieldStrengthandgt;
				<ul>
					<li>Description: The field strength in Gal corrected for tides.</li>
					<li>Type: double</li>
					<li>Unit: Gal</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;fieldStrengthUncandgt;
				<ul>
					<li>Description: The field strength uncertainty in Gal.</li>
					<li>Type: double</li>
					<li>Unit: Gal</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;assocVertDisplandgt;
				<ul>
					<li>Description: Comments on associated vertical displacement. Use the letters Y for yes, U for unknown and N for none in front of the comments.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;assocGWaterLevelandgt;
				<ul>
					<li>Description: Comments on associated change in groundwater level. Use the letters Y for yes, U for unknown and N for none in front of the comments.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Comments about the measurements.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Thermal -->
		<h2 class="wovomlclass"><a name="data_thermal" id="data_thermal"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | andlt;Thermalandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Thermalandgt;</strong>
	<a href="#data_thermal_ground-based">andlt;Ground-basedandgt;...andlt;/Ground-basedandgt;</a>
	<a href="#data_thermal_thermalimage">andlt;ThermalImageandgt;...andlt;/ThermalImageandgt;</a>
<strong>andlt;/Thermalandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about all thermal data for a volcano.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;Ground-basedandgt;
				<ul>
					<li>Description: See <a href="#data_thermal_ground-based">andlt;Ground-basedandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;ThermalImageandgt;
				<ul>
					<li>Description: See <a href="#data_thermal_thermalimage">andlt;ThermalImageandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Thermal - Ground-based -->
		<h2 class="wovomlclass"><a name="data_thermal_ground-based" id="data_thermal_ground-based"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_thermal">andlt;Thermalandgt;</a> | andlt;Ground-basedandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Ground-based code=andquot;...andquot;andgt;</strong>
	andlt;instrumentCodeandgt;...andlt;/instrumentCodeandgt;		andlt;!-- OR andlt;stationCodeandgt;...andlt;/stationCodeandgt; --andgt;
	andlt;measTypeandgt;...andlt;/measTypeandgt;
	andlt;measTimeandgt;...andlt;/measTimeandgt;
	andlt;measTimeUncandgt;...andlt;/measTimeUncandgt;
	andlt;measDepthandgt;...andlt;/measDepthandgt;
	andlt;distanceandgt;...andlt;/distanceandgt;
	andlt;recalculatedandgt;...andlt;/recalculatedandgt;
	andlt;temperatureandgt;...andlt;/temperatureandgt;
	andlt;temperatureUncandgt;...andlt;/temperatureUncandgt;
	andlt;areaandgt;...andlt;/areaandgt;
	andlt;heatFluxandgt;...andlt;/heatFluxandgt;
	andlt;heatFluxUncandgt;...andlt;/heatFluxUncandgt;
	andlt;bgGeothermGradientandgt;...andlt;/bgGeothermGradientandgt;
	andlt;conductivityandgt;...andlt;/conductivityandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
<strong>andlt;/Ground-basedandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains all of the thermal data collected on the ground.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;instrumentCodeandgt; OR andlt;stationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the instrument/station which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;measTypeandgt;
				<ul>
					<li>Description: The type of measurement, for example, thermocouple or thermal IR.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measTimeandgt;
				<ul>
					<li>Description: The measurement time in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the measurement time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;measDepthandgt;
				<ul>
					<li>Description: The depth of the measurement in meters below the ground surface.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;distanceandgt;
				<ul>
					<li>Description: The distance of the instrument from the object measured. This field is used in the case when the measurement is done remotely.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;recalculatedandgt;
				<ul>
					<li>Description: The flag to indicate if the value is directly measured (O), or recalculated from other parameter (R).</li>
					<li>Type: O, R <em>(Original value, Recalculated value)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;temperatureandgt;
				<ul>
					<li>Description: The measured temperature in degrees Celsius.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;C</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;temperatureUncandgt;
				<ul>
					<li>Description: The standard error or precision of the temperature in degrees Celsius.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;C</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;areaandgt;
				<ul>
					<li>Description: The approximate area of of the body measured in meters squared.</li>
					<li>Type: float</li>
					<li>Unit: m<sup>2</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;heatFluxandgt;
				<ul>
					<li>Description: The heat flux in W/m<sup>2</sup>.</li>
					<li>Type: float</li>
					<li>Unit: W/m<sup>2</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;heatFluxUncandgt;
				<ul>
					<li>Description: The standard error or precision of flux in W/m<sup>2</sup>.</li>
					<li>Type: float</li>
					<li>Unit: W/m<sup>2</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;bgGeothermGradientandgt;
				<ul>
					<li>Description: The regional background geothermal gradient in deg Celsius/km.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;C/km</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;conductivityandgt;
				<ul>
					<li>Description: The thermal conductivity at the station or measurement point, in W/(m<sup>2</sup> degC). This value is either inferred from the soil type or measured intrinsically, and used to derive heat flux with the help of Fick's law.</li>
					<li>Type: float</li>
					<li>Unit: W/(m<sup>2</sup>anddeg;C)</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Additional comments on the heat flux and thermal conductivity including if they inferred or measured.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Thermal - Thermal image -->
		<h2 class="wovomlclass"><a name="data_thermal_thermalimage" id="data_thermal_thermalimage"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_thermal">andlt;Thermalandgt;</a> | andlt;ThermalImageandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;ThermalImage code=andquot;...andquot;andgt;</strong>
	andlt;volcanoCodeandgt;...andlt;/volcanoCodeandgt;
	andlt;instrumentCodeandgt;...andlt;/instrumentCodeandgt;		andlt;!-- OR andlt;stationCodeandgt;...andlt;/stationCodeandgt; OR andlt;satelliteCodeandgt;...andlt;/satelliteCodeandgt; OR andlt;airplaneCodeandgt;...andlt;/airplaneCodeandgt; --andgt;
	andlt;instPlatformandgt;...andlt;/instPlatformandgt;
	andlt;instLatandgt;...andlt;/instLatandgt;
	andlt;instLonandgt;...andlt;/instLonandgt;
	andlt;datumandgt;...andlt;/datumandgt;
	andlt;instAltandgt;...andlt;/instAltandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;timeandgt;...andlt;/timeandgt;
	andlt;timeUncandgt;...andlt;/timeUncandgt;
	andlt;bandNameandgt;...andlt;/bandNameandgt;
	andlt;highBandWavelengthandgt;...andlt;/highBandWavelengthandgt;
	andlt;lowBandWavelengthandgt;...andlt;/lowBandWavelengthandgt;
	andlt;pixelSizeandgt;...andlt;/pixelSizeandgt;
	andlt;maxRadianceandgt;...andlt;/maxRadianceandgt;
	andlt;maxRelativeRadianceandgt;...andlt;/maxRelativeRadianceandgt;
	andlt;hottestPixelTempandgt;...andlt;/hottestPixelTempandgt;
	andlt;totRadianceandgt;...andlt;/totRadianceandgt;
	andlt;maxHeatFluxandgt;...andlt;/maxHeatFluxandgt;
	andlt;nominalTempResandgt;...andlt;/nominalTempResandgt;
	andlt;atmosCorrectionandgt;...andlt;/atmosCorrectionandgt;
	andlt;thermCorrectionandgt;...andlt;/thermCorrectionandgt;
	andlt;orthorecProcandgt;...andlt;/orthorecProcandgt;
	andlt;commentsandgt;...andlt;/commentsandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
	<a href="#data_thermal_thermalimage_thermalpixels">andlt;ThermalPixelsandgt;...andlt;/ThermalPixelsandgt;</a>
<strong>andlt;/ThermalImageandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains data collected from space, the air, or the ground that are used to create thermal images.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;volcanoCodeandgt;
				<ul>
					<li>Description: The code of the volcano to which the data refer.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;instrumentCodeandgt; OR andlt;stationCodeandgt; OR andlt;satelliteCodeandgt; OR andlt;airplaneCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the instrument/station/satellite/airplane which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;instPlatformandgt;
				<ul>
					<li>Description: A description of the instrument platform, for example on an airplane or satellite, or on a crater rim or roof of a hut.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;instLatandgt; AND andlt;instLonandgt;
				<ul>
					<li>Description: The latitude and longitude of the instrument during recording of image in decimal degrees. Please enter the location information for instruments on moving objects only.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;datumandgt;
				<ul>
					<li>Description: The datum used for the longitude and latitude. Please also include the original datum.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;instAltandgt;
				<ul>
					<li>Description: The altitude of the instrument during recording of image in meters above sea level. Please enter the location information for instruments on moving objects only.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the thermal image, for example a hot spot at summit that has increased in temperature over the past week.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;timeandgt;
				<ul>
					<li>Description: The time the image was taken in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;timeUncandgt;
				<ul>
					<li>Description: The uncertainty in the time the image was taken.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;bandNameandgt;
				<ul>
					<li>Description: The band name where each band is separated by a comma.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;highBandWavelengthandgt;
				<ul>
					<li>Description: The high value of the band wavelength range in microns.</li>
					<li>Type: float</li>
					<li>Unit: andmu;m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;lowBandWavelengthandgt;
				<ul>
					<li>Description: The low value of the band wavelength range in microns.</li>
					<li>Type: float</li>
					<li>Unit: andmu;m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;pixelSizeandgt;
				<ul>
					<li>Description: The pixel size in meters.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxRadianceandgt;
				<ul>
					<li>Description: The maximum radiance of any pixel in the frame in W/(m<sup>2</sup>-m) andtimes; 10<sup>7</sup>.</li>
					<li>Type: float</li>
					<li>Unit: W/(m<sup>2</sup>-m) andtimes; 10<sup>7</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxRelativeRadianceandgt;
				<ul>
					<li>Description: The maximum relative radiance of any pixel in the frame in W/(m<sup>2</sup>-m andtimes; sr) andtimes; 10<sup>7</sup> where sr is spectral radiance, which is wavelength dependent.</li>
					<li>Type: float</li>
					<li>Unit: W/(m<sup>2</sup>-m andtimes; sr) andtimes; 10<sup>7</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;hottestPixelTempandgt;
				<ul>
					<li>Description: The temperature of the hottest pixel (if calibrated) in degrees Celsius.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;C</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;totRadianceandgt;
				<ul>
					<li>Description: Total radiance in the whole surface of the frame. This is an integration of all pixels radiances.</li>
					<li>Type: float</li>
					<li>Unit: W/(m<sup>2</sup>-m) andtimes; 10<sup>7</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxHeatFluxandgt;
				<ul>
					<li>Description: The heat flux of the hottest pixel in W/m<sup>2</sup>.</li>
					<li>Type: float</li>
					<li>Unit: W/m<sup>2</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;nominalTempResandgt;
				<ul>
					<li>Description: The nominal temperature resolution (per pixel) in degrees Celsius.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;C</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;atmosCorrectionandgt;
				<ul>
					<li>Description: The type of atmospheric correction procedure / method applied.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;thermCorrectionandgt;
				<ul>
					<li>Description: The type of thermal correction procedure / method applied using ground truth points.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;orthorecProcandgt;
				<ul>
					<li>Description: The type of orthorectification procedure used, for example ESRI tool, rubber sheeting, etc.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;commentsandgt;
				<ul>
					<li>Description: Additional comments on the measurement, instrument, etc.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ThermalPixelsandgt;
				<ul>
					<li>Description: See <a href="#data_thermal_thermalimage_thermalpixels">andlt;ThermalPixelsandgt;</a>.</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Thermal - Thermal image - Thermal pixels -->
		<h2 class="wovomlclass"><a name="data_thermal_thermalimage_thermalpixels" id="data_thermal_thermalimage_thermalpixels"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_thermal">andlt;Thermalandgt;</a> | <a href="#data_thermal_thermalimage">andlt;ThermalImageandgt;</a> | andlt;ThermalPixelsandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;ThermalPixels</strong>
	<a href="#data_thermal_thermalimage_thermalpixels_thermalpixel">andlt;ThermalPixelandgt;...andlt;/ThermalPixelandgt;</a>
<strong>andlt;/ThermalPixelsandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains every pixels of a thermal image.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;ThermalPixelandgt;
				<ul>
					<li>Description: See <a href="#data_thermal_thermalimage_thermalpixels_thermalpixel">andlt;ThermalPixelandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Thermal - Thermal image - Thermal pixels - Thermal pixel -->
		<h2 class="wovomlclass"><a name="data_thermal_thermalimage_thermalpixels_thermalpixel" id="data_thermal_thermalimage_thermalpixels_thermalpixel"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_thermal">andlt;Thermalandgt;</a> | <a href="#data_thermal_thermalimage">andlt;ThermalImageandgt;</a> | <a href="#data_thermal_thermalimage_thermalpixels">andlt;ThermalPixelsandgt;</a> | andlt;ThermalPixelandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;ThermalPixel</strong>
	andlt;latandgt;...andlt;/latandgt;
	andlt;lonandgt;...andlt;/lonandgt;
	andlt;elevandgt;...andlt;/elevandgt;
	andlt;radianceandgt;...andlt;/radianceandgt;
	andlt;heatFluxandgt;...andlt;/heatFluxandgt;
	andlt;temperatureandgt;...andlt;/temperatureandgt;
<strong>andlt;/ThermalPixelandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains data for each pixel of a thermal image.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;latandgt; AND andlt;lonandgt;
				<ul>
					<li>Description: The latitude and longitude in decimal degrees.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;elevandgt;
				<ul>
					<li>Description: The elevation at the pixel center in meters.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;radianceandgt;
				<ul>
					<li>Description: The radiance of the pixel center in W/(m<sup>2</sup>-m) andtimes; 10<sup>7</sup>.</li>
					<li>Type: float</li>
					<li>Unit: W/(m<sup>2</sup>-m) andtimes; 10<sup>7</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;heatFluxandgt;
				<ul>
					<li>Description: The heat flux at the pixel center in W/m<sup>2</sup>.</li>
					<li>Type: float</li>
					<li>Unit: W/m<sup>2</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;temperatureandgt;
				<ul>
					<li>Description: The temperature at the pixel center in degrees Celsius.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;C</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Seismic -->
		<h2 class="wovomlclass"><a name="data_seismic" id="data_seismic"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | andlt;Seismicandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Seismicandgt;</strong>
	<a href="#data_seismic_networkevent">andlt;NetworkEventandgt;...andlt;/NetworkEventandgt;</a>
	<a href="#data_seismic_singlestationevent">andlt;SingleStationEventandgt;...andlt;/SingleStationEventandgt;</a>
	<a href="#data_seismic_intensity">andlt;Intensityandgt;...andlt;/Intensityandgt;</a>
	<a href="#data_seismic_tremor">andlt;Tremorandgt;...andlt;/Tremorandgt;</a>
	<a href="#data_seismic_waveform">andlt;Waveformandgt;...andlt;/Waveformandgt;</a>
	<a href="#data_seismic_interval">andlt;Intervalandgt;...andlt;/Intervalandgt;</a>
	<a href="#data_seismic_rsam-ssam">andlt;RSAM-SSAMandgt;...andlt;/RSAM-SSAMandgt;</a>
<strong>andlt;/Seismicandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about all seismic data for a volcano.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;NetworkEventandgt;
				<ul>
					<li>Description: See <a href="#data_seismic_networkevent">andlt;NetworkEventandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;SingleStationEventandgt;
				<ul>
					<li>Description: See <a href="#data_seismic_singlestationevent">andlt;SingleStationEventandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;Intensityandgt;
				<ul>
					<li>Description: See <a href="#data_seismic_intensity">andlt;Intensityandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;Tremorandgt;
				<ul>
					<li>Description: See <a href="#data_seismic_tremor">andlt;Tremorandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;Waveformandgt;
				<ul>
					<li>Description: See <a href="#data_seismic_waveform">andlt;Waveformandgt;</a>.</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Intervalandgt;
				<ul>
					<li>Description: See <a href="#data_seismic_interval">andlt;Intervalandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
			<li>andlt;RSAM-SSAMandgt;
				<ul>
					<li>Description: See <a href="#data_seismic_rsam-ssam">andlt;RSAM-SSAMandgt;</a>.</li>
					<li>Number of occurrences: 0-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Seismic - Network event -->
		<h2 class="wovomlclass"><a name="data_seismic_networkevent" id="data_seismic_networkevent"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_seismic">andlt;Seismicandgt;</a> | andlt;NetworkEventandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;NetworkEvent code=andquot;...andquot;andgt;</strong>
	andlt;networkCodeandgt;...andlt;/networkCodeandgt;
	andlt;seismoArchiveandgt;...andlt;/seismoArchiveandgt;
	andlt;originTimeandgt;...andlt;/originTimeandgt;
	andlt;originTimeUncandgt;...andlt;/originTimeUncandgt;
	andlt;durationandgt;...andlt;/durationandgt;
	andlt;durationUncandgt;...andlt;/durationUncandgt;
	andlt;locaTechniqueandgt;...andlt;/locaTechniqueandgt;
	andlt;picksDeterminationandgt;...andlt;/picksDeterminationandgt;
	andlt;latandgt;...andlt;/latandgt;
	andlt;lonandgt;...andlt;/lonandgt;
	andlt;depthandgt;...andlt;/depthandgt;
	andlt;fixedDepthandgt;...andlt;/fixedDepthandgt;
	andlt;numberOfStationsandgt;...andlt;/numberOfStationsandgt;
	andlt;numberOfPhasesandgt;...andlt;/numberOfPhasesandgt;
	andlt;largestAzimuthGapandgt;...andlt;/largestAzimuthGapandgt;
	andlt;distClosestStationandgt;...andlt;/distClosestStationandgt;
	andlt;travelTimeRMSandgt;...andlt;/travelTimeRMSandgt;
	andlt;horizLocaErrandgt;...andlt;/horizLocaErrandgt;
	andlt;maxLonErrandgt;...andlt;/maxLonErrandgt;
	andlt;maxLatErrandgt;...andlt;/maxLatErrandgt;
	andlt;depthErrandgt;...andlt;/depthErrandgt;
	andlt;locaQualityandgt;...andlt;/locaQualityandgt;
	andlt;primMagnitudeandgt;...andlt;/primMagnitudeandgt;
	andlt;primMagnitudeTypeandgt;...andlt;/primMagnitudeTypeandgt;
	andlt;secMagnitudeandgt;...andlt;/secMagnitudeandgt;
	andlt;secMagnitudeTypeandgt;...andlt;/secMagnitudeTypeandgt;
	andlt;earthquakeTypeandgt;...andlt;/earthquakeTypeandgt;
	andlt;momentTensorScaleandgt;...andlt;/momentTensorScaleandgt;
	andlt;momentTensorXXandgt;...andlt;/momentTensorXXandgt;
	andlt;momentTensorXYandgt;...andlt;/momentTensorXYandgt;
	andlt;momentTensorXZandgt;...andlt;/momentTensorXZandgt;
	andlt;momentTensorYYandgt;...andlt;/momentTensorYYandgt;
	andlt;momentTensorYZandgt;...andlt;/momentTensorYZandgt;
	andlt;momentTensorZZandgt;...andlt;/momentTensorZZandgt;
	andlt;strike1andgt;...andlt;/strike1andgt;
	andlt;strike1Uncandgt;...andlt;/strike1Uncandgt;
	andlt;dip1andgt;...andlt;/dip1andgt;
	andlt;dip1Uncandgt;...andlt;/dip1Uncandgt;
	andlt;rake1andgt;...andlt;/rake1andgt;
	andlt;rake1Uncandgt;...andlt;/rake1Uncandgt;
	andlt;strike2andgt;...andlt;/strike2andgt;
	andlt;strike2Uncandgt;...andlt;/strike2Uncandgt;
	andlt;dip2andgt;...andlt;/dip2andgt;
	andlt;dip2Uncandgt;...andlt;/dip2Uncandgt;
	andlt;rake2andgt;...andlt;/rake2andgt;
	andlt;rake2Uncandgt;...andlt;/rake2Uncandgt;
	andlt;sampleRateandgt;...andlt;/sampleRateandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
	<a href="#data_seismic_networkevent_waveform">andlt;Waveformandgt;...andlt;/Waveformandgt;</a>
<strong>andlt;/NetworkEventandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains seismic data that were collected from several stations in a network and then processed to give a location.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;networkCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the network which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;seismoArchiveandgt;
				<ul>
					<li>Description: Location of the seismogram archive, if available.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;originTimeandgt;
				<ul>
					<li>Description: The time of the beginning of the event in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS.SSSS* (unlimited number of digits for sub-seconds)</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;originTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the time of the beginning of the event.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS.SSSS* (unlimited number of digits for sub-seconds)</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;durationandgt;
				<ul>
					<li>Description: Average duration of the earthquake as recorded at stations andlt;15 km from the volcano (in sec).</li>
					<li>Type: float</li>
					<li>Unit: s</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;durationUncandgt;
				<ul>
					<li>Description: The uncertainty in the average duration of the earthquake as recorded at stations andlt;15 km from the volcano (in sec).</li>
					<li>Type: float</li>
					<li>Unit: s</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;locaTechniqueandgt;
				<ul>
					<li>Description: The technique used to locate the event. Please include information about each recalculation such as "initial Hypo71, those locations recalculated using double difference".</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;picksDeterminationandgt;
				<ul>
					<li>Description: A description of how the picks were determined.</li>
					<li>Type: A, R, H, U <em>(Automatic picker, Ruler hand-picked, Human using computer-based picker, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;latandgt; AND andlt;lonandgt;
				<ul>
					<li>Description: The latitude and longitude in decimal degrees.</li>
					<li>Type: a decimal value ranging from -90 (inclusive) to +90 (inclusive) for latitude and from -180 (inclusive) to +180 (inclusive) for longitude</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;depthandgt;
				<ul>
					<li>Description: Estimated depth of the seismic event in kilometers.</li>
					<li>Type: float</li>
					<li>Unit: km</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;fixedDepthandgt;
				<ul>
					<li>Description: A flag to indicate that the depth was held fixed by the location algorithm.</li>
					<li>Type: Y, N, U <em>(Yes, No, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numberOfStationsandgt;
				<ul>
					<li>Description: The total number of seismic stations that reported arrival times for this earthquake.</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numberOfPhasesandgt;
				<ul>
					<li>Description: The total number of P and S arrival-time observations used to compute the hypocenter location.</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;largestAzimuthGapandgt;
				<ul>
					<li>Description: The largest azimuthal gap between azimuthally adjacent stations (in degrees, 0-360).</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;distClosestStationandgt;
				<ul>
					<li>Description: Horizontal distance from the epicenter to the nearest station in km.</li>
					<li>Type: float</li>
					<li>Unit: km</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;travelTimeRMSandgt;
				<ul>
					<li>Description: The weighted root-mean-square (RMS) travel time residual, in sec.</li>
					<li>Type: float</li>
					<li>Unit: s</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;horizLocaErrandgt;
				<ul>
					<li>Description: The horizontal location error, in km, defined as the length of the largest projection of the three principal errors on a horizontal plane. The principal errors are the major axes of the error ellipsoid, and are mutually perpendicular.</li>
					<li>Type: float</li>
					<li>Unit: km</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxLonErrandgt;
				<ul>
					<li>Description: The maximum x (longitude) error, in km, for cases where the horizontal error is not given.</li>
					<li>Type: float</li>
					<li>Unit: km</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxLatErrandgt;
				<ul>
					<li>Description: The maximum y (latitude) error, in km, for cases where the horizontal error is not given.</li>
					<li>Type: float</li>
					<li>Unit: km</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;depthErrandgt;
				<ul>
					<li>Description: The depth error, in km, defined as the largest projection of the three principal errors on a vertical line.</li>
					<li>Type: float</li>
					<li>Unit: km</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;locaQualityandgt;
				<ul>
					<li>Description: The quality of the calculated location.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;primMagnitudeandgt;
				<ul>
					<li>Description: The primary magnitude.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;primMagnitudeTypeandgt;
				<ul>
					<li>Description: The primary magnitude type, e.g., M<sub>s</sub>, M<sub>b</sub>, M<sub>w</sub>, M<sub>d</sub> (the last, duration or "coda" magnitude).</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;secMagnitudeandgt;
				<ul>
					<li>Description: A secondary magnitude, where given.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;secMagnitudeTypeandgt;
				<ul>
					<li>Description: A secondary magnitude type.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;earthquakeTypeandgt;
				<ul>
					<li>Description: The original terminology for the earthquake type given by the observatory. (for example, VT, LP; A,B,C; HF, LF; other).</li>
					<li>Type: R, Q, V, VT, VT_D, VT_S, H, H_HLF, H_LHF, LF, LF_LP, LF_T, LF_ILF, VLP, E <em>(Click <a href="#">here</a> for details)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;momentTensorScaleandgt;
				<ul>
					<li>Description: The scale of the following moment tensor data. Please store as a multiplier for the moment tensor data.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;momentTensorXXandgt;
				<ul>
					<li>Description: Moment tensor m_xx.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;momentTensorXYandgt;
				<ul>
					<li>Description: Moment tensor m_xy.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;momentTensorXZandgt;
				<ul>
					<li>Description: Moment tensor m_xz.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;momentTensorYYandgt;
				<ul>
					<li>Description: Moment tensor m_yy.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;momentTensorYZandgt;
				<ul>
					<li>Description: Moment tensor m_yz.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;momentTensorZZandgt;
				<ul>
					<li>Description: Moment tensor m_zz.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;strike1andgt;
				<ul>
					<li>Description: Strike 1 of best double couple (0-360 degrees).</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;strike1Uncandgt;
				<ul>
					<li>Description: The uncertainty in the value of strike 1.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;dip1andgt;
				<ul>
					<li>Description: Dip 1 of best double couple (0-90 degrees).</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 90 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;dip1Uncandgt;
				<ul>
					<li>Description: The uncertainty in the value of dip 1.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;rake1andgt;
				<ul>
					<li>Description: Rake 1 of best double couple (0-90 degrees).</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 90 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;rake1Uncandgt;
				<ul>
					<li>Description: The uncertainty in the value of rake 1.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;strike2andgt;
				<ul>
					<li>Description: Strike 2 of best double couple, if available (0-360 degrees).</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 360 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;strike2Uncandgt;
				<ul>
					<li>Description: The uncertainty in the value of strike 2.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;dip2andgt;
				<ul>
					<li>Description: Dip 2 of best double couple, if available (0-90 degrees).</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 90 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;dip2Uncandgt;
				<ul>
					<li>Description: The uncertainty in the value of dip 2.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;rake2andgt;
				<ul>
					<li>Description: Rake 2 of best double couple, if available (0-90 degrees).</li>
					<li>Type: a decimal value ranging from 0 (inclusive) to 90 (inclusive)</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;rake2Uncandgt;
				<ul>
					<li>Description: The uncertainty in the value of rake 2.</li>
					<li>Type: float</li>
					<li>Unit: anddeg;</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;sampleRateandgt;
				<ul>
					<li>Description: The sampling rate in Hz.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Unit: Hz</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Waveformandgt;
				<ul>
					<li>Description: See <a href="#data_seismic_networkevent_waveform">andlt;Waveformandgt;</a>.</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Seismic - Network event - Waveform -->
		<h2 class="wovomlclass"><a name="data_seismic_networkevent_waveform" id="data_seismic_networkevent_waveform"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_seismic">andlt;Seismicandgt;</a> | <a href="#data_seismic_networkevent">andlt;NetworkEventandgt;</a> | andlt;Waveformandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Waveform code=andquot;...andquot;andgt;</strong>
	andlt;stationCodeandgt;...andlt;/stationCodeandgt;
	andlt;archiveandgt;...andlt;/archiveandgt;
	andlt;distSummitandgt;...andlt;/distSummitandgt;
	andlt;informationandgt;...andlt;/informationandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
<strong>andlt;/Waveformandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains sample waveforms to highlight common and uncommon events at different volcanoes.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;stationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the station which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;archiveandgt;
				<ul>
					<li>Description: Location of seismogram archive. This information should be used to find additional waveforms beyond the representative waveforms stored here.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;distSummitandgt;
				<ul>
					<li>Description: The distance that the waveform was recorded from the summit.</li>
					<li>Type: D, I, P, U <em>(Distal (andgt; 5 km), Intermediate (2-5 km), Proximal (andlt; 2 km), Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;informationandgt;
				<ul>
					<li>Description: Background information to include the event type in WOVOdat terminology, the volcano or approximate location where the event occurred, and a time.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: Added description of the waveform. Include how often and when this kind of waveform occurs, and any interpretations.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Seismic - Single station event -->
		<h2 class="wovomlclass"><a name="data_seismic_singlestationevent" id="data_seismic_singlestationevent"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_seismic">andlt;Seismicandgt;</a> | andlt;SingleStationEventandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SingleStationEvent code=andquot;...andquot;andgt;</strong>
	andlt;stationCodeandgt;...andlt;/stationCodeandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;durationandgt;...andlt;/durationandgt;
	andlt;durationUncandgt;...andlt;/durationUncandgt;
	andlt;picksDeterminationandgt;...andlt;/picksDeterminationandgt;
	andlt;SPIntervalandgt;...andlt;/SPIntervalandgt;
	andlt;distActiveVentandgt;...andlt;/distActiveVentandgt;
	andlt;maxAmplitudeandgt;...andlt;/maxAmplitudeandgt;
	andlt;sampleRateandgt;...andlt;/sampleRateandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
	<a href="#data_seismic_singlestationevent_waveform">andlt;Waveformandgt;...andlt;/Waveformandgt;</a>
<strong>andlt;/SingleStationEventandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains seismic data that were collected from a single station and therefore no location can be calculated.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;stationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the station which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The event start time (P phase) in UTC.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS.SSSS* (unlimited number of digits for sub-seconds)</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the event start time (P phase).</li>
					<li>Type: YYYY-MM-DD HH:MM:SS.SSSS* (unlimited number of digits for sub-seconds)</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;durationandgt;
				<ul>
					<li>Description: The length or duration of the event in seconds from the start time until a background level has returned.</li>
					<li>Type: float</li>
					<li>Unit: s</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;durationUncandgt;
				<ul>
					<li>Description: The uncertainty in the length or duration of the event in seconds from the start time until a background level has returned.</li>
					<li>Type: float</li>
					<li>Unit: s</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;picksDeterminationandgt;
				<ul>
					<li>Description: A description of how the picks were determined.</li>
					<li>Type: A, R, H, U <em>(Automatic picker, Ruler hand-picked, Human using computer-based picker, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;SPIntervalandgt;
				<ul>
					<li>Description: The interval between the S and P start times in seconds.</li>
					<li>Type: float</li>
					<li>Unit: s</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;distActiveVentandgt;
				<ul>
					<li>Description: The approximate distance from where the event was recorded to the active vent.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxAmplitudeandgt;
				<ul>
					<li>Description: The maximum amplitude of trace.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;sampleRateandgt;
				<ul>
					<li>Description: The sampling rate in Hz.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Unit: Hz</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Waveformandgt;
				<ul>
					<li>Description: See <a href="#data_seismic_singlestationevent_waveform">andlt;Waveformandgt;</a>.</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Seismic - Single station event - Waveform -->
		<h2 class="wovomlclass"><a name="data_seismic_singlestationevent_waveform" id="data_seismic_singlestationevent_waveform"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_seismic">andlt;Seismicandgt;</a> | <a href="#data_seismic_singlestationevent">andlt;SingleStationEventandgt;</a> | andlt;Waveformandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Waveform code=andquot;...andquot;andgt;</strong>
	andlt;stationCodeandgt;...andlt;/stationCodeandgt;
	andlt;archiveandgt;...andlt;/archiveandgt;
	andlt;distSummitandgt;...andlt;/distSummitandgt;
	andlt;informationandgt;...andlt;/informationandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
<strong>andlt;/Waveformandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains sample waveforms to highlight common and uncommon events at different volcanoes.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;stationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the station which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;archiveandgt;
				<ul>
					<li>Description: Location of seismogram archive. This information should be used to find additional waveforms beyond the representative waveforms stored here.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;distSummitandgt;
				<ul>
					<li>Description: The distance that the waveform was recorded from the summit.</li>
					<li>Type: D, I, P, U <em>(Distal (andgt; 5 km), Intermediate (2-5 km), Proximal (andlt; 2 km), Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;informationandgt;
				<ul>
					<li>Description: Background information to include the event type in WOVOdat terminology, the volcano or approximate location where the event occurred, and a time.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: Added description of the waveform. Include how often and when this kind of waveform occurs, and any interpretations.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Seismic - Intensity -->
		<h2 class="wovomlclass"><a name="data_seismic_intensity" id="data_seismic_intensity"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_seismic">andlt;Seismicandgt;</a> | andlt;Intensityandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Intensity code=andquot;...andquot;andgt;</strong>
	andlt;volcanoCodeandgt;...andlt;/volcanoCodeandgt;
	andlt;networkEventCodeandgt;...andlt;/networkEventCodeandgt;		andlt;!-- OR andlt;singleStationEventCodeandgt;...andlt;/singleStationEventCodeandgt; --andgt;
	andlt;timeandgt;...andlt;/timeandgt;
	andlt;timeUncandgt;...andlt;/timeUncandgt;
	andlt;cityandgt;...andlt;/cityandgt;
	andlt;maxDistanceandgt;...andlt;/maxDistanceandgt;
	andlt;maxReportedandgt;...andlt;/maxReportedandgt;
	andlt;distMaxReportedandgt;...andlt;/distMaxReportedandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
<strong>andlt;/Intensityandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about the intensities of events that may or may not have been recorded by a station.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;volcanoCodeandgt;
				<ul>
					<li>Description: The code of the volcano to which the data refer.</li>
					<li>Type: string of at most 12 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;networkEventCodeandgt; OR andlt;singleStationEventCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the probable network/single station event.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;timeandgt;
				<ul>
					<li>Description: Approximate time of event (UTC).</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;timeUncandgt;
				<ul>
					<li>Description: Uncertainty in the approximate time of event.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;cityandgt;
				<ul>
					<li>Description: The name of the city or town where the event was felt.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxDistanceandgt;
				<ul>
					<li>Description: The maximum distance at which the earthquake was felt, measured from the volcano summit in km.</li>
					<li>Type: float</li>
					<li>Unit: km</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxReportedandgt;
				<ul>
					<li>Description: The maximum reported intensity (modified mercalli intensity).</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;distMaxReportedandgt;
				<ul>
					<li>Description: The distance from the volcano's summit to where the maximum intensity was reported in km.</li>
					<li>Type: float</li>
					<li>Unit: km</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Seismic - Tremor -->
		<h2 class="wovomlclass"><a name="data_seismic_tremor" id="data_seismic_tremor"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_seismic">andlt;Seismicandgt;</a> | andlt;Tremorandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Tremor code=andquot;...andquot;andgt;</strong>
	andlt;networkCodeandgt;...andlt;/networkCodeandgt;		andlt;!-- OR andlt;stationCodeandgt;...andlt;/stationCodeandgt; --andgt;
	andlt;typeandgt;...andlt;/typeandgt;
	andlt;qualitativeDepthandgt;...andlt;/qualitativeDepthandgt;
	andlt;dominantFreqandgt;...andlt;/dominantFreqandgt;
	andlt;secondDominantFreqandgt;...andlt;/secondDominantFreqandgt;
	andlt;maxAmplitudeandgt;...andlt;/maxAmplitudeandgt;
	andlt;backgroundNoiseandgt;...andlt;/backgroundNoiseandgt;
	andlt;reducedDispandgt;...andlt;/reducedDispandgt;
	andlt;reducedDispUncandgt;...andlt;/reducedDispUncandgt;
	andlt;visibleActivityandgt;...andlt;/visibleActivityandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;durationPerDayandgt;...andlt;/durationPerDayandgt;
	andlt;durationPerDayUncandgt;...andlt;/durationPerDayUncandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
	<a href="#data_seismic_tremor_waveform">andlt;Waveformandgt;...andlt;/Waveformandgt;</a>
<strong>andlt;/Tremorandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information about tremor such as the time interval, qualitative depth, dominant frequency, amplitude range, and reduced displacement.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;networkCodeandgt; OR andlt;stationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the network/station which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;typeandgt;
				<ul>
					<li>Description: The type and a description of the tremor, e.g., any temporal pattern such as banding, spasmodic bursts, etc. Use N for narrow band or B for broadband and include the frequency range. Broadband includes spasmodic bursts and should span a frequency range greater than 3 Hz.</li>
					<li>Type: G, M, H, C <em>(Click <a href="#">here</a> for details)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;qualitativeDepthandgt;
				<ul>
					<li>Description: The qualitative depth of the tremor.</li>
					<li>Type: D, I, S, U <em>(Deep (andgt; 10 km), Intermediate (4-10 km), Shallow (andlt; 4 km), Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;dominantFreqandgt;
				<ul>
					<li>Description: The dominant frequency (in Hz).</li>
					<li>Type: float</li>
					<li>Unit: Hz</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;secondDominantFreqandgt;
				<ul>
					<li>Description: The second dominant frequency (if any, in Hz).</li>
					<li>Type: float</li>
					<li>Unit: Hz</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;maxAmplitudeandgt;
				<ul>
					<li>Description: The maximum amplitude of tremor.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;backgroundNoiseandgt;
				<ul>
					<li>Description: The background noise level.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;reducedDispandgt;
				<ul>
					<li>Description: The reduced displacement (as estimated using a station >5km from source to minimize the effects of geometrical spreading).</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;reducedDispUncandgt;
				<ul>
					<li>Description: The reduced displacement error.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;visibleActivityandgt;
				<ul>
					<li>Description: A description of any associated visible activity.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The start time (UTC).</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the start time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The end time (UTC).</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the end time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;durationPerDayandgt;
				<ul>
					<li>Description: The total duration of tremor for each day in minutes.</li>
					<li>Type: float</li>
					<li>Unit: min</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;durationPerDayUncandgt;
				<ul>
					<li>Description: The uncertainty in the total duration of tremor for each day in minutes.</li>
					<li>Type: float</li>
					<li>Unit: min</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;Waveformandgt;
				<ul>
					<li>Description: See <a href="#data_seismic_tremor_waveform">andlt;Waveformandgt;</a>.</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Seismic - Tremor - Waveform -->
		<h2 class="wovomlclass"><a name="data_seismic_tremor_waveform" id="data_seismic_tremor_waveform"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_seismic">andlt;Seismicandgt;</a> | <a href="#data_seismic_tremor">andlt;Tremorandgt;</a> | andlt;Waveformandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Waveform code=andquot;...andquot;andgt;</strong>
	andlt;stationCodeandgt;...andlt;/stationCodeandgt;
	andlt;archiveandgt;...andlt;/archiveandgt;
	andlt;distSummitandgt;...andlt;/distSummitandgt;
	andlt;informationandgt;...andlt;/informationandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
<strong>andlt;/Waveformandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains sample waveforms to highlight common and uncommon events at different volcanoes.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;stationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the station which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;archiveandgt;
				<ul>
					<li>Description: Location of seismogram archive. This information should be used to find additional waveforms beyond the representative waveforms stored here.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;distSummitandgt;
				<ul>
					<li>Description: The distance that the waveform was recorded from the summit.</li>
					<li>Type: D, I, P, U <em>(Distal (andgt; 5 km), Intermediate (2-5 km), Proximal (andlt; 2 km), Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;informationandgt;
				<ul>
					<li>Description: Background information to include the event type in WOVOdat terminology, the volcano or approximate location where the event occurred, and a time.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: Added description of the waveform. Include how often and when this kind of waveform occurs, and any interpretations.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Seismic - Waveform -->
		<h2 class="wovomlclass"><a name="data_seismic_waveform" id="data_seismic_waveform"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_seismic">andlt;Seismicandgt;</a> | andlt;Waveformandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Waveform code=andquot;...andquot;andgt;</strong>
	andlt;networkEventCodeandgt;...andlt;/networkEventCodeandgt;		andlt;!-- OR andlt;singleStationEventCodeandgt;...andlt;/singleStationEventCodeandgt; OR andlt;tremorCodeandgt;...andlt;/tremorCodeandgt; --andgt;
	andlt;stationCodeandgt;...andlt;/stationCodeandgt;
	andlt;archiveandgt;...andlt;/archiveandgt;
	andlt;distSummitandgt;...andlt;/distSummitandgt;
	andlt;informationandgt;...andlt;/informationandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
<strong>andlt;/Waveformandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains sample waveforms to highlight common and uncommon events at different volcanoes.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;networkEventCodeandgt; OR andlt;singleStationEventCodeandgt; OR andlt;tremorCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the probable network/single station/tremor event.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;stationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the station which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;archiveandgt;
				<ul>
					<li>Description: Location of seismogram archive. This information should be used to find additional waveforms beyond the representative waveforms stored here.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;distSummitandgt;
				<ul>
					<li>Description: The distance that the waveform was recorded from the summit.</li>
					<li>Type: D, I, P, U <em>(Distal (andgt; 5 km), Intermediate (2-5 km), Proximal (andlt; 2 km), Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;informationandgt;
				<ul>
					<li>Description: Background information to include the event type in WOVOdat terminology, the volcano or approximate location where the event occurred, and a time.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: Added description of the waveform. Include how often and when this kind of waveform occurs, and any interpretations.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Seismic - Interval -->
		<h2 class="wovomlclass"><a name="data_seismic_interval" id="data_seismic_interval"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_seismic">andlt;Seismicandgt;</a> | andlt;Intervalandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;Interval code=andquot;...andquot;andgt;</strong>
	andlt;networkCodeandgt;...andlt;/networkCodeandgt;		andlt;!-- OR andlt;stationCodeandgt;...andlt;/stationCodeandgt; --andgt;
	andlt;earthquakeTypeandgt;...andlt;/earthquakeTypeandgt;
	andlt;hDistSummitandgt;...andlt;/hDistSummitandgt;
	andlt;meanDepthandgt;...andlt;/meanDepthandgt;
	andlt;verticalDispandgt;...andlt;/verticalDispandgt;
	andlt;hypocenterHMigrandgt;...andlt;/hypocenterHMigrandgt;
	andlt;hypocenterVMigrandgt;...andlt;/hypocenterVMigrandgt;
	andlt;temporalPatternandgt;...andlt;/temporalPatternandgt;
	andlt;dataTypeandgt;...andlt;/dataTypeandgt;
	andlt;picksDeterminationandgt;...andlt;/picksDeterminationandgt;
	andlt;numbOfRecEqandgt;...andlt;/numbOfRecEqandgt;
	andlt;numbOfFeltEqandgt;...andlt;/numbOfFeltEqandgt;
	andlt;feltEqCntStartTimeandgt;...andlt;/feltEqCntStartTimeandgt;
	andlt;feltEqCntStartTimeUncandgt;...andlt;/feltEqCntStartTimeUncandgt;
	andlt;feltEqCntEndTimeandgt;...andlt;/feltEqCntEndTimeandgt;
	andlt;feltEqCntEndTimeUncandgt;...andlt;/feltEqCntEndTimeUncandgt;
	andlt;energyReleaseandgt;...andlt;/energyReleaseandgt;
	andlt;energyMeasStartTimeandgt;...andlt;/energyMeasStartTimeandgt;
	andlt;energyMeasStartTimeUncandgt;...andlt;/energyMeasStartTimeUncandgt;
	andlt;energyMeasEndTimeandgt;...andlt;/energyMeasEndTimeandgt;
	andlt;energyMeasEndTimeUncandgt;...andlt;/energyMeasEndTimeUncandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;descriptionandgt;...andlt;/descriptionandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
<strong>andlt;/Intervalandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains data about earthquakes that occur in specified time intervals, e.g., as seismic swarms.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;networkCodeandgt; OR andlt;stationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the network/station which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;earthquakeTypeandgt;
				<ul>
					<li>Description: The original terminology for the earthquake type given by the observatory. (for example, VT, LP; A,B,C; HF, LF; other).</li>
					<li>Type: R, Q, V, VT, VT_D, VT_S, H, H_HLF, H_LHF, LF, LF_LP, LF_T, LF_ILF, VLP, E <em>(Click <a href="#">here</a> for details)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;hDistSummitandgt;
				<ul>
					<li>Description: The horizontal distance from the summit to the swarm center in km.</li>
					<li>Type: float</li>
					<li>Unit: km</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;meanDepthandgt;
				<ul>
					<li>Description: Mean depth of the swarm earthquakes in m.</li>
					<li>Type: float</li>
					<li>Unit: m</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;verticalDispandgt;
				<ul>
					<li>Description: Range (dispersion) of depths over which these swarm earthquakes occurred.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;hypocenterHMigrandgt;
				<ul>
					<li>Description: Any horizontal migration of hypocenters from/to the summit in km (use positive numbers for outward and negative numbers for inward).</li>
					<li>Type: float</li>
					<li>Unit: km</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;hypocenterVMigrandgt;
				<ul>
					<li>Description: Any vertical migration of hypocenters in km (use positive numbers for up and negative numbers for down).</li>
					<li>Type: float</li>
					<li>Unit: km</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;temporalPatternandgt;
				<ul>
					<li>Description: The temporal pattern of the swarm.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;dataTypeandgt;
				<ul>
					<li>Description: A description of the types of data included in the earthquake counts.</li>
					<li>Type: L, C, H, U <em>(Located, Computer trigger algorithm detected, Hand counted, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;picksDeterminationandgt;
				<ul>
					<li>Description: A description of how the picks were determined.</li>
					<li>Type: A, R, H, U <em>(Automatic picker, Ruler hand-picked, Human using computer-based picker, Unknown)</em></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numbOfRecEqandgt;
				<ul>
					<li>Description: The recorded earthquake count during the specified time interval.</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;numbOfFeltEqandgt;
				<ul>
					<li>Description: The number of felt earthquakes for this interval.</li>
					<li>Type: integer number</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;feltEqCntStartTimeandgt;
				<ul>
					<li>Description: The felt earthquake counts measurement start time (UTC).</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;feltEqCntStartTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the felt earthquake counts measurement start time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;feltEqCntEndTimeandgt;
				<ul>
					<li>Description: The felt earthquake counts measurement stop time (UTC).</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;feltEqCntEndTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the felt earthquake counts measurement end time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;energyReleaseandgt;
				<ul>
					<li>Description: The total seismic energy release (seismic moment) for this swarm interval in erg<sup>-0.5</sup>.</li>
					<li>Type: float</li>
					<li>Unit: erg<sup>-0.5</sup></li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;energyMeasStartTimeandgt;
				<ul>
					<li>Description: The total seismic energy release (seismic moment) measurement start time (UTC).</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;energyMeasStartTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the total seismic energy release (seismic moment) measurement start time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;energyMeasEndTimeandgt;
				<ul>
					<li>Description: The total seismic energy release (seismic moment) measurement stop time (UTC).</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;energyMeasEndTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the total seismic energy release (seismic moment) measurement end time.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The start time (UTC) of this interval based on instrument recordings.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the start time of this interval based on instrument recordings.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The end time (UTC) of this interval based on instrument recordings.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the end time of this interval based on instrument recordings.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;descriptionandgt;
				<ul>
					<li>Description: A description of the swarms or interval data and any uncertainties in the data such as location.</li>
					<li>Type: string of at most 255 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Seismic - RSAM-SSAM -->
		<h2 class="wovomlclass"><a name="data_seismic_rsam-ssam" id="data_seismic_rsam-ssam"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_seismic">andlt;Seismicandgt;</a> | andlt;RSAM-SSAMandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;RSAM-SSAM code=andquot;...andquot;andgt;</strong>
	andlt;stationCodeandgt;...andlt;/stationCodeandgt;
	andlt;cntIntervalandgt;...andlt;/cntIntervalandgt;
	andlt;cntIntervalUncandgt;...andlt;/cntIntervalUncandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
	andlt;endTimeandgt;...andlt;/endTimeandgt;
	andlt;endTimeUncandgt;...andlt;/endTimeUncandgt;
	andlt;ownerCodeandgt;...andlt;/ownerCodeandgt;
	pubDate...andlt;/pubDateandgt;
	<a href="#data_seismic_rsam-ssam_rsam">andlt;RSAMandgt;...andlt;/RSAMandgt;</a>
	<a href="#data_seismic_rsam-ssam_ssam">andlt;SSAMandgt;...andlt;/SSAMandgt;</a>
<strong>andlt;/RSAM-SSAMandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains information needed to create RSAM and SSAM images. These techniques were developed by the USGS to summarize seismic activity in real-time during volcanic crises. The techniques use the amplitudes and frequencies of seismic signals instead of the locations and magnitudes of the earthquakes, which makes them an ideal tool for rapid analysis during periods of time when seismicity has reached a level at which individual seismic events are difficult to distinguish.</p>

		<h3>Attributes</h3>
		<ul>
			<li>code
				<ul>
					<li>Description: A unique code/ID that can be used for finding these data in WOVOdat later.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Required: Yes</li>
				</ul>
			</li>
		</ul>
		
		<h3>Elements</h3>
		<ul>
			<li>andlt;stationCodeandgt;
				<ul>
					<li>Description: The code in WOVOdat for the station which recorded these data.</li>
					<li>Type: string of at most 30 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;cntIntervalandgt;
				<ul>
					<li>Description: The time interval in seconds for each measurement bin.</li>
					<li>Type: float</li>
					<li>Unit: s</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;cntIntervalUncandgt;
				<ul>
					<li>Description: The uncertainty in the time interval in seconds for each measurement bin.</li>
					<li>Type: float</li>
					<li>Unit: s</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The measurement start time (UTC) of RSAM or SSAM measurements.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the measurement start time of RSAM or SSAM measurements.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;endTimeandgt;
				<ul>
					<li>Description: The measurement end time (UTC) of RSAM or SSAM measurements.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;endTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the measurement end time of RSAM or SSAM measurements.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;ownerCodeandgt;
				<ul>
					<li>Description: The contact code in WOVOdat for the data collector.</li>
					<li>Type: string of at most 10 characters</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>pubDate
				<ul>
					<li>Description: The date these data can become public. This date can be set up to two years in advance.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;RSAMandgt;
				<ul>
					<li>Description: See <a href="#data_seismic_rsam-ssam_rsam">andlt;RSAMandgt;</a>.</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;SSAMandgt;
				<ul>
					<li>Description: See <a href="#data_seismic_rsam-ssam_ssam">andlt;SSAMandgt;</a>.</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Seismic - RSAM-SSAM - RSAM -->
		<h2 class="wovomlclass"><a name="data_seismic_rsam-ssam_rsam" id="data_seismic_rsam-ssam_rsam"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_seismic">andlt;Seismicandgt;</a> | <a href="#data_seismic_rsam-ssam">andlt;RSAM-SSAMandgt;</a> | andlt;RSAMandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;RSAMandgt;</strong>
	<a href="#data_seismic_rsam-ssam_rsam_rsamdata">andlt;RSAMDataandgt;...andlt;/RSAMDataandgt;</a>
<strong>andlt;/RSAMandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains the data needed to create an RSAM image.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;RSAMDataandgt;
				<ul>
					<li>Description: See <a href="#data_seismic_rsam-ssam_rsam_rsamdata">andlt;RSAMDataandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- RSAM data -->
		<h2 class="wovomlclass"><a name="data_seismic_rsam-ssam_rsam_rsamdata" id="data_seismic_rsam-ssam_rsam_rsamdata"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_seismic">andlt;Seismicandgt;</a> | <a href="#data_seismic_rsam-ssam">andlt;RSAM-SSAMandgt;</a> | <a href="#data_seismic_rsam-ssam_rsam">andlt;RSAMandgt;</a> | andlt;RSAMDataandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;RSAMDataandgt;</strong>
	andlt;cntandgt;...andlt;/cntandgt;
	andlt;calibrationandgt;...andlt;/calibrationandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
<strong>andlt;/RSAMDataandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains a part of the data needed to create an RSAM image.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;cntandgt;
				<ul>
					<li>Description: The RSAM count during this interval.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;calibrationandgt;
				<ul>
					<li>Description: The reduced displacement per 100 RSAM counts.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The starting time for the given interval.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the starting time for the given interval.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Seismic - RSAM-SSAM - SSAM -->
		<h2 class="wovomlclass"><a name="data_seismic_rsam-ssam_ssam" id="data_seismic_rsam-ssam_ssam"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_seismic">andlt;Seismicandgt;</a> | <a href="#data_seismic_rsam-ssam">andlt;RSAM-SSAMandgt;</a> | andlt;SSAMandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SSAMandgt;</strong>
	<a href="#data_seismic_rsam-ssam_ssam_ssamdata">andlt;SSAMDataandgt;...andlt;/SSAMDataandgt;</a>
<strong>andlt;/SSAMandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains the data needed to create an SSAM image.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;SSAMDataandgt;
				<ul>
					<li>Description: See <a href="#data_seismic_rsam-ssam_ssam_ssamdata">andlt;SSAMDataandgt;</a>.</li>
					<li>Number of occurrences: 1-<em class="infin">andinfin;</em></li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
		
		<!-- Data - Seismic - RSAM-SSAM - SSAM - SSAM data -->
		<h2 class="wovomlclass"><a name="data_seismic_rsam-ssam_ssam_ssamdata" id="data_seismic_rsam-ssam_ssam_ssamdata"></a><a href="#wovoml">andlt;wovomlandgt;</a> | <a href="#data">andlt;Dataandgt;</a> | <a href="#data_seismic">andlt;Seismicandgt;</a> | <a href="#data_seismic_rsam-ssam">andlt;RSAM-SSAMandgt;</a> | <a href="#data_seismic_rsam-ssam_ssam">andlt;SSAMandgt;</a> | andlt;SSAMDataandgt;</h2>
		
		<h3>Template</h3>
<pre><strong>andlt;SSAMDataandgt;</strong>
	andlt;lowFreqandgt;...andlt;/lowFreqandgt;
	andlt;highFreqandgt;...andlt;/highFreqandgt;
	andlt;cntandgt;...andlt;/cntandgt;
	andlt;calibrationandgt;...andlt;/calibrationandgt;
	andlt;startTimeandgt;...andlt;/startTimeandgt;
	andlt;startTimeUncandgt;...andlt;/startTimeUncandgt;
<strong>andlt;/SSAMDataandgt;</strong></pre>
		
		<h3>Description</h3>
		<p>This class contains a part of the data needed to create an SSAM image.</p>

		<h3>Elements</h3>
		<ul>
			<li>andlt;lowFreqandgt;
				<ul>
					<li>Description: The low frequency limit in Hz for this frequency range.</li>
					<li>Type: float</li>
					<li>Unit: Hz</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;highFreqandgt;
				<ul>
					<li>Description: The high frequency limit in Hz for this frequency range.</li>
					<li>Type: float</li>
					<li>Unit: Hz</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;cntandgt;
				<ul>
					<li>Description: The SSAM count for this time and frequency interval.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;calibrationandgt;
				<ul>
					<li>Description: The reduced displacement per 100 SSAM counts for the specified frequency range.</li>
					<li>Type: float</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
			<li>andlt;startTimeandgt;
				<ul>
					<li>Description: The starting time for the given interval.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 1</li>
				</ul>
			</li>
			<li>andlt;startTimeUncandgt;
				<ul>
					<li>Description: The uncertainty in the starting time for the given interval.</li>
					<li>Type: YYYY-MM-DD HH:MM:SS</li>
					<li>Number of occurrences: 0-1</li>
				</ul>
			</li>
		</ul>
		
		<h2>andnbsp;</h2>
		<p class="backtotop"><a href="#top">Back to top</a></p>
			
			</div>
			</div>
			
		<!-- Footer -->
		<div id="footer">
			<?php include 'php/include/footer_beta.php'; ?>
		</div>
		
		</div>
		
	</div>
</body>
</html>