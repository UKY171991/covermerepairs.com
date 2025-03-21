-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 21, 2025 at 12:37 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u841852544_crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `auditor`
--

CREATE TABLE `auditor` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `address` varchar(500) NOT NULL,
  `dob` date NOT NULL,
  `qualification` varchar(500) NOT NULL,
  `location` text NOT NULL,
  `email` varchar(500) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `standred` text NOT NULL,
  `view_count` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1=active , 0= inactive',
  `added_by` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auditor`
--

INSERT INTO `auditor` (`id`, `name`, `address`, `dob`, `qualification`, `location`, `email`, `phone`, `standred`, `view_count`, `status`, `added_by`, `created`, `updated`) VALUES
(1, 'XYZ', 'qw', '2023-11-30', 'dfg', 'xyz', 'uky171991@gmail.com', '02425342424', 'wertghy', 0, '1', 1, '2023-11-02 12:59:20', '2023-11-02 12:59:20'),
(2, 'ABC', 'qw', '2023-11-03', 'dfg', 'abc', 'admin14@gmail.com', '02425342424', 'wertghy', 0, '1', 1, '2023-11-02 13:13:44', '2023-11-02 13:13:44');

-- --------------------------------------------------------

--
-- Table structure for table `billty`
--

CREATE TABLE `billty` (
  `id` int(11) NOT NULL,
  `branch` text NOT NULL,
  `PSN` text NOT NULL,
  `consignment_no` text NOT NULL,
  `consignment_date` date NOT NULL,
  `CIN` text NOT NULL,
  `PAN` text NOT NULL,
  `work_order_details_WO_No` text NOT NULL,
  `work_order_details_date` date NOT NULL,
  `work_order_details_SAP_delivery_no` text NOT NULL,
  `work_order_details_loading_station` text NOT NULL,
  `work_order_details_distance` text NOT NULL,
  `work_order_details_vehicle_no` text NOT NULL,
  `work_order_details_delivery_station` text NOT NULL,
  `work_order_details_transit_days` text NOT NULL,
  `work_order_details_load_type` text NOT NULL,
  `consignor_details_name` text NOT NULL,
  `consignor_details_address` text NOT NULL,
  `consignor_details_GSTIN` text NOT NULL,
  `consignor_details_designtiaon` text NOT NULL,
  `consignee_details_name` text NOT NULL,
  `consignee_details_address` text NOT NULL,
  `consignee_details_GSTIN` text NOT NULL,
  `sold_to_contain_product` text NOT NULL,
  `sold_to_contain_no_of_pkg` text NOT NULL,
  `sold_to_contain_packing` text NOT NULL,
  `sold_to_contain_value_of_goods` text NOT NULL,
  `weight_in_MT_net` text NOT NULL,
  `weight_in_MT_weight` text NOT NULL,
  `weight_in_MT_minimum_gurantee_weight` text NOT NULL,
  `freight_charge_amount_freight` text NOT NULL,
  `freight_charge_amount_rate_PMT` text NOT NULL,
  `freight_charge_amount_advance` text NOT NULL,
  `freight_charge_amount_balance` text NOT NULL,
  `party_document_details_document_type` text NOT NULL,
  `party_document_details_document_no` text NOT NULL,
  `party_document_details_document_date` date NOT NULL,
  `party_document_details_invoice_no` text NOT NULL,
  `basis_of_booking` text NOT NULL,
  `branch_to_pay` text NOT NULL,
  `branch_paid` text NOT NULL,
  `transit_insurance_by_carrier` text NOT NULL,
  `transit_insurance_by_customer` text NOT NULL,
  `name_of_insurance_company` text NOT NULL,
  `policy_no` text NOT NULL,
  `policy_date` date NOT NULL,
  `any_remarks` text NOT NULL,
  `government_by_consignor` text NOT NULL,
  `government_by_consignee` text NOT NULL,
  `government_by_GTA` text NOT NULL,
  `government_by_exempt` text NOT NULL,
  `reporng_date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `releasing_date_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `reason_for_detention` text NOT NULL,
  `loading_supervisor_details_name` text NOT NULL,
  `loading_supervisor_details_employee_code` text NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1=active , 0= inactive',
  `added_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billty`
--

INSERT INTO `billty` (`id`, `branch`, `PSN`, `consignment_no`, `consignment_date`, `CIN`, `PAN`, `work_order_details_WO_No`, `work_order_details_date`, `work_order_details_SAP_delivery_no`, `work_order_details_loading_station`, `work_order_details_distance`, `work_order_details_vehicle_no`, `work_order_details_delivery_station`, `work_order_details_transit_days`, `work_order_details_load_type`, `consignor_details_name`, `consignor_details_address`, `consignor_details_GSTIN`, `consignor_details_designtiaon`, `consignee_details_name`, `consignee_details_address`, `consignee_details_GSTIN`, `sold_to_contain_product`, `sold_to_contain_no_of_pkg`, `sold_to_contain_packing`, `sold_to_contain_value_of_goods`, `weight_in_MT_net`, `weight_in_MT_weight`, `weight_in_MT_minimum_gurantee_weight`, `freight_charge_amount_freight`, `freight_charge_amount_rate_PMT`, `freight_charge_amount_advance`, `freight_charge_amount_balance`, `party_document_details_document_type`, `party_document_details_document_no`, `party_document_details_document_date`, `party_document_details_invoice_no`, `basis_of_booking`, `branch_to_pay`, `branch_paid`, `transit_insurance_by_carrier`, `transit_insurance_by_customer`, `name_of_insurance_company`, `policy_no`, `policy_date`, `any_remarks`, `government_by_consignor`, `government_by_consignee`, `government_by_GTA`, `government_by_exempt`, `reporng_date_time`, `releasing_date_time`, `reason_for_detention`, `loading_supervisor_details_name`, `loading_supervisor_details_employee_code`, `status`, `added_by`, `created`, `updated`) VALUES
(6, '5', 'ghfhhh', '566565656565', '0000-00-00', 'qw', 'q', 'sdf', '2023-12-06', 'sdf', 'sdfg', 'sdfg', 'sdf', 'sd', 'f', 'sdf', 'sdf', '2023-12-18', 'sdf', 'ert', 'sdfg', '2023-12-20', 'sdf', 'werty', 'ert', 'ert', 'asdf', 'asdf', 'sdf', 'sdf', 'sdfv', 'qwe', 'qw', 'qw', 'q', 'q', '2023-12-18', 'q', '', '', '', '', '', 'sdf', 'qw', '2023-12-18', 'sdfg', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sdf', 'sdf', 'sdf', '1', 1, '2023-11-17 09:54:31', '2023-11-17 09:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `address` text NOT NULL,
  `phone` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` text NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1=active , 0= inactive',
  `added_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `name`, `address`, `phone`, `email`, `website`, `status`, `added_by`, `created`, `updated`) VALUES
(5, 'M/s Plaza Road Lines', 'State Highway SA Sakhan Sonebhdra, UP - 231205', '05412-353193', 'fevus@mailinator.com', 'https://covermerepairs.com/', '1', 1, '2023-12-22 11:18:12', '2023-12-22 11:18:12'),
(6, 'Ignatius Romero', 'Magnam recusandae C', '+1 (433) 657-2563', 'zipufarora@mailinator.com', 'https://covermerepairs.com/', '1', 1, '2025-02-10 08:42:09', '2025-02-10 08:42:09'),
(7, 'Ashburton HQ', 'asdasdas', 'asdasdasd', 'fxctx@bhuvbu.com', 'sdasdasd', '1', 1, '2025-02-16 08:14:57', '2025-02-16 08:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `added_by`, `created_at`) VALUES
(1, 'Microphone', 1, '2025-02-09 19:56:04'),
(2, 'OPPO', 1, '2025-02-09 20:15:33'),
(5, 'Samsung', 1, '2025-02-09 20:42:03'),
(6, 'Vivo', 20, '2025-02-10 07:15:01'),
(7, 'testing', 20, '2025-02-18 02:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `challan`
--

CREATE TABLE `challan` (
  `id` int(11) NOT NULL,
  `branch` text NOT NULL,
  `PSN` text NOT NULL,
  `challan_no` text NOT NULL,
  `loading_station` text NOT NULL,
  `distance` text NOT NULL,
  `truck_no` text NOT NULL,
  `delivery_station` text NOT NULL,
  `transit_days` text NOT NULL,
  `vehicle_no` text NOT NULL,
  `vehicle_type` text NOT NULL,
  `cn_no_r1` text NOT NULL,
  `cn_date_r1` date NOT NULL,
  `cn_destination_r1` text NOT NULL,
  `nature_of_goods_r1` text NOT NULL,
  `value_of_goods_r1` text NOT NULL,
  `no_of_pkgs_r1` text NOT NULL,
  `desp_weight_r1` text NOT NULL,
  `exp_del_date_r1` date NOT NULL,
  `cn_no_r2` text NOT NULL,
  `cn_date_r2` date NOT NULL,
  `cn_destination_r2` text NOT NULL,
  `nature_of_goods_r2` text NOT NULL,
  `value_of_goods_r2` text NOT NULL,
  `no_of_pkgs_r2` int(11) NOT NULL,
  `desp_weight_r2` text NOT NULL,
  `exp_del_date_r2` date NOT NULL,
  `lorry_hire` text NOT NULL,
  `loading_labour` text NOT NULL,
  `loading_deten` text NOT NULL,
  `other` text NOT NULL,
  `tds_amount` text NOT NULL,
  `total` text NOT NULL,
  `advance` text NOT NULL,
  `balance` text NOT NULL,
  `charge_Wt` text NOT NULL,
  `total_amount_after_tds` text NOT NULL,
  `late_delivery_penality` text NOT NULL,
  `late_receiving_submission_penality` text NOT NULL,
  `delivery_incharge_contact_no` text NOT NULL,
  `balance_at_branch_phone` text NOT NULL,
  `truck_supplier_details` text NOT NULL,
  `current_lorry_owner_details` text NOT NULL,
  `loading_supervisor_details` text NOT NULL,
  `emp_code` text NOT NULL,
  `lorry_driver_details_name` text NOT NULL,
  `lorry_driver_details_license_no` text NOT NULL,
  `lorry_driver_details_mobile_no` text NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1=active , 0= inactive',
  `added_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `challan`
--

INSERT INTO `challan` (`id`, `branch`, `PSN`, `challan_no`, `loading_station`, `distance`, `truck_no`, `delivery_station`, `transit_days`, `vehicle_no`, `vehicle_type`, `cn_no_r1`, `cn_date_r1`, `cn_destination_r1`, `nature_of_goods_r1`, `value_of_goods_r1`, `no_of_pkgs_r1`, `desp_weight_r1`, `exp_del_date_r1`, `cn_no_r2`, `cn_date_r2`, `cn_destination_r2`, `nature_of_goods_r2`, `value_of_goods_r2`, `no_of_pkgs_r2`, `desp_weight_r2`, `exp_del_date_r2`, `lorry_hire`, `loading_labour`, `loading_deten`, `other`, `tds_amount`, `total`, `advance`, `balance`, `charge_Wt`, `total_amount_after_tds`, `late_delivery_penality`, `late_receiving_submission_penality`, `delivery_incharge_contact_no`, `balance_at_branch_phone`, `truck_supplier_details`, `current_lorry_owner_details`, `loading_supervisor_details`, `emp_code`, `lorry_driver_details_name`, `lorry_driver_details_license_no`, `lorry_driver_details_mobile_no`, `status`, `added_by`, `created`, `updated`) VALUES
(6, '5', '21334243', '23434', 'Pune', '1200', '1289090', 'Delhi', '12', '7y99809', '12 XL', '12', '2023-12-22', '12', '23', '32', '32', '233', '2023-12-28', '23', '2023-12-22', '12', '12', '21', 21, '12', '2023-12-28', '12', '12', '12', '122', '122', '12', '1221', '122', '122', '12', '332', '2324', '2442', '2424', '2424', '424', '24', '24', 'Amjad', '81768', '9540052228', '1', 1, '2023-12-22 13:24:19', '2023-12-22 13:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `couriereStatus`
--

CREATE TABLE `couriereStatus` (
  `id` int(11) NOT NULL,
  `job` int(11) NOT NULL,
  `issue_list` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `couriereStatus`
--

INSERT INTO `couriereStatus` (`id`, `job`, `issue_list`, `added_by`, `created_at`) VALUES
(1, 3, 'sdfv', 1, '2025-02-19 15:17:11'),
(2, 3, 'sdfv', 1, '2025-02-19 15:18:58'),
(3, 3, 'sdfv', 1, '2025-02-19 15:21:30'),
(4, 3, 'sdc', 1, '2025-02-19 15:23:00'),
(5, 3, 'sc', 1, '2025-02-19 15:23:39'),
(6, 4, 'Testing', 1, '2025-02-19 15:24:41'),
(7, 4, 'sdfsdfg', 1, '2025-02-19 15:25:40'),
(8, 3, 'sdfv', 1, '2025-02-19 15:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `id` int(11) NOT NULL,
  `job` int(11) NOT NULL,
  `issue_list` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`id`, `job`, `issue_list`, `added_by`, `created_at`) VALUES
(4, 8, 'asdfgb', 1, '2025-02-15 01:47:36'),
(5, 7, 'asdf', 1, '2025-02-15 01:47:50'),
(6, 7, 'rthy', 1, '2025-02-15 01:47:59'),
(7, 8, 'sfdgvc cdgtrfb vcgrgbv frgfvc dfrgrfcv fgrhbv ctgfc  dgrf', 1, '2025-02-15 02:18:24'),
(8, 8, 'dfgh', 1, '2025-02-15 02:20:26'),
(9, 8, 'hhhffd', 1, '2025-02-15 02:20:35'),
(10, 8, 'yyy', 1, '2025-02-15 02:28:41'),
(11, 8, 'hhh', 1, '2025-02-15 02:30:46'),
(12, 8, 'gggg', 1, '2025-02-15 02:32:38'),
(13, 8, 'Rafael King', 1, '2025-02-15 03:33:28'),
(14, 8, 'xcv', 1, '2025-02-15 06:07:24'),
(15, 5, 'sdfghn', 20, '2025-02-19 10:17:13'),
(16, 11, 'sdefghn', 20, '2025-02-19 10:17:24'),
(17, 11, 'sdfgb', 20, '2025-02-19 10:17:33'),
(18, 7, 'sdfv', 16, '2025-02-19 10:57:58'),
(19, 7, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 16, '2025-02-19 10:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `branch` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `model_no` varchar(100) NOT NULL,
  `issue` text NOT NULL,
  `added_by` varchar(100) NOT NULL,
  `assigned_to` varchar(100) NOT NULL,
  `date_from` date NOT NULL DEFAULT current_timestamp(),
  `date_to` date NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Pending Repairs','Done Repairs','In Progress','Approvid','Wait','QC','Ready','Picked','Couriered') DEFAULT NULL COMMENT '''Pending Repairs'',''Done Repairs'',''In Progress'',''Approvid'',''Wait'',''QC'',''Ready'',''Picked'',''Couriered''',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `customer_name`, `email`, `mobile`, `branch`, `brand`, `model_no`, `issue`, `added_by`, `assigned_to`, `date_from`, `date_to`, `status`, `created_at`, `updated_at`) VALUES
(3, 'weq qw', 'kybihabasy@mailinator.com', '02425342424', 15, 1, '2', 'dfgh', '1', '6', '2025-02-10', '2025-02-10', 'Picked', '2025-02-10 11:12:10', '2025-02-24 10:12:47'),
(4, 'Umakant Yadav', 'fevus@mailinator.com', '09453619260', 15, 2, '3', 'dfgh', '1', '6', '2025-02-10', '2025-02-28', 'Couriered', '2025-02-10 11:13:30', '2025-02-19 15:59:55'),
(5, 'Naida Parks', 'bitygysu@mailinator.com', 'Eius nostrum volupta', 15, 2, '3', 'Qui tempora cillum q', '1', '22', '2014-09-12', '2018-03-30', 'Ready', '2025-02-13 13:17:39', '2025-02-24 10:09:53'),
(7, 'Declan Petersen', 'wihino@mailinator.com', 'Aut ullamco neque se', 11, 1, '4', 'Quam molestiae volup', '1', '17', '2008-04-08', '2014-03-25', 'QC', '2025-02-14 07:03:38', '2025-02-20 05:11:17'),
(8, 'Umakant Yadav', 'umakant171991@gmail.com', '09453619260', 20, 1, '2', 'Ad est Nam distincti', '1', '7', '2025-02-14', '2025-02-15', 'Wait', '2025-02-14 07:23:33', '2025-02-24 10:07:11'),
(11, 'Xander Booker', 'fevus@mailinator.com', 'Dolor sunt qui illo ', 24, 1, '2', 'Ad iusto velit ipsu', '1', '7', '1988-01-11', '1996-10-28', 'In Progress', '2025-02-15 06:59:17', '2025-02-24 10:05:08');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `name`, `brand_id`, `added_by`, `created_at`) VALUES
(2, 'M M 1', 1, 1, '2025-02-09 19:56:53'),
(3, 'O M1', 2, 1, '2025-02-09 20:52:33'),
(4, 'Modal 1', 1, 1, '2025-02-09 20:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `id` int(11) NOT NULL,
  `branch` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `model` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `price_min` decimal(10,2) DEFAULT 0.00,
  `price_max` decimal(10,2) DEFAULT 0.00,
  `stock` int(11) DEFAULT 0,
  `added_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`id`, `branch`, `brand`, `model`, `type`, `price_min`, `price_max`, `stock`, `added_by`, `created_at`) VALUES
(1, 5, 1, 2, 3, 400.00, 600.00, 99, 1, '2025-02-10 07:31:08'),
(2, 6, 2, 3, 2, 436.00, 573.00, 6, 1, '2025-02-10 07:44:54');

-- --------------------------------------------------------

--
-- Table structure for table `part_type`
--

CREATE TABLE `part_type` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1=active , 0= inactive',
  `added_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `part_type`
--

INSERT INTO `part_type` (`id`, `name`, `status`, `added_by`, `created`, `updated`) VALUES
(2, 'Intergrated chip', '1', 1, '2023-11-02 05:33:20', '2023-11-02 05:33:20'),
(3, 'Speaker', '1', 1, '2023-11-02 05:34:02', '2023-11-02 05:34:02'),
(4, 'Microphone', '1', 1, '2023-11-07 00:04:19', '2023-11-07 00:04:19'),
(6, 'Battery', '1', 1, '2023-11-17 09:54:31', '2023-11-17 09:54:31'),
(7, 'Camera', '1', 1, '2025-02-09 20:57:30', '2025-02-09 20:57:30');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `branch` text NOT NULL,
  `PSN` text NOT NULL,
  `challan_no` text NOT NULL,
  `loading_station` text NOT NULL,
  `distance` text NOT NULL,
  `truck_no` text NOT NULL,
  `delivery_station` text NOT NULL,
  `transit_days` text NOT NULL,
  `vehicle_no` text NOT NULL,
  `vehicle_type` text NOT NULL,
  `cn_no_r1` text NOT NULL,
  `cn_date_r1` date NOT NULL,
  `cn_destination_r1` text NOT NULL,
  `nature_of_goods_r1` text NOT NULL,
  `value_of_goods_r1` text NOT NULL,
  `no_of_pkgs_r1` text NOT NULL,
  `desp_weight_r1` text NOT NULL,
  `exp_del_date_r1` date NOT NULL,
  `cn_no_r2` text NOT NULL,
  `cn_date_r2` date NOT NULL,
  `cn_destination_r2` text NOT NULL,
  `nature_of_goods_r2` text NOT NULL,
  `value_of_goods_r2` text NOT NULL,
  `no_of_pkgs_r2` int(11) NOT NULL,
  `desp_weight_r2` text NOT NULL,
  `exp_del_date_r2` date NOT NULL,
  `lorry_hire` text NOT NULL,
  `loading_labour` text NOT NULL,
  `loading_deten` text NOT NULL,
  `other` text NOT NULL,
  `tds_amount` text NOT NULL,
  `total` text NOT NULL,
  `advance` text NOT NULL,
  `balance` text NOT NULL,
  `charge_Wt` text NOT NULL,
  `total_amount_after_tds` text NOT NULL,
  `late_delivery_penality` text NOT NULL,
  `late_receiving_submission_penality` text NOT NULL,
  `delivery_incharge_contact_no` text NOT NULL,
  `balance_at_branch_phone` text NOT NULL,
  `truck_supplier_details` text NOT NULL,
  `current_lorry_owner_details` text NOT NULL,
  `loading_supervisor_details` text NOT NULL,
  `emp_code` text NOT NULL,
  `lorry_driver_details_name` text NOT NULL,
  `lorry_driver_details_license_no` text NOT NULL,
  `lorry_driver_details_mobile_no` text NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1=active , 0= inactive',
  `added_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `branch`, `PSN`, `challan_no`, `loading_station`, `distance`, `truck_no`, `delivery_station`, `transit_days`, `vehicle_no`, `vehicle_type`, `cn_no_r1`, `cn_date_r1`, `cn_destination_r1`, `nature_of_goods_r1`, `value_of_goods_r1`, `no_of_pkgs_r1`, `desp_weight_r1`, `exp_del_date_r1`, `cn_no_r2`, `cn_date_r2`, `cn_destination_r2`, `nature_of_goods_r2`, `value_of_goods_r2`, `no_of_pkgs_r2`, `desp_weight_r2`, `exp_del_date_r2`, `lorry_hire`, `loading_labour`, `loading_deten`, `other`, `tds_amount`, `total`, `advance`, `balance`, `charge_Wt`, `total_amount_after_tds`, `late_delivery_penality`, `late_receiving_submission_penality`, `delivery_incharge_contact_no`, `balance_at_branch_phone`, `truck_supplier_details`, `current_lorry_owner_details`, `loading_supervisor_details`, `emp_code`, `lorry_driver_details_name`, `lorry_driver_details_license_no`, `lorry_driver_details_mobile_no`, `status`, `added_by`, `created`, `updated`) VALUES
(6, '5', '21334243', '23434', 'Pune', '1200', '1289090', 'Delhi', '12', '7y99809', '12 XL', '12', '2023-12-22', '12', '23', '32', '32', '233', '2023-12-28', '23', '2023-12-22', '12', '12', '21', 21, '12', '2023-12-28', '12', '12', '12', '122', '122', '12', '1221', '122', '122', '12', '332', '2324', '2442', '2424', '2424', '424', '24', '24', 'Amjad', '81768', '9540052228', '1', 1, '2023-12-22 13:24:19', '2023-12-22 13:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `slug` text NOT NULL,
  `permission_option` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `name`, `slug`, `permission_option`, `added_by`, `status`, `created`, `update`) VALUES
(2, 'Branch', 'branch', 0, 1, '1', '2023-11-07 00:35:53', '2023-11-07 00:35:53'),
(8, 'Part', 'part', 0, 1, '1', '2024-01-09 00:03:49', '2024-01-09 00:03:49'),
(10, 'Modal', 'model', 0, 1, '1', '2025-02-08 03:02:29', '2025-02-08 03:02:29'),
(11, 'Brand', 'brand', 0, 1, '1', '2025-02-08 03:02:44', '2025-02-08 03:02:44'),
(13, 'Part type', 'part_type', 0, 1, '1', '2025-02-09 20:55:10', '2025-02-09 20:55:10'),
(14, 'Job', 'job', 0, 1, '1', '2025-02-10 10:25:22', '2025-02-10 10:25:22'),
(15, 'Staff', 'staff', 0, 1, '1', '2025-02-12 05:03:01', '2025-02-12 05:03:01'),
(16, 'Technicians', 'technicians', 0, 1, '1', '2025-02-12 05:03:46', '2025-02-12 05:03:46'),
(17, 'Part corntroller', 'part_corntroller', 0, 1, '1', '2025-02-12 05:05:35', '2025-02-12 05:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` int(11) NOT NULL,
  `model` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `quantity` int(11) DEFAULT 0,
  `price` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `dob` date NOT NULL,
  `address` text DEFAULT NULL,
  `web_address` varchar(500) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `pass_show` text NOT NULL,
  `img` text DEFAULT NULL,
  `type` int(11) NOT NULL COMMENT '1=> admin,2=>staff,3=>technicians,4=>Branch	,5=> Part corntroller',
  `added_by` int(11) DEFAULT NULL,
  `permission` text DEFAULT NULL,
  `branch` text DEFAULT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1 => active , 0 => Inactie',
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `phone`, `email`, `dob`, `address`, `web_address`, `password`, `pass_show`, `img`, `type`, `added_by`, `permission`, `branch`, `status`, `created`, `updated`) VALUES
(1, 'admin', 'Umakant', '09540052228', 'md.amjad38@gmail.com', '1989-09-18', 'Y - 837 Mangol Puri', NULL, '9580ab5d9db022c73d6678b07c86c9db', '', NULL, 1, 1, 'part_corntroller--technicians--staff--job--part_type--brand--model--part--user_type--users--branch', NULL, '1', '2023-12-22 11:19:12', '2023-12-22 11:19:12'),
(6, 'tech', 'Sandeep Shukla', '9370261391', 'sandeep.shukla@gglff.com', '1980-01-07', 'Indore and Nagpur', NULL, '9580ab5d9db022c73d6678b07c86c9db', '', NULL, 3, 1, 'part_corntroller--technicians--staff--job--part_type--brand--part', '15', '1', '2024-01-04 11:05:04', '2024-01-04 11:05:04'),
(7, 'socuras', 'Nichole Winters', '+1 (852) 648-7135', 'puhyhyt@mailinator.com', '2025-11-14', 'Eum culpa itaque do', NULL, '9580ab5d9db022c73d6678b07c86c9db', '', NULL, 3, 1, 'part_corntroller--technicians--staff--job--part_type--brand--modal--part--billty--users', NULL, '1', '2025-02-12 06:04:04', '2025-02-12 06:04:04'),
(8, 'xodasevady', 'Leonard Pierce', '+1 (329) 302-1662', 'zipufarora@mailinator.com', '2025-11-11', 'Nesciunt adipisci q', NULL, '9580ab5d9db022c73d6678b07c86c9db', '', NULL, 2, 1, 'part_corntroller--technicians--job', '15', '1', '2025-02-12 06:10:11', '2025-02-12 06:10:11'),
(10, 'seqazu', 'Elaine Smith', '+1 (864) 153-6887', 'pijuruqit@mailinator.com', '1989-07-12', 'Similique quasi volu', NULL, 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '', NULL, 1, 1, 'technicians--staff--part_type--brand--model--user_type', NULL, '1', '2025-02-15 07:51:17', '2025-02-15 07:51:17'),
(11, 'pojegy', 'Macey Adkins', '+1 (757) 347-4774', 'vakopupa@mailinator.com', '2009-12-03', 'Illum non blanditii', NULL, 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '', NULL, 4, 1, 'part_corntroller--technicians--staff--job--part_type--brand--modal--part', NULL, '1', '2025-02-15 07:51:52', '2025-02-15 07:51:52'),
(12, 'admin1', 'Ashburton HQ', '206512', 'asdasdasd@yasjkosjda.com', '2025-02-15', 'asdasdasd', NULL, '827ccb0eea8a706c4c34a16891f84e7b', '', NULL, 2, 1, 'part_corntroller--job--brand--part', NULL, '1', '2025-02-16 08:27:41', '2025-02-16 08:27:41'),
(13, 'dupah', 'Mollie Cook', '+1 (935) 207-9407', 'ruqiheqyvi@mailinator.com', '2019-08-08', 'Voluptate eiusmod re', NULL, 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '', NULL, 2, 1, 'technicians--part--user_type--users', NULL, '1', '2025-02-17 03:26:30', '2025-02-17 03:26:30'),
(14, 'pubil', 'Madeline Lloyd', '+1 (465) 452-6993', 'tuxelyby@mailinator.com', '2004-04-14', 'Odit omnis quis eum ', NULL, '9580ab5d9db022c73d6678b07c86c9db', '', NULL, 5, 1, 'part_corntroller--job--model--users--branch', '20', '1', '2025-02-17 03:26:50', '2025-02-17 03:26:50'),
(15, 'cecapineny', 'Lyle Sutton', '+1 (569) 762-7426', 'quzaj@mailinator.com', '1981-08-14', 'Nulla cupiditate eum', NULL, '9580ab5d9db022c73d6678b07c86c9db', '', NULL, 4, 1, 'part_corntroller--technicians--staff--job--part_type--model--user_type--users', NULL, '1', '2025-02-17 11:05:22', '2025-02-17 11:05:22'),
(16, 'staff', 'Jamalia Lowery', '+1 (463) 738-9215', 'hunisuju@mailinator.com', '2008-03-20', 'Molestiae consequatu', NULL, '9580ab5d9db022c73d6678b07c86c9db', '', NULL, 2, 20, 'part_corntroller--technicians--staff--job--part_type--brand--model--part--branch', '20', '1', '2025-02-17 23:15:01', '2025-02-17 23:15:01'),
(17, 'buzuxej', 'Abel Gallagher', '+1 (482) 823-7795', 'lehug@mailinator.com', '2025-12-27', 'Aut aut nostrud qui ', NULL, 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '', NULL, 3, 1, 'part_corntroller--staff--user_type', '20', '1', '2025-02-17 23:16:57', '2025-02-17 23:16:57'),
(18, 'capyku', 'Winter Pittman', '+1 (513) 998-8991', 'liqicev@mailinator.com', '1987-08-21', 'Est recusandae Rep', NULL, 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '', NULL, 5, 1, 'job--brand--users', '15', '1', '2025-02-17 23:18:29', '2025-02-17 23:18:29'),
(19, 'xorutucej', 'Hunter Avila', '+1 (438) 233-6293', 'disejywu@mailinator.com', '1998-12-27', 'Voluptas unde nostru', NULL, 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '', NULL, 5, 1, 'staff--part_type--user_type--branch', '11', '1', '2025-02-17 23:18:39', '2025-02-17 23:18:39'),
(20, 'branch', 'Colleen Gay', '+1 (997) 751-1107', 'kybihabasy@mailinator.com', '1992-09-09', 'Sunt harum ut sint ', NULL, '9580ab5d9db022c73d6678b07c86c9db', '', NULL, 4, 1, 'part_corntroller--technicians--staff--job--part_type--brand--model--part--branch', NULL, '1', '2025-02-17 23:19:05', '2025-02-17 23:19:05'),
(22, 'gujiqeha', 'Andrew Woodard', '+1 (157) 745-7952', 'dutepe@mailinator.com', '2025-04-23', 'Aut aut anim ut aute', NULL, '9580ab5d9db022c73d6678b07c86c9db', '', NULL, 3, 1, 'part_corntroller--staff--job--model--branch', '20', '1', '2025-02-18 03:02:38', '2025-02-18 03:02:38'),
(23, 'qipyvesaf', 'Lillith Richmond', '+1 (874) 883-9622', 'jobehi@mailinator.com', '1989-08-21', 'Expedita inventore i', NULL, 'f3ed11bbdb94fd9ebdefbaf646ab94d3', '', NULL, 5, 20, 'part_corntroller--brand--model--part--user_type--users--branch', '20', '1', '2025-02-18 03:34:27', '2025-02-18 03:34:27'),
(24, 'gyqopavi', 'Wyoming Parrish', '+1 (121) 791-3654', 'waqy@mailinator.com', '1979-10-25', 'Ut ea enim officia v', NULL, '9580ab5d9db022c73d6678b07c86c9db', '', NULL, 4, 1, 'part_corntroller--technicians--staff--job--part_type--brand--model--part--branch', NULL, '1', '2025-02-18 09:45:05', '2025-02-18 09:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '1=active , 0= inactive',
  `added_by` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`, `status`, `added_by`, `created`, `updated`) VALUES
(1, 'Admin', '1', 1, '2023-11-02 05:32:26', '2023-11-02 05:32:26'),
(2, 'Staff', '1', 1, '2023-11-02 05:33:20', '2023-11-02 05:33:20'),
(3, 'Technician', '1', 1, '2023-11-02 05:34:02', '2023-11-02 05:34:02'),
(4, 'Branch', '1', 1, '2023-11-07 00:04:19', '2023-11-07 00:04:19'),
(5, 'Part corntroller', '1', 1, '2023-11-17 09:54:31', '2023-11-17 09:54:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auditor`
--
ALTER TABLE `auditor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billty`
--
ALTER TABLE `billty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challan`
--
ALTER TABLE `challan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `couriereStatus`
--
ALTER TABLE `couriereStatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `part_type`
--
ALTER TABLE `part_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand` (`brand`),
  ADD KEY `model` (`model`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auditor`
--
ALTER TABLE `auditor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `billty`
--
ALTER TABLE `billty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `challan`
--
ALTER TABLE `challan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `couriereStatus`
--
ALTER TABLE `couriereStatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `part_type`
--
ALTER TABLE `part_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model`
--
ALTER TABLE `model`
  ADD CONSTRAINT `model_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`brand`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`model`) REFERENCES `model` (`id`),
  ADD CONSTRAINT `stock_ibfk_3` FOREIGN KEY (`type`) REFERENCES `part_type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
