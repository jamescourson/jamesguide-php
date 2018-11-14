<?php
    include 'auth.php';

    $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');
    $series = $_GET['series'];

    function rollItem($rarity) {
        $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');
        $series = $_GET['series'];
        
        $rollableItems = mysqli_query($conn, "SELECT * FROM items WHERE series=$series and rarity=$rarity");
        $itemIDs = array();

        while ($row = mysqli_fetch_assoc($rollableItems)) {
            array_push($itemIDs, $row['id']);
        }

        $rolledItemIndex = mt_rand(0, mysqli_num_rows($rollableItems) - 1);
        return $itemIDs[$rolledItemIndex];
    }

    // Authenticate user box ownership
    $box = mysqli_query($conn, "SELECT * FROM owned_boxes WHERE ownerID=$user->id and boxID=$series");
    $auth = mysqli_num_rows($box);

    if ($auth > 0) {
        // Determine rarity to be picked
        $roll = mt_rand(1, 100);
    
        if ($roll >= 1 and $roll <= 70) {
            // Common
            $rolledItem = rollItem(1);
        }
        else if ($roll >= 71 and $roll <= 90) {
            // Uncommon
            $rolledItem = rollItem(2);
        }
        else if ($roll >= 91 and $roll <= 100) {
            // Rare
            $rolledItem = rollItem(3);
    
            if (mt_rand(1, 100) == 1) {
                // Unique
                $rolledItem = rollItem(4);
            }
        }

        if (mysqli_query($conn, "INSERT INTO owned_items (itemID, ownerID) VALUES ($rolledItem, $user->id)")) {
            $ownedBoxID = mysqli_fetch_assoc($box)['id'];

            if (mysqli_query($conn, "DELETE FROM owned_boxes WHERE id=$ownedBoxID")) {
                header("Location: /pages/profile.php?id=$user->username");
            }
        }
    }
?>