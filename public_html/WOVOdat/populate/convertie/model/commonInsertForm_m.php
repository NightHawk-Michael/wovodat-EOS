<?php           
include 'php/include/db_connect.php';

//check whther vd_cavw,vd_inf_cavw are already in database for jquery validation
##calling from insertFormValidation.js
if(isset($_POST['vd_cavw']) || isset($_POST['vd_inf_cavw'])){
	if(isset($_POST['vd_cavw'])){
		$cavw = trim($_POST['vd_cavw']);
	}
	if(isset($_POST['vd_inf_cavw'])){
		$cavw = trim($_POST['vd_inf_cavw']);
	}

	$chkResult = getcavw($cavw);
	print ("$chkResult");
}

##check whther code are already in database for jquery validation 
##calling from insertFormValidation.js
if(isset($_POST['cc_code']) || isset($_POST['cc_code2']) || isset($_POST['co_code']) || isset($_POST['ip_hyd_code']) || isset($_POST['ip_mag_code']) || isset($_POST['ip_pres_code']) || isset($_POST['ip_sat_code']) || isset($_POST['ip_tec_code']) || isset($_POST['sn_code']) || isset($_POST['ss_code'])  || isset($_POST['si_code']) || isset($_POST['si_cmp_code'])  || isset($_POST['cn_code']) || isset($_POST['ds_code']) || isset($_POST['di_gen_code']) || isset($_POST['di_tlt_code']) || isset($_POST['fs_code']) || isset($_POST['fi_code'])  || isset($_POST['gs_code']) || isset($_POST['gi_code'])  || isset($_POST['hs_code']) || isset($_POST['hi_code']) || isset($_POST['ms_code']) || isset($_POST['mi_code']) || isset($_POST['ts_code']) || isset($_POST['ti_code'])){

	if(isset($_POST['cc_code'])){
		$code = trim($_POST['cc_code']);
	}else if(isset($_POST['cc_code2'])){
		$code = trim($_POST['cc_code2']);
	}else if(isset($_POST['co_code'])){
		$code = trim($_POST['co_code']);
	}else if(isset($_POST['ip_hyd_code'])){
		$code = trim($_POST['ip_hyd_code']);
	}else if(isset($_POST['ip_mag_code'])){
		$code = trim($_POST['ip_mag_code']);
	}else if(isset($_POST['ip_pres_code'])){
		$code = trim($_POST['ip_pres_code']);
	}else if(isset($_POST['ip_sat_code'])){
		$code = trim($_POST['ip_sat_code']);
	}else if(isset($_POST['ip_tec_code'])){
		$code = trim($_POST['ip_tec_code']);
	}else if(isset($_POST['sn_code'])){  
		$code = trim($_POST['sn_code']);
	}else if(isset($_POST['ss_code'])){  
		$code = trim($_POST['ss_code']);
	}else if(isset($_POST['si_code'])){  
		$code = trim($_POST['si_code']);     
	}else if(isset($_POST['si_cmp_code'])){  
		$code = trim($_POST['si_cmp_code']);
	}else if(isset($_POST['cn_code'])){  
		$code = trim($_POST['cn_code']);   
	}else if(isset($_POST['ds_code'])){
		$code = trim($_POST['ds_code']);   
	}else if(isset($_POST['di_gen_code'])){
		$code = trim($_POST['di_gen_code']);   
	}else if(isset($_POST['di_tlt_code'])){
		$code = trim($_POST['di_tlt_code']);   
	}else if(isset($_POST['fs_code'])){
		$code = trim($_POST['fs_code']);   
	}else if(isset($_POST['fi_code'])){
		$code = trim($_POST['fi_code']);   
	}else if(isset($_POST['gs_code'])){
		$code = trim($_POST['gs_code']);   
	}else if(isset($_POST['gi_code'])){
		$code = trim($_POST['gi_code']);   
	}else if(isset($_POST['hs_code'])){
		$code = trim($_POST['hs_code']);   
	}else if(isset($_POST['hi_code'])){
		$code = trim($_POST['hi_code']);   
	}else if(isset($_POST['ms_code'])){
		$code = trim($_POST['ms_code']);   
	}else if(isset($_POST['mi_code'])){
		$code = trim($_POST['mi_code']);   
	}else if(isset($_POST['ts_code'])){
		$code = trim($_POST['ts_code']);   
	}else if(isset($_POST['ti_code'])){
		$code = trim($_POST['ti_code']);    
	}
	
	$chkResult = getCode($code);
	print ("$chkResult");
}


// Using for SN/SS/SI/SI_CMP  Common network,station & instru
if (isset($_POST['volListByJson']) ||  isset($_POST['networkListByJson']) ||  isset($_POST['stationListByJson']) ||  isset($_POST['instrumentListByJson']) || isset($_POST['commonNetworkListByJson']) || isset($_POST['satelliteListByJson'])) {   
	
	if(isset($_POST['volListByJson'])){
		$obs=$_POST['volListByJson'];
		getVolListDependOnObs($obs);  
	}
	
	if(isset($_POST['networkListByJson'])) { 
		$vdId=$_POST['networkListByJson'];
		getNetworkListDependOnVol($vdId);
	}	

	if(isset($_POST['stationListByJson'])) {   
		$table1=$_POST['table1'];
		$table2=$_POST['table2'];
		$netId=$_POST['stationListByJson'];
		getStationListDependOnNetwork($table1,$table2,$netId);
	}
	
	if(isset($_POST['instrumentListByJson'])) {   
		$instrId=$_POST['instrumentListByJson'];
		getInstruListDependOnStation($instrId);
	}	
	
	if(isset($_POST['commonNetworkListByJson'])) {   
		$vdId=$_POST['commonNetworkListByJson'];      
		$type=$_POST['type']; 
		getCommonNetworkListDependOnVol($vdId,$type);
	}	
	
	if(isset($_POST['satelliteListByJson'])) {   
		getSatelliteList();
	}	

	
} 

function getVolListDependOnObs($obs){
	global $link;

	$data=array();
		
	$sql="select vd_id,vd_name from vd where (vd.cc_id=$obs || vd.cc_id2=$obs || vd.cc_id3=$obs || vd.cc_id4=$obs || vd.cc_id5=$obs) order by vd_name ASC";

	$result = mysql_query($sql, $link);

	while ($row = mysql_fetch_assoc($result))
		$data[] = $row;
	
	echo json_encode($data);
}

function getNetworkListDependOnVol($vdId){  
	global $link;

	$data=array();
		
	$sql="select distinct sn.sn_id,sn.sn_name from vol_jj_sn as vjs, sn where vjs.sn_id=sn.sn_id and vjs.vd_id=$vdId order by sn.sn_name ASC";

	$result = mysql_query($sql, $link);

	while ($row = mysql_fetch_assoc($result))
		$data[] = $row;
	
	
	echo json_encode($data);
}

function getCommonNetworkListDependOnVol($vdId,$type){  
	global $link;

	$data=array();
		
	$sql="select distinct cn.cn_id,cn.cn_name from cn where cn.vd_id=$vdId and cn.cn_type='$type' order by cn.cn_name ASC";

	$result = mysql_query($sql, $link);

	while ($row = mysql_fetch_assoc($result))
		$data[] = $row;
	
	
	echo json_encode($data);
}
/*
function getStationListDependOnNetwork($netId){  
	global $link;

	$data=array();
		
	$sql="select distinct b.ss_id,b.ss_name from sn as a, ss as b where a.sn_id=b.sn_id and a.sn_id=$netId order by b.ss_name ASC";

	$result = mysql_query($sql, $link);

	while ($row = mysql_fetch_assoc($result))
		$data[] = $row;
	
	
	echo json_encode($data);
}
*/

function getStationListDependOnNetwork($table1,$table2,$netId){  
	global $link;
        
	$data=array();
	
	$fieldName1 = $table1.'_id';
	$fieldName2 = $table2.'_name';	
	$fieldName3 = $table2.'_id';
	
	$sql="select distinct b.$fieldName3,b.$fieldName2 from $table1 as a, $table2 as b where a.$fieldName1=b.$fieldName1 and a.$fieldName1=$netId order by b.$fieldName2 ASC";
	
	//$sql="select distinct b.ss_id,b.ss_name from sn as a, ss as b where a.sn_id=b.sn_id and a.sn_id=$netId order by b.ss_name ASC (or) select distinct b.cn_id,b.ds_name from cn as a, ds as b where a.cn_id=b.cn_id and a.cn_id=308 order by b.ds_name ASC; 

	$result = mysql_query($sql, $link);

	while ($row = mysql_fetch_assoc($result))
		$data[] = $row;
		

	echo json_encode($data);
}

function getInstruListDependOnStation($instrId){  

	global $link;

	$data=array();
		
	$sql="select distinct c.si_id,c.si_name from sn as a, ss as b, si as c where a.sn_id=b.sn_id and b.ss_id=c.ss_id and c.si_id=$instrId order by c.si_name ASC";

	$result = mysql_query($sql, $link);

	while ($row = mysql_fetch_assoc($result))
		$data[] = $row;
	
	
	echo json_encode($data);
}


function getSatelliteList(){  
	global $link;

	$data=array();
		
	$sql="select cs.cs_id,cs.cs_name from cs order by cs.cs_name ASC";

	$result = mysql_query($sql, $link);

	while ($row = mysql_fetch_assoc($result))
		$data[] = $row;
	
	
	echo json_encode($data);
}

//Get today date and time
function getTodayDate(){
	
	$todayDateTime=date('Y-m-d H:i:s');
	return $todayDateTime;
}

//Set default wovodat end time if the user leaves it blank.
function getEndTime($endTime){

	if($endTime == '' || $endTime == "YYYY-MM-DD HH:MM:SS" ){
		$endTime = "9999-12-31 23:59:59";   
	}

	return $endTime;
}


//Add 2 years to start date if the user leaves it blank.
function getPubDate($pubDate,$startTime){
	
	if($pubDate == '' || $pubDate == "YYYY-MM-DD HH:MM:SS" ){

/*	
		$datetime=strtotime($startTime);

		$max_pubdate=date('Y-m-d H:i:s', mktime(date('H',$datetime), date('i',$datetime), date('s',$datetime), date('m',$datetime), date('d',$datetime), date('Y',$datetime)+2));
*/
		$date = strtotime($startTime);
		$date = strtotime("+2 year", $date);  
		$max_pubdate=date('Y-m-d H:i:s', $date);		
	}
	
	return $max_pubdate;
}


//get volcano list
function getVolList(){
	global $link;

	$data=array();
		
	$sql="select vd_id,vd_name from vd order by vd_name ASC";

	$result = mysql_query($sql, $link);

	while ($row = mysql_fetch_array($result))
		$data[] = $row;
	
	return $data;
}


//get cc_id and cc_obs  
function getCcList(){
	global $link;

	$data=array();
		
	$sql="select cc_id,cc_country,cc_code,cc_obs from cc where cc_code NOT REGEXP '^-?[0-9]+$' order by cc_country ASC"; 

	$result = mysql_query($sql, $link);

	while ($row = mysql_fetch_array($result))
		$data[] = $row;
	
	return $data;
}


//get cb list
function getCbList(){
	global $link;

	$data=array();
		
	$sql="select cb_id,cb_auth,cb_year,cb_title from cb where cb_auth is not null order by cb_auth ASC"; 

	$result = mysql_query($sql, $link);

	while ($row = mysql_fetch_array($result))
		$data[] = $row;
	
	return $data;
}


//check whether vd_inf_cavw is already in database for jquery validation
function getcavw($cavw){
	global $link;

	if(isset($_GET['tableName'])){
		$tableName= $_GET['tableName'];
		
//vd_inf data is part of volcano data. So vd_inf_cavw must exit in vd table first. So check vd_inf_cavw in vd table.
//That's why true/false condition is change in below.	

		if($tableName == 'vd_inf')    
			$tableName = "vd";

		$tableCavw= $tableName."_cavw";
		
		$sql = "select * from $tableName where $tableCavw='$cavw'";

		$result = mysql_query($sql, $link);
		$num_rows= mysql_num_rows($result);
										
		if($_GET['tableName'] == "vd_inf"){
			if ($num_rows == 1)     // if user is found                   
				$found = "true";
			else
				$found = "false";
		}else{
			if ($num_rows == 1)     // if user is found                   
				$found = "false";
			else
				$found = "true";		
		}
		
		return $found;
	}
}


//check whether code is already in database for jquery validation
function getCode($code){
	global $link;

	if(isset($_GET['tableName'])){
		$tableName= $_GET['tableName'];

		$fieldName= $_GET['fieldName'];

		$sql = "select * from $tableName where $fieldName='$code'";

		$result = mysql_query($sql, $link);
		$num_rows= mysql_num_rows($result);
										

		if ($num_rows == 1)     // if user is found                   
			$found = "false";
		else
			$found = "true";	
		
		return $found;
	}
}

//insert new row. use it for every table
function insertTable($table_name,$field_name,$field_value){

	global $link;
	
	$fieldNameSize = sizeof($field_name);
	$fieldValueSize = sizeof($field_value);
	
	if($table_name != '' && $fieldNameSize == $fieldValueSize){
	
		$sql = 'insert into '. $table_name .' (' . $field_name[0];

		for($i=1; $i < $fieldNameSize; $i++){	     //get field name
			$sql .= ','. $field_name[$i];
		}

		$sql .= ') values ("'. $field_value[0]. '"';
		
		
		for($i=1; $i < $fieldValueSize; $i++){     // get field value
			if($field_value[$i] != ''){
				$sql .= ',"'. $field_value[$i] .'"';
			}else{
				$sql .= ',NULL';
			}	
		}
		
		$sql .= ')';
		
		$result=mysql_query($sql,$link);
	}	

	return $result;
	mysql_close($link);	
}




?>