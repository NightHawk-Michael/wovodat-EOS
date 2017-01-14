 DELIMITER $$ 
 DROP PROCEDURE IF EXISTS test_mysql_loop $$
 CREATE PROCEDURE IF NOT EXISTS test_mysql_loop()
 BEGIN
	 DECLARE x INT DEFAULT 0;	
	 SET x = 1;			
	 loop_label:  LOOP
	 IF  x > 10 THEN 
	 LEAVE  loop_label;
	 END  IF;				
	 SET  x = x + 1;
	 END LOOP;    
	 SELECT x; 
 END $$
 DELIMITER ;
 CALL test_mysql_loop();