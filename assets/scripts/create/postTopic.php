<?php
    include '../auth.php';
    
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (!empty($title) && !empty($content)) {
        $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');
        
        $date = date('m/d/Y-h:i:s');
        $parent = $_GET['parent'];
        $sql = "INSERT INTO topics (title, content, parent, `owner`, postDate) VALUES ('$title', '$content', '$parent', '$user->username', '$date')";

        if (mysqli_query($conn, $sql)) {
            if (mysqli_query($conn, "UPDATE forums SET topics = topics + 1 WHERE id='$parent'")) {
                header("Location: ../../pages/view/viewForum.php?id=" . $parent);
            }
        }
        else {
            echo 'Error: ' . $conn->error;
        }
    
        mysqli_close($conn);
    }
    else {
        header("Location: ../../pages/post/topic.php?empty=1");
    }
?>