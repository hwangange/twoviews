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

	   			<h3 class = "article-sidebar-item">Keep in Touch!</h3>
				<hr>
				<div class = "social-row">
	    			<a href = 'https://twitter.com/TwoViewsPress'><i class = "fa fa-3x fa-twitter-square social"></i></a>
	    			<a href = "https://facebook.com/TwoViewPress"><i class = "fa fa-3x fa-facebook-square social"></i></a>
	    			<a href = "https://instagram.com"><i class = "fa fa-3x fa-instagram social"></i></a>
    			</div>
	    	</div>
	     


		
	    </div>
	    <!-- /.container -->
	    <?php require "footer.php"; ?>
	</body>
</html>