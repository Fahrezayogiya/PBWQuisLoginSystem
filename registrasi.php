<?php
require 'function.php';

if( isset($_POST["register"]) ) {

    if( registrasi($_POST) > 0 ) {
        echo "<script>
              alert('User baru berhasil ditambahkan!');
              </script>";
    } else{
        echo mysqli_error($conn);
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
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
<br><br><br>
<div class="container mt-3 shadow-lg p-3 mb-5 bg-info rounded">
    <h1>Halaman Registrasi</h1>
    <form action="" method="post">
        <ul>
            <li>
                <div class="col-sm-11">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username yang anda inginkan">
                </div>
            </li>
            <br>
            <li>
                <div class="col-sm-11">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password yang anda inginkan">
                </div>
            </li>
            <br>
            <li>
                <div class="col-sm-11">
                    <label for="password2">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password2" id="password2" placeholder="Masukkan kembali password anda">
                </div>
            </li>
            <br>
            <li>
                <div class="d-grid gap-2 col-sm-11">
                    <button type="submit" class="btn btn-success" name="register">Register!</button>
                </div>
            </li>
            <br>
            <li>
                <label for="login">Sudah punya akun? Klik -></label>
                <a class="btn btn-primary" href="login.php" role="button">Login</a>
            </li>
        </ul>
    </form>
</div>
</body>
</html>