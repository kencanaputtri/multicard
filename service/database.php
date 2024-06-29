<?php 
$hostname = "localhost:8111";
$username = "root";
$password = "";
$database_name = "multicard";
$db = mysqli_connect($hostname, $username, $password, $database_name);

// Mengecek koneksi
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}