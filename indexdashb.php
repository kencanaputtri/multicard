<!DOCTYPE html>
<html>
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
            background: #35A9DB;
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
            background-color: blue;
            color: white;
            text-decoration: none;
            padding: 5px 5px;
            border-radius: 5px;
        }

        a:hover{
            background-color: red;
        }
    </style>
</head>
<body>
    <?php
        // Auto refresh halaman web dalam 5 detik
        header("refresh: 5;");  
        
        $koneksi=mysqli_connect("localhost","root","","multicard") or die("Tidak bisa tersambung ke database");
        $sql="select * from logperangkat order by id DESC";

        $query=mysqli_query($koneksi, $sql);
    ?>

    <h1>Data RFID</h1>
    <table class="table1">
        <tr>
            <th>Nomor</th>
            <th>UID</th>
            <th>Waktu</th>
        </tr>

        <?php
            while($hasil=mysqli_fetch_array($query)){
        ?>
                <tr>
                    <td><?=$hasil["id"];?></td>
                    <td><?=$hasil["uidrfid"];?></td>
                    <td><?=$hasil["waktu"];?></td>
                </tr>
        <?php 
            } 
        ?>

    </table>
</body>
</html>    


