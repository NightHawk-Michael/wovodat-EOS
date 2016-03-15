<?php

$sql.="UNIX_TIMESTAMP(a.dd_edm_time) as t, a.dd_edm_line, a.ds_id2, b.ds_name FROM dd_edm a, ds b WHERE a.ds_id2=b.ds_id and (a.dd_edm_time BETWEEN '$startDate[2]-$startDate[0]-$startDate[1]' AND '$endDate[2]-$endDate[0]-$endDate[1]') AND a.dd_edm_pubdate < CONCAT(CURDATE(), ' ', CURTIME()) AND (a.ds_id1='$station_id' OR di_gen_id=(SELECT c.di_gen_id FROM di_gen c WHERE a.ds_id1='$station_id')) ORDER BY a.dd_edm_time";

?>