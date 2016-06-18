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
	    	<div class = "col-md-9">
	    		<?php require 'database/find-tag.php';?>
	    	</div>

	    	<div class = "article-sidebar col-md-3">
				<h3 class = "article-sidebar-item">Recommended Reading</h3>
	    		<hr>
	    		<p>To create your first image blog post, click here and select 'Add & Edit Posts' > All Posts > This is the title of your first image post.Great looking images make your blog posts more visually compelling for your audience, and encourage readers to keep coming back. </p>

	    		<h3 class = "article-sidebar-item">Search By Tags</h3>
	   			<hr>
	   			<p>To create your first image blog post, click here and select 'Add & Edit Posts' > All Posts > This is the title of your first image post.Great looking images make your blog posts more visually compelling for your audience, and encourage readers to keep coming back. </p>

	   			<h3 class = "article-sidebar-item">Follow Two Views</h3>
	   			<hr>
    			<p>To create your first image blog post, click here and select 'Add & Edit Posts' > All Posts > This is the title of your first image post.Great looking images make your blog posts more visually compelling for your audience, and encourage readers to keep coming back. </p>
	    	</div>
	     


		<?php require "footer.php"; ?>
	    </div>
	    <!-- /.container -->
	</body>
</html>