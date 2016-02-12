<?php
if(!isset($_SESSION)) {
    session_start();
}
require_once "php/include/db_connect.php";

if(!isset($_SESSION['login'])){
	header('Location:index.php?nopost=1');
}


function obsname($ccid){               // Added to distingish wovodat_Tool.tar using cc_obs on 10oct2012
	global $link;

	$sql="select cc.cc_obs as ccobs from cc where cc.cc_id='$ccid'";
	$result = mysql_query($sql);
	$row= mysql_fetch_array($result);	
	return $row['ccobs'];

}

function obslist(){               // For observatory drop down list added on 10oct2012
	global $link;

	$sql="select cc_code, cc_country, cc_obs, cc_id from cc order by cc_country";
	$result = mysql_query($sql);

	while($row=mysql_fetch_array($result))
		$data[]=$row;

	return $data;
}



if(isset($_POST['observ'])) {
	
	$observ=$_POST['observ'];
	
	function cctable($observ){
		global $link;

		
		$sql="select * from cc WHERE cc.cc_code='$observ'";

		$result = mysql_query($sql, $link);
		$row = mysql_fetch_array($result);


		$cc_sql = "INSERT INTO cc (cc_id,cc_code,cc_code2,cc_fname,cc_lname,cc_obs,cc_add1,cc_add2,cc_city,cc_state,cc_country, cc_post,cc_url,cc_email,cc_phone,cc_phone2,cc_fax,cc_com,cc_loaddate) VALUES('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]','$row[7]','$row[8]','$row[9]','$row[10]','$row[11]','$row[12]','$row[13]','$row[14]','$row[15]','$row[16]','$row[17]','$row[18]')";

		return $cc_sql;

	}

	function vdtable($observ){
		global $link;

		$sql="select * from vd where vd.cc_id = (select cc_id from cc where cc.cc_code='$observ') || vd.cc_id2 = (select cc_id from cc where cc.cc_code='$observ') || vd.cc_id3 = (select cc_id from cc where cc.cc_code='$observ') || vd.cc_id4 = (select cc_id from cc where cc.cc_code='$observ') || vd.cc_id5 = (select cc_id from cc where cc.cc_code='$observ')";

		$result = mysql_query($sql,$link);

		while ($row = mysql_fetch_array($result)){
			$data[] = $row;
		}
		
		$datasize=sizeof($data);
		
		$vd_sql = "INSERT INTO vd(vd_id,vd_cavw,vd_name,vd_name2,vd_tzone,vd_mcont,cc_id,cc_id2,cc_id3,cc_id4,cc_id5,vd_loaddate,vd_pubdate,cc_id_load) VALUES ";

		for($i=0;$i<$datasize;$i++){

			$vd_sql .= "('{$data[$i][0]}','{$data[$i][1]}','{$data[$i][2]}','{$data[$i][3]}','{$data[$i][4]}','{$data[$i][5]}','{$data[$i][6]}','{$data[$i][7]}','{$data[$i][8]}','{$data[$i][9]}','{$data[$i][10]}','{$data[$i][11]}','{$data[$i][12]}','{$data[$i][13]}')";

			if($i != ($datasize-1) )
				$vd_sql .= ",";
		}
		
		return $vd_sql;

	}


	function vdinftable($observ){
		global $link;

		$sql="select * from vd_inf as vi where vi.vd_id IN (select vd.vd_id from vd where vd.cc_id = (select cc_id from cc where cc.cc_code='$observ') || vd.cc_id2 = (select cc_id from cc where cc.cc_code='$observ') || vd.cc_id3 = (select cc_id from cc where cc.cc_code='$observ') || vd.cc_id4 = (select cc_id from cc where cc.cc_code='$observ') || vd.cc_id5 = (select cc_id from cc where cc.cc_code='$observ'))";

		$result = mysql_query($sql,$link);

		while ($row = mysql_fetch_array($result)){
			$data[] = $row;
		}

		$datasize=sizeof($data);
		
		$vdinf_sql = "INSERT INTO vd_inf(vd_inf_id,vd_id,vd_inf_cavw,vd_inf_status,vd_inf_desc,vd_inf_slat,vd_inf_slon,vd_inf_selev,vd_inf_type,vd_inf_evol,vd_inf_numcald,vd_inf_lcald_dia,vd_inf_ycald_lat,vd_inf_ycald_lon,vd_inf_stime,vd_inf_stime_unc,vd_inf_etime,vd_inf_etime_unc,cc_id,vd_inf_loaddate,vd_inf_pubdate,cc_id_load) VALUES ";
		
		for($i=0;$i<$datasize;$i++){

			$vdinf_sql .= "('{$data[$i][0]}','{$data[$i][1]}','{$data[$i][2]}','{$data[$i][3]}','{$data[$i][4]}','{$data[$i][5]}','{$data[$i][6]}','{$data[$i][7]}','{$data[$i][8]}','{$data[$i][9]}','{$data[$i][10]}','{$data[$i][11]}','{$data[$i][12]}','{$data[$i][13]}','{$data[$i][14]}','{$data[$i][15]}','{$data[$i][16]}','{$data[$i][17]}','{$data[$i][18]}','{$data[$i][19]}','{$data[$i][20]}','{$data[$i][21]}')";
			
			if($i != ($datasize-1) )
				$vdinf_sql .= ",";
		}

		return $vdinf_sql;

	}

	function steqttable($observ){
		global $link;

		$sql="select cc.cc_id from cc WHERE cc.cc_code='$observ'";
		$result = mysql_query($sql, $link);
		$ccId = mysql_fetch_array($result);		
		
		
		$sql="select st_eqt_id,st_eqt_wovo,st_eqt_org,st_eqt_name,st_eqt_loaddate,cc_id_load from st_eqt as e where e.cc_id='303'";
		$result = mysql_query($sql,$link);
		while ($row = mysql_fetch_array($result)){
			$data[] = $row;
		}

		$datasize=sizeof($data);
		
		$steqt_sql = "INSERT INTO st_eqt (st_eqt_id,st_eqt_wovo,st_eqt_org,st_eqt_name, cc_id, st_eqt_loaddate,cc_id_load) VALUES ";
		
		for($i=0;$i<$datasize;$i++){

			$steqt_sql .= "('{$data[$i][0]}','{$data[$i][1]}','{$data[$i][2]}','{$data[$i][3]}', '$ccId[0]', '{$data[$i][4]}','{$data[$i][5]}')";
			
			if($i != ($datasize-1) )
				$steqt_sql .= ",";
		}

		return $steqt_sql;

	}

	

	$cc = cctable($observ);
	$vd = vdtable($observ);
	$vdinf =vdinftable($observ);
	$steqt =steqttable($observ);

	$sqlmasterfile = "wovodat_DB/wovodat_master.sql";
	$masterhandle = fopen($sqlmasterfile,"r");
	$masteroutfile=fread($masterhandle,filesize($sqlmasterfile));



	$outfile = "wovodat_DB/wovodat.sql";
	$sqlfile = $masteroutfile."\n".$cc.";\n".$vd.";\n".$vdinf.";\n".$steqt.";";


	$outhandle = fopen($outfile, 'w');
	fwrite($outhandle, $sqlfile);

	fclose($outhandle);
	fclose($masterhandle);

	if(file_exists($outfile)) {  
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($outfile));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($outfile));
		
		ob_clean();
		flush();
		readfile($outfile);
		unlink($outfile);
		exit;
	} 

}
?>	