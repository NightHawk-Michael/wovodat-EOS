select * from `sd_evn` where `sd_evn_arch` = 'HVO' into outfile 'C:/Users/erickssonn/Desktop/data.csv' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\n' 


select sd_evn_eqtype, sd_evn_arch, avg(sd_evn_elat), avg(sd_evn_elon) 
into outfile 'C:/Users/erickssonn/Desktop/data.csv' FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\n' from sd_evn group by sd_evn_eqtype;
 
 
 
UPDATE sn t0, (SELECT sn_code, vd_id, sn_stime, sn_etime, sn_desc, sn_utc, sn_ori, sn_com FROM sn WHERE cc_id = 150 AND sn_code LIKE 'SeisNet_%') t1
SET t0.sn_stime = t1.sn_stime, t0.sn_desc = t1.sn_desc, t0.sn_utc = t1.sn_utc, t0.sn_ori = t1.sn_ori, t0.sn_com = t1.sn_com 
WHERE t0.vd_id = t1.vd_id AND t0.sn_code LIKE  'JMA_SeisNet_%' AND t0.cc_id = 150


SELECT * FROM `vd` WHERE vd_name IN ('Miyake-jima', 'Sakura-jima','Akan')


DELETE FROM sn WHERE sn_code LIKE 'SeisNet_%' AND cc_id = 150 AND vd_id NOT IN ( 628, 686, 746 ) 


UPDATE cn t0, (SELECT * FROM cn WHERE cc_id = 150 AND cn_code LIKE 'DefNet_%') t1
SET t0.cn_stime = t1.cn_stime, 
      t0.cn_desc = t1.cn_desc, 
	    t0.cn_utc = t1.cn_utc, 
		t0.cn_ori = t1.cn_ori, 
		t0.cn_com = t1.cn_com, 
		t0.cc_id2 = t1.cc_id2,
		t0.cc_id3 = t1.cc_id3,
		t0.cn_loaddate = t1.cn_loaddate,
	    t0.cn_pubdate = t1.cn_pubdate
WHERE t0.vd_id = t1.vd_id AND t0.cn_code LIKE  'JMA_DefNet_%' AND t0.cc_id = 150
SELECT * FROM `cn` WHERE `cc_id` = 150 AND cn_code LIKE '%DefNet%' ORDER BY `cn`.`vd_id` 


UPDATE cn t0, (SELECT * FROM cn WHERE cc_id = 150 AND cn_code LIKE 'GasNet_%') t1
SET t0.cn_stime = t1.cn_stime, 
      t0.cn_desc = t1.cn_desc, 
	    t0.cn_utc = t1.cn_utc, 
		t0.cn_ori = t1.cn_ori, 
		t0.cn_com = t1.cn_com, 
		t0.cc_id2 = t1.cc_id2,
		t0.cc_id3 = t1.cc_id3,
		t0.cn_loaddate = t1.cn_loaddate,
	    t0.cn_pubdate = t1.cn_pubdate
WHERE t0.vd_id = t1.vd_id AND t0.cn_code LIKE  'JMA_GasNet_%' AND t0.cc_id = 150
SELECT * FROM `cn` WHERE `cc_id` = 150 AND cn_code LIKE '%GasNet%' ORDER BY `cn`.`vd_id` 


UPDATE cn t0, (SELECT * FROM cn WHERE cc_id = 150 AND cn_code LIKE 'GasNet_%') t1
SET t0.cn_stime = t1.cn_stime, 
      t0.cn_desc = t1.cn_desc, 
	    t0.cn_utc = t1.cn_utc, 
		t0.cn_ori = t1.cn_ori, 
		t0.cn_com = t1.cn_com, 
		t0.cc_id2 = t1.cc_id2,
		t0.cc_id3 = t1.cc_id3,
		t0.cn_loaddate = t1.cn_loaddate,
	    t0.cn_pubdate = t1.cn_pubdate
WHERE t0.vd_id = t1.vd_id AND t0.cn_code LIKE  'JMA_GasNet_%' AND t0.cc_id = 150
SELECT * FROM `cn` WHERE `cc_id` = 150 AND cn_code LIKE '%GasNet%' ORDER BY `cn`.`vd_id` 



SELECT u1.cc_id 
FROM cc u1, cc u2
WHERE u1.cc_obs = u2.cc_obs
AND u2.cc_id = 199


SELECT u1.cc_id, u1.cc_code, u1.cc_obs
FROM cc u1, cc u2
WHERE u1.cc_obs = u2.cc_obs
AND u2.cc_id = 199
AND u1.cc_code REGEXP '[a-zA-Z]'



SELECT *
FROM sd_evn u1, sd_evn u2
WHERE u1.sd_evn_arch = 'AVO'
AND u2.sd_evn_arch = 'AVO'
AND u1.sd_evn_elat = u2.sd_evn_elat
AND u1.sd_evn_elon = u2.sd_evn_elon
AND u1.sd_evn_stime = u2.sd_evn_stime



USE wovodat;

DELIMITER $$ 
DROP PROCEDURE IF EXISTS correct_avo_data $$
CREATE PROCEDURE IF NOT EXISTS correct_avo_data () 
BEGIN
	DECLARE done BOOLEAN DEFAULT FALSE;
    DECLARE code1, code2 TEXT DEFAULT "";
	DECLARE load1, load2 DATE;
	DECLARE seismic_cursor CURSOR FOR 
		SELECT u1.sd_evn_code, u2.sd_evn_code, u1.sd_evn_loaddate, u2.sd_evn_loaddate
		FROM sd_evn u1, sd_evn u2
		WHERE u1.sd_evn_elat = u2.sd_evn_elat
		AND u1.sd_evn_elon = u2.sd_evn_elon
		AND u1.sd_evn_edep = u2.sd_evn_edep
		AND u1.sd_evn_time = u2.sd_evn_time
		AND u1.sd_evn_code != u2.sd_evn_code
		GROUP BY u1.sd_evn_time;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
	
	OPEN seismic_cursor;		
		seismic_loop: 
		LOOP
			FETCH seismic_cursor INTO code1, code2, load1, load2;
			IF done THEN
			  LEAVE seismic_loop;
			END IF;	
			#SELECT code1, code2, load1, load2;
			IF load1 < load2 THEN 
				DELETE FROM sd_evn WHERE sd_evn_code = code1;
			ELSE 
				DELETE FROM sd_evn WHERE sd_evn_code = code2;
			END IF;
		END LOOP 
		seismic_loop;		
    CLOSE seismic_cursor;	
	
END $$
DELIMITER ;
CALL correct_avo_data();
