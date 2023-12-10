-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2021 at 12:45 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_southlane`
--
CREATE DATABASE IF NOT EXISTS `app_southlane` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `app_southlane`;

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `appointment_id_unique` varchar(15) NOT NULL,
  `appointment_date` varchar(30) NOT NULL DEFAULT current_timestamp(),
  `mr_number` varchar(15) NOT NULL,
  `patient_name` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `owner_name` varchar(30) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `appointment_created_date` varchar(30) NOT NULL,
  `print_receipt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `appointment_id_unique`, `appointment_date`, `mr_number`, `patient_name`, `contact`, `owner_name`, `user_name`, `appointment_created_date`, `print_receipt`) VALUES
(1, 'INV 1000', '2021-12-15', '1001', 'Test', '123', 'Farheen Malik', 'Administrator', '2021-12-12 18:59:47', '');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `bill_id` int(11) NOT NULL,
  `bill_id_unique` text NOT NULL,
  `mr_number` varchar(15) NOT NULL,
  `owner_name` varchar(20) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `doctor` varchar(20) DEFAULT NULL,
  `bill_date` varchar(20) NOT NULL,
  `procedures_with_amount` text DEFAULT NULL,
  `extra_charges` varchar(10) DEFAULT NULL,
  `discount` varchar(10) DEFAULT NULL,
  `total_amount` varchar(10) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `contact` varchar(20) NOT NULL,
  `patient_name` varchar(20) NOT NULL,
  `print_receipt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`bill_id`, `bill_id_unique`, `mr_number`, `owner_name`, `user_name`, `doctor`, `bill_date`, `procedures_with_amount`, `extra_charges`, `discount`, `total_amount`, `deleted`, `contact`, `patient_name`, `print_receipt`) VALUES
(18, '1012', '', 'Tooba', 'Administrator', '', '2021-12-10 17:18:46', 'Consultation: 500<br/>Treatment: 1000<br/>', '1500', '0', '1500', 0, '03022779090', 'Bugi', ''),
(19, '1013', '', 'Tooba', 'Administrator', '', '2021-12-10 17:21:15', 'Boarding: 10000<br/>', '10000', '0', '10000', 0, '03022779090', 'Bugi', ''),
(20, '1014', '', 'Mrs Hameed', 'Administrator', '', '2021-12-10 17:56:11', 'Treatment: 1000<br/>', '1000', '0', '1000', 0, '03333053844', 'Trixie', ''),
(21, '1015', '', 'Mrs Hameed', 'Administrator', '', '2021-12-10 17:58:40', 'Deworming: 500<br/>Partial Grooming: 500<br/>Flea Treatment: 1500<br/>', '2500', '0', '2500', 0, '03333053844', 'Coco', ''),
(23, '1017', '', 'Mrs Fareeha Amir', 'Administrator', '', '2021-12-10 17:39:29', 'Neutering Surgery: 10000<br/>Discount: -2000<br/>', '10000', '-2000', '8000', 0, '03132191964', 'Pensey', ''),
(24, '1018', '', 'Mrs Fareeha Amir', 'Administrator', '', '2021-12-10 17:41:23', 'Neutering Surgery: 10000<br/>Discount: -2000<br/>', '10000', '-2000', '8000', 0, '03132191964', 'Mufasa', ''),
(25, '1019', '', 'Noor Yasmin', 'Administrator', '', '2021-12-10 17:48:09', 'Consultation: 500<br/>Treatment: 500<br/>', '1000', '0', '1000', 0, '03099948758', 'Maxie', ''),
(26, '1020', '', 'Noor Yasmin', 'Administrator', '', '2021-12-10 17:49:10', 'Consultation: 500<br/>Treatment: 500<br/>', '1000', '0', '1000', 0, '03099948758', 'Lizzie', ''),
(27, '1021', '', 'Mrs Fareeha Amir', 'Administrator', '', '2021-12-10 17:24:01', 'Treatment: 1000<br/>', '1000', '0', '1000', 0, '03132191964', 'Pensey', ''),
(28, '1022', '', 'Mrs Fareeha Amir', 'Administrator', '', '2021-12-10 17:25:09', 'Treatment: 1000<br/>', '1000', '0', '1000', 0, '03132191964', 'Mufasa', ''),
(29, '1023', '', 'Noor Yasmin', 'Administrator', '', '2021-12-10 17:59:25', 'Treatment: 1000<br/>', '1000', '0', '1000', 0, '03099948758', 'Lizzie', ''),
(30, '1024', '', 'Noor Yasmin', 'Administrator', '', '2021-12-10 18:00:29', 'Treatment: 500<br/>', '500', '0', '500', 0, '03099948758', 'Maxie', ''),
(33, 'INV 1027', '1007', 'Mrs Fareeha Amir', 'Administrator', '', '2021-12-12 19:48:43', 'Consultation: 500<br/>', '500', '0', '500', 0, '03132191964', 'Pensey', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1027</td></tr><tr><td>Invoice Date</td><td>: 2021-12-15 18:07:52</td></tr><tr><td>M.R#</td><td>: PT 1009</td></tr><tr><td>Owner Name</td><td>: Zehra</td></tr><tr><td>Patient Name</td><td>: Golu</td></tr><tr><td>Contact</td><td>: 03003577396</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Consultation</td><td>500</td><td>1</td><td>: 500<td/></tr><tr><td>Treatment</td><td>1000</td><td>1</td><td>: 1000<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 1500<td/></tr><tr><td>Discount</td><td>: 0<td/></tr><tr><td>Grand Total</td><td>: 1500<td/></tr><tr><td>Amount Received</td><td>: 1500<td/></tr><tr><td>Amount To be Paid</td><td>: 0<td/></tr></table>'),
(34, 'INV 1028', '1007', 'Mrs Fareeha Amir', 'Administrator', '', '2021-12-12 19:49:47', 'Consultation: 500<br/>', '500', '0', '500', 0, '03132191964', 'Mufasa', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1028</td></tr><tr><td>Invoice Date</td><td>: 2021-12-15 18:09:28</td></tr><tr><td>M.R#</td><td>: PT 1008</td></tr><tr><td>Owner Name</td><td>: Aryenish</td></tr><tr><td>Patient Name</td><td>: Maple</td></tr><tr><td>Contact</td><td>: 03008267262</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Treatment</td><td>2000</td><td>1</td><td>: 2000<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 2000<td/></tr><tr><td>Grand Total</td><td>: 2000<td/></tr><tr><td>Amount Received</td><td>: 2000<td/></tr><tr><td>Amount To be Paid</td><td>: 0<td/></tr></table>'),
(35, 'INV 1029', 'PT 1010', 'Nosheen', 'Administrator', '', '2021-12-12 20:08:37', 'Deworming: 500<br/>', '500', '0', '500', 0, '03008260940', 'Blu', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1029</td></tr><tr><td>Invoice Date</td><td>: 2021-12-15 18:24:27</td></tr><tr><td>M.R#</td><td>: PT 1010</td></tr><tr><td>Owner Name</td><td>: Noor Yasmin</td></tr><tr><td>Patient Name</td><td>: lizzie</td></tr><tr><td>Contact</td><td>: 03099948758</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Consultation</td><td>500</td><td>1</td><td>: 500<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 500<td/></tr><tr><td>Grand Total</td><td>: 500<td/></tr><tr><td>Amount Received</td><td>: 500<td/></tr><tr><td>Amount To be Paid</td><td>: 0<td/></tr></table>'),
(36, 'INV 1030', 'PT 1010', 'Nosheen', 'Administrator', '', '2021-12-12 20:09:22', 'Consultation: 500<br/>Deworming: 500<br/>', '1000', '0', '1000', 0, '03008260940', 'Dory', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1030</td></tr><tr><td>Invoice Date</td><td>: 2021-12-15 18:41:42</td></tr><tr><td>M.R#</td><td>: PT 1011</td></tr><tr><td>Owner Name</td><td>: Mahim</td></tr><tr><td>Patient Name</td><td>: Poppy</td></tr><tr><td>Contact</td><td>: 03343144926</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Consultation</td><td>500</td><td>1</td><td>: 500<td/></tr><tr><td>Treatment</td><td>500</td><td>1</td><td>: 500<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 1000<td/></tr><tr><td>Grand Total</td><td>: 1000<td/></tr><tr><td>Amount Received</td><td>: 0<td/></tr><tr><td>Amount To be Paid</td><td>: 1000<td/></tr></table>'),
(37, 'INV 1031', '1008', 'Noor Yasmin', 'Administrator', '', '2021-12-12 19:47:26', 'Treatment: 500<br/>Deworming: 500<br/>', '1000', '0', '1000', 0, '03099948758', 'Maxie', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1031</td></tr><tr><td>Invoice Date</td><td>: 2021-12-15 18:43:31</td></tr><tr><td>M.R#</td><td>: PT 1012</td></tr><tr><td>Owner Name</td><td>: Sanam</td></tr><tr><td>Patient Name</td><td>: Pearl</td></tr><tr><td>Contact</td><td>: 03333085185</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Consultation</td><td>500</td><td>1</td><td>: 500<td/></tr><tr><td>Treatment</td><td>1000</td><td>1</td><td>: 1000<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 1500<td/></tr><tr><td>Grand Total</td><td>: 1500<td/></tr><tr><td>Amount Received</td><td>: 0<td/></tr><tr><td>Amount To be Paid</td><td>: 1500<td/></tr></table>'),
(38, 'INV 1032', '1008', 'Noor Yasmin', 'Administrator', '', '2021-12-12 19:48:41', 'Treatment: 500<br/>', '500', '0', '500', 0, '03099948758', 'Lizzie', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1032</td></tr><tr><td>Invoice Date</td><td>: 2021-12-15 18:28:59</td></tr><tr><td>M.R#</td><td>: PT 1005</td></tr><tr><td>Owner Name</td><td>: Mrs Mariyam Khan</td></tr><tr><td>Patient Name</td><td>: Roxie</td></tr><tr><td>Contact</td><td>: 03452530038</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Treatment</td><td>2000</td><td>1</td><td>: 2000<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 2000<td/></tr><tr><td>Grand Total</td><td>: 2000<td/></tr><tr><td>Amount Received</td><td>: 2000<td/></tr><tr><td>Amount To be Paid</td><td>: 0<td/></tr></table>'),
(39, 'INV 1018', '1007', 'Mrs Fareeha Amir', 'Administrator', '', '2021-12-13 14:41:32', 'Treatment: 500<br/>', '500', '0', '500', 0, '03132191964', 'Pensey', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1018</td></tr><tr><td>Invoice Date</td><td>: 2021-12-13 14:41:32</td></tr><tr><td>M.R#</td><td>: 1007</td></tr><tr><td>Owner Name</td><td>: Mrs Fareeha Amir</td></tr><tr><td>Patient Name</td><td>: Pensey</td></tr><tr><td>Contact</td><td>: 03132191964</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Treatment</td><td>500</td><td>1</td><td>: 500<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 500<td/></tr><tr><td>Discount</td><td>: 0<td/></tr><tr><td>Grand Total</td><td>: 500<td/></tr><tr><td>Amount Received</td><td>: 500<td/></tr><tr><td>Amount To be Paid</td><td>: 0<td/></tr></table>'),
(40, 'INV 1019', '1007', 'Mrs Fareeha Amir', 'Administrator', '', '2021-12-13 14:44:16', 'Treatment: 500<br/>', '500', '0', '500', 0, '03132191964', 'Mufasa', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1019</td></tr><tr><td>Invoice Date</td><td>: 2021-12-13 14:44:16</td></tr><tr><td>M.R#</td><td>: 1007</td></tr><tr><td>Owner Name</td><td>: Mrs Fareeha Amir</td></tr><tr><td>Patient Name</td><td>: Mufasa</td></tr><tr><td>Contact</td><td>: 03132191964</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Treatment</td><td>500</td><td>1</td><td>: 500<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 500<td/></tr><tr><td>Discount</td><td>: 0<td/></tr><tr><td>Grand Total</td><td>: 500<td/></tr><tr><td>Amount Received</td><td>: 500<td/></tr><tr><td>Amount To be Paid</td><td>: 0<td/></tr></table>'),
(41, 'INV 1020', '1007', 'Mrs Fareeha Amir', 'Administrator', '', '2021-12-13 14:47:00', 'Cat litter scoop: 700<br/>Wanpy Treat: 350<br/>', '1050', '0', '1050', 0, '03132191964', 'Pensey', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1020</td></tr><tr><td>Invoice Date</td><td>: 2021-12-13 14:47:00</td></tr><tr><td>M.R#</td><td>: 1007</td></tr><tr><td>Owner Name</td><td>: Mrs Fareeha Amir</td></tr><tr><td>Patient Name</td><td>: Pensey</td></tr><tr><td>Contact</td><td>: 03132191964</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Cat litter scoop</td><td>350</td><td>2</td><td>: 700<td/></tr><tr><td>Wanpy Treat</td><td>350</td><td>1</td><td>: 350<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 1050<td/></tr><tr><td>Discount</td><td>: 0<td/></tr><tr><td>Grand Total</td><td>: 1050<td/></tr><tr><td>Amount Received</td><td>: 0<td/></tr><tr><td>Amount To be Paid</td><td>: 0<td/></tr></table>'),
(42, 'INV 1021', 'PT 1005', 'Mrs Mariyam Khan', 'Administrator', '', '2021-12-13 15:03:43', 'Consultation: 500<br/>Treatment: 2000<br/>', '2500', '0', '2500', 0, '03452530038', 'Roxie', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1021</td></tr><tr><td>Invoice Date</td><td>: 2021-12-13 15:03:43</td></tr><tr><td>M.R#</td><td>: PT 1005</td></tr><tr><td>Owner Name</td><td>: Mrs Mariyam Khan</td></tr><tr><td>Patient Name</td><td>: Roxie</td></tr><tr><td>Contact</td><td>: 03452530038</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Consultation</td><td>500</td><td>1</td><td>: 500<td/></tr><tr><td>Treatment</td><td>2000</td><td>1</td><td>: 2000<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 2500<td/></tr><tr><td>Discount</td><td>: 0<td/></tr><tr><td>Grand Total</td><td>: 2500<td/></tr><tr><td>Amount Received</td><td>: 2500<td/></tr><tr><td>Amount To be Paid</td><td>: 0<td/></tr></table>'),
(43, 'INV 1022', 'PT 1006', 'Yousuf Magsi', 'Administrator', '', '2021-12-14 18:52:20', 'Consultation: 500<br/>Treatment: 500<br/>', '1000', '0', '1000', 0, '03332466000', 'Duke', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1022</td></tr><tr><td>Invoice Date</td><td>: 2021-12-14 18:52:20</td></tr><tr><td>M.R#</td><td>: PT 1006</td></tr><tr><td>Owner Name</td><td>: Yousuf Magsi</td></tr><tr><td>Patient Name</td><td>: Duke</td></tr><tr><td>Contact</td><td>: 03332466000</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Consultation</td><td>500</td><td>1</td><td>: 500<td/></tr><tr><td>Treatment</td><td>500</td><td>1</td><td>: 500<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 1000<td/></tr><tr><td>Discount</td><td>: 0<td/></tr><tr><td>Grand Total</td><td>: 1000<td/></tr><tr><td>Amount Received</td><td>: 1000<td/></tr><tr><td>Amount To be Paid</td><td>: 0<td/></tr></table>'),
(44, 'INV 1023', 'PT 1005', 'Mrs Mariyam Khan', 'Administrator', '', '2021-12-15 18:33:35', 'Treatment: 2000<br/>', '2000', '0', '2000', 0, '03452530038', 'Roxie', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1023</td></tr><tr><td>Invoice Date</td><td>: 2021-12-15 18:33:35</td></tr><tr><td>M.R#</td><td>: PT 1005</td></tr><tr><td>Owner Name</td><td>: Mrs Mariyam Khan</td></tr><tr><td>Patient Name</td><td>: Roxie</td></tr><tr><td>Contact</td><td>: 03452530038</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Treatment</td><td>2000</td><td>1</td><td>: 2000<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Grand Total</td><td>: 2000<td/></tr><tr><td>Amount Received</td><td>: 2000<td/></tr><tr><td>Amount To be Paid</td><td>: 0<td/></tr></table>'),
(45, 'INV 1024', 'PT 1007', 'Farheen Malick', 'Administrator', '', '2021-12-15 18:39:05', 'Boarding: 1500<br/>Treatment: 500<br/>', '2000', '0', '2000', 0, '03152097459', 'Kalu v2', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1024</td></tr><tr><td>Invoice Date</td><td>: 2021-12-15 18:39:05</td></tr><tr><td>M.R#</td><td>: PT 1007</td></tr><tr><td>Owner Name</td><td>: Farheen Malick</td></tr><tr><td>Patient Name</td><td>: Kalu v2</td></tr><tr><td>Contact</td><td>: 03152097459</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Boarding</td><td>500</td><td>3</td><td>: 1500<td/></tr><tr><td>Treatment</td><td>500</td><td>1</td><td>: 500<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 2000<td/></tr><tr><td>Grand Total</td><td>: 2000<td/></tr><tr><td>Amount Received</td><td>: 1000<td/></tr><tr><td>Amount To be Paid</td><td>: 1000<td/></tr></table>'),
(46, 'INV 1025', 'PT 1007', 'Farheen Malick', 'Administrator', '', '2021-12-15 18:43:00', 'Boarding: 1500<br/>Treatment: 500<br/>', '2000', '0', '2000', 0, '03152097459', 'Kutta', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1025</td></tr><tr><td>Invoice Date</td><td>: 2021-12-15 18:43:00</td></tr><tr><td>M.R#</td><td>: PT 1007</td></tr><tr><td>Owner Name</td><td>: Farheen Malick</td></tr><tr><td>Patient Name</td><td>: Kutta</td></tr><tr><td>Contact</td><td>: 03152097459</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Boarding</td><td>500</td><td>3</td><td>: 1500<td/></tr><tr><td>Treatment</td><td>500</td><td>1</td><td>: 500<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 2000<td/></tr><tr><td>Grand Total</td><td>: 2000<td/></tr><tr><td>Amount Received</td><td>: 0<td/></tr><tr><td>Amount To be Paid</td><td>: 2000<td/></tr></table>'),
(47, 'INV 1026', 'PT 1008', 'Aryenish', 'Administrator', '', '2021-12-15 18:16:11', 'Consultation: 500<br/>Treatment: 2000<br/>', '2500', '0', '2500', 0, '03008267262', 'Maple', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1026</td></tr><tr><td>Invoice Date</td><td>: 2021-12-15 18:16:11</td></tr><tr><td>M.R#</td><td>: PT 1008</td></tr><tr><td>Owner Name</td><td>: Aryenish</td></tr><tr><td>Patient Name</td><td>: Maple</td></tr><tr><td>Contact</td><td>: 03008267262</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Consultation</td><td>500</td><td>1</td><td>: 500<td/></tr><tr><td>Treatment</td><td>2000</td><td>1</td><td>: 2000<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 2500<td/></tr><tr><td>Grand Total</td><td>: 2500<td/></tr><tr><td>Amount Received</td><td>: 0<td/></tr><tr><td>Amount To be Paid</td><td>: 2500<td/></tr></table>'),
(48, 'INV 1027', 'PT 1009', 'Zehra', 'Administrator', '', '2021-12-15 18:07:52', 'Consultation: 500<br/>Treatment: 1000<br/>', '1500', '0', '1500', 0, '03003577396', 'Golu', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1027</td></tr><tr><td>Invoice Date</td><td>: 2021-12-15 18:07:52</td></tr><tr><td>M.R#</td><td>: PT 1009</td></tr><tr><td>Owner Name</td><td>: Zehra</td></tr><tr><td>Patient Name</td><td>: Golu</td></tr><tr><td>Contact</td><td>: 03003577396</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Consultation</td><td>500</td><td>1</td><td>: 500<td/></tr><tr><td>Treatment</td><td>1000</td><td>1</td><td>: 1000<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 1500<td/></tr><tr><td>Discount</td><td>: 0<td/></tr><tr><td>Grand Total</td><td>: 1500<td/></tr><tr><td>Amount Received</td><td>: 1500<td/></tr><tr><td>Amount To be Paid</td><td>: 0<td/></tr></table>'),
(49, 'INV 1028', 'PT 1008', 'Aryenish', 'Administrator', '', '2021-12-15 18:09:28', 'Treatment: 2000<br/>', '2000', '0', '2000', 0, '03008267262', 'Maple', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1028</td></tr><tr><td>Invoice Date</td><td>: 2021-12-15 18:09:28</td></tr><tr><td>M.R#</td><td>: PT 1008</td></tr><tr><td>Owner Name</td><td>: Aryenish</td></tr><tr><td>Patient Name</td><td>: Maple</td></tr><tr><td>Contact</td><td>: 03008267262</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Treatment</td><td>2000</td><td>1</td><td>: 2000<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 2000<td/></tr><tr><td>Grand Total</td><td>: 2000<td/></tr><tr><td>Amount Received</td><td>: 2000<td/></tr><tr><td>Amount To be Paid</td><td>: 0<td/></tr></table>'),
(50, 'INV 1029', 'PT 1010', 'Noor Yasmin', 'Administrator', '', '2021-12-15 18:24:27', 'Consultation: 500<br/>', '500', '0', '500', 0, '03099948758', 'lizzie', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1029</td></tr><tr><td>Invoice Date</td><td>: 2021-12-15 18:24:27</td></tr><tr><td>M.R#</td><td>: PT 1010</td></tr><tr><td>Owner Name</td><td>: Noor Yasmin</td></tr><tr><td>Patient Name</td><td>: lizzie</td></tr><tr><td>Contact</td><td>: 03099948758</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Consultation</td><td>500</td><td>1</td><td>: 500<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 500<td/></tr><tr><td>Grand Total</td><td>: 500<td/></tr><tr><td>Amount Received</td><td>: 500<td/></tr><tr><td>Amount To be Paid</td><td>: 0<td/></tr></table>'),
(51, 'INV 1030', 'PT 1011', 'Mahim', 'Administrator', '', '2021-12-15 18:41:42', 'Consultation: 500<br/>Treatment: 500<br/>', '1000', '0', '1000', 0, '03343144926', 'Poppy', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1030</td></tr><tr><td>Invoice Date</td><td>: 2021-12-15 18:41:42</td></tr><tr><td>M.R#</td><td>: PT 1011</td></tr><tr><td>Owner Name</td><td>: Mahim</td></tr><tr><td>Patient Name</td><td>: Poppy</td></tr><tr><td>Contact</td><td>: 03343144926</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Consultation</td><td>500</td><td>1</td><td>: 500<td/></tr><tr><td>Treatment</td><td>500</td><td>1</td><td>: 500<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 1000<td/></tr><tr><td>Grand Total</td><td>: 1000<td/></tr><tr><td>Amount Received</td><td>: 0<td/></tr><tr><td>Amount To be Paid</td><td>: 1000<td/></tr></table>'),
(52, 'INV 1031', 'PT 1012', 'Sanam', 'Administrator', '', '2021-12-15 18:43:31', 'Consultation: 500<br/>Treatment: 1000<br/>', '1500', '0', '1500', 0, '03333085185', 'Pearl', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1031</td></tr><tr><td>Invoice Date</td><td>: 2021-12-15 18:43:31</td></tr><tr><td>M.R#</td><td>: PT 1012</td></tr><tr><td>Owner Name</td><td>: Sanam</td></tr><tr><td>Patient Name</td><td>: Pearl</td></tr><tr><td>Contact</td><td>: 03333085185</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Consultation</td><td>500</td><td>1</td><td>: 500<td/></tr><tr><td>Treatment</td><td>1000</td><td>1</td><td>: 1000<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 1500<td/></tr><tr><td>Grand Total</td><td>: 1500<td/></tr><tr><td>Amount Received</td><td>: 0<td/></tr><tr><td>Amount To be Paid</td><td>: 1500<td/></tr></table>'),
(53, 'INV 1032', 'PT 1005', 'Mrs Mariyam Khan', 'Administrator', '', '2021-12-15 18:28:59', 'Treatment: 2000<br/>', '2000', '0', '2000', 0, '03452530038', 'Roxie', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1032</td></tr><tr><td>Invoice Date</td><td>: 2021-12-15 18:28:59</td></tr><tr><td>M.R#</td><td>: PT 1005</td></tr><tr><td>Owner Name</td><td>: Mrs Mariyam Khan</td></tr><tr><td>Patient Name</td><td>: Roxie</td></tr><tr><td>Contact</td><td>: 03452530038</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Treatment</td><td>2000</td><td>1</td><td>: 2000<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 2000<td/></tr><tr><td>Grand Total</td><td>: 2000<td/></tr><tr><td>Amount Received</td><td>: 2000<td/></tr><tr><td>Amount To be Paid</td><td>: 0<td/></tr></table>'),
(54, 'INV 1033', 'PT 1013', 'Mrs Hameed', 'haris isani', '', '2021-12-19 16:42:57', 'Consultation: 500<br/>Vaccination LR: 3000<br/>Grooming: 2500<br/>Flea Treatment: 1000<br/>Cat litter Super Klumpy (5 ltr.): 450<br/>Puppy Nylon Collar: 400<br/>', '7850', '0', '7850', 0, '03333053844', 'Coco', '<table style=\'width:100%; margin:0 auto;\'><tr><td>Invoice Id</td><td>: INV 1033</td></tr><tr><td>Invoice Date</td><td>: 2021-12-19 16:42:57</td></tr><tr><td>M.R#</td><td>: PT 1013</td></tr><tr><td>Owner Name</td><td>: Mrs Hameed</td></tr><tr><td>Patient Name</td><td>: Coco</td></tr><tr><td>Contact</td><td>: 03333053844</td></tr></table><table style=\'width:100%; margin:0 auto;\'><tr><th>Description</th><th>Unit</th><th>Qty</th><th>Amount</th><tr><td>Consultation</td><td>500</td><td>1</td><td>: 500<td/></tr><tr><td>Vaccination LR</td><td>3000</td><td>1</td><td>: 3000<td/></tr><tr><td>Grooming</td><td>2500</td><td>1</td><td>: 2500<td/></tr><tr><td>Flea Treatment</td><td>1000</td><td>1</td><td>: 1000<td/></tr><tr><td>Cat litter Super Klumpy (5 ltr.)</td><td>450</td><td>1</td><td>: 450<td/></tr><tr><td>Puppy Nylon Collar</td><td>400</td><td>1</td><td>: 400<td/></tr></table><table style=\'width:80%; margin:0 auto; marginleft:20%;\'><tr><td>Sub-Total</td><td>: 7850<td/></tr><tr><td>Grand Total</td><td>: 7850<td/></tr><tr><td>Amount Received</td><td>: 7850<td/></tr></table>');

-- --------------------------------------------------------

--
-- Table structure for table `billing_data`
--

CREATE TABLE `billing_data` (
  `procedure_id` int(11) NOT NULL,
  `procedure_name` varchar(30) NOT NULL,
  `procedure_amount` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing_data`
--

INSERT INTO `billing_data` (`procedure_id`, `procedure_name`, `procedure_amount`) VALUES
(18, 'Consultation', '500'),
(19, 'Vaccination', '0'),
(20, 'Surgery', '0'),
(21, 'Grooming', '0'),
(22, 'Boarding', '0'),
(23, 'Treatment', '0'),
(24, 'ASD (Antiseptic Dressing)', '0'),
(25, 'General Anesthesia', '0'),
(26, 'Local Anesthesia', '0'),
(27, 'Urinary Catheterization ', '0'),
(28, 'I/V Treatment ', '0'),
(31, 'Pending', '0'),
(32, 'Deworming', '500');

-- --------------------------------------------------------

--
-- Table structure for table `extras`
--

CREATE TABLE `extras` (
  `extra_id` int(11) NOT NULL,
  `extra_name` varchar(30) NOT NULL,
  `extra_amount` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `extras`
--

INSERT INTO `extras` (`extra_id`, `extra_name`, `extra_amount`) VALUES
(1, 'Cat litter scoop', '350'),
(2, 'Wanpy Treat', '350');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `activity` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL,
  `time_stamp` varchar(20) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`log_id`, `user_name`, `activity`, `status`, `time_stamp`) VALUES
(1, 'no user', 'Adding a new user', 'Successful', '2021-12-05 21:48:04'),
(2, 'no user', 'Attempting Login', 'Username or pas', '2021-12-05 21:48:16'),
(3, 'Administrator', 'Attempting Login', 'Successful', '2021-12-05 21:48:25'),
(4, 'Administrator', 'Updating a procedure', 'Successful', '2021-12-05 21:49:02'),
(5, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-05 21:51:02'),
(6, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 21:51:02'),
(7, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 21:59:21'),
(8, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 22:06:30'),
(9, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 22:16:13'),
(10, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:23:56'),
(11, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:24:01'),
(12, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:25:39'),
(13, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 22:27:03'),
(14, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 22:37:04'),
(15, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:40:11'),
(16, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:41:34'),
(17, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:43:24'),
(18, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:44:04'),
(19, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:44:07'),
(20, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:46:01'),
(21, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:46:49'),
(22, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:47:19'),
(23, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 22:47:59'),
(24, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:48:36'),
(25, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:49:06'),
(26, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:51:24'),
(27, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:52:43'),
(28, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:58:22'),
(29, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 22:59:13'),
(30, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 23:00:16'),
(31, 'Administrator', 'Adding a new bill', 'Query Execution', '2021-12-05 23:00:55'),
(32, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 23:01:44'),
(33, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 23:02:42'),
(34, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 23:03:14'),
(35, 'Administrator', 'Updating a patient', 'Successful', '2021-12-05 23:05:55'),
(36, 'Administrator', 'Updating a patient', 'Successful', '2021-12-05 23:06:10'),
(37, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 23:06:38'),
(38, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-05 23:06:38'),
(39, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 23:07:39'),
(40, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-05 23:07:39'),
(41, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-05 23:09:27'),
(42, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 23:09:27'),
(43, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 23:18:02'),
(44, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 23:28:36'),
(45, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 23:30:23'),
(46, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-05 23:32:03'),
(47, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 23:32:03'),
(48, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 23:32:38'),
(49, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 23:33:49'),
(50, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 23:36:14'),
(51, 'no user', 'Attempting Login', 'Username or pas', '2021-12-05 23:49:03'),
(52, 'Administrator', 'Attempting Login', 'Successful', '2021-12-05 23:49:17'),
(53, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-05 23:51:54'),
(54, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-05 23:51:54'),
(55, 'Administrator', 'Updating a patient', 'Successful', '2021-12-06 00:01:28'),
(56, 'Administrator', 'Deleting a new patient', 'Successful', '2021-12-06 00:04:01'),
(57, 'Administrator', 'Attempting Login', 'Successful', '2021-12-06 00:06:15'),
(58, 'Administrator', 'Attempting Login', 'Successful', '2021-12-10 00:09:00'),
(59, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-10 00:10:59'),
(60, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-10 00:10:59'),
(61, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-10 00:26:23'),
(62, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-10 00:27:27'),
(63, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-10 17:18:46'),
(64, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-10 17:18:46'),
(65, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-10 17:21:15'),
(66, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-10 17:56:11'),
(67, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-10 17:56:11'),
(68, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-10 17:58:40'),
(69, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-10 17:39:04'),
(70, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-10 17:39:04'),
(71, 'Administrator', 'Adding a new procedure', 'Successful', '2021-12-10 17:31:15'),
(72, 'Administrator', 'Updating a procedure', 'Successful', '2021-12-10 17:31:26'),
(73, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-10 17:39:29'),
(74, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-10 17:39:29'),
(75, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-10 17:41:23'),
(76, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-10 17:48:09'),
(77, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-10 17:48:09'),
(78, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-10 17:49:10'),
(79, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-10 17:24:01'),
(80, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-10 17:25:09'),
(81, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-10 17:59:25'),
(82, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-10 18:00:29'),
(83, 'no user', 'Attempting Login', 'Username or pas', '2021-12-10 17:38:33'),
(84, 'no user', 'Attempting Login', 'Username or pas', '2021-12-10 17:38:39'),
(85, 'Administrator', 'Attempting Login', 'Successful', '2021-12-10 17:38:47'),
(86, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-12 18:45:21'),
(87, 'Administrator', 'saving a receipt', 'Successful', '2021-12-12 18:45:21'),
(88, 'Administrator', 'Deleting Procedure', 'Successful', '2021-12-12 18:55:20'),
(89, 'Administrator', 'Deleting Procedure', 'Successful', '2021-12-12 18:55:26'),
(90, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-12 18:59:47'),
(91, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-12 19:07:59'),
(92, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-12 19:08:01'),
(93, 'Administrator', 'saving a receipt', 'Successful', '2021-12-12 19:08:01'),
(94, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-12 19:48:43'),
(95, 'Administrator', 'saving a receipt', 'Successful', '2021-12-12 19:48:43'),
(96, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-12 19:49:47'),
(97, 'Administrator', 'saving a receipt', 'Successful', '2021-12-12 19:49:47'),
(98, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-12 20:08:35'),
(99, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-12 20:08:37'),
(100, 'Administrator', 'saving a receipt', 'Successful', '2021-12-12 20:08:37'),
(101, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-12 20:09:22'),
(102, 'Administrator', 'saving a receipt', 'Successful', '2021-12-12 20:09:22'),
(103, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-12 19:47:26'),
(104, 'Administrator', 'saving a receipt', 'Successful', '2021-12-12 19:47:26'),
(105, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-12 19:48:41'),
(106, 'Administrator', 'saving a receipt', 'Successful', '2021-12-12 19:48:41'),
(107, 'Administrator', 'Attempting Login', 'Successful', '2021-12-13 14:44:38'),
(108, 'Administrator', 'Attempting Login', 'Successful', '2021-12-13 15:07:10'),
(109, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-13 14:41:32'),
(110, 'Administrator', 'saving a receipt', 'Successful', '2021-12-13 14:41:32'),
(111, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-13 14:44:16'),
(112, 'Administrator', 'saving a receipt', 'Successful', '2021-12-13 14:44:16'),
(113, 'Administrator', 'Adding a new extra', 'Successful', '2021-12-13 14:45:11'),
(114, 'Administrator', 'Adding a new extra', 'Successful', '2021-12-13 14:46:10'),
(115, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-13 14:47:00'),
(116, 'Administrator', 'saving a receipt', 'Successful', '2021-12-13 14:47:00'),
(117, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-13 15:03:41'),
(118, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-13 15:03:43'),
(119, 'Administrator', 'saving a receipt', 'Successful', '2021-12-13 15:03:43'),
(120, 'Administrator', 'Attempting Login', 'Successful', '2021-12-14 18:41:53'),
(121, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-14 18:52:18'),
(122, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-14 18:52:20'),
(123, 'Administrator', 'saving a receipt', 'Successful', '2021-12-14 18:52:20'),
(124, 'Administrator', 'Attempting Login', 'Successful', '2021-12-15 17:36:47'),
(125, 'Administrator', 'Attempting Login', 'Successful', '2021-12-15 18:00:07'),
(126, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-15 18:33:35'),
(127, 'Administrator', 'saving a receipt', 'Successful', '2021-12-15 18:33:35'),
(128, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-15 18:39:03'),
(129, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-15 18:39:05'),
(130, 'Administrator', 'saving a receipt', 'Successful', '2021-12-15 18:39:05'),
(131, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-15 18:43:00'),
(132, 'Administrator', 'saving a receipt', 'Successful', '2021-12-15 18:43:00'),
(133, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-15 18:16:09'),
(134, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-15 18:16:11'),
(135, 'Administrator', 'saving a receipt', 'Successful', '2021-12-15 18:16:11'),
(136, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-15 18:07:50'),
(137, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-15 18:07:52'),
(138, 'Administrator', 'saving a receipt', 'Successful', '2021-12-15 18:07:53'),
(139, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-15 18:09:28'),
(140, 'Administrator', 'saving a receipt', 'Successful', '2021-12-15 18:09:29'),
(141, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-15 18:24:24'),
(142, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-15 18:24:27'),
(143, 'Administrator', 'saving a receipt', 'Successful', '2021-12-15 18:24:27'),
(144, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-15 18:41:40'),
(145, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-15 18:41:42'),
(146, 'Administrator', 'saving a receipt', 'Successful', '2021-12-15 18:41:42'),
(147, 'Administrator', 'Adding a new patient', 'Successful', '2021-12-15 18:43:29'),
(148, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-15 18:43:31'),
(149, 'Administrator', 'saving a receipt', 'Successful', '2021-12-15 18:43:31'),
(150, 'Administrator', 'Adding a new bill', 'Successful', '2021-12-15 18:28:59'),
(151, 'Administrator', 'saving a receipt', 'Successful', '2021-12-15 18:28:59'),
(152, 'no user', 'Attempting Login', 'Username or pas', '2021-12-19 16:12:31'),
(153, 'no user', 'Adding a new user', 'Successful', '2021-12-19 16:12:59'),
(154, 'haris isani', 'Attempting Login', 'Successful', '2021-12-19 16:13:14'),
(155, 'haris isani', 'Adding a new patient', 'Successful', '2021-12-19 16:42:55'),
(156, 'haris isani', 'Adding a new bill', 'Successful', '2021-12-19 16:42:57'),
(157, 'haris isani', 'saving a receipt', 'Successful', '2021-12-19 16:42:57');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `mr_number` int(11) NOT NULL,
  `mr_id_unique` text NOT NULL,
  `patient_name` varchar(20) NOT NULL,
  `owner_name` varchar(20) NOT NULL,
  `owner_contact` varchar(15) DEFAULT NULL,
  `pet_notes` text DEFAULT NULL,
  `owner_email` varchar(25) DEFAULT NULL,
  `owner_address` text DEFAULT NULL,
  `patient_created_date` varchar(20) NOT NULL,
  `patient_last_modified_date` varchar(20) NOT NULL,
  `patient_last_modified_by` varchar(20) NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`mr_number`, `mr_id_unique`, `patient_name`, `owner_name`, `owner_contact`, `pet_notes`, `owner_email`, `owner_address`, `patient_created_date`, `patient_last_modified_date`, `patient_last_modified_by`, `deleted`) VALUES
(8, '1004', 'Bugi', 'Tooba', '03022779090', '03000919535 Amir', '', '', '2021-12-10 17:18:46', '2021-12-10 17:18:46', 'Administrator', 0),
(9, '1005', 'Trixie', 'Mrs Hameed', '03333053844', '', '', '', '2021-12-10 17:56:11', '2021-12-10 17:56:11', 'Administrator', 0),
(11, '1007', 'Pensey', 'Mrs Fareeha Amir', '03132191964', '', '', '', '2021-12-10 17:39:29', '2021-12-10 17:39:29', 'Administrator', 0),
(12, '1008', 'Maxie', 'Noor Yasmin', '03099948758', '03005033712', '', '', '2021-12-10 17:48:09', '2021-12-10 17:48:09', 'Administrator', 0),
(14, 'PT 1010', 'Blu', 'Nosheen', '03008260940', '', '', '', '2021-12-12 20:08:35', '2021-12-12 20:08:35', 'Administrator', 0),
(15, 'PT 1005', 'Roxie', 'Mrs Mariyam Khan', '03452530038', '', '', '', '2021-12-13 15:03:41', '2021-12-13 15:03:41', 'Administrator', 0),
(16, 'PT 1006', 'Duke', 'Yousuf Magsi', '03332466000', '', '', '', '2021-12-14 18:52:18', '2021-12-14 18:52:18', 'Administrator', 0),
(17, 'PT 1007', 'Kalu v2', 'Farheen Malick', '03152097459', '', '', '', '2021-12-15 18:39:03', '2021-12-15 18:39:03', 'Administrator', 0),
(18, 'PT 1008', 'Maple', 'Aryenish', '03008267262', '', '', '', '2021-12-15 18:16:09', '2021-12-15 18:16:09', 'Administrator', 0),
(19, 'PT 1009', 'Golu', 'Zehra', '03003577396', '', '', '', '2021-12-15 18:07:50', '2021-12-15 18:07:50', 'Administrator', 0),
(20, 'PT 1010', 'lizzie', 'Noor Yasmin', '03099948758', '', '', '', '2021-12-15 18:24:24', '2021-12-15 18:24:24', 'Administrator', 0),
(21, 'PT 1011', 'Poppy', 'Mahim', '03343144926', '', '', '', '2021-12-15 18:41:39', '2021-12-15 18:41:39', 'Administrator', 0),
(22, 'PT 1012', 'Pearl', 'Sanam', '03333085185', '', '', '', '2021-12-15 18:43:29', '2021-12-15 18:43:29', 'Administrator', 0),
(23, 'PT 1013', 'Coco', 'Mrs Hameed', '03333053844', '', '', '', '2021-12-19 16:42:55', '2021-12-19 16:42:55', 'haris isani', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_contact` varchar(20) NOT NULL,
  `user_email` varchar(20) NOT NULL,
  `user_created_date` varchar(20) DEFAULT NULL,
  `user_last_login` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password`, `user_contact`, `user_email`, `user_created_date`, `user_last_login`) VALUES
(1, 'Administrator', 'admin123', '11', 'Admin@southlane.com', '2021-12-05 21:48:04', '2021-12-15 18:00:07'),
(2, 'haris isani', '1234', '0', 'harisisani@gmail.com', '2021-12-19 16:12:59', '2021-12-19 16:13:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `billing_data`
--
ALTER TABLE `billing_data`
  ADD PRIMARY KEY (`procedure_id`);

--
-- Indexes for table `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`extra_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`mr_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `billing_data`
--
ALTER TABLE `billing_data`
  MODIFY `procedure_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `extras`
--
ALTER TABLE `extras`
  MODIFY `extra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `mr_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_length` text COLLATE utf8_bin DEFAULT NULL,
  `col_collation` varchar(64) COLLATE utf8_bin NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) COLLATE utf8_bin DEFAULT '',
  `col_default` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `settings_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `export_type` varchar(10) COLLATE utf8_bin NOT NULL,
  `template_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `template_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Dumping data for table `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'database', 'backup db 12 - 12 2021', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"structure_or_data_forced\":\"0\",\"table_select[]\":[\"appointments\",\"billing\",\"billing_data\",\"extras\",\"log\",\"patients\",\"users\"],\"table_structure[]\":[\"appointments\",\"billing\",\"billing_data\",\"extras\",\"log\",\"patients\",\"users\"],\"table_data[]\":[\"appointments\",\"billing\",\"billing_data\",\"extras\",\"log\",\"patients\",\"users\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@DATABASE@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"structure_and_data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"structure_and_data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_procedure_function\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"xml_structure_or_data\":\"data\",\"xml_export_events\":\"something\",\"xml_export_functions\":\"something\",\"xml_export_procedures\":\"something\",\"xml_export_tables\":\"something\",\"xml_export_triggers\":\"something\",\"xml_export_views\":\"something\",\"xml_export_contents\":\"something\",\"yaml_structure_or_data\":\"data\",\"\":null,\"lock_tables\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"csv_columns\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_create_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}'),
(2, 'root', 'server', 'app_souhtlane', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"db_select[]\":[\"app_southlane\",\"phpmyadmin\",\"test\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@SERVER@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"yaml_structure_or_data\":\"data\",\"\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"csv_columns\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_drop_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_procedure_function\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `item_type` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `tables` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"app_southlane\",\"table\":\"users\"},{\"db\":\"app_southlane\",\"table\":\"patients\"},{\"db\":\"app_southlane\",\"table\":\"billing\"},{\"db\":\"app_southlane\",\"table\":\"billing_data\"},{\"db\":\"app_southlane\",\"table\":\"appointments\"},{\"db\":\"app_southlane\",\"table\":\"extras\"},{\"db\":\"app_southlane\",\"table\":\"log\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `prefs` text COLLATE utf8_bin NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin DEFAULT NULL,
  `data_sql` longtext COLLATE utf8_bin DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2021-12-19 11:17:39', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL,
  `tab` varchar(64) COLLATE utf8_bin NOT NULL,
  `allowed` enum('Y','N') COLLATE utf8_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `usergroup` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
