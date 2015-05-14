-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 14, 2015 at 09:05 PM
-- Server version: 5.6.24-0ubuntu2
-- PHP Version: 5.6.7-1+deb.sury.org~utopic+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cake_blog`
--
CREATE DATABASE IF NOT EXISTS `cake_blog` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `cake_blog`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--
-- Creation: Apr 28, 2015 at 01:46 PM
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(10) NOT NULL DEFAULT '1',
  `path` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `categories`
--

TRUNCATE TABLE `categories`;
--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `path`, `created_at`, `updated_at`) VALUES
(1, 'Uncategorized', 'uncategorized', 0, '1', '2015-04-18 09:18:00', '2015-04-18 09:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--
-- Creation: Apr 28, 2015 at 01:46 PM
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
`id` int(10) unsigned NOT NULL,
  `body` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `post_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `path` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `status` int(10) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `comments`:
--   `post_id`
--       `posts` -> `id`
--   `user_id`
--       `users` -> `id`
--

--
-- Truncate table before insert `comments`
--

TRUNCATE TABLE `comments`;
--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `body`, `user_id`, `post_id`, `parent_id`, `path`, `status`, `created_at`, `updated_at`) VALUES
(1, 'This is the first comment!', 1, 1, 0, '1', 3, '2015-04-18 09:18:00', '2015-04-18 09:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--
-- Creation: May 14, 2015 at 08:55 AM
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `relative_path` text COLLATE utf8_unicode_ci,
  `media_type` int(10) NOT NULL DEFAULT '1',
  `mime_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `media`:
--   `user_id`
--       `users` -> `id`
--

--
-- Truncate table before insert `media`
--

TRUNCATE TABLE `media`;
--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `user_id`, `title`, `slug`, `description`, `file_name`, `relative_path`, `media_type`, `mime_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Nature Image 001', 'nature-image-001', '{"title":"Nature Image 001","file_name":"nature-image-001-2015-05-14-w2048-h1289-bec9bd0cf23ffd38c494f15122e64a47.jpg","mime_type":"image\\/jpeg","relative_path":"upload\\/2015\\/05\\/14\\/nature-image-001-2015-05-14-w2048-h1289-bec9bd0cf23ffd38c494f15122e64a47.jpg","url":"http:\\/\\/cakephp.dev\\/upload\\/2015\\/05\\/14\\/nature-image-001-2015-05-14-w2048-h1289-bec9bd0cf23ffd38c494f15122e64a47.jpg","description":"Nature Image 001"}', 'nature-image-001-2015-05-14-w2048-h1289-bec9bd0cf23ffd38c494f15122e64a47.jpg', 'upload/2015/05/14/nature-image-001-2015-05-14-w2048-h1289-bec9bd0cf23ffd38c494f15122e64a47.jpg', 1, 'image/jpeg', 1, '2015-05-14 16:43:48', '2015-05-14 16:43:48'),
(2, 3, 'Sun Star', 'sun-star', '{"title":"Sun Star","file_name":"sun-star-2015-05-14-w2048-h1367-596d6220e9033a646f001edd2539a6f2.jpg","mime_type":"image\\/jpeg","relative_path":"upload\\/2015\\/05\\/14\\/sun-star-2015-05-14-w2048-h1367-596d6220e9033a646f001edd2539a6f2.jpg","url":"http:\\/\\/cakephp.dev\\/upload\\/2015\\/05\\/14\\/sun-star-2015-05-14-w2048-h1367-596d6220e9033a646f001edd2539a6f2.jpg","description":"Sun star"}', 'sun-star-2015-05-14-w2048-h1367-596d6220e9033a646f001edd2539a6f2.jpg', 'upload/2015/05/14/sun-star-2015-05-14-w2048-h1367-596d6220e9033a646f001edd2539a6f2.jpg', 1, 'image/jpeg', 1, '2015-05-14 16:45:41', '2015-05-14 16:45:41'),
(3, 3, 'Cloudy day', 'cloudy-day', '{"title":"Cloudy day","file_name":"cloudy-day-2015-05-14-w2048-h1519-1aa5f1cd75d4621a95b2395d62f0e7e2.jpg","mime_type":"image\\/jpeg","relative_path":"upload\\/2015\\/05\\/14\\/cloudy-day-2015-05-14-w2048-h1519-1aa5f1cd75d4621a95b2395d62f0e7e2.jpg","url":"http:\\/\\/cakephp.dev\\/upload\\/2015\\/05\\/14\\/cloudy-day-2015-05-14-w2048-h1519-1aa5f1cd75d4621a95b2395d62f0e7e2.jpg","description":"Cloudy day"}', 'cloudy-day-2015-05-14-w2048-h1519-1aa5f1cd75d4621a95b2395d62f0e7e2.jpg', 'upload/2015/05/14/cloudy-day-2015-05-14-w2048-h1519-1aa5f1cd75d4621a95b2395d62f0e7e2.jpg', 1, 'image/jpeg', 1, '2015-05-14 16:48:52', '2015-05-14 16:48:52'),
(4, 3, 'Daisy', 'daisy', '{"title":"Daisy","file_name":"daisy-2015-05-14-w1600-h900-831b11b9cba3d86126af854dc986b818.jpg","mime_type":"image\\/jpeg","relative_path":"upload\\/2015\\/05\\/14\\/daisy-2015-05-14-w1600-h900-831b11b9cba3d86126af854dc986b818.jpg","url":"http:\\/\\/cakephp.dev\\/upload\\/2015\\/05\\/14\\/daisy-2015-05-14-w1600-h900-831b11b9cba3d86126af854dc986b818.jpg","description":"Daisy"}', 'daisy-2015-05-14-w1600-h900-831b11b9cba3d86126af854dc986b818.jpg', 'upload/2015/05/14/daisy-2015-05-14-w1600-h900-831b11b9cba3d86126af854dc986b818.jpg', 1, 'image/jpeg', 1, '2015-05-14 17:29:26', '2015-05-14 17:29:26'),
(5, 3, 'Crafty colorful circle', 'crafty-colorful-circle', '{"title":"Crafty colorful circle","file_name":"crafty-colorful-circle-2015-05-14-w2048-h1201-19c30d1402cf1696fd8c4991c7de0b14.jpg","mime_type":"image\\/jpeg","relative_path":"upload\\/2015\\/05\\/14\\/crafty-colorful-circle-2015-05-14-w2048-h1201-19c30d1402cf1696fd8c4991c7de0b14.jpg","url":"http:\\/\\/cakephp.dev\\/upload\\/2015\\/05\\/14\\/crafty-colorful-circle-2015-05-14-w2048-h1201-19c30d1402cf1696fd8c4991c7de0b14.jpg","description":"Crafty colorful circle"}', 'crafty-colorful-circle-2015-05-14-w2048-h1201-19c30d1402cf1696fd8c4991c7de0b14.jpg', 'upload/2015/05/14/crafty-colorful-circle-2015-05-14-w2048-h1201-19c30d1402cf1696fd8c4991c7de0b14.jpg', 1, 'image/jpeg', 1, '2015-05-14 17:25:19', '2015-05-14 17:25:19'),
(6, 3, 'Crystal camera', 'crystal-camera', '{"title":"Crystal camera","file_name":"crystal-camera-2015-05-14-w1600-h1063-cc22903a22717cc94b5ec6ba63ceaaf5.jpg","mime_type":"image\\/jpeg","relative_path":"upload\\/2015\\/05\\/14\\/crystal-camera-2015-05-14-w1600-h1063-cc22903a22717cc94b5ec6ba63ceaaf5.jpg","url":"http:\\/\\/cakephp.dev\\/upload\\/2015\\/05\\/14\\/crystal-camera-2015-05-14-w1600-h1063-cc22903a22717cc94b5ec6ba63ceaaf5.jpg","description":"Crystal camera"}', 'crystal-camera-2015-05-14-w1600-h1063-cc22903a22717cc94b5ec6ba63ceaaf5.jpg', 'upload/2015/05/14/crystal-camera-2015-05-14-w1600-h1063-cc22903a22717cc94b5ec6ba63ceaaf5.jpg', 1, 'image/jpeg', 1, '2015-05-14 17:28:32', '2015-05-14 17:28:32'),
(8, 3, 'Acaster Malbis', 'acaster-malbis', '{"title":"Acaster Malbis","file_name":"acaster-malbis-2015-05-14-w2048-h1366-90a357a609c51ed7da97139e628a6a3f.jpg","mime_type":"image\\/jpeg","relative_path":"upload\\/2015\\/05\\/14\\/acaster-malbis-2015-05-14-w2048-h1366-90a357a609c51ed7da97139e628a6a3f.jpg","url":"http:\\/\\/cakephp.dev\\/upload\\/2015\\/05\\/14\\/acaster-malbis-2015-05-14-w2048-h1366-90a357a609c51ed7da97139e628a6a3f.jpg","description":"Acaster Malbis"}', 'acaster-malbis-2015-05-14-w2048-h1366-90a357a609c51ed7da97139e628a6a3f.jpg', 'upload/2015/05/14/acaster-malbis-2015-05-14-w2048-h1366-90a357a609c51ed7da97139e628a6a3f.jpg', 1, 'image/jpeg', 1, '2015-05-14 19:23:07', '2015-05-14 19:23:07'),
(9, 3, 'Tiger', 'tiger', '{"title":"Tiger","file_name":"tiger-2015-05-14-w2048-h1367-8403bc1f13e65635e52b9aaf60cb732d.jpg","mime_type":"image\\/jpeg","relative_path":"upload\\/2015\\/05\\/14\\/tiger-2015-05-14-w2048-h1367-8403bc1f13e65635e52b9aaf60cb732d.jpg","url":"http:\\/\\/cakephp.dev\\/upload\\/2015\\/05\\/14\\/tiger-2015-05-14-w2048-h1367-8403bc1f13e65635e52b9aaf60cb732d.jpg","description":"Tiger"}', 'tiger-2015-05-14-w2048-h1367-8403bc1f13e65635e52b9aaf60cb732d.jpg', 'upload/2015/05/14/tiger-2015-05-14-w2048-h1367-8403bc1f13e65635e52b9aaf60cb732d.jpg', 1, 'image/jpeg', 1, '2015-05-14 19:24:31', '2015-05-14 19:24:31'),
(10, 3, 'Smile', 'smile', '{"title":"Smile","file_name":"smile-2015-05-14-w2048-h1365-37b7a8fb3c50cf21dcf67bc9623b76a6.jpg","mime_type":"image\\/jpeg","relative_path":"upload\\/2015\\/05\\/14\\/smile-2015-05-14-w2048-h1365-37b7a8fb3c50cf21dcf67bc9623b76a6.jpg","url":"http:\\/\\/cakephp.dev\\/upload\\/2015\\/05\\/14\\/smile-2015-05-14-w2048-h1365-37b7a8fb3c50cf21dcf67bc9623b76a6.jpg","description":"Smile"}', 'smile-2015-05-14-w2048-h1365-37b7a8fb3c50cf21dcf67bc9623b76a6.jpg', 'upload/2015/05/14/smile-2015-05-14-w2048-h1365-37b7a8fb3c50cf21dcf67bc9623b76a6.jpg', 1, 'image/jpeg', 1, '2015-05-14 19:25:53', '2015-05-14 19:25:53'),
(11, 3, 'Biker in morning sunrays', 'biker-in-morning-sunrays', '{"title":"Biker in morning sunrays","file_name":"biker-in-morning-sunrays-2015-05-14-w1600-h1066-3d2a2d08513fda7b648cb6c20a765a12.jpg","mime_type":"image\\/jpeg","relative_path":"upload\\/2015\\/05\\/14\\/biker-in-morning-sunrays-2015-05-14-w1600-h1066-3d2a2d08513fda7b648cb6c20a765a12.jpg","url":"http:\\/\\/cakephp.dev\\/upload\\/2015\\/05\\/14\\/biker-in-morning-sunrays-2015-05-14-w1600-h1066-3d2a2d08513fda7b648cb6c20a765a12.jpg","description":"Biker in morning sunrays"}', 'biker-in-morning-sunrays-2015-05-14-w1600-h1066-3d2a2d08513fda7b648cb6c20a765a12.jpg', 'upload/2015/05/14/biker-in-morning-sunrays-2015-05-14-w1600-h1066-3d2a2d08513fda7b648cb6c20a765a12.jpg', 1, 'image/jpeg', 1, '2015-05-14 19:28:23', '2015-05-14 19:28:23');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--
-- Creation: Apr 28, 2015 at 01:46 PM
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
`id` int(10) unsigned NOT NULL,
  `controller` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `permissions`
--

TRUNCATE TABLE `permissions`;
--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `controller`, `action`, `type`, `created_at`, `updated_at`) VALUES
(1, '*', '*', '1', '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(2, 'users', '*', '1', '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(3, 'users', 'add', '0', '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(4, 'roles', '*', '0', '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(5, 'permissions', '*', '0', '2015-04-18 09:18:00', '2015-04-18 09:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--
-- Creation: Apr 28, 2015 at 01:46 PM
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
`id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `status` int(10) NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `posts`:
--   `user_id`
--       `users` -> `id`
--

--
-- Truncate table before insert `posts`
--

TRUNCATE TABLE `posts`;
--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `parent_id`, `user_id`, `title`, `slug`, `body`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Hello, world!', 'hello-world', '<p>This is the <u>first</u> post!</p>\r\n', 3, '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(2, 0, 3, 'Example draft post', 'example-draft-post', '<p>This is an example draft post.</p>\r\n', 0, '2015-05-07 02:32:21', '2015-05-08 09:34:30'),
(3, 0, 3, 'Lorem Ipsum', 'lorem-ipsum', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>\r\n', 0, '2015-05-07 02:43:50', '2015-05-08 09:40:37'),
(4, 0, 3, 'Hello world', 'hello-world-2', '<p>B&agrave;i viết để test chức năng tạo slug tự động cho b&agrave;i viết.</p>\r\n', 1, '2015-05-07 13:58:56', '2015-05-07 13:58:56'),
(5, 0, 3, 'Hello world', 'hello-world-3', '<p>B&agrave;i viết để <em>test</em> m&atilde; h&oacute;a phần <strong>nội dung</strong> của b&agrave;i đăng.</p>\r\n', 1, '2015-05-08 01:54:51', '2015-05-08 01:54:51'),
(6, 0, 3, 'Bài viết thử nghiệm', 'bai-viet-thu-nghiem', 'Kiểm tra chức năng đăng bản nháp nhanh.', 0, '2015-05-08 09:54:23', '2015-05-08 09:54:23');

-- --------------------------------------------------------

--
-- Table structure for table `posts_categories`
--
-- Creation: Apr 28, 2015 at 01:46 PM
--

DROP TABLE IF EXISTS `posts_categories`;
CREATE TABLE IF NOT EXISTS `posts_categories` (
  `post_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `posts_categories`:
--   `category_id`
--       `categories` -> `id`
--   `post_id`
--       `posts` -> `id`
--

--
-- Truncate table before insert `posts_categories`
--

TRUNCATE TABLE `posts_categories`;
--
-- Dumping data for table `posts_categories`
--

INSERT INTO `posts_categories` (`post_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(2, 1, '2015-05-08 02:34:30', '2015-05-08 02:34:30'),
(3, 1, '2015-05-08 02:40:37', '2015-05-08 02:40:37'),
(4, 1, '2015-05-07 13:58:56', '2015-05-07 13:58:56'),
(5, 1, '2015-05-08 01:54:51', '2015-05-08 01:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `posts_tags`
--
-- Creation: Apr 28, 2015 at 01:46 PM
--

DROP TABLE IF EXISTS `posts_tags`;
CREATE TABLE IF NOT EXISTS `posts_tags` (
  `post_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `posts_tags`:
--   `post_id`
--       `posts` -> `id`
--   `tag_id`
--       `tags` -> `id`
--

--
-- Truncate table before insert `posts_tags`
--

TRUNCATE TABLE `posts_tags`;
--
-- Dumping data for table `posts_tags`
--

INSERT INTO `posts_tags` (`post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(2, 1, '2015-05-08 02:34:30', '2015-05-08 02:34:30'),
(3, 1, '2015-05-08 02:40:37', '2015-05-08 02:40:37'),
(4, 1, '2015-05-07 13:58:56', '2015-05-07 13:58:56'),
(5, 1, '2015-05-08 01:54:51', '2015-05-08 01:54:51'),
(1, 2, '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(4, 2, '2015-05-07 13:58:56', '2015-05-07 13:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--
-- Creation: Apr 28, 2015 at 01:46 PM
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `roles`
--

TRUNCATE TABLE `roles`;
--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(2, 'Moderator', '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(3, 'User', '2015-04-18 09:18:00', '2015-04-18 09:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--
-- Creation: Apr 28, 2015 at 01:46 PM
--

DROP TABLE IF EXISTS `roles_permissions`;
CREATE TABLE IF NOT EXISTS `roles_permissions` (
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `roles_permissions`:
--   `permission_id`
--       `permissions` -> `id`
--   `role_id`
--       `roles` -> `id`
--

--
-- Truncate table before insert `roles_permissions`
--

TRUNCATE TABLE `roles_permissions`;
--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(3, 2, '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(3, 3, '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(3, 4, '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(3, 5, '2015-04-18 09:18:00', '2015-04-18 09:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--
-- Creation: Apr 28, 2015 at 01:46 PM
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `tags`
--

TRUNCATE TABLE `tags`;
--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'uncategorized', 'uncategorized', '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(2, 'blog', 'blog', '2015-04-18 09:18:00', '2015-04-18 09:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: May 01, 2015 at 10:09 AM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(72) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(10) unsigned NOT NULL DEFAULT '3',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `users`:
--   `role_id`
--       `roles` -> `id`
--

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `full_name`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@localhost', 'Administrator', '$2y$10$mAm8wAkoZvThj13ODxSlCuDtjgk9FEoUHjvRQG8jPipPLROgg2kd2', 1, '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(2, 'user', 'user@localhost.local', 'User', '$2y$10$3rAR4xLt/ql34vGpmHhkFejWAaBmyyH5q/w4x0yWK1VvmqHCn8mqy', 3, '2015-04-18 09:18:00', '2015-04-18 09:18:00'),
(3, 'ansidev', 'ansidev@gmail.com', 'Lê Minh Trí', '$2y$10$UP1iJOOHqcS.J1m6GR/I8OBnPwUdidg7CxBtxn4U9iSFj3ZTHnoIO', 3, '2015-05-06 10:29:16', '2015-05-06 10:29:16'),
(4, 'legoiv', 'legoiv@outlook.com', 'LegoIV', '$2y$10$Nw7Ax9d5ozntWlJ/UKUdWepqGOmRkm4Ne2M3nfDssmdz9iGKwQ1US', 3, '2015-05-10 23:30:14', '2015-05-10 23:30:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_UNIQUE` (`slug`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`), ADD KEY `user_key_idx` (`user_id`), ADD KEY `post_key_idx` (`post_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_UNIQUE` (`slug`), ADD KEY `md_user_key_idx` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug` (`slug`), ADD KEY `ps_user_key_idx` (`user_id`);

--
-- Indexes for table `posts_categories`
--
ALTER TABLE `posts_categories`
 ADD PRIMARY KEY (`post_id`,`category_id`), ADD KEY `category_idx` (`category_id`,`post_id`);

--
-- Indexes for table `posts_tags`
--
ALTER TABLE `posts_tags`
 ADD PRIMARY KEY (`tag_id`,`post_id`), ADD KEY `pt_post_key` (`post_id`), ADD KEY `tag_idx` (`tag_id`,`post_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
 ADD PRIMARY KEY (`role_id`,`permission_id`), ADD KEY `rp_permission_key_idx` (`permission_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `slug_UNIQUE` (`slug`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`,`email`), ADD KEY `us_role_key_idx` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `cm_post_key` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `cm_user_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
ADD CONSTRAINT `md_user_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
ADD CONSTRAINT `ps_user_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `posts_categories`
--
ALTER TABLE `posts_categories`
ADD CONSTRAINT `pc_category_key` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `pc_post_key` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `posts_tags`
--
ALTER TABLE `posts_tags`
ADD CONSTRAINT `pt_post_key` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `pt_tag_key` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
ADD CONSTRAINT `rp_permission_key` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `rp_role_key` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `us_role_key` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
