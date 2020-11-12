-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2020 at 06:16 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistempakar`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_gangguan_internet`
--

CREATE TABLE `data_gangguan_internet` (
  `id` int(11) NOT NULL,
  `kode_gangguan` int(11) NOT NULL,
  `nama_gangguan` varchar(128) NOT NULL,
  `solusi_gangguan` text NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_gangguan_internet`
--

INSERT INTO `data_gangguan_internet` (`id`, `kode_gangguan`, `nama_gangguan`, `solusi_gangguan`, `is_active`) VALUES
(1, 201, 'IP PC Tidak Sesuai Dengan IP Modem', 'Cek koneksi local area, lakukan ping tes dari pc langsung ke modem, cek perangkat pelanggan sudah mendapat IP modem, jika belum bisa dilakukan isi IP secara manual. Restart modem atau reset modem, kemudian setting ulang konfigurasi', 1),
(2, 202, 'Terisolir', 'Buka aplikasi SAMS, lakukan bukis (buka isolir) dengan memasukkan nomor internet pelanggan.', 1),
(3, 203, 'Spam, Virus', 'Meng-offkan semua firewall, pastikan antivirus tidak blocking koneksi', 1),
(4, 204, 'Profil Paket Kuota Habis', 'Cek pada aplikasi spins untuk cek sisa kuota, edukasi pelanggan', 1),
(5, 205, 'Kabel Patchcord Rusak', 'Ganti kabel patchcord baru, melakukan penyambungan ulang dengan kabel dropcore', 1),
(6, 206, 'DNS / Proxy', 'Bisa dilakukan cek/ganti proxy yang ada di browser. Mengubah DNS, masukkan DNS google (Preferred DNS Server 8.8.8.8, Alternate DNS Server 8.8.4.4)', 1),
(7, 207, 'Profil di Port Tidak Sesuai Paket', 'Setting-an create pada modem hilang, lakukan create ulang, masuk pada putty, masukkan script create setting konfigurasi dan masukkan data nomor telepon, nomor internet, dan SN (Serial Number) modem', 1),
(8, 208, 'Kabel dropcore Rusak', 'Cek ukuran/redaman kabel dengan menggunakan OPM meter (ukuran baik tidak >25dBm), lalu lakukan rekoneksi sambungan/pergantian dropcore. Settingcreate pada modem hilang, lakukan create ulang, masuk pada putty, masukkan script create setting konfigurasi dan masukkan data nomor telepon, nomor internet, dan SN (Serial Number) modem', 1),
(9, 209, 'Fast Connector Rusak', 'Dilakukan penggantian fast connector baru, kemudian lakukan penyambungan ulang', 1),
(10, 210, 'Adaptor Rusak/ Modem Rusak', 'dilakukan pengecekan dengan adaptor dan modem test, apabila tidak berfungsi dapat diganti dengan adaptor atau modem ONT baru', 1),
(11, 211, 'Maintenance Server', 'Kemungkinan terdapat perbaikan server pada alamat web yang dituju.', 1),
(25, 212, 'AssfsfsfAssfsfsfAssfsfsfAssfsfsfAssfsfsf', 'AssfsfsfAssfsfsfAssfsfsfAssfsfsfAssfsfsfAssfsfsfAssfsfsfAssfsfsfAssfsfsfAssfsfsfAssfsfsfAssfsfsfAssfsfsf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_gangguan_telepon`
--

CREATE TABLE `data_gangguan_telepon` (
  `id` int(11) NOT NULL,
  `kode_gangguan` int(11) NOT NULL,
  `nama_gangguan` varchar(128) NOT NULL,
  `solusi_gangguan` text NOT NULL,
  `is_active` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_gangguan_telepon`
--

INSERT INTO `data_gangguan_telepon` (`id`, `kode_gangguan`, `nama_gangguan`, `solusi_gangguan`, `is_active`) VALUES
(1, 101, 'Telepon Mati Total', 'Solusi yang diberikan apabila telepon mati tidak ada nada adalah cek dengan test phone kemungkinan pesawat telepon pelanggan yang rusak, jika jaringan telepon, rekonek kabel UTP telepon, cek pada splitter pastikan RJ 11 yang masuk pada phone dan modem tidak terbalik. Apabila tlp di paralel, cek pada sambungan rosette pastikan tidak lembab air. Jika masih belum bisa coba ganti splitter dan rosette baru, atau ganti kabel dan connector RJ 11 yang baru', 1),
(22, 102, 'Kabel UTP Telepon Rusak', 'Pertama kali cabut RJ 11 pada pesawat telepon, kemudian pasang kembali. Jika masih belum bisa, dilakukan penggantian kabel UTP TLP yang baru.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_gangguan_useetv`
--

CREATE TABLE `data_gangguan_useetv` (
  `id` int(11) NOT NULL,
  `kode_gangguan` int(11) NOT NULL,
  `nama_gangguan` varchar(128) NOT NULL,
  `solusi_gangguan` text NOT NULL,
  `is_active` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_gangguan_useetv`
--

INSERT INTO `data_gangguan_useetv` (`id`, `kode_gangguan`, `nama_gangguan`, `solusi_gangguan`, `is_active`) VALUES
(1, 301, 'Kabel RCA/HDMI rusak', 'Dilakukan penggantian kabel RCA/HDMI baru', 1),
(2, 302, 'Alamat dari server otentikasi tidak sesuai', 'Jika gangguan error 1302. Disebabkan alamat homepage EPG (Electronic Program Guide) gagal terhubung atau alamat dari server otentikasi tidak sesuai. Dicoba dengan reboot STB (set top box) dengan cara: pencet tombol SET pada remote useetv> pilih konfigurasi> isi password dengan 6321> tingkat lanjut> reboot. Pastikan kabel UTP dari STB menancap di LAN Port 4 modem, agar mendapatkan alamat dari server yaitu ip 10 .x.x.x', 1),
(3, 303, 'Profil DHCP tidak valid', 'Jika gangguan error 1305. Kemungkinan parameter DHCP (Dinamic  Host Configuration Protocol) dari modem tidak benar. Dilakukan reboot modem seperti gangguan 1302, dilanjutkan dengan cek info jaringan: pilih menu tingkat lanjut> pilih sistem informasi> pilih info jaringan> pastikan ip mendapatkan ip 10.x.x.x dengan memastikan parameter otentikasi, nomor internet, dan password useetvsudah benar', 1),
(4, 304, 'Kabel UTP LAN/Connector RJ 45 rusak', 'Jika gangguan error 1901. Disebabkan kabel jaringan tidak tersambung. Periksa koneksi fisik dari kabel jaringan. Cek koneksi kabel UTP & RJ 45 dari modem ke arah STB, coba di-reconnect ulang. Apabila kabel UTP & RJ 45 sudah tidak berfungsi dapat dilakukan penggantian baru', 1),
(5, 305, 'Konfigurasi vlan multicast hilang', 'Jika gangguan error code 4514 sama dengan gangguan channel live TV tidak muncul. Cek pada embassy, pastikan data Rx Power untuk OLT dan ONU tidak > 25 dBm. Cek konfigurasi vlan multicast apabila konfigurasi hilang atau channel multicast mengalami data timeout, maka create lagi dengan memasukkan scriptkonfigurasi vlan pada putty, dengan mendaftarkan nomor internet dan SN (serial number) modem', 1),
(6, 306, 'Konfigurasi setting hilang', 'ika kualitas gambar tv putus-putus, tekan tombol info pada remote control> panah kanan [volume +] > tampil signal power & quality standard>70%. Atau dilakukan create ulang konfigurasi', 1),
(7, 307, 'Unbind', 'Jika gangguan error code 70116204, disebabkan account pelanggan di lock, cek pada aplikasi embassy jika kebinding maka di unbinding, terutama untuk modem baru', 1),
(8, 308, 'Salah username/password', 'Jika gangguan error code 70116206, disebabkan username/nomor rekening dan password salah pada settingan menu STB, cek pada aplikasi SOAP username dan password useetv yang benar> setting ulang kembali di STB', 1),
(9, 309, 'Modem STB Rusak', 'Jika lampu indikator LINK mati, Cek kelayakan kabel UTP, connector RJ 45 dari ONT ke STB. Cek dengan modem test, apabila STB rusak dapat dilakukan penggantian modem baru', 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_gejala_internet`
--

CREATE TABLE `data_gejala_internet` (
  `id` int(11) NOT NULL,
  `kode_gejala` int(11) NOT NULL,
  `nama_gejala` varchar(128) NOT NULL,
  `cf_pakar` float NOT NULL,
  `is_active` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_gejala_internet`
--

INSERT INTO `data_gejala_internet` (`id`, `kode_gejala`, `nama_gejala`, `cf_pakar`, `is_active`) VALUES
(1, 201, 'Internet Tidak Bisa Connect', 0.2, 1),
(2, 202, 'PC Tidak Mendapatkan IP', 0.6, 1),
(3, 203, 'Tidak Ada Tunggakan Pembayaran', 0.6, 1),
(4, 204, 'Koneksi Lambat Pc Pelanggan di Share', 0.6, 1),
(5, 205, 'Koneksi Lambat', 0.6, 1),
(6, 206, 'Bandwidth Kecil', 0.6, 1),
(7, 207, 'Paket Internet Kuota Habis', 0.6, 1),
(8, 208, 'Koneksi Putus Putus', 0.6, 1),
(9, 209, 'Modem Normal', 0.6, 1),
(10, 210, 'Kabel Patchcord Rusak', 0.6, 1),
(11, 211, 'Tidak Bisa Browsing', 0.6, 1),
(12, 212, 'IP PC Sesuai Dengan IP Modem', 0.6, 1),
(13, 213, 'Bandwidth Tidak Sesuai Paket', 0.6, 1),
(14, 214, 'Konfigurasi Setting Hilang', 0.6, 1),
(15, 215, 'Lampu Indikator PON Mati', 0.6, 1),
(16, 216, 'Lampu Indikator LOS Merah', 0.6, 1),
(17, 217, 'Fast Connector Tidak Berfungsi/Rusak', 0.6, 1),
(18, 218, 'Lampu Indicator Power Mati', 0.6, 1),
(19, 219, 'Modem ONT Tidak Menyala', 0.6, 1),
(20, 220, 'Tidak Bisa Membuka Web Tertentu', 0.6, 1),
(21, 221, 'Proxy Sudah Sesuai', 0.6, 1),
(22, 222, 'DNS Sudah Sesuai', 0.6, 1),
(24, 223, 'Kabel Distribusi Putus', 0.6, 1),
(25, 224, 'Kabel Feder Putus', 0.6, 1),
(26, 225, 'Fanderisme', 0.6, 1),
(29, 226, 'ODP Rusak', 0.6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_gejala_telepon`
--

CREATE TABLE `data_gejala_telepon` (
  `id` int(11) NOT NULL,
  `kode_gejala` int(11) NOT NULL,
  `nama_gejala` varchar(128) NOT NULL,
  `cf_pakar` float NOT NULL,
  `is_active` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_gejala_telepon`
--

INSERT INTO `data_gejala_telepon` (`id`, `kode_gejala`, `nama_gejala`, `cf_pakar`, `is_active`) VALUES
(1, 101, 'Telepon mati tidak ada nada', 0.6, 1),
(2, 102, 'Rosette lembab air', 0.6, 1),
(3, 103, 'Splitter tidak berfungsi', 0.6, 1),
(4, 104, 'Kabel PVC telepon rusak', 0.6, 1),
(5, 105, 'Connector RJ11 tidak berfungsi', 0.6, 1),
(6, 106, 'Nada telepon ngetut-tut', 0.6, 1),
(7, 107, 'Nada telepon nada panjang', 0.6, 1),
(16, 108, 'Kabel digigit tikus', 0.6, 1),
(17, 109, 'Kabel Kejepit', 0.6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_gejala_useetv`
--

CREATE TABLE `data_gejala_useetv` (
  `id` int(11) NOT NULL,
  `kode_gejala` int(11) NOT NULL,
  `nama_gejala` varchar(128) NOT NULL,
  `cf_pakar` float NOT NULL,
  `is_active` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_gejala_useetv`
--

INSERT INTO `data_gejala_useetv` (`id`, `kode_gejala`, `nama_gejala`, `cf_pakar`, `is_active`) VALUES
(1, 301, 'Gambar UseeTV Blank', 0.6, 1),
(2, 302, 'Konfigurasi Sudah Sesuai', 0.6, 1),
(3, 303, 'Error 1302', 0.6, 1),
(4, 304, 'Koneksi Ke EPG Gagal', 0.6, 1),
(5, 305, 'Error 1305', 0.6, 1),
(6, 306, 'Username Tidak Sesuai', 0.6, 1),
(7, 307, 'Password Tidak Sesuai', 0.6, 1),
(8, 308, 'Error 1901', 0.6, 1),
(9, 309, 'Error 4514', 0.6, 1),
(10, 310, 'Channel Multicast Mengalami Data Timeout', 0.6, 1),
(11, 311, 'Gambar UseeTV Putus-putus', 0.6, 1),
(12, 312, 'Konfigurasi Setting Hilang', 0.6, 1),
(13, 313, 'Penggantian Modem STB Baru', 0.6, 1),
(14, 314, 'Error 70116204', 0.6, 1),
(15, 315, 'Error 70116206', 0.6, 1),
(16, 316, 'Modem STB Tidak Menyala Atau Tidak Berfungsi', 0.6, 1),
(17, 317, 'Lampu Indikator LINK Mati', 0.6, 1),
(19, 318, 'Password Terpasang Di Perangkat Lain', 0.6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gejala_gangguan_internet`
--

CREATE TABLE `gejala_gangguan_internet` (
  `id` int(11) NOT NULL,
  `kode_gejala` int(11) NOT NULL,
  `kode_gangguan` int(11) NOT NULL,
  `is_active` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gejala_gangguan_internet`
--

INSERT INTO `gejala_gangguan_internet` (`id`, `kode_gejala`, `kode_gangguan`, `is_active`) VALUES
(14, 211, 207, 1),
(15, 213, 207, 1),
(16, 214, 207, 1),
(17, 214, 208, 1),
(18, 215, 208, 1),
(21, 218, 210, 1),
(22, 219, 210, 1),
(95, 202, 209, 1),
(96, 216, 209, 1),
(97, 217, 209, 1),
(114, 201, 202, 1),
(115, 203, 202, 1),
(126, 211, 206, 1),
(127, 212, 206, 1),
(128, 205, 204, 1),
(129, 206, 204, 1),
(130, 207, 204, 1),
(134, 204, 203, 1),
(140, 208, 205, 1),
(141, 209, 205, 1),
(142, 210, 205, 1),
(145, 201, 201, 1),
(146, 202, 201, 1),
(154, 211, 211, 1),
(155, 220, 211, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gejala_gangguan_telepon`
--

CREATE TABLE `gejala_gangguan_telepon` (
  `id` int(11) NOT NULL,
  `kode_gejala` int(11) NOT NULL,
  `kode_gangguan` int(11) NOT NULL,
  `is_active` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gejala_gangguan_telepon`
--

INSERT INTO `gejala_gangguan_telepon` (`id`, `kode_gejala`, `kode_gangguan`, `is_active`) VALUES
(164, 101, 101, 1),
(165, 102, 101, 1),
(166, 103, 101, 1),
(167, 104, 101, 1),
(168, 105, 101, 1),
(177, 106, 102, 1),
(178, 107, 102, 1),
(179, 108, 102, 1),
(180, 109, 102, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gejala_gangguan_useetv`
--

CREATE TABLE `gejala_gangguan_useetv` (
  `id` int(11) NOT NULL,
  `kode_gejala` int(11) NOT NULL,
  `kode_gangguan` int(11) NOT NULL,
  `is_active` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gejala_gangguan_useetv`
--

INSERT INTO `gejala_gangguan_useetv` (`id`, `kode_gejala`, `kode_gangguan`, `is_active`) VALUES
(7, 305, 303, 1),
(8, 306, 303, 1),
(9, 307, 303, 1),
(10, 304, 304, 1),
(11, 308, 304, 1),
(12, 309, 305, 1),
(13, 310, 305, 1),
(14, 311, 306, 1),
(15, 312, 306, 1),
(18, 306, 308, 1),
(19, 307, 308, 1),
(20, 314, 308, 1),
(23, 301, 301, 1),
(24, 302, 301, 1),
(25, 303, 302, 1),
(26, 304, 302, 1),
(30, 313, 307, 1),
(31, 314, 307, 1),
(32, 318, 307, 1),
(33, 316, 309, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teknisi_requests`
--

CREATE TABLE `teknisi_requests` (
  `id` int(11) NOT NULL,
  `request` varchar(128) NOT NULL,
  `layanan` varchar(128) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `kode_gejala` int(11) NOT NULL,
  `kode_gangguan` int(11) NOT NULL,
  `nama_layanan` varchar(128) NOT NULL,
  `solusi` text NOT NULL,
  `cf_pakar` float NOT NULL,
  `image` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Khalid', 'khalid@gmail.com', 'images1.png', '$2y$10$XHFbOLoLhZLkH36JdtQmnubw2kjJ9lantNrrDiXhQjulHKoz5GrhK', 3, 1, 1569744112),
(27, 'Seorang Pakar', 'pakar@gmail.com', 'images3.png', '$2y$10$LcpQvrcJbtTfHgPcz1KDx.Ex1VgPJn0NuzbW4Bx1zpaZvFHgAWkrG', 1, 1, 1579817521),
(28, 'Seorang User', 'user@gmail.com', 'default.jpg', '$2y$10$Y3A0dZDzS3cFuDY5ebp2huEAXOoBHEiF5CDo7bzlbrjwj17LQ9zTO', 2, 1, 1579817597),
(29, 'Andi', 'andi@gmail.com', 'default.jpg', '$2y$10$c/5Ls.OLa3PDWKfdxGAM6OPWfQnHLFisGZ6dNJ6Z7cd68CytT5X5.', 2, 1, 1579817628),
(31, 'Khalid Mahfudh', 'khalidmahfudh94@gmail.com', 'khalid1.jpeg', '$2y$10$rTaLyj7B2OLXp18hGGQBWugm8u0FEo43f0mTHEQBgnbdEYu7RK9sy', 1, 0, 1581605526);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(5, 2, 3),
(6, 1, 4),
(7, 2, 4),
(8, 3, 1),
(9, 3, 2),
(10, 3, 3),
(11, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'MENU PAKAR'),
(2, 'KONSULTASI GANGGUAN LAYANAN'),
(3, 'USER'),
(4, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_requests`
--

CREATE TABLE `user_requests` (
  `id` int(11) NOT NULL,
  `id_layanan` int(128) NOT NULL,
  `request` varchar(128) NOT NULL,
  `layanan` varchar(128) NOT NULL,
  `kode` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_requests`
--

INSERT INTO `user_requests` (`id`, `id_layanan`, `request`, `layanan`, `kode`, `name`, `image`) VALUES
(10, 25, 'Tambah Data Gangguan', 'Internet Fiber', 212, 'Khalid', 'images1.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Pakar'),
(2, 'Pelanggan'),
(3, 'Teknisi');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Manage Telepon Rumah', 'managetelepon', 'fas fa-fw fa-phone-alt', 1),
(2, 1, 'Manage Internet Fiber', 'manageinternet', 'fas fa-fw fa-wifi', 1),
(3, 1, 'Manage UseeTV', 'manageuseetv', 'fas fa-fw fa-tv', 1),
(4, 1, 'Manage Users', 'manageusers', 'fas fa-fw fa-users-cog', 1),
(5, 1, 'All Requests', 'requests', 'fas fa-fw fa-tools', 1),
(6, 2, 'Gangguan Telepon Rumah', 'konsultasitelepon', 'fas fa-fw fa-phone-alt', 1),
(7, 2, 'Gangguan Internet Fiber', 'konsultasiinternet', 'fas fa-fw fa-wifi', 1),
(8, 2, 'Gangguan UseeTV', 'konsultasiuseetv', 'fas fa-fw fa-tv', 1),
(9, 3, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(10, 3, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(11, 4, 'About', 'about', 'fas fa-fw fa-mobile-alt', 1),
(12, 3, 'Ubah Password', 'user/ubahpassword', 'fas fa-fw fa-key', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_gangguan_internet`
--
ALTER TABLE `data_gangguan_internet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_gangguan` (`kode_gangguan`);

--
-- Indexes for table `data_gangguan_telepon`
--
ALTER TABLE `data_gangguan_telepon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_gangguan_useetv`
--
ALTER TABLE `data_gangguan_useetv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_gejala_internet`
--
ALTER TABLE `data_gejala_internet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_gejala` (`kode_gejala`);

--
-- Indexes for table `data_gejala_telepon`
--
ALTER TABLE `data_gejala_telepon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_gejala_useetv`
--
ALTER TABLE `data_gejala_useetv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gejala_gangguan_internet`
--
ALTER TABLE `gejala_gangguan_internet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_gangguan` (`kode_gangguan`);

--
-- Indexes for table `gejala_gangguan_telepon`
--
ALTER TABLE `gejala_gangguan_telepon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gejala_gangguan_useetv`
--
ALTER TABLE `gejala_gangguan_useetv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teknisi_requests`
--
ALTER TABLE `teknisi_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_requests`
--
ALTER TABLE `user_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_gangguan_internet`
--
ALTER TABLE `data_gangguan_internet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `data_gangguan_telepon`
--
ALTER TABLE `data_gangguan_telepon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `data_gangguan_useetv`
--
ALTER TABLE `data_gangguan_useetv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `data_gejala_internet`
--
ALTER TABLE `data_gejala_internet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `data_gejala_telepon`
--
ALTER TABLE `data_gejala_telepon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `data_gejala_useetv`
--
ALTER TABLE `data_gejala_useetv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `gejala_gangguan_internet`
--
ALTER TABLE `gejala_gangguan_internet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `gejala_gangguan_telepon`
--
ALTER TABLE `gejala_gangguan_telepon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `gejala_gangguan_useetv`
--
ALTER TABLE `gejala_gangguan_useetv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `teknisi_requests`
--
ALTER TABLE `teknisi_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_requests`
--
ALTER TABLE `user_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;