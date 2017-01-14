<?php
include 'php/include/db_connect_view.php';

	
function getAllResult(){	
	global $link;

$sql2="SELECT TempV2.vd_name AS vdName, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, concat('Network Events(', TempV1.sd_evn_eqtype, ')'), MinTime, MaxTime, concat('vd_id=', TempV2.vd_id, '&stime=', TempV2.ed_stime)
FROM (
SELECT sn_id, sd_evn_eqtype, MIN(sd_evn_time) as MinTime, MAX(sd_evn_time) as MaxTime
FROM sd_evn
WHERE (
sd_evn_time
BETWEEN '2000-03-01 00:00:00'
AND '2015-03-02 00:00:00'
)
AND (
sd_evn.sd_evn_eqtype = 'E'
OR sd_evn.sd_evn_eqtype = 'VT'
)
GROUP BY sn_id, sd_evn_eqtype
) AS TempV1, 
(
SELECT *
FROM vol_jj_sn
WHERE (
ed_stime
BETWEEN '2000-03-01 00:00:00'
AND '2015-03-02 00:00:00'
)
) AS TempV2
WHERE TempV1.sn_id = TempV2.sn_id
GROUP BY vdName, TempV2.vd_id, TempV2.vd_inf_type, TempV2.vd_inf_rtype, TempV2.ed_stime, TempV2.ed_etime, TempV2.ed_vei, TempV1.sd_evn_eqtype";
	
	echo $sql2;

	$result = mysql_query($sql2, $link);
	while($row=mysql_fetch_array($result)){
			$data[]=$row;		
	}
	
	return $data;
}


?>