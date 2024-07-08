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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Multicard</title>
    <link rel="stylesheet" type="text/css" href="login.css">
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
                            <h1>Welcome Back</h1>
                        </div>
                        <div class="login-form">
                            <input type="text" class="form-control" name="username" placeholder="Username">
            
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="#" id="keeploggedin">
                                <label class="form-check-label" for="flexCheckDefault">Keep me logged in</label>
                                <a href="#" class="text-decoration-none">Forgot Password</a>
                            </div>
                        </div>
                        <div class="button">
                            <button type="submit" name="login">MASUK SEKARANG</button>
                        </div>
                        <div class="signup">
                            <span>Don't have an account?</span>
                            <a href="register.php" class="text-decoration-none">Sign up for free</a>
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