<?php
require_once '../../Connection/DBConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'edit':
                try {
                    editBook($_POST['bookId'], $_POST['isbn'], $_POST['judul'], $_POST['penulis'], $_POST['genre'], $_POST['publisher'], $_POST['tahun'], $_POST['jumlah']);
                    echo 'Edit successful';
                } catch (Exception $e) {
                    echo 'Edit failed: ' . $e->getMessage();
                }
                break;
            case 'delete':
                try {
                    deleteBook($_POST['bookId']);
                    echo 'Delete successful';
                } catch (Exception $e) {
                    echo 'Delete failed: ' . $e->getMessage();
                }
                break;
            case 'add':
                try {
                    addBook($_POST['isbn'], $_POST['judul'], $_POST['penulis'], $_POST['genre'], $_POST['publisher'], $_POST['tahun'], $_POST['jumlah']);
                    echo 'Add successful';
                } catch (Exception $e) {
                    echo 'Add failed: ' . $e->getMessage();
                }
                break;
        }
    } else {
        echo 'Invalid action';
    }
} else {
    echo 'Invalid request method';
}

function editBook($bookId, $isbn, $judul, $penulis, $genre, $publisher, $tahun, $jumlah) {
    global $con;
    $query = "UPDATE books SET `ISBN Index` = ?, JUDUL = ?, PENULIS = ?, GENRE = ?, PUBLISHER = ?, TAHUN = ?, JUMLAH = ? WHERE BOOK_ID = ?";
    $stmt = mysqli_prepare($con, $query);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . mysqli_error($con));
    }
    mysqli_stmt_bind_param($stmt, "ssssssii", $isbn, $judul, $penulis, $genre, $publisher, $tahun, $jumlah, $bookId);
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception('Execute failed: ' . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_close($stmt);
}

function deleteBook($bookId) {
    global $con;
    $query = "DELETE FROM books WHERE BOOK_ID = ?";
    $stmt = mysqli_prepare($con, $query);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . mysqli_error($con));
    }
    mysqli_stmt_bind_param($stmt, "i", $bookId);
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception('Execute failed: ' . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_close($stmt);
}

function addBook($isbn, $judul, $penulis, $genre, $publisher, $tahun, $jumlah) {
    global $con;
    $query = "INSERT INTO books (`ISBN Index`, JUDUL, PENULIS, GENRE, PUBLISHER, TAHUN, JUMLAH) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);
    if (!$stmt) {
        throw new Exception('Prepare failed: ' . mysqli_error($con));
    }
    mysqli_stmt_bind_param($stmt, "ssssssi", $isbn, $judul, $penulis, $genre, $publisher, $tahun, $jumlah);
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception('Execute failed: ' . mysqli_stmt_error($stmt));
    }
    mysqli_stmt_close($stmt);
}