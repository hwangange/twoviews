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
		<h4>Select one article to display as the <b>Top News</b> article on the home page. If you select more than one article, only the most recent article will be shown.</h4>
		<form method = "post" action = "admin-choose-success.php" name = "chooseArticleForm" id = "chooseArticleForm">
			<div class = "row">
				<div class = "col-md-6">
		
	<?php
		$sql = "SELECT id, title, genre, tags, top FROM articles ORDER BY date DESC LIMIT 25";
		if($stmt = $conn->prepare($sql)) { // assuming $conn is the connection	   
		    $stmt->execute();
		    $stmt->store_result();
		    $count = 0;
		    $stmt->bind_result($id, $title, $genre, $tags, $top);
		    while($stmt->fetch()) {
				$title = stripslashes($title);
		    	if ($count == 12){ ?>
		    		</div> <!-- end col-md-6 -->
		    		<div class = "col-md-6">
		    	<?php
		    	}
		    	if ($top == 0) { ?>
		    		<input type = "checkbox" name = "top[]" value = "<?php echo $id;?>"> <?php echo $title; ?> <br>
		    	<?php
		    	}
		    	else { ?>
		    		<input type = "checkbox" name = "top[]" value = "<?php echo $id;?>" checked = "yes"> <?php echo $title; ?> <br>
		    	<?php
		    	}

		    	$count+=1;
			}
		    $stmt->close();
		} else {
			echo "Couldn't prepare statement";
		}
		
	?>
			</div> <!-- end col-md-6 -->
		</div><!-- end row -->

		<h4>Select three article to display as the <b>Staff's Picks</b> articles on the home page. If you select more than three articles, only the most recent articles will be shown.</h4>
		<div class = "row">
				<div class = "col-md-6">
		
			<?php
				$sql = "SELECT id, title, genre, tags, staff FROM articles ORDER BY date DESC LIMIT 25";
				if($stmt = $conn->prepare($sql)) { // assuming $conn is the connection	   
				    $stmt->execute();
				    $stmt->store_result();
				    $count = 0;
				    $stmt->bind_result($id, $title, $genre, $tags, $staff);
				    while($stmt->fetch()) {
						$title = stripslashes($title);
						if ($count == 12){ ?>
				    		</div> <!-- end col-md-6 -->
				    		<div class = "col-md-6">
				    	<?php
				    	}
				    	if ($staff == 0) { ?>
				    		<input type = "checkbox" name = "staff[]" value = "<?php echo $id;?>"> <?php echo $title; ?> <br>
				    	<?php
				    	}
				    	else { ?>
				    		<input type = "checkbox" name = "staff[]" value = "<?php echo $id;?>" checked = "yes"> <?php echo $title; ?> <br>
				    	<?php
				    	}

				    	$count+=1;
					}
				    $stmt->close();
				} else {
					echo "Couldn't prepare statement";
				} 
				$conn->close();
				?>
			</div> <!-- end col-md-6 -->
		</div><!-- end row -->

		<button name="submitbtn" id = "submitbtn" type = "submit">Submit</button> or
	    <button name = "cancelbtn" id = "cancelbtn"><a href = "admin.php">Cancel</a></button>
		
		</form>
	</div>
	<script>
	
		var Anchors = document.getElementsByTagName("a");
		for (var i = 0; i < Anchors.length ; i++) {
		    Anchors[i].addEventListener("click", 
		        function (event) {
		            event.preventDefault();
		            if (confirm('Are you sure you want to leave this page? Any changes will not be saved.')) {
		                window.location = this.href;
		            }
		        }, 
		        false);
		}

		$("#cancelbtn").click(function(event) {
			event.preventDefault();
		})
	</script>
</body>
</html>