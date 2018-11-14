<html>
    <head>
        <?php
            include 'include/header.php';
        ?>
        <link rel="stylesheet" href="market.css">
    </head>

    <body>
        <h1>Market</h1>

        <div class="wrapper">
            <?php
                $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');
                
                if ($_GET['insufficient'] == 1) {
                    echo '<br>You do not have enough bits to purchase that.';
                }

                echo '<h2>Boxes</h2>';

                echo '<div class="wrapper" id="boxes-wrapper">';
                    $query = "SELECT * FROM boxes ORDER BY id DESC";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="listing">';
                            echo '<div class="listing-pic">';
                                echo '<img src="' . $row['pic'] . '">';
                            echo '</div>';
                            
                            echo '<div class="listing-name">';
                                echo 'Series ' . $row['id'];
                            echo '</div>';

                            echo '<div class="listing-collection">';
                                echo $row['collection'];
                            echo '</div>';

                            echo '<div class="listing-buy">';
                                echo '<form method="post" action="../../scripts/buyBox.php?id=' . $row['id'] . '">';
                                    echo '<button><img src="/assets/icons/hexagon.svg" class="svg">' . $row['price'] . '</button>';
                                echo '</form>';
                            echo '</div>';
                        echo '</div>';
                    }
                echo '</div>';

                echo '<h2>Items</h2>';

                echo '<div class="wrapper">';
                    $query = "SELECT * FROM listed_items";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) == 0) {
                        echo 'No items listed. Come back later.';
                    }
                    else {
                        while ($row = mysqli_fetch_assoc($result)) {

                        }
                    }
                echo '</div>';
            ?>
        </div>
    </body>
</html>