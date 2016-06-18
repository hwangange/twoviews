<?php
	 $_SESSION["genre"] = "home";
?>
<!DOCTYPE html>
<html>
	<?php require 'head.php'; ?>

	<body>
		<?php require 'header.php'; ?>



		<!-- Page Content -->
	    <div class="container">
	    	<div class = "whole-top-post">
		        <div class = "row top-post-row hero-spacer">
		        	<div class = "col-sm-4 col-md-3">
		        		<div class = "thumbnail">
		        			<img src = "img/blue.jpg">
			        		<div class = "caption">
			        			Title
			        		</div>
			        	</div>
			        </div>
		        	<div class = "col-sm-4 col-md-3">
		        		<div class = "thumbnail">
		        			<img src = "img/blue.jpg">
			        		<div class = "caption">
			        			Title
			        		</div>
			        	</div>
		        	</div>
		        	<div class = "col-sm-4 col-md-3">
		        		<div class = "thumbnail">
		        			<img src = "img/blue.jpg">
			        		<div class = "caption">
			        			Title
			        		</div>
			        	</div>
		        	</div>
		        	<div class = "col-sm-4 col-md-3">
		        		<div class = "thumbnail">
		        			<img src = "img/blue.jpg">
			        		<div class = "caption">
			        			Title
			        		</div>
			        	</div>
		        	</div>
		        </div>
	        </div>

	        <br>

	        <div class = "row">
	        	<div class = "col-md-9">
	        		<?php require 'database/get-home-articles.php'; ?>
	        	</div>

	        	<div class = "col-md-3">
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
	        </div>

		<?php require 'footer.php'; ?>
	    </div>
	    <!-- /.container -->

	</body>
</html>



<!-- Jumbotron Header 
	        <header class="jumbotron hero-spacer">
	            <h1>A Warm Welcome!</h1>
	            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
	            <p><a class="btn btn-primary btn-large">Call to action!</a>
	            </p>
	        </header>
-->

