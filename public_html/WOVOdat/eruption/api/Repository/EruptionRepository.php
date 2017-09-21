<?php
	/**
	*	This class supports query the information from ed and ed_phs table
	* 	
	*/
	class EruptionRepository {

		/**
		*	Given an eruption id, return its information
		*	@param:
		*		$ed_id
		*	@return
		*		information of this eruption
		*/
		public static function getEruptionList($vd_id) {
			$result = array();
			global $db;
			$query = "select ed_id, ed_stime, ed_stime_bc, ed_etime, ed_etime_bc, ed_vei from ed where vd_id = $vd_id";
			$temp = $db->query($query);
//			echo $temp."\n";
			$result = $db->getList();
			$output = array();
			foreach($result as $row){
                $row['ed_stime'] = TimeFormatter::getJavascriptTimestamp($row['ed_stime']);
                if($row["ed_stime_bc"] != null){
                    $row['ed_stime'] += $row["ed_stime_bc"];
                    $row['ed_stime'] = "".$row["ed_stime"];
                }
                $row['ed_etime'] = TimeFormatter::getJavascriptTimestamp($row['ed_etime']);
                if($row["ed_etime_bc"] != null){
                    $row['ed_etime'] += $row["ed_etime_bc"];
                }
                $row["ed_phs"] = self::getEruptionPhase($row['ed_id']);
                array_push($output,$row);
            }

			return $output;
		}

		/**
		*	Given eruption phase id, return its information
		*	@param:
		*		$ed_phs_id
		*	@return
		*		eruption phase information
		*/
		public static function getEruptionPhase($ed_id) {
			global $db;
			$query = "select ed_phs_id, ed_phs_type, ed_phs_stime, ed_phs_etime, ed_phs_vei, ed_phs_dre_tot,
					ed_phs_dre_lav, ed_phs_dre_tep, ed_phs_col from ed_phs where ed_id=$ed_id";
			$temp = $db->query($query);
//			echo $temp."\n";
			$result = $db->getList();
            $output = array();
			foreach($result as $row){
                if(array_key_exists('ed_phs_stime', $row)){
                    $row['ed_phs_stime'] = TimeFormatter::getJavascriptTimestamp($row['ed_phs_stime']);
                }
                if(array_key_exists('ed_phs_etime', $row)){
                    $row['ed_phs_etime'] = TimeFormatter::getJavascriptTimestamp($row['ed_phs_etime']);
                }
                array_push($output,$row);
            }

			return $output;
		}

		/**
		*	Return this list of eruption forecast by volcano id
		*	@param:
		*		$vd_id
		*	@return:
		*		list of eruption forecast
		*/
		public static function getEruptionForecastList($vd_id) {
			global $db;
			$query = "select ed_for_alevel, ed_for_astime, ed_for_aetime from ed_for where vd_id = %d and ed_for_astime < ed_for_aetime";
			$temp = $db->query($query, $vd_id);
//			echo $temp;
			$result = $db->getList();
			foreach ($result as &$value) {

				$value['ed_for_astime'] = TimeFormatter::getJavascriptTimestamp($value['ed_for_astime']);
				$value['ed_for_aetime'] = TimeFormatter::getJavascriptTimestamp($value['ed_for_aetime']);
			}
			return $result;
		}
	}
