<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cinemax_db";

// Buat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
