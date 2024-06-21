<?php
session_start();
session_destroy();

// Mengarahkan ke halaman login setelah logout
header('Location: index.html');
exit();
?>
