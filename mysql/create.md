Create table if not exist with index
```
CREATE TABLE IF NOT EXISTS `table_name` (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`user_id` int(11) not null default 0,
		`order_id` int(11) not null default 0,
		`amount` decimal(15,2) not null DEFAULT 0,
		`created_at` datetime default null,
		PRIMARY KEY (`id`),
    INDEX `user_created` (user_id,created_at),
    INDEX `user_id` (user_id)
) ENGINE=INNODB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
```
