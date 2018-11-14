<?php
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $confirm = $_POST['confirm'];
    $email = $_POST['email'];

    // If no fields are empty
    if (!empty($username) && !empty($password) && !empty($confirm) && !empty($email) ) {
        // If you entered matching passwords
        if ($password == $confirm) {
            $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');

            $query = "SELECT * FROM user_info WHERE user='$username'";
            $result_user = mysqli_query($conn, $query);

            $query = "SELECT * FROM user_info WHERE email='$email'";
            $result_email = mysqli_query($conn, $query);

            // If the username and email are both unused
            if (mysqli_num_rows($result_user) == 0) {
                if (mysqli_num_rows($result_email) == 0) {
                    $conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');

                    $hashed = password_hash($password, PASSWORD_BCRYPT);

                    $date = date('m/d/Y');
                    $sql = "INSERT INTO user_info (user, pass, email, joinDate) VALUES ('$username', '$hashed', '$email', '$date')";
                
                    if (mysqli_query($conn, $sql)) {
                        header("Location: ../pages/login.php?justRegistered=1");
                    }
                
                    mysqli_close($conn);
                }
                else {
                    header("Location: ../pages/register.php?emailTaken=1");
                }
            }
            else {
                header("Location: ../pages/register.php?userTaken=1");
            }

        }
        else {
            header("Location: ../pages/register.php?mismatch=1");
        }
    }
    else {
        header("Location: ../pages/register.php?empty=1");
    }
?>