-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 17, 2022 at 12:11 AM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kukuriho_jan_12`
--

-- --------------------------------------------------------

--
-- Table structure for table `content_product`
--

CREATE TABLE `content_product` (
  `content_product_id` bigint(20) UNSIGNED NOT NULL,
  `content_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `country_slug`, `iso_2`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Afghanistan', 'afghanistan', 'AF', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(2, 'Albania', 'albania', 'AL', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(3, 'Algeria', 'algeria', 'DZ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(4, 'American Samoa', 'american-samoa', 'AS', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(5, 'Andorra', 'andorra', 'AD', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(6, 'Angola', 'angola', 'AO', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(7, 'Anguilla', 'anguilla', 'AI', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(8, 'Antigua', 'antigua', 'AG', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(9, 'Argentina', 'argentina', 'AR', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(10, 'Armenia', 'armenia', 'AM', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(11, 'Aruba', 'aruba', 'AW', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(12, 'Australia', 'australia', 'AU', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(13, 'Austria', 'austria', 'AT', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(14, 'Azerbaijan', 'azerbaijan', 'AZ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(15, 'Bahamas', 'bahamas', 'BS', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(16, 'Bahrain', 'bahrain', 'BH', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(17, 'Bangladesh', 'bangladesh', 'BD', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(18, 'Barbados', 'barbados', 'BB', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(19, 'Belarus', 'belarus', 'BY', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(20, 'Belgium', 'belgium', 'BE', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(21, 'Belize', 'belize', 'BZ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(22, 'Benin', 'benin', 'BJ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(23, 'Bermuda', 'bermuda', 'BM', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(24, 'Bhutan', 'bhutan', 'BT', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(25, 'Bolivia', 'bolivia', 'BO', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(26, 'Bonaire', 'bonaire', 'XB', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(27, 'Bosnia', 'bosnia', 'BA', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(28, 'Botswana', 'botswana', 'BW', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(29, 'Brazil', 'brazil', 'BR', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(30, 'Brunei', 'brunei', 'BN', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(31, 'Bulgaria', 'bulgaria', 'BG', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(32, 'Burkina Faso', 'burkina-faso', 'BF', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(33, 'Burundi', 'burundi', 'BI', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(34, 'Cambodia', 'cambodia', 'KH', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(35, 'Cameroon', 'cameroon', 'CM', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(36, 'Canada', 'canada', 'CA', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(37, 'Canary Islands, The', 'canary-islands-the', 'IC', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(38, 'Cape Verde', 'cape-verde', 'CV', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(39, 'Cayman Islands', 'cayman-islands', 'KY', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(40, 'Central African', 'central-african', 'CF', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(41, 'Chad', 'chad', 'TD', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(42, 'Chile', 'chile', 'CL', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(43, 'China', 'china', 'CN', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(44, 'Colombia', 'colombia', 'CO', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(45, 'Comoros', 'comoros', 'KM', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(46, 'Congo', 'congo', 'CG', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(47, 'Congo, DPR', 'congo-dpr', 'CD', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(48, 'Cook Islands', 'cook-islands', 'CK', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(49, 'Costa Rica', 'costa-rica', 'CR', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(50, 'Cote D Ivoire', 'cote-d-ivoire', 'CI', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(51, 'Croatia', 'croatia', 'HR', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(52, 'Cuba', 'cuba', 'CU', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(53, 'Curacao', 'curacao', 'XC', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(54, 'Cyprus', 'cyprus', 'CY', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(55, 'Czech Rep., The', 'czech-rep-the', 'CZ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(56, 'Denmark', 'denmark', 'DK', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(57, 'Djibouti', 'djibouti', 'DJ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(58, 'Dominica', 'dominica', 'DM', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(59, 'Dominican Rep.', 'dominican-rep', 'DO', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(60, 'East Timor', 'east-timor', 'TL', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(61, 'Ecuador', 'ecuador', 'EC', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(62, 'Egypt', 'egypt', 'EG', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(63, 'El Salvador', 'el-salvador', 'SV', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(64, 'Eritrea', 'eritrea', 'ER', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(65, 'Estonia', 'estonia', 'EE', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(66, 'Ethiopia', 'ethiopia', 'ET', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(67, 'Falkland Islands', 'falkland-islands', 'FK', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(68, 'Faroe Islands', 'faroe-islands', 'FO', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(69, 'Fiji', 'fiji', 'FJ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(70, 'Finland', 'finland', 'FI', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(71, 'France', 'france', 'FR', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(72, 'French Guyana', 'french-guyana', 'GF', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(73, 'Gabon', 'gabon', 'GA', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(74, 'Gambia', 'gambia', 'GM', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(75, 'Georgia', 'georgia', 'GE', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(76, 'Germany', 'germany', 'DE', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(77, 'Ghana', 'ghana', 'GH', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(78, 'Gibraltar', 'gibraltar', 'GI', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(79, 'Greece', 'greece', 'GR', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(80, 'Greenland', 'greenland', 'GL', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(81, 'Grenada', 'grenada', 'GD', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(82, 'Guadeloupe', 'guadeloupe', 'GP', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(83, 'Guam', 'guam', 'GU', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(84, 'Guatemala', 'guatemala', 'GT', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(85, 'Guernsey', 'guernsey', 'GG', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(86, 'Guinea Rep.', 'guinea-rep', 'GN', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(87, 'Guinea-Bissau', 'guinea-bissau', 'GW', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(88, 'Guinea-Equatorial', 'guinea-equatorial', 'GQ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(89, 'Guyana (British)', 'guyana-british', 'GY', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(90, 'Haiti', 'haiti', 'HT', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(91, 'Honduras', 'honduras', 'HN', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(92, 'Hong Kong', 'hong-kong', 'HK', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(93, 'Hungary', 'hungary', 'HU', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(94, 'Iceland', 'iceland', 'IS', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(95, 'India', 'india', 'IN', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(96, 'Indonesia', 'indonesia', 'ID', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(97, 'Iran', 'iran', 'IR', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(98, 'Iraq', 'iraq', 'IQ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(99, 'Israel', 'israel', 'IS', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(100, 'Ireland, Rep. Of', 'ireland-rep-of', 'IE', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(101, 'Italy', 'italy', 'IT', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(102, 'Jamaica', 'jamaica', 'JM', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(103, 'Japan', 'japan', 'JP', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(104, 'Jersey', 'jersey', 'JE', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(105, 'Jordan', 'jordan', 'JO', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(106, 'Kazakhstan', 'kazakhstan', 'KZ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(107, 'Kenya', 'kenya', 'KE', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(108, 'Kiribati', 'kiribati', 'KI', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(109, 'Korea,  D.P.R Of', 'korea-dpr-of', 'KP', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(110, 'Korea, Rep. Of', 'korea-rep-of', 'KR', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(111, 'Kosovo', 'kosovo', 'KV', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(112, 'Kuwait', 'kuwait', 'KW', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(113, 'Kyrgyzstan', 'kyrgyzstan', 'KG', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(114, 'Laos', 'laos', 'LA', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(115, 'Latvia', 'latvia', 'LV', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(116, 'Lebanon', 'lebanon', 'LB', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(117, 'Lesotho', 'lesotho', 'LS', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(118, 'Liberia', 'liberia', 'LR', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(119, 'Libya', 'libya', 'LY', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(120, 'Liechtenstein', 'liechtenstein', 'LI', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(121, 'Lithuania', 'lithuania', 'LT', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(122, 'Luxembourg', 'luxembourg', 'LU', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(123, 'Macau', 'macau', 'MO', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(124, 'Madagascar', 'madagascar', 'MG', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(125, 'Malawi', 'malawi', 'MW', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(126, 'Malaysia', 'malaysia', 'MY', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(127, 'Maldives', 'maldives', 'MV', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(128, 'Mali', 'mali', 'ML', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(129, 'Malta', 'malta', 'MT', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(130, 'Mariana Islands', 'mariana-islands', 'MP', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(131, 'Marshall Islands', 'marshall-islands', 'MH', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(132, 'Martinique', 'martinique', 'MQ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(133, 'Mauritania', 'mauritania', 'MR', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(134, 'Mauritius', 'mauritius', 'MU', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(135, 'Mayotte', 'mayotte', 'YT', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(136, 'Mexico', 'mexico', 'MX', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(137, 'Micronesia', 'micronesia', 'FM', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(138, 'Moldova, Rep. Of', 'moldova-rep-of', 'MD', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(139, 'Monaco', 'monaco', 'MC', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(140, 'Mongolia', 'mongolia', 'MN', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(141, 'Montenegro, Rep Of', 'montenegro-rep-of', 'ME', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(142, 'Montserrat', 'montserrat', 'MS', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(143, 'Morocco', 'morocco', 'MA', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(144, 'Mozambique', 'mozambique', 'MZ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(145, 'Myanmar', 'myanmar', 'MM', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(146, 'Namibia', 'namibia', 'NA', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(147, 'Nauru, Rep. Of', 'nauru-rep-of', 'NR', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(148, 'Nepal', 'nepal', 'NP', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(149, 'Netherlands, The', 'netherlands-the', 'NL', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(150, 'Nevis', 'nevis', 'XN', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(151, 'New Caledonia', 'new-caledonia', 'NC', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(152, 'New Zealand', 'new-zealand', 'NZ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(153, 'Nicaragua', 'nicaragua', 'NI', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(154, 'Niger', 'niger', 'NE', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(155, 'Nigeria', 'nigeria', 'NG', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(156, 'Niue', 'niue', 'NU', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(157, 'North Macedonia', 'north-macedonia', 'MK', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(158, 'Norway', 'norway', 'NO', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(159, 'Oman', 'oman', 'OM', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(160, 'Pakistan', 'pakistan', 'PK', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(161, 'Palau', 'palau', 'PW', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(162, 'Panama', 'panama', 'PA', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(163, 'Papua New Guinea', 'papua-new-guinea', 'PG', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(164, 'Paraguay', 'paraguay', 'PY', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(165, 'Peru', 'peru', 'PE', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(166, 'Philippines, The', 'philippines-the', 'PH', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(167, 'Poland', 'poland', 'PL', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(168, 'Portugal', 'portugal', 'PT', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(169, 'Puerto Rico', 'puerto-rico', 'PR', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(170, 'Qatar', 'qatar', 'QA', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(171, 'Reunion, Island Of', 'reunion-island-of', 'RE', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(172, 'Romania', 'romania', 'RO', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(173, 'Russian Federation', 'russian-federation', 'RU', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(174, 'Rwanda', 'rwanda', 'RW', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(175, 'Saint Helena', 'saint-helena', 'SH', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(176, 'Samoa', 'samoa', 'WS', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(177, 'San Marino', 'san-marino', 'SM', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(178, 'Sao Tome And Principe', 'sao-tome-and-principe', 'ST', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(179, 'Saudi Arabia', 'saudi-arabia', 'SA', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(180, 'Senegal', 'senegal', 'SN', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(181, 'Serbia, Rep. Of', 'serbia-rep-of', 'RS', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(182, 'Seychelles', 'seychelles', 'SC', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(183, 'Sierra Leone', 'sierra-leone', 'SL', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(184, 'Singapore', 'singapore', 'SG', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(185, 'Slovakia', 'slovakia', 'SK', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(186, 'Slovenia', 'slovenia', 'SI', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(187, 'Solomon Islands', 'solomon-islands', 'SB', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(188, 'Somalia', 'somalia', 'SO', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(189, 'Somaliland, Rep Of', 'somaliland-rep-of', 'XS', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(190, 'South Africa', 'south-africa', 'ZA', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(191, 'South Sudan', 'south-sudan', 'SS', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(192, 'Spain', 'spain', 'ES', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(193, 'Sri Lanka', 'sri-lanka', 'LK', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(194, 'St. Barthelemy', 'st-barthelemy', 'XY', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(195, 'St. Eustatius', 'st-eustatius', 'XE', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(196, 'St. Kitts', 'st-kitts', 'KN', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(197, 'St. Lucia', 'st-lucia', 'LC', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(198, 'St. Maarten', 'st-maarten', 'XM', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(199, 'St. Vincent', 'st-vincent', 'VC', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(200, 'Sudan', 'sudan', 'SD', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(201, 'Suriname', 'suriname', 'SR', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(202, 'Swaziland', 'swaziland', 'SZ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(203, 'Sweden', 'sweden', 'SE', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(204, 'Switzerland', 'switzerland', 'CH', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(205, 'Syria', 'syria', 'SY', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(206, 'Tahiti', 'tahiti', 'PF', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(207, 'Taiwan', 'taiwan', 'TW', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(208, 'Tajikistan', 'tajikistan', 'TJ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(209, 'Tanzania', 'tanzania', 'TZ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(210, 'Thailand', 'thailand', 'TH', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(211, 'Togo', 'togo', 'TG', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(212, 'Tonga', 'tonga', 'TO', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(213, 'Trinidad And Tobago', 'trinidad-and-tobago', 'TT', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(214, 'Tunisia', 'tunisia', 'TN', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(215, 'Turkey', 'turkey', 'TR', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(216, 'Turkmenistan', 'turkmenistan', 'TM', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(217, 'Turks & Caicos', 'turks-caicos', 'TC', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(218, 'Tuvalu', 'tuvalu', 'TV', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(219, 'Uganda', 'uganda', 'UG', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(220, 'Ukraine', 'ukraine', 'UA', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(221, 'United Kingdom', 'united-kingdom', 'GB', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(222, 'Uruguay', 'uruguay', 'UY', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(223, 'USA', 'usa', 'US', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(224, 'Uzbekistan', 'uzbekistan', 'UZ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(225, 'Vanuatu', 'vanuatu', 'VU', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(226, 'Vatican City', 'vatican-city', 'VA', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(227, 'Venezuela', 'venezuela', 'VE', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(228, 'Vietnam', 'vietnam', 'VN', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(229, 'Virgin Islands-British', 'virgin-islands-british', 'VG', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(230, 'Virgin Islands-US', 'virgin-islands-us', 'VI', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(231, 'Yemen, Rep. Of', 'yemen-rep-of', 'YE', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(232, 'Zambia', 'zambia', 'ZM', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(233, 'Zimbabwe', 'zimbabwe', 'ZW', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(234, 'United Arab Emirates', 'united-arab-emirates', 'AE', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(235, 'Wallis & Futuna', 'wallis-futuna', 'WF', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(236, 'St Maarten fedex', 'st-marten', 'SX', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(237, 'St Martin', 'st-martin', 'MF', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(238, 'Palestine Autonomous', 'palestine-autonomous', 'PS', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(239, 'Curacao fedex', 'curacao-fedex', 'CW', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00'),
(240, 'Bonaire fedex', 'bonaire-fedex', 'BQ', NULL, 'Active', '2021-09-12 17:00:00', '2021-09-12 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_usages`
--

CREATE TABLE `coupon_usages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `use_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_usages`
--

INSERT INTO `coupon_usages` (`id`, `customer_id`, `coupon_code`, `use_status`, `created_at`, `updated_at`) VALUES
(1, 1, '2356', 1, '2022-03-24 16:29:31', '2022-03-24 16:29:31'),
(2, 1, '2222', 1, '2022-03-24 16:53:39', '2022-03-24 16:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_service_areas`
--

CREATE TABLE `delivery_service_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area_name` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `rate` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_service_area_districts`
--

CREATE TABLE `delivery_service_area_districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dist_id` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dist_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `dist_id`, `dist_name`, `en_name`, `province_id`, `created_at`, `updated_at`) VALUES
(1, '09', 'सुनसरी', 'Sunsari', 1, NULL, NULL),
(2, '10', 'मोरङ्ग', 'Morang', 1, NULL, NULL),
(3, '01', 'ताप्लेजुङ्ग', 'Taplejung', 1, NULL, NULL),
(4, '02', 'पाँचथर', 'Pachthar', 1, NULL, NULL),
(5, '03', 'इलाम', 'Illam', 1, NULL, NULL),
(6, '04', 'झापा', 'Jhapa', 1, NULL, NULL),
(7, '05', 'संखुवासभा', 'Sankhuwasabha', 1, NULL, NULL),
(8, '06', 'तेह्रथुम', 'Tehrathum', 1, NULL, NULL),
(9, '07', 'भोजपुर', 'Bhojpur', 1, NULL, NULL),
(10, '08', 'धनकुटा', 'Dhankuta', 1, NULL, NULL),
(11, '11', 'सोलुखम्बु', 'Solukhumbu', 1, NULL, NULL),
(12, '12', 'खोटाङ्ग', 'Khotang', 1, NULL, NULL),
(13, '13', 'उदयपुर', 'Udaypur', 1, NULL, NULL),
(14, '14', 'ओखलढुङ्गा', 'Okhaldhunga', 1, NULL, NULL),
(15, '17', 'धनुषा', 'Dhanusa', 2, NULL, NULL),
(16, '33', 'बारा', 'Bara', 2, NULL, NULL),
(17, '34', 'पर्सा', 'Parsa', 2, NULL, NULL),
(18, '15', 'सप्तरी', 'Saptari', 2, NULL, NULL),
(19, '16', 'सिराहा', 'Siraha', 2, NULL, NULL),
(20, '18', 'महोत्तरी', 'Mohattari', 2, NULL, NULL),
(21, '19', 'सर्लाही', 'Sarlahi', 2, NULL, NULL),
(22, '32', 'रौतहट', 'Rautahat', 2, NULL, NULL),
(23, '27', 'काठमाण्डौं', 'Kathmandu', 3, NULL, NULL),
(24, '28', 'ललितपुर', 'Lalitpur', 3, NULL, NULL),
(25, '35', 'चितवन', 'Chitwan', 3, NULL, NULL),
(26, '31', 'मकवानपुर', 'Makwanpur', 3, NULL, NULL),
(27, '20', 'सिन्धुली', 'Sindhuli', 3, NULL, NULL),
(28, '21', 'रामेछाप', 'Ramechhap', 3, NULL, NULL),
(29, '22', 'दोलखा', 'Dolakha', 3, NULL, NULL),
(30, '23', 'सिन्धुपाल्चोक', 'Sindhupalchowk', 3, NULL, NULL),
(31, '25', 'धादिङ्ग', 'Dhading', 3, NULL, NULL),
(32, '26', 'नुवाकोट', 'Nuwakot', 3, NULL, NULL),
(33, '29', 'भक्तपुर', 'Bhaktapur', 3, NULL, NULL),
(34, '30', 'काभ्रेपलान्चोक', 'Kavrepalanchowk', 3, NULL, NULL),
(35, '24', 'रसुवा', 'Rasuwa', 3, NULL, NULL),
(36, '47', 'कास्की', 'Kaski', 4, NULL, NULL),
(37, '76', 'नवलपरासी (बर्दघाट सुस्ता पूर्व)', 'Nawalparasi( Bardaghat Susta East)', 4, NULL, NULL),
(38, '42', 'स्याङ्गजा', 'Syangja', 4, NULL, NULL),
(39, '43', 'तनहुँ', 'Tanahun', 4, NULL, NULL),
(40, '44', 'गोरखा', 'Gorkha', 4, NULL, NULL),
(41, '46', 'लम्जुङ्ग', 'Lamjung', 4, NULL, NULL),
(42, '48', 'पर्वत', 'Parbat', 4, NULL, NULL),
(43, '49', 'बाग्लुङ्ग', 'Baglung', 4, NULL, NULL),
(44, '50', 'म्याग्दी', 'Myagdi', 4, NULL, NULL),
(45, '45', 'मनाङ', 'Manang', 4, NULL, NULL),
(46, '51', 'मुस्ताङ', 'Mustang', 4, NULL, NULL),
(47, '37', 'रूपन्देही', 'Rupandehi', 5, NULL, NULL),
(48, '60', 'दाङ्ग', 'Dang', 5, NULL, NULL),
(49, '62', 'बाँके', 'Banke', 5, NULL, NULL),
(50, '36', 'नवलपरासी (बर्दघाट सुस्ता पश्चिम)', 'Nawalparasi(Bardghat Susta West)', 5, NULL, NULL),
(51, '38', 'कपिलवस्तु', 'Kapilvastu', 5, NULL, NULL),
(52, '39', 'अर्घाखाँची', 'Arghakhanchi', 5, NULL, NULL),
(53, '40', 'पाल्पा', 'Palpa', 5, NULL, NULL),
(54, '41', 'गुल्मी', 'Gulmi', 5, NULL, NULL),
(55, '58', 'रोल्पा', 'Rolpa', 5, NULL, NULL),
(56, '59', 'प्यूठान', 'Pyuthan', 5, NULL, NULL),
(57, '63', 'बर्दिया', 'Bardiya', 5, NULL, NULL),
(58, '77', 'रूकुम (पूर्व)', 'Rukum(East)', 5, NULL, NULL),
(59, '52', 'मुगु', 'Mugu', 6, NULL, NULL),
(60, '53', 'डोल्पा', 'Dolpa', 6, NULL, NULL),
(61, '55', 'जुम्ला', 'Jumla', 6, NULL, NULL),
(62, '56', 'कालिकोट', 'Kalikot', 6, NULL, NULL),
(63, '57', 'रूकुम (पश्चिम)', 'Rukum( West)', 6, NULL, NULL),
(64, '61', 'सल्यान', 'Salyan', 6, NULL, NULL),
(65, '64', 'सुर्खेत', 'Surkhet', 6, NULL, NULL),
(66, '65', 'जाजरकोट', 'Jajarkot', 6, NULL, NULL),
(67, '66', 'दैलेख', 'Dailekh', 6, NULL, NULL),
(68, '54', 'हुम्ला', 'Humla', 6, NULL, NULL),
(69, '67', 'कैलाली', 'Kailali', 7, NULL, NULL),
(70, '68', 'डोटी', 'Doti', 7, NULL, NULL),
(71, '69', 'आछाम', 'Achham', 7, NULL, NULL),
(72, '70', 'बाजुरा', 'Bajura', 7, NULL, NULL),
(73, '71', 'बझाङ', 'Bajhang', 7, NULL, NULL),
(74, '72', 'दार्चुला', 'Darchula', 7, NULL, NULL),
(75, '73', 'बैतडी', 'Baitadi', 7, NULL, NULL),
(76, '74', 'डडेलधुरा', 'Dadeldhura', 7, NULL, NULL),
(77, '75', 'कञ्चनपुर', 'Kanchanpur', 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flash_sales`
--

CREATE TABLE `flash_sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL,
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `totalStock` bigint(20) NOT NULL,
  `soldStock` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_10_25_104143_create_permission_tables', 1),
(10, '2019_11_13_173545_create_admins_table', 1),
(11, '2019_11_20_060909_create_settings_table', 1),
(12, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(13, '2020_03_23_120856_create_subscribers_table', 1),
(14, '2020_03_23_120916_create_categories_table', 1),
(15, '2020_03_23_120946_create_customers_table', 1),
(16, '2020_03_27_045428_create_sellers_table', 1),
(17, '2020_03_27_122410_create_photos_table', 1),
(18, '2020_03_30_135254_create_sliders_table', 1),
(19, '2020_04_01_082914_create_products_table', 1),
(20, '2020_04_02_104620_create_news_categories_table', 1),
(21, '2020_04_02_105038_create_news_table', 1),
(22, '2020_04_02_105050_create_news_newscategory', 1),
(23, '2020_04_02_130330_create_writers_table', 1),
(24, '2020_04_02_134122_create_news_writer_table', 1),
(25, '2020_04_07_075119_create_orders_table', 1),
(26, '2020_04_07_075229_create_payments_table', 1),
(27, '2020_04_08_181600_create_tags_table', 1),
(28, '2020_04_08_184132_create_news_tag_table', 1),
(29, '2020_04_09_101113_create_contents_table', 1),
(30, '2020_04_12_095121_create_content_product_table', 1),
(31, '2020_04_15_122742_create_wishlists_table', 1),
(32, '2020_04_19_044148_create_product_staff_seller_table', 1),
(33, '2020_04_20_204031_create_contacts_table', 1),
(34, '2020_04_21_110147_create_reviews_table', 1),
(35, '2020_04_22_151249_create_advertisements_table', 1),
(36, '2020_04_23_134333_create_coupons_table', 1),
(37, '2020_04_30_090447_create_deliveries_table', 1),
(38, '2020_05_04_161409_create_ime_settings_table', 1),
(39, '2020_05_05_110859_create_seller_add_product_notifications_table', 1),
(40, '2020_05_07_130232_create_delivery_delivery_settings_table', 1),
(41, '2020_05_10_143042_create_favourites_table', 1),
(42, '2020_05_14_114107_create_referrals_table', 1),
(43, '2020_05_18_173535_create_measures_table', 1),
(44, '2020_05_19_151038_create_delivery_assigns_table', 1),
(45, '2020_05_20_141856_create_order_delivery_staff_table', 1),
(46, '2020_05_25_155913_create_notifications_table', 1),
(47, '2020_05_26_145347_create_messages_table', 1),
(48, '2020_05_27_124235_create_push_notifications_table', 1),
(49, '2020_05_31_120212_create_delivery_settings_table', 1),
(50, '2020_05_31_130754_create_stocks_table', 1),
(51, '2020_06_02_131048_create_update_payments_table', 1),
(52, '2020_06_02_131110_create_update_orders_table', 1),
(53, '2020_06_14_121006_create_transaction_overviews_table', 1),
(54, '2020_06_15_154512_create_sales_returns_table', 1),
(55, '2020_06_16_173321_create_return_transaction_overviews_table', 1),
(56, '2020_06_17_130806_create_statements_table', 1),
(57, '2020_06_25_160332_create_affiliates_table', 1),
(58, '2020_06_29_154541_create_affiliate_transaction_overviews_table', 1),
(59, '2020_06_30_171501_create_affiliate_statements_table', 1),
(60, '2020_07_06_105122_create_affiliate_return_transaction_overviews_table', 1),
(61, '2020_07_07_181359_create_brands_table', 1),
(62, '2020_07_21_133746_create_order_cancels_table', 1),
(63, '2021_10_31_073900_create_flash_sales_table', 1),
(64, '2021_11_02_044504_delivery_type', 1),
(65, '2021_11_02_064104_add_fb_id_column_in_customers_table', 1),
(66, '2021_11_02_065243_add_express_charge', 1),
(67, '2021_11_02_092447_add_google_id_column_in_customers_table', 1),
(68, '2021_12_13_153926_create_countries_table', 1),
(69, '2021_12_20_104600_create_provinces_table', 1),
(70, '2021_12_20_104611_create_districts_table', 1),
(71, '2021_12_20_111708_create_delivery_service_areas_table', 1),
(72, '2021_12_20_112209_create_delivery_service_area_districts_table', 1),
(73, '2022_01_05_131905_create_coupon_usages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news_news_category`
--

CREATE TABLE `news_news_category` (
  `news_news_category_id` bigint(20) UNSIGNED NOT NULL,
  `news_category_id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_tag`
--

CREATE TABLE `news_tag` (
  `news_tag_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news_writer`
--

CREATE TABLE `news_writer` (
  `news_writer_id` bigint(20) UNSIGNED NOT NULL,
  `writer_id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_delivery_staff`
--

CREATE TABLE `order_delivery_staff` (
  `order_delivery_staff_id` bigint(20) UNSIGNED NOT NULL,
  `ref_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('shriyamhrzn22@gmail.com', '$2y$10$4ebkA6e5wDQYPcEBI4yGeuNAs7K2J4ZQuqv1dsahk7qBGSg5XM.Rq', '2022-03-25 16:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_content', 'admin', 'tbl_contents', NULL, NULL),
(2, 'create_content', 'admin', 'tbl_contents', NULL, NULL),
(3, 'read_content', 'admin', 'tbl_contents', NULL, NULL),
(4, 'update_content', 'admin', 'tbl_contents', NULL, NULL),
(5, 'delete_content', 'admin', 'tbl_contents', NULL, NULL),
(6, 'browse_role', 'admin', 'tbl_roles', NULL, NULL),
(7, 'create_role', 'admin', 'tbl_roles', NULL, NULL),
(8, 'read_role', 'admin', 'tbl_roles', NULL, NULL),
(9, 'update_role', 'admin', 'tbl_roles', NULL, NULL),
(10, 'delete_role', 'admin', 'tbl_roles', NULL, NULL),
(11, 'browse_admin', 'admin', 'tbl_admins', NULL, NULL),
(12, 'create_admin', 'admin', 'tbl_admins', NULL, NULL),
(13, 'read_admin', 'admin', 'tbl_admins', NULL, NULL),
(14, 'update_admin', 'admin', 'tbl_admins', NULL, NULL),
(15, 'delete_admin', 'admin', 'tbl_admins', NULL, NULL),
(16, 'browse_seller', 'admin', 'tbl_sellers', NULL, NULL),
(17, 'create_seller', 'admin', 'tbl_sellers', NULL, NULL),
(18, 'read_seller', 'admin', 'tbl_sellers', NULL, NULL),
(19, 'update_seller', 'admin', 'tbl_sellers', NULL, NULL),
(20, 'delete_seller', 'admin', 'tbl_sellers', NULL, NULL),
(21, 'browse_slider', 'admin', 'tbl_sliders', NULL, NULL),
(22, 'create_slider', 'admin', 'tbl_sliders', NULL, NULL),
(23, 'read_slider', 'admin', 'tbl_sliders', NULL, NULL),
(24, 'update_slider', 'admin', 'tbl_sliders', NULL, NULL),
(25, 'delete_slider', 'admin', 'tbl_sliders', NULL, NULL),
(26, 'browse_child_category', 'admin', 'tbl_child_categories', NULL, NULL),
(27, 'create_child_category', 'admin', 'tbl_child_categories', NULL, NULL),
(28, 'read_child_category', 'admin', 'tbl_child_categories', NULL, NULL),
(29, 'update_child_category', 'admin', 'tbl_child_categories', NULL, NULL),
(30, 'delete_child_category', 'admin', 'tbl_child_categories', NULL, NULL),
(31, 'browse_category', 'admin', 'tbl_categories', NULL, NULL),
(32, 'create_category', 'admin', 'tbl_categories', NULL, NULL),
(33, 'read_category', 'admin', 'tbl_categories', NULL, NULL),
(34, 'update_category', 'admin', 'tbl_categories', NULL, NULL),
(35, 'delete_category', 'admin', 'tbl_categories', NULL, NULL),
(36, 'browse_sub_category', 'admin', 'tbl_sub_categories', NULL, NULL),
(37, 'create_sub_category', 'admin', 'tbl_sub_categories', NULL, NULL),
(38, 'read_sub_category', 'admin', 'tbl_sub_categories', NULL, NULL),
(39, 'update_sub_category', 'admin', 'tbl_sub_categories', NULL, NULL),
(40, 'delete_sub_category', 'admin', 'tbl_sub_categories', NULL, NULL),
(41, 'browse_product', 'admin', 'tbl_products', NULL, NULL),
(42, 'create_product', 'admin', 'tbl_products', NULL, NULL),
(43, 'read_product', 'admin', 'tbl_products', NULL, NULL),
(44, 'update_product', 'admin', 'tbl_products', NULL, NULL),
(45, 'delete_product', 'admin', 'tbl_products', NULL, NULL),
(46, 'browse_setting', 'admin', 'tbl_settings', NULL, NULL),
(47, 'create_setting', 'admin', 'tbl_settings', NULL, NULL),
(48, 'read_setting', 'admin', 'tbl_settings', NULL, NULL),
(49, 'update_setting', 'admin', 'tbl_settings', NULL, NULL),
(50, 'delete_setting', 'admin', 'tbl_settings', NULL, NULL),
(51, 'browse_news', 'admin', 'tbl_news', NULL, NULL),
(52, 'create_news', 'admin', 'tbl_news', NULL, NULL),
(53, 'read_news', 'admin', 'tbl_news', NULL, NULL),
(54, 'update_news', 'admin', 'tbl_news', NULL, NULL),
(55, 'delete_news', 'admin', 'tbl_news', NULL, NULL),
(56, 'browse_news_category', 'admin', 'tbl_news_categories', NULL, NULL),
(57, 'create_news_category', 'admin', 'tbl_news_categories', NULL, NULL),
(58, 'read_news_category', 'admin', 'tbl_news_categories', NULL, NULL),
(59, 'update_news_category', 'admin', 'tbl_news_categories', NULL, NULL),
(60, 'delete_news_category', 'admin', 'tbl_news_categories', NULL, NULL),
(61, 'browse_delivery', 'admin', 'tbl_deliveries', NULL, NULL),
(62, 'create_delivery', 'admin', 'tbl_deliveries', NULL, NULL),
(63, 'read_delivery', 'admin', 'tbl_deliveries', NULL, NULL),
(64, 'update_delivery', 'admin', 'tbl_deliveries', NULL, NULL),
(65, 'delete_delivery', 'admin', 'tbl_deliveries', NULL, NULL),
(66, 'browse_customer', 'admin', 'tbl_customers', NULL, NULL),
(67, 'create_customer', 'admin', 'tbl_customers', NULL, NULL),
(68, 'read_customer', 'admin', 'tbl_customers', NULL, NULL),
(69, 'update_customer', 'admin', 'tbl_customers', NULL, NULL),
(70, 'delete_customer', 'admin', 'tbl_customers', NULL, NULL),
(71, 'browse_affiliate', 'admin', 'tbl_affiliates', NULL, NULL),
(72, 'create_affiliate', 'admin', 'tbl_affiliates', NULL, NULL),
(73, 'read_affiliate', 'admin', 'tbl_affiliates', NULL, NULL),
(74, 'update_affiliate', 'admin', 'tbl_affiliates', NULL, NULL),
(75, 'delete_affiliate', 'admin', 'tbl_affiliates', NULL, NULL),
(76, 'browse_coupon', 'admin', 'tbl_coupons', NULL, NULL),
(77, 'create_coupon', 'admin', 'tbl_coupons', NULL, NULL),
(78, 'read_coupon', 'admin', 'tbl_coupons', NULL, NULL),
(79, 'update_coupon', 'admin', 'tbl_coupons', NULL, NULL),
(80, 'delete_coupon', 'admin', 'tbl_coupons', NULL, NULL),
(81, 'browse_advertisement', 'admin', 'tbl_advertisements', NULL, NULL),
(82, 'create_advertisement', 'admin', 'tbl_advertisements', NULL, NULL),
(83, 'read_advertisement', 'admin', 'tbl_advertisements', NULL, NULL),
(84, 'update_advertisement', 'admin', 'tbl_advertisements', NULL, NULL),
(85, 'delete_advertisement', 'admin', 'tbl_advertisements', NULL, NULL),
(86, 'browse_delivery_setting', 'admin', 'tbl_delivery_settings', NULL, NULL),
(87, 'create_delivery_setting', 'admin', 'tbl_delivery_settings', NULL, NULL),
(88, 'read_delivery_setting', 'admin', 'tbl_delivery_settings', NULL, NULL),
(89, 'update_delivery_setting', 'admin', 'tbl_delivery_settings', NULL, NULL),
(90, 'delete_delivery_setting', 'admin', 'tbl_delivery_settings', NULL, NULL),
(91, 'browse_brand', 'admin', 'tbl_brands', NULL, NULL),
(92, 'create_brand', 'admin', 'tbl_brands', NULL, NULL),
(93, 'read_brand', 'admin', 'tbl_brands', NULL, NULL),
(94, 'update_brand', 'admin', 'tbl_brands', NULL, NULL),
(95, 'delete_brand', 'admin', 'tbl_brands', NULL, NULL),
(96, 'browse_push_notification', 'admin', 'tbl_push_notifications', NULL, NULL),
(97, 'create_push_notification', 'admin', 'tbl_push_notifications', NULL, NULL),
(98, 'read_push_notification', 'admin', 'tbl_push_notifications', NULL, NULL),
(99, 'update_push_notification', 'admin', 'tbl_push_notifications', NULL, NULL),
(100, 'delete_push_notification', 'admin', 'tbl_push_notifications', NULL, NULL),
(101, 'browse_sales_return', 'admin', 'tbl_sales_returns', NULL, NULL),
(102, 'create_sales_return', 'admin', 'tbl_sales_returns', NULL, NULL),
(103, 'read_sales_return', 'admin', 'tbl_sales_returns', NULL, NULL),
(104, 'update_sales_return', 'admin', 'tbl_sales_returns', NULL, NULL),
(105, 'delete_sales_return', 'admin', 'tbl_sales_returns', NULL, NULL),
(106, 'browse_statement', 'admin', 'tbl_statements', NULL, NULL),
(107, 'create_statement', 'admin', 'tbl_statements', NULL, NULL),
(108, 'read_statement', 'admin', 'tbl_statements', NULL, NULL),
(109, 'update_statement', 'admin', 'tbl_statements', NULL, NULL),
(110, 'delete_statement', 'admin', 'tbl_statements', NULL, NULL),
(111, 'browse_affiliate_statement', 'admin', 'tbl_affiliate_statements', NULL, NULL),
(112, 'create_affiliate_statement', 'admin', 'tbl_affiliate_statements', NULL, NULL),
(113, 'read_affiliate_statement', 'admin', 'tbl_affiliate_statements', NULL, NULL),
(114, 'update_affiliate_statement', 'admin', 'tbl_affiliate_statements', NULL, NULL),
(115, 'delete_affiliate_statement', 'admin', 'tbl_affiliate_statements', NULL, NULL),
(116, 'browse_flash_sale', 'admin', 'tbl_flash_sales', NULL, NULL),
(117, 'create_flash_sale', 'admin', 'tbl_flash_sales', NULL, NULL),
(118, 'read_flash_sale', 'admin', 'tbl_flash_sales', NULL, NULL),
(119, 'update_flash_sale', 'admin', 'tbl_flash_sales', NULL, NULL),
(120, 'delete_flash_sale', 'admin', 'tbl_flash_sales', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_staff_seller`
--

CREATE TABLE `product_staff_seller` (
  `product_staff_seller_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `np_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eng_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `np_name`, `eng_name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Province 1', '1', NULL, NULL, NULL),
(2, NULL, 'Province 2', '1', NULL, NULL, NULL),
(3, NULL, 'Bagmati', '1', NULL, NULL, NULL),
(4, NULL, 'Gandaki', '1', NULL, NULL, NULL),
(5, NULL, 'Province 5', '1', NULL, NULL, NULL),
(6, NULL, 'Karnali', '1', NULL, NULL, NULL),
(7, NULL, 'Province 7', '1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin', '2022-01-12 17:09:20', '2022-01-12 17:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE `tbl_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`id`, `name`, `username`, `email`, `password`, `image`, `publish_status`, `delete_status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nectar Digit', 'nectardigit', 'nectardigit@gmail.com', '$2y$10$ezsjDNJbW/CRYXOQq9t59ufFpis9yFtZKkrxKcA4rExGqX6ga5Ewi', NULL, '1', '0', NULL, '2022-01-12 17:09:20', '2022-01-12 17:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advertisements`
--

CREATE TABLE `tbl_advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placement` enum('plain-text','mid-left','mid-right','full-width','deal-ad','google-play') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `featured` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_advertisements`
--

INSERT INTO `tbl_advertisements` (`id`, `title`, `body`, `link`, `image`, `placement`, `publish_status`, `delete_status`, `featured`, `created_at`, `updated_at`) VALUES
(1, 'Best Deal', '<p>Best Deal For you to get clasic Khukuri</p>', NULL, NULL, 'plain-text', '1', '0', '1', '2022-01-12 23:35:26', '2022-01-12 23:35:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_affiliates`
--

CREATE TABLE `tbl_affiliates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `affiliate_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `activation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_acc_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `publish_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_otp` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_affiliate_return_transaction_overviews`
--

CREATE TABLE `tbl_affiliate_return_transaction_overviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `affiliate_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `transaction_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `amount` double DEFAULT NULL,
  `statement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_affiliate_statements`
--

CREATE TABLE `tbl_affiliate_statements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `affiliate_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `opening_balance` double DEFAULT '0',
  `closing_balance` double DEFAULT '0',
  `paid_balance` double DEFAULT '0',
  `commission_earned` double DEFAULT '0',
  `commission_refund` double DEFAULT '0',
  `payout` double DEFAULT '0',
  `paid_status` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `publish_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `delete_status` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_affiliate_transaction_overviews`
--

CREATE TABLE `tbl_affiliate_transaction_overviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `affiliate_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `transaction_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `amount` double DEFAULT NULL,
  `statement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brands`
--

CREATE TABLE `tbl_brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `featured` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` text COLLATE utf8mb4_unicode_ci,
  `view_count` bigint(20) DEFAULT NULL,
  `show_on_home` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `placement` enum('none','first','second','third') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `hot_best_sellers` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `hot_new_arrivals` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `publish_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `category_name`, `category_slug`, `category_id`, `position`, `featured`, `image`, `banner_image`, `category_icon`, `alt`, `view_count`, `show_on_home`, `placement`, `hot_best_sellers`, `hot_new_arrivals`, `publish_status`, `delete_status`, `meta_title`, `meta_keyword`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'Category', 'category', 0, 1, '1', 'parent-category1641975475.png', 'banner-category-1641975495.png', 'category-icon-1641975495.png', NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-01-12 20:03:15', '2022-07-16 14:23:39'),
(3, 'Chira Custom khukuri', 'chira-custom-khukuri', 1, 4, '1', 'parent-category1641983325.png', 'banner-category-1641983358.png', 'category-icon-1641983359.png', NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-01-12 22:14:19', '2022-07-16 05:12:30'),
(4, 'hunting Sirupate Khukuri', 'hunting-sirupate-khukuri', 1, 5, '1', 'parent-category1641986841.jpg', 'banner-category-1641986874.jpg', 'category-icon-1641986874.jpg', NULL, NULL, '1', 'second', '1', '1', '1', '0', NULL, NULL, NULL, '2022-01-12 23:12:54', '2022-07-16 05:12:35'),
(5, 'Service Griper', 'service-griper', 1, 2, '1', 'parent-category1642141462.png', 'banner-category-1642141489.png', 'category-icon-1642141489.png', NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-01-14 18:09:50', '2022-07-16 18:38:59'),
(6, 'Panawal Khukuri', 'panawal-khukuri', 1, 3, '1', 'parent-category1642146801.png', 'banner-category-1642146811.png', 'category-icon-1642146812.png', NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-01-14 19:38:32', '2022-07-16 05:19:01'),
(7, 'American Eagle Handle', 'american-eagle-handle', 1, NULL, '1', 'parent-category1642147158.png', 'banner-category-1642147187.png', 'category-icon-1642147187.png', NULL, NULL, '1', 'none', '0', '0', '1', '1', NULL, NULL, NULL, '2022-01-14 19:44:47', '2022-04-08 20:52:09'),
(8, 'test', 'test', 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, '0', 'none', '0', '0', '0', '1', NULL, NULL, NULL, '2022-01-14 19:52:49', '2022-04-08 20:52:09'),
(9, 'Afgan Khukuri', 'afgan-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-01-14 21:13:28', '2022-07-16 05:11:50'),
(10, 'Katle Khukuri', 'katle-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-01-14 21:15:12', '2022-07-16 05:11:47'),
(11, 'Iraqi Griper Block Handle Khukuri', 'iraqi-griper-block-handle-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-01-14 21:16:34', '2022-07-16 05:11:52'),
(12, 'Kopis Knife Custom', 'kopis-knife-custom', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-01-14 21:17:55', '2022-07-16 05:11:56'),
(13, '13\'\' Jung Bahadur Khukuri', '13-jung-bahadur-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-01-14 22:34:57', '2022-07-16 05:11:57'),
(14, 'Eagle Hunting Sirupate Khukuri', 'eagle-hunting-sirupate-khukuri', 1, 7, '1', 'parent-category1645093913.jpg', 'banner-category-1645094041.jpg', 'category-icon-1645094041.jpg', NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-02-17 22:19:01', '2022-07-16 05:12:32'),
(15, 'Service No 1 Khukuri', 'service-no-1-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '0', '1', '0', NULL, NULL, NULL, '2022-03-11 17:06:56', '2022-07-16 14:08:03'),
(16, 'Hunting Sirupate Khukuri', 'hunting-sirupate-khukuri', 1, NULL, '0', NULL, NULL, NULL, NULL, NULL, '0', 'none', '0', '0', '1', '0', NULL, NULL, NULL, '2022-03-11 17:15:13', '2022-04-08 20:52:09'),
(17, 'Sirupate Traditional Khukuri', 'sirupate-traditional-khukuri', 1, NULL, '0', NULL, NULL, NULL, NULL, NULL, '0', 'none', '0', '0', '1', '0', NULL, NULL, NULL, '2022-03-11 23:31:52', '2022-07-16 05:12:37'),
(18, 'Ganjawal Khukuri', 'ganjawal-khukuri', 1, NULL, '0', NULL, NULL, NULL, NULL, NULL, '0', 'none', '0', '0', '1', '0', NULL, NULL, NULL, '2022-03-13 18:04:18', '2022-07-16 05:12:40'),
(19, 'Dhankute Khukuri', 'dhankute-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '0', '0', '1', '0', NULL, NULL, NULL, '2022-03-13 18:25:06', '2022-07-16 05:12:02'),
(20, 'Custom Survival Khukuri', 'custom-survival-khukuri', 1, NULL, '0', NULL, NULL, NULL, NULL, NULL, '0', 'none', '0', '0', '1', '0', NULL, NULL, NULL, '2022-03-13 18:53:10', '2022-07-16 05:12:41'),
(21, 'Historic Budune Khukuri', 'historic-budune-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '0', 'none', '0', '0', '1', '0', NULL, NULL, NULL, '2022-03-13 21:40:37', '2022-07-16 05:12:41'),
(22, 'Chira Tradition Khukuri', 'chira-tradition-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '0', 'none', '0', '0', '1', '0', NULL, NULL, NULL, '2022-03-13 21:44:02', '2022-07-16 05:12:42'),
(23, 'Eagle Inchury Chukuri Khukuri', 'eagle-inchury-chukuri-khukuri', 1, NULL, '0', NULL, NULL, NULL, NULL, NULL, '0', 'none', '0', '0', '1', '0', NULL, NULL, NULL, '2022-03-14 19:50:38', '2022-07-16 05:12:43'),
(24, 'American Eagle Khukuri', 'american-eagle-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '0', '0', '1', '0', NULL, NULL, NULL, '2022-03-31 20:56:28', '2022-07-16 05:12:02'),
(25, 'Aang Khola Khukuri', 'aang-khola-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '0', '0', '1', '0', NULL, NULL, NULL, '2022-03-31 20:59:56', '2022-07-16 05:12:03'),
(26, 'Charauke Khukuri', 'charauke-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-03-31 21:02:25', '2022-07-16 05:12:02'),
(27, 'Book of Eli Knife', 'book-of-eli-knife', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '0', '0', '1', '0', NULL, NULL, NULL, '2022-03-31 21:02:52', '2022-07-16 05:12:03'),
(28, 'Balance Khukuri', 'balance-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '0', '0', '1', '1', NULL, NULL, NULL, '2022-04-01 16:06:44', '2022-04-08 20:52:09'),
(29, 'Balance Khukuri', 'balance-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '0', '0', '1', '0', NULL, NULL, NULL, '2022-04-01 16:06:44', '2022-07-16 05:12:07'),
(30, 'Ceremonial Khukuri', 'ceremonial-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '0', '0', '1', '0', NULL, NULL, NULL, '2022-04-01 16:12:16', '2022-07-16 05:12:07'),
(31, 'Ceremonial Khukuri', 'ceremonial-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '0', '0', '1', '1', NULL, NULL, NULL, '2022-04-01 16:12:16', '2022-04-08 20:52:09'),
(32, 'American Eagle Dragon Khukuri', 'american-eagle-dragon-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-04-01 17:23:05', '2022-07-16 05:12:07'),
(33, 'Itihas Khukuri', 'itihas-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-04-03 15:08:31', '2022-07-16 05:12:08'),
(34, 'Iraq Khukuri', 'iraq-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-04-03 16:16:36', '2022-07-16 05:12:11'),
(35, 'Afgan Khkuri', 'afgan-khkuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-04-03 16:20:29', '2022-07-16 05:12:11'),
(36, 'Nepal Police Khukuri', 'nepal-police-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-04-03 16:24:55', '2022-07-16 05:12:14'),
(37, 'Farmer Khukuri', 'farmer-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-04-03 17:23:33', '2022-07-16 05:12:15'),
(38, 'Bowie knife', 'bowie-knife', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-04-03 17:43:14', '2022-07-16 14:39:51'),
(39, 'Chukuri', 'chukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-04-03 20:44:07', '2022-07-16 14:07:00'),
(40, 'Chukuri', 'chukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '1', NULL, NULL, NULL, '2022-04-03 20:44:08', '2022-04-08 20:52:09'),
(41, '3 Chira Khukuri', '3-chira-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-04-03 20:53:43', '2022-07-16 05:12:21'),
(42, 'Paper Knife', 'paper-knife', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-04-04 17:36:23', '2022-07-16 14:06:51'),
(43, 'Handmade Stone Set Jungle Khukuri', 'handmade-stone-set-jungle-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-04-04 18:06:41', '2022-07-16 05:12:24'),
(44, 'Sirupate Khukuri', 'sirupate-khukuri', 1, NULL, '1', NULL, NULL, NULL, NULL, NULL, '1', 'none', '1', '1', '1', '0', NULL, NULL, NULL, '2022-04-05 21:57:32', '2022-07-16 05:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contacts`
--

CREATE TABLE `tbl_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contents`
--

CREATE TABLE `tbl_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_type` enum('none','about','news','service','service-icon','service-selected','contact','team','brand','category','product','faq','page','gallery','video','testimonial') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_body` text COLLATE utf8mb4_unicode_ci,
  `external_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `position` int(11) NOT NULL DEFAULT '1',
  `featured_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `show_on_menu` enum('H','F','B','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_contents`
--

INSERT INTO `tbl_contents` (`id`, `content_title`, `content_url`, `content_type`, `content_icon`, `content_body`, `external_link`, `parent_id`, `position`, `featured_img`, `publish_status`, `delete_status`, `show_on_menu`, `meta_title`, `meta_keyword`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'About us', 'about-us', 'about', NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The Ex Gurkha Khukuri House (TEGKH) was established in 2010. Situated in Lazimpat, though being relatively new we are one of the renowned Khukuri shops in Kathmandu. Not only that, but we&rsquo;ve also made respectable reputation for being the best manufacturer as well as exporters of genuine Khukuris. We&rsquo;ve come up with many unique and custom made Khukuris. We have created various new custom made Khukuris. Within the short period of time, we have impressed our customers and maintained the standard and the genuine quality of our Khukuris. Our main motto is customer satisfaction. We sell Genuine and authentic Khukuris.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>', NULL, 0, 1, 'feature1642141168.png', '1', '0', 'B', NULL, NULL, NULL, '2022-01-12 19:58:37', '2022-04-22 20:09:01'),
(2, 'Khukuri info', 'khukuri-info', 'about', NULL, NULL, NULL, 0, 2, 'feature1641984403.jpg', '1', '0', 'H', NULL, NULL, NULL, '2022-01-12 22:32:06', '2022-01-13 17:15:52'),
(3, 'KHUKURI MAINTAINANCE', 'khukuri-maintainance', 'about', NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Khukuri </span></span><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">is regarded as the traditional knife in Nepal which is a basic and simple knife tool that is used for cutting purposes by different farmers and&nbsp;people in Nepal. It requires almost no skills to use or handle. It is used by many farmers in the villages of Nepal. It has traditional values in Nepal. It is used by armies in Nepal as well as by the British armies. It also has a historical value. It was used by Gurkha Armies in World War II. There are different types of khukuri found in Nepal. Some of them are found classical where some have modern looks. Although it is easy to use, you should be careful when you use it because they are sharp and can hurt you accidentally. These khukuris should be maintained and repaired time and again as they are used. Khukuris should be handled and maintained in the following ways:</span></span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Apply&nbsp;machine or motor oil&nbsp;on the blade once a month and also, if possible, every time after use and do not leave fingerprints on the blade.</span></span></span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Incase rust develops, first clean the blade with some petrol/gasoline then rub the rust off with fine sandpaper; wipe it off by a clean cloth and apply oil. A buff machine may be used to re-shine the rust infected area.</span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Before displaying, you can scrub the carved blade by the hand brush which is soaked in petrol, and then wipe it with a clean cloth.</span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">You can use&nbsp;shoe polish for the leather sheath, wax for wood, brass polish for the brass fittings, and silver polish for the silver once after use to make your khukuri look better.</span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">For the sharpening purpose, you can use&nbsp;sharpening stones&nbsp;for faster and better results.</span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">After the use of khukuri, it may get dirty. You should be sure to clean the dirt that is picked up by the blade&rsquo;s surface with the dry cloth and keep it away from the water and moist to avoid rusting.</span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">When the khukuri is not in use for a long period, you can apply oil to the blade and wrap it in a plastic or polythene bag and keep it out&nbsp;of the scabbard. You can also do the same for the small knives.</span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">You should always store the khukuri in a dry and normal place.</span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">There are some cautions that you should avoid while using khukuri.</span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Care should be taken and you should not expose the scabbard into the sun for a long time as the heating may cause the&nbsp;<a href=\"https://www.thegurkhakhukuri.com/\" style=\"color:blue; text-decoration:underline\"><span style=\"color:black\">khukuri</span></a>&nbsp;to shrink and make the blade difficult to draw-in draw-out.</span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">You should avoid the khukuri use on the metallic surface.</span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">You should keep the khukuri away from the water, moist, and the fingerprints.</span></span></span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:48px; text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Caution</span></span></span></strong></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Your Khukuri is a dangerous weapon and should be treated as such. Please use them with caution and care. Keep your Khukuri away from minors. Avoid the blade from metallic surfaces and stones etc. Do not expose the scabbard to the sun for a long period of time as heating may help it to shrink a bit and hence making the blade difficult to insert.</span></span></span></span></span></p>', NULL, 2, 10, 'feature1641984851.jpg', '1', '0', 'F', NULL, NULL, NULL, '2022-01-12 22:39:20', '2022-04-22 21:11:12'),
(4, 'PARTS OF THE KHUKURI', 'parts-of-the-khukuri', 'about', NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Blade</span></span></span></strong></span></span></span></p>\r\n\r\n<ul style=\"list-style-type:circle\">\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Keeper (<em>Hira Jornu</em>): Spade/diamond shaped metal/brass plate used to seal the butt cap.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Butt Cap (<em>Chapri</em>): Thick metal/brass plate used to secure the handle to the tang.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Tang (<em>Paro</em>): Rear piece of the blade that goes through the handle.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Bolster (<em>Kanjo</em>): Thick metal/brass round shaped plate between blade and handle made to support and reinforce the fixture.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Spine (<em>Beet</em>): Thickest blunt edge of the blade.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Fuller/Groove (<em>Khol</em>): Straight groove or deep line that runs along part of the upper spine.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Peak (<em>Juro</em>): Highest point of the blade.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Main body (<em>Ang</em>): Main surface or panel of the blade.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Fuller (<em>Chirra</em>): Curvature/hump in the blade made to absorb impact and to reduce unnecessary weight.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Tip (<em>Toppa</em>): The starting point of the blade.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Edge (<em>Dhaar</em>): Sharp edge of the blade.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Belly (<em>Bhundi</em>): Widest part/area of the blade.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Bevel (<em>Patti</em>): Slope from the main body until the sharp edge.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Notch (<em>Cho</em>): A distinctive cut (numeric &#39;3 &#39;-like shape) in the edge. Used as a stopper when sharpening with the chakmak.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Ricasso (<em>Ghari</em>): Blunt area between the notch and bolster.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Rings (<em>Harhari</em>): Round circles in the handle.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Rivet (<em>Khil</em>): Steel or metal bolt to fasten or secure tang to the handle.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Tang Tail (<em>Puchchar</em>): Last point of the kukri blade.</span></span></span></span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:14.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Scabbard</span></span></span></strong></span></span></span></p>\r\n\r\n<ul style=\"list-style-type:circle\">\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Frog (<em>Faras</em>): Belt holder specially made of thick leather (2 mm to 4&nbsp; mm) encircling the scabbard close towards the throat.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Upper Edge (<em>Mathillo Bhaag</em>): Spine of the scabbard where holding should be done when handling a kukri.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Lace (<em>Tuna</em>): A leather cord used to sew or attach two ends of the frog. Especially used in army types.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Main Body (<em>Sharir</em>): The main body or surface of the scabbard. Generally made in semi oval shape.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Chape (<em>Khothi</em>): Pointed metallic tip of the scabbard. Used to protect the naked tip of a scabbard.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Loop (<em>Golie</em>): Round leather room/space where a belt goes through attached/fixed to the keeper with steel rivets.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Throat (<em>Mauri</em>): Entrance towards the interior of the scabbard for the blade.</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Strap/Ridge (<em>Bhunti</em>): Thick raw leather encircling the scabbard made to create a hump to secure the frog from moving or wobbling (not available in this pic).</span></span></span></span></span></span></li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Lower Edge (<em>Tallo Bhag</em>): Belly/curvature of the scabbard.</span></span></span></span></span></span></li>\r\n</ul>', NULL, 2, 12, 'feature1648108004.jpg', '1', '0', 'F', NULL, NULL, NULL, '2022-01-12 22:47:47', '2022-04-22 21:12:46'),
(5, 'Contact', 'contact', 'about', NULL, '<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Nepal: </span></span></span></p>\r\n\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Hotel Marg, Hotel Radisson, Lazimpat</span></span></span></p>\r\n\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Kathmandu, Nepal</span></span></span></p>\r\n\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">+977 9855 083554</span></span></span></p>\r\n			</td>\r\n			<td>\r\n			<p>&nbsp;</p>\r\n\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">UK: </span></span></span></p>\r\n\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">103a The Broadway Southall, </span></span></span></p>\r\n\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">London UB1 1LN </span></span></span></p>\r\n\r\n			<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">+44 7969 273 976</span></span></span></p>\r\n\r\n			<p>theexgurkha@gmail.com</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>', NULL, 0, 9, NULL, '1', '0', 'B', NULL, NULL, NULL, '2022-01-14 18:06:46', '2022-04-28 16:52:56'),
(6, 'TEGKH Policy', 'tegkh-policy', 'about', NULL, '<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Privacy Policy:</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">We respect the privacy of our customer.&nbsp;The security and protection of our customers&#39; personal information is our top priority and is especially important in our business of fine products.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The personal information we collect from our site: -</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">We require your personally identifiable information like name, address, email address and/or telephone numbers etc. in order to be in touch with you. </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Price policy:</span></span></strong><br />\r\n<span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">TEGKH products prices are revised annually depending on the current market&rsquo;s rates, assessment, circumstances and calculation. </span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Insurance policy:</span></span></strong><br />\r\n<span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">All products are insured and a buyer is illegible for compensation under legal policies act put up by TEGKH&nbsp;and our forwarding partners. If by any chances we completely fail to deliver a product within estimated given period of time, we will refund the amount; if an order is mistakenly sent to another address than the destination provided by the buyer, we will resend the order. In cases like theft, robbery, accident or lost before reaching the buyer, we will resend the order. However, in cases like minor damage in the product or buyer&rsquo;s negligence causing damage to the product, we will not be held responsible. Insurance policy does not cover such cases.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Satisfactions Guarantee</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">You must be 100% satisfied in your every purchase. If not, you can return the products within 15 days of receipt for a full refund or a credit on a future purchase. We do not honor any claims after twenty (15) days from the date of delivery.</span></span></span></span><br />\r\n&nbsp;</p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Product Warranty</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">If any product breaks or has any problems not due to use or misuse, you can return the product within 15 days of receipt for a full refund or a credit on a future purchase. You may request a replacement of any product if its condition is not satisfactory (damaged materials, stains, missing components etc.) within 10 days.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Return and refund Policy</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">If, for any reason you are not fully satisfied with your online khukuri purchase as described, please notify us by email and return the khukuri undamaged immediately. A full no quibble refund will be made upon receipt of the goods. Please note that shipping, handling and insurance charge will not be refundable. Return shipping Charge will also be paid by Buyers.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Under the following circumstances/situations TEGKH implements refund polices.</span></span></span></span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">In case a product other than actually ordered/sold has been sent by mistake.</span></span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">If TEGKH&nbsp;completely fails to deliver the product or delays well beyond the given delivery time frame.</span></span></span></span></li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Service Guarantee</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Our service starts with a live person you can call to ask questions or place an order. But our service doesn&#39;t stop there. We notify you of when your item is shipped and any delays there may be in shipping. We are always only an email or a phone call away. All email inquiries will be responded to within 24 hours.&nbsp;</span></span></span></span></p>', NULL, 0, 6, NULL, '1', '0', 'F', NULL, NULL, NULL, '2022-02-18 16:11:19', '2022-02-21 18:45:19'),
(7, 'Shipping Policy', 'shipping-policy', 'about', NULL, '<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Shipping Policy</span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">We charge a fixed price estimation of actual shipping and handling costs and fees. We do offer a combined shipping discount on almost every item we sell. You pay the highest shipping charge for the first item and 10% discount for each additional item. This discount is only available when you pay for all purchases as one payment.</span></span></span></p>\r\n\r\n<p><br />\r\n<span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Carriers: We may use any of these international courier services. The tracking no. and website link will be provided once the order is shipped: UPS, FedEx, DHL, Aramex or Express Mail Service (EMS). Home delivery within 3 to 6 business days once full payment receipts.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Important Note: (For some Eastern Europe Countries &amp; South American Customers) Before placing an order or bid, please check your Local, State, or federal government import laws, rules &amp; regulations in order import this product. We DO NOT refund if Custom cease your product package because of import restrictions. The Custom clearance or duties or any other fees (if apply); has to be paid by buyers. If the item is returned due to import restriction, the shipping charges is not refundable and return shipping charges will also be paid by buyers. In any case if the item is held by custom then The Ex Gurkha Khukuri House(TEGKH) is not responsible.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Insurance: We highly recommend all buyers to buy such an insurance with nominal cost. We will not be responsible for uninsured item for lost or damage in transit. Please ask any questions you may have before placing order regarding shipping or insurance. We will contact you shortly after the receiving your email with an invoice. We ship very rapidly, usually within 24 hours of your payment.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">International Duties:<br />\r\nPlease refer to your country&rsquo;s duty charges before placing a order. Any customs duty will be buyer&rsquo;s responsibility. If a package is returned to us due incorrect address or recipient non-availability to accept, there will be a shipping charge to ship package for the second time even if the original sale was shipped free of charges.</span></span></span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>', NULL, 0, 11, NULL, '1', '0', 'F', NULL, NULL, NULL, '2022-02-18 16:28:20', '2022-03-24 20:31:38'),
(8, 'KHUKURI HISTORY', 'khukuri-history', 'about', NULL, '<p><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><strong><span style=\"font-size:14.0pt\"><span style=\"color:black\">HISTORY OF THE KHUKURI</span></span></strong><br />\r\n<span style=\"color:black\">The Khukuri&rsquo;s history predates the founding of the nation of Nepal. When the kingdom of Nepal was first created in the 16th Century, it was already the weapon of choice for the Gurkhas and their predecessors, the Nepali Sainik (warriors or soldiers).</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">The khukuri is ancient - Many believe that its 2,500-year history stretches back to at least the time of Alexander the Great&rsquo;s invasion of the Indian subcontinent, and this is certainly possible. However, historians are not completely sure if Alexander brought the blade with him to what is today Nepal, or if he and his cavalry troops encountered it here on the battlefield, realized its effectiveness, and adopted it for themselves.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">It is even possible that both stories are true: The Macedonian version of the kopis (the term used for the single-edged, reverse-curved sword used by Alexander&rsquo;s cavalry) was strangely SHORTER than its Egyptian counterparts &ndash; interestingly enough, about the size of a khukuri. Whatever the circumstances were, though, they remain lost to history.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">In any case, the present curved khukuri design as we know it today was born as an object of native craftsmanship in the hills of Nepal, in or around the 7th century BC - about 2500 years ago.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">To put this into some sort of defining historical context, the Japanese katana is justifiably famed as the iconic sword of Japan&rsquo;s fabled samurai warriors&hellip; But it is also true that when the great Japanese master craftsman, Amakune, made the first gracefully curved katana sword for the samurai, some 900 years ago, the art of crafting the khukuri was already more than a thousand years old.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">The Nepalese khukuri has the unique distinction of being the only ancient battle weapon still in use in the field today &ndash; a distinction that is unique in the entire history of edged weaponry.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">The khukuri first gained notoriety in the West for its ferocious effectiveness against the British troops who encountered it in the Anglo-Nepali War.The mutual respect each side gained for the other in that war forged the British-Gurkha alliance that continues to this day.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">This emblematic weapon continued to serve the Gurkha warriors who wielded it through World War I, and World War II. During these conflicts, the knife gained high regard among allied and enemy troops alike, for its effectiveness and utility.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Because a Gurkha and his khukuri are inseparable, it was formally adopted as official military issue gear under British leadership &ndash; each Gurkha carries one as a part of his &ldquo;kit,&rdquo; in both parade and battle. No Gurkha would ever think of going into combat without one. In this way, the khukuri has also become a part of English history as well.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">The English spelling of the word, Khukuri, has been rather &ldquo;fluid&rdquo; over the years, owing to the fact that the English characters used must be interpreted phonetically from the Nepalese language &ndash; So the word, &ldquo;Khukuri&rdquo; has also been written, khookree, khukri, khukuri, kukery, kukoori, and kukri. Early British dispatches and other accounts render it in three syllables &ndash; &ldquo;koo-ker-ee&rdquo; &ndash; It even achieved a certain degree of 19th Century British literary fame, when &ndash; in Braham Stoker&rsquo;s classic tale of horror, Dracula, one of the English heroes, the stalwart Jonathan Harker, beheads the evil villain with a single sweep of his &ldquo;great kukri.&rdquo;</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">But however, it is spelled, and whatever notoriety it has achieved elsewhere, it remains first and foremost the iconic, traditional battle knife of the Gurkhas.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">The spelling of the kukri has been in dispute for some time. It has documented as khookree, khukri, khukuri, kukery, kukoori and kukri. There are mostly from early British&nbsp;accounts.tha spoken word is 3 syallable. Today&rsquo;s accepted spelling are kukri or Khukuri. The kukri is the national weapon and icon of Nepal. It was and still is the basic and traditional utility knife of Nepalese, a formidable and very effective weapon of gurkhas regiment throughout the world and an exquisite piece of local craftsmanship that symbolic pride and valor. It is wickedly curved in shape. it is basically carried in leather case, mostly having walnut wooden grip with two small knives. It is part of many traditional ritual among different ethnic group of Nepal, including one where the groom has to wear it during the wedding ceremony. The khukuri gained fame in the anglo-nepali war fpr its effectiveness and its continued use right through to and including both world war Iand World War II, enhanced its reputation among both allied troops and enemy force. The oldest known khukari are in national museum (Kathmandu in Nepal and belonged to Drabya shah circa 1559</span></span></span></span></p>', NULL, 2, 7, 'feature1647234511.jpg', '1', '0', 'F', NULL, NULL, NULL, '2022-03-14 14:42:09', '2022-04-22 21:21:47');
INSERT INTO `tbl_contents` (`id`, `content_title`, `content_url`, `content_type`, `content_icon`, `content_body`, `external_link`, `parent_id`, `position`, `featured_img`, `publish_status`, `delete_status`, `show_on_menu`, `meta_title`, `meta_keyword`, `meta_description`, `created_at`, `updated_at`) VALUES
(9, 'CUSTOM KHUKURI', 'custom-khukuri', 'about', NULL, '<h1 style=\"text-align:justify\"><span style=\"font-size:16pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Calibri Light&quot;,sans-serif\"><span style=\"color:#2f5496\"><strong><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">DESIGN YOUR KHUKURI</span></span></strong></span></span></span></span></h1>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Most khukuri feature handles with metal bolsters and butt plates, which are generally made of brass or steel, and a handle of either water buffalo horn or tough Indian Rosewood (Rhododendron wood), but some examples feature grips of ivory, bone, silver, or other exotic materials.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">There are basically two distinct types of khukuri - the traditional type is the &quot;rat &ndash;tail&quot; or &quot;stick-tang&quot; model, seen on most antique khukuri, in which a narrow finger of metal is driven all the way through the handle and riveted into place. Ancient khukuri handles were similar but gracefully downward curved rather than straight, with steel or iron bolsters and pommel, and the tang did not go all the way through the handle.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">The other type is a full-tang or &quot;panawal handle&quot; model, featuring slab handles and pommel attached to the blade by means of rivets. Although the exact origin of the panawal handle is not known, it is likely that it began in the early 1900s, when kamis were influenced by seeing British knives, admired their strength and functionality, and adapted this useful feature to their own use.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">If you want to design your khukri, then you can choose any of the types as we can provide you with whatever you need!</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">The Khukuri is typically carried in a wooden, hide-covered sheath. The sheath carries with it a small utility knife, called a &quot;karda&quot; &ndash; for skinning small game and other utility functions, and a &quot;chakmak&quot; which serves as a sharpening steel. Because of its curved blade, the khukuri must be carefully drawn and sheathed, with the left hand at the back of the sheath, so that the edge does not slip between the wooden halves and injure the hand.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">The typical, general-purpose khukuri is commonly 16 to 18 inches (around 40-45cm) in overall length and weighs 1 to 2 pounds. Typically, khukuri blades usually feature an unusual, enigmatic notch at the base of the blade, called a &quot;kauda&quot; or &quot;cho.&quot; Various functions, both practical and ceremonial &ndash; and even spiritual &ndash; are served by this unusual feature:</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">It delineates the end of the blade when sharpening, and it acts as an effective drain for blood or sap so that the handle will not become slippery with use. It is also used as a means of locking and disarming an enemy&#39;s weapon, and it is a sacred symbol representing the mantra, &quot;Om,&quot; or alternatively a cow&#39;s foot, or the trident of Shiva.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">It is claimed that a kukri has never been broken in battle, and there is truth to this claim &ndash; the khukuri is crafted of pure, high-carbon steel, deferentially heat-treated for both strength and sharpness, and can be 10 millimeters thick close to the hilt. This makes the khukri extremely strong and virtually unbreakable.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Blades usually taper distally to about 5mm, toward the point for lightness, balance, and enhanced penetration &ndash; and of course, feature an increasingly narrower bevel as they descend toward the wickedly-sharp, convex ground, reverse-curved cutting edge.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">There is a great deal of variation in the dimensions and blade thicknesses of khukuri &ndash; this depends a great deal on the task that they were constructed for, and the particular &quot;style&quot; and regional variations, as well as the personal tastes of the kami who make them. Lengths can vary, but 26-38 cm (about 10 to 15 inches) is about average for general use.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Another factor that affects a khukuri&#39;s weight and balance is variables in the construction of the blade itself &ndash; these variations are many and are both artistic and practical aspects of the smith&#39;s art &ndash; a blade can be hollow-forged for lightness, double or triple fullered (&quot;duichira,&quot; and &quot;tin chira,&quot; respectively) for exceptional strength, single-fullered (&quot;angkhola&quot;), or even heavy and non-tapered, with a large, beveled edge.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Basic designs, shapes, and sizes of khukuri, from ancient to modern, have varied extensively, depending on regional styles, requirements of the owner, tastes, and traditional cultural styles of the smiths who made them, etc. For example, khukuris made in the eastern village of Bhojpur, have heavy, thick blades, whereas the sirupate style blade is slim and thin. Khukuri from Salyan are long and slender, with a deep, deeper belly, and the khukuris of Dhankuta, a village in the east, are the simple, standard army-type blade, but created with elaborate fullers and ornate decorative features.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Get to design your khukri as we provide custom Gurkha knives at reasonable rates!</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Since all khukuri are completely handmade, there is some variation even in the same type of blade. The individual craftsman always has his own, unique, highly individualized vision of what a khukuri should look like.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Khukuri can, however, be broadly classified into two styles, &quot;Eastern&quot; and &quot;Western.&quot; Western blades are broader and are occasionally referred to as a &quot;budhuna&quot; pattern (a &quot;budhuna&quot; is a Nepalese fresh-water fish with a large head). Another term for the Western pattern is &quot;Baspate&quot; (&quot;Bamboo leaf&quot;), which refers to blades a bit wider than the narrow &quot;Sirupate&quot; blade.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Modern khukuri crafted here are made of near-indestructible 5160 high-carbon steel, salvaged from truck suspension springs. The tough spring steel is forged to shape and differentially heat treated &ndash; a complex process that leaves the back and sides of the blade tough and springy, but the edge hard enough to take and hold a razor edge.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:12pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">To DESIGN YOUR KHUKURI, get in touch with us now!</span></span></span></span></p>', NULL, 0, 5, NULL, '1', '0', 'B', NULL, NULL, NULL, '2022-03-14 15:10:38', '2022-04-22 21:09:36'),
(10, 'FAQS', 'faqs', 'about', NULL, '<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">FAQS</span></span></strong><br />\r\n<span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Below is a list of Frequently Asked Questions. If you cannot find the answer you&#39;re looking for, email your questions to us.</span></span></span></span></p>\r\n\r\n<ol>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">What is mean by Khukuri?</span></span></strong></span></span></li>\r\n</ol>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">It is a curved metal knife and each Gurkha soldier carries with him in uniform and in battles. During the 1st and 2nd world wars, it was famed as a non- exploded bomb or grenade. In times past, it was said that once a Khukuri was drawn in battle, it had to &#39;taste blood&#39;- if not, its owner had to cut himself before returning into its sheath.</span></span></span></span><br />\r\n	&nbsp;</li>\r\n</ul>\r\n\r\n<ol start=\"2\">\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Will my personal information remain private or secure?</span></span></strong></span></span></li>\r\n</ol>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Yes! Your personal information will be 100% secure. You&rsquo;re shopping with us is 100% secure.</span></span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:96px\">&nbsp;</p>\r\n\r\n<ol start=\"3\">\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">How do I know, once the order shipped?</span></span></strong></span></span></li>\r\n</ol>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Once the goods have been shipped via our courier agent, then we will send an email including tracking number and carrier&#39;s website to check it our current status of your order.</span></span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:96px\">&nbsp;</p>\r\n\r\n<ol start=\"4\">\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">When should I receive my order?</span></span></strong></span></span></li>\r\n</ol>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">All orders are processed and shipped within 24-48 business hours after being submitted, all orders should arrive at their destination within 5-7 business days. If we have an email on file, you will receive order and ship confirmations.</span></span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:96px\">&nbsp;</p>\r\n\r\n<ol start=\"5\">\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">What is the time frame on returns? What is the return policy?</span></span></strong></span></span></li>\r\n</ol>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">We have a 15-day satisfaction guarantee on all of our items. If you are not completely satisfied with any item from The Ex-Gurkha Khukuri House(TEGKH), Inc. or if the item is damaged or defective you may return it for a replacement or refund. Please allow 2-3 weeks for your return to be processed, once we process the return your credit should be posted on your next statement.</span></span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:96px\">&nbsp;</p>\r\n\r\n<ol start=\"6\">\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Why do you need my phone number and/or email address?</span></span></strong></span></span></li>\r\n</ol>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Having a phone number or email address on your account helps us contact you quicker if we have a question or problem with your order. If we have your email address you will receive an email confirmation to confirm your order and a shipping confirmation when your order ships with the tracking number if it is shipped via a trackable method. You will also receive periodic email promotions that our company sends out.</span></span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:96px\">&nbsp;</p>\r\n\r\n<ol start=\"7\">\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Pricing Policy?</span></span></strong></span></span></li>\r\n</ol>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Every product and price featured on this website has undergone strict editing procedures. However, errors may occur. TEGKH reserves the right to void any incorrect pricing or product information.</span></span></span></span></li>\r\n</ul>', NULL, 0, 8, NULL, '1', '0', 'H', NULL, NULL, NULL, '2022-03-14 15:42:37', '2022-03-14 15:44:42'),
(11, 'GURKHAS', 'gurkhas', 'about', NULL, NULL, NULL, 0, 3, NULL, '1', '0', 'H', NULL, NULL, NULL, '2022-03-14 20:33:44', '2022-03-14 20:44:12'),
(12, 'ABOUT GURKHAS', 'about-gurkhas', 'about', NULL, '<h1>THE GUKHAS</h1>\r\n\r\n<p>Some sources say that in the mid-18th Century, in a small principality called &ldquo;Gorkha&rdquo; under King Prithivi Narayaan conquered and united most of what is today known as Nepal, and went on to expand their kingdom to an area that extends from the Border of Kashmir in the northwest, to Bhutan in the east; establishing Hinduism &ndash; with distinct Rajput warrior and Gorkhanath influences &ndash; as the official state religion.</p>\r\n\r\n<p><img alt=\"Janga Bahadur Rana\" src=\"https://www.nepalkhukurihouse.com/pub/media/wysiwyg/demo/about-gurkhas2_1.jpg\" style=\"height:459px; width:250px\" /></p>\r\n\r\n<p>Other sources disagree, saying that it is the other way around &ndash; they believe the locality took its name from the Gorkha people of that region. These sources contend that in the early 1500s some of the descendants of Bappa Rawal &ndash; a powerful and famous ruler of India&rsquo;s Mewar Dynasty &ndash; went further east, to conquer a small state in present-day Nepal, which they named Gorkha in honour of their patron saint; and that by 1769, under the leadership of Sri Panch Maharaj, Dhiraj Prithvi Narayan Shahdev (1769&ndash;1775), the Gorkha Dynasty controlled the area which is modern Nepal.</p>\r\n\r\n<p>Whether the people took the name of the region or the region was given the name of the people, though, the Gurkhas evolved a simple, but unique philosophy of life, which epitomizes the very essence of what it means to be a warrior: They believe it is better to be dead than to be a coward.</p>\r\n\r\n<p>Even the name itself, &ldquo;Gurkha&rdquo; comes from the root, &ldquo;gorkhali,&rdquo; which in our language is another name for, valor, courage, steadfastness, loyalty, and neutrality or impartiality.</p>\r\n\r\n<p>So it is with good reason that their traditional war cry, given in battle preparatory to a charge, is enough to chill the blood of the most determined adversary: &quot;Jai Mahakali, Ayo Gorkhali!!!&quot; - &quot;Glory to the Goddess of War, here come the Gurkhas!&quot;</p>\r\n\r\n<p>It may be hard for modern, 21st Century people to understand, but during this warlike era of unification, it is said that the nation, its warriors, and their weapon; the khukuri; became as one. Just as it was said by the legendary Japanese samurai warriors that, &ldquo;The sword is the soul of the samurai,&rdquo; It was said of the khukuri and the warriors who carried them, &ldquo;Without the one, the other is nothing.&rdquo;</p>\r\n\r\n<p>The relationship of the Gurkha to his khukuri goes back to the earliest days of the Nepalese nation. For almost 200 years, they have served in the British Army thanks to the Treaty of Segauli, which made them allies and brothers in arms. They are not mercenaries, but full members of the British Army. Their relationship with the British is unique in history.</p>\r\n\r\n<p>When the Gurkhas began to have clashes with the crack troops guarding territory controlled by the British East India Company, the British quickly declared war against them&hellip; and soon discovered that declaring war on a Gurkha was one thing, but conquering him was something else entirely.</p>\r\n\r\n<p>During this conflict though, something truly remarkable happened &ndash; something not often seen in the annals of warfare: Each side noted not only the valor, but also the honor and courtesy with which the other side fought, and each side came to admire the bravery and chivalry of their opponents.</p>\r\n\r\n<p>In the Spring of 1816, in a singular gesture of respect for a worthy adversary, the British decided not only to make peace with the Gurkhas, but to forge an alliance with these brave little men with the big knives, who seemed to have all of the qualities that make an ideal infantryman:</p>\r\n\r\n<p>Thus, on March 4, 1816, the Treaty of Sugauli was ratified and a provision was made that allowed the British to recruit them into the British Army as a Brigade of Gurkhas. On that day, a long-standing alliance between the British and the Gurkhas that endures to this day.</p>\r\n\r\n<p>Ever since that time, Nepalese troops from the the Rai&rsquo;s , Limbus, Gurungs, Magar, and other Nepalese clans have served proudly in the British Army. Their courage, sincerity and loyalty have won them the praise and friendship of their British counterparts, and the fear and respect of their enemies; and won many metals and unit commendations for their courage on the battlefield, including even the Victoria Cross, Britain&rsquo;s highest military honor:</p>\r\n\r\n<p><img alt=\"The Gurkhas\" src=\"https://www.nepalkhukurihouse.com/pub/media/wysiwyg/demo/about-gurkhas.jpg\" style=\"height:522px; width:396px\" /></p>\r\n\r\n<p>In the 158 years since the Victoria Cross was created for conspicuous valor and extreme courage in the face of the enemy, only 1,357 have been awarded; twenty-six have been awarded to members of Gurkha regiments.</p>\r\n\r\n<p>The near-superhuman courage which Gurkhas manifest on the b</p>\r\n\r\n<p><img alt=\"Gorkhali Man\" src=\"https://www.nepalkhukurihouse.com/pub/media/wysiwyg/demo/about-gurkhas1.jpg\" style=\"height:269px; width:193px\" /></p>\r\n\r\n<p>attlefield is legendary &ndash; The Gurkha&rsquo;s story has been indelibly written on battlefields throughout the world. In WWI alone, some 20,000 Gurkhas gave their lives in battles that raged as far away as France, Turkey, Palestine, and Mesopotamia. In at least one case &ndash; The Battle of Loos, they literally fought to the last man. They were often the first troops to arrive and the last to leave.</p>\r\n\r\n<p>The Gurkha Welfare Trust, which was organized by the British to assist their Gurkha veterans acknowledged that &ldquo;If there was a minute&rsquo;s silence for every Gurkha casualty from the World War alone (meaning World War I), we would have to keep quiet for two weeks.&rdquo;</p>\r\n\r\n<p>Sam Maneskshaw, Former Chief of Staff of the Indian Army, once commented, &ldquo;If a man is not afraid of dying, then he is either lying, or he is a Gurkha.&rdquo;</p>\r\n\r\n<p>This kind of courage has won the highest admiration and praise from their British allies. Sir Ralph Turner, of the 3rd Queen Alexander&rsquo;s Own Gurkha Rifles was once moved to comment about the Gurkhas,&ldquo; As I write these last words, my thoughts return to you who were my comrades, the stubborn and indomitable peasants of Nepal. Once more I hear the laughter with which you greeted every hardship. Once more I see you in your bivouacs or about your fires, on forced march or in the trenches, now shivering with wet and cold, now scorched by a pitiless and burning sun. Uncomplaining you endure hunger and thirst and wounds; and at the last your unwavering lines disappear into the smoke and wrath of battle. Bravest of the brave, most generous of the generous, never had country more faithful friends than you. &rdquo;</p>', NULL, 11, 4, NULL, '1', '1', 'H', NULL, NULL, NULL, '2022-03-14 20:34:34', '2022-03-14 20:44:50'),
(13, 'ABOUT GURKHAS', 'about-gurkhas', 'about', NULL, NULL, NULL, 11, 1, NULL, '1', '1', 'H', NULL, NULL, NULL, '2022-03-24 18:06:28', '2022-03-24 18:12:50'),
(14, 'ABOUT GURKHAS', 'about-gurkhas', 'about', NULL, '<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">THE GURKHAS</span></span></span></strong></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Some sources say that in the mid-18th Century, in a small principality called &ldquo;Gorkha&rdquo; under King Prithivi Narayaan conquered and united most of what is today known as Nepal and went on to expand their kingdom to an area that extends from the Border of Kashmir in the northwest, to Bhutan in the east, establishing Hinduism &ndash; with distinct Rajput warrior and Gorkhanath influences &ndash; as the official state religion.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Other sources disagree, saying that it is the other way around &ndash; they believe the locality took its name from the Gorkha people of that region. These sources contend that in the early 1500s some of the descendants of Bappa Rawal &ndash; a powerful and famous ruler of India&rsquo;s Mewar Dynasty &ndash; went further east, to conquer a small state in present-day Nepal, which they named Gorkha in honor of their patron saint; and that by 1769, under the leadership of Sri Panch Maharaj, Dhiraj Prithvi Narayan Shahdev (1769&ndash;1775), the Gorkha Dynasty controlled the area which is modern Nepal.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Whether the people took the name of the region, or the region was given the name of the people, though, the Gurkhas evolved a simple, but unique philosophy of life, which epitomizes the very essence of what it means to be a warrior: They believe it is better to be dead than to be a coward.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Even the name itself, &ldquo;Gurkha&rdquo; comes from the root, &ldquo;gorkhali,&rdquo; which in our language is another name for, valor, courage, steadfastness, loyalty, and neutrality or impartiality.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">So it is with good reason that their traditional war cry, given in battle preparatory to a charge, is enough to chill the blood of the most determined adversary: &quot;Jai Mahakali, Ayo Gorkhali!!!&quot; - &quot;Glory to the Goddess of War, here come the Gurkhas!&quot;</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">It may be hard for modern, 21st Century people to understand, but during this warlike era of unification, it is said that the nation, its warriors, and their weapon; the khukuri; became as one. Just as it was said by the legendary Japanese samurai warriors that, &ldquo;The sword is the soul of the samurai,&rdquo; It was said of the khukuri and the warriors who carried them, &ldquo;Without the one, the other is nothing.&rdquo;</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">The relationship of the Gurkha to his khukuri goes back to the earliest days of the Nepalese nation. For almost 200 years, they have served in the British Army thanks to the Treaty of Segauli, which made them allies and brothers in arms. They are not mercenaries, but full members of the British Army. Their relationship with the British is unique in history.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">When the Gurkhas began to have clashes with the crack troops guarding territory controlled by the British East India Company, the British quickly declared war against them&hellip; and soon discovered that declaring war on a Gurkha was one thing but conquering him was something else entirely.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">During this conflict though, something truly remarkable happened &ndash; something not often seen in the annals of warfare: Each side noted not only the valor, but also the honor and courtesy with which the other side fought, and each side came to admire the bravery and chivalry of their opponents.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">In the Spring of 1816, in a singular gesture of respect for a worthy adversary, the British decided not only to make peace with the Gurkhas, but to forge an alliance with these brave little men with the big knives, who seemed to have all the qualities that make an ideal infantryman:</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Thus, on March 4, 1816, the Treaty of Sugauli was ratified and a provision was made that allowed the British to recruit them into the British Army as a Brigade of Gurkhas. On that day, a long-standing alliance between the British and the Gurkhas that endures to this day.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Ever since that time, Nepalese troops from the Rai&rsquo;s, Limbus, Gurungs, Magar, and other Nepalese clans have served proudly in the British Army. Their courage, sincerity and loyalty have won them the praise and friendship of their British counterparts, and the fear and respect of their enemies; and won many metals and unit commendations for their courage on the battlefield, including even the Victoria Cross, Britain&rsquo;s highest military honor:</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">In the 158 years since the Victoria Cross was created for conspicuous valor and extreme courage in the face of the enemy, only 1,357 have been awarded; twenty-six have been awarded to members of Gurkha regiments.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">The near-superhuman courage which Gurkha&rsquo;s manifest on the battlefield is legendary &ndash; The Gurkha&rsquo;s story has been indelibly written on battlefields throughout the world. In WWI alone, some 20,000 Gurkhas gave their lives in battles that raged as far away as France, Turkey, Palestine, and Mesopotamia. In at least one case &ndash; The Battle of Loos, they literally fought to the last man. They were often the first troops to arrive and the last to leave.</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">The Gurkha Welfare Trust, which was organized by the British to assist their Gurkha veterans acknowledged that &ldquo;If there was a minute&rsquo;s silence for every Gurkha casualty from the World War alone (meaning World War I), we would have to keep quiet for two weeks.&rdquo;</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Sam Maneskshaw, Former Chief of Staff of the Indian Army, once commented, &ldquo;If a man is not afraid of dying, then he is either lying, or he is a Gurkha.&rdquo;</span></span></span></span></span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"background-color:white\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">This kind of courage has won the highest admiration and praise from their British allies. Sir Ralph Turner, of the 3rd Queen Alexander&rsquo;s Own Gurkha Rifles was once moved to comment about the Gurkhas, &ldquo;As I write these last words, my thoughts return to you who were my comrades, the stubborn and indomitable peasants of Nepal. Once more I hear the laughter with which you greeted every hardship. Once more I see you in your bivouacs or about your fires, on forced March or in the trenches, now shivering with wet and cold, now scorched by a pitiless and burning sun. Uncomplaining you endure hunger and thirst and wounds; and at the last your unwavering lines disappear into the smoke and wrath of battle. Bravest of the brave, most generous of the generous, never had country more faithful friends than you.&rdquo;</span></span></span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>', NULL, 11, 1, 'feature1648190465.jpg', '1', '0', 'F', NULL, NULL, NULL, '2022-03-25 17:26:07', '2022-04-22 21:23:06'),
(15, 'WHY US', 'why-us', 'about', NULL, '<h2 style=\"text-align:justify\"><span style=\"font-size:13pt\"><span style=\"font-family:&quot;Calibri Light&quot;,sans-serif\"><span style=\"color:#2f5496\"><span style=\"font-size:16.0pt\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Why The Ex Gurkha Khukuri House?</span></span></span></span></span></span></span></h2>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"background-color:white\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\"><span style=\"color:black\">Because the greatest reward for us is in customers satisfaction. We have the most authentic and genuine Khukuris and some of the most historical khukuris dating back 100 of years. We sell the best product at a reasonable price. We create custom Khukuris as per your order, we have various unique Khukuris that we created, which is Unique to our shop. Not only do we create custom khukuris but we also engrave the Khukuri with anything the customers want to write down on the Khukuri they buy as a souvenir. We operate from a shop from a prime location, we are easier to find and for those who can&rsquo;t come to our shop we operate online and ship your products to wherever you want. </span></span></span></span></span></p>', NULL, 0, 1, NULL, '1', '0', 'B', NULL, NULL, NULL, '2022-04-22 21:28:14', '2022-04-22 21:28:14'),
(16, 'Privacy Policy', 'privacy-policy', 'about', NULL, '<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\">Privacy Policy:</span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">The Ex-Gurkha Khukuri House respects the privacy of any individual we keep our customer database safe and unshared be found company&#39;s limited staff.&nbsp;</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\">Price policy:</span></strong><br />\r\n<span style=\"font-size:12.0pt\">TEGKH products&rsquo; prices are revised annually depending on the current market&rsquo;s rates, assessment, circumstances, and calculation. </span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\">Insurance policy:</span></strong><br />\r\n<span style=\"font-size:12.0pt\">All products are insured, and a buyer is illegible for compensation under legal policies act put up by EGKH&nbsp;and our forwarding partners. If by any chances we completely fail to deliver a product within estimated given period, we will refund the amount; if an order is mistakenly sent to another address than the destination provided by the buyer, we will resend the order. In cases like theft, robbery, accident or lost before reaching the buyer, we will resend the order. However, in cases like minor damage in the product or buyer&rsquo;s negligence causing damage to the product, we will not be held responsible. Insurance policy does not cover such cases.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\">Satisfactions Guarantee</span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">You must be 100% satisfied in your every purchase. If not, you can return the products within 15 days of receipt for a full refund or a credit on a future purchase. We do not honor any claims after twenty (15) days from the date of delivery.</span></span></span><br />\r\n&nbsp;</p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\">Product Warranty</span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">If any product breaks or has any problems not due to use or misuse, you can return the product within 10&nbsp;days of receipt for a full refund or a credit on a future purchase. You may request a replacement of any product if its condition is not satisfactory (damaged materials, stains, missing components etc.) within 10 days.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\">Return and refund Policy</span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">If, for any reason you are not fully satisfied with your online khukuri purchase as described, please notify us by email and return the khukuri undamaged immediately. A full no quibble refund will be made upon receipt of the goods. Please note that shipping, handling, and insurance charge will not be refundable. Return shipping Charge will also be paid by Buyers.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Under the following circumstances/situations TEGKH implements refund polices.</span></span></span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">In case a product other than ordered/sold has been sent by mistake.</span></span></span></li>\r\n	<li><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">If TEGKH&nbsp;completely fails to deliver the product or delays well beyond the given delivery time frame.</span></span></span></li>\r\n</ul>\r\n\r\n<p style=\"margin-left:48px\">&nbsp;</p>\r\n\r\n<p style=\"margin-left:48px\">&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\">Service Guarantee</span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Our service starts with a live person you can call to ask questions or place an order. But our service doesn&#39;t stop there. We notify you of when your item is shipped and any delays there may be in shipping. We are always only an email or a phone call away. All email inquiries will be responded to within 24 hours.&nbsp;</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Feel free to order any time on-line or if you have any other questions before you place your order, please telephone us during business hours (9:30 to 5:30 NST, Nepal Standard Time; GMT+05:45) at +977 9855 083554.</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">We hope you enjoyed your visiting with us. We are working hard to offer you the very best </span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Return Address</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Hotel Marg, Hotel Radisson, Lazimpat, Kathmandu, Nepal</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Phone: +977 9855 083554</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Email: theexgurkha@gmail.com</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">UK:</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">103a The Broadway Southall,</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">London UB1 1LN</span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\">Phone: +44 7969 273 976</span></span></span></p>\r\n\r\n<p>&nbsp;</p>', NULL, 0, 1, NULL, '0', '0', 'N', NULL, NULL, NULL, '2022-04-25 21:01:29', '2022-04-25 21:04:26');
INSERT INTO `tbl_contents` (`id`, `content_title`, `content_url`, `content_type`, `content_icon`, `content_body`, `external_link`, `parent_id`, `position`, `featured_img`, `publish_status`, `delete_status`, `show_on_menu`, `meta_title`, `meta_keyword`, `meta_description`, `created_at`, `updated_at`) VALUES
(17, 'The Making of Khukuri', 'the-making-of-khukuri', 'about', NULL, '<p style=\"text-align:center\"><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The Making of Khukuri</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The Ex-Gurkha Khukuri House follows the time-tested traditional method of making Khukuri. All our khukuri are partially heat-treated, hand-forged, and completely handmade using basic machines for grinding and polishing. The complete khukuri&nbsp;set (a blade, handle, &amp; sheath) is made by hand. &nbsp;</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The traditional way of&nbsp;making of Kukri/ Khukuri (early 2000&#39;s)</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Making a khukuri/kukri mainly includes making 3 major parts of the khukuri,&nbsp;Blade,&nbsp;Handle, and the&nbsp;Scabbard/Sheath. Khukuri House follows this method to make the khukuri &amp; knives.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Making the blade&nbsp;</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Here we have explained 13 steps in making the blade of khukuri/kukri.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">01.&nbsp;Weighing/Choosing Steel</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Surplus Indian truck steel (suspension leaf spring; HC) are bought from local scrap shops/dealers after carefully observing for any cracks or puncture and then transported to Khukuri House. It is stored with other raw materials in the warehouse. The steel is then weighed to make the required type of khukuri. The weight of the steel should be slightly heavier than the actual (final) weight of khukuri as weight is lost in grinding process when shaping it.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">02.&nbsp;Measuring Steel</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The steel is measured depending on the total length required for the khukuri. Normally around 1/2 of the required size is measured on the steel. But this depends on the thickness of the steel; longer if thinner and shorter if thicker.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">03.&nbsp;Cutting Steel</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The measured steel is cut and split from the main body. At first, the steel is red heated around 800-900*C in a charcoal oven, &ldquo;Chula&rdquo;, and then is hammered using a 3 kg hammer against a sharp metal cutting Chisel. This hammering process takes almost half an hour for two men to break the steel apart.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">04.&nbsp;Beating and Hammering (forging)</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">This is the most important stage of the making process. Here the kukri gets a rough initial shape and size and the tang is forged out from the steel. The forging (this stage) is all about the master craftsman who rolls around the steel side-by-side, up and down and back and forth while being beaten by two 3 kg hammers simultaneously by his associates. The steel is red heated regularly and hammered countless times to bring into the required size, shape, and structure of the kukri. During the process, the steel gets the re-curve shape of a khukuri and the tang is created where the handle will be fixed at later stages. This heavy-duty work takes about an hour for the 3 men&#39;s team/set.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">05.&nbsp;Shaping</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The rough shape formed at the earlier stage at forging is now given the actual shape. The master craftsman uses a 1.5 kg hammer to bring the rough shape to reality. The still is regularly heated, beaten all around the surface over and over to get the required shape. This is a very time-consuming stage and requires a lot of skill and years of experience.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">06.&nbsp;Notch</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">After the shape is achieved notch (blood dripper) is made at the ricasso of the blade. A rod having its tip like the shape of a notch is used and carefully hammered in the area. The blade is once again heated, made soft and the rod is hammered in so that it cuts the edge of the blade and leaves the impression of the notch. Thus, notch is later finalized by using a 5&rdquo; Pitsaw file.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">07.&nbsp;Pattern</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The making of the pattern above the notch along the spine takes place in this stage. Various patterns are made depending on the type of khukuri. A sharp-pointed Chisel and 1 kg hammer are used to make the patterns. The craftsman maneuvers his toes to move and flip the blade to find the right spot to hammer in the patterns. In some village&nbsp;models, a brass inlay is used as part of the decoration of the pattern.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">08.&nbsp;Quenching</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">This is another crucial stage where the blade is given hardness and strength. The craftsman carefully spills water (at room temperature) onto the edge/bevel of the carefully heated blade. It requires great skill to be able to judge the right temperature by the sheer color of the blade to get the best quench (hardness). The blade&rsquo;s bevel must be equally heated at the same temperature just before the quenching. Over/under doing it will result in inferior quality either resulting in cracks or subtle (weak) edge. Also, the amount of water spilled should be well balanced on all parts and should not be done on the panel of the blade.&nbsp;</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">09.&nbsp;Filing Blade</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">In this stage, the coarse blade is filed by a 10&rdquo; flat rough file and finished (smoothened). A pair of pliers is used to hold the blade and the file is scrubbed against the blade countless times until it becomes well done. The blade&rsquo;s counters and corners are leveled from all angles and sides. The craftsman pays special attention to the edge of the blade and makes it thin and steep from both sides.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">10.&nbsp;Joining blade to handle</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Here the blade is joined/fixed to the handle. A hole is first drilled into the solid handle material by a 10mm drill machine. Then the tang is red heated and inserted into the same hole which burns the handle material and leaves a trail of smoke. Traditional&nbsp;laha&nbsp;glue is pressed and squeezed inside the hole and filled up. Then the tang is&nbsp;inserted into the hole and secured to the handle.</span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">11.&nbsp;Sharpening</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">A very traditional method is performed to sharpen a khukuri. It is obviously very time-consuming but effective. It requires two persons and a homemade wheel-chain rotary appliance to complete the act. The device uses a 10-12&rdquo; hard wheel made from the mixture of laha, fine sand, and tiny particles of white river stones. The mixture is cooked and stirred for several hours until it is perfectly blended to each other. Then it is spilled in a round iron frame and dried up until it is rock hard. The craftsman grinds the edge of the khukuri against the wheel on both sides to trim the bevel and sharpen the edge while his associate pulls the chain to spin the wheel from the other side. Water is regularly poured on the edge to calm the temperature generated from the friction. The edge is checked time and again until it is very sharp.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">12.&nbsp;Grinding (preparing) the edge</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">During this traditional sharpening process, the edge of the blade is repeatedly checked over and over to get required sharpness. The craftsman regularly deeps the blade into water and spills fine sand particles over the edge and again grinds in the sharpening wheel. Here water controls the heat generated from grinding and makes sure hardness is not withdrawn from the edge whereas fine san particles help to trim down the edge smoothly.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">13.&nbsp;Shining / Polishing</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">This is the last stage of the making in which the khukuri is finished and polished (shinned) skillfully. The blade and handle both are finished by applying various grits of sand blasters and papers (lower to higher). The finisher uses a 2-3 HP Buff Machine and does 4-5 sets of various steps to get the fine finishing. He must be very cautious not to overdo the job as overheating may ruin the hardness of the blade making it soft and fragile.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Making Handle</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Cutting Horn/Wood</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">​Water buffalo horns are imported from India and transported to our factory in large numbers. They all go through the selection phase and bad quality horns are rejected. The hollow area of the horn is cut off from the main body and only the solid part is used to make the handle. The solid horn is then measured to fit the size of a required khukuri. Now the making of a handle starts.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Shaping Handle</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The horn is now brought into the shape of a khukuri handle. The craftsman uses another sharp khukuri and modifies the raw horn into curve, oval, or round shape to fit the handle of a khukuri. During the process, gaps are also made for brass fitting to stay at the two ends of the horn.</span></span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Cutting Brass</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Now brass fittings are cut to support the handle. The exact size of the two ends of the handle are measured and cut to fit the brass cap at the rear portion (Chapri) and the brass holder at the other end ( Kazo). Brass fittings are also filed to make it smooth and shiny.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Making Brass Holders</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The cut pieces of brass are given shapes and sizes according to the khukuri. The two-ends of the brass are heated and are pressed onto one another and repeatedly hammered until they attach and join together. Then the brass frame is again hammered from all angles to every corner to achieve the required shape.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Adding LAHA</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Glue taken out from the bark of trees (Laha) is used to join the blade with the handle. Before this, a hole is drilled through the horn for the tang of the blade to go through. Then the Laha is heated and as it starts melting, it is squeezed inside the hole by the tang as shown in the picture. The craftsman makes sure that no gaps are left inside the horn as it is important for Laha to firmly stick around the blade for strong grip.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Fitting Brass Holders</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">As depicted in the picture, brass cap and brass holder is used to lock the khukuri to its handle. The brass fittings, which are placed onto the grooves made on the edges of the handle, lock the khukuri to its hilt. It is then made secure using laha/glue. The extra portion of the tang is then cut on the edge of the brass cap and sealed using a brass rivet.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Filing Handle</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">A file is used to filing the handle to make the surface smooth. All the rough pop outs while shaping the horn is scratched off from the handle and given clean-level surface. In this stage, a sharp wire is also used to rub against the handle to and fro to make deep lines for better grip and look.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\">&nbsp;</span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Making Scabbard/Sheath (DAP)</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Scratching Off Hide</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The water buffalo hide is submerged into water for some time until it becomes completely wet and soft. It is then scratched with a sharp slicker to remove all the remaining waste attached in the hide. Later, it is cut into the size required for a khukuri scabbard.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Cutting Wood</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">A wood called &#39;Sisau&#39; or &#39;Karma&#39; in English is used to make khukuri scabbard. The wood is roughly cut to give a pointed and curved shape as in the picture. The craftsman is careful not to cut the wood too deep to avoid from becoming thin and weak, as a result.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Sizing Wood</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Now the roughly cut wood is resized to make the exact size of a khukuri scabbard. A khukuri is used to measure the size needed for its own scabbard. During the process, craftsman cuts &frac14; inch wider than actual size so that it becomes easier to tuck in and out the blade from the wood.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Digging Wood</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">During this process, the wood is scrapped and made hallow for the blade to fit in. Inside of the wood are sliced off from the main body so that a room is created for the blade. It is important not to overdo it so that the blade does not wiggle around when tucked in. While scrapping the wood inside, rough wall (obstruction) like structure is made around the outer portion so that the blade stays firmly when kept inside.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Filing Wood</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Now the wooden frame is filed from outside and made smoother. The rough surface of the wood is scratched off to make it smooth and to level its surface. This will later help the hide to stay in balance and firmly with the wood.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Wrapping Wood</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">The completed wooden scabbard frame is now wrapped with the earlier treated hide. Two rounded belt leather stripes are also attached at the top of the frame. A different kind of hard leather is used for this purpose in order to fit in two small knives called the &#39;Karda&#39; and &#39;Chakmak&#39;.</span></span></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><strong><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Sewing Hide</span></span></strong></span></span></p>\r\n\r\n<p><span style=\"font-size:11pt\"><span style=\"font-family:Calibri,sans-serif\"><span style=\"font-size:12.0pt\"><span style=\"font-family:&quot;Times New Roman&quot;,serif\">Now the wrapped hide is strongly sewn using a needle and thread. The craftsman uses both his hands and feet to stitch the hide around the frame. Note that in the picture, feet are used to press the hide against the wood and hands used to sew the hide. The process is repeated back and forth for much better grip.&nbsp;</span></span></span></span></p>', NULL, 2, 1, NULL, '1', '0', 'N', NULL, NULL, NULL, '2022-04-26 19:49:57', '2022-04-26 19:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_coupon`
--

CREATE TABLE `tbl_coupon` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coupon_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_description` text COLLATE utf8mb4_unicode_ci,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_price` double DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `publish_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_coupon`
--

INSERT INTO `tbl_coupon` (`id`, `coupon_name`, `coupon_description`, `coupon_code`, `discount_price`, `start_date`, `end_date`, `publish_status`, `delete_status`, `created_at`, `updated_at`) VALUES
(1, 'Dioscount', NULL, '2356', 100, '2022-03-23', '2022-03-25', '1', '0', '2022-03-24 16:28:31', '2022-03-24 16:29:25'),
(2, 'Dioscount', NULL, '2222', 200, '2022-03-23', '2022-03-25', '1', '0', '2022-03-24 16:53:10', '2022-03-24 16:53:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referer_id` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apartment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_social_login` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `payment_option` enum('cash','esewa','khalti','imepay','paypal') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reward_point` double NOT NULL DEFAULT '0',
  `publish_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_otp` int(11) DEFAULT NULL,
  `forgot_password_otp` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fb_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`id`, `provider_id`, `referer_id`, `title`, `name`, `phone`, `address`, `email`, `country`, `state`, `town`, `street`, `apartment`, `zipcode`, `is_social_login`, `payment_option`, `password`, `email_verified_at`, `image`, `reward_point`, `publish_status`, `delete_status`, `remember_token`, `verify_token`, `verify_otp`, `forgot_password_otp`, `created_at`, `updated_at`, `fb_id`, `google_id`) VALUES
(1, NULL, NULL, 'mrs', 'Shriya Maharjan', '9869199508', 'Kathmandu', 'shriyamhrzn22@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '$2y$10$Ngp3C4nQm7mqQkpAssOmV.6UWkbRQpqIH9ywXZ8R/5zmXB3RjcmUe', '2022-03-24 16:27:01', NULL, 0, '1', '0', NULL, 'lBrz9kphFKKmCvQfeCAAPPgHt', 843587, NULL, '2022-03-24 16:26:14', '2022-03-24 16:51:00', NULL, NULL),
(2, NULL, NULL, 'mr', 'Mohan Khadka', '9845654524', 'ktm', 'mohan.khadka@nectardigit.com', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '$2y$10$oykz53VAAmNg.6lVMUScs.B9O7qfgdfenPN4ePQXTVvqRNrI.gcK6', '2022-05-03 18:46:36', NULL, 0, '1', '0', NULL, 'GYjyhwaUSH011OIEPpUriLI5w', 582746, NULL, '2022-05-03 18:45:42', '2022-05-03 22:57:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deliveries`
--

CREATE TABLE `tbl_deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `delivery_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_detail` text COLLATE utf8mb4_unicode_ci,
  `business_type` int(11) DEFAULT NULL,
  `company_website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_offer` text COLLATE utf8mb4_unicode_ci,
  `company_description` text COLLATE utf8mb4_unicode_ci,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `activation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_acc_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `publish_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holiday_mode` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deliveries_assign`
--

CREATE TABLE `tbl_deliveries_assign` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delivery_delivery_settings`
--

CREATE TABLE `tbl_delivery_delivery_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight_min` double DEFAULT NULL,
  `weight_max` double DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delivery_settings`
--

CREATE TABLE `tbl_delivery_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight_min` double DEFAULT NULL,
  `weight_max` double DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_favourites`
--

CREATE TABLE `tbl_favourites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_imesettings`
--

CREATE TABLE `tbl_imesettings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `MerchantCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TranAmount` double(8,2) DEFAULT NULL,
  `RefId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TokenId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TransactionId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Msisdn` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ResponseCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RequestDate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ResponseDate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `StatusDetail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SpecialStatus` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_measures`
--

CREATE TABLE `tbl_measures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `measure_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE `tbl_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `send_by` enum('customer','seller') COLLATE utf8mb4_unicode_ci NOT NULL,
  `seen_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `news_date` date DEFAULT NULL,
  `news_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `news_excerpt` text COLLATE utf8mb4_unicode_ci,
  `news_body` text COLLATE utf8mb4_unicode_ci,
  `external_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parallex_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `news_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `featured_news` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `view_count` bigint(20) NOT NULL DEFAULT '0',
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news_categories`
--

CREATE TABLE `tbl_news_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_body` text COLLATE utf8mb4_unicode_ci,
  `category_icon` text COLLATE utf8mb4_unicode_ci,
  `external_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `featured_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parallex_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `show_on_menu` enum('H','F','B','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `featured_category` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `extra_data` text COLLATE utf8mb4_unicode_ci,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `aff_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `ref_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `coupon_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pending` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `ready_to_ship` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `shipped` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `delivered` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `cancelled` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `failed_delivery` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`id`, `product_id`, `aff_id`, `quantity`, `ref_id`, `discount_amount`, `coupon_name`, `pending`, `ready_to_ship`, `shipped`, `delivered`, `cancelled`, `failed_delivery`, `created_at`, `updated_at`) VALUES
(1, 12, '0', 1, 'GK-R1itROiTL', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-03-24 16:31:30', '2022-03-24 16:31:30'),
(2, 12, '0', 1, 'GK-uu39Y3L2t', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-03-24 16:31:45', '2022-03-24 16:31:45'),
(3, 12, '0', 1, 'GK-yUiI6Y9BX', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-03-24 16:46:10', '2022-03-24 16:46:10'),
(4, 12, '0', 1, 'GK-vAJ2VbDjc', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-03-24 16:47:57', '2022-03-24 16:47:57'),
(5, 12, '0', 1, 'GK-SJZWqunOS', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-03-24 16:47:59', '2022-03-24 16:47:59'),
(6, 12, '0', 1, 'GK-LN0PZ2mvq', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-03-24 16:48:02', '2022-03-24 16:48:02'),
(7, 12, '0', 1, 'GK-bg11nuACk', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-03-24 16:48:14', '2022-03-24 16:48:14'),
(8, 12, '0', 1, 'GK-yXLy31KDP', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-03-24 16:50:40', '2022-03-24 16:50:40'),
(9, 12, '0', 1, 'GK-OgCfyLbdr', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-03-24 16:50:55', '2022-03-24 16:50:55'),
(10, 12, '0', 1, 'GK-8c0l87uXv', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-03-24 16:50:57', '2022-03-24 16:50:57'),
(11, 12, '0', 1, 'GK-RimL1AHve', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-03-24 16:51:00', '2022-03-24 16:51:00'),
(12, 12, '0', 1, 'GK-bqIgdfb20', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-03-24 16:53:50', '2022-03-24 16:53:50'),
(13, 149, '0', 1, 'GK-ozlRgsYh8', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 18:49:57', '2022-05-03 18:49:57'),
(14, 103, '0', 1, 'GK-ozlRgsYh8', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 18:49:57', '2022-05-03 18:49:57'),
(15, 149, '0', 1, 'GK-GWrQaSRpq', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 18:49:57', '2022-05-03 18:49:57'),
(16, 103, '0', 1, 'GK-GWrQaSRpq', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 18:49:57', '2022-05-03 18:49:57'),
(17, 149, '0', 1, 'GK-5K47eVXtx', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 18:50:19', '2022-05-03 18:50:19'),
(18, 103, '0', 1, 'GK-5K47eVXtx', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 18:50:19', '2022-05-03 18:50:19'),
(19, 149, '0', 1, 'GK-koClqw7Pd', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 18:50:39', '2022-05-03 18:50:39'),
(20, 103, '0', 1, 'GK-koClqw7Pd', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 18:50:39', '2022-05-03 18:50:39'),
(21, 149, '0', 1, 'GK-MTtADVipt', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 18:50:56', '2022-05-03 18:50:56'),
(22, 103, '0', 1, 'GK-MTtADVipt', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 18:50:56', '2022-05-03 18:50:56'),
(23, 149, '0', 1, 'GK-u1J1qIzWc', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 18:51:05', '2022-05-03 18:51:05'),
(24, 103, '0', 1, 'GK-u1J1qIzWc', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 18:51:05', '2022-05-03 18:51:05'),
(25, 149, '0', 1, 'GK-O1Pu1DZGK', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 18:51:37', '2022-05-03 18:51:37'),
(26, 103, '0', 1, 'GK-O1Pu1DZGK', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 18:51:37', '2022-05-03 18:51:37'),
(27, 114, '0', 1, 'GK-8QUicXHGN', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 20:11:19', '2022-05-03 20:11:19'),
(28, 114, '0', 1, 'GK-ZKHakMSWU', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 20:13:22', '2022-05-03 20:13:22'),
(29, 114, '0', 1, 'GK-d4DrpiF7A', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 20:23:52', '2022-05-03 20:23:52'),
(30, 114, '0', 1, 'GK-7SlFZ8shE', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 20:25:09', '2022-05-03 20:25:09'),
(31, 114, '0', 1, 'GK-qUzl0eE4f', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 20:25:18', '2022-05-03 20:25:18'),
(32, 114, '0', 1, 'GK-A9I5bLvQu', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 20:25:48', '2022-05-03 20:25:48'),
(33, 114, '0', 1, 'GK-0zczp7V4V', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 20:25:53', '2022-05-03 20:25:53'),
(34, 114, '0', 1, 'GK-EmtFpOJ0B', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 20:25:57', '2022-05-03 20:25:57'),
(35, 149, '0', 1, 'GK-oDoKi5d1q', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:42:49', '2022-05-03 22:42:49'),
(36, 102, '0', 1, 'GK-oDoKi5d1q', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:42:49', '2022-05-03 22:42:49'),
(37, 149, '0', 1, 'GK-wxErOGYn3', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:43:00', '2022-05-03 22:43:00'),
(38, 102, '0', 1, 'GK-wxErOGYn3', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:43:00', '2022-05-03 22:43:00'),
(39, 149, '0', 1, 'GK-YxsO9AcTA', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:43:01', '2022-05-03 22:43:01'),
(40, 102, '0', 1, 'GK-YxsO9AcTA', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:43:01', '2022-05-03 22:43:01'),
(41, 149, '0', 1, 'GK-UsSofku53', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:43:51', '2022-05-03 22:43:51'),
(42, 102, '0', 1, 'GK-UsSofku53', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:43:51', '2022-05-03 22:43:51'),
(43, 149, '0', 1, 'GK-lDZtGz7pP', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:43:55', '2022-05-03 22:43:55'),
(44, 102, '0', 1, 'GK-lDZtGz7pP', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:43:55', '2022-05-03 22:43:55'),
(45, 149, '0', 1, 'GK-azXy9dqCt', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:44:47', '2022-05-03 22:44:47'),
(46, 102, '0', 1, 'GK-azXy9dqCt', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:44:47', '2022-05-03 22:44:47'),
(47, 149, '0', 1, 'GK-sYwEJ2eEL', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:46:09', '2022-05-03 22:46:09'),
(48, 102, '0', 1, 'GK-sYwEJ2eEL', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:46:09', '2022-05-03 22:46:09'),
(49, 149, '0', 1, 'GK-pO1FrYhBf', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:47:00', '2022-05-03 22:47:00'),
(50, 102, '0', 1, 'GK-pO1FrYhBf', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:47:00', '2022-05-03 22:47:00'),
(51, 149, '0', 1, 'GK-sUMeiBkxU', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:47:16', '2022-05-03 22:47:16'),
(52, 102, '0', 1, 'GK-sUMeiBkxU', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:47:16', '2022-05-03 22:47:16'),
(53, 149, '0', 1, 'GK-WmqU1CIqS', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:47:21', '2022-05-03 22:47:21'),
(54, 102, '0', 1, 'GK-WmqU1CIqS', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:47:21', '2022-05-03 22:47:21'),
(55, 149, '0', 1, 'GK-7BrAG6VTY', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:47:24', '2022-05-03 22:47:24'),
(56, 102, '0', 1, 'GK-7BrAG6VTY', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:47:24', '2022-05-03 22:47:24'),
(57, 149, '0', 1, 'GK-A3BWn4G2Y', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:49:21', '2022-05-03 22:49:21'),
(58, 102, '0', 1, 'GK-A3BWn4G2Y', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:49:21', '2022-05-03 22:49:21'),
(59, 149, '0', 1, 'GK-RWq9IQTkY', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:50:01', '2022-05-03 22:50:01'),
(60, 102, '0', 1, 'GK-RWq9IQTkY', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:50:01', '2022-05-03 22:50:01'),
(61, 149, '0', 1, 'GK-6MFIgmXhe', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:52:36', '2022-05-03 22:52:36'),
(62, 102, '0', 1, 'GK-6MFIgmXhe', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:52:36', '2022-05-03 22:52:36'),
(63, 149, '0', 1, 'GK-VwdZkTL5q', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:53:23', '2022-05-03 22:53:23'),
(64, 102, '0', 1, 'GK-VwdZkTL5q', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:53:23', '2022-05-03 22:53:23'),
(65, 149, '0', 1, 'GK-rTejbjpV0', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:53:36', '2022-05-03 22:53:36'),
(66, 102, '0', 1, 'GK-rTejbjpV0', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:53:36', '2022-05-03 22:53:36'),
(67, 149, '0', 1, 'GK-BIT7p00xj', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:54:07', '2022-05-03 22:54:07'),
(68, 102, '0', 1, 'GK-BIT7p00xj', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:54:07', '2022-05-03 22:54:07'),
(69, 149, '0', 1, 'GK-UEiVEzuNb', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:57:37', '2022-05-03 22:57:37'),
(70, 102, '0', 1, 'GK-UEiVEzuNb', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:57:37', '2022-05-03 22:57:37'),
(71, 149, '0', 1, 'GK-1hdu3NkiH', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:58:00', '2022-05-03 22:58:00'),
(72, 102, '0', 1, 'GK-1hdu3NkiH', NULL, NULL, '1', '0', '0', '0', '0', '0', '2022-05-03 22:58:00', '2022-05-03 22:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_cancels`
--

CREATE TABLE `tbl_order_cancels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `ref_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `complete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `delivery_assign_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `device_type` enum('web','api') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'api',
  `esewa` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `khalti` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `imepay` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `paypal` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `master_card` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `hbl_pay` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `total_price` int(11) DEFAULT NULL,
  `old_total_price` double DEFAULT '0',
  `delivery_cost` int(11) DEFAULT NULL,
  `discount_amount` double NOT NULL DEFAULT '0',
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apartment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `gift_wrap` tinyint(1) NOT NULL DEFAULT '0',
  `different_shipping` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `shipping_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_town` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_apartment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_contactperson` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`id`, `customer_id`, `ref_id`, `paid_status`, `complete_status`, `delivery_assign_status`, `device_type`, `esewa`, `khalti`, `imepay`, `paypal`, `master_card`, `hbl_pay`, `total_price`, `old_total_price`, `delivery_cost`, `discount_amount`, `firstname`, `lastname`, `country`, `state`, `town`, `street`, `apartment`, `zipcode`, `email`, `number`, `notes`, `gift_wrap`, `different_shipping`, `shipping_country`, `shipping_state`, `shipping_town`, `shipping_street`, `shipping_apartment`, `shipping_zipcode`, `shipping_city`, `shipping_phone`, `shipping_contactperson`, `vat_number`, `company`, `created_at`, `updated_at`) VALUES
(1, 1, 'GK-R1itROiTL', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 3900, 0, 0, 100, 'Shriya', 'Maharjan', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', 'shriyamhrzn22@gmail.com', '9869199508', NULL, 0, '0', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', NULL, '9869199508', NULL, NULL, NULL, '2022-03-24 16:31:30', '2022-03-24 16:31:30'),
(2, 1, 'GK-uu39Y3L2t', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, NULL, 0, 'Shriya', 'Maharjan', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', 'shriyamhrzn22@gmail.com', '9869199508', NULL, 0, '0', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', NULL, '9869199508', NULL, NULL, NULL, '2022-03-24 16:31:45', '2022-03-24 16:31:45'),
(3, 1, 'GK-yUiI6Y9BX', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, 0, 0, 'Shriya', 'Maharjan', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', 'shriyamhrzn22@gmail.com', '9869199508', NULL, 0, '0', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', NULL, '9869199508', NULL, NULL, NULL, '2022-03-24 16:46:10', '2022-03-24 16:46:10'),
(4, 1, 'GK-vAJ2VbDjc', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, NULL, 0, 'Shriya', 'Maharjan', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', 'shriyamhrzn22@gmail.com', '9869199508', NULL, 0, '0', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', NULL, '9869199508', NULL, NULL, NULL, '2022-03-24 16:47:57', '2022-03-24 16:47:57'),
(5, 1, 'GK-SJZWqunOS', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, NULL, 0, 'Shriya', 'Maharjan', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', 'shriyamhrzn22@gmail.com', '9869199508', NULL, 0, '0', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', NULL, '9869199508', NULL, NULL, NULL, '2022-03-24 16:47:59', '2022-03-24 16:47:59'),
(6, 1, 'GK-LN0PZ2mvq', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, NULL, 0, 'Shriya', 'Maharjan', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', 'shriyamhrzn22@gmail.com', '9869199508', NULL, 0, '0', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', NULL, '9869199508', NULL, NULL, NULL, '2022-03-24 16:48:02', '2022-03-24 16:48:02'),
(7, 1, 'GK-bg11nuACk', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, 0, 0, 'Shriya', 'Maharjan', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', 'shriyamhrzn22@gmail.com', '9869199508', NULL, 0, '0', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', NULL, '9869199508', NULL, NULL, NULL, '2022-03-24 16:48:14', '2022-03-24 16:48:14'),
(8, 1, 'GK-yXLy31KDP', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, 0, 0, 'Shriya', 'Maharjan', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', 'shriyamhrzn22@gmail.com', '9869199508', NULL, 0, '0', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', NULL, '9869199508', NULL, NULL, NULL, '2022-03-24 16:50:40', '2022-03-24 16:50:40'),
(9, 1, 'GK-OgCfyLbdr', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, NULL, 0, 'Shriya', 'Maharjan', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', 'shriyamhrzn22@gmail.com', '9869199508', NULL, 0, '0', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', NULL, '9869199508', NULL, NULL, NULL, '2022-03-24 16:50:55', '2022-03-24 16:50:55'),
(10, 1, 'GK-8c0l87uXv', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, NULL, 0, 'Shriya', 'Maharjan', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', 'shriyamhrzn22@gmail.com', '9869199508', NULL, 0, '0', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', NULL, '9869199508', NULL, NULL, NULL, '2022-03-24 16:50:57', '2022-03-24 16:50:57'),
(11, 1, 'GK-RimL1AHve', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, NULL, 0, 'Shriya', 'Maharjan', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', 'shriyamhrzn22@gmail.com', '9869199508', NULL, 0, '0', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', NULL, '9869199508', NULL, NULL, NULL, '2022-03-24 16:51:00', '2022-03-24 16:51:00'),
(12, 1, 'GK-bqIgdfb20', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 3800, 0, 0, 200, 'Shriya', 'Maharjan', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', 'shriyamhrzn22@gmail.com', '9869199508', NULL, 0, '0', 'NP', NULL, NULL, 'kuleshwor', NULL, '44600', NULL, '9869199508', NULL, NULL, NULL, '2022-03-24 16:53:50', '2022-03-24 16:53:50'),
(13, 2, 'GK-ozlRgsYh8', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10500, 0, 0, 0, 'Mohan', 'Khadka', 'NP', NULL, NULL, 'newroad', NULL, '44600', 'mohan.khadka@nectardigit.com', '9865642615', 'sdsae', 0, '0', 'NP', NULL, NULL, 'newroad', NULL, '44600', NULL, '9865642615', NULL, NULL, NULL, '2022-05-03 18:49:57', '2022-05-03 18:49:57'),
(14, 2, 'GK-GWrQaSRpq', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10500, 0, 0, 0, 'Mohan', 'Khadka', 'NP', NULL, NULL, 'newroad', NULL, '44600', 'mohan.khadka@nectardigit.com', '9865642615', 'sdsae', 0, '0', 'NP', NULL, NULL, 'newroad', NULL, '44600', NULL, '9865642615', NULL, NULL, NULL, '2022-05-03 18:49:57', '2022-05-03 18:49:57'),
(15, 2, 'GK-5K47eVXtx', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10500, 0, NULL, 0, 'Mohan', 'Khadka', 'NP', NULL, NULL, 'newroad', NULL, '44600', 'mohan.khadka@nectardigit.com', '9865642615', 'sdsae', 0, '0', 'NP', NULL, NULL, 'newroad', NULL, '44600', NULL, '9865642615', NULL, NULL, NULL, '2022-05-03 18:50:19', '2022-05-03 18:50:19'),
(16, 2, 'GK-koClqw7Pd', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10500, 0, 0, 0, 'Mohan', 'Khadka', 'NP', NULL, NULL, 'newroad', NULL, '44600', 'mohan.khadka@nectardigit.com', '9865642615', 'sdsae', 0, '0', 'NP', NULL, NULL, 'newroad', NULL, '44600', NULL, '9865642615', NULL, NULL, NULL, '2022-05-03 18:50:39', '2022-05-03 18:50:39'),
(17, 2, 'GK-MTtADVipt', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10500, 0, NULL, 0, 'Mohan', 'Khadka', 'NP', NULL, NULL, 'newroad', NULL, '44600', 'mohan.khadka@nectardigit.com', '9865642615', 'sdsae', 0, '0', 'NP', NULL, NULL, 'newroad', NULL, '44600', NULL, '9865642615', NULL, NULL, NULL, '2022-05-03 18:50:56', '2022-05-03 18:50:56'),
(18, 2, 'GK-u1J1qIzWc', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10500, 0, 0, 0, 'Mohan', 'Khadka', 'NP', NULL, NULL, 'newroad', NULL, '44600', 'mohan.khadka@nectardigit.com', '9865642615', 'sdsae', 0, '0', 'NP', NULL, NULL, 'newroad', NULL, '44600', NULL, '9865642615', NULL, NULL, NULL, '2022-05-03 18:51:05', '2022-05-03 18:51:05'),
(19, 2, 'GK-O1Pu1DZGK', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10500, 0, 0, 0, 'Mohan', 'Khadka', 'NP', NULL, NULL, 'newroad', NULL, '44600', 'mohan.khadka@nectardigit.com', '9865642615', 'sdsae', 0, '0', 'NP', NULL, NULL, 'newroad', NULL, '44600', NULL, '9865642615', NULL, NULL, NULL, '2022-05-03 18:51:37', '2022-05-03 18:51:37'),
(20, 2, 'GK-8QUicXHGN', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, 0, 0, 'Mohan', 'Khadka', 'NP', NULL, NULL, 'rnac', NULL, '46800', 'mohan.khadka@nectardigit.com', '9814525123', 'eegfdhfh', 0, '0', 'NP', NULL, NULL, 'rnac', NULL, '46800', NULL, '9814525123', NULL, NULL, NULL, '2022-05-03 20:11:19', '2022-05-03 20:11:19'),
(21, 2, 'GK-ZKHakMSWU', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, 0, 0, 'Mohan', 'Khadka', 'NP', NULL, NULL, 'rnac', NULL, '44600', 'mohan.khadka@nectardigit.com', '9825152524', NULL, 0, '0', 'NP', NULL, NULL, 'rnac', NULL, '44600', NULL, '9825152524', NULL, NULL, NULL, '2022-05-03 20:13:22', '2022-05-03 20:13:22'),
(22, 2, 'GK-d4DrpiF7A', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, NULL, 0, 'Mohan', 'Khadka', 'NP', NULL, NULL, 'rnac', NULL, '44600', 'mohan.khadka@nectardigit.com', '9836586354', NULL, 0, '0', 'NP', NULL, NULL, 'rnac', NULL, '44600', NULL, '9836586354', NULL, NULL, NULL, '2022-05-03 20:23:52', '2022-05-03 20:23:52'),
(23, 2, 'GK-7SlFZ8shE', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, NULL, 0, 'Mohan', 'Khadka', 'NP', NULL, NULL, 'rnac', NULL, '44600', 'mohan.khadka@nectardigit.com', '9836586354', NULL, 0, '0', 'NP', NULL, NULL, 'rnac', NULL, '44600', NULL, '9836586354', NULL, NULL, NULL, '2022-05-03 20:25:09', '2022-05-03 20:25:09'),
(24, 2, 'GK-qUzl0eE4f', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, 0, 0, 'Mohan', 'Khadka', 'NP', NULL, NULL, 'rnac', NULL, '44600', 'mohan.khadka@nectardigit.com', '9836586354', NULL, 0, '0', 'NP', NULL, NULL, 'rnac', NULL, '44600', NULL, '9836586354', NULL, NULL, NULL, '2022-05-03 20:25:18', '2022-05-03 20:25:18'),
(25, 2, 'GK-A9I5bLvQu', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, NULL, 0, 'Mohan', 'Khadka', 'NP', NULL, NULL, 'rnac', NULL, '44600', 'mohan.khadka@nectardigit.com', '9836586354', NULL, 0, '0', 'NP', NULL, NULL, 'rnac', NULL, '44600', NULL, '9836586354', NULL, NULL, NULL, '2022-05-03 20:25:48', '2022-05-03 20:25:48'),
(26, 2, 'GK-0zczp7V4V', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, NULL, 0, 'Mohan', 'Khadka', 'NP', NULL, NULL, 'rnac', NULL, '44600', 'mohan.khadka@nectardigit.com', '9836586354', NULL, 0, '0', 'NP', NULL, NULL, 'rnac', NULL, '44600', NULL, '9836586354', NULL, NULL, NULL, '2022-05-03 20:25:53', '2022-05-03 20:25:53'),
(27, 2, 'GK-EmtFpOJ0B', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 4000, 0, 0, 0, 'Mohan', 'Khadka', 'NP', NULL, NULL, 'rnac', NULL, '44600', 'mohan.khadka@nectardigit.com', '9836586354', NULL, 0, '0', 'NP', NULL, NULL, 'rnac', NULL, '44600', NULL, '9836586354', NULL, NULL, NULL, '2022-05-03 20:25:57', '2022-05-03 20:25:57'),
(28, 2, 'GK-oDoKi5d1q', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 238750, 0, 22500, 0, 'Mohan', 'Khadka', 'IN', NULL, NULL, 'mumbai', NULL, '46412', 'mohan.khadka@nectardigit.com', '156105485', NULL, 0, '0', 'IN', NULL, NULL, 'mumbai', NULL, '46412', NULL, '156105485', NULL, NULL, NULL, '2022-05-03 22:42:49', '2022-05-03 22:42:49'),
(29, 2, 'GK-wxErOGYn3', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10750, 0, NULL, 0, 'Mohan', 'Khadka', 'IN', NULL, NULL, 'mumbai', NULL, '46412', 'mohan.khadka@nectardigit.com', '156105485', NULL, 0, '0', 'IN', NULL, NULL, 'mumbai', NULL, '46412', NULL, '156105485', NULL, NULL, NULL, '2022-05-03 22:43:00', '2022-05-03 22:43:00'),
(30, 2, 'GK-YxsO9AcTA', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10750, 0, NULL, 0, 'Mohan', 'Khadka', 'IN', NULL, NULL, 'mumbai', NULL, '46412', 'mohan.khadka@nectardigit.com', '156105485', NULL, 0, '0', 'IN', NULL, NULL, 'mumbai', NULL, '46412', NULL, '156105485', NULL, NULL, NULL, '2022-05-03 22:43:01', '2022-05-03 22:43:01'),
(31, 2, 'GK-UsSofku53', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10750, 0, NULL, 0, 'Mohan', 'Khadka', 'IN', NULL, NULL, 'mumbai', NULL, '46412', 'mohan.khadka@nectardigit.com', '156105485', NULL, 0, '0', 'IN', NULL, NULL, 'mumbai', NULL, '46412', NULL, '156105485', NULL, NULL, NULL, '2022-05-03 22:43:51', '2022-05-03 22:43:51'),
(32, 2, 'GK-lDZtGz7pP', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10750, 0, NULL, 0, 'Mohan', 'Khadka', 'IN', NULL, NULL, 'mumbai', NULL, '46412', 'mohan.khadka@nectardigit.com', '156105485', NULL, 0, '0', 'IN', NULL, NULL, 'mumbai', NULL, '46412', NULL, '156105485', NULL, NULL, NULL, '2022-05-03 22:43:55', '2022-05-03 22:43:55'),
(33, 2, 'GK-azXy9dqCt', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10750, 0, NULL, 0, 'Mohan', 'Khadka', 'IN', NULL, NULL, 'mumbai', NULL, '46412', 'mohan.khadka@nectardigit.com', '156105485', 'cargo', 0, '0', 'IN', NULL, NULL, 'mumbai', NULL, '46412', NULL, '156105485', NULL, NULL, NULL, '2022-05-03 22:44:47', '2022-05-03 22:44:47'),
(34, 2, 'GK-sYwEJ2eEL', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 30550, 0, 19800, 0, 'Mohan', 'Khadka', 'AU', NULL, NULL, 'sydney', NULL, '46412', 'mohan.khadka@nectardigit.com', '156105485', NULL, 0, '0', 'AU', NULL, NULL, 'sydney', NULL, '46412', NULL, '156105485', NULL, NULL, NULL, '2022-05-03 22:46:09', '2022-05-03 22:46:09'),
(35, 2, 'GK-pO1FrYhBf', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10750, 0, NULL, 0, 'Mohan', 'Khadka', 'AU', NULL, NULL, 'sydney', NULL, '46412', 'mohan.khadka@nectardigit.com', '156105485', NULL, 0, '0', 'AU', NULL, NULL, 'sydney', NULL, '46412', NULL, '156105485', NULL, NULL, NULL, '2022-05-03 22:47:00', '2022-05-03 22:47:00'),
(36, 2, 'GK-sUMeiBkxU', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10750, 0, NULL, 0, 'Mohan', 'Khadka', 'AU', NULL, NULL, 'sydney', NULL, '46412', 'mohan.khadka@nectardigit.com', '156105485', NULL, 0, '0', 'AU', NULL, NULL, 'sydney', NULL, '46412', NULL, '156105485', NULL, NULL, NULL, '2022-05-03 22:47:16', '2022-05-03 22:47:16'),
(37, 2, 'GK-WmqU1CIqS', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10750, 0, NULL, 0, 'Mohan', 'Khadka', 'AU', NULL, NULL, 'sydney', NULL, '46412', 'mohan.khadka@nectardigit.com', '156105485', NULL, 0, '0', 'AU', NULL, NULL, 'sydney', NULL, '46412', NULL, '156105485', NULL, NULL, NULL, '2022-05-03 22:47:21', '2022-05-03 22:47:21'),
(38, 2, 'GK-7BrAG6VTY', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10750, 0, 0, 0, 'Mohan', 'Khadka', 'AU', NULL, NULL, 'sydney', NULL, '46412', 'mohan.khadka@nectardigit.com', '156105485', NULL, 0, '0', 'AU', NULL, NULL, 'sydney', NULL, '46412', NULL, '156105485', NULL, NULL, NULL, '2022-05-03 22:47:24', '2022-05-03 22:47:24'),
(39, 2, 'GK-A3BWn4G2Y', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10750, 0, NULL, 0, 'Mohan', 'Khadka', 'AU', NULL, NULL, 'sydney', NULL, '46412', 'mohan.khadka@nectardigit.com', '156105485', NULL, 0, '0', 'AU', NULL, NULL, 'sydney', NULL, '46412', NULL, '156105485', NULL, NULL, NULL, '2022-05-03 22:49:21', '2022-05-03 22:49:21'),
(40, 2, 'GK-RWq9IQTkY', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 10750, 0, NULL, 0, 'Mohan', 'Khadka', 'AU', NULL, NULL, 'sydney', NULL, '46412', 'mohan.khadka@nectardigit.com', '156105485', NULL, 0, '0', 'AU', NULL, NULL, 'sydney', NULL, '46412', NULL, '156105485', NULL, NULL, NULL, '2022-05-03 22:50:01', '2022-05-03 22:50:01'),
(41, 2, 'GK-6MFIgmXhe', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 41250, 0, NULL, 0, 'Mohan', 'Khadka', 'FM', NULL, NULL, 'grtg', NULL, '46565', 'mohan.khadka@nectardigit.com', '874684684', NULL, 0, '0', 'FM', NULL, NULL, 'grtg', NULL, '46565', NULL, '874684684', NULL, NULL, NULL, '2022-05-03 22:52:36', '2022-05-03 22:52:36'),
(42, 2, 'GK-VwdZkTL5q', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 71750, 0, NULL, 0, 'Mohan', 'Khadka', 'FM', NULL, NULL, 'grtg', NULL, '46565', 'mohan.khadka@nectardigit.com', '874684684', NULL, 0, '0', 'FM', NULL, NULL, 'grtg', NULL, '46565', NULL, '874684684', NULL, NULL, NULL, '2022-05-03 22:53:23', '2022-05-03 22:53:23'),
(43, 2, 'GK-rTejbjpV0', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 102250, 0, NULL, 0, 'Mohan', 'Khadka', 'FM', NULL, NULL, 'grtg', NULL, '46565', 'mohan.khadka@nectardigit.com', '874684684', NULL, 0, '0', 'FM', NULL, NULL, 'grtg', NULL, '46565', NULL, '874684684', NULL, NULL, NULL, '2022-05-03 22:53:36', '2022-05-03 22:53:36'),
(44, 2, 'GK-BIT7p00xj', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 132750, 0, NULL, 0, 'Mohan', 'Khadka', 'FM', NULL, NULL, 'grtg', NULL, '46565', 'mohan.khadka@nectardigit.com', '874684684', NULL, 0, '0', 'FM', NULL, NULL, 'grtg', NULL, '46565', NULL, '874684684', NULL, NULL, NULL, '2022-05-03 22:54:07', '2022-05-03 22:54:07'),
(45, 2, 'GK-UEiVEzuNb', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 41250, 0, NULL, 0, 'Mohan', 'Khadka', 'MM', NULL, NULL, 'fgbhtd', NULL, '68465', 'mohan.khadka@nectardigit.com', '4665987435', NULL, 0, '0', 'MM', NULL, NULL, 'fgbhtd', NULL, '68465', NULL, '4665987435', NULL, NULL, NULL, '2022-05-03 22:57:37', '2022-05-03 22:57:37'),
(46, 2, 'GK-1hdu3NkiH', '0', '0', '0', 'web', '0', '0', '0', '0', '0', '0', 41250, 0, 30500, 0, 'Mohan', 'Khadka', 'MM', NULL, NULL, 'fgbhtd', NULL, '68465', 'mohan.khadka@nectardigit.com', '4665987435', NULL, 0, '0', 'MM', NULL, NULL, 'fgbhtd', NULL, '68465', NULL, '4665987435', NULL, NULL, NULL, '2022-05-03 22:58:00', '2022-05-03 22:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_photos`
--

CREATE TABLE `tbl_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `imageable_id` bigint(20) UNSIGNED NOT NULL,
  `imageable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_photos`
--

INSERT INTO `tbl_photos` (`id`, `imageable_id`, `imageable_type`, `image`, `delete_status`, `created_at`, `updated_at`) VALUES
(2, 2, 'App\\Product', 'product(1)-1641986000.jpg', '0', '2022-01-12 22:58:20', '2022-01-12 22:58:20'),
(3, 2, 'App\\Product', 'product(2)-1641986000.jpg', '0', '2022-01-12 22:58:20', '2022-01-12 22:58:20'),
(4, 2, 'App\\Product', 'product(3)-1641986000.jpg', '0', '2022-01-12 22:58:20', '2022-01-12 22:58:20'),
(8, 3, 'App\\Product', 'product(0)-1642154389.jpg', '0', '2022-01-14 21:44:49', '2022-01-14 21:44:49'),
(9, 3, 'App\\Product', 'product(1)-1642154389.jpg', '0', '2022-01-14 21:44:49', '2022-01-14 21:44:49'),
(10, 3, 'App\\Product', 'product(2)-1642154389.jpg', '0', '2022-01-14 21:44:49', '2022-01-14 21:44:49'),
(17, 6, 'App\\Product', 'product(0)-1642155690.jpg', '0', '2022-01-14 22:06:30', '2022-01-14 22:06:30'),
(18, 6, 'App\\Product', 'product(1)-1642155690.jpg', '0', '2022-01-14 22:06:30', '2022-01-14 22:06:30'),
(19, 6, 'App\\Product', 'product(2)-1642155690.jpg', '0', '2022-01-14 22:06:30', '2022-01-14 22:06:30'),
(20, 7, 'App\\Product', 'product(0)-1642155979.jpg', '0', '2022-01-14 22:11:19', '2022-01-14 22:11:19'),
(21, 8, 'App\\Product', 'product(0)-1642156873.jpg', '0', '2022-01-14 22:26:13', '2022-01-14 22:26:13'),
(22, 8, 'App\\Product', 'product(1)-1642156873.jpg', '0', '2022-01-14 22:26:13', '2022-01-14 22:26:13'),
(23, 8, 'App\\Product', 'product(2)-1642156873.jpg', '0', '2022-01-14 22:26:13', '2022-01-14 22:26:13'),
(24, 8, 'App\\Product', 'product(3)-1642156873.jpg', '0', '2022-01-14 22:26:13', '2022-01-14 22:26:13'),
(25, 1, 'App\\Product', 'product(0)-1642157088.jpg', '0', '2022-01-14 22:29:48', '2022-01-14 22:29:48'),
(26, 1, 'App\\Product', 'product(1)-1642157088.jpg', '0', '2022-01-14 22:29:48', '2022-01-14 22:29:48'),
(27, 1, 'App\\Product', 'product(2)-1642157088.jpg', '0', '2022-01-14 22:29:48', '2022-01-14 22:29:48'),
(28, 1, 'App\\Product', 'product(3)-1642157088.jpg', '0', '2022-01-14 22:29:48', '2022-01-14 22:29:48'),
(29, 9, 'App\\Product', 'product(0)-1642157268.jpg', '0', '2022-01-14 22:32:48', '2022-01-14 22:32:48'),
(30, 9, 'App\\Product', 'product(1)-1642157268.jpg', '0', '2022-01-14 22:32:48', '2022-01-14 22:32:48'),
(31, 9, 'App\\Product', 'product(2)-1642157268.jpg', '0', '2022-01-14 22:32:48', '2022-01-14 22:32:48'),
(32, 9, 'App\\Product', 'product(3)-1642157268.jpg', '0', '2022-01-14 22:32:48', '2022-01-14 22:32:48'),
(33, 10, 'App\\Product', 'product(0)-1642157495.jpg', '0', '2022-01-14 22:36:35', '2022-01-14 22:36:35'),
(34, 10, 'App\\Product', 'product(1)-1642157495.jpg', '0', '2022-01-14 22:36:35', '2022-01-14 22:36:35'),
(35, 10, 'App\\Product', 'product(2)-1642157495.jpg', '0', '2022-01-14 22:36:35', '2022-01-14 22:36:35'),
(36, 10, 'App\\Product', 'product(3)-1642157495.jpg', '0', '2022-01-14 22:36:35', '2022-01-14 22:36:35'),
(37, 11, 'App\\Product', 'product(0)-1642157736.jpg', '0', '2022-01-14 22:40:36', '2022-01-14 22:40:36'),
(38, 11, 'App\\Product', 'product(1)-1642157736.jpg', '0', '2022-01-14 22:40:36', '2022-01-14 22:40:36'),
(39, 11, 'App\\Product', 'product(2)-1642157736.jpg', '0', '2022-01-14 22:40:36', '2022-01-14 22:40:36'),
(40, 11, 'App\\Product', 'product(3)-1642157736.jpg', '0', '2022-01-14 22:40:36', '2022-01-14 22:40:36'),
(41, 12, 'App\\Product', 'product(0)-1642158152.jpg', '0', '2022-01-14 22:47:32', '2022-01-14 22:47:32'),
(42, 12, 'App\\Product', 'product(1)-1642158152.jpg', '0', '2022-01-14 22:47:32', '2022-01-14 22:47:32'),
(43, 12, 'App\\Product', 'product(2)-1642158152.jpg', '0', '2022-01-14 22:47:32', '2022-01-14 22:47:32'),
(44, 5, 'App\\Product', 'product(0)-1645093202.jpg', '0', '2022-02-17 22:05:02', '2022-02-17 22:05:02'),
(45, 13, 'App\\Product', 'product(0)-1645094296.jpg', '0', '2022-02-17 22:23:16', '2022-02-17 22:23:16'),
(50, 4, 'App\\Product', 'product(4)-1645095243.jpg', '0', '2022-02-17 22:39:03', '2022-02-17 22:39:03'),
(51, 4, 'App\\Product', 'product(5)-1645095243.jpg', '0', '2022-02-17 22:39:04', '2022-02-17 22:39:04'),
(52, 4, 'App\\Product', 'product(6)-1645095244.jpg', '0', '2022-02-17 22:39:04', '2022-02-17 22:39:04'),
(53, 4, 'App\\Product', 'product(7)-1645095244.jpg', '0', '2022-02-17 22:39:04', '2022-02-17 22:39:04'),
(55, 4, 'App\\Product', 'product(9)-1645095244.jpg', '0', '2022-02-17 22:39:04', '2022-02-17 22:39:04'),
(56, 4, 'App\\Product', 'product(10)-1645095244.jpg', '0', '2022-02-17 22:39:04', '2022-02-17 22:39:04'),
(58, 4, 'App\\Product', 'product(12)-1645095244.jpg', '0', '2022-02-17 22:39:04', '2022-02-17 22:39:04'),
(59, 4, 'App\\Product', 'product(13)-1645095244.jpg', '0', '2022-02-17 22:39:04', '2022-02-17 22:39:04'),
(60, 4, 'App\\Product', 'product(14)-1645095244.jpg', '0', '2022-02-17 22:39:04', '2022-02-17 22:39:04'),
(63, 14, 'App\\Product', 'product(0)-1646975575.jpg', '0', '2022-03-11 16:57:55', '2022-03-11 16:57:55'),
(64, 19, 'App\\Product', 'product(0)-1646977141.jpg', '0', '2022-03-11 17:24:01', '2022-03-11 17:24:01'),
(65, 19, 'App\\Product', 'product(1)-1646977141.jpg', '0', '2022-03-11 17:24:01', '2022-03-11 17:24:01'),
(66, 19, 'App\\Product', 'product(2)-1646977141.jpg', '0', '2022-03-11 17:24:01', '2022-03-11 17:24:01'),
(70, 19, 'App\\Product', 'product(6)-1646977141.jpg', '0', '2022-03-11 17:24:01', '2022-03-11 17:24:01'),
(72, 19, 'App\\Product', 'product(8)-1646977141.jpg', '0', '2022-03-11 17:24:01', '2022-03-11 17:24:01'),
(73, 19, 'App\\Product', 'product(9)-1646977141.jpg', '0', '2022-03-11 17:24:01', '2022-03-11 17:24:01'),
(78, 20, 'App\\Product', 'product(0)-1646977349.jpg', '0', '2022-03-11 17:27:29', '2022-03-11 17:27:29'),
(79, 20, 'App\\Product', 'product(1)-1646977349.jpg', '0', '2022-03-11 17:27:29', '2022-03-11 17:27:29'),
(80, 20, 'App\\Product', 'product(2)-1646977349.jpg', '0', '2022-03-11 17:27:29', '2022-03-11 17:27:29'),
(81, 20, 'App\\Product', 'product(3)-1646977349.jpg', '0', '2022-03-11 17:27:29', '2022-03-11 17:27:29'),
(82, 20, 'App\\Product', 'product(4)-1646977349.jpg', '0', '2022-03-11 17:27:29', '2022-03-11 17:27:29'),
(83, 20, 'App\\Product', 'product(5)-1646977349.jpg', '0', '2022-03-11 17:27:29', '2022-03-11 17:27:29'),
(84, 21, 'App\\Product', 'product(0)-1646998230.jpg', '0', '2022-03-11 23:15:30', '2022-03-11 23:15:30'),
(85, 21, 'App\\Product', 'product(1)-1646998230.jpg', '0', '2022-03-11 23:15:30', '2022-03-11 23:15:30'),
(86, 21, 'App\\Product', 'product(2)-1646998230.jpg', '0', '2022-03-11 23:15:30', '2022-03-11 23:15:30'),
(90, 21, 'App\\Product', 'product(6)-1646998230.jpg', '0', '2022-03-11 23:15:30', '2022-03-11 23:15:30'),
(91, 21, 'App\\Product', 'product(7)-1646998230.jpg', '0', '2022-03-11 23:15:30', '2022-03-11 23:15:30'),
(92, 21, 'App\\Product', 'product(8)-1646998230.jpg', '0', '2022-03-11 23:15:30', '2022-03-11 23:15:30'),
(93, 22, 'App\\Product', 'product(0)-1646998470.jpg', '0', '2022-03-11 23:19:30', '2022-03-11 23:19:30'),
(94, 22, 'App\\Product', 'product(1)-1646998470.jpg', '0', '2022-03-11 23:19:30', '2022-03-11 23:19:30'),
(95, 22, 'App\\Product', 'product(2)-1646998470.jpg', '0', '2022-03-11 23:19:30', '2022-03-11 23:19:30'),
(97, 22, 'App\\Product', 'product(4)-1646998470.jpg', '0', '2022-03-11 23:19:30', '2022-03-11 23:19:30'),
(98, 22, 'App\\Product', 'product(5)-1646998470.jpg', '0', '2022-03-11 23:19:30', '2022-03-11 23:19:30'),
(99, 22, 'App\\Product', 'product(6)-1646998470.jpg', '0', '2022-03-11 23:19:30', '2022-03-11 23:19:30'),
(103, 23, 'App\\Product', 'product(3)-1646998691.jpg', '0', '2022-03-11 23:23:11', '2022-03-11 23:23:11'),
(106, 23, 'App\\Product', 'product(6)-1646998691.jpg', '0', '2022-03-11 23:23:11', '2022-03-11 23:23:11'),
(107, 24, 'App\\Product', 'product(0)-1646998864.jpg', '0', '2022-03-11 23:26:04', '2022-03-11 23:26:04'),
(108, 24, 'App\\Product', 'product(1)-1646998864.jpg', '0', '2022-03-11 23:26:04', '2022-03-11 23:26:04'),
(109, 24, 'App\\Product', 'product(2)-1646998864.jpg', '0', '2022-03-11 23:26:04', '2022-03-11 23:26:04'),
(113, 24, 'App\\Product', 'product(6)-1646998864.jpg', '0', '2022-03-11 23:26:04', '2022-03-11 23:26:04'),
(114, 24, 'App\\Product', 'product(7)-1646998864.jpg', '0', '2022-03-11 23:26:04', '2022-03-11 23:26:04'),
(117, 25, 'App\\Product', 'product(0)-1646999050.jpg', '0', '2022-03-11 23:29:10', '2022-03-11 23:29:10'),
(118, 25, 'App\\Product', 'product(1)-1646999050.jpg', '0', '2022-03-11 23:29:10', '2022-03-11 23:29:10'),
(119, 25, 'App\\Product', 'product(2)-1646999050.jpg', '0', '2022-03-11 23:29:10', '2022-03-11 23:29:10'),
(121, 25, 'App\\Product', 'product(4)-1646999050.jpg', '0', '2022-03-11 23:29:10', '2022-03-11 23:29:10'),
(123, 25, 'App\\Product', 'product(6)-1646999050.jpg', '0', '2022-03-11 23:29:10', '2022-03-11 23:29:10'),
(125, 26, 'App\\Product', 'product(0)-1646999349.jpg', '0', '2022-03-11 23:34:09', '2022-03-11 23:34:09'),
(126, 26, 'App\\Product', 'product(1)-1646999349.jpg', '0', '2022-03-11 23:34:09', '2022-03-11 23:34:09'),
(127, 26, 'App\\Product', 'product(2)-1646999349.jpg', '0', '2022-03-11 23:34:09', '2022-03-11 23:34:09'),
(130, 26, 'App\\Product', 'product(5)-1646999349.jpg', '0', '2022-03-11 23:34:09', '2022-03-11 23:34:09'),
(131, 26, 'App\\Product', 'product(6)-1646999349.jpg', '0', '2022-03-11 23:34:09', '2022-03-11 23:34:09'),
(132, 27, 'App\\Product', 'product(0)-1646999550.jpg', '0', '2022-03-11 23:37:30', '2022-03-11 23:37:30'),
(133, 27, 'App\\Product', 'product(1)-1646999550.jpg', '0', '2022-03-11 23:37:30', '2022-03-11 23:37:30'),
(134, 27, 'App\\Product', 'product(2)-1646999550.jpg', '0', '2022-03-11 23:37:30', '2022-03-11 23:37:30'),
(136, 27, 'App\\Product', 'product(4)-1646999550.jpg', '0', '2022-03-11 23:37:30', '2022-03-11 23:37:30'),
(137, 27, 'App\\Product', 'product(5)-1646999550.jpg', '0', '2022-03-11 23:37:30', '2022-03-11 23:37:30'),
(138, 27, 'App\\Product', 'product(6)-1646999550.jpg', '0', '2022-03-11 23:37:30', '2022-03-11 23:37:30'),
(139, 28, 'App\\Product', 'product(0)-1646999836.jpg', '0', '2022-03-11 23:42:16', '2022-03-11 23:42:16'),
(140, 28, 'App\\Product', 'product(1)-1646999836.jpg', '0', '2022-03-11 23:42:16', '2022-03-11 23:42:16'),
(141, 28, 'App\\Product', 'product(2)-1646999836.jpg', '0', '2022-03-11 23:42:17', '2022-03-11 23:42:17'),
(144, 28, 'App\\Product', 'product(5)-1646999837.jpg', '0', '2022-03-11 23:42:17', '2022-03-11 23:42:17'),
(145, 28, 'App\\Product', 'product(6)-1646999837.jpg', '0', '2022-03-11 23:42:17', '2022-03-11 23:42:17'),
(146, 28, 'App\\Product', 'product(7)-1646999837.jpg', '0', '2022-03-11 23:42:17', '2022-03-11 23:42:17'),
(147, 29, 'App\\Product', 'product(0)-1647154008.jpg', '0', '2022-03-13 17:31:48', '2022-03-13 17:31:48'),
(148, 29, 'App\\Product', 'product(1)-1647154008.jpg', '0', '2022-03-13 17:31:48', '2022-03-13 17:31:48'),
(149, 29, 'App\\Product', 'product(2)-1647154008.jpg', '0', '2022-03-13 17:31:48', '2022-03-13 17:31:48'),
(150, 29, 'App\\Product', 'product(3)-1647154008.jpg', '0', '2022-03-13 17:31:48', '2022-03-13 17:31:48'),
(151, 29, 'App\\Product', 'product(4)-1647154008.jpg', '0', '2022-03-13 17:31:48', '2022-03-13 17:31:48'),
(152, 29, 'App\\Product', 'product(5)-1647154009.jpg', '0', '2022-03-13 17:31:49', '2022-03-13 17:31:49'),
(153, 30, 'App\\Product', 'product(0)-1647154139.jpg', '0', '2022-03-13 17:33:59', '2022-03-13 17:33:59'),
(154, 30, 'App\\Product', 'product(1)-1647154139.jpg', '0', '2022-03-13 17:34:00', '2022-03-13 17:34:00'),
(155, 30, 'App\\Product', 'product(2)-1647154140.jpg', '0', '2022-03-13 17:34:00', '2022-03-13 17:34:00'),
(156, 30, 'App\\Product', 'product(3)-1647154140.jpg', '0', '2022-03-13 17:34:00', '2022-03-13 17:34:00'),
(157, 30, 'App\\Product', 'product(4)-1647154140.jpg', '0', '2022-03-13 17:34:00', '2022-03-13 17:34:00'),
(158, 30, 'App\\Product', 'product(5)-1647154140.jpg', '0', '2022-03-13 17:34:00', '2022-03-13 17:34:00'),
(159, 30, 'App\\Product', 'product(6)-1647154140.jpg', '0', '2022-03-13 17:34:00', '2022-03-13 17:34:00'),
(160, 31, 'App\\Product', 'product(0)-1647154277.jpg', '0', '2022-03-13 17:36:17', '2022-03-13 17:36:17'),
(161, 31, 'App\\Product', 'product(1)-1647154277.jpg', '0', '2022-03-13 17:36:17', '2022-03-13 17:36:17'),
(162, 31, 'App\\Product', 'product(2)-1647154277.jpg', '0', '2022-03-13 17:36:17', '2022-03-13 17:36:17'),
(163, 31, 'App\\Product', 'product(3)-1647154277.jpg', '0', '2022-03-13 17:36:17', '2022-03-13 17:36:17'),
(164, 31, 'App\\Product', 'product(4)-1647154277.jpg', '0', '2022-03-13 17:36:17', '2022-03-13 17:36:17'),
(165, 31, 'App\\Product', 'product(5)-1647154277.jpg', '0', '2022-03-13 17:36:18', '2022-03-13 17:36:18'),
(166, 32, 'App\\Product', 'product(0)-1647154484.jpg', '0', '2022-03-13 17:39:44', '2022-03-13 17:39:44'),
(167, 32, 'App\\Product', 'product(1)-1647154484.jpg', '0', '2022-03-13 17:39:44', '2022-03-13 17:39:44'),
(168, 32, 'App\\Product', 'product(2)-1647154484.jpg', '0', '2022-03-13 17:39:44', '2022-03-13 17:39:44'),
(169, 32, 'App\\Product', 'product(3)-1647154484.jpg', '0', '2022-03-13 17:39:44', '2022-03-13 17:39:44'),
(170, 32, 'App\\Product', 'product(4)-1647154484.jpg', '0', '2022-03-13 17:39:44', '2022-03-13 17:39:44'),
(171, 32, 'App\\Product', 'product(5)-1647154484.jpg', '0', '2022-03-13 17:39:44', '2022-03-13 17:39:44'),
(172, 32, 'App\\Product', 'product(6)-1647154484.jpg', '0', '2022-03-13 17:39:44', '2022-03-13 17:39:44'),
(173, 34, 'App\\Product', 'product(0)-1647157446.jpg', '0', '2022-03-13 18:29:06', '2022-03-13 18:29:06'),
(175, 34, 'App\\Product', 'product(2)-1647157446.jpg', '0', '2022-03-13 18:29:06', '2022-03-13 18:29:06'),
(176, 34, 'App\\Product', 'product(3)-1647157446.jpg', '0', '2022-03-13 18:29:06', '2022-03-13 18:29:06'),
(177, 34, 'App\\Product', 'product(4)-1647157446.jpg', '0', '2022-03-13 18:29:06', '2022-03-13 18:29:06'),
(178, 34, 'App\\Product', 'product(5)-1647157446.jpg', '0', '2022-03-13 18:29:06', '2022-03-13 18:29:06'),
(179, 34, 'App\\Product', 'product(6)-1647157446.jpg', '0', '2022-03-13 18:29:06', '2022-03-13 18:29:06'),
(183, 35, 'App\\Product', 'product(0)-1647165896.jpg', '0', '2022-03-13 20:49:56', '2022-03-13 20:49:56'),
(184, 35, 'App\\Product', 'product(1)-1647165896.jpg', '0', '2022-03-13 20:49:56', '2022-03-13 20:49:56'),
(185, 35, 'App\\Product', 'product(2)-1647165896.jpg', '0', '2022-03-13 20:49:56', '2022-03-13 20:49:56'),
(186, 35, 'App\\Product', 'product(3)-1647165896.jpg', '0', '2022-03-13 20:49:56', '2022-03-13 20:49:56'),
(187, 35, 'App\\Product', 'product(4)-1647165896.jpg', '0', '2022-03-13 20:49:56', '2022-03-13 20:49:56'),
(193, 37, 'App\\Product', 'product(0)-1647247984.jpg', '0', '2022-03-14 19:38:04', '2022-03-14 19:38:04'),
(194, 37, 'App\\Product', 'product(1)-1647247984.jpg', '0', '2022-03-14 19:38:04', '2022-03-14 19:38:04'),
(195, 37, 'App\\Product', 'product(2)-1647247984.jpg', '0', '2022-03-14 19:38:04', '2022-03-14 19:38:04'),
(196, 37, 'App\\Product', 'product(3)-1647247984.jpg', '0', '2022-03-14 19:38:04', '2022-03-14 19:38:04'),
(197, 37, 'App\\Product', 'product(4)-1647247984.jpg', '0', '2022-03-14 19:38:04', '2022-03-14 19:38:04'),
(198, 37, 'App\\Product', 'product(5)-1647247984.jpg', '0', '2022-03-14 19:38:04', '2022-03-14 19:38:04'),
(199, 38, 'App\\Product', 'product(0)-1647248091.jpg', '0', '2022-03-14 19:39:51', '2022-03-14 19:39:51'),
(200, 38, 'App\\Product', 'product(1)-1647248091.jpg', '0', '2022-03-14 19:39:51', '2022-03-14 19:39:51'),
(201, 38, 'App\\Product', 'product(2)-1647248091.jpg', '0', '2022-03-14 19:39:51', '2022-03-14 19:39:51'),
(202, 38, 'App\\Product', 'product(3)-1647248091.jpg', '0', '2022-03-14 19:39:51', '2022-03-14 19:39:51'),
(203, 38, 'App\\Product', 'product(4)-1647248091.jpg', '0', '2022-03-14 19:39:51', '2022-03-14 19:39:51'),
(204, 38, 'App\\Product', 'product(5)-1647248091.jpg', '0', '2022-03-14 19:39:51', '2022-03-14 19:39:51'),
(205, 38, 'App\\Product', 'product(6)-1647248091.jpg', '0', '2022-03-14 19:39:51', '2022-03-14 19:39:51'),
(206, 39, 'App\\Product', 'product(0)-1647248247.jpg', '0', '2022-03-14 19:42:27', '2022-03-14 19:42:27'),
(207, 39, 'App\\Product', 'product(1)-1647248247.jpg', '0', '2022-03-14 19:42:27', '2022-03-14 19:42:27'),
(211, 39, 'App\\Product', 'product(5)-1647248248.jpg', '0', '2022-03-14 19:42:28', '2022-03-14 19:42:28'),
(212, 40, 'App\\Product', 'product(0)-1647248396.jpg', '0', '2022-03-14 19:44:56', '2022-03-14 19:44:56'),
(213, 40, 'App\\Product', 'product(1)-1647248396.jpg', '0', '2022-03-14 19:44:56', '2022-03-14 19:44:56'),
(214, 40, 'App\\Product', 'product(2)-1647248396.jpg', '0', '2022-03-14 19:44:56', '2022-03-14 19:44:56'),
(215, 40, 'App\\Product', 'product(3)-1647248396.jpg', '0', '2022-03-14 19:44:56', '2022-03-14 19:44:56'),
(216, 40, 'App\\Product', 'product(4)-1647248396.jpg', '0', '2022-03-14 19:44:56', '2022-03-14 19:44:56'),
(218, 41, 'App\\Product', 'product(0)-1647248627.jpg', '0', '2022-03-14 19:48:47', '2022-03-14 19:48:47'),
(219, 41, 'App\\Product', 'product(1)-1647248627.jpg', '0', '2022-03-14 19:48:47', '2022-03-14 19:48:47'),
(220, 41, 'App\\Product', 'product(2)-1647248627.jpg', '0', '2022-03-14 19:48:47', '2022-03-14 19:48:47'),
(221, 41, 'App\\Product', 'product(3)-1647248627.jpg', '0', '2022-03-14 19:48:47', '2022-03-14 19:48:47'),
(222, 41, 'App\\Product', 'product(4)-1647248627.jpg', '0', '2022-03-14 19:48:47', '2022-03-14 19:48:47'),
(223, 41, 'App\\Product', 'product(5)-1647248627.jpg', '0', '2022-03-14 19:48:47', '2022-03-14 19:48:47'),
(224, 43, 'App\\Product', 'product(0)-1647248954.jpg', '0', '2022-03-14 19:54:14', '2022-03-14 19:54:14'),
(225, 43, 'App\\Product', 'product(1)-1647248954.jpg', '0', '2022-03-14 19:54:14', '2022-03-14 19:54:14'),
(226, 43, 'App\\Product', 'product(2)-1647248954.jpg', '0', '2022-03-14 19:54:14', '2022-03-14 19:54:14'),
(227, 43, 'App\\Product', 'product(3)-1647248954.jpg', '0', '2022-03-14 19:54:14', '2022-03-14 19:54:14'),
(228, 43, 'App\\Product', 'product(4)-1647248954.jpg', '0', '2022-03-14 19:54:14', '2022-03-14 19:54:14'),
(229, 43, 'App\\Product', 'product(5)-1647248954.jpg', '0', '2022-03-14 19:54:14', '2022-03-14 19:54:14'),
(230, 36, 'App\\Product', 'product(0)-1648528249.jpg', '0', '2022-03-29 15:15:49', '2022-03-29 15:15:49'),
(231, 36, 'App\\Product', 'product(1)-1648528249.jpg', '0', '2022-03-29 15:15:49', '2022-03-29 15:15:49'),
(232, 36, 'App\\Product', 'product(2)-1648528249.jpg', '0', '2022-03-29 15:15:49', '2022-03-29 15:15:49'),
(233, 36, 'App\\Product', 'product(3)-1648528249.jpg', '0', '2022-03-29 15:15:49', '2022-03-29 15:15:49'),
(234, 36, 'App\\Product', 'product(4)-1648528249.jpg', '0', '2022-03-29 15:15:49', '2022-03-29 15:15:49'),
(235, 36, 'App\\Product', 'product(5)-1648528249.jpg', '0', '2022-03-29 15:15:49', '2022-03-29 15:15:49'),
(236, 36, 'App\\Product', 'product(6)-1648528249.jpg', '0', '2022-03-29 15:15:49', '2022-03-29 15:15:49'),
(237, 44, 'App\\Product', 'product(0)-1648614808.jpg', '0', '2022-03-30 15:18:28', '2022-03-30 15:18:28'),
(238, 44, 'App\\Product', 'product(1)-1648614808.jpg', '0', '2022-03-30 15:18:28', '2022-03-30 15:18:28'),
(239, 44, 'App\\Product', 'product(2)-1648614808.jpg', '0', '2022-03-30 15:18:28', '2022-03-30 15:18:28'),
(240, 44, 'App\\Product', 'product(3)-1648614808.jpg', '0', '2022-03-30 15:18:28', '2022-03-30 15:18:28'),
(241, 44, 'App\\Product', 'product(4)-1648614808.jpg', '0', '2022-03-30 15:18:28', '2022-03-30 15:18:28'),
(242, 44, 'App\\Product', 'product(5)-1648614808.jpg', '0', '2022-03-30 15:18:28', '2022-03-30 15:18:28'),
(243, 18, 'App\\Product', 'product(0)-1648717678.jpg', '0', '2022-03-31 19:52:58', '2022-03-31 19:52:58'),
(244, 18, 'App\\Product', 'product(1)-1648717678.jpg', '0', '2022-03-31 19:52:58', '2022-03-31 19:52:58'),
(245, 18, 'App\\Product', 'product(2)-1648717678.jpg', '0', '2022-03-31 19:52:58', '2022-03-31 19:52:58'),
(246, 18, 'App\\Product', 'product(3)-1648717678.jpg', '0', '2022-03-31 19:52:58', '2022-03-31 19:52:58'),
(249, 18, 'App\\Product', 'product(6)-1648717678.jpg', '0', '2022-03-31 19:52:58', '2022-03-31 19:52:58'),
(250, 18, 'App\\Product', 'product(7)-1648717678.jpg', '0', '2022-03-31 19:52:58', '2022-03-31 19:52:58'),
(251, 45, 'App\\Product', 'product(0)-1648721610.jpg', '0', '2022-03-31 20:58:30', '2022-03-31 20:58:30'),
(252, 45, 'App\\Product', 'product(1)-1648721610.jpg', '0', '2022-03-31 20:58:30', '2022-03-31 20:58:30'),
(253, 45, 'App\\Product', 'product(2)-1648721610.jpg', '0', '2022-03-31 20:58:30', '2022-03-31 20:58:30'),
(254, 45, 'App\\Product', 'product(3)-1648721610.jpg', '0', '2022-03-31 20:58:30', '2022-03-31 20:58:30'),
(255, 45, 'App\\Product', 'product(4)-1648721610.jpg', '0', '2022-03-31 20:58:30', '2022-03-31 20:58:30'),
(256, 46, 'App\\Product', 'product(0)-1648728500.jpg', '0', '2022-03-31 22:53:20', '2022-03-31 22:53:20'),
(257, 46, 'App\\Product', 'product(1)-1648728500.jpg', '0', '2022-03-31 22:53:20', '2022-03-31 22:53:20'),
(258, 46, 'App\\Product', 'product(2)-1648728501.jpg', '0', '2022-03-31 22:53:21', '2022-03-31 22:53:21'),
(259, 46, 'App\\Product', 'product(3)-1648728501.jpg', '0', '2022-03-31 22:53:21', '2022-03-31 22:53:21'),
(260, 46, 'App\\Product', 'product(4)-1648728501.jpg', '0', '2022-03-31 22:53:21', '2022-03-31 22:53:21'),
(261, 47, 'App\\Product', 'product(0)-1648728636.jpg', '0', '2022-03-31 22:55:36', '2022-03-31 22:55:36'),
(262, 47, 'App\\Product', 'product(1)-1648728636.jpg', '0', '2022-03-31 22:55:36', '2022-03-31 22:55:36'),
(263, 47, 'App\\Product', 'product(2)-1648728636.jpg', '0', '2022-03-31 22:55:36', '2022-03-31 22:55:36'),
(264, 47, 'App\\Product', 'product(3)-1648728636.jpg', '0', '2022-03-31 22:55:36', '2022-03-31 22:55:36'),
(265, 47, 'App\\Product', 'product(4)-1648728636.jpg', '0', '2022-03-31 22:55:36', '2022-03-31 22:55:36'),
(266, 47, 'App\\Product', 'product(5)-1648728636.jpg', '0', '2022-03-31 22:55:36', '2022-03-31 22:55:36'),
(267, 48, 'App\\Product', 'product(0)-1648789964.jpg', '0', '2022-04-01 15:57:44', '2022-04-01 15:57:44'),
(268, 48, 'App\\Product', 'product(1)-1648789964.jpg', '0', '2022-04-01 15:57:44', '2022-04-01 15:57:44'),
(269, 48, 'App\\Product', 'product(2)-1648789964.jpg', '0', '2022-04-01 15:57:44', '2022-04-01 15:57:44'),
(270, 48, 'App\\Product', 'product(3)-1648789964.jpg', '0', '2022-04-01 15:57:44', '2022-04-01 15:57:44'),
(271, 48, 'App\\Product', 'product(4)-1648789964.jpg', '0', '2022-04-01 15:57:44', '2022-04-01 15:57:44'),
(272, 49, 'App\\Product', 'product(0)-1648790080.jpg', '0', '2022-04-01 15:59:40', '2022-04-01 15:59:40'),
(273, 49, 'App\\Product', 'product(1)-1648790080.jpg', '0', '2022-04-01 15:59:40', '2022-04-01 15:59:40'),
(274, 49, 'App\\Product', 'product(2)-1648790080.jpg', '0', '2022-04-01 15:59:40', '2022-04-01 15:59:40'),
(275, 49, 'App\\Product', 'product(3)-1648790080.jpg', '0', '2022-04-01 15:59:40', '2022-04-01 15:59:40'),
(276, 49, 'App\\Product', 'product(4)-1648790080.jpg', '0', '2022-04-01 15:59:40', '2022-04-01 15:59:40'),
(284, 50, 'App\\Product', 'product(0)-1648790347.jpg', '0', '2022-04-01 16:04:07', '2022-04-01 16:04:07'),
(285, 50, 'App\\Product', 'product(1)-1648790347.jpg', '0', '2022-04-01 16:04:07', '2022-04-01 16:04:07'),
(286, 50, 'App\\Product', 'product(2)-1648790347.jpg', '0', '2022-04-01 16:04:07', '2022-04-01 16:04:07'),
(287, 50, 'App\\Product', 'product(3)-1648790347.jpg', '0', '2022-04-01 16:04:07', '2022-04-01 16:04:07'),
(289, 50, 'App\\Product', 'product(5)-1648790347.jpg', '0', '2022-04-01 16:04:07', '2022-04-01 16:04:07'),
(291, 51, 'App\\Product', 'product(0)-1648790448.jpg', '0', '2022-04-01 16:05:48', '2022-04-01 16:05:48'),
(292, 51, 'App\\Product', 'product(1)-1648790448.jpg', '0', '2022-04-01 16:05:48', '2022-04-01 16:05:48'),
(293, 51, 'App\\Product', 'product(2)-1648790448.jpg', '0', '2022-04-01 16:05:48', '2022-04-01 16:05:48'),
(294, 51, 'App\\Product', 'product(3)-1648790448.jpg', '0', '2022-04-01 16:05:48', '2022-04-01 16:05:48'),
(295, 51, 'App\\Product', 'product(4)-1648790448.jpg', '0', '2022-04-01 16:05:48', '2022-04-01 16:05:48'),
(296, 52, 'App\\Product', 'product(0)-1648790596.jpg', '0', '2022-04-01 16:08:16', '2022-04-01 16:08:16'),
(297, 52, 'App\\Product', 'product(1)-1648790596.jpg', '0', '2022-04-01 16:08:16', '2022-04-01 16:08:16'),
(298, 52, 'App\\Product', 'product(2)-1648790596.jpg', '0', '2022-04-01 16:08:16', '2022-04-01 16:08:16'),
(299, 52, 'App\\Product', 'product(3)-1648790596.jpg', '0', '2022-04-01 16:08:16', '2022-04-01 16:08:16'),
(300, 53, 'App\\Product', 'product(0)-1648790752.jpg', '0', '2022-04-01 16:10:52', '2022-04-01 16:10:52'),
(301, 53, 'App\\Product', 'product(1)-1648790752.jpg', '0', '2022-04-01 16:10:52', '2022-04-01 16:10:52'),
(302, 53, 'App\\Product', 'product(2)-1648790752.jpg', '0', '2022-04-01 16:10:52', '2022-04-01 16:10:52'),
(303, 53, 'App\\Product', 'product(3)-1648790752.jpg', '0', '2022-04-01 16:10:52', '2022-04-01 16:10:52'),
(304, 53, 'App\\Product', 'product(4)-1648790752.jpg', '0', '2022-04-01 16:10:53', '2022-04-01 16:10:53'),
(305, 53, 'App\\Product', 'product(5)-1648790753.jpg', '0', '2022-04-01 16:10:53', '2022-04-01 16:10:53'),
(306, 53, 'App\\Product', 'product(6)-1648790753.jpg', '0', '2022-04-01 16:10:53', '2022-04-01 16:10:53'),
(307, 54, 'App\\Product', 'product(0)-1648791026.jpg', '0', '2022-04-01 16:15:26', '2022-04-01 16:15:26'),
(308, 54, 'App\\Product', 'product(1)-1648791026.jpg', '0', '2022-04-01 16:15:26', '2022-04-01 16:15:26'),
(309, 54, 'App\\Product', 'product(2)-1648791026.jpg', '0', '2022-04-01 16:15:26', '2022-04-01 16:15:26'),
(310, 54, 'App\\Product', 'product(3)-1648791026.jpg', '0', '2022-04-01 16:15:26', '2022-04-01 16:15:26'),
(311, 54, 'App\\Product', 'product(4)-1648791026.jpg', '0', '2022-04-01 16:15:26', '2022-04-01 16:15:26'),
(312, 54, 'App\\Product', 'product(5)-1648791026.jpg', '0', '2022-04-01 16:15:26', '2022-04-01 16:15:26'),
(313, 54, 'App\\Product', 'product(6)-1648791026.jpg', '0', '2022-04-01 16:15:26', '2022-04-01 16:15:26'),
(314, 55, 'App\\Product', 'product(0)-1648794495.jpg', '0', '2022-04-01 17:13:15', '2022-04-01 17:13:15'),
(315, 55, 'App\\Product', 'product(1)-1648794495.jpg', '0', '2022-04-01 17:13:15', '2022-04-01 17:13:15'),
(316, 55, 'App\\Product', 'product(2)-1648794495.jpg', '0', '2022-04-01 17:13:15', '2022-04-01 17:13:15'),
(317, 55, 'App\\Product', 'product(3)-1648794495.jpg', '0', '2022-04-01 17:13:15', '2022-04-01 17:13:15'),
(318, 55, 'App\\Product', 'product(4)-1648794495.jpg', '0', '2022-04-01 17:13:15', '2022-04-01 17:13:15'),
(319, 55, 'App\\Product', 'product(5)-1648794495.jpg', '0', '2022-04-01 17:13:15', '2022-04-01 17:13:15'),
(322, 56, 'App\\Product', 'product(0)-1648794622.jpg', '0', '2022-04-01 17:15:22', '2022-04-01 17:15:22'),
(323, 56, 'App\\Product', 'product(1)-1648794622.jpg', '0', '2022-04-01 17:15:22', '2022-04-01 17:15:22'),
(324, 56, 'App\\Product', 'product(2)-1648794622.jpg', '0', '2022-04-01 17:15:22', '2022-04-01 17:15:22'),
(325, 56, 'App\\Product', 'product(3)-1648794622.jpg', '0', '2022-04-01 17:15:22', '2022-04-01 17:15:22'),
(326, 56, 'App\\Product', 'product(4)-1648794622.jpg', '0', '2022-04-01 17:15:22', '2022-04-01 17:15:22'),
(327, 56, 'App\\Product', 'product(5)-1648794622.jpg', '0', '2022-04-01 17:15:22', '2022-04-01 17:15:22'),
(328, 56, 'App\\Product', 'product(6)-1648794622.jpg', '0', '2022-04-01 17:15:22', '2022-04-01 17:15:22'),
(329, 57, 'App\\Product', 'product(0)-1648794991.jpg', '0', '2022-04-01 17:21:31', '2022-04-01 17:21:31'),
(330, 57, 'App\\Product', 'product(1)-1648794991.jpg', '0', '2022-04-01 17:21:31', '2022-04-01 17:21:31'),
(331, 57, 'App\\Product', 'product(2)-1648794991.jpg', '0', '2022-04-01 17:21:31', '2022-04-01 17:21:31'),
(332, 57, 'App\\Product', 'product(3)-1648794991.jpg', '0', '2022-04-01 17:21:31', '2022-04-01 17:21:31'),
(333, 57, 'App\\Product', 'product(4)-1648794991.jpg', '0', '2022-04-01 17:21:31', '2022-04-01 17:21:31'),
(334, 57, 'App\\Product', 'product(5)-1648794991.jpg', '0', '2022-04-01 17:21:31', '2022-04-01 17:21:31'),
(335, 58, 'App\\Product', 'product(0)-1648798795.jpg', '0', '2022-04-01 18:24:55', '2022-04-01 18:24:55'),
(336, 58, 'App\\Product', 'product(1)-1648798795.jpg', '0', '2022-04-01 18:24:55', '2022-04-01 18:24:55'),
(337, 58, 'App\\Product', 'product(2)-1648798795.jpg', '0', '2022-04-01 18:24:55', '2022-04-01 18:24:55'),
(338, 58, 'App\\Product', 'product(3)-1648798795.jpg', '0', '2022-04-01 18:24:55', '2022-04-01 18:24:55'),
(339, 58, 'App\\Product', 'product(4)-1648798795.jpg', '0', '2022-04-01 18:24:56', '2022-04-01 18:24:56'),
(340, 58, 'App\\Product', 'product(5)-1648798796.jpg', '0', '2022-04-01 18:24:56', '2022-04-01 18:24:56'),
(341, 58, 'App\\Product', 'product(6)-1648798796.jpg', '0', '2022-04-01 18:24:56', '2022-04-01 18:24:56'),
(342, 58, 'App\\Product', 'product(7)-1648798796.jpg', '0', '2022-04-01 18:24:56', '2022-04-01 18:24:56'),
(343, 59, 'App\\Product', 'product(0)-1648959294.jpg', '0', '2022-04-03 14:59:54', '2022-04-03 14:59:54'),
(344, 59, 'App\\Product', 'product(1)-1648959294.jpg', '0', '2022-04-03 14:59:54', '2022-04-03 14:59:54'),
(345, 59, 'App\\Product', 'product(2)-1648959294.jpg', '0', '2022-04-03 14:59:54', '2022-04-03 14:59:54'),
(346, 59, 'App\\Product', 'product(3)-1648959294.jpg', '0', '2022-04-03 14:59:54', '2022-04-03 14:59:54'),
(347, 59, 'App\\Product', 'product(4)-1648959294.jpg', '0', '2022-04-03 14:59:54', '2022-04-03 14:59:54'),
(348, 59, 'App\\Product', 'product(5)-1648959294.jpg', '0', '2022-04-03 14:59:54', '2022-04-03 14:59:54'),
(350, 60, 'App\\Product', 'product(0)-1648959423.jpg', '0', '2022-04-03 15:02:03', '2022-04-03 15:02:03'),
(351, 60, 'App\\Product', 'product(1)-1648959423.jpg', '0', '2022-04-03 15:02:03', '2022-04-03 15:02:03'),
(352, 60, 'App\\Product', 'product(2)-1648959423.jpg', '0', '2022-04-03 15:02:03', '2022-04-03 15:02:03'),
(353, 60, 'App\\Product', 'product(3)-1648959423.jpg', '0', '2022-04-03 15:02:03', '2022-04-03 15:02:03'),
(354, 60, 'App\\Product', 'product(4)-1648959423.jpg', '0', '2022-04-03 15:02:03', '2022-04-03 15:02:03'),
(355, 61, 'App\\Product', 'product(0)-1648959733.jpg', '0', '2022-04-03 15:07:13', '2022-04-03 15:07:13'),
(356, 61, 'App\\Product', 'product(1)-1648959733.jpg', '0', '2022-04-03 15:07:13', '2022-04-03 15:07:13'),
(357, 61, 'App\\Product', 'product(2)-1648959733.jpg', '0', '2022-04-03 15:07:13', '2022-04-03 15:07:13'),
(358, 61, 'App\\Product', 'product(3)-1648959733.jpg', '0', '2022-04-03 15:07:13', '2022-04-03 15:07:13'),
(359, 61, 'App\\Product', 'product(4)-1648959733.jpg', '0', '2022-04-03 15:07:13', '2022-04-03 15:07:13'),
(361, 62, 'App\\Product', 'product(0)-1648959905.jpg', '0', '2022-04-03 15:10:05', '2022-04-03 15:10:05'),
(362, 62, 'App\\Product', 'product(1)-1648959905.jpg', '0', '2022-04-03 15:10:05', '2022-04-03 15:10:05'),
(363, 62, 'App\\Product', 'product(2)-1648959905.jpg', '0', '2022-04-03 15:10:05', '2022-04-03 15:10:05'),
(364, 62, 'App\\Product', 'product(3)-1648959905.jpg', '0', '2022-04-03 15:10:05', '2022-04-03 15:10:05'),
(365, 62, 'App\\Product', 'product(4)-1648959905.jpg', '0', '2022-04-03 15:10:05', '2022-04-03 15:10:05'),
(366, 62, 'App\\Product', 'product(5)-1648959905.jpg', '0', '2022-04-03 15:10:05', '2022-04-03 15:10:05'),
(367, 62, 'App\\Product', 'product(6)-1648959905.jpg', '0', '2022-04-03 15:10:05', '2022-04-03 15:10:05'),
(368, 63, 'App\\Product', 'product(0)-1648963676.jpg', '0', '2022-04-03 16:12:56', '2022-04-03 16:12:56'),
(369, 63, 'App\\Product', 'product(1)-1648963676.jpg', '0', '2022-04-03 16:12:56', '2022-04-03 16:12:56'),
(370, 63, 'App\\Product', 'product(2)-1648963676.jpg', '0', '2022-04-03 16:12:56', '2022-04-03 16:12:56'),
(372, 63, 'App\\Product', 'product(4)-1648963676.jpg', '0', '2022-04-03 16:12:56', '2022-04-03 16:12:56'),
(373, 63, 'App\\Product', 'product(5)-1648963676.jpg', '0', '2022-04-03 16:12:56', '2022-04-03 16:12:56'),
(374, 64, 'App\\Product', 'product(0)-1648963992.jpg', '0', '2022-04-03 16:18:12', '2022-04-03 16:18:12'),
(375, 64, 'App\\Product', 'product(1)-1648963992.jpg', '0', '2022-04-03 16:18:12', '2022-04-03 16:18:12'),
(376, 64, 'App\\Product', 'product(2)-1648963992.jpg', '0', '2022-04-03 16:18:12', '2022-04-03 16:18:12'),
(377, 64, 'App\\Product', 'product(3)-1648963992.jpg', '0', '2022-04-03 16:18:12', '2022-04-03 16:18:12'),
(378, 64, 'App\\Product', 'product(4)-1648963992.jpg', '0', '2022-04-03 16:18:12', '2022-04-03 16:18:12'),
(379, 64, 'App\\Product', 'product(5)-1648963992.jpg', '0', '2022-04-03 16:18:12', '2022-04-03 16:18:12'),
(382, 65, 'App\\Product', 'product(0)-1648964287.jpg', '0', '2022-04-03 16:23:07', '2022-04-03 16:23:07'),
(383, 65, 'App\\Product', 'product(1)-1648964287.jpg', '0', '2022-04-03 16:23:07', '2022-04-03 16:23:07'),
(384, 65, 'App\\Product', 'product(2)-1648964287.jpg', '0', '2022-04-03 16:23:07', '2022-04-03 16:23:07'),
(385, 66, 'App\\Product', 'product(0)-1648964519.jpg', '0', '2022-04-03 16:26:59', '2022-04-03 16:26:59'),
(386, 66, 'App\\Product', 'product(1)-1648964519.jpg', '0', '2022-04-03 16:26:59', '2022-04-03 16:26:59'),
(387, 66, 'App\\Product', 'product(2)-1648964519.jpg', '0', '2022-04-03 16:26:59', '2022-04-03 16:26:59'),
(388, 66, 'App\\Product', 'product(3)-1648964519.jpg', '0', '2022-04-03 16:26:59', '2022-04-03 16:26:59'),
(389, 66, 'App\\Product', 'product(4)-1648964519.jpg', '0', '2022-04-03 16:26:59', '2022-04-03 16:26:59'),
(390, 67, 'App\\Product', 'product(0)-1648964632.jpg', '0', '2022-04-03 16:28:52', '2022-04-03 16:28:52'),
(391, 67, 'App\\Product', 'product(1)-1648964632.jpg', '0', '2022-04-03 16:28:52', '2022-04-03 16:28:52'),
(392, 67, 'App\\Product', 'product(2)-1648964632.jpg', '0', '2022-04-03 16:28:52', '2022-04-03 16:28:52'),
(393, 67, 'App\\Product', 'product(3)-1648964632.jpg', '0', '2022-04-03 16:28:52', '2022-04-03 16:28:52'),
(394, 67, 'App\\Product', 'product(4)-1648964632.jpg', '0', '2022-04-03 16:28:52', '2022-04-03 16:28:52'),
(395, 67, 'App\\Product', 'product(5)-1648964632.jpg', '0', '2022-04-03 16:28:52', '2022-04-03 16:28:52'),
(396, 68, 'App\\Product', 'product(0)-1648964768.jpg', '0', '2022-04-03 16:31:08', '2022-04-03 16:31:08'),
(397, 68, 'App\\Product', 'product(1)-1648964768.jpg', '0', '2022-04-03 16:31:08', '2022-04-03 16:31:08'),
(398, 68, 'App\\Product', 'product(2)-1648964768.jpg', '0', '2022-04-03 16:31:08', '2022-04-03 16:31:08'),
(399, 68, 'App\\Product', 'product(3)-1648964768.jpg', '0', '2022-04-03 16:31:08', '2022-04-03 16:31:08'),
(400, 68, 'App\\Product', 'product(4)-1648964768.jpg', '0', '2022-04-03 16:31:08', '2022-04-03 16:31:08'),
(401, 69, 'App\\Product', 'product(0)-1648967690.jpg', '0', '2022-04-03 17:19:50', '2022-04-03 17:19:50'),
(402, 69, 'App\\Product', 'product(1)-1648967690.jpg', '0', '2022-04-03 17:19:50', '2022-04-03 17:19:50'),
(403, 69, 'App\\Product', 'product(2)-1648967690.jpg', '0', '2022-04-03 17:19:50', '2022-04-03 17:19:50'),
(405, 69, 'App\\Product', 'product(4)-1648967690.jpg', '0', '2022-04-03 17:19:50', '2022-04-03 17:19:50'),
(406, 70, 'App\\Product', 'product(0)-1648968115.jpg', '0', '2022-04-03 17:26:55', '2022-04-03 17:26:55'),
(407, 70, 'App\\Product', 'product(1)-1648968115.jpg', '0', '2022-04-03 17:26:55', '2022-04-03 17:26:55'),
(408, 70, 'App\\Product', 'product(2)-1648968115.jpg', '0', '2022-04-03 17:26:55', '2022-04-03 17:26:55'),
(410, 70, 'App\\Product', 'product(4)-1648968115.jpg', '0', '2022-04-03 17:26:55', '2022-04-03 17:26:55'),
(411, 71, 'App\\Product', 'product(0)-1648968312.jpg', '0', '2022-04-03 17:30:12', '2022-04-03 17:30:12'),
(412, 71, 'App\\Product', 'product(1)-1648968312.jpg', '0', '2022-04-03 17:30:12', '2022-04-03 17:30:12'),
(413, 71, 'App\\Product', 'product(2)-1648968312.jpg', '0', '2022-04-03 17:30:12', '2022-04-03 17:30:12'),
(416, 72, 'App\\Product', 'product(1)-1648968428.jpg', '0', '2022-04-03 17:32:08', '2022-04-03 17:32:08'),
(417, 72, 'App\\Product', 'product(2)-1648968428.jpg', '0', '2022-04-03 17:32:08', '2022-04-03 17:32:08'),
(418, 72, 'App\\Product', 'product(3)-1648968428.jpg', '0', '2022-04-03 17:32:08', '2022-04-03 17:32:08'),
(419, 72, 'App\\Product', 'product(4)-1648968428.jpg', '0', '2022-04-03 17:32:08', '2022-04-03 17:32:08'),
(420, 73, 'App\\Product', 'product(0)-1648968739.jpg', '0', '2022-04-03 17:37:19', '2022-04-03 17:37:19'),
(421, 73, 'App\\Product', 'product(1)-1648968739.jpg', '0', '2022-04-03 17:37:19', '2022-04-03 17:37:19'),
(422, 73, 'App\\Product', 'product(2)-1648968739.jpg', '0', '2022-04-03 17:37:19', '2022-04-03 17:37:19'),
(425, 74, 'App\\Product', 'product(0)-1648968935.jpg', '0', '2022-04-03 17:40:35', '2022-04-03 17:40:35'),
(426, 74, 'App\\Product', 'product(1)-1648968935.jpg', '0', '2022-04-03 17:40:35', '2022-04-03 17:40:35'),
(427, 74, 'App\\Product', 'product(2)-1648968935.jpg', '0', '2022-04-03 17:40:35', '2022-04-03 17:40:35'),
(428, 74, 'App\\Product', 'product(3)-1648968935.jpg', '0', '2022-04-03 17:40:35', '2022-04-03 17:40:35'),
(429, 74, 'App\\Product', 'product(4)-1648968935.jpg', '0', '2022-04-03 17:40:35', '2022-04-03 17:40:35'),
(430, 75, 'App\\Product', 'product(0)-1648969225.jpg', '0', '2022-04-03 17:45:25', '2022-04-03 17:45:25'),
(433, 75, 'App\\Product', 'product(3)-1648969225.jpg', '0', '2022-04-03 17:45:25', '2022-04-03 17:45:25'),
(434, 75, 'App\\Product', 'product(4)-1648969225.jpg', '0', '2022-04-03 17:45:25', '2022-04-03 17:45:25'),
(435, 75, 'App\\Product', 'product(5)-1648969225.jpg', '0', '2022-04-03 17:45:25', '2022-04-03 17:45:25'),
(436, 76, 'App\\Product', 'product(0)-1648969388.jpg', '0', '2022-04-03 17:48:08', '2022-04-03 17:48:08'),
(437, 76, 'App\\Product', 'product(1)-1648969388.jpg', '0', '2022-04-03 17:48:08', '2022-04-03 17:48:08'),
(438, 76, 'App\\Product', 'product(2)-1648969388.jpg', '0', '2022-04-03 17:48:08', '2022-04-03 17:48:08'),
(440, 76, 'App\\Product', 'product(4)-1648969388.jpg', '0', '2022-04-03 17:48:08', '2022-04-03 17:48:08'),
(441, 77, 'App\\Product', 'product(0)-1648969515.jpg', '0', '2022-04-03 17:50:15', '2022-04-03 17:50:15'),
(442, 77, 'App\\Product', 'product(1)-1648969515.jpg', '0', '2022-04-03 17:50:15', '2022-04-03 17:50:15'),
(443, 77, 'App\\Product', 'product(2)-1648969515.jpg', '0', '2022-04-03 17:50:15', '2022-04-03 17:50:15'),
(444, 77, 'App\\Product', 'product(3)-1648969515.jpg', '0', '2022-04-03 17:50:15', '2022-04-03 17:50:15'),
(445, 77, 'App\\Product', 'product(4)-1648969515.jpg', '0', '2022-04-03 17:50:15', '2022-04-03 17:50:15'),
(446, 78, 'App\\Product', 'product(0)-1648969699.jpg', '0', '2022-04-03 17:53:19', '2022-04-03 17:53:19'),
(447, 78, 'App\\Product', 'product(1)-1648969699.jpg', '0', '2022-04-03 17:53:19', '2022-04-03 17:53:19'),
(448, 78, 'App\\Product', 'product(2)-1648969699.jpg', '0', '2022-04-03 17:53:19', '2022-04-03 17:53:19'),
(449, 78, 'App\\Product', 'product(3)-1648969699.jpg', '0', '2022-04-03 17:53:19', '2022-04-03 17:53:19'),
(451, 78, 'App\\Product', 'product(5)-1648969699.jpg', '0', '2022-04-03 17:53:19', '2022-04-03 17:53:19'),
(452, 79, 'App\\Product', 'product(0)-1648969926.jpg', '0', '2022-04-03 17:57:06', '2022-04-03 17:57:06'),
(453, 79, 'App\\Product', 'product(1)-1648969926.jpg', '0', '2022-04-03 17:57:06', '2022-04-03 17:57:06'),
(454, 79, 'App\\Product', 'product(2)-1648969926.jpg', '0', '2022-04-03 17:57:06', '2022-04-03 17:57:06'),
(455, 79, 'App\\Product', 'product(3)-1648969926.jpg', '0', '2022-04-03 17:57:06', '2022-04-03 17:57:06'),
(456, 79, 'App\\Product', 'product(4)-1648969926.jpg', '0', '2022-04-03 17:57:06', '2022-04-03 17:57:06'),
(457, 79, 'App\\Product', 'product(5)-1648969926.jpg', '0', '2022-04-03 17:57:06', '2022-04-03 17:57:06'),
(458, 80, 'App\\Product', 'product(0)-1648970133.jpg', '0', '2022-04-03 18:00:33', '2022-04-03 18:00:33'),
(459, 80, 'App\\Product', 'product(1)-1648970133.jpg', '0', '2022-04-03 18:00:33', '2022-04-03 18:00:33'),
(460, 80, 'App\\Product', 'product(2)-1648970133.jpg', '0', '2022-04-03 18:00:33', '2022-04-03 18:00:33'),
(461, 80, 'App\\Product', 'product(3)-1648970133.jpg', '0', '2022-04-03 18:00:33', '2022-04-03 18:00:33'),
(462, 80, 'App\\Product', 'product(4)-1648970133.jpg', '0', '2022-04-03 18:00:33', '2022-04-03 18:00:33'),
(467, 82, 'App\\Product', 'product(0)-1648970715.jpg', '0', '2022-04-03 18:10:15', '2022-04-03 18:10:15'),
(468, 82, 'App\\Product', 'product(1)-1648970715.jpg', '0', '2022-04-03 18:10:15', '2022-04-03 18:10:15'),
(469, 82, 'App\\Product', 'product(2)-1648970715.jpg', '0', '2022-04-03 18:10:15', '2022-04-03 18:10:15'),
(470, 82, 'App\\Product', 'product(3)-1648970715.jpg', '0', '2022-04-03 18:10:15', '2022-04-03 18:10:15'),
(471, 83, 'App\\Product', 'product(0)-1648977933.jpg', '0', '2022-04-03 20:10:33', '2022-04-03 20:10:33'),
(472, 83, 'App\\Product', 'product(1)-1648977933.jpg', '0', '2022-04-03 20:10:33', '2022-04-03 20:10:33'),
(473, 83, 'App\\Product', 'product(2)-1648977933.jpg', '0', '2022-04-03 20:10:33', '2022-04-03 20:10:33'),
(474, 83, 'App\\Product', 'product(3)-1648977933.jpg', '0', '2022-04-03 20:10:33', '2022-04-03 20:10:33'),
(475, 85, 'App\\Product', 'product(0)-1648978264.jpg', '0', '2022-04-03 20:16:04', '2022-04-03 20:16:04'),
(476, 85, 'App\\Product', 'product(1)-1648978264.jpg', '0', '2022-04-03 20:16:04', '2022-04-03 20:16:04'),
(477, 85, 'App\\Product', 'product(2)-1648978264.jpg', '0', '2022-04-03 20:16:04', '2022-04-03 20:16:04'),
(478, 85, 'App\\Product', 'product(3)-1648978264.jpg', '0', '2022-04-03 20:16:04', '2022-04-03 20:16:04'),
(480, 86, 'App\\Product', 'product(0)-1648978714.jpg', '0', '2022-04-03 20:23:34', '2022-04-03 20:23:34'),
(481, 86, 'App\\Product', 'product(1)-1648978714.jpg', '0', '2022-04-03 20:23:34', '2022-04-03 20:23:34'),
(482, 86, 'App\\Product', 'product(2)-1648978714.jpg', '0', '2022-04-03 20:23:34', '2022-04-03 20:23:34'),
(488, 87, 'App\\Product', 'product(2)-1648978866.jpg', '0', '2022-04-03 20:26:06', '2022-04-03 20:26:06'),
(489, 87, 'App\\Product', 'product(3)-1648978866.jpg', '0', '2022-04-03 20:26:06', '2022-04-03 20:26:06'),
(493, 88, 'App\\Product', 'product(0)-1648979039.jpg', '0', '2022-04-03 20:28:59', '2022-04-03 20:28:59'),
(494, 88, 'App\\Product', 'product(1)-1648979039.jpg', '0', '2022-04-03 20:28:59', '2022-04-03 20:28:59'),
(495, 88, 'App\\Product', 'product(2)-1648979039.jpg', '0', '2022-04-03 20:28:59', '2022-04-03 20:28:59'),
(496, 88, 'App\\Product', 'product(3)-1648979039.jpg', '0', '2022-04-03 20:28:59', '2022-04-03 20:28:59'),
(497, 89, 'App\\Product', 'product(0)-1648979474.jpg', '0', '2022-04-03 20:36:14', '2022-04-03 20:36:14'),
(498, 89, 'App\\Product', 'product(1)-1648979474.jpg', '0', '2022-04-03 20:36:14', '2022-04-03 20:36:14'),
(499, 89, 'App\\Product', 'product(2)-1648979474.jpg', '0', '2022-04-03 20:36:14', '2022-04-03 20:36:14'),
(500, 89, 'App\\Product', 'product(3)-1648979474.jpg', '0', '2022-04-03 20:36:14', '2022-04-03 20:36:14'),
(501, 89, 'App\\Product', 'product(4)-1648979474.jpg', '0', '2022-04-03 20:36:14', '2022-04-03 20:36:14'),
(505, 90, 'App\\Product', 'product(3)-1648979625.jpg', '0', '2022-04-03 20:38:45', '2022-04-03 20:38:45'),
(508, 91, 'App\\Product', 'product(1)-1648979745.jpg', '0', '2022-04-03 20:40:45', '2022-04-03 20:40:45'),
(509, 91, 'App\\Product', 'product(2)-1648979745.jpg', '0', '2022-04-03 20:40:45', '2022-04-03 20:40:45'),
(512, 91, 'App\\Product', 'product(5)-1648979745.jpg', '0', '2022-04-03 20:40:45', '2022-04-03 20:40:45'),
(526, 94, 'App\\Product', 'product(2)-1648980682.jpg', '0', '2022-04-03 20:56:22', '2022-04-03 20:56:22'),
(528, 94, 'App\\Product', 'product(4)-1648980682.jpg', '0', '2022-04-03 20:56:22', '2022-04-03 20:56:22'),
(531, 95, 'App\\Product', 'product(2)-1648980809.jpg', '0', '2022-04-03 20:58:29', '2022-04-03 20:58:29'),
(532, 95, 'App\\Product', 'product(3)-1648980809.jpg', '0', '2022-04-03 20:58:29', '2022-04-03 20:58:29'),
(533, 95, 'App\\Product', 'product(4)-1648980809.jpg', '0', '2022-04-03 20:58:29', '2022-04-03 20:58:29'),
(534, 95, 'App\\Product', 'product(5)-1648980809.jpg', '0', '2022-04-03 20:58:29', '2022-04-03 20:58:29'),
(535, 95, 'App\\Product', 'product(6)-1648980809.jpg', '0', '2022-04-03 20:58:29', '2022-04-03 20:58:29'),
(538, 96, 'App\\Product', 'product(2)-1648981035.jpg', '0', '2022-04-03 21:02:15', '2022-04-03 21:02:15'),
(540, 96, 'App\\Product', 'product(4)-1648981035.jpg', '0', '2022-04-03 21:02:15', '2022-04-03 21:02:15'),
(543, 97, 'App\\Product', 'product(2)-1648981192.jpg', '0', '2022-04-03 21:04:52', '2022-04-03 21:04:52'),
(545, 97, 'App\\Product', 'product(4)-1648981192.jpg', '0', '2022-04-03 21:04:53', '2022-04-03 21:04:53'),
(548, 98, 'App\\Product', 'product(2)-1648981354.jpg', '0', '2022-04-03 21:07:34', '2022-04-03 21:07:34'),
(549, 98, 'App\\Product', 'product(3)-1648981354.jpg', '0', '2022-04-03 21:07:34', '2022-04-03 21:07:34'),
(550, 98, 'App\\Product', 'product(4)-1648981354.jpg', '0', '2022-04-03 21:07:34', '2022-04-03 21:07:34'),
(553, 99, 'App\\Product', 'product(2)-1648981702.jpg', '0', '2022-04-03 21:13:22', '2022-04-03 21:13:22'),
(554, 99, 'App\\Product', 'product(3)-1648981702.jpg', '0', '2022-04-03 21:13:22', '2022-04-03 21:13:22'),
(555, 99, 'App\\Product', 'product(4)-1648981702.jpg', '0', '2022-04-03 21:13:22', '2022-04-03 21:13:22'),
(558, 100, 'App\\Product', 'product(2)-1648983195.jpg', '0', '2022-04-03 21:38:15', '2022-04-03 21:38:15'),
(559, 100, 'App\\Product', 'product(3)-1648983195.jpg', '0', '2022-04-03 21:38:15', '2022-04-03 21:38:15'),
(560, 100, 'App\\Product', 'product(4)-1648983195.jpg', '0', '2022-04-03 21:38:15', '2022-04-03 21:38:15'),
(563, 101, 'App\\Product', 'product(2)-1648983341.jpg', '0', '2022-04-03 21:40:41', '2022-04-03 21:40:41'),
(565, 101, 'App\\Product', 'product(4)-1648983341.jpg', '0', '2022-04-03 21:40:41', '2022-04-03 21:40:41'),
(567, 102, 'App\\Product', 'product(1)-1648983647.jpg', '0', '2022-04-03 21:45:47', '2022-04-03 21:45:47'),
(568, 102, 'App\\Product', 'product(2)-1648983647.jpg', '0', '2022-04-03 21:45:47', '2022-04-03 21:45:47'),
(569, 102, 'App\\Product', 'product(3)-1648983647.jpg', '0', '2022-04-03 21:45:47', '2022-04-03 21:45:47'),
(570, 102, 'App\\Product', 'product(4)-1648983647.jpg', '0', '2022-04-03 21:45:47', '2022-04-03 21:45:47'),
(572, 103, 'App\\Product', 'product(1)-1648984137.jpg', '0', '2022-04-03 21:53:57', '2022-04-03 21:53:57'),
(573, 103, 'App\\Product', 'product(2)-1648984137.jpg', '0', '2022-04-03 21:53:57', '2022-04-03 21:53:57'),
(574, 103, 'App\\Product', 'product(3)-1648984137.jpg', '0', '2022-04-03 21:53:57', '2022-04-03 21:53:57'),
(576, 103, 'App\\Product', 'product(5)-1648984137.jpg', '0', '2022-04-03 21:53:57', '2022-04-03 21:53:57'),
(583, 105, 'App\\Product', 'product(1)-1648984485.jpg', '0', '2022-04-03 21:59:45', '2022-04-03 21:59:45'),
(584, 105, 'App\\Product', 'product(2)-1648984485.jpg', '0', '2022-04-03 21:59:45', '2022-04-03 21:59:45'),
(586, 106, 'App\\Product', 'product(0)-1648985000.jpg', '0', '2022-04-03 22:08:20', '2022-04-03 22:08:20'),
(587, 106, 'App\\Product', 'product(1)-1648985000.jpg', '0', '2022-04-03 22:08:20', '2022-04-03 22:08:20'),
(588, 106, 'App\\Product', 'product(2)-1648985000.jpg', '0', '2022-04-03 22:08:20', '2022-04-03 22:08:20'),
(590, 106, 'App\\Product', 'product(4)-1648985000.jpg', '0', '2022-04-03 22:08:20', '2022-04-03 22:08:20'),
(593, 107, 'App\\Product', 'product(2)-1648985105.jpg', '0', '2022-04-03 22:10:05', '2022-04-03 22:10:05'),
(595, 107, 'App\\Product', 'product(4)-1648985105.jpg', '0', '2022-04-03 22:10:05', '2022-04-03 22:10:05'),
(604, 109, 'App\\Product', 'product(1)-1648985422.jpg', '0', '2022-04-03 22:15:22', '2022-04-03 22:15:22'),
(605, 109, 'App\\Product', 'product(2)-1648985422.jpg', '0', '2022-04-03 22:15:22', '2022-04-03 22:15:22'),
(606, 109, 'App\\Product', 'product(3)-1648985422.jpg', '0', '2022-04-03 22:15:22', '2022-04-03 22:15:22'),
(608, 110, 'App\\Product', 'product(0)-1648985573.jpg', '0', '2022-04-03 22:17:53', '2022-04-03 22:17:53'),
(609, 110, 'App\\Product', 'product(1)-1648985573.jpg', '0', '2022-04-03 22:17:53', '2022-04-03 22:17:53'),
(610, 110, 'App\\Product', 'product(2)-1648985573.jpg', '0', '2022-04-03 22:17:53', '2022-04-03 22:17:53'),
(611, 110, 'App\\Product', 'product(3)-1648985573.jpg', '0', '2022-04-03 22:17:53', '2022-04-03 22:17:53'),
(612, 110, 'App\\Product', 'product(4)-1648985573.jpg', '0', '2022-04-03 22:17:53', '2022-04-03 22:17:53'),
(613, 110, 'App\\Product', 'product(5)-1648985573.jpg', '0', '2022-04-03 22:17:53', '2022-04-03 22:17:53'),
(616, 111, 'App\\Product', 'product(2)-1648985721.jpg', '0', '2022-04-03 22:20:21', '2022-04-03 22:20:21'),
(619, 111, 'App\\Product', 'product(5)-1648985721.jpg', '0', '2022-04-03 22:20:22', '2022-04-03 22:20:22'),
(622, 112, 'App\\Product', 'product(2)-1648985919.jpg', '0', '2022-04-03 22:23:39', '2022-04-03 22:23:39'),
(623, 112, 'App\\Product', 'product(3)-1648985919.jpg', '0', '2022-04-03 22:23:39', '2022-04-03 22:23:39'),
(625, 113, 'App\\Product', 'product(0)-1648986040.jpg', '0', '2022-04-03 22:25:40', '2022-04-03 22:25:40'),
(626, 113, 'App\\Product', 'product(1)-1648986040.jpg', '0', '2022-04-03 22:25:40', '2022-04-03 22:25:40'),
(627, 113, 'App\\Product', 'product(2)-1648986040.jpg', '0', '2022-04-03 22:25:40', '2022-04-03 22:25:40'),
(630, 114, 'App\\Product', 'product(2)-1648986166.jpg', '0', '2022-04-03 22:27:46', '2022-04-03 22:27:46'),
(631, 114, 'App\\Product', 'product(3)-1648986166.jpg', '0', '2022-04-03 22:27:46', '2022-04-03 22:27:46'),
(632, 114, 'App\\Product', 'product(4)-1648986166.jpg', '0', '2022-04-03 22:27:46', '2022-04-03 22:27:46'),
(633, 115, 'App\\Product', 'product(0)-1648986281.jpg', '0', '2022-04-03 22:29:41', '2022-04-03 22:29:41'),
(636, 115, 'App\\Product', 'product(3)-1648986281.jpg', '0', '2022-04-03 22:29:41', '2022-04-03 22:29:41'),
(639, 116, 'App\\Product', 'product(2)-1648986590.jpg', '0', '2022-04-03 22:34:50', '2022-04-03 22:34:50'),
(640, 116, 'App\\Product', 'product(3)-1648986590.jpg', '0', '2022-04-03 22:34:50', '2022-04-03 22:34:50'),
(646, 117, 'App\\Product', 'product(2)-1648986698.jpg', '0', '2022-04-03 22:36:38', '2022-04-03 22:36:38'),
(648, 117, 'App\\Product', 'product(4)-1648986698.jpg', '0', '2022-04-03 22:36:38', '2022-04-03 22:36:38'),
(649, 118, 'App\\Product', 'product(0)-1648986999.jpg', '0', '2022-04-03 22:41:39', '2022-04-03 22:41:39'),
(651, 118, 'App\\Product', 'product(2)-1648986999.jpg', '0', '2022-04-03 22:41:39', '2022-04-03 22:41:39'),
(652, 118, 'App\\Product', 'product(3)-1648986999.jpg', '0', '2022-04-03 22:41:39', '2022-04-03 22:41:39'),
(653, 118, 'App\\Product', 'product(4)-1648986999.jpg', '0', '2022-04-03 22:41:39', '2022-04-03 22:41:39'),
(657, 119, 'App\\Product', 'product(2)-1648987264.jpg', '0', '2022-04-03 22:46:04', '2022-04-03 22:46:04'),
(658, 119, 'App\\Product', 'product(3)-1648987264.jpg', '0', '2022-04-03 22:46:04', '2022-04-03 22:46:04'),
(664, 121, 'App\\Product', 'product(2)-1648987478.jpg', '0', '2022-04-03 22:49:38', '2022-04-03 22:49:38'),
(665, 121, 'App\\Product', 'product(3)-1648987478.jpg', '0', '2022-04-03 22:49:38', '2022-04-03 22:49:38'),
(666, 122, 'App\\Product', 'product(0)-1648987591.jpg', '0', '2022-04-03 22:51:31', '2022-04-03 22:51:31');
INSERT INTO `tbl_photos` (`id`, `imageable_id`, `imageable_type`, `image`, `delete_status`, `created_at`, `updated_at`) VALUES
(667, 122, 'App\\Product', 'product(1)-1648987591.jpg', '0', '2022-04-03 22:51:31', '2022-04-03 22:51:31'),
(668, 122, 'App\\Product', 'product(2)-1648987591.jpg', '0', '2022-04-03 22:51:31', '2022-04-03 22:51:31'),
(671, 123, 'App\\Product', 'product(2)-1648987729.jpg', '0', '2022-04-03 22:53:49', '2022-04-03 22:53:49'),
(672, 123, 'App\\Product', 'product(3)-1648987729.jpg', '0', '2022-04-03 22:53:49', '2022-04-03 22:53:49'),
(673, 123, 'App\\Product', 'product(4)-1648987729.jpg', '0', '2022-04-03 22:53:49', '2022-04-03 22:53:49'),
(676, 124, 'App\\Product', 'product(2)-1648988047.jpg', '0', '2022-04-03 22:59:07', '2022-04-03 22:59:07'),
(677, 124, 'App\\Product', 'product(3)-1648988047.jpg', '0', '2022-04-03 22:59:07', '2022-04-03 22:59:07'),
(679, 124, 'App\\Product', 'product(5)-1648988047.jpg', '0', '2022-04-03 22:59:07', '2022-04-03 22:59:07'),
(681, 125, 'App\\Product', 'product(1)-1648988176.jpg', '0', '2022-04-03 23:01:16', '2022-04-03 23:01:16'),
(682, 125, 'App\\Product', 'product(2)-1648988176.jpg', '0', '2022-04-03 23:01:16', '2022-04-03 23:01:16'),
(683, 125, 'App\\Product', 'product(3)-1648988176.jpg', '0', '2022-04-03 23:01:16', '2022-04-03 23:01:16'),
(684, 125, 'App\\Product', 'product(4)-1648988176.jpg', '0', '2022-04-03 23:01:16', '2022-04-03 23:01:16'),
(685, 125, 'App\\Product', 'product(5)-1648988176.jpg', '0', '2022-04-03 23:01:16', '2022-04-03 23:01:16'),
(686, 126, 'App\\Product', 'product(0)-1649045077.jpg', '0', '2022-04-04 14:49:38', '2022-04-04 14:49:38'),
(687, 126, 'App\\Product', 'product(1)-1649045078.jpg', '0', '2022-04-04 14:49:38', '2022-04-04 14:49:38'),
(688, 126, 'App\\Product', 'product(2)-1649045078.jpg', '0', '2022-04-04 14:49:38', '2022-04-04 14:49:38'),
(689, 126, 'App\\Product', 'product(3)-1649045078.jpg', '0', '2022-04-04 14:49:38', '2022-04-04 14:49:38'),
(693, 128, 'App\\Product', 'product(2)-1649054355.jpg', '0', '2022-04-04 17:24:15', '2022-04-04 17:24:15'),
(694, 128, 'App\\Product', 'product(3)-1649054355.jpg', '0', '2022-04-04 17:24:15', '2022-04-04 17:24:15'),
(696, 128, 'App\\Product', 'product(5)-1649054355.jpg', '0', '2022-04-04 17:24:15', '2022-04-04 17:24:15'),
(699, 129, 'App\\Product', 'product(2)-1649054710.jpg', '0', '2022-04-04 17:30:10', '2022-04-04 17:30:10'),
(701, 129, 'App\\Product', 'product(4)-1649054710.jpg', '0', '2022-04-04 17:30:10', '2022-04-04 17:30:10'),
(702, 129, 'App\\Product', 'product(5)-1649054710.jpg', '0', '2022-04-04 17:30:11', '2022-04-04 17:30:11'),
(703, 130, 'App\\Product', 'product(0)-1649054873.jpg', '0', '2022-04-04 17:32:53', '2022-04-04 17:32:53'),
(704, 130, 'App\\Product', 'product(1)-1649054873.jpg', '0', '2022-04-04 17:32:53', '2022-04-04 17:32:53'),
(705, 130, 'App\\Product', 'product(2)-1649054873.jpg', '0', '2022-04-04 17:32:53', '2022-04-04 17:32:53'),
(706, 130, 'App\\Product', 'product(3)-1649054873.jpg', '0', '2022-04-04 17:32:53', '2022-04-04 17:32:53'),
(710, 131, 'App\\Product', 'product(2)-1649054980.jpg', '0', '2022-04-04 17:34:40', '2022-04-04 17:34:40'),
(715, 132, 'App\\Product', 'product(2)-1649055195.jpg', '0', '2022-04-04 17:38:15', '2022-04-04 17:38:15'),
(718, 132, 'App\\Product', 'product(5)-1649055195.jpg', '0', '2022-04-04 17:38:15', '2022-04-04 17:38:15'),
(719, 133, 'App\\Product', 'product(0)-1649055292.jpg', '0', '2022-04-04 17:39:52', '2022-04-04 17:39:52'),
(720, 133, 'App\\Product', 'product(1)-1649055292.jpg', '0', '2022-04-04 17:39:52', '2022-04-04 17:39:52'),
(721, 133, 'App\\Product', 'product(2)-1649055292.jpg', '0', '2022-04-04 17:39:52', '2022-04-04 17:39:52'),
(723, 133, 'App\\Product', 'product(4)-1649055292.jpg', '0', '2022-04-04 17:39:52', '2022-04-04 17:39:52'),
(724, 134, 'App\\Product', 'product(0)-1649055517.jpg', '0', '2022-04-04 17:43:37', '2022-04-04 17:43:37'),
(725, 134, 'App\\Product', 'product(1)-1649055517.jpg', '0', '2022-04-04 17:43:37', '2022-04-04 17:43:37'),
(726, 134, 'App\\Product', 'product(2)-1649055517.jpg', '0', '2022-04-04 17:43:37', '2022-04-04 17:43:37'),
(728, 134, 'App\\Product', 'product(4)-1649055517.jpg', '0', '2022-04-04 17:43:37', '2022-04-04 17:43:37'),
(733, 135, 'App\\Product', 'product(4)-1649055613.jpg', '0', '2022-04-04 17:45:13', '2022-04-04 17:45:13'),
(734, 136, 'App\\Product', 'product(0)-1649055769.jpg', '0', '2022-04-04 17:47:49', '2022-04-04 17:47:49'),
(735, 136, 'App\\Product', 'product(1)-1649055769.jpg', '0', '2022-04-04 17:47:49', '2022-04-04 17:47:49'),
(737, 136, 'App\\Product', 'product(3)-1649055769.jpg', '0', '2022-04-04 17:47:49', '2022-04-04 17:47:49'),
(738, 136, 'App\\Product', 'product(4)-1649055769.jpg', '0', '2022-04-04 17:47:49', '2022-04-04 17:47:49'),
(745, 137, 'App\\Product', 'product(6)-1649057224.jpg', '0', '2022-04-04 18:12:04', '2022-04-04 18:12:04'),
(747, 138, 'App\\Product', 'product(1)-1649057331.jpg', '0', '2022-04-04 18:13:51', '2022-04-04 18:13:51'),
(749, 138, 'App\\Product', 'product(3)-1649057331.jpg', '0', '2022-04-04 18:13:51', '2022-04-04 18:13:51'),
(750, 138, 'App\\Product', 'product(4)-1649057331.jpg', '0', '2022-04-04 18:13:51', '2022-04-04 18:13:51'),
(751, 139, 'App\\Product', 'product(0)-1649057431.jpg', '0', '2022-04-04 18:15:31', '2022-04-04 18:15:31'),
(752, 139, 'App\\Product', 'product(1)-1649057431.jpg', '0', '2022-04-04 18:15:31', '2022-04-04 18:15:31'),
(754, 139, 'App\\Product', 'product(3)-1649057431.jpg', '0', '2022-04-04 18:15:31', '2022-04-04 18:15:31'),
(755, 139, 'App\\Product', 'product(4)-1649057431.jpg', '0', '2022-04-04 18:15:31', '2022-04-04 18:15:31'),
(756, 141, 'App\\Product', 'product(0)-1649059591.jpg', '0', '2022-04-04 18:51:32', '2022-04-04 18:51:32'),
(757, 141, 'App\\Product', 'product(1)-1649059592.jpg', '0', '2022-04-04 18:51:32', '2022-04-04 18:51:32'),
(758, 141, 'App\\Product', 'product(2)-1649059592.jpg', '0', '2022-04-04 18:51:32', '2022-04-04 18:51:32'),
(764, 92, 'App\\Product', 'product(2)-1649151215.jpg', '0', '2022-04-05 20:18:35', '2022-04-05 20:18:35'),
(767, 92, 'App\\Product', 'product(5)-1649151215.jpg', '0', '2022-04-05 20:18:35', '2022-04-05 20:18:35'),
(775, 93, 'App\\Product', 'product(0)-1649151743.jpg', '0', '2022-04-05 20:27:23', '2022-04-05 20:27:23'),
(776, 93, 'App\\Product', 'product(1)-1649151743.jpg', '0', '2022-04-05 20:27:23', '2022-04-05 20:27:23'),
(777, 93, 'App\\Product', 'product(2)-1649151743.jpg', '0', '2022-04-05 20:27:23', '2022-04-05 20:27:23'),
(778, 93, 'App\\Product', 'product(3)-1649151743.jpg', '0', '2022-04-05 20:27:23', '2022-04-05 20:27:23'),
(779, 93, 'App\\Product', 'product(4)-1649151743.jpg', '0', '2022-04-05 20:27:23', '2022-04-05 20:27:23'),
(780, 93, 'App\\Product', 'product(5)-1649151743.jpg', '0', '2022-04-05 20:27:23', '2022-04-05 20:27:23'),
(785, 108, 'App\\Product', 'product(3)-1649154697.jpg', '0', '2022-04-05 21:16:37', '2022-04-05 21:16:37'),
(787, 108, 'App\\Product', 'product(5)-1649154697.jpg', '0', '2022-04-05 21:16:37', '2022-04-05 21:16:37'),
(790, 81, 'App\\Product', 'product(0)-1649157299.jpg', '0', '2022-04-05 21:59:59', '2022-04-05 21:59:59'),
(791, 81, 'App\\Product', 'product(1)-1649157299.jpg', '0', '2022-04-05 21:59:59', '2022-04-05 21:59:59'),
(792, 81, 'App\\Product', 'product(2)-1649157299.jpg', '0', '2022-04-05 21:59:59', '2022-04-05 21:59:59'),
(794, 120, 'App\\Product', 'product(0)-1649157586.jpg', '0', '2022-04-05 22:04:46', '2022-04-05 22:04:46'),
(795, 18, 'App\\Product', 'product(0)-1649410265.jpg', '0', '2022-04-08 20:16:05', '2022-04-08 20:16:05'),
(796, 19, 'App\\Product', 'product(0)-1649410405.jpg', '0', '2022-04-08 20:18:25', '2022-04-08 20:18:25'),
(797, 21, 'App\\Product', 'product(0)-1649410559.jpg', '0', '2022-04-08 20:20:59', '2022-04-08 20:20:59'),
(798, 21, 'App\\Product', 'product(1)-1649410559.jpg', '0', '2022-04-08 20:20:59', '2022-04-08 20:20:59'),
(799, 22, 'App\\Product', 'product(0)-1649410675.jpg', '0', '2022-04-08 20:22:55', '2022-04-08 20:22:55'),
(800, 23, 'App\\Product', 'product(0)-1649410862.jpg', '0', '2022-04-08 20:26:02', '2022-04-08 20:26:02'),
(801, 23, 'App\\Product', 'product(1)-1649410862.jpg', '0', '2022-04-08 20:26:02', '2022-04-08 20:26:02'),
(802, 24, 'App\\Product', 'product(0)-1649410990.jpg', '0', '2022-04-08 20:28:10', '2022-04-08 20:28:10'),
(803, 25, 'App\\Product', 'product(0)-1649411126.jpg', '0', '2022-04-08 20:30:26', '2022-04-08 20:30:26'),
(804, 26, 'App\\Product', 'product(0)-1649411194.jpg', '0', '2022-04-08 20:31:34', '2022-04-08 20:31:34'),
(805, 28, 'App\\Product', 'product(0)-1649411373.jpg', '0', '2022-04-08 20:34:33', '2022-04-08 20:34:33'),
(806, 34, 'App\\Product', 'product(0)-1649411861.jpg', '0', '2022-04-08 20:42:41', '2022-04-08 20:42:41'),
(807, 40, 'App\\Product', 'product(0)-1649411956.jpg', '0', '2022-04-08 20:44:16', '2022-04-08 20:44:16'),
(808, 42, 'App\\Product', 'product(0)-1649412115.jpg', '0', '2022-04-08 20:46:55', '2022-04-08 20:46:55'),
(809, 42, 'App\\Product', 'product(1)-1649412115.jpg', '0', '2022-04-08 20:46:55', '2022-04-08 20:46:55'),
(810, 42, 'App\\Product', 'product(2)-1649412115.jpg', '0', '2022-04-08 20:46:55', '2022-04-08 20:46:55'),
(811, 42, 'App\\Product', 'product(3)-1649412115.jpg', '0', '2022-04-08 20:46:55', '2022-04-08 20:46:55'),
(812, 42, 'App\\Product', 'product(4)-1649412115.jpg', '0', '2022-04-08 20:46:55', '2022-04-08 20:46:55'),
(813, 42, 'App\\Product', 'product(5)-1649412115.jpg', '0', '2022-04-08 20:46:55', '2022-04-08 20:46:55'),
(814, 50, 'App\\Product', 'product(0)-1649412857.jpg', '0', '2022-04-08 20:59:17', '2022-04-08 20:59:17'),
(815, 50, 'App\\Product', 'product(1)-1649412857.jpg', '0', '2022-04-08 20:59:17', '2022-04-08 20:59:17'),
(816, 52, 'App\\Product', 'product(0)-1649413001.jpg', '0', '2022-04-08 21:01:41', '2022-04-08 21:01:41'),
(817, 55, 'App\\Product', 'product(0)-1649413331.jpg', '0', '2022-04-08 21:07:11', '2022-04-08 21:07:11'),
(818, 59, 'App\\Product', 'product(0)-1649413897.jpg', '0', '2022-04-08 21:16:37', '2022-04-08 21:16:37'),
(819, 61, 'App\\Product', 'product(0)-1649419068.jpg', '0', '2022-04-08 22:42:48', '2022-04-08 22:42:48'),
(820, 63, 'App\\Product', 'product(0)-1649419251.jpg', '0', '2022-04-08 22:45:51', '2022-04-08 22:45:51'),
(823, 65, 'App\\Product', 'product(0)-1649419493.jpg', '0', '2022-04-08 22:49:53', '2022-04-08 22:49:53'),
(824, 69, 'App\\Product', 'product(0)-1649569618.jpg', '0', '2022-04-10 16:31:58', '2022-04-10 16:31:58'),
(825, 70, 'App\\Product', 'product(0)-1649587821.jpg', '0', '2022-04-10 21:35:21', '2022-04-10 21:35:21'),
(826, 71, 'App\\Product', 'product(0)-1649587888.jpg', '0', '2022-04-10 21:36:28', '2022-04-10 21:36:28'),
(827, 72, 'App\\Product', 'product(0)-1649587950.jpg', '0', '2022-04-10 21:37:30', '2022-04-10 21:37:30'),
(828, 73, 'App\\Product', 'product(0)-1649588042.jpg', '0', '2022-04-10 21:39:02', '2022-04-10 21:39:02'),
(829, 75, 'App\\Product', 'product(0)-1649588180.jpg', '0', '2022-04-10 21:41:20', '2022-04-10 21:41:20'),
(830, 75, 'App\\Product', 'product(1)-1649588180.jpg', '0', '2022-04-10 21:41:20', '2022-04-10 21:41:20'),
(831, 76, 'App\\Product', 'product(0)-1649588278.jpg', '0', '2022-04-10 21:42:58', '2022-04-10 21:42:58'),
(832, 78, 'App\\Product', 'product(0)-1649588423.jpg', '0', '2022-04-10 21:45:23', '2022-04-10 21:45:23'),
(833, 81, 'App\\Product', 'product(0)-1649588548.jpg', '0', '2022-04-10 21:47:28', '2022-04-10 21:47:28'),
(834, 85, 'App\\Product', 'product(0)-1649588620.jpg', '0', '2022-04-10 21:48:40', '2022-04-10 21:48:40'),
(835, 85, 'App\\Product', 'product(1)-1649588620.jpg', '0', '2022-04-10 21:48:40', '2022-04-10 21:48:40'),
(836, 86, 'App\\Product', 'product(0)-1649588747.jpg', '0', '2022-04-10 21:50:48', '2022-04-10 21:50:48'),
(837, 86, 'App\\Product', 'product(1)-1649588748.jpg', '0', '2022-04-10 21:50:48', '2022-04-10 21:50:48'),
(838, 87, 'App\\Product', 'product(0)-1649588979.jpg', '0', '2022-04-10 21:54:39', '2022-04-10 21:54:39'),
(839, 87, 'App\\Product', 'product(1)-1649588980.jpg', '0', '2022-04-10 21:54:40', '2022-04-10 21:54:40'),
(840, 87, 'App\\Product', 'product(2)-1649588980.jpg', '0', '2022-04-10 21:54:40', '2022-04-10 21:54:40'),
(841, 87, 'App\\Product', 'product(3)-1649588980.jpg', '0', '2022-04-10 21:54:40', '2022-04-10 21:54:40'),
(842, 88, 'App\\Product', 'product(0)-1649589120.jpg', '0', '2022-04-10 21:57:00', '2022-04-10 21:57:00'),
(843, 90, 'App\\Product', 'product(0)-1649589309.jpg', '0', '2022-04-10 22:00:09', '2022-04-10 22:00:09'),
(844, 90, 'App\\Product', 'product(1)-1649589309.jpg', '0', '2022-04-10 22:00:09', '2022-04-10 22:00:09'),
(845, 90, 'App\\Product', 'product(2)-1649589309.jpg', '0', '2022-04-10 22:00:09', '2022-04-10 22:00:09'),
(846, 90, 'App\\Product', 'product(3)-1649589309.jpg', '0', '2022-04-10 22:00:09', '2022-04-10 22:00:09'),
(847, 91, 'App\\Product', 'product(0)-1649589417.jpg', '0', '2022-04-10 22:01:57', '2022-04-10 22:01:57'),
(848, 91, 'App\\Product', 'product(1)-1649589417.jpg', '0', '2022-04-10 22:01:57', '2022-04-10 22:01:57'),
(849, 91, 'App\\Product', 'product(2)-1649589417.jpg', '0', '2022-04-10 22:01:57', '2022-04-10 22:01:57'),
(850, 92, 'App\\Product', 'product(0)-1649589509.jpg', '0', '2022-04-10 22:03:29', '2022-04-10 22:03:29'),
(851, 92, 'App\\Product', 'product(1)-1649589509.jpg', '0', '2022-04-10 22:03:29', '2022-04-10 22:03:29'),
(852, 92, 'App\\Product', 'product(2)-1649589509.jpg', '0', '2022-04-10 22:03:29', '2022-04-10 22:03:29'),
(853, 94, 'App\\Product', 'product(0)-1649589646.jpg', '0', '2022-04-10 22:05:46', '2022-04-10 22:05:46'),
(854, 94, 'App\\Product', 'product(1)-1649589646.jpg', '0', '2022-04-10 22:05:46', '2022-04-10 22:05:46'),
(855, 94, 'App\\Product', 'product(2)-1649589646.jpg', '0', '2022-04-10 22:05:46', '2022-04-10 22:05:46'),
(856, 95, 'App\\Product', 'product(0)-1649589811.jpg', '0', '2022-04-10 22:08:31', '2022-04-10 22:08:31'),
(857, 95, 'App\\Product', 'product(1)-1649589811.jpg', '0', '2022-04-10 22:08:31', '2022-04-10 22:08:31'),
(858, 96, 'App\\Product', 'product(0)-1649589917.jpg', '0', '2022-04-10 22:10:17', '2022-04-10 22:10:17'),
(859, 96, 'App\\Product', 'product(1)-1649589917.jpg', '0', '2022-04-10 22:10:17', '2022-04-10 22:10:17'),
(860, 96, 'App\\Product', 'product(2)-1649589917.jpg', '0', '2022-04-10 22:10:17', '2022-04-10 22:10:17'),
(861, 96, 'App\\Product', 'product(3)-1649589917.jpg', '0', '2022-04-10 22:10:17', '2022-04-10 22:10:17'),
(862, 97, 'App\\Product', 'product(0)-1649590010.jpg', '0', '2022-04-10 22:11:50', '2022-04-10 22:11:50'),
(863, 97, 'App\\Product', 'product(1)-1649590010.jpg', '0', '2022-04-10 22:11:50', '2022-04-10 22:11:50'),
(864, 97, 'App\\Product', 'product(2)-1649590010.jpg', '0', '2022-04-10 22:11:50', '2022-04-10 22:11:50'),
(865, 98, 'App\\Product', 'product(0)-1649590067.jpg', '0', '2022-04-10 22:12:47', '2022-04-10 22:12:47'),
(866, 98, 'App\\Product', 'product(1)-1649590067.jpg', '0', '2022-04-10 22:12:47', '2022-04-10 22:12:47'),
(867, 99, 'App\\Product', 'product(0)-1649590145.jpg', '0', '2022-04-10 22:14:05', '2022-04-10 22:14:05'),
(868, 99, 'App\\Product', 'product(1)-1649590145.jpg', '0', '2022-04-10 22:14:05', '2022-04-10 22:14:05'),
(869, 100, 'App\\Product', 'product(0)-1649590237.jpg', '0', '2022-04-10 22:15:37', '2022-04-10 22:15:37'),
(870, 100, 'App\\Product', 'product(1)-1649590237.jpg', '0', '2022-04-10 22:15:37', '2022-04-10 22:15:37'),
(871, 101, 'App\\Product', 'product(0)-1649590331.jpg', '0', '2022-04-10 22:17:11', '2022-04-10 22:17:11'),
(872, 101, 'App\\Product', 'product(1)-1649590331.jpg', '0', '2022-04-10 22:17:11', '2022-04-10 22:17:11'),
(873, 101, 'App\\Product', 'product(2)-1649590331.jpg', '0', '2022-04-10 22:17:11', '2022-04-10 22:17:11'),
(874, 101, 'App\\Product', 'product(3)-1649590331.jpg', '0', '2022-04-10 22:17:11', '2022-04-10 22:17:11'),
(875, 104, 'App\\Product', 'product(0)-1650606677.jpg', '0', '2022-04-22 16:36:17', '2022-04-22 16:36:17'),
(876, 104, 'App\\Product', 'product(1)-1650606677.jpg', '0', '2022-04-22 16:36:17', '2022-04-22 16:36:17'),
(877, 104, 'App\\Product', 'product(2)-1650606677.jpg', '0', '2022-04-22 16:36:17', '2022-04-22 16:36:17'),
(878, 105, 'App\\Product', 'product(0)-1650606777.jpg', '0', '2022-04-22 16:37:57', '2022-04-22 16:37:57'),
(879, 105, 'App\\Product', 'product(1)-1650606777.jpg', '0', '2022-04-22 16:37:57', '2022-04-22 16:37:57'),
(880, 107, 'App\\Product', 'product(0)-1650606921.jpg', '0', '2022-04-22 16:40:21', '2022-04-22 16:40:21'),
(881, 107, 'App\\Product', 'product(1)-1650606921.jpg', '0', '2022-04-22 16:40:21', '2022-04-22 16:40:21'),
(882, 107, 'App\\Product', 'product(2)-1650606921.jpg', '0', '2022-04-22 16:40:21', '2022-04-22 16:40:21'),
(883, 107, 'App\\Product', 'product(3)-1650606921.jpg', '0', '2022-04-22 16:40:21', '2022-04-22 16:40:21'),
(884, 108, 'App\\Product', 'product(0)-1650607036.jpg', '0', '2022-04-22 16:42:16', '2022-04-22 16:42:16'),
(885, 108, 'App\\Product', 'product(1)-1650607036.jpg', '0', '2022-04-22 16:42:16', '2022-04-22 16:42:16'),
(886, 108, 'App\\Product', 'product(2)-1650607036.jpg', '0', '2022-04-22 16:42:16', '2022-04-22 16:42:16'),
(887, 108, 'App\\Product', 'product(3)-1650607036.jpg', '0', '2022-04-22 16:42:17', '2022-04-22 16:42:17'),
(888, 108, 'App\\Product', 'product(4)-1650607037.jpg', '0', '2022-04-22 16:42:17', '2022-04-22 16:42:17'),
(889, 109, 'App\\Product', 'product(0)-1650607132.jpg', '0', '2022-04-22 16:43:52', '2022-04-22 16:43:52'),
(890, 109, 'App\\Product', 'product(1)-1650607132.jpg', '0', '2022-04-22 16:43:52', '2022-04-22 16:43:52'),
(891, 111, 'App\\Product', 'product(0)-1650607269.jpg', '0', '2022-04-22 16:46:09', '2022-04-22 16:46:09'),
(892, 111, 'App\\Product', 'product(1)-1650607269.jpg', '0', '2022-04-22 16:46:09', '2022-04-22 16:46:09'),
(893, 111, 'App\\Product', 'product(2)-1650607269.jpg', '0', '2022-04-22 16:46:10', '2022-04-22 16:46:10'),
(894, 112, 'App\\Product', 'product(0)-1650607483.jpg', '0', '2022-04-22 16:49:43', '2022-04-22 16:49:43'),
(895, 112, 'App\\Product', 'product(1)-1650607483.jpg', '0', '2022-04-22 16:49:43', '2022-04-22 16:49:43'),
(896, 112, 'App\\Product', 'product(2)-1650607483.jpg', '0', '2022-04-22 16:49:43', '2022-04-22 16:49:43'),
(897, 114, 'App\\Product', 'product(0)-1650607996.jpg', '0', '2022-04-22 16:58:16', '2022-04-22 16:58:16'),
(898, 114, 'App\\Product', 'product(1)-1650607996.jpg', '0', '2022-04-22 16:58:16', '2022-04-22 16:58:16'),
(899, 115, 'App\\Product', 'product(0)-1650608111.jpg', '0', '2022-04-22 17:00:11', '2022-04-22 17:00:11'),
(900, 115, 'App\\Product', 'product(1)-1650608111.jpg', '0', '2022-04-22 17:00:11', '2022-04-22 17:00:11'),
(901, 116, 'App\\Product', 'product(0)-1650608260.jpg', '0', '2022-04-22 17:02:40', '2022-04-22 17:02:40'),
(902, 116, 'App\\Product', 'product(1)-1650608260.jpg', '0', '2022-04-22 17:02:40', '2022-04-22 17:02:40'),
(903, 116, 'App\\Product', 'product(2)-1650608260.jpg', '0', '2022-04-22 17:02:40', '2022-04-22 17:02:40'),
(904, 116, 'App\\Product', 'product(3)-1650608260.jpg', '0', '2022-04-22 17:02:40', '2022-04-22 17:02:40'),
(905, 117, 'App\\Product', 'product(0)-1650608564.jpg', '0', '2022-04-22 17:07:44', '2022-04-22 17:07:44'),
(906, 117, 'App\\Product', 'product(1)-1650608564.jpg', '0', '2022-04-22 17:07:44', '2022-04-22 17:07:44'),
(907, 117, 'App\\Product', 'product(2)-1650608564.jpg', '0', '2022-04-22 17:07:44', '2022-04-22 17:07:44'),
(909, 118, 'App\\Product', 'product(0)-1650608716.jpg', '0', '2022-04-22 17:10:16', '2022-04-22 17:10:16'),
(910, 119, 'App\\Product', 'product(0)-1650608827.jpg', '0', '2022-04-22 17:12:07', '2022-04-22 17:12:07'),
(911, 119, 'App\\Product', 'product(1)-1650608827.jpg', '0', '2022-04-22 17:12:07', '2022-04-22 17:12:07'),
(912, 119, 'App\\Product', 'product(2)-1650608827.jpg', '0', '2022-04-22 17:12:07', '2022-04-22 17:12:07'),
(913, 121, 'App\\Product', 'product(0)-1650608944.jpg', '0', '2022-04-22 17:14:04', '2022-04-22 17:14:04'),
(914, 123, 'App\\Product', 'product(0)-1650609159.jpg', '0', '2022-04-22 17:17:39', '2022-04-22 17:17:39'),
(915, 123, 'App\\Product', 'product(1)-1650609159.jpg', '0', '2022-04-22 17:17:39', '2022-04-22 17:17:39'),
(916, 124, 'App\\Product', 'product(0)-1650609254.jpg', '0', '2022-04-22 17:19:14', '2022-04-22 17:19:14'),
(917, 124, 'App\\Product', 'product(1)-1650609254.jpg', '0', '2022-04-22 17:19:14', '2022-04-22 17:19:14'),
(918, 125, 'App\\Product', 'product(0)-1650609323.jpg', '0', '2022-04-22 17:20:23', '2022-04-22 17:20:23'),
(919, 126, 'App\\Product', 'product(0)-1650609424.jpg', '0', '2022-04-22 17:22:04', '2022-04-22 17:22:04'),
(920, 128, 'App\\Product', 'product(0)-1650610230.jpg', '0', '2022-04-22 17:35:30', '2022-04-22 17:35:30'),
(921, 128, 'App\\Product', 'product(1)-1650610230.jpg', '0', '2022-04-22 17:35:30', '2022-04-22 17:35:30'),
(922, 128, 'App\\Product', 'product(2)-1650610230.jpg', '0', '2022-04-22 17:35:30', '2022-04-22 17:35:30'),
(923, 129, 'App\\Product', 'product(0)-1650610352.jpg', '0', '2022-04-22 17:37:32', '2022-04-22 17:37:32'),
(924, 129, 'App\\Product', 'product(1)-1650610352.jpg', '0', '2022-04-22 17:37:32', '2022-04-22 17:37:32'),
(925, 130, 'App\\Product', 'product(0)-1650610441.jpg', '0', '2022-04-22 17:39:01', '2022-04-22 17:39:01'),
(926, 131, 'App\\Product', 'product(0)-1650610554.jpg', '0', '2022-04-22 17:40:54', '2022-04-22 17:40:54'),
(927, 131, 'App\\Product', 'product(1)-1650610554.jpg', '0', '2022-04-22 17:40:54', '2022-04-22 17:40:54'),
(928, 131, 'App\\Product', 'product(2)-1650610554.jpg', '0', '2022-04-22 17:40:54', '2022-04-22 17:40:54'),
(929, 132, 'App\\Product', 'product(0)-1650610775.jpg', '0', '2022-04-22 17:44:35', '2022-04-22 17:44:35'),
(930, 132, 'App\\Product', 'product(1)-1650610775.jpg', '0', '2022-04-22 17:44:35', '2022-04-22 17:44:35'),
(931, 132, 'App\\Product', 'product(2)-1650610775.jpg', '0', '2022-04-22 17:44:35', '2022-04-22 17:44:35'),
(932, 133, 'App\\Product', 'product(0)-1650610873.jpg', '0', '2022-04-22 17:46:13', '2022-04-22 17:46:13'),
(933, 134, 'App\\Product', 'product(0)-1650610945.jpg', '0', '2022-04-22 17:47:25', '2022-04-22 17:47:25'),
(934, 135, 'App\\Product', 'product(0)-1650611037.jpg', '0', '2022-04-22 17:48:57', '2022-04-22 17:48:57'),
(935, 135, 'App\\Product', 'product(1)-1650611037.jpg', '0', '2022-04-22 17:48:57', '2022-04-22 17:48:57'),
(936, 135, 'App\\Product', 'product(2)-1650611037.jpg', '0', '2022-04-22 17:48:57', '2022-04-22 17:48:57'),
(937, 136, 'App\\Product', 'product(0)-1650611107.jpg', '0', '2022-04-22 17:50:07', '2022-04-22 17:50:07'),
(938, 137, 'App\\Product', 'product(0)-1650611222.jpg', '0', '2022-04-22 17:52:02', '2022-04-22 17:52:02'),
(939, 137, 'App\\Product', 'product(1)-1650611222.jpg', '0', '2022-04-22 17:52:02', '2022-04-22 17:52:02'),
(940, 137, 'App\\Product', 'product(2)-1650611222.jpg', '0', '2022-04-22 17:52:02', '2022-04-22 17:52:02'),
(941, 137, 'App\\Product', 'product(3)-1650611222.jpg', '0', '2022-04-22 17:52:02', '2022-04-22 17:52:02'),
(942, 138, 'App\\Product', 'product(0)-1650611515.jpg', '0', '2022-04-22 17:56:55', '2022-04-22 17:56:55'),
(943, 140, 'App\\Product', 'product(0)-1650611663.jpg', '0', '2022-04-22 17:59:23', '2022-04-22 17:59:23'),
(944, 141, 'App\\Product', 'product(0)-1650611753.jpg', '0', '2022-04-22 18:00:53', '2022-04-22 18:00:53'),
(945, 141, 'App\\Product', 'product(1)-1650611753.jpg', '0', '2022-04-22 18:00:53', '2022-04-22 18:00:53'),
(946, 143, 'App\\Product', 'product(0)-1650612417.jpg', '0', '2022-04-22 18:11:57', '2022-04-22 18:11:57'),
(947, 143, 'App\\Product', 'product(1)-1650612417.jpg', '0', '2022-04-22 18:11:57', '2022-04-22 18:11:57'),
(948, 143, 'App\\Product', 'product(2)-1650612417.jpg', '0', '2022-04-22 18:11:57', '2022-04-22 18:11:57'),
(949, 144, 'App\\Product', 'product(0)-1650612795.jpg', '0', '2022-04-22 18:18:15', '2022-04-22 18:18:15'),
(950, 144, 'App\\Product', 'product(1)-1650612795.jpg', '0', '2022-04-22 18:18:15', '2022-04-22 18:18:15'),
(951, 144, 'App\\Product', 'product(2)-1650612795.jpg', '0', '2022-04-22 18:18:15', '2022-04-22 18:18:15'),
(952, 144, 'App\\Product', 'product(3)-1650612795.jpg', '0', '2022-04-22 18:18:15', '2022-04-22 18:18:15'),
(953, 145, 'App\\Product', 'product(0)-1650612988.jpg', '0', '2022-04-22 18:21:28', '2022-04-22 18:21:28'),
(954, 145, 'App\\Product', 'product(1)-1650612988.jpg', '0', '2022-04-22 18:21:28', '2022-04-22 18:21:28'),
(955, 145, 'App\\Product', 'product(2)-1650612988.jpg', '0', '2022-04-22 18:21:28', '2022-04-22 18:21:28'),
(956, 145, 'App\\Product', 'product(3)-1650612988.jpg', '0', '2022-04-22 18:21:28', '2022-04-22 18:21:28'),
(957, 145, 'App\\Product', 'product(4)-1650612988.jpg', '0', '2022-04-22 18:21:28', '2022-04-22 18:21:28'),
(958, 146, 'App\\Product', 'product(0)-1650613239.jpg', '0', '2022-04-22 18:25:39', '2022-04-22 18:25:39'),
(959, 146, 'App\\Product', 'product(1)-1650613239.jpg', '0', '2022-04-22 18:25:39', '2022-04-22 18:25:39'),
(960, 146, 'App\\Product', 'product(2)-1650613239.jpg', '0', '2022-04-22 18:25:39', '2022-04-22 18:25:39'),
(962, 146, 'App\\Product', 'product(4)-1650613239.jpg', '0', '2022-04-22 18:25:39', '2022-04-22 18:25:39'),
(963, 146, 'App\\Product', 'product(5)-1650613239.jpg', '0', '2022-04-22 18:25:39', '2022-04-22 18:25:39'),
(964, 147, 'App\\Product', 'product(0)-1650613435.jpg', '0', '2022-04-22 18:28:55', '2022-04-22 18:28:55'),
(966, 147, 'App\\Product', 'product(2)-1650613435.jpg', '0', '2022-04-22 18:28:55', '2022-04-22 18:28:55'),
(967, 147, 'App\\Product', 'product(3)-1650613435.jpg', '0', '2022-04-22 18:28:55', '2022-04-22 18:28:55'),
(968, 147, 'App\\Product', 'product(4)-1650613435.jpg', '0', '2022-04-22 18:28:55', '2022-04-22 18:28:55'),
(969, 147, 'App\\Product', 'product(5)-1650613435.jpg', '0', '2022-04-22 18:28:55', '2022-04-22 18:28:55'),
(970, 148, 'App\\Product', 'product(0)-1650613650.jpg', '0', '2022-04-22 18:32:30', '2022-04-22 18:32:30'),
(971, 148, 'App\\Product', 'product(1)-1650613650.jpg', '0', '2022-04-22 18:32:30', '2022-04-22 18:32:30'),
(972, 149, 'App\\Product', 'product(0)-1650613804.jpg', '0', '2022-04-22 18:35:04', '2022-04-22 18:35:04'),
(974, 149, 'App\\Product', 'product(1)-1650613881.jpg', '0', '2022-04-22 18:36:21', '2022-04-22 18:36:21'),
(975, 149, 'App\\Product', 'product(2)-1650613881.jpg', '0', '2022-04-22 18:36:21', '2022-04-22 18:36:21'),
(978, 149, 'App\\Product', 'product(5)-1650613881.jpg', '0', '2022-04-22 18:36:21', '2022-04-22 18:36:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `content_id` bigint(20) UNSIGNED DEFAULT NULL,
  `owner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_model` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blade` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `handle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blade_weight` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_weight` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_highlights` text COLLATE utf8mb4_unicode_ci,
  `product_description` text COLLATE utf8mb4_unicode_ci,
  `product_warranty_type` enum('international_manufacturer_warranty','non_local_warranty','local_seller_warranty','no_warranty','international_seller_warranty','international_warranty','local_warranty','original_product','brand_warranty') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_warrenty_period` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_warrenty_policy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_whats_on_box` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_package_weight` double DEFAULT NULL,
  `weight_measure` int(11) DEFAULT NULL,
  `product_package_dimension` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_video_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_delivery` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `delivery_charges` decimal(8,2) UNSIGNED DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `product_original_price` double DEFAULT NULL,
  `product_compare_price` double DEFAULT NULL,
  `product_key_features` text COLLATE utf8mb4_unicode_ci,
  `product_sku` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `on_sale` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `best_rated` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `view_count` bigint(20) DEFAULT NULL,
  `on_deal` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `deal_end_date` date DEFAULT NULL,
  `publish_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `live_status` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `quality_status` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `quality_reject_reason` text COLLATE utf8mb4_unicode_ci,
  `quality_control_comment` text COLLATE utf8mb4_unicode_ci,
  `policy_status` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `policy_reject_reason` text COLLATE utf8mb4_unicode_ci,
  `policy_control_comment` text COLLATE utf8mb4_unicode_ci,
  `penalty_type` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deliveryType` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT 'standard',
  `cargo` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `category_id`, `content_id`, `owner_id`, `product_name`, `product_code`, `product_slug`, `product_brand`, `product_model`, `blade`, `handle`, `blade_weight`, `total_weight`, `material`, `product_highlights`, `product_description`, `product_warranty_type`, `product_warrenty_period`, `product_warrenty_policy`, `product_whats_on_box`, `product_package_weight`, `weight_measure`, `product_package_dimension`, `product_video_url`, `home_delivery`, `delivery_charges`, `tax`, `product_original_price`, `product_compare_price`, `product_key_features`, `product_sku`, `image`, `alt`, `on_sale`, `best_rated`, `view_count`, `on_deal`, `deal_end_date`, `publish_status`, `delete_status`, `live_status`, `quality_status`, `quality_reject_reason`, `quality_control_comment`, `policy_status`, `policy_reject_reason`, `policy_control_comment`, `penalty_type`, `created_by`, `updated_by`, `meta_title`, `meta_keyword`, `meta_description`, `created_at`, `updated_at`, `deliveryType`, `cargo`) VALUES
(1, 6, NULL, 0, '12\'\' Panwal Ang Khola Rust free Khukuri', '1002', '12-panwal-ang-khola-rust-free-khukuri-jz59', NULL, '2022', '12\'\'', '5\'\'', '800Gm.', '1100Gm.', 'Wooden Handle', NULL, '<p>Clasic Nepali Khukuri</p>', 'local_seller_warranty', '3 Month', NULL, NULL, NULL, NULL, NULL, 'Sunt dolore minim at', '0', NULL, NULL, 2500, NULL, '<p>12&#39;&#39; Panwal Ang Khola Rust free Khukuri<br />\r\nrosewood handle</p>', '0002', 'product1642157060.jpg', 'Nemo aut ad pariatur', '1', '1', 23, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12\'\' Panwal Ang Khola Rust free Khukuri', '12\'\' Panwal Ang Khola Rust free Khukuri', '12\'\' Panwal Ang Khola Rust free Khukuri', '2022-01-12 22:41:22', '2022-04-22 18:03:34', NULL, NULL),
(2, 3, NULL, 0, '11\'\' world war 2 khukuri', '1001', '11-world-war-2-khukuri-pdfd', NULL, '2022', '7\'\'', '5\'\'', '700gm.', '1100gm', 'wooden handle', NULL, '<p>used in second world war</p>', 'international_manufacturer_warranty', '6 month', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5000, NULL, '<p>Fighting, Battle, Hunting</p>', '1', 'product1641985837.jpg', NULL, '1', '1', 41, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11\'\' world war 2 khukuri', 'most dangerous weapon11\'\' world war 2 khukuri', '11\'\' world war 2 khukuri that used on second world war.', '2022-01-12 22:58:20', '2022-04-22 18:03:45', NULL, NULL),
(3, 7, NULL, 0, '12\'\' AMERICAN EAGLE JOIN HANDLE', '10011', '12-american-eagle-join-handle-gyn3', NULL, '2022', '12', '5.5\'\'', '900gm', '1100gm', 'Bone & wood Handle', NULL, '<p>12&#39;&#39; AMERICAN EAGLE JOIN HANDLE</p>', 'international_manufacturer_warranty', '1 month', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 2000, NULL, '<p>&nbsp;JOIN HANDLE</p>', '1011', 'product1642154373.jpg', NULL, '1', '1', 19, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12\'\' AMERICAN EAGLE JOIN HANDLE', '12\'\' AMERICAN EAGLE JOIN HANDLE', '12\'\' AMERICAN EAGLE JOIN HANDLE', '2022-01-14 21:44:49', '2022-04-05 20:11:10', NULL, NULL),
(4, 5, NULL, 0, '10\'\' SERVICE GRIPER', '10021', '10-service-griper-aujz', NULL, '2022', '10\'\'', '5\'\'', '600gm', '800gm', NULL, NULL, '<h3>SERVICE GRIPER</h3>', 'international_manufacturer_warranty', '1 month', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 2500, NULL, '<h3>SERVICE GRIPER</h3>', '10111', 'product1642155061.jpg', NULL, '1', '1', 24, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SERVICE GRIPER', 'SERVICE GRIPER', 'SERVICE GRIPER', '2022-01-14 21:56:29', '2022-04-22 18:04:12', NULL, NULL),
(5, 5, NULL, 0, '10\'\' SERVICE GRIPER Horn Handle', '10022', '10-service-griper-horn-handle-kg5t', NULL, '2022', '10\'\'', '5\'\'', '600gm', '800gm', 'Horn Handle', NULL, '<h3>SERVICE GRIPER</h3>', 'international_manufacturer_warranty', '1 Month', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 3000, NULL, '<h3>SERVICE GRIPER</h3>', '2002', 'product1642155345.png', NULL, '1', '1', 11, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SERVICE GRIPER', 'SERVICE GRIPER', 'SERVICE GRIPER', '2022-01-14 22:01:02', '2022-02-17 22:45:49', NULL, NULL),
(6, 6, NULL, 0, '10\'\' Panwal Service Khukuri', '10023', '10-panwal-service-khukuri-clim', NULL, '2022', '10\'\'', '5\'\'', '700gm', '900gm', 'Horn Hadle', NULL, '<h3>10&#39;&#39; Panwal Service Khukuri</h3>', 'international_manufacturer_warranty', '1 month', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 3000, NULL, '<p>Horn Handle&nbsp;<br />\r\n10&#39;&#39; Panwal Service Khukuri</p>', '2010', 'product1642155673.jpg', NULL, '1', '1', 27, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10\'\' Panwal Service Khukuri', '10\'\' Panwal Service Khukuri', '10\'\' Panwal Service Khukuri', '2022-01-14 22:06:30', '2022-04-22 18:04:21', NULL, NULL),
(7, 5, NULL, 0, '13\'\' Service No 1 Khukuri', '100211', '13-service-no-1-khukuri-twge', NULL, '2022', '13\'\'', '5\'\'', '800gm', '1000gm', 'Horn Handle', NULL, '<p>13&#39;&#39; Service No 1 Khukuri</p>', 'international_manufacturer_warranty', '1 Month', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 2000, NULL, '<p>13&#39;&#39; Service No 1 Khukuri<br />\r\nHorn Handle</p>', '200', 'product1642155907.jpg', NULL, '1', '1', 26, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13\'\' Service No 1 Khukuri', '13\'\' Service No 1 Khukuri', '13\'\' Service No 1 Khukuri', '2022-01-14 22:11:19', '2022-03-14 20:47:26', NULL, NULL),
(8, 4, NULL, 0, '15\'\' Hunting Sirupate Khukuri', '201011', '15-hunting-sirupate-khukuri-bet7', NULL, '2022', '15\'\'', '5\'\'', '1000gm', '1300gm', 'wooden Handle', NULL, '<p>15&#39;&#39; Hunting Sirupate Khukuri</p>', 'international_manufacturer_warranty', '1 month', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4500, NULL, '<p>wooden Handle<br />\r\n15&#39;&#39; Hunting Sirupate Khukuri</p>', '2010', 'product1642156851.jpg', NULL, '1', '1', 19, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15\'\' Hunting Sirupate Khukuri', '15\'\' Hunting Sirupate Khukuri', '15\'\' Hunting Sirupate Khukuri', '2022-01-14 22:26:13', '2022-04-22 18:04:33', NULL, NULL),
(9, 6, NULL, 0, '11\'\' Panwal world war Khukuri', '2020', '11-panwal-world-war-khukuri-xeq3', NULL, '2022', '11\'\'', '5\'\'', '650gm', '850gm', 'wooden Handle', NULL, '<p>11&#39;&#39; Panwal world war Khukuri</p>', 'international_manufacturer_warranty', '1 month', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 2500, NULL, '<p>11&#39;&#39; Panwal world war Khukuri<br />\r\nwooden Handle</p>', '100110', 'product1642157238.jpg', NULL, '1', '1', 29, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11\'\' Panwal world war Khukuri', '11\'\' Panwal world war Khukuri', '11\'\' Panwal world war Khukuri', '2022-01-14 22:32:48', '2022-04-22 18:04:44', NULL, NULL),
(10, 13, NULL, 0, '13\'\' Janga bahadur Khukuri', '201100', '13-janga-bahadur-khukuri-qeov', NULL, '2022', '13\'\'', '7\'\'', '800gm', '1100gm', 'Metal Handle', NULL, '<p>13&#39;&#39; Janga bahadur Khukuri</p>', 'international_manufacturer_warranty', '1 month', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5000, NULL, '<p>13&#39;&#39; Janga bahadur Khukuri<br />\r\nMetal Handle</p>', '10000', 'product1642157471.jpg', NULL, '1', '1', 27, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13\'\' Janga bahadur Khukuri', '13\'\' Janga bahadur Khukuri', '13\'\' Janga bahadur Khukuri', '2022-01-14 22:36:35', '2022-04-05 21:46:30', NULL, NULL),
(11, 3, NULL, 0, '112\'\' 5 Chira Custom Khukuri', '1212100', '112-5-chira-custom-khukuri-2ua1', NULL, '2022', '12\'\'', '5.5\'\'', '800gm', '1100gm', 'Bore + wood Handle', NULL, '<p>13&#39;&#39; Janga bahadur Khukuri</p>', 'international_manufacturer_warranty', '1 month', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 3500, NULL, '<p>13&#39;&#39; Janga bahadur Khukuri</p>\r\n\r\n<p>Bore + wood Handle</p>', '1000110', 'product1642157713.jpg', NULL, '1', '1', 17, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Bore + wood Handle', 'Bore + wood Handle', 'Bore + wood Handle', '2022-01-14 22:40:36', '2022-04-22 18:04:53', NULL, NULL),
(12, 9, NULL, 0, '11', '1144', '11-1imx', NULL, '2022', '11', '5.5\'\'', '700gm', '900gm', 'wooden Handle', NULL, '<p>11&quot; Afgan Issue Khukuri</p>', NULL, '1 month', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4000, NULL, '<p>11&quot; Afgan Issue Khukuri</p>', '001100', 'product1642158138.jpg', NULL, '1', '1', 25, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11\" Afgan Issue Khukuri', '11\" Afgan Issue Khukuri', '11\" Afgan Issue Khukuri', '2022-01-14 22:47:32', '2022-04-05 20:35:06', NULL, NULL),
(13, 14, NULL, 0, '12\" Eagle Hunting Sirupate Khukuri', '2000', '12-eagle-hunting-sirupate-khukuri-tb9i', NULL, '12', '12\"', '5.5\"', '800gm', '1000gm', 'Horn Handle', NULL, '<p>12&quot; Eagle Hunting Sirupate Khukuri</p>', 'brand_warranty', '6 months', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 2499, NULL, '<p>12&quot; Eagle Hunting Sirupate Khukuri</p>', '2000', 'product1645094275.jpg', NULL, '1', '1', 14, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-02-17 22:23:16', '2022-04-22 18:03:16', NULL, NULL),
(14, 5, NULL, 0, '10\" Service Gripper', '0001', '10-service-gripper-1ppi', NULL, '1', '10\"', '5\"', '600 gm', '800 gm', 'Horn Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 15000, NULL, NULL, '0001', 'product1646975550.jpg', NULL, '0', '0', 13, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 16:57:55', '2022-07-16 05:17:16', NULL, 45),
(15, 15, NULL, 0, '10\" Service No 1', '0002', '10-service-no-1-0lrx', NULL, '2', '10\"', '5\"', '600 gm', '800 gm', 'Horn Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 15500, NULL, NULL, '0002', 'product1646975932.png', NULL, '0', '0', 13, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 17:04:03', '2022-07-16 05:15:57', NULL, 45),
(16, 6, NULL, 0, 'Panawal Service Khukuri', '0003', 'panawal-service-khukuri-isks', NULL, '3', '10\"', '5\"', '700 gm', '900 gm', 'Horn Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 18750, NULL, NULL, '0003', 'product1646976035.jpg', NULL, '0', '1', 11, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 17:05:38', '2022-07-16 05:18:49', NULL, 45),
(17, 15, NULL, 0, '13\" Service No 1 Khukuri', '0004', '13-service-no-1-khukuri-mklj', NULL, '4', '13\"', '5\"', '800 gm', '1000 gm', 'Horn Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 7000, NULL, NULL, '0004', 'product1646976340.jpg', NULL, '0', '1', 21, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 17:10:45', '2022-07-16 05:15:52', NULL, 60),
(18, 4, NULL, 0, '15\" Hunting Sirupate Khukuri', '0005', '15-hunting-sirupate-khukuri-i97s', NULL, '5', '15\"', '5\"', '1000 gm', '1300 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 7000, NULL, NULL, '0005', 'product1646976662.jpg', NULL, '0', '0', 11, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 17:16:08', '2022-07-16 05:18:02', NULL, 60),
(19, 6, NULL, 0, '12\" Panawal Aang Khola Rust Free Khukuri', '0006', '12-panawal-aang-khola-rust-free-khukuri-a358', NULL, '6', '12\"', '5\"', '800 gm', '1100 gm', 'Wooden Handle (Rose wood)', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 8750, NULL, NULL, '0006', 'product1646977106.jpg', NULL, '0', '1', 15, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 17:24:01', '2022-07-16 05:18:58', NULL, 60),
(20, 6, NULL, 0, '11\" Panawal World War Khukuri', '0007', '11-panawal-world-war-khukuri-5raf', NULL, '7', '11\"', '5\"', '650 gm', '850 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 7000, NULL, NULL, '0007', 'product1646977313.jpg', NULL, '0', '0', 15, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 17:27:29', '2022-07-16 05:17:46', NULL, 60),
(21, 13, NULL, 0, '13\" Jung Bahadur Khukuri', '0008', '13-jung-bahadur-khukuri-tfqb', NULL, '8', '13\"', '7\"', '800 gm', '1100 gm', 'Metal Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 13750, NULL, NULL, '0008', 'product1646998194.jpg', NULL, '0', '1', 14, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 23:15:30', '2022-07-16 05:15:51', NULL, 60),
(22, 3, NULL, 0, '12\" Panch Chira Custom Khukuri Joint Handel', '0009', '12-panch-chira-custom-khukuri-joint-handel-nrp0', NULL, '9', '12\"', '5.5\"', '800 gm', '1100 gm', 'Bone + Wood Handle', NULL, NULL, 'non_local_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 10000, NULL, NULL, '0009', 'product1646998437.jpg', NULL, '0', '1', 9, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 23:19:30', '2022-07-16 05:17:55', NULL, 60),
(23, 24, NULL, 0, '12\" American Eagle Join Handle', '0010', '12-american-eagle-join-handle-eghg', NULL, '10', '12\"', '5.5\"', '900 gm', '1100 gm', 'Bone + Wood Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 10000, NULL, NULL, '0010', 'product1646998648.jpg', NULL, '0', '1', 24, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 23:23:11', '2022-07-16 05:16:20', NULL, 60),
(24, 9, NULL, 0, '11\" Afgan Issue Khukuri', '0011', '11-afgan-issue-khukuri-e9ou', NULL, '11', '11\"', '5.5\"', '700 gm', '900 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0011', 'product1646998822.jpg', NULL, '0', '1', 23, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 23:26:04', '2022-07-16 05:15:38', NULL, 60),
(25, 4, NULL, 0, '12\" Eagle Hunting Sirupate Khukuri', '0012', '12-eagle-hunting-sirupate-khukuri-2d5w', NULL, '12', '12\"', '5.5\"', '800 gm', '1000 gm', 'Horn Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 8750, NULL, NULL, '0012', 'product1646999009.jpg', NULL, '0', '0', 9, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 23:29:10', '2022-07-16 05:17:58', NULL, 60),
(26, 17, NULL, 0, '13\" Sirupate Traditional Khukuri', '0013', '13-sirupate-traditional-khukuri-pukk', NULL, '13', '13\"', '5\"', '700 gm', '1000 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5500, NULL, NULL, '0013', 'product1646999311.jpg', NULL, '0', '1', 13, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 23:34:09', '2022-07-16 05:18:25', NULL, 45),
(27, 10, NULL, 0, '11\" Katle Khukuri Rust Free Blocker', '0014', '11-katle-khukuri-rust-free-blocker-az3c', NULL, '14', '11\"', '4\"', '800 gm', '1000 gm', 'Wooden Handel', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 9500, NULL, NULL, '0014', 'product1646999500.jpg', NULL, '0', '0', 18, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 23:37:30', '2022-07-16 05:15:30', NULL, 60),
(28, 11, NULL, 0, '8\" Iraqi Griper Block Handle Khukuri', '0015', '8-iraqi-griper-block-handle-khukuri-9otr', NULL, '15', '8\"', '5\"', '600 gm', '800 gm', 'Block Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4500, NULL, NULL, '0015', 'product1646999798.jpg', NULL, '0', '0', 15, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-11 23:42:16', '2022-07-16 05:15:46', NULL, 45),
(29, 6, NULL, 0, '6\" Panawal Super Mini Jungle', '0016', '6-panawal-super-mini-jungle-paos', NULL, '16', '6\"', '4.5\"', '400 gm', '600 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4000, NULL, NULL, '0016', 'product1647153978.jpg', NULL, '0', '0', 11, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-13 17:31:48', '2022-07-16 05:17:41', NULL, 45),
(30, 12, NULL, 0, '15\" Kopis Knife Custom', '0017', '15-kopis-knife-custom-rklv', NULL, '17', '15\"', '6\"', '1100 gm', '1300 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 13750, NULL, NULL, '0017', 'product1647154102.jpg', NULL, '0', '0', 18, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-13 17:33:59', '2022-07-16 05:15:48', NULL, 60),
(31, 6, NULL, 0, '24\" Panawal Sirupate Khukuri', '0018', '24-panawal-sirupate-khukuri-ueu2', NULL, '18', '24', '7', '1850 gm', '2300 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 13750, NULL, NULL, '0018', 'product1647154246.jpg', NULL, '0', '0', 12, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-13 17:36:17', '2022-07-16 05:17:41', NULL, 80),
(32, 3, NULL, 0, '21\" 3 Chira Custom Serupate Khukuri', '0019', '21-3-chira-custom-serupate-khukuri-5t8o', NULL, '19', '21\"', '12\"', '1300 gm', '1600 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 15000, NULL, NULL, '0019', 'product1647154439.jpg', NULL, '0', '0', 6, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-13 17:39:44', '2022-07-16 05:17:53', NULL, 60),
(33, 18, NULL, 0, 'Traditional 13\" Ganjawal Khukuri', '0020', 'traditional-13-ganjawal-khukuri-rxkb', NULL, '20', '13\"', '5\"', NULL, '1000 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 11250, NULL, NULL, '0020', NULL, NULL, '0', '0', 11, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-13 18:10:34', '2022-07-16 05:18:21', NULL, 60),
(34, 19, NULL, 0, 'Dhankute D K Horn 12” Khukuri', '0021', 'dhankute-d-k-horn-12-khukuri-miho', NULL, '21', '12\"', '5.5\"', '600 gm', '900 gm', 'Horn Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 21250, NULL, NULL, '0021', 'product1647157403.jpg', NULL, '0', '0', 18, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-13 18:29:06', '2022-07-16 05:16:09', NULL, 60),
(35, 20, NULL, 0, '12\" Custom Survival Khukuri', '0022', '12-custom-survival-khukuri-aldv', NULL, '22', '12\"', '6\"', NULL, '1350 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 11250, NULL, NULL, '0022', 'product1647165870.jpg', NULL, '0', '0', 10, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-13 20:49:56', '2022-07-16 05:18:33', NULL, 60),
(36, 21, NULL, 0, 'Royal Historic Budune Khukuri', '0023', 'royal-historic-budune-khukuri-qtia', NULL, '23', '15\"', '4\"', NULL, '1050 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 11250, NULL, NULL, '0023', 'product1648528218.jpg', NULL, '0', '1', 15, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-13 21:42:07', '2022-07-16 05:18:40', NULL, 60),
(37, 22, NULL, 0, '3 Chira Tradition Khukuri', '0024', '3-chira-tradition-khukuri-t1jy', NULL, '24', '13\"', '6\"', NULL, '1050 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 8750, NULL, NULL, '0024', 'product1647247962.jpg', NULL, '0', '1', 9, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 19:38:04', '2022-07-16 05:18:48', NULL, 60),
(38, 10, NULL, 0, 'Katle 11\" Custom Khukuri', '0025', 'katle-11-custom-khukuri-67sw', NULL, '25', '11\"', '5\"', NULL, '700 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 8750, NULL, NULL, '0025', 'product1647248072.jpg', NULL, '0', '0', 15, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 19:39:51', '2022-07-16 05:15:30', NULL, 45),
(39, 10, NULL, 0, 'Katle 8\" Custom Khukuri', '0026', 'katle-8-custom-khukuri-crsp', NULL, '26', '8\"', '5\"', NULL, '550 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0026', 'product1647248231.jpg', NULL, '0', '0', 17, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 19:42:27', '2022-07-16 05:15:28', NULL, 45),
(40, 10, NULL, 0, 'Katle 11\" Custom Khukuri', '0027', 'katle-11-custom-khukuri-mxib', NULL, '27', '11\"', '5\"', NULL, '700 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 10000, NULL, NULL, '0027', 'product1647248373.jpg', NULL, '0', '1', 21, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 19:44:56', '2022-07-16 05:15:24', NULL, 60),
(41, 19, NULL, 0, 'Dhankute Wooden Khukuri', '0028', 'dhankute-wooden-khukuri-q7yw', NULL, '28', '10\"', '5\"', NULL, '550 gm', 'Wooden Handle', NULL, NULL, 'local_seller_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 7500, NULL, NULL, '0028', 'product1647248541.jpg', NULL, '0', '0', 15, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 19:48:47', '2022-07-16 05:16:09', NULL, 45),
(42, 23, NULL, 0, 'Eagle Inchury Chukuri Khukuri', '0029', 'eagle-inchury-chukuri-khukuri-pgx8', NULL, '29', '10\"', '6\"', NULL, '750 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 10000, NULL, NULL, '0029', 'product1649412073.jpg', NULL, '0', '0', 19, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 19:52:32', '2022-07-16 05:18:43', NULL, 60),
(43, 23, NULL, 0, 'Eagle Inchury Chukuri Khukuri', '0030', 'eagle-inchury-chukuri-khukuri-3ink', NULL, '30', '8\"', '6\"', NULL, '1000 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 8000, NULL, NULL, '0030', 'product1647248937.jpg', NULL, '0', '0', 14, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-14 19:54:14', '2022-07-16 05:18:42', NULL, 45),
(44, 18, NULL, 0, 'Custom Handmade Ganjawal service Khukuri', '0031', 'custom-handmade-ganjawal-service-khukuri-rnvl', NULL, '0031', '11\"', '6\"', '400 gm', '550 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 10000, NULL, NULL, '0031', 'product1648614786.jpg', NULL, '0', '0', 17, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-30 15:18:28', '2022-07-16 05:18:14', NULL, 45),
(45, 24, NULL, 0, '10\" American Eagle Custom Khukuri', '0032', '10-american-eagle-custom-khukuri-o7kl', NULL, '32', '10\"', '5.5\"', NULL, '800 gm', 'Water Buffalo Bone', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 10500, NULL, NULL, '0032', 'product1648721592.jpg', NULL, '0', '0', 11, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-31 20:58:30', '2022-07-16 05:16:19', NULL, 60),
(46, 25, NULL, 0, '10\" Aang Khola Khukuri', '0033', '10-aang-khola-khukuri-8cxm', NULL, '33', '10\"', '5\"', NULL, '1000 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0033', 'product1648728457.jpg', NULL, '0', '0', 6, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-31 22:53:20', '2022-07-16 05:16:36', NULL, 60),
(47, 26, NULL, 0, '14\" Charauke Khukuri', '0034', '14-charauke-khukuri-pa7w', NULL, '34', '14', '6', NULL, '1300 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 13750, NULL, NULL, '0034', 'product1648728599.jpg', NULL, '0', '1', NULL, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-03-31 22:55:36', '2022-04-08 20:54:40', NULL, 60),
(48, 18, NULL, 0, 'Historic Ganjawal Khukuri', '0035', 'historic-ganjawal-khukuri-tpgj', NULL, '35', '13\"', '5\"', NULL, '900 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 10000, NULL, NULL, '0035', 'product1648789940.jpg', NULL, '0', '0', 8, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-01 15:57:44', '2022-07-16 05:18:14', NULL, 60),
(49, 27, NULL, 0, '8\" Book of Eli Knife', '0036', '8-book-of-eli-knife-qhc0', NULL, '36', '8\"', '6\"', NULL, '850 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 7500, NULL, NULL, '0036', 'product1648790053.jpg', NULL, '0', '0', 7, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-01 15:59:40', '2022-07-16 05:16:31', NULL, 45),
(50, 18, NULL, 0, '12\" 2 Chira Custom Ganjawal Khukuri', '0037', '12-2-chira-custom-ganjawal-khukuri-obj5', NULL, '37', '12\"', '6\"', NULL, '1350 gm', 'Woode + Horn Join Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 12500, NULL, NULL, '0037', 'product1649157720.jpg', NULL, '0', '1', 12, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-01 16:01:58', '2022-07-16 05:18:13', NULL, 60),
(51, 27, NULL, 0, '12\" Book of Eli Knife', '0038', '12-book-of-eli-knife-gvac', NULL, '38', '12\"', '6\"', NULL, '1300 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 10000, NULL, NULL, '0038', 'product1648790424.jpg', NULL, '0', '0', 8, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-01 16:05:48', '2022-07-16 05:16:30', NULL, 60),
(52, 29, NULL, 0, 'Hency Balance Khukuri', '0039', 'hency-balance-khukuri-6i2f', NULL, '39', '14\"', '6\"', NULL, '1300 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 11250, NULL, NULL, '0039', 'product1648790579.jpg', NULL, '0', '0', 9, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-01 16:08:16', '2022-07-16 05:16:45', NULL, 60),
(53, 18, NULL, 0, '13\" Historic Ganjawal Khukuri', '0040', '13-historic-ganjawal-khukuri-cowu', NULL, '40', '13\"', '5\"', NULL, '1100 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 11250, NULL, NULL, '0040', 'product1648790728.jpg', NULL, '0', '0', 6, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-01 16:10:52', '2022-07-16 05:18:13', NULL, 60),
(54, 30, NULL, 0, 'British Gurkha Ceremonial Khukuri', '0041', 'british-gurkha-ceremonial-khukuri-y8yr', NULL, '41', '10.5\"', '5\"', NULL, '700 gm', 'Horn Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0041', 'product1648791001.jpg', NULL, '0', '1', 8, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-01 16:15:26', '2022-07-16 05:16:43', NULL, 45),
(55, 18, NULL, 0, '10\" Panchira Custom Ganjawal Khukuri', '0042', '10-panchira-custom-ganjawal-khukuri-0xoq', NULL, '42', '10\"', '5\"', NULL, '1000 gm', 'Wooden + Bone Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 1000, NULL, NULL, '0042', 'product1648794465.jpg', NULL, '0', '0', 9, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-01 17:13:15', '2022-07-16 05:18:04', NULL, 11250),
(56, 24, NULL, 0, 'American Eagle Custom Made Rust Free', '0043', 'american-eagle-custom-made-rust-free-elbw', NULL, '43', '10.5\"', '5.5\"', NULL, '900 gm', 'Wooden + Bone Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 9500, NULL, NULL, '0043', 'product1648794604.jpg', NULL, '0', '1', 7, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-01 17:15:22', '2022-07-16 05:16:13', NULL, 45),
(57, 29, NULL, 0, 'Itihas Join Handle Balance Khukuri', '0044', 'itihas-join-handle-balance-khukuri-gubf', NULL, '44', '10\"', '5.5\"', NULL, '900 gm', 'Wooden + Bone Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 9500, NULL, NULL, '0044', 'product1648794976.jpg', NULL, '0', '1', 7, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-01 17:21:31', '2022-07-16 05:16:44', NULL, 45),
(58, 32, NULL, 0, '10\" American Eagle Dragon Rust Free Custom', '0045', '10-american-eagle-dragon-rust-free-custom-hnpr', NULL, '45', '10\"', '6\"', NULL, '900 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 9500, NULL, NULL, '0045', 'product1648798497.jpg', NULL, '1', '1', NULL, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-01 18:24:54', '2022-04-08 21:18:10', NULL, 60),
(59, 32, NULL, 0, '8\" American Eagle Dragon Rust Free Custom', '0046', '8-american-eagle-dragon-rust-free-custom-lbok', NULL, '46', '8\"', '5\"', NULL, '600 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 7500, NULL, NULL, '0046', 'product1648959253.jpg', NULL, '0', '1', 14, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 14:59:54', '2022-07-16 05:16:42', NULL, 45),
(60, 24, NULL, 0, '8\" American Eagle Khukuri', '0047', '8-american-eagle-khukuri-tupt', NULL, '47', '8\"', '5\"', NULL, '600 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0047', 'product1648959404.jpg', NULL, '1', '1', 9, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 15:02:03', '2022-07-16 05:16:13', NULL, 45),
(61, 32, NULL, 0, '10\" American Eagle Dragon Rust Free', '0048', '10-american-eagle-dragon-rust-free-6vlc', NULL, '48', '10\"', '5\"', NULL, '600 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 8000, NULL, NULL, '0048', 'product1648959695.jpg', NULL, '0', '1', 17, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 15:07:13', '2022-07-16 05:16:41', NULL, 45),
(62, 33, NULL, 0, 'Itihas Khukuri', '0049', 'itihas-khukuri-w8xx', NULL, '49', '8\"', '5\"', NULL, '700 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 8000, NULL, NULL, '0049', 'product1648959888.jpg', NULL, '1', '1', 14, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 15:10:05', '2022-07-17 11:57:23', NULL, 45),
(63, 32, NULL, 0, '8\" American Eagle Bone Dragon', '0050', '8-american-eagle-bone-dragon-bnhn', NULL, '50', '8\"', '5\"', NULL, '600 gm', 'Bone Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 8000, NULL, NULL, '0050', 'product1648963656.jpg', NULL, '1', '1', 9, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 16:12:56', '2022-07-16 05:16:40', NULL, 45),
(64, 34, NULL, 0, '11\" Iraq War Khukuri', '0051', '11-iraq-war-khukuri-1dxq', NULL, '51', '11\"', '6\"', NULL, '800 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 7000, NULL, NULL, '0051', 'product1648963968.jpg', NULL, '1', '1', 8, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 16:18:12', '2022-07-16 05:16:58', NULL, 60),
(65, 35, NULL, 0, '11\" Afgan Khukuri', '0052', '11-afgan-khukuri-oeen', NULL, '52', '11\"', '6\"', NULL, '800 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0052', 'product1649419473.jpg', NULL, '1', '1', 8, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 16:23:07', '2022-07-16 05:17:00', NULL, 60),
(66, 36, NULL, 0, '9\" Nepal Police Khukuri', '0053', '9-nepal-police-khukuri-galw', NULL, '53', '9\"', '5\"', NULL, '450 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5000, NULL, NULL, '0053', 'product1648964485.jpg', NULL, '1', '1', 12, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 16:26:59', '2022-07-16 05:17:06', NULL, 45),
(67, 25, NULL, 0, '10\" Aang Khola Khukuri', '0054', '10-aang-khola-khukuri-12bb', NULL, '54', '10\"', '5\"', NULL, '800 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0054', 'product1648964601.jpg', NULL, '1', '1', 6, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 16:28:52', '2022-07-16 05:16:32', NULL, 60),
(68, 6, NULL, 0, '13\" Panawal Survival Khukuri', '0055', '13-panawal-survival-khukuri-iraj', NULL, '55', '13\"', '5\"', NULL, '1050 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 10000, NULL, NULL, '0055', 'product1648964740.jpg', NULL, '1', '1', 7, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 16:31:08', '2022-07-16 05:17:37', NULL, 60),
(69, 29, NULL, 0, '2nd World War Custom Made Balance Khukuri', '0056', '2nd-world-war-custom-made-balance-khukuri-kdpx', NULL, '56', '15\"', '6\"', NULL, '1100 gm', 'Wooden + Horn Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 9500, NULL, NULL, '0056', 'product1649569617.jpg', NULL, '1', '1', 12, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 17:19:50', '2022-07-16 05:16:44', NULL, 60),
(70, 37, NULL, 0, 'Modify Farmer Working Khukuri', '0057', 'modify-farmer-working-khukuri-3i8l', NULL, '57', '14\"', '5\"', NULL, NULL, 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 11250, NULL, NULL, '0057', 'product1649587806.jpg', NULL, '1', '1', 11, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 17:26:55', '2022-07-16 05:17:07', NULL, 60),
(71, 20, NULL, 0, '17\" Custom Made Survival Khukuri', '0058', '17-custom-made-survival-khukuri-rkrq', NULL, '58', '17\"', '6\"', NULL, '1700 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 11250, NULL, NULL, '0058', 'product1648968293.jpg', NULL, '1', '1', 12, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 17:30:12', '2022-07-16 05:18:31', NULL, 60),
(72, 6, NULL, 0, '14\" Panawal Survival Khukuri', '0059', '14-panawal-survival-khukuri-2xql', NULL, '59', '14\"', '6\"', NULL, '1150 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 8750, NULL, NULL, '0059', 'product1648968394.jpg', NULL, '1', '1', 11, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 17:32:08', '2022-07-16 05:17:33', NULL, 60),
(73, 27, NULL, 0, '15\" Book Of Eli Rust Free Knife', '0060', '15-book-of-eli-rust-free-knife-nmft', NULL, '60', '15\"', '7\"', NULL, '1900 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 12000, NULL, NULL, '0060', 'product1648968712.jpg', NULL, '0', '1', 11, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 17:37:19', '2022-07-16 05:16:30', NULL, 60),
(74, 27, NULL, 0, '19\" Book Of Eli Rust Free Knife', '0061', '19-book-of-eli-rust-free-knife-sxoq', NULL, '61', '19\"', '7\"', NULL, '1900 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 16250, NULL, NULL, '0061', 'product1649588089.jpg', NULL, '1', '1', 11, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 17:40:35', '2022-07-16 05:16:27', NULL, 80),
(75, 38, NULL, 0, '14\" D Guard Custom Bowie Knife', '0062', '14-d-guard-custom-bowie-knife-jcvn', NULL, '62', '14\"', '6\"', NULL, '1300 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 13750, NULL, NULL, '0062', 'product1648969204.jpg', NULL, '1', '1', 10, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 17:45:25', '2022-07-16 05:17:08', NULL, 60),
(76, 27, NULL, 0, '21\" Book Of Eli Rust Free Knife', '0063', '21-book-of-eli-rust-free-knife-h59q', NULL, '63', '21\"', '7\"', NULL, '2250 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 13750, NULL, NULL, '0063', 'product1649588251.jpg', NULL, '1', '1', 12, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 17:48:08', '2022-07-16 05:16:24', NULL, 80),
(77, 27, NULL, 0, '16\" Book Of Eli Knife', '0064', '16-book-of-eli-knife-2zkb', NULL, '64', '16\"', '6\"', NULL, '1400 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 12000, NULL, NULL, '0064', 'product1649588357.jpg', NULL, '0', '1', 8, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 17:50:15', '2022-07-16 05:16:21', NULL, 80),
(78, 19, NULL, 0, '16\" Dhankute Wooden Khukuri', '0065', '16-dhankute-wooden-khukuri-z6qt', NULL, '65', '16\"', '6\"', NULL, '1100 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 17500, NULL, NULL, '0065', 'product1648969646.jpg', NULL, '0', '1', 12, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 17:53:19', '2022-07-16 05:16:05', NULL, 80),
(79, 6, NULL, 0, '22.5\" Panawal Sirupate Khukuri', '0066', '225-panawal-sirupate-khukuri-szju', NULL, '66', '22.5\"', '8\"', NULL, '1800 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 12500, NULL, NULL, '0066', 'product1648969884.jpg', NULL, '1', '1', 9, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 17:57:06', '2022-07-16 05:17:32', NULL, 80),
(80, 6, NULL, 0, '20\" Panawal Sirupate Khukuri', '0067', '20-panawal-sirupate-khukuri-vw83', NULL, '67', '20\"', '8\"', NULL, '1600 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 13750, NULL, NULL, '0067', 'product1648970069.jpg', NULL, '1', '1', 9, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 18:00:33', '2022-07-16 05:17:28', NULL, 80),
(81, 44, NULL, 0, '20\" 3 Chira Sirupate Khukuri', '0068', '20-3-chira-sirupate-khukuri-jcac', NULL, '68', '20\"', '8\"', NULL, '1600 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 15000, NULL, NULL, '0068', 'product1649157378.jpg', NULL, '1', '1', 11, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 18:07:32', '2022-07-16 05:17:15', NULL, 80),
(82, 6, NULL, 0, '8\" Panawal Sirupate Khukuri', '0069', '8-panawal-sirupate-khukuri-q2bb', NULL, '69', '8\"', '5\"', NULL, '500 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4500, NULL, NULL, '0069', 'product1648970686.jpg', NULL, '1', '1', 7, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 18:10:15', '2022-07-16 05:17:28', NULL, 45),
(83, 36, NULL, 0, '6\" Nepal Police Khukuri', '0070', '6-nepal-police-khukuri-znj9', NULL, '70', '6\"', '4\"', NULL, '300 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0070', 'product1648977914.jpg', NULL, '1', '1', 7, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 20:10:33', '2022-07-16 05:17:05', NULL, 45),
(84, 11, NULL, 0, 'Iraqi Gripper Blocker Handle Khukuri', '0071', 'iraqi-gripper-blocker-handle-khukuri-s7aq', NULL, '71', '10.5\"', '5\"', NULL, '950 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 15000, NULL, NULL, '0071', NULL, NULL, '1', '1', NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 20:12:31', '2022-04-03 20:12:31', NULL, 45),
(85, 33, NULL, 0, '12\" Itihas Khukuri', '0072', '12-itihas-khukuri-buyz', NULL, '72', '12\"', '5\"', NULL, '950 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 8000, NULL, NULL, '0072', 'product1648978228.jpg', NULL, '1', '1', 16, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 20:16:04', '2022-07-17 11:57:25', NULL, 60),
(86, 6, NULL, 0, '12\" 3 Chira Panawal Khukuri', '0073', '12-3-chira-panawal-khukuri-ewxi', NULL, '73', '12\"', '5.5\"', NULL, '1000 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 8750, NULL, NULL, '0073', 'product1648978681.jpg', NULL, '1', '1', 10, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 20:23:34', '2022-07-16 05:17:25', NULL, 60),
(87, 6, NULL, 0, '10\" 3 Chira Panawal Khukuri', '0074', '10-3-chira-panawal-khukuri-tons', NULL, '74', '10\"', '5\"', NULL, '1100 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 7000, NULL, NULL, '0074', 'product1648978831.jpg', NULL, '1', '1', 9, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 20:26:05', '2022-07-16 05:17:19', NULL, 60),
(88, 6, NULL, 0, '10\" Panawal Rust Free Working Khukuri', '0075', '10-panawal-rust-free-working-khukuri-pcwi', NULL, '75', '10\"', '5\"', NULL, '800 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5500, NULL, NULL, '0075', 'product1648979016.jpg', NULL, '1', '1', 10, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 20:28:59', '2022-07-16 05:17:17', NULL, 60),
(89, 33, NULL, 0, '10\" Itihas Khukuri', '0076', '10-itihas-khukuri-gaej', NULL, '76', '10\"', '5\"', NULL, '800 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0076', 'product1648979465.jpg', NULL, '1', '1', 13, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 20:36:14', '2022-07-17 11:57:24', NULL, 60),
(90, 19, NULL, 0, '14\" Dhankute Horn Panchira Khukur', '0077', '14-dhankute-horn-panchira-khukur-lmln', NULL, '77', '14\"', '5\"', NULL, '800 gm', 'Horn Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 30000, NULL, NULL, '0077', 'product1648979605.jpg', NULL, '1', '1', 10, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 20:38:45', '2022-07-16 05:16:03', NULL, 80),
(91, 19, NULL, 0, '10\" Dhankute Horn Panchira Khukuri', '0078', '10-dhankute-horn-panchira-khukuri-hszb', NULL, '78', '10\"', '5\"', NULL, '700 gm', 'Horn Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 16250, NULL, NULL, '0078', 'product1648979708.jpg', NULL, '0', '1', 10, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 20:40:45', '2022-07-16 05:15:58', NULL, 60),
(92, 39, NULL, 0, '8\" Chukuri', '0079', '8-chukuri-93e1', NULL, '79', '8\"', '5\"', NULL, '700 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5500, NULL, NULL, '0079', 'product1648980174.jpg', NULL, '0', '1', 16, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 20:47:56', '2022-07-16 05:17:13', NULL, 45),
(93, 39, NULL, 0, '10\" Chukuri', '0080', '10-chukuri-bh88', NULL, '80', '10\"', '5.5\"', NULL, '800 gm', 'Wooden Handle', NULL, NULL, 'local_seller_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 7000, NULL, NULL, '0080', 'product1649151702.jpg', NULL, '1', '1', 9, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 20:51:24', '2022-07-16 05:17:08', NULL, 45),
(94, 41, NULL, 0, '14\" 3 Chira Khukuri', '0081', '14-3-chira-khukuri-q69j', NULL, '81', '14\"', '5.5\"', NULL, '1000 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 10500, NULL, NULL, '0081', 'product1648980670.jpg', NULL, '1', '1', 11, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 20:56:22', '2022-07-16 05:17:13', NULL, 80),
(95, 10, NULL, 0, '8\" Rust Free Katle Balance Khukuri', '0082', '8-rust-free-katle-balance-khukuri-shwm', NULL, '82', '8\"', '5\"', NULL, '550 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4500, NULL, NULL, '0082', 'product1648980783.jpg', NULL, '1', '1', 12, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 20:58:29', '2022-07-16 05:15:22', NULL, 45),
(96, 34, NULL, 0, '8\" Iraqi Full Angkhola Khukuri', '0083', '8-iraqi-full-angkhola-khukuri-eox2', NULL, '83', '8\"', '5\"', NULL, '600 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5500, NULL, NULL, '0083', 'product1649589886.jpg', NULL, '1', '1', 9, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 21:02:15', '2022-07-16 05:16:55', NULL, 45),
(97, 36, NULL, 0, '9\" Nepal Police Khukuri', '0084', '9-nepal-police-khukuri-ykxa', NULL, '84', '9\"', '5\"', NULL, '600 gm', 'Horn Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5000, NULL, NULL, '0084', 'product1648981161.jpg', NULL, '0', '1', 12, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 21:04:52', '2022-07-16 05:17:04', NULL, 45),
(98, 10, NULL, 0, '8\" Rust Free Katle Custom Khukuri', '0085', '8-rust-free-katle-custom-khukuri-cwlw', NULL, '85', '8\"', '4.5\"', NULL, '500 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0085', 'product1648981337.jpg', NULL, '1', '1', 10, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 21:07:34', '2022-07-16 05:15:18', NULL, 45),
(99, 20, NULL, 0, '6\" Custom Made Rust Free Survival Knife', '0086', '6-custom-made-rust-free-survival-knife-l02f', NULL, '86', '6\"', '4.5\"', NULL, '450 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6000, NULL, NULL, '0086', 'product1648981685.jpg', NULL, '0', '1', 11, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 21:13:22', '2022-07-16 05:18:25', NULL, 45);
INSERT INTO `tbl_products` (`id`, `category_id`, `content_id`, `owner_id`, `product_name`, `product_code`, `product_slug`, `product_brand`, `product_model`, `blade`, `handle`, `blade_weight`, `total_weight`, `material`, `product_highlights`, `product_description`, `product_warranty_type`, `product_warrenty_period`, `product_warrenty_policy`, `product_whats_on_box`, `product_package_weight`, `weight_measure`, `product_package_dimension`, `product_video_url`, `home_delivery`, `delivery_charges`, `tax`, `product_original_price`, `product_compare_price`, `product_key_features`, `product_sku`, `image`, `alt`, `on_sale`, `best_rated`, `view_count`, `on_deal`, `deal_end_date`, `publish_status`, `delete_status`, `live_status`, `quality_status`, `quality_reject_reason`, `quality_control_comment`, `policy_status`, `policy_reject_reason`, `policy_control_comment`, `penalty_type`, `created_by`, `updated_by`, `meta_title`, `meta_keyword`, `meta_description`, `created_at`, `updated_at`, `deliveryType`, `cargo`) VALUES
(100, 11, NULL, 0, '8\" Iraqi Gripper Blocker Khukuri', '0087', '8-iraqi-gripper-blocker-khukuri-bt8o', NULL, '87', '8\"', '4.5\"', NULL, '600 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5500, NULL, NULL, '0087', 'product1648983169.jpg', NULL, '0', '1', 11, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 21:38:15', '2022-07-16 05:15:43', NULL, 45),
(101, 11, NULL, 0, '6\" Iraqi Gripper Blocker Khukuri', '0088', '6-iraqi-gripper-blocker-khukuri-z5bp', NULL, '88', '6\"', '4.5\"', NULL, '450 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5000, NULL, NULL, '0088', 'product1649155671.jpg', NULL, '0', '1', 17, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 21:40:41', '2022-07-16 05:15:42', NULL, 45),
(102, 9, NULL, 0, '8\" Afgan Khukuri', '0089', '8-afgan-khukuri-orp4', NULL, '89', '8\"', '5\"', NULL, '500 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4500, NULL, NULL, '0089', 'product1648983626.jpg', NULL, '0', '1', 23, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 21:45:47', '2022-07-16 05:15:37', NULL, 45),
(103, 9, NULL, 0, '6\" Afgan Khukuri', '0090', '6-afgan-khukuri-cfto', NULL, '90', '6\"', '4.5\"', NULL, '400 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4250, NULL, NULL, '0090', 'product1650606487.jpg', NULL, '1', '1', 16, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 21:53:56', '2022-07-16 05:15:36', NULL, 45),
(104, 32, NULL, 0, '8\" American Eagle Dragon Khukuri', '0091', '8-american-eagle-dragon-khukuri-xw1u', NULL, '91', '8\"', '5\"', NULL, '500 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0091', 'product1650606665.jpg', NULL, '1', '1', 15, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 21:57:44', '2022-07-16 05:16:39', NULL, 45),
(105, 35, NULL, 0, '8\" Afgan Custom Khukuri', '0092', '8-afgan-custom-khukuri-jx4u', NULL, '92', '8\"', '5\"', NULL, '500 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4500, NULL, NULL, '0092', 'product1648984472.jpg', NULL, '1', '1', 9, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 21:59:45', '2022-07-16 05:16:59', NULL, 45),
(106, 10, NULL, 0, '8\" Katle Working Rust Free Khukuri', '0093', '8-katle-working-rust-free-khukuri-qyia', NULL, '93', '8\"', '5\"', NULL, '550 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0093', 'product1648984983.jpg', NULL, '1', '1', 13, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:08:20', '2022-07-16 05:15:15', NULL, 45),
(107, 33, NULL, 0, '8\" Itihas Balance Khukuri', '0094', '8-itihas-balance-khukuri-srvt', NULL, '94', '8\"', '5\"', NULL, '600 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5500, NULL, NULL, '0094', 'product1648985090.jpg', NULL, '1', '1', 11, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:10:05', '2022-07-16 05:15:09', NULL, 45),
(108, 10, NULL, 0, '8\" Rust Free Katle Khukuri', '0095', '8-rust-free-katle-khukuri-opnx', NULL, '95', '8\"', '5\"', NULL, '600 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0095', 'product1648985279.jpg', NULL, '1', '1', 24, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:13:24', '2022-07-16 05:15:08', NULL, 45),
(109, 32, NULL, 0, '6\" American Eagle Dragon Khukuri', '0096', '6-american-eagle-dragon-khukuri-1k0o', NULL, '96', '6\"', '4.5\"', NULL, '400 gm', 'Bone Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0096', 'product1648985401.jpg', NULL, '1', '1', 17, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:15:22', '2022-07-16 05:15:06', NULL, 45),
(110, 24, NULL, 0, '6\" American Eagle Khukuri', '0097', '6-american-eagle-khukuri-vd1g', NULL, '97', '6\"', '4.5\"', NULL, '500 gm', 'Bone Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5000, NULL, NULL, '0097', 'product1648985555.jpg', NULL, '1', '1', 12, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:17:53', '2022-07-16 05:15:00', NULL, 45),
(111, 6, NULL, 0, '8\" Panawal Sirupate Khukuri', '0098', '8-panawal-sirupate-khukuri-am7z', NULL, '98', '8\"', '5\"', NULL, '500 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5500, NULL, NULL, '0098', 'product1648985706.jpg', NULL, '0', '1', 12, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:20:21', '2022-07-16 05:14:56', NULL, 45),
(112, 6, NULL, 0, '6\" Panawal Jungle Khukuri', '0099', '6-panawal-jungle-khukuri-qedo', NULL, '99', '6\"', '5\"', NULL, '450 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4250, NULL, NULL, '0099', 'product1648985869.jpg', NULL, '1', '1', 19, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:23:39', '2022-07-16 05:14:55', NULL, 45),
(113, 6, NULL, 0, '6\" Rust Free Panawal  Katle Khukuri', '0100', '6-rust-free-panawal-katle-khukuri-nwgy', NULL, '100', '6\"', '5\"', NULL, '500 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5000, NULL, NULL, '0100', 'product1648986025.jpg', NULL, '1', '1', NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:25:40', '2022-04-03 22:25:40', NULL, 45),
(114, 25, NULL, 0, '6\" Aang Khola Khukuri', '0101', '6-aang-khola-khukuri-ovo9', NULL, '101', '6\"', '4.5\"', NULL, '450 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4000, NULL, NULL, '0101', 'product1648986140.jpg', NULL, '1', '1', 17, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:27:46', '2022-07-17 11:57:26', NULL, 45),
(115, 33, NULL, 0, '6\" Itihas Balance Khukuri', '0102', '6-itihas-balance-khukuri-ovwi', NULL, '102', '6\"', '4.5\"', NULL, '450 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4500, NULL, NULL, '0102', 'product1648986257.jpg', NULL, '1', '1', 12, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:29:41', '2022-07-16 05:14:47', NULL, 45),
(116, 18, NULL, 0, '5\" Ganjawal Balance Khukuri', '0103', '5-ganjawal-balance-khukuri-nvlo', NULL, '103', '5\"', '4\"', NULL, '100 gm', '8000', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5000, NULL, NULL, '0103', 'product1648986441.jpg', NULL, '1', '1', 12, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:34:50', '2022-07-16 05:14:46', NULL, 30),
(117, 18, NULL, 0, '8\" Ganjawal Balance Khukuri', '0104', '8-ganjawal-balance-khukuri-vuac', NULL, '104', '8\"', '5\"', NULL, '500 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 8000, NULL, NULL, '0104', 'product1650608469.jpg', NULL, '1', '1', 17, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:36:38', '2022-07-16 05:14:43', NULL, 45),
(118, 6, NULL, 0, '6\" Ganjawal Balance Khukuri', '0105', '6-ganjawal-balance-khukuri-kbg6', NULL, '105', '6\"', '4\"', NULL, '300 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5500, NULL, NULL, '0105', 'product1648986981.jpg', NULL, '1', '1', 13, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:41:39', '2022-07-16 05:14:43', NULL, 30),
(119, 18, NULL, 0, '10\" Traditional Ganjawal Khukuri', '0106', '10-traditional-ganjawal-khukuri-m8vf', NULL, '106', '10\"', '4\"', NULL, '550 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 8000, NULL, NULL, '0106', 'product1648987247.jpg', NULL, '1', '1', 13, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:46:04', '2022-07-16 05:14:37', NULL, 45),
(120, 18, NULL, 0, '8\" Ganjawal Balance Khukuri', '0107', '8-ganjawal-balance-khukuri-jjt4', NULL, '107', '8\"', '4\"', NULL, '350 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0107', 'product1649157580.jpg', NULL, '1', '1', 13, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:48:12', '2022-07-16 05:14:35', NULL, 45),
(121, 18, NULL, 0, '4\" Traditional Ganjawal Khukuri', '0108', '4-traditional-ganjawal-khukuri-fh3l', NULL, '108', '4\"', '4\"', NULL, '100 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 3750, NULL, NULL, '0108', 'product1648987461.jpg', NULL, '1', '1', 14, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:49:38', '2022-07-16 05:14:32', NULL, 30),
(122, 6, NULL, 0, '6\" Panawal Jungle Khukuri', '0109', '6-panawal-jungle-khukuri-8czb', NULL, '109', '6\"', '5\"', NULL, '450 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4000, NULL, NULL, '0109', 'product1648987576.jpg', NULL, '1', '1', 13, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:51:31', '2022-07-16 05:14:32', NULL, 30),
(123, 32, NULL, 0, '6\" American Eagle Dragon Khukuri', '0110', '6-american-eagle-dragon-khukuri-rzhf', NULL, '110', '6\"', '4.5\"', NULL, '400 gm', 'Wooden + Bone Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5500, NULL, NULL, '0110', 'product1650609139.jpg', NULL, '1', '1', 15, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:53:48', '2022-07-16 05:14:31', NULL, 30),
(124, 32, NULL, 0, '8\" Custom American Eagle Dragon Khukuri', '0111', '8-custom-american-eagle-dragon-khukuri-k2ig', NULL, '111', '8\"', '4.5\"', NULL, '400 gm', 'Wooden + Bone Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 7500, NULL, NULL, '0111', 'product1648988038.jpg', NULL, '1', '1', 14, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 22:59:07', '2022-07-16 05:14:26', NULL, 45),
(125, 24, NULL, 0, '5\" American Eagle Khukuri', '0112', '5-american-eagle-khukuri-4gcc', NULL, '112', '5\"', '4\"', NULL, '250 gm', 'Horn Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4500, NULL, NULL, '0112', 'product1648988163.jpg', NULL, '1', '1', 16, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-03 23:01:16', '2022-07-16 05:14:24', NULL, 30),
(126, 32, NULL, 0, '5.5\" American Eagle Dragon Khukuri', '0113', '55-american-eagle-dragon-khukuri-ipjt', NULL, '113', '5.5', '4.5', NULL, '300 gm', 'Horn Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5000, NULL, NULL, '0113', 'product1649045065.jpg', NULL, '0', '1', NULL, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-04 14:47:08', '2022-04-22 17:30:22', NULL, 30),
(128, 24, NULL, 0, '4\" American Eagle Bone Handle Khukuri', '0115', '4-american-eagle-bone-handle-khukuri-sikc', NULL, '115', '4\"', '4\"', NULL, '200 gm', 'Bone Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 3750, NULL, NULL, '0115', 'product1649054087.jpg', NULL, '1', '1', 15, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-04 17:24:15', '2022-07-17 02:33:23', NULL, 30),
(129, 24, NULL, 0, '5\" American Eagle Bone Handle Khukuri', '0116', '5-american-eagle-bone-handle-khukuri-ahoe', NULL, '116', '5\"', '4\"', NULL, '300 gm', 'Wooden Handel', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4500, NULL, NULL, '0116', 'product1649054692.jpg', NULL, '1', '1', 14, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-04 17:30:10', '2022-07-16 05:14:22', NULL, 30),
(130, 32, NULL, 0, '5\" American Eagle Dragon Khukuri', '0117', '5-american-eagle-dragon-khukuri-7lqr', NULL, '117', '5\"', '4\"', NULL, '300 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4500, NULL, NULL, '0117', 'product1649054857.jpg', NULL, '1', '1', 15, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-04 17:32:53', '2022-07-16 05:14:21', NULL, 30),
(131, 32, NULL, 0, '4\" American Eagle Dragon Khukuri', '0118', '4-american-eagle-dragon-khukuri-9lff', NULL, '118', '4\"', '4\"', NULL, '200 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 3750, NULL, NULL, '0118', 'product1649054962.jpg', NULL, '0', '1', 13, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-04 17:34:40', '2022-07-16 05:14:21', NULL, 30),
(132, 42, NULL, 0, '5\" Paper Knife', '0119', '5-paper-knife-2qew', NULL, '119', '5\"', '3.5\"', NULL, '150 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 2500, NULL, NULL, '0119', 'product1650610735.jpg', NULL, '1', '1', 19, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-04 17:38:15', '2022-07-17 11:57:19', NULL, 30),
(133, 42, NULL, 0, '4\" Paper Knife', '0120', '4-paper-knife-xnir', NULL, '120', '4\"', '3\"', NULL, '100 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 2000, NULL, NULL, '0120', 'product1650610837.jpg', NULL, '1', '1', 18, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-04 17:39:52', '2022-07-17 11:57:20', NULL, 30),
(134, 19, NULL, 0, '8\" Dhankute Five Fuller Horn Khukuri', '0121', '8-dhankute-five-fuller-horn-khukuri-vblk', NULL, '121', '8\"', '5\"', NULL, '300 gm', 'Horn Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 8750, NULL, NULL, '0121', 'product1649158021.jpg', NULL, '1', '1', 14, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-04 17:43:37', '2022-07-16 05:14:16', NULL, 30),
(135, 19, NULL, 0, '5\" Dhankute Five Fuller Horn Khukuri', '0122', '5-dhankute-five-fuller-horn-khukuri-jxah', NULL, '122', '5\"', '3.5\"', NULL, '150 gm', 'Horn Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5000, NULL, NULL, '0122', 'product1649157899.jpg', NULL, '1', '1', 18, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-04 17:45:13', '2022-07-16 05:14:11', NULL, 30),
(136, 33, NULL, 0, '5\" Itihas Khukuri', '0123', '5-itihas-khukuri-ufcu', NULL, '123', '5\"', '4.5\"', NULL, '250 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 3000, NULL, NULL, '0123', 'product1649055752.jpg', NULL, '1', '1', 19, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-04 17:47:49', '2022-07-17 11:57:21', NULL, 30),
(137, 43, NULL, 0, '8\" Handmade Stone Set Mini Jungle Khukuri', '0124', '8-handmade-stone-set-mini-jungle-khukuri-ssjg', NULL, '124', '8\"', '5\"', NULL, '550 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 7500, NULL, NULL, '0124', 'product1650611199.jpg', NULL, '1', '1', 18, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-04 18:12:03', '2022-07-16 05:14:03', NULL, 45),
(138, 43, NULL, 0, '6\" Handmade Stone Set Mini Jungle Khukuri', '0125', '6-handmade-stone-set-mini-jungle-khukuri-h18i', NULL, '125', '6\"', '4.5\"', NULL, '450 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0125', 'product1650611492.jpg', NULL, '0', '1', 15, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-04 18:13:51', '2022-07-16 05:14:00', NULL, 45),
(139, 43, NULL, 0, '5\" Handmade Stone Set Super Mini Jungle Khukuri', '0126', '5-handmade-stone-set-super-mini-jungle-khukuri-zwit', NULL, '126', '5\"', '4.5\"', NULL, '400 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5500, NULL, NULL, '0126', 'product1649057418.jpg', NULL, '0', '1', 20, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-04 18:15:31', '2022-07-16 05:14:00', NULL, 30),
(140, 43, NULL, 0, '4\"Handmade Stone Set Super Mini Jungle Khukuri', '0127', '4handmade-stone-set-super-mini-jungle-khukuri-fkks', NULL, '127', '4\"', '4\"', NULL, '400 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5000, NULL, NULL, '0127', 'product1650611642.jpg', NULL, '0', '1', 17, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-04 18:49:10', '2022-07-16 05:13:57', NULL, 30),
(141, 6, NULL, 0, '4\" Handmade Stone Set Panawal Khukuri', '0128', '4-handmade-stone-set-panawal-khukuri-i34s', NULL, '128', '4\"', '4\"', NULL, '200 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5000, NULL, NULL, '0128', 'product1650611735.jpg', NULL, '0', '1', 21, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-04 18:51:31', '2022-07-16 05:13:53', NULL, 30),
(142, 32, NULL, 0, '4\" American Eagle Dragon Bone Handle  Khukuri', '0114', '4-american-eagle-dragon-bone-handle-khukuri-kzxw', NULL, '114', '4\"', '4\"', NULL, '300 gm', 'Bone Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 3750, NULL, NULL, '0114', 'product1650614244.jpg', NULL, '1', '1', 12, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-22 16:55:50', '2022-07-16 05:13:46', NULL, 30),
(143, 42, NULL, 0, '4\" Handmade Stone Set Paper Knife Khukuri', '0129', '4-handmade-stone-set-paper-knife-khukuri-78qp', NULL, '129', '4\"', '3.5\"', NULL, '100 gm', 'Wooden Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4500, NULL, NULL, '0129', 'product1650612402.jpg', NULL, '0', '0', 7, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-22 18:11:57', '2022-07-16 05:13:44', NULL, 30),
(144, 24, NULL, 0, '6\" Handmade Stone Set American Eagle Khukuri', '0130', '6-handmade-stone-set-american-eagle-khukuri-t3hc', NULL, '130', '6\"', '4.5\"', NULL, '250 gm', 'Horn Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5500, NULL, NULL, '0130', 'product1650612752.jpg', NULL, '1', '1', 10, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-22 18:18:15', '2022-07-16 05:13:43', NULL, 30),
(145, 24, NULL, 0, '5\" Handmade Stone Set American Eagle Khukuri', '0131', '5-handmade-stone-set-american-eagle-khukuri-hnwc', NULL, '131', '5\"', '4.5\"', NULL, '250 gm', 'Wooden + Bone Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 6250, NULL, NULL, '0131', 'product1650612957.jpg', NULL, '1', '1', 9, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-22 18:21:28', '2022-07-16 05:13:40', NULL, 30),
(146, 24, NULL, 0, '4\" Handmade Stone Set American Eagle Khukuri', '0132', '4-handmade-stone-set-american-eagle-khukuri-wdw5', NULL, '132', '4\"', '4\"', NULL, '250 gm', 'Wooden + Bone Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 5500, NULL, NULL, '0132', 'product1650613202.jpg', NULL, '1', '1', 13, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-22 18:25:39', '2022-07-16 05:13:38', NULL, 30),
(147, 24, NULL, 0, '4\" Handmade Stone Set American Eagle Khukuri', '0133', '4-handmade-stone-set-american-eagle-khukuri-atti', NULL, '133', '4\"', '4\"', NULL, '250 gm', 'Bone Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 4500, NULL, NULL, '0133', 'product1650613389.jpg', NULL, '1', '0', 12, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-22 18:28:55', '2022-07-16 05:13:32', NULL, 30),
(148, 32, NULL, 0, '4', '0134', '4-nzti', NULL, '134', '4', '4', NULL, '250 gm', 'Bone Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 45, NULL, NULL, '0134', 'product1650613637.jpg', NULL, '0', '0', 16, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-22 18:32:30', '2022-07-17 11:57:17', NULL, 30),
(149, 32, NULL, 0, '5', '0135', '5-tgxl', NULL, '135', '5', '4.5', NULL, '250 gm', 'Bone Handle', NULL, NULL, 'no_warranty', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 55, NULL, NULL, '0135', 'product1650613787.jpg', NULL, '1', '1', 22, NULL, NULL, '1', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-04-22 18:35:04', '2022-07-17 11:57:16', NULL, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_push_notifications`
--

CREATE TABLE `tbl_push_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type` enum('product','news','coupons') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `external_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_referrals`
--

CREATE TABLE `tbl_referrals` (
  `ref_customer_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `referral_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_return_transaction_overviews`
--

CREATE TABLE `tbl_return_transaction_overviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `transaction_type` enum('payment_fee_credit','reversal_commission_fee','reversal_item_price') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `amount` double DEFAULT NULL,
  `vat` double DEFAULT NULL,
  `wht` text COLLATE utf8mb4_unicode_ci,
  `statement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviews`
--

CREATE TABLE `tbl_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reply` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sales_returns`
--

CREATE TABLE `tbl_sales_returns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_id` bigint(20) NOT NULL,
  `seller_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `ref_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `complete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sellers`
--

CREATE TABLE `tbl_sellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `seller_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_detail` text COLLATE utf8mb4_unicode_ci,
  `business_type` int(11) DEFAULT NULL,
  `company_website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_offer` text COLLATE utf8mb4_unicode_ci,
  `company_description` text COLLATE utf8mb4_unicode_ci,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `activation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_acc_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `holiday_mode` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `commission` double NOT NULL DEFAULT '0',
  `publish_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verify_otp` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seller_add_productnotifications`
--

CREATE TABLE `tbl_seller_add_productnotifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `seen_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_detail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_mini_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `viber` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_embed_link` longtext COLLATE utf8mb4_unicode_ci,
  `map_link` text COLLATE utf8mb4_unicode_ci,
  `operation` text COLLATE utf8mb4_unicode_ci,
  `privacy_policy` text COLLATE utf8mb4_unicode_ci,
  `terms_and_conditions` text COLLATE utf8mb4_unicode_ci,
  `refer_reward` int(11) DEFAULT NULL,
  `dollar_rate` double DEFAULT NULL,
  `vat` double NOT NULL DEFAULT '0',
  `payment_fee` double NOT NULL DEFAULT '0',
  `register_reward` double NOT NULL DEFAULT '0',
  `purchase_reward` double NOT NULL DEFAULT '0',
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expressCharge` double NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `site_name`, `address`, `phone`, `email`, `contact_detail`, `site_url`, `site_logo`, `site_mini_logo`, `facebook`, `twitter`, `youtube`, `linkedin`, `instagram`, `viber`, `whatsapp`, `map_embed_link`, `map_link`, `operation`, `privacy_policy`, `terms_and_conditions`, `refer_reward`, `dollar_rate`, `vat`, `payment_fee`, `register_reward`, `purchase_reward`, `meta_title`, `meta_keyword`, `meta_description`, `created_at`, `updated_at`, `expressCharge`) VALUES
(1, 'Gorkha khukuri', 'Kathmandu, Nepal', '9855083554', 'info@khukurihouse.com', NULL, 'https://kukurihouse.com/', 'setting1641985637.jpg', 'site-mini-logo-1641985649.png', 'https://www.facebook.com/theexgurkhakhukurihouse', 'https://twitter.com/TheExGurkha', NULL, NULL, 'https://www.instagram.com/theexgurkhakhukurihouse/', '9855083554', '9855083554', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2022-03-25 17:20:30', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sliders`
--

CREATE TABLE `tbl_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_desc` text COLLATE utf8mb4_unicode_ci,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `alt_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `hide_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_sliders`
--

INSERT INTO `tbl_sliders` (`id`, `title`, `body`, `image`, `link`, `meta_desc`, `meta_keyword`, `meta_title`, `alt_img`, `publish_status`, `delete_status`, `hide_status`, `created_at`, `updated_at`) VALUES
(1, 'Khukuris Used By Gurkhas', NULL, 'slider1655813936.jpg', NULL, NULL, NULL, NULL, NULL, '1', '0', '1', '2022-01-12 20:06:09', '2022-06-21 23:04:19'),
(2, 'The Authentic Khukuri', NULL, 'slider1655104172.png', NULL, NULL, NULL, NULL, NULL, '1', '0', '0', '2022-01-12 23:40:01', '2022-06-13 17:54:42'),
(3, 'Feel the ex Gurkha Spirit', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '2022-03-24 23:03:11', '2022-03-24 23:03:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_statements`
--

CREATE TABLE `tbl_statements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `opening_balance` double DEFAULT '0',
  `closing_balance` double DEFAULT '0',
  `paid_balance` double DEFAULT '0',
  `order_item_charge` double DEFAULT '0',
  `order_eshopping_fee` double DEFAULT '0',
  `order_payment_fee` double DEFAULT '0',
  `order_commission_fee` double DEFAULT '0',
  `order_shipping_fee` double DEFAULT '0',
  `order_penalties` double DEFAULT '0',
  `order_vat` double DEFAULT '0',
  `order_subtotal` double DEFAULT '0',
  `refund_item_charge` double DEFAULT '0',
  `refund_eshopping_fee` double DEFAULT '0',
  `refund_payment_fee_credit` double DEFAULT '0',
  `refund_reversal_commission_fee` double DEFAULT '0',
  `refund_penalties` double DEFAULT '0',
  `refund_vat` double DEFAULT '0',
  `refund_subtotal` double DEFAULT '0',
  `payout` double DEFAULT '0',
  `paid_status` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `publish_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `delete_status` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stocks`
--

CREATE TABLE `tbl_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `old_stock` bigint(20) DEFAULT '0',
  `new_stock` bigint(20) DEFAULT '0',
  `total_stock` bigint(20) DEFAULT '0',
  `damaged_stock` bigint(20) DEFAULT '0',
  `returned_stock` bigint(20) DEFAULT '0',
  `returned_damage_stock` bigint(20) DEFAULT '0',
  `withholding_stock` bigint(20) DEFAULT '0',
  `delivered_stock` bigint(20) DEFAULT '0',
  `sellable_stock` bigint(20) DEFAULT '0',
  `remaining_stock` bigint(20) DEFAULT '0',
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_stocks`
--

INSERT INTO `tbl_stocks` (`id`, `product_id`, `old_stock`, `new_stock`, `total_stock`, `damaged_stock`, `returned_stock`, `returned_damage_stock`, `withholding_stock`, `delivered_stock`, `sellable_stock`, `remaining_stock`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 20, 100, 120, 13, 2, 2, 12, -2, 107, 95, NULL, '2022-01-12 22:41:22', '2022-01-14 18:12:14'),
(2, 2, 0, 100, 100, 0, 0, 0, 25, 25, 75, 50, NULL, '2022-01-12 22:58:20', '2022-01-12 22:59:00'),
(3, 3, 0, 100, 100, 0, 0, 0, 30, 20, 80, 50, NULL, '2022-01-14 21:44:49', '2022-01-14 21:45:09'),
(4, 4, 100, 100, 200, 0, 0, 0, 100, 10, 190, 90, NULL, '2022-01-14 21:56:30', '2022-01-14 21:58:13'),
(5, 5, 0, 100, 100, 0, 0, 0, 50, 0, 100, 50, NULL, '2022-01-14 22:01:02', '2022-01-14 22:01:19'),
(6, 6, 100, 100, 200, 0, 0, 0, 20, 0, 200, 180, NULL, '2022-01-14 22:06:30', '2022-01-14 22:06:49'),
(7, 7, 0, 100, 100, 0, 0, 0, 50, 0, 100, 50, NULL, '2022-01-14 22:11:19', '2022-01-14 22:11:36'),
(8, 8, 0, 100, 100, 0, 0, 0, 10, 0, 100, 90, NULL, '2022-01-14 22:26:13', '2022-01-14 22:26:25'),
(9, 9, 0, 10000, 10000, 0, 0, 0, 1000, 0, 10000, 9000, NULL, '2022-01-14 22:32:48', '2022-01-14 22:33:05'),
(10, 10, 0, 500, 500, 0, 0, 0, 100, 0, 500, 400, NULL, '2022-01-14 22:36:35', '2022-01-14 22:36:47'),
(11, 11, 0, 200, 200, 0, 0, 0, 20, 0, 200, 180, NULL, '2022-01-14 22:40:36', '2022-01-14 22:40:50'),
(12, 12, 0, 100, 100, 0, 0, 0, 20, 0, 100, 80, NULL, '2022-01-14 22:47:32', '2022-01-14 22:47:43'),
(13, 13, 0, 1000, 1000, 0, 0, 0, 200, 300, 700, 500, NULL, '2022-02-17 22:23:16', '2022-02-17 22:23:49'),
(14, 14, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-11 16:57:55', '2022-03-11 16:59:02'),
(15, 15, 10, 10, 20, 0, 0, 0, 0, 0, 20, 20, NULL, '2022-03-11 17:04:03', '2022-03-11 17:04:10'),
(16, 16, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-11 17:05:38', '2022-03-11 17:05:44'),
(17, 17, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-11 17:10:45', '2022-03-11 17:10:56'),
(18, 18, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-11 17:16:08', '2022-03-11 17:16:13'),
(19, 19, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-11 17:24:01', '2022-03-11 17:24:08'),
(20, 20, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-11 17:27:29', '2022-03-11 17:27:38'),
(21, 21, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-11 23:15:30', '2022-03-11 23:16:12'),
(22, 22, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-11 23:19:30', '2022-03-11 23:19:37'),
(23, 23, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-11 23:23:11', '2022-03-11 23:23:19'),
(24, 24, 0, 20, 20, 0, 0, 0, 0, 0, 20, 20, NULL, '2022-03-11 23:26:04', '2022-03-11 23:26:12'),
(25, 25, 0, 20, 20, 0, 0, 0, 0, 0, 20, 20, NULL, '2022-03-11 23:29:10', '2022-03-11 23:29:59'),
(26, 26, 0, 20, 20, 0, 0, 0, 0, 0, 20, 20, NULL, '2022-03-11 23:34:09', '2022-03-11 23:34:16'),
(27, 27, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-11 23:37:30', '2022-03-11 23:37:38'),
(28, 28, 0, 20, 20, 0, 0, 0, 0, 0, 20, 20, NULL, '2022-03-11 23:42:17', '2022-03-11 23:42:23'),
(29, 29, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-13 17:31:49', '2022-03-13 17:31:55'),
(30, 30, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-13 17:34:00', '2022-03-13 17:34:05'),
(31, 31, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-13 17:36:18', '2022-03-13 17:36:23'),
(32, 32, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-13 17:39:44', '2022-03-13 17:43:11'),
(33, 33, 10, 10, 20, 0, 0, 0, 0, 0, 20, 20, NULL, '2022-03-13 18:10:34', '2022-03-13 18:11:01'),
(34, 34, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-13 18:29:06', '2022-03-13 18:38:08'),
(35, 35, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-13 20:49:56', '2022-03-13 20:50:31'),
(36, 36, 0, 20, 20, 0, 0, 0, 0, 0, 20, 20, NULL, '2022-03-13 21:42:07', '2022-03-13 21:42:13'),
(37, 37, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-14 19:38:04', '2022-03-14 19:38:11'),
(38, 38, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-14 19:39:51', '2022-03-14 19:39:56'),
(39, 39, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-14 19:42:28', '2022-03-14 19:42:36'),
(40, 40, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-14 19:44:56', '2022-03-14 19:45:05'),
(41, 41, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-14 19:48:47', '2022-03-14 19:48:53'),
(42, 42, 0, 20, 20, 0, 0, 0, 0, 0, 20, 20, NULL, '2022-03-14 19:52:32', '2022-03-14 19:52:37'),
(43, 43, 0, 10, 10, 0, 0, 0, 0, 0, 10, 10, NULL, '2022-03-14 19:54:14', '2022-03-14 19:54:56'),
(44, 44, 0, 1, 1, 0, 0, 0, 0, 0, 1, 1, NULL, '2022-03-30 15:18:28', '2022-03-30 15:21:28'),
(45, 45, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-03-31 20:58:30', '2022-03-31 20:58:38'),
(46, 46, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-03-31 22:53:21', '2022-03-31 22:53:29'),
(47, 47, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '2022-03-31 22:55:36', '2022-03-31 22:55:36'),
(48, 48, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-01 15:57:44', '2022-04-01 15:57:52'),
(49, 49, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-01 15:59:40', '2022-04-01 15:59:46'),
(50, 50, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-01 16:01:58', '2022-04-01 16:02:23'),
(51, 51, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-01 16:05:48', '2022-04-01 16:06:10'),
(52, 52, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-01 16:08:16', '2022-04-01 16:08:22'),
(53, 53, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-01 16:10:53', '2022-04-01 16:10:58'),
(54, 54, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-01 16:15:26', '2022-04-01 16:15:31'),
(55, 55, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-01 17:13:16', '2022-04-01 17:13:23'),
(56, 56, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-01 17:15:22', '2022-04-01 17:15:34'),
(57, 57, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-01 17:21:31', '2022-04-01 17:21:37'),
(58, 58, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '2022-04-01 18:24:57', '2022-04-01 18:24:57'),
(59, 59, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 14:59:54', '2022-04-03 15:00:38'),
(60, 60, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 15:02:03', '2022-04-03 15:02:39'),
(61, 61, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 15:07:13', '2022-04-03 15:07:19'),
(62, 62, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 15:10:05', '2022-04-03 15:10:46'),
(63, 63, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 16:12:56', '2022-04-03 16:13:08'),
(64, 64, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 16:18:12', '2022-04-03 16:18:19'),
(65, 65, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 16:23:07', '2022-04-03 16:23:22'),
(66, 66, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 16:26:59', '2022-04-03 16:27:18'),
(67, 67, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 16:28:52', '2022-04-03 16:29:40'),
(68, 68, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 16:31:08', '2022-04-03 16:31:16'),
(69, 69, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 17:19:50', '2022-04-03 17:20:24'),
(70, 70, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 17:26:55', '2022-04-03 17:27:01'),
(71, 71, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 17:30:12', '2022-04-03 17:30:36'),
(72, 72, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 17:32:08', '2022-04-03 17:32:49'),
(73, 73, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 17:37:19', '2022-04-03 17:37:27'),
(74, 74, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 17:40:35', '2022-04-03 17:42:38'),
(75, 75, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 17:45:25', '2022-04-03 17:45:33'),
(76, 76, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 17:48:08', '2022-04-03 17:48:14'),
(77, 77, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 17:50:15', '2022-04-03 17:50:21'),
(78, 78, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 17:53:19', '2022-04-03 17:53:29'),
(79, 79, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 17:57:06', '2022-04-03 17:57:18'),
(80, 80, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 18:00:33', '2022-04-03 18:04:45'),
(81, 81, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 18:07:32', '2022-04-03 18:07:38'),
(82, 82, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 18:10:15', '2022-04-03 18:10:24'),
(83, 83, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 20:10:33', '2022-04-03 20:10:42'),
(84, 84, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 20:12:31', '2022-04-03 20:12:39'),
(85, 85, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 20:16:04', '2022-04-03 20:16:12'),
(86, 86, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 20:23:34', '2022-04-03 20:24:26'),
(87, 87, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 20:26:06', '2022-04-03 20:26:14'),
(88, 88, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 20:28:59', '2022-04-03 20:29:28'),
(89, 89, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 20:36:14', '2022-04-03 20:36:23'),
(90, 90, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 20:38:45', '2022-04-03 20:38:56'),
(91, 91, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 20:40:45', '2022-04-03 20:40:54'),
(92, 92, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 20:47:56', '2022-04-03 20:48:09'),
(93, 93, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 20:51:24', '2022-04-03 20:51:29'),
(94, 94, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 20:56:22', '2022-04-03 20:56:30'),
(95, 95, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 20:58:29', '2022-04-03 20:58:51'),
(96, 96, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 21:02:15', '2022-04-03 21:02:37'),
(97, 97, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 21:04:53', '2022-04-03 21:05:12'),
(98, 98, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 21:07:34', '2022-04-03 21:07:45'),
(99, 99, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 21:13:22', '2022-04-03 21:13:29'),
(100, 100, 200, 200, 400, 0, 0, 0, 0, 0, 400, 400, NULL, '2022-04-03 21:38:15', '2022-04-03 21:38:53'),
(101, 101, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 21:40:41', '2022-04-03 21:40:52'),
(102, 102, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 21:45:47', '2022-04-03 21:47:39'),
(103, 103, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 21:53:57', '2022-04-03 21:54:34'),
(104, 104, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 21:57:44', '2022-04-03 21:58:07'),
(105, 105, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 21:59:45', '2022-04-03 21:59:55'),
(106, 106, 0, 20, 20, 0, 0, 0, 0, 0, 20, 20, NULL, '2022-04-03 22:08:20', '2022-04-03 22:08:36'),
(107, 107, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:10:05', '2022-04-03 22:11:30'),
(108, 108, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:13:25', '2022-04-03 22:13:42'),
(109, 109, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:15:22', '2022-04-03 22:15:38'),
(110, 110, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:17:53', '2022-04-03 22:18:06'),
(111, 111, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:20:22', '2022-04-03 22:20:27'),
(112, 112, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:23:39', '2022-04-03 22:24:21'),
(113, 113, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:25:40', '2022-04-03 22:25:47'),
(114, 114, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:27:46', '2022-04-03 22:27:52'),
(115, 115, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:29:41', '2022-04-03 22:30:26'),
(116, 116, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:34:50', '2022-04-03 22:34:58'),
(117, 117, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:36:38', '2022-04-03 22:39:03'),
(118, 118, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:41:39', '2022-04-03 22:43:47'),
(119, 119, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:46:04', '2022-04-03 22:46:12'),
(120, 120, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:48:13', '2022-04-03 22:48:22'),
(121, 121, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:49:38', '2022-04-03 22:50:13'),
(122, 122, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:51:31', '2022-04-03 22:51:54'),
(123, 123, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:53:49', '2022-04-03 22:53:57'),
(124, 124, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 22:59:07', '2022-04-03 22:59:15'),
(125, 125, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-03 23:01:16', '2022-04-03 23:01:24'),
(126, 126, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '2022-04-04 14:47:08', '2022-04-04 14:47:08'),
(127, 128, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-04 17:24:15', '2022-04-04 17:24:23'),
(128, 129, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-04 17:30:11', '2022-04-04 17:30:17'),
(129, 130, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-04 17:32:53', '2022-04-04 17:32:59'),
(130, 131, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-04 17:34:40', '2022-04-04 17:34:48'),
(131, 132, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-04 17:38:15', '2022-04-04 17:38:23'),
(132, 133, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-04 17:39:52', '2022-04-04 17:41:44'),
(133, 134, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-04 17:43:37', '2022-04-04 17:43:52'),
(134, 135, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-04 17:45:13', '2022-04-04 17:45:19'),
(135, 136, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-04 17:47:49', '2022-04-04 17:48:00'),
(136, 137, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-04 18:12:04', '2022-04-04 18:12:12'),
(137, 138, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-04 18:13:51', '2022-04-04 18:14:05'),
(138, 139, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-04 18:15:31', '2022-04-04 18:15:37'),
(139, 140, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-04 18:49:10', '2022-04-04 18:49:18'),
(140, 141, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-04 18:51:32', '2022-04-04 18:51:41'),
(141, 142, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-22 16:55:50', '2022-04-22 16:55:57'),
(142, 143, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-22 18:11:57', '2022-04-22 18:12:03'),
(143, 144, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-22 18:18:15', '2022-04-22 18:18:22'),
(144, 145, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-22 18:21:28', '2022-04-22 18:21:35'),
(145, 146, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-22 18:25:39', '2022-04-22 18:25:45'),
(146, 147, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-22 18:28:55', '2022-04-22 18:29:00'),
(147, 148, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-22 18:32:30', '2022-04-22 18:32:35'),
(148, 149, 0, 200, 200, 0, 0, 0, 0, 0, 200, 200, NULL, '2022-04-22 18:35:04', '2022-04-22 18:35:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscribers`
--

CREATE TABLE `tbl_subscribers` (
  `id` int(10) UNSIGNED NOT NULL,
  `subscriber_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_subscribers`
--

INSERT INTO `tbl_subscribers` (`id`, `subscriber_email`, `delete_status`, `created_at`, `updated_at`) VALUES
(1, 'mohan@gmail.com', '0', '2022-05-03 18:00:23', '2022-05-03 18:00:23'),
(2, 'mohan@gmail.com', '0', '2022-05-03 18:00:24', '2022-05-03 18:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tags`
--

CREATE TABLE `tbl_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_body` text COLLATE utf8mb4_unicode_ci,
  `publish_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `featured_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction_overviews`
--

CREATE TABLE `tbl_transaction_overviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `transaction_type` enum('payment_fee','commission_fee','shipping_fee','item_price') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `amount` double DEFAULT NULL,
  `vat` double DEFAULT NULL,
  `wht` text COLLATE utf8mb4_unicode_ci,
  `statement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_update_orders`
--

CREATE TABLE `tbl_update_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `ref_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` double NOT NULL DEFAULT '0',
  `coupon_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pending` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `ready_to_ship` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `shipped` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `delivered` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `cancelled` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `failed_delivery` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_update_payments`
--

CREATE TABLE `tbl_update_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `ref_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `complete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `delivery_assign_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `esewa` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `khalti` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `imepay` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `paypal` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `total_price` int(11) DEFAULT NULL,
  `old_total_price` double DEFAULT '0',
  `delivery_cost` int(11) DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apartment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `different_shipping` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `shipping_country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_town` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_apartment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_contactperson` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlists`
--

CREATE TABLE `tbl_wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_wishlists`
--

INSERT INTO `tbl_wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 2, 27, '2022-05-03 20:29:46', '2022-05-03 20:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_writers`
--

CREATE TABLE `tbl_writers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `writer_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `writer_designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `writer_type` enum('reporter','guest') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `writer_body` text COLLATE utf8mb4_unicode_ci,
  `featured_img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `writer_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `writer_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `writer_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `writer_facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `writer_twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `writer_youtube` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `delete_status` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content_product`
--
ALTER TABLE `content_product`
  ADD PRIMARY KEY (`content_product_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_country_slug_unique` (`country_slug`);

--
-- Indexes for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupon_usages_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `delivery_service_areas`
--
ALTER TABLE `delivery_service_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_service_area_districts`
--
ALTER TABLE `delivery_service_area_districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_service_area_districts_area_id_foreign` (`area_id`),
  ADD KEY `delivery_service_area_districts_district_id_foreign` (`district_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districts_province_id_foreign` (`province_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `flash_sales`
--
ALTER TABLE `flash_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flash_sales_productid_foreign` (`productId`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `news_news_category`
--
ALTER TABLE `news_news_category`
  ADD PRIMARY KEY (`news_news_category_id`);

--
-- Indexes for table `news_tag`
--
ALTER TABLE `news_tag`
  ADD PRIMARY KEY (`news_tag_id`);

--
-- Indexes for table `news_writer`
--
ALTER TABLE `news_writer`
  ADD PRIMARY KEY (`news_writer_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `order_delivery_staff`
--
ALTER TABLE `order_delivery_staff`
  ADD PRIMARY KEY (`order_delivery_staff_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `product_staff_seller`
--
ALTER TABLE `product_staff_seller`
  ADD PRIMARY KEY (`product_staff_seller_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_admins_username_unique` (`username`),
  ADD UNIQUE KEY `tbl_admins_email_unique` (`email`);

--
-- Indexes for table `tbl_advertisements`
--
ALTER TABLE `tbl_advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_affiliates`
--
ALTER TABLE `tbl_affiliates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_affiliate_return_transaction_overviews`
--
ALTER TABLE `tbl_affiliate_return_transaction_overviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_affiliate_statements`
--
ALTER TABLE `tbl_affiliate_statements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_affiliate_transaction_overviews`
--
ALTER TABLE `tbl_affiliate_transaction_overviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contacts`
--
ALTER TABLE `tbl_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contents`
--
ALTER TABLE `tbl_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_coupon`
--
ALTER TABLE `tbl_coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_deliveries`
--
ALTER TABLE `tbl_deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_deliveries_assign`
--
ALTER TABLE `tbl_deliveries_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_delivery_delivery_settings`
--
ALTER TABLE `tbl_delivery_delivery_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_delivery_settings`
--
ALTER TABLE `tbl_delivery_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_favourites`
--
ALTER TABLE `tbl_favourites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_imesettings`
--
ALTER TABLE `tbl_imesettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_measures`
--
ALTER TABLE `tbl_measures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_news_categories`
--
ALTER TABLE `tbl_news_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order_cancels`
--
ALTER TABLE `tbl_order_cancels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_photos`
--
ALTER TABLE `tbl_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_products_product_code_unique` (`product_code`),
  ADD UNIQUE KEY `tbl_products_product_slug_unique` (`product_slug`);
ALTER TABLE `tbl_products` ADD FULLTEXT KEY `products_fulltext_index` (`product_name`,`product_brand`,`product_model`);

--
-- Indexes for table `tbl_push_notifications`
--
ALTER TABLE `tbl_push_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_referrals`
--
ALTER TABLE `tbl_referrals`
  ADD PRIMARY KEY (`ref_customer_id`);

--
-- Indexes for table `tbl_return_transaction_overviews`
--
ALTER TABLE `tbl_return_transaction_overviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sales_returns`
--
ALTER TABLE `tbl_sales_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sellers`
--
ALTER TABLE `tbl_sellers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_seller_add_productnotifications`
--
ALTER TABLE `tbl_seller_add_productnotifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_seller_add_productnotifications_product_id_foreign` (`product_id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sliders`
--
ALTER TABLE `tbl_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_statements`
--
ALTER TABLE `tbl_statements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stocks`
--
ALTER TABLE `tbl_stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_stocks_product_id_foreign` (`product_id`);

--
-- Indexes for table `tbl_subscribers`
--
ALTER TABLE `tbl_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tags`
--
ALTER TABLE `tbl_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaction_overviews`
--
ALTER TABLE `tbl_transaction_overviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_update_orders`
--
ALTER TABLE `tbl_update_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_update_payments`
--
ALTER TABLE `tbl_update_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wishlists`
--
ALTER TABLE `tbl_wishlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_writers`
--
ALTER TABLE `tbl_writers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content_product`
--
ALTER TABLE `content_product`
  MODIFY `content_product_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery_service_areas`
--
ALTER TABLE `delivery_service_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_service_area_districts`
--
ALTER TABLE `delivery_service_area_districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flash_sales`
--
ALTER TABLE `flash_sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `news_news_category`
--
ALTER TABLE `news_news_category`
  MODIFY `news_news_category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_tag`
--
ALTER TABLE `news_tag`
  MODIFY `news_tag_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news_writer`
--
ALTER TABLE `news_writer`
  MODIFY `news_writer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_delivery_staff`
--
ALTER TABLE `order_delivery_staff`
  MODIFY `order_delivery_staff_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_staff_seller`
--
ALTER TABLE `product_staff_seller`
  MODIFY `product_staff_seller_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_advertisements`
--
ALTER TABLE `tbl_advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_affiliates`
--
ALTER TABLE `tbl_affiliates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_affiliate_return_transaction_overviews`
--
ALTER TABLE `tbl_affiliate_return_transaction_overviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_affiliate_statements`
--
ALTER TABLE `tbl_affiliate_statements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_affiliate_transaction_overviews`
--
ALTER TABLE `tbl_affiliate_transaction_overviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_brands`
--
ALTER TABLE `tbl_brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_contacts`
--
ALTER TABLE `tbl_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_contents`
--
ALTER TABLE `tbl_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_coupon`
--
ALTER TABLE `tbl_coupon`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_deliveries`
--
ALTER TABLE `tbl_deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_deliveries_assign`
--
ALTER TABLE `tbl_deliveries_assign`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_delivery_delivery_settings`
--
ALTER TABLE `tbl_delivery_delivery_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_delivery_settings`
--
ALTER TABLE `tbl_delivery_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_favourites`
--
ALTER TABLE `tbl_favourites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_imesettings`
--
ALTER TABLE `tbl_imesettings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_measures`
--
ALTER TABLE `tbl_measures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_news_categories`
--
ALTER TABLE `tbl_news_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tbl_order_cancels`
--
ALTER TABLE `tbl_order_cancels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_photos`
--
ALTER TABLE `tbl_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=979;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `tbl_push_notifications`
--
ALTER TABLE `tbl_push_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_referrals`
--
ALTER TABLE `tbl_referrals`
  MODIFY `ref_customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_return_transaction_overviews`
--
ALTER TABLE `tbl_return_transaction_overviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sales_returns`
--
ALTER TABLE `tbl_sales_returns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sellers`
--
ALTER TABLE `tbl_sellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_seller_add_productnotifications`
--
ALTER TABLE `tbl_seller_add_productnotifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_sliders`
--
ALTER TABLE `tbl_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_statements`
--
ALTER TABLE `tbl_statements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_stocks`
--
ALTER TABLE `tbl_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `tbl_subscribers`
--
ALTER TABLE `tbl_subscribers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_tags`
--
ALTER TABLE `tbl_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_transaction_overviews`
--
ALTER TABLE `tbl_transaction_overviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_update_orders`
--
ALTER TABLE `tbl_update_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_update_payments`
--
ALTER TABLE `tbl_update_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_wishlists`
--
ALTER TABLE `tbl_wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_writers`
--
ALTER TABLE `tbl_writers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  ADD CONSTRAINT `coupon_usages_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `tbl_customers` (`id`);

--
-- Constraints for table `delivery_service_area_districts`
--
ALTER TABLE `delivery_service_area_districts`
  ADD CONSTRAINT `delivery_service_area_districts_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `districts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `delivery_service_area_districts_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `flash_sales`
--
ALTER TABLE `flash_sales`
  ADD CONSTRAINT `flash_sales_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `tbl_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_seller_add_productnotifications`
--
ALTER TABLE `tbl_seller_add_productnotifications`
  ADD CONSTRAINT `tbl_seller_add_productnotifications_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_stocks`
--
ALTER TABLE `tbl_stocks`
  ADD CONSTRAINT `tbl_stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
