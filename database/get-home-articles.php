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
				} 

				/*if(mysql_num_rows($result)) {
					while($row = mysql_fetch_assoc($result)) {
						$data['emp_info'][] = $row;
					}
				}*/

				mysqli_close($this->connection);
		}

	}

	$home_articles = new home_articles();
	$data = array();	
	$home_articles -> find_articles();
		
?>