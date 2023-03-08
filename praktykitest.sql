-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 08 Mar 2023, 12:12
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
-- Baza danych: `praktykitest`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adres`
--

CREATE TABLE `adres` (
  `ID` int(11) NOT NULL,
  `Gmina` varchar(80) NOT NULL,
  `Miejscowosc` varchar(80) NOT NULL,
  `Ulica` varchar(80) NOT NULL,
  `Kod pocztowy` varchar(6) NOT NULL,
  `Poczta` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kandydat`
--

CREATE TABLE `kandydat` (
  `ID` int(11) NOT NULL,
  `Nazwisko` varchar(80) NOT NULL,
  `Imie` varchar(80) NOT NULL,
  `Drugie imie` varchar(80) DEFAULT NULL,
  `Data urodzenia` date NOT NULL,
  `Miejsce urodzenia` varchar(80) NOT NULL,
  `Pesel` int(11) NOT NULL,
  `nr telefonu` varchar(15) DEFAULT NULL,
  `Mail` varchar(255) NOT NULL,
  `AdresID` int(11) NOT NULL,
  `ZameldowanieID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `opiekun`
--

CREATE TABLE `opiekun` (
  `ID` int(11) NOT NULL,
  `Nazwisko` varchar(80) NOT NULL,
  `Imie` varchar(80) NOT NULL,
  `nr telefonu` varchar(15) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `AdresID` int(11) NOT NULL,
  `KandydatID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wniosek`
--

CREATE TABLE `wniosek` (
  `ID` int(11) NOT NULL,
  `KandydatID` int(11) NOT NULL,
  `Kierunek1` varchar(80) NOT NULL,
  `Kierunek2` varchar(80) DEFAULT NULL,
  `Kierunek3` varchar(80) DEFAULT NULL,
  `szkola` varchar(255) NOT NULL,
  `Data` date NOT NULL DEFAULT current_timestamp(),
  `Godzina` time NOT NULL DEFAULT current_timestamp()
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
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Pesel` (`Pesel`);

--
-- Indeksy dla tabeli `opiekun`
--
ALTER TABLE `opiekun`
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
-- AUTO_INCREMENT dla tabeli `opiekun`
--
ALTER TABLE `opiekun`
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
