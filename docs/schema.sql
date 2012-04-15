-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 15 Avril 2012 à 03:53
-- Version du serveur: 5.1.61
-- Version de PHP: 5.3.9-ZS5.6.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `nation`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `books`
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


-- --------------------------------------------------------

--
-- Structure de la table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `left` int(11) NOT NULL,
  `right` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `sections`
--

INSERT INTO `sections` (`id`, `name`, `left`, `right`) VALUES
(1, 'info', 1, 10),
(2, 'web', 2, 9),
(3, 'PHP', 3, 4),
(4, 'JS', 5, 6),
(5, 'CSS', 7, 8);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `users`
--


-- --------------------------------------------------------

--
-- Structure de la table `users_books`
--

CREATE TABLE IF NOT EXISTS `users_books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `book` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `book` (`book`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `users_books`
--


