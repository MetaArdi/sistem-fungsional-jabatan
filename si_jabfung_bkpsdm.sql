-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2026 at 10:45 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_jabfung_bkpsdm`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_rapat`
--

CREATE TABLE `bahan_rapat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_usulan` bigint(20) UNSIGNED DEFAULT NULL,
  `nomor_bahan` varchar(50) NOT NULL,
  `tanggal_bahan` date NOT NULL,
  `no_urut` int(11) NOT NULL,
  `kajian_otomatis` text NOT NULL,
  `tabel_besetting` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tabel_besetting`)),
  `status_bahan` enum('draft','proses','menunggu_persetujuan','disetujui','ditolak') DEFAULT 'draft',
  `alasan_persetujuan` text DEFAULT NULL,
  `disetujui_oleh` varchar(20) DEFAULT NULL,
  `tanggal_disetujui` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bahan_rapat`
--

INSERT INTO `bahan_rapat` (`id`, `id_usulan`, `nomor_bahan`, `tanggal_bahan`, `no_urut`, `kajian_otomatis`, `tabel_besetting`, `status_bahan`, `alasan_persetujuan`, `disetujui_oleh`, `tanggal_disetujui`, `created_at`, `updated_at`) VALUES
(1, 1, 'BHP/2026/04/001', '2026-04-03', 1, 'Berdasarkan Sertifikat Uji Kompetensi Kementerian Pendidikan No.REG-98765432 Saudara/i Acelia Putri Rahmawati, S.Pd NIP. 197506152010012001 telah mengikuti Uji Kompetensi Kenaikan Jabatan Fungsional Guru Ahli Muda sebagai Guru Ahli Madya dan dinyatakan lulus serta memenuhi syarat untuk pengajuan Kenaikan Jabatan dengan masa berlaku sampai 08 Oktober 2027;\r\n\r\n➢ Predikat Kinerja tahun 2025 bernilai \'BAIK\';\r\n➢ Penetapan Angka Kredit 360,086;\r\n➢ Pada saat mengajukan Kenaikan Jabatan yang bersangkutan berusia 51 tahun 2 bulan;\r\n➢ Memperhatikan Surat Menteri PANRB tanggal 10 Oktober 2025 Nomor : ___________________ serta besetting JF pada Dinas Pendidikan Kabupaten Kudus terkait.', NULL, 'disetujui', NULL, NULL, '2026-04-03 07:05:36', '2026-04-02 23:18:59', '2026-04-03 07:05:36'),
(2, NULL, 'BHP/2026/04/002', '2026-04-05', 1, 'Berdasarkan Sertifikat Uji Kompetensi Kementerian Pendidikan No.REG-11223344 Saudara/i Dra. Siti Aminah, M.Pd NIP. 198203152010031005 telah mengikuti Uji Kompetensi Kenaikan Jabatan Fungsional Guru Ahli Madya sebagai Guru Ahli Utama dan dinyatakan lulus serta memenuhi syarat untuk pengajuan Kenaikan Jabatan dengan masa berlaku sampai 10-01-2029;\n\n- Predikat Kinerja tahun 2025 bernilai \'BAIK\';\n- Penetapan Angka Kredit 425,750;\n- Pada saat mengajukan Kenaikan Jabatan yang bersangkutan berusia 44 tahun 1 bulan;\n- Memperhatikan Surat Menteri PANRB tanggal 10 Oktober 2026 Nomor B/4748/M.SM.01.00/2026 serta besetting JF pada OPD terkait.', NULL, 'disetujui', NULL, '4', '2026-04-05 01:54:11', '2026-04-04 20:56:20', '2026-04-05 01:54:11');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_rapat_usulan`
--

CREATE TABLE `bahan_rapat_usulan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_bahan_rapat` bigint(20) UNSIGNED NOT NULL,
  `id_usulan` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bahan_rapat_usulan`
--

INSERT INTO `bahan_rapat_usulan` (`id`, `id_bahan_rapat`, `id_usulan`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2026-04-04 20:56:20', '2026-04-04 20:56:20'),
(2, 1, 1, '2026-04-04 21:10:48', '2026-04-04 21:10:48');

-- --------------------------------------------------------

--
-- Table structure for table `besetting_jf`
--

CREATE TABLE `besetting_jf` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `opd_id` varchar(20) DEFAULT NULL,
  `jabatan_fungsional` varchar(255) NOT NULL,
  `jenjang` enum('Pertama','Muda','Madya','Utama') NOT NULL,
  `kebutuhan` int(11) NOT NULL,
  `ketersediaan` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `besetting_jf`
--

INSERT INTO `besetting_jf` (`id`, `opd_id`, `jabatan_fungsional`, `jenjang`, `kebutuhan`, `ketersediaan`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 'OPD01', 'Analis Kebijakan', 'Pertama', 5, 4, '2026', '2026-03-31 22:25:35', '2026-03-31 22:25:35'),
(2, 'OPD02', 'Guru', 'Muda', 12, 20, '2026', '2026-03-31 22:26:31', '2026-03-31 22:28:58'),
(3, 'OPD03', 'Dokter', 'Madya', 6, 7, '2026', '2026-03-31 22:28:21', '2026-03-31 22:31:06'),
(4, 'OPD04', 'Teknik Sipil', 'Utama', 2, 1, '2026', '2026-03-31 22:30:22', '2026-03-31 22:30:22'),
(5, 'OPD05', 'Penguji Kendaraan', 'Madya', 3, 2, '2026', '2026-03-31 22:31:51', '2026-03-31 22:31:51');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_integrasi`
--

CREATE TABLE `log_integrasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_usulan` bigint(20) UNSIGNED DEFAULT NULL,
  `id_sk` bigint(20) UNSIGNED DEFAULT NULL,
  `aksi` varchar(100) NOT NULL,
  `status` enum('berhasil','gagal') NOT NULL DEFAULT 'berhasil',
  `response` text DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_30_140159_create_sessions_table', 1),
(5, '2026_03_30_230314_create_users_table', 1),
(6, '2026_03_31_040820_create_opd_table', 2),
(7, '2026_04_01_003514_create_besetting_jf_table', 3),
(8, '2026_04_01_071646_create_configurations_table', 4),
(9, '2026_04_01_132926_create_pegawai_table', 5),
(10, '2026_04_02_020359_create_usulan_table', 6),
(11, '2026_04_02_062818_create_bahan_rapat_table', 7),
(12, '2026_04_04_045340_create_bahan_rapat_table', 8),
(13, '2026_04_05_000446_add_sertifikat_and_surat_columns', 9);

-- --------------------------------------------------------

--
-- Table structure for table `opd`
--

CREATE TABLE `opd` (
  `id_opd` varchar(20) NOT NULL,
  `kode_opd` varchar(20) NOT NULL,
  `nama_opd` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `opd`
--

INSERT INTO `opd` (`id_opd`, `kode_opd`, `nama_opd`, `alamat`, `telepon`, `email`, `created_at`, `updated_at`) VALUES
('OPD01', '1.01.01', 'Sekretariat Daerah Kabupaten Kudus', 'Jl. Pendopo No. 1, Kudus, Jawa Tengah 59300', '0812345678910', 'sekretariatdaerah@gmail.com', '2026-03-31 06:43:25', '2026-03-31 06:43:25'),
('OPD02', '1.01.02', 'Dinas Pendidikan, Kepemudaan dan Olahraga', 'Jl. Pemuda No. 1, Kudus', '081234567891', 'dindik@kudus.go.id', '2026-03-31 19:45:33', '2026-03-31 19:45:33'),
('OPD03', '1.01.03', 'Dinas Kesehatan', 'Jl. Dr. Lukmonohadi No. 10, Kudus', '081234567892', 'dinkes@kudus.go.id', '2026-03-31 19:46:23', '2026-03-31 19:46:23'),
('OPD04', '1.01.04', 'Dinas Pekerjaan Umum dan Penataan Ruang', 'Jl. Simpang Tujuh No. 5, Kudus', '081234567893', 'pupr@kudus.go.id', '2026-03-31 22:21:52', '2026-03-31 22:21:52'),
('OPD05', '1.01.05', 'Dinas Perhubungan', 'Jl. Raya Kudus - Demak No. 15, Kudus', '081234567894', 'dishub@kudus.go.id', '2026-03-31 22:24:02', '2026-03-31 22:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(18) NOT NULL,
  `no_sertifikat` varchar(100) DEFAULT NULL,
  `masa_berlaku_sertifikat` date DEFAULT NULL,
  `tahun_predikat_kinerja` varchar(4) DEFAULT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `status_perkawinan` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_opd` varchar(20) NOT NULL,
  `pangkat` varchar(100) NOT NULL,
  `golongan` varchar(10) NOT NULL,
  `tmt_pangkat` date NOT NULL,
  `jabatan_saat_ini` varchar(255) NOT NULL,
  `unit_kerja` varchar(255) NOT NULL,
  `angka_kredit` decimal(10,3) NOT NULL,
  `usia_tahun` int(11) NOT NULL,
  `usia_bulan` int(11) NOT NULL,
  `pendidikan_terakhir` varchar(50) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `no_sertifikat`, `masa_berlaku_sertifikat`, `tahun_predikat_kinerja`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `status_perkawinan`, `alamat`, `no_hp`, `email`, `id_opd`, `pangkat`, `golongan`, `tmt_pangkat`, `jabatan_saat_ini`, `unit_kerja`, `angka_kredit`, `usia_tahun`, `usia_bulan`, `pendidikan_terakhir`, `jurusan`, `tahun_lulus`, `created_at`, `updated_at`) VALUES
('197506152010012001', 'REG-12345678', '2028-06-15', '2025', 'Acelia Putri Rahmawati, S.Pd', 'Kudus', '1975-07-09', 'P', 'Islam', 'Kawin', 'Jl. Kudus - Pati No. 45, RT 02/RW 03, Kelurahan Purwosari, Kecamatan Kota, Kudus, Jawa Tengah 59300', '081234567890', 'acelia.putri@example.com', 'OPD02', 'Penata', 'III/d', '2026-03-02', 'Guru Ahli Muda', 'SMP Negeri 1 Dawe', 360.086, 51, 2, 'S1', 'Pendidikan Matematika', '2000', '2026-04-01 17:32:54', '2026-04-04 18:02:48'),
('198203152010031005', 'REG-11223344', '2029-01-10', '2025', 'Dra. Siti Aminah, M.Pd', 'Jepara', '1982-03-15', 'P', 'Islam', 'Kawin', 'Jl. Raya Kudus - Jepara No. 45, Kudus, Jawa Tengah 59300', '081234567892', 'siti.aminah@example.com', 'OPD02', 'Pembina Tingkat I', 'IV/b', '2026-01-01', 'Guru Ahli Madya', 'SMA Negeri 1 Kudus', 425.750, 44, 1, 'S2', 'Pendidikan Matematika', '2015', '2026-04-04 18:17:46', '2026-04-04 18:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_usulan`
--

CREATE TABLE `riwayat_usulan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_usulan` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_usulan`
--

INSERT INTO `riwayat_usulan` (`id`, `id_usulan`, `status`, `keterangan`, `id_user`, `created_at`, `updated_at`) VALUES
(2, 2, 'sk_diterbitkan', 'Bahan rapat disetujui oleh admin_administrasi', 4, '2026-04-05 01:54:11', '2026-04-05 01:54:11');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('asciQN4oc3JDXLot8nf2j0xZCKVSIKZrp21LSyEd', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', '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', 1775465129);

-- --------------------------------------------------------

--
-- Table structure for table `sk`
--

CREATE TABLE `sk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_usulan` bigint(20) UNSIGNED NOT NULL,
  `nomor_sk` varchar(100) NOT NULL,
  `tanggal_sk` date NOT NULL,
  `file_sk` varchar(255) NOT NULL,
  `status` enum('aktif','arsip') NOT NULL DEFAULT 'aktif',
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sk`
--

INSERT INTO `sk` (`id`, `id_usulan`, `nomor_sk`, `tanggal_sk`, `file_sk`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, '800/001/BKPSDM/2026', '2026-04-05', 'uploads/sk/SK_20260405053541_surat pengantar.pdf', 'aktif', 'SK ini diterbitkan berdasarkan hasil rapat tim penilai tanggal 05 April 2026', '2026-04-04 22:35:43', '2026-04-05 23:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `id_opd` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `id_opd`, `created_at`, `updated_at`) VALUES
(1, 'admin_sistem', '$2y$12$FPtQfFW7Q.HD/QUdkgM1O.85PQ6x/kNmcv3oIdc1Y5oSVknqSME2C', 'admin_sistem', NULL, '2026-03-30 17:45:38', '2026-03-30 17:45:38'),
(2, 'admin_opd', '$2y$12$CXfAQZM8bSfKQg3vCJbDKe/rsawhDWXBQp8HVIEXjrSkm0nVbxTdK', 'admin_opd', 'OPD02', '2026-03-30 17:45:38', '2026-03-30 17:45:38'),
(3, 'verifikator', '$2y$12$ctWazqPnnMk6KZQ8/wFgBO3ABMLRfwX.bZw8/oBXXtcad4EslwoCu', 'verifikator', NULL, '2026-03-30 17:45:39', '2026-03-30 17:45:39'),
(4, 'admin_administrasi', '$2y$12$JB.snn3pKSSs53tRFt/iAOtf1u7S8dpC8jERA27upw2rvsd./xMQa', 'admin_administrasi', NULL, '2026-03-30 17:45:39', '2026-03-30 17:45:39'),
(6, 'admin_opd2', '$2y$12$TaxT/qNzWSGD8svU2/BRH.CNsvEqsciqcN5jzzRcCvt1fT4My7DMK', 'admin_opd', 'OPD01', '2026-04-01 17:49:15', '2026-04-01 17:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `usulan`
--

CREATE TABLE `usulan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(18) NOT NULL,
  `id_opd_pengusul` varchar(20) NOT NULL,
  `id_user_pengusul` bigint(20) UNSIGNED NOT NULL,
  `jenis_usulan` enum('kenaikan','perpindahan','pemberhentian') NOT NULL,
  `jabatan_lama` varchar(255) NOT NULL,
  `golongan_lama` varchar(10) NOT NULL,
  `unit_kerja_lama` varchar(255) NOT NULL,
  `jabatan_baru` varchar(255) DEFAULT NULL,
  `golongan_baru` varchar(10) DEFAULT NULL,
  `unit_kerja_tujuan` varchar(255) DEFAULT NULL,
  `angka_kredit_usulan` decimal(10,3) DEFAULT NULL,
  `alasan_perpindahan` text DEFAULT NULL,
  `alasan_pemberhentian` varchar(100) DEFAULT NULL,
  `tanggal_efektif` date DEFAULT NULL,
  `nomor_surat` varchar(100) NOT NULL,
  `no_surat_panrb` varchar(100) DEFAULT NULL,
  `jenis_surat` varchar(255) NOT NULL,
  `jumlah_bandel` int(11) NOT NULL,
  `keterangan_surat` text NOT NULL,
  `file_surat_pengantar` varchar(255) NOT NULL,
  `status` enum('menunggu_verifikasi','sedang_diverifikasi','ditolak_verifikator','menunggu_persetujuan','ditolak_administrasi','sk_diterbitkan','selesai') NOT NULL DEFAULT 'menunggu_verifikasi',
  `alasan_penolakan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usulan`
--

INSERT INTO `usulan` (`id`, `nip`, `id_opd_pengusul`, `id_user_pengusul`, `jenis_usulan`, `jabatan_lama`, `golongan_lama`, `unit_kerja_lama`, `jabatan_baru`, `golongan_baru`, `unit_kerja_tujuan`, `angka_kredit_usulan`, `alasan_perpindahan`, `alasan_pemberhentian`, `tanggal_efektif`, `nomor_surat`, `no_surat_panrb`, `jenis_surat`, `jumlah_bandel`, `keterangan_surat`, `file_surat_pengantar`, `status`, `alasan_penolakan`, `created_at`, `updated_at`) VALUES
(1, '197506152010012001', 'OPD02', 2, 'kenaikan', 'Guru Ahli Muda', 'III/d', 'SMP Negeri 1 Dawe', 'Guru Ahli Madya', 'IV/d', NULL, 360.086, NULL, NULL, NULL, '800.4.10.3/1975 /2025', 'B/4748/M.SM.01.00/2026', 'Berkas untuk kenaikan jabatan fungsional Guru', 1, 'Dikirim dengan hormat untuk penyelesaian lebih lanjut', 'uploads/surat_usulan/1775109154_surat pengantar.pdf', 'sk_diterbitkan', NULL, '2026-04-01 22:52:35', '2026-04-06 00:34:40'),
(2, '198203152010031005', 'OPD02', 2, 'kenaikan', 'Guru Ahli Madya', 'IV/b', 'SMA Negeri 1 Kudus', 'Guru Ahli Utama', 'IV/c', NULL, 425.750, NULL, NULL, NULL, '800.4.10.3/1975/2025', 'B/4748/M.SM.01.00/2026', 'Berkas untuk kenaikan jabatan fungsional Guru', 1, 'dikirim untuk tindak lanjut', 'uploads/surat_usulan/1775359259_surat pengantar.pdf', 'sk_diterbitkan', NULL, '2026-04-04 18:49:00', '2026-04-05 01:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `usulan_berkas`
--

CREATE TABLE `usulan_berkas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_usulan` bigint(20) UNSIGNED NOT NULL,
  `jenis_berkas` varchar(50) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usulan_berkas`
--

INSERT INTO `usulan_berkas` (`id`, `id_usulan`, `jenis_berkas`, `nama_file`, `path_file`, `created_at`, `updated_at`) VALUES
(1, 1, 'sk_cpns', '1775109155_sk_cpns.pdf', 'uploads/berkas_usulan/1/1775109155_sk_cpns.pdf', '2026-04-01 22:52:36', '2026-04-01 22:52:36'),
(2, 1, 'sk_pns', '1775109156_sk_pns.pdf', 'uploads/berkas_usulan/1/1775109156_sk_pns.pdf', '2026-04-01 22:52:36', '2026-04-01 22:52:36'),
(3, 1, 'sk_jabatan', '1775109156_sk_jabatan.pdf', 'uploads/berkas_usulan/1/1775109156_sk_jabatan.pdf', '2026-04-01 22:52:36', '2026-04-01 22:52:36'),
(4, 1, 'sertifikat_uk', '1775109156_sertifikat_uk.pdf', 'uploads/berkas_usulan/1/1775109156_sertifikat_uk.pdf', '2026-04-01 22:52:36', '2026-04-01 22:52:36'),
(5, 1, 'angka_kredit', '1775109156_angka_kredit.pdf', 'uploads/berkas_usulan/1/1775109156_angka_kredit.pdf', '2026-04-01 22:52:36', '2026-04-01 22:52:36'),
(6, 3, 'sk_cpns', '1775354810_sk_cpns.pdf', 'uploads/berkas_usulan/3/1775354810_sk_cpns.pdf', '2026-04-04 19:06:50', '2026-04-04 19:06:50'),
(7, 3, 'sk_pns', '1775354810_sk_pns.pdf', 'uploads/berkas_usulan/3/1775354810_sk_pns.pdf', '2026-04-04 19:06:50', '2026-04-04 19:06:50'),
(8, 3, 'sk_jabatan', '1775354810_sk_jabatan.pdf', 'uploads/berkas_usulan/3/1775354810_sk_jabatan.pdf', '2026-04-04 19:06:50', '2026-04-04 19:06:50'),
(9, 3, 'sertifikat_uk', '1775354810_sertifikat_uk.pdf', 'uploads/berkas_usulan/3/1775354810_sertifikat_uk.pdf', '2026-04-04 19:06:50', '2026-04-04 19:06:50'),
(10, 3, 'angka_kredit', '1775354810_angka_kredit.pdf', 'uploads/berkas_usulan/3/1775354810_angka_kredit.pdf', '2026-04-04 19:06:50', '2026-04-04 19:06:50'),
(11, 2, 'sk_cpns', '1775359259_sk_cpns.pdf', 'uploads/berkas_usulan/2/1775359259_sk_cpns.pdf', '2026-04-04 20:20:59', '2026-04-04 20:20:59'),
(12, 2, 'sk_pns', '1775359259_sk_pns.pdf', 'uploads/berkas_usulan/2/1775359259_sk_pns.pdf', '2026-04-04 20:20:59', '2026-04-04 20:20:59'),
(13, 2, 'sk_jabatan', '1775359259_sk_jabatan.pdf', 'uploads/berkas_usulan/2/1775359259_sk_jabatan.pdf', '2026-04-04 20:20:59', '2026-04-04 20:20:59'),
(14, 2, 'sertifikat_uk', '1775359259_sertifikat_uk.pdf', 'uploads/berkas_usulan/2/1775359259_sertifikat_uk.pdf', '2026-04-04 20:20:59', '2026-04-04 20:20:59'),
(15, 2, 'angka_kredit', '1775359259_angka_kredit.pdf', 'uploads/berkas_usulan/2/1775359259_angka_kredit.pdf', '2026-04-04 20:20:59', '2026-04-04 20:20:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_rapat`
--
ALTER TABLE `bahan_rapat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bahan_rapat_id_usulan_unique` (`id_usulan`),
  ADD UNIQUE KEY `bahan_rapat_nomor_bahan_unique` (`nomor_bahan`);

--
-- Indexes for table `bahan_rapat_usulan`
--
ALTER TABLE `bahan_rapat_usulan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bahan_rapat` (`id_bahan_rapat`),
  ADD KEY `id_usulan` (`id_usulan`);

--
-- Indexes for table `besetting_jf`
--
ALTER TABLE `besetting_jf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `besetting_jf_opd_id_foreign` (`opd_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_integrasi`
--
ALTER TABLE `log_integrasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_integrasi_id_usulan_foreign` (`id_usulan`),
  ADD KEY `log_integrasi_id_sk_foreign` (`id_sk`),
  ADD KEY `log_integrasi_id_user_foreign` (`id_user`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opd`
--
ALTER TABLE `opd`
  ADD PRIMARY KEY (`id_opd`),
  ADD UNIQUE KEY `opd_kode_opd_unique` (`kode_opd`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `pegawai_id_opd_foreign` (`id_opd`);

--
-- Indexes for table `riwayat_usulan`
--
ALTER TABLE `riwayat_usulan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_usulan_id_usulan_foreign` (`id_usulan`),
  ADD KEY `riwayat_usulan_id_user_foreign` (`id_user`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sk`
--
ALTER TABLE `sk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sk_id_usulan_foreign` (`id_usulan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `usulan`
--
ALTER TABLE `usulan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usulan_nip_foreign` (`nip`),
  ADD KEY `usulan_id_opd_pengusul_foreign` (`id_opd_pengusul`),
  ADD KEY `usulan_id_user_pengusul_foreign` (`id_user_pengusul`);

--
-- Indexes for table `usulan_berkas`
--
ALTER TABLE `usulan_berkas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_rapat`
--
ALTER TABLE `bahan_rapat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bahan_rapat_usulan`
--
ALTER TABLE `bahan_rapat_usulan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `besetting_jf`
--
ALTER TABLE `besetting_jf`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_integrasi`
--
ALTER TABLE `log_integrasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `riwayat_usulan`
--
ALTER TABLE `riwayat_usulan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sk`
--
ALTER TABLE `sk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usulan`
--
ALTER TABLE `usulan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usulan_berkas`
--
ALTER TABLE `usulan_berkas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahan_rapat`
--
ALTER TABLE `bahan_rapat`
  ADD CONSTRAINT `bahan_rapat_id_usulan_foreign` FOREIGN KEY (`id_usulan`) REFERENCES `usulan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bahan_rapat_usulan`
--
ALTER TABLE `bahan_rapat_usulan`
  ADD CONSTRAINT `bahan_rapat_usulan_ibfk_1` FOREIGN KEY (`id_bahan_rapat`) REFERENCES `bahan_rapat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bahan_rapat_usulan_ibfk_2` FOREIGN KEY (`id_usulan`) REFERENCES `usulan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `besetting_jf`
--
ALTER TABLE `besetting_jf`
  ADD CONSTRAINT `besetting_jf_opd_id_foreign` FOREIGN KEY (`opd_id`) REFERENCES `opd` (`id_opd`) ON DELETE CASCADE;

--
-- Constraints for table `log_integrasi`
--
ALTER TABLE `log_integrasi`
  ADD CONSTRAINT `log_integrasi_id_sk_foreign` FOREIGN KEY (`id_sk`) REFERENCES `sk` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `log_integrasi_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `log_integrasi_id_usulan_foreign` FOREIGN KEY (`id_usulan`) REFERENCES `usulan` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_id_opd_foreign` FOREIGN KEY (`id_opd`) REFERENCES `opd` (`id_opd`) ON DELETE CASCADE;

--
-- Constraints for table `riwayat_usulan`
--
ALTER TABLE `riwayat_usulan`
  ADD CONSTRAINT `riwayat_usulan_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `riwayat_usulan_id_usulan_foreign` FOREIGN KEY (`id_usulan`) REFERENCES `usulan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sk`
--
ALTER TABLE `sk`
  ADD CONSTRAINT `sk_id_usulan_foreign` FOREIGN KEY (`id_usulan`) REFERENCES `usulan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `usulan`
--
ALTER TABLE `usulan`
  ADD CONSTRAINT `usulan_id_opd_pengusul_foreign` FOREIGN KEY (`id_opd_pengusul`) REFERENCES `opd` (`id_opd`) ON DELETE CASCADE,
  ADD CONSTRAINT `usulan_id_user_pengusul_foreign` FOREIGN KEY (`id_user_pengusul`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `usulan_nip_foreign` FOREIGN KEY (`nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
