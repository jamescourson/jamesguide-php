<html>
	<?php
		include '../include/header.php';
		include '../scripts/auth.php';
	?>

	<body>
		<h1><?php echo $_GET['id']; ?></h1>

		<div class="user-page-wrapper">
			<h2>Profile</h2>

			<div class="wrapper">
				<h3>
					<!-- EDIT/LOGOUT -->
					<?php
						if ($_GET['id'] == $user->username) {
							echo '<button id="editText" onclick="editProfile(true)">Edit</button>';
							echo '<form method="post" style="display:inline-block" action="/scripts/logout.php">';
								echo '&nbsp;<button>Logout</button>';
							echo '</form><br>';
						}
						else {
							$user = new User($_GET['id']);
						}

						echo '<p hidden id="uid">' . $user->username . '</p>';
					?>

					<div id="profile-wrapper">
						<div id="left-pane">
							<div id="profile-avatar">
								<?php
									echo '<img class="avatar" src='. $user->avatar. '>';
									echo '<br>';
									echo '<span id="avatar_edit"></span><br>';
								?>
							</div>

							<div id="profile-username">
								<?php
									echo $user->username;
								?>
							</div>

							<div id="profile-title">
								<span id="title_edit"><?php echo $user->title; ?></span>
							</div>
						</div>
						
						<div id="right-pane">
							<div id="profile-join">
								<?php
									echo 'Join date: ' . $user->joinDate;
								?>
							</div>

							<div id="profile-topics">
								<?php
									$conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');
									
									$topics = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM topics WHERE owner='$user->username'"));

									echo 'Topics: ' . $topics;
								?>
							</div>
							
							<div id="profile-replies">
								<?php
									$conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');
									
									$replies = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM replies WHERE owner='$user->username'"));

									echo 'Replies: ' . $replies;
								?>
							</div>
							
							<div id="profile-score">
								<?php
									echo 'Score: ' . $user->score;
								?>
							</div>
						</div>
					</div>
				</h3>
			</div>

			<h2>Inventory</h2>

			<div class="wrapper">
				<h3>Boxes</h3>

				<div class="wrapper">
					<?php
						$conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');

						$query = "SELECT * FROM owned_boxes WHERE ownerID=$user->id";
						$result = mysqli_query($conn, $query);
						
						if (mysqli_num_rows($result) == 0) {
							echo '<h3>No items to display</h3>';
						}
						else {
							while ($row = mysqli_fetch_assoc($result)) {
								$id = $row['boxID'];
								$box = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM boxes WHERE id=$id"));

								echo '<div class="box-listing">';
									echo '<div class="box-pic">';
										echo '<img src="' . $box['pic'] . '">';
									echo '</div>';

									echo '<div class="box-name">';
										echo $box['name'];
									echo '</div>';

									echo '<div class="box-open">';
										echo '<form method="post" action="/scripts/openBox.php?series=' . $box['id'] . '">';
											echo '<button>Open</button>';
										echo '</form>';
									echo '</div>';
								echo '</div>';
							}
						}
					?>
				</div>

				<h3>Items</h3>

				<div class="wrapper">
					<?php
						$conn = new mysqli('localhost', 'hplaserj_James', 'Furgus', 'hplaserj_users');

						$query = "SELECT * FROM owned_items WHERE ownerID='$user->id'";
						$result = mysqli_query($conn, $query);
						
						if (mysqli_num_rows($result) == 0) {
							echo '<h3>No items to display</h3>';
						}
						else {
							while ($row = mysqli_fetch_assoc($result)) {
								$id = $row['itemID'];
								$item = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM items WHERE id=$id"));

								echo '<div class="item-listing">';
									echo '<div class="item-pic">';
										echo '<img src="' . $item['pic'] . '">';
									echo '</div>';

									echo '<div class="item-name">';
										echo $item['name'];
									echo '</div>';

									echo '<div class="item-info">';
										echo '<form method="post" action="">';
											echo '<button>Info</button>';
										echo '</form>';
									echo '</div>';
								echo '</div>';
							}
						}
					?>
				</div>
			</div>
		</div>
	</body>
</html>