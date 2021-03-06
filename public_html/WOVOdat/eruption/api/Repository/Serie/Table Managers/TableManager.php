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
	protected $vd_long;
	protected $vd_lat;
	protected $data_code;
	protected $vd_id;
	public function TableManager(){
		$this->cols_name = $this->setColumnsName();
		$this->table_name = $this->setTableName();
		$this->monitoryType = $this->setMonitoryType();
		$this->dataType = $this->setDataType();
		$this->stationId = $this->setStationID();
		$this->sta_id_code_dictionary = $this->getStationIdCodeDictionary();
		$this->shortDataType = $this->setShortDataType();
		$this->stationTable = $this->setStationTable();

		$this->data_code =  $this->setDataCode();
	}

	public function getTableName(){
		return $this->table_name;
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
    abstract protected function setShortDataType();
	abstract protected function setLatLong();	//Set param Lat Long fo get Table Query

	//if there is 1 station, station1 is the same as station2
	abstract protected function setStationID(); // column names represent stationID1,station ID2
	protected function setDataCode(){
		$code =  substr($this->table_name,3,strlen($this->table_name)-3) ."_code";
//		var_dump($code);
		return $code;

	}
	abstract protected function setStationCode(); // column name represent primary stationCode1, stationCode2. (Deprecated)
	abstract protected function setStationDataParams($component); // params to get data station [unit,flot_style,errorbar,attributes,query]
	private function getTableNameFromIdName($id){
		$temp = explode("_", $id);
		return $temp[0];
	}
/*	
	protected function getTimeSeriesListQuery($vd_id){

		$query_format = 'select b.vd_inf_slat as vd_lat, b.vd_inf_slon as vd_long, a.%s as sta_id1,  a.%s as sta_id2, vd.vd_name ';
		$query = sprintf($query_format,$this->stationId[0],$this->stationId[1]);
		foreach ($this->cols_name as $name) {
			$query = $query.",a.".$name;
		}
		$query = $query." from $this->table_name as a,vd ,vd_inf as b where a.vd_id=$vd_id AND vd.vd_id = $vd_id and b.vd_id = $vd_id group by a.vd_id, sta_id1, sta_id2 order by a.vd_id";
		return $query;
	}
*/	
	protected function getTimeSeriesListQuery($vd_id){

		$query_format = 'select b.vd_inf_slat as vd_lat, b.vd_inf_slon as vd_long, a.%s as sta_id1,  a.%s as sta_id2, d.vd_name ';
		$query = sprintf($query_format,$this->stationId[0],$this->stationId[1]);
		foreach ($this->cols_name as $name) {
			$query = $query.",a.".$name;
		}
//		$query = $query." from $this->table_name as a,vd ,vd_inf as b where a.vd_id=$vd_id AND vd.vd_id = $vd_id and b.vd_id = $vd_id group by a.vd_id, sta_id1, sta_id2 order by a.vd_id";
		$stationTable = $this->stationTable;
		if (is_array($stationTable)) $stationTable  = $stationTable[0];

		$stationID = $this->stationId[0];
		if($this->table_name == "es_dd_lev") $stationID = "ds_id_ref";
		$lat = $this->setLatLong()[0];
		$long =  $this->setLatLong()[1];
		$prefixQuery = $query." from " . $this->table_name . " a, vd_inf b, " . $stationTable ." c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id " ;
		$prefixQuery2 = $prefixQuery . " and a." . $stationID . "=c." . $stationTable . "_id and a.vd_id = d.vd_id and 6371*acos(sin(RADIANS(". $lat ."))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(". $lat ."))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(". $long ."))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";


//		if($this->table_name == "es_gd_plu") {
//			$query = $prefixQuery2. " union ".$query." from es_gd_plu a, vd_inf b, cs c ,vd d where a.vd_id=b.vd_id and a.cs_id=c.cs_id and a.vd_id=d.vd_id group by d.vd_id, sta_id1, sta_id2";
//		}
//		else if($this->table_name == "es_sd_evn") {
//			$query = $prefixQuery . " a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(" . $lat . "))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(" . $lat . ")) *cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(" . $long . "))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
//		}
//		else if($this->table_name == "es_sd_int" || $this->table_name == "es_sd_ivl" || $this->table_name == "es_sd_trm") {
//			$query = $prefixQuery. " (a.ss_id=c.ss_id || a.sn_id = c.sn_id) and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(". $lat. "))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(" . $lat ."))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(". $long."))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
//		}
//		else{
//			$query = $prefixQuery2;
//		}
		if($this->table_name == "es_dd_edm") {
			$query = $query." from es_dd_edm a, vd_inf b, ds c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.ds_id1=c.ds_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(ds_nlat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(ds_nlat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(ds_nlon))) < 30  group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_dd_gps") {

			$query = $query." from es_dd_gps a, vd_inf b, ds c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.ds_id=c.ds_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(ds_nlat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(ds_nlat)) *cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(ds_nlon))) < 30  group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_dd_gpv") {

			$query = $query." from es_dd_gpv a, vd_inf b, ds c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.ds_id=c.ds_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(ds_nlat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(ds_nlat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(ds_nlon))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_dd_lev") {

			$query = $query." from es_dd_lev a, vd_inf b, ds c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.ds_id_ref=c.ds_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(ds_nlat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(ds_nlat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(ds_nlon))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_dd_str") {
			$query = $query." from es_dd_str a, vd_inf b, ds c,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.ds_id=c.ds_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(ds_nlat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(ds_nlat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(ds_nlon))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_dd_tlt") {
			$query = $query." from es_dd_tlt a, vd_inf b, ds c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.ds_id=c.ds_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(ds_nlat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(ds_nlat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(ds_nlon))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_dd_tlv") {
			$query = $query." from es_dd_tlv a, vd_inf b, ds c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.ds_id=c.ds_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(ds_nlat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(ds_nlat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(ds_nlon))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_fd_ele") {
			$query = $query." from es_fd_ele a, vd_inf b, fs c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.fs_id1=c.fs_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(fs_lat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(fs_lat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(fs_lon))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_fd_gra") {
			$query = $query." from es_fd_gra a, vd_inf b, fs c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.fs_id=c.fs_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(fs_lat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(fs_lat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(fs_lon))) < 30  group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_fd_mag") {
			$query = $query." from es_fd_mag a, vd_inf b, fs c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.fs_id=c.fs_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(fs_lat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(fs_lat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(fs_lon))) < 30  group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_fd_mgv") {
			$query = $query." from es_fd_mgv a, vd_inf b, fs c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.fs_id=c.fs_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(fs_lat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(fs_lat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(fs_lon))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_gd") {
			$query = $query." from es_gd a, vd_inf b, gs c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.gs_id=c.gs_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(gs_lat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(gs_lat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(gs_lon))) < 30  group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_gd_plu") {
			$query = $query." from es_gd_plu a, vd_inf b, gs c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.gs_id=c.gs_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(gs_lat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(gs_lat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(gs_lon))) < 30  group by d.vd_id, sta_id1, sta_id2 union ".$query."
			from es_gd_plu a, vd_inf b, cs c ,vd d where a.vd_id=b.vd_id and a.cs_id=c.cs_id and a.vd_id=d.vd_id group by d.vd_id, sta_id1, sta_id2";
		}
		else if($this->table_name == "es_gd_sol") {
			$query = $query." from es_gd_sol a, vd_inf b, gs c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.gs_id=c.gs_id and  a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(gs_lat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(gs_lat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(gs_lon))) < 30  group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_hd") {
			$query = $query." from es_hd a, vd_inf b, hs c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.hs_id=c.hs_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(hs_lat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(hs_lat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(hs_lon))) < 30  group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_med") {
			$query = $query." from es_med a, vd_inf b, ms c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.ms_id=c.ms_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(ms_lat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(ms_lat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(ms_lon))) < 30  group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_td") {
			$query = $query." from es_td a, vd_inf b, ts c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.ts_id=c.ts_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(ts_lat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(ts_lat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(ts_lon))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_sd_evn") {
			$query = $query." from es_sd_evn a, vd_inf b ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.vd_id=d.vd_id and
			6371*acos(sin(RADIANS(sd_evn_elat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(sd_evn_elat)) *cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(sd_evn_elon))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_sd_evs") {
			$query = $query." from es_sd_evs a, vd_inf b, ss c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.ss_id=c.ss_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(ss_lat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(ss_lat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(ss_lon))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_sd_int") {
			$query = $query." from es_sd_int a, vd_inf b, ss c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and (a.ss_id=c.ss_id || a.sn_id = c.sn_id) and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(ss_lat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(ss_lat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(ss_lon))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_sd_ivl") {
			$query = $query." from es_sd_ivl a, vd_inf b, ss c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and (a.ss_id=c.ss_id || a.sn_id = c.sn_id) and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(ss_lat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(ss_lat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(ss_lon))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_sd_rsm") {
			$query = $query." from es_sd_rsm a, vd_inf b, ss c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and a.ss_id=c.ss_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(ss_lat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(ss_lat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(ss_lon))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_sd_ssm") {
			$query = $query." from es_sd_ssm a, vd_inf b, ss c ,vd d where a.vd_id=b.vd_id and a.ss_id=c.ss_id and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(ss_lat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(ss_lat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(ss_lon))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}
		else if($this->table_name == "es_sd_trm") {
			$query = $query." from es_sd_trm a, vd_inf b, ss c ,vd d where a.vd_id=$vd_id and a.vd_id=b.vd_id and (a.ss_id=c.ss_id || a.sn_id = c.sn_id) and a.vd_id=d.vd_id and 6371*acos(sin(RADIANS(ss_lat))*sin(RADIANS(vd_inf_slat))+cos(RADIANS(ss_lat))*cos(RADIANS(vd_inf_slat))*cos(RADIANS(vd_inf_slon)-RADIANS(ss_lon))) < 30 group by d.vd_id, sta_id1, sta_id2 order by d.vd_id";
		}

		return $query;
	}
	
	
	public function getTimeSeriesList($vd_id){

		$result = array();
		global $db;
		$query = $this->getTimeSeriesListQuery($vd_id);
		$db->query( $query);
		$serie_list = $db->getList();
		$exsited = array();
		$v = "";

		foreach ($serie_list as $serie) {
//			var_dump($serie);
			foreach ($this->cols_name as $col_name) {

				if(!array_key_exists($serie["sta_id1"], $this->sta_id_code_dictionary[0])){
					$this->sta_id_code_dictionary[0][$serie["sta_id1"]] = "0";
					$serie["sta_id1"] = "0";
				}
				if(!array_key_exists($serie["sta_id2"], $this->sta_id_code_dictionary[1])){
					$this->sta_id_code_dictionary[1][$serie["sta_id2"]] = "0";
					$serie["sta_id2"] = "0";
				}

				if (array_key_exists("vd_name",$serie)){
					$v = $serie["vd_name"];
				}else{

				}
				if($serie[$col_name]!=""){

					$x = array('category' => $this->monitoryType ,
							   'data_type' => $this->dataType,
                                'short_data_type' => $this->shortDataType,
							   'station_id1' => $serie["sta_id1"],
							   'station_code1' => $this->sta_id_code_dictionary[0][$serie["sta_id1"]],
							   'station_id2' => $serie["sta_id2"],
							   'station_code2' => $this->sta_id_code_dictionary[1][$serie["sta_id2"]],
						       'component' => $serie[$col_name],
						'vd_lat' => $serie["vd_lat"],
						'vd_long' => $serie["vd_long"],
								'volcanoName'  => $v,
//								'data_owner' => $cc_url,
						   		);

					$x["sr_id"] = md5( $x["category"].$x["data_type"].$x["station_id1"].$x["station_id2"].$x["component"].$x["volcanoName"] );
					if(!array_key_exists($x["sr_id"], $exsited)){
						$exsited[$x["sr_id"]] = true;
//						if($this->isHasData($x,$vd_id)) array_push($result,  $x );
						array_push($result,  $x );
					}else{

					}
				}
			}
		}
		return $result;

 	}

	public function isHasData($stations,$vd_id){
		$this->vd_long = $stations["vd_long"];
		$this->vd_lat = $stations["vd_lat"];
		$id1 = $stations["station_id1"];
		$id2 = $stations["station_id2"];
		global $db;

		$stationDataParams = $this->setStationDataParams($stations['component']);

		$query = $stationDataParams["query"];
		$fromPos = strripos($query,"from");
		$groupByPos = stripos($query, "group by");
		if ($groupByPos == FALSE) $groupByPos = strlen($query);
		$query2 = "SELECT COUNT(*) as count " . substr($query,$fromPos,$groupByPos-$fromPos);
		$db->query($query2, $id1,$id2,$vd_id);
		$res = $db->getList();
//		var_dump("IS HAS DATA ----------------------");
//		var_dump($db);
//		var_dump("END IS HAS DATA ----------------------");

		if(sizeof($res) == 0) {
			return true;
		}
		if ($res[0]["count"] == "0") return false;
		else return true;
	}
  	public function getStationData($stations,$vd_id){
		$this->vd_long = $stations["vd_long"];
		$this->vd_lat = $stations["vd_lat"];
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
		//$temp =  "select a." . $this->data_code ." as data_code, cc_id, cc_id2, cc_id3, cb_ids,";

		if($this->table_name == 'es_sd_rsm' || $this->table_name == 'es_sd_ssm') {
			$temp =  "select b.sd_sam_code as data_code, cc_id, cc_id2, cc_id3, cb_ids,";
		}else{	
			$temp =  "select a." . $this->data_code ." as data_code, cc_id, cc_id2, cc_id3, cb_ids,";
		}
		
		 $query = str_replace("select",$temp ,$query);

		$db->query($query, $id1,$id2,$vd_id);
		$res = $db->getList();
		if (empty($res)){
			$query1 = "SELECT `sn_id` FROM " . $this->table_name . " WHERE `ss_id`=" . $id1;
			$db->query($query1);
			$sn_id = $db->getValue();
			$query = str_replace("a.ss_id","sn_id" ,$query);

			$db->query($query, $sn_id,$sn_id,$vd_id);

			$res = $db->getList();
		}



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
			$cc_ids = array();
			$cc_ids[0] = $row["cc_id"];
			$cc_ids[1] = $row["cc_id2"];
			$cc_ids[2]= $row["cc_id3"];
			$cb_ids  = $row["cb_ids"];
			//echo $cc_ids[2];

			$dataOwner = $this->getCCUrl($cc_ids);
			$temp["data_owner"] = $dataOwner;

			$reference =  $this->getDataReference($cb_ids);
			$temp["reference"] = $reference;
			array_push($data, $temp );			
		}
		$result["style"] = $stationDataParams["style"];
		$result["errorbar"] = $errorbar;
		$result["data"] = $data;
		$result["unit"] = $unit;
		return $result;
  	}
	/*
     * Get cc_url/cc_email of a volcano
     * of a specific cavw
     */

	private function getCCUrl($cc_ids) {
		$dataOwners = array();
		global $db;
		foreach ($cc_ids as $cc_id) {

			if ($cc_id != null) {
				$sql = "select cc_code,cc_url, cc_email from cc where cc_id=" . $cc_id;
				$db->query($sql);
				$result = $db->getList();
				
				//var_dump($sql);
				
				if (sizeof($result) == 0) continue;
				$result = $result[0]; 
				
				$result["cc_code"]  = "Data Owner: ".$result["cc_code"];
				
				if ($result["cc_url"] != null) {  
					array_push($dataOwners, $result["cc_code"]);
					array_push($dataOwners, $result["cc_url"]);
				} else if ($result["cc_url"] != null) {
					array_push($dataOwners, $result["cc_code"]);
					array_push($dataOwners, $result["cc_email"]);
				} 
			}
		}
		return array_unique($dataOwners);
	}

	/**
	 * Luis Ngo : 6/9/2016
	 *
	 * Get reference of data (cb)
	 */
	private function getDataReference($cb_ids) {
		global $db;
		$reference = array();
		if ($cb_ids != null) {
			$temp = join(" OR cb_id=",explode(",",$cb_ids));

			$sql = "select cb_auth,cb_year,cb_url from cb where cb_id=" . $temp;
			$db->query($sql);
			$result = $db->getList();
			if(sizeof($result) == 0){
				array_push($reference,"");
				array_push($reference, "");
			}else{
				$result = $result[0];
				
				$firstAuth  = stristr($result["cb_auth"], ',', true);
				
				if($firstAuth == ""){
					$result['cb_auth'] =  " - Author: ".$result['cb_auth']." et al. (".$result['cb_year'].")";
				}else{
					$result['cb_auth'] =  "- Author: ".$firstAuth." et al. (".$result['cb_year'].")";
				}	
				
				array_push($reference, $result['cb_auth']);
				array_push($reference, $result["cb_url"]);
			}

		}else{
			array_push($reference,"");
			array_push($reference, "");
		}
		return $reference;
	}
} 