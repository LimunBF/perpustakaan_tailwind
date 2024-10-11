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
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="RegisterBook.php">Penambahan Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/perpustakaan_tailwind/Components/Php/Login.php">Riwayat Peminjaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/perpustakaan_tailwind/Components/Php/LoginAdmin.php">Login Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/perpustakaan_tailwind/Components/Php/User/HomeLay.php">Landing Page</a>
                    </li>
                </ul>
                <span class="navbar-text pe-4 font-nav-admin" style="font-size: large;">
                    Admin: 
                    <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?>
                </span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <section class="container-fluid pt-3">
        <div class="row justify-content-center">
            <?php
            include '../../Connection/DBConnection.php';

            $stmt = $con->prepare("SELECT DISTINCT GENRE FROM books");
            $stmt->execute();
            $result = $stmt->get_result();
            $genres = array();

            while ($row = $result->fetch_assoc()) {
                $genres[] = $row['GENRE'];
            }

            foreach ($genres as $genre) {
            ?>
                <div class="col-md-6 mb-4">
                    <div class="bg-light p-3 rounded">
                        <h5 class="text-center genre-color"  ><?php echo $genre; ?></h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">ISBN Index</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Penulis</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch books by genre
                                $stmt = $con->prepare("SELECT * FROM books WHERE GENRE = ? LIMIT 10");
                                $stmt->bind_param("s", $genre);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $row_num = 1;

                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $row_num++; ?></th>
                                        <td><?php echo $row['ISBN']; ?></td>
                                        <td><?php echo $row['JUDUL']; ?></td>
                                        <td><?php echo $row['PENULIS']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>
