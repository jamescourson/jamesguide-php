<?php
    include '../auth.php';

    $forumID = $_GET['id'];
    $newTitle = $_POST['title'];
    $newDesc = $_POST['desc'];

    $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');

    $query = "UPDATE forums SET title='$newTitle', `desc`='$newDesc' WHERE `id`='$forumID'";

    if (mysqli_query($conn, $query)) {
        header("Location: /");
    }
?>