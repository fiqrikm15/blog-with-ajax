-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2018 at 06:49 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `idts`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id_article` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `title` varchar(1000) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `content` text,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Publish','Draft','Unpublish') DEFAULT NULL,
  `tgl_create` date DEFAULT NULL,
  `last_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id_article`, `id_user`, `title`, `slug`, `content`, `image`, `status`, `tgl_create`, `last_update`) VALUES
(14, 15, 'Lorem Ipsum', 'Lorem-Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquet in lorem quis hendrerit. Vivamus varius, enim ac laoreet tincidunt, sem nisl pulvinar dolor, eu ullamcorper turpis arcu eu tortor. Integer vehicula urna lorem, sit amet molestie turpis tempor sed. Fusce tempus lorem sed diam suscipit dictum. Nunc varius ligula sollicitudin metus luctus, vehicula elementum diam pretium. Ut gravida faucibus malesuada. In hac habitasse platea dictumst.<br />\n<br />\nAenean lorem odio, tincidunt sit amet enim ac, posuere rhoncus ligula. Vivamus aliquam mi enim, eu interdum lorem ultricies nec. Aenean non finibus metus. Vestibulum eleifend odio sit amet ultricies euismod. Aenean at mi vitae neque hendrerit feugiat. Duis faucibus bibendum nibh id sodales. Donec sit amet feugiat nisl, id aliquet felis.<br />\n<br />\nUt ut tempus metus, et pulvinar risus. Duis vitae diam rutrum, lobortis justo vel, semper justo. Vivamus orci erat, malesuada sit amet mollis vitae, tempus quis nunc. Nullam molestie arcu non erat euismod, sed vehicula lacus vehicula. Vivamus tristique erat eget nunc feugiat gravida. Donec rutrum ornare lectus et ultricies. Curabitur auctor pretium neque, a porta est euismod id. Proin sed mattis elit, vitae tempor ligula. Donec sed pellentesque est. Fusce nec auctor tortor. Cras vel bibendum nulla, sit amet vulputate ligula. Aenean placerat sem sit amet elit lobortis, eget aliquam tortor aliquet. Maecenas rutrum vel lorem a lobortis.<br />\n<br />\nMaecenas arcu magna, ultricies id tempus sed, interdum quis mi. Nulla dignissim commodo urna vel sagittis. Cras risus elit, egestas ut leo sed, gravida bibendum est. Nullam id sollicitudin purus. Vivamus porttitor nisi eget convallis porta. Sed ultricies, augue vel scelerisque viverra, diam justo tempus magna, sit amet lacinia lorem mi at nisl. Donec lorem ex, rutrum sit amet nisl eu, suscipit gravida ligula. In id mi dictum, dignissim felis quis, suscipit orci. Phasellus lacus turpis, elementum at tortor condimentum, pharetra euismod eros. Curabitur vitae convallis eros. Nam tempor velit quis mi dignissim mollis. Praesent non erat nec felis ultrices commodo. Phasellus ac commodo ante. Mauris mi leo, rutrum id velit vel, gravida pulvinar mauris. Morbi elementum sagittis turpis vitae fermentum.<br />\n<br />\nPraesent eget turpis eu nulla ultrices semper. Donec nec odio nec erat gravida imperdiet non nec sapien. Donec sodales augue vitae metus congue sollicitudin. Vivamus rutrum nisi euismod sodales scelerisque. Nunc in molestie dolor, id porta ligula. Fusce dapibus laoreet justo, ac molestie enim imperdiet a. Donec vestibulum justo ac metus consequat, in posuere ipsum dignissim. Vivamus congue nunc at augue vestibulum feugiat. ', '6369fb00e325449c83d7ca1fb4da3895.jpg', 'Publish', '2018-04-02', '2018-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `j_kelamin` enum('Pria','Wanita') NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `kode_pos` varchar(5) NOT NULL,
  `agama` enum('Islam','Kristen','Hindu','Budha') NOT NULL,
  `foto_profile` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `username`, `password`, `j_kelamin`, `alamat`, `kode_pos`, `agama`, `foto_profile`) VALUES
(15, 'fiqri khoirul muttaqin', 'fiqrikhoirul@yahoo.com', 'fiqrikm15', '680d9fdd92598637f0e23fc380221b76', 'Pria', 'Bandung Barat ', '40552', 'Islam', '519b2467a71bb7f06ca5beed8f404683.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `FK_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
