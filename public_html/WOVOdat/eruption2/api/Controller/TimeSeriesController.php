<?php
	class TimeSeriesController {

		/**
		*	@param: 
		*		$vd_id
		*	@return 
		*		data list
		*/
		public static function loadDataList($vd_id) {


			$instance = TimeSeriesManager::getInstance();
			$result = $instance->getTimeSeriesList($vd_id);

			return $result;
		}	


		public static function loadTimeSerie($serie,$vd_id) {
			$instance = TimeSeriesManager::getInstance();
			$result = $instance->getTimeSerie($serie,$vd_id);
			return $result;
		}

	}
