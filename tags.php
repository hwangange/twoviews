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

	    	<h1><?php echo $_SESSION["tag"]; ?></h1>
	     


		<?php require "footer.php"; ?>
	    </div>
	    <!-- /.container -->
	</body>
</html>