-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 03 2019 г., 23:45
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `my_organization`
--
CREATE DATABASE IF NOT EXISTS `my_organization` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `my_organization`;

-- --------------------------------------------------------

--
-- Структура таблицы `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL COMMENT '№',
  `сustomer_name` varchar(150) NOT NULL COMMENT 'Наименование',
  `сustomer_UNP` int(10) NOT NULL COMMENT 'УНП',
  `customer_address` varchar(300) NOT NULL COMMENT 'Адрес',
  `costomer_contacts` text NOT NULL COMMENT 'Контакты',
  `costomer_notice` text NOT NULL COMMENT 'Примечание'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `customer`
--

INSERT INTO `customer` (`id`, `сustomer_name`, `сustomer_UNP`, `customer_address`, `costomer_contacts`, `costomer_notice`) VALUES
(1, 'ООО', 123456789, 'Адрес ООО', 'Контакты ООО', 'Что-то об ООО'),
(2, 'ЧУП', 234567891, 'Адрес ЧУП', 'Контакты ЧУП', 'Описание ЧУП'),
(3, 'ОАО', 345678912, 'Адрес ОАО', 'Контакты ОАО', 'Что-то об ОАО'),
(5, 'ИП', 567891234, 'Адрес ИП', 'Контакты ИП', 'Что-то об ИП'),
(12, '1', 1, '1', '1', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `group_workers`
--

CREATE TABLE `group_workers` (
  `id` int(11) NOT NULL,
  `group_workers` varchar(50) NOT NULL COMMENT 'Группа / Отдел',
  `description` text NOT NULL COMMENT 'Описание'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `group_workers`
--

INSERT INTO `group_workers` (`id`, `group_workers`, `description`) VALUES
(1, 'leader', 'Администратор'),
(2, 'worker', 'Работники с разрешением на редактирование'),
(3, 'user', 'Работники с разрешением только на просмотр');

-- --------------------------------------------------------

--
-- Структура таблицы `objects`
--

CREATE TABLE `objects` (
  `id` int(11) NOT NULL COMMENT '№',
  `id_customer` int(11) NOT NULL COMMENT 'Заказчик',
  `object_name` varchar(300) NOT NULL COMMENT 'Объект',
  `beginning_works` date NOT NULL COMMENT 'Начало работ',
  `end_work` date NOT NULL COMMENT 'Окончание работ',
  `status_objects` int(10) NOT NULL COMMENT 'Состояние',
  `notes` text NOT NULL COMMENT 'Примечания'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `objects`
--

INSERT INTO `objects` (`id`, `id_customer`, `object_name`, `beginning_works`, `end_work`, `status_objects`, `notes`) VALUES
(3, 3, 'Объект ОАО', '2019-10-09', '2019-10-31', 3, 'Строительство идет'),
(4, 1, 'Объект ООО', '2019-10-01', '2019-10-16', 5, 'Сдан в установленный срок'),
(5, 5, 'Закупка товаров ИП', '2019-10-28', '2019-10-31', 2, 'Договор у заказчика на рассмотрении'),
(6, 1, 'Объект ЧУП', '2019-10-01', '2019-10-01', 6, 'Заказчик отказался'),
(8, 2, 'test chup', '2019-10-29', '2019-10-31', 1, 'test');

-- --------------------------------------------------------

--
-- Структура таблицы `object_file`
--

CREATE TABLE `object_file` (
  `id` int(11) NOT NULL COMMENT '№',
  `id_objects` int(11) NOT NULL,
  `tmp_name_file` varchar(300) NOT NULL,
  `name_file` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `status_objects`
--

CREATE TABLE `status_objects` (
  `id` int(11) NOT NULL,
  `status_objects` varchar(100) NOT NULL COMMENT 'Состояние объекта'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status_objects`
--

INSERT INTO `status_objects` (`id`, `status_objects`) VALUES
(1, 'Переговоры'),
(2, 'Заключение договора'),
(3, 'Строительство объекта'),
(4, 'Сдача объекта'),
(5, 'Объект сдан'),
(6, 'Закупка отменена');

-- --------------------------------------------------------

--
-- Структура таблицы `workers`
--

CREATE TABLE `workers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'Имя',
  `surname` varchar(50) NOT NULL COMMENT 'Фамилия',
  `login` varchar(10) NOT NULL COMMENT 'Логин',
  `password` varchar(10) NOT NULL COMMENT 'Пароль',
  `group_workers` int(10) NOT NULL COMMENT 'Отдел / Группа'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `workers`
--

INSERT INTO `workers` (`id`, `name`, `surname`, `login`, `password`, `group_workers`) VALUES
(6, 'Алексей', 'Алексеев', 'alex', '123', 1),
(8, 'Вова', 'Вовин', 'vov', '123', 2),
(9, 'vova', 'vova', 'vova', 'vova', 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `сustumer_UNP` (`сustomer_UNP`);

--
-- Индексы таблицы `group_workers`
--
ALTER TABLE `group_workers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `objects`
--
ALTER TABLE `objects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `status_objects` (`status_objects`);

--
-- Индексы таблицы `object_file`
--
ALTER TABLE `object_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_objects` (`id_objects`);

--
-- Индексы таблицы `status_objects`
--
ALTER TABLE `status_objects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_workers` (`group_workers`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '№', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `group_workers`
--
ALTER TABLE `group_workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `objects`
--
ALTER TABLE `objects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '№', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `object_file`
--
ALTER TABLE `object_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '№', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `status_objects`
--
ALTER TABLE `status_objects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `objects`
--
ALTER TABLE `objects`
  ADD CONSTRAINT `objects_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `objects_ibfk_2` FOREIGN KEY (`status_objects`) REFERENCES `status_objects` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `object_file`
--
ALTER TABLE `object_file`
  ADD CONSTRAINT `object_file_ibfk_1` FOREIGN KEY (`id_objects`) REFERENCES `objects` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `workers`
--
ALTER TABLE `workers`
  ADD CONSTRAINT `workers_ibfk_1` FOREIGN KEY (`group_workers`) REFERENCES `group_workers` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
