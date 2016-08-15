	<?php
/**
 *	This class supports query the data from data table 
 * 	
 */
// DEFINE('HOST', 'localhost');
require_once('TableManagerInterface.php');
abstract class TableManager implements TableManagerInterface {
	protected $cols_name;
	protected $table_name;
	protected $monitoryType;
	protected $dataType;
	protected $stationId;
	protected $stationCode;
	protected $sta_table;
	protected $sta_id_code_dictionary;
	protected $data_code;
	public function TableManager(){
		$this->cols_name = $this->setColumnsName();
		$this->table_name = $this->setTableName();
		$this->monitoryType = $this->setMonitoryType();
		$this->dataType = $this->setDataType();
		$this->stationId = $this->setStationID();
		$this->sta_id_code_dictionary = $this->getStationIdCodeDictionary();
		$this->data_code =  $this->setDataCode();
	}
	//must return 1 sta_code column
	protected function getStationCodeQuery($sta_id){
		$table_name = $this->getTableNameFromIdName($sta_id);
		$sta_id_code_query = "SELECT DISTINCT ".$table_name."_id as sta_id, " . $table_name ."_code as sta_code FROM $table_name order by sta_id";
		return $sta_id_code_query;
	}
	protected function getStationIdCodeDictionary(){
		global $db;
		$sta_id_codes = array();
		foreach($this->stationId as $sta_id){

			$sta_id_code = array();
			$sta_id_code_query = $this->getStationCodeQuery($sta_id);
			// echo $sta_id_code_query."\n";
			$db->query($sta_id_code_query);
			$temp = $db->getList();
			$sta_id_code[0] = "";
			// print_r($temp);
			foreach($temp as $tmp){
				$sta_id_code[$tmp["sta_id"]]  = $tmp['sta_code'];
			}

			array_push($sta_id_codes,$sta_id_code);
		}


		return $sta_id_codes;
	}
	abstract protected function setStationTable(); // get the name of the station table which stores sta_id and sta_code
	abstract protected function setColumnsName(); // names of data columns
	abstract protected function setTableName(); // name of es table
	abstract protected function setMonitoryType(); // monitory type Deformation, Gas, ....
	abstract protected function setDataType(); // Data type for each data table
	//if there is 1 station, station1 is the same as station2
	abstract protected function setStationID(); // column names represent stationID1,station ID2
	protected function setDataCode(){
		$code =  substr($this->table_name,3,strlen($this->table_name)-3) ."_code";
		return $code;

	}
	abstract protected function setStationCode(); // column name represent primary stationCode1, stationCode2. (Deprecated)
	abstract protected function setStationDataParams($component); // params to get data station [unit,flot_style,errorbar,attributes,query]
	private function getTableNameFromIdName($id){
		$temp = explode("_", $id);
		return $temp[0];
	}

	public function getTimeSeriesList($vd_id){

  		$result = array();
		global $db;
		$query_format = 'select a.%s as sta_id1,  a.%s as sta_id2, vd.vd_name ';
		$query = sprintf($query_format,$this->stationId[0],$this->stationId[1]);
		foreach ($this->cols_name as $name) {
			$query = $query.",a.".$name;
		}
		$query = $query." from $this->table_name as a, vd where a.vd_id=$vd_id AND vd.vd_id = $vd_id group by a.vd_id, sta_id1, sta_id2 order by a.vd_id";

		$db->query( $query);

		$serie_list = $db->getList();
		$exsited = array();
		$cc_url =  $this->getCCUrl($vd_id);
		// var_dump($serie_list);
		foreach ($serie_list as $serie) {

			foreach ($this->cols_name as $col_name) {
				// print_r($this->table_name);
				// print_r($this->stationId);
				// print_r($this->sta_id_code_dictionary);
				// echo ($this->getStationCodeQuery($this->stationId[0])."\n");
				if(!array_key_exists($serie["sta_id1"], $this->sta_id_code_dictionary[0])){
					continue;
				}
				if(!array_key_exists($serie["sta_id2"], $this->sta_id_code_dictionary[1])){
					continue;
				}
				if($serie[$col_name]!=""){

					$x = array('category' => $this->monitoryType ,
							   'data_type' => $this->dataType,
							   'station_id1' => $serie["sta_id1"],
							   'station_code1' => $this->sta_id_code_dictionary[0][$serie["sta_id1"]],
							   'station_id2' => $serie["sta_id2"],
							   'station_code2' => $this->sta_id_code_dictionary[1][$serie["sta_id2"]],
						       'component' => $serie[$col_name],
								'volcanoName'  => $serie["vd_name"],
								'data_owner' => $cc_url,
						   		);

					$x["sr_id"] = md5( $x["category"].$x["data_type"].$x["station_id1"].$x["station_id2"].$x["component"].$x["volcanoName"] );
					if(!array_key_exists($x["sr_id"], $exsited)){
						$exsited[$x["sr_id"]] = true;
						array_push($result,  $x );
					}else{

					}


				}
			}
		}
		return $result;

 	}

  	public function getStationData($stations){
  		
  		$id1 = $stations["station_id1"];
  		$id2 = $stations["station_id2"];
		global $db;
		$result = array();
		$res = array();
		$data = array();
		$unit = "";
		$stationDataParams = $this->setStationDataParams($stations['component']);
		$errorbar = $stationDataParams["errorbar"];
		$query = $stationDataParams["query"];
		//Add select data code from query. Add in this tableManager to apply all data.
		$temp =  "select a." . $this->data_code ." as data_code,";
		 $query = str_replace("select",$temp ,$query);

		$db->query($query, $id1,$id2);

		$res = $db->getList();

		foreach ($res as $row) {
			//add value attributes

			$temp = array("value" => floatval($row["value"]));
			//add time value attributes (time or (etime, stime))
			if(array_key_exists("time", $row)){
				$time = strtotime($row["time"]);
				$temp["time"] = floatval(1000*$time);
			}else{
				$stime = strtotime($row["stime"]);
				$etime = 0;
				if(array_key_exists("etime", $row)){
					$etime = strtotime($row["etime"]);
				}else{
					// if data have no etime, assume that the bars are continuous
					$data_size = sizeof($data);
					if($data_size!=0){
						$data[$data_size-1]["etime"] = $stime*1000;
					}
				}
				
				$temp["stime"] = floatval(1000*$stime);
				$temp["etime"] = floatval(1000*$etime);
			}
			//add filter attribute
			// var_dump($row);

			if(array_key_exists("filter", $row)){
				
				$temp["filter"] = $row["filter"];
				if($temp["filter"] === null){
					// echo("a\n");
					$temp["filter"] = " ";
				}
				if($temp["filter"] == ""){
					$temp["filter"] = "Others";
				}
			}else{
				$temp["filter"] = " ";
			}
			// find attribute
			if(array_key_exists("unit", $row)){
				
				$unit = $row["unit"];
				
			}else{
				$unit = $stationDataParams["unit"];
			}
			// add error bar
			if($errorbar){
				if($row["err"]!=null){
					$temp["error"] = floatval($row["err"]);
				}else{
					$temp["error"] = 0;
				}
			}
			$temp["data_code"] = $row["data_code"];
			array_push($data, $temp );			
		}
		$result["style"] = $stationDataParams["style"];
		$result["errorbar"] = $errorbar;
		$result["data"] = $data;
		$result["unit"] = $unit;
		// var_dump($result);
		return $result;
  	}
	/*
     * Get cc_url of a volcano
     * of a specific cavw
     */

	private function getCCUrl($vd_id) {
		$query1 = mysql_query("select cc_id from vd where vd_id='" . $vd_id . "'");
		$object = "";
		$result1 = mysql_fetch_array($query1);
		if ($result1 !== false) {
			$cc_id = $result1[0];
			$object['cc_id1'] = $cc_id;
			$query1_2 = mysql_query("select cc_url from cc where cc_id='" . $cc_id . "'");
			$result1_2 = mysql_fetch_array($query1_2);
			// retrieve the cc_code based on cc_id - vutuan added
			$query1_3 = mysql_query("select cc_code from cc where cc_id='". $cc_id . "'");
			$result1_3 = mysql_fetch_array($query1_3);

			if ($result1_2 !== false)
				$object['owner1'] = $result1_2[0];
			else
				$object['owner1'] = "";
			if($result1_3 !== false)
				$object['cc_code1'] = $result1_3[0];
			else
				$object['cc_code1'] = "";
		}

		// second cc_id
		$query1 = mysql_query("select cc_id2 from vd where vd_id='" . $vd_id . "'");
		$result1 = mysql_fetch_array($query1);
		if ($result1 !== false) {
			$cc_id = $result1[0];
			$object['cc_id2'] = $cc_id;
			$query1_2 = mysql_query("select cc_url from cc where cc_id='" . $cc_id . "'");
			$result1_2 = mysql_fetch_array($query1_2);
			// retrieve the cc_code based on cc_id - vutuan added
			$query1_3 = mysql_query("select cc_code from cc where cc_id='". $cc_id . "'");
			$result1_3 = mysql_fetch_array($query1_3);
			if ($result1_2 !== false)
				$object['owner2'] = $result1_2[0];
			else
				$object['owner2'] = "";
			if($result1_3 !== false)
				$object['cc_code2'] = $result1_3[0];
			else
				$object['cc_code2'] = "";
		}

		$query2 = mysql_query("select vd_inf_status, vd_inf_type from vd_inf where vd_id ='" . $vd_id . "'");
		$result2 = mysql_fetch_array($query2);
		if ($result2 !== false) {
			$object['status'] = $result2[0] . " - " . $result2[1];
		}
		return $object;
	}
} 