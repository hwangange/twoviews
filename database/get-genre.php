<?php
	require_once 'connection.php';

	function echo_stuff($array, $x) {
		if($x < sizeof($array)) {
			$id = $array[$x][0];
			$title = $array[$x][1];
			$author = $array[$x][2];
			$date = $array[$x][3];
			$text = $array[$x][4];
			$image = $array[$x][5];
			$genre= $array[$x][6];
			$tags = $array[$x][7];
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

			echo " <div class = 'panel panel-default'> <div class = 'panel-body'>
										    			
						<img class = 'tag-img' src = '$image'>
						<a href = 'article.php?id=$id'><h3>$title</h3></a>
					    <p><span>$author</span><span>	|	</span><span>$date</span></p>
					    <p>$string</p>
						<p><span>Tags: </span>";


					    foreach($tagArray as $tag) {
					    	echo "<a href = 'tags.php?tag=$tag'><span>$tag</span></a>	";
					    }

					    echo "</p>
					    	</div></div>
					    <br>";
			}
	}

	function echo_breaking_news($array, $x) {
		if($x < sizeof($array)) {
			$id = $array[$x][0];
			$title = $array[$x][1];
			$author = $array[$x][2];
			$date = $array[$x][3];
			$text = $array[$x][4];
			$image = $array[$x][5];
			$genre= $array[$x][6];
			$tags = $array[$x][7];
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

			if($x==0) {
				echo "<div class = 'inner'>
						<img class = 'tag-img' src = '$image'>
								<a href = 'article.php?id=$id'><h1><b>$title</b></h1></a>
				    </div>
					<br>";
			}

			else echo " <div>					    			
							<img class = 'tag-img' src = '$image'>
							<a href = 'article.php?id=$id'><h3><b>$title</b></h3></a>
				    	</div>
					    <br>";
		}
	}

	function print_col_45($array, $length, $start) {
		for($x = $start; $x < $length; $x+=2) {
			echo_stuff($array, $x);			
		}	
	}

	class genre_articles {

		private $db;
		private $connection;

		function __construct(){
			$this->db = new DB_Connection();
			$this->connection = $this->db->get_connection();
		}

		public function find_articles(){ ?>							

		<?php
			
				$genre = $_SESSION['genre'];
				$query = "Select * from articles WHERE genre LIKE '".$genre."' ORDER BY id";
				$result = mysqli_query($this->connection, $query);

				if(mysqli_num_rows($result)==0){
					$data = array('empty' => 'No results found.');
							//$json['empty'] = 'No results found.';
				}else{ 
					$length = mysqli_num_rows($result);
					$array = mysqli_fetch_all($result);
					if($length > 3) {
						$start = array(3,4); ?>
					<div class = "row">
						<div class = "col-md-8">
							<div class = "outer">
								<div class = "middle">

					<?php	echo_breaking_news($array, 0); ?>
								
							</div>
						</div>
					</div> <!-- end col-md-8-->
					<div class = "col-md-4"> 

					<?php
						echo_breaking_news($array, 1);
						echo_breaking_news($array, 2);
					?>
						
					</div> <!-- end col-md-4-->
				</div><!-- end row -->
				<hr> 
				<?php
					} else {
						$start = array(0,1);
					}//end if, else there are more than 3 articles

				?>
			<div class = "row">
				<div class = "col-md-9">
					<div class = "row">
						<div class = "col-md-6">
				<?php
					
					print_col_45($array, $length, $start[0]);
				?>		</div><!--end col-md-6-->
						<div class = "col-md-6">
				<?php
					
					print_col_45($array, $length, $start[1]);			
				}
				?>
						</div> <!-- end col-md-6 -->
					</div><!-- end row with 6's -->
					
						</div> <!-- end col-md-9 -->
				<div class = "article-sidebar col-md-3">
					<?php require 'get-recent.php'; ?>

		    		<?php require 'tag-list.php'; ?>
		    		<a class="twitter-timeline" data-height="500" data-theme="light" href="https://twitter.com/TwoViewsPress">Tweets by TwoViewsPress</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>


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