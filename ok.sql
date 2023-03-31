-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 31 Mar 2023, 12:00
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ok`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adres`
--

CREATE TABLE `adres` (
  `ID` int(11) NOT NULL,
  `Miejscowosc` varchar(60) NOT NULL,
  `Ulica` varchar(80) NOT NULL,
  `Kod pocztowy` varchar(6) NOT NULL,
  `Gmina` varchar(60) DEFAULT NULL,
  `Poczta` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kandydat`
--

CREATE TABLE `kandydat` (
  `ID` int(11) NOT NULL,
  `Nazwisko` varchar(60) NOT NULL,
  `Imie` varchar(60) NOT NULL,
  `Drugie imie` varchar(60) DEFAULT NULL,
  `Data urodzenia` date NOT NULL,
  `Miejsce urodzenia` varchar(60) NOT NULL,
  `PESEL` varchar(11) NOT NULL,
  `Numer telefonu` varchar(15) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `ID Adres` int(11) NOT NULL,
  `ID Zameldowania` int(11) NOT NULL,
  `ID Oceny` int(11) NOT NULL,
  `ID Osiagniecia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oceny`
--

CREATE TABLE `oceny` (
  `ID` int(11) NOT NULL,
  `Zachowanie` varchar(20) NOT NULL,
  `Egzamin polski` int(3) NOT NULL,
  `Egzamin matematyka` tinyint(2) NOT NULL,
  `Egzamin jezyk obcy` tinyint(2) NOT NULL,
  `Polski` tinyint(2) NOT NULL,
  `Matematyka` tinyint(2) NOT NULL,
  `Jezyk obcy` tinyint(2) NOT NULL,
  `Geografia` tinyint(2) DEFAULT NULL,
  `Informatyka` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `opieka`
--

CREATE TABLE `opieka` (
  `ID` int(11) NOT NULL,
  `ID Kandydata` int(11) NOT NULL,
  `ID Opiekuna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `opiekun`
--

CREATE TABLE `opiekun` (
  `ID` int(11) NOT NULL,
  `Nazwisko` varchar(60) NOT NULL,
  `Imie` varchar(60) NOT NULL,
  `Numer telefonu` varchar(15) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `ID Adres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `osiagniecia`
--

CREATE TABLE `osiagniecia` (
  `ID` int(11) NOT NULL,
  `wyroznienie1` tinyint(2) DEFAULT NULL,
  `wyroznienie2` tinyint(2) DEFAULT NULL,
  `wyroznienie3` tinyint(2) DEFAULT NULL,
  `wyroznienie4` tinyint(2) DEFAULT NULL,
  `wyroznienie5` tinyint(2) DEFAULT NULL,
  `wyroznienie6` tinyint(2) DEFAULT NULL,
  `wyroznienie7` tinyint(2) DEFAULT NULL,
  `wyroznienie8` tinyint(2) DEFAULT NULL,
  `wyroznienie9` tinyint(2) DEFAULT NULL,
  `wyroznienie10` tinyint(2) DEFAULT NULL,
  `wyroznienie11` tinyint(2) DEFAULT NULL,
  `wyroznienie12` tinyint(2) DEFAULT NULL,
  `wyroznienie13` tinyint(2) DEFAULT NULL,
  `wyroznienie14` tinyint(2) DEFAULT NULL,
  `wyroznienie15` tinyint(2) DEFAULT NULL,
  `wyroznienie16` tinyint(2) DEFAULT NULL,
  `wyroznienie17` tinyint(2) DEFAULT NULL,
  `wyroznienie18` tinyint(2) DEFAULT NULL,
  `wyroznienie19` tinyint(2) DEFAULT NULL,
  `wyroznienie20` tinyint(2) DEFAULT NULL,
  `wyroznienie21` tinyint(2) DEFAULT NULL,
  `wyroznienie22` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wniosek`
--

CREATE TABLE `wniosek` (
  `ID` int(11) NOT NULL,
  `Data` date NOT NULL DEFAULT current_timestamp(),
  `Godzina` time NOT NULL DEFAULT current_timestamp(),
  `Kierunek1` varchar(80) NOT NULL,
  `Kierunek2` varchar(80) DEFAULT NULL,
  `Kierunek3` varchar(80) DEFAULT NULL,
  `Szkola` varchar(255) NOT NULL,
  `ID Kandydat` int(11) NOT NULL,
  `Punkty informatyka` int(11) DEFAULT NULL,
  `Punkty geografia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adres`
--
ALTER TABLE `adres`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `kandydat`
--
ALTER TABLE `kandydat`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `oceny`
--
ALTER TABLE `oceny`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `opieka`
--
ALTER TABLE `opieka`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `opiekun`
--
ALTER TABLE `opiekun`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `osiagniecia`
--
ALTER TABLE `osiagniecia`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `wniosek`
--
ALTER TABLE `wniosek`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `adres`
--
ALTER TABLE `adres`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `kandydat`
--
ALTER TABLE `kandydat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `oceny`
--
ALTER TABLE `oceny`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `opieka`
--
ALTER TABLE `opieka`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `opiekun`
--
ALTER TABLE `opiekun`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `osiagniecia`
--
ALTER TABLE `osiagniecia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `wniosek`
--
ALTER TABLE `wniosek`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
