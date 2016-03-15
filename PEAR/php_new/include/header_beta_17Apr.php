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
		background-color:#ffffff;
		height: 38px;
	}
	
	#partner,#wovoPartner{
	    font-family: 'Trebuchet MS','Helvetica Neue',Arial,Helvetica,sans-serif;
		color:  #333333;
		font-size:11px;
		height:15px;
	}

	#partner{
		padding-top:2px;
	}	
	
	#wovoPartner{
		padding-top:3px;
	}
	
	#partner a,#wovoPartner a{
		color: #333333;
		text-decoration: none; 
	}	
	
	#partner a:hover,#wovoPartner a:hover{
	    background-color: #C6D3EF;
	}	
	
	#partnerTitle{
		color:#444444;
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
		<div id="partner">		
			<span id="partnerTitle">Partners:</span>
			<a href="http://www.futurevolc.hi.is" title="Present day in-situ monitoring networks of volcanic and seismic hazards, Iceland" target="_blank">FutureVolc,</a>
			<a href="http://www.geonet.org.nz/volcano/" title="Geonet Project of New Zealand" target="_blank">GeoNet,</a>
			<a href="http://volcano.si.edu" title="Global Volcanism Program" target="_blank">GVP,</a>
			<a href="http://www.globalvolcanomodel.org"  title="Global Volcano Model"  target="_blank">GVM,</a>
			<a href="http://www.iris.edu/hq"  title="Incorporated Research Intitutions for Seismology"  target="_blank">IRIS,</a>
			<a href="http://www.bosai.go.jp/e/"  title="National Research Institute for Earth Science and Disaster Prevention"  target="_blank">NIED,</a>
			<a href="http://www.bgs.ac.uk/vogripa"  title="Volcano Global Risk Identification and Analysis Project"  target="_blank">VOGRIPA,</a>
			<a href="http://www.wovo.org/observatories"  title="WOVO Observatories"  target="_blank">WOVO-Observatories</a>
		</div>   
		<div id="wovoPartner">		
			<span id="partnerTitle">WOVO-Observatories:</span>
			<a href="http://www.avo.alaska.edu" title="Alaska Volcano Observatory, US" target="_blank">AVO(US)&nbsp</a>
			<a href="http://www.eri.u-tokyo.ac.jp/VRC/kansoku/asama_E.html" title="Asama Volcano Observatory, Japan" target="_blank">AVO(Jp)&nbsp</a>
			<a href="http://www.cvarg.azores.gov.pt/Paginas/home-cvarg.aspx" title="Universidade dos Açores: Centro de Vulcanologia, Portugal" target="_blank">CVARG&nbsp</a>
			<a href="http://www.eri.u-tokyo.ac.jp/VRC/index_E.html" title="University of Tokyo: Volcano Research Center, Japan" target="_blank">ERI-VRC&nbsp</a>
			<a href="http://www.igepn.edu.ec" title="Instituto Geofisico-Escuela Politechnica Nacional, Ecuador" target="_blank">IG-EPN&nbsp</a>
			<a href="http://www.ingv.it/en" title="Istituto Nazionale di Geofisica e Vulcanologia, Italy" target="_blank">INGV&nbsp</a>
			<a href="http://www.ineter.gob.ni/" title="Instituto Nicaragüense de Estudios Territoriales, Nicaragua" target="_blank">INETER&nbsp</a>
			<a href="http://www.insivumeh.gob.gt/geofisica.html" title="Instituto Nacional de Sismologia, Vulcanologia, Meteorologia e Hidrologia, Guatemala" target="_blank">INSIVUMEH&nbsp</a>
			<a href="http://www.ipgp.fr/pages/0303.php?langue=1" title="IPGP: Observatoires Volcanologiques et Sismologiques, France" target="_blank">IPGP&nbsp</a>
			<a href="http://www.jma.go.jp/en/volcano/" title="Japan Meteorological Agency" target="_blank">JMA&nbsp</a>
			<a href="http://www.mvo.ms" title="Montserrat Volcano Observatory, Montserrat" target="_blank">MVO&nbsp</a>
			<a href="http://www2.norvol.hi.is/" title="University of Iceland: Nordic Volcanological Center" target="_blank">NVC&nbsp</a>
			<a href="http://www.ucol.mx/volcan/" title="Universidad de Colima: Observatorio Vulcanológico, Mexico" target="_blank">OV&nbsp</a>
			<a href="http://wovo.org/0203.html" title="Observatoire Volcanologique de Goma, Congo" target="_blank">OVG&nbsp</a>
			<a href="http://www.sernageomin.cl/volcan-observatorio.php" title="Observatorio Volcanológico de Los Andes del Sur, Chile" target="_blank">OVDAS&nbsp</a>
			<a href="http://www.ovsicori.una.ac.cr" title="Universidad Nacional: Observatorio Vulcanológico y Sismológico de Costa Rica" target="_blank">OVSICORI&nbsp</a>
			<a href="http://www.phivolcs.dost.gov.ph"  title="The Philippine Institute of Volcanology and Seismology"  target="_blank">PHIVOLCS&nbsp</a>
			<a href="http://www.vsi.esdm.go.id" title="Center of Volcanology and Geological Hazard Mitigation, Indonesia" target="_blank">PVMBG&nbsp</a>
			<a href="http://www.wovo.org/0500_0504.html" title="Rabaul Volcano Observatory, PNG" target="_blank">RVO&nbsp</a>
			<a href="http://www.ingeominas.gov.co/Observatorios-Vulcanologicos.aspx" title="Servicio Geológico Colombiano: Observatorios Vulcanológicos, Colombia" target="_blank">SGC&nbsp</a>
			<a href="http://www.dpri.kyoto-u.ac.jp/~kazan/default_e.html" title="Kyoto University: Sakurajima Volcano Research Center, Japan" target="_blank">SVRC&nbsp</a>
			<a href="http://volcanoes.usgs.gov/" title="USGS Volcano Hazard Program" target="_blank">USGS&nbsp</a>
			<a href="http://uvo.sci.hokudai.ac.jp/" title="Hokkaido University: Usu Volcano Observatory, Japan" target="_blank">UVO,</a>
			<a href="http://www.wovo.org/observatories" title="...Etc" target="_blank"> and ...</a>
		</div> 
	</div>  	
</div>
	<div style="padding-top:60px;"></div>  <!-- To move down contents from every pages-->