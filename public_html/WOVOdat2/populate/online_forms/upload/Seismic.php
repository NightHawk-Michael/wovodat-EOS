<?php
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
		$data[$key] = $value;
	}
	calculate();
	upload();

	function calculate() {
		global $data;
		if ($data['magnitude'] == '') {
			if ($data['max_amplitude_of_trace'] != '') {
				$data['magnitude'] = log10(2.8 * $data['max_amplitude_of_trace']) + 1.4;
			} else
			if ($data['duration'] != '') {
				$data['magnitude'] = 1.91 * log10($data['duration']) - 1.45;
			}
		}

		if ($data['energy'] == '') {
			if ($data['magnitude'] != '') {
				$log = 4.8 + (1.5 * $data['magnitude']) + 7;
				$data['energy'] = pow(10, $log);
			}
		}
	}

	function isDigit($x) {
		$digits = '0123456789';
		if (strpos($digits, $x) === FALSE) return false;
		return true;
	}

	function refine($raw) {
		$res = "";
		for ($i = 0; $i < strlen($raw); $i++) if (isDigit($raw[$i]))
			$res .= $raw[$i];
		return $res;
	}

	function make_2_digits($num) {
		if ($num < 10) return '0' . $num;
		else return $num;
	}

	function upload() {
		global $data;
		$station = $data['station'];
		$pos = strpos($station, '$');

		$to_upload = array();

		$to_upload['ss_id'] = substr($station, 0, $pos);
		$ss_code = substr($station, $pos + 1);
		
		//date time
		$to_upload['sd_evs_time'] = $data['date'] . ' '. $data['time'];
		$to_upload['sd_evs_time_ms'] = $data['millisec'];

		$time = DateTime::createFromFormat("Y-m-d H:i:s", $data['date'] . ' ' . $data['time']);
		$time->add(new DateInterval("P7D"));
		$to_upload['sd_evs_pubdate'] = $time->format("Y-m-d H:i:s");
		$to_upload['sd_evs_code'] = $ss_code . '_' . 
				refine($to_upload['sd_evs_time'] . make_2_digits($to_upload['sd_evs_time_ms'] * 100));

		$today = new DateTime();
		$to_upload['sd_evs_loaddate'] = $today->format("Y-m-d H:i:s");

		//others
		$to_upload['sd_evs_picks'] = $data['pick_determination'];
		$to_upload['sd_evs_spint'] = $data['sp_interval'];
		$to_upload['sd_evs_dur'] = $data['duration'];
		$to_upload['sd_evs_maxamptrac'] = $data['max_amplitude_of_trace'];

		//added in 4-Sep-2013
		$to_upload['sd_evs_mag'] = $data['magnitude'];
		$to_upload['sd_evs_energy'] = $data['energy'];

		//added in 9-Sep-2013
		$to_upload['sd_evs_domFre'] = $data['frequency'];
		$to_upload['sd_evs_firMotion'] = $data['first_motion'];

		//end added
		
		$to_upload['sd_evs_eqtype'] = $data['earthquake_type'];
		$to_upload['sd_evs_ori'] = 'O';
		if ($data['drum_plot_record_no'] !== '') {
			$to_upload['sd_evs_com'] = 'Drum plot no = ' . $data['drum_plot_record_no'] . ';' . $data['comments'];
		} else $to_upload['sd_evs_com'] = $data['comments'];

		//user
		$to_upload['cc_id'] = 134;
		$to_upload['cc_id_load'] = $_SESSION['login']['cc_id']; 

		//sql

		$sql = make_sql($to_upload);

		$sd_evs_id = exist($to_upload['sd_evs_code']);
		if ($sd_evs_id) {
			if ($data['replace'] == 'NO')
				echo 'Existed';
			else {
				$sql = make_sql2($to_upload, $sd_evs_id);
				global $link;
				$res = mysql_query($sql, $link);			
				if (!$res) echo 'Error!';
				else echo 'Replaced!';				
			}
		} else {
			global $link;
			$res = mysql_query($sql, $link);			
			if (!$res) echo 'Failed';
			else echo 'Success';
		}
	}

	function make_sql($data) {
		$res = "INSERT INTO sd_evs(";
		$flag = false;
		foreach ($data as $key=>$value) {
			if ($flag) $res .= ", $key";
			else $res .= $key;
			$flag = true;
		}
		$res .= ") VALUES(";
		$flag = false;
		foreach ($data as $key=>$value) {
			if ($flag) $res .= ", " . final_version($value);
			else $res.= final_version($value);
			$flag = true;
		}
		$res .= ')';
		return $res;
	}

	function make_sql2($data, $sd_evs_id) {
		$res = "UPDATE sd_evs SET ";
		$flag = false;
		foreach ($data as $key=>$value) {
			if ($flag) $res .= ", $key = " . final_version($value);
			else $res .= "$key = ". final_version($value);
			$flag = true;
		}
		$res .= " WHERE sd_evs_id = $sd_evs_id";
		return $res;
	}

	function final_version($value) {
		if ($value === '') return 'NULL';
		if (is_numeric($value)) return $value;
		return "'" . $value . "'";
	}

	function exist($sd_evs_code) {
		$sql = "SELECT * FROM sd_evs WHERE sd_evs_code = '$sd_evs_code'";
		global $link;
		$res = mysql_query($sql, $link);
		while ($row = mysql_fetch_array($res)) {
			return $row['sd_evs_id'];
		}
		return '';		
	}
?>
