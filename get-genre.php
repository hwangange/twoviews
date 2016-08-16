<?php
	require "config.php";
	$conn = new mysqli(hostname, username, password, db_name) or die ("could not connect to mysql");

	function echo_stuff($id, $title, $author, $date, $text, $image, $genre, $tags) {
		
			$title = stripslashes($title);
			$author = stripslashes($author);
			$text = stripslashes($text);
			$tags = stripslashes($tags);
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



			$returnString = " <div class = 'panel panel-default'> <div class = 'panel-body'>
										    			
						<img class = 'tag-img' src = '$image'>
						<a href = 'article.php?id=$id'><h3>$title</h3></a>
					    <p><span>$author</span><span>	|	</span><span>$date</span></p>
					    <p>$string</p>
						<p><span>Tags: </span>";


					    foreach($tagArray as $tag) {
					    	$returnString.= "<a href = 'tags.php?tag=$tag'><span>$tag</span></a>	";
					    }

					    $returnString.= "</p>
					    	</div></div>
					    <br>";
			

			return $returnString;
	}

	function echo_breaking_news($count, $id, $title, $author, $date, $text, $image, $genre, $tags) {
			$title = stripslashes($title);
			$author = stripslashes($author);
			$text = stripslashes($text);
			$tags = stripslashes($tags);

			$string = strip_tags($text);
			if (strlen($string) > 100) {

								    // truncate string
				$stringCut = substr($string, 0, 100);

								    // make sure it ends in a word so assassinate doesn't become ass...
				$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'<br><a href="article.php?id='.$id.'">Read More</a>'; 
			}

			$tags = str_replace(' ', '', $tags);
			$tagArray = explode(',', $tags);

			if($count==0) {
				echo "<div class = 'inner' id = 'children-tobe'>
						<img class = 'big-tag-img' src = '$image'>
								<a href = 'article.php?id=$id'><h1 style = 'text-align: center'><b>$title</b></h1></a>
				    </div>
					<br>";
			}

			else echo " <div>					    			
							<img class = 'tag-img' src = '$image'>
							<a href = 'article.php?id=$id'><h3 style = 'text-align: center'><b>$title</b></h3></a>
				    	</div>
					    <br>";
		
	}



							

				

				$sql = "SELECT id, title, author, date, text, image, genre, tags FROM articles WHERE genre = ? ORDER BY date DESC";
				if($stmt = $conn->prepare($sql)) { // assuming $conn is the connection
			   		$stmt->bind_param('s', $genre);
			   		$genre = $_SESSION['genre'];
				    $stmt->execute();
				    $stmt->store_result();
				    
				    $stmt->bind_result($id, $title, $author, $date, $text, $image, $genre, $tags);
				    $length = $stmt->num_rows;

				    $count = 0;
				   
				    	$leftColumn = "";
				    	$rightColumn = "";
				    	
				    	while($stmt->fetch()) {
				    		if($count==0) {
				    		?>

						    	<div class = "row">
								<div class = "col-md-8" id = "parent-tobe">
									
											<?php echo_breaking_news($count, $id, $title, $author, $date, $text, $image, $genre, $tags); ?>
										
								</div> <!-- end col-md-8 -->
				    <?php
				    		}
				    		if($count==1) {
				    		?>
				    			<div class = "col-md-4">
				    				<?php echo_breaking_news($count, $id, $title, $author, $date, $text, $image, $genre, $tags); ?>
				    		<?php
				    		}

				    		if($count==2) {
				    		?>
				    			<?php echo_breaking_news($count, $id, $title, $author, $date, $text, $image, $genre, $tags); ?>
				    			
				    		<?php
				    		}

				    		if($count==2 || ($count==1 && $count==$length-1)) {
				    		?>
				    			</div> <!-- end col-md-4 -->
				    			</div> <!-- end row -->
				    			
				    		<?php
				    		}

				    		if($count > 2 && fmod($count, 2) ==1) { $leftColumn.=echo_stuff($id, $title, $author, $date, $text, $image, $genre, $tags); }
				    		else if ($count > 2 && fmod($count, 2) ==0) { $rightColumn.=echo_stuff($id, $title, $author, $date, $text, $image, $genre, $tags);}

				    		$count = $count + 1;
						}

						if($length > 3) {
						?>
							<hr>
							<div class = "row">
							<div class = "col-md-9">
								<div class = "row">
									<div class = "col-md-6">
										<?php echo $leftColumn;?>
									</div>
									<div class = "col-md-6">
										<?php echo $rightColumn; ?>
									</div>
								</div>
							</div>
							<div class = "article-sidebar col-md-3">
									<?php require 'get-recent.php'; ?>

						    		<?php require 'tag-list.php'; ?>
						    		<a class="twitter-timeline" data-height="500" data-theme="light" href="https://twitter.com/TwoViewsPress">Tweets by TwoViewsPress</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>


					    		</div> <!-- end col-md-3 -->
					    	</div> <!-- end row -->
						<?php
					}
				     $stmt->close();

				   
			}
				

				$conn->close();

				/****************************************/
			
			/*	$genre = $_SESSION['genre'];
				$query = "Select * from articles WHERE genre LIKE '".$genre."' ORDER BY date DESC";
				$result = mysqli_query($this->connection, $query);

				if(mysqli_num_rows($result)==0){
					echo "No results found.";
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

				mysqli_close($this->connection);  */
		

	
		
?>