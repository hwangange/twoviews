<?php
	$_SESSION["tag"] = $_GET["tag"]; 
?>

<!DOCTYPE html>
<html>
	<?php require "head.php"; ?>

	<body>
		<?php require "header.php"; ?>

		<!-- Page Content -->
	    <div class="container">
	    	<h1 class = "hero-spacer">Tag: <?php echo $_SESSION["tag"]; ?></h1>
	    	
	    		<?php require 'database/find-tag.php';?>
	    	

	   
	     


		
	    </div>
	    <!-- /.container -->
	    <?php require "footer.php"; ?>
	</body>
</html>