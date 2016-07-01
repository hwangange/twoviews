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

		$sql = "INSERT INTO articles(id, title, author, date, text, image, genre, tags, breaking, staff, top) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, 0, 0)";
		if($query = $conn->prepare($sql)) { // assuming $conn is the connection
		    $query->bind_param('ssssssss', $id, $title, $name, $date, $article, $image, $genre, $tags);

		    $id = $idTemp;
		    $name = $_POST['name'];
			$date = $dateTemp;
			$title = $_POST['title'];
			$genre = $_POST['genre'];
			$tags = $_POST['tags'];
			$image = "./img/image1.jpg"; //$_POST['image']
			$article = $_POST['article'];

			 if(!get_magic_quotes_gpc()) {
			 		$id = addslashes($id);
	              	$name = addslashes($name);
	              	$date = addslashes($date);
	              	$title = addslashes($title);
	              	$genre = addslashes($genre);
	              	$tags = addslashes($tags);
	              	$image = addslashes($image);
	              	$article = addslashes($article);
	               
	         }
		    $query->execute();
		    // any additional code you need would go here.
		    $result = $query->get_result();
	   		var_dump($result);
			if($result)
				echo "successfully inserted";
			$query->close();
		} else {
		    $error = $conn->errno . ' ' . $conn->error;
		    echo $error; // 1054 Unknown column 'foo' in 'field list'
		}
		
	}

	$conn->close();

?>