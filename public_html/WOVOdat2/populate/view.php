<?php

/**********************************

This page displays the list of eruptions related to a volcano selected on select_volcano.php.

**********************************/

// Import necessary scripts
require_once("php/funcs/db_funcs.php");

// Check login
require_once("php/include/login_check.php");

// Get root url
require_once "php/include/get_root.php";

// Direct access
if (!isset($_POST['select_volcano_ok'])) {
	// Redirect to home page
	header('Location: '.$url_root.'home.php');
	exit();
}

// Get stored information
$list_volcanoes=$_SESSION['view_eruption']['list_volcanoes'];

// Get posted information
$vd_id=trim($_POST['select_volcano']);

// Get volcano name and cavw
for ($i=0; $i<count($list_volcanoes); $i++) {
	if ($vd_id==$list_volcanoes[$i]['vd_id']) {
		$volcano_name=htmlentities($list_volcanoes[$i]['vd_name'], ENT_COMPAT, "cp1252");
		$volcano_cavw=$list_volcanoes[$i]['vd_cavw'];
		break;
	}
}

unset($_SESSION['view_eruption']);

// Select all eruptions for selected volcano
$select_table="ed";
$select_field_name=array();
$select_field_value=array();
$select_field_name[0]="ed_name";
$select_field_name[1]="ed_nar";
$select_field_name[2]="ed_stime";
$select_field_name[3]="ed_stime_bc";
$select_field_name[4]="ed_stime_unc";
$select_field_name[5]="ed_etime";
$select_field_name[6]="ed_etime_bc";
$select_field_name[7]="ed_etime_unc";
$select_field_name[8]="ed_climax";
$select_field_name[9]="ed_climax_bc";
$select_field_name[10]="ed_climax_unc";
$select_field_name[11]="ed_com";
$select_field_name[12]="cc_id";
$select_where_field_name=array();
$select_where_field_value=array();
$select_where_field_name[0]="vd_id";
$select_where_field_value[0]=$vd_id;
$errors="";
if (!db_select($select_table, $select_field_name, $select_where_field_name, $select_where_field_value, $select_field_value, $errors)) {
	// Database error
	switch ($errors) {
		case "Error in the parameters given":
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=1046;
			$_SESSION['errors'][0]['message']=$errors." to db_select()";
			$_SESSION['l_errors']=1;
			// Redirect user to system error page
			header('Location: '.$url_root.'system_error.php');
			exit();
		default:
			$_SESSION['errors'][0]=array();
			$_SESSION['errors'][0]['code']=4018;
			$_SESSION['errors'][0]['message']=$errors;
			$_SESSION['l_errors']=1;
			// Redirect user to database error page
			header('Location: '.$url_root.'db_error.php');
			exit();
	}
}
// Number of results
$l_select_field_value=count($select_field_value);
if ($l_select_field_value!=0) {
	// Get results
	$name=array();
	$narrative=array();
	$stime=array();
	$stime_unc=array();
	$etime=array();
	$etime_unc=array();
	$climax=array();
	$climax_unc=array();
	$comment=array();
	$owner=array();
	
	// Temporary tables
	$temp_cc_id=array();
	$temp_owner=array();
	$cnt_owner=0;
	
	for ($i=0; $i<$l_select_field_value; $i++) {
		// Name
		$name[$i]=htmlentities($select_field_value[$i][0], ENT_COMPAT, "cp1252");
		// Narrative
		$narrative[$i]=htmlentities($select_field_value[$i][1], ENT_COMPAT, "cp1252");
		// Start time
		$stime[$i]=$select_field_value[$i][2];
		if ($select_field_value[$i][3]!="" && $select_field_value[$i][3]!=NULL) {
			// BC time exists
			$stime[$i]=$select_field_value[$i][3].substr($stime[$i], 4);
		}
		// Start time uncertainty
		$stime_unc[$i]=$select_field_value[$i][4];
		// End time
		$etime[$i]=$select_field_value[$i][5];
		if ($select_field_value[$i][6]!="" && $select_field_value[$i][6]!=NULL) {
			// BC time exists
			$etime[$i]=$select_field_value[$i][6].substr($etime[$i], 4);
		}
		// End time uncertainty
		$etime_unc[$i]=$select_field_value[$i][7];
		// Climax time
		$climax[$i]=$select_field_value[$i][8];
		if ($select_field_value[$i][9]!="" && $select_field_value[$i][9]!=NULL) {
			// BC time exists
			$climax[$i]=$select_field_value[$i][9].substr($climax[$i], 4);
		}
		// Climax time uncertainty
		$climax_unc[$i]=$select_field_value[$i][10];
		// Comment
		$comment[$i]=htmlentities($select_field_value[$i][11], ENT_COMPAT, "cp1252");
		
		// Owner
		$cc_id=$select_field_value[$i][12];
		
		// If no owner
		if ($cc_id=="" || $cc_id==NULL) {
			$owner[$i]="";
			continue;
		}
		
		// Browse owners already encountered
		
		// If no owner was encountered yet
		if ($cnt_owner==0) {
			// Select owner from DB
			$select_table="cc";
			$select_field_name=array();
			$select_field_value2=array();
			$select_field_name[0]="cc_fname";
			$select_field_name[1]="cc_lname";
			$select_field_name[2]="cc_obs";
			$select_where_field_name=array();
			$select_where_field_value=array();
			$select_where_field_name[0]="cc_id";
			$select_where_field_value[0]=$cc_id;
			$errors="";
			if (!db_select($select_table, $select_field_name, $select_where_field_name, $select_where_field_value, $select_field_value2, $errors)) {
				// Database error
				switch ($errors) {
					case "Error in the parameters given":
						$_SESSION['errors'][0]=array();
						$_SESSION['errors'][0]['code']=1046;
						$_SESSION['errors'][0]['message']=$errors." to db_select()";
						$_SESSION['l_errors']=1;
						// Redirect user to system error page
						header('Location: '.$url_root.'system_error.php');
						exit();
					default:
						$_SESSION['errors'][0]=array();
						$_SESSION['errors'][0]['code']=4018;
						$_SESSION['errors'][0]['message']=$errors;
						$_SESSION['l_errors']=1;
						// Redirect user to database error page
						header('Location: '.$url_root.'db_error.php');
						exit();
				}
			}
			// Get results
			$cc_fname=htmlentities($select_field_value2[0][0], ENT_COMPAT, "cp1252");
			$cc_lname=htmlentities($select_field_value2[0][1], ENT_COMPAT, "cp1252");
			$cc_obs=htmlentities($select_field_value2[0][2], ENT_COMPAT, "cp1252");
			
			// Form owner name
			if ($cc_fname!="") {
				$ownername=$cc_fname;
				if ($cc_lname!="") {
					$ownername.=" ".$cc_lname;
				}
			}
			else {
				if ($cc_lname!="") {
					$ownername=$cc_lname;
				}
				else {
					// No first name and no last name
					$ownername=$cc_obs;
				}
			}
			
			// Store name
			$owner[$i]=$ownername;
			$temp_cc_id[$cnt_owner]=$cc_id;
			$temp_owner[$cnt_owner]=$ownername;
			$cnt_owner++;
			continue;
		}
		
		// Look for owner
		$found=FALSE;
		for ($j=0; $j<$cnt_owner; $j++) {
			// If same cc_id, get name
			if ($cc_id==$temp_cc_id[$j]) {
				$owner[$i]=$temp_owner[$j];
				$found=TRUE;
				break;
			}
		}
		
		if ($found) {
			continue;
		}
		
		// Select owner from DB
		$select_table="cc";
		$select_field_name=array();
		$select_field_value2=array();
		$select_field_name[0]="cc_fname";
		$select_field_name[1]="cc_lname";
		$select_field_name[2]="cc_obs";
		$select_where_field_name=array();
		$select_where_field_value=array();
		$select_where_field_name[0]="cc_id";
		$select_where_field_value[0]=$cc_id;
		$errors="";
		if (!db_select($select_table, $select_field_name, $select_where_field_name, $select_where_field_value, $select_field_value2, $errors)) {
			// Database error
			switch ($errors) {
				case "Error in the parameters given":
					$_SESSION['errors'][0]=array();
					$_SESSION['errors'][0]['code']=1046;
					$_SESSION['errors'][0]['message']=$errors." to db_select()";
					$_SESSION['l_errors']=1;
					// Redirect user to system error page
					header('Location: '.$url_root.'system_error.php');
					exit();
				default:
					$_SESSION['errors'][0]=array();
					$_SESSION['errors'][0]['code']=4018;
					$_SESSION['errors'][0]['message']=$errors;
					$_SESSION['l_errors']=1;
					// Redirect user to database error page
					header('Location: '.$url_root.'db_error.php');
					exit();
			}
		}
		// Get results
		$cc_fname=htmlentities($select_field_value2[0][0], ENT_COMPAT, "cp1252");
		$cc_lname=htmlentities($select_field_value2[0][1], ENT_COMPAT, "cp1252");
		$cc_obs=htmlentities($select_field_value2[0][2], ENT_COMPAT, "cp1252");
		
		// Form owner name
		if ($cc_fname!="") {
			$ownername=$cc_fname;
			if ($cc_lname!="") {
				$ownername.=" ".$cc_lname;
			}
		}
		else {
			if ($cc_lname!="") {
				$ownername=$cc_lname;
			}
			else {
				// No first name and no last name
				$ownername=$cc_obs;
			}
		}
		
		// Store name
		$owner[$i]=$ownername;
		$temp_cc_id[$cnt_owner]=$cc_id;
		$temp_owner[$cnt_owner]=$ownername;
		$cnt_owner++;
	}
}

?>
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
	<script language="JavaScript" src="/js2/menu_array.js" type="text/javascript"></script>
	<script language="JavaScript" src="/js2/mmenu.js" type="text/javascript"></script>

	<div id="wrapborder">
	<div id="wrap">
		<?php include 'php/include/header_beta.php'; ?>
		<!-- Content -->
		<div id="content">	
			<div id="contentlview">
		<!-- Top of the page -->
		
		<!-- Page content -->
		<h1>List of eruptions</h1>
<?php

if ($l_select_field_value==0) {
	print <<<STRING
		<p>Volcano "$volcano_name" ($volcano_cavw) does not have any recorded eruption.</p>
STRING;
}
else {
	print <<<STRING
		<p style="font-size:10px;">Here is the list of eruptions for volcano "$volcano_name" ($volcano_cavw):</p>
		<table id="table_slgu">
			<tr>
				<th>Name</th>
				<th>Narrative</th>
				<th>Start time</th>
				<th>Start time uncertainty</th>
				<th>End time</th>
				<th>End time uncertainty</th>
				<th>Climax time</th>
				<th>Climax time uncertainty</th>
				<th>Comment</th>
				<th>Owner</th>
			</tr>
STRING;
	// Loop on eruptions
	for ($i=0; $i<$l_select_field_value; $i++) {
		print "\t\t\t<tr>\n".
		"\t\t\t\t<td>".$name[$i]."</td>\n".
		"\t\t\t\t<td>".$narrative[$i]."</td>\n".
		"\t\t\t\t<td>".$stime[$i]."</td>\n".
		"\t\t\t\t<td>".$stime_unc[$i]."</td>\n".
		"\t\t\t\t<td>".$etime[$i]."</td>\n".
		"\t\t\t\t<td>".$etime_unc[$i]."</td>\n".
		"\t\t\t\t<td>".$climax[$i]."</td>\n".
		"\t\t\t\t<td>".$climax_unc[$i]."</td>\n".
		"\t\t\t\t<td>".$comment[$i]."</td>\n".
		"\t\t\t\t<td>".$owner[$i]."</td>\n";
	}
}

?>
		</table>
		<p>You may now <a href="select_volcano.php">select another volcano</a> or <a href="home.php">go to home page</a>.</p>

			</div>
			<div id="contentrview">
				<div id="top" align="left">
					<!-- Aligned to the right: You are logged in as username (FName LName | Obs) | Logout -->
					<p align="right">Login as <b><?php print $uname; ?></b> | <a href="logout.php">Logout</a></p>
				</div><br>
		
			</div>
		</div>
		
		<!-- Footer -->
		<div id="footer">
			<?php include 'php/include/footer_beta.php'; ?>
		</div>
		
	</div>
</body>
</html>