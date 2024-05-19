-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-05-2024 a las 04:24:36
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `citas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_05_16_025524_create_specialties_table', 1),
(7, '2024_05_17_002057_create_patients_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
  `id_paciente` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `especialidad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cita` datetime DEFAULT NULL,
  `alergias` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_paciente`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `patients`
--

INSERT INTO `patients` (`id_paciente`, `nombres`, `apellidos`, `direccion`, `correo`, `telefono`, `especialidad`, `cita`, `alergias`, `observaciones`, `created_at`, `updated_at`) VALUES
(1, 'Prof. Dashawn Mueller V', 'Lindgren', '760 Ibrahim Tunnel Apt. 653\nPort Gene, MN 43070-5605', 'bryon.flatley@example.com', '1-407-662-6608', 'A sequi.', '2024-05-24 02:07:50', 'Vitae.', 'Dolorem velit quia.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(2, 'Giovanna Hackett', 'Keebler', '433 Goldner Flat Suite 545\nMinaborough, AL 69455-1239', 'wiza.albin@example.org', '657-771-4737', 'Fugiat.', '2024-05-24 02:07:50', 'Expedita.', 'Voluptas doloremque.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(3, 'Gardner Hackett', 'Kshlerin', '8779 Camden Hills\nLeonbury, RI 76717-1186', 'lyric16@example.net', '(458) 984-3446', 'Veniam.', '2024-05-24 02:07:50', 'Nam.', 'Eius minima numquam.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(4, 'Kasey Hane DVM', 'Wilderman', '42445 Pagac Valley Apt. 274\nLake Emilytown, LA 38491', 'isabella85@example.com', '+18029042302', 'Debitis.', '2024-05-24 02:07:50', 'Facilis.', 'Dicta occaecati.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(5, 'Dr. Jailyn Champlin V', 'Goodwin', '3742 Stehr Lights\nWest Donfort, NC 95574', 'naomie.turcotte@example.org', '1-332-988-3342', 'Quis.', '2024-05-24 02:07:50', 'Et sit.', 'Impedit dolorem.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(6, 'Ruth Turcotte MD', 'Collins', '146 White Squares Suite 583\nLake Eladio, SD 16222', 'maritza71@example.com', '678.454.2005', 'Est neque.', '2024-05-24 02:07:50', 'Qui.', 'Sapiente eos.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(7, 'Mr. Jalon Halvorson', 'Kuhn', '448 Howell Lights Suite 625\nPort Margarett, GA 95219-7845', 'sid53@example.org', '+1.541.563.3177', 'Saepe.', '2024-05-24 02:07:50', 'Maiores.', 'At eligendi officia.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(8, 'Mrs. Shaylee Raynor', 'Strosin', '7645 Name Trail\nNorth Lauriebury, RI 96625', 'jovani.walter@example.net', '+1-215-543-0103', 'Velit.', '2024-05-24 02:07:50', 'Molestiae.', 'Sapiente voluptatum.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(9, 'Dr. Albertha McKenzie MD', 'Yundt', '78326 Miller Cliff\nKuhnburgh, AK 51652-1834', 'mercedes.schultz@example.net', '1-872-377-4661', 'Quia eius.', '2024-05-24 02:07:50', 'Voluptas.', 'Temporibus iusto ut.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(10, 'Maxine Stroman', 'Ziemann', '1794 Randi Island\nNorth Hortenseton, HI 51412-7295', 'kutch.shyann@example.com', '757-505-0021', 'Quasi.', '2024-05-24 02:07:50', 'Eum et.', 'Enim corporis atque.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(11, 'Mrs. Martine Ward Jr.', 'Ebert', '868 Kuvalis Summit\nCierraside, MS 80258-3712', 'alakin@example.net', '(773) 427-0266', 'Facilis.', '2024-05-24 02:07:50', 'Est eaque.', 'Voluptatem ipsum at.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(12, 'Courtney Nicolas', 'Lowe', '9744 Kaelyn Shoal Apt. 864\nJacobshaven, MI 78186-0203', 'russel.clement@example.org', '1-442-418-6023', 'Ipsa.', '2024-05-24 02:07:50', 'Quisquam.', 'Repudiandae.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(13, 'Mrs. Jacinthe McKenzie DDS', 'Sanford', '814 Schuppe Forge\nLake Dewayne, VT 94384-7055', 'autumn.block@example.com', '606-758-6378', 'Velit.', '2024-05-24 02:07:50', 'Ratione.', 'Nam nobis tempore.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(14, 'Sandy Pacocha', 'Marks', '695 Dianna Pike Apt. 272\nNorth Evanschester, SD 09840-2237', 'camryn83@example.org', '+1-916-944-5245', 'Qui quia.', '2024-05-24 02:07:50', 'Non et.', 'Expedita non.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(15, 'Ms. Dorothy Corkery MD', 'Von', '5724 Winnifred Cliffs Apt. 400\nPort Katelin, VA 02379-9930', 'wiegand.yasmine@example.net', '(469) 992-3239', 'Tempora.', '2024-05-24 02:07:50', 'Harum.', 'Cum consequatur.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(16, 'Ms. Ettie Langosh', 'Donnelly', '82267 Durgan Knolls Suite 057\nNew Alfred, OK 67027', 'ojohns@example.net', '949.200.1506', 'Et.', '2024-05-24 02:07:50', 'Velit.', 'In quisquam.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(17, 'Cornelius 12', 'Abernathy 12', '245 Rohan Curve\nErynshire, FL 55749-6874', 'sohara@example.net', '1-669-333-8679', 'Velit.', '2024-05-24 02:07:50', 'Sunt quam.', 'Dignissimos.', '2024-05-17 12:07:51', '2024-05-19 08:28:56'),
(18, 'Cheya 1', 'Schmeler 12', '313 Jerrold Run\nNorth Reilly, TX 42974', 'jedediah.johnston@example.net', '283.615.8957', 'Nemo. 12', '2024-05-24 02:07:50', 'Quibusdam.', 'Beatae dolorum.', '2024-05-17 12:07:51', '2024-05-19 08:28:31'),
(19, 'Ms. Adriana Champlin MD', 'Weimann', '2045 Santiago Curve\nNew Karlieside, IL 77765-7165', 'doyle76@example.com', '820.872.2858', 'Cum.', '2024-05-24 02:07:50', 'Et.', 'Possimus asperiores.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(20, 'Vada Bradtke', 'Jones', '180 Spinka Camp Apt. 537\nGrimesside, MA 63114-7374', 'nakia33@example.net', '737-210-0882', 'Et eaque.', '2024-05-24 02:07:50', 'Quo.', 'Ea ducimus.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(21, 'Sabryna Robel', 'Terry', '350 Syble Bridge Apt. 539\nSouth Nicholaus, MO 73882-3930', 'callie29@example.net', '1-620-682-9896', 'Animi.', '2024-05-24 02:07:50', 'Modi.', 'Quia doloribus.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(22, 'Prof. Louie Batz', 'Kovacek', '710 Beer Fields\nEast Trinity, ND 43858', 'millie91@example.net', '(458) 363-4477', 'Eum.', '2024-05-24 02:07:50', 'Nulla sed.', 'Necessitatibus ut.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(23, 'Dr. Ford Bauch II', 'Beahan', '67939 Considine Springs Apt. 374\nNew Dockport, NH 95116', 'mack51@example.org', '360.858.4325', 'Aliquam.', '2024-05-24 02:07:50', 'Non non.', 'Numquam beatae enim.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(24, 'Hosea Brakus', 'O\'Connell', '5746 Merlin Inlet\nCrystelton, WY 12598-9507', 'bennett.dubuque@example.net', '(220) 499-1193', 'Maiores.', '2024-05-24 02:07:50', 'Est ex et.', 'Cumque quia sit.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(25, 'Eloy 12', 'Walsh', '883 Khalil Manors\nNorth Tate, OH 41477-5765', 'veda.zboncak@example.net', '+1-817-364-7845', 'Magni aut.', '2024-05-24 02:07:50', 'Illum.', 'Ipsam eum quos.', '2024-05-17 12:07:51', '2024-05-19 08:28:38'),
(26, 'Ian Williamson', 'Bartoletti', '41324 Jayda Wall Apt. 227\nGabrielhaven, NC 55310-0929', 'jamir.barton@example.org', '+1.934.944.6417', 'Omnis.', '2024-05-24 02:07:50', 'Excepturi.', 'Temporibus quia.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(27, 'Remington Hettinger DVM', 'Wunsch', '573 Adelia Harbor\nBryanaview, MS 19219', 'vandervort.wilhelm@example.org', '+1 (831) 443-9914', 'Mollitia.', '2024-05-24 02:07:50', 'Ipsam ea.', 'Dolorem in.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(28, 'Zoila Dare', 'Auer', '504 Powlowski Wall\nNew Elisabethchester, NV 98878-9624', 'darrick.labadie@example.net', '+1.510.473.2848', 'Nostrum.', '2024-05-24 02:07:50', 'Illo nemo.', 'Reprehenderit sit.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(29, 'Mr. Taylor Cummerata', 'Larkin', '1100 Stuart Plaza Suite 869\nVickyfort, VT 98234', 'yjohns@example.org', '+1.304.526.7741', 'Fugit.', '2024-05-24 02:07:50', 'Ut amet.', 'Magni ab qui sequi.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(30, 'Marcelina Schultz', 'Mueller', '709 Lorena Brooks\nHellerberg, CA 62291', 'rickey17@example.org', '(734) 758-6515', 'Quasi et.', '2024-05-24 02:07:50', 'Corrupti.', 'Asperiores.', '2024-05-17 12:07:51', '2024-05-17 12:07:51'),
(31, 'prueba', 'prueba', NULL, 'prueba@gmail.com', '131313', NULL, NULL, 'prueba', 'prueba', '2024-05-19 08:41:41', '2024-05-19 08:41:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `specialties`
--

DROP TABLE IF EXISTS `specialties`;
CREATE TABLE IF NOT EXISTS `specialties` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `specialties`
--

INSERT INTO `specialties` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(4, 'Profilaxis', 'Es la acción preventiva de la aparición de las enfermedades infectocontagiosas, y en el caso de que suceda su manifestación, la profilaxis busca contrarrestar su propagación en la población', '2024-05-16 15:10:31', '2024-05-17 05:10:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Josset Yair Portuguéz Rea', 'jossetpr@gmail.com', NULL, '$2y$12$/SKbz3AmTaDTT10iMm0NduSEO6WsO4dL7c5ZGDdPTRuEk3jqh.FHG', NULL, '2024-05-14 16:02:42', '2024-05-14 16:02:42'),
(2, 'Alondra Sanchez Rea', 'alondra@gmail.com', NULL, '$2y$10$cGDJxdsSLw.0Zju0GzrV/uC.DObe0jtepI5KJt.MfVDcUieCGa2sS', NULL, '2024-05-15 11:44:26', '2024-05-15 11:44:26'),
(3, 'carmenrosa', 'carmen@gmail.com', NULL, '$2y$12$VfHvpIFMgIcDxy5eSimiqeiJ1BQjbt3aVCKditSTOzuuZCQe0ZQ5K', NULL, '2024-05-15 16:03:56', '2024-05-15 16:03:56'),
(4, 'Julio Rea Flores', 'jrf@gmail.com', NULL, '$2y$12$kmho0sSwU4Z8O1JERXNute7zdwxR9mG/AbfJDwk3hY5FPmpgcJt4m', NULL, '2024-05-16 06:36:03', '2024-05-16 06:36:03'),
(5, 'lola', 'lola@gmail.com', NULL, '$2y$12$su2wdaGoq3vDdzCAOcMMyOQ6pZLAd3pJl/chFRQnw9X2C.qotwkp.', NULL, '2024-05-17 05:09:06', '2024-05-17 05:09:06');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
