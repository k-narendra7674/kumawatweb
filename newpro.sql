-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2021 at 01:38 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `img` varchar(250) NOT NULL,
  `icon` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `content` varchar(250) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `img`, `icon`, `name`, `content`, `created_at`) VALUES
(4, 'about-mission1.jpg', '<i class=\"fa fa-tachometer\" aria-hidden=\"true\"></i>', 'Our Mission', 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2021-04-14'),
(5, 'about-plan1.jpg', '<i class=\"fa fa-file-text\" aria-hidden=\"true\"></i>', 'Our Plan', 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2021-04-14'),
(6, 'about-vision1.jpg', '<i class=\"fa fa-podcast\" aria-hidden=\"true\"></i>', 'Our Vision', 'Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2021-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `phone` varchar(150) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `phone`, `created_at`) VALUES
(1, 'admin', 'nnk.6488@gmail.com', '$2y$10$jD99ioOJ8lP99o.7hJBcCup0/kXNsvcN9D5Iw9kFys9ALyFuY13By', '9584958494', '2021-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `all_product`
--

CREATE TABLE `all_product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `app_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `web_id` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `all_product`
--

INSERT INTO `all_product` (`product_id`, `name`, `app_id`, `card_id`, `web_id`, `created_at`) VALUES
(1, 'All Product', 1, 1, 1, '2021-04-14'),
(2, 'All Product', 2, 2, 2, '2021-04-14'),
(3, 'All Product', 3, 3, 3, '2021-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `app`
--

CREATE TABLE `app` (
  `app_id` int(11) NOT NULL,
  `img` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `app`
--

INSERT INTO `app` (`app_id`, `img`, `name`, `created_at`) VALUES
(1, 'app11.jpg', 'app1', '2021-04-14'),
(2, 'app21.jpg', 'app2', '2021-04-14'),
(3, 'app31.jpg', 'app3', '2021-04-14'),
(4, 'app111.jpg', 'app 4', '2021-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `card_id` int(11) NOT NULL,
  `img` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_id`, `img`, `name`, `created_at`) VALUES
(1, 'card11.jpg', 'card 1', '2021-04-14'),
(2, 'card21.jpg', 'card 2', '2021-04-14'),
(3, 'card31.jpg', 'card 3', '2021-04-14'),
(4, 'card111.jpg', 'Card 4', '2021-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mobiles`
--

CREATE TABLE `mobiles` (
  `id` int(11) NOT NULL,
  `img` varchar(250) NOT NULL,
  `icon` varchar(250) NOT NULL,
  `name` varchar(150) NOT NULL,
  `content` varchar(150) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobiles`
--

INSERT INTO `mobiles` (`id`, `img`, `icon`, `name`, `content`, `created_at`) VALUES
(1, 'avatar11.png', '<i class=\"fa fa-user-circle\" aria-hidden=\"true\"></i>', 'User', 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident', '2021-04-14'),
(2, 'avatar21.png', '<i class=\"fa fa-mobile\" aria-hidden=\"true\"></i>', 'Mobile', 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident', '2021-04-14'),
(3, 'avatar31.png', '<i class=\"fa fa-wpbeginner\" aria-hidden=\"true\"></i>', 'Teddy', 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident', '2021-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `icon` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `content` varchar(250) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `icon`, `name`, `content`, `created_at`) VALUES
(4, '<i class=\"float-left  fa fa-bullseye mt-2\" aria-hidden=\"true\"></i>', 'Lorem Ipsum', 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident', 0),
(5, '                        <i class=\" float-left fa fa-star-o mt-2\" aria-hidden=\"true\"></i>', 'Dolor Sitema', 'Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata', 0),
(6, '                        <i class=\" float-left fa fa-bandcamp mt-2\" aria-hidden=\"true\"></i>', 'Sed ut perspiciatis', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur', 0),
(7, '<i class=\" float-left fa fa-eercast mt-2\" aria-hidden=\"true\"></i>', 'Magni Dolores', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 0),
(8, '<i class=\" float-left fa fa-grav mt-2\" aria-hidden=\"true\"></i>', 'Nemo Enim', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque', 0),
(9, '<i class=\" float-left mt-2 fa fa-user-o\" aria-hidden=\"true\"></i>', 'Eiusmod Tempor', 'Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `img` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `designation` varchar(250) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `img`, `name`, `designation`, `created_at`) VALUES
(1, 'team-11.jpg', 'Sr. Designer & Developer', 'Narendra Kumawat', '2021-04-14'),
(2, 'team-21.jpg', 'HR MANAGER', 'FRANKLIN HARBET', '2021-04-14'),
(3, 'team-31.jpg', 'Sr. Designer', 'Tejkaran Kumawat', '2021-04-14');

-- --------------------------------------------------------

--
-- Table structure for table `web`
--

CREATE TABLE `web` (
  `web_id` int(11) NOT NULL,
  `img` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `web`
--

INSERT INTO `web` (`web_id`, `img`, `name`, `created_at`) VALUES
(1, 'web11.jpg', 'web 1', 2147483647),
(2, 'web21.jpg', 'web 2', 2147483647),
(3, 'web31.jpg', 'web 3', 2147483647),
(4, 'web111.jpg', 'web 4', 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_product`
--
ALTER TABLE `all_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `app`
--
ALTER TABLE `app`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobiles`
--
ALTER TABLE `mobiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web`
--
ALTER TABLE `web`
  ADD PRIMARY KEY (`web_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `all_product`
--
ALTER TABLE `all_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `app`
--
ALTER TABLE `app`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mobiles`
--
ALTER TABLE `mobiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `web`
--
ALTER TABLE `web`
  MODIFY `web_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
