<?php 
require_once('MonitoryTypeManagerInterface.php');
abstract class MonitoryTypeManager implements MonitoryTypeManagerInterface {
	protected $infor;
	protected $tableManagers;
	protected $timeSeriesListQuery = "";
	protected $type;
	public function MonitoryTypeManager(){

		$this->tableManagers = $this->setTableManagers();
		$this->type = $this->setMonitoryType();
		$this->infor = json_decode( file_get_contents($this->type."/".$this->type.".json", true) , true);

	}
	abstract protected function setMonitoryType();
	abstract protected function setTableManagers();
	public function getTimeSeriesList($vd_id){
		$result = array();
//		var_dump($this->tableManagers);
		foreach ($this->tableManagers as $col => $tableManager) {

			$result = array_merge($result,$tableManager->getTimeSeriesList($vd_id));
		}
		// var_dump($result);
		return $result;
	}
	public function getStationData($serie,$vd_id ){
		$result = array();
//		 var_dump($this->infor);

		$table = "";
		foreach ($this->infor as $key => $type) {
//			var_dump($type["data_type"]);
			if ( $type["data_type"] == $serie["data_type"] ){

				foreach ($type["params"] as $params) {
					if($params["name"] == $serie["component"]){
						$table =$key;
						break;
					}
				}
				if($table != ""){
					break;
				}
			}
		}
			
		foreach ($this->tableManagers as $tableName=> $tableManager) {

			if($table == $tableName){
				$result = array_merge($result,$tableManager->getStationData($serie,$vd_id));
			}
			
		}

		return $result;
	}
	
}


