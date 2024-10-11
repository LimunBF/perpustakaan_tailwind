<?php
    include '../../Connection/DBConnection.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/perpustakaan_tailwind/Components/Css/Layout.css?v=1.2">
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
                <ul class="navbar-nav mb-2 mb-lg-0 me-auto">
                    <li class="nav-item"> 
                        <a class="nav-link active" aria-current="page"  href="HomeLay.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Peminjaman.php">Peminjaman Buku</a>
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

    <!-- Content -->
    <div class="container-fluid pt-2">
        <div class="row">
            <div class="col-2">
                <div class="list-group">
                    <h2 class="text-center pb-2" style="background-color:white; color: black;">GENRE</h2>
                    <?php
                        $sql = "SELECT DISTINCT GENRE FROM books";
                        $result = mysqli_query($con, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <a href="#" class="list-group-item list-group-item-action" onclick="filterBooksByGenre('<?php echo $row['GENRE']; ?>')"><?php echo $row['GENRE']; ?></a>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="col-10">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ISBN</th>
                            <th scope="col">JUDUL</th>
                            <th scope="col">GENRE</th>
                            <th scope="col">PENULIS</th>
                            <th scope="col">PUBLISHER</th>
                            <th scope="col">TAHUN</th>
                            <th scope="col">JUMLAH</th>
                        </tr>
                    </thead>
                    <tbody id="book-list">
                        <?php
                            $sql = "SELECT * FROM books";
                            $result = mysqli_query($con, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['ISBN']; ?></td>
                            <td><?php echo $row['JUDUL']; ?></td>
                            <td><?php echo $row['GENRE']; ?></td>
                            <td><?php echo $row['PENULIS']; ?></td>
                            <td><?php echo $row['PUBLISHER']; ?></td>
                            <td><?php echo $row['TAHUN']; ?></td>
                            <td><?php echo $row['JUMLAH']; ?></td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        function filterBooksByGenre(genre) {
            var bookList = document.getElementById('book-list');

            bookList.innerHTML = '';

            <?php
                $sql = "SELECT * FROM books";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
            ?>
            if ('<?php echo $row['GENRE']; ?>' === genre) {
                var row = document.createElement('tr');

                var isbnCell = document.createElement('td');
                isbnCell.textContent = '<?php echo $row['ISBN']; ?>';

                var judulCell = document.createElement('td');
                judulCell.textContent = '<?php echo $row['JUDUL']; ?>';

                var genreCell = document.createElement('td');
                genreCell.textContent = '<?php echo $row['GENRE']; ?>';

                var penulisCell = document.createElement('td');
                penulisCell.textContent = '<?php echo $row['PENULIS']; ?>';

                var publisherCell = document.createElement('td');
                publisherCell.textContent = '<?php echo $row['PUBLISHER']; ?>';

                var tahunCell = document.createElement('td');
                tahunCell.textContent = '<?php echo $row['TAHUN']; ?>';

                var jumlahCell = document.createElement('td');
                jumlahCell.textContent = '<?php echo $row['JUMLAH']; ?>';

                row.appendChild(isbnCell);
                row.appendChild(judulCell);
                row.appendChild(genreCell);
                row.appendChild(penulisCell);
                row.appendChild(publisherCell);
                row.appendChild(tahunCell);
                row.appendChild(jumlahCell);

                bookList.appendChild(row);
            }
            <?php
                    }
                }
            ?>
        }
    </script>

</body>

</html>