-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2022 at 09:37 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

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
-- Table structure for table `cena`
--

CREATE TABLE `cena` (
  `id_cena` int(11) NOT NULL,
  `cena` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cena`
--

INSERT INTO `cena` (`id_cena`, `cena`) VALUES
(4, '500'),
(5, '200'),
(6, '0'),
(7, '400'),
(8, '999'),
(9, '800'),
(10, '499');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id_event` int(255) NOT NULL,
  `naziv` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresa` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datum` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vreme` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opis` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_grad` int(255) NOT NULL,
  `status` tinyint(5) NOT NULL,
  `putanja` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_cena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id_event`, `naziv`, `adresa`, `datum`, `vreme`, `opis`, `id_grad`, `status`, `putanja`, `id_cena`) VALUES
(1, 'Boom Boom Party', 'Kragujevacka 44', '2022-08-24', '22:00', 'Dodjite na nezaboravnu zurku u Beogradu.Za vas nastupaju fenomenalni Dj Vuk i pretalentovana Rea.Upad je samo 200din.Ovakva prilika za dobrim provodom se ne propusta', 1, 1, '1648253804-1630164494-1.jpg', 5),
(2, 'Soul Free', 'Novosadski kej BB', '2022-06-23', '00:00', 'Novosadsko magicno veca za pamacenje.Dodjite u prestonicu nocnog zivota i dobrog provoda.Pozovite drustvo i zabavite se kao nikada do sad.Za vas nastupa jedan jedni Dj Free zajedno sa Markom Morenom.', 2, 1, '1648254088-1630165605-2.jpg', 4),
(3, 'Black And White', 'Niska tvrdjava BB', '2022-08-03', '21:00', 'Grad Nis organizuje zurku koju ne smete propustiti.Na nasoj tvrdjavi dolaze velike muzicke zvezde iz regiona i ulaz je potpune besplatan.Ima li boljeg povoda da dodjete i da se druzimo do kasno.', 3, 1, '1648254247-1630164891-4.jpg', 6),
(4, 'White Sensation', 'Trg Nikole Djurica 21', '2022-07-06', '21:10', 'Obucite se u belo i dodjite na ludu zurku.Uslovi za ulazak u klub je dobra volja i bele garderoba.Ko ispostuje uslove ne placa ulaz.Za dobru atmosferu ce se pobrinuti grupa Veni Vidi.', 8, 1, '1648254459-1630165014-7.jpg', 7),
(5, 'Jezz Vece', 'Proleterska 32', '2022-07-24', '23:00', 'Ko ne zeli da uziva u jezz muzici.U Proletersko ulici se organizuje vece jezz muzike.', 1, 1, '1648254617-1630164717-12.jpg', 6),
(6, 'Rainy Party', 'Zarka Zrenjanina 212', '2022-08-06', '22:00', 'U Pancevu se organizuje Raiy zurka.Ulaz je ogranicen za ljude koji imaju vise od 18 godina.Najvece hitove godine pustace Kimi i Dj Vuk.', 5, 1, '1648254774-1630165179-9.jpg', 8),
(7, 'NoName Party', 'Gradski Trg BB', '2022-06-20', '22:00', 'Najludja zurka ikada u ovom gradu.Najvruci Dj Boss samo za Vas.Spremite se jer polecemo!!!!', 6, 1, '1648254886-1630165387-10.jpg', 6),
(8, 'LOL', 'Svetoza Miletiva 21', '2022-06-17', '22:00', 'Dj wow i DJ Vuk samo za vas.Duo nedelje meseca godine je tu.Nikad zesca zurka vas ocekuje.Ulaz je 800 din uz to dobijete 2 pica gratis.', 7, 1, '1648255031-1630166038-11.jpg', 9),
(9, 'Moly Party', 'Pavla Djurica 12', '2022-06-03', '21:00', 'Dj Moly pravi Moly Party.Jednostano i mocno.Ulaz samo 499din.Najbolja haouse muzika samo za vas.', 2, 1, '1648255145-1630167046-12.jpg', 10),
(10, 'Electric Party', 'Kneza Milosa 21', '2022-07-01', '22:00', 'Elektro muzika je u vasem gradu.Dojite da razdrmamo svako celiju u vasem telu.', 4, 1, '1648255222-1630167177-sem.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `event_izvodjac`
--

CREATE TABLE `event_izvodjac` (
  `id_event_izvodjac` int(255) NOT NULL,
  `id_izvodjac` int(255) NOT NULL,
  `id_event` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_izvodjac`
--

INSERT INTO `event_izvodjac` (`id_event_izvodjac`, `id_izvodjac`, `id_event`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 4, 2),
(5, 2, 3),
(6, 5, 3),
(7, 6, 4),
(8, 7, 5),
(9, 8, 6),
(10, 1, 6),
(11, 9, 7),
(12, 10, 8),
(13, 1, 8),
(14, 11, 9),
(15, 12, 10),
(16, 2, 10),
(17, 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `grad`
--

CREATE TABLE `grad` (
  `id_grad` int(255) NOT NULL,
  `naziv` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grad`
--

INSERT INTO `grad` (`id_grad`, `naziv`) VALUES
(1, 'Beograd'),
(2, 'Novi Sad'),
(3, 'Nis'),
(4, 'Kragujevac'),
(5, 'Pancevo'),
(6, 'Subotica'),
(7, 'Valjevo'),
(8, 'Smederevo\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `izvodjaci`
--

CREATE TABLE `izvodjaci` (
  `id_izvodjac` int(255) NOT NULL,
  `naziv` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `izvodjaci`
--

INSERT INTO `izvodjaci` (`id_izvodjac`, `naziv`) VALUES
(9, 'Dj Boss'),
(3, 'Dj Free'),
(11, 'Dj Moly'),
(1, 'Dj Vuk'),
(10, 'Dj wow'),
(7, 'Guru'),
(8, 'Kimi'),
(4, 'Marko Moreno'),
(2, 'Rea'),
(6, 'Veni Vidi'),
(12, 'Vule'),
(5, 'XYZ');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id_korisnik` int(255) NOT NULL,
  `ime` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lozinka` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(2) NOT NULL,
  `uloga` int(10) NOT NULL,
  `vreme_registracije` int(11) NOT NULL DEFAULT current_timestamp(),
  `recovery_key` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id_korisnik`, `ime`, `prezime`, `email`, `lozinka`, `status`, `uloga`, `vreme_registracije`, `recovery_key`) VALUES
(4, 'Marko', 'Markovic', 'marko@gamil.com', '2e6c740729c44c12663c973965cbf698', 1, 2, 2147483647, NULL),
(5, 'Nikola', 'Nikolic', 'nikola@gmail.com', 'e8f8b0cf7e6f4267e0bce864db0ac20c', 1, 1, 1559, NULL),
(6, 'Test', 'Test', 'djeventsapp@gmail.com', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 1, 2, 2147483647, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE `meni` (
  `id_meni` int(255) NOT NULL,
  `naziv` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `putanja` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prikaz_nav` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`id_meni`, `naziv`, `putanja`, `prikaz_nav`) VALUES
(1, 'Dogadjaji', '?page=events', 1),
(2, 'Autor', '?page=author', 1),
(3, 'Admin', '?page=admin', 3),
(4, 'Dodaj dogadjaj', '?page=admin-insert', 4),
(5, 'Svi dogadjaji', '?page=admin-select', 4),
(6, 'Svi korisnici', '?page=admin-users', 4);

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

CREATE TABLE `uloge` (
  `id_uloge` int(255) NOT NULL,
  `naziv` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `cena`
--
ALTER TABLE `cena`
  ADD PRIMARY KEY (`id_cena`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `id_grad` (`id_grad`),
  ADD KEY `id_cena` (`id_cena`);

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
  ADD PRIMARY KEY (`id_grad`);

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
-- Indexes for table `meni`
--
ALTER TABLE `meni`
  ADD PRIMARY KEY (`id_meni`);

--
-- Indexes for table `uloge`
--
ALTER TABLE `uloge`
  ADD PRIMARY KEY (`id_uloge`),
  ADD UNIQUE KEY `naziv` (`naziv`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cena`
--
ALTER TABLE `cena`
  MODIFY `id_cena` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id_event` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `event_izvodjac`
--
ALTER TABLE `event_izvodjac`
  MODIFY `id_event_izvodjac` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `grad`
--
ALTER TABLE `grad`
  MODIFY `id_grad` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `izvodjaci`
--
ALTER TABLE `izvodjaci`
  MODIFY `id_izvodjac` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id_korisnik` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `meni`
--
ALTER TABLE `meni`
  MODIFY `id_meni` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`id_grad`) REFERENCES `grad` (`id_grad`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`id_cena`) REFERENCES `cena` (`id_cena`);

--
-- Constraints for table `event_izvodjac`
--
ALTER TABLE `event_izvodjac`
  ADD CONSTRAINT `event_izvodjac_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `events` (`id_event`),
  ADD CONSTRAINT `event_izvodjac_ibfk_2` FOREIGN KEY (`id_izvodjac`) REFERENCES `izvodjaci` (`id_izvodjac`);

--
-- Constraints for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD CONSTRAINT `korisnici_ibfk_1` FOREIGN KEY (`uloga`) REFERENCES `uloge` (`id_uloge`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
