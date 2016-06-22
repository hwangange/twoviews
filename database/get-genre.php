<?php
	require_once 'connection.php';

	class genre_articles {

		private $db;
		private $connection;

		function __construct(){
			$this->db = new DB_Connection();
			$this->connection = $this->db->get_connection();
		}

		public function find_articles(){
			?>
			<div class = "row">
				<div class = "col-md-9">
			<?php
				$genre = $_SESSION['genre'];
				$query = "Select * from articles WHERE genre LIKE '".$genre."' ORDER BY id";
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
						    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'<br><a href="article.php?id='.$id.'">Read More</a>'; 
						}

						$tags = str_replace(' ', '', $tags);
						$tagArray = explode(',', $tags);



						echo "
							<div> <div class = 'genre' id = '$genreID'></div></div>
							<div class = 'row'>
				    			<div class = 'col-md-3'>
				    				<img class = 'tag-img' src = '$image'>
				    			</div>
				    			<div class = 'col-md-9 tag-text'>
				    				<a href = 'article.php?id=$id'><h3>$title</h3></a>
				    				<p><span>$author</span><span>	|	</span><span>$date</span></p>
				    				<p>$string</p>
				    			</div>
				    		</div>
				    		<div><span>Tags: </span>";


				    			foreach($tagArray as $tag) {
				    				echo "<a href = 'tags.php?tag=$tag'><span>$tag</span></a>	";
				    			}

				    			echo "</div>
				    		<br>
			        		
			        		<script>
			        			var element = document.getElementById('$genreID');
			        			element.className += ' genre-' + '$genre';
			        			element.innerHTML += '$genre'.toUpperCase(); 
			        		</script>";
					}
				}
				?>
				</div> <!-- end col-md-9 -->
				<div class = "article-sidebar col-md-3">
					<?php require 'get-recent.php'; ?>

		    		<?php require 'tag-list.php'; ?>


	    		</div> <!-- end col-md-3 -->
	    	</div> <!-- end row -->
				<?php 

				mysqli_close($this->connection);
		}

	}

	$genre_articles = new genre_articles();
	$data = array();	
	$genre_articles -> find_articles();
		
?>