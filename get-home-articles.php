<?php
	require "config.php";
	$conn = new mysqli(hostname, username, password, db_name) or die ("could not connect to mysql");
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
		$title = stripslashes($news[0]['title']);
		$image = $news[0]['image'];
		$string = truncate(stripslashes($news[0]['text']), 50, $id);
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
			$title = stripslashes($news[$x]['title']);
			$id = $news[$x]['id'];
			echo "<li class = 'list-group-item'><a href = 'article.php?id=".$id."'>$title</a></li>";
		}
	}

	?>
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
			$data = array();

				//CAROUSEL
				$sql = "Select id, title, text, image from articles WHERE breaking = '1' ORDER by id DESC LIMIT 5";
				if($stmt = $conn->prepare($sql)) {
					$stmt->execute();
			   		$stmt->store_result();
				    $stmt->bind_result($id, $title, $text, $image);
				    $count = 1;
				    while($stmt->fetch()) {
				    	$title = stripslashes($title);
				    	$text = stripslashes($text);
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
				}
?>
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
					$sql = "Select id, title, author, date, text, image, genre, tags from articles WHERE breaking = '0' AND genre = ? ORDER BY date DESC LIMIT 1";
					if($stmt = $conn->prepare($sql)) {
						$stmt->bind_param('s', $genre);
						$genre = $genres[strval($count)];
						$stmt->execute();
				   		$stmt->store_result();
					    $stmt->bind_result($id, $title, $author, $date, $text, $image, $genre, $tags);
					    while($stmt->fetch()) {
					    	$genreID = 'genre'.$id;
					    	$title = stripslashes($title);
					    	$author = stripslashes($author);
					    	$text = stripslashes($text);
					    	$tags = stripslashes($tags);

					    	$uppercase = ucfirst($genre);
							//$title = truncate_noId($title, 100);
							echo"
									<div class = 'preview-article pretty-box' style = 'background-color: black'>							
										<div class = 'hold-image'>
											<img src = '$image' class = 'centered-and-cropped'>
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
												$news = array();
						        				$sql = "Select * from articles WHERE breaking = '0' AND genre = 'edit' ORDER BY date DESC LIMIT 4";
						        				if($stmt = $conn->prepare($sql)) {
													$stmt->execute();
												    $result = $stmt->get_result();
													while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
													  
													    $news[] = $row;
													    $data[] = $row["id"];  
													  	
													}

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
				        						$sql = "Select * from articles WHERE breaking = '0' AND top = '1' ORDER BY id DESC LIMIT 1";
				        						if($stmt = $conn->prepare($sql)) {
													$stmt->execute();
												    $result = $stmt->get_result();
													while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
														$id = $row['id'];
														$title = stripslashes($row['title']);
														$text = stripslashes($row['text']);
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
					        					$sql = "Select * from articles WHERE breaking = '0' AND genre = 'us' ORDER BY id DESC LIMIT 4";
												
												$news = array();
												if($stmt = $conn->prepare($sql)) {
													$stmt->execute();
												    $result = $stmt->get_result();
													while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
														$news[] = $row;
														$data[] = $row['id'];
													}
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
					        					$sql = "Select * from articles WHERE breaking = '0' AND genre = 'international' ORDER BY id DESC LIMIT 4";
												
												$news = array();
												if($stmt = $conn->prepare($sql)) {
													$stmt->execute();
												    $result = $stmt->get_result();
													while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
														$news[] = $row;
														$data[] = $row['id'];
													}
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
						        					$sql = "Select * from articles WHERE breaking = '0' AND genre = 'science' ORDER BY id DESC LIMIT 4";
													unset($news);
													$news = array();
													if($stmt = $conn->prepare($sql)) {
														$stmt->execute();
													    $result = $stmt->get_result();
														while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
															$news[] = $row;
															$data[] = $row['id'];
														}
													}
						        			

														$id = $news[0]['id'];
														$title = stripslashes($news[0]['title']);
														$image = $news[0]['image'];
														$string = truncate(stripslashes($news[0]['text']), 50, $id);
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

					        						$sql = "Select * from articles WHERE breaking = '0' AND genre = 'entertainment' ORDER BY id DESC LIMIT 4";
													unset($news);
													$news = array();
													if($stmt = $conn->prepare($sql)) {
														$stmt->execute();
													    $result = $stmt->get_result();
														while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
															$news[] = $row;
															$data[] = $row['id'];
														}
													}

														$id = $news[0]['id'];
														$title = stripslashes($news[0]['title']);
														$image = $news[0]['image'];
														$string = truncate(stripslashes($news[0]['text']), 50, $id);
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

				        					$sql = "Select * from articles WHERE staff = '1' ORDER BY date DESC LIMIT 3";
											unset($news);
											$news = array();
											if($stmt = $conn->prepare($sql)) {
												$stmt->execute();
											    $result = $stmt->get_result();
												while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
													$staff_pick_html = display_media($row['id'], $row['title'], $row['image'], $row['date']);
													echo $staff_pick_html;
												}
											}
				        					?>
				        						</div>
											</div>
				        					<?php 

				        					$sql = "Select * from articles WHERE breaking = '0' AND genre = 'school' ORDER BY id DESC LIMIT 4";							
				        					unset($news);
											$news = array();
											if($stmt = $conn->prepare($sql)) {
												$stmt->execute();
											    $result = $stmt->get_result();
												while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
													$news[] = $row;
													$data[] = $row['id'];
												}
											}

					        				?>
        					
					        				<div class = "school-news-home">
					        					<h3>School</h3>
					        					<?php vertical_column($news);?>
					        				</div>

					        				<?php 
					   								$sql = "Select * from articles WHERE breaking = '0' AND genre = 'life' ORDER BY id DESC LIMIT 4";
													unset($news);
													$news = array();
													if($stmt = $conn->prepare($sql)) {
														$stmt->execute();
													    $result = $stmt->get_result();
														while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
															$news[] = $row;
															$data[] = $row['id'];
														}
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
				$sql = "Select * from articles WHERE breaking = '0' AND staff = '0' AND top = '0' AND id NOT IN(";

				for($x = 0; $x < sizeof($data); $x++) {
					$sql = $sql . "'" . $data[$x] . "'";
					if($x != sizeof($data)-1) {
						$sql = $sql . ", ";
					}
				}

				$sql = $sql . ") ORDER BY id DESC LIMIT 10";

				$latestHtml = "";
				if($stmt = $conn->prepare($sql)) {
					$stmt->execute();
					$result = $stmt->get_result();
					while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
						$news[] = $row;
						$latestHtml.=display_media($row['id'], $row['title'], $row['image'], $row['date']);
					}
				}		
				
				?>
				
				<script> 
					var latest = document.getElementById("latest");
					var string = "<?php echo preg_replace("/\r?\n/", "\\n", addslashes($latestHtml)); ?>";
					latest.innerHTML+= string; </script>;
				<?php

				$conn->close();
	
?>




