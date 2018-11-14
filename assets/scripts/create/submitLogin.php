<?php
    include "../include/user.php";
    session_start();

    $username = $_POST['user'];

    $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');

    $query = "SELECT pass FROM user_info WHERE user='$username'";
    $hashed = mysqli_fetch_array(mysqli_query($conn, $query), MYSQLI_ASSOC)['pass'];

    if (password_verify($_POST['pass'], $hashed)) {
        $query = "SELECT * FROM user_info WHERE user='$username'";

        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
        $rows = mysqli_num_rows($result);
    
        $query = "SELECT email FROM user_info WHERE user='$username'";
        $email = mysqli_fetch_array(mysqli_query($conn, $query), MYSQLI_NUM)[0];
    
        if ($rows == 1) {
            $_SESSION['user'] = new user($username);
            
            header("Location: ../index.php");
        }
    
        mysqli_close($conn);
    }
    else {
        header("Location: ../pages/login.php?invalid=1");
    }
?>