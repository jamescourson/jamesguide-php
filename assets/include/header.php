<html>
	<head>
		<?php include("user.php"); ?>

		<title>
			James' Guide
		</title>

		<link rel="stylesheet" href="../css/styles.css">
		<link rel="shortcut icon" href="../img/icon.png">
		<link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="../js/scripts.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<head>

	<body>
		<div class="header">
			<div class="header-logo">
				<a href="/" class="link">
					<img id="logo" src="/assets/logo.png" width=400 alt="James' Guide">
				</a>
			</div>

			<?php
				echo '<div class="header-info">';
					session_start();

					if (isset($_SESSION['user'])) {
						$user = $_SESSION['user'];

						echo 'Welcome, <a href="/pages/profile.php?id=' . $user->username . '" class="link">';
							echo $user->username;
						echo '</a>';

						echo '! [<img src="/assets/icons/hexagon.svg" class="svg">' . $user->bits . ']';
					}
					else {
						echo 'Welcome, guest! <a href="/pages/login.php" class="link">Login</a>';
					}
				echo '</div>';
			?>

			<div class="header-nav">
				<a href="http://james.guide" class="link">Home</a>
				<a href="http://market.james.guide" class="link">Market</a>
				<a href="/pages/about.php" class="link">About</a>
			</div>
		</div>
	</body>
</html>