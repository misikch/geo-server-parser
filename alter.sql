USE `demodb`;

DROP TABLE IF EXISTS `geo_counties`;
CREATE TABLE `geo_counties` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(2) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `geo_counties_names`;
CREATE TABLE `geo_counties_names` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(2) CHARACTER SET utf8 NOT NULL,
  `country_code` varchar(2) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `coutry_code+lang` (`country_code`,`lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `geo_regions_level1`;
CREATE TABLE `geo_regions_level1` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) CHARACTER SET utf8 NOT NULL,
  `country_code` varchar(2) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `coutry_code+code` (`country_code`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;





