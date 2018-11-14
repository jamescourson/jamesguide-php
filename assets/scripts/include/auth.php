<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/include/user.php";
    session_start();
    
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];

        $user->update();
    }
    else {
        header('Location: /pages/login.php?login=1');
    }
?>