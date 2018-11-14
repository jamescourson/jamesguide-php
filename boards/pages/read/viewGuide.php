<html>
    <head>
        <?php include '/include/header.php'; ?>
        <link rel="stylesheet" href="forum.css">
    </head>

    <body>
        <div class="wrapper">
            <table class="forum-table">
                <?php
                    $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');
                    $guideID = $_GET['id'];

                    $query = "SELECT * FROM guides WHERE id='$guideID'";
                    $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

                    echo '<h1>' . $result['title'] . '</h1>';

                    // Post button
                    if (isset($_SESSION['user'])) {
                        $user = $_SESSION['user'];

                        // Determine owner of guide
                        $query = "SELECT * FROM guides WHERE id='$guideID'";
                        $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

                        if ($user->username == $result['owner']) {
                            echo '<form method="post" action="../post/forum.php?id=' . $guideID . '">';
                                echo '<button>Add new forum (100 bits)</button>';
                            echo '</form>';

                            echo '&nbsp;';

                            echo '<form method="post" action="/pages/edit/guide.php?id=' . $guideID . '">';
                                echo '<button>Edit</button><br><br>';
                            echo '</form>';
                        }
                    }

                    $query = "SELECT * FROM forums WHERE parent='$guideID'";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="forum-listing">';
                            echo '<a href="viewForum.php?id=' . $row['id'] . '" class="link forum-item forum-title">';
                                echo $row['title'];
                            echo '</a>';
                            
                            echo '<div class="forum-item forum-desc">';
                                echo $row['desc'];
                            echo '</div>';

                            echo '<div class="forum-item forum-topics">';
                                echo $row['topics'] . ' topics';
                            echo '</div>';

                            echo '<div class="forum-item forum-replies">';
                                echo $row['replies'] . ' replies';
                            echo '</div>';
                        echo '</div>';
                    }
                ?>
            </table>
        </div>
    </body>
</html>
