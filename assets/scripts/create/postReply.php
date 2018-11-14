<?php
    include '../auth.php';
    
    $content = $_POST['content'];

    if (!empty($content)) {
        $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');
        
        $date = date('m/d/Y-h:i:s');
        $parent = $_GET['parent'];
        $sql = "INSERT INTO replies (content, `owner`, postDate, parent) VALUES ('$content', '$user->username', '$date', '$parent')";
    
        if (mysqli_query($conn, $sql)) {
            // Increment replies in parent forum
            $parentTopic = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM topics WHERE id='$parent'"))['parent'];
            $parentForum = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM forums WHERE id='$parentTopic'"))['id'];
            if (mysqli_query($conn, "UPDATE forums SET replies = replies + 1 WHERE id='$parentForum'")) {
                header("Location: ../../pages/view/viewTopic.php?id=" . $parent);
            }
        }
        else {
            echo 'Error: ' . $conn->error;
        }
    
        mysqli_close($conn);
    }
    else {
        header("Location: ../../pages/post/reply.php?empty=1");
    }
?>