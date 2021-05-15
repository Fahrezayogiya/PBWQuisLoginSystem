<?php 
session_start();

if( !isset($_SESSION["login"]) ) {

    header("Location: login.php");
    exit;
    
}

function curl($url){ //pembuatan fungsi cURL
    $ch = curl_init(); //melakukan inisiasi 
    curl_setopt($ch, CURLOPT_URL, $url); // memberikan nilai options seperti alamat URL destinasi, format hasil, header dan lainnya
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $output = curl_exec($ch);  // melakukan HTTP Request sesuai dengan options yang diberikan dan mengeksekusinya dengan fungsi
    curl_close($ch);  //setelah selesai mengeksekusi cURL sudah tidak digunakan lagi dan ditutup dengan fungsi
    return $output; //menghasilkan output cURL
}

$curl = curl("https://sandbox.rachmat.id/curl/get/"); //alamat http yang diambil 

// mengubah JSON menjadi array
$data = json_decode($curl, TRUE);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tugas PWEB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
        h1, th {
            font-family: poppins;
        }
    </style>
</head>
    <body class="p-3 mb-2 text-white">
        <div class="container mt-3 shadow-lg p-3 mb-5 bg-info rounded">
            <h1 style="text-align:center;">Jadwal Sepak Bola</h1>
            <br>
            <a href="logout.php" type="button" class="btn btn-danger">Logout</a>
            <br><br>
            <div class="table-responsive">
                <table class="table table-info table-hover">
                    <tr>
                        <th> Jadwal </th>
                        <th> Liga </th>
                        <th> Channel TV </th>
                    </tr>
                    <?php
                    // URL TARGET
                    $url = 'http://blog.kristiandes.com/grabbing-jadwal-bola-hari-ini/';
                    //end
                    // get / mengambil content berdasarkan url yang akan di curi datanya
                    $content = file_get_contents($url);
                    //
                    // STEP 1 mengambil syntax pembuka
                    $first_step = explode( "<table border='1' class='mainhati'>" , $content );
                    //
                    // STEP 2 mengambil syntax penutup
                    $second_step = explode("</table>" , $first_step[1] );
                    //
                    // Replace syntax </tbody> dengan </tbody></table>
                    $text1 = $second_step[0];
                    //Tampilkan 
                    echo $text1;
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>