<html>
    <head>
        <?php include '/include/header.php'; ?>
        <link rel="stylesheet" href="forum.css">
    </head>

    <div class="wrapper">
        <?php
            session_start();

            $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');
            $forumID = $_GET['id'];

            $query = "SELECT * FROM forums WHERE id='$forumID'";
            $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

            echo '<h1>' . $result['title'] . '</h1>';

            // Post button
            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];

                $guideID = $result['parent'];
                $query = "SELECT * FROM guides WHERE id=$guideID";
                $guide = mysqli_fetch_assoc(mysqli_query($conn, $query));
                $owner = $guide['owner'];

                echo '<form method="post" style="display:inline;" action="../post/topic.php?id=' . $forumID . '">';
                    echo '<button>Post to ' . $result['title'] . '</button>';
                echo '</form>';

                echo '&nbsp;';

                if ($owner == $user->username) {
                    echo '<form method="post" style="display:inline;" action="../edit/forum.php?id=' . $forumID . '">';
                        echo '<button>Edit</button><br><br>';
                    echo '</form>';
                }
            }

            $query = "SELECT * FROM topics WHERE parent='$forumID' ORDER BY id DESC";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                $parent = $row['id'];
                
                $replies = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM replies WHERE parent='$parent'"));

                echo '<div class="topic-listing">';
                    echo '<a href="viewTopic.php?id=' . $row['id'] . '" class="link topic-item topic-name">';
                        echo $row['title'];
                    echo '</a>';

                    echo '<div class="topic-item topic-score">';
                        echo 'Score: ' . $row['score'];
                    echo '</div>';

                    echo '<a href="/pages/profile.php?id=' . $row['owner'] . '" class="link topic-item topic-owner">';
                        echo $row['owner'];
                    echo '</a>';

                    echo '<div class="topic-item topic-replies">';
                        echo $replies . ' replies';
                    echo '</div>';
                echo '</div>';
            }
        ?>
    </div>
</html>
