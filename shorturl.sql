SET FOREIGN_KEY_CHECKS = 0;

CREATE DATABASE IF NOT EXISTS `shorturl` CHARACTER SET utf8 COLLATE latin1_swedish_ci;

USE shorturl;

CREATE TABLE IF NOT EXISTS `hits` (
  `hit_id` int(11) NOT NULL AUTO_INCREMENT,
  `link_id` int(11) NOT NULL,
  `refer` varchar(150) NOT NULL,
  `user_ip` varchar(16) NOT NULL,
  `access_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `browser` varchar(30) NOT NULL,
  `browser_version` varchar(10) NOT NULL,
  `os` varchar(30) NOT NULL,
  `country` varchar(15) NOT NULL,
  `region` varchar(15) NOT NULL,
  `city` varchar(30) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  PRIMARY KEY (`hit_id`),
  KEY `link_id` (`link_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105 ;


CREATE TABLE IF NOT EXISTS `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `short` varchar(15) NOT NULL,
  `long` varchar(300) NOT NULL,
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;
