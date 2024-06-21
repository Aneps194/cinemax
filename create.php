<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $director = $_POST['director'];
    $release_year = $_POST['release_year'];
    $synopsis = $_POST['synopsis'];
    $video_path = $_POST['video_path'];

    $sql = "INSERT INTO film (title, genre, director, release_year, synopsis, video_path) VALUES ('$title', '$genre', '$director', '$release_year', '$synopsis', '$video_path')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Film</title>
</head>
<body>
    <h2>Create Film</h2>
    <form method="post" action="">
        <label>Title:</label><input type="text" name="title" required><br>
        <label>Genre:</label><input type="text" name="genre" required><br>
        <label>Director:</label><input type="text" name="director" required><br>
        <label>Release Year:</label><input type="number" name="release_year" required><br>
        <label>Synopsis:</label><textarea name="synopsis" required></textarea><br>
        <label>Video Path:</label><input type="text" name="video_path" required><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
