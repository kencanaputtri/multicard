<?php 
    include "service/database.php";
    session_start();
    $register_message = "";

    if (isset($_SESSION["is_login"])) {
        header("location: dashboard.php");
    }

    if(isset($_POST["register"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $hash_password = hash("sha256", $password);
        $cardid = $_POST["cardid"];

        $koneksi = mysqli_connect("localhost:8111","root","","multicard") or die("Tidak bisa tersambung ke database");
        $sqlcek = "SELECT * FROM users WHERE username='$username' OR uidrfid='$cardid'";
        $query=mysqli_query($koneksi, $sqlcek);
        $count= mysqli_num_rows($query);
        if($count > 0){
            $register_message = "Username ".$username." atau card id ".$cardid." sudah terdaftar, silahkan gunakan username atau card id lain";
        }else{
            try{
                $sql = "INSERT INTO users (username,pass,uidrfid) VALUES('$username', '$hash_password','$cardid')";
    
                if($db->query($sql)){
                    $register_message = "daftar akun BERHASIL, silahkan LogIn";
                }else {
                    $register_message = "daftar akun GAGAL, silahkan coba beberapa saat";
                }
            }catch (mysqli_sql_exception) {
                $register_message = "username sudah ada";
            }
            $db->close();
        }
    }
    $uidrfid = "";
    if(isset($_GET["uidrfid"])){
        $uidrfid = $_GET["uidrfid"];
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Multicard</title>
    <link rel="stylesheet" type="text/css" href="register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">    
</head>
<body>
        <section class="login d-flex">
            <div class="login-left w-50 h-100">
                <div class="row">
                    <div class="col-6">
                        <div class="header">
                            <h1>Welcome</h1>
                        </div>
                        <div class="login-form">
                            <input type="text" class="form-control" name="username" placeholder="Username">
            
                            <input type="password" class="form-control" name="password" placeholder="Password">

                            <input type="text" class="form-control" placeholder="card id" name="cardid" value="<?php echo $uidrfid; ?>"/>
                        </div>
                        <div class="button">
                            <button type="submit" name="register">DAFTAR SEKARANG</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="login-right w-50 h-100">
                <img src="image/icon.png" alt="Deskripsi gambar" style="position: fixed; align-items: center ; top: 35%; left: 65%; width: 25%;">
            </div>  
        </section>
    </body>
    </html> 



