-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2018 at 04:10 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookid` int(11) NOT NULL,
  `author` varchar(150) COLLATE utf16_swedish_ci NOT NULL,
  `title` varchar(150) COLLATE utf16_swedish_ci NOT NULL,
  `onloan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_swedish_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookid`, `author`, `title`, `onloan`) VALUES
(1, 'J.K Rowling', 'Harry Potter and the order of the phoenix', 1),
(2, 'Nicholas Sparks', 'The Notebook', 0),
(3, 'hejhejhej', 'maria', 0),
(4, 'bert', 'kul', 0),
(5, 'cirkus', 'elefant', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` char(150) COLLATE utf16_swedish_ci NOT NULL,
  `userpass` varchar(150) COLLATE utf16_swedish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16 COLLATE=utf16_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `userpass`) VALUES
(1, 'maria', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;