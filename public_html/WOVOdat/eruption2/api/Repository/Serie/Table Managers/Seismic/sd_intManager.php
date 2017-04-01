<?php
/**
 *	This class supports query the data from data table dd_tlt 
 * 	
 */
// DEFINE('HOST', 'localhost');
// require_once '..//TableManager.php';
class sd_intManager extends SeismicTablesManager {
	
	protected function setColumnsName(){
		$result = array("sd_int_maxdist","sd_int_maxrint","sd_int_maxrint_dist");
		return $result;
	}
	protected function setTableName(){  
		return "es_sd_int";
	}
	protected function getStationCodeQuery($sta_id){
        $sta_id_code_query ="";
		if($sta_id == "sn_id"){
			$sta_id_code_query = "SELECT c.sn_id as sta_id, c.sn_code as sta_code FROM sd_int as a, sd_evn as b,sn as c where a.sd_evn_id = b.sd_evn_id and b.sn_id=c.sn_id";
		}
		if($sta_id == "ss_id"){
			$sta_id_code_query = "SELECT c.ss_id as sta_id, c.ss_code as sta_code FROM sd_int as a, sd_evs as b,ss as c where a.sd_evs_id = b.sd_evs_id and b.ss_id=c.ss_id";
		}
		// echo($sta_id_code_query."\n");
		return $sta_id_code_query;
		
	}

	protected function setDataType(){
		return "SeismicIntensity";
	} // Data type for each data table
	//if there is 1 station, station1 is the same as station2
	protected function setStationID(){
		$result = array("sn_id","ss_id");
		return $result;
	} // column names represent stationID1,station ID2
	protected function setStationCode(){
		$result = array("sta_code","sta_code");
		return $result;
	} // column name represent primary stationCode1, stationCode2.
	protected function setStationDataParams($component){
		$unit="";
		$query = "";
		$table = "sd_int";
		$errorbar = false;  
		$style = "dot"; 
		if($component == 'Maximum Distance Felt'){
			$unit = "km";
			$attribute = "sd_int_maxdist";
			$query = "select a.sd_int_time as time, a.$attribute as value  from $table  as a where a.ss_id=%s and a.$attribute IS NOT NULL and a.sd_int_pubdate<= now()";
		}else if($component == 'Maximum Intensity'){
			$unit = "";
			$attribute = "sd_int_maxrint";
			$query = "select a.sd_int_time as time, a.$attribute as value  from $table  as a where a.ss_id=%s and a.$attribute IS NOT NULL and a.sd_int_pubdate<= now()";
		}else if($component == 'Distance At Maximum Intenstiy'){
			$unit = "km";
			$attribute = "sd_int_maxrint_dist";
			$query = "select a.sd_int_time as time, a.$attribute as value  from $table  as a where a.ss_id=%s and a.$attribute IS NOT NULL and a.sd_int_pubdate<= now()";
		}
		$result = array("unit" => $unit,
						"style" => $style,
						"errorbar" => $errorbar,
						"query" =>$query
						);
		return $result;
	} // params to get data station [unit,flot_style,errorbar,query]

    protected function setShortDataType()
    {
        // TODO: Implement setShortDataType() method.
        return "Intensity";
    }
}