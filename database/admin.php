<?php
    session_start();
    if(!isset($_SESSION['username'])) {
		header("Location: admin-login.php");
		exit;
	}
   
	require "connection.php";
?>
<!DOCTYPE html>
<html>
<head>
	<?php require "admin-head.php";?>
</head>
<body>
	<?php require "admin-nav.php";?>
	<div class = "container" style = "margin-top: 50px">
		<h3><?php echo "Welcome, " . $_SESSION['name']; ?></h3>
		<div class="list-group" style = "display: block; margin-left: auto; margin-right: auto">
		  <a href="admin-convert.php" class="list-group-item">Post an Article</a>
		  <a href="admin-edit.php" class="list-group-item">View and Edit Your Articles</a>
		  <a href="admin-profile.php" class = "list-group-item">Profile</a>
		  <a href="admin-logout.php" class="list-group-item">Log out</a>
		</div>
	</div>
</body>
</html>