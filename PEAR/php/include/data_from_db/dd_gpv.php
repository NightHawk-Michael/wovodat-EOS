<?php

$sql.="UNIX_TIMESTAMP(dd_gpv_stime) as t, dd_gpv_N, dd_gpv_E, dd_gpv_vert FROM dd_gpv WHERE (dd_gpv_stime BETWEEN '$startDate[2]-$startDate[0]-$startDate[1]' AND '$endDate[2]-$endDate[0]-$endDate[1]') AND dd_gpv_pubdate < CONCAT(CURDATE(), ' ', CURTIME()) AND (ds_id='$station_id' OR di_gen_id=(SELECT di_gen_id FROM di_gen WHERE ds_id='$station_id')) ORDER BY dd_gpv_stime";

?>