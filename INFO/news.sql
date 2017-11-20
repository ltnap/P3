CREATE TABLE IF NOT EXISTS `news` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `auteur` varchar(30) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `AddDate` datetime NOT NULL,
  `UpdtDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 ;