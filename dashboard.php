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
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <form action="dataget.php" method="get"></form>
</head>
<body>
    <?php
        // Auto refresh halaman web dalam 5 detik
        header("refresh: 5;");  
        $uidrfid=$_SESSION['rfid'];
        $koneksi=mysqli_connect("localhost:8111","root","","multicard") or die("Tidak bisa tersambung ke database");
        $sql="select * from logperangkat WHERE uidrfid=$uidrfid order by id DESC";

        $query=mysqli_query($koneksi, $sql);
    ?>
    <teks1_dashb>
        <h2>JAVA</h2>
        <h3>HALLO <?= $_SESSION["username"]?> </h3>
        <h4>Aktifitas Kartu</h4>
        <table class="table1">
        <tr>
            <th>Nomor</th>
            <th>UID</th>
            <th>Waktu</th>
            <th>Tempat</th>
        </tr>

        <?php
            while($hasil=mysqli_fetch_array($query)){
        ?>
                <tr>
                    <td><?=$hasil["id"];?></td>
                    <td><?=$hasil["uidrfid"];?></td>
                    <td><?=$hasil["waktu"];?></td>
                    <td><?=$hasil["nama_tempat"];?></td>
                </tr>
        <?php 
            } 
        ?>
        </table>
        <logout>
            <div class="logout-butt">
                <a href="logout.php">Logout</a>
            </div>
        </logout>
    </teks1_dashb>
    <?php include "layout/footer.html" ?>
</body>
<img src="image/bgdash.jpg" alt="Deskripsi gambar" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;">
</html>

