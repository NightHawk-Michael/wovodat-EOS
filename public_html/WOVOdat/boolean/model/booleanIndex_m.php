<?php           
include 'php/include/db_connect.php';

 
//get Volcano Feature Type
function getFeatureType() {

	global $link;
			
	$sql=" SHOW COLUMNS FROM vd_inf LIKE 'vd_inf_type'";
	
	$result = mysql_query($sql, $link);
	$row = mysql_fetch_array($result,MYSQL_NUM );
	$regex = "/'(.*?)'/";
	preg_match_all( $regex , $row[1], $enum_array );
	$enum_fields = $enum_array[1];
	return $enum_fields;
}


//get Volcano Rock Type
function getRockType(){
	global $link;
		
	$sql=" SHOW COLUMNS FROM vd_inf LIKE 'vd_inf_rtype'";

	$result = mysql_query($sql, $link);

	$row = mysql_fetch_array($result,MYSQL_NUM );
	$regex = "/'(.*?)'/";
	preg_match_all( $regex , $row[1], $enum_array );
	$enum_fields = $enum_array[1];
	return $enum_fields;
}

//get Eruption Phase Type
function getedPhaseType(){
	global $link;
		
	$sql=" SHOW COLUMNS FROM ed_phs LIKE 'ed_phs_type'";

	$result = mysql_query($sql, $link);

	$row = mysql_fetch_array($result,MYSQL_NUM );
	$regex = "/'(.*?)'/";
	preg_match_all( $regex , $row[1], $enum_array );
	$enum_fields = $enum_array[1];
	return $enum_fields;
}

//get Eruption Phase Type - use for sd_evn, sd_evs, sd_ivl
function geteqType(){
	global $link;
		
//	$sql=" SHOW COLUMNS FROM sd_evn LIKE 'sd_evn_eqtype'";
	
	$sql="select concat(st_eqt.st_eqt_name,' (',st_eqt.st_eqt_wovo,')') as eqName, st_eqt.st_eqt_wovo 
from st_eqt where st_eqt.cc_id=303 order by st_eqt.st_eqt_name ASC";
//	echo $sql;
	
	$enum_fields = Array();

	$result = mysql_query($sql, $link);
	while($row=mysql_fetch_array($result))
		$enum_fields[]=$row;		

	return $enum_fields;
}



//get Tremor Type 
function gettremorType(){
	global $link;
		
	$sql=" SHOW COLUMNS FROM sd_trm LIKE 'sd_trm_type'";

	$result = mysql_query($sql, $link);

	$row = mysql_fetch_array($result,MYSQL_NUM );
	$regex = "/'(.*?)'/";
	preg_match_all( $regex , $row[1], $enum_array );
	$enum_fields = $enum_array[1];
	return $enum_fields;
}


//get Sampled Gas Species
function getSampledGasSpecies(){
	global $link;
		
	$sql=" SHOW COLUMNS FROM gd LIKE 'gd_species'";

	$result = mysql_query($sql, $link);

	$row = mysql_fetch_array($result,MYSQL_NUM );
	$regex = "/'(.*?)'/";
	preg_match_all( $regex , $row[1], $enum_array );
	$enum_fields = $enum_array[1];
	return $enum_fields;
}

//get Plume Species
function getPlumeSpecies(){
	global $link;
		
	$sql=" SHOW COLUMNS FROM gd_plu LIKE 'gd_plu_species'";

	$result = mysql_query($sql, $link);

	$row = mysql_fetch_array($result,MYSQL_NUM );
	$regex = "/'(.*?)'/";
	preg_match_all( $regex , $row[1], $enum_array );
	$enum_fields = $enum_array[1];
	return $enum_fields;
}

//get Soil Species
function getSoilSpecies(){
	global $link;
		
	$sql=" SHOW COLUMNS FROM gd_sol LIKE 'gd_sol_species'";

	$result = mysql_query($sql, $link);

	$row = mysql_fetch_array($result,MYSQL_NUM );
	$regex = "/'(.*?)'/";
	preg_match_all( $regex , $row[1], $enum_array );
	$enum_fields = $enum_array[1];
	return $enum_fields;
}


//get Hydrologic Species
function getHdSpecies(){
	global $link;
		
	$sql=" SHOW COLUMNS FROM hd LIKE 'hd_comp_species'";

	$result = mysql_query($sql, $link);

	$row = mysql_fetch_array($result,MYSQL_NUM );
	$regex = "/'(.*?)'/";
	preg_match_all( $regex , $row[1], $enum_array );
	$enum_fields = $enum_array[1];
	return $enum_fields;
}

$type = $_GET["dataType"];
switch ($type) {
	case 'feature':
		echo json_encode( getFeatureType() );
		break;
	case 'rock':
		echo json_encode( getRockType() );
		break;	
	case 'edPhase':
		echo json_encode( getedPhaseType() );
		break;
	case 'sd_evn' :
		echo json_encode( geteqType() );
		break;
	case 'sd_evs' :
		echo json_encode( geteqType() );
		break;
	case 'sd_ivl' :
		echo json_encode( geteqType() );
		break;
	case 'sd_trm':
		echo json_encode( gettremorType() );
		break;
	case 'gd':
		echo json_encode( getSampledGasSpecies() );
		break;
	case 'gd_plu':
		echo json_encode( getPlumeSpecies() );
		break;
	case "gd_sol":
		echo json_encode( getSoilSpecies() );
		break;
	case 'hd':
		echo json_encode( getHdSpecies() );
		break;
	default:
		# code...
		break;
}


?>