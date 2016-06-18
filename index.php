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
	    	<div id="myCarousel" class="carousel slide hero-spacer" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
			    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			    <li data-target="#myCarousel" data-slide-to="1"></li>
			    <li data-target="#myCarousel" data-slide-to="2"></li>
			    <li data-target="#myCarousel" data-slide-to="3"></li>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
			    <div class="item active">
			      <img src="img/image1.jpg" alt="New York">
			      <div class="carousel-caption inline">
			        <h3>New York</h3>
			        <p>The atmosphere in New York is lorem ipsum.</p>
			      </div> 
			    </div>

			    <div class="item">
			      <img src="img/image2.jpg" alt="Chicago">
			      <div class="carousel-caption">
			        <h3>Chicago</h3>
			        <p>Thank you, Chicago - A night we won't forget.</p>
			      </div> 
			    </div>

			    <div class="item">
			      <img src="img/image3.jpg" alt="Los Angeles">
			      <div class="carousel-caption">
			        <h3>LA</h3>
			        <p>Even though the traffic was a mess, we had the best time.</p>
			      </div> 
			    </div>

			    <div class="item">
			      <img src="img/image4.jpg" alt="Los Angeles">
			      <div class="carousel-caption">
			        <h3>LA</h3>
			        <p>Even though the traffic was a mess, we had the best time.</p>
			      </div> 
			    </div>
			  </div>

			  <!-- Left and right controls -->
			  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
	        <br>

	        <div class = "row">
	        	<div class = "col-md-9">
	        		<div id = "grid" data-columns>
	        			<?php require 'database/get-home-articles.php'; ?>
	        		</div>
	        	</div>

	        	<div class = "col-md-3">
	        		<h3 class = "article-sidebar-item">Who We Are</h3>
	    			<hr>
	    			<img src = "img/two_views_logo.jpg" class = "centered">
	    			<p>Two Views is a student run onling news service. We offer opinionated and sophisticated editorials, fresh perspectives on current events, and articles on the latest news.</p>

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

		<?php require 'footer.php'; ?>
	    </div>
	    <!-- /.container -->

	</body>
	<script src="js/salvattore.js"></script>
</html>



<!-- Jumbotron Header 
	        <header class="jumbotron hero-spacer">
	            <h1>A Warm Welcome!</h1>
	            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
	            <p><a class="btn btn-primary btn-large">Call to action!</a>
	            </p>
	        </header>
-->

