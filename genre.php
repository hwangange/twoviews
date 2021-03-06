<?php
	$_SESSION["genre"] = $_GET["genre"]; 
	$genre = strtolower($_SESSION['genre']);

	if (strpos($genre, 'life') !== false) {
	    $genre = "Lifestyle & Health"; 
	    $_SESSION["genre"] = "life";
	}
	else if (strpos($genre, 'tech') !== false || strpos($genre, 'science') !== false) {
	    $genre = "Tech & Sciences"; 
	    $_SESSION["genre"] = "science";
	}

	else if (strpos($genre, 'us') !== false || strpos($genre, 'united') !== false) {
	    $genre = "U.S."; 
	    $_SESSION["genre"] = "us";
	}

	else if (strpos($genre, 'edit') !== false) {
	    $genre = "Editorials"; 
	    $_SESSION["genre"] = "edit";
	}

	else if (strpos($genre, 'inter') !== false) {
	    $genre = "International News"; 
	    $_SESSION["genre"] = "international";
	}

	else if (strpos($genre, 'viral') !== false) {
	    $genre = "Viral News"; 
	    $_SESSION["genre"] = "viral";
	}

	else if (strpos($genre, 'ent') !== false) {
	    $genre = "Entertainment"; 
	    $_SESSION["genre"] = "entertainment";
	}

	else if (strpos($genre, 'school') !== false) {
	    $genre = "School"; 
	    $_SESSION["genre"] = "school";
	}
?>

<!DOCTYPE html>
<html>
	<?php require "head.php"; ?>

	<body>
		<?php require "header.php"; ?>

		<!-- Page Content -->
	    <div class="container">

	    	<h1 class = "hero-spacer" style = "text-align: center; padding: 20px"><b><?php echo $genre; ?></b></h1>

	    	<?php require 'get-genre.php';?>    
	   </div>
	    <!-- /.container -->
	    <?php require "footer.php"; ?>
	</body>
	<script>
	   $(window).load(function() {

	    	
		/*	$height = $("#parent-tobe").height();
   			$("#parent-tobe").css({'height': $height});

   			$height = $("#children-tobe").height();
   			$("#children-tobe").css({'height': $height});

   			$("#parent-tobe").addClass("parent");

			$("#children-tobe").addClass("children"); 
		}); */
	</script> 
</html>