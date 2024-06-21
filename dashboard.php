<?php
include 'database.php';
$sql = "SELECT * FROM film";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

//create
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $director = $_POST['director'];
    $release_year = $_POST['release_year'];
    $synopsis = $_POST['synopsis'];
    $video_path = $_POST['video_path'];

    $sql = "INSERT INTO film (title, genre, director, release_year, synopsis, video_path) VALUES ('$title', '$genre', '$director', '$release_year', '$synopsis', '$video_path')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'New record created successfully'
            }).then(function() {
                window.location = 'dashboard.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error: " . $sql . "<br>" . $conn->error . "'
            }).then(function() {
                window.location = 'dashboard.php';
            });
        </script>";
    }

    $conn->close();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>CinemaXjoss</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="./assets/images/logo-no-background.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <!-- Navbar -->
    <header class="header" data-header>
    <div class="container">

      <div class="overlay" data-overlay></div>

      <a href="./index.html" class="logo" style="display: flex; align-items: center;">
        <img src="./assets/images/logo-no-background.png" alt="CinemaXjoss Logo" style="height: 60px; margin-right: 10px;">
        <span style="color: hsla(57, 97%, 45%, 0.957); font-weight: bold; font-size: 1.5em;">CinemaXjoss</span>
      </a>
      
      <div class="header-actions">
    
        <button class="search-btn">
          <ion-icon name="search-outline"></ion-icon>
        </button>

        <div class="lang-wrapper">
          <label for="language">
            <ion-icon name="settings-outline" style="cursor:pointer;"></ion-icon>
          </label>

        </div>

      </div>

      <button class="menu-open-btn" data-menu-open-btn>
        <ion-icon name="reorder-two"></ion-icon>
      </button>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">

          <a href="./index.html" class="logo">
          </a>

          <button class="menu-close-btn" data-menu-close-btn>
            <ion-icon name="close-outline"></ion-icon>
          </button>

        </div>

        <ul class="navbar-list">

          <li>
            <a href="" class="navbar-link">Dashboard</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Film</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Pengguna</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Setting</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Support & Feedback</a>
          </li>

        </ul>

        <ul class="navbar-social-list">

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-pinterest"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>

        </ul>

      </nav>

    </div>
  </header>
    <!-- End of Navbar -->

    <div class="content">
        <!-- Create Film Form -->
        <div class="bottom-data">
            <div class="add">
                <div class="add-form">
                    <i class='bx bxs-add-to-queue'></i>
                    <h3>Create Film</h3>
                </div><br>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre:</label>
                        <input type="text" id="genre" name="genre" required>
                    </div>
                    <div class="form-group">
                        <label for="director">Director:</label>
                        <input type="text" id="director" name="director" required>
                    </div>
                    <div class="form-group">
                        <label for="release_year">Release Year:</label>
                        <input type="number" id="release_year" name="release_year" required>
                    </div>
                    <div class="form-group">
                        <label for="synopsis">Synopsis:</label>
                        <textarea id="synopsis" name="synopsis" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="video_path">Video Path:</label>
                        <input type="text" id="video_path" name="video_path" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </form>
            </div>
        </div>
        <!-- End of Create Film Form -->

        <!-- Read Table Film -->
        <div class="bottom-data">
            <div class="add">
                <div class="add-form">
                    <i class='bx bx-movie'></i>
                    <h3>List Films</h3>
                    <i class='bx bx-filter'></i>
                    <i class='bx bx-search'></i>
                </div><br>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Genre</th>
                            <th>Director</th>
                            <th>Release Year</th>
                            <th>Synopsis</th>
                            <th>Video Path</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['genre']; ?></td>
                                <td><?php echo $row['director']; ?></td>
                                <td><?php echo $row['release_year']; ?></td>
                                <td><?php echo $row['synopsis']; ?></td>
                                <td><?php echo $row['video_path']; ?></td>
                                <td>
                                    <a href="update.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn-delete">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End of Read Table Film -->
    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-brand-wrapper">
                    <a href="./index.html">
                        <span>CinemaXjoss</span>
                    </a>
                </div>
                <br>
                <div class="quicklink-wrapper">
                    <ul class="quicklink-list">
                        <li>
                            <a href="#" class="quicklink-link">Faq</a>
                        </li>
                        <li>
                            <a href="#" class="quicklink-link">Pusat Bantuan</a>
                        </li>
                        <li>
                            <a href="#" class="quicklink-link">Syarat Penggunaan</a>
                        </li>
                        <li>
                            <a href="#" class="quicklink-link">Privacy</a>
                        </li>
                    </ul>
                    <ul class="social-list">
                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-facebook"></ion-icon>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-twitter"></ion-icon>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-pinterest"></ion-icon>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="social-link">
                                <ion-icon name="logo-linkedin"></ion-icon>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p class="copyright">
                    &copy; 2024 <a href="#">anepsomeone</a>. All Rights Reserved
                </p>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

    <script src="./admin/script-dash.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
