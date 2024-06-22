<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "multicard";
$db = mysqli_connect($hostname, $username, $password, $database_name);

// Mengecek koneksi
if ($db->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}