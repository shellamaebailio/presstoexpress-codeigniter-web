-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2017 at 08:26 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pte`
--

-- --------------------------------------------------------

--
-- Table structure for table `bed_room`
--

CREATE TABLE IF NOT EXISTS `bed_room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_no` int(11) NOT NULL,
  `bed_no` int(11) NOT NULL,
  `parent_no` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `bed_room`
--

INSERT INTO `bed_room` (`id`, `room_no`, `bed_no`, `parent_no`, `deleted`) VALUES
(12, 101, 0, 0, 0),
(13, 101, 1, 101, 0),
(14, 101, 2, 101, 0),
(15, 101, 3, 101, 0),
(16, 101, 4, 101, 0),
(17, 101, 5, 101, 0),
(18, 101, 6, 101, 0),
(19, 101, 7, 101, 0),
(20, 102, 0, 0, 0),
(21, 102, 1, 102, 0);

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE IF NOT EXISTS `device` (
  `device_id` int(100) NOT NULL AUTO_INCREMENT,
  `mac` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `deleted` int(11) NOT NULL,
  `last_logged_in_date` date NOT NULL,
  `last_logged_in` int(11) NOT NULL,
  `allow_start` int(11) NOT NULL,
  PRIMARY KEY (`device_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`device_id`, `mac`, `name`, `deleted`, `last_logged_in_date`, `last_logged_in`, `allow_start`) VALUES
(1, '202481586397956', 'express_device1', 0, '2017-03-11', 114850, 0),
(2, '892357346547356', 'express_device2', 0, '0000-00-00', 0, 0),
(3, '203828933219321', 'express_device3', 0, '0000-00-00', 0, 0),
(4, '548395738957389', 'express_device4', 0, '0000-00-00', 0, 0),
(5, '723897382942432', 'express_device5', 0, '0000-00-00', 0, 1),
(6, '349997872913131', 'express_device6', 0, '0000-00-00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` int(100) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `device_id` int(50) NOT NULL,
  `bed_room_id` int(50) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`patient_id`),
  KEY `device_id` (`device_id`),
  KEY `room_id` (`bed_room_id`),
  KEY `device_id_2` (`device_id`),
  KEY `bed_room_id` (`bed_room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `fname`, `mname`, `gender`, `birthdate`, `address`, `lname`, `device_id`, `bed_room_id`, `deleted`) VALUES
(4, 'Sol', 'D.', 'Female', '1980-04-13', 'St. Joseph Golden home foundation', 'Dela pena', 1, 13, 0),
(5, 'Zosimo', 'Z.', 'Male', '1984-11-30', 'Lapasan, Cagayan de Oro City', 'Dalion', 5, 14, 1),
(6, 'Alfreda', 'A.', 'Female', '1920-02-08', 'Lumbia, Cagayan de Oro City', 'Gamba', 3, 18, 1),
(7, 'Mario', 'M.', 'Male', '1740-02-11', 'Lapasan, Cagayan de Oro City', 'Estrella', 2, 19, 0),
(8, 'Victor', 'V.', 'Male', '1959-11-03', 'Lapasan, Cagayan de Oro City', 'Maglangit', 1, 18, 1),
(9, 'Virginia', 'V.', 'Female', '1990-02-11', 'Lumbia, Cagayan de Oro City', 'Gabas', 0, 18, 1),
(10, 'Arcadio', 'O.', 'Male', '1987-02-01', 'Patag, Cagayan de Oro City', 'Galos', 0, 19, 1),
(11, 'Edhika', 'E.', 'Female', '1989-11-30', 'Lumbia, Cagayan de Oro City', 'Agos', 0, 0, 1),
(12, 'Alfonsa', 'C.', 'Female', '1989-02-01', 'Carmen, Cagayan de oro City', 'Camporidondo', 0, 0, 1),
(13, 'Felixberia', 'F.', 'Female', '1986-01-01', 'Cogon, Cagayn de oro city', 'Abellanosa', 0, 0, 1),
(14, 'Minda', 'M.', 'Female', '1990-02-02', 'Lapasan, Cagayan de Oro City', 'Vallar', 0, 0, 1),
(15, '', '', '', '0000-00-00', '', '', 0, 0, 1),
(16, '', '', '', '0000-00-00', '', '', 0, 0, 1),
(17, 'dfdewf', 'wefew', 'Male', '2017-02-17', 'fwf', 'fw', 1, 15, 1),
(18, 'Mar Christine', 'Serdena', 'Female', '2017-02-21', 'Patag, Cagayan de Oro City', 'Ramos', 1, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff_t`
--

CREATE TABLE IF NOT EXISTS `staff_t` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_type` varchar(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `deleted` int(11) NOT NULL,
  `logged_in` int(11) NOT NULL,
  `last_logged_in_date` date NOT NULL,
  `last_logged_in` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `staff_t`
--

INSERT INTO `staff_t` (`id`, `staff_type`, `fname`, `mname`, `lname`, `gender`, `email`, `contact_no`, `address`, `username`, `password`, `deleted`, `logged_in`, `last_logged_in_date`, `last_logged_in`) VALUES
(5, 'admin', 'carlos', 'l', 'dura', 'male', 'duracs@gmail.com', '09361472152', 'Carmen CDO', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 0, 0, '0000-00-00', 0),
(8, 'caretaker', 'ronalyn', 'hapson', 'pabololot', 'female', 'ronalynko12@gmail.com', '09058963463', 'lapasan, cagayan de oro city', 'rona', '827ccb0eea8a706c4c34a16891f84e7b', 0, 1, '2017-03-11', 110417),
(9, 'caretaker', 'shellamae', 'yurag', 'bailio', 'female', 'she@gmail.com', '8080', 'lumbia, cagayan de oro city', 'shella', '827ccb0eea8a706c4c34a16891f84e7b', 0, 1, '2017-02-20', 120940),
(10, 'caretaker', 'mar', 'serdena', 'ramos', 'female', 'mar@gmail.com', '8080', 'opol, mis. or', 'mar', '55517ebde4a0174883ef85aaca2cb48f', 0, 1, '2017-02-10', 23035),
(11, 'caretaker', 'christize', 'olavedes', 'galos', 'female', 'chris@gmail.com', '8888', 'patag, cagayan de oro city', 'Dumog', '827ccb0eea8a706c4c34a16891f84e7b', 0, 1, '2017-03-11', 114850);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `trans_id` int(50) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` int(100) NOT NULL,
  `need` varchar(100) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `patient_id` int(100) NOT NULL,
  `attended` int(11) NOT NULL,
  `details` varchar(500) NOT NULL,
  `device_name` varchar(20) NOT NULL,
  `time_attended` int(11) NOT NULL,
  `time_finished` int(11) NOT NULL,
  PRIMARY KEY (`trans_id`),
  KEY `patient_id` (`patient_id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=504 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`trans_id`, `date`, `time`, `need`, `staff_id`, `patient_id`, `attended`, `details`, `device_name`, `time_attended`, `time_finished`) VALUES
(489, '2017-02-19', 103621, 'emergency', 9, 7, 1, 'the patient was taken good care of. ', '', 103629, 103632),
(490, '2017-02-19', 105056, 'emergency', 11, 6, 1, 'the patient is in critical condition', '', 105142, 110108),
(491, '2017-02-19', 110423, 'water', 10, 6, 1, 'the patient was dehydrated', '', 110551, 110660),
(492, '2017-02-19', 111217, 'massage', 9, 7, 1, 'back ache', '', 111432, 112000),
(493, '2017-02-19', 111537, 'clothes', 8, 4, 1, 'back was wet', '', 111750, 150000),
(494, '2017-02-19', 111704, 'massage', 9, 4, 1, 'neck ache', '', 111900, 121300),
(495, '2017-03-11', 110021, 'emergency', 11, 4, 1, '', '', 110109, 110113),
(496, '2017-03-11', 110235, 'emergency', 11, 4, 1, '', '', 110254, 110301),
(498, '2017-03-11', 111601, 'emergency', 11, 4, 1, '', '', 111622, 111626),
(499, '2017-03-11', 111829, 'emergency', 11, 4, 1, '', '', 111841, 111844),
(500, '2017-03-11', 113235, 'water', 11, 4, 1, '', '', 113301, 113309),
(501, '2017-03-11', 113351, 'water', 11, 4, 1, 'ok', '', 113355, 113409),
(502, '2017-03-11', 113904, 'water', 11, 4, 1, 'l', '', 114000, 114018),
(503, '2017-03-11', 114202, 'water', 11, 4, 1, '', '', 114220, 114223);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
