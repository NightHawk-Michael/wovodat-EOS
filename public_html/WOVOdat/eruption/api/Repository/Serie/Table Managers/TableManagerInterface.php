<?php
/**
 *	This class supports query the data series (deformation, gas, seismic..) for a volcano
 * 	
 */
// DEFINE('HOST', 'localhost');

interface TableManagerInterface {
  public function getTimeSeriesList($vd_id);
  public function getStationData($stations,$vd_id);
} 