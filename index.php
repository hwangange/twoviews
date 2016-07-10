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
	    	
			    

	        <?php require 'temp_get_home.php'; ?>

		
	    </div>
	    <!-- /.container -->
	    <?php require 'footer.php'; ?>

	</body>
	<script src="js/salvattore.js"></script>

	<script>
		$width = $('.pretty-box').innerWidth() - 20;
		$('.holdTitle').css({'width': $width});

		$largestHeight = 0;
		$(".column").each(function() {
			$height = $(this).height();
			if($height > $largestHeight)
				$largestHeight = $height;
		});

		$(".column").each(function() {
			$height = $(this).height();
			$difference = $largestHeight - $height;
			$equalDis = $difference/2;

			$prettyHeight = $(this).find(".pretty-box").eq(0).height();
			$prettyWidth = $(this).find(".pretty-box").eq(0).width();
			$(this).find(".pretty-box").eq(0).css({"height":$prettyHeight + $equalDis});

			$(this).find(".pretty-box").find("img").eq(0).css({"width":$prettyWidth});
			$(this).find(".pretty-box").find("img").eq(0).css({"height":$prettyHeight + $equalDis});

			$prettyHeight = $(this).find(".pretty-box").eq(1).height();
			$prettyWidth = $(this).find(".pretty-box").eq(1).width();
			$(this).find(".pretty-box").eq(1).css({"height":$prettyHeight + $equalDis});

			$(this).find(".pretty-box").find("img").eq(1).css({"width":$prettyWidth});
			$(this).find(".pretty-box").find("img").eq(1).css({"height":$prettyHeight + $equalDis});
		});
	</script>
</html>



<!-- Jumbotron Header 
	        <header class="jumbotron hero-spacer">
	            <h1>A Warm Welcome!</h1>
	            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
	            <p><a class="btn btn-primary btn-large">Call to action!</a>
	            </p>
	        </header>
-->

