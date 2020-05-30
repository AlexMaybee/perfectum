-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Трв 30 2020 р., 23:56
-- Версія сервера: 5.7.25-log
-- Версія PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `perfectum`
--

-- --------------------------------------------------------

--
-- Структура таблиці `chat`
--

CREATE TABLE `chat` (
  `id` tinyint(6) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `create_by` int(11) NOT NULL,
  `date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `chat`
--

INSERT INTO `chat` (`id`, `name`, `create_by`, `date_time`) VALUES
(1, 'HHH', 1, '2020-05-28 11:36:47'),
(2, 'BB', 3, '2020-05-28 11:36:47'),
(3, 'KOL', 2, '2020-05-28 17:18:02');

-- --------------------------------------------------------

--
-- Структура таблиці `chat_message`
--

CREATE TABLE `chat_message` (
  `id` int(11) UNSIGNED NOT NULL,
  `chat_id` int(11) NOT NULL,
  `create_by` int(11) NOT NULL,
  `message` text NOT NULL,
  `reply_to_message` int(11) DEFAULT NULL,
  `delete_for` json DEFAULT NULL,
  `date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_time_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `chat_message`
--

INSERT INTO `chat_message` (`id`, `chat_id`, `create_by`, `message`, `reply_to_message`, `delete_for`, `date_time`, `date_time_update`) VALUES
(1, 1, 1, 'Сообщение 1 тест', NULL, NULL, '2020-05-28 11:59:03', NULL),
(2, 1, 2, 'И тебе привет!', NULL, NULL, '2020-05-28 12:00:21', NULL),
(3, 1, 2, 'Как у тебя дела?', NULL, NULL, '2020-05-28 12:00:45', NULL),
(4, 2, 3, 'Врем привееет!', NULL, NULL, '2020-05-28 12:02:47', NULL),
(5, 2, 3, 'Как настроение?', NULL, NULL, '2020-05-28 12:02:58', NULL),
(6, 2, 2, 'Ну такое....', NULL, NULL, '2020-05-28 12:03:23', NULL),
(7, 2, 1, 'Бывало и лучше!', NULL, NULL, '2020-05-28 12:03:57', NULL),
(8, 2, 2, 'Сообщение Общий ответ всем', 4, NULL, '2020-05-28 12:22:38', NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `age` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `user`
--

INSERT INTO `user` (`id`, `name`, `lastname`, `age`) VALUES
(1, 'Alex', 'A', 5),
(2, 'Vova', 'V', 10),
(3, 'KOLYA', 'K', 2);

-- --------------------------------------------------------

--
-- Структура таблиці `user_chat_settings`
--

CREATE TABLE `user_chat_settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_time_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `user_chat_settings`
--

INSERT INTO `user_chat_settings` (`id`, `user_id`, `chat_id`, `is_active`, `date_time`, `date_time_update`) VALUES
(1, 1, 1, 1, '2020-05-28 11:52:12', NULL),
(2, 3, 1, 1, '2020-05-28 11:52:12', NULL),
(3, 1, 2, 1, '2020-05-28 11:53:39', NULL),
(4, 3, 2, 1, '2020-05-28 11:53:39', NULL),
(5, 2, 2, 1, '2020-05-28 11:53:39', NULL);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `user_chat_settings`
--
ALTER TABLE `user_chat_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `chat`
--
ALTER TABLE `chat`
  MODIFY `id` tinyint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблиці `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблиці `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблиці `user_chat_settings`
--
ALTER TABLE `user_chat_settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
