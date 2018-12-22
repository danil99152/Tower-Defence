-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 22 2018 г., 12:20
-- Версия сервера: 5.6.41
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tower_of_is`
--

-- --------------------------------------------------------

--
-- Структура таблицы `map`
--

CREATE TABLE `map` (
  `id` int(11) NOT NULL,
  `size_x` int(11) DEFAULT NULL,
  `size_y` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `map`
--

INSERT INTO `map` (`id`, `size_x`, `size_y`) VALUES
(1, 6, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `mob`
--

CREATE TABLE `mob` (
  `id` int(11) NOT NULL,
  `user_id` varchar(45) NOT NULL DEFAULT '1',
  `life` varchar(45) NOT NULL DEFAULT '1000',
  `x` varchar(45) DEFAULT '1',
  `y` varchar(45) DEFAULT '1',
  `speed` varchar(45) DEFAULT '1',
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mob`
--

INSERT INTO `mob` (`id`, `user_id`, `life`, `x`, `y`, `speed`, `type`) VALUES
(26, '1', '1500', '0', '0', '5', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `shot`
--

CREATE TABLE `shot` (
  `id` int(11) NOT NULL,
  `angle` varchar(45) NOT NULL DEFAULT '0.5',
  `x` varchar(45) DEFAULT '1',
  `y` varchar(45) DEFAULT '1',
  `speed` varchar(45) NOT NULL DEFAULT '1',
  `user_id` varchar(45) NOT NULL DEFAULT '1',
  `tower_id` varchar(45) NOT NULL DEFAULT '1',
  `status` varchar(45) DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shot`
--

INSERT INTO `shot` (`id`, `angle`, `x`, `y`, `speed`, `user_id`, `tower_id`, `status`, `type`) VALUES
(1, '0.5', '2', '2', '10000', '2', '1', NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tile`
--

CREATE TABLE `tile` (
  `id` int(11) NOT NULL,
  `map_id` varchar(45) NOT NULL DEFAULT '1',
  `x` int(11) NOT NULL DEFAULT '1',
  `y` int(11) NOT NULL DEFAULT '1',
  `passability` varchar(45) NOT NULL DEFAULT '1',
  `sprite` varchar(45) NOT NULL DEFAULT '1',
  `type` varchar(45) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tile`
--

INSERT INTO `tile` (`id`, `map_id`, `x`, `y`, `passability`, `sprite`, `type`) VALUES
(1, '1', 0, 0, '0', '1', 'grass'),
(2, '1', 0, 1, '0', '1', 'grass'),
(3, '1', 0, 2, '1', '0', 'road'),
(4, '1', 0, 3, '0', '1', 'grass'),
(5, '1', 0, 4, '0', '1', 'grass'),
(6, '1', 0, 5, '0', '1', 'grass'),
(7, '1', 1, 0, '0', '1', 'grass'),
(8, '1', 1, 1, '0', '1', 'grass'),
(9, '1', 1, 2, '1', '0', 'road'),
(10, '1', 1, 3, '0', '1', 'grass'),
(11, '1', 1, 4, '0', '1', 'grass'),
(12, '1', 1, 5, '0', '1', 'grass'),
(13, '1', 2, 0, '0', '1', 'grass'),
(14, '1', 2, 1, '1', '0', 'road'),
(15, '1', 2, 2, '1', '0', 'road'),
(16, '1', 2, 3, '0', '1', 'grass'),
(17, '1', 2, 4, '0', '1', 'grass'),
(18, '1', 2, 5, '0', '1', 'grass'),
(19, '1', 3, 0, '0', '1', 'grass'),
(20, '1', 3, 1, '1', '0', 'road'),
(21, '1', 3, 2, '0', '1', 'grass'),
(22, '1', 3, 3, '0', '1', 'grass'),
(23, '1', 3, 4, '0', '1', 'grass'),
(24, '1', 3, 5, '0', '1', 'grass'),
(25, '1', 4, 0, '0', '1', 'grass'),
(26, '1', 4, 1, '1', '0', 'road'),
(27, '1', 4, 2, '1', '0', 'road'),
(28, '1', 4, 3, '1', '0', 'road'),
(29, '1', 4, 4, '1', '0', 'road'),
(30, '1', 4, 5, '1', '0', 'road'),
(31, '1', 5, 0, '0', '1', 'grass'),
(32, '1', 5, 1, '0', '1', 'grass'),
(33, '1', 5, 2, '0', '1', 'grass'),
(34, '1', 5, 3, '0', '1', 'grass'),
(35, '1', 5, 4, '0', '1', 'grass'),
(36, '1', 5, 5, '0', '1', 'grass');

-- --------------------------------------------------------

--
-- Структура таблицы `tower`
--

CREATE TABLE `tower` (
  `id` int(11) NOT NULL,
  `user_id` varchar(45) NOT NULL DEFAULT '1',
  `damage` varchar(45) NOT NULL DEFAULT '1',
  `x` varchar(45) DEFAULT '1',
  `y` varchar(45) DEFAULT '1',
  `angle` varchar(45) NOT NULL DEFAULT '0.5',
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tower`
--

INSERT INTO `tower` (`id`, `user_id`, `damage`, `x`, `y`, `angle`, `type`) VALUES
(1, '2', '100000', '2', '2', '0.5', 1),
(12, '1', '500', '2', '2', '0', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `login` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `token` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `login`, `password`, `token`) VALUES
(1, 'вася', 'vasya', '123', '78408828f91bd7118c8c16f14d5de233'),
(2, 'Петя', 'peya', '123', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `size_x_UNIQUE` (`size_x`),
  ADD UNIQUE KEY `size_y_UNIQUE` (`size_y`);

--
-- Индексы таблицы `mob`
--
ALTER TABLE `mob`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`);

--
-- Индексы таблицы `shot`
--
ALTER TABLE `shot`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gamerId_UNIQUE` (`user_id`),
  ADD UNIQUE KEY `towerId_UNIQUE` (`tower_id`);

--
-- Индексы таблицы `tile`
--
ALTER TABLE `tile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Индексы таблицы `tower`
--
ALTER TABLE `tower`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iduser_UNIQUE` (`id`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `map`
--
ALTER TABLE `map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `mob`
--
ALTER TABLE `mob`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `shot`
--
ALTER TABLE `shot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tile`
--
ALTER TABLE `tile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `tower`
--
ALTER TABLE `tower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
