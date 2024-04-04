-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 04, 2024 alle 20:44
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
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `duration`) VALUES
(1, 'Micro pigmentazione', 350.00, NULL),
(2, 'Ritocco annuale', 200.00, NULL),
(3, 'Eye-liner infracigliare', 350.00, NULL),
(4, 'Eye-liner sfumato', 350.00, NULL),
(5, 'Trucco semi permanente labbra', 350.00, NULL),
(6, 'Micro needling', 150.00, NULL),
(7, 'Hydramethod', 60.00, NULL),
(8, 'Acidi specifici', 100.00, NULL),
(9, 'Laminazione', 80.00, NULL),
(10, 'Laminazione e colorazione', 75.00, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `services_types`
--

CREATE TABLE `services_types` (
  `service_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL
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
-- Struttura della tabella `servizi_tipi_servizi`
--

CREATE TABLE `servizi_tipi_servizi` (
  `servizio_id` int(11) NOT NULL,
  `tipo_servizio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `tipi_servizi`
--

CREATE TABLE `tipi_servizi` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'Sopracciglia'),
(2, 'Occhi'),
(3, 'Trucco'),
(4, 'Trattamenti viso'),
(5, 'Ciglia');

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
-- Indici per le tabelle scaricate
--

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
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `services_types`
--
ALTER TABLE `services_types`
  ADD KEY `service_id` (`service_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indici per le tabelle `servizi_tipi_servizi`
--
ALTER TABLE `servizi_tipi_servizi`
  ADD KEY `servizio_id` (`servizio_id`),
  ADD KEY `tipo_servizio_id` (`tipo_servizio_id`);

--
-- Indici per le tabelle `tipi_servizi`
--
ALTER TABLE `tipi_servizi`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

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
-- AUTO_INCREMENT per la tabella `tipi_servizi`
--
ALTER TABLE `tipi_servizi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Limiti per la tabella `services_types`
--
ALTER TABLE `services_types`
  ADD CONSTRAINT `services_types_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `services_types_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);

--
-- Limiti per la tabella `servizi_tipi_servizi`
--
ALTER TABLE `servizi_tipi_servizi`
  ADD CONSTRAINT `servizi_tipi_servizi_ibfk_1` FOREIGN KEY (`servizio_id`) REFERENCES `services` (`id`),
  ADD CONSTRAINT `servizi_tipi_servizi_ibfk_2` FOREIGN KEY (`tipo_servizio_id`) REFERENCES `tipi_servizi` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
