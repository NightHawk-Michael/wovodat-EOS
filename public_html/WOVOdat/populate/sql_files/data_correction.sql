USE wovodat;

DELIMITER $$ 
DROP PROCEDURE IF EXISTS correct_avo_data $$
CREATE PROCEDURE correct_avo_data () 
BEGIN
	DECLARE done BOOLEAN DEFAULT FALSE;
    DECLARE code1, code2 TEXT DEFAULT "";
	DECLARE load1, load2 DATE;
	DECLARE seismic_cursor CURSOR FOR 
		SELECT u1.sd_evn_code, u2.sd_evn_code, u1.sd_evn_loaddate, u2.sd_evn_loaddate
		FROM sd_evn u1, sd_evn u2
		WHERE u1.sd_evn_elat = u2.sd_evn_elat
		AND u1.sd_evn_code = u2.sd_evn_code
		AND u1.sd_evn_elon = u2.sd_evn_elon
		AND u1.sd_evn_edep = u2.sd_evn_edep
		AND u1.sd_evn_time = u2.sd_evn_time
		AND u1.sd_evn_id != u2.sd_evn_id
		AND u1.sd_evn_arch = 'AVO'
		AND u2.sd_evn_arch = 'AVO'
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











