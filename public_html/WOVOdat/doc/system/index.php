<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
        <meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
        <meta name="keywords" content="Volcano, Vulcano, Volcanoes">
        <link href="/gif2/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
        <link href="/css/styles_beta.css" rel="stylesheet">
    </head>

    <body>
        <div id="wrapborder_x">
            <!-- Header -->
            <div id="wrap_x">
                <?php include 'php/include/header_beta.php'; ?>  


				<!-- Content -->
				<div id="content">
				
					<!-- Left content -->
					<div id="contentl">
					
						<h1><br>About the upload system</h1>		
						<h2>How does the upload work?</h2>

						<h2<br><br>Submit a file</h2>
						<p>On the basic start, Monitoring Data usually consists of <b>Station</b>, <b>Type of Data</b>, the <b>Data</b> itself. A CSV(comma delimited value) file is the easiest way to submit data. <a href="#">Here</a> is to submit the data. For Station, the information includes Network code, if any, Station name, Lat, Lon and Elevation. For time series data it contains at least three columns: "Date", "Time" and "Value".
						</p>
						
						<h2>Why several versions?</h2>
						<p>As the database is changing versions (see explanation in the <a href="/doc/database/">database documentation</a>), the scripts used for uploading files to the database need to change accordingly.</p>
						
						<h2>List of versions</h2>
						<ul>
							<li>
								<h3>1.001<span> <em>(release in March 2010)</em></span></h3>
								<p>Description: Major changes resulting from pilot testing and data populating phases.</p>
								<p>Go to reference for: <a href="1.001/wovoml.php">WOVOML reference</a> | <a href="1.001/wovoml_to_db.php">Upload process</a></p>
							</li>
							<li>
								<h3>1.0<span> <em>(release in 2007)</em></span></h3>
								<p>Description: Initial version.</p>
								<p>Go to reference for: <a href="1.0/wovoml.php">WOVOML reference</a> | <a href="#">Upload process</a></p>
							</li>
						</ul>
					
					</div>
					
					<!-- Right content -->
					<div id="contentr"><br><br>
						<p align="center"><img src="/gif/flowschema.png" width="400" height="210" alt="schema"></p>
					</div> <!-- end of contentr -->
				</div> <!-- end of content -->
           </div>  <!-- end wrap_x -->      
           
		   <div style="height: 20px"></div>
           <div class="reservedSpace">
           </div>
        </div>   <!-- end of wrapborder_x -->
		
        <div class="wrapborder_x">
            <?php include 'php/include/footer_main_beta.php'; ?>
        </div>
    </body>
</html>