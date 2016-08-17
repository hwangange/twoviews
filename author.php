<script>
function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
    }
</script>
<?php
	$_SESSION["author"] = $_GET["author"]; 
?>

<!DOCTYPE html>
<html>
	<?php require "head.php"; ?>

	<body>
		<?php require "header.php"; ?>

		<!-- Page Content -->
	    <div class="container">
	    	<h1 class = "hero-spacer">Author: <?php echo $_SESSION["author"]; ?></h1>
	    	
	    	
	    		<?php require 'find-author.php'; ?> 
	    	

	   
	     


		
	    </div>
	    <!-- /.container -->
	    <?php require "footer.php"; ?>
	</body>
</html>