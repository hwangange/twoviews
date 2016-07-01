<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		header("Location: admin-login.php");
		exit;
	}
	require "config.php";
	$conn = new mysqli(hostname, username, password, db_name) or die ("could not connect to mysql");
	if(!($_POST['name']) || !($_POST['date']) || !($_POST['title']) || !($_POST['genre']) || !($_POST['tags']) || !($_POST['image']) || !($_POST['article'])) {
		echo "Name: ".$_POST['name'];
		echo "Date: ".$_POST['date'];
		echo "Title:  ".$_POST['title'];
		echo "Genre: ".$_POST['genre'];
		echo "Tags: ".$_POST['tags'];
		echo "Image: ".$_POST['image'];
		echo "article: ".$_POST['article'];
		echo "Incomplete.";
	}
	else {

		$result = $conn->query("SELECT * FROM articles");
		$idTemp = strval($result->num_rows + 1);
		$dateTemp = strval($_POST['date']);
		$result->close();

		if(!get_magic_quotes_gpc()) {
			
	        $_POST['name'] = addslashes($_POST['name']); 
	        $_POST['title'] = addslashes($_POST['title']);
	        $_POST['genre'] = addslashes($_POST['genre']);
	        $_POST['tags'] = addslashes($_POST['tags']);
	        $_POST['image'] = addslashes($_POST['image']);
	        $_POST['article'] = addslashes($_POST['article']);
	               
	    }

		$sql = "INSERT INTO articles(id, title, author, date, text, image, genre, tags, breaking, staff, top) VALUES (?, ?, ?, CAST(? AS DATE), ?, ?, ?, ?, ?, ?, ?)";
		if($stmt = $conn->prepare($sql)) { // assuming $conn is the connection
		    $stmt->bind_param('ssssssssiii', $id, $title, $author, $date, $text, $image, $genre, $tags, $breaking, $staff, $top);

		    $id = $idTemp;
		    $title = $_POST['title'];
		    $author = $_POST['name'];
			$date = $dateTemp;
			$text = $_POST['article'];
			$image = "./img/image1.jpg"; //$_POST['image']
			$genre = $_POST['genre'];
			$tags = $_POST['tags'];
			$breaking = 0;
			$staff = 0;
			$top = 0;

		    $stmt->execute();
		    $stmt->store_result();
		    var_dump($stmt);
	   		
			if($stmt)
				echo "successfully inserted";
			$stmt->close();
		} else {
		    $error = $conn->errno . ' ' . $conn->error;
		    echo $error; // 1054 Unknown column 'foo' in 'field list'
		}
		
	}

	$conn->close();

?>