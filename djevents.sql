-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2021 at 10:00 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `djevents`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id_event` int(255) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `adresa` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `datum` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `vreme` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `opis` text COLLATE utf8_unicode_ci NOT NULL,
  `id_grad` int(255) NOT NULL,
  `status` tinyint(5) NOT NULL,
  `putanja` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id_event`, `naziv`, `adresa`, `datum`, `vreme`, `opis`, `id_grad`, `status`, `putanja`) VALUES
(18, 'Dj Night Party', 'Kralja Milutina 22', '2021-09-09', '21:30', 'Dodjite na najludju zurku u gradu i uzivajte uz najvrelije hitove ovoga leta.Za zagrevanje je tu nas Dj rexx, a posle na scenu stupa niko drugi nego Marko Moreno.', 17, 1, '1630164494-1.jpg'),
(19, 'Jezz Night', 'Uzicka 13', '2021-09-11', '21:00', 'Dobrodosli na jezz vece.Tu su za vas perfektni Mr Prefeckt i uvek atraktivni Jhon Doe', 19, 1, '1630164717-12.jpg'),
(20, 'Soul Free Party', 'Trg Djure Jakšića', '2021-09-08', '21:00', 'Dodjite na nezaboravnu zurku i izbacite sve iz sebe.Zaboravite na probleme,posao stres za trenutak i oslobodite svoju dusu.a', 27, 1, '1630164891-4.jpg'),
(21, 'White Sensation Party', 'Gradski Trg', '2021-09-11', '22:00', 'Obucite se u belu odevnu konbinaciju i dodjite na najludju zurku u gradu.Cekamo vas na gradskom trgu u Kragujevcu.', 25, 1, '1630165014-7.jpg'),
(22, 'Boom Boom Party', 'Kikindska 12', '2021-09-05', '21:00', 'Za kraj leta smo spremili nezaboravnu Boom Boom zurku.Zbog ogromnog interesovanja dodali smo jos karata.Ne cekajte nista i obezbedite vasu na vreme.', 29, 1, '1630165179-9.jpg'),
(23, 'Black And White', 'Zarka Zrenjanina 12', '2021-09-06', '21:00', 'Black and white zurka.Ispostujte dress code i dobijate poklon koktel.', 28, 1, '1630165387-10.jpg'),
(24, 'Trep Party', 'Sajmiste 23', '2021-09-09', '22:00', 'Dodjite na nazaboravno trep vece uz najvece hitove domace i strane trep scene.Za miksetom ce vas izludeti Vule i Dj Blue.Sve rezervacije traju do 22h.', 17, 1, '1630165605-2.jpg'),
(25, 'SOS Party', 'Hangar Beograd', '2021-09-08', '21:00', 'Dodjite na najludju rejv zurku u gradu.Za vas smo doveli velike zvezde sa nase  scene poput Dj Zu i Dj SS,a za kraj ce vas raspaliti svetski poznata i neponovljiva Nina', 17, 1, '1630166038-11.jpg'),
(27, 'Kraj Leta Party', 'Prvomajska 45', '2021-09-05', '21:00', 'Za kraj leta Dj Summer.Nepropustite najludju zurku u gradu i dodjite da se oprostimo od leta kako dolikuje', 24, 1, '1630167046-12.jpg'),
(28, 'Semafor Party', 'Usce BB', '2021-09-08', '23:00', 'Semafor partu na Uscu uz Ljanmija.', 17, 1, '1630167177-sem.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `event_izvodjac`
--

CREATE TABLE `event_izvodjac` (
  `id_event_izvodjac` int(255) NOT NULL,
  `id_izvodjac` int(255) NOT NULL,
  `id_event` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event_izvodjac`
--

INSERT INTO `event_izvodjac` (`id_event_izvodjac`, `id_izvodjac`, `id_event`) VALUES
(20, 25, 18),
(21, 26, 18),
(22, 27, 19),
(23, 28, 19),
(24, 29, 20),
(25, 30, 20),
(26, 31, 20),
(27, 32, 21),
(28, 33, 21),
(29, 34, 22),
(30, 35, 22),
(31, 36, 23),
(32, 37, 24),
(33, 38, 24),
(34, 39, 25),
(35, 40, 25),
(36, 41, 25),
(38, 43, 27),
(39, 44, 28);

-- --------------------------------------------------------

--
-- Table structure for table `grad`
--

CREATE TABLE `grad` (
  `id_grad` int(255) NOT NULL,
  `naziv` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grad`
--

INSERT INTO `grad` (`id_grad`, `naziv`) VALUES
(17, 'Beograd'),
(25, 'Kragujevac'),
(26, 'Kraljevo'),
(24, 'Niš'),
(19, 'Novi Sad'),
(28, 'Pančevo'),
(27, 'Subotica'),
(30, 'Valjevo'),
(29, 'Vršac');

-- --------------------------------------------------------

--
-- Table structure for table `izvodjaci`
--

CREATE TABLE `izvodjaci` (
  `id_izvodjac` int(255) NOT NULL,
  `naziv` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `izvodjaci`
--

INSERT INTO `izvodjaci` (`id_izvodjac`, `naziv`) VALUES
(31, 'Boss'),
(38, 'Dj Blue'),
(34, 'Dj Markoni'),
(29, 'Dj Rea'),
(25, 'Dj rexx'),
(32, 'Dj Rimda13'),
(35, 'Dj Silver'),
(40, 'Dj SS'),
(43, 'Dj Summer'),
(39, 'Dj Zu'),
(33, 'Dzoni00'),
(54, 'fedfsfds'),
(28, 'Jhon Doe'),
(44, 'Ljanmi'),
(26, 'Marko Moreno'),
(27, 'Mr Perfect'),
(41, 'Nina'),
(36, 'ReMa'),
(30, 'Veni Vidi'),
(37, 'Vule');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id_korisnik` int(255) NOT NULL,
  `ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(2) NOT NULL,
  `uloga` int(10) NOT NULL,
  `vreme_registracije` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id_korisnik`, `ime`, `prezime`, `email`, `lozinka`, `status`, `uloga`, `vreme_registracije`) VALUES
(1, 'Pera', 'Peric', 'pera@gmail.com', 'bb21a26301198c657a25e72f7b0f5149', 1, 1, '2021-08-25 19:47:40'),
(2, 'Marko', 'Peric', 'marko@gamil.com', '2e6c740729c44c12663c973965cbf698', 1, 2, '2021-08-25 20:02:12'),
(3, 'Marta', 'Mitic', 'mesic@gmail.cac', '16dd189ce58340d771bd0149098aade2', 1, 2, '2021-08-25 20:06:01'),
(4, 'Katarina', 'Pasic', 'malakaca@gmial.com', '22547deabc31bbac79f5e9f12617874e', 1, 2, '2021-08-25 20:09:01');

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

CREATE TABLE `uloge` (
  `id_uloge` int(255) NOT NULL,
  `naziv` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uloge`
--

INSERT INTO `uloge` (`id_uloge`, `naziv`) VALUES
(1, 'Admin'),
(2, 'Korisnik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `id_grad` (`id_grad`);

--
-- Indexes for table `event_izvodjac`
--
ALTER TABLE `event_izvodjac`
  ADD PRIMARY KEY (`id_event_izvodjac`),
  ADD KEY `id_izvodjac` (`id_izvodjac`),
  ADD KEY `id_event` (`id_event`);

--
-- Indexes for table `grad`
--
ALTER TABLE `grad`
  ADD PRIMARY KEY (`id_grad`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- Indexes for table `izvodjaci`
--
ALTER TABLE `izvodjaci`
  ADD PRIMARY KEY (`id_izvodjac`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id_korisnik`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `uloga` (`uloga`);

--
-- Indexes for table `uloge`
--
ALTER TABLE `uloge`
  ADD PRIMARY KEY (`id_uloge`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id_event` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `event_izvodjac`
--
ALTER TABLE `event_izvodjac`
  MODIFY `id_event_izvodjac` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `grad`
--
ALTER TABLE `grad`
  MODIFY `id_grad` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `izvodjaci`
--
ALTER TABLE `izvodjaci`
  MODIFY `id_izvodjac` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id_korisnik` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `uloge`
--
ALTER TABLE `uloge`
  MODIFY `id_uloge` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`id_grad`) REFERENCES `grad` (`id_grad`);

--
-- Constraints for table `event_izvodjac`
--
ALTER TABLE `event_izvodjac`
  ADD CONSTRAINT `event_izvodjac_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `events` (`id_event`),
  ADD CONSTRAINT `event_izvodjac_ibfk_2` FOREIGN KEY (`id_izvodjac`) REFERENCES `izvodjaci` (`id_izvodjac`) ON DELETE CASCADE;

--
-- Constraints for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD CONSTRAINT `korisnici_ibfk_1` FOREIGN KEY (`uloga`) REFERENCES `uloge` (`id_uloge`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
