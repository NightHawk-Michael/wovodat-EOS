<?php
/**
 *	This class supports query the data from data table dd_tlt 
 * 	
 */
// DEFINE('HOST', 'localhost');
// require_once '..//TableManager.php';
class sd_ssmManager extends TableManager {
	
	protected function setColumnsName(){
		$result = array("sd_ssm_lowf","sd_ssm_highf","sd_ssm_count");
		return $result;
	}
	protected function setTableName(){
		return "es_sd_ssm";
	}
	protected function setMonitoryType(){
		return "Seismic";
	} // monitory type Deformation, Gas, ....
	protected function setDataType(){
		return "SSAM";
	} // Data type for each data table
	//if there is 1 station, station1 is the same as station2
	protected function setStationID(){
		$result = array("ss_id","ss_id");
		return $result;
	} // column names represent stationID1,station ID2
	protected function setStationCode(){
		$result = array("sta_code","sta_code");
		return $result;
	} // column name represent primary stationCode1, stationCode2.
	protected function setStationDataParams($component){
		$unit="";
		$attribute = "";
		$query = "";
		$table = "sd_ssm";
		$errorbar = false;
		$style = "bar";
		if($component == 'SSAM Low-freq Limit'){
			$unit = "Hz";
			$attribute = "sd_ssm_lowf";
			$query = "select a.sd_ssm_stime as stime,a.sd_ssm_etime as etime, a.$attribute as value  from $table  as a where a.ss_id=%s and a.$attribute IS NOT NULL";
		}else if($component == 'SSAM Hight-freq Limit'){
			$unit = "Hz";
			$attribute = "sd_ssm_highf";
			$query = "select a.sd_ssm_stime as stime,a.sd_ssm_etime as etime, a.$attribute as value  from $table  as a where a.ss_id=%s and a.$attribute IS NOT NULL";
		}else if($component == 'SSAM Counts'){
			$unit = "counts";
			$attribute = "sd_ssm_count";
			$query = "select a.sd_ssm_stime as stime,a.sd_ssm_etime as etime, a.$attribute as value  from $table  as a where a.ss_id=%s and a.$attribute IS NOT NULL";
		}	
		$result = array("unit" => $unit,
						"style" => $style,
						"errorbar" => $errorbar,
						"query" =>$query
						);
		return $result;
	} // params to get data station [unit,flot_style,errorbar,query]
} 