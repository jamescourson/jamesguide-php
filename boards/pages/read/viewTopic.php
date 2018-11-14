<html>
    <head>
        <?php include '/include/header.php'; ?>
        <link rel="stylesheet" href="forum.css">
    </head>
    
    <div class="wrapper">
        <?php
            session_start();

            $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');
            $topicID = $_GET['id'];
            $query = "SELECT * FROM topics WHERE id='$topicID'";
            $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

            echo '<h1>' . $result['title'] . '</h1>';

            echo '<div class="topic-head listing reply-listing">';
                $poster = new User($result['owner']);

                echo '<div class="reply-avatar">';
                    echo '<img src="' . $poster->avatar . '">';
                echo '</div>';

                echo '<div class="reply-user">';
                    echo '<a href="/pages/profile.php?id=' . $poster->username . '" class="link">' . $poster->username . '</a>';
                echo '</div>';  

                echo '<div class="reply-title">';
                    echo $poster->title;
                echo '</div>';

                echo '<div class="reply-content">';
                    echo $result['content'];
                echo '</div>';

                echo '<div class="reply-date">';
                    echo $result['postDate'];
                echo '</div>';

                echo '<div class="reply-score">';
                    echo 'Score: ' . $result['score'];
                echo '</div>';

                if (isset($user)) {
                    if ($user->username != $poster->username) {
                        $id = $result['id'];
                        $voted = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM votes WHERE user='$user->username' and voteType='t' and id=$id"));
                        
                        echo '<div class="reply-vote">';
                            if ($voted == 0) {
                                echo '<form method="post" style="display:inline-block" action="/scripts/vote.php?id=' . $topicID . '&t=t">';
                                    echo '<button>+</button>';
                                echo '</form>';
                            }
                            else {
                                echo '<form method="post" style="display:inline-block" action="">';
                                    echo '<button class="voted">+</button>';
                                echo '</form>';
                            }
                        echo '</div>';
                    }
                }

                if (isset($user) && $user->username == $poster->username) {
                    echo '<div class="reply-edit">';
                        echo '<form method="post" style="display:inline-block" action="/scripts/edit/editReply.php">';
                            echo '<button>Edit</button>';
                        echo '</form>';
                    echo '</div>';

                    echo '<div class="reply-delete">';
                        echo '<form method="post" style="display:inline-block" action="/scripts/delete/deleteReply.php">';
                            echo '<button>Delete</button>';
                        echo '</form>';
                    echo '</div>';
                }
            echo '</div>';

            // Reply button
            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];
                echo '<form method="post" action="../post/reply.php?id=' . $topicID . '">';
                    echo '<button>Reply</button>';
                echo '</form>';
            }

            // Get all replies from db
            $query = "SELECT * FROM replies WHERE parent='$topicID'";
            $result = mysqli_query($conn, $query);

            // Print all replies
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="listing reply-listing">';
                    $poster = new User($row['owner']);

                    echo '<div class="reply-avatar">';
                        echo '<img src="' . $poster->avatar . '">';
                    echo '</div>';

                    echo '<div class="reply-user">';
                        echo '<a href="/pages/profile.php?id=' . $poster->username . '" class="link">' . $poster->username . '</a>';
                    echo '</div>';  

                    echo '<div class="reply-title">';
                        echo $poster->title;
                    echo '</div>';

                    echo '<div class="reply-content">';
                        echo $row['content'];
                    echo '</div>';

                    echo '<div class="reply-date">';
                        echo $row['postDate'];
                    echo '</div>';

                    echo '<div class="reply-score">';
                        echo 'Score: ' . $row['score'];
                    echo '</div>';

                    if (isset($user)) {
                        if ($user->username != $poster->username) {
                            $id = $row['id'];
                            $voted = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM votes WHERE user='$user->username' and voteType='r' and id=$id"));
                            
                            echo '<div class="reply-vote">';
                                if ($voted == 0) {
                                    echo '<form method="post" style="display:inline-block" action="/scripts/vote.php?id=' . $row['id'] . '&t=r">';
                                        echo '<button>+</button>';
                                    echo '</form>';
                                }
                                else {
                                    echo '<form method="post" style="display:inline-block" action="">';
                                        echo '<button class="voted">+</button>';
                                    echo '</form>';
                                }
    
                            echo '</div>';
                        }
                    }

                    if (isset($user) && $user->username == $poster->username) {
                        echo '<div class="reply-edit">';
                            echo '<form method="post" style="display:inline-block" action="/scripts/edit/editReply.php">';
                                echo '<button>Edit</button>';
                            echo '</form>';
                        echo '</div>';

                        echo '<div class="reply-delete">';
                            echo '<form method="post" style="display:inline-block" action="/scripts/delete/deleteReply.php">';
                                echo '<button>Delete</button>';
                            echo '</form>';
                        echo '</div>';
                    }
                echo '</div>';
            }
        ?>

        <!-- <div class="reply-wrapper">
            <div class="reply-usercontent">
                <div class="reply-usercontent-profile">
                    <div class="reply-usercontent-profile-avatar">

                    </div>

                    <div class="reply-usercontent-profile-username">

                    </div>

                    <div class="reply-usercontent-profile-title">

                    </div>

                    <div class="reply-usercontent-profile-date">

                    </div>
                </div>

                <div class="reply-usercontent-content">

                </div>
            </div>

            <div class="reply-actions">
                <div class="reply-actions-user">
                    <div class="reply-actions-score">

                    </div>

                    <div class="reply-actions-vote">

                    </div>
                </div>

                <div class="reply-actions-poster">
                    <div class="reply-actions-poster-edit">

                    </div>

                    <div class="reply-actions-poster-delete">

                    </div>
                </div>
            </div>
        </div> -->
    </div>
</html>