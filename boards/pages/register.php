<html>
    <?php include '../include/header.php'?>

    <body class="centered">
        <h1>
            Register
        </h1>

        <h2>
            <?php
                if (isset($_GET['mismatch'])) {
                    if ($_GET['mismatch'] == 1) {
                        echo 'Your passwords do not match. Please try again.<br>';
                    }
                }
                else if (isset($_GET['empty'])) {
                    if ($_GET['empty'] == 1) {
                        echo 'One or more fields is empty. Please try again.<br>';
                    }
                }
                else if (isset($_GET['userTaken'])) {
                    if ($_GET['userTaken'] == 1) {
                        echo 'That username is taken. Please use another.<br>';
                    }
                }
                else if (isset($_GET['emailTaken'])) {
                    if ($_GET['emailTaken'] == 1) {
                        echo 'That email is taken. Please use another.<br>';
                    }
                }
                else {
                    echo 'Register an account:<br>';
                }
            ?>
        </h2>

        <form method="post" action="../scripts/submitRegistration.php" class="form">
            Username:<input type="text" name="user" maxlength="16"><br>
            Password:<input type="password" name="pass"><br>
            Confirm :<input type="password" name="confirm"><br>
            Email &nbsp;&nbsp;:<input type="text" name="email"><br><br>
            <button type="submit" value="Register">Register</button>
        </form>

        <h2>
            Already a member? <a href="/pages/login.php" class="link">Login</a>
        </h2>
    </body>
</html>