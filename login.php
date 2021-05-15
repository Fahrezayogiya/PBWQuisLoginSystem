<?php
session_start();
require 'function.php';

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    if( $key === hash('sha256', $row['username']) ) {
        $_SESSION['login'] = true;
    }
    
}

if( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}


if( isset($_POST["login"]) ) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // Cek username
    if( mysqli_num_rows($result) ===1 ) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row["password"]) ) {
            // set session
            $_SESSION["login"] = true;

            // cek remember me
            if( isset($_POST['remember']) ) {
                // buat cookie

                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header("Location: index.php");
            exit;
        }
    }

    $error = true;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
        li {
            display: block;
        }

        h1 {
            text-align: center;
            color: white;
        }

        label {
            color: white;
        }

        li, p, h1, h3{
            font-family: poppins;
        }

        p {
            text-align: center;
        }
    </style>
</head>
<body>

    <br><br><br><br>
    <div class="container mt-3 shadow-lg p-3 mb-5 bg-info rounded">
    <h1>Halaman Login</h1>
        <form action="" method="post">
            <ul>
                <li>
                    <div class="col-sm-11">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username anda">
                    </div>
                </li>
                <br>
                <li>
                    <div class="col-sm-11">
                        <label for="password" form="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password anda">
                    </div>
                </li>
                <li>
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember Me</label>
                </li>
                <br>
                <li>
                    <div class="d-grid gap-2 col-sm-11">
                        <button type="submit" class="btn btn-success" name="login">Login</button>
                    </div>
                </li>
                <br>
                <li>
                    <label for="login">Belum punya akun? Klik -></label>
                    <a class="btn btn-primary" href="registrasi.php" role="button">Register</a>
                </li>
            </ul>
        </form>
        <?php if( isset($error) ) : ?>
        <p style="color: red; font-style: italic;">Username / Password salah</p>
        <?php endif; ?>
    </div>
</body>
</html>