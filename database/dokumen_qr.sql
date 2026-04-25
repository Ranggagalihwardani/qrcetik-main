-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 25 Apr 2026 pada 01.02
-- Versi server: 8.4.3
-- Versi PHP: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dokumen_qr`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `documents`
--

CREATE TABLE `documents` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `html_template` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci,
  `pdf_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sha256` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','processing','generated','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `documents`
--

INSERT INTO `documents` (`id`, `uuid`, `title`, `html_template`, `payload`, `pdf_path`, `sha256`, `status`, `created_at`, `updated_at`) VALUES
(5, 'ae6aa287-4c7a-4677-b11b-bf8179bcde99', 'SURAT UNDANGAN', '<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 150%; tab-stops: 2.0cm center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 150%; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></p>\r\n<p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom: 0cm; text-align: center; line-height: 115%;\"><v:shapetype id=\"_x0000_t75\" coordsize=\"21600,21600\" o:spt=\"75\" o:preferrelative=\"t\" path=\"m@4@5l@4@11@9@11@9@5xe\" filled=\"f\" stroked=\"f\"> <v:stroke joinstyle=\"miter\"> <v:formulas> <v:f eqn=\"if lineDrawn pixelLineWidth 0\"> <v:f eqn=\"sum @0 1 0\"> <v:f eqn=\"sum 0 0 @1\"> <v:f eqn=\"prod @2 1 2\"> <v:f eqn=\"prod @3 21600 pixelWidth\"> <v:f eqn=\"prod @3 21600 pixelHeight\"> <v:f eqn=\"sum @0 0 1\"> <v:f eqn=\"prod @6 1 2\"> <v:f eqn=\"prod @7 21600 pixelWidth\"> <v:f eqn=\"sum @8 21600 0\"> <v:f eqn=\"prod @7 21600 pixelHeight\"> <v:f eqn=\"sum @10 21600 0\"> </v:f></v:f></v:f></v:f></v:f></v:f></v:f></v:f></v:f></v:f></v:f></v:f></v:formulas> <v:path o:extrusionok=\"f\" gradientshapeok=\"t\" o:connecttype=\"rect\"> <o:lock v:ext=\"edit\" aspectratio=\"t\"> </o:lock></v:path></v:stroke></v:shapetype><v:shape id=\"Picture_x0020_4\" o:spid=\"_x0000_s1027\" type=\"#_x0000_t75\" style=\"position: absolute; left: 0; text-align: left; margin-left: 399.95pt; margin-top: -.35pt; width: 67.4pt; height: 67.55pt; z-index: 251663360; visibility: visible; mso-wrap-style: square; mso-width-percent: 0; mso-height-percent: 0; mso-wrap-distance-left: 9pt; mso-wrap-distance-top: 0; mso-wrap-distance-right: 9pt; mso-wrap-distance-bottom: 0; mso-position-horizontal: absolute; mso-position-horizontal-relative: text; mso-position-vertical: absolute; mso-position-vertical-relative: text; mso-width-relative: margin; mso-height-relative: margin;\"> <v:imagedata src=\"file:///C:/Users/MSI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image001.png\" o:title=\"\"> </v:imagedata></v:shape><v:shape id=\"Picture_x0020_2\" o:spid=\"_x0000_s1026\" type=\"#_x0000_t75\" style=\"position: absolute; left: 0; text-align: left; margin-left: 25.05pt; margin-top: -11.65pt; width: 59.45pt; height: 79.25pt; z-index: 251662336; visibility: visible; mso-wrap-style: square; mso-width-percent: 0; mso-height-percent: 0; mso-wrap-distance-left: 9pt; mso-wrap-distance-top: 0; mso-wrap-distance-right: 9pt; mso-wrap-distance-bottom: 0; mso-position-horizontal: absolute; mso-position-horizontal-relative: text; mso-position-vertical: absolute; mso-position-vertical-relative: text; mso-width-relative: margin; mso-height-relative: margin;\"> <v:imagedata src=\"file:///C:/Users/MSI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image002.png\" o:title=\"\"> </v:imagedata></v:shape><b><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">KKN TEMATIK KELOMPOK 27<o:p></o:p></span></b></p>\r\n<p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom: 0cm; text-align: center; line-height: 115%;\"><b><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">UNIVERSITAS DUTA BANGSA SURAKARTA<o:p></o:p></span></b></p>\r\n<p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom: 0cm; text-align: center; line-height: 115%;\"><i><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Desa Samirukun, Kel.Plesungan, Kec.gondangrejo<o:p></o:p></span></i></p>\r\n<p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom: 0cm; text-align: center; line-height: 115%;\"><i><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Kab.Boyolali, Jawa Tengah 57383<o:p></o:p></span></i></p>\r\n<div style=\"mso-element: para-border-div; border: none; border-bottom: solid windowtext 2.25pt; padding: 0cm 0cm 1.0pt 0cm;\">\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal; border: none; mso-border-bottom-alt: solid windowtext 2.25pt; padding: 0cm; mso-padding-alt: 0cm 0cm 1.0pt 0cm;\"><i><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></i></p>\r\n</div>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal;\"><i><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></i></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 78.0pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Nomor<span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>: 001/UND/RT 03/2025<span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 78.0pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Perihal<span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>: <b>Undangan <o:p></o:p></b></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 78.0pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 78.0pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Kepada Yth,<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 78.0pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Ibu &ndash; Ibu Desa Samirukun RT 03<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 78.0pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 99.25pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Di -<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 99.25pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Tempat<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 99.25pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 99.25pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Assalamualaikum Wr.Wb.<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"text-align: justify; text-indent: 36.0pt;\"><a name=\"_Hlk185975154\"></a><span style=\"font-size: 12.0pt; line-height: 107%; font-family: \'Times New Roman\',serif;\">Puji syukur kehadirat Allah SWT karena atas limpahan rahmat dan hidayah-Nya kita masih dapat merasakan Ni&rsquo;mat yang tidak dapat dihitung. Sholawat serta salam kita haturkan kepada Nabi Muhammmad SAW yang semoga kita mendapat syafa&rsquo;at beliau di akhir nanti, Aamiin.<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"text-align: justify; text-indent: 36.0pt;\"><span style=\"font-size: 12.0pt; line-height: 107%; font-family: \'Times New Roman\',serif;\">Sehubungan dengan diadakannya rangkaian kegiatan untuk pembentukan Panitia/Struktur RT 03 kami mengunndang Ibu yang akan dilaksanakan pada :<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"text-indent: 36.0pt; line-height: normal;\"><b style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif;\">Hari/tanggal<span style=\"mso-tab-count: 1;\">&nbsp; </span>: Selasa, 31 Desember 2024<o:p></o:p></span></b></p>\r\n<p class=\"MsoNormal\" style=\"text-indent: 36.0pt; line-height: normal;\"><b style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif;\">Waktu<span style=\"mso-tab-count: 2;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>: 19.00 WIB<o:p></o:p></span></b></p>\r\n<p class=\"MsoNormal\" style=\"text-indent: 36.0pt; line-height: normal;\"><b style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif;\">Tempat<span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>: Rumah Ibu .....<o:p></o:p></span></b></p>\r\n<p class=\"MsoNormal\" style=\"text-indent: 36.0pt; line-height: normal;\"><b style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif;\">Keperluan<span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>: Pembentukan Panitia RT 03<o:p></o:p></span></b></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; text-align: justify; line-height: 115%; tab-stops: 35.45pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Demikian surat izin ini kami buat, atas partisipasi dan kerja samanya kami ucapkan terimakasih.<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; text-align: justify; line-height: 115%; tab-stops: 2.0cm center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; text-align: justify; line-height: 115%; tab-stops: 2.0cm center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Wassalamualaikum Wr.Wb.<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 2.0cm center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 2.0cm center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 2.0cm center 411.1pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><span style=\"mso-tab-count: 2;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Kauman,<span style=\"mso-spacerun: yes;\">&nbsp; </span>20 Desember 2024<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: center 70.9pt 411.1pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><span style=\"mso-tab-count: 2;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style=\"mso-spacerun: yes;\">&nbsp;</span>Mengetahui,<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: center 70.9pt left 177.2pt 191.4pt 382.75pt 389.85pt center 411.1pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><span style=\"mso-spacerun: yes;\">&nbsp;&nbsp;&nbsp; </span><span style=\"mso-spacerun: yes;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Ketua RT 03<span style=\"mso-tab-count: 3;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Ketua RW 02<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: center 70.9pt 411.1pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: center 70.9pt 411.1pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: center 70.9pt 411.1pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: center 70.9pt 411.1pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: center 70.9pt 411.1pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><b>(<u>Satino</u>)</b><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><b>(<u>Ari </u>)<o:p></o:p></b></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: center 70.9pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><o:p></o:p></span></p>', NULL, 'documents/48dc2c63-b9e4-4621-944b-56585165335e.pdf', '874d48743013d5eedc704e9131faa17a2225345c0ba3243da9f5f84f05a25b32', 'generated', '2025-09-24 08:12:10', '2025-09-24 09:09:08'),
(6, 'b4854e0e-991f-44ae-9b02-3b203bc94ac3', 'SURAT UNDANGAN', '<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 150%; tab-stops: 2.0cm center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 150%; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></p>\r\n<p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom: 0cm; text-align: center; line-height: 115%;\"><v:shapetype id=\"_x0000_t75\" coordsize=\"21600,21600\" o:spt=\"75\" o:preferrelative=\"t\" path=\"m@4@5l@4@11@9@11@9@5xe\" filled=\"f\" stroked=\"f\"> <v:stroke joinstyle=\"miter\"> <v:formulas> <v:f eqn=\"if lineDrawn pixelLineWidth 0\"> <v:f eqn=\"sum @0 1 0\"> <v:f eqn=\"sum 0 0 @1\"> <v:f eqn=\"prod @2 1 2\"> <v:f eqn=\"prod @3 21600 pixelWidth\"> <v:f eqn=\"prod @3 21600 pixelHeight\"> <v:f eqn=\"sum @0 0 1\"> <v:f eqn=\"prod @6 1 2\"> <v:f eqn=\"prod @7 21600 pixelWidth\"> <v:f eqn=\"sum @8 21600 0\"> <v:f eqn=\"prod @7 21600 pixelHeight\"> <v:f eqn=\"sum @10 21600 0\"> </v:f></v:f></v:f></v:f></v:f></v:f></v:f></v:f></v:f></v:f></v:f></v:f></v:formulas> <v:path o:extrusionok=\"f\" gradientshapeok=\"t\" o:connecttype=\"rect\"> <o:lock v:ext=\"edit\" aspectratio=\"t\"> </o:lock></v:path></v:stroke></v:shapetype><v:shape id=\"Picture_x0020_4\" o:spid=\"_x0000_s1027\" type=\"#_x0000_t75\" style=\"position: absolute; left: 0; text-align: left; margin-left: 399.95pt; margin-top: -.35pt; width: 67.4pt; height: 67.55pt; z-index: 251663360; visibility: visible; mso-wrap-style: square; mso-width-percent: 0; mso-height-percent: 0; mso-wrap-distance-left: 9pt; mso-wrap-distance-top: 0; mso-wrap-distance-right: 9pt; mso-wrap-distance-bottom: 0; mso-position-horizontal: absolute; mso-position-horizontal-relative: text; mso-position-vertical: absolute; mso-position-vertical-relative: text; mso-width-relative: margin; mso-height-relative: margin;\"> <v:imagedata src=\"file:///C:/Users/MSI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image001.png\" o:title=\"\"> </v:imagedata></v:shape><v:shape id=\"Picture_x0020_2\" o:spid=\"_x0000_s1026\" type=\"#_x0000_t75\" style=\"position: absolute; left: 0; text-align: left; margin-left: 25.05pt; margin-top: -11.65pt; width: 59.45pt; height: 79.25pt; z-index: 251662336; visibility: visible; mso-wrap-style: square; mso-width-percent: 0; mso-height-percent: 0; mso-wrap-distance-left: 9pt; mso-wrap-distance-top: 0; mso-wrap-distance-right: 9pt; mso-wrap-distance-bottom: 0; mso-position-horizontal: absolute; mso-position-horizontal-relative: text; mso-position-vertical: absolute; mso-position-vertical-relative: text; mso-width-relative: margin; mso-height-relative: margin;\"> <v:imagedata src=\"file:///C:/Users/MSI~1/AppData/Local/Temp/msohtmlclip1/01/clip_image002.png\" o:title=\"\"> </v:imagedata></v:shape><b><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">KKN TEMATIK KELOMPOK 27<o:p></o:p></span></b></p>\r\n<p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom: 0cm; text-align: center; line-height: 115%;\"><b><span style=\"font-size: 14.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">UNIVERSITAS DUTA BANGSA SURAKARTA<o:p></o:p></span></b></p>\r\n<p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom: 0cm; text-align: center; line-height: 115%;\"><i><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Desa Samirukun, Kel.Plesungan, Kec.gondangrejo<o:p></o:p></span></i></p>\r\n<p class=\"MsoNormal\" align=\"center\" style=\"margin-bottom: 0cm; text-align: center; line-height: 115%;\"><i><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Kab.Boyolali, Jawa Tengah 57383<o:p></o:p></span></i></p>\r\n<div style=\"mso-element: para-border-div; border: none; border-bottom: solid windowtext 2.25pt; padding: 0cm 0cm 1.0pt 0cm;\">\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal; border: none; mso-border-bottom-alt: solid windowtext 2.25pt; padding: 0cm; mso-padding-alt: 0cm 0cm 1.0pt 0cm;\"><i><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></i></p>\r\n</div>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal;\"><i><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></i></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 78.0pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Nomor<span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>: 001/UND/RT 03/2025<span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 78.0pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Perihal<span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>: <b>Undangan&nbsp;<o:p></o:p></b></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 78.0pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Kepada Yth,<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 78.0pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Ibu &ndash; Ibu Desa Samirukun RT 03<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 99.25pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Di -<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 99.25pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Tempat<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 99.25pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">Assalamualaikum Wr.Wb.<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"text-align: justify; text-indent: 36.0pt;\"><a name=\"_Hlk185975154\"></a><span style=\"font-size: 12.0pt; line-height: 107%; font-family: \'Times New Roman\',serif;\">Puji syukur kehadirat Allah SWT karena atas limpahan rahmat dan hidayah-Nya kita masih dapat merasakan Ni&rsquo;mat yang tidak dapat dihitung. Sholawat serta salam kita haturkan kepada Nabi Muhammmad SAW yang semoga kita mendapat syafa&rsquo;at beliau di akhir nanti, Aamiin.<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"text-align: justify; text-indent: 36.0pt;\"><span style=\"font-size: 12.0pt; line-height: 107%; font-family: \'Times New Roman\',serif;\">Sehubungan dengan diadakannya rangkaian kegiatan untuk pembentukan Panitia/Struktur RT 03 kami mengunndang Ibu yang akan dilaksanakan pada :<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"text-indent: 36.0pt; line-height: normal;\"><b style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif;\">Hari/tanggal<span style=\"mso-tab-count: 1;\">&nbsp; </span>: Selasa, 31 Desember 2024<o:p></o:p></span></b></p>\r\n<p class=\"MsoNormal\" style=\"text-indent: 36.0pt; line-height: normal;\"><b style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif;\">Waktu<span style=\"mso-tab-count: 2;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>: 19.00 WIB<o:p></o:p></span></b></p>\r\n<p class=\"MsoNormal\" style=\"text-indent: 36.0pt; line-height: normal;\"><b style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif;\">Tempat<span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>: Rumah Ibu .....<o:p></o:p></span></b></p>\r\n<p class=\"MsoNormal\" style=\"text-indent: 36.0pt; line-height: normal;\"><b style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; font-family: \'Times New Roman\',serif;\">Keperluan<span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>: Pembentukan Panitia RT 03<o:p></o:p></span></b></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; text-align: justify; line-height: 115%; tab-stops: 35.45pt center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Demikian surat izin ini kami buat, atas partisipasi dan kerja samanya kami ucapkan terimakasih.<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; text-align: justify; line-height: 115%; tab-stops: 2.0cm center 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\">WassalamualaikUm Wr.Wb.<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: 2.0cm center 411.1pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><span style=\"mso-tab-count: 2;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Kauman,<span style=\"mso-spacerun: yes;\">&nbsp; </span>20 Desember 2024<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: center 70.9pt 411.1pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><span style=\"mso-tab-count: 2;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style=\"mso-spacerun: yes;\">&nbsp;</span>Mengetahui,<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: center 70.9pt left 177.2pt 191.4pt 382.75pt 389.85pt center 411.1pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><span style=\"mso-spacerun: yes;\">&nbsp;&nbsp;&nbsp; </span><span style=\"mso-spacerun: yes;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Ketua RT 03<span style=\"mso-tab-count: 3;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Ketua RW 02<o:p></o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: center 70.9pt 411.1pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: center 70.9pt 411.1pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: center 70.9pt 411.1pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: center 70.9pt 411.1pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><o:p>&nbsp;</o:p></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: center 70.9pt 411.1pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><b>(<u>Satino</u>)</b><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><b>(<u>Ari </u>)<o:p></o:p></b></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 115%; tab-stops: center 70.9pt 439.45pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; font-family: \'Times New Roman\',serif;\"><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><o:p></o:p></span></p>', NULL, 'documents/e32ffaf7-b60a-419f-bcc0-d2e3a6faf7fa.pdf', '769d9ffd58bf2226e6deb2d6063a6fe3f15d76d68eb7ee86389295c9e05e014f', 'generated', '2025-09-24 08:13:37', '2025-10-17 09:11:03'),
(20, 'a5214afe-2206-42bf-9097-f538934e4647', 'dfgrds', '<p>gseges</p>', 'sefse', 'documents/d67d13b2-934a-42d8-9e3b-09e5372f13be.pdf', '39c8fab25190c6d459ddac8a856ff0203e837012a0d86c055e6ded8f8228bb43', 'generated', '2025-11-05 12:03:54', '2025-11-05 12:04:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_24_000000_create_documents_table', 1),
(5, '2025_09_25_042522_add_role_to_users_table', 2),
(6, '2025_09_25_105507_add_session_id_to_users_table', 3),
(7, '2025_09_25_135242_add_avatar_to_users_table', 4),
(8, '2025_09_25_152922_create_pdf_uploads_table', 5),
(9, '2025_09_25_193941_add_status_to_pdf_uploads_table', 6),
(10, '2025_09_26_171851_add_payload_to_documents_table', 7),
(11, '2025_09_26_180930_add_payload_to_pdf_uploads_table', 8),
(12, '2025_09_26_185704_create_settings_table', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pdf_uploads`
--

CREATE TABLE `pdf_uploads` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint UNSIGNED NOT NULL DEFAULT '0',
  `pdf_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pdf_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pdf_sha256` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qr_png_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'uploaded',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pdf_uploads`
--

INSERT INTO `pdf_uploads` (`id`, `uuid`, `title`, `payload`, `original_name`, `mime`, `size`, `pdf_path`, `pdf_url`, `pdf_sha256`, `qr_png_path`, `status`, `created_at`, `updated_at`) VALUES
(4, 'fd074f21-dc7c-46eb-85fa-6295048846dd', 'misal', NULL, 'UNDANGAN REMAS.pdf', 'application/pdf', 158040, 'pdf_with_qr/ee63008e-1845-462d-820d-d5ace009031c.pdf', 'http://127.0.0.1:8000/storage/pdf_with_qr/ee63008e-1845-462d-820d-d5ace009031c.pdf', 'c7ca20c7642ebc1df60331ca80c5488290f24c636f53ef246494ad8787a67000', 'qr_uploads/e2cdf94f-2020-46dc-b78b-33e2a82b7ed0.png', 'generated', '2025-09-25 12:40:15', '2025-09-25 12:40:15'),
(16, '000fef59-57d0-47e5-b6cb-02dfa2d1b6fa', 'SURAT UNDANGAN MASJID', 'rangga', '002UNDRPTIX2025.pdf', 'application/pdf', 158210, 'pdf_with_qr/87dcc1c2-bec7-4e2f-9303-48de06e4bb71.pdf', 'http://127.0.0.1:8000/storage/pdf_with_qr/87dcc1c2-bec7-4e2f-9303-48de06e4bb71.pdf', '492ba9ef9aa8b061e4d2fc4984a4094c62fc35917afc0b8ef4170c0e68039923', 'qr_uploads/84871e4e-e733-4d15-8018-d4dffc6efc8b.png', 'generated', '2025-10-05 23:49:42', '2025-10-05 23:49:42'),
(17, 'fc8b7cda-1428-4783-bf45-4a4f7c237774', 'SURAT UNDANGAN MASJID', 'rangga', '002UNDRPTIX2025.pdf', 'application/pdf', 158210, 'pdf_with_qr/f9731cb0-83ad-4985-8c42-190193e0450d.pdf', 'http://127.0.0.1:8000/storage/pdf_with_qr/f9731cb0-83ad-4985-8c42-190193e0450d.pdf', 'f1568e91ca6e53fcb025e4da4e9cf88ad39c6597c7e526035474f24959a49ea8', 'qr_uploads/68f74e00-d9ea-4646-baf2-604a5bd78b4d.png', 'generated', '2025-10-05 23:49:42', '2025-10-05 23:49:42'),
(18, '65dc86dd-2e79-41db-b84d-c6d2dda3e6ce', 'fdfh', 'rangga', '002UNDRPTIX2025.pdf', 'application/pdf', 158210, 'pdf_with_qr/d4c00060-0dbd-47b4-ae8d-56a70560c252.pdf', 'http://127.0.0.1:8000/storage/pdf_with_qr/d4c00060-0dbd-47b4-ae8d-56a70560c252.pdf', 'a27561808f750bc833a67c6b3eed68b9d65747ddb89542f512262a299786a6bc', 'qr_uploads/1be13203-7670-4762-bdab-25318c96fc35.png', 'generated', '2025-10-17 09:11:47', '2025-10-17 09:11:47'),
(19, '60c2dfe9-346d-46fc-a66d-0761e8c65fdf', 'ASU', 'rangga', '002UNDRPTIX2025.pdf', 'application/pdf', 158210, 'pdf_with_qr/fe0c5b8a-6314-442b-882c-a76931a97247.pdf', 'http://127.0.0.1:8000/storage/pdf_with_qr/fe0c5b8a-6314-442b-882c-a76931a97247.pdf', 'e2fd91e95ae48d40efe8776b5e1cc277f947a47b78b7761e560d37853a51dcd6', 'qr_uploads/f8e9dfdd-def1-4e61-b771-15a7a033294a.png', 'generated', '2025-10-21 00:21:46', '2025-10-21 00:21:46'),
(20, '608c4a87-2b69-4897-809f-ffaf5f3ed027', 'SURAT KETERANGAN SEHAT', 'Rangga galih wardani', '001UNDRPTI2026.pdf', 'application/pdf', 100520, 'pdf_with_qr/0a2e6c51-e778-4c7b-b4aa-7f2a61e556f3.pdf', 'http://localhost:8000/storage/pdf_with_qr/0a2e6c51-e778-4c7b-b4aa-7f2a61e556f3.pdf', 'a2f5aa43c1adcdf53d1de5c4431544d35445567c98e803ce5fc1b5e725e5a72e', 'qr_uploads/fb429084-5187-4fad-8190-bb018331545b.png', 'generated', '2026-04-20 05:19:09', '2026-04-20 05:19:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('SyEoRlBW9IB8r5kLyefXU7MgAsCVhpXh6HA9Y3T4', 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid1BqQUJmQWpHR0dOUWlTZHBSekFiN1YyaVlTUUxLeW0xZHFWRllVdyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kb2N1bWVudHMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1777073175);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'CETIKLI', '2025-09-26 12:19:35', '2025-09-26 12:19:35'),
(2, 'tagline', 'cetak PDF, cetik QR!', '2025-09-26 12:19:35', '2025-09-26 12:19:35'),
(3, 'footer_text', '© 2025 QR Docs', '2025-09-26 12:19:35', '2025-09-26 12:19:35'),
(4, 'contact_email', 'support@example.com', '2025-09-26 12:19:35', '2025-09-26 12:19:35'),
(5, 'company_name', 'QR Docs', '2025-09-26 12:19:35', '2025-09-26 12:19:35'),
(6, 'company_addr', '—', '2025-09-26 12:19:35', '2025-09-26 12:19:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `email_verified_at`, `password`, `role`, `remember_token`, `session_id`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@mail.com', NULL, NULL, '$2y$12$pwB5wi3lsiSeTuEIOWSoLuPPOgI5k6GvdJrzuxnFy4UKGKwJfyuMa', 'admin', NULL, NULL, '2025-09-24 21:23:45', '2025-09-24 21:23:45'),
(2, 'rangga galih', 'galehrangga24@gmail.com', 'avatars/ava_68e365a070a0f.jpg', NULL, '$2y$12$q8XK28k7MZXyOk/7fwEYpeSFM3EwEgYh747.v4ZsR.aORr6jzD9di', 'admin', NULL, NULL, '2025-09-24 22:15:42', '2026-04-20 06:25:11'),
(4, 'Dona Indra', 'dona12@gmail.com', 'avatars/ava_69e779a441aa4.jpg', NULL, '$2y$12$m3S5/Nv56YRwAPLYy7KBkuljL7bYp8JrdXDTiADGoK6lCErG1hLqW', 'user', NULL, NULL, '2026-04-21 06:19:52', '2026-04-21 06:20:37'),
(5, 'Diptyasama', 'diptya@gmail.com', NULL, NULL, '$2y$12$283eZin8EDtElBw.gyp8zuTaxwFizJjapYNCotgJoKuSyzX.0JEb6', 'user', NULL, NULL, '2026-04-24 16:25:35', '2026-04-24 16:25:35');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documents_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pdf_uploads`
--
ALTER TABLE `pdf_uploads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pdf_uploads_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pdf_uploads`
--
ALTER TABLE `pdf_uploads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
