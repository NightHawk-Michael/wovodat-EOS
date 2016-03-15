<?php
if (!isset($_SESSION))
    session_start();
?>
<script language="JavaScript" src="/jscookmenu/JSCookMenu.js" type="text/javascript"></script>
<link rel="stylesheet" href="/jscookmenu/ThemeOffice/theme.css" type="text/css">
<script language="JavaScript" src="/jscookmenu/ThemeOffice/theme.js" type="text/javascript"></script>
<script language="JavaScript" src="/jscookmenu/menu-items.js" type="text/javascript"></script>
<style type="text/css">
   #header2 div:first-child{  
        width: 180px;
		padding-top:1.5px;  

    }
    #header2 div a{
        color:white; height:230px;
    }
	
    #header2 div ul li{ 
        color: white;
        display: inline-block;
        padding-left: 10px;
        padding-right: 10px;
        text-align:center;
        font-size:	12px;		
	    font-family:verdana, arial, sans-serif;
		

    }
    #header2 div ul li:hover{
        background-color: #C6D3EF;
		height:21px;
		
    }
    #wovodatMenu{ 
         margin-left: 50px; 
    }
	
	#header2 div ul{  
        list-style-type:none;
        border-width: 0px;
        padding: 0px 0px 0px 0px;
        margin: 0px 0px 0px 0px;  
    }
	
	#partnerslist{
		padding-top:2px;
		background-color:#ffffff;
		height: 39px;	
	}

	#floatLeft1 {
		width: 6%; 
		float: left; 
	}
	
	#floatLeft {
		width: 24%; 
		float: left;
	}

	#floatRight {
	    width: 50%; 
		float: right;   
		padding-right:30px;
	}	

	#floatRight1 {
		float: right; 
	}
	
	#floatLeft,#floatRight,#floatLeft2,#floatRight2 {
	    font-family: 'Trebuchet MS','Helvetica Neue',Arial,Helvetica,sans-serif;
		color:  #333333;
		font-size:11px;
	}

	#floatLeft a,#floatRight a{
		color: #333333;
		text-decoration: none; 
	}	
	
	#floatLeft a:hover,#floatRight a:hover{
	    background-color: #C6D3EF;
	}	
	
	#partnerTitle{
		color:#444444;
		font-size:12px;
		font-weight:bold;
		font-style:italic;
	}
	

</style>
<div id="headershadow">
    <div id="headerspacer"></div>
    <div id="headerspacer1"></div>
    <div id="header1">
        <div id="wovologo">
            <a href="http://www.wovo.org/" target="_blank"><p align="center"><img src="/gif2/WOVO_logo.gif" alt="WOVO logo" width="40" height="40" border="0"></p></a>
            <div>
                <p align="center"><a title="The World Organization of Volcano Observatories" href="http://www.wovo.org/" target="_blank" style="color:#990000;"><b>WOVO</b></a></p>
            </div>
        </div>
		
        <div style="float:left; padding-top:27px;">
            <a href="http://volcanoes.usgs.gov/vdap/" title="vdap" target="_blank"><p align="center"><img src="/gif2/usgs.png" alt="WOVO logo" width="73" height="30" border="0"></p></a>
        </div>

		
        <div align="left" id="wovodatlogo">
            <a href="http://www.wovodat.org/" target="_parent"><b><span style="font-family:lucida,sans-serif; font-size:32px; color:#0005b2;">&nbsp WOVOdat</span></b><span style="font-family:lucida,sans-serif; font-size:12px; color:#fdfdfd;"> &nbsp&nbsp&nbsp ...A Database of Volcanic Unrest</span></a>
        </div>
		<div id="eoslogo">
			<a href="http://www.earthobservatory.sg/" target="_blank">
            <p align="left"><img title="Earth Observatory of Singapore, An Institute of Nanyang Technological University" src="/gif2/EOS_logo_3.png" alt="EOS logo" width="139" height="60" border="0"></p></a>
        </div>
        <div align="left" id="silogo">
            <a href="http://www.volcano.si.edu/" target="_blank">
                <img title="National Museum of Natural History" src="/gif2/SI_logo_2.png" alt=" si logo" width="147" height="55" border="0"></a>
        </div>
    </div>
	
    <div id="header2">
        <div style="float:right">
            <ul>
                <?php
                if (isset($_SESSION['login'])) {
                    ?>
                    <li>
                        <a href="/populate/my_account.php"><?php 
                        $n = $_SESSION['login']['cr_uname'];
                        $l = strlen($n);
                        if($l > 12) $n = substr($n,0,12) . '...';
                        echo $n; 
                        ?></a>
                    </li>
                    <li>
                        <a href="/populate/logout.php">Logout</a>
                    </li>
                    <?php
                } else {
                    ?>

                    <li>
                        <a href="/populate/index.php">Login</a>
                    </li>
                    <?php
                }
                ?>
                
            </ul>
        </div>
        <div id="wovodatMenu">
            <script type="text/javascript">cmDraw('wovodatMenu',wovodatMenu,'hbr', cmThemeOffice);</script>
        </div>		
    </div>
    <div id="partnerslist">
    	<div id="floatLeft1">
			<table>
				<tr>
					<td>			
						<span id="partnerTitle">Partners:</span>
					</td>
				</tr>
			</table>    	
    	</div>	
		<div id="floatLeft">
			<table>
				<tr>
					<td>			
						<a href="http://www.futurevolc.hi.is" title="ICELAND: Present day in-situ monitoring networks of volcanic and seismic hazards" target="_blank">FutureVolc&nbsp</a>
						<a href="http://www.geonet.org.nz/volcano/" title="Geonet Project of New Zealand" target="_blank">GeoNet&nbsp</a>
						<a href="http://volcano.si.edu" title="Global Volcanism Program" target="_blank">GVP&nbsp</a>
						<a href="http://www.globalvolcanomodel.org"  title="Global Volcano Model"  target="_blank">GVM&nbsp</a>
						<a href="http://www.iris.edu/hq"  title="Incorporated Research Intitutions for Seismology"  target="_blank">IRIS&nbsp</a>
						<a href="http://www.bosai.go.jp/e/"  title="JAPAN: National Research Institute for Earth Science and Disaster Prevention"  target="_blank">NIED&nbsp</a>
						<a href="http://www.bgs.ac.uk/vogripa"  title="Volcano Global Risk Identification and Analysis Project"  target="_blank">VOGRIPA&nbsp</a>
						<a href="http://www.wovo.org/observatories"  title="WOVO Observatories"  target="_blank">WOVO-Observatories&nbsp</a>
					</td>
				</tr>
			</table>
		</div>

		<div id="floatRight">
			<table>
				<tr>
					<td>			
						<a href="http://www.avo.alaska.edu" title="US. Alaska Volcano Observatory" target="_blank">AVO(US)&nbsp</a>
						<a href="http://www.eri.u-tokyo.ac.jp/VRC/kansoku/asama_E.html" title="JAPAN. Asama Volcano Observatory" target="_blank">AVO(Jp)&nbsp</a>
						<a href="http://www.cvarg.azores.gov.pt/Paginas/home-cvarg.aspx" title="PORTUGAL. Universidade dos Açores: Centro de Vulcanologia" target="_blank">CVARG&nbsp</a>
						<a href="http://www.eri.u-tokyo.ac.jp/VRC/index_E.html" title="JAPAN. University of Tokyo: Volcano Research Center" target="_blank">ERI-VRC&nbsp</a>
						<a href="http://www.igepn.edu.ec" title="ECUADOR. Instituto Geofisico-Escuela Politechnica Nacional" target="_blank">IG-EPN&nbsp</a>
						<a href="http://www.ingv.it/en" title="ITALY. Istituto Nazionale di Geofisica e Vulcanologica" target="_blank">INGV&nbsp</a>
						<a href="http://www.ineter.gob.ni/" title="NICARAGUA. Instituto Nicaragüense de Estudios Territoriales" target="_blank">INETER&nbsp</a>
						<a href="http://www.insivumeh.gob.gt/geofisica.html" title="GUATEMALA. Instituto Nacional de Sismologia, Vulcanologia, Meteorologia e Hidrologia" target="_blank">INSIVUMEH&nbsp</a>
						<a href="http://www.ipgp.fr/pages/0303.php?langue=1" title="FRANCE. IPGP: Observatoires Volcanologiques et Sismologiques" target="_blank">IPGP&nbsp</a>
						<a href="http://www.jma.go.jp/en/volcano/" title="JAPAN Meteorological Agency" target="_blank">JMA&nbsp</a>
						<a href="http://www.mvo.ms" title="MONTSERRAT. Montserrat Volcano Observatory" target="_blank">MVO&nbsp</a>
						<a href="http://www2.norvol.hi.is/" title="ICELAND. University of Iceland: Nordic Volcanological Center" target="_blank">NVC&nbsp</a>
						<a href="http://www.ucol.mx/volcan/" title="MEXICO. Universidad de Colima: Observatorio Vulcanológico" target="_blank">OV&nbsp</a>
						<a href="http://wovo.org/0203.html" title="CONGO. Observatoire Volcanologique de Goma" target="_blank">OVG&nbsp</a>
						<a href="http://www.sernageomin.cl/volcan-observatorio.php" title="CHILE. Observatorio Volcanológico de Los Andes del Sur" target="_blank">OVDAS&nbsp</a>
						<a href="http://www.ovsicori.una.ac.cr" title="COSTA RICA. Universidad Nacional: Observatorio Vulcanológico y Sismológico de Costa Rica" target="_blank">OVSICORI&nbsp</a>
						<a href="http://www.phivolcs.dost.gov.ph"  title="The PHILIPPINE Institute of Volcanology and Seismology"  target="_blank">PHIVOLCS&nbsp</a>
						<a href="http://www.vsi.esdm.go.id" title="INDONESIA. Center of Volcanology and Geological Hazard Mitigation" target="_blank">PVMBG&nbsp</a>
						<a href="http://www.wovo.org/0500_0504.html" title="PAPUA NEW GUINEA. Rabaul Volcano Observatory" target="_blank">RVO&nbsp</a>
						<a href="http://www.ingeominas.gov.co/Observatorios-Vulcanologicos.aspx" title="COLOMBIA. Servicio Geológico Colombiano: Observatorios Vulcanológicos" target="_blank">SGC&nbsp</a>
						<a href="http://www.dpri.kyoto-u.ac.jp/~kazan/default_e.html" title="JAPAN. Kyoto University: Sakurajima Volcano Research Center" target="_blank">SVRC&nbsp</a>
						<a href="http://volcanoes.usgs.gov/" title="USGS Volcano Hazard Program" target="_blank">USGS&nbsp</a>
						<a href="http://uvo.sci.hokudai.ac.jp/" title="JAPAN. Hokkaido University: Usu Volcano Observatory" target="_blank">UVO,</a>
						<a href="http://www.wovo.org/observatories" title="Browse on WOVO.org" target="_blank"> and ...</a>							
					</td>
				</tr>
			</table>
		</div>
		<div id="floatRight1">
			<table>
				<tr><td>			
						<span id="partnerTitle">WOVO-Observatories:</span>
				</td></tr>
			</table>
		</div>
	
	</div>		<!-- end of partnerslist div-->


</div>

<div style="padding-top:60px;"></div>  <!-- To move down contents from every pages-->