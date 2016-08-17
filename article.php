<?php
	 $_SESSION["id"] = $_GET["id"];
	 $session_id = $_SESSION["id"];
?>
<!DOCTYPE html>
<html>
	<?php require "head.php"; ?>

	<body>
		<?php require "header.php"; ?>

		<!-- Page Content -->
	    <div class="container">

	    	
	    			<?php require "get-article.php"; ?>

	    </div>
	    <!-- /.container -->
	    
	    <?php require "footer.php"; ?>
	</body>
</html>