<?php
session_start();
include 'database.php'; // Ubah sesuai dengan nama file koneksi database Anda

$response = array('success' => false, 'message' => 'Terjadi kesalahan.');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash password menggunakan password_hash
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memeriksa apakah username sudah ada
    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Jika username sudah ada
        $response['message'] = 'Username sudah digunakan. Silakan gunakan username lain.';
    } else {
        // Jika username belum ada, lakukan proses pendaftaran
        $query = "INSERT INTO users (nama, username, password, role) VALUES ('$nama', '$username', '$hashed_password', 'user')";

        if (mysqli_query($conn, $query)) {
            $response['success'] = true;
            $response['message'] = 'Registrasi berhasil!';
        } else {
            $response['message'] = 'Error: ' . mysqli_error($conn);
        }
    }
} else {
    $response['message'] = 'Metode permintaan tidak valid.';
}

// Mengirim respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
