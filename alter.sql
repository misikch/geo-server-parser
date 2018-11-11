USE `demodb`;

DROP TABLE IF EXISTS `geo_counties`;
CREATE TABLE `geo_counties` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `geo_counties_names`;
CREATE TABLE `geo_counties_names` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `lang` varchar(2) NOT NULL,
  `country_code` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `coutry_code+lang` (`country_code`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `geo_regions_level1`;
CREATE TABLE `geo_regions_level1` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `code` varchar(10) NOT NULL,
  `country_code` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `coutry_code+code` (`country_code`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `geo_regions_level2`;
CREATE TABLE `geo_regions_level2` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `region_level1_code` varchar(10) NOT NULL,
  `code` varchar(25) NOT NULL,
  `country_code` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `coutry_code+region_level1_code+code` (`country_code`,`region_level1_code`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `geo_cities`;
CREATE TABLE `geo_cities` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `region_level1_code` varchar(10) NOT NULL,
  `region_level2_code` varchar(25) NOT NULL,
  `country_code` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `coutry_code+region_level1_code+region_level2_code` (`country_code`,`region_level1_code`,`region_level2_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `geo_alter_names`;
CREATE TABLE `geo_alter_names` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `geoname_id` int(11) NOT NULL,
  `lang` varchar(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_prefered_name` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `geoname_id+lang+is_prefered_name` (`geoname_id`,`lang`,`is_prefered_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



