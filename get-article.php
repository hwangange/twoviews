<?php
	require_once 'connection.php';
	require_once 'display-media.php';
	class article {

		private $db;
		private $connection;

		function __construct(){
			$this->db = new DB_Connection();
			$this->connection = $this->db->get_connection();
		}

		public function find_article(){
			?>
			<div class = "row hero-spacer">
	    		<div class = "col-md-9">
			<?php
				$session_id = $_SESSION["id"];
				$query = "Select * from articles WHERE id = '$session_id'";
				$result = mysqli_query($this->connection, $query);
				if(mysqli_num_rows($result)!=0){
					$count = 0;
					$length = mysqli_num_rows($result);
					$data = array('success' => 'Results found.', 'length' => $length);

					while ($row = $result->fetch_assoc()) {
						$id = $row['id'];
						$title = stripslashes($row['title']);
						$author = stripslashes($row['author']);
						$date = $row['date'];
						$text = stripslashes($row['text']);
						$image = $row['image'];
						$genre= $row['genre'];
						$tags = stripslashes($row['tags']);
						$genreID = 'genre'.$id;
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

						echo"

							<div class = 'genre $genreClass' id = '$genreID'>$genreText</div>
							<h1>$title</h1>
	    					<p><span>$author</span><span>	|	</span><span>$date</span></p>
	    					<br>
	    					<img class = 'article-image centered' src = '$image'>
	    					<br><br>
	    					<div id = 'article-text'>
	    					$finalText
			        		<br><br>
			        		<span>Tags: </span>";
				    	foreach($tagArray as $tag) {
				    		echo "<a href = 'tags.php?tag=$tag'><span>$tag</span></a>	";
				    	}
			        	echo "
							</div>";
					}
				} ?>

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

				mysqli_close($this->connection);
		}

	}
?>

<?php

	$article = new article();
	$data = array();	
	$article -> find_article();
		
?>

