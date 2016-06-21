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
			  <ol class="list-group col-sm-4">
			    <li data-target="#myCarousel" data-slide-to="0" class="list-group-item active" id = "carousel-1"></li>
			    <li data-target="#myCarousel" data-slide-to="1" class = "list-group-item" id = "carousel-2"></li>
			    <li data-target="#myCarousel" data-slide-to="2" class = "list-group-item" id = "carousel-3"></li>
			    <li data-target="#myCarousel" data-slide-to="3" class = "list-group-item" id = "carousel-4"></li>
			    <li data-target="#myCarousel" data-slide-to="4" class = "list-group-item" id = "carousel-5"></li>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner">
			    

	        <?php require 'database/get-home-articles.php'; ?>

		
	    </div>
	    <!-- /.container -->
	    <?php require 'footer.php'; ?>

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

