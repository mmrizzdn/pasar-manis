-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2023 at 12:55 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pasar_manis`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `gambar` longblob NOT NULL,
  `name` varchar(30) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `price` int(20) NOT NULL,
  `umkm_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `gambar`, `name`, `deskripsi`, `price`, `umkm_id`) VALUES
(6, 0x2e2e2f6d656e752f32646531616238633132656461623262386331333739323166373539343337622e6a7067, 'Dimsum Udang ', 'Dimsum ini merupakan menu yang terdapat di Kubaro Dimsum, harga diatas merupakan harga perporsi dengan ini 4 setiap porsinya', 12000, 22),
(7, 0x2e2e2f6d656e752f363462623930373165346166352e6a7067, 'Gyoza ', 'Gyoza ini merupakan salah satu makanan yang terdapat di Kubaro Dimsum harga diatas merupakan harga per porsi, dengan isian 4.', 12000, 22),
(8, 0x2e2e2f6d656e752f39663130326461376165653536396335646135656636353664306438623061322e6a7067, 'Dimsum Ayam', 'Dimsum ayam ini merupakan salahsatu makanan favorit dari Kubaro Dimsum, setiap porsi terdapat 4 biji dimsum.', 12000, 22),
(9, 0x2e2e2f6d656e752f363462623937333864323031352e6a7067, 'Crepes Chocolate', 'crepes ini menggunakan bahan-bahan yang premium sehinngga tidak perlu diragukan untuk rasa dan kualitas dari crepes ini, chocolate merupakan crepes favorit dari Murita Crepes.', 7000, 26),
(10, 0x2e2e2f6d656e752f363462623938313262666663372e6a7067, 'Martabak Manis', 'martabak manis ini kuliner paling favorit dari Martabak AF', 19000, 24),
(11, 0x2e2e2f6d656e752f363462623938643063646338302e6a7067, 'Martaabak Telur', 'martabak Telur ini menggunakan bahan bahan yang masih fresh sehingga membuat martabak telur ini memiliki citarasa yang gurih dan nikmat.', 24000, 24),
(12, 0x2e2e2f6d656e752f363462623962373134306234322e6a7067, 'Lumpia Ayam', 'Lumpia ayam ini merupakan salah satu makanan favorit dengan harga terjangkau dan isi yang melimpah, harga yang ditawarkan merupakan harga per porsi yang berisi 1 lumpia ukuran besar. ', 10000, 25),
(13, 0x2e2e2f6d656e752f6275726765722e2e6a7067, 'Burger Daging', 'Burger daging ini menggunakan daging sapi pilihan, Sehingga membuat burger ini sangat nikmat dan enak.', 25000, 28),
(14, 0x2e2e2f6d656e752f6b6562616e2e2e6a7067, 'Kebab', 'kebab ini merupakan best seller dari deman kebab burger, menggunakan bahan bahan pilihan menjadikan kebab ini memiliki citarasa yang berbeda dari kebab yang lain.', 17000, 28);

-- --------------------------------------------------------

--
-- Table structure for table `umkm`
--

CREATE TABLE `umkm` (
  `umkm_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `gambar` longblob NOT NULL,
  `owner` varchar(30) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `deskripsi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `umkm`
--

INSERT INTO `umkm` (`umkm_id`, `name`, `gambar`, `owner`, `phone_number`, `deskripsi`) VALUES
(22, 'KUBARO DIMSUM', 0x2e2e2f554d4b4d2f64696d73756d2e6a7067, 'Maryanto', '0882006864308', 'masakan Tionghoa yang beragam dan biasanya disajikan dalam porsi kecil, cocok untuk disantap bersama keluarga atau teman-teman.'),
(24, 'Martabak AR', 0x2e2e2f554d4b4d2f6d6172746162616b2e6a7067, 'Malio', '0892351827635', 'Martabak AR merupakan salah satu kuliner yang ada di Kuliner malam pasar manis, terdapat 2 macam martabak yaitu martabak manis dan martabak asin(Telur).'),
(25, 'Lumpia BOOM', 0x2e2e2f554d4b4d2f6c756d70696120626f6f6d2e6a7067, 'Rodi Cahyawan', '0812374518237', 'Lumpia Boom adalah roll goreng yang biasanya diisi dengan campuran daging, sayuran, dan bumbu. Isian lumpia Boom dapat bervariasi, tergantung pada selera masing-masing orang.'),
(26, 'Murita Crepes', 0x2e2e2f554d4b4d2f6c656b65722e6a7067, 'Murita', '0871827392718', 'Murita Crepes adalah salahsatu makanan yang terdapat berbagai macam rasa seperti, Chocolate, Chese, Blueberry dan masih banyak lagi. '),
(27, 'Soto Lamongan', 0x2e2e2f554d4b4d2f736f746f206c616d6f6e67616e2e6a7067, 'Supriyadi', '081273628374', 'Soto Lamongan dengan bumbu khas dari lamongan, hadirnya di kuliner malam pasar manis anda tidak perlu jauh jauh untuk ke lamongan untuk mencicipi soto lamongan. '),
(28, 'Deman Kebab Berger', 0x2e2e2f554d4b4d2f6b656261622e6a7067, 'Nindi Setyani', '08927382172', 'kebab adalah kombinasi yang menarik antara hidangan yang terinspirasi dari masakan Timur Tengah dan Barat. Makanan ini sering dijuluki sebagai \"fusion food\". Burger adalah makanan populer yang terdiri'),
(32, 'Mie Lampung', 0x2e2e2f554d4b4d2f6d6965206c616d70756e672e6a7067, 'wayan', '0828392319', 'Mie Lampung Enak sekali');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `user_id`, `name`, `email`, `password`, `role`) VALUES
('madam.iz', 1, 'Ammar', '21102122@ittelkom-pwt.ac.id', 'ewokgtg', 'Admin'),
('synysterBP', 2, 'Wayan', '21102123@ittelkom-pwt.ac.id', 'synyster', 'User'),
('marlinarrr', 3, 'Marlino', '21102124@ittelkom-pwt.ac.id', 'marline', 'User'),
('amalia', 4, 'Amalaaaa', '21102125@ittelkom-pwt.ac.id', 'amalia', 'Admin'),
('hendro', 5, 'hendrieoi', 'hendrie@gmail.com', 'hendro', 'User'),
('gfsad', 20, 'adasd', 'bagasweq@gmail.com', 'dadasd', 'User'),
('wayan12', 21, 'wayan12', 'wayan12@gmail.com', 'wayan12', 'User'),
('nocolas', 22, 'nicolas', 'nico@gmail.com', 'nicolas', 'User'),
('hendrosda', 23, 'hendries', 'hendrieii@gmail.com', '$2y$10$tcU', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `umkm_id` (`umkm_id`);

--
-- Indexes for table `umkm`
--
ALTER TABLE `umkm`
  ADD PRIMARY KEY (`umkm_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `umkm`
--
ALTER TABLE `umkm`
  MODIFY `umkm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`umkm_id`) REFERENCES `umkm` (`umkm_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
