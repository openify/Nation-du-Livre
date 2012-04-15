--
-- Base de données: `nation`
--

-- --------------------------------------------------------

--
-- Structure de la table `books_sections`
--

CREATE TABLE IF NOT EXISTS `books_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255),
  `password` varchar(255),
  `name` varchar(255),
  `lastname` varchar(255),
  `book` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `book` (`book`,`section`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `books_sections`
--


