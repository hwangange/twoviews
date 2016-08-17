<?php
	require "config.php";
	$conn = new mysqli(hostname, username, password, db_name) or die ("could not connect to mysql");

	
			?> 
			<div class = "row">
				<div class = "col-md-9">
			<?php
				$sql = "SELECT id, title, author, date, text, image, genre, tags FROM articles WHERE tags LIKE ? ORDER BY date DESC LIMIT 10";
				if($stmt = $conn->prepare($sql)) { // assuming $conn is the connection
			   		$stmt->bind_param('s', $tag);
			   		$tag = "%{$_SESSION['tag']}%";
			   		$stmt->execute();
			   		$stmt->store_result();
				    $length = $stmt->num_rows;
				    $stmt->bind_result($id, $title, $author, $date, $text, $image, $genre, $tags);
				    while($stmt->fetch()) {
				    	$title = stripslashes($title);
						$author = stripslashes($author);
						$text = stripslashes($text);
						$tags = stripslashes($tags);

						$genreText = $genre;
						if($genre == "edit") { $genreText = "Editorial"; }

						$string = strip_tags($text);

						if (strlen($string) > 300) {

						    // truncate string
						    $stringCut = substr($string, 0, 300);

						    // make sure it ends in a word so assassinate doesn't become ass...
						    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'<br><a href="article.php?id='.$id.'">Read More</a>'; 
						}

						$tags = str_replace(' ', '', $tags);
						$tagArray = explode(',', $tags);



						echo "
							<div> <div class = 'genre' id = '$id'></div></div>
							<div class = 'row'>
				    			<div class = 'col-md-3'>
				    				<img class = 'tag-img' src = '$image'>
				    			</div>
				    			<div class = 'col-md-9 tag-text' >
				    				<a href = 'article.php?id=$id'><h3 style = 'margin-top: 0'>$title</h3></a>
				    				<p><span>$author</span><span>	|	</span><span>$date</span></p>
				    				<p>$string</p>
				    			
				    		<div><span>Tags: </span>";


				    			foreach($tagArray as $tag) {
				    				echo "<a href = 'tags.php?tag=$tag'><span>$tag</span></a>	";
				    			}

				    			echo "</div>
				    			</div>
				    		</div>
				    		<br>
			        		
			        		<script>
			        			var element = document.getElementById('$id');
			        			element.className += ' genre-' + '$genre';
			        			element.innerHTML += '$genreText'.toUpperCase(); 
			        		</script>";
				    }
				    $stmt->close();

				}?> </div> <!--end col-md-9 -->
				<div class = "col-md-3">
					<?php require 'get-recent.php'; ?>

		    		<?php require 'tag-list.php'; ?>
		    		<a class="twitter-timeline" data-height="500" data-theme="light" href="https://twitter.com/TwoViewsPress">Tweets by TwoViewsPress</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>


	    		</div> <!-- end col-md-3 -->
	    	</div> <!-- end row -->
				<?php 

				
				$conn->close();
		

	

	
		
?>