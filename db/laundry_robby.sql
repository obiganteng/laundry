-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2020 at 07:53 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry_robby`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_laundry`
--

CREATE TABLE `barang_laundry` (
  `id_barang` int(12) NOT NULL,
  `nama_barang` varchar(70) NOT NULL,
  `stok` int(12) NOT NULL,
  `tgl_update` date NOT NULL,
  `harga` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_laundry`
--

INSERT INTO `barang_laundry` (`id_barang`, `nama_barang`, `stok`, `tgl_update`, `harga`) VALUES
(6, 'Kapur Barus 1pc 12btr', 40, '2019-12-02', 12000),
(7, 'Rinso Pewangi 1ltr', 28, '2019-12-02', 25000),
(8, 'Downy Perfume France 1ltr', 34, '2019-12-02', 29000),
(9, 'Hanger Pass', 173, '2019-12-04', 8000),
(10, 'Setrika Sony Electronic 12v', 2, '2019-12-04', 150000);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_laundry`
--

CREATE TABLE `jenis_laundry` (
  `id_jl` varchar(50) NOT NULL,
  `nama_jl` varchar(50) NOT NULL,
  `tarif` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_laundry`
--

INSERT INTO `jenis_laundry` (`id_jl`, `nama_jl`, `tarif`) VALUES
('1333218a-e6be-4485-801b-5a08c3374ac3', 'Cuci Satuan Setrika', '10000'),
('2bd2513b-099a-4dab-9458-cfc245d89e54', 'Cuci Lipat (kg)', '12500'),
('7a47d45f-7b4a-41cb-9d55-9f8d6ba13462', 'Cuci Setrika (kg)', '15000'),
('d06b18c8-5bf9-457d-93ed-51628f5ffc0f', 'Cuci Satuan Lipat', '8000'),
('d15463a1-d83c-44c0-892f-e9059a4e0a43', 'Cuci Satuan Lengkap', '11000'),
('f07f1a94-3da2-4e27-986d-6fa23b7b207f', 'Cuci Lengkap (kg)', '35000');

-- --------------------------------------------------------

--
-- Table structure for table `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` varchar(50) NOT NULL,
  `nama_konsumen` varchar(50) NOT NULL,
  `no_telepon` varchar(12) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `nama_konsumen`, `no_telepon`, `jenis_kelamin`, `alamat`) VALUES
('2acbf765-c894-45c8-baf2-a1624fab0806', 'Syamil Ghifari', '082544779963', 'Laki-Laki', 'Jagakarsa, Jakarta Selatan'),
('4c55256a-3fa7-4df8-955f-1f354785a703', 'Bang Jaya', '087753239414', 'Laki-Laki', 'Jl. Dijakarta juga boleh no.28'),
('97d1f049-7b00-46ad-9581-6f53e2f8f6a3', 'Najma Maulida', '08551411463', 'Perempuan', 'Jagakarsa, Jakarta Selatan'),
('a7819164-5318-4acb-89d3-e80a3d162821', 'Budi Wow Setiawan', '082344554121', 'Laki-Laki', 'Jl.Binomo Jutaan Orang Bahkan Tidak Menyadari'),
('fcdd1ba5-1106-4616-80da-53e259a71c7a', 'Robby Jatmika', '08558047055', 'Laki-Laki', 'Ciputat, Tangerang Selatan\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `pemakaian_barang`
--

CREATE TABLE `pemakaian_barang` (
  `id_pemakaian` int(11) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_barang` int(12) NOT NULL,
  `jumlah_pakai` int(12) NOT NULL,
  `tgl_pakai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemakaian_barang`
--

INSERT INTO `pemakaian_barang` (`id_pemakaian`, `id_user`, `id_barang`, `jumlah_pakai`, `tgl_pakai`) VALUES
(22, '399eb729-130d-11ea-aefb-a417319c34ae', 9, 1, '2020-01-07'),
(23, '399eb729-130d-11ea-aefb-a417319c34ae', 8, 1, '2020-01-07'),
(24, '399efa61-130d-11ea-aefb-a417319c34ae', 9, 1, '2020-01-07');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_barang`
--

CREATE TABLE `pembelian_barang` (
  `no_pembelian` int(12) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_barang` int(12) NOT NULL,
  `nama_barang` varchar(70) NOT NULL,
  `id_supplier` varchar(50) NOT NULL,
  `stok` int(12) NOT NULL,
  `harga` int(12) NOT NULL,
  `tgl_update` date NOT NULL,
  `total` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian_barang`
--

INSERT INTO `pembelian_barang` (`no_pembelian`, `id_user`, `id_barang`, `nama_barang`, `id_supplier`, `stok`, `harga`, `tgl_update`, `total`) VALUES
(19, '399eb729-130d-11ea-aefb-a417319c34ae', 9, 'Hanger Pass', '2fb1a751-c9d7-41cb-9a7d-e4016040cf1e', 200, 8000, '2019-12-04', 1600000),
(21, '399efa61-130d-11ea-aefb-a417319c34ae', 10, 'Setrika Sony Electronic 12v', '53cc4841-3681-4ddf-9e2a-89fb1cb7ffd5', 3, 150000, '2019-12-01', 450000);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(50) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `no_telepon` varchar(12) NOT NULL,
  `alamat_supplier` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `no_telepon`, `alamat_supplier`) VALUES
('2fb1a751-c9d7-41cb-9a7d-e4016040cf1e', 'CV. Meme Sekali Logistic', '021447741256', 'Bekasi'),
('53cc4841-3681-4ddf-9e2a-89fb1cb7ffd5', 'CV. Kapitalis Mutam', '021369885652', 'Depok\r\n'),
('a3fa5315-373a-4817-b7d9-ad0d9b35cf61', 'CV. Fantatipid Logistics Cleaning', '08954111473', 'Cipulir\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `no_transaksi` int(12) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `id_konsumen` varchar(50) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `tanggal_ambil` date NOT NULL,
  `jenis_ambil` enum('Antar','Ambil') NOT NULL,
  `id_jl` varchar(50) NOT NULL,
  `nama_pakaian` varchar(50) NOT NULL,
  `jumlah` int(16) NOT NULL,
  `status` enum('Lunas','Belum Bayar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`no_transaksi`, `id_user`, `id_konsumen`, `tanggal_transaksi`, `tanggal_ambil`, `jenis_ambil`, `id_jl`, `nama_pakaian`, `jumlah`, `status`) VALUES
(10, '399eb729-130d-11ea-aefb-a417319c34ae', 'fcdd1ba5-1106-4616-80da-53e259a71c7a', '2019-12-02', '2019-12-03', 'Ambil', 'f07f1a94-3da2-4e27-986d-6fa23b7b207f', 'Pakaian Senam', 4, 'Lunas'),
(11, '399efa61-130d-11ea-aefb-a417319c34ae', '2acbf765-c894-45c8-baf2-a1624fab0806', '2019-12-04', '2019-12-05', 'Antar', 'd15463a1-d83c-44c0-892f-e9059a4e0a43', 'Pakaian Kantor', 7, 'Lunas'),
(12, '399eb729-130d-11ea-aefb-a417319c34ae', '97d1f049-7b00-46ad-9581-6f53e2f8f6a3', '2019-12-05', '2019-12-05', 'Antar', '7a47d45f-7b4a-41cb-9d55-9f8d6ba13462', 'Pakaian Sekolah', 5, 'Lunas'),
(13, '399eb729-130d-11ea-aefb-a417319c34ae', 'a7819164-5318-4acb-89d3-e80a3d162821', '2019-12-05', '2019-12-06', 'Ambil', 'f07f1a94-3da2-4e27-986d-6fa23b7b207f', 'Pakaian Trading', 5, 'Lunas'),
(15, 'cfc63943-7c34-4c4c-8b04-1add04fab7e7', '4c55256a-3fa7-4df8-955f-1f354785a703', '2020-01-25', '2020-01-26', 'Antar', 'f07f1a94-3da2-4e27-986d-6fa23b7b207f', 'Pakaian Bebas/Tidur', 6, 'Lunas');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(50) NOT NULL,
  `nama_lengkap` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `level` enum('Admin','Petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `username`, `password`, `pass`, `level`) VALUES
('399eb729-130d-11ea-aefb-a417319c34ae', 'Marco Reus Simic', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'Admin'),
('399efa61-130d-11ea-aefb-a417319c34ae', 'Januzaj Asu', 'officer', 'ac68c11e9fe50085d803b0ca51704715f774d88d', 'ofc123', 'Petugas'),
('cfc63943-7c34-4c4c-8b04-1add04fab7e7', 'Murodifa Sarasvati', 'murodifa', '86c3d4b6be26b3d727b91bb62be901cb189e1333', 'murod123', 'Petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_laundry`
--
ALTER TABLE `barang_laundry`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `jenis_laundry`
--
ALTER TABLE `jenis_laundry`
  ADD PRIMARY KEY (`id_jl`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- Indexes for table `pemakaian_barang`
--
ALTER TABLE `pemakaian_barang`
  ADD PRIMARY KEY (`id_pemakaian`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pembelian_barang`
--
ALTER TABLE `pembelian_barang`
  ADD PRIMARY KEY (`no_pembelian`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_konsumen` (`id_konsumen`),
  ADD KEY `id_jl` (`id_jl`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_laundry`
--
ALTER TABLE `barang_laundry`
  MODIFY `id_barang` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pemakaian_barang`
--
ALTER TABLE `pemakaian_barang`
  MODIFY `id_pemakaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pembelian_barang`
--
ALTER TABLE `pembelian_barang`
  MODIFY `no_pembelian` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `no_transaksi` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemakaian_barang`
--
ALTER TABLE `pemakaian_barang`
  ADD CONSTRAINT `pemakaian_barang_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang_laundry` (`id_barang`),
  ADD CONSTRAINT `pemakaian_barang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `pembelian_barang`
--
ALTER TABLE `pembelian_barang`
  ADD CONSTRAINT `pembelian_barang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `pembelian_barang_ibfk_3` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_jl`) REFERENCES `jenis_laundry` (`id_jl`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_konsumen`) REFERENCES `konsumen` (`id_konsumen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
