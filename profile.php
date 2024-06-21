<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // User is not logged in, redirect to login page
    header('Location: login.html');
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your CSS file here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="profile.php" id="profileButton"><?php echo htmlspecialchars($username); ?></a></li>
                <!-- Add other navigation links as needed -->
            </ul>
        </nav>
    </header>
    
    <main>
        <h1>Welcome, <?php echo htmlspecialchars($username); ?></h1>
        <p>This is your profile page.</p>
        <!-- Add more profile details as needed -->
    </main>

    <footer>
        <p>&copy; 2024 Your Website</p>
    </footer>

    <script>
        $(document).ready(function() {
            $('#profileButton').click(function(e) {
                e.preventDefault();
                // Show profile dropdown menu or perform other actions
                console.log('Profile button clicked');
            });
        });
    </script>
</body>
</html>
