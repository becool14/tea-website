-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Lut 2024, 23:13
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
-- Baza danych: `tea-website`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contactform`
--

CREATE TABLE `contactform` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `contact_email` varchar(50) NOT NULL,
  `subject` text NOT NULL,
  `file_contact` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `contactform`
--

INSERT INTO `contactform` (`id`, `firstname`, `lastname`, `contact_email`, `subject`, `file_contact`) VALUES
(19, 'Maksym', 'Moroz', 'maxmoro2004@gmail.com', '21r132tr', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontakt`
--

CREATE TABLE `kontakt` (
  `id` int(11) NOT NULL,
  `imie` varchar(255) NOT NULL,
  `nazwisko` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `kontakt`
--

INSERT INTO `kontakt` (`id`, `imie`, `nazwisko`, `email`, `created_at`) VALUES
(10, 'Максим', 'Мороз', 'maxmoro2004@gmail.com', '2024-02-02 13:13:05'),
(11, 'Maksym', 'Moroz', 'maxmoro2004@gmail.com', '2024-02-02 13:17:17'),
(12, 'Максим', 'Мороз', 'maxmoro2004@gmail.com', '2024-02-02 13:18:09'),
(13, 'Максим', 'Мороз', 'maxmoro2004@gmail.com', '2024-02-02 15:10:55');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `koszyk`
--

CREATE TABLE `koszyk` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `towary`
--

CREATE TABLE `towary` (
  `id` int(11) NOT NULL,
  `nazwa_towaru` varchar(255) NOT NULL,
  `cena` decimal(10,2) NOT NULL,
  `file_path_to_img` varchar(255) NOT NULL,
  `typ_towaru` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `towary`
--

INSERT INTO `towary` (`id`, `nazwa_towaru`, `cena`, `file_path_to_img`, `typ_towaru`) VALUES
(6, 'Cute Cat Clay Figurine', '15.99', 'media/cat_tea_pet_0.jpg', 'sales'),
(7, 'Cute Cat Clay Figurine', '15.99', 'media/cat_tea_pet_0.jpg', 'sales'),
(8, 'Cute Cat Clay Figurine', '15.99', 'media/cat_tea_pet_0.jpg', 'sales'),
(9, 'West Lake Dragon Well Tea', '16.99', 'media/longjing_.jpg', 'green_tea'),
(10, 'West Lake Dragon Well Tea', '16.99', 'media/longjing_.jpg', 'green_tea'),
(11, 'West Lake Dragon Well Tea', '16.99', 'media/longjing_.jpg', 'green_tea'),
(12, 'West Lake Dragon Well Tea', '16.99', 'media/longjing_.jpg', 'green_tea'),
(13, 'Keemun Tea (Qimen Tea)', '12.99', 'media/qimen_black_tea.jpg', 'black_tea'),
(14, 'Keemun Tea (Qimen Tea)', '12.99', 'media/qimen_black_tea.jpg', 'black_tea'),
(15, 'Keemun Tea (Qimen Tea)', '12.99', 'media/qimen_black_tea.jpg', 'black_tea'),
(16, 'Keemun Tea (Qimen Tea)', '12.99', 'media/qimen_black_tea.jpg', 'black_tea');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `contactform`
--
ALTER TABLE `contactform`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `kontakt`
--
ALTER TABLE `kontakt`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeksy dla tabeli `towary`
--
ALTER TABLE `towary`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `contactform`
--
ALTER TABLE `contactform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT dla tabeli `kontakt`
--
ALTER TABLE `kontakt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT dla tabeli `towary`
--
ALTER TABLE `towary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `koszyk`
--
ALTER TABLE `koszyk`
  ADD CONSTRAINT `koszyk_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `towary` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
