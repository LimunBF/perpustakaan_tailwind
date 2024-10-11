<?php
include '../../Connection/DBConnection.php';

// Process the borrowing form submission
if (isset($_POST['pinjam'])) {
    $isbn = $_POST['isbn'];
    $book_name = $_POST['book_name'];
    $nama_peminjam = $_POST['nama_peminjam'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];

    // Initialize an array to store the filled data
    $filled_data = array();

    // Validate each field individually
    if (!empty($isbn)) {
        $filled_data['isbn'] = $isbn;
    }
    if (!empty($book_name)) {
        $filled_data['book_name'] = $book_name;
    }
    if (!empty($nama_peminjam)) {
        $filled_data['nama_peminjam'] = $nama_peminjam;
    }
    if (!empty($tanggal_pinjam)) {
        $filled_data['tanggal_pinjam'] = $tanggal_pinjam;
    }

    // Check if all fields are filled in
    if (count($filled_data) < 4) {
        $message = "Semua field harus diisi!";
    } else {
        // Check if the book exists
        $sql = "SELECT * FROM books WHERE JUDUL = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $filled_data['book_name']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            // Book exists, proceed with borrowing
            $row = mysqli_fetch_assoc($result);
            $book_id = $row['BOOK_ID'];
            $jumlah = $row['JUMLAH'];

            if ($jumlah <= 0) {
                // Book is out of stock, display an error message
                $message = "Buku tidak tersedia karena stok habis!";
            } else {
                // Check if the username exists in the database
                $sql = "SELECT id FROM users WHERE username = ?";
                $stmt = mysqli_prepare($con, $sql);
                mysqli_stmt_bind_param($stmt, "s", $filled_data['nama_peminjam']);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 0) {
                    // Username not found, set an error message
                    $message = "Username not found!";
                } else {
                    // If the username is found, retrieve the user ID and proceed with the borrowing process
                    $row = mysqli_fetch_assoc($result);
                    $user_id = $row['id'];

                    // Start a transaction
                    mysqli_begin_transaction($con);

                    try {
                        // Calculate the tanggal_kembali
                        $tanggal_kembali = date('Y-m-d', strtotime('+1 week', strtotime($filled_data['tanggal_pinjam'])));

                        // Subtract 1 from the JUMLAH column in the books table
                        $sql = "UPDATE books SET JUMLAH = JUMLAH - 1 WHERE ISBN = ?";
                        $stmt = mysqli_prepare($con, $sql);
                        mysqli_stmt_bind_param($stmt, "s", $filled_data['isbn']);
                        mysqli_stmt_execute($stmt);

                        // Check if the update was successful
                        if (mysqli_affected_rows($con) == 0) {
                            throw new Exception("Failed to update the book quantity");
                        }

                        // Insert a new record into the peminjaman table
                        $sql = "INSERT INTO peminjaman (username, isbn, tanggal_pinjam, tanggal_kembali, status) VALUES (?, ?, ?, ?, 'borrowed')";
                        $stmt = mysqli_prepare($con, $sql);
                        mysqli_stmt_bind_param($stmt, "ssss", $filled_data['nama_peminjam'], $filled_data['isbn'], $filled_data['tanggal_pinjam'], $tanggal_kembali);
                        mysqli_stmt_execute($stmt);

                        // Commit the transaction
                        mysqli_commit($con);

                        $message = "Peminjaman berhasil!";
                    } catch (Exception $e) {
                        // Roll back the transaction if an error occurs
                        mysqli_rollback($con);
                        $message = "Peminjaman gagal!";
                    }
                }
            }
        } else {
            // Book does not exist, set an error message
            $message = "Buku tidak tersedia !";
        }
    }
}

if (isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];

    $sql = "SELECT JUDUL, ISBN FROM books WHERE JUDUL LIKE '%$searchTerm%'";
    $result = mysqli_query($con, $sql);

    $books = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }

    echo json_encode($books);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/perpustakaan_tailwind/Components/Css/LayoutPeminjaman.css?v=1.2">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body class="vh-100 gradient-custom">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg gradient-custom-nav sticky-top">
        <div class="container-fluid justify-content-between">
        <a class="navbar-brand fw-bold">
            <i class="bi bi-book icon-color" style="margin-left:10px; margin-right: 8px;"></i> Perpustakaan Kang Lee Moon
        </a>
        <span class="navbar-divider" style="border-left: 1px solid white; height: 30px; margin: auto 15px;"></span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="HomeLay.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="">Peminjaman Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="RiwayatPinjam.php">Riwayat Peminjaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="RegistrasiUser.php">Registrasi User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/perpustakaan_tailwind/Components/Php/LoginAdmin.php">Login Admin</a>
                    </li>
                </ul>
                <span class="navbar-text pe-4 font-nav-admin" style="font-size: large;">
                    USER
                </span>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark collapse" id="sidebar">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white"
                    style="min-height: 100vh;">
                    <h2 class="text-center text-white">Daftar Pengguna</h2>
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT id, username FROM users";
                            $result = mysqli_query($con, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['username'] . "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col py-3">
                <!-- Sidebar Toggle Button -->
                <button class="btn float-end" data-bs-toggle="collapse" data-bs-target="#sidebar" role="button">
                    <i class="bi bi-arrow-left-square-fill fs-3"></i>
                </button>

                <!-- Book Borrowing Form -->
                <form action="" method="post">
                    <div class="form-group">
                        <label for="book_name">Nama Buku</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="book_name" name="book_name"
                                placeholder="Masukkan nama buku" value="<?php echo isset($filled_data['book_name']) ? $filled_data['book_name'] : ''; ?>">
                            <button class="btn btn-primary" id="search-book-btn">Search</button>
                        </div>
                        <div id="book-list"></div>
                    </div>
                    <div class="form-group">
                        <label for="isbn">ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" readonly value="<?php echo isset($filled_data['isbn']) ? $filled_data['isbn'] : ''; ?>">>
                        </div>
                    <div class="form-group">
                        <label for="nama_peminjam">Nama Peminjam</label>
                        <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam"
                            placeholder="Masukkan nama peminjam" value="<?php echo isset($filled_data['nama_peminjam']) ? $filled_data['nama_peminjam'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pinjam">Tanggal Pinjam</label>
                        <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control" 
                            value="<?php echo isset($filled_data['tanggal_pinjam']) ? $filled_data['tanggal_pinjam'] : ''; ?>" min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary" name="pinjam">Pinjam</button>
                </form>
                <div id="message">
                    <?php if (isset($message)) { ?>
                        <div class="alert alert-<?php echo (strpos($message, 'successfully') !== false) ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                            <?php echo $message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script>
    const bookInput = document.getElementById('book_name');
    const searchBookBtn = document.getElementById('search-book-btn');
    const bookList = document.getElementById('book-list');
    const isbnInput = document.getElementById('isbn');

    searchBookBtn.addEventListener('click', async () => {
        const searchTerm = bookInput.value.trim();
        if (searchTerm.length > 0) {
            const params = new URLSearchParams();
            params.append('searchTerm', searchTerm);

            const response = await fetch(window.location.href, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: params.toString(),
            });
            const books = await response.json();
            if (books.length > 0) {
                bookList.innerHTML = '';
                books.forEach((book) => {
                    const bookListItem = document.createElement('div');
                    bookListItem.textContent = book.JUDUL;
                    bookListItem.addEventListener('click', () => {
                        bookInput.value = book.JUDUL;
                        isbnInput.value = book.ISBN; // Set the ISBN value
                        bookList.innerHTML = '';
                    });
                    bookList.appendChild(bookListItem);
                });
            } else {
                bookList.innerHTML = 'No matching books found.';
            }
        } else {
            bookList.innerHTML = '';
        }
    });

    bookInput.addEventListener('input', async () => {
        const searchTerm = bookInput.value.trim();
        if (searchTerm.length > 0) {
            const params = new URLSearchParams();
            params.append('searchTerm', searchTerm);

            const response = await fetch(window.location.href, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: params.toString(),
            });
            const books = await response.json();
            if (books.length > 0) {
                bookList.innerHTML = '';
                books.forEach((book) => {
                    const bookListItem = document.createElement('div');
                    bookListItem.textContent = book.JUDUL;
                    bookListItem.addEventListener('click', () => {
                        bookInput.value = book.JUDUL;
                        isbnInput.value = book.ISBN; // Set the ISBN value
                        bookList.innerHTML = '';
                    });
                    bookList.appendChild(bookListItem);
                });
            } else {
                bookList.innerHTML = 'No matching books found.';
            }
        } else {
            bookList.innerHTML = '';
        }
    });
            // $(document).ready(function() {
        //     $("#search-book-btn").click(function() {
        //         const searchTerm = $("#book_name").val().trim();
        //         if (searchTerm.length > 0) {
        //             $.ajax({
        //                 type: 'POST',
        //                 url: '/search_book', // Replace with your API endpoint
        //                 data: { searchTerm: searchTerm },
        //                 success: function(data) {
        //                     const book = data;
        //                     if (book) {
        //                         $("#isbn").val(book.ISBN);
        //                         $("#book-list").html(''); // Clear previous results
        //                     } else {
        //                         $("#book-list").html('No matching books found.');
        //                     }
        //                 }
        //             });
        //         } else {
        //             $("#book-list").html('');
        //         }
        //     });
        // });
    </script>

    <script src="https://cdn.jsdelivr.net/npm /@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>