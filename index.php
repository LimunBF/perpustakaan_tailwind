<?php 

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'library');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    clifford: '#da373d',
                },
                fontFamily: {
                    sans: ['Graphik', 'Helvetica']
                },
                extend: {
                    spacing: {
                        '8xl': '96rem',
                        '9xl': '128rem',
                    },
                    borderRadius: {
                        '4xl': '2rem',
                    }
                }
            }
        }
    }
    </script>

    <title>Home</title>
    <style>
    body {
        background-image: url(imgs/bg.jpg);
        background-size: cover;
        background-position: center;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    h1 {
        text-align: center;
        background: rgba(0, 0, 0, 0.4);
        color: azure;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .btn-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .btn-custom {
        margin: 10px;
        padding: 15px 30px;
        font-size: 18px;
        border-radius: 5px;
        width: 200px;
        text-align: center;
    }
    </style>
</head>

<body>
    <h1>Welcome to Library Management System</h1>

    <div class="btn-container">
        <a href="Components/Php/Signup.php" class="btn btn-primary btn-custom">Members</a>
        <a href="Components/Php/Login.php" class="btn btn-primary btn-custom">Books</a>
        <a href="Components/Php/User/HomeLay.php" class="btn btn-primary btn-custom">USER</a>
        <a href="return.php" class="btn btn-primary btn-custom">f</a>
        <a href="renew.php" class="btn btn-primary btn-custom">Renew Membership</a>
    </div>
</body>

</html>