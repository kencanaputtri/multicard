<?php
    include "service/database.php";
    session_start();

    $login_message = "";

    if (isset($_SESSION["is_login"])) {
        header("location: dashboard.php");
    }

    if (isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hash_password = hash("sha256", $password);

        $sql = "SELECT * FROM users 
        WHERE username='$username' AND pass='$hash_password' 
        ";
        $result = $db->query($sql);
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $_SESSION["username"] = $data["username"];
            $_SESSION["uid"] = $data["user_ID"];
            $_SESSION["rfid"] = $data["uidrfid"];
            $_SESSION["is_login"] = true;
            
            header("location: dashboard.php");
        }else {
            $login_message ="data tidak ditemukan";
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
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body style="display: flex; flex-direction: column;">
    <?php include "layout/header.html"?>
    <div class="login-form">
            <h3>MASUK</h3>
            <i><?= $login_message ?></i>
            <form action="login.php" method="POST">
                <input type="text" placeholder="username" name="username"/>
                <input type="password" placeholder="password" name="password"/>
                <buttl>
                    <button type = "submit" name="login">MASUK SEKARANG</button>
                </buttl>
            </form>
    </div>
    <footer>
    <?php include "layout/footer.html"?>
</footer>
</body>
</html>

