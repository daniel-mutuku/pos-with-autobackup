-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2021 at 09:27 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_pos_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `store_no` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `branch_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `branch_email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `location`, `store_no`, `branch_phone`, `branch_email`, `created_at`, `updated_at`) VALUES
(2, 'Newdawn Town', 'Nairobi, Kenya', 'DSD23CHD', '+254717576900', 'town@gmail.com', '2021-11-14 17:14:52', '2021-11-14 17:14:52'),
(284259610, 'Town branc', 'Nairobi, Kenya', 'wehsdajfh', '0724654191', 'townb@gmail.com', '2021-12-06 05:27:05', '2021-12-06 05:27:05');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `branch_id` int(11) NOT NULL,
  `is_walkin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `phone`, `branch_id`, `is_walkin`) VALUES
(217563569, 'Walkin Client', '0717576900', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `invoice_amt` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `particulars` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Cash'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `branch_id`, `client_id`, `invoice_amt`, `discount`, `tax`, `particulars`, `created_at`, `type`) VALUES
(218103415, 2, 217563569, '27400.00', '600.00', '0.00', '[{\"prodId\":\"262562760\",\"prodName\":\"HP\",\"prodQty\":1,\"prodCost\":\"28000.00\",\"prodTax\":0,\"prodTot\":\"28000.00\",\"avQty\":10}]', '2021-12-08 02:50:10', 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_payments`
--

CREATE TABLE `invoice_payments` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `mode` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoice_payments`
--

INSERT INTO `invoice_payments` (`id`, `client_id`, `mode`, `amount`, `created_at`, `updated_at`) VALUES
(218105904, 217563569, 'cash', '27400.00', '2021-12-08 02:50:10', '2021-12-08 02:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `staff_id`, `password`, `created_at`, `updated_at`) VALUES
(3, 298413204, '9e061dc6c341bfb89f01f5bcd11dc99f', '2021-11-25 19:50:41', '2021-11-25 20:04:14');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `barcode` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `buying_price` decimal(10,2) NOT NULL,
  `selling_price` decimal(10,2) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `barcode`, `buying_price`, `selling_price`, `branch_id`, `cat_id`, `created_at`, `updated_at`) VALUES
(261775482, 'Samsung M20', 'W34EKSASAE2', '2349248342342', '15000.00', '21000.00', 2, 254990182, '2021-12-06 13:09:37', '2021-12-06 13:09:37'),
(262178041, 'Infinix ', 'jdsdjsssfdsjsdfv', '12345678754336', '10000.00', '15000.00', 2, 254990182, '2021-12-06 13:10:17', '2021-12-06 13:10:17'),
(262562760, 'HP', 'DDFKSFMHFJJ34', '2947321489753', '21000.00', '28000.00', 2, 255458462, '2021-12-06 13:10:56', '2021-12-06 13:10:56'),
(262886025, 'Lenovo', 'ssdk34esxaas', '348927343621292', '25000.00', '30000.00', 2, 255458462, '2021-12-06 13:11:28', '2021-12-06 13:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `product_adjustments`
--

CREATE TABLE `product_adjustments` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `effect` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'add' COMMENT 'add or reduce',
  `type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_adjustments`
--

INSERT INTO `product_adjustments` (`id`, `product_id`, `amount`, `effect`, `type`, `created_at`, `updated_at`) VALUES
(206212169, 262562760, 10, 'add', 'stock_purchase', '2021-12-08 02:30:21', '2021-12-08 02:30:21'),
(218102403, 262562760, 1, 'reduce', 'sale', '2021-12-08 02:50:10', '2021-12-08 02:50:10'),
(285767295, 261775482, 10, 'reduce', 'stock_return', '2021-12-08 07:29:36', '2021-12-08 07:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `branch_id`, `created_at`) VALUES
(254608712, 'Health & Beauty', 2, '2021-12-06 13:07:52'),
(254824768, 'Home & Office', 2, '2021-12-06 13:07:53'),
(254990182, 'Phone & Tablets', 2, '2021-12-06 13:07:53'),
(255458462, 'Computing', 2, '2021-12-06 13:07:53');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `is_super` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `is_super`, `created_at`, `updated_at`) VALUES
(246801598, 'Super Admin', 1, '2021-12-06 13:03:36', '2021-12-08 02:59:01');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `particulars` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `fname` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `phone_no` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `dob` int(11) NOT NULL,
  `id_no` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `fname`, `lname`, `email`, `username`, `phone_no`, `dob`, `id_no`, `role_id`, `branch_id`, `created_at`, `updated_at`) VALUES
(298413204, 'Dedan', 'Wanjiru', 'mike@gmail.com', 'admin', '0717576900', 0, 36474358, 246801598, 2, '2021-11-25 19:50:41', '2021-11-25 19:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `stock_purchases`
--

CREATE TABLE `stock_purchases` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `supp_id` int(11) NOT NULL,
  `particulars` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `phone_no` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `id_no` int(15) NOT NULL,
  `location` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `branch_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `email`, `phone_no`, `id_no`, `location`, `branch_id`, `created_at`, `updated_at`) VALUES
(205825298, 'Daniel Mutuku', 'mike@gmail.com', '0724654191', 36474358, 'Nairobi, Kenya', 2, '2021-12-08 02:29:42', '2021-12-08 02:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payments`
--

CREATE TABLE `supplier_payments` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `method` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `supplier_payments`
--

INSERT INTO `supplier_payments` (`id`, `supplier_id`, `amount`, `method`, `created_at`) VALUES
(200096978, 205825298, '100000.00', 'cash', '2021-12-08 07:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_supplies`
--

CREATE TABLE `supplier_supplies` (
  `id` int(11) NOT NULL,
  `adjustment_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `supplier_supplies`
--

INSERT INTO `supplier_supplies` (`id`, `adjustment_id`, `supplier_id`, `total_price`, `created_at`) VALUES
(206218327, 206212169, 205825298, '150000.00', '2021-12-08 02:30:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ClientsBranch` (`branch_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ExpenseBranchBranchID` (`branch_id`),
  ADD KEY `ExpCreator` (`created_by`),
  ADD KEY `ExpUpdator` (`updated_by`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `InvoiceBranchBranchID` (`branch_id`),
  ADD KEY `InvoiceClient` (`client_id`);

--
-- Indexes for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IPInvcoiceInvoiceID` (`client_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `LoginStaffStaffID` (`staff_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PermRoleRoleID` (`role_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`,`barcode`),
  ADD KEY `ProdBranchBranchID` (`branch_id`),
  ADD KEY `ProdCatCatID` (`cat_id`);

--
-- Indexes for table `product_adjustments`
--
ALTER TABLE `product_adjustments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PAProdProdID` (`product_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `SettingsBranchBranchID` (`branch_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_no` (`id_no`),
  ADD KEY `StaffBranchBranchID` (`branch_id`),
  ADD KEY `StaffRoleRoleID` (`role_id`);

--
-- Indexes for table `stock_purchases`
--
ALTER TABLE `stock_purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PurchasesBranch` (`branch_id`),
  ADD KEY `SupplierPurchases` (`supp_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`phone_no`,`id_no`),
  ADD KEY `SuppBrnachBranchID` (`branch_id`);

--
-- Indexes for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `SupPaymentsSuppliers` (`supplier_id`);

--
-- Indexes for table `supplier_supplies`
--
ALTER TABLE `supplier_supplies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `SuppliesAdjustments` (`adjustment_id`),
  ADD KEY `SuppliesSupplier` (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284259611;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=217563570;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218103416;

--
-- AUTO_INCREMENT for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218105905;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262886026;

--
-- AUTO_INCREMENT for table `product_adjustments`
--
ALTER TABLE `product_adjustments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=285767296;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255458463;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246801599;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298413205;

--
-- AUTO_INCREMENT for table `stock_purchases`
--
ALTER TABLE `stock_purchases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205825299;

--
-- AUTO_INCREMENT for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200096979;

--
-- AUTO_INCREMENT for table `supplier_supplies`
--
ALTER TABLE `supplier_supplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206218328;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `ClientsBranch` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `ExpCreator` FOREIGN KEY (`created_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ExpUpdator` FOREIGN KEY (`updated_by`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ExpenseBranchBranchID` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `InvoiceBranchBranchID` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `InvoiceClient` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_payments`
--
ALTER TABLE `invoice_payments`
  ADD CONSTRAINT `IPInvcoiceInvoiceID` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `LoginStaffStaffID` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `PermRoleRoleID` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `ProdBranchBranchID` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ProdCatCatID` FOREIGN KEY (`cat_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_adjustments`
--
ALTER TABLE `product_adjustments`
  ADD CONSTRAINT `PAProdProdID` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `SettingsBranchBranchID` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `StaffBranchBranchID` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `StaffRoleRoleID` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `stock_purchases`
--
ALTER TABLE `stock_purchases`
  ADD CONSTRAINT `PurchasesBranch` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SupplierPurchases` FOREIGN KEY (`supp_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `SuppBrnachBranchID` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplier_payments`
--
ALTER TABLE `supplier_payments`
  ADD CONSTRAINT `SupPaymentsSuppliers` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplier_supplies`
--
ALTER TABLE `supplier_supplies`
  ADD CONSTRAINT `SuppliesAdjustments` FOREIGN KEY (`adjustment_id`) REFERENCES `product_adjustments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SuppliesSupplier` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
