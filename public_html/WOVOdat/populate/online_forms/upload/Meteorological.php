<?php
	//$file = fopen("output.txt","w");

	require_once('php/include/db_connect.php');
	// Start session
	session_start();

	// Regenerate session ID
	session_regenerate_id(true);

	// Get root url
	require_once "php/include/get_root.php";

	if(!isset($_SESSION['login'])) {
		header('Location: /populate/login_required.php');// Session was not yet started.... Redirect to login required page
		exit();
	}

	$data = array();
	foreach ($_POST as $key=>$value) {
		//echo $key . '<br/>' . $value . '<br/>';
		$data[$key] = $value;
	}

	//if (!$data['station'] || !$data['date']) die();

	$error = array();
	$success = array();
	$waiting = array();
	upload("06");
	upload("12");
	upload("18");
	upload("24");
	mysql_close($link);		
	output();

	//fclose($file);

	function get_fog_coverage($time) {
		global $data;
		$res = '';
		$int = intval($time);
		$i = $int - 6;
		while ($i < $int) {
			if ($data['fog_coverage'][$i] !== '0') 
				$res.= ' '.( $i<10 ? '0' : '') . $i.'="0'.$data['fog_coverage'][$i].'"';
			$i++;
		}
		if ($res) return "Fog coverage:".$res.';';
		return'';
	}

	function get_med_obs($time) {
		if ($time=='24') return '';
		$res = "";
		global $data;
		if ($data["visual_observation_".$time]!=='') 
			$res.= "Visual observation: \"".$data["visual_observation_".$time]."\";";
		$res.=get_fog_coverage($time);
		if ($data["temperature_min"]!=='') 
			$res.="Tmin: ".$data["temperature_min"].";";
		if ($data["temperature_max"]!=='') 
			$res.="Tmax: ".$data["temperature_max"].";";
		return $res;
	}

	function final_version($s) {
		if ($s !== '') return $s;
		else return 'NULL';
	}

	function final_version2($s) {
		if ($s !== '') 
			return "'" . $s . "'";
		else return 'NULL';
	}

	function upload($time) {
//		echo $time;
		global $data;
		$station_info = $data['station'];
		$pos = strpos($station_info, '$');
		$station_id = substr($station_info, 0, $pos);
		$station_code = substr($station_info, $pos + 1);

		$date = new DateTime($data['date']);
		if ($time !== '24')
			$date->setTime(intval($time), 0, 0);
		else $date->setTime(23, 59, 59);
		$med_code = final_version2(substr($station_code, 0, 15) . '_med_' . $date->format("Ymd") . $time);

		$date_raw = $date->format("Y-m-d H:i:s");
		$date_string = final_version2($date->format("Y-m-d H:i:s"));

		$date->add(new DateInterval("P7D"));
		$pubdate = final_version2($date->format("Y-m-d H:i:s"));

		if (isset($data['temperature_' . $time]))
			$temperature = final_version($data['temperature_' . $time]);
		else $temperature = final_version('');

		if (isset($data['humidity_' . $time]))
			$humidity = final_version($data['humidity_' . $time]);
		else $humidity = final_version('');

		if (isset($data['barometric_pressure_' . $time]))
			$barometric_pressure = final_version($data['barometric_pressure_' . $time]);
		else $barometric_pressure = final_version('');

		//$barometric_pressure = final_version($data['barometric_pressure_' . $time]);
		if ($barometric_pressure !== 'NULL') $barometric_pressure *= 1.33322368;
		$dominant_wind_direction = final_version2($data['dominant_wind_direction_' . $time]);
		$total_daily_precipitation = final_version($data['total_daily_precipitation']);
		$comments = final_version2($data['comments']);

		$med_obs = final_version2(get_med_obs($time));

		$today = new DateTime();	

		$today_string = final_version2($today->format("Y-m-d H:i:s"));

		$cc_id_load = $_SESSION['login']['cc_id'];

		$sql = "INSERT INTO med(ms_id, med_code, med_time, med_temp, med_hd, med_bp, med_wdir, med_prec, med_com, cc_id, med_loaddate, med_pubdate, cc_id_load, med_ori, med_obs) 
				VALUES($station_id, $med_code, $date_string, $temperature, $humidity, $barometric_pressure, $dominant_wind_direction,
				$total_daily_precipitation, $comments, 134, $today_string, $pubdate, $cc_id_load, 'O', $med_obs)";

		//echo $sql;
		global $error, $success, $waiting;

		if (exist($station_id, $date_string)) {
			global $med_id;
			$new_sql = "UPDATE med SET ms_id = $station_id, med_code = $med_code, med_time = $date_string, med_temp = $temperature, 
			med_hd = $humidity, med_bp = $barometric_pressure, med_wdir = $dominant_wind_direction, med_prec = $total_daily_precipitation, 
			med_com = $comments, cc_id = 134, med_loaddate = $today_string, med_pubdate = $pubdate, cc_id_load = $cc_id_load, med_ori = 'O' , med_obs = $med_obs
			WHERE med_id = $med_id";
			array_push($waiting, array('date'=>$date_raw, 'sql'=>$new_sql, 'med_id'=>$med_id));
			return;
		}
		global $link;
		$res = mysql_query($sql, $link);
		if(!$res) array_push($error, $date_raw);
		else {
			array_push($success, $date_raw);
		}
	}

	function exist($station_id, $date) {
		$sql = "SELECT med_id FROM med WHERE med_time = $date and ms_id = $station_id";
		global $link;
		$res = mysql_query($sql, $link);
		while ($row = mysql_fetch_array($res)) {
			global $med_id;
			$med_id = $row['med_id'];
			return true;
		}
		return false;
	}

	function output() {
		global $error, $success, $waiting;
		$response = array("error"=>$error, "success"=>$success, "waiting"=>$waiting);
		echo json_encode($response);
	}
?>