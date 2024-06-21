<?php
include 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM film WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: 'Record has been deleted.'
            }).then(function() {
                window.location = 'dashboard.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error deleting record: " . $conn->error . "'
            }).then(function() {
                window.location = 'dashboard.php';
            });
        </script>";
    }

    $conn->close();
}
?>
