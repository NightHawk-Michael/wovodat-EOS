<?php

$sql.="UNIX_TIMESTAMP(a.sd_ivl_stime) as t, a.sd_ivl_nrec    FROM sd_ivl a    WHERE (a.sd_ivl_stime BETWEEN '$startDate[2]-$startDate[0]-$startDate[1]' AND '$endDate[2]-$endDate[0]-$endDate[1]') AND (a.ss_id='$station_id') ORDER BY a.sd_ivl_stime";

?>
