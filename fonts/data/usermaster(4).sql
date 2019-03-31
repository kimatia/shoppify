-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 25, 2017 at 01:47 PM
-- Server version: 5.7.18
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usermaster`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advantages`
--

CREATE TABLE `tbl_advantages` (
  `id` int(11) NOT NULL,
  `userTitleOne` varchar(255) NOT NULL,
  `userContentOne` varchar(255) NOT NULL,
  `userTitleTwo` varchar(255) NOT NULL,
  `userContentTwo` varchar(255) NOT NULL,
  `userTitleThree` varchar(255) NOT NULL,
  `userContentThree` varchar(255) NOT NULL,
  `userTitleFour` varchar(255) NOT NULL,
  `userContentFour` varchar(255) NOT NULL,
  `userTitleFive` varchar(255) NOT NULL,
  `userContentFive` varchar(255) NOT NULL,
  `userTitleSix` varchar(255) NOT NULL,
  `userContentSix` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_call`
--

CREATE TABLE `tbl_call` (
  `id` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userPhone` int(255) NOT NULL,
  `sendtime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `sendtime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_directors`
--

CREATE TABLE `tbl_directors` (
  `userID` int(10) NOT NULL,
  `userName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `userTittle` varchar(20) CHARACTER SET utf8 NOT NULL,
  `userContent` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `readMore` varchar(10000) CHARACTER SET utf8 NOT NULL,
  `overLay` varchar(255) CHARACTER SET utf8 NOT NULL,
  `userPic` varchar(255) CHARACTER SET utf8 NOT NULL,
  `postdate` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_financialadvisory`
--

CREATE TABLE `tbl_financialadvisory` (
  `id` int(11) NOT NULL,
  `userMail` varchar(255) NOT NULL,
  `userService` varchar(255) NOT NULL DEFAULT 'Financial Advisory',
  `status` varchar(11) NOT NULL DEFAULT '0',
  `sent` varchar(1000) NOT NULL DEFAULT '0',
  `subtime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_financialadvisory`
--

INSERT INTO `tbl_financialadvisory` (`id`, `userMail`, `userService`, `status`, `sent`, `subtime`) VALUES
(0, 'joshua3@yahoo.com', 'Financial Advisory', '1', '0', '2017-10-07 21:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_financialarticles`
--

CREATE TABLE `tbl_financialarticles` (
  `userID` int(10) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userTittle` varchar(20) NOT NULL,
  `userContent` varchar(255) NOT NULL,
  `readMore` varchar(10000) NOT NULL,
  `overLay` varchar(255) NOT NULL,
  `articleType` varchar(255) NOT NULL DEFAULT 'Financial ',
  `userPic` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_financialcontent`
--

CREATE TABLE `tbl_financialcontent` (
  `id` int(11) NOT NULL,
  `userContent` varchar(1000) NOT NULL,
  `userContentMore` varchar(20000) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_financialview`
--

CREATE TABLE `tbl_financialview` (
  `id` int(11) NOT NULL,
  `userTitleOne` varchar(255) NOT NULL,
  `userContentOne` varchar(255) NOT NULL,
  `userTitleTwo` varchar(255) NOT NULL,
  `userContentTwo` varchar(255) NOT NULL,
  `userTitleThree` varchar(255) NOT NULL,
  `userContentThree` varchar(255) NOT NULL,
  `userTitleFour` varchar(255) NOT NULL,
  `userContentFour` varchar(255) NOT NULL,
  `userTitleFive` varchar(255) NOT NULL,
  `userContentFive` varchar(255) NOT NULL,
  `userTitleSix` varchar(255) NOT NULL,
  `userContentSix` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_legaladvisory`
--

CREATE TABLE `tbl_legaladvisory` (
  `id` int(11) NOT NULL,
  `userMail` varchar(255) NOT NULL,
  `userService` varchar(255) NOT NULL DEFAULT 'Legal Advisory',
  `status` varchar(11) NOT NULL DEFAULT '0',
  `sent` varchar(1000) NOT NULL DEFAULT '0',
  `subtime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_legaladvisory`
--

INSERT INTO `tbl_legaladvisory` (`id`, `userMail`, `userService`, `status`, `sent`, `subtime`) VALUES
(0, 'janja@gmail.com', 'Legal Advisory', '1', '0', '2017-10-07 21:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_legalarticles`
--

CREATE TABLE `tbl_legalarticles` (
  `userID` int(10) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userTittle` varchar(20) NOT NULL,
  `userContent` varchar(255) NOT NULL,
  `readMore` varchar(10000) NOT NULL,
  `overLay` varchar(255) NOT NULL,
  `articleType` varchar(255) NOT NULL DEFAULT 'Legal ',
  `userPic` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_legalcontent`
--

CREATE TABLE `tbl_legalcontent` (
  `id` int(11) NOT NULL,
  `userContent` varchar(1000) NOT NULL,
  `userContentMore` varchar(20000) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_legalview`
--

CREATE TABLE `tbl_legalview` (
  `id` int(11) NOT NULL,
  `userTitleOne` varchar(255) NOT NULL,
  `userContentOne` varchar(255) NOT NULL,
  `userTitleTwo` varchar(255) NOT NULL,
  `userContentTwo` varchar(255) NOT NULL,
  `userTitleThree` varchar(255) NOT NULL,
  `userContentThree` varchar(255) NOT NULL,
  `userTitleFour` varchar(255) NOT NULL,
  `userContentFour` varchar(255) NOT NULL,
  `userTitleFive` varchar(255) NOT NULL,
  `userContentFive` varchar(255) NOT NULL,
  `userTitleSix` varchar(255) NOT NULL,
  `userContentSix` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mailinterval`
--

CREATE TABLE `tbl_mailinterval` (
  `id` int(11) NOT NULL,
  `userMail` varchar(255) NOT NULL,
  `subtime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_mailinterval`
--

INSERT INTO `tbl_mailinterval` (`id`, `userMail`, `subtime`) VALUES
(0, 'kimatiajoshua@gmail.com', '2017-11-18 08:06:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projectarticles`
--

CREATE TABLE `tbl_projectarticles` (
  `userID` int(10) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userTittle` varchar(20) NOT NULL,
  `userContent` varchar(255) NOT NULL,
  `readMore` varchar(10000) NOT NULL,
  `overLay` varchar(255) NOT NULL,
  `articleType` varchar(255) NOT NULL DEFAULT 'Project ',
  `userPic` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projectcontent`
--

CREATE TABLE `tbl_projectcontent` (
  `id` int(11) NOT NULL,
  `userContent` varchar(1000) NOT NULL,
  `userContentMore` varchar(20000) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projectmanagement`
--

CREATE TABLE `tbl_projectmanagement` (
  `id` int(11) NOT NULL,
  `userMail` varchar(255) NOT NULL,
  `userService` varchar(255) NOT NULL DEFAULT 'Project Management',
  `status` varchar(11) NOT NULL DEFAULT '0',
  `sent` varchar(1000) NOT NULL DEFAULT '0',
  `subtime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_projectmanagement`
--

INSERT INTO `tbl_projectmanagement` (`id`, `userMail`, `userService`, `status`, `sent`, `subtime`) VALUES
(0, 'oop@gmail.com', 'Project Management', '1', '0', '2017-10-08 09:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_projectview`
--

CREATE TABLE `tbl_projectview` (
  `id` int(11) NOT NULL,
  `userTitleOne` varchar(255) NOT NULL,
  `userContentOne` varchar(255) NOT NULL,
  `userTitleTwo` varchar(255) NOT NULL,
  `userContentTwo` varchar(255) NOT NULL,
  `userTitleThree` varchar(255) NOT NULL,
  `userContentThree` varchar(255) NOT NULL,
  `userTitleFour` varchar(255) NOT NULL,
  `userContentFour` varchar(255) NOT NULL,
  `userTitleFive` varchar(255) NOT NULL,
  `userContentFive` varchar(255) NOT NULL,
  `userTitleSix` varchar(255) NOT NULL,
  `userContentSix` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_researchanddevelopment`
--

CREATE TABLE `tbl_researchanddevelopment` (
  `id` int(11) NOT NULL,
  `userMail` varchar(255) NOT NULL,
  `userService` varchar(255) NOT NULL DEFAULT 'Research and Development',
  `status` varchar(11) NOT NULL DEFAULT '0',
  `sent` varchar(1000) NOT NULL DEFAULT '0',
  `subtime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_researchanddevelopment`
--

INSERT INTO `tbl_researchanddevelopment` (`id`, `userMail`, `userService`, `status`, `sent`, `subtime`) VALUES
(0, 'kenny@gmail.com', 'Research and Development', '1', '0', '2017-10-08 13:53:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_researcharticles`
--

CREATE TABLE `tbl_researcharticles` (
  `userID` int(10) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userTittle` varchar(20) NOT NULL,
  `userContent` varchar(255) NOT NULL,
  `readMore` varchar(10000) NOT NULL,
  `overLay` varchar(255) NOT NULL,
  `articleType` varchar(255) NOT NULL DEFAULT 'Research ',
  `userPic` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_researchcontent`
--

CREATE TABLE `tbl_researchcontent` (
  `id` int(11) NOT NULL,
  `userContent` varchar(1000) NOT NULL,
  `userContentMore` varchar(20000) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_researchview`
--

CREATE TABLE `tbl_researchview` (
  `id` int(11) NOT NULL,
  `userTitleOne` varchar(255) NOT NULL,
  `userContentOne` varchar(255) NOT NULL,
  `userTitleTwo` varchar(255) NOT NULL,
  `userContentTwo` varchar(255) NOT NULL,
  `userTitleThree` varchar(255) NOT NULL,
  `userContentThree` varchar(255) NOT NULL,
  `userTitleFour` varchar(255) NOT NULL,
  `userContentFour` varchar(255) NOT NULL,
  `userTitleFive` varchar(255) NOT NULL,
  `userContentFive` varchar(255) NOT NULL,
  `userTitleSix` varchar(255) NOT NULL,
  `userContentSix` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_riskarticles`
--

CREATE TABLE `tbl_riskarticles` (
  `userID` int(10) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userTittle` varchar(20) NOT NULL,
  `userContent` varchar(255) NOT NULL,
  `readMore` varchar(10000) NOT NULL,
  `overLay` varchar(255) NOT NULL,
  `articleType` varchar(255) NOT NULL DEFAULT 'Risk ',
  `userPic` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_riskcontent`
--

CREATE TABLE `tbl_riskcontent` (
  `id` int(11) NOT NULL,
  `userContent` varchar(1000) NOT NULL,
  `userContentMore` varchar(1000) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_riskmanagement`
--

CREATE TABLE `tbl_riskmanagement` (
  `id` int(11) NOT NULL,
  `userMail` varchar(255) NOT NULL,
  `userService` varchar(255) NOT NULL DEFAULT 'Risk Management',
  `status` varchar(11) NOT NULL DEFAULT '0',
  `sent` varchar(1000) NOT NULL DEFAULT '0',
  `subtime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_riskmanagement`
--

INSERT INTO `tbl_riskmanagement` (`id`, `userMail`, `userService`, `status`, `sent`, `subtime`) VALUES
(0, 'janja@gmail.com', 'Risk Management', '1', '0', '2017-10-07 15:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_riskview`
--

CREATE TABLE `tbl_riskview` (
  `id` int(11) NOT NULL,
  `userTitleOne` varchar(255) NOT NULL,
  `userContentOne` varchar(255) NOT NULL,
  `userTitleTwo` varchar(255) NOT NULL,
  `userContentTwo` varchar(255) NOT NULL,
  `userTitleThree` varchar(255) NOT NULL,
  `userContentThree` varchar(255) NOT NULL,
  `userTitleFour` varchar(255) NOT NULL,
  `userContentFour` varchar(255) NOT NULL,
  `userTitleFive` varchar(255) NOT NULL,
  `userContentFive` varchar(255) NOT NULL,
  `userTitleSix` varchar(255) NOT NULL,
  `userContentSix` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_strategyadvisory`
--

CREATE TABLE `tbl_strategyadvisory` (
  `id` int(11) NOT NULL,
  `userMail` varchar(255) NOT NULL,
  `userService` varchar(255) NOT NULL DEFAULT 'Strategy Advisory',
  `status` varchar(11) NOT NULL DEFAULT '0',
  `sent` varchar(1000) NOT NULL DEFAULT '0',
  `subtime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_strategyadvisory`
--

INSERT INTO `tbl_strategyadvisory` (`id`, `userMail`, `userService`, `status`, `sent`, `subtime`) VALUES
(0, 'nama@gmail.com', 'Strategy Advisory', '1', '0', '2017-10-07 21:43:21'),
(1, 'kimatiadaniel@gmail.com', 'Strategy Advisory', '1', '1', '2017-11-25 22:52:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_strategyarticles`
--

CREATE TABLE `tbl_strategyarticles` (
  `userID` int(10) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userTittle` varchar(20) NOT NULL,
  `userContent` varchar(255) NOT NULL,
  `readMore` varchar(10000) NOT NULL,
  `overLay` varchar(255) NOT NULL,
  `articleType` varchar(255) NOT NULL DEFAULT 'Strategy ',
  `userPic` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_strategycontent`
--

CREATE TABLE `tbl_strategycontent` (
  `id` int(11) NOT NULL,
  `userContent` varchar(1000) NOT NULL,
  `userContentMore` varchar(20000) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_strategyview`
--

CREATE TABLE `tbl_strategyview` (
  `id` int(11) NOT NULL,
  `userTitleOne` varchar(255) NOT NULL,
  `userContentOne` varchar(255) NOT NULL,
  `userTitleTwo` varchar(255) NOT NULL,
  `userContentTwo` varchar(255) NOT NULL,
  `userTitleThree` varchar(255) NOT NULL,
  `userContentThree` varchar(255) NOT NULL,
  `userTitleFour` varchar(255) NOT NULL,
  `userContentFour` varchar(255) NOT NULL,
  `userTitleFive` varchar(255) NOT NULL,
  `userContentFive` varchar(255) NOT NULL,
  `userTitleSix` varchar(255) NOT NULL,
  `userContentSix` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teamfive`
--

CREATE TABLE `tbl_teamfive` (
  `userID` int(10) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userContent` varchar(255) NOT NULL,
  `readMore` varchar(10000) NOT NULL,
  `userPic` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teamfour`
--

CREATE TABLE `tbl_teamfour` (
  `userID` int(10) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userContent` varchar(255) NOT NULL,
  `readMore` varchar(10000) NOT NULL,
  `userPic` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teamone`
--

CREATE TABLE `tbl_teamone` (
  `userID` int(10) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userContent` varchar(255) NOT NULL,
  `readMore` varchar(10000) NOT NULL,
  `userPic` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teamsix`
--

CREATE TABLE `tbl_teamsix` (
  `userID` int(10) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userContent` varchar(255) NOT NULL,
  `readMore` varchar(10000) NOT NULL,
  `userPic` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teamthree`
--

CREATE TABLE `tbl_teamthree` (
  `userID` int(10) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userContent` varchar(255) NOT NULL,
  `readMore` varchar(10000) NOT NULL,
  `userPic` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teamtwo`
--

CREATE TABLE `tbl_teamtwo` (
  `userID` int(10) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userContent` varchar(255) NOT NULL,
  `readMore` varchar(10000) NOT NULL,
  `userPic` varchar(255) NOT NULL,
  `postdate` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userID` int(10) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userPhone` varchar(20) NOT NULL,
  `nationalId` varchar(100) DEFAULT NULL,
  `loginType` varchar(100) DEFAULT 'user',
  `superType` varchar(255) NOT NULL DEFAULT 'useradmin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userID`, `userName`, `userEmail`, `userPass`, `userPhone`, `nationalId`, `loginType`, `superType`) VALUES
(0, 'kimatia', 'kimatiadaniel@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234567', '234567', 'admin', 'superadmin'),
(1, 'joshua', 'joshua@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '12345678', '2456', 'worker', 'useradmin'),
(4, 'steve', 'steve@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'w345', 'ert', 'admin', 'useradmin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_advantages`
--
ALTER TABLE `tbl_advantages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_call`
--
ALTER TABLE `tbl_call`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_directors`
--
ALTER TABLE `tbl_directors`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tbl_financialadvisory`
--
ALTER TABLE `tbl_financialadvisory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_financialarticles`
--
ALTER TABLE `tbl_financialarticles`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tbl_financialcontent`
--
ALTER TABLE `tbl_financialcontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_financialview`
--
ALTER TABLE `tbl_financialview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_legaladvisory`
--
ALTER TABLE `tbl_legaladvisory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_legalarticles`
--
ALTER TABLE `tbl_legalarticles`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tbl_legalcontent`
--
ALTER TABLE `tbl_legalcontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_legalview`
--
ALTER TABLE `tbl_legalview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_mailinterval`
--
ALTER TABLE `tbl_mailinterval`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_projectarticles`
--
ALTER TABLE `tbl_projectarticles`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tbl_projectcontent`
--
ALTER TABLE `tbl_projectcontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_projectmanagement`
--
ALTER TABLE `tbl_projectmanagement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_projectview`
--
ALTER TABLE `tbl_projectview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_researchanddevelopment`
--
ALTER TABLE `tbl_researchanddevelopment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_researcharticles`
--
ALTER TABLE `tbl_researcharticles`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tbl_researchcontent`
--
ALTER TABLE `tbl_researchcontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_researchview`
--
ALTER TABLE `tbl_researchview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_riskarticles`
--
ALTER TABLE `tbl_riskarticles`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tbl_riskcontent`
--
ALTER TABLE `tbl_riskcontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_riskmanagement`
--
ALTER TABLE `tbl_riskmanagement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_riskview`
--
ALTER TABLE `tbl_riskview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_strategyadvisory`
--
ALTER TABLE `tbl_strategyadvisory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_strategyarticles`
--
ALTER TABLE `tbl_strategyarticles`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tbl_strategycontent`
--
ALTER TABLE `tbl_strategycontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_strategyview`
--
ALTER TABLE `tbl_strategyview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_teamfive`
--
ALTER TABLE `tbl_teamfive`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tbl_teamfour`
--
ALTER TABLE `tbl_teamfour`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tbl_teamone`
--
ALTER TABLE `tbl_teamone`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tbl_teamsix`
--
ALTER TABLE `tbl_teamsix`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tbl_teamthree`
--
ALTER TABLE `tbl_teamthree`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tbl_teamtwo`
--
ALTER TABLE `tbl_teamtwo`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`),
  ADD UNIQUE KEY `nationalId` (`nationalId`),
  ADD KEY `userName` (`userName`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_advantages`
--
ALTER TABLE `tbl_advantages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_call`
--
ALTER TABLE `tbl_call`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_directors`
--
ALTER TABLE `tbl_directors`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `tbl_financialadvisory`
--
ALTER TABLE `tbl_financialadvisory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_financialarticles`
--
ALTER TABLE `tbl_financialarticles`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `tbl_financialcontent`
--
ALTER TABLE `tbl_financialcontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_financialview`
--
ALTER TABLE `tbl_financialview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_legaladvisory`
--
ALTER TABLE `tbl_legaladvisory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_legalarticles`
--
ALTER TABLE `tbl_legalarticles`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `tbl_legalcontent`
--
ALTER TABLE `tbl_legalcontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_legalview`
--
ALTER TABLE `tbl_legalview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_mailinterval`
--
ALTER TABLE `tbl_mailinterval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_projectarticles`
--
ALTER TABLE `tbl_projectarticles`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `tbl_projectcontent`
--
ALTER TABLE `tbl_projectcontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_projectmanagement`
--
ALTER TABLE `tbl_projectmanagement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_projectview`
--
ALTER TABLE `tbl_projectview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_researchanddevelopment`
--
ALTER TABLE `tbl_researchanddevelopment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_researcharticles`
--
ALTER TABLE `tbl_researcharticles`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `tbl_researchcontent`
--
ALTER TABLE `tbl_researchcontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_researchview`
--
ALTER TABLE `tbl_researchview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_riskarticles`
--
ALTER TABLE `tbl_riskarticles`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `tbl_riskcontent`
--
ALTER TABLE `tbl_riskcontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_riskmanagement`
--
ALTER TABLE `tbl_riskmanagement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_riskview`
--
ALTER TABLE `tbl_riskview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_strategyadvisory`
--
ALTER TABLE `tbl_strategyadvisory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_strategyarticles`
--
ALTER TABLE `tbl_strategyarticles`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `tbl_strategycontent`
--
ALTER TABLE `tbl_strategycontent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_strategyview`
--
ALTER TABLE `tbl_strategyview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_teamfive`
--
ALTER TABLE `tbl_teamfive`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `tbl_teamfour`
--
ALTER TABLE `tbl_teamfour`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `tbl_teamone`
--
ALTER TABLE `tbl_teamone`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `tbl_teamsix`
--
ALTER TABLE `tbl_teamsix`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `tbl_teamthree`
--
ALTER TABLE `tbl_teamthree`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `tbl_teamtwo`
--
ALTER TABLE `tbl_teamtwo`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
