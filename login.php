<?php
session_start();
include('database.php');

header('Content-Type: application/json');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Memastikan metode HTTP adalah POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['success' => false, 'message' => 'Metode tidak diizinkan']);
    exit();
}

// Mendapatkan data dari form
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Validasi input
if (empty($username) || empty($password)) {
    echo json_encode(['success' => false, 'message' => 'Username dan password harus diisi!']);
    exit();
}

// Membersihkan input untuk mencegah serangan XSS
$username = htmlspecialchars($username);
$password = htmlspecialchars($password);

// Mengecek pengguna di database
$stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Kesalahan dalam persiapan statement!']);
    error_log('Kesalahan dalam persiapan statement: ' . $conn->error);
    exit();
}
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $dbUsername, $dbPassword, $role);
    $stmt->fetch();

    // Memverifikasi password
    if (password_verify($password, $dbPassword)) {
        // Menyimpan informasi pengguna dalam sesi
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $dbUsername;
        $_SESSION['role'] = $role;

        // Mengarahkan ke halaman sesuai peran
        $redirect = ($role === 'admin') ? 'dashboard.php' : 'index.html';
        echo json_encode(['success' => true, 'redirect' => $redirect]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Password salah!']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Username tidak ditemukan!']);
}

// Memastikan statement dan koneksi ditutup dengan benar
$stmt->close();
$conn->close();
?>
