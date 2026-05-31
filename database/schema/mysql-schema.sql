/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
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
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `kebijakan_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kebijakan_applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `application_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemilik_usaha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pengaju` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hubungan_pengaju` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ptp_data` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu_bpn',
  `bpn_berkas_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `bpn_cek_lokasi_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpn_cek_lokasi_dt` datetime DEFAULT NULL,
  `bpn_cek_lokasi_cp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpn_rapat_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpn_rapat_dt` datetime DEFAULT NULL,
  `bpn_pertek_document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpn_notes` text COLLATE utf8mb4_unicode_ci,
  `dinas_pu_notes` text COLLATE utf8mb4_unicode_ci,
  `satu_pintu_notes` text COLLATE utf8mb4_unicode_ci,
  `approval_document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `peta_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_kuasa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fc_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fc_npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fc_akta_pendirian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rencana_penggunaan_tanah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `persyaratan_lainnya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nib` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kbli` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposal_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kebijakan_applications_application_number_unique` (`application_number`),
  KEY `kebijakan_applications_user_id_foreign` (`user_id`),
  CONSTRAINT `kebijakan_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `lapolpa_bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lapolpa_bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `whatsapp_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booking_date` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'booked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lapolpa_bookings_user_id_unique` (`user_id`),
  CONSTRAINT `lapolpa_bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ppkpr_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ppkpr_applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `application_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemilik_usaha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pengaju` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hubungan_pengaju` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ptp_data` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu_bpn',
  `bpn_berkas_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `bpn_cek_lokasi_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpn_cek_lokasi_dt` datetime DEFAULT NULL,
  `bpn_cek_lokasi_cp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpn_rapat_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpn_rapat_dt` datetime DEFAULT NULL,
  `bpn_pertek_document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satu_pintu_no_pkkpr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satu_pintu_tanggal_terbit` date DEFAULT NULL,
  `bpn_notes` text COLLATE utf8mb4_unicode_ci,
  `dinas_pu_notes` text COLLATE utf8mb4_unicode_ci,
  `satu_pintu_notes` text COLLATE utf8mb4_unicode_ci,
  `approval_document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `peta_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_kuasa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fc_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fc_npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fc_akta_pendirian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rencana_penggunaan_tanah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `persyaratan_lainnya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nib` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kbli` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposal_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ppkpr_applications_application_number_unique` (`application_number`),
  KEY `ppkpr_applications_user_id_foreign` (`user_id`),
  CONSTRAINT `ppkpr_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `ppkpr_berusaha_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ppkpr_berusaha_applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `application_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemilik_usaha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pengaju` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hubungan_pengaju` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ptp_data` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu_bpn',
  `bpn_berkas_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `bpn_pembayaran_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum_bayar',
  `no_berkas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpn_cek_lokasi_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpn_cek_lokasi_dt` datetime DEFAULT NULL,
  `bpn_cek_lokasi_cp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpn_rapat_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpn_rapat_dt` datetime DEFAULT NULL,
  `bpn_pertek_document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpn_notes` text COLLATE utf8mb4_unicode_ci,
  `dinas_pu_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `dinas_pu_notes` text COLLATE utf8mb4_unicode_ci,
  `satu_pintu_no_pkkpr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satu_pintu_tanggal_terbit` date DEFAULT NULL,
  `satu_pintu_document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satu_pintu_notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `peta_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_kuasa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fc_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fc_npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fc_akta_pendirian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rencana_penggunaan_tanah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nib` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kbli` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposal_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `persyaratan_lainnya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dinas_pu_tanggal_penilaian` date DEFAULT NULL,
  `dinas_pu_document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ppkpr_berusaha_applications_application_number_unique` (`application_number`),
  KEY `ppkpr_berusaha_applications_user_id_foreign` (`user_id`),
  CONSTRAINT `ppkpr_berusaha_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `psn_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `psn_applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `application_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemilik_usaha` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pengaju` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hubungan_pengaju` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu_bpn',
  `ptp_data` text COLLATE utf8mb4_unicode_ci,
  `bpn_notes` text COLLATE utf8mb4_unicode_ci,
  `dinas_pu_notes` text COLLATE utf8mb4_unicode_ci,
  `satu_pintu_notes` text COLLATE utf8mb4_unicode_ci,
  `peta_lokasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surat_kuasa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fc_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fc_npwp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fc_akta_pendirian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rencana_penggunaan_tanah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposal_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `persyaratan_lainnya` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpn_berkas_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `bpn_cek_lokasi_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpn_cek_lokasi_dt` datetime DEFAULT NULL,
  `bpn_cek_lokasi_cp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpn_rapat_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bpn_rapat_dt` datetime DEFAULT NULL,
  `bpn_pertek_document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dinas_pu_tanggal_penilaian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dinas_pu_document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satu_pintu_no_pkkpr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satu_pintu_tanggal_terbit` date DEFAULT NULL,
  `approval_document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `psn_applications_application_number_unique` (`application_number`),
  KEY `psn_applications_user_id_foreign` (`user_id`),
  CONSTRAINT `psn_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `module_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` bigint unsigned NOT NULL,
  `rating` int NOT NULL,
  `rating_label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reviews_user_id_module_type_module_id_unique` (`user_id`,`module_type`,`module_id`),
  CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pelaku_usaha',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `business_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (1,'0001_01_01_000000_create_users_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (4,'2026_05_21_002205_create_ppkpr_applications_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (5,'2026_05_21_010000_create_kebijakan_applications_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (6,'2026_05_21_020000_create_ppkpr_berusaha_applications_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (7,'2026_05_22_030000_create_lapolpa_bookings_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (8,'2026_05_22_040000_create_reviews_table',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (9,'2026_05_24_134259_split_doc_persyaratan_to_multiple_columns',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (10,'2026_05_29_035436_add_missing_document_columns_to_all_tables',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (11,'2026_05_29_085000_add_ptp_data_to_all_applications_tables',1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (12,'2026_05_29_122006_add_dinas_pu_fields_to_ppkpr_berusaha_applications_table',2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (13,'2026_05_29_200000_add_no_berkas_to_ppkpr_berusaha_applications_table',3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (14,'2026_05_29_200001_add_satu_pintu_fields_to_ppkpr_applications_table',4);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES (15,'2026_05_29_210000_create_psn_applications_table',5);
