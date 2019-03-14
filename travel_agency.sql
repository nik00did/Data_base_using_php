-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 14 2019 г., 19:59
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `travel_agency`
--

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `surname` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `patronymic` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`id`, `surname`, `name`, `patronymic`, `address`, `phone`) VALUES
(6, 'Ahalakova', 'Yulia', 'Sergeevna', 'c.Dnipro', 2147483647),
(8, 'Vovchenko', 'Taras', 'Alexandrovich', 'c.Dnipro', 2147483647),
(11, 'Lelikov', 'Andrew', 'Vitalievich', 't.Poznan', 445638563),
(14, 'Lysenko', 'Artem', 'Nikolaevich', 'c.Kiev', 2147483647),
(16, 'Stark', 'Tony', 'Hovardovich', 'c.New-York', 555),
(17, 'Pushkarev', 'Ilua', 'Alexandrovich', 'c.Dnipro', 380993494),
(19, 'Ivanov', 'Ivan', 'Ivanovich', 'c.Undefined', 333666999),
(20, 'Downey', 'Robert', 'Junior', 'Mayami', 999666333),
(21, 'rrrrrrrrrrrrr', 'eeeeeeeee', 'wwwwwwwwwww', 'qqqqqqq', 11111111),
(22, 'rrrrrrrrrrrrr', 'eeeeeeeee', 'wwwwwwwwwww', 'qqqqqqq', 11111111),
(23, 'rrrrrrrrrrrrr', 'eeeeeeeee', 'wwwwwwwwwww', 'qqqqqqq', 11111111),
(24, 'rrrrrrrrrrrrr', 'eeeeeeeee', 'wwwwwwwwwww', 'qqqqqqq', 11111111),
(25, 'rrrrrrrrrrrrr', 'eeeeeeeee', 'wwwwwwwwwww', 'qqqqqqq', 11111111),
(26, 'rrrrrrrrrrrrr', 'eeeeeeeee', 'wwwwwwwwwww', 'qqqqqqq', 11111111),
(27, 'rrrrrrrrrrrrr', 'eeeeeeeee', 'wwwwwwwwwww', 'qqqqqqq', 11111111),
(28, 'hhhfggg', 'baaaa', 'chjgf', 'ehjhg', 1112222),
(29, 'a', 'b', 'c', 'eee', 111),
(31, 'a', 'b', 'c', 'eee', 111),
(33, 'uuuuuuuuuuuu', 'ttttttt', 'rrrrrrrrrrrr', 'fffffffffff', 22222222),
(50, 'Nikita', 'Didenko', 'Vadimovich', 'сысыс', 11111111);

-- --------------------------------------------------------

--
-- Структура таблицы `permits`
--

CREATE TABLE IF NOT EXISTS `permits` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_route` int(11) NOT NULL,
  `id_cust` int(11) NOT NULL,
  `date_go` date NOT NULL,
  `amount` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cust` (`id_cust`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `permits`
--

INSERT INTO `permits` (`id`, `id_route`, `id_cust`, `date_go`, `amount`, `discount`) VALUES
(4, 120, 17, '2019-03-15', 10, 5),
(5, 118, 20, '2019-05-11', 8392, 50),
(6, 122, 6, '2019-03-19', 84, 30),
(7, 116, 14, '2019-03-15', 49, 8),
(8, 123, 27, '2019-04-13', 934, 20),
(10, 0, 50, '2019-03-05', 5, 8),
(20, 115, 27, '2019-03-07', 6666, 55);

-- --------------------------------------------------------

--
-- Структура таблицы `routes`
--

CREATE TABLE IF NOT EXISTS `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Country` varchar(20) NOT NULL,
  `Climate` varchar(20) NOT NULL,
  `Lasting` int(11) NOT NULL,
  `Hotel` varchar(20) NOT NULL,
  `Cost` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_routes` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1122 ;

--
-- Дамп данных таблицы `routes`
--

INSERT INTO `routes` (`id`, `Country`, `Climate`, `Lasting`, `Hotel`, `Cost`) VALUES
(114, 'UK', 'Cold', 100, '', 5000),
(115, 'aa', 'ok', 20, 'nnnnnnnnn', 100666666),
(116, 'fkbvkfd', 'Cold', 6554, 'dfghjk', 0),
(117, 'china', 'hot', 123, 'hotel', 5678),
(118, 'ytjgfnfgn', 'jfdfndf', 4654634, 'gfdge', 10),
(119, 'fbghkolp', 'sasaew', 99, 'regrrht', 60),
(120, 'vcnvbmbnmm', 'fdsgdhf', 1234, 'puyiwere', 12342),
(121, 'fdhfgj', 'rytrtnh', 5433, 'xgfryg', 9365),
(122, 'vdoqfu', 'eivdsgtj', 572, 'mwhgew', 5),
(123, 'reyvdj', 'aqrynk', 4, 'ynbf', 4005),
(1120, 'ffdiifsksl', 'fmdkfwoefnd', 6554, 'gfkrml', 432),
(1121, '12324324', 'cvfbd', 1213, 'bfhfnb', 100000);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `permits`
--
ALTER TABLE `permits`
  ADD CONSTRAINT `permits_ibfk_2` FOREIGN KEY (`id_cust`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
