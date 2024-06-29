<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kirim Data menggunakan metode GET</title>
    <style>
        .table1 {
        font-family: sans-serif;
        color: #444;
        border-collapse: collapse;
        width: 70%;
        border: 1px solid #f2f5f7;
        }
    
        .table1 tr th{
            background: #74512D;
            color: #fff;
            font-weight: normal;
        }
    
        .table1, th, td {
            padding: 20px 20px;
            text-align: center;
        }
    
        .table1 tr:hover {
            background-color:#cccccc;
        }
    
        .table1 tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        
        a{
            background-color: #543310;
            color: white;
            text-decoration: none;
            padding: 5px 5px;
            border-radius: 5px;
        }

        a:hover{
            background-color: red;
        }
    </style> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../dashboard.css">
    <link rel="stylesheet" type="text/css" href="../index.css">
</head>
</html>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        
        // Mendapatkan data menggunakan $_GET
        $uidrfid = htmlspecialchars($_GET['uidrfid']);
        $tempat = htmlspecialchars($_GET['tempat']);
        
        // Menampilan data dihalaman web getdata.php


        $koneksi = mysqli_connect("localhost:8111","root","","multicard") or die("Tidak bisa tersambung ke database");
        $cari="SELECT * FROM users WHERE uidrfid=$uidrfid";
        $query=mysqli_query($koneksi, $cari);
        $count= mysqli_num_rows($query);
        
        if ($count> 0) {
            $sql = "INSERT INTO logperangkat(uidrfid,nama_tempat) values('$uidrfid','$tempat')";
            $query = mysqli_query($koneksi, $sql);
            echo"Berhasil menyimpan log";
        }else{
            ?>
            <h5>Kartu Anda belum terdaftar</h5>
            <p>silahkan daftar terlebih dahulu</p>
            <a href="../register.php?uidrfid=<?php echo $uidrfid ?>">Daftar</a>
            <?php
        }
    }
?>

<body>
<?php include "../layout/footer.html" ?>
</body>