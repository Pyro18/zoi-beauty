-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 23, 2024 alle 17:48
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
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', '$2y$10$hNsfAUR.DPLVAoqnijwZ9O0PfZJYyCNddAwWKbrQEqbzVe8QvSODq', 'admin@gmail.com');

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
-- Struttura della tabella `prenotazioni`
--

CREATE TABLE `prenotazioni` (
  `id` int(11) NOT NULL,
  `utente_id` int(11) DEFAULT NULL,
  `servizio_id` int(11) DEFAULT NULL,
  `data_ora` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prenotazioni`
--

INSERT INTO `prenotazioni` (`id`, `utente_id`, `servizio_id`, `data_ora`) VALUES
(54, 10, 1, '2024-05-23 10:00:00'),
(59, 10, 2, '2024-05-22 12:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazioni_non_utenti`
--

CREATE TABLE `prenotazioni_non_utenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `data_ora` datetime NOT NULL,
  `servizio_id` int(11) NOT NULL
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
(1, 'Tatuaggi', 4),
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
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `nome`, `cognome`, `username`, `telefono`, `email`, `password`, `request_time`) VALUES
(7, 'NomeaNuovo', 'CognomaeNuovo', 'nuovoa_utente', '3384381985', 'nuovoa_utente@example.com', '$2y$10$eGZQkXjbK0mgVDFxPVjcC.toaywmUz0zb1MniD8hYqPC1gajcGJhW', '2024-04-12 14:19:15'),
(8, 'NomeaNauovo', 'CognomaaeNuovo', 'nuovoa_autente', '3384381985', 'nuovoa_utentae@example.com', '$2y$10$LJEBTGnGKOLLXgHUn08A.uLji8G1Yg791XL7YKvrKAynz3S8RlrMu', '2024-04-12 14:31:59'),
(10, 'marius', 'noroaca', 'pyro', '3384381985', 'marius.noroaca@gmail.com', '$2y$10$AQvggA9YocjJuqWJZYqDZeZlCX4F5yh5hzJOZakUr7XMHVFN9Yv2W', '2024-04-14 09:51:38'),
(29, '1234', '1234', '4321', '3683244568', 'ciaotessst@test.com', '$2y$10$xeaqmwQCSZBDI.kL1pmE6ucyisRIYGHxES4j4rWcWemen0PirP1m.', '2024-05-19 21:15:14'),
(30, 'dsaw', 'wasd', 'sawd', '3547891245', 'wasd@wasd.com', '$2y$10$qQS.y/Ho88044mjZnj2/W.Wclf2FudU33w4J/xs8I..yI.yaNk16S', '2024-05-20 18:17:54');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utente_id` (`utente_id`),
  ADD KEY `servizio_id` (`servizio_id`);

--
-- Indici per le tabelle `prenotazioni_non_utenti`
--
ALTER TABLE `prenotazioni_non_utenti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servizio_id` (`servizio_id`);

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
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT per la tabella `prenotazioni_non_utenti`
--
ALTER TABLE `prenotazioni_non_utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
-- Limiti per la tabella `prenotazioni_non_utenti`
--
ALTER TABLE `prenotazioni_non_utenti`
  ADD CONSTRAINT `prenotazioni_non_utenti_ibfk_1` FOREIGN KEY (`servizio_id`) REFERENCES `services` (`id`);

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
