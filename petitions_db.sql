-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 22, 2018 at 01:34 PM
-- Server version: 5.6.41
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petitions_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `petitions`
--

CREATE TABLE `petitions` (
  `id` int(11) NOT NULL,
  `id_autor` varchar(64) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` varchar(1000) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `petitions`
--

INSERT INTO `petitions` (`id`, `id_autor`, `subject`, `body`, `active`) VALUES
(5, '88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', 'First', 'laksntlkrn\r\nkalaksdt', 1),
(8, '5763adf2adc36151fe070114db25120cde4132c199cbb7611fb6d2bf68d2d7ab', 'second', 'second petition', 1),
(9, '88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', 'threed', 'artlklknds', 1),
(10, 'ee096b06e6a1e3a477bed67f30e78c706455808604ea6bde35ed148a7202be12', 'Fours', 'kajslktrlkn lkjf salkrt', 1),
(11, '88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', 'fives', 'alkdjltrkej sdlfkjlkjr lkdjfl123123', 1),
(12, '88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', 'number 6', '6666666666666', 1),
(13, 'ffadf547cb0e41f96f9a516a46bf9672331d75be4220d24c556cb61cd7b6b8d8', '7', 'sdferter', 1),
(14, '5d5c86d445c78fc38242b80f1567e946af8ac59413e27471359f6305cf30c318', '8', 'r324123', 1),
(15, 'ffadf547cb0e41f96f9a516a46bf9672331d75be4220d24c556cb61cd7b6b8d8', '9', '123123', 1),
(16, '88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', '10', '412421', 1),
(22, '7274094aca8a9e6cc0aaeec93d8c1a481cc74d37d3cc04d1c22dc0972dcb902c', 'New1', 'vare', 1),
(23, '7274094aca8a9e6cc0aaeec93d8c1a481cc74d37d3cc04d1c22dc0972dcb902c', 'one petition', 'asdf', 1),
(25, '7274094aca8a9e6cc0aaeec93d8c1a481cc74d37d3cc04d1c22dc0972dcb902c', 'my next petition', 'my next petition', 1),
(32, 'f50a2eb63d9ccba1f5a087a9ff923bbe84503f5f18c22832d9a84d99dbe89a97', 'NEW PET', 'dddddddddddddddddddd', 1),
(33, '7274094aca8a9e6cc0aaeec93d8c1a481cc74d37d3cc04d1c22dc0972dcb902c', 'aaaaaaaaaaaa', 'fffffffffffffffffff', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `hash`) VALUES
(1, 'cbcfbe8e613fbefd4d4a158eb4e6ed80'),
(2, 'ecd50ae0c3ed0261ace942de6f206029'),
(3, '1cb963db3cf206f06527b4023be38e1a'),
(4, '85e246cd28906f280992b76993bdefdb'),
(5, '0f2b0ae2c3d81468e12c258decedfd05'),
(6, 'ad5c5236f2dac4f18714a570e76b0e00'),
(7, '4dd4b8d56c7e5cb0930c98e718bc790c'),
(8, 'e5dc4fae038d41ab5464cd35ed59359c'),
(9, 'c13635bcdeaf01edf158b8feebdfc802'),
(10, '949e063385e43a27411f02d7c2d3f0ab'),
(11, '1587cc34958df2904873442650665ef4'),
(12, '334fc4f8b9ee002620bfcf716b75d17c'),
(13, '4e2727b798bcc0e33a97010b2bbd9e9d'),
(14, '98ed1afc14e94434105d34a2c78f4c56'),
(15, 'e83d03d3ef98dbf11b0d16ed145696a3'),
(16, '2fd19986315739e842e9188174e196ae'),
(17, '5ffe8337ae08144721a2eae7387884e1'),
(18, '9aa391479b532791b26294e137982afe'),
(19, '3bb6b25051edddf2e6680388498e7509'),
(20, 'ca00d94c4b7678ffbd2a199ff9421c1f'),
(21, 'c7c9f951a0e3df0d09fa98981c07cffc'),
(22, 'e0ca2b987b8444337002218791c4d4bc'),
(23, 'c5dd365cc95e22e3a63635d9a2115e2d'),
(24, '273d04e18e648d1ca2848b89508596f0'),
(25, 'c6c703ed848a1d95c2e8a7944bd29bf4'),
(26, '54fb0cd0b93d076bdea9cd374bf495b1'),
(27, '0ce9b7698315b46281169a20dc0b4d68'),
(28, '1bb62474fc101112c09f58fbf00733e3'),
(29, '9be33b90119c24f826fe524e13f419b5'),
(30, 'f462c82798416b920b2b8080c7b989b3'),
(31, '477b6e1469a69bd7deaac302b96bcd2a'),
(32, 'a2fb8f6ba8ee68ff88385090cfc7c27c'),
(33, 'ed9d2041789b109e5e6bca60d99e8d3e'),
(34, '451fa2b2756490b15246d693a569357f'),
(35, '668387395250c2dd57a5039a0210864b'),
(36, '3cda85d8fc586f6b8d7bd5cc68f72fbd'),
(37, '74d325ded685137f49aed9f693fcf53d');

-- --------------------------------------------------------

--
-- Table structure for table `signatures`
--

CREATE TABLE `signatures` (
  `id` int(11) NOT NULL,
  `id_user` varchar(64) NOT NULL,
  `id_petition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `signatures`
--

INSERT INTO `signatures` (`id`, `id_user`, `id_petition`) VALUES
(2, '5763adf2adc36151fe070114db25120cde4132c199cbb7611fb6d2bf68d2d7ab', 5),
(3, '88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', 5),
(4, '88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', 8),
(5, 'ffadf547cb0e41f96f9a516a46bf9672331d75be4220d24c556cb61cd7b6b8d8', 8),
(6, 'ee096b06e6a1e3a477bed67f30e78c706455808604ea6bde35ed148a7202be12', 9),
(7, 'ee096b06e6a1e3a477bed67f30e78c706455808604ea6bde35ed148a7202be12', 10),
(8, '88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', 10),
(9, '5d5c86d445c78fc38242b80f1567e946af8ac59413e27471359f6305cf30c318', 5),
(10, '5763adf2adc36151fe070114db25120cde4132c199cbb7611fb6d2bf68d2d7ab', 16),
(11, '7abebcbffd3d6aa0fe9c53fad324f67e8c6388d7456385dd390899ca84b2ffc6', 16),
(12, '7274094aca8a9e6cc0aaeec93d8c1a481cc74d37d3cc04d1c22dc0972dcb902c', 0),
(13, 'f619e87c6fc32065033b7c9a0ac67cce03a9c283be787bda947349fb575d1374', 0),
(14, 'f619e87c6fc32065033b7c9a0ac67cce03a9c283be787bda947349fb575d1374', 5),
(15, '7274094aca8a9e6cc0aaeec93d8c1a481cc74d37d3cc04d1c22dc0972dcb902c', 5),
(16, 'f619e87c6fc32065033b7c9a0ac67cce03a9c283be787bda947349fb575d1374', 8),
(17, '7274094aca8a9e6cc0aaeec93d8c1a481cc74d37d3cc04d1c22dc0972dcb902c', 8),
(18, 'e13873a044d34e62a1904b782577fd74ff46c696db300e24e9f30173cbccf25f', 5),
(19, 'e13873a044d34e62a1904b782577fd74ff46c696db300e24e9f30173cbccf25f', 33),
(20, 'cc2e166955ec49675e749f9dce21db0cbd2979d4aac4a845bdde35ccb642bc47', 5),
(21, 'cc2e166955ec49675e749f9dce21db0cbd2979d4aac4a845bdde35ccb642bc47', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `active`, `password`) VALUES
('5763adf2adc36151fe070114db25120cde4132c199cbb7611fb6d2bf68d2d7ab', 'kostya@gmail.com', 1, ''),
('5d5c86d445c78fc38242b80f1567e946af8ac59413e27471359f6305cf30c318', 'email2@email.com', 1, ''),
('7274094aca8a9e6cc0aaeec93d8c1a481cc74d37d3cc04d1c22dc0972dcb902c', 'max@user.com', 1, ''),
('7abebcbffd3d6aa0fe9c53fad324f67e8c6388d7456385dd390899ca84b2ffc6', 'ter@dsk.rr', 1, ''),
('88af91d7cf4ebfe6adcce8825f223a9fb847c1c2787d809c7eaeae84a97e9b54', 'tretyak1c@gmail.com', 1, ''),
('cc2e166955ec49675e749f9dce21db0cbd2979d4aac4a845bdde35ccb642bc47', 'test2@gmail.com', 1, ''),
('e13873a044d34e62a1904b782577fd74ff46c696db300e24e9f30173cbccf25f', 'newuser@email.com', 1, ''),
('e61c573b14f29d7df846c3b9b4288248c171791090ea7a41bd4e3fccd50b3c2d', 'slava@gmail.com', 0, 'b59c67bf196a4758191e42f76670ceba'),
('ee096b06e6a1e3a477bed67f30e78c706455808604ea6bde35ed148a7202be12', 'bestofthebest@gmail.com', 1, ''),
('f50a2eb63d9ccba1f5a087a9ff923bbe84503f5f18c22832d9a84d99dbe89a97', 'newnew@new.new', 1, ''),
('f619e87c6fc32065033b7c9a0ac67cce03a9c283be787bda947349fb575d1374', 'new@gmail.com', 1, ''),
('fe624869a6d98599aff16040d69d4c3627b29d86e32a7f5672fb454ae0e6f6ee', 'tester3@gmai.com', 0, '81dc9bdb52d04dc20036dbd8313ed055'),
('ffadf547cb0e41f96f9a516a46bf9672331d75be4220d24c556cb61cd7b6b8d8', 'tretyak1c@ukr.net', 1, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `petitions`
--
ALTER TABLE `petitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signatures`
--
ALTER TABLE `signatures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `petitions`
--
ALTER TABLE `petitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `signatures`
--
ALTER TABLE `signatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
