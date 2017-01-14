USE wovodat;

DELIMITER $$ 
DROP FUNCTION IF EXISTS Distance $$
CREATE FUNCTION Distance(Lat1 DOUBLE, Lon1 DOUBLE, Lat2 DOUBLE,Lon2 DOUBLE) RETURNS DOUBLE
    DETERMINISTIC
BEGIN
    DECLARE dist, E, G, H, F DOUBLE DEFAULT 0.0;
	SET E = RADIANS(Lat1);
	SET G = RADIANS(Lat2);
	SET F = RADIANS(Lon1);
	SET H = RADIANS(Lon2);
	SET dist = 6371*acos(sin(E)*sin(G)+cos(E)*cos(G)*cos(H-F));	
RETURN dist;
END $$
DELIMITER ;

DELIMITER $$ 
DROP PROCEDURE IF EXISTS Get_vd_inf_slat_slon $$
CREATE PROCEDURE IF NOT EXISTS Get_vd_inf_slat_slon(IN Volcano_name TEXT, OUT latitude DOUBLE, OUT longitude DOUBLE)
BEGIN
	SELECT vd_inf_slat, vd_inf_slon 
	INTO latitude, longitude 
	FROM vd_inf, vd 
	WHERE  vd_inf.vd_id = vd.vd_id 
	AND vd.vd_name LIKE Volcano_name; 
END $$
DELIMITER ;

#CALL Get_vd_inf_slat_slon("Akutan",@latitude,@longitude);
#SELECT @latitude;
#SELECT @longitude;

DELIMITER $$
DROP PROCEDURE IF EXISTS GetVolcanoZone $$
CREATE PROCEDURE GetVolcanoZone(
    IN Volcano_name TEXT, IN Radius DOUBLE, 
	IN Date_range0 TEXT, IN Date_range1 TEXT,
	IN Magn_range0 DOUBLE, IN Magn_range1 DOUBLE, 
	IN Dept_range0 DOUBLE, IN Dept_range1 DOUBLE,  
	IN Eart_quakeT TEXT 
)
BEGIN

	DECLARE lat, lon DOUBLE DEFAULT 0;
	CALL Get_vd_inf_slat_slon(Volcano_name,lat,lon);

	SET @sql = CONCAT("
	SELECT sd_evn_time,
	       sd_evn_elat, 
		   sd_evn_elon, 		  
		   sd_evn_edep, 
		   sd_evn_pmag, 
		   sd_evn_pmag_type, 
		   sd_evn_eqtype,		   
		   Distance(sd_evn_elat,sd_evn_elon,",lat,",",lon,") AS Radial_dist,
		   sd_evn_arch
	FROM sd_evn 
	WHERE Distance(sd_evn_elat,sd_evn_elon,",lat,",",lon,") <= ",Radius,"
	AND   sd_evn_time >= ",Date_range0," AND sd_evn_time <= ",Date_range1,"
	AND   sd_evn_pmag >= ",Magn_range0," AND sd_evn_pmag <= ",Magn_range1,"
	AND   sd_evn_edep >= ",Dept_range0," AND sd_evn_edep <= ",Dept_range1,"
	AND   sd_evn_eqtype IN (",Eart_quakeT,")
	#AND   sd_evn_arch = \"AVO\"
	INTO OUTFILE 'C:/Users/erickssonn/Desktop/Volcano/",Volcano_name,".csv' 
	FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' 
	#LIMIT 100
	");
	PREPARE stmt FROM @sql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
	
END $$
DELIMITER ;
CALL GetVolcanoZone("Sinabung",100,"'1000-01-01'","'2018-04-17'",-10,10,-20,20,"'R','V','VT','H','LF','LF_T','LF_ILF','U','O','X','%'");

DELIMITER $$ 
DROP PROCEDURE IF EXISTS Prepare_volcano_zone $$
CREATE PROCEDURE IF NOT EXISTS Prepare_volcano_zone() 
BEGIN
	DECLARE done BOOLEAN DEFAULT FALSE;
    DECLARE volcano_name TEXT DEFAULT "";
	DECLARE vd_name CURSOR FOR SELECT vd_name FROM vd WHERE vd_id IN (972, 1056);
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
	OPEN vd_name;	
	
	volc_loop: LOOP
		FETCH vd_name INTO volcano_name;
		IF done THEN
		  LEAVE volc_loop;
		END IF;
		SELECT volcano_name;
	    CALL GetVolcanoZone(volcano_name,100,"'1000-01-01'","'2018-04-17'",-10,10,-20,20,"'R','V','VT','H','LF','LF_T','LF_ILF','U','O','X','%'");
    END LOOP volc_loop;
    CLOSE vd_name;	
END $$
DELIMITER ;
#CALL Prepare_volcano_zone();








