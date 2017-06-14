<?php
/**
 *	T
 * 	
 */
// DEFINE('HOST', 'localhost');
// require_once '..//TableManager.php';
abstract class HydrologyTablesManager extends TableManager {
	protected function setStationTable(){
		return "hs";
	}
	
	protected function setMonitoryType(){
		return "Hydrology";
	} // monitory type Deformation, Gas, ....

	protected function setLatLong(){
		return array("hs_lat", "hs_lon");
	}
} 