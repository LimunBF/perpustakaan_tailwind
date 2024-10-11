<?php
include '../../Connection/DBConnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $email = $_POST['emailAddress'];
    $phoneNumber = $_POST['phoneNumber'];

    $username = $firstName . ' ' . $lastName;

    if (empty($username) || empty($gender) || empty($email) || empty($phoneNumber)) {
        $message = "Please fill in all the required fields.";
    } else {
        $query = "INSERT INTO users (username, gender, email, telephone_number) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssi", $username, $gender, $email, $phoneNumber);

            try {
                mysqli_stmt_execute($stmt);

                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    $message = "Data inserted successfully!";
                } else {
                    $message = "Error inserting data: " . mysqli_stmt_error($stmt);
                }
            } catch (mysqli_sql_exception $e) {
                $message = "Error: " . $e->getMessage();
                if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                    $message = "Email already exists in our database. Please try a different email.";
                }
            }

            mysqli_stmt_close($stmt);
        } else {
            $message = "Error preparing query: " . mysqli_error($con);
        }
    }
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
    <link rel="stylesheet" href="/perpustakaan_tailwind/Components/Css/Layout.css?v=1.2">
    <link rel="stylesheet" href="/perpustakaan_tailwind/Components/Css/Signup.css?v=1.2">
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
                        <a class="nav-link" href="HomeLay.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Peminjaman.php">Peminjaman Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="RiwayatPinjam.php">Riwayat Peminjaman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="RegistrasiUser.php">Registrasi User</a>
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
    <div class="container py-5">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                    <?php if (isset($message)) { ?>
                        <div class="alert alert-<?php echo (strpos($message, 'successfully') !== false) ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
                            <?php echo $message; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Form Registrasi</h3>
                        <form action="registrasiUser.php" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="firstName">Nama Depan</label>
                                        <input type="text" id="firstName" name="firstName" class="form-control form-control-lg" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="lastName">Nama Belakang</label>
                                        <input type="text" id="lastName" name="lastName" class="form-control form-control-lg" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <h6 class="mb-2 pb-1">Gender: </h6>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="Cewek" checked />
                                        <label class="form-check-label" for="femaleGender">Cewek</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="maleGender" value="Cowok" />
                                        <label class="form-check-label" for="maleGender">Cowok</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4 pb-2">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="emailAddress">Email</label>
                                        <input type="email" id="emailAddress" name="emailAddress" class="form-control form-control-lg" />
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 pb-2">
                                    <div data-mdb-input-init class="form-outline">
                                        <label class="form-label" for="phoneNumber">Nomor Handphone</label>
                                        <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control form-control-lg" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 d-flex justify-content-start mt-4 pt-2 back">
                                    <input data-mdb-ripple-init class="btn btn-primary btn-lg btn-back" type="button" value="Back" />
                                </div>
                                <div class="col-md-6 d-flex mt-4 pt-2 submit">
                                    <input data-mdb-ripple-init class="btn btn-primary btn-lg btn-registrasi" type="submit" value="Registrasi" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm /@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>