-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: localhost
-- Čas generovania: Pi 04.Sep 2026, 23:45
-- Verzia serveru: 10.4.28-MariaDB
-- Verzia PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `healthylife`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `meals`
--

CREATE TABLE `meals` (
  `meal_id` int(11) NOT NULL,
  `meal_type` varchar(255) NOT NULL,
  `meal_description` text NOT NULL,
  `calories` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `meals`
--

INSERT INTO `meals` (`meal_id`, `meal_type`, `meal_description`, `calories`, `created_at`, `user_id`) VALUES
(1, 'Raňajky', 'Ovsená kaša s ovocím', 320, '2026-03-29 19:05:14', 1),
(2, 'Obed', 'Kuracie prsia s ryžou a zeleninou', 520, '2026-03-29 19:05:14', 1),
(3, 'Večera', 'Grilovaný losos s hnedou ryžou a brokolicou', 450, '2026-03-29 19:05:14', 1),
(4, 'Snack', 'Grécky jogurt s horkou čokoládou a ovocím', 200, '2026-03-29 19:27:42', 1),
(5, 'Raňajky', 'Smoothie z banánu, špenátu, mandľového mlieka a proteínového prášku, hrsť mandlí', 450, '2026-03-29 19:27:42', 1),
(6, 'Obed', 'Grilované morčačie filéty s pohánkou a dusená zeleninou', 650, '2026-03-29 19:27:42', 1),
(7, 'Večera', 'Vypražaný tofu s ryžou a teriyaki omáčkou', 620, '2026-03-30 10:54:17', 1),
(11, 'Snack', 'Celozrnný chlebíček s banánom a arašidovým maslom', 350, '2026-03-30 21:06:40', 1),
(12, 'Večera', 'Vypražaný tofu s ryžou a teriyaki omáčkou', 520, '2026-04-01 21:55:23', 2),
(13, 'Raňajky', 'Praženica so šunkou a bagetou', 530, '2026-04-01 22:06:13', 3),
(14, 'Raňajky', 'Praženica so šunkou a bagetou', 450, '2026-04-22 16:46:13', 2);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `sleep_logs`
--

CREATE TABLE `sleep_logs` (
  `sleep_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hours` decimal(4,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `sleep_logs`
--

INSERT INTO `sleep_logs` (`sleep_id`, `user_id`, `hours`, `date`) VALUES
(2, 2, 7.00, '2026-04-04'),
(4, 1, 7.50, '2026-04-01'),
(5, 1, 8.00, '2026-04-02'),
(6, 1, 8.00, '2026-04-03'),
(7, 1, 9.00, '2026-04-04'),
(8, 3, 7.50, '2026-04-05');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Sťahujem dáta pre tabuľku `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `created_at`, `role`) VALUES
(1, 'admin', '$2y$10$vdxhG1vQ0V0/5weVwnEaqeyCEO2Od12NZ6Z6B9tzeBTw9x2S7kbym', '2026-04-01 18:18:03', 'admin'),
(2, 'user1', '$2y$10$hkSbNcbxRnONzz1txxSAjeyUsw8ix6uy3OXIDA/RYwzx4C/aivYk6', '2026-04-01 21:54:47', 'user'),
(3, 'user2', '$2y$10$ExMGZnWErH7RyfCsw23qFOiR7H1V0sSkGjf7ee.3Nh2gU7bCR8HE2', '2026-04-01 22:05:10', 'user'),
(4, 'user3', '$2y$10$QnvZS.OapmXI3G0TAalOk.zI4XWM5bey8u1GaNII7xbo6FSv7ykau', '2026-04-24 09:09:47', 'user');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`meal_id`);

--
-- Indexy pre tabuľku `sleep_logs`
--
ALTER TABLE `sleep_logs`
  ADD PRIMARY KEY (`sleep_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `meals`
--
ALTER TABLE `meals`
  MODIFY `meal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pre tabuľku `sleep_logs`
--
ALTER TABLE `sleep_logs`
  MODIFY `sleep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `sleep_logs`
--
ALTER TABLE `sleep_logs`
  ADD CONSTRAINT `sleep_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
