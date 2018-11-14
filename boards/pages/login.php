<html>
	<?php include '../include/header.php'?>

	<body class="centered">
		<h1>
			Login
		</h1>

		<h2>
			<?php
				if (isset($_GET['invalid'])) {
					if ($_GET['invalid'] == 1) {
						$invalid = 1;
						echo 'Invalid login. Please try again.<br>';
					}
				}
				else if (isset($_GET['justRegistered'])) {
					if ($_GET['justRegistered'] == 1) {
						echo 'Registration successful! Now log in.<br>';
					}
				}
				else if (isset($_GET['login'])) {
					if ($_GET['login'] == 1) {
						echo 'You must be logged in to do that.<br>';
					}
				}
				else {
					echo 'Log in to your account:<br>';
				}
			?>
		</h2>

		<form method="post" action="../scripts/submitLogin.php" class="form">
			Username:<input type="text" name="user"><br>
			Password:<input type="password" name="pass"><br><br>
			<button type="submit" value="Login">Login</button>
		</form>

		<h2>
			Not a member yet? <a href="/pages/register.php" class="link">Register</a>
		</h2>
	</body>
</html>