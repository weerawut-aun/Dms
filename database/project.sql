-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2021 at 07:04 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL,
  `adm_show` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `agd_id` int(10) NOT NULL,
  `agd_name` varchar(255) NOT NULL,
  `agd_day` date NOT NULL DEFAULT current_timestamp(),
  `agd_show` enum('0','1') NOT NULL,
  `y_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `appoint_letter`
--

CREATE TABLE `appoint_letter` (
  `apt_id` int(10) NOT NULL,
  `apt_filename` varchar(255) NOT NULL,
  `apt_date` date NOT NULL DEFAULT current_timestamp(),
  `pro_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `approval_letter`
--

CREATE TABLE `approval_letter` (
  `alt_id` int(10) NOT NULL,
  `alt_filename` varchar(255) NOT NULL,
  `alt_date` date NOT NULL DEFAULT current_timestamp(),
  `pro_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `comment_meeting`
--

CREATE TABLE `comment_meeting` (
  `cmg_id` int(10) NOT NULL,
  `parent_id` int(10) NOT NULL,
  `cmg_comment` text NOT NULL,
  `agd_id` int(10) NOT NULL,
  `cmg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `complete_letter`
--

CREATE TABLE `complete_letter` (
  `clt_id` int(10) NOT NULL,
  `clt_filename` varchar(50) NOT NULL,
  `clt_date` date NOT NULL DEFAULT current_timestamp(),
  `pro_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dean`
--

CREATE TABLE `dean` (
  `dea_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL,
  `dea_show` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doc`
--

CREATE TABLE `doc` (
  `doc_id` int(10) NOT NULL,
  `doc_filename` varchar(255) NOT NULL,
  `agd_id` int(10) NOT NULL,
  `doc_date` date NOT NULL DEFAULT current_timestamp(),
  `usr_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `document_other`
--

CREATE TABLE `document_other` (
  `don_id` int(10) NOT NULL,
  `don_filename` varchar(255) NOT NULL,
  `don_date` date NOT NULL DEFAULT current_timestamp(),
  `pro_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `endorser`
--

CREATE TABLE `endorser` (
  `eds_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `fct_id` int(10) NOT NULL,
  `fct_name` varchar(50) NOT NULL,
  `fct_uploadsize` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `img_id` int(10) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `pro_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `info_object`
--

CREATE TABLE `info_object` (
  `iof_id` int(10) NOT NULL,
  `iof_object` text NOT NULL,
  `pro_id` int(10) NOT NULL,
  `iof_date` date NOT NULL DEFAULT current_timestamp(),
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `info_place`
--

CREATE TABLE `info_place` (
  `ipe_id` int(10) NOT NULL,
  `ipe_place` text NOT NULL,
  `ipe_date` date NOT NULL DEFAULT current_timestamp(),
  `pro_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `info_projecttype`
--

CREATE TABLE `info_projecttype` (
  `ipt_id` int(10) NOT NULL,
  `ipt_pty` text NOT NULL,
  `ipt_date` date NOT NULL DEFAULT current_timestamp(),
  `pro_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `info_repon`
--

CREATE TABLE `info_repon` (
  `irn_id` int(10) NOT NULL,
  `irn_repon` varchar(255) NOT NULL,
  `irn_date` date NOT NULL DEFAULT current_timestamp(),
  `pro_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `info_schedule`
--

CREATE TABLE `info_schedule` (
  `ise_id` int(10) NOT NULL,
  `ise_schedule` date NOT NULL,
  `ise_date` text NOT NULL DEFAULT current_timestamp(),
  `pro_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invitation_letter_summary`
--

CREATE TABLE `invitation_letter_summary` (
  `ils_id` int(10) NOT NULL,
  `ils_filename` varchar(255) NOT NULL,
  `ils_date` date NOT NULL DEFAULT current_timestamp(),
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invite`
--

CREATE TABLE `invite` (
  `inv_id` int(10) NOT NULL,
  `inv_filename` varchar(255) NOT NULL,
  `agd_id` int(10) NOT NULL,
  `inv_date` date NOT NULL DEFAULT current_timestamp(),
  `usr_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `list_attend`
--

CREATE TABLE `list_attend` (
  `lat_id` int(10) NOT NULL,
  `lat_filename` varchar(255) NOT NULL,
  `lat_date` date NOT NULL DEFAULT current_timestamp(),
  `pro_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `meet_detail`
--

CREATE TABLE `meet_detail` (
  `mtd_id` int(10) NOT NULL,
  `mtd_date` date NOT NULL DEFAULT current_timestamp(),
  `agd_id` int(10) NOT NULL,
  `inv_id` int(10) NOT NULL,
  `sig_id` int(10) NOT NULL,
  `min_id` int(10) NOT NULL,
  `doc_id` int(10) NOT NULL,
  `mtd_day` date NOT NULL,
  `usr_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `mtd_detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `meet_sign_summary`
--

CREATE TABLE `meet_sign_summary` (
  `mss_id` int(10) NOT NULL,
  `mss_filename` varchar(255) NOT NULL,
  `mss_date` date NOT NULL DEFAULT current_timestamp(),
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `minutes`
--

CREATE TABLE `minutes` (
  `min_id` int(10) NOT NULL,
  `min_filename` varchar(255) NOT NULL,
  `agd_id` int(10) NOT NULL,
  `min_date` date NOT NULL DEFAULT current_timestamp(),
  `usr_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `other`
--

CREATE TABLE `other` (
  `oth_id` int(10) NOT NULL,
  `oth_filename` varchar(255) NOT NULL,
  `oth_date` date NOT NULL DEFAULT current_timestamp(),
  `pro_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permit_user`
--

CREATE TABLE `permit_user` (
  `pmu_id` int(10) NOT NULL,
  `pmu_permit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permit_user`
--

INSERT INTO `permit_user` (`pmu_id`, `pmu_permit`) VALUES
(1, 'ผู้อนุมัติ'),
(2, 'เจ้าหน้าที่ผ่าย'),
(3, 'เลขานุการ(สโมสรนักศึกษา)'),
(4, 'สมาชิกสโมสรนักศึกษา'),
(5, 'อาจารย์');

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `pla_id` int(10) NOT NULL,
  `pla_name` varchar(255) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `pla_show` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `pro_id` int(10) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `y_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `pro_date` date NOT NULL DEFAULT current_timestamp(),
  `pro_details` text NOT NULL,
  `pro_show` enum('0','1','2') NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `project_book`
--

CREATE TABLE `project_book` (
  `pbk_id` int(10) NOT NULL,
  `pbk_filename` varchar(255) NOT NULL,
  `pbk_date` date NOT NULL DEFAULT current_timestamp(),
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `pro_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `project_details`
--

CREATE TABLE `project_details` (
  `pdt_id` int(10) NOT NULL,
  `iof_id` int(10) NOT NULL,
  `ipt_id` int(10) NOT NULL,
  `ise_id` int(10) NOT NULL,
  `ipe_id` int(10) NOT NULL,
  `irn_id` int(10) NOT NULL,
  `wpt_id` int(10) NOT NULL,
  `alt_id` int(10) NOT NULL,
  `apt_id` int(10) NOT NULL,
  `img_id` int(10) NOT NULL,
  `lat_id` int(10) NOT NULL,
  `oth_id` int(10) NOT NULL,
  `pbk_id` int(10) NOT NULL,
  `clt_id` int(10) NOT NULL,
  `don_id` int(10) NOT NULL,
  `pro_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `pdt_status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `project_type`
--

CREATE TABLE `project_type` (
  `pty_id` int(10) NOT NULL,
  `pty_type` varchar(50) NOT NULL,
  `pty_show` enum('0','1') NOT NULL,
  `fct_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report_document`
--

CREATE TABLE `report_document` (
  `rpd_id` int(10) NOT NULL,
  `rpd_filename` varchar(255) NOT NULL,
  `rpd_date` date NOT NULL DEFAULT current_timestamp(),
  `usr_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report_meet_summary`
--

CREATE TABLE `report_meet_summary` (
  `rms_id` int(10) NOT NULL,
  `rms_filename` varchar(255) NOT NULL,
  `rms_date` date NOT NULL DEFAULT current_timestamp(),
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `responsible_project`
--

CREATE TABLE `responsible_project` (
  `rpt_id` int(10) NOT NULL,
  `rpt_person` varchar(255) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `rpt_show` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `secretary`
--

CREATE TABLE `secretary` (
  `str_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sign`
--

CREATE TABLE `sign` (
  `sig_id` int(10) NOT NULL,
  `sig_filename` varchar(100) NOT NULL,
  `agd_id` int(10) NOT NULL,
  `sig_date` date NOT NULL DEFAULT current_timestamp(),
  `usr_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `stf_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `std_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `tec_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `title_prefix`
--

CREATE TABLE `title_prefix` (
  `tpf_id` int(10) NOT NULL,
  `tpf_prefix` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `title_prefix`
--

INSERT INTO `title_prefix` (`tpf_id`, `tpf_prefix`) VALUES
(1, 'นาย'),
(2, 'นาง'),
(3, 'นางสาว'),
(4, 'ผศ.ดร.'),
(5, 'ดร.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `usr_id` int(10) NOT NULL,
  `usr_username` varchar(20) NOT NULL,
  `usr_password` varchar(255) NOT NULL,
  `usr_prefix` varchar(10) NOT NULL,
  `usr_firstname` varchar(50) NOT NULL,
  `usr_lastname` varchar(50) NOT NULL,
  `usr_tel` varchar(10) NOT NULL,
  `usr_email` varchar(50) NOT NULL,
  `usr_adr` text NOT NULL,
  `fct_id` int(10) NOT NULL,
  `usr_show` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `web_config`
--

CREATE TABLE `web_config` (
  `wcf_id` smallint(5) NOT NULL,
  `wcf_name` varchar(255) NOT NULL,
  `title_bar` int(10) NOT NULL,
  `upload_size` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web_config`
--

INSERT INTO `web_config` (`wcf_id`, `wcf_name`, `title_bar`, `upload_size`) VALUES
(1, '$2y$10$ZoTN/vFAgruVTz5Wagro/uKoKeTY86sqyvCDLDjiO.tu3NEUw6U0i', 0, 0),
(2, '$2y$10$/lGjETpL7.e0eyj2NQye1.rbammZ3rkm0tjehKOpg2a4.wjcq3Py.', 0, 0),
(3, 'ระบบบริหารจัดการเอกสารสโมสรนักศึกษา', 1, 0),
(4, '2097152', 0, 1),
(5, '4194304', 0, 1),
(6, '6291456', 0, 1),
(7, '8388608', 0, 1),
(8, '10485760', 0, 1),
(9, '12582912', 0, 1),
(10, '14680064', 0, 1),
(11, '16777216', 0, 1),
(12, '18874368', 0, 1),
(13, '20971520', 0, 1),
(14, '23068672', 0, 1),
(15, '25165824', 0, 1),
(16, '27262976', 0, 1),
(17, '29360128', 0, 1),
(18, '31457280', 0, 1),
(19, '33554432', 0, 1),
(20, '35651584', 0, 1),
(21, '37748736', 0, 1),
(22, '39845888', 0, 1),
(23, '41943040', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `write_project`
--

CREATE TABLE `write_project` (
  `wpt_id` int(10) NOT NULL,
  `wpt_filename` varchar(255) NOT NULL,
  `wpt_date` date NOT NULL DEFAULT current_timestamp(),
  `pro_id` int(10) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `y_id` int(10) NOT NULL,
  `usr_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `y_id` int(10) NOT NULL,
  `y_years` varchar(5) NOT NULL,
  `fct_id` int(10) NOT NULL,
  `fct_y` varchar(255) NOT NULL,
  `y_show` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`agd_id`);

--
-- Indexes for table `appoint_letter`
--
ALTER TABLE `appoint_letter`
  ADD PRIMARY KEY (`apt_id`);

--
-- Indexes for table `approval_letter`
--
ALTER TABLE `approval_letter`
  ADD PRIMARY KEY (`alt_id`);

--
-- Indexes for table `comment_meeting`
--
ALTER TABLE `comment_meeting`
  ADD PRIMARY KEY (`cmg_id`);

--
-- Indexes for table `complete_letter`
--
ALTER TABLE `complete_letter`
  ADD PRIMARY KEY (`clt_id`);

--
-- Indexes for table `dean`
--
ALTER TABLE `dean`
  ADD PRIMARY KEY (`dea_id`);

--
-- Indexes for table `doc`
--
ALTER TABLE `doc`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `document_other`
--
ALTER TABLE `document_other`
  ADD PRIMARY KEY (`don_id`);

--
-- Indexes for table `endorser`
--
ALTER TABLE `endorser`
  ADD PRIMARY KEY (`eds_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`fct_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `info_object`
--
ALTER TABLE `info_object`
  ADD PRIMARY KEY (`iof_id`);

--
-- Indexes for table `info_place`
--
ALTER TABLE `info_place`
  ADD PRIMARY KEY (`ipe_id`);

--
-- Indexes for table `info_projecttype`
--
ALTER TABLE `info_projecttype`
  ADD PRIMARY KEY (`ipt_id`);

--
-- Indexes for table `info_repon`
--
ALTER TABLE `info_repon`
  ADD PRIMARY KEY (`irn_id`);

--
-- Indexes for table `info_schedule`
--
ALTER TABLE `info_schedule`
  ADD PRIMARY KEY (`ise_id`);

--
-- Indexes for table `invitation_letter_summary`
--
ALTER TABLE `invitation_letter_summary`
  ADD PRIMARY KEY (`ils_id`);

--
-- Indexes for table `invite`
--
ALTER TABLE `invite`
  ADD PRIMARY KEY (`inv_id`),
  ADD UNIQUE KEY `inv_name` (`inv_filename`);

--
-- Indexes for table `list_attend`
--
ALTER TABLE `list_attend`
  ADD PRIMARY KEY (`lat_id`);

--
-- Indexes for table `meet_detail`
--
ALTER TABLE `meet_detail`
  ADD PRIMARY KEY (`mtd_id`);

--
-- Indexes for table `meet_sign_summary`
--
ALTER TABLE `meet_sign_summary`
  ADD PRIMARY KEY (`mss_id`);

--
-- Indexes for table `minutes`
--
ALTER TABLE `minutes`
  ADD PRIMARY KEY (`min_id`);

--
-- Indexes for table `other`
--
ALTER TABLE `other`
  ADD PRIMARY KEY (`oth_id`);

--
-- Indexes for table `permit_user`
--
ALTER TABLE `permit_user`
  ADD PRIMARY KEY (`pmu_id`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`pla_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `project_book`
--
ALTER TABLE `project_book`
  ADD PRIMARY KEY (`pbk_id`);

--
-- Indexes for table `project_details`
--
ALTER TABLE `project_details`
  ADD PRIMARY KEY (`pdt_id`);

--
-- Indexes for table `project_type`
--
ALTER TABLE `project_type`
  ADD PRIMARY KEY (`pty_id`);

--
-- Indexes for table `report_document`
--
ALTER TABLE `report_document`
  ADD PRIMARY KEY (`rpd_id`);

--
-- Indexes for table `report_meet_summary`
--
ALTER TABLE `report_meet_summary`
  ADD PRIMARY KEY (`rms_id`);

--
-- Indexes for table `responsible_project`
--
ALTER TABLE `responsible_project`
  ADD PRIMARY KEY (`rpt_id`);

--
-- Indexes for table `secretary`
--
ALTER TABLE `secretary`
  ADD PRIMARY KEY (`str_id`);

--
-- Indexes for table `sign`
--
ALTER TABLE `sign`
  ADD PRIMARY KEY (`sig_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`stf_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`std_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`tec_id`);

--
-- Indexes for table `title_prefix`
--
ALTER TABLE `title_prefix`
  ADD PRIMARY KEY (`tpf_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`usr_id`);

--
-- Indexes for table `web_config`
--
ALTER TABLE `web_config`
  ADD PRIMARY KEY (`wcf_id`);

--
-- Indexes for table `write_project`
--
ALTER TABLE `write_project`
  ADD PRIMARY KEY (`wpt_id`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`y_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `agd_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appoint_letter`
--
ALTER TABLE `appoint_letter`
  MODIFY `apt_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `approval_letter`
--
ALTER TABLE `approval_letter`
  MODIFY `alt_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comment_meeting`
--
ALTER TABLE `comment_meeting`
  MODIFY `cmg_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complete_letter`
--
ALTER TABLE `complete_letter`
  MODIFY `clt_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dean`
--
ALTER TABLE `dean`
  MODIFY `dea_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doc`
--
ALTER TABLE `doc`
  MODIFY `doc_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_other`
--
ALTER TABLE `document_other`
  MODIFY `don_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `endorser`
--
ALTER TABLE `endorser`
  MODIFY `eds_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `fct_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `img_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_object`
--
ALTER TABLE `info_object`
  MODIFY `iof_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_place`
--
ALTER TABLE `info_place`
  MODIFY `ipe_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_projecttype`
--
ALTER TABLE `info_projecttype`
  MODIFY `ipt_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_repon`
--
ALTER TABLE `info_repon`
  MODIFY `irn_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_schedule`
--
ALTER TABLE `info_schedule`
  MODIFY `ise_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invitation_letter_summary`
--
ALTER TABLE `invitation_letter_summary`
  MODIFY `ils_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invite`
--
ALTER TABLE `invite`
  MODIFY `inv_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_attend`
--
ALTER TABLE `list_attend`
  MODIFY `lat_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meet_detail`
--
ALTER TABLE `meet_detail`
  MODIFY `mtd_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meet_sign_summary`
--
ALTER TABLE `meet_sign_summary`
  MODIFY `mss_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `minutes`
--
ALTER TABLE `minutes`
  MODIFY `min_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `other`
--
ALTER TABLE `other`
  MODIFY `oth_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permit_user`
--
ALTER TABLE `permit_user`
  MODIFY `pmu_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `pla_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `pro_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_book`
--
ALTER TABLE `project_book`
  MODIFY `pbk_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_details`
--
ALTER TABLE `project_details`
  MODIFY `pdt_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_type`
--
ALTER TABLE `project_type`
  MODIFY `pty_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_document`
--
ALTER TABLE `report_document`
  MODIFY `rpd_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_meet_summary`
--
ALTER TABLE `report_meet_summary`
  MODIFY `rms_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responsible_project`
--
ALTER TABLE `responsible_project`
  MODIFY `rpt_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `secretary`
--
ALTER TABLE `secretary`
  MODIFY `str_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sign`
--
ALTER TABLE `sign`
  MODIFY `sig_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `stf_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `std_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `tec_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `title_prefix`
--
ALTER TABLE `title_prefix`
  MODIFY `tpf_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `usr_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_config`
--
ALTER TABLE `web_config`
  MODIFY `wcf_id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `write_project`
--
ALTER TABLE `write_project`
  MODIFY `wpt_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `y_id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
