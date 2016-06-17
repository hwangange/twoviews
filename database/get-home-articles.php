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

				$query = "Select * from articles ORDER BY id DESC LIMIT 5";
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

						if (strlen($string) > 500) {

						    // truncate string
						    $stringCut = substr($string, 0, 500);

						    // make sure it ends in a word so assassinate doesn't become ass...
						    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'<br><a href="index.php">Read More</a>'; 
						}

						echo"
							<div class = 'preview-article'>
								<div class = 'genre' id = '$genreID'></div>
			        			<h1>$title</h1>
			        			<p><span>$author</span><span>	|	</span><span>$date</span></p>	
			        			<br>
                         		<img class = 'preview-image' src = '$image'>
                         		<br><br>
			        			<div>
				    				<p>$string</p>
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