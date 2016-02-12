<?php

$sql.="dd_gpv_code, di_gen_id, ds_id, dd_gpv_stime, dd_gpv_stime_unc, dd_gpv_etime, dd_gpv_etime_unc, dd_gpv_dmag, dd_gpv_daz, dd_gpv_vincl, dd_gpv_N, dd_gpv_E, dd_gpv_vert, dd_gpv_dherr, dd_gpv_dnerr, dd_gpv_deerr, dd_gpv_dverr, dd_gpv_com, cc_id FROM dd_gpv WHERE (dd_gpv_stime BETWEEN '$startDate[2]-$startDate[0]-$startDate[1]' AND '$endDate[2]-$endDate[0]-$endDate[1]') AND dd_gpv_pubdate < CONCAT(CURDATE(), ' ', CURTIME()) AND (ds_id='$station_id' OR di_gen_id=(SELECT di_gen_id FROM di_gen WHERE ds_id='$station_id'))";

?>