-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2017 at 11:51 AM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gac`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `mainadmin`
--

CREATE TABLE IF NOT EXISTS `mainadmin` (
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mainadmin`
--

INSERT INTO `mainadmin` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE IF NOT EXISTS `register` (
`id` int(11) NOT NULL,
  `course` varchar(250) NOT NULL,
  `shift` varchar(250) NOT NULL,
  `adno` varchar(250) NOT NULL,
  `doa` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `sex` varchar(250) NOT NULL,
  `dob` varchar(250) NOT NULL,
  `comm` varchar(250) NOT NULL,
  `subc` varchar(250) NOT NULL,
  `pschool` varchar(250) NOT NULL,
  `national` varchar(250) NOT NULL,
  `religion` varchar(250) NOT NULL,
  `dist` varchar(250) NOT NULL,
  `fm` varchar(250) NOT NULL,
  `tho` varchar(250) NOT NULL,
  `income` varchar(250) NOT NULL,
  `handi` varchar(250) NOT NULL,
  `exser` varchar(250) NOT NULL,
  `orgin` varchar(250) NOT NULL,
  `sports` varchar(250) NOT NULL,
  `addr` varchar(250) NOT NULL,
  `tags` varchar(250) NOT NULL,
  `photo` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `batch` varchar(250) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `course`, `shift`, `adno`, `doa`, `name`, `sex`, `dob`, `comm`, `subc`, `pschool`, `national`, `religion`, `dist`, `fm`, `tho`, `income`, `handi`, `exser`, `orgin`, `sports`, `addr`, `tags`, `photo`, `status`, `batch`) VALUES
(3, 'BA English', 'Shift II', '', '06-01-2017', '', '', '', 'OC', 'fasd', 'sadfads', 'Indian', 'asfd', 'asdf', 'adsf', 'yes', '1004', 'yes', 'yes', 'yes', 'yes', 'dsafajlf;ksd', 'sadf;sdf', 'uploads/Koala.jpg', '', ''),
(4, 'BA English', 'Shift II', '', '06-01-2017', 'asdf', 'Male', '27-12-2016', 'OC', 'gsd', 'dssaf', 'Indian', 'asfdd', 'adsdfsd', 'sadfs', 'yes', '1000', 'no', 'yes', 'yes', 'yes', 'asdfasdfasd', 'sadfadsj;lk,asdfadsf', 'uploads/Lighthouse.jpg', '', ''),
(5, 'BA History', 'Shift II', 'fdsaf', '06-01-2017', 'dsfaasdf', 'Male', '09-01-2017', 'OC', 'asdfasdf', 'asdafkl;sadf', 'kadsj;kflas', 'lskdafj;', 'dsfa', 'asadf', 'yes', '1000', 'yes', 'yes', 'yes', 'yes', 'fasl;df', 'adsdj;lfkj', 'uploads/Koala.jpg', '', ''),
(6, 'M.Sc Comp.Science', 'Shift I', '1214132', '06-01-2017', 'gopi sm', 'Male', '15-10-1994', 'BC', 'Sourstra', 'Sour. hr, schoo, paramakudi', 'Indian', 'Hindu', 'Ramanthapuram', 'Manokaran', 'no', '10000', 'no', 'no', 'no', 'no', 'Emaneswaram', 'Left Hand,Right Hand', 'uploads/gopiphoto.jpg', '', ''),
(7, 'B.Sc Comp.Science', 'Shift I', '12321', '06-01-2017', 'sabarikirivasan', 'Male', '28-11-2016', 'BC', 'sour', 'sour', 'Indian', 'hindu', 'rmd', 'mani', 'yes', '100100', 'yes', 'yes', 'yes', 'yes', 'rajja', 'short,hight', 'uploads/IMG_20160420_170052.jpg', 'Not Issued', ''),
(8, 'BA English', 'Shift II', 'fdsafsd', '01-07-2015', 'fdas', 'Male', '29-05-2017', 'BC', 'gsd', 'sadf', 'Indian', 'dsfa', 'saf', 'adsdf', 'yes', '1001', 'yes', 'yes', 'yes', 'yes', 'asddfasd', 'adsdfasd,sasdfsd', 'uploads/IMG_20160401_215341.jpg', 'Not Issued', '2015'),
(9, 'BA English', 'Shift II', 'fdsafsd', '01-07-2015', 'fdas', 'Male', '29-05-2017', 'BC', 'gsd', 'sadf', 'Indian', 'dsfa', 'saf', 'adsdf', 'yes', '1001', 'yes', 'yes', 'yes', 'yes', 'asddfasd', 'adsdfasd,sasdfsd', 'uploads/IMG_20160401_215443.jpg', 'Iussed on 07-01-2017', '2015');

-- --------------------------------------------------------

--
-- Table structure for table `tc`
--

CREATE TABLE IF NOT EXISTS `tc` (
  `id` int(11) NOT NULL,
  `dobw` varchar(250) NOT NULL,
  `sublev` varchar(250) NOT NULL,
  `aucsub` varchar(250) NOT NULL,
  `part1` varchar(250) NOT NULL,
  `medium` varchar(250) NOT NULL,
  `paid` varchar(250) NOT NULL,
  `scholar` varchar(250) NOT NULL,
  `medical` varchar(250) NOT NULL,
  `dol` varchar(250) NOT NULL,
  `chara` varchar(250) NOT NULL,
  `apply` varchar(250) NOT NULL,
  `idate` varchar(250) NOT NULL,
  `noy` varchar(250) NOT NULL,
  `academic` varchar(250) NOT NULL,
  `flang` varchar(250) NOT NULL,
  `tmedium` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tc`
--

INSERT INTO `tc` (`id`, `dobw`, `sublev`, `aucsub`, `part1`, `medium`, `paid`, `scholar`, `medical`, `dol`, `chara`, `apply`, `idate`, `noy`, `academic`, `flang`, `tmedium`, `date`) VALUES
(9, 'twentnine-may-twoseventy', 'CS', 'Computer', 'English', 'English', 'Yes', '-', 'No', '05-01-2017', 'Good', '03-01-2017', '03-01-2017', '3', '4033', 'Tamil', 'English', '07-01-2017');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `mainadmin`
--
ALTER TABLE `mainadmin`
 ADD PRIMARY KEY (`username`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tc`
--
ALTER TABLE `tc`
 ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
