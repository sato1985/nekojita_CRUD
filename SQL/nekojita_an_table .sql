-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-07-26 10:05:47
-- サーバのバージョン： 10.4.24-MariaDB
-- PHP のバージョン: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `nekojita`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `nekojita_an_table`
--

CREATE TABLE `nekojita_an_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SKU` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nayami1` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nayami2` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nayami3` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `nekojita_an_table`
--

INSERT INTO `nekojita_an_table` (`id`, `name`, `email`, `category`, `brand`, `SKU`, `nayami1`, `nayami2`, `nayami3`, `indate`) VALUES
(29, '佐藤', 'test@com', '2', '1', '', '食べてくれない', '抜け毛が多い', '腎臓ケア', '2022-06-24 14:09:29'),
(30, 'test2', 'test2@com', '2', '2', '', '食べてくれない', '抜け毛が多い', '腎臓ケア', '2022-06-24 14:09:46'),
(31, 'test2', 'satoshitanaka0430@gmail.com', '1', '2', '', '食べてくれない', '抜け毛が多い', '腎臓ケア', '2022-06-24 14:10:13'),
(32, '田中慧', 'a@com', '1', '1', '', '食べてくれない', '抜け毛が多い', '腎臓ケア', '2022-06-25 18:31:29');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `nekojita_an_table`
--
ALTER TABLE `nekojita_an_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `nekojita_an_table`
--
ALTER TABLE `nekojita_an_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
