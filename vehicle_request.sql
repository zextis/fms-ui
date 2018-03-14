-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2018 at 12:57 PM
-- Server version: 5.7.21-0ubuntu0.17.10.1
-- PHP Version: 7.1.11-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicle_request`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `id` int(11) UNSIGNED NOT NULL,
  `vechicle_id` varchar(20) NOT NULL,
  `alert_type` varchar(20) NOT NULL,
  `alert_date` date NOT NULL,
  `expriration_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `audits`
--

CREATE TABLE `audits` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `login_time` timestamp NULL DEFAULT NULL,
  `logout_time` timestamp NULL DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `activity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE `configuration` (
  `id` int(11) UNSIGNED NOT NULL,
  `facility_name` varchar(50) NOT NULL,
  `database_name` varchar(20) NOT NULL,
  `updates` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `facility_id` int(11) UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `first_name`, `last_name`, `facility_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Frank', 'Martin', 1, 1, '2018-02-26 05:00:00', '2018-02-26 05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(200) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `location`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'SRHA', 'Mandeville', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `journey_logging`
--

CREATE TABLE `journey_logging` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `request_id` int(11) UNSIGNED NOT NULL,
  `liscense_plate` varchar(15) NOT NULL,
  `driver_id` int(11) UNSIGNED NOT NULL,
  `departure_odometer` int(11) DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `return_odometer` int(11) DEFAULT NULL,
  `return_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(11) UNSIGNED NOT NULL,
  `liscense_plate` varchar(15) NOT NULL,
  `driver_id` int(11) UNSIGNED DEFAULT NULL,
  `service_date` date NOT NULL,
  `service_type` varchar(150) NOT NULL,
  `service_cost` double NOT NULL,
  `job_description` text NOT NULL,
  `others` varchar(150) NOT NULL,
  `odometer_reading` int(11) DEFAULT NULL,
  `mechanic` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Do Anything', '2018-03-05 05:00:00', '2018-03-05 05:00:00'),
(2, 'Manage Request', '2018-03-05 05:00:00', '2018-03-05 05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) UNSIGNED NOT NULL,
  `facility_id` int(11) UNSIGNED NOT NULL,
  `liscense_plate` varchar(15) DEFAULT NULL,
  `department` varchar(50) NOT NULL,
  `number_of_persons` int(11) NOT NULL,
  `purpose_of_trip` varchar(1500) NOT NULL,
  `pick_up_point` varchar(1000) NOT NULL,
  `required_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `destination` text NOT NULL,
  `other_info` text,
  `dept_supervisor` int(11) UNSIGNED NOT NULL,
  `contact_num` varchar(30) NOT NULL,
  `request_date` date NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `approval_date` date DEFAULT NULL,
  `driver_id` int(11) UNSIGNED DEFAULT NULL,
  `status` varchar(35) NOT NULL DEFAULT 'Pending',
  `comments` text,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `facility_id`, `liscense_plate`, `department`, `number_of_persons`, `purpose_of_trip`, `pick_up_point`, `required_date`, `departure_time`, `destination`, `other_info`, `dept_supervisor`, `contact_num`, `request_date`, `request_time`, `approved`, `approval_date`, `driver_id`, `status`, `comments`, `updated_at`) VALUES
(1, 1, NULL, 'MIS', 20, 'Fun and relaxation', 'SRHA', '2018-02-26', '05:00:00', 'Uganda', 'Bring food and beer', 2, '000-000-0000', '2018-02-26', '2018-02-26 14:57:32', 0, NULL, NULL, 'Pending', NULL, '2018-03-01 15:58:58'),
(2, 1, NULL, 'Human Resources', 20, 'Training', 'SRHA', '2018-04-25', '08:00:00', 'Kingston', 'None', 2, '000-000-0000', '2018-02-26', '2018-02-26 18:44:33', 0, NULL, NULL, 'Pending', NULL, '2018-02-28 19:46:25'),
(3, 1, NULL, 'Accounts', 15, 'Audit', 'SRHA', '2018-11-13', '09:09:00', 'Black River', 'Bring Pizza', 1, '000-000-0000', '2018-02-26', '2018-02-26 18:52:57', 0, NULL, NULL, 'Pending', NULL, '2018-02-28 19:41:16'),
(4, 1, NULL, 'HIV', 15, 'Education', 'SRHA', '2018-06-06', '05:00:00', 'Kingston', 'Nope', 1, '000-000-0000', '2018-02-28', '2018-02-28 19:40:17', 0, NULL, NULL, 'Pending', NULL, NULL),
(5, 1, NULL, 'Human Resources', 12, 'Training', 'SRHA', '2018-04-17', '08:00:00', 'Montego Bay', '', 1, '000-000-0000', '2018-03-01', '2018-03-01 15:58:04', 0, NULL, NULL, 'Pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'power-user', '2018-03-05 05:00:00', '2018-03-05 05:00:00'),
(2, 'supervisor', '2018-03-05 05:00:00', '2018-03-05 05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(11) UNSIGNED NOT NULL,
  `role_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `role` varchar(25) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `facility_id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `role`, `is_active`, `facility_id`, `created_at`, `updated_at`) VALUES
(1, '', '', 'Admin', 'admin@srha.gov.jm', '$2y$10$St1VykCotcUMlI21NhXlZ.AZIVfAHUGxEK3mpxAWT82qRF9Sxc3pK', 'power-user', 1, 1, '2018-02-19 17:00:00', '2018-02-19 21:52:39'),
(2, 'Bob', 'Avalon', 'Bod', 'bob@srha.gov.jm', '$2y$10$St1VykCotcUMlI21NhXlZ.AZIVfAHUGxEK3mpxAWT82qRF9Sxc3pK', 'supervisor', 1, 1, '2018-02-21 05:00:00', '2018-02-21 16:42:30'),
(3, 'Sasha', 'Grant', 'sasha', 'sasha_grant@mail.com', 'pass', '', 1, 1, '2018-03-06 05:00:00', '2018-03-06 05:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_has_roles`
--

CREATE TABLE `user_has_roles` (
  `role_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_has_roles`
--

INSERT INTO `user_has_roles` (`role_id`, `user_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `liscense_plate` varchar(15) NOT NULL,
  `vehicle_type` varchar(50) NOT NULL,
  `body_type` varchar(150) NOT NULL,
  `make` varchar(150) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` int(11) NOT NULL,
  `transmission` varchar(50) NOT NULL,
  `fuel` varchar(10) NOT NULL,
  `production_year` int(11) NOT NULL,
  `facility_id` int(11) UNSIGNED NOT NULL,
  `engine_number` varchar(50) DEFAULT NULL,
  `chasis_number` varchar(50) NOT NULL,
  `colour` varchar(20) NOT NULL,
  `seating` int(11) DEFAULT NULL,
  `cc_rating` varchar(50) NOT NULL,
  `fitness_expiration` date DEFAULT NULL,
  `liscense_expiration` date DEFAULT NULL,
  `next_maintenance` date DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '0',
  `is_operable` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`liscense_plate`, `vehicle_type`, `body_type`, `make`, `model`, `year`, `transmission`, `fuel`, `production_year`, `facility_id`, `engine_number`, `chasis_number`, `colour`, `seating`, `cc_rating`, `fitness_expiration`, `liscense_expiration`, `next_maintenance`, `is_available`, `is_operable`, `created_at`, `updated_at`) VALUES
('1234 AB', '', '', '', '', 1234, '', '', 1000, 1, NULL, '', '', NULL, '', NULL, NULL, NULL, 0, 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audits`
--
ALTER TABLE `audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `audit_user_foreign` (`user_id`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facility_drivers_foreign` (`facility_id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journey_logging`
--
ALTER TABLE `journey_logging`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journey_driver_foreign` (`driver_id`),
  ADD KEY `journey_request_foreign` (`request_id`),
  ADD KEY `journey_user_foreign` (`user_id`),
  ADD KEY `journey_vehicle_foreign` (`liscense_plate`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenance_driver_foreign` (`driver_id`),
  ADD KEY `maintenance_vehicle_foreign` (`liscense_plate`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_facility_id_foreign` (`facility_id`),
  ADD KEY `request_user_foreign` (`dept_supervisor`),
  ADD KEY `request_vehicle_foreign` (`liscense_plate`),
  ADD KEY `request_drivers_foreign` (`driver_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_facility_foreign` (`facility_id`);

--
-- Indexes for table `user_has_roles`
--
ALTER TABLE `user_has_roles`
  ADD PRIMARY KEY (`role_id`,`user_id`),
  ADD KEY `user_has_roles_user_id_foreign` (`user_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`liscense_plate`),
  ADD KEY `facility_vehicles` (`facility_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `audits`
--
ALTER TABLE `audits`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `journey_logging`
--
ALTER TABLE `journey_logging`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `audits`
--
ALTER TABLE `audits`
  ADD CONSTRAINT `audit_user_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `facility_drivers_foreign` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `journey_logging`
--
ALTER TABLE `journey_logging`
  ADD CONSTRAINT `journey_driver_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journey_request_foreign` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journey_user_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journey_vehicle_foreign` FOREIGN KEY (`liscense_plate`) REFERENCES `vehicles` (`liscense_plate`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `maintenance_driver_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `maintenance_vehicle_foreign` FOREIGN KEY (`liscense_plate`) REFERENCES `vehicles` (`liscense_plate`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `request_drivers_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_user_foreign` FOREIGN KEY (`dept_supervisor`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_vehicle_foreign` FOREIGN KEY (`liscense_plate`) REFERENCES `vehicles` (`liscense_plate`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_facility_foreign` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_has_roles`
--
ALTER TABLE `user_has_roles`
  ADD CONSTRAINT `user_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_has_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
