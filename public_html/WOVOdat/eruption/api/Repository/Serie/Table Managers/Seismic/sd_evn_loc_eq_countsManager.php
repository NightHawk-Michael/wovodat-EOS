<?php
/**
 *	This class supports query the data from data table sd_evn
 * 	
 */
// DEFINE('HOST', 'localhost');
// require_once '..//TableManager.php';
class sd_evn_loc_eq_countsManager extends sd_evnManager {
	
	protected function setColumnsName(){
		$result = array("loc_eq_counts");
		return $result;
	}
	
	protected function setDataType(){
		return "SeismicEventFromNetwork";
	} // Data type for each data table
	//if there is 1 station, station1 is the same as station2
	protected function setStationID(){
		$result = array("cc_id","cc_id");
		return $result;
	} // column names represent stationID1,station ID2
	protected function setStationCode(){
		$result = array("cc_code","cc_code");
		return $result;
	} // column name represent primary stationCode1, stationCode2.
	protected function getTimeSeriesListQuery($vd_id){
		$query = "select \"Located Earthquake Counts\" as loc_eq_counts, b.vd_inf_slat as vd_lat, b.vd_inf_slon as vd_long, a.cc_id as sta_id1,  a.cc_id as sta_id2 from sd_evn as a, vd_inf as b, es_sd_evn as c where 6371*acos(sin(RADIANS(a.sd_evn_elat))*sin(RADIANS(b.vd_inf_slat))+cos(RADIANS(a.sd_evn_elat)) *cos(RADIANS(b.vd_inf_slat))*cos(RADIANS(b.vd_inf_slon)-RADIANS(a.sd_evn_elon))) <= 30 and b.vd_id = $vd_id and a.sn_id=c.sn_id AND a.sd_evn_pubdate <= now() and a.sd_evn_edep BETWEEN -10 AND 40 and b.vd_id=c.vd_id group by b.vd_id, sta_id1, sta_id2 order by b.vd_id";
		return $query;
	}
	protected function setStationDataParams($component){
		$unit="counts";
		$attribute = "";
		$query = "";
		$table = "sd_evn";
		$errorbar = false;
		$style = "bar";
		$vd_long = $this->vd_long;
		$vd_lat = $this->vd_lat;
		// var_dump($this);
		if($component == 'Located Earthquake Counts'){
			$query = "select count(sd_evn_edep) as value, sd_evn_eqtype as filter, concat(DATE(sd_evn_time),\" 00:00:00\") as stime, concat(DATE(sd_evn_time), \" 23:59:59\") as etime, sd_evn_eqtype, cc_id, sd_evn_derr FROM sd_evn as a WHERE a.cc_id =%s and sd_evn_pubdate <= now() and sd_evn_edep BETWEEN -10 AND 40 GROUP BY DATE(sd_evn_time), filter";
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
        return "";
    }
} 