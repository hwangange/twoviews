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
		<p>Name: <?php echo $_SESSION['name'];?></p>
		<p>Username: <?php echo $_SESSION['name'];?></p>
	</div>
</body>
</html>