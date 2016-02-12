<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
        <meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
        <meta name="keywords" content="Volcano, Vulcano, Volcanoes">
        <link href="/gif2/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
        <link href="/css/index.css" rel="stylesheet" type="text/css">
        <link href="/css/normalize.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="js/jssor.slider.mini.js"></script>
        <script type="text/javascript" src="js/home_index.js"></script>
    </head>  
   <body>
       <div class="body" style="height:1300px;">
          <?php include 'php/include/header.php'; ?> 
          <div class="container">

               <div class="slideshow">
                   <div id="slider_container" class="container-slideshow">

                       <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                           <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                               background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                           </div>
                           <div style="position: absolute; display: block; background: url(img/slideshow/loading.gif) no-repeat center center;
                               top: 0px; left: 0px;width: 100%;height:100%;">
                           </div>
                       </div>

                       <div u="slides" style=" position: absolute; left: 0px; top: 0px; width: 884px; height: 416px; overflow: hidden;">
                           <div>
                               <div class="box">
                                   <h2 class="box-title">The world in gigapixels</h2>
                                   <p class="box-content">
                                       The USC School of Cinematic Arts' Eric Hanson goes to the world's most inaccessible places and captures them digitally. His <a href="#">video creations</a> capture detail invisible to the naked eye.
                                   </p>
                               </div>
                               <img u="image" src="img/slideshow/slide01.JPG" width="884px" height="416px" />
                           </div>
                           <div>
                               <div class="box">
                                   <h2 class="box-title">LA in a box?</h2>
                                   <p class="box-content">
                                       USC Dornsife faculty and students have teamed up with Boyle Heights educators to teach local schoolchildren about their community's past — using the <a href="#">mysterious contents</a> of a box.
                                   </p>
                               </div>
                               <img u="image" src="img/slideshow/slide02.JPG" width="884px" height="416px"/>
                           </div>
                           <div>
                               <div class="box">
                                   <h2 class="box-title">The world in gigapixels</h2>
                                   <p class="box-content">
                                       The USC School of Cinematic Arts' Eric Hanson goes to the world's most inaccessible places and captures them digitally. His <a href="#">video creations</a> capture detail invisible to the naked eye.
                                   </p>
                               </div>
                               <img u="image" src="img/slideshow/slide03.JPG" width="884px" height="416px"/>
                           </div>
                           <div>
                               <div class="box">
                                   <h2 class="box-title">LA in a box?</h2>
                                   <p class="box-content">
                                       USC Dornsife faculty and students have teamed up with Boyle Heights educators to teach local schoolchildren about their community's past — using the <a href="#">mysterious contents</a> of a box.
                                   </p>
                               </div>
                               <img u="image" src="img/slideshow/slide04.JPG" width="884px" height="416px"/>
                           </div>
                        </div>
                       <!-- bullet navigator container -->
                       <div u="navigator" class="jssorb05" style="position: absolute; bottom: 16px; right: 16px">
                           <!-- bullet navigator item prototype -->
                           <div u="prototype" style="POSITION: absolute; WIDTH: 16px; HEIGHT: 16px;"></div>
                       </div>

                       <!-- Arrow Left -->
                       <span u="arrowleft" class="jssora20l" style="width: 55px; height: 55px; top: 123px; left: 8px;">
                       </span>
                       <!-- Arrow Right -->
                       <span u="arrowright" class="jssora20r" style="width: 55px; height: 55px; top: 123px; right: 8px">
                       </span>

                   </div>
               </div>

               <div class="content">
                   <table>
                       <tr>
                           <td class="welcome">
                               <h1>W E L C O M E</h1>
                               <div></div>
                               <p>The collective record of volcano monitoring around the world is housed in roughly 100 volcano observatories and research institutes around the world, in a myriad of data formats. Often, volcano seismic data are stored separately from data of ground deformation, and those of gas emissions and other changes are found in other files. Published, legacy data are retrievable only with months of library work.</p>
                               <div></div>
                               <p>This new database is WOVOdat - a collective record of volcano monitoring, worldwide - brought to you by the WOVO (World Organization of Volcano Observatories) and presently hosted at the Earth Observatory of Singapore. It will have many uses for crisis response and research. The principal goal of WOVOdat, as contrasted with databases at individual observatories, is to enable rapid comparisons of unrest at various volcanoes, rapid searches for particular patterns of unrest, and other operations on data from many volcanoes and episodes of unrest. To make these searches efficient, we gather mainly processed, reduced, published data.</p>
                               <div></div>
                               <p>...</p>
                           </td>

                           <td class="graph">
                               <div class="download">
                                   <span><a href="/installing/" title="download WOVOdat-like scripts for development"> DOWNLOAD WOVODAT STANDALONE PACKAGE </a></span>
                                   <p>
                                  For those from observatories willing to develop their database system using <b><u>WOVOdat-like</u></b> format, scripts are available <a href="/installing/"><u style="color:blue">here</u></a>. These are basic scripts that could be used in starting database construction.</p>
                               </div>
                               <div class="graph-demo">
                                   <div><img src="gif2/rsam_compare_new2.gif" /></div>
                                   <b style="font-size:9px;padding-left:20px;">source: Endo et.al in "Fire and Mud", 1996. Data from: CVO, AVO, Phivolcs</b>
                                   <p style = "text-align: justify"><b>A comparison of RSAM (real-time seismic amplitude measurement) culminating in eruption at three volcanoes. Mount St. Helens (May 1985 dome building), Mount Pinatubo (eruption of June 7, 1991), and Mount Redoubt (eruption of January 1990). (Endo et al., 1996). Data and figures from Endo et al., 1996.
Monitoring data of any kind can be viewed and compared, in time or space.
All data in WOVOdat will be tagged with contact information for the data owner (e.g. a volcano observatory or individual scientist) should raw data or additional details be required.</b></p>
                               </div>
                           </td>
                       </tr>
                   </table>
               </div>
           </div>           
        </div> 
    <!-- Footer -->
    <?php include 'php/include/footer.php'; ?>  
    </body>
</html>