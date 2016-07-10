<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		header("Location: admin-login.php");
		exit;
	}
	if(!isset($_GET['id'])) {
		header("Location: admin-my-articles.php");
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

<?php
	if(!isset($_POST['name']) || !isset($_POST['date']) || !isset($_POST['title']) || !isset($_POST['genre']) || !isset($_POST['tags']) || !isset($_POST['article'])) {
		echo "Name: ".$_POST['name'];
		echo "Date: ".$_POST['date'];
		echo "Title:  ".$_POST['title'];
		echo "Genre: ".$_POST['genre'];
		echo "Tags: ".$_POST['tags'];
		echo "article: ".$_POST['article'];
		echo "Incomplete.";
	}
	else {

		if(!get_magic_quotes_gpc()) {
			
	        $_POST['name'] = addslashes($_POST['name']); 
	        $_POST['title'] = addslashes($_POST['title']);
	        $_POST['genre'] = addslashes($_POST['genre']);
	        $_POST['tags'] = addslashes($_POST['tags']);
	        $_POST['article'] = addslashes($_POST['article']);
	               
	    }

	    if(!is_uploaded_file($_FILES['image']['tmp_name'])) {
	    	 $sql = "UPDATE articles SET author = ?, date = CAST(? AS DATE), title = ?, genre = ?, tags = ?, text = ? WHERE id = ?";
		    if($stmt = $conn->prepare($sql)) {
		    	$stmt->bind_param('sssssss', $author, $date, $title, $genre, $tags, $text, $id);
		    	$author = $_POST['name'];
		    	$date = strval($_POST['date']);
		    	$title = $_POST['title'];
		    	$genre = $_POST['genre'];
		    	$tags = $_POST['tags'];
		    	$text = $_POST['article'];
		    	$id = $_GET['id'];
		    	$stmt->execute();
		    	$stmt->store_result();
		    	if($stmt) 
		    		echo "Successfully updated article. Do NOT click the back button on your browser. Instead, click on any link on the navigation bar.";
		    	$stmt->close();
		    } else {
		    	$error = $conn->errno . ' ' . $conn->error;
			    echo $error; // 1054 Unknown column 'foo' in 'field list'
		    }
	    } else {
	    	 $sql = "UPDATE articles SET author = ?, date = CAST(? AS DATE), title = ?, genre = ?, tags = ?, text = ?, image = ? WHERE id = ?";
		    if($stmt = $conn->prepare($sql)) {
		    	$stmt->bind_param('ssssssss', $author, $date, $title, $genre, $tags, $text, $image, $id);
		    	$author = $_POST['name'];
		    	$date = strval($_POST['date']);
		    	$title = $_POST['title'];
		    	$genre = $_POST['genre'];
		    	$tags = $_POST['tags'];
		    	$text = $_POST['article'];
		    	$image = uploadImage($_GET['id']);
		    	$id = $_GET['id'];
		    	$stmt->execute();
		    	$stmt->store_result();
		    	if($stmt) 
		    		echo "Successfully updated article with new image. Do NOT click the back button on your browser. Instead, click on any link on the navigation bar.";
		    	$stmt->close();
		    } else {
		    	$error = $conn->errno . ' ' . $conn->error;
			    echo $error; // 1054 Unknown column 'foo' in 'field list'
		    }
	    }
	}   

	$conn->close();

	function uploadImage($id) {
			//define ('SITE_ROOT', realpath(dirname(__FILE__)));
			
		    $target_dir = "img/article_img/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
		  //  $target_file = SITE_ROOT.'/article_img/'.basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            //Check if image file is a actual image or fake
        
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {

                if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file))
                {
                    //echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                    $ext = findexts($target_file);
                    //$new_target_file = SITE_ROOT.'/article_img/'.$id."_coverimg".".".$ext;
                    $new_target_file = 'img/article_img/'.$id."_coverimg".".".$ext;
                    rename($target_file, $new_target_file);
                    //echo "New image name - " . basename($new_target_file);
                    $result = $new_target_file;
                }
            } else {
                echo "File is not an image";
                $uploadOk = 0;
                $result = 0;
            }

            return $result;
        }

	

	function findexts ($filename) {
       $filename = strtolower($filename);
       $exts = split("[/\\.]", $filename);
       $n = count($exts) - 1;
       $exts = $exts[$n];
       return $exts;
    }

?>
</div>
</body>
</html>