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

        $koneksi = mysqli_connect("localhost","root","","multicard") or die("Tidak bisa tersambung ke database");
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
            <input type="text" placeholder="cardid" name="cardid" value="<?php echo $uidrfid; ?>"/><br>
            <button type = "submit" name="register">DAFTAR SEKARANG</button>
        <br>
        </form>
    </inputan>
    <?php include "layout/footer.html"?>
</body>
</html>