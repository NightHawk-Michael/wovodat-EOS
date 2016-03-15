<?php

$sql.="(DATEDIFF(a.td_time, FROM_UNIXTIME(0))*24*3600) as t, a.td_temp   FROM td a    WHERE (a.td_time BETWEEN '$startDate[2]-$startDate[0]-$startDate[1]' AND '$endDate[2]-$endDate[0]-$endDate[1]') AND a.ts_id='$station_id' ORDER BY a.td_time";

?>
