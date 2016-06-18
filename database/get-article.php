<?php
	require_once 'connection.php';

	class article {

		private $db;
		private $connection;

		function __construct(){
			$this->db = new DB_Connection();
			$this->connection = $this->db->get_connection();
		}

		public function find_article(){
				$session_id = $_SESSION["id"];
				$query = "Select * from articles WHERE id = $session_id";
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
						$genreClass = 'genre-'.$genre;

						$genre = strtoupper($genre);

						$tags = str_replace(' ', '', $tags);
						$tagArray = explode(',', $tags);

						echo"

							<div class = 'genre $genreClass' id = '$genreID'>$genre</div>
							<h1>$title</h1>
	    					<p><span>$author</span><span>	|	</span><span>$date</span></p>
	    					<br>
	    					<img class = 'preview-image' src = '$image'>
	    					<br><br>
	    					<div id = 'article-text'>
	    					<script>
			        			var element = document.getElementById('article-text');
			        			element.innerHTML += '$text'; 
			        		</script>
			        		<br><br>
			        		<span>Tags: </span>";
				    	foreach($tagArray as $tag) {
				    		echo "<a href = 'tags.php?tag=$tag'><span>$tag</span></a>	";
				    	}
			        	echo "
							</div>";
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

	$article = new article();
	$data = array();	
	$article -> find_article();
		
?>