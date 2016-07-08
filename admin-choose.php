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
		
		
	</div>
</body>
</html>