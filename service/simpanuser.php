<?php
$koneksi = mysqli_connect("localhost","root","","multicard") or die("Tidak bisa tersambung ke database");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nama"])) {
        $nama = $_POST["nama"];
        $pass = $_POST["password"];
        $rfid = $_POST["rfid"];
        $hash_password = hash("sha256", $pass);
        $sql = "INSERT INTO users (username,pass,uidrfid) VALUES('$nama', '$hash_password','$rfid')";
        $query = mysqli_query($koneksi, $sql);
        if($query){
            echo "Berhasil simpan data";
        }else{
            echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
        }
    }
}

?>