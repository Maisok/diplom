-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Май 27 2025 г., 04:30
-- Версия сервера: 10.9.3-MariaDB-1:10.9.3+maria~ubu2204
-- Версия PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `21039_diplom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `body_types`
--

CREATE TABLE `body_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `body_types`
--

INSERT INTO `body_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Седан', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(2, 'Хэтчбек', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(3, 'Универсал', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(4, 'Купе', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(5, 'Кабриолет', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(6, 'Внедорожник', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(7, 'Кроссовер', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(8, 'Минивэн', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(9, 'Пикап', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(10, 'Фургон', '2025-05-26 09:29:34', '2025-05-26 09:29:34');

-- --------------------------------------------------------

--
-- Структура таблицы `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `appointment_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('pending','confirmed','rejected','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `manager_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `car_id`, `booking_date`, `appointment_date`, `status`, `manager_comment`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2025-05-27 04:07:40', '2025-05-28 00:00:00', 'pending', NULL, '2025-05-27 04:07:40', '2025-05-27 04:11:46');

-- --------------------------------------------------------

--
-- Структура таблицы `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `branches`
--

INSERT INTO `branches` (`id`, `name`, `address`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Форвард Авто Интерлайн', 'Иркутск, улица Ленина, 5А', 'branches/7H3IxkLd0oLqbBIbQcnDDToiJNAOWzjcIl9zfAHv.jpg', '2025-05-26 09:37:24', '2025-05-26 09:37:24'),
(2, 'Форвард Авто на Трактовой', 'Иркутск, Трактовая улица, 22А', 'branches/dAfUz8b7vZXz23yKZv4lO9I9ZAbcPnEDiT5pAocj.jpg', '2025-05-26 09:38:16', '2025-05-26 09:38:16'),
(3, 'Форвард Авто в Новоленино', 'Иркутск, улица Ярославского, 302', 'branches/ah3ApSadu3qkuwSrtXggDfeLv0kUZvrV01l649pO.jpg', '2025-05-26 09:38:37', '2025-05-26 09:38:37');

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id`, `name`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'BMW', 'brands/wkzJEiY065qRnNr0sps4MBqDMT4XhEPyuQkI3c4O.png', '2025-05-26 09:38:59', '2025-05-26 09:38:59'),
(5, 'Cadillac', 'brands/x3bB5X16zbnnu8TwXLFsSSuPNl0kncwJ3inkMZqt.png', '2025-05-26 09:43:49', '2025-05-26 09:43:49'),
(6, 'Toyota', 'brands/RQdtMLQfi4eOSlb86RND2NVWOpHYev53OakaJxC4.png', '2025-05-26 09:44:14', '2025-05-26 09:44:14'),
(7, 'Porsche', 'brands/wYzErQ6HdBfGiPpcwgOtzR3kHE4K1mEnLCuqku9n.png', '2025-05-26 09:45:01', '2025-05-26 09:45:01'),
(8, 'Nissan', 'brands/F4M1iL1RnVmv0pa9uJQFICIZMeKtNBRkWYCm2bDS.png', '2025-05-26 09:45:46', '2025-05-26 09:45:46');

-- --------------------------------------------------------

--
-- Структура таблицы `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1748318834),
('laravel_cache_356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1748318834;', 1748318834);

-- --------------------------------------------------------

--
-- Структура таблицы `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment_id` bigint(20) UNSIGNED NOT NULL,
  `vin` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mileage` int(11) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_sold` tinyint(1) NOT NULL DEFAULT 0,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `custom_color_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_color_hex` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `cars`
--

INSERT INTO `cars` (`id`, `equipment_id`, `vin`, `mileage`, `price`, `description`, `is_sold`, `branch_id`, `color_id`, `custom_color_name`, `custom_color_hex`, `created_at`, `updated_at`) VALUES
(1, 1, 'WVGZZZCAZJC111111', 19000, '9350000.00', 'Как эксплуатировался\r\n• Подтвержденный пробег 19 456км\r\n• Заводской окрас\r\n• Без аварий\r\n• Только летняя эксплуатация\r\n\r\nКак обслуживали\r\n• Авто в состоянии нового\r\n• Вce планoвыe ТO провели у дилера с применением качественных расходников\r\n• Пpoизвeдeнa пpедпродажнaя подгoтовка: химчиcткa/пoлиpовкa/замена жидкоcтeй\r\n\r\nЧто с документами\r\n• Владельцы – физические лица\r\n• ПТС электронный\r\n• Сервисная книжка в наличии\r\n• Транспортное средство без обременений и ограничений на регистрационные действия\r\n• Возможна любая форма продажи и оплаты\r\n\r\nЧем подтвердим\r\n• Организуем бесплатный подъемник\r\n• Предоставим лист диагностики систем автомобиля\r\n• Покажем отчет по истории его эксплуатации', 0, 1, 1, NULL, NULL, '2025-05-26 09:58:06', '2025-05-26 09:58:06'),
(2, 2, 'WVGZZZCAZJC222222', 13250, '8250000.00', 'Как эксплуатировался\r\n• Подтвержденный пробег 19 456км\r\n• Заводской окрас\r\n• Без аварий\r\n• Только летняя эксплуатация\r\n\r\nКак обслуживали\r\n• Авто в состоянии нового\r\n• Вce планoвыe ТO провели у дилера с применением качественных расходников\r\n• Пpoизвeдeнa пpедпродажнaя подгoтовка: химчиcткa/пoлиpовкa/замена жидкоcтeй\r\n\r\nЧто с документами\r\n• Владельцы – физические лица\r\n• ПТС электронный\r\n• Сервисная книжка в наличии\r\n• Транспортное средство без обременений и ограничений на регистрационные действия\r\n• Возможна любая форма продажи и оплаты\r\n\r\nЧем подтвердим\r\n• Организуем бесплатный подъемник\r\n• Предоставим лист диагностики систем автомобиля\r\n• Покажем отчет по истории его эксплуатации', 0, 2, 4, NULL, NULL, '2025-05-26 10:07:54', '2025-05-27 04:11:46'),
(3, 3, 'WVGZZZCAZJC333333', 3000, '12000000.00', 'Как эксплуатировался\r\n• Подтвержденный пробег 19 456км\r\n• Заводской окрас\r\n• Без аварий\r\n• Только летняя эксплуатация\r\n\r\nКак обслуживали\r\n• Авто в состоянии нового\r\n• Вce планoвыe ТO провели у дилера с применением качественных расходников\r\n• Пpoизвeдeнa пpедпродажнaя подгoтовка: химчиcткa/пoлиpовкa/замена жидкоcтeй\r\n\r\nЧто с документами\r\n• Владельцы – физические лица\r\n• ПТС электронный\r\n• Сервисная книжка в наличии\r\n• Транспортное средство без обременений и ограничений на регистрационные действия\r\n• Возможна любая форма продажи и оплаты\r\n\r\nЧем подтвердим\r\n• Организуем бесплатный подъемник\r\n• Предоставим лист диагностики систем автомобиля\r\n• Покажем отчет по истории его эксплуатации', 0, 3, 5, NULL, NULL, '2025-05-26 10:17:13', '2025-05-26 10:17:30'),
(4, 4, 'WVGZZZCAZJC555555', 3900, '4890000.00', 'Как эксплуатировался\r\n• Подтвержденный пробег 19 456км\r\n• Заводской окрас\r\n• Без аварий\r\n• Только летняя эксплуатация\r\n\r\nКак обслуживали\r\n• Авто в состоянии нового\r\n• Вce планoвыe ТO провели у дилера с применением качественных расходников\r\n• Пpoизвeдeнa пpедпродажнaя подгoтовка: химчиcткa/пoлиpовкa/замена жидкоcтeй\r\n\r\nЧто с документами\r\n• Владельцы – физические лица\r\n• ПТС электронный\r\n• Сервисная книжка в наличии\r\n• Транспортное средство без обременений и ограничений на регистрационные действия\r\n• Возможна любая форма продажи и оплаты\r\n\r\nЧем подтвердим\r\n• Организуем бесплатный подъемник\r\n• Предоставим лист диагностики систем автомобиля\r\n• Покажем отчет по истории его эксплуатации', 0, 1, 6, NULL, NULL, '2025-05-26 10:24:18', '2025-05-26 10:24:31'),
(5, 5, 'WVGZZZCAZJC777777', 25000, '447000.00', '29.03.2025 заменены все масла и фильтры.\r\n2020 модельный год.\r\nМаксимальная комплектация с музыкой Bose.\r\nОпция Sport Package:\r\n- закрытый дифференциал;\r\n- усиленная тормозная система;\r\n- разноширокие кованные диски.\r\nРезина новая.\r\nВ очень ухоженном и боевом состоянии.\r\nУчёт РФ.', 0, 2, 6, NULL, NULL, '2025-05-26 10:33:12', '2025-05-26 10:33:12'),
(6, 7, 'WVGZZZCAZJC999999', 12000, '7000000.00', 'BMW X7 xDrive40i M Sport Pro LCI\r\nКузов: M Серый Бруклин\r\nСалон: Слоновая Кость, BMW Individual расширенная отделка кожей Merino', 0, 2, 4, NULL, NULL, '2025-05-27 04:29:45', '2025-05-27 04:29:45');

-- --------------------------------------------------------

--
-- Структура таблицы `car_images`
--

CREATE TABLE `car_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `car_images`
--

INSERT INTO `car_images` (`id`, `car_id`, `path`, `is_main`, `created_at`, `updated_at`) VALUES
(1, 1, 'cars/YCQQ0qMrLBeZcjbgW4g4Zo8Yt6U4LR1PDe4y6kc1.webp', 1, '2025-05-26 09:58:06', '2025-05-26 09:58:06'),
(2, 1, 'cars/s9DvOgSQrm1MfemERLfmVzoslvzyHNwSvht4zrY9.webp', 0, '2025-05-26 09:58:06', '2025-05-26 09:58:06'),
(3, 1, 'cars/FjA7NtFMI936RRcem0JySd8OjRcXSFILT4UL838O.webp', 0, '2025-05-26 09:58:06', '2025-05-26 09:58:06'),
(4, 1, 'cars/igsEGCHsP11cceLDVKyTnBSvumZ2jdIQ3dkc0qcp.webp', 0, '2025-05-26 09:58:06', '2025-05-26 09:58:06'),
(5, 1, 'cars/DywL4CBzmTScMzMsBoTEYRQn7TIsKHJDjJohFIbI.webp', 0, '2025-05-26 09:58:06', '2025-05-26 09:58:06'),
(6, 1, 'cars/HDH8eTc5pRPvtf0ZfX1mf5HlsysdQbVQUUDWLwiX.webp', 0, '2025-05-26 09:58:06', '2025-05-26 09:58:06'),
(7, 1, 'cars/arYkPPhcX7th6xaNvx9Mx691jEOk0qVN5eNMKZ7O.webp', 0, '2025-05-26 09:58:06', '2025-05-26 09:58:06'),
(8, 1, 'cars/m2ahCNZzTFJj5yScond3LhhnTf1ze2IajpvMbXnb.webp', 0, '2025-05-26 09:58:06', '2025-05-26 09:58:06'),
(9, 1, 'cars/2WerPwINsRMNXZkmKlRcm2gEhMauxw8paG2ZsiRz.webp', 0, '2025-05-26 09:58:06', '2025-05-26 09:58:06'),
(10, 1, 'cars/SIIpkdzRq3Px80Yhr4RHXGSE09btX8asiNFprfpX.webp', 0, '2025-05-26 09:58:06', '2025-05-26 09:58:06'),
(11, 1, 'cars/RC9cFYkYUN9K3uiCbY033gALyPmGwjge495LuY8F.webp', 0, '2025-05-26 09:58:06', '2025-05-26 09:58:06'),
(12, 1, 'cars/DfOWNbSdDgq3lxDu60YIGf597IgIbSSIa6F8REGG.webp', 0, '2025-05-26 09:58:06', '2025-05-26 09:58:06'),
(13, 2, 'cars/v3ZYcxItuLbGDHGH9jXSqQosAZDyhsvyP1css2ag.webp', 0, '2025-05-26 10:07:54', '2025-05-26 10:08:52'),
(14, 2, 'cars/IBJKFQAg19rElS46AHeNRSFOLA2OWKAi1tL3KGML.webp', 0, '2025-05-26 10:07:54', '2025-05-26 10:08:52'),
(15, 2, 'cars/2esKTMd9rs4Ps8krnBoOQNdUjsIj5CqiviqOv7fB.webp', 0, '2025-05-26 10:07:54', '2025-05-26 10:08:52'),
(16, 2, 'cars/YGPcCQi9Db3ua0GAxE4NnK0Z026RoLJYsYViW4pt.webp', 0, '2025-05-26 10:07:54', '2025-05-26 10:08:52'),
(17, 2, 'cars/JAAl06F1OnHLVub65Hs9dbs9PiqKmGZPVy7zUiDa.webp', 0, '2025-05-26 10:07:54', '2025-05-26 10:08:52'),
(18, 2, 'cars/hkNH886PCaJ9ktXD1GySh7IPeeo4aUksAQgzpS7f.webp', 1, '2025-05-26 10:07:54', '2025-05-26 10:08:52'),
(19, 2, 'cars/KFp3dIiJvGfN5lSJHu6Jb8yHTZi35iwdGbJf9AcK.webp', 0, '2025-05-26 10:07:54', '2025-05-26 10:08:52'),
(20, 2, 'cars/t2BJkDa1Upa69JUAYwK8JDlY3KVz9nJjwcnkrdxw.webp', 0, '2025-05-26 10:07:54', '2025-05-26 10:08:52'),
(21, 2, 'cars/5qA6hL7d9c8XoVEFBBdNtwLKC8cndYUrIsYjcSGi.webp', 0, '2025-05-26 10:07:54', '2025-05-26 10:08:52'),
(22, 3, 'cars/JK1snPDA4oQDhFGjSiqazxqfmofcvyPZUYMAoNBv.webp', 1, '2025-05-26 10:17:13', '2025-05-26 10:17:30'),
(23, 3, 'cars/gjpcENrVw9EuU47FT5KY49HN0SgtrJaPhYu8B9nD.webp', 0, '2025-05-26 10:17:13', '2025-05-26 10:17:30'),
(24, 3, 'cars/yjbh97amSEoZ7vDI6q4V1SFQFsSeMvtBAsjapdA0.webp', 0, '2025-05-26 10:17:13', '2025-05-26 10:17:30'),
(25, 3, 'cars/bInkyobJqgs5yjBYsNombuByK5Qzxf4RPtwvR9SU.webp', 0, '2025-05-26 10:17:13', '2025-05-26 10:17:30'),
(26, 3, 'cars/tIdEucdQlbrMqdqqHS9EuxO4Xy3xxqyOmgKjRUd1.webp', 0, '2025-05-26 10:17:13', '2025-05-26 10:17:30'),
(27, 3, 'cars/DXwmcamUlH1wBrbuLnvIHc61n3dprs28OTTuRYh6.webp', 0, '2025-05-26 10:17:13', '2025-05-26 10:17:30'),
(28, 3, 'cars/KKhpE6lOjUjNVhc8czlYFkkxplbeR3FRlU8fsZNX.webp', 0, '2025-05-26 10:17:13', '2025-05-26 10:17:30'),
(29, 3, 'cars/tLB2hZwYGzSFaVxwtQSvyaLQzbhWKWmhs5eLhjh1.webp', 0, '2025-05-26 10:17:13', '2025-05-26 10:17:30'),
(30, 3, 'cars/h7V4Rf5NSI1pajR07KYdq3LccmGsTlZZgwCM0qCP.webp', 0, '2025-05-26 10:17:13', '2025-05-26 10:17:30'),
(31, 3, 'cars/Rl5aer9H3YniaMteIsVqhvcC2S6iuTUWVRDjSjoS.webp', 0, '2025-05-26 10:17:13', '2025-05-26 10:17:30'),
(32, 3, 'cars/oHddQej2KZtDIimNY2VgKigBpgvo9cJemxRcVSJ9.webp', 0, '2025-05-26 10:17:13', '2025-05-26 10:17:30'),
(33, 3, 'cars/KpwY7vMkkVKoyiHBEd0A2vtQopwDYjDy4dfdWlCW.webp', 0, '2025-05-26 10:17:13', '2025-05-26 10:17:30'),
(34, 3, 'cars/7nqEqEcCxXsBr8YG5gJuNl5Lwe2dU13v8ztIevxJ.webp', 0, '2025-05-26 10:17:13', '2025-05-26 10:17:30'),
(35, 4, 'cars/JYGA7yoee2DiIwS3uXmBXHgBHJJSuOU9kAjk16R2.webp', 1, '2025-05-26 10:24:18', '2025-05-26 10:24:31'),
(36, 4, 'cars/IjrMEdisuQbQnhqwKExJBB4uDEqGoTKrGGmFi0GB.webp', 0, '2025-05-26 10:24:18', '2025-05-26 10:24:31'),
(37, 4, 'cars/hFQd56h1BaEne2rfWDmfFzJvn52ZcHD8gh6XUMvg.webp', 0, '2025-05-26 10:24:18', '2025-05-26 10:24:31'),
(38, 4, 'cars/33WEJaKsY0RSFfVYd7hyal4tIP8Duoc6LDU0fKFC.webp', 0, '2025-05-26 10:24:18', '2025-05-26 10:24:31'),
(39, 4, 'cars/7jghISIwepH4l74Nuu31Rx87IM1g7F8ECQBV7vOD.webp', 0, '2025-05-26 10:24:18', '2025-05-26 10:24:31'),
(40, 4, 'cars/gnFs5UgZdk1sTrBVhJmt01xSmz9E2bXIbbnb5SDD.webp', 0, '2025-05-26 10:24:18', '2025-05-26 10:24:31'),
(41, 4, 'cars/i8Xqo6qa1n7uiSxkBBCOcGmyUScWaOpwgfzDY5Sm.webp', 0, '2025-05-26 10:24:18', '2025-05-26 10:24:31'),
(42, 4, 'cars/T5jHiU0sStSdwPmeBiDpdmbIOf9MK8MNmCm7xmZ0.webp', 0, '2025-05-26 10:24:18', '2025-05-26 10:24:31'),
(43, 4, 'cars/dqHDvON9Lvr9bh5CgBPAmOhLCD856JonPnmK5tzY.webp', 0, '2025-05-26 10:24:18', '2025-05-26 10:24:31'),
(44, 4, 'cars/pwVO8xkijtIofPrhkPbNCo3b2Aa1ArcIFPLz8yug.webp', 0, '2025-05-26 10:24:18', '2025-05-26 10:24:31'),
(45, 4, 'cars/iZL9KKKZqKeYUuiVvrM6a4szMCeudTiJgPM9CUqG.webp', 0, '2025-05-26 10:24:18', '2025-05-26 10:24:31'),
(46, 4, 'cars/GD1tGwrUHYvF8qyZ6ApECdX5yC8JFMeYVTqodLh5.webp', 0, '2025-05-26 10:24:18', '2025-05-26 10:24:31'),
(47, 5, 'cars/68fjxLjTq3HYB71Xjtuy1YY2gnnOdsJVAkNMyanU.webp', 1, '2025-05-26 10:33:12', '2025-05-26 10:33:12'),
(48, 5, 'cars/fFSmERnnhWPVKIFZb5iTEUm2tjASUobFvf3i0ra4.webp', 0, '2025-05-26 10:33:12', '2025-05-26 10:33:12'),
(49, 5, 'cars/xGIu5GgbhffTuYasWwOAJtE7amrkAZOomP3ZotnT.webp', 0, '2025-05-26 10:33:12', '2025-05-26 10:33:12'),
(50, 5, 'cars/gqa2sattBudxRFgHqK665SxTd9ip1PPRlNiyPLQY.webp', 0, '2025-05-26 10:33:12', '2025-05-26 10:33:12'),
(51, 5, 'cars/YhmwAP9C2MTSqx9CcYGHLVilxijP7N5JWaWUcTAI.webp', 0, '2025-05-26 10:33:12', '2025-05-26 10:33:12'),
(52, 5, 'cars/u5Cf7rjYYXMolY5OmkAUsOYSZlpGNMXokPrRobrP.webp', 0, '2025-05-26 10:33:12', '2025-05-26 10:33:12'),
(53, 5, 'cars/ve4KYXCtNQXIUyoce9fd4jzeX6XrlTgDb492d6Ep.webp', 0, '2025-05-26 10:33:12', '2025-05-26 10:33:12'),
(54, 5, 'cars/ZILeB8HqLaVKm7JCnwQFjEdjoJfeNn3HJtDFrAMa.webp', 0, '2025-05-26 10:33:12', '2025-05-26 10:33:12'),
(55, 5, 'cars/yqrvfWuUprFHPD8WkWGOuZGJJnt33gIuLrwAf3rB.webp', 0, '2025-05-26 10:33:12', '2025-05-26 10:33:12'),
(56, 6, 'cars/g3vkitcCLmezpsk31HqYIv3dQ7xF5v1yM7HcQt6E.jpg', 1, '2025-05-27 04:29:45', '2025-05-27 04:29:45'),
(57, 6, 'cars/H6suYRlut5IgEfz3Bn4e7CEeBjOfF8EL7OAI6oxR.jpg', 0, '2025-05-27 04:29:45', '2025-05-27 04:29:45'),
(58, 6, 'cars/OoatJ8goGvOpkCJ6WHIq2Z0OHNF2YgwHyfIo0Dae.jpg', 0, '2025-05-27 04:29:45', '2025-05-27 04:29:45'),
(59, 6, 'cars/BAGls6cBKD30ImmGGUG4CAadU6dAPKwuiJIpknbD.jpg', 0, '2025-05-27 04:29:45', '2025-05-27 04:29:45'),
(60, 6, 'cars/6gidQamoQvYmiUkb7itQfWdN0jpBa5U3dy61HMxh.jpg', 0, '2025-05-27 04:29:45', '2025-05-27 04:29:45'),
(61, 6, 'cars/Ymztk5aAvDdg9WUIDpWBDgGVkvJUdZ62dHtkdd9K.jpg', 0, '2025-05-27 04:29:45', '2025-05-27 04:29:45'),
(62, 6, 'cars/6vX1ERyRhqTx5HhLfOiGw5OoGYeMVqtuvcRwp6Uh.jpg', 0, '2025-05-27 04:29:45', '2025-05-27 04:29:45'),
(63, 6, 'cars/RVhLczYJOITqiEKbG6atvaNm7cmxjWN48rzGnVa6.jpg', 0, '2025-05-27 04:29:45', '2025-05-27 04:29:45'),
(64, 6, 'cars/CiQtMQKmSeOdx58gQAl19l80nWCPc6vaT7TXt76V.jpg', 0, '2025-05-27 04:29:45', '2025-05-27 04:29:45'),
(65, 6, 'cars/cpMJ2oGxOFoA1sLeKK6156a6MAcYCPYjLDLj85zH.jpg', 0, '2025-05-27 04:29:45', '2025-05-27 04:29:45');

-- --------------------------------------------------------

--
-- Структура таблицы `car_models`
--

CREATE TABLE `car_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `car_models`
--

INSERT INTO `car_models` (`id`, `brand_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'M4', '2025-05-26 09:39:36', '2025-05-26 09:41:18'),
(2, 5, 'Blackwing', '2025-05-26 09:59:28', '2025-05-26 09:59:28'),
(3, 7, '911 Carrera', '2025-05-26 10:09:25', '2025-05-26 10:09:32'),
(4, 6, 'Supra', '2025-05-26 10:18:26', '2025-05-26 10:18:26'),
(5, 8, '370z', '2025-05-26 10:25:45', '2025-05-26 10:25:45'),
(6, 1, 'X7', '2025-05-27 04:18:37', '2025-05-27 04:18:37');

-- --------------------------------------------------------

--
-- Структура таблицы `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hex_code` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `colors`
--

INSERT INTO `colors` (`id`, `name`, `hex_code`, `created_at`, `updated_at`) VALUES
(1, 'Красный торонто', '#ee1d19', '2025-05-26 09:53:40', '2025-05-26 09:53:40'),
(2, 'Синий танзанит', '#0000CC', '2025-05-26 09:53:40', '2025-05-26 09:53:40'),
(3, 'Морозный черный', '#040001', '2025-05-26 09:53:40', '2025-05-26 09:53:40'),
(4, 'Черный', '#000000', '2025-05-26 10:06:34', '2025-05-26 10:06:34'),
(5, 'Agate grey', '#200204', '2025-05-26 10:15:31', '2025-05-26 10:15:31'),
(6, 'Белый', '#FFFFFF', '2025-05-26 10:22:33', '2025-05-26 10:22:33');

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'Россия', 'RU', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(2, 'Германия', 'DE', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(3, 'Япония', 'JP', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(4, 'США', 'US', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(5, 'Китай', 'CN', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(6, 'Корея', 'KR', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(7, 'Франция', 'FR', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(8, 'Италия', 'IT', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(9, 'Великобритания', 'GB', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(10, 'Швеция', 'SE', '2025-05-26 09:29:34', '2025-05-26 09:29:34');

-- --------------------------------------------------------

--
-- Структура таблицы `drive_types`
--

CREATE TABLE `drive_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `drive_types`
--

INSERT INTO `drive_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Передний', '2025-05-26 09:29:35', '2025-05-26 09:29:35'),
(2, 'Задний', '2025-05-26 09:29:35', '2025-05-26 09:29:35'),
(3, 'Полный', '2025-05-26 09:29:35', '2025-05-26 09:29:35');

-- --------------------------------------------------------

--
-- Структура таблицы `engine_types`
--

CREATE TABLE `engine_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `engine_types`
--

INSERT INTO `engine_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Бензиновый', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(2, 'Дизельный', '2025-05-26 09:29:34', '2025-05-26 09:29:34'),
(3, 'Электрический', '2025-05-26 09:29:35', '2025-05-26 09:29:35'),
(4, 'Гибридный', '2025-05-26 09:29:35', '2025-05-26 09:29:35');

-- --------------------------------------------------------

--
-- Структура таблицы `equipment`
--

CREATE TABLE `equipment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `generation_id` bigint(20) UNSIGNED NOT NULL,
  `body_type_id` bigint(20) UNSIGNED NOT NULL,
  `engine_type_id` bigint(20) UNSIGNED NOT NULL,
  `engine_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engine_volume` decimal(3,1) NOT NULL,
  `engine_power` int(11) NOT NULL,
  `transmission_type_id` bigint(20) UNSIGNED NOT NULL,
  `transmission_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `drive_type_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` decimal(6,1) NOT NULL,
  `load_capacity` int(11) DEFAULT NULL,
  `seats` int(11) NOT NULL,
  `fuel_consumption` decimal(4,1) NOT NULL,
  `fuel_tank_volume` int(11) DEFAULT NULL,
  `battery_capacity` int(11) DEFAULT NULL,
  `range` int(11) NOT NULL,
  `max_speed` int(11) NOT NULL,
  `clearance` int(11) NOT NULL,
  `model_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `equipment`
--

INSERT INTO `equipment` (`id`, `generation_id`, `body_type_id`, `engine_type_id`, `engine_name`, `engine_volume`, `engine_power`, `transmission_type_id`, `transmission_name`, `drive_type_id`, `country_id`, `description`, `weight`, `load_capacity`, `seats`, `fuel_consumption`, `fuel_tank_volume`, `battery_capacity`, `range`, `max_speed`, `clearance`, `model_path`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'S58B30', '3.0', 510, 2, 'M DCT', 1, 2, 'Стильный и мощный BMW M4 G82 — это идеальное сочетание спортивного характера и элегантного дизайна. Агрессивные линии кузова, фирменная решетка радиатора с двойными спицами и выразительная оптика придают ему индивидуальности. Под капотом — турбомотор M серии, обеспечивающий молниеносную динамику и захватывающий звук. Точное руление, идеально настроенная подвеска и высококачественный салон с элементами углеволокна создают абсолютный контроль и комфорт. BMW M4 G82 — не просто автомобиль, а воплощение скорости, технологий и страсти к вождению.', '1500.0', 300, 4, '10.2', 70, NULL, 500, 250, 100, '3d_models/equipment_1', '2025-05-26 09:53:40', '2025-05-26 09:53:40'),
(2, 2, 1, 1, 'LGY', '3.0', 365, 2, 'CT5 V Series PERFORMANCE', 3, 4, 'Cadillac CT5-V — это мощь американской инженерии в облике роскошного спортседана. Яркий, агрессивный дизайн с широкими воздухозаборниками и фирменными светодиодными фарами привлекает внимание с первого взгляда. Под капотом — турбированный V6 с компрессором, развивающий более 360 л.с., обеспечивающий впечатляющий разгон и уверенную динамику. Система электронного полного привода, спортивная подвеска и персонализируемые режимы вождения делают каждую поездку захватывающей. В салоне — кожаная отделка, технологичный интерфейс и продвинутый аудиосистема Bose. CT5-V сочетает комфорт люкс-класса и характер настоящего спорткара.', '1700.0', 500, 4, '12.0', 70, NULL, 500, 270, 130, '3d_models/equipment_2', '2025-05-26 10:06:34', '2025-05-26 10:06:34'),
(3, 3, 4, 1, 'MDK.KA', '3.0', 450, 1, 'PDK', 3, 2, 'Porsche 911 Carrera 4S — легенда спортивного автомобилестроения, сочетающая безупречный стиль, передовые технологии и впечатляющую динамику. Харизматичный дизайн с фирменными круглыми фарами, широкими арками и рельефным кузовом подчеркивает её спортивный характер. Под капотом — турбированный оппозитный двигатель, обеспечивающий молниеносный разгон и точность управления. Полный привод, адаптивная подвеска и идеально сбалансированное шасси гарантируют уверенность в любом повороте. Роскошный, технологичный салон с высококачественными материалами создаёт комфорт на высшем уровне. 911 Carrera 4S — не просто автомобиль, а символ стиля, мощи и любви к скорости.', '1500.0', 600, 2, '9.0', 60, NULL, 500, 250, 120, '3d_models/equipment_3', '2025-05-26 10:15:31', '2025-05-26 10:15:31'),
(4, 4, 4, 1, 'B58B30', '3.0', 340, 2, 'ZF', 2, 3, 'Toyota Supra V (A90) — воплощение японской прецизионности и спортивного духа. Стильный, низкий силуэт с плавными линиями и агрессивным передком выделяет её среди конкурентов. Под капотом — рядный турбомотор BMW B58, обеспечивающий мощность до 340 л.с., впечатляющий разгон и чуткую реакцию на каждое движение педали. Точное руление, идеально настроенная подвеска и легкий вес делают управление по-настоящему удовольствием. В салоне — минималистичный дизайн, качественные материалы и современная электроника. Toyota Supra A90 — не просто спорткар, а настоящий гимн скорости и гармонии технологий.', '1500.0', 500, 2, '9.0', 65, NULL, 300, 230, 120, '3d_models/equipment_4', '2025-05-26 10:22:33', '2025-05-26 10:22:33'),
(5, 5, 4, 1, 'VQ37HR', '2.0', 331, 2, 'qs220', 2, 3, 'Nissan 370Z I Рестайлинг — яркий представитель японского спортивного стиля, сочетающий динамичный дизайн и истинное удовольствие от вождения. Обновлённый экстерьер с рельефным кузовом, выразительной оптикой и аэродинамическими элементами придаёт ему ещё больше агрессии и современности. Под капотом — проверенный временем V6 двигатель мощностью 330 л.с., развивающий высокую скорость и насыщенный звук. Точная шестиступенчатая механика, улучшенная подвеска и низкий центр тяжести обеспечивают отличную управляемость. В салоне — спорткар ориентирован на водителя: удобные кресла, качественные материалы и минималистичный интерфейс. Nissan 370Z — это автомобиль для тех, кто живёт скоростью и любит каждое мгновение за рулём.', '1500.0', 500, 5, '8.0', 34, NULL, 500, 250, 120, '3d_models/equipment_5', '2025-05-26 10:32:20', '2025-05-26 10:32:20'),
(7, 6, 6, 1, 'S63B44 TU2', '4.4', 550, 1, 'Steptronic BMW X7', 1, 2, 'BMW X7 — флагманский кроссовер, сочетающий роскошь, технологичность и внушительный внешний вид. Его величественный силуэт с крупной решеткой радиатора, эффектными светодиодными фарами и массивными колесными арками придает образу уверенность и престиж. Просторный салон отделан высококачественными материалами, снабжен передовыми системами комфорта и мультимедиа, обеспечивая максимальное удовольствие от поездки для водителя и пассажиров. Мощные двигатели, полный привод и адаптивная подвеска гарантируют уверенное поведение на дороге и комфорт в любом путешествии. BMW X7 — это не просто автомобиль, а символ статуса и безупречного вкуса.', '1800.0', 700, 7, '10.0', 80, NULL, 500, 250, 180, NULL, '2025-05-27 04:25:18', '2025-05-27 04:25:18');

-- --------------------------------------------------------

--
-- Структура таблицы `equipment_colors`
--

CREATE TABLE `equipment_colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `equipment_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `equipment_colors`
--

INSERT INTO `equipment_colors` (`id`, `equipment_id`, `color_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 2, 4, NULL, NULL),
(5, 3, 5, NULL, NULL),
(6, 4, 6, NULL, NULL),
(7, 5, 6, NULL, NULL),
(8, 7, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `favorite_equipments`
--

CREATE TABLE `favorite_equipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `equipment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `favorite_equipments`
--

INSERT INTO `favorite_equipments` (`id`, `user_id`, `equipment_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '2025-05-27 04:07:00', '2025-05-27 04:07:00'),
(2, 1, 2, '2025-05-27 04:07:36', '2025-05-27 04:07:36');

-- --------------------------------------------------------

--
-- Структура таблицы `generations`
--

CREATE TABLE `generations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `car_model_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_from` year(4) NOT NULL,
  `year_to` year(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `generations`
--

INSERT INTO `generations` (`id`, `car_model_id`, `name`, `year_from`, `year_to`, `created_at`, `updated_at`) VALUES
(1, 1, 'G82', 2020, 2024, '2025-05-26 09:40:11', '2025-05-26 09:55:47'),
(2, 2, 'I Рестайлинг', 2024, 2025, '2025-05-26 10:03:13', '2025-05-26 10:03:13'),
(3, 3, 'VIII (992)', 2018, 2024, '2025-05-26 10:09:59', '2025-05-26 10:10:05'),
(4, 4, 'V (A90)', 2019, 2026, '2025-05-26 10:19:52', '2025-05-26 10:19:52'),
(5, 5, 'I Рестайлинг', 2012, 2020, '2025-05-26 10:27:58', '2025-05-26 10:28:30'),
(6, 6, 'I (G07)', 2019, 2022, '2025-05-27 04:19:35', '2025-05-27 04:20:08');

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_02_202758_create_brands_table', 1),
(5, '2025_05_02_202758_create_countries_table', 1),
(6, '2025_05_02_202759_create_body_types_table', 1),
(7, '2025_05_02_202759_create_car_models_table', 1),
(8, '2025_05_02_202759_create_generations_table', 1),
(9, '2025_05_02_202800_create_drive_types_table', 1),
(10, '2025_05_02_202800_create_engine_types_table', 1),
(11, '2025_05_02_202800_create_transmission_types_table', 1),
(12, '2025_05_02_202801_create_colors_table', 1),
(13, '2025_05_02_205006_create_equipment_table', 1),
(14, '2025_05_02_205255_create_equipment_colors_table', 1),
(15, '2025_05_03_111900_create_branches_table', 1),
(16, '2025_05_05_122932_create_cars_table', 1),
(17, '2025_05_05_123009_create_car_images_table', 1),
(18, '2025_05_10_195533_create_bookings_table', 1),
(19, '2025_05_11_095756_create_favorite_equipments_table', 1),
(20, '2025_05_11_095917_create_notifications_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `car_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `car_id`, `type`, `message`, `read_at`, `created_at`, `updated_at`, `url`) VALUES
(1, 1, 2, 'booking_confirmed', 'Ваше бронирование автомобиля Blackwing было подтверждено.', '2025-05-27 04:14:18', '2025-05-27 04:11:35', '2025-05-27 04:14:18', 'http://127.0.0.1:8001/bookings/1'),
(2, 1, 2, 'booking_pending', 'Ваше бронирование автомобиля Blackwing переведено в статус ожидания.', '2025-05-27 04:14:18', '2025-05-27 04:11:46', '2025-05-27 04:14:18', 'http://127.0.0.1:8001/bookings/1');

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2utSskmIPphR1za4Nm26xmzdnUKviGOYOxGjW9NT', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 YaBrowser/25.2.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZjNEUVhuUGgxODdyb2Jpc1ZnVXVHeWxxSXRPR1A4Z3BqRzYxWHl6byI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9ub3RpZmljYXRpb25zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1748319262),
('6iW9gTLGahUzxJkRGp9xbIsqBBVkxI4yP6ad6rz4', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVk02VWY3TGxJYU5UanplUHZNYnhlQW40Vm5qdzFRdlAxbk5hbzZHUSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vMTI3LjAuMC4xOjgwMDEvbm90aWZpY2F0aW9ucyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1748319250),
('KwabsNtmCkAAvKRuQTGwIlvMKhS3d0CpYonuRUUz', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZFBWMHhmcmlUTjJ5NGZHcUZSU2tFNExWb01BS2lzV1NVU1VQaWtiaCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9ub3RpZmljYXRpb25zIjt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1748320253);

-- --------------------------------------------------------

--
-- Структура таблицы `transmission_types`
--

CREATE TABLE `transmission_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `transmission_types`
--

INSERT INTO `transmission_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Механическая', '2025-05-26 09:29:35', '2025-05-26 09:29:35'),
(2, 'Автоматическая', '2025-05-26 09:29:35', '2025-05-26 09:29:35'),
(3, 'Роботизированная', '2025-05-26 09:29:35', '2025-05-26 09:29:35'),
(4, 'Вариатор', '2025-05-26 09:29:35', '2025-05-26 09:29:35');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('superadmin','admin','manager','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Кирилл', 'miasnikov2005@gmail.com', '8 111 111 11 11', '$2y$12$6hYvLmh/XP2AY6zZNyj13uVgYosaFSBB8FCYpwagwxflCRnhXbLB2', 'user', '2025-05-27 04:06:31', NULL, '2025-05-26 09:29:57', '2025-05-27 04:06:31'),
(2, 'Super_admin', 'super_admin@gmail.com', '8 222 222 22 22', '$2y$12$S7TWGMQTYL/hsk1F.kWT3umZRJrRdSuJ4qSo2fiOxRhF.f4UtHAhe', 'superadmin', NULL, NULL, '2025-05-26 09:30:29', '2025-05-26 09:30:29'),
(3, 'admin', 'admin@gmail.com', '8 333 333 33 33', '$2y$12$VVm0FJ1Gs0HPVO2EH8XzfOHZnP7t98E5lcDGlARRZBmcJhMW95Osa', 'admin', NULL, NULL, '2025-05-26 09:31:16', '2025-05-26 09:31:16'),
(4, 'manager', 'manager@gmail.com', '8 444 444 44 44', '$2y$12$JaXW6cumweR2DW5WUAtt6uKNjySS7AX8YUPNx5HFwCP5pd2f8M5HG', 'manager', NULL, NULL, '2025-05-26 09:33:31', '2025-05-26 09:33:31');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `body_types`
--
ALTER TABLE `body_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_car_id_status_index` (`car_id`,`status`);

--
-- Индексы таблицы `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Индексы таблицы `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Индексы таблицы `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cars_vin_unique` (`vin`),
  ADD KEY `cars_equipment_id_foreign` (`equipment_id`),
  ADD KEY `cars_branch_id_foreign` (`branch_id`),
  ADD KEY `cars_color_id_foreign` (`color_id`);

--
-- Индексы таблицы `car_images`
--
ALTER TABLE `car_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_images_car_id_foreign` (`car_id`);

--
-- Индексы таблицы `car_models`
--
ALTER TABLE `car_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_models_brand_id_foreign` (`brand_id`);

--
-- Индексы таблицы `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `drive_types`
--
ALTER TABLE `drive_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `engine_types`
--
ALTER TABLE `engine_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_generation_id_foreign` (`generation_id`),
  ADD KEY `equipment_body_type_id_foreign` (`body_type_id`),
  ADD KEY `equipment_engine_type_id_foreign` (`engine_type_id`),
  ADD KEY `equipment_transmission_type_id_foreign` (`transmission_type_id`),
  ADD KEY `equipment_drive_type_id_foreign` (`drive_type_id`),
  ADD KEY `equipment_country_id_foreign` (`country_id`);

--
-- Индексы таблицы `equipment_colors`
--
ALTER TABLE `equipment_colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_colors_equipment_id_foreign` (`equipment_id`),
  ADD KEY `equipment_colors_color_id_foreign` (`color_id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `favorite_equipments`
--
ALTER TABLE `favorite_equipments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `favorite_equipments_user_id_equipment_id_unique` (`user_id`,`equipment_id`),
  ADD KEY `favorite_equipments_equipment_id_foreign` (`equipment_id`);

--
-- Индексы таблицы `generations`
--
ALTER TABLE `generations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `generations_car_model_id_foreign` (`car_model_id`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Индексы таблицы `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_car_id_foreign` (`car_id`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Индексы таблицы `transmission_types`
--
ALTER TABLE `transmission_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `body_types`
--
ALTER TABLE `body_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `car_images`
--
ALTER TABLE `car_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT для таблицы `car_models`
--
ALTER TABLE `car_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `drive_types`
--
ALTER TABLE `drive_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `engine_types`
--
ALTER TABLE `engine_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `equipment_colors`
--
ALTER TABLE `equipment_colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `favorite_equipments`
--
ALTER TABLE `favorite_equipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `generations`
--
ALTER TABLE `generations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `transmission_types`
--
ALTER TABLE `transmission_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cars_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cars_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`);

--
-- Ограничения внешнего ключа таблицы `car_images`
--
ALTER TABLE `car_images`
  ADD CONSTRAINT `car_images_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `car_models`
--
ALTER TABLE `car_models`
  ADD CONSTRAINT `car_models_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `equipment_body_type_id_foreign` FOREIGN KEY (`body_type_id`) REFERENCES `body_types` (`id`),
  ADD CONSTRAINT `equipment_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  ADD CONSTRAINT `equipment_drive_type_id_foreign` FOREIGN KEY (`drive_type_id`) REFERENCES `drive_types` (`id`),
  ADD CONSTRAINT `equipment_engine_type_id_foreign` FOREIGN KEY (`engine_type_id`) REFERENCES `engine_types` (`id`),
  ADD CONSTRAINT `equipment_generation_id_foreign` FOREIGN KEY (`generation_id`) REFERENCES `generations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `equipment_transmission_type_id_foreign` FOREIGN KEY (`transmission_type_id`) REFERENCES `transmission_types` (`id`);

--
-- Ограничения внешнего ключа таблицы `equipment_colors`
--
ALTER TABLE `equipment_colors`
  ADD CONSTRAINT `equipment_colors_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `equipment_colors_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `favorite_equipments`
--
ALTER TABLE `favorite_equipments`
  ADD CONSTRAINT `favorite_equipments_equipment_id_foreign` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorite_equipments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `generations`
--
ALTER TABLE `generations`
  ADD CONSTRAINT `generations_car_model_id_foreign` FOREIGN KEY (`car_model_id`) REFERENCES `car_models` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
