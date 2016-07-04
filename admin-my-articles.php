<?php
    session_start();
	if(!isset($_SESSION['username'])) {
		header("Location: admin-login.php");
		exit;
	} 
	require "config.php";
	$conn = new mysqli(hostname, username, password, db_name) or die ("could not connect to mysql");
?>
<!DOCTYPE html>
<html>
<head>
	<?php require "admin-head.php";?>
</head>
<body>
	<?php require "admin-nav.php";?>
	<div class = "container" style = "margin-top: 50px">
		<h3>Click on any article to edit it.</h3>
		<ul class = 'list-group'>
			
		<?php
			$sql = "SELECT id, title, genre, tags FROM articles ORDER BY date DESC";
			if($stmt = $conn->prepare($sql)) { // assuming $conn is the connection
			   
			    $stmt->execute();
			    $stmt->store_result();
			    $stmt->bind_result($id, $title, $genre, $tags);
			    while($stmt->fetch()) {
					$title = stripslashes($title);
					?>
					<li class = "list-group-item"><a href = "admin-edit.php?id=<?php echo $id;?>"><?php echo $title; ?></li>
			    <?php }

			    $stmt->close();
			} else {
				echo "Couldn't prepare statement";
			}

			$conn->close();

		?>

		</ul>
		
	</div>
</body>
</html>