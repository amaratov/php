USE demo;

CREATE TABLE IF NOT EXISTS `lab4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_name` varchar(100) NOT NULL,
  `person_age` int(3) NOT NULL,
  `person_dio`text NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `store_file_name` varchar(255) NOT NULL,
  `file_uploaded` datetime DEFAULT CURRENT_TIMESTAMP,
  `filesize` int(11) NOT NULL,
  `file_type` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
);