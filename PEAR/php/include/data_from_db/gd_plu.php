<?php

$sql.="UNIX_TIMESTAMP(a.gd_plu_time) as t, a.gd_plu_species, a.gd_plu_emit, a.gd_plu_units    FROM gd_plu a    WHERE (a.gd_plu_time BETWEEN '$startDate[2]-$startDate[0]-$startDate[1]' AND '$endDate[2]-$endDate[0]-$endDate[1]') AND a.gs_id='$station_id' ORDER BY a.gd_plu_time";

?>
