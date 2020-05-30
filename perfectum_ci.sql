-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Трв 30 2020 р., 23:57
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
-- База даних: `perfectum_ci`
--

-- --------------------------------------------------------

--
-- Структура таблиці `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) UNSIGNED NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `reply_to_id` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `comment`
--

INSERT INTO `comment` (`comment_id`, `user_name`, `email`, `comment`, `reply_to_id`, `date_create`, `date_update`) VALUES
(1, 'Вова Н', 'VovaN@gamil.com', 'Да ты шо?! И?', NULL, '2020-05-29 17:48:49', '2020-05-29 17:49:00'),
(2, NULL, 'DenM@gamil.com', 'ДА я те грю!', NULL, '2020-05-29 17:48:49', NULL),
(3, NULL, 'VovaN@gamil.com', 'Да не бывает такого!!!', NULL, '2020-05-29 17:49:45', NULL),
(4, NULL, 'DenM@gamil.com', 'Отвечаю!', NULL, '2020-05-29 17:49:45', NULL),
(5, 'Вова Н', 'VovaN@gamil.com', 'Ладно, верю!', 4, '2020-05-29 17:50:22', NULL),
(6, 'RRRR', '22@22.ia', 'EEEEEEEEEEEEEEEEEEEEEEEEE', NULL, '2020-05-29 22:40:42', NULL),
(7, 'Ваня', 'Ivan@i.ua', 'LOOONG MESSAGE OOOO', NULL, '2020-05-29 22:47:13', NULL),
(10, 'Ваня2123', 'Ivan@i.ua', 'LOOONG MESSAGE OOOO', NULL, '2020-05-29 22:51:39', NULL),
(11, 'Ваня2123', 'Ivan@i.ua', 'LOOONG MESSAGE OOOO', NULL, '2020-05-29 22:52:11', NULL),
(13, 'asdasdads', 'aaa@aa.oi', 'asasdd', NULL, '2020-05-29 23:29:44', NULL),
(14, 'IIIOO', 'AS@ui.pa', 'ASDASD', NULL, '2020-05-29 23:30:22', NULL),
(15, '', 'dsa@asd.oa', 'asdasda', NULL, '2020-05-29 23:31:02', '2020-05-30 23:49:36'),
(16, 'VADIK', 'aa@dfasd.iu', 'TEST ME', NULL, '2020-05-29 23:31:53', NULL),
(17, 'Vadik', 'VA@uu.oa', 'HELLO!A', NULL, '2020-05-29 23:32:45', NULL),
(18, '', 'Alex@1.ia', 'Help! M', NULL, '2020-05-29 23:39:46', NULL),
(19, 'New Name', 'Fff@ff.ia', 'HOHOHO- OOOO!', NULL, '2020-05-30 21:51:28', '2020-05-30 23:50:07'),
(21, 'Еще раз!', 'aa@aa.ua', 'Test comment from me!', NULL, '2020-05-30 22:18:52', NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(3, '2020-05-29-131304', 'App\\Database\\Migrations\\CommentMigrate', 'default', 'App', 1590763641, 1);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Індекси таблиці `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблиці `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
