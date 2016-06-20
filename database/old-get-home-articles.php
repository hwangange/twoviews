<?php
	require_once 'connection.php';

	class home_articles {

		private $db;
		private $connection;

		function __construct(){
			$this->db = new DB_Connection();
			$this->connection = $this->db->get_connection();
		}

		public function find_articles(){

				$query = "Select * from articles ORDER BY id DESC LIMIT 6";
				$result = mysqli_query($this->connection, $query);
				if(mysqli_num_rows($result)==0){
					$data = array('empty' => 'No results found.');
							//$json['empty'] = 'No results found.';
				}else{
					$count = 0;
					$length = mysqli_num_rows($result);
					$data = array('success' => 'Results found.', 'length' => $length);

					while ($row = $result->fetch_assoc()) {
						$id = $row['id'];
						$title = $row['title'];
						$author = $row['author'];
						$date = $row['date'];
						$text = $row['text'];
						$image = $row['image'];
						$genre= $row['genre'];
						$tags = $row['tags'];
						$genreID = 'genre'.$id;

						$string = strip_tags($text);

						if (strlen($string) > 100) {

						    // truncate string
						    $stringCut = substr($string, 0, 100);

						    // make sure it ends in a word so assassinate doesn't become ass...
						    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="article.php?id='.$id.'">Read More</a>'; 
						}

						$tags = str_replace(' ', '', $tags);
						$tagArray = explode(',', $tags);

						$uppercase = ucfirst($genre);

						if($count<6) {
							echo"
								<div class = 'preview-article'>
									<a href = 'genre.php?genre=$uppercase'><div class = 'genre' id = '$genreID'></div></a>
				        			<a href = 'article.php?id=$id'><h1>$title</h1></a>
				        			<p><span>$author</span><span>	|	</span><span>$date</span></p>	
				        			
	                         		<img class = 'preview-image' src = '$image'>
	                         		<br>
				        			<div>
					    				<p>$string</p>
					    				<span>Tags: </span>";
					    	foreach($tagArray as $tag) {
					    		echo "<a href = 'tags.php?tag=$tag'><span>$tag</span></a>	";
					    	}
				        	echo "
				        			</div>
					    			<br>
				        		</div>
				        		<script>
				        			var element = document.getElementById('$genreID');
				        			element.className += ' genre-' + '$genre';
				        			element.innerHTML += '$genre'.toUpperCase(); 
				        		</script>";
				        }
				        $count+=1;
				        if($count==6) { ?>
				        			</div> <!-- end grid -->
				        			<div class = "row">
				        				<div class = "col-md-6 col-xs-12">
				        					<div class = "media">
					        					<div class = "media-left">
					        						<a href="#"><img class = "media-object" src = "img/image1.jpg"></a>
					        					</div>
					        					<div class = "media-body">
					        						<h4 class = "media-heading">Media heading</h4>
					        						<p>Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text... </p>
					        					</div>
					        				</div>
					        				<div class = "media">
					        					<div class = "media-left">
					        						<a href="#"><img class = "media-object" src = "img/image1.jpg"></a>
					        					</div>
					        					<div class = "media-body">
					        						<h4 class = "media-heading">Media heading</h4>
					        						<p>Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text... </p>
					        					</div>
					        				</div>
					        				<div class = "media">
					        					<div class = "media-left">
					        						<a href="#"><img class = "media-object" src = "img/image1.jpg"></a>
					        					</div>
					        					<div class = "media-body">
					        						<h4 class = "media-heading">Media heading</h4>
					        						<p>Text Text Text Text Text Text Text Text Text Text Text Text Text Text Text... </p>
					        					</div>
					        				</div>					        				
				        				</div>
				        				<div class = "col-md-6 col-xs-12">
				        					<div><img src = "img/image1.jpg" class = "centered-and-cropped second-row-image"></div>        				
				        				</div>
				        			</div>
					        	</div> <!-- end column -->

					        	<div class = "col-md-3">
					        		<h3 class = "article-sidebar-item">Who We Are</h3>
					    			<hr class = "less-hr">
					    			<img src = "img/two_views_logo.jpg" class = "centered">
					    			<p>Two Views is a student run online news service. We offer opinionated and sophisticated editorials, fresh perspectives on current events, and articles on the latest news.</p>

					    			<h3 class = "article-sidebar-item">Search By Tags</h3>
					    			<hr class = "less-hr">
					    			<p>To create your first image blog post, click here and select 'Add & Edit Posts' > All Posts > This is the title of your first image post.Great looking images make your blog posts more visually compelling for your audience, and encourage readers to keep coming back. </p>

					    			<a class="twitter-timeline" data-height="500" data-theme="light" href="https://twitter.com/TwoViewsPress">Tweets by TwoViewsPress</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
					        	</div>
					        </div>



				     <?php   }
				     	else if ($count > 6) {

				     	}
					}
				} 

				/*if(mysql_num_rows($result)) {
					while($row = mysql_fetch_assoc($result)) {
						$data['emp_info'][] = $row;
					}
				}*/

				mysqli_close($this->connection);
		}

	}
?>

<div class = "row">
	<div class = "col-md-9">
		<div id = "grid" data-columns>
<?php

	$home_articles = new home_articles();
	$data = array();	
	$home_articles -> find_articles();
		
?>