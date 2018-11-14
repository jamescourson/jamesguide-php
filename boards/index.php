<html>
    <head>
        <?php
            include 'include/header.php';
        ?>
        
        <link rel="stylesheet" href="pages/view/forum.css">
    </head>

    <body>
        <h1>Guides</h1>
        
        <div class="guide-wrapper">
            <?php
                $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');

                $query = "SELECT * FROM guides";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="guide-listing">';
                        echo '<div class="guide-item">';
                            echo '<a href="pages/view/viewGuide.php?id=' . $row["id"] . '" class="link">';
                                echo '<h1>' . $row["title"] . '</h1>';
                            echo '</a>';
                        echo '</div>';
                        
                        echo '<div class="guide-item">';
                            echo '<h2>' . $row["desc"] . '</h2>';
                        echo '</div>';

                        echo '<div class="guide-item">';
                            echo '<h2>';
                                echo 'Owned by: ';
                                echo '<a href="pages/profile.php?id=' . $row["owner"] . '" class="link">';
                                    echo $row["owner"];
                                echo '</a>';
                            echo '</h2>';
                        echo '</div>';
                    echo '</div>';
                }
            ?>
        </div>
    </body>
</html>