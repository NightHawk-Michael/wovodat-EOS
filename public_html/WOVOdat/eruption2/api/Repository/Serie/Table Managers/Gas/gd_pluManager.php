<?php
/**
 *	This class supports query the data from data table gd_plu 
 * 	
 */
// DEFINE('HOST', 'localhost');
// require_once '..//TableManager.php';
class gd_pluManager extends GasTablesManager {
	
	protected function setColumnsName(){
		$result = array("gd_plu_height","gd_plu_mass","gd_plu_etot","gd_plu_emit");
		return $result;
	}
	protected function setTableName(){
		return "es_gd_plu";
	}

	protected function setDataType(){
		return "Gas Plume";
	} // Data type for each data table
	//if there is 1 station, station1 is the same as station2
	protected function setStationID(){
		$result = array("gs_id","cs_id");
		return $result;
	} // column names represent stationID1,station ID2
	protected function setStationCode(){
		$result = array("gs_code","cs_code");
		return $result;
	} // column name represent primary stationCode1, stationCode2.
	protected function setStationDataParams($component){
//		var_dump($component);
		$unit="";
		$attribute = "";
		$query = "";
		$table = "gd_plu";
		$errorbar = false;
		$style = "dot";
		if($component == 'Plume Height'){
			$unit = "km";
			$attribute = "gd_plu_height";
			$errorbar = false;
			$query = "select a.gd_plu_time as time, a.$attribute as value from $table as a where (a.gs_id=%s or a.cs_id=%s) and vd_id = %s and a.$attribute IS NOT NULL and a.gd_plu_pubdate <= now()";
	
		}else if($component == 'Gas Emission Rate'){

			$attribute = "gd_plu_emit"; 	
			$errorbar = true;
			$style = 'dot';
			$query = "select a.gd_plu_units as unit, a.gd_plu_species as filter, a.gd_plu_emit_err as err, a.gd_plu_time as time, a.$attribute as value from $table as a where (a.gs_id=%s or a.cs_id=%s) and vd_id = %s and a.$attribute IS NOT NULL and a.gd_plu_pubdate <= now()";
			
		//	echo $query;
			
		}else if($component == 'Gas Emission Mass'){
			$unit ="tons";
			$attribute = "gd_plu_mass";
			$errorbar = false;
			$style = 'dot';
			$query = "select a.gd_plu_units as unit, a.gd_plu_species as filter, a.gd_plu_time as time, a.$attribute as value from $table as a where (a.gs_id=%s or a.cs_id=%s) and vd_id = %s and a.$attribute IS NOT NULL and a.gd_plu_pubdate  <= now()";
		//	var_dump($query);


		}else if($component == 'Total Gas Emission'){

			$attribute = "gd_plu_etot";
			$errorbar = true;
			$style = 'dot';
			$query = "select a.gd_plu_units as unit, a.gd_plu_species as filter, a.gd_plu_etot_err as err, a.gd_plu_time as time, a.$attribute as value from $table as a where (a.gs_id=%s or a.cs_id=%s) and vd_id = %s and a.$attribute IS NOT NULL and a.gd_plu_pubdate<= now()";
			
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
        return "Plume";
    }
}