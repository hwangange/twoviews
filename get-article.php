<?php
	
	require "config.php";
	$conn = new mysqli(hostname, username, password, db_name) or die ("could not connect to mysql");
	
			?>
			<div class = "row hero-spacer">
	    		<div class = "col-md-9 article-padding">
			<?php

				$sql = "SELECT title, author, date, text, image, genre, tags FROM articles WHERE id = ?";
				if($stmt = $conn->prepare($sql)) { // assuming $conn is the connection
			   		$stmt->bind_param('s', $id);
			   		$id = $_GET['id'];
				    $stmt->execute();
				    $stmt->store_result();
				    $stmt->bind_result($title, $author, $date, $text, $image, $genre, $tags);
				    
				    while($stmt->fetch()) {
						$title = stripslashes($title);
						$text = stripslashes($text);
						$tags = stripslashes($tags); 
						$genreClass = 'genre-'.$genre;

						$finalText = "";

						$output = str_replace(array("\r\n", "\r"), "\n", $text);
						$lines = explode("\n", $output);
						$new_lines = array();

						foreach ($lines as $i => $line) {
						    if(!empty($line))
						        $new_lines[] = trim($line);
						}
						$finalText = $finalText . implode($new_lines);

						$genreText = $genre;

						if($genre == "edit") $genreText = "Editorial";
						$genreText = strtoupper($genreText);


						$tags = str_replace(' ', '', $tags);
						$tagArray = explode(',', $tags);

						?>
							<div class = 'genre <?php echo $genreClass;?>'><?php echo $genreText; ?></div>
							<h1><?php echo $title;?></h1>
	    					<p><a href = "author.php?author=<?php echo $author; ?>"><span><?php echo $author; ?></span></a><span>	|	</span><span><?php echo $date; ?></span></p>
	    					<br>

		    			<?php	if(substr($image, 0, 3) == 'img') {
		    					echo "<img class = 'article-image centered' src = '$image'>";
		    				}
		    				
		    				else echo $image;

		    			?>	<br><br>
		    					<div id = 'article-text'>
		    					<?php echo $finalText;?>
				        		<br><br>
				        		<span>Tags: </span>
				        <?php
					    	foreach($tagArray as $tag) {
					    		echo "<a href = 'tags.php?tag=$tag'><span>$tag</span></a>	";
					    	}
				        	echo "
								</div>";

						
					}
				} else { echo "Could not prepare statement.";}


	 ?>

					<div id="disqus_thread"></div>
					<script>
					    /**
					     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
					     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
					     */
					    
					    var disqus_config = function () {
					        this.page.url = '<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>';  // Replace PAGE_URL with your page's canonical URL variable
					        this.page.identifier = "<?php echo $_SESSION['id']; ?>"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
					    };
					    
					    (function() {  // DON'T EDIT BELOW THIS LINE
					        var d = document, s = d.createElement('script');
					        
					        s.src = '//twoviews.disqus.com/embed.js';
					        
					        s.setAttribute('data-timestamp', +new Date());
					        (d.head || d.body).appendChild(s);
					    })();
					</script>
					<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

				</div> <!--end col-md-9 -->
				<div class = "article-sidebar col-md-3">
	    			<?php require 'get-recent.php'; ?>

	    			
	    			<?php require 'tag-list.php'; ?>
	    			<a class="twitter-timeline" data-height="500" data-theme="light" href="https://twitter.com/TwoViewsPress">Tweets by TwoViewsPress</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

	    			
	    		</div> <!-- end col-md-3 -->
			</div> <!--end row -->

				<?php 
				$stmt->close();
				$conn->close();

?>

