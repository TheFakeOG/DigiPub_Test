CREATE TABLE IF NOT EXISTS `skjema` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fornavn` varchar(50) NOT NULL,
  `etternavn` varchar(50) NOT NULL,
  `epost` varchar(50) DEFAULT NULL,
  `tlf` varchar(8) NOT NULL,
  `fødselsdato` date NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);