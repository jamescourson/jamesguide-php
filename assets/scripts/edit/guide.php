<?php
    include '../auth.php';

    $guideID = $_GET['id'];
    $newTitle = $_POST['title'];
    $newDesc = $_POST['desc'];

    $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');

    $query = "UPDATE guides SET title='$newTitle', `desc`='$newDesc' WHERE `id`='$guideID'";

    if (mysqli_query($conn, $query)) {
        header("Location: /");
    }
?>