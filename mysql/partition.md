# Script add new partition by date
```
DELIMITER //

CREATE PROCEDURE proc_create_partition()
BEGIN
   DECLARE v_loop_str VARCHAR(3000);
   DECLARE v_date DATE;
   DECLARE p_error VARCHAR(2000);
   DECLARE done INT DEFAULT FALSE;

   -- Declare cursor
   DECLARE c_partition CURSOR FOR
      SELECT table_schema AS owner, table_name AS object_name, 
             MAX(SUBSTRING_INDEX(partition_name, '_', -1)) AS sub_partition
      FROM information_schema.partitions
      WHERE table_schema = 'APP_OWNER'
        AND partition_name IS NOT NULL
      GROUP BY table_name;

   -- Declare exit handler
   DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

   -- Open cursor
   OPEN c_partition;

   read_loop: LOOP
      FETCH c_partition INTO @owner, @object_name, @sub_partition;
      
      IF done THEN
         LEAVE read_loop;
      END IF;

      -- Parse the sub_partition into a date
      SET v_date = STR_TO_DATE(CONCAT('20', @sub_partition), '%Y%m%d');

      WHILE v_date <= DATE_ADD(STR_TO_DATE(CONCAT('20', @sub_partition), '%Y%m%d'), INTERVAL 1 MONTH)
      DO
         BEGIN
            -- Increment date
            SET v_date = DATE_ADD(v_date, INTERVAL 1 DAY);
            
            -- Create dynamic query
            SET v_loop_str = CONCAT('ALTER TABLE ', @owner, '.', @object_name,
                                    ' ADD PARTITION (PARTITION DATA20', 
                                    DATE_FORMAT(v_date, '%y%m%d'), 
                                    ' VALUES LESS THAN (TO_DATE(''20', 
                                    DATE_FORMAT(v_date, '%y%m%d'), 
                                    ''', ''%Y%m%d'')))');
                                    
            -- Output for debug (You can replace this with a log table insert if needed)
            SELECT v_loop_str;

            -- Execute the dynamic SQL
            SET @stmt = v_loop_str;
            PREPARE stmt FROM @stmt;
            EXECUTE stmt;
            DEALLOCATE PREPARE stmt;

         -- Exception handler for MySQL
         EXCEPTION
            WHEN SQLEXCEPTION THEN
               SET p_error = CONCAT('Error occurred while adding partition: ', SQLERRM);
               SELECT p_error;
         END;
      END WHILE;
   END LOOP;

   -- Close cursor
   CLOSE c_partition;
END//

DELIMITER ;
```
Create table with auto partition
```
CREATE TABLE products (
    product_id    INT(6),
    customer_id   INT,
    time_id       DATE,
    channel_info  CHAR(1),
    promo_id      INT(6),
    qty_sold      INT(3),
    amt_sold      DECIMAL(10,2)
)
PARTITION BY RANGE (YEAR(time_id)) (
    PARTITION p0 VALUES LESS THAN (2015),
    PARTITION p1 VALUES LESS THAN (2016),
    PARTITION p2 VALUES LESS THAN (2017),
    PARTITION pmax VALUES LESS THAN MAXVALUE
);
```

