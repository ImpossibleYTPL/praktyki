-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Mar 2023, 10:46
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
  `PESEL` int(11) NOT NULL,
  `Numer telefonu` varchar(15) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `ID Adres` int(11) NOT NULL,
  `ID Zameldowania` int(11) NOT NULL,
  `ID Oceny` int(11) NOT NULL,
  `ID Osiagniecia` int(11) NOT NULL,
  `ID Kryteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kryteria`
--

CREATE TABLE `kryteria` (
  `ID` int(11) NOT NULL,
  `Problemy zdrowotne` tinyint(1) NOT NULL,
  `Wielodzietnosc rodziny` tinyint(1) NOT NULL,
  `Niepelnosprawnosc kandydata` tinyint(1) NOT NULL,
  `Niepelnosprawnosc dziecka kandydata` tinyint(1) NOT NULL,
  `Niepelnosprawnosc innej osoby` tinyint(1) NOT NULL,
  `Samotnie wychowywane dziecko` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oceny`
--

CREATE TABLE `oceny` (
  `ID` int(11) NOT NULL,
  `Zachowanie` varchar(15) NOT NULL,
  `Egzamin polski` int(3) DEFAULT NULL,
  `Egzamin angielski` int(3) DEFAULT NULL,
  `Egzamin matematyka` int(3) DEFAULT NULL,
  `Polski` int(1) NOT NULL,
  `Angielski` int(1) NOT NULL,
  `Niemiecki` int(1) DEFAULT NULL,
  `Rosyjski` int(1) DEFAULT NULL,
  `Historia` int(1) NOT NULL,
  `Wiedza o społeczenstwie` int(1) NOT NULL,
  `Matematyka` int(1) NOT NULL,
  `Chemia` int(1) NOT NULL,
  `Fizyka` int(1) NOT NULL,
  `Geografia` int(1) NOT NULL,
  `Biologia` int(1) NOT NULL,
  `Przyroda` int(1) NOT NULL,
  `Muzyka` int(1) NOT NULL,
  `Technika` int(1) NOT NULL,
  `Edukacja dla bezpieczeństwa` int(1) NOT NULL,
  `Plastyka` int(1) NOT NULL,
  `Religia/Etyka` int(1) DEFAULT NULL,
  `Wychowanie fizyczne` int(1) DEFAULT NULL
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
  `1` tinyint(1) NOT NULL,
  `2` tinyint(1) NOT NULL,
  `3` tinyint(1) NOT NULL,
  `4` tinyint(1) NOT NULL,
  `5` tinyint(1) NOT NULL,
  `6` tinyint(1) NOT NULL,
  `7` tinyint(1) NOT NULL,
  `8` tinyint(1) NOT NULL,
  `9` tinyint(1) NOT NULL,
  `10` tinyint(1) NOT NULL,
  `11` tinyint(1) NOT NULL,
  `12` tinyint(1) NOT NULL,
  `13` tinyint(1) NOT NULL,
  `14` tinyint(1) NOT NULL,
  `15` tinyint(1) NOT NULL,
  `16` tinyint(1) NOT NULL,
  `17` tinyint(1) NOT NULL,
  `18` tinyint(1) NOT NULL,
  `19` tinyint(1) NOT NULL,
  `20` tinyint(1) NOT NULL,
  `21` tinyint(1) NOT NULL,
  `22` tinyint(1) NOT NULL,
  `23` tinyint(1) NOT NULL,
  `24` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wniosek`
--

CREATE TABLE `wniosek` (
  `ID` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Godzina` time NOT NULL,
  `Kierunek1` varchar(80) NOT NULL,
  `Kierunek2` varchar(80) NOT NULL,
  `Kierunek3` varchar(80) NOT NULL,
  `Szkola` varchar(255) NOT NULL,
  `ID Kandydat` int(11) NOT NULL,
  `Punkty` int(11) NOT NULL
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
-- Indeksy dla tabeli `kryteria`
--
ALTER TABLE `kryteria`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `oceny`
--
ALTER TABLE `oceny`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Angielski` (`Angielski`);

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
-- AUTO_INCREMENT dla tabeli `kryteria`
--
ALTER TABLE `kryteria`
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

  --
  --TRIGGER
  --
  CREATE TRIGGER `Sprawdz kod pocztowy` BEFORE INSERT ON `adres`
 FOR EACH ROW BEGIN
  IF NEW.`Kod pocztowy` NOT REGEXP '^[0-9]{2}-[0-9]{3}$' THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Nieprawidłowy kod pocztowy';
  END IF;
END
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
