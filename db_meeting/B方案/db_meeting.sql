-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.8-MariaDB
-- PHP 版本： 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `db_meeting`
--

-- --------------------------------------------------------

--
-- 資料表結構 `meeting_content`
--

CREATE TABLE `meeting_content` (
  `date` date NOT NULL,
  `time` time(6) NOT NULL,
  `place` varchar(20) CHARACTER SET utf8 NOT NULL,
  `detail` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `meeting_info`
--

CREATE TABLE `meeting_info` (
  `date` date NOT NULL,
  `time` time(6) NOT NULL,
  `description` varchar(100) CHARACTER SET utf8 NOT NULL,
  `duration` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `student`
--

CREATE TABLE `student` (
  `ID` varchar(15) CHARACTER SET utf8 NOT NULL,
  `name` varchar(15) CHARACTER SET utf8 NOT NULL,
  `school` varchar(15) CHARACTER SET utf8 NOT NULL,
  `field` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `teacher`
--

CREATE TABLE `teacher` (
  `ID` varchar(15) CHARACTER SET utf8 NOT NULL,
  `name` varchar(15) CHARACTER SET utf8 NOT NULL,
  `school` varchar(20) CHARACTER SET utf8 NOT NULL,
  `field` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `meeting_content`
--
ALTER TABLE `meeting_content`
  ADD PRIMARY KEY (`date`,`time`),
  ADD KEY `date` (`date`,`time`);

--
-- 資料表索引 `meeting_info`
--
ALTER TABLE `meeting_info`
  ADD PRIMARY KEY (`date`,`time`);

--
-- 資料表索引 `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`);

--
-- 資料表索引 `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`ID`);

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `meeting_content`
--
ALTER TABLE `meeting_content`
  ADD CONSTRAINT `date_time_FK` FOREIGN KEY (`date`,`time`) REFERENCES `meeting_info` (`date`, `time`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
