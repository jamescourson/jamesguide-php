<html>
	<?php include '../include/header.php'; ?>
	
	<h1>
		About
    </h1>
    
    <div class="info">
        <div class="info-window" id="about">
            <h1>
                Info<br>
            </h1>

            <h2>
                James' Guide is an experimental forum.<br>
                Forums are separated into "Guides", which are owned by users.<br>
                <br>
                You can earn bits through other users voting on your topics or replies.<br>
                You can spend bits on boxes or items at the market.<br>
                <br>
                Opening a box gives you a random item from the box's collection.<br>
                Items have different rarities and attributes.<br>
            </h2>
        </div>

        <div class="info-window" id="leaderboard">
            <h1>Leaderboard</h1>

            <?php
                $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');

                $query = "SELECT * FROM user_info ORDER BY score DESC";
                $leaders = mysqli_query($conn, $query);
                $rank = 0;

                echo '<div class="board">';
                    while ($row = mysqli_fetch_assoc($leaders)) {
                        $rank++;
                        echo '<div class="board-listing">';
                            echo '#' . $rank . ': <a href="/pages/profile.php?id=' . $row['user'] . '" class="link">' . $row['user'] . '</a> (' . $row['score'] . ' points)';
                        echo '</div>';
                    }
                echo '</div>';
            ?>
        </div>

        <div class="info-window" id="statistics">
            <h1>
                Statistics
            </h1>

            <h2>
                <?php
                    $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');

                    $users = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user_info"));
                    $topics = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM topics"));
                    $replies = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM replies"));
                    $votes = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM votes"));
                    $bits = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(bits) AS total FROM user_info"))['total'];

                    echo 'Users: ' . $users . '<br>';
                    echo 'Topics: ' . $topics . '<br>';
                    echo 'Replies: ' . $replies . '<br>';
                    echo 'Votes: ' . $votes . '<br>';
                    echo 'Owned bits: ' . $bits . '<br>';
                ?>
            </h2>
        </div>
    </div>
</html>