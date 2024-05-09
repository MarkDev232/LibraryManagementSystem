-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 12:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `addtocart`
--

CREATE TABLE `addtocart` (
  `add_ID` int(11) NOT NULL,
  `add_img` varchar(100) NOT NULL,
  `add_name` varchar(100) NOT NULL,
  `add_price` float(10,2) NOT NULL,
  `add_category` varchar(100) NOT NULL,
  `add_qty` int(100) NOT NULL,
  `Total_price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `Admin_ID` int(11) NOT NULL,
  `Admin_FName` varchar(100) NOT NULL,
  `Admin_Email` varchar(100) NOT NULL,
  `Admin_Username` varchar(100) NOT NULL,
  `Admin_Password` varchar(100) NOT NULL,
  `Admin_Img` varchar(100) NOT NULL,
  `verify_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`Admin_ID`, `Admin_FName`, `Admin_Email`, `Admin_Username`, `Admin_Password`, `Admin_Img`, `verify_status`) VALUES
(1, 'admins', 'admin@gmail.com', 'admin', 'admin', 'userimg/b10.jpg', 'Verify');

-- --------------------------------------------------------

--
-- Table structure for table `book_info`
--

CREATE TABLE `book_info` (
  `book_ID` int(50) NOT NULL,
  `book_Image` varchar(100) NOT NULL,
  `book_Name` varchar(100) NOT NULL,
  `book_Category` varchar(100) NOT NULL,
  `book_Author` varchar(100) NOT NULL,
  `book_Price` decimal(10,2) NOT NULL,
  `book_Qty` int(32) NOT NULL,
  `SoldCount` int(11) NOT NULL,
  `BorrowCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_info`
--

INSERT INTO `book_info` (`book_ID`, `book_Image`, `book_Name`, `book_Category`, `book_Author`, `book_Price`, `book_Qty`, `SoldCount`, `BorrowCount`) VALUES
(13, 'image/image4.png', 'Mastering Photoshop for Web Design', 'Programing Language', 'Master M', 100.00, 33, 6, 1),
(14, 'uploads/b1.jpg', 'Data Analysis', 'Database', 'Berk', 120.00, 3, 3, 0),
(15, 'uploads/b2.jpg', 'Daily Stoic', 'Database', 'Ryan Holiday', 120.00, 5, 1, 2),
(16, 'uploads/b3.jpg', 'English Advance Vocabulary', 'Database', 'Mark', 120.00, 1, 5, 0),
(20, 'uploads/b7.jpg', 'Program with C', 'Programing Language', 'Noel', 300.00, 0, 5, 0),
(21, 'uploads/b8.jpg', 'Javascript', 'Programing Language', 'Stephen', 300.00, 6, 0, 0),
(22, 'uploads/b9.jpg', 'Phyton Programming', 'Programing Language', 'Adam', 300.00, -6, 12, 0),
(23, 'uploads/b10.jpg', 'Phyton Data Analytics', 'Programing Language', 'Fabio', 300.00, 6, 0, 0),
(24, 'uploads/b11.jpg', 'Excel VBA', 'Programing Language', 'Jason Jay', 300.00, 5, 1, 0),
(25, 'uploads/book1.png', 'asdasdas', 'Programing Language', 'asdsadas', 300.00, 99, 0, 0),
(26, 'uploads/b1.jpg', 'test1', 'test', 'testt', 490.00, 40, 0, 0),
(27, 'uploads/b1.jpg', 'test1', 'test', 'testt', 490.00, 40, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `borrow_ID` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `book_Cat` varchar(100) NOT NULL,
  `book_Aut` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `borrow_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_info` varchar(100) NOT NULL,
  `approval_date` varchar(100) NOT NULL,
  `penalty` decimal(10,2) NOT NULL,
  `return_date` varchar(100) NOT NULL,
  `status_b` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`borrow_ID`, `user_id`, `book_name`, `book_Cat`, `book_Aut`, `quantity`, `borrow_date`, `status_info`, `approval_date`, `penalty`, `return_date`, `status_b`) VALUES
(14, '', 'Essentials of Ecology', 'Environment', 'Bird Man', 1, '2024-01-13 08:37:49', 'Approved', '2024-01-13', 0.00, '2024-01-16', 'Paid'),
(15, '', 'Javascript', 'Programing Language', 'Stephen', 1, '2024-01-15 05:38:10', 'Pending', '', 0.00, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `Category_ID` int(11) NOT NULL,
  `Category_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Category_Name`) VALUES
(2, 'Database'),
(3, 'Programing Language'),
(4, 'Environment'),
(5, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `edit_user`
--

CREATE TABLE `edit_user` (
  `edit_ID` int(11) NOT NULL,
  `edit_bg` varchar(100) NOT NULL,
  `edit_font` varchar(100) NOT NULL,
  `edit_logo` varchar(100) NOT NULL,
  `edit_slide1` varchar(100) NOT NULL,
  `edit_slide2` varchar(100) NOT NULL,
  `edit_slide3` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `edit_user`
--

INSERT INTO `edit_user` (`edit_ID`, `edit_bg`, `edit_font`, `edit_logo`, `edit_slide1`, `edit_slide2`, `edit_slide3`) VALUES
(1, 'green', 'red', 'editimg/aboutbooks.jpeg', 'editimg/slide1.png', 'editimg/bg1.jpg', 'editimg/slide2.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_qty` int(100) NOT NULL,
  `prod_price` decimal(10,2) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `Total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `Status_ID` int(11) NOT NULL,
  `Status_info` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `total_vat` decimal(10,2) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `total_change` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `prod_id`, `total_vat`, `invoice_id`, `total_change`, `total_price`, `date_create`) VALUES
(5, 0, 12.00, 65, 21.00, 112.00, '2024-01-15 01:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `transaction_detail_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `names` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwords` varchar(100) NOT NULL,
  `verify_token` varchar(100) NOT NULL,
  `verify_status` tinyint(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `User_ID` int(11) NOT NULL,
  `User_FName` varchar(50) NOT NULL,
  `User_Email` varchar(50) NOT NULL,
  `User_Username` varchar(50) NOT NULL,
  `User_Mobile` varchar(50) NOT NULL,
  `User_Address` varchar(50) NOT NULL,
  `User_Password` varchar(50) NOT NULL,
  `User_Img` varchar(50) NOT NULL,
  `User_Status` varchar(100) NOT NULL,
  `verify_token` varchar(100) NOT NULL,
  `verify_status` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `BorrowedBooksCount` int(11) NOT NULL,
  `login_attempts` int(11) NOT NULL,
  `blocked` tinyint(1) NOT NULL,
  `penalty` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`User_ID`, `User_FName`, `User_Email`, `User_Username`, `User_Mobile`, `User_Address`, `User_Password`, `User_Img`, `User_Status`, `verify_token`, `verify_status`, `created_at`, `BorrowedBooksCount`, `login_attempts`, `blocked`, `penalty`) VALUES
(3, 'Mark Francis Sauquillo edited', 'mark.sauquillo1@gmail.com', 'mark3', '', '', 'mark', 'userimg/b11.jpg', '', '59bba32619f4f9dec09ab6205ed86bf5', 'Verify', '2024-04-26 11:08:53', 1, 1, 0, 0.00),
(4, 'markmarkmark editedvb2', 'mark.sauquillo3@gmail.com', 'mark2', '', '', 'markmark', 'userimg/b8.jpg', '', 'c32f54101350688d2f593caabb2035c6', 'Verify', '2024-01-15 05:38:10', 1, 0, 0, 0.00),
(5, 'Mark Francis Sauquillo edited', 'mark.sauquillo1@gmail.com', 'mark3', '', '', 'mark', 'userimg/b11.jpg', '', '776b2bcc0dfc57f8c49f3d4cd1d23fa5', 'Not Verify', '2024-04-26 11:08:53', 1, 1, 0, 0.00),
(7, 'markmar', 'markfrancis.sauquillo.f@bulsu.edu.ph', 'markmark', '', '', 'mark3', 'default-profile-image.jpg', '', '09b82646f892e39a6f2872300adef494', 'Verify', '2024-01-10 08:24:05', 0, 0, 0, 0.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addtocart`
--
ALTER TABLE `addtocart`
  ADD PRIMARY KEY (`add_ID`);

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `book_info`
--
ALTER TABLE `book_info`
  ADD PRIMARY KEY (`book_ID`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`borrow_ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`Category_ID`);

--
-- Indexes for table `edit_user`
--
ALTER TABLE `edit_user`
  ADD PRIMARY KEY (`edit_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`Status_ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`transaction_detail_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addtocart`
--
ALTER TABLE `addtocart`
  MODIFY `add_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `book_info`
--
ALTER TABLE `book_info`
  MODIFY `book_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `borrow_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `Category_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `edit_user`
--
ALTER TABLE `edit_user`
  MODIFY `edit_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `Status_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `transaction_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
