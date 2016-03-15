<?php

$sql.="UNIX_TIMESTAMP(a.sd_rsm_stime) as t, a.sd_rsm_count    FROM sd_rsm a, sd_sam b   WHERE (a.sd_rsm_stime BETWEEN '$startDate[2]-$startDate[0]-$startDate[1]' AND '$endDate[2]-$endDate[0]-$endDate[1]') AND (b.ss_id='$station_id') AND a.sd_sam_id=b.sd_sam_id ORDER BY a.sd_rsm_stime";

?>