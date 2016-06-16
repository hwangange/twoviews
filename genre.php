<?php
	$_SESSION["genre"] = $_GET["genre"]; 
	if($_SESSION["genre"] == "Tech") { $_SESSION["genre"] = "Tech & Science"; }
	if($_SESSION["genre"] == "Lifestyle") { $_SESSION["genre"] = "Lifestyle & Health"; }
?>

<!DOCTYPE html>
<html>
	<?php require "head.php"; ?>

	<body>
		<?php require "header.php"; ?>

		<!-- Page Content -->
	    <div class="container">

	    	<h1><?php echo $_SESSION["genre"]; ?></h1>
	     


		<?php require "footer.php"; ?>
	    </div>
	    <!-- /.container -->
	</body>
</html>