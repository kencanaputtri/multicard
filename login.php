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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Split-Screen Login</title>
    <link rel="stylesheet" type="text/css" href="log_in.css">
</head>
<body style="display: flex; flex-direction: column;">
    <?php include "layout/header.html"?>
    <div class="loginform">
            <h3>Welcome Back!</h3>
            <i><?= $login_message ?></i>
            <form action="login.php" method="POST">
                <table>
                    <tr>
                        <td><input type="text" placeholder="username" name="username" /></td>
                    </tr>
		            </tr>
			            <td><input type="password" placeholder="password" name="password" /></td>
		            </tr>
		            <tr>
			            <td colspan="2"><button type="submit" name="login">MASUK SEKARANG</button></td>
		            </tr>
	            </table>
            </form>        
    </div>
    <footer>
    <?php include "layout/footer.html"?>
</footer>
</body>
</html>
