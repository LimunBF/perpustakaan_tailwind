<?php
session_start();
?>
<?php
require_once '../../Connection/DBConnection.php';
include 'BookCRUD.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="/perpustakaan_tailwind/Components/Css/Layout.css?v=1.2">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="gradient-custom">
    <section>
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
                            <a class="nav-link" aria-current="page" href="HomeAdminLay.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="">Penambahan Buku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/perpustakaan_tailwind/Components/Php/Login.php">Riwayat
                                Peminjaman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/perpustakaan_tailwind/Components/Php/User/HomeLay.php">Landing Page</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/perpustakaan_tailwind/Components/Php/LoginAdmin.php">Login
                                Admin</a>
                        </li>
                        
                    </ul>
                    <span class="navbar-text pe-4 font-nav-admin" style="font-size:large">
                        Admin :
                        <?php if (isset($_SESSION['username'])) {
                            echo $_SESSION['username'];
                        } else {
                            echo 'Guest';
                        } ?>
                    </span>
                </div>
            </div>
        </nav>
    </section>
    <div class="container">
        <h1 class="text-center text-white pt-3 pb-2">DAFTAR BUKU</h1>
        <table class="table table-striped table-bordered ">
            <thead class=>
                <tr>
                    <th>ISBN</th>
                    <th>JUDUL</th>
                    <th>GENRE</th>
                    <th>PENULIS</th>
                    <th>PENERBIT</th>
                    <th>TAHUN</th>
                    <th>JUMLAH</th>
                    <th class="text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM books LIMIT 20";
                $result = mysqli_query($con, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    // display book data
                    ?>
                    <tr>
                        <td><?php echo $row['ISBN']; ?></td>
                        <td><?php echo $row['JUDUL']; ?></td>
                        <td><?php echo $row['GENRE']; ?></td>
                        <td><?php echo $row['PENULIS']; ?></td>
                        <td><?php echo $row['PUBLISHER']; ?></td>
                        <td><?php echo $row['TAHUN']; ?></td>
                        <td><?php echo $row['JUMLAH']; ?></td>
                        <td class="text-center">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal"
                                data-book-id="<?php echo $row['BOOK_ID']; ?>"
                                data-isbn="<?php echo $row['ISBN']; ?>"
                                data-judul="<?php echo $row['JUDUL']; ?>"
                                data-penulis="<?php echo $row['PENULIS']; ?>"
                                data-genre="<?php echo $row['GENRE']; ?>"
                                data-publisher="<?php echo $row['PUBLISHER']; ?>"
                                data-tahun="<?php echo $row['TAHUN']; ?>"
                                data-jumlah="<?php echo $row['JUMLAH']; ?>">Edit</button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                data-book-id="<?php echo $row['BOOK_ID']; ?>">Delete</button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

        <!-- Create Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="createForm">
                            <div class="mb-3">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input type="text" class="form-control" id="isbn" name="isbn">
                            </div>
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul">
                            </div>
                            <div class="mb-3">
                                <label for="penulis" class="form-label">Penulis</label>
                                <input type="text" class="form-control" id="penulis" name="penulis">
                            </div>
                            <div class="mb-3">
                                <label for="genre" class="form-label">Genre</label>
                                <input type="text" class="form-control" id="genre" name="genre">
                            </div>
                            <div class="mb-3">
                                <label for="publisher" class="form-label">Penerbit</label>
                                <input type="text" class="form-control" id="publisher" name="publisher">
                            </div>
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="number" class="form-control" id="tahun" name="tahun">
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah">
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            <div class="mb-3">
                                <label for="isbn" class="form-label">ISBN</label>
                                <input type="text" class="form-control" id="isbn" name="isbn">
                            </div>
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="judul" name="judul">
                            </div>
                            <div class="mb-3">
                                <label for="penulis" class="form-label">Penulis</label>
                                <input type="text" class="form-control" id="penulis" name="penulis">
                            </div>
                            <div class="mb-3">
                                <label for="genre" class="form-label">Genre</label>
                                <input type="text" class="form-control" id="genre" name="genre">
                            </div>
                            <div class="mb-3">
                                <label for="publisher" class="form-label">Penerbit</label>
                                <input type="text" class="form-control" id="publisher" name="publisher">
                            </div>
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <input type="number" class="form-control" id="tahun" name="tahun">
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Hapus Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus buku ini?</p>
                        <button type="button" class="btn btn-danger" id="deleteButton">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Buku</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        // Create form submission handler
        document.getElementById('createForm').addEventListener('submit', function (event) {
            event.preventDefault();
            var isbn = document.getElementById('isbn').value;
            var judul = document.getElementById('judul').value;
            var penulis = document.getElementById('penulis').value;
            var genre = document.getElementById('genre').value;
            var publisher = document.getElementById('publisher').value;
            var tahun = document.getElementById('tahun').value;
            var jumlah = document.getElementById('jumlah').value;

            // Send the form data to the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'BookCRUD.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Close the modal
                    var modal = document.getElementById('createModal');
                    modal.classList.remove('show');
                    modal.style.display = 'none';
                    // Refresh the page to show the updated data
                    location.reload();
                } else {
                    console.error('Request failed. Response:', xhr.responseText);
                }
            };
            xhr.onerror = function () {
                console.error('Request failed');
            };
            xhr.send('action=add&isbn=' + encodeURIComponent(isbn) + '&judul=' + encodeURIComponent(judul) + '&penulis=' + encodeURIComponent(penulis) + '&genre=' + encodeURIComponent(genre) + '&publisher=' + encodeURIComponent(publisher) + '&tahun=' + encodeURIComponent(tahun) + '&jumlah=' + encodeURIComponent(jumlah));
        });

        // Edit button click event handler
        document.querySelectorAll('.btn-primary').forEach(button => {
            button.addEventListener('click', function (event) {
                var isbn = button.getAttribute('data-isbn');
                var judul = button.getAttribute('data-judul');
                var penulis = button.getAttribute('data-penulis');
                var genre = button.getAttribute('data-genre');
                var publisher = button.getAttribute('data-publisher');
                var tahun = button.getAttribute('data-tahun');
                var jumlah = button.getAttribute('data-jumlah');
                var bookId = button.getAttribute('data-book-id');

                // Populate the form fields with the book data
                document.getElementById('editModal').querySelector('#isbn').value = isbn;
                document.getElementById('editModal').querySelector('#judul').value = judul;
                document.getElementById('editModal').querySelector('#penulis').value = penulis;
                document.getElementById('editModal').querySelector('#genre').value = genre;
                document.getElementById('editModal').querySelector('#publisher').value = publisher;
                document.getElementById('editModal').querySelector('#tahun').value = tahun;
                document.getElementById('editModal').querySelector('#jumlah').value = jumlah;
                document.getElementById('editModal').setAttribute('data-book-id', bookId);
            });
        });

        // Edit form submission handler
        document.getElementById('editForm').addEventListener('submit', function (event) {
            event.preventDefault();
            var bookId = document.getElementById('editModal').getAttribute('data-book-id');
            var formData = new FormData(this);
            formData.append('action', 'edit');
            formData.append('bookId', bookId);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'BookCRUD.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    location.reload();
                }
            };
            xhr.send(formData);
        });

        // Delete button click handler
        document.getElementById('deleteButton').addEventListener('click', function () {
            var bookId = document.getElementById('deleteModal').getAttribute('data-book-id');
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'BookCRUD.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    location.reload();
                }
            };
            xhr.send('action=delete&bookId=' + encodeURIComponent(bookId));
        });
    </script>
</body>