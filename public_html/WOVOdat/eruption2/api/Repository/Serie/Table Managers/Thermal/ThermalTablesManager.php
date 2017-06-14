<?php
/**
 *	T
 * 	
 */
// DEFINE('HOST', 'localhost');
// require_once '..//TableManager.php';
abstract class ThermalTablesManager extends TableManager {
	protected function setStationTable(){
		return "ts";
	}
	
	protected function setMonitoryType(){
		return "Thermal";
	} // monitory type Deformation, Gas, ....

	protected function setLatLong(){
		return array("ts_lat", "ts_lon");
	}
} 