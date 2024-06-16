<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "multicard";
$db = mysqli_connect($hostname, $username, $password, $database_name);

$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($db->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Mendapatkan data dari NodeMCU
$card_id = $_POST["card_id"];
// Menyimpan data ke database
$sql = "INSERT INTO card (card_ID) VALUES ('".$card_id."')";

if ($db->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $db->error;
}

$db->close();
?>