
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `login` varchar(16) NOT NULL,
  `email` varchar(96) NOT NULL,
  `password` varchar(32) NOT NULL,
  `profil_id` int(11) NOT NULL,
  `expiration` date NOT NULL,
  `last_cnx` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DELETE FROM `users`;
INSERT INTO `users` (`id`, `firstname`, `lastname`, `login`, `email`, `password`, `profil_id`, `expiration`, `last_cnx`, `last_update`) VALUES
	(1, 'Olivier', 'Gaillard', 'ogaillard', 'ogaillard@live.fr', '3f03eb77315398ab66129052d669be92', 300, '2049-12-31', '', '');

/* ogaillard /ogaillard */