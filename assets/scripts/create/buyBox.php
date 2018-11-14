<?php
    include 'auth.php';

    $id = $_GET['id'];

    $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');

    $query = "SELECT * FROM boxes WHERE id='$id'";
    $box = mysqli_fetch_assoc(mysqli_query($conn, $query));

    if ($user->bits >= $box['price']) {
        $price = $box['price'];
        
        mysqli_query($conn, "UPDATE user_info SET bits = bits - $price WHERE userID='$user->id'");
        mysqli_query($conn, "INSERT INTO owned_boxes (boxID, ownerID) VALUES ('$id', '$user->id')");

        header("Location: /pages/market/market.php?success=1");
    }
    else {
        header("Location: /pages/market/market.php?insufficient=1");
    }
?>