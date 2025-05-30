-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.0
-- Время создания: Май 31 2025 г., 05:19
-- Версия сервера: 8.0.35
-- Версия PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `forward`
--

-- --------------------------------------------------------

--
-- Структура таблицы `body_types`
--

CREATE TABLE `body_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `body_types`
--

INSERT INTO `body_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Седан', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(2, 'Хэтчбек', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(3, 'Универсал', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(4, 'Купе', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(5, 'Кабриолет', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(6, 'Внедорожник', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(7, 'Кроссовер', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(8, 'Минивэн', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(9, 'Пикап', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(10, 'Фургон', '2025-05-30 20:39:01', '2025-05-30 20:39:01');

-- --------------------------------------------------------

--
-- Структура таблицы `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `car_id` bigint UNSIGNED NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `appointment_date` timestamp NULL DEFAULT NULL,
  `status` enum('pending','confirmed','rejected','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `manager_comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `manager_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `branches`
--

CREATE TABLE `branches` (
  `id` bigint UNSIGNED NOT NULL,
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
(1, 'Форвард Авто Интерлайн', 'Иркутск, Советская улица, 73', 'branches/yIxR3sGEAMiu561Jk00RWqXYnsLaHWSRvrRcCKj9.jpg', '2025-05-30 20:42:45', '2025-05-30 20:42:45'),
(2, 'Форвард Авто в Новоленино', 'Иркутск, улица Ярославского, 302', 'branches/8gGqF8UMOoGF8Hg5WW5Q1xC6Lub0lsXsC5mFsvsv.jpg', '2025-05-30 20:43:12', '2025-05-30 20:43:12'),
(3, 'Форвард Авто на Ленина', 'Иркутск, улица Ленина, 5А', 'branches/ea7U5gKoFj8g8X8J9YvQiffiRJlDRDK9NcqkgqzP.jpg', '2025-05-30 20:44:19', '2025-05-30 20:44:19'),
(4, 'Форвард Авто на Трактовой', 'Иркутск, Трактовая улица, 22А', 'branches/qDZAvZe1uziQ7A5ZlAVVEjN9vRUwn7oO7n4ka8Ox.jpg', '2025-05-30 20:45:02', '2025-05-30 20:45:02');

-- --------------------------------------------------------

--
-- Структура таблицы `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `brands`
--

INSERT INTO `brands` (`id`, `name`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'BMW', 'brands/mAjrQ2QXMQOwX3grhlHybzKS2YjCEXxwcIKtdUFq.png', '2025-05-30 20:45:20', '2025-05-30 20:52:31'),
(2, 'Nissan', 'brands/Gso434PhPfv5XIFpolOKR0n2ZY9fgJipfqRtm87T.png', '2025-05-30 20:45:30', '2025-05-30 20:45:30'),
(3, 'Toyota', 'brands/DHY02xDiiYpZReSC4Mk9p5Kn7cTMnXk7l6jJjc2G.png', '2025-05-30 20:45:40', '2025-05-30 20:45:40'),
(4, 'Mercedes Benz', 'brands/vRmuLltCzjwHQd3173AO0HYNcAvIHXXn4Ih63859.png', '2025-05-30 20:45:54', '2025-05-30 20:45:54'),
(5, 'Cadillac', 'brands/ROGZNo55sNSPYmgLLf8p4JK6AfCWnbhcigwj5C8a.png', '2025-05-30 20:46:10', '2025-05-30 20:46:10'),
(6, 'Porsche', 'brands/XAhrVEUv8Vum8sx5vED3tkIUq06D8HyD7aJrMMSO.png', '2025-05-30 20:46:18', '2025-05-30 20:46:18'),
(7, 'Ford', 'brands/JolNpXQHHJujrzHEccg4d4kXvDjbqAfsWx2SB28H.png', '2025-05-30 20:46:38', '2025-05-30 20:46:38'),
(8, 'Лада', 'brands/3yoe66jEztefPeywx4752uipiuhCSH3M3sEG3URH.png', '2025-05-30 20:47:46', '2025-05-30 20:47:46'),
(9, 'Skoda', 'brands/7vje5L9IaBQoyRSzDklJWcxy2Gh0exjbK1Fuan6q.png', '2025-05-30 20:48:50', '2025-05-30 20:48:50'),
(10, 'Mitsubishi', 'brands/F8UO0i91jFOkaJDpaCkkPD2GqDkrwbAoDJz6Ehaf.png', '2025-05-30 20:50:15', '2025-05-30 20:50:15');

-- --------------------------------------------------------

--
-- Структура таблицы `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cars`
--

CREATE TABLE `cars` (
  `id` bigint UNSIGNED NOT NULL,
  `equipment_id` bigint UNSIGNED NOT NULL,
  `vin` varchar(17) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mileage` int NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_sold` tinyint(1) NOT NULL DEFAULT '0',
  `branch_id` bigint UNSIGNED DEFAULT NULL,
  `color_id` bigint UNSIGNED DEFAULT NULL,
  `custom_color_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_color_hex` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `car_images`
--

CREATE TABLE `car_images` (
  `id` bigint UNSIGNED NOT NULL,
  `car_id` bigint UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `car_models`
--

CREATE TABLE `car_models` (
  `id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `car_models`
--

INSERT INTO `car_models` (`id`, `brand_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'M5', '2025-05-30 20:50:27', '2025-05-30 20:53:41'),
(2, 1, 'X7', '2025-05-30 20:50:36', '2025-05-30 20:50:36'),
(3, 2, 'GTR', '2025-05-30 20:53:52', '2025-05-30 20:53:52'),
(4, 2, 'X-Trail', '2025-05-30 20:54:00', '2025-05-30 20:54:00'),
(5, 3, 'Mark 2', '2025-05-30 20:54:11', '2025-05-30 20:54:11'),
(6, 3, 'Crown', '2025-05-30 20:54:23', '2025-05-30 20:54:23'),
(7, 4, 'C class', '2025-05-30 20:54:41', '2025-05-30 20:54:41'),
(8, 4, 'S class', '2025-05-30 20:54:56', '2025-05-30 20:54:56'),
(9, 5, 'CTS', '2025-05-30 20:55:12', '2025-05-30 20:55:12'),
(10, 5, 'Escalade', '2025-05-30 20:55:53', '2025-05-30 20:55:53'),
(11, 6, 'Panamera', '2025-05-30 20:56:05', '2025-05-30 20:56:05'),
(12, 6, '911', '2025-05-30 20:56:12', '2025-05-30 20:56:12'),
(13, 7, 'Raptor', '2025-05-30 20:56:24', '2025-05-30 20:56:24'),
(14, 7, 'Focus', '2025-05-30 20:57:02', '2025-05-30 20:57:02'),
(15, 8, 'Веста', '2025-05-30 20:57:13', '2025-05-30 20:57:13'),
(16, 8, 'Ларгус', '2025-05-30 20:57:29', '2025-05-30 20:57:29'),
(17, 9, 'Oktavia', '2025-05-30 20:57:39', '2025-05-30 20:57:39'),
(18, 9, 'Karoq', '2025-05-30 20:57:48', '2025-05-30 20:57:48'),
(19, 10, 'ASX', '2025-05-30 20:57:55', '2025-05-30 20:57:55'),
(20, 10, 'Lancer', '2025-05-30 20:58:03', '2025-05-30 20:58:03');

-- --------------------------------------------------------

--
-- Структура таблицы `colors`
--

CREATE TABLE `colors` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hex_code` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `colors`
--

INSERT INTO `colors` (`id`, `name`, `hex_code`, `created_at`, `updated_at`) VALUES
(1, 'Красный авантюрин', '#cc5577', '2025-05-30 21:08:03', '2025-05-30 21:08:03'),
(2, 'Синий снэппер рокс', '#003251', '2025-05-30 21:09:46', '2025-05-30 21:10:17'),
(3, 'Темно-синяя жемчужина', '#1d2732', '2025-05-30 21:12:09', '2025-05-30 21:12:09'),
(4, 'Серебристый', '#c0c0c0', '2025-05-30 21:14:35', '2025-05-30 21:14:35'),
(5, 'Белый', '#FFFFFF', '2025-05-30 21:16:14', '2025-05-30 21:16:14');

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Россия', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(2, 'Германия', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(3, 'Япония', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(4, 'США', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(5, 'Китай', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(6, 'Корея', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(7, 'Франция', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(8, 'Италия', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(9, 'Великобритания', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(10, 'Швеция', '2025-05-30 20:39:01', '2025-05-30 20:39:01');

-- --------------------------------------------------------

--
-- Структура таблицы `drive_types`
--

CREATE TABLE `drive_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `drive_types`
--

INSERT INTO `drive_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Передний', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(2, 'Задний', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(3, 'Полный', '2025-05-30 20:39:01', '2025-05-30 20:39:01');

-- --------------------------------------------------------

--
-- Структура таблицы `engine_types`
--

CREATE TABLE `engine_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `engine_types`
--

INSERT INTO `engine_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Бензиновый', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(2, 'Дизельный', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(3, 'Электрический', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(4, 'Гибридный', '2025-05-30 20:39:01', '2025-05-30 20:39:01');

-- --------------------------------------------------------

--
-- Структура таблицы `equipment`
--

CREATE TABLE `equipment` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `generation_id` bigint UNSIGNED NOT NULL,
  `body_type_id` bigint UNSIGNED NOT NULL,
  `engine_type_id` bigint UNSIGNED NOT NULL,
  `transmission_type_id` bigint UNSIGNED NOT NULL,
  `drive_type_id` bigint UNSIGNED NOT NULL,
  `country_id` bigint UNSIGNED NOT NULL,
  `engine_volume` decimal(3,1) NOT NULL,
  `engine_power` int NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `range` int NOT NULL,
  `max_speed` int NOT NULL,
  `model_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `generation_id`, `body_type_id`, `engine_type_id`, `transmission_type_id`, `drive_type_id`, `country_id`, `engine_volume`, `engine_power`, `description`, `range`, `max_speed`, `model_path`, `created_at`, `updated_at`) VALUES
(1, 'M Special', 1, 1, 1, 1, 3, 2, 4.4, 625, 'Стильный и динамичный M5 F90 LCI — это воплощение спортивного премиум-класса от BMW. Обновлённый дизайн экстерьера с агрессивной передней частью, улучшенные аэродинамические свойства и интеллектуальные технологии делают этот автомобиль по-настоящему совершенным. Мощный 4,4-литровый V8 с двойным турбонаддувом выдаёт 625 л.с., обеспечивая впечатляющий разгон и уверенное прохождение поворотов. Салон выполнен из высококачественных материалов с вниманием к каждой детали — идеальное сочетание комфорта, технологичности и спортивного духа. M5 F90 LCI — не просто машина, а настоящий объект желания для ценителей скорости и стиля.', 500, 250, NULL, '2025-05-30 21:08:03', '2025-05-30 21:08:03'),
(2, 'M60I xDrive', 2, 6, 1, 3, 3, 2, 4.0, 520, 'BMW X7 G07 — флагманский кроссовер, сочетающий роскошь, технологии и внушительные габариты в идеальном союзе. С первого взгляда покоряет массивная решётка радиатора, солидный профиль и изысканная оптика с лазерными прожекторами. В интерьере — простор, утончённость отделки, индивидуальные места для пассажиров и передовые системы комфорта и безопасности. Под капотом — мощный 4,4-литровый V8 или 3-литровый рядный шестицилиндровый двигатель, обеспечивающие уверенный ход в любом темпе. BMW X7 G07 — это вершина премиального SUV: статусно, технологично, безупречно.', 550, 220, NULL, '2025-05-30 21:09:46', '2025-05-30 21:09:46'),
(3, 'Nismo', 3, 4, 1, 2, 3, 3, 3.8, 570, 'Nissan GT-R — легендарный спорткар, сочетающий экстремальную динамику, передовые технологии и безупречную управляемость. Стильный, агрессивный дизайн подчёркивает его боевой характер, а мощный 3,8-литровый V6 с двойным турбонаддувом развивает до 570 л.с., обеспечивая невероятное ускорение и стабильность на трассе. Полный привод, спортивная подвеска и продвинутая аэродинамика делают GT-R по-настоящему всесторонним чемпионом. В салоне — комфорт высокого уровня, качественные материалы и современная электроника. Nissan GT-R — это не просто машина, а настоящий гипер-спортивный флагман японского автопрома.', 400, 280, NULL, '2025-05-30 21:12:09', '2025-05-30 21:12:09'),
(4, 'Lux', 19, 6, 1, 4, 3, 3, 2.0, 180, 'Nissan X-Trail — идеальный выбор для тех, кто ценит комфорт, надежность и стиль в повседневных поездках. Этот компактный кроссовер сочетает в себе современный дизайн с выразительной передней панелью, просторным и функциональным салоном, а также адаптивным полным приводом и продвинутыми системами безопасности. Под капотом — экономичный и бодрый турбомотор, обеспечивающий уверенную динамику как в городе, так и на трассе. Nissan X-Trail — это автомобиль для семьи, путешествий и активного образа жизни, где каждый километр становится удовольствием.', 700, 180, NULL, '2025-05-30 21:14:35', '2025-05-30 21:14:35'),
(5, 'Tourer V', 4, 1, 1, 2, 2, 3, 3.0, 280, 'Toyota Mark II — культовый японский седан, известный своей надежностью, элегантным дизайном и отличной управляемостью. Стильный экстерьер с выразительными линиями, продуманный до мелочей интерьер и хорошо отлаженный двигатель делают его любимцем автолюбителей по всему миру. Этот автомобиль сочетает в себе комфорт городского кruйза и уверенную динамику на трассе. Toyota Mark II — не просто машина, а символ времени, когда стиль и качество шли рука об руку.', 400, 220, NULL, '2025-05-30 21:16:14', '2025-05-30 21:16:14'),
(6, 'Majesta', 5, 1, 1, 2, 3, 3, 2.2, 180, 'Toyota Crown — легендарный флагманский седан, олицетворяющий элегантность, комфорт и японское качество. С момента своего дебюта он остаётся символом премиального статуса и технологичности. Современная версия поражает стильным, динамичным дизайном, роскошным интерьером с богатой отделкой и продвинутыми системами безопасности и комфорта. Гибридная силовая установка сочетает мощность и экологичность, обеспечивая плавный ход и низкий расход топлива. Toyota Crown — это не просто автомобиль, а выражение уважения к водителю и пассажирам, где каждый момент за рулём становится удовольствием.', 600, 220, NULL, '2025-05-30 21:17:30', '2025-05-30 21:17:30');

-- --------------------------------------------------------

--
-- Структура таблицы `equipment_colors`
--

CREATE TABLE `equipment_colors` (
  `id` bigint UNSIGNED NOT NULL,
  `equipment_id` bigint UNSIGNED NOT NULL,
  `color_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `equipment_colors`
--

INSERT INTO `equipment_colors` (`id`, `equipment_id`, `color_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 3, NULL, NULL),
(4, 4, 4, NULL, NULL),
(5, 5, 5, NULL, NULL),
(6, 6, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `favorite_equipments`
--

CREATE TABLE `favorite_equipments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `equipment_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `generations`
--

CREATE TABLE `generations` (
  `id` bigint UNSIGNED NOT NULL,
  `car_model_id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year_from` year NOT NULL,
  `year_to` year DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `generations`
--

INSERT INTO `generations` (`id`, `car_model_id`, `name`, `year_from`, `year_to`, `created_at`, `updated_at`) VALUES
(1, 1, 'F90', '2020', '2024', '2025-05-30 20:58:15', '2025-05-30 20:58:15'),
(2, 2, 'G07', '2018', '2020', '2025-05-30 20:58:34', '2025-05-30 20:58:34'),
(3, 3, 'R35', '2010', '2018', '2025-05-30 20:58:54', '2025-05-30 20:58:54'),
(4, 5, 'JZX100', '1996', '2002', '2025-05-30 20:59:43', '2025-05-30 20:59:43'),
(5, 6, 'X (S150)', '1995', '2008', '2025-05-30 21:00:16', '2025-05-30 21:00:16'),
(6, 7, 'IV (W205) Рестайлинг', '2018', '2023', '2025-05-30 21:01:02', '2025-05-30 21:01:02'),
(7, 8, 'VI (W222, C217) Рестайлинг', '2017', '2020', '2025-05-30 21:01:29', '2025-05-30 21:01:29'),
(8, 9, 'III', '2013', '2019', '2025-05-30 21:02:06', '2025-05-30 21:02:06'),
(9, 10, 'V Рестайлинг', '2024', NULL, '2025-05-30 21:02:39', '2025-05-30 21:02:39'),
(10, 12, 'VIII (992) Рестайлинг', '2024', NULL, '2025-05-30 21:03:20', '2025-05-30 21:03:20'),
(11, 13, 'XIV', '2020', '2024', '2025-05-30 21:03:48', '2025-05-30 21:03:48'),
(12, 14, 'III Рестайлинг', '2014', '2019', '2025-05-30 21:04:22', '2025-05-30 21:04:22'),
(13, 15, 'I Рестайлинг (NG)', '2022', NULL, '2025-05-30 21:04:53', '2025-05-30 21:04:53'),
(14, 16, 'I Рестайлинг', '2021', NULL, '2025-05-30 21:05:19', '2025-05-30 21:05:19'),
(15, 17, 'IV (A8) Рестайлинг', '2024', NULL, '2025-05-30 21:05:45', '2025-05-30 21:05:45'),
(16, 18, 'I Рестайлинг', '2021', NULL, '2025-05-30 21:06:05', '2025-05-30 21:06:05'),
(17, 19, 'I Рестайлинг 2', '2016', '2020', '2025-05-30 21:06:39', '2025-05-30 21:06:39'),
(18, 20, 'X Рестайлинг', '2011', '2015', '2025-05-30 21:07:11', '2025-05-30 21:07:11'),
(19, 4, 'N32 II Рестайлинг', '2010', '2015', '2025-05-30 21:13:04', '2025-05-30 21:13:04');

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
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
(20, '2025_05_11_095917_create_notifications_table', 1),
(21, '2025_05_30_161235_add_manager_id_to_bookings_table', 1),
(22, '2025_05_31_032445_update_appointment_date_nullable_in_bookings_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `car_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8KpEyACRDvgbwojk3LJB2meMXJA7lw0Hezsy7Asd', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMnlXUTVBUVVFSmVNMG9JYVRiZlNuT0dpc0lwbXJIbnpKbE1rajhmWSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL25vdGlmaWNhdGlvbnMiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2VxdWlwbWVudHMvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1748639932),
('ELwhyzmmfvY4oIQNXWo92XRVngosIOeM7bquQmZ8', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibmFoeXZ3eEEwbWgxM056SGhLbktzWlVaMGFYZ25vSzNzQWdQUWE2aiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2NhcnMiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1748637633);

-- --------------------------------------------------------

--
-- Структура таблицы `transmission_types`
--

CREATE TABLE `transmission_types` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `transmission_types`
--

INSERT INTO `transmission_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Механическая', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(2, 'Автоматическая', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(3, 'Роботизированная', '2025-05-30 20:39:01', '2025-05-30 20:39:01'),
(4, 'Вариатор', '2025-05-30 20:39:01', '2025-05-30 20:39:01');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
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
(1, 'Admin', 'admin@gmail.com', '8 111 111 11 11', '$2y$12$vnPEJYjLallXfEGMp1VIpuvtknHbDT8utjw8Fm2PgzHtyIQ/gjXDq', 'admin', NULL, NULL, '2025-05-30 20:40:31', '2025-05-30 20:40:31');

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
  ADD KEY `bookings_car_id_status_index` (`car_id`,`status`),
  ADD KEY `bookings_manager_id_foreign` (`manager_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `car_images`
--
ALTER TABLE `car_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `car_models`
--
ALTER TABLE `car_models`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `drive_types`
--
ALTER TABLE `drive_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `engine_types`
--
ALTER TABLE `engine_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `equipment_colors`
--
ALTER TABLE `equipment_colors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `favorite_equipments`
--
ALTER TABLE `favorite_equipments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `generations`
--
ALTER TABLE `generations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `transmission_types`
--
ALTER TABLE `transmission_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_car_id_foreign` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
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
