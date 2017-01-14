use wovodat;
DELIMITER $$
DROP FUNCTION IF EXISTS Distance $$
CREATE FUNCTION Distance(Lat1 DOUBLE, lng1 DOUBLE, Lat2 DOUBLE,lng2 DOUBLE) RETURNS DOUBLE

BEGIN
    DECLARE R INT;
    DECLARE dLat DOUBLE(30,15);
    DECLARE dLng DOUBLE(30,15);
    DECLARE a1 DOUBLE(30,15);
    DECLARE a2 DOUBLE(30,15);
    DECLARE a DOUBLE(30,15);
    DECLARE c DOUBLE(30,15);
    DECLARE d DOUBLE(30,15);

    SET R = 6371; 
    SET dLat = RADIANS( lat2 ) - RADIANS( lat1 );
    SET dLng = RADIANS( lng2 ) - RADIANS( lng1 );
    SET a1 = SIN( dLat / 2 ) * SIN( dLat / 2 );
    SET a2 = SIN( dLng / 2 ) * SIN( dLng / 2 ) * COS( RADIANS( lat1 )) * COS( RADIANS( lat2 ) );
    SET a = a1 + a2;
    SET c = 2 * ATAN2( SQRT( a ), SQRT( 1 - a ) );
    SET d = R * c;
    RETURN d;
END$$

DELIMITER ;