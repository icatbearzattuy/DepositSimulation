-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2025 pada 09.46
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_deposito_irsyad`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_simuldep` (IN `p_user_id` INT, IN `p_bank_id` INT, IN `p_nominal` DECIMAL(15,2), IN `p_bulan` INT)   BEGIN
    DECLARE bunga_dasar DECIMAL(5,2);
    DECLARE bunga DECIMAL(15,2);
    DECLARE total DECIMAL(15,2);

    SELECT suku_bunga_dasar
    INTO bunga_dasar
    FROM banks
    WHERE bank_id = p_bank_id;

    SET bunga = p_nominal * (bunga_dasar / 100) * (p_bulan / 12);
    SET total = p_nominal + bunga;

    INSERT INTO simulations (
        user_id,
        bank_id,
        nominal_deposito,
        jangka_waktu_bulan,
        bunga_diterima,
        total_akhir,
        waktu_simulasi
    )
    VALUES (
        p_user_id,
        p_bank_id,
        p_nominal,
        p_bulan,
        bunga,
        total,
        NOW()
    );
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$12$6kKtwfqN049H6DCjNLLLBu3aFczhBv1xug3vbab6aVg2F6F3tkkE6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `audit_logs`
--

CREATE TABLE `audit_logs` (
  `log_id` int(11) NOT NULL,
  `aksi` varchar(100) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `audit_logs_backup`
--

CREATE TABLE `audit_logs_backup` (
  `log_id` int(11) NOT NULL,
  `aksi` varchar(100) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `audit_logs_backup`
--

INSERT INTO `audit_logs_backup` (`log_id`, `aksi`, `waktu`, `keterangan`) VALUES
(0, 'UPDATE USER', '2025-12-14 16:10:56', 'User ID 1 diupdate. Sebelum: Username=anakbaik21, Email=baikbijak@gmail.com, Password=sehat2orang || Sesudah: Username=anakbaik21, Email=baikbijak@gmail.com, Password=$2y$12$3zahtB1r5JiebYEAViMpC.dshAom9qkLnGbilwR0c0sWLwZpJbZa2'),
(1, 'UPDATE USER', '2025-12-13 09:19:51', 'User ID 7 diupdate. Sebelum: Username=hausetanol, Email=lil.bahzil@gmail.com, Password=tangkiberkarat || Sesudah: Username=hausetanol, Email=lil.bahzil@gmail.com, Password=tobatnasuha2025'),
(2, 'UPDATE USER', '2025-12-13 09:23:25', 'User ID 4 diupdate. Sebelum: Username=adrian80, Email=Bang.adrian@gmail.com, Password=adriandisini || Sesudah: Username=adrian80, Email=adrian.official@gmail.com, Password=adriandisini');

-- --------------------------------------------------------

--
-- Struktur dari tabel `banks`
--

CREATE TABLE `banks` (
  `bank_id` int(11) NOT NULL,
  `nama_bank` varchar(50) DEFAULT NULL,
  `suku_bunga_dasar` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `banks`
--

INSERT INTO `banks` (`bank_id`, `nama_bank`, `suku_bunga_dasar`) VALUES
(1, 'Bank Mandiri', 3.50),
(2, 'Bank BRI', 4.25),
(5, 'Bank BNI', 3.10),
(6, 'Bank Bukopin', 3.80);

-- --------------------------------------------------------

--
-- Struktur dari tabel `simulations`
--

CREATE TABLE `simulations` (
  `simulasi_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `nominal_deposito` decimal(15,2) DEFAULT NULL,
  `jangka_waktu_bulan` int(11) DEFAULT NULL,
  `bunga_diterima` decimal(15,2) DEFAULT NULL,
  `total_akhir` decimal(15,2) DEFAULT NULL,
  `waktu_simulasi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `simulations`
--

INSERT INTO `simulations` (`simulasi_id`, `user_id`, `bank_id`, `nominal_deposito`, `jangka_waktu_bulan`, `bunga_diterima`, `total_akhir`, `waktu_simulasi`) VALUES
(1, 1, 1, 5000000.00, 12, 175000.00, 5175000.00, '2025-12-13 09:29:33'),
(2, 6, 2, 100000000.00, 24, 8500000.00, 108500000.00, '2025-12-13 09:30:54'),
(3, 5, 3, 10000000.00, 6, 150000.00, 10150000.00, '2025-12-13 09:31:38'),
(0, 8, 1, 10000000.00, 6, 175000.00, 10175000.00, '2025-12-15 03:21:47'),
(0, 8, 3, 10000000.00, 6, 150000.00, 10150000.00, '2025-12-15 03:59:20'),
(0, 8, 2, 10000000.00, 3, 106250.00, 10106250.00, '2025-12-15 05:19:33'),
(0, 8, 2, 10000000.00, 3, 106250.00, 10106250.00, '2025-12-15 05:19:49'),
(0, 8, 1, 10000000.00, 3, 87500.00, 10087500.00, '2025-12-15 05:22:42'),
(0, 8, 1, 10000000.00, 3, 87500.00, 10087500.00, '2025-12-15 05:23:16'),
(0, 8, 2, 10000000.00, 3, 106250.00, 10106250.00, '2025-12-15 05:23:32'),
(0, 8, 3, 100000000000.00, 9, 2250000000.00, 102250000000.00, '2025-12-15 05:24:04'),
(0, 8, 2, 10000000000.00, 18, 637500000.00, 10637500000.00, '2025-12-15 07:46:30'),
(0, 8, 1, 10000000.00, 6, 175000.00, 10175000.00, '2025-12-15 08:46:58'),
(0, 9, 1, 1000000000.00, 6, 17500000.00, 1017500000.00, '2025-12-15 11:40:49'),
(0, 9, 1, 100000000.00, 3, 875000.00, 100875000.00, '2025-12-15 11:43:45'),
(0, 9, 1, 10000000.00, 3, 87500.00, 10087500.00, '2025-12-15 11:47:17'),
(0, 9, 1, 10000000.00, 3, 87500.00, 10087500.00, '2025-12-16 02:58:30'),
(0, 9, 1, 10000000.00, 6, 175000.00, 10175000.00, '2025-12-16 03:01:10'),
(0, 9, 2, 100000000.00, 3, 1062500.00, 101062500.00, '2025-12-16 03:02:10'),
(0, 9, 1, 1000000.00, 3, 8750.00, 1008750.00, '2025-12-16 03:23:48'),
(0, 10, 2, 100000000.00, 3, 1062500.00, 101062500.00, '2025-12-16 05:51:17'),
(0, 10, 1, 2331333333.00, 3, 20399166.66, 2351732499.66, '2025-12-16 07:01:31'),
(0, 10, 1, 1000000000.00, 6, 17500000.00, 1017500000.00, '2025-12-16 07:02:16'),
(0, 10, 1, 10000000.00, 6, 175000.00, 10175000.00, '2025-12-16 12:00:08'),
(0, 10, 1, 10000000.00, 6, 175000.00, 10175000.00, '2025-12-16 13:09:41'),
(0, 10, 1, 100000000.00, 6, 1750000.00, 101750000.00, '2025-12-16 13:43:32'),
(0, 11, 2, 10000000.00, 12, 425000.00, 10425000.00, '2025-12-16 14:14:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `nama_lengkap`, `email`, `email_verified_at`) VALUES
(1, 'anakbaik21', '$2y$12$ut8i0PiJAze65Me.f7hubewQSaiqq45EPXNgN.b0Ox6lnG2t8vNA6', 'Insanul ihsan', 'baikbijak@gmail.com', NULL),
(2, 'katabijak01', '$2y$12$ut8i0PiJAze65Me.f7hubewQSaiqq45EPXNgN.b0Ox6lnG2t8vNA6', 'Kalam al-hasan', 'quotekeren@gmail.com', NULL),
(3, 'slalukonsis', '$2y$12$ut8i0PiJAze65Me.f7hubewQSaiqq45EPXNgN.b0Ox6lnG2t8vNA6', 'Haikal al-faruqi', 'ikalll@gmail.com', NULL),
(4, 'adrian80', '$2y$12$ut8i0PiJAze65Me.f7hubewQSaiqq45EPXNgN.b0Ox6lnG2t8vNA6', 'Adrian zuhair', 'adrian.official@gmail.com', NULL),
(5, 'mancingemosi', '$2y$12$ut8i0PiJAze65Me.f7hubewQSaiqq45EPXNgN.b0Ox6lnG2t8vNA6', 'Guntur rizky', 'dikejarmasa@gmail.com', NULL),
(6, 'demensawit', '$2y$12$ut8i0PiJAze65Me.f7hubewQSaiqq45EPXNgN.b0Ox6lnG2t8vNA6', 'Prahadi subagyo', 'massa.iq58@gmail.com', NULL),
(7, 'hausetanol', '$2y$12$ut8i0PiJAze65Me.f7hubewQSaiqq45EPXNgN.b0Ox6lnG2t8vNA6', 'Bahzil al kadzab', 'lil.bahzil@gmail.com', NULL);

--
-- Trigger `users`
--
DELIMITER $$
CREATE TRIGGER `trg_update_user` AFTER UPDATE ON `users` FOR EACH ROW BEGIN
    INSERT INTO audit_logs (aksi, waktu, keterangan)
    VALUES (
        'UPDATE USER',
        NOW(),
        CONCAT(
            'User ID ', NEW.user_id, ' diupdate. ',
            'Sebelum: Username=', OLD.username,
            ', Email=', OLD.email,
            ', Password=', OLD.password,
            ' || Sesudah: Username=', NEW.username,
            ', Email=', NEW.email,
            ', Password=', NEW.password
        )
    );
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indeks untuk tabel `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `banks`
--
ALTER TABLE `banks`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
