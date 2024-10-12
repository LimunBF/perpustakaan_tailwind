-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2024 at 02:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) NOT NULL,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'tes', 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `password`) VALUES
('tes', 'tes'),
('tes', 'da');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `ISBN` bigint(20) DEFAULT NULL,
  `BOOK_ID` bigint(20) NOT NULL,
  `GENRE` text DEFAULT NULL,
  `JUDUL` text DEFAULT NULL,
  `PENULIS` text DEFAULT NULL,
  `PUBLISHER` text DEFAULT NULL,
  `TAHUN` bigint(20) DEFAULT NULL,
  `JUMLAH` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ISBN`, `BOOK_ID`, `GENRE`, `JUDUL`, `PENULIS`, `PUBLISHER`, `TAHUN`, `JUMLAH`) VALUES
(9786230314285, 1, 'Manga', 'Frieren : After The End 08 - Special Edition', 'KANEHITO YAMADA/TSUKASA ABE', 'm&c!', 2024, 4),
(9786020633576, 2, 'Fiksi', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 5),
(9786020332172, 5, 'Bisnis', 'Rich Dad Poor Dad', 'Robert T. Kiyosaki', 'Gramedia Pustaka Utama', 2017, 5),
(9786020622181, 6, 'Fiksi', 'Dilan 1990', 'Pidi Baiq', 'Pastel Books', 2014, 4),
(9786020675312, 7, 'Romance', 'Hopeless (Tanpa Daya)', 'Colleen Hoover', 'Gramedia Pustaka Utama', 2024, 3),
(9781234567897, 8, 'Fiksi', 'To Kill a Mockingbird', 'Harper Lee', 'J.B. Lippincott & Co.', 1960, 10),
(9781234567898, 9, 'Fantasi', 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 'Bloomsbury', 1997, 15),
(9781234567899, 10, 'Fiksi', 'Dune', 'Frank Herbert', 'Chilton Books', 1965, 7),
(9781234567801, 12, 'Biography', 'The Diary of a Young Girl', 'Anne Frank', 'Contact Publishing', 1947, 8),
(9781234567802, 13, 'Non-Fiksi', 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 'Harvill Secker', 2011, 10),
(9781234567803, 14, 'Romance', 'Pride and Prejudice', 'Jane Austen', 'T. Egerton, Whitehall', 1813, 20),
(9781234567804, 15, 'Fiksi', 'The Book Thief', 'Markus Zusak', 'Picador', 2005, 10),
(9781234567805, 16, 'Horror', 'It', 'Stephen King', 'Viking Press', 1986, 5),
(9781234567806, 17, 'Thriller', 'The Girl with the Dragon Tattoo', 'Stieg Larsson', 'Norstedts Förlag', 2005, 12),
(9781234567807, 18, 'Fantasy', 'The Hobbit', 'J.R.R. Tolkien', 'George Allen & Unwin', 1937, 15),
(9781234567808, 19, 'Filosofi', 'The Republic', 'Plato', 'Penguin Classics', 380, 8),
(9781234567809, 20, 'Self-help', 'The Power of Habit', 'Charles Duhigg', 'Random House', 2012, 10),
(9781234567810, 21, 'Science', 'A Brief History of Time', 'Stephen Hawking', 'Bantam Dell Publishing Group', 1988, 6),
(9781234567811, 22, 'Poetry', 'The Waste Land', 'T.S. Eliot', 'Faber and Faber', 1922, 5),
(9781234567812, 23, 'Drama', 'Hamlet', 'William Shakespeare', 'N/A', 1600, 10),
(9781234567813, 24, 'Classic', 'Moby Dick', 'Herman Melville', 'Harper & Brothers', 1851, 7),
(9781234567814, 25, 'Adventure', 'The Call of the Wild', 'Jack London', 'Macmillan', 1903, 15),
(9781234567815, 26, 'Humor', 'Bossypants', 'Tina Fey', 'Little, Brown and Company', 2011, 12),
(9781234567816, 27, 'Children\'s Literature', 'Charlotte\'s Web', 'E.B. White', 'Harper & Brothers', 1952, 18),
(9781234567817, 28, 'Fantasy', 'The Name of the Wind', 'Patrick Rothfuss', 'DAW Books', 2007, 8),
(9781234567818, 29, 'Fiction', 'The Great Gatsby', 'F. Scott Fitzgerald', 'Charles Scribner\'s Sons', 1925, 20),
(9781234567819, 30, 'Historical Fiction', 'All the Light We Cannot See', 'Anthony Doerr', 'Scribner', 2014, 10),
(9781234567820, 31, 'Science Fiction', 'Neuromancer', 'William Gibson', 'Ace Books', 1984, 7),
(9781234567821, 32, 'Memoir', 'Educated', 'Tara Westover', 'Random House', 2018, 12),
(9781234567822, 33, 'Mystery', 'The Da Vinci Code', 'Dan Brown', 'Doubleday', 2003, 15),
(9781234567823, 34, 'Fantasy', 'American Gods', 'Neil Gaiman', 'HarperCollins', 2001, 8),
(9781234567824, 35, 'Self-help', 'Atomic Habits', 'James Clear', 'Penguin', 2018, 10),
(9781234567825, 36, 'Horror', 'The Shining', 'Stephen King', 'Doubleday', 1977, 5),
(9781234567826, 37, 'Thriller', 'The Silence of the Lambs', 'Thomas Harris', 'St. Martin\'s Press', 1988, 8);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `isbn` bigint(20) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `jumlah_pinjam` int(2) DEFAULT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` enum('borrowed','returned') DEFAULT 'borrowed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `telephone_number` bigint(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `gender`, `telephone_number`, `email`) VALUES
(1, 'Limun', 'Cowok', 821467427, 'lintang@gmail.com'),
(2, 'limuns tjh', 'Cowok', 82233809069, 'lintangmukti638@gmail.com'),
(3, 'Septian Dwi', 'Cowok', 893457512, 'septian@gmail.com');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `validate_email` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
  IF NEW.email NOT REGEXP '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,}$' THEN
    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Invalid email address';
  END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`BOOK_ID`) USING BTREE,
  ADD KEY `ISBN` (`ISBN`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `isbn` (`isbn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `BOOK_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `isbn` FOREIGN KEY (`isbn`) REFERENCES `books` (`ISBN`),
  ADD CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
