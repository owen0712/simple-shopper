-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2021 at 04:59 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple_shopper`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `receiptient_name` varchar(1000) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `postal_code` int(5) NOT NULL,
  `state` varchar(15) NOT NULL,
  `area` varchar(1000) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `default_status` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `receiptient_name`, `phone_number`, `postal_code`, `state`, `area`, `description`, `default_status`, `user_id`) VALUES
(1, 'Sim Ple Kid', '0123456789', 50603, 'Kuala Lumpur', 'Wilayah Persekutuan', 'Universiti Malaya', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Beverage'),
(2, 'Instant Food'),
(3, 'Cereal'),
(4, 'Snack'),
(5, 'Canned and Packed Food'),
(6, 'Cooking Ingredient'),
(7, 'Baking Supplies'),
(8, 'Paper Product'),
(9, 'Household Supply'),
(10, 'Bath and Body'),
(11, 'Baby Product'),
(12, 'Pet');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`product_id`, `user_id`, `time`) VALUES
(1, 2, '2021-06-11 00:44:30'),
(2, 2, '2021-06-11 00:44:33'),
(3, 2, '2021-06-11 00:44:36'),
(4, 2, '2021-06-05 01:32:29'),
(7, 2, '2021-06-11 00:36:33'),
(10, 2, '2021-06-11 00:39:21'),
(11, 2, '2021-06-11 00:45:17'),
(12, 2, '2021-06-04 07:35:43'),
(13, 2, '2021-06-04 05:53:19'),
(14, 2, '2021-06-11 00:44:40'),
(15, 2, '2021-06-11 00:44:44'),
(20, 2, '2021-06-05 01:32:12'),
(22, 2, '2021-06-11 00:44:48'),
(24, 2, '2021-06-04 05:53:59'),
(28, 2, '2021-06-11 00:44:56'),
(34, 2, '2021-06-04 05:54:01'),
(37, 2, '2021-06-05 01:25:00'),
(54, 2, '2021-06-11 00:34:56'),
(63, 2, '2021-06-05 01:46:44'),
(76, 2, '2021-06-04 05:54:04'),
(80, 2, '2021-06-04 05:54:06'),
(81, 2, '2021-06-04 05:54:10'),
(89, 2, '2021-06-05 01:34:51'),
(90, 2, '2021-06-04 05:54:13'),
(91, 2, '2021-06-05 03:05:11'),
(106, 2, '2021-06-04 05:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `Otp_id` int(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `Otp` int(4) NOT NULL,
  `Expire` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`Otp_id`, `email`, `phone`, `Otp`, `Expire`) VALUES
(3, 'simplekid@gmail.com', NULL, 5067, '2021-06-01 01:19');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_image` varchar(1000) NOT NULL,
  `product_name` varchar(1000) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_amount` int(11) DEFAULT NULL,
  `product_price` float NOT NULL,
  `product_description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_image`, `product_name`, `category_id`, `product_amount`, `product_price`, `product_description`) VALUES
(1, 'Beverage-1.png', 'Coca-cola', 1, 0, 1.99, 'Coca-Cola Carbonated Drink Original 320ml'),
(2, 'Beverage-2.png', '100 plus', 1, 10, 1.99, '100 plus Carbonated Drink Original 320ml'),
(3, 'Beverage-3.png', '7up', 1, 10, 1.99, '7up Lemon  and  Lime Carbonated Drink 320ml'),
(4, 'Beverage-4.png', 'Tropicana', 1, 10, 2.99, 'Tropicana Twister Orange Drink 350ml'),
(5, 'Beverage-5.png', 'Nescafe', 1, 10, 2.6, 'Nescafe Original Drink 240ml'),
(6, 'Beverage-6.png', 'Nestl?? Milo', 1, 10, 2, 'Nestl?? Milo Chocolate Malt Drink 200ml'),
(7, 'Beverage-7.png', 'Farm Fresh', 1, 10, 4.99, 'Farm Fresh Original Yogurt Drink 700ml'),
(8, 'Beverage-8.png', 'GoodDay', 1, 10, 5.2, 'GoodDay Full Cream Fresh Milk 500ml'),
(9, 'Beverage-9.png', 'Homesoy', 1, 10, 1.2, 'Homesoy Soya Milk Original 250ml'),
(10, 'Beverage-10.png', 'Oishi', 1, 10, 1.99, 'Oishi Original Green Tea Drink 380ml'),
(11, 'Instant-1.png', 'Mi Sedap', 2, 20, 3.8, 'Mi Sedap Instant Noodle original flavour 5 packets x 91g'),
(12, 'Instant-2.png', 'Mama Mee', 2, 20, 5, 'Mama Mee 5 packets x 60g'),
(13, 'Instant-3.png', 'Samyang', 2, 20, 19, 'Samyang Spicy Korean Ramen 5 packets'),
(14, 'Instant-4.png', 'Nongshim Shin Ramyun', 2, 20, 10.5, 'Nongshim Shin Ramyun Korea Ramen 5 Pack'),
(15, 'Instant-5.png', 'A1 Bak Kut Teh Mee', 2, 20, 7, 'A1 Bak Kut Teh Mee (90g x 4packs)'),
(16, 'Instant-6.png', 'Maggi curry\'', 2, 20, 4.8, 'Maggi curry flavour'),
(17, 'Instant-7.png', 'Cintan', 2, 20, 3.2, 'Cintan Instant Noodles - Assorted Flavour (75g x 5\'s)'),
(18, 'Instant-8.png', 'Mamee Chef', 2, 20, 5.9, 'Mamee Chef Instant Noodle - Creamy Tom Yam Flavour (4 x 80g)'),
(19, 'Instant-9.png', 'IndoMie', 2, 20, 4.85, 'IndoMie Instant Fried Noodle 85g x 5 packets'),
(20, 'Instant-10.png', 'San Remo', 2, 20, 4.8, 'San Remo Dry Pasta - Spirals (500g)'),
(21, 'Cereal-1.png', 'KokoKrunch', 3, 30, 8.99, 'KokoKrunch (330g)'),
(22, 'Cereal-2.png', 'Honey Stars', 3, 30, 8.9, 'Honey Stars (300g)'),
(23, 'Cereal-3.png', 'Cookie Crisps', 3, 30, 10.9, 'Cookie Crisps (330g)'),
(24, 'Cereal-4.png', 'Fitness cereal ', 3, 30, 13.95, 'Fitness cereal (fruits) (390g)'),
(25, 'Cereal-5.png', 'Froot Loops', 3, 30, 9.7, 'Froot Loops (300g)'),
(26, 'Cereal-6.png', 'Corn Flakes', 3, 30, 6.56, 'Corn Flakes (275g)'),
(27, 'Cereal-7.png', 'Special K', 3, 30, 12.9, 'Special K (oats and honey) (375g)'),
(28, 'Cereal-8.png', 'Honey Crunch', 3, 30, 11.33, 'Honey Crunch (360g)'),
(29, 'Cereal-9.png', 'Cheerios', 3, 30, 21.5, 'Cheerios (272g)'),
(30, 'Cereal-10.png', 'Milo cereal', 3, 30, 8.9, 'Milo cereal (330g)'),
(31, 'snack-1.png', 'Baiwei Yuanqi Mochi', 4, 35, 7.52, 'Baiwei Yuanqi Mochi Strawberry Mango 180g'),
(32, 'snack-2.png', 'GPR Popcorn', 4, 35, 18, 'GPR Popcorn 280g Chocolate Flavor'),
(33, 'snack-3.png', 'Small twist snack', 4, 35, 0.38, 'Small twist snack'),
(34, 'snack-4.png', 'WuZiWei Snacks', 4, 35, 0.99, 'WuZiWei Snacks Buy 3 free 1 (14g)'),
(35, 'snack-5.png', 'China Weilong', 4, 35, 4.55, 'China Weilong Special Spicy Snacks'),
(36, 'snack-6.png', 'Lay Potato Chips', 4, 35, 4.8, 'Thailand Lay Potato Chips Snack'),
(37, 'snack-7.png', 'Cheese Cake', 4, 35, 1.19, 'Fruity Banana Mango Durian Cheese Cake snacks'),
(38, 'snack-8.png', 'Munchy\'s Oat', 4, 35, 7.29, 'Munchy\'s Oat Krunch Biscuit (416g)'),
(39, 'snack-9.png', 'Tearing bread snack', 4, 35, 9.99, 'Tearing bread snack soya flavour'),
(40, 'snack-10.png', 'Haidilao Snack', 4, 35, 1.79, 'Haidilao Snack 20g'),
(41, 'canned-1.png', 'Ayam Brand Sardines', 5, 25, 5.7, 'Ayam Brand Sardines in Tomato Sauce 230g'),
(42, 'canned-2.png', 'Ayam Brand Peas', 5, 25, 3, 'Ayam Brand Processed Peas 425g'),
(43, 'canned-3.png', 'Ayam Brand Tuna', 5, 25, 6.85, 'Ayam Brand Tuna Light Chunks in Olive Oil (150g)'),
(44, 'canned-4.png', 'Ayam Brand Deli', 5, 25, 6.4, 'Ayam Brand Deli Spread Tuna 160g'),
(45, 'canned-5.png', 'Yeos Kacang', 5, 25, 4.29, 'Yeos Kacang Panggang 425G'),
(46, 'canned-6.png', 'Rex Curry Beef', 5, 25, 4.49, 'Rex Curry Beef 160g'),
(47, 'canned-7.png', 'Pineapple Chunks', 5, 25, 4.89, 'Pineapple Chunks in Syrup 425g'),
(48, 'canned-8.png', 'Ayam Brand Mushrooms', 5, 25, 6.05, 'Ayam Brand Mushrooms 420g'),
(49, 'canned-9.png', 'Kimball Tomato Soup', 5, 25, 4, 'Kimball Tomato Soup 425g'),
(50, 'canned-10.png', 'Coconut Milk', 5, 25, 2.79, 'Ayam Brand Coconut Milk'),
(51, 'CS-1.png', 'Knife Cooking oil', 6, 15, 26.8, 'Knife Cooking oil (5kg)'),
(52, 'CS-2.png', 'Olive oil', 6, 15, 13.99, 'Naturel extra virgin olive oil (250ml)'),
(53, 'CS-3.png', 'Fine granulated sugar', 6, 15, 2.95, 'Fine granulated sugar (1kg)'),
(54, 'CS-4.png', 'Soy sauce', 6, 15, 6.25, 'Lee Kum Kee selected light soy sauce (500ml)'),
(55, 'CS-5.png', 'Panda brand Oyster', 6, 15, 7.99, 'Lee Kum Kee Panda brand Oyster sauce (770g)'),
(56, 'CS-6.png', 'Ajinomoto', 6, 15, 7.19, 'Ajinomoto (500g)'),
(57, 'CS-7.png', 'Smoked Ground', 6, 15, 11.99, 'McCormick Paprika Smoked Ground (37g)'),
(58, 'CS-8.png', 'Salt', 6, 15, 10.1, 'Cerebos Iodised Table Salt (700g)'),
(59, 'CS-9.png', 'Real Stock Chicken', 6, 15, 17.9, 'Campbells Real Stock Chicken (500ml)'),
(60, 'CS-10.png', 'Gochujang', 6, 15, 20.5, 'Gochujang (500g)'),
(61, 'baking supplies-1.png', 'Pizza Pan', 7, 5, 25.12, 'Non-stick High Quality Pizza Pan'),
(62, 'baking supplies-2.png', 'Rotating Stand', 7, 5, 12.65, 'Cake Decorating Supplies Cake Turntable Decorating Rotating Stand'),
(63, 'baking supplies-3.png', 'Turntable Cake Bag', 7, 5, 38.9, 'Bakeware Cake Decorating Supplies Cake Turntable Cake Bag'),
(64, 'baking supplies-4.png', 'Cake Mold Baking Tools', 7, 5, 36.3, 'HELLO KITTY DIY Silicone Donut/Cake Mold Baking Tools'),
(65, 'baking supplies-5.png', 'Cream Cake Baking Tool', 7, 5, 4.9, 'Adjustable Height Fondant Cream Cake Baking Tool Bakeware'),
(66, 'baking supplies-6.png', 'Muffin Baking Mold DIY', 7, 5, 2.99, 'Kitchen Loaf Tin Cake Mold Muffin Baking Mold DIY Bakeware Supplies'),
(67, 'baking supplies-7.png', 'Round Pizza Pan', 7, 5, 7.12, 'Round Dish Deep Pizza Pan'),
(68, 'baking supplies-8.png', 'Biscuit Cutter', 7, 5, 3.66, '4Pcs/Set Stainless Steel Dinosaur Biscuit Cutter'),
(69, 'baking supplies-9.png', 'Fondant Scraper', 7, 5, 2.26, 'Christmas Plastic Dough Icing Fondant Scraper'),
(70, 'baking supplies-10.png', 'Cake Baking Tool', 7, 5, 2.6, 'Plastic Dough Icing Fondant Scraper Cake Decorating Baking Tool'),
(71, 'Paper_Product-1.png', 'Soft Box Tissue', 8, 10, 2.99, 'Premier Facial Soft Box Tissue 2ply x 100pcs'),
(72, 'Paper_Product-2.png', 'Premier Wet Tissue', 8, 10, 6.99, 'Premier Wet Tissue 50pcs'),
(73, 'Paper_Product-3.png', 'Compact toilet paper', 8, 10, 14.99, 'Compact toilet paper 10 rolls'),
(74, 'Paper_Product-4.png', 'Kitchen Paper Towel', 8, 10, 5.8, 'Scott Kitchen Paper Towel 2Rolls x60s'),
(75, 'Paper_Product-5.png', 'Facial Tissue', 8, 10, 5.9, 'Kleenex Skincare 3ply Facial Tissue 44sx4'),
(76, 'Paper_Product-6.png', 'Sampling Paper Cup', 8, 10, 4.99, 'Sampling Paper Cup 50pcs/set'),
(77, 'Paper_Product-7.png', 'Baking Paper', 8, 10, 9.99, 'Diamond Cooking  and  Baking Paper 8mx30cm'),
(78, 'Paper_Product-8.png', 'Coffee Filter Paper', 8, 10, 3.5, 'MOMO Coffee Filter Paper 100pcs'),
(79, 'Paper_Product-9.png', 'Wax Paper Sandwich Bag', 8, 10, 6.99, 'Reynolds Wax Paper Sandwich Bag 50pcs'),
(80, 'Paper_Product-10.png', 'Brown Paper Bag', 8, 10, 2.8, 'Brown Paper Bag 20pcs'),
(81, 'Household-1.png', 'Sunlight Dishwash', 9, 20, 5.6, 'Sunlight Dishwash Liquid Extra Nature 900ml'),
(82, 'Household-2.png', 'Multi-purpose towel', 9, 20, 11.8, 'Scoot multi-purpose towel 8 rolls'),
(83, 'Household-3.png', 'Wooden Fry Turner', 9, 20, 9.6, 'Wooden Fry Turner with hole(35cm)'),
(84, 'Household-4.png', 'Pizza knife set', 9, 20, 42.9, 'Cs kochsysteme steak/ pizza knife set'),
(85, 'Household-5.png', 'UHU glue', 9, 20, 5.8, 'UHU glue 20ml'),
(86, 'Household-6.png', 'Precision Scissors', 9, 20, 17.5, 'Precision Scissors'),
(87, 'Household-7.png', 'Staples', 9, 20, 0.29, 'Staples 1000pcs 1unit'),
(88, 'Household-8.png', 'Blue Ball Pen', 9, 20, 3.6, 'Faber-Caster Blue Ball Pen 0.5'),
(89, 'Household-9.png', 'Black Ball Pen', 9, 20, 3.6, 'Faber-Caster Black Ball Pen 0.5'),
(90, 'Household-10.png', 'Transparent Tape', 9, 20, 3.44, 'Eve Clear Transparent Tape 48mm x 40m'),
(91, 'bath-1.png', 'Morocco Shampoo', 10, 30, 20.9, 'Renew Repair Argan Oil of Morocco Shampoo 400ml'),
(92, 'bath-2.png', 'Rejoice Shampoo', 10, 30, 16.9, 'Rejoice Shampoo 900ml Rich Soft Smooth'),
(93, 'bath-3.png', 'Dove', 10, 30, 18.9, 'Dove Nutritive Solutions Shampoo 680ml'),
(94, 'bath-4.png', 'Sunsilk Shampoo', 10, 30, 15.5, 'Sunsilk Shampoo 650ml'),
(95, 'bath-5.png', 'Antibacterial Shower', 10, 30, 18.9, 'Lifebuoy Total 10 Antibacterial Shower Gel 950ml'),
(96, 'bath-6.png', 'Shokubutsu', 10, 30, 10.8, 'Shokubutsu Clean Fresh Shower Foam 650ml'),
(97, 'bath-7.png', 'Follow Me', 10, 30, 12, 'Follow Me Anti-bacterial Body Wash 1000ml'),
(98, 'bath-8.png', 'Green Tea Shampoo', 10, 30, 15.3, 'Follow Me Green Tea Shampoo 6 in 1 650ml'),
(99, 'bath-9.png', 'Lux Shower Gel', 10, 30, 15.5, 'Lux Shower Gel - Magical Spell 950ml'),
(100, 'bath-10.png', 'Pantene', 10, 30, 17.95, 'Pantene Micellar Shampoo 500ml'),
(101, 'baby-1.png', 'Pureen Baby Bath', 11, 35, 15.9, 'Pureen Baby Bath with Vitamin E'),
(102, 'baby-2.png', 'Pureen Baby Oil', 11, 35, 11.9, 'Pureen Baby Oil with Vitamin E'),
(103, 'baby-3.png', 'Pureen Baby Powder', 11, 35, 10.9, 'Pureen Baby Cornstarch Powder'),
(104, 'baby-4.png', 'Joielle Baby', 11, 35, 27, 'Joielle Baby Top To Toe (250ml)'),
(105, 'baby-5.png', 'Pureen Baby Napkin', 11, 35, 20.9, 'Pureen Baby Napkin (Colourful)'),
(106, 'baby-6.png', 'Car Seat', 11, 35, 499, 'Koopers Pago Red Car Seat'),
(107, 'baby-7.png', 'Pigeon Baby Wipes', 11, 35, 13, 'Pigeon Baby Wipes Water Base 30s x 2'),
(108, 'baby-8.png', 'Baby Bottle', 11, 35, 79.1, 'Mam Premium Glass Bottle (9OZ) Single Pack'),
(109, 'baby-9.png', 'Sweetheart Paris', 11, 35, 229, 'Sweetheart Paris BW1001 ??? Orange'),
(110, 'baby-10.png', 'Teether and Rattles', 11, 35, 22, 'Teether and Rattles'),
(111, 'pet-1.png', 'Pedigree Dog Lamb', 12, 25, 27.5, 'Pedigree Dog Lamb and Vegetables Dog Food'),
(112, 'pet-2.png', 'Whiskas Canned Tuna', 12, 25, 4.91, 'Whiskas Canned Tuna 400g'),
(113, 'pet-3.png', 'Cat Dry Food Tuna', 12, 25, 7.17, 'Whiskas Adult Cat Dry Food Tuna Flavour 480g'),
(114, 'pet-4.png', 'Cesar Chicken Cheese', 12, 25, 9.34, 'Cesar Chicken  and  Cheese 100g x 3'),
(115, 'pet-5.png', 'Cat Litter', 12, 25, 14.58, 'Catsan Clumping Cat Litter 5L'),
(116, 'pet-6.png', 'Sheba Tender Chicken', 12, 25, 3.9, 'Sheba Tender Chicken and Fine Flakes Wet Food 85g'),
(117, 'pet-7.png', 'Cesar Beef Dog Food', 12, 25, 3.8, 'Cesar Beef Dog Food 100g'),
(118, 'pet-8.png', 'Kitty Bed', 12, 25, 128, 'Kitty City Cozy Bed'),
(119, 'pet-9.png', 'Water Dispenser', 12, 25, 33, 'Auto Food Water Dispenser'),
(120, 'pet-10.png', 'Foldable Cat Cage', 12, 20, 70, 'Foldable Cat Cage');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_list`
--

CREATE TABLE `shopping_list` (
  `list_id` int(11) NOT NULL,
  `list_name` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopping_list`
--

INSERT INTO `shopping_list` (`list_id`, `list_name`, `user_id`) VALUES
(1, 'Shopping List 1', 1),
(2, 'Shopping List 2', 1),
(3, 'Shopping List 4', 1),
(4, 'User 2 Shopping 6', 2),
(5, 'User 2 Shopping 2', 2),
(9, 'User 2 Shopping 5', 2),
(10, 'Hello', 2),
(15, 'Shopping List 6', 1),
(16, 'Hello', 1),
(17, 'hi', 2);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_list_item`
--

CREATE TABLE `shopping_list_item` (
  `list_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `item_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shopping_list_item`
--

INSERT INTO `shopping_list_item` (`list_id`, `product_id`, `item_quantity`) VALUES
(1, 1, 10),
(1, 2, 10),
(1, 3, 15),
(2, 11, 4),
(2, 12, 2),
(2, 13, 2),
(2, 15, 1),
(3, 21, 6),
(3, 26, 5),
(3, 28, 1),
(4, 3, 5),
(4, 11, 18),
(4, 13, 9),
(5, 1, 9),
(5, 12, 1),
(5, 28, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(10000) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `password`, `name`, `email`, `phone`, `gender`, `dob`, `profile`, `status`) VALUES
(1, 'a43c27c2babefd68df8a694900f30a1c', 'Admin', 'admin@gmail.com', '0123456789', 'male', '2021-06-05', '../assets/uploads/profile.png', 'Admin'),
(2, 'bab3f1e57da7208228498a28398aa1ce', 'Sim Ple Kid', 'simplekid@gmail.com', '012345678', 'male', '2020-10-09', '../assets/uploads/profile.png', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `fk_history_user` (`user_id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`Otp_id`),
  ADD KEY `fk_otp_email` (`email`),
  ADD KEY `fk_otp_phone` (`phone`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_product_category` (`category_id`);
ALTER TABLE `product` ADD FULLTEXT KEY `prodcut_description` (`product_description`);

--
-- Indexes for table `shopping_list`
--
ALTER TABLE `shopping_list`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `fk_list_user_id` (`user_id`);

--
-- Indexes for table `shopping_list_item`
--
ALTER TABLE `shopping_list_item`
  ADD PRIMARY KEY (`list_id`,`product_id`),
  ADD KEY `fk_item_product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `phone_unique` (`phone`),
  ADD UNIQUE KEY `email_unique` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `Otp_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `shopping_list`
--
ALTER TABLE `shopping_list`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_history_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `otp`
--
ALTER TABLE `otp`
  ADD CONSTRAINT `fk_otp_email` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_otp_phone` FOREIGN KEY (`phone`) REFERENCES `user` (`phone`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shopping_list`
--
ALTER TABLE `shopping_list`
  ADD CONSTRAINT `fk_list_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shopping_list_item`
--
ALTER TABLE `shopping_list_item`
  ADD CONSTRAINT `fk_item_list_id` FOREIGN KEY (`list_id`) REFERENCES `shopping_list` (`list_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_item_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
