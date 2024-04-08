-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 09, 2024 alle 00:10
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zoi_beauty`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Sopracciglia'),
(2, 'Occhi'),
(3, 'Trucco'),
(4, 'Trattamenti viso'),
(5, 'Ciglia');

-- --------------------------------------------------------

--
-- Struttura della tabella `ip_bloccati`
--

CREATE TABLE `ip_bloccati` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `blocked_until` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `access_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `logs`
--

INSERT INTO `logs` (`id`, `ip_address`, `access_time`) VALUES
(1, '::1', '2024-02-07 13:59:31'),
(2, '::1', '2024-02-07 14:02:15'),
(3, '127.0.0.1', '2024-02-07 14:04:32'),
(4, '127.0.0.1', '2024-02-07 14:04:33'),
(5, '127.0.0.1', '2024-02-07 14:04:33'),
(6, '127.0.0.1', '2024-02-07 14:04:33'),
(7, '127.0.0.1', '2024-02-07 14:04:33'),
(8, '127.0.0.1', '2024-02-07 14:04:34'),
(9, '127.0.0.1', '2024-02-07 14:05:03'),
(10, '127.0.0.1', '2024-02-07 14:05:07'),
(11, '127.0.0.1', '2024-02-07 14:05:08'),
(12, '127.0.0.1', '2024-02-07 14:05:08'),
(13, '127.0.0.1', '2024-02-07 14:05:11'),
(14, '127.0.0.1', '2024-02-07 14:05:11'),
(15, '127.0.0.1', '2024-02-07 14:05:11'),
(16, '127.0.0.1', '2024-02-07 14:05:11'),
(17, '127.0.0.1', '2024-02-07 14:05:12'),
(18, '::1', '2024-02-07 14:08:42'),
(19, '127.0.0.1', '2024-02-07 14:09:16'),
(20, '::1', '2024-02-07 14:10:47'),
(21, '127.0.0.1', '2024-02-07 14:11:18'),
(22, '127.0.0.1', '2024-02-07 14:11:22'),
(23, '127.0.0.1', '2024-02-07 14:12:08'),
(24, '127.0.0.1', '2024-02-07 14:12:47'),
(25, '::1', '2024-02-07 14:12:51'),
(26, '::1', '2024-02-07 14:28:00'),
(27, '::1', '2024-02-07 14:39:17'),
(28, '::1', '2024-02-07 14:39:44'),
(29, '::1', '2024-02-07 14:42:23'),
(30, '127.0.0.1', '2024-02-13 13:08:16'),
(31, '127.0.0.1', '2024-02-13 13:08:18'),
(32, '127.0.0.1', '2024-02-13 14:08:50'),
(33, '127.0.0.1', '2024-02-13 14:17:27'),
(34, '127.0.0.1', '2024-02-13 14:17:32'),
(35, '127.0.0.1', '2024-02-13 14:41:54'),
(36, '127.0.0.1', '2024-02-13 16:15:39'),
(37, '127.0.0.1', '2024-02-19 18:51:06'),
(38, '127.0.0.1', '2024-02-19 18:51:11'),
(39, '127.0.0.1', '2024-02-20 07:06:00'),
(40, '127.0.0.1', '2024-02-20 07:06:03'),
(41, '127.0.0.1', '2024-02-20 07:09:18'),
(42, '127.0.0.1', '2024-02-20 07:09:24'),
(43, '127.0.0.1', '2024-02-20 14:55:44'),
(44, '127.0.0.1', '2024-02-20 15:39:00'),
(45, '127.0.0.1', '2024-02-20 15:42:44'),
(46, '::1', '2024-02-24 18:31:57'),
(47, '::1', '2024-02-24 18:32:10'),
(48, '::1', '2024-02-24 18:32:19'),
(49, '127.0.0.1', '2024-02-25 15:44:35'),
(50, '127.0.0.1', '2024-02-25 15:55:04'),
(51, '127.0.0.1', '2024-02-25 15:56:03'),
(52, '127.0.0.1', '2024-02-25 15:58:12'),
(53, '127.0.0.1', '2024-02-25 15:58:53'),
(54, '127.0.0.1', '2024-02-25 15:58:59'),
(55, '127.0.0.1', '2024-02-25 15:59:13'),
(56, '127.0.0.1', '2024-02-25 15:59:16'),
(57, '127.0.0.1', '2024-02-25 15:59:48'),
(58, '127.0.0.1', '2024-02-25 15:59:55'),
(59, '127.0.0.1', '2024-02-25 16:00:19'),
(60, '127.0.0.1', '2024-02-25 16:00:21'),
(61, '127.0.0.1', '2024-02-25 16:00:34'),
(62, '127.0.0.1', '2024-02-25 16:00:48'),
(63, '127.0.0.1', '2024-02-25 16:02:20'),
(64, '127.0.0.1', '2024-02-25 16:05:10'),
(65, '127.0.0.1', '2024-02-25 16:05:27'),
(66, '127.0.0.1', '2024-02-25 16:05:30'),
(67, '127.0.0.1', '2024-02-25 16:05:35'),
(68, '127.0.0.1', '2024-02-25 16:07:26'),
(69, '127.0.0.1', '2024-02-25 16:10:37'),
(70, '127.0.0.1', '2024-02-25 16:13:27'),
(71, '::1', '2024-02-25 16:15:39'),
(72, '127.0.0.1', '2024-03-15 06:25:43'),
(73, '127.0.0.1', '2024-03-15 06:25:50'),
(74, '127.0.0.1', '2024-03-15 06:26:07'),
(75, '127.0.0.1', '2024-03-15 06:26:12'),
(76, '127.0.0.1', '2024-03-19 07:17:48'),
(77, '127.0.0.1', '2024-03-19 07:17:56'),
(78, '::1', '2024-03-29 11:06:02'),
(79, '::1', '2024-03-29 11:23:40'),
(80, '::1', '2024-03-29 11:31:27'),
(81, '::1', '2024-03-29 11:47:08'),
(82, '::1', '2024-03-29 17:58:01'),
(83, '::1', '2024-03-29 18:00:52'),
(84, '::1', '2024-03-29 18:01:18'),
(85, '::1', '2024-03-29 18:01:29'),
(86, '::1', '2024-03-29 18:29:24'),
(87, '::1', '2024-03-29 18:29:34'),
(88, '::1', '2024-03-29 19:26:27'),
(89, '::1', '2024-03-29 19:47:28'),
(90, '::1', '2024-04-06 17:36:39'),
(91, '::1', '2024-04-06 17:37:03');

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazioni`
--

CREATE TABLE `prenotazioni` (
  `id` int(11) NOT NULL,
  `utente_id` int(11) NOT NULL,
  `servizio_id` int(11) NOT NULL,
  `data_ora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazioni_utenti`
--

CREATE TABLE `prenotazioni_utenti` (
  `id` int(11) NOT NULL,
  `utente_id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `duration`, `type_id`) VALUES
(1, 'Micro pigmentazione', 350.00, NULL, 1),
(2, 'Ritocco annuale', 200.00, NULL, 2),
(3, 'Eye-liner infracigliare', 350.00, NULL, 3),
(4, 'Eye-liner sfumato', 350.00, NULL, 4),
(5, 'Trucco semi permanente labbra', 350.00, NULL, 5),
(6, 'Micro needling', 150.00, NULL, 6),
(7, 'Hydramethod', 60.00, NULL, 7),
(8, 'Acidi specifici', 100.00, NULL, 8),
(9, 'Laminazione', 80.00, NULL, 9),
(10, 'Laminazione e colorazione', 75.00, NULL, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `services_types`
--

CREATE TABLE `services_types` (
  `service_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `services_types`
--

INSERT INTO `services_types` (`service_id`, `type_id`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 3),
(6, 4),
(7, 4),
(8, 4),
(9, 5),
(10, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `types`
--

INSERT INTO `types` (`id`, `name`, `category_id`) VALUES
(1, 'Micro pigmentazione', 4),
(2, 'Ritocco annuale', 4),
(3, 'Eye-liner infracigliare', 2),
(4, 'Eye-liner sfumato', 2),
(5, 'Trucco semi permanente labbra', 3),
(6, 'Micro needling', 4),
(7, 'Hydramethod', 3),
(8, 'Acidi specifici', 3),
(9, 'Laminazione', 1),
(10, 'Laminazione e colorazione', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `ip_address`, `username`, `password`, `email`, `request_time`) VALUES
(1, '::1', 'nuovo_utente', '$2y$10$6GTJCjoUOC1gol5D0HyYvuuPW4FKO3fzBOoIN9PR3OslUX4xowzje', 'bnVvdm9fdXRlbnRlQGV4YW1wbGUuY29t', '2024-04-06 17:36:39'),
(2, '::1', 'admin', '$2y$10$bihJykirmhIds5J50kdL7OI1jbyvXNzIqRw61Q399cL.hLgahrC2G', 'YWRtaW5AYWRtaW4uY29t', '2024-04-06 17:37:03');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ip_bloccati`
--
ALTER TABLE `ip_bloccati`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utente_id` (`utente_id`),
  ADD KEY `servizio_id` (`servizio_id`);

--
-- Indici per le tabelle `prenotazioni_utenti`
--
ALTER TABLE `prenotazioni_utenti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utente_id` (`utente_id`);

--
-- Indici per le tabelle `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_ibfk_1` (`type_id`);

--
-- Indici per le tabelle `services_types`
--
ALTER TABLE `services_types`
  ADD PRIMARY KEY (`service_id`,`type_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indici per le tabelle `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `types_ibfk_1` (`category_id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `ip_bloccati`
--
ALTER TABLE `ip_bloccati`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `prenotazioni_utenti`
--
ALTER TABLE `prenotazioni_utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD CONSTRAINT `prenotazioni_ibfk_1` FOREIGN KEY (`utente_id`) REFERENCES `utenti` (`id`),
  ADD CONSTRAINT `prenotazioni_ibfk_2` FOREIGN KEY (`servizio_id`) REFERENCES `services` (`id`);

--
-- Limiti per la tabella `prenotazioni_utenti`
--
ALTER TABLE `prenotazioni_utenti`
  ADD CONSTRAINT `prenotazioni_utenti_ibfk_1` FOREIGN KEY (`utente_id`) REFERENCES `utenti` (`id`);

--
-- Limiti per la tabella `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);

--
-- Limiti per la tabella `services_types`
--
ALTER TABLE `services_types`
  ADD CONSTRAINT `services_types_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `services_types_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);

--
-- Limiti per la tabella `types`
--
ALTER TABLE `types`
  ADD CONSTRAINT `types_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
