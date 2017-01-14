USE wovodat
SELECT u1.sd_evn_code, u2.sd_evn_code, u1.sd_evn_time, u2.sd_evn_time, u1.sd_evn_elat, u2.sd_evn_elat, u1.sd_evn_elon, u2.sd_evn_elon, u1.sd_evn_loaddate, u2.sd_evn_loaddate
FROM sd_evn u1, sd_evn u2
WHERE u1.sd_evn_elat = u2.sd_evn_elat
AND u1.sd_evn_elon = u2.sd_evn_elon
AND u1.sd_evn_edep = u2.sd_evn_edep
AND u1.sd_evn_time = u2.sd_evn_time
AND u1.sd_evn_code != u2.sd_evn_code
GROUP BY u1.sd_evn_time
