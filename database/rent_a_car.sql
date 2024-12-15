-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 12:58 PM
-- Server version: 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent_a_car`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` int(10) NOT NULL,
  `user` varchar(50) NOT NULL,
  `car` varchar(50) NOT NULL,
  `pickup` date NOT NULL,
  `dropoff` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `user`, `car`, `pickup`, `dropoff`, `status`) VALUES
(72, '31', '6', '2024-05-05', '2024-05-06', 'Approved'),
(78, '34', '1', '2024-05-06', '2024-05-08', 'Pending'),
(82, '32', '17', '2024-05-21', '2024-05-25', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE IF NOT EXISTS `system` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `about` varchar(1023) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `name`, `email`, `contact`, `about`) VALUES
(1, 'Rent a Car', 'rac@mail.com', '+63123', 'Just rent it. ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact`, `password`) VALUES
(1, 'Ched', 'ched@mail.com', '+63123', 'ched123'),
(31, 'Neo', 'neo@mail.com', '+63123', 'neo123'),
(32, 'Aiyan', 'aiyan@mail.com', '+631234', 'aiyan123'),
(34, 'Venson', 'venson@mail.com', 'call me maybe?', 'venson123');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `car_id` int(10) NOT NULL,
  `type` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `capacity` varchar(20) NOT NULL,
  `transmission` varchar(10) NOT NULL,
  `fuel` varchar(10) NOT NULL,
  `cost` varchar(50) NOT NULL,
  `image` varchar(1023) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=409 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`car_id`, `type`, `name`, `capacity`, `transmission`, `fuel`, `cost`, `image`, `description`) VALUES
(1, 'Sedan', 'Toyota Vios', '5', 'CVT', 'Gasoline', '1000', 'vios.png', 'The Toyota Vios has a front-wheel drive with a maximum output of 106 hp at 6000 rpm and maximum torque output of 140nm at 4200 rpm.                                '),
(2, 'Sedan', 'Honda City', '5', 'Automatic', 'Hydrogen', '2999', '2.jpg', 'The Honda City is a popular compact sedan known for its reliability, fuel efficiency, and comfortable ride. With sleek styling and a spacious interior, it offers a perfect blend of practicality and style for urban commuters. Equipped with advanced safety features and modern technology, the Honda City provides a smooth and enjoyable driving experience.                                                                                                                                                                                                               '),
(3, 'Sedan', 'Kia Rio', '5', 'Automatic', 'Gasoline', '1500', 'rio.png', 'Discover the 2023 Kia Rio Sedan. Enhance your daily drives with comfortable seating and a variety of advanced technical options. Find yours today!'),
(4, 'Sedan', 'Mitsubishi Mirage G4', '5', 'Automatic', 'Gasoline', '2999', 'mirageG4.png', 'The Mitsubishi Mirage G4 is a compact sedan that prioritizes affordability and efficiency without compromising on features. With its compact size and nimble handling, it''s ideal for city driving and tight parking spaces. The Mirage G4 boasts impressive fuel economy, a user-friendly infotainment system, and a surprisingly spacious cabin, making it a practical choice for budget-conscious buyers.'),
(5, 'Van', 'Nissan NV350', '18', 'Manual', 'Diesel', '7000', '5.jpg', 'The Nissan NV350 is a versatile and spacious commercial van designed for businesses of all sizes. With its robust build quality and customizable interior configurations, it offers ample cargo space and practicality for various transportation needs. Equipped with modern safety features and efficient engines, the NV350 ensures reliable performance and comfort for both drivers and passengers.'),
(6, 'Delivery', 'Mitsubishi L300', '3', 'Manual', 'Gasoline', '6999', '6.jpg', 'The Mitsubishi L300 is a reliable and versatile light commercial vehicle suitable for various business and transport needs. Known for its sturdy construction and spacious interior, it offers ample cargo capacity and comfortable seating for passengers. With its efficient engine options and durable build, the L300 is a practical choice for businesses requiring dependable transportation solutions.'),
(9, 'MPV', 'Toyota Innova', '7', 'Manual', 'Diesel', '4999', '3.jpg', 'The Toyota Innova is a highly acclaimed multi-purpose vehicle renowned for its reliability and versatility. With its spacious and well-appointed interior, it comfortably accommodates up to eight passengers and offers ample cargo space. Equipped with advanced safety features and efficient engine options, the Innova provides a smooth and enjoyable driving experience for both urban and long-distance travel.'),
(10, 'MPV', 'Hyundai Stargazer', '7', 'Manual', 'Diesel', '3500', 'stargazer.png', 'The Stargazer is a 7 Seater MPV and has a length of 4460 mm the width of 1780 mm, and a wheelbase of 2780 mm.'),
(11, 'MPV', 'Mitsubishi Xpander', '7', 'Manual', 'Diesel', '4450', 'xpander.png', 'The Mitsubishi Xpander is a stylish and practical MPV designed for modern families. Its sleek exterior design is complemented by a spacious and flexible interior layout, capable of seating up to seven passengers comfortably. With advanced safety features and efficient engine options, the Xpander offers a smooth and secure driving experience, making it an ideal choice for urban commuting and family road trips.'),
(12, 'MPV', 'Suzuki Ertiga', '7', 'Automatic', 'Diesel', '4500', 'ertiga.png', 'The Suzuki Ertiga is a versatile and compact MPV crafted for families seeking comfort and practicality. Its ergonomic design provides ample space for up to seven occupants, along with flexible seating arrangements to accommodate varying cargo needs. With fuel-efficient engines and modern amenities, the Ertiga offers a smooth and enjoyable driving experience for both city commutes and long journeys.'),
(17, 'Hatchback', 'Honda Brio', '5', 'CVT', 'Gasoline', '2000', 'brio.png', 'The New Honda Brio now made affordable with special downpayment offers! A hatchback with a big impact, a practical but stylish car loaded with features.'),
(18, 'Hatchback', 'Suzuki Swift', '5', 'Automatic', 'Gasoline', '1500', 'swift.png', 'The Suzuki Swift is an iconic hatchback with dynamic driving performance, preventative safety technology and bold design. Book a test drive now!'),
(19, 'Hatchback', 'Toyota Wigo', '5', 'CVT', 'Gasoline', '1999', '1.jpg', 'The Toyota Wigo is a compact hatchback designed for urban living, offering excellent maneuverability and fuel efficiency. With its sleek and stylish exterior, the Wigo stands out on city streets while providing a comfortable interior for its passengers. Equipped with modern features and Toyota''s renowned reliability, the Wigo is an ideal choice for drivers looking for a practical and affordable city car.                          '),
(20, 'Hatchback', 'Kia Picanto', '5', 'Manual', 'Gasoline', '1500', 'picanto.png', 'The Kia Picanto is a compact hatchback known for its stylish design, fuel efficiency, and agile handling. With its compact size and nimble performance, the Picanto is perfect for navigating through crowded city streets and tight parking spaces. Despite its small exterior dimensions, the Picanto offers a surprisingly spacious and comfortable interior, making it an excellent choice for urban commuters and small families.'),
(22, 'SUV', 'Mitsubishi Montero', '7', 'Automatic', 'Diesel', '7000', 'montero.png', 'The Mitsubishi Montero is a rugged and versatile SUV renowned for its off-road capabilities and dependable performance. With its robust chassis and advanced four-wheel-drive system, the Montero excels in tackling various terrains, from rough trails to city streets. Featuring a spacious cabin, ample cargo room, and advanced safety features, the Montero provides both comfort and confidence for adventurous journeys.'),
(23, 'SUV', 'Toyota Fortuner', '7', 'Automatic', 'Diesel', '5000', '4.jpg', 'The Toyota Fortuner is a formidable SUV that combines ruggedness with refined comfort. Its powerful engine options and robust chassis make it suitable for both on-road cruising and off-road adventures. With its spacious interior, advanced safety features, and commanding road presence, the Fortuner offers a versatile driving experience for those seeking reliability and versatility in their SUV.'),
(24, 'SUV', 'Ford Everest', '7', 'Manual', 'Diesel', '10000', 'everest.png', 'The Ford Everest is a capable SUV designed for adventurous journeys and urban commutes alike. Boasting a strong and efficient engine lineup, along with advanced terrain management systems, it''s built to tackle various road conditions with ease. Its spacious interior, loaded with modern comforts and safety features, ensures a comfortable and secure ride for both driver and passengers.\r\n\r\n\r\n\r\n\r\n\r\n'),
(25, 'SUV', 'Nissan Terra', '7', 'Automatic', 'Diesel', '9000', 'terra.png', 'The Nissan Terra is a rugged and versatile SUV built for both on-road comfort and off-road capability. With its powerful engine options and advanced driving technologies, it provides a smooth and controlled driving experience in any terrain. Its spacious and well-appointed interior offers ample room for passengers and cargo, making it ideal for both family adventures and everyday use.'),
(404, 'Van', 'Toyota Hiace', '14', 'Manual', 'Diesel', ' 7000', 'hiace.png', 'The Toyota Hiace is a reliable and versatile van renowned for its durability and practicality. With its spacious interior and flexible seating configurations, it''s ideal for various commercial and personal transportation needs. Equipped with advanced safety features and efficient engines, the Hiace ensures a comfortable and secure journey for both driver and passengers alike.\r\n\r\n\r\n\r\n\r\n\r\n'),
(405, 'Van', 'Foton Transvan', '15', 'Automatic', 'Diesel', ' 7500', 'foton.png', 'The Foton Transvan is a dependable and cost-effective van designed for commercial and personal use. Its robust build, spacious interior, and customizable configurations make it suitable for various transportation needs. With efficient engines and modern features, the Transvan offers a smooth and reliable driving experience for both passengers and drivers.'),
(406, 'Delivery', 'Hyundai K2500', '3', 'CVT', 'Gasoline', '8000', 'K2500.png', 'The Hyundai K2500 is a versatile and practical commercial vehicle designed for a range of cargo and passenger transportation needs. With its spacious interior, durable construction, and powerful engine options, the K2500 is well-suited for businesses and individuals alike. Whether used for deliveries, logistics, or as a workhorse, the K2500 offers reliability and efficiency on the road.'),
(407, 'Delivery', 'Toyota Lite Ace', '2', 'Automatic', 'Diesel', '7000', 'liteace.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.'),
(408, 'Delivery', 'Kia H100', '3', 'Manual', 'Gasoline', '6000', 'H100.png', 'The Kia H100 is a robust and dependable light commercial vehicle designed for versatile hauling tasks. With its spacious cargo area and strong engine performance, the H100 is well-suited for transporting goods and equipment in various urban and rural settings. Its durable construction and comfortable cabin make it a reliable choice for businesses and professionals requiring a dependable workhorse.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`car_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `car_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=409;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
