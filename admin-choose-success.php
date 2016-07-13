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
	<div class = "container" style = "margin: 50px">
	<?php
		if(!empty($_POST['top'])) {
			var_dump($_POST['top']);
			$sql = "UPDATE articles SET top = 0";
			if($stmt = $conn->prepare($sql)) { // assuming $conn is the connection	   
		    	$stmt->execute();
		    	$stmt->close();
		    }

		    foreach($_POST['top'] as $check) {
		    	$sql = "UPDATE articles SET top = 1 WHERE id = ?";
				if($stmt = $conn->prepare($sql)) { // assuming $conn is the connection
					$stmt->bind_param('i', $id);
					$id = intval($check);	   
			    	$stmt->execute();
			    	$stmt->store_result();
			    	var_dump($stmt);
			    	if($stmt) {
			    		echo "stmt is true??";
			    	}
			    	$stmt->close();
			    }

		    }
		}

		if(!empty($_POST['staff'])) {
			$sql = "UPDATE articles SET staff = 0";
			if($stmt = $conn->prepare($sql)) { // assuming $conn is the connection	   
		    	$stmt->execute();
		    	$stmt->close();
		    }

		    foreach($_POST['staff'] as $check) {
		    	$sql = "UPDATE articles SET staff = 1 WHERE id = ?";
				if($stmt = $conn->prepare($sql)) { // assuming $conn is the connection
					$stmt->bind_param('i', $id);
					$id = intval($check);	   
			    	$stmt->execute();
			    	$stmt->store_result();
			    	if($stmt) {
			    		echo "Successfully updated Staff's Picks articles";
			    	}
			    	$stmt->close();
			    }

		    }
		}
	?>
	</div>
</body>
</html>