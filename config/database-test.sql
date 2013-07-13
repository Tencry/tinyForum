-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 20 2012 г., 18:05
-- Версия сервера: 5.5.8
-- Версия PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `test`
--
CREATE DATABASE `tinyforum` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tinyforum`;

-- --------------------------------------------------------

--
-- Структура таблицы `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL DEFAULT '0',
  `type` varchar(64) NOT NULL DEFAULT '',
  `title` varchar(64) NOT NULL DEFAULT '',
  `author` varchar(64) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `tstamp` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `forum`
--

INSERT INTO `forum` (`id`, `pid`, `type`, `title`, `author`, `text`, `tstamp`) VALUES
(1, 0, 'theme', 'Млекопитающие', 'Джон', '', 1327078110),
(2, 1, 'theme', 'Собаки', 'Джон', '', 1327078122),
(3, 2, 'message', '', 'Джон', 'Я люблю собак', 1327078139),
(4, 3, 'message', '', 'Билл', 'Я тоже', 1327078154),
(5, 2, 'message', '', 'Джейн', 'Собаки отстой, кошки лучше', 1327078186),
(6, 1, 'theme', 'Кошки', 'Джейн', '', 1327078204),
(7, 6, 'message', '', 'Джейн', 'Кошки самые лучшие', 1327078230),
(8, 7, 'message', '', 'Джон', 'нет', 1327078244),
(9, 8, 'message', '', 'Джейн', 'ДА!!!', 1327078255),
(10, 0, 'theme', 'Я не люблю домашних животных', 'Мадам Леонор', '', 1327078296),
(11, 10, 'message', '', 'Мадам Леонор', 'Я не люблю этих гадких тварей', 1327078322),
(12, 10, 'theme', 'Любители носорогов', 'Кейси', '', 1327079086);
