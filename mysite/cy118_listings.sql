-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 11, 2022 at 02:53 PM
-- Server version: 5.7.38
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cy118_listings`
--

-- --------------------------------------------------------

--
-- Table structure for table `fav`
--

CREATE TABLE `fav` (
  `id` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fav`
--

INSERT INTO `fav` (`id`, `lid`, `uid`, `date`) VALUES
(1, 18, 1, '2022-03-17 20:42:02');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `lid`, `uid`, `url`, `posted`) VALUES
(1, 10, 1, 'https://lid.zoocdn.com/u/1024/768/a4f186809d3e7e61215500a9dedcc13a3d3c2120.jpg', '2022-03-13 06:17:04'),
(3, 10, 1, 'https://lid.zoocdn.com/u/1024/768/1397bde2ccf5b23ec24d7af1ffafd437dc6d4bd0.jpg:p', '2022-03-13 06:25:57'),
(5, 12, 6, 'https://lid.zoocdn.com/u/1024/768/dfad08e1351d867f2002a0c6acadeaac08f296f1.jpg:p', '2022-03-13 06:45:41'),
(6, 12, 6, 'https://lid.zoocdn.com/u/1024/768/ecbabac5d51d7095d44ea76ccbaa21c436a6ca47.jpg:p', '2022-03-13 06:46:05'),
(7, 12, 6, 'https://lid.zoocdn.com/u/1024/768/a883b0f30105f83801d342daba024131c303de8f.jpg:p', '2022-03-13 06:46:35'),
(8, 12, 6, 'https://lid.zoocdn.com/u/1024/768/7d5385668242e73fc554084e372b4b66f1c8f4d0.jpg:p', '2022-03-13 06:47:25'),
(15, 12, 6, 'https://lid.zoocdn.com/u/1024/768/28c0f68c3008a441a9b354eb10033cde2368304a.jpg:p', '2022-03-14 20:29:57'),
(17, 18, 1, 'https://lid.zoocdn.com/u/1024/768/7d829215c5f08a08a113e26ebad28812d5adb8fe.jpg:p', '2022-03-15 20:40:01'),
(18, 18, 1, 'https://lid.zoocdn.com/u/1024/768/1a1027edc0eb7c3015ef247d9f9c88430424f681.jpg:p', '2022-03-15 20:40:33'),
(19, 18, 1, 'https://lid.zoocdn.com/u/1024/768/7fffeb2d5df0f26fdd42c2c24ad28e0e39bc9a9a.jpg:p', '2022-03-15 20:40:46'),
(20, 18, 1, 'https://lid.zoocdn.com/u/1024/768/001545c86003ad249fe58de6c766a9cbf4495834.jpg:p', '2022-03-15 20:40:57'),
(21, 18, 1, 'https://lid.zoocdn.com/u/1024/768/2fcb20cef2b11d460d10ffbc8104a8718db909e2.jpg:p', '2022-03-15 20:41:08'),
(22, 18, 1, 'https://lid.zoocdn.com/u/1024/768/d59ff646e69f377ad14f832fb01ef78ba017e3cb.jpg:p', '2022-03-15 20:42:26'),
(23, 18, 1, 'https://lid.zoocdn.com/u/1024/768/465c679f92990079caafa63f2f4d7ecdbf0b6633.jpg:p', '2022-03-15 21:36:10'),
(24, 18, 1, 'https://lid.zoocdn.com/u/1024/768/56c0518c7136eb036fb41fd2794465d34c45f37c.jpg:p', '2022-03-15 22:13:54'),
(25, 18, 1, 'https://lid.zoocdn.com/u/1024/768/75f39341ce3291b5bdba862cbbef583f3bf99283.jpg:p', '2022-03-15 22:14:14'),
(26, 18, 1, 'https://lid.zoocdn.com/u/1024/768/3b7e7c32273bc807b8133f9cd81d1f3001083559.jpg:p', '2022-03-15 22:14:35'),
(27, 18, 1, 'https://lid.zoocdn.com/u/1024/768/9cd6b9b3388267c254524d98f017b03176cb6e31.jpg:p', '2022-03-16 00:19:41'),
(28, 8, 1, 'https://lid.zoocdn.com/u/768/576/bd98497061544eb5bc8a58c19a254b94b21c22c5.jpg:p', '2022-03-20 15:05:50'),
(29, 3, 1, 'https://lid.zoocdn.com/u/1024/768/a4f186809d3e7e61215500a9dedcc13a3d3c212.jpg', '2022-03-21 23:30:54'),
(30, 19, 1, 'https://lid.zoocdn.com/u/1024/768/5966ad8102e55d6debc6927be6f4e63d7957493b.jpg:p', '2022-03-23 05:43:39'),
(31, 19, 1, 'https://lid.zoocdn.com/u/1024/768/db9b8b04a0bc3fc3994f28ce6481ef86f78e8c6a.jpg:p', '2022-03-23 05:43:56'),
(32, 21, 1, 'https://www.bouygues-uk.com/wp-content/uploads/2020/07/230721_university-of-brighton-c-simon-harvey-21-scaled.jpg', '2022-03-23 07:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `lid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL,
  `descr` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postcode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `outcode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `beds` int(11) NOT NULL DEFAULT '0',
  `baths` int(11) NOT NULL DEFAULT '0',
  `size` int(11) NOT NULL DEFAULT '0',
  `property` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `lng` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`lid`, `uid`, `title`, `type`, `price`, `descr`, `location`, `street`, `postcode`, `outcode`, `beds`, `baths`, `size`, `property`, `status`, `lng`, `lat`, `posted`, `code`) VALUES
(1, 1, 'Test', 1, 10000, 'Description', '', '', '', '', 0, 0, 0, '', 0, '', '', '2022-03-04 16:22:13', '116473748971'),
(2, 1, 'dtfghjk', 1, 5678, 'dxfcgbhjkdfcgvbhjn', '', '', '', '', 0, 0, 0, '', 0, '', '', '2022-03-04 18:04:04', '116473749601'),
(3, 1, 'NewTest', 1, 67809, 'This is a description', 'London', '', '', '', 0, 0, 0, '', 0, '', '', '2022-03-04 18:05:45', '116473749771'),
(4, 1, 'House', 1, 45678, 'Description test', '', '', '', '', 0, 0, 0, '', 0, '', '', '2022-03-04 18:24:12', '116473749861'),
(5, 1, '4 bed flat', 1, 20000, '4 bedroom flat for rent', '', '', '', '', 0, 0, 0, '', 0, '', '', '2022-03-05 19:38:50', '116473750021'),
(6, 1, '4 bed flat', 1, 200000, '4 bedroom flat for rent', '', '', '', '', 0, 0, 0, '', 0, '', '', '2022-03-05 19:42:01', '116473750131'),
(7, 4, 'jhbnh', 1, 10000, 'garage with toaster', 'London', '', '', '', 0, 0, 0, '', 0, '', '', '2022-03-07 10:30:54', '116473750231'),
(8, 1, 'TestTitle', 1, 500, 'Test description 123 test', 'Brighton', '', '', '', 4, 2, 305, 'Semi-detatched', 0, '', '', '2022-03-12 15:05:18', '116473750351'),
(9, 1, 'For sale title', 2, 450000, 'RANDOm deSCRIPTion', 'Brighton', '', '', '', 5, 3, 400, 'Flat', 0, '-0.14372', '50.831227', '2022-03-12 15:11:48', '116472710453'),
(10, 1, 'Random', 1, 5000, 'Expensive house', 'London', '', '', '', 3, 3, 300, 'Semi-detatched', 0, '', '', '2022-03-13 00:17:48', '1164737533221'),
(11, 1, 'NewTest', 1, 250, 'Student house', 'Brighton', '', '', '', 5, 2, 486, 'Semi-detatched', 0, '', '', '2022-03-13 05:40:29', '116273759321'),
(12, 6, '4 bed flat', 2, 200000, 'Bungalow for sale in brighton', 'Brighton', '', '', '', 3, 2, 670, 'Bungalow', 0, '', '', '2022-03-13 06:44:03', '122478752353'),
(17, 1, 'dfghijok', 2, 56789, 'fcghvbjklgvhjbk', 'br', '', '', '', 6, 4, 7689, 'Detached', 0, '', '', '2022-03-15 20:03:20', '116473282725'),
(18, 1, 'hufrhufhu', 2, 647326, 'This is a house for sale', 'Brighton', '', '', '', 6, 4, 756, 'Detached', 0, '', '', '2022-03-15 20:08:04', '116473748841'),
(19, 1, 'studio flat', 1, 1000, 'Coming soon to Brighton this year, Pavilion Point is located in the heart of Brighton’s bustling city. Enjoy everything Brighton has to offer, with just a 16 min bus ride to the University of Brighton, the seafront right on your doorstep and all the shops, restaurants and pubs you love just around the corner in the town center, you’ll be sure to be living your best student life in Brighton.\r\n\r\nNot only are we located in a great spot, but we also offer amazing spaces for you to enjoy at home when you want to socialize with your friends, including an on-site gym, cinema room, coffee station and we’ve also got dedicated areas for you to study.\r\n\r\nWhether you choose one of the stylish en suites or spacious studios, all bills*, contents insurance and high-speed Wi-Fi are included in the price. Plus, – you can even share our studios with a partner at no extra cost!\r\n\r\nHow to make an inquiry: Select desired check-in and check-out date, the number of guests, scroll at the bottom of the page and click on Contact host.\r\n\r\nOur studios come with a small double bed, loads of workspace & storage, en suite shower room, and your own mini-kitchen, fully equipped with a full-size oven and separate microwave. Plus, there is 19sqm of floor space. Have the studios all to yourself, or share with a partner at no extra cost!\r\n\r\nNotes:\r\n\r\nPlease note that this is a Students Only property.\r\n\r\nAdditional information about the guest will be requested through a form in order to meet the accommodation provider requirements.', 'Brighton', 'Howards Place', 'BN1 3UP', 'BN1', 1, 1, 0, 'Flat', 0, '-0.14372', '50.831227', '2022-03-23 05:05:46', '116480119461'),
(21, 1, 'Brighton university', 1, 1500, 'Brighton university', 'Brighton', 'Lewes road', 'BN2 4AT', 'BN2', 1, 15, 0, 'Detached', 0, '-0.11917', '50.842454', '2022-03-23 07:33:00', '116480207801');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `date`) VALUES
(1, 'Caleb', 'calebyorkton@gmail.com', '$2y$10$WolDci9S7Q.BpU2kytfxEeNs4244x3yDhwes7mjs0RLJcb2Ik2ywC', '2022-03-05 20:24:39'),
(4, 'gvygvyg', 'asad99@gmail.com', '$2y$10$rYVU9FoyriaFY0vBs5vEq..Xolg1c5Un1TB6COAOkPKYgxtc/myEC', '2022-03-07 10:29:48'),
(6, 'Calebnew', 'Caleb@google.com', '$2y$10$G8wWATg3/.yVaPv2WjRREuWeAgboTJTYqnJ3TorEmBTaFxUo9mbRe', '2022-03-13 06:42:58'),
(7, 'calebb', 'email@email.com', '$2y$10$riBl4TJozygqQxlarfsUve/JivZhw5QFS52EBFLmTXkpgLIyupW96', '2022-03-21 23:15:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fav`
--
ALTER TABLE `fav`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`lid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fav`
--
ALTER TABLE `fav`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `list`
  MODIFY `lid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
