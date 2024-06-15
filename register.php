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

        try{
            $sql = "INSERT INTO users (username, pass)VALUES('$username', '$hash_password')";

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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<F, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
    <?php include "layout/header.html"?>
    <inputan>
    <h3>DAFTAR</h3>
    <i><?=$register_message ?></i>
        <form action="register.php" method="POST">
            <input type="text" placeholder="username" name="username"/>
            <input type="password" placeholder="password" name="password"/>
            <button type = "submit" name="register">DAFTAR SEKARANG</button>
        </form>
    </inputan>
    <?php include "layout/footer.html"?>
</body>
</html>