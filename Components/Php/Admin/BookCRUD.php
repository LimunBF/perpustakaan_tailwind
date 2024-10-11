<?php
require_once '../../Connection/DBConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'edit':
                editBook($_POST['bookId'], $_POST['isbn'], $_POST['judul'], $_POST['penulis'], $_POST['genre'], $_POST['publisher'], $_POST['tahun'], $_POST['jumlah']);
                break;
            case 'delete':
                deleteBook($_POST['bookId']);
                break;
            case 'add':
                addBook($_POST['isbn'], $_POST['judul'], $_POST['penulis'], $_POST['genre'], $_POST['publisher'], $_POST['tahun'], $_POST['jumlah']);
                break;
        }
    }
}

function editBook($bookId, $isbn, $judul, $penulis, $genre, $publisher, $tahun, $jumlah) {
    global $con;
    $query = "UPDATE books SET ISBN = ?, JUDUL = ?, PENULIS = ?, GENRE = ?, PUBLISHER = ?, TAHUN = ?, JUMLAH = ? WHERE BOOK_ID = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ssssssii", $isbn, $judul, $penulis, $genre, $publisher, $tahun, $jumlah, $bookId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function deleteBook($bookId) {
    global $con;
    $query = "DELETE FROM books WHERE BOOK_ID = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $bookId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function addBook($isbn, $judul, $penulis, $genre, $publisher, $tahun, $jumlah) {
    global $con;
    $query = "INSERT INTO books (ISBN, JUDUL, PENULIS, GENRE, PUBLISHER, TAHUN, JUMLAH) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ssssssi", $isbn, $judul, $penulis, $genre, $publisher, $tahun, $jumlah);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}