-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 03 Lip 2024, 19:30
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ticketsystem`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `artists`
--

CREATE TABLE `artists` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Photo` varchar(50) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `artists`
--

INSERT INTO `artists` (`ID`, `Name`, `Photo`, `Description`) VALUES
(1, 'Bambi', 'bambi.webp', 'Co to mówić hot raperka młodego pokolenia, git totalny!'),
(2, 'Young Leosia', 'leosia.jpg', 'Klasa sama w sobie, równie piękna co popularna raperka!'),
(3, 'Lady Pank', 'ladypank.jpeg', 'Lady Pank to jeden z najbardziej znanych polskich zespołów rockowych, który powstał z inicjatywy Jana Borysewicza. '),
(4, 'Bajm', 'bajm.jpg', 'Zespół który śpiewa: \"Jesteś steeerem, białym żołnierzem!\"');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_total` decimal(10,2) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `post` varchar(100) NOT NULL,
  `zip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_total`, `fullname`, `email`, `address`, `city`, `post`, `zip`) VALUES
(21, 9, '1849.95', 'Kacper Ziubiński', 'kacperziubinski@gmail.com', '3-go maja', 'Rudzienko', 'Kołbiel', '05-340'),
(22, 9, '739.98', 'Kacper Ziubiński', 'kacperziubinski@gmail.com', '3-go maja', 'Rudzienko', 'Kołbiel', '05-340');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_name`, `price`, `quantity`) VALUES
(49, 21, 'Bilet ULTRA', '369.99', 2),
(50, 21, 'Bilet ULTRA', '369.99', 3),
(51, 22, 'Bilet ULTRA', '369.99', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tickets`
--

CREATE TABLE `tickets` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Included` text NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `tickets`
--

INSERT INTO `tickets` (`ID`, `Name`, `Included`, `Price`) VALUES
(1, 'Standard', '<ul>\r\n                <li>Koncerty</li>\r\n                <li>Darmowy parking</li>\r\n                <li>Dostęp do strefy gastro</li>\r\n            </ul>', 69.99),
(3, 'VIP', '<ul>\r\n                <li>Koncerty</li>\r\n                <li>Strzeżony parking VIP</li>\r\n                <li>Dostęp do strefy Gastro VIP</li>\r\n                <li>Wejście bez kolejki</li>\r\n                <li>Dostęp do strefy CHILL</li>\r\n            </ul>', 169.99),
(5, 'ULTRA', '<ul>\r\n                <li>Koncerty</li>\r\n                <li>Strzeżony parking VIP</li>\r\n                <li>Dostęp do strefy Gastro VIP</li>\r\n                <li>Wejście bez kolejki</li>\r\n                <li>Dostęp do strefy CHILL</li>\r\n                <li>Afterparty z artystami</li>\r\n                <li>Obecność na backstage\'u</li>\r\n            </ul>', 369.99);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(5, 'kacper', 'kacperziubinski@gmail.com', '9eecf460b57b6f392e2b33ff8a8392d4', 'user', '2024-07-01 15:37:06'),
(8, 'admin', 'kontakt@ziubinski.pl', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2024-07-01 20:15:52'),
(9, 'bartek', 'ziub@ek.pl', '9eecf460b57b6f392e2b33ff8a8392d4', 'user', '2024-07-02 07:16:32');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indeksy dla tabeli `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `artists`
--
ALTER TABLE `artists`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT dla tabeli `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT dla tabeli `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
