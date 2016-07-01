<?php
	require_once 'connection.php';
	require 'display-media.php';

	function truncate_noId($text, $length) {
		$string = strip_tags($text);

		if (strlen($string) > $length) {
		    $stringCut = substr($string, 0, $length);
		    $string = substr($stringCut, 0, strrpos($stringCut, ' ')); 
		}

		return $string;
	}

	function truncate($text, $length, $id) {
			$string = truncate_noId($text, $length);
			$string = $string.'... <a href="article.php?id='.$id.'">Read More</a>';

			return $string;
	}

	function vertical_column($news) {
		$id = $news[0]['id'];
		$title = $news[0]['title'];
		$image = $news[0]['image'];
		$string = truncate($news[0]['text'], 50, $id);
	?>

		<ul class = 'list-group'>
			<li class = "list-group-item">
				<div class = 'md-article'>
					<img class = 'med-img-home' src = '<?php echo $image;?>' >
					<h4><b><a href = "article.php?id=<?php echo $id;?>"><?php echo $title;?></a></b></h4>
					<p><?php echo $string;?></p>
				</div>
 			</li>
	<?php
			print_bottom_articles($news);

			?></ul><?php
	}

	function print_bottom_articles($news) {
		$length = sizeof($news);
		for($x = 1; $x < $length; $x++) {
			$title = $news[$x]['title'];
			$id = $news[$x]['id'];
			echo "<li class = 'list-group-item'><a href = 'article.php?id=".$id."'>$title</a></li>";
		}
	}

	class home_articles {

		private $db;
		private $connection;

		function __construct(){
			$this->db = new DB_Connection();
			$this->connection = $this->db->get_connection();
		}

		public function find_articles(){ ?>
			<div id="myCarousel" class="carousel slide hero-spacer" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="list-group col-sm-4">
			    <li data-target="#myCarousel" data-slide-to="0" class="list-group-item active" id = "carousel-1"></li>
			    <li data-target="#myCarousel" data-slide-to="1" class = "list-group-item" id = "carousel-2"></li>
			    <li data-target="#myCarousel" data-slide-to="2" class = "list-group-item" id = "carousel-3"></li>
			    <li data-target="#myCarousel" data-slide-to="3" class = "list-group-item" id = "carousel-4"></li>
			    <li data-target="#myCarousel" data-slide-to="4" class = "list-group-item" id = "carousel-5"></li>
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner">
		<?php

				//CAROUSEL
				$query = "Select * from articles WHERE breaking = '1' ORDER by id DESC LIMIT 5";
				$result = mysqli_query($this->connection, $query);
				if(mysqli_num_rows($result)!=0){
					$count = 1;
					$length = mysqli_num_rows($result);
					while ($row = $result->fetch_assoc()) {
						$id = $row['id'];
						$title = $row['title'];
						$text = $row['text'];
						$image = $row['image'];

						$string = truncate($text, 40, $id);
						if($count==1) {
							echo "<div class='item active' id = '$id'>
							      <img src= '$image' class = 'centered-and-cropped'>
							      <div class='carousel-caption'>
							        <h2><a href = 'article.php?id=".$id."'>$title</a></h2>
							        <p>$string</p>
							      </div> 
							   </div>";
						} else {
							echo "<div class='item' id = '$id'>
							      <img src= '$image' class = 'centered-and-cropped'>
							      <div class='carousel-caption'>
							        <h2><a href = 'article.php?id=".$id."'>$title</a></h2>
							        <p>$string</p>
							      </div> 
							   </div>";
						}


							echo "<script> var element = document.getElementById('carousel-".$count."');
				        			element.innerHTML += '<h3>".$title."</h3>';</script>";
				        $count = $count + 1;
				        $data[] = $id;
					}
				} ?>
					</div><!-- end carousel-inner-->
					<div class = "carousel-controls">
					  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
					</div>
				</div> <!-- End #myCarousel-->
		        <br>

				<?php

				//PRETTY BOXES
				echo "
					<div class = 'row'><div class = 'col-md-12'>
					<div id = 'grid' data-columns>";
				$count = 1;
				$genres = array('1' => 'us', '2' => 'international', '3' => 'science', '4' =>'school', '5' => 'life', '6' => 'entertainment');
				while($count < 7) {
					$query = "Select * from articles WHERE breaking = '0' AND genre = '".$genres[strval($count)]."' ORDER BY date DESC LIMIT 1";
					$result = mysqli_query($this->connection, $query);
					if(mysqli_num_rows($result)!=0){
						
						$length = mysqli_num_rows($result);

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

							$uppercase = ucfirst($genre);
							//$title = truncate_noId($title, 100);
							echo"
									<div class = 'preview-article pretty-box' style = 'background-color: black'>							
										<div class = 'hold-image'>
											<img src = '$image'>
										</div> 
											<a href = 'genre.php?genre=$uppercase&page=1'><div class = 'genre' id = '$genreID'></div></a>
											<br><br>
											<div class = 'container text'>
							        			<div class = 'holdTitle'><a href = 'article.php?id=$id'><h2>$title</h2></a></div>
							        			<p><span>$author</span><span>	|	</span><span>$date</span></p>	
						        			</div>
		                         			<br><br>
					        		</div>
					        		<script>
					        			var element = document.getElementById('$genreID');
					        			element.className += ' genre-' + '$genre';
					        			element.innerHTML += '$genre'.toUpperCase(); 


					        		</script>";
					        $data[] = $id;
					        
					        
					       }
					      }
					      $count = $count + 1;
				     }
				   ?>
				        			</div> <!-- end grid -->
				        			</div><!-- end col -->
				        			</div><!-- end row-->

				        			<div class = "row">
				        				<div class = "col-md-3 col-xs-12 top-pad">
				        					<div>
					        					<h3>Latest</h3>
					        					<div class="panel panel-default">
												  <div class="panel-body" id = "latest">
												    <!--media goes here -->
												  </div>
												</div>
						        			</div>

											<?php 
						        				$query = "Select * from articles WHERE breaking = '0' AND genre = 'edit' ORDER BY id DESC LIMIT 4";
												$result = mysqli_query($this->connection, $query);
												$news = array();
												while($row = $result->fetch_assoc()) {
													$news[] = $row;
													$data[] = $row['id'];
													}			
						        			?>
						        				
						        			<div class = "edit-news-home">
						        				<h3>Editorials</h3>
							        			<?php vertical_column($news);?>
						        			</div>

						        			<div class = "poll container-fluid">		
							        			<script type="text/javascript" charset="utf-8" src="http://static.polldaddy.com/p/9451823.js"></script>
												<noscript><a href="http://polldaddy.com/poll/9451823/">Who will win the 2016 U.S. presidential election?</a></noscript>
											</div>

					        										        				
				        				</div>
				        				<div class = "col-md-6 col-xs-12 top-pad big-pad">
				        					<h3>Top News</h3>

				        					<?php
				        						$query = "Select * from articles WHERE breaking = '0' AND top = '1' ORDER BY id DESC LIMIT 1";
												$result = mysqli_query($this->connection, $query);
												if(mysqli_num_rows($result)!=0){
													
													$length = mysqli_num_rows($result);

													while ($row = $result->fetch_assoc()) {
														$id = $row['id'];
														$title = $row['title'];
														$text = $row['text'];
														$image = $row['image'];
														$string = truncate($text, 150, $id);
													
														echo "
															<div class = 'main-news'>
									        					<img class = 'main-image' src = '$image'>
									        					<h2><b><a href='article.php?id=".$id."'>$title</a></b></h2>
									        					<p>$string</p>
									        				</div>
														";

														$data[] = $id;

													}
												}
				        					?>
				        		
					        				<hr>

					        				<?php 
					        					$query = "Select * from articles WHERE breaking = '0' AND genre = 'us' ORDER BY id DESC LIMIT 4";
												$result = mysqli_query($this->connection, $query);
												$news = array();
												while($row = $result->fetch_assoc()) {
													$news[] = $row;
													$data[] = $row['id'];
												}			
					        				?>

					        				<div class = "row">
					        					<div class = "col-md-6">
					        						<div class = "us-news-home">
					        							<h3>US</h3>
						        						<?php vertical_column($news);?>
					        						</div>
					        					</div>

					        					<?php 
					        						$query = "Select * from articles WHERE breaking = '0' AND genre = 'international' ORDER BY id DESC LIMIT 4";
													$result = mysqli_query($this->connection, $query);
													unset($news);
													$news = array();
													while($row = $result->fetch_assoc()) {
														$news[] = $row;
														$data[] = $row['id'];
													}
					        					?>


					        					<div class = "col-md-6">
					        						<div class = "world-news-home">
					        							<h3>World</h3>
					        							<?php vertical_column($news);?>
					        						</div>
					        					</div>
					        				</div>
					        				<div class = "row">
					        					<div class = "col-md-12">

						        					<?php 
						        						$query = "Select * from articles WHERE breaking = '0' AND genre = 'science' ORDER BY id DESC LIMIT 4";
														$result = mysqli_query($this->connection, $query);
														unset($news);
														$news = array();
														while($row = $result->fetch_assoc()) {
															$news[] = $row;
															$data[] = $row['id'];
														}

														$id = $news[0]['id'];
														$title = $news[0]['title'];
														$image = $news[0]['image'];
														$string = truncate($news[0]['text'], 50, $id);
						        					?>
					        						<div class = "tech-news-home">
					        							<h3>Tech & Sciences</h3>
						        						<ul class = 'list-group'>
						        							<li class = 'list-group-item'>
						        								<div class = "md-article">
						        									<div class = "row">
						        										<div class = "col-md-6">
						        											<img class = "med-img-home" src = "<?php echo $image;?>">
						        										</div>
						        										<div class = "col-md-6">
						        											<h4><b><a href = 'article.php?id=<?php echo $id;?>'><?php echo $title;?></a></b></h4>
								        									<p><?php echo $string;?></p>
						        										</div>
						        									</div>
						        								</div>
						        							</li>
						        							<?php print_bottom_articles($news);?>
						        						</ul>
					        						</div>
					        					</div>
					        					<div class = "col-md-12">
					        						<?php 
						        						$query = "Select * from articles WHERE breaking = '0' AND genre = 'entertainment' ORDER BY id DESC LIMIT 4";
														$result = mysqli_query($this->connection, $query);
														unset($news);
														$news = array();
														while($row = $result->fetch_assoc()) {
															$news[] = $row;
															$data[] = $row['id'];
														}

														$id = $news[0]['id'];
														$title = $news[0]['title'];
														$image = $news[0]['image'];
														$string = truncate($news[0]['text'], 50, $id);
						        					?>

					        						<div class = "ent-news-home">
					        							<h3>Entertainment</h3>
						        						<ul class = 'list-group'>
						        							<li class = 'list-group-item'>
						        								<div class = "md-article">
						        									<div class = "row">
						        										<div class = "col-md-6">
						        											<h4><b><a href = 'article.php?id=<?php echo $id;?>'><?php echo $title;?></a></b></h4>
								        									<p><?php echo $string;?></p>
						        										</div>
						        										<div class = "col-md-6">
						        											<img class = "med-img-home" src = "<?php echo $image;?>">
						        										</div>
						        									</div>
						        								</div>
						        							</li>
						        							<?php print_bottom_articles($news);?>
						        						</ul>
					        						</div>
					        					</div>
					        				</div>

				        				</div>
				        				<div class = "col-md-3 col-xs-12 top-pad">
				        					<h3>Staff's Picks</h3>
				        					<div class="panel panel-default">
											  <div class="panel-body">
				        					<?php

											$query = "Select * from articles WHERE staff = '1' ORDER BY id DESC LIMIT 3";
											$result = mysqli_query($this->connection, $query);
											$staff_pick_html = display_media($result);
											echo $staff_pick_html;


				        					?>
				        						</div>
											</div>
				        					<?php 
					        						$query = "Select * from articles WHERE breaking = '0' AND genre = 'school' ORDER BY id DESC LIMIT 4";
													$result = mysqli_query($this->connection, $query);
													unset($news);
													$news = array();
													while($row = $result->fetch_assoc()) {
														$news[] = $row;
														$data[] = $row['id'];
													}
					        				?>
        					
					        				<div class = "school-news-home">
					        					<h3>School</h3>
					        					<?php vertical_column($news);?>
					        				</div>

					        				<?php 
					        						$query = "Select * from articles WHERE breaking = '0' AND genre = 'life' ORDER BY id DESC LIMIT 4";
													$result = mysqli_query($this->connection, $query);
													unset($news);
													$news = array();
													while($row = $result->fetch_assoc()) {
														$news[] = $row;
														$data[] = $row['id'];
													}
					        				?>
        					
					        				<div class = "life-news-home">
					        					<h3>Lifestyle & Health</h3>
					        					<?php vertical_column($news);?>
					        				</div>

					        				<?php require 'tag-list.php'; ?>
					        				<a class="twitter-timeline" data-height="500" data-theme="light" href="https://twitter.com/TwoViewsPress">Tweets by TwoViewsPress</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>		       				
				        				</div>
				        			</div>
					        	 <!-- end column -->

					        	
					        



				     <?php   
				//Display LATEST articles
				$query = "Select * from articles WHERE breaking = '0' AND staff = '0' AND top = '0' AND id NOT IN(";

				for($x = 0; $x < sizeof($data); $x++) {
					$query = $query . "'" . $data[$x] . "'";
					if($x != sizeof($data)-1) {
						$query = $query . ", ";
					}
				}

				$query = $query . ") ORDER BY id DESC LIMIT 10";
				$result = mysqli_query($this->connection, $query);
				
				$latestHtml = display_media($result);
				?>
				
				<script> 
					var latest = document.getElementById("latest");
					var string = "<?php echo preg_replace("/\r?\n/", "\\n", addslashes($latestHtml)); ?>";
					latest.innerHTML+= string; </script>;
				<?php

				mysqli_close($this->connection);
		} //find articles method

	} //home articles class
?>


<?php

	$home_articles = new home_articles();	
	$data = array(); //used articles
	$home_articles -> find_articles();
?>

