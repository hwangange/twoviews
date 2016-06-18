<?php
	require_once 'connection.php';

	class tag_articles {

		private $db;
		private $connection;

		function __construct(){
			$this->db = new DB_Connection();
			$this->connection = $this->db->get_connection();
		}

		public function find_articles(){
				$tag = $_SESSION['tag'];
				$query = "Select * from articles WHERE tags LIKE '%".$tag."%' ORDER BY id DESC LIMIT 5";
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

				/*if(mysql_num_rows($result)) {
					while($row = mysql_fetch_assoc($result)) {
						$data['emp_info'][] = $row;
					}
				}*/

				mysqli_close($this->connection);
		}

	}

	$tag_articles = new tag_articles();
	$data = array();	
	$tag_articles -> find_articles();
		
?>