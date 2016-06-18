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
			      <img src="img/image1.jpg" alt="New York" class = "centered-and-cropped">
			      <div class="carousel-caption">
			        <h3>New York</h3>
			        <p>The atmosphere in New York is lorem ipsum.</p>
			      </div> 
			    </div>

			    <div class="item">
			      <img src="img/image2.jpg" alt="Chicago" class = "centered-and-cropped">
			      <div class="carousel-caption">
			        <h3>Chicago</h3>
			        <p>Thank you, Chicago - A night we won't forget.</p>
			      </div> 
			    </div>

			    <div class="item">
			      <img src="img/image3.jpg" alt="Los Angeles" class = "centered-and-cropped">
			      <div class="carousel-caption">
			        <h3>LA</h3>
			        <p>Even though the traffic was a mess, we had the best time.</p>
			      </div> 
			    </div>

			    <div class="item">
			      <img src="img/image4.jpg" alt="Los Angeles" class = "centered-and-cropped">
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

	        <?php require 'database/get-home-articles.php'; ?>
	

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

