<?php
    include 'auth.php';

    $t = $_GET['t'];
    $id = $_GET['id'];
    $redir = $id;

    $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');
    
    switch ($t) {
        case "t":
            $topic = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM topics WHERE id=$id"));
            $owner = $topic['owner'];

            // Update user's score
            mysqli_query($conn, "UPDATE user_info SET score = score + 10, bits = bits + 10 WHERE user='$owner'");

            // Update post's score
            mysqli_query($conn, "UPDATE topics SET score = score + 1 WHERE id=$id");
            break;
        case "r":
            $reply = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM replies WHERE id=$id"));
            $owner = $reply['owner'];

            // Update user's score
            mysqli_query($conn, "UPDATE user_info SET score = score + 5, bits = bits + 5 WHERE user='$owner'");

            // Update post's score
            mysqli_query($conn, "UPDATE replies SET score = score + 1 WHERE id=$id");

            // Update $redir for proper redirect
            $redir = $reply['parent'];
            break;
    }

    // Insert new vote into votes table
    mysqli_query($conn, "INSERT INTO votes (user, voteType, id) VALUES ('$user->username', '$t', $id)");

    // Redirect
    header("Location: ../pages/view/viewTopic.php?id=$redir");
?>