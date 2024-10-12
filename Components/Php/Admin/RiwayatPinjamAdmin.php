<?php
    include '../../Connection/DBConnection.php';
    include '../../Php/Admin/DeleteHistory.php';
?>
<?php
session_start();
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
                        <a class="nav-link" href="HomeAdminLay.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="RegisterBook.php">Penambahan Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="RiwayatPinjamAdmin.php">Riwayat Peminjaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../User/HomeLay.php">LogOut</a>
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
    <?php
        // Query to retrieve data from peminjaman table
        $query = "SELECT * FROM peminjaman";
        $result = mysqli_query($con, $query);

        // Check if there are any results
        if (mysqli_num_rows($result) > 0) {
            // Display the data in a table
            ?>
            <div class="container mt-5">
                <h2 class="text-center">Riwayat Peminjaman</h2>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ISBN</th>
                            <th>Username</th>
                            <th>Jumlah Pinjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= $row['isbn'] ?></td>
                            <td><?= $row['username'] ?></td>
                            <td><?= $row['jumlah_pinjam'] ?></td>
                            <td><?= $row['tanggal_pinjam'] ?></td>
                            <td><?= $row['tanggal_kembali'] ?></td>
                            <td><?= $row['status'] ?></td>
                            <td>
                                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php
        } else {
            echo "<div class='alert alert-info d-flex justify-content-center align-items-center' style='height: 100vh; background-color:#FC5D8C; color: black; font-size: larger;'>
                    <p>No Data Found.</p>
                </div>";
                echo "<div class='alert alert-info d-flex justify-content-center align-items-center' style='height: 100vh; background-color:#FC5D8C; color: black; font-size: larger;'>
                    <p>$message</p>
                </div>";
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm /@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>