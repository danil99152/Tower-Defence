-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 31 2019 г., 17:45
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
(1, 10, 10);

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
(5, '1', 0, 4, '1', '0', 'road'),
(6, '1', 0, 5, '0', '1', 'grass'),
(7, '1', 0, 6, '0', '1', 'grass'),
(8, '1', 0, 7, '0', '1', 'grass'),
(9, '1', 0, 8, '0', '1', 'grass'),
(10, '1', 0, 9, '0', '1', 'grass'),
(11, '1', 1, 0, '0', '1', 'grass'),
(12, '1', 1, 1, '0', '1', 'grass'),
(13, '1', 1, 2, '1', '0', 'road'),
(14, '1', 1, 3, '0', '1', 'grass'),
(15, '1', 1, 4, '1', '0', 'road'),
(16, '1', 1, 5, '1', '0', 'road'),
(17, '1', 1, 6, '1', '0', 'road'),
(18, '1', 1, 7, '1', '0', 'road'),
(19, '1', 1, 8, '1', '0', 'road'),
(20, '1', 1, 9, '1', '0', 'road'),
(21, '1', 2, 0, '1', '0', 'road'),
(22, '1', 2, 1, '1', '0', 'road'),
(23, '1', 2, 2, '1', '0', 'road'),
(24, '1', 2, 3, '0', '1', 'grass'),
(25, '1', 2, 4, '0', '1', 'grass'),
(26, '1', 2, 5, '0', '1', 'grass'),
(27, '1', 2, 6, '1', '0', 'road'),
(28, '1', 2, 7, '0', '1', 'grass'),
(29, '1', 2, 8, '0', '1', 'grass'),
(30, '1', 2, 9, '0', '1', 'grass'),
(31, '1', 3, 0, '0', '1', 'grass'),
(32, '1', 3, 1, '0', '1', 'grass'),
(33, '1', 3, 2, '1', '0', 'road'),
(34, '1', 3, 3, '1', '0', 'road'),
(35, '1', 3, 4, '1', '0', 'road'),
(36, '1', 3, 5, '0', '1', 'grass'),
(37, '1', 3, 6, '1', '0', 'road'),
(38, '1', 3, 7, '0', '1', 'grass'),
(39, '1', 3, 8, '1', '0', 'road'),
(40, '1', 3, 9, '1', '0', 'road'),
(41, '1', 4, 0, '0', '1', 'grass'),
(42, '1', 4, 1, '1', '0', 'road'),
(43, '1', 4, 2, '1', '0', 'road'),
(44, '1', 4, 3, '0', '1', 'grass'),
(45, '1', 4, 4, '1', '0', 'road'),
(46, '1', 4, 5, '1', '0', 'road'),
(47, '1', 4, 6, '1', '0', 'road'),
(48, '1', 4, 7, '1', '0', 'road'),
(49, '1', 4, 8, '1', '0', 'road'),
(50, '1', 4, 9, '0', '1', 'grass'),
(51, '1', 5, 0, '1', '0', 'road'),
(52, '1', 5, 1, '1', '0', 'road'),
(53, '1', 5, 2, '0', '1', 'grass'),
(54, '1', 5, 3, '0', '1', 'grass'),
(55, '1', 5, 4, '1', '0', 'road'),
(56, '1', 5, 5, '1', '0', 'road'),
(57, '1', 5, 6, '0', '1', 'grass'),
(58, '1', 5, 7, '0', '1', 'grass'),
(59, '1', 5, 8, '0', '1', 'grass'),
(60, '1', 5, 9, '0', '1', 'grass'),
(61, '1', 6, 0, '0', '1', 'grass'),
(62, '1', 6, 1, '0', '1', 'grass'),
(63, '1', 6, 2, '0', '1', 'grass'),
(64, '1', 6, 3, '1', '0', 'road'),
(65, '1', 6, 4, '1', '0', 'road'),
(66, '1', 6, 5, '1', '0', 'road'),
(67, '1', 6, 6, '0', '1', 'grass'),
(68, '1', 6, 7, '1', '0', 'road'),
(69, '1', 6, 8, '1', '0', 'road'),
(70, '1', 6, 9, '1', '0', 'road'),
(71, '1', 7, 0, '0', '1', 'grass'),
(72, '1', 7, 1, '0', '1', 'grass'),
(73, '1', 7, 2, '1', '0', 'road'),
(74, '1', 7, 3, '1', '0', 'road'),
(75, '1', 7, 4, '0', '1', 'grass'),
(76, '1', 7, 5, '1', '0', 'road'),
(77, '1', 7, 6, '1', '0', 'road'),
(78, '1', 7, 7, '1', '0', 'road'),
(79, '1', 7, 8, '0', '1', 'grass'),
(80, '1', 7, 9, '0', '1', 'grass'),
(81, '1', 8, 0, '0', '1', 'grass'),
(82, '1', 8, 1, '1', '0', 'road'),
(83, '1', 8, 2, '1', '0', 'road'),
(84, '1', 8, 3, '0', '1', 'grass'),
(85, '1', 8, 4, '0', '1', 'grass'),
(86, '1', 8, 5, '0', '1', 'grass'),
(87, '1', 8, 6, '0', '1', 'grass'),
(88, '1', 8, 7, '1', '0', 'road'),
(89, '1', 8, 8, '1', '0', 'road'),
(90, '1', 8, 9, '0', '1', 'grass'),
(91, '1', 9, 0, '0', '1', 'grass'),
(92, '1', 9, 1, '1', '0', 'road'),
(93, '1', 9, 2, '0', '1', 'grass'),
(94, '1', 9, 3, '0', '1', 'grass'),
(95, '1', 9, 4, '0', '1', 'grass'),
(96, '1', 9, 5, '0', '1', 'grass'),
(97, '1', 9, 6, '0', '1', 'grass'),
(98, '1', 9, 7, '0', '1', 'grass'),
(99, '1', 9, 8, '1', '0', 'road'),
(100, '1', 9, 9, '0', '1', 'grass');

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
(1, 'вася', 'vasya', '123', NULL),
(2, 'Петя', 'petya', '123', NULL),
(3, 'Нул', ' ', ' ', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `shot`
--
ALTER TABLE `shot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `tile`
--
ALTER TABLE `tile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT для таблицы `tower`
--
ALTER TABLE `tower`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
