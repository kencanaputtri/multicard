<?php 
    session_start();
    if (isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header('location: index.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="dashboard.css">
</head>
<body>
    <?php include "layout/header.html" ?>
    <teks1_dashb>
        <h3>SELAMAT DATANG <?= $_SESSION["username"]?> </h3>
        <h4>Aktifitas Kartu</h4>
        <form action="dashboard.php" method="POST">
            <button type="submit" name="logout">logout</button>
        </form>
    </teks1_dashb>
    
    <?php include "layout/footer.html" ?>
</body>
</html>