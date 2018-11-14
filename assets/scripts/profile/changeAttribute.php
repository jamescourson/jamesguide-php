<?php
    // Authenticate user
    include '../../include/user.php';

    $user = new User($_GET['id']);

    if (!empty($_GET['avatar'])) {
        $user->avatar = $_GET['avatar'];
    }

    if (!empty($_GET['title'])) {
        $user->title = $_GET['title'];
    }
    
    // Connect to server
    $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');
    // Update user data
    $query = "UPDATE user_info SET avatar = '$user->avatar', title = '$user->title' WHERE user = '$user->username'";

    // Redirect if successful
    if (mysqli_query($conn, $query)) {
        header("Location: ../../pages/profile.php?id=" . $user->username);
    }

    mysqli_close($conn);
?>