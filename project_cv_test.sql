CREATE DATABASE IF NOT EXISTS project_cv_test;
USE project_cv_test;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `award`
--

CREATE TABLE `award` (
  `aw_id`   int(11)   NOT NULL,
  `pd_id`   int(11)   NOT NULL,
  `nama`    text      NOT NULL,
  `tanggal` text      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `certification_type`
--

CREATE TABLE `certification_type` (
  `type_id`             int(11)       NOT NULL,
  `certification_name`  varchar(100)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `certification_type`
--

INSERT INTO `certification_type` (`type_id`, `certification_name`) VALUES
(1, 'Certiplus Program'),
(2, 'Cisco Networking Academy');

-- --------------------------------------------------------

--
-- Table structure for table `certiplus_detail`
--

CREATE TABLE `certiplus_detail` (
  `ce_id`       int(11)   NOT NULL,
  `pd_id`       int(11)   NOT NULL,
  `type_id`     int(11)   NOT NULL,
  `nama`        text      NOT NULL,
  `sumber`      text      NOT NULL,
  `tanggal`     text      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cer_type_detail`
--

CREATE TABLE `cer_type_detail` (
  `ctd_id`      int(12)       NOT NULL,
  `type_id`     int(12)       NOT NULL,
  `certi_name`  varchar(100)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cer_type_detail`
--

INSERT INTO `cer_type_detail` (`ctd_id`, `type_id`, `certi_name`) VALUES
(1, 2, 'CCNA Routing and Switching: Introduction to Network'),
(2, 2, 'CCNA Routing and Switching: Routing and Switching Essentials');

-- --------------------------------------------------------

--
-- Table structure for table `compulsary`
--

CREATE TABLE `compulsary` (
  `co_id`     int(11)       NOT NULL,
  `pd_id`     int(11)       NOT NULL,
  `nama`      varchar(50)   NOT NULL,
  `negara`    varchar(50)   NOT NULL,
  `provinsi`  varchar(50)   NOT NULL,
  `kota`      text          NOT NULL,
  `tanggal`   text          NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_job`
--

CREATE TABLE `detail_job` (
  `dj_id`             int(11)   NOT NULL,
  `ex_id`             int(11)   NOT NULL,
  `detail_pekerjaan`  text      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_technology`
--

CREATE TABLE `detail_technology` (
  `dt_id`             int(11)   NOT NULL,
  `te_id`             int(11)   NOT NULL,
  `detail_teknologi`  text      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `employment_objective`
--

CREATE TABLE `employment_objective` (
  `eo_id`       int(11)   NOT NULL,
  `pd_id`       int(11)   NOT NULL,
  `objective`   text      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `experience`
--

CREATE TABLE `experience` (
  `ex_id`               int(11)   NOT NULL,
  `pd_id`               int(11)   NOT NULL,
  `nama_perusahaan`     text      NOT NULL,
  `kota`                text      NOT NULL,
  `negara`              text      NOT NULL,
  `detail_perusahaan`   text      NOT NULL,
  `scoping_statement`   text      NOT NULL,
  `posisi`              text      NOT NULL,
  `status`              text      NOT NULL,
  `tanggal_mulai`       text      NOT NULL,
  `tanggal_selesai`     text      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `higher_education`
--

CREATE TABLE `higher_education` (
  `he_id`         int(11)     NOT NULL,
  `pd_id`         int(11)     NOT NULL,
  `nama`          text        NOT NULL,
  `kota`          text        NOT NULL,
  `jurusan`       int(11)     NOT NULL,
  `concentration` text        NOT NULL,
  `gelar`         text        NOT NULL,
  `ipk`           float(3,2)  NOT NULL,
  `tanggal`       text        NOT NULL,
  `negara`        varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `lg_id`               int(11)   NOT NULL,
  `pd_id`               int(11)   NOT NULL,
  `language`            text      NOT NULL,
  `language_test`       text      NOT NULL,
  `Language_proficient` text      NOT NULL,
  `score`               int(11)   NOT NULL,
  `date`                text      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `language_skill`
--

CREATE TABLE `language_skill` (
  `ls_id`   int(11)   NOT NULL,
  `lg_id`   int(11)   NOT NULL,
  `skill`   text      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `negara`
--

CREATE TABLE `negara` (
  `ne_id`       int(11)     NOT NULL,
  `nama_negara` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `negara`
--

INSERT INTO `negara` (`ne_id`, `nama_negara`) VALUES
(1, 'Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `or_id`             int(11)   NOT NULL,
  `pd_id`             int(11)   NOT NULL,
  `nama`              text      NOT NULL,
  `posisi`            text      NOT NULL,
  `detail_organisasi` text      NOT NULL,
  `tanggal_mulai`     text      NOT NULL,
  `tanggal_selesai`   text      NOT NULL,
  `detail_pekerjaan`  text      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `other_experience`
--

CREATE TABLE `other_experience` (
  `ox_id`             int(11) NOT NULL,
  `pd_id`             int(11) NOT NULL,
  `nama`              text NOT NULL,
  `detail_perusahaan` text NOT NULL,
  `posisi`            text NOT NULL,
  `detail_pekerjaan`  text NOT NULL,
  `tanggal`           text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pd_to_ctd`
--

CREATE TABLE `pd_to_ctd` (
  `ptc_id`  int(12) NOT NULL,
  `pd_id`   int(12) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `personal_detail`
--

CREATE TABLE `personal_detail` (
  `pd_id`     int(11)       NOT NULL,
  `us_id`     int(11)       NOT NULL,
  `ps_id`     int(11)       NOT NULL,
  `no_induk`  varchar(10)   NOT NULL,
  `nama`      varchar(100)  NOT NULL,
  `alamat`    varchar(100)  NOT NULL,
  `kota`      varchar(50)   NOT NULL,
  `propinsi`  varchar(50)   NOT NULL,
  `negara`    text          NOT NULL,
  `kode_pos`  varchar(6)    DEFAULT NULL,
  `no_telpon` bigint(16)    NOT NULL,
  `email`     varchar(64)   NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `picture`
--

CREATE TABLE `picture` (
  `ph_id`   int(11)       NOT NULL,
  `us_id`   int(11)       NOT NULL,
  `picture` varchar(35)   NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `program_studi`
--

CREATE TABLE `program_studi` (
  `ps_id`   int(11)       NOT NULL,
  `nama`    varchar(50)   NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_studi`
--

INSERT INTO `program_studi` (`ps_id`, `nama`) VALUES
(1, 'Mobile Technology'),
(2, 'Media and Internet Technology');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `pr_id`           int(11)       NOT NULL,
  `nama_provinsi`   varchar(50)   NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`pr_id`, `nama_provinsi`) VALUES
(1, 'Aceh'),
(2, 'Bali'),
(3, 'Banten'),
(4, 'Bengkulu'),
(5, 'Gorontalo'),
(6, 'Jakarta'),
(7, 'Jambi'),
(8, 'Jawa Barat'),
(9, 'Jawa Tengah'),
(10, 'Jawa Timur'),
(11, 'Kalimantan Barat'),
(12, 'Kalimantan Selatan'),
(13, 'Kalimantan Tengah'),
(14, 'Kalimantan Timur'),
(15, 'Kalimantan Utara'),
(16, 'Kepulauan Bangka Belitung'),
(17, 'Kepulauan Riau'),
(18, 'Lampung'),
(19, 'Maluku'),
(20, 'Maluku Barat'),
(21, 'Nusa Tenggara Barat'),
(22, 'Nusa Tenggara Timur'),
(23, 'Papua'),
(24, 'Papua Barat'),
(25, 'Riau'),
(26, 'Sumatra Barat'),
(27, 'Sumatra Selatan'),
(28, 'Sumatra Utara'),
(29, 'Sulawesi Barat'),
(30, 'Sulawesi Selatan'),
(31, 'Sulawesi Tengah'),
(32, 'Sulawesi Tenggara'),
(33, 'Sulawesi Utara'),
(34, 'Yogyakarta');


-- --------------------------------------------------------

--
-- Table structure for table `ptc_to_procer`
--

CREATE TABLE `ptc_to_procer` (
  `pcr_id`  int(12)       NOT NULL,
  `ptc_id`  int(12)       NOT NULL,
  `ctd_id`  int(12)       NOT NULL,
  `tanggal` varchar(100)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId`          int(11)   NOT NULL,
  `pwdResetEmail`       text      NOT NULL,
  `pwdResetSelector`    text      NOT NULL,
  `pwdResetToken`       longtext  NOT NULL,
  `pwdResetExpires`     text      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `re_id`   int(11)       NOT NULL,
  `role`    varchar(150)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`re_id`, `role`) VALUES
(1, 'Mahasiswa'),
(2, 'Reviewer');

-- --------------------------------------------------------

--
-- Table structure for table `technology`
--

CREATE TABLE `technology` (
  `te_id`           int(11)   NOT NULL,
  `pd_id`           int(11)   NOT NULL,
  `nama_teknologi`  text      NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `us_id`             int(11)       NOT NULL,
  `email`             varchar(64)   NOT NULL,
  `password`          varchar(128)  NOT NULL,
  `role`              int(2)        NOT NULL,
  `recovery_question` varchar(50)   NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `award`
--
ALTER TABLE `award`
  ADD PRIMARY KEY (`aw_id`),
  ADD KEY `pd_id` (`pd_id`);

--
-- Indexes for table `certification_type`
--
ALTER TABLE `certification_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `certiplus_detail`
--
ALTER TABLE `certiplus_detail`
  ADD PRIMARY KEY (`ce_id`),
  ADD KEY `pd_id` (`pd_id`),
  ADD KEY `certiplus_detail_ibfk_1` (`type_id`);

--
-- Indexes for table `cer_type_detail`
--
ALTER TABLE `cer_type_detail`
  ADD PRIMARY KEY (`ctd_id`),
  ADD KEY `cer_type_detail_ibfk_1` (`type_id`);

--
-- Indexes for table `compulsary`
--
ALTER TABLE `compulsary`
  ADD PRIMARY KEY (`co_id`),
  ADD KEY `compulsary_ibfk_1` (`pd_id`);

--
-- Indexes for table `detail_job`
--
ALTER TABLE `detail_job`
  ADD PRIMARY KEY (`dj_id`),
  ADD KEY `ex_id` (`ex_id`);

--
-- Indexes for table `detail_technology`
--
ALTER TABLE `detail_technology`
  ADD PRIMARY KEY (`dt_id`),
  ADD KEY `te_id` (`te_id`);

--
-- Indexes for table `employment_objective`
--
ALTER TABLE `employment_objective`
  ADD PRIMARY KEY (`eo_id`),
  ADD KEY `pd_id` (`pd_id`);

--
-- Indexes for table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`ex_id`),
  ADD KEY `pd_id` (`pd_id`);

--
-- Indexes for table `higher_education`
--
ALTER TABLE `higher_education`
  ADD PRIMARY KEY (`he_id`),
  ADD KEY `pd_id` (`pd_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`lg_id`),
  ADD KEY `pd_id` (`pd_id`);

--
-- Indexes for table `language_skill`
--
ALTER TABLE `language_skill`
  ADD PRIMARY KEY (`ls_id`),
  ADD KEY `lg_id` (`lg_id`);

--
-- Indexes for table `negara`
--
ALTER TABLE `negara`
  ADD PRIMARY KEY (`ne_id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`or_id`),
  ADD KEY `pd_id` (`pd_id`);

--
-- Indexes for table `other_experience`
--
ALTER TABLE `other_experience`
  ADD PRIMARY KEY (`ox_id`),
  ADD KEY `pd_id` (`pd_id`);

--
-- Indexes for table `pd_to_ctd`
--
ALTER TABLE `pd_to_ctd`
  ADD PRIMARY KEY (`ptc_id`),
  ADD KEY `pd_to_ctd_ibfk_1` (`pd_id`),
  ADD KEY `pd_to_ctd_ibfk_3` (`type_id`);

--
-- Indexes for table `personal_detail`
--
ALTER TABLE `personal_detail`
  ADD PRIMARY KEY (`pd_id`),
  ADD KEY `us_id` (`us_id`),
  ADD KEY `ps_id` (`ps_id`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`ph_id`),
  ADD KEY `us_id` (`us_id`);

--
-- Indexes for table `program_studi`
--
ALTER TABLE `program_studi`
  ADD PRIMARY KEY (`ps_id`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexes for table `ptc_to_procer`
--
ALTER TABLE `ptc_to_procer`
  ADD PRIMARY KEY (`pcr_id`),
  ADD KEY `ptc_to_procer_ibfk_1` (`ptc_id`),
  ADD KEY `ptc_to_procer_ibfk_2` (`ctd_id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`re_id`);

--
-- Indexes for table `technology`
--
ALTER TABLE `technology`
  ADD PRIMARY KEY (`te_id`),
  ADD KEY `pd_id` (`pd_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`us_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `award`
--
ALTER TABLE `award`
  MODIFY `aw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `certification_type`
--
ALTER TABLE `certification_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `certiplus_detail`
--
ALTER TABLE `certiplus_detail`
  MODIFY `ce_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `cer_type_detail`
--
ALTER TABLE `cer_type_detail`
  MODIFY `ctd_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `compulsary`
--
ALTER TABLE `compulsary`
  MODIFY `co_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `detail_job`
--
ALTER TABLE `detail_job`
  MODIFY `dj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `detail_technology`
--
ALTER TABLE `detail_technology`
  MODIFY `dt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `employment_objective`
--
ALTER TABLE `employment_objective`
  MODIFY `eo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `experience`
--
ALTER TABLE `experience`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `higher_education`
--
ALTER TABLE `higher_education`
  MODIFY `he_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `lg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `language_skill`
--
ALTER TABLE `language_skill`
  MODIFY `ls_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `or_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `other_experience`
--
ALTER TABLE `other_experience`
  MODIFY `ox_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `pd_to_ctd`
--
ALTER TABLE `pd_to_ctd`
  MODIFY `ptc_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `personal_detail`
--
ALTER TABLE `personal_detail`
  MODIFY `pd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
  MODIFY `ph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `program_studi`
--
ALTER TABLE `program_studi`
  MODIFY `ps_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `ptc_to_procer`
--
ALTER TABLE `ptc_to_procer`
  MODIFY `pcr_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `technology`
--
ALTER TABLE `technology`
  MODIFY `te_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `award`
--
ALTER TABLE `award`
  ADD CONSTRAINT `award_ibfk_1` FOREIGN KEY (`pd_id`) REFERENCES `personal_detail` (`pd_id`) ON DELETE CASCADE;

--
-- Constraints for table `certiplus_detail`
--
ALTER TABLE `certiplus_detail`
  ADD CONSTRAINT `certiplus_detail_ibfk_1` FOREIGN KEY (`type_id`)  REFERENCES `certification_type` (`type_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `certiplus_detail_ibfk_2` FOREIGN KEY (`pd_id`)    REFERENCES `personal_detail` (`pd_id`) ON DELETE CASCADE;

--
-- Constraints for table `cer_type_detail`
--
ALTER TABLE `cer_type_detail`
  ADD CONSTRAINT `cer_type_detail_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `certification_type` (`type_id`) ON DELETE CASCADE;

--
-- Constraints for table `compulsary`
--
ALTER TABLE `compulsary`
  ADD CONSTRAINT `compulsary_ibfk_1` FOREIGN KEY (`pd_id`) REFERENCES `personal_detail` (`pd_id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_job`
--
ALTER TABLE `detail_job`
  ADD CONSTRAINT `detail_job_ibfk_1` FOREIGN KEY (`ex_id`) REFERENCES `experience` (`ex_id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_technology`
--
ALTER TABLE `detail_technology`
  ADD CONSTRAINT `detail_technology_ibfk_1` FOREIGN KEY (`te_id`) REFERENCES `technology` (`te_id`) ON DELETE CASCADE;

--
-- Constraints for table `employment_objective`
--
ALTER TABLE `employment_objective`
  ADD CONSTRAINT `employment_objective_ibfk_1` FOREIGN KEY (`pd_id`) REFERENCES `personal_detail` (`pd_id`) ON DELETE CASCADE;

--
-- Constraints for table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `experience_ibfk_1` FOREIGN KEY (`pd_id`) REFERENCES `personal_detail` (`pd_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `higher_education`
--
ALTER TABLE `higher_education`
  ADD CONSTRAINT `higher_education_ibfk_1` FOREIGN KEY (`pd_id`) REFERENCES `personal_detail` (`pd_id`) ON DELETE CASCADE;

--
-- Constraints for table `language`
--
ALTER TABLE `language`
  ADD CONSTRAINT `language_ibfk_1` FOREIGN KEY (`pd_id`) REFERENCES `personal_detail` (`pd_id`) ON DELETE CASCADE;

--
-- Constraints for table `language_skill`
--
ALTER TABLE `language_skill`
  ADD CONSTRAINT `language_skill_ibfk_1` FOREIGN KEY (`lg_id`) REFERENCES `language` (`lg_id`) ON DELETE CASCADE;

--
-- Constraints for table `organization`
--
ALTER TABLE `organization`
  ADD CONSTRAINT `organization_ibfk_1` FOREIGN KEY (`pd_id`) REFERENCES `personal_detail` (`pd_id`) ON DELETE CASCADE;

--
-- Constraints for table `other_experience`
--
ALTER TABLE `other_experience`
  ADD CONSTRAINT `other_experience_ibfk_1` FOREIGN KEY (`pd_id`) REFERENCES `personal_detail` (`pd_id`) ON DELETE CASCADE;

--
-- Constraints for table `pd_to_ctd`
--
ALTER TABLE `pd_to_ctd`
  ADD CONSTRAINT `pd_to_ctd_ibfk_1` FOREIGN KEY (`pd_id`) REFERENCES `personal_detail` (`pd_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pd_to_ctd_ibfk_3` FOREIGN KEY (`type_id`) REFERENCES `certification_type` (`type_id`) ON DELETE CASCADE;

--
-- Constraints for table `personal_detail`
--
ALTER TABLE `personal_detail`
  ADD CONSTRAINT `personal_detail_ibfk_2` FOREIGN KEY (`ps_id`) REFERENCES `program_studi` (`ps_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `personal_detail_ibfk_3` FOREIGN KEY (`us_id`) REFERENCES `users` (`us_id`) ON DELETE CASCADE;

--
-- Constraints for table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `picture_ibfk_1` FOREIGN KEY (`us_id`) REFERENCES `users` (`us_id`) ON DELETE CASCADE;

--
-- Constraints for table `ptc_to_procer`
--
ALTER TABLE `ptc_to_procer`
  ADD CONSTRAINT `ptc_to_procer_ibfk_1` FOREIGN KEY (`ptc_id`) REFERENCES `pd_to_ctd` (`ptc_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ptc_to_procer_ibfk_2` FOREIGN KEY (`ctd_id`) REFERENCES `cer_type_detail` (`ctd_id`) ON DELETE CASCADE;

--
-- Constraints for table `technology`
--
ALTER TABLE `technology`
  ADD CONSTRAINT `technology_ibfk_1` FOREIGN KEY (`pd_id`) REFERENCES `personal_detail` (`pd_id`) ON DELETE CASCADE;
COMMIT;
