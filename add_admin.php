//
include 'database.php';

// Hash password admin123
$hashed_password = password_hash('admin123', PASSWORD_DEFAULT);

// Masukkan pengguna admin ke database
$query = "INSERT INTO users (nama, username, password, role) VALUES ('admin', 'admin', '$hashed_password', 'admin')";
if (mysqli_query($conn, $query)) {
    echo "Admin berhasil ditambahkan.";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
