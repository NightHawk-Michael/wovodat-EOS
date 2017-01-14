<?php
// Start session
	session_start();
	// Regenerate session ID
	session_regenerate_id(true);
	$uname="";

// If session was already started
	if (isset($_SESSION['login'])) {
		// Get login ID and user name
		$uname=$_SESSION['login']['cr_uname'];
		$cp_access=$_SESSION['permissions']['access'];		
		if($cp_access==9){
			exit();			
		}
	}else{
			header('Location:http://www.wovodat.org/index.php');
			exit();		
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>WOVOdat :: The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat), by IAVCEI</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
	<meta name="description" content="The World Organization of Volcano Observatories (WOVO): Database of Volcanic Unrest (WOVOdat)">
	<meta name="keywords" content="Volcano, Vulcano, Volcanoes">
	<link href="/css/styles_beta.css" rel="stylesheet">
	<link href="/gif2/WOVOfavicon.ico" type="image/x-icon" rel="SHORTCUT ICON">
	<script language="javascript" type="text/javascript" src="/js/scripts.js"></script>
</head>
<body>
	<div id="wrapborder">
	<div id="wrap">
			<?php include 'php/include/header_beta.php'; ?>

	  <div id="content">	
			<div id="contentlview">
				<h2><br><b>COMMITTEE</b></h2>
				<strong>1. The Steering Committee<br></strong><br>
				Membership in the steering committee is by invitation from the WOVO leadership team only.<br>The steering committee oversees activities by the WOVOdat project, discusses topics brought to the committee's attention, and votes on major decisions by simple majority (&gt;50% of members have to be present or participating in the vote). The steering committee meets at least once a year, and in the times in-between, acts via e-mail discussions and -votes as they become necessary. The steering committee is the &quot;political&quot; or &quot;legislative&quot; arm of WOVOdat.<br>Currently, there are 23 confirmed active members (in alphabetical order):<br>
				<br>
				<table width="100%" border="0" cellspacing="0" cellpadding="2">
					<tr>
						<td align="right" valign="top" width="20"></td>
						<td valign="top" width="155"><strong>Name</strong></td>
						<td valign="top" width="270"><strong>Institution, country</strong></td>
						<td valign="top" width="20">&nbsp</td>
						<td valign="top"><strong>member since</strong></td>
					</tr>
					<tr>
						<td align="right" valign="top" width="20">1</td>
						<td valign="top" width="155">Briole, Pierre</td>
						<td valign="top" width="270">Inst. de Physique du Globe de Paris, FR</td>
						<td valign="top" width="20">&nbsp</td>
						<td valign="top">Nov 2006</td>
					</tr>
					<tr>
						<td align="right" valign="top" width="20">2</td>
						<td valign="top" width="155">Brodsky, Emily</td>
						<td valign="top" width="270">Univ. of California, Santa Cruz, USA</td>
						<td valign="top" width="20">&nbsp</td>
						<td valign="top">Nov 2006</td>
					</tr>
					<tr>
						<td align="right" valign="top" width="20">3</td>
						<td valign="top" width="155">Carniel, Roberto</td>
						<td valign="top" width="270">Università di Udine, IT</td>
						<td valign="top" width="20">&nbsp</td>
						<td valign="top">Nov 2006</td>
					</tr>
					<tr>
						<td align="right" valign="top" width="20">4</td>
						<td valign="top" width="155">De la Cruz-Reya, Servando</td>
						<td valign="top" width="270">Universidad Nacional Autonoma de Mexico, MX</td>
						<td valign="top" width="20">&nbsp</td>
						<td valign="top">Nov 2006</td>
					</tr>
					<tr>
						<td align="right" valign="top" width="20">5</td>
						<td valign="top" width="155">Ewert, John</td>
						<td valign="top" width="270">USGS CVO, NVEWS, USA</td>
						<td valign="top" width="20">&nbsp</td>
						<td valign="top">Nov 2006</td>
					</tr>
					<tr>
						<td align="right" valign="top" width="20">6</td>
						<td valign="top" width="155">Fujita, Eisuke</td>
						<td valign="top" width="270">NIED, JP</td>
						<td valign="top" width="20">&nbsp</td>
						<td valign="top">Nov 2006</td>
					</tr>
					<tr>
						<td align="right" valign="top" width="20">7</td>
						<td valign="top" width="155">Gordeev, Evgenii</td>
						<td valign="top" width="270"><st1:place w:st="on"><st1:PlaceType w:st="on">Institute</st1:PlaceType> of <st1:PlaceName w:st="on">Volcanology</st1:PlaceName></st1:place> &amp; Seismology FEB RAS, RU</td>
						<td valign="top" width="20">&nbsp</td>
						<td valign="top">Nov 2006</td>
					</tr>
					<tr>
						<td align="right" valign="top" width="20">8</td>
						<td valign="top" width="155">Komorowski, Jean-Christophe</td>
						<td valign="top" width="270">Inst. de Physique du Globe de Paris, FR</td>
						<td valign="top" width="20">&nbsp</td>
						<td valign="top">Nov 2006</td>
					</tr>
					<tr>
						<td align="right" valign="top" width="20">9</td>
						<td valign="top" width="155">Malone, Steve</td>
						<td valign="top" width="270">Univ. of <st1:State w:st="on"><st1:place w:st="on">Washington, USA</st1:place></st1:State></td>
						<td valign="top" width="20">&nbsp</td>
						<td valign="top">Nov 2006</td>
					</tr>
					<tr valign="top">
						<td align="right" valign="top" width="20">10</td>
						<td valign="top" width="155">Marzocchi, Warner <sup>1</sup></td>
						<td valign="top" width="270">INGV/WOVO, IT</td>
						<td valign="top" width="20">&nbsp</td>
						<td valign="top">Nov 2006</td>
					</tr>
													<tr>
														<td align="right" valign="top" width="20">11</td>
														<td valign="top" width="155">Mattioli, Glen</td>
														<td valign="top" width="270">Univ. of Arkansas, USA</td>
														<td valign="top" width="20">&nbsp</td>
														<td valign="top">Nov 2006</td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20">12</td>
														<td valign="top" width="155">McNutt, Steve</td>
														<td valign="top" width="270">USGS AVO/Univ. of <st1:State w:st="on">Alaska/IAVCEI, USA</st1:State></td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top">Nov 2006</td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20">13</td>
														<td valign="top" width="155">Newhall, Chris</td>
														<td valign="top" width="270">EOS, Nanyang Technol. Univ., Singapore</td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top">Nov 2006</td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20">14</td>
														<td valign="top" width="155">Nye, Chris</td>
														<td valign="top" width="270">USGS AVO/Alaska State Geolog. Surv./NVEWS, USA</td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top">Nov 2006</td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20">15</td>
														<td valign="top" width="155">Pallister, John</td>
														<td valign="top" width="270">USGS, USA</td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top">Nov 2006</td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20">16</td>
														<td valign="top" width="155">Schwandner, Florian</td>
														<td valign="top" width="270">EOS, Nanyang Technol. Univ., Singapore</td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top">Nov 2006</td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20">17</td>
														<td valign="top" width="155">Scott, Bradley J.</td>
														<td valign="top" width="270">Geonet, Wairakei Research Centre, NZ</td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top">Nov 2006</td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20">18</td>
														<td valign="top" width="155">Lee Siebert</td>
														<td valign="top" width="270">GVP, Smithsonian Institution, USA</td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top">Oct  2007</td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20">19</td>
														<td valign="top" width="155">Solidum, Rene</td>
														<td valign="top" width="270">PHIVOLCS, Philippines</td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top">Nov 2006</td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20">20</td>
														<td valign="top" width="155">Sparks, Steve</td>
														<td valign="top" width="270">Univ. of Bristol, UK</td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top">Nov 2006</td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20">21</td>
														<td valign="top" width="155">Venezky, Dina</td>
														<td valign="top" width="270">USGS, USA</td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top">Nov 2006</td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20">22</td>
														<td valign="top" width="155">Voight, Barry</td>
														<td valign="top" width="270"><st1:PlaceName w:st="on">Pennsylvania</st1:PlaceName> <st1:PlaceType w:st="on">State</st1:PlaceType> Univ., USA</td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top">Nov 2006</td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20">23</td>
														<td valign="top" width="155">Tupper, Andrew</td>
														<td valign="top" width="270">Bureau of Meteorology, Australia</td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top">Nov 2006</td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20"></td>
														<td valign="top" width="155"><sup>1</sup> past interim chair</td>
														<td valign="top" width="270"></td>
														<td valign="top"></td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20"></td>
														<td valign="top" width="155"></td>
														<td valign="top" width="270"></td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top"></td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20"></td>
														<td valign="top" width="155"><strong>pending acceptance:</strong></td>
														<td valign="top" width="270"></td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top"><strong>invited</strong></td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20">24</td>
														<td valign="top" width="155">Cervelli, Dan</td>
														<td valign="top" width="270">USGS, USA</td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top">Jan 2007</td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20">25</td>
														<td valign="top" width="155">Ida, Yoshiaki</td>
														<td valign="top" width="270">Univ. of <st1:place w:st="on"><st1:City w:st="on">Hyogo</st1:City>, <st1:country-region w:st="on">J</st1:country-region></st1:place><st1:place w:st="on"><st1:country-region w:st="on">P</st1:country-region></st1:place></td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top">Nov 2006</td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20"></td>
														<td valign="top" width="155"></td>
														<td valign="top" width="270"></td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top"></td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20"></td>
														<td valign="top" width="155"><strong>former members</strong></td>
														<td valign="top" width="270"></td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top"><strong>period</strong></td>
													</tr>
													<tr>
														<td align="right" valign="top" width="20"></td>
														<td valign="top" width="155">Luhr, Jim †</td>
														<td valign="top" width="270">GVP, Smithsonian Institution, USA</td>
						<td valign="top" width="20">&nbsp</td>
														<td valign="top">Nov 2006 - Jan 2007</td>
													</tr>
												</table>
			</div>

			<div id="contentrview">
							<div id="top" align="left">
								<!-- Aligned to the right: You are logged in as username (FName LName | Obs) | Logout -->
								<p align="left">Login as: <b><?php print $uname; ?></b>|<a href='/populate/logout.php'>Logout</a></p>
				   		</div>
			</div>

				</p>
			</div>
		</div>
		<div id="footer">
			<?php include 'php/include/footer_main_beta.php'; ?>
		</div>
	</div>
	</div> <!--end of wrapborder-->
</body>
</html>



