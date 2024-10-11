<?php
    session_start();
    include '../Connection/DBConnection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $con->prepare("SELECT password FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($password);
            $stmt->fetch();
        
            $input_password = $_POST['password'];
        
            if ($input_password == $password) {
                $error = "Password is correct!";
                // Login successful, redirect to home page
                $_SESSION['username'] = $username;
                $error = "Login Succesful.";
                header('Location: http://localhost/perpustakaan_tailwind/Components/Php/Admin/HomeAdminLay.php');
                exit();
            } else {
                $error = "Password is incorrect.";
            }
        } else {
            $error = "No user found with that username.";
        }

        $stmt->close();
        $con->close(); 
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    <link rel="stylesheet" href="/perpustakaan_tailwind/Components/Css/Signup.css">
</head>

<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-7">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 text-center">Silahkan Login</h3>
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" name="username" id="username"
                                                class="form-control form-control-lg" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" name="password" id="password"
                                                class="form-control form-control-lg" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 pt-2 d-flex justify-content-center">
                                    <button class="btn btn-primary btn-lg" type="submit">Login</button>
                                </div>
                            </form>
                            <div class="pt-4">
                                <?php
                                    if (isset($error)) {
                                        echo "<div class='alert alert-danger' role='alert'>$error</div>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>