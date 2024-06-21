<?php
include 'database.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $director = $_POST['director'];
    $release_year = $_POST['release_year'];
    $synopsis = $_POST['synopsis'];
    $video_path = $_POST['video_path'];

    $sql = "UPDATE film SET title='$title', genre='$genre', director='$director', release_year='$release_year', synopsis='$synopsis', video_path='$video_path' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header('Location: dashboard.php');
}

$sql = "SELECT * FROM film WHERE id=$id";
$result = $conn->query($sql);
$film = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Film</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="icon" href="./assets/images/logo-no-background.png" type="image/x-icon">

</head>
<body>
    <div class="content">
        <div class="bottom-data">
            <div class="add">
                <div class="add-form">
                    <i class='bx bxs-add-to-queue'></i>
                    <h3>Update Film</h3>
                </div><br>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" value="<?php echo $film['title']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre:</label>
                        <input type="text" id="genre" name="genre" value="<?php echo $film['genre']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="director">Director:</label>
                        <input type="text" id="director" name="director" value="<?php echo $film['director']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="release_year">Release Year:</label>
                        <input type="number" id="release_year" name="release_year" value="<?php echo $film['release_year']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="synopsis">Synopsis:</label>
                        <textarea id="synopsis" name="synopsis" required><?php echo $film['synopsis']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="video_path">Video Path:</label>
                        <input type="text" id="video_path" name="video_path" value="<?php echo $film['video_path']; ?>" required>
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

