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

						$string = strip_tags($text);

						if (strlen($string) > 40) {
						    $stringCut = substr($string, 0, 40);
						    $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="article.php?id='.$id.'">Read More</a>'; 
						}

						if($count==1) {
							echo "<div class='item active' id = '$id'>
							      <img src= '$image' class = 'centered-and-cropped'>
							      <div class='carousel-caption'>
							        <a href = 'article.php?id=".$id."'<h3>$title</h3></a>
							        <p>$string</p>
							      </div> 
							   </div>";
						} else {
							echo "<div class='item' id = '$id'>
							      <img src= '$image' class = 'centered-and-cropped'>
							      <div class='carousel-caption'>
							        <a href = 'article.php?id=".$id."'<h3>$title</h3></a>
							        <p>$string</p>
							      </div> 
							   </div>";
						}


							echo "<script> var element = document.getElementById('carousel-".$count."');
				        			element.innerHTML += '<h3>".$title."</h3>';</script>";
				        $count = $count + 1;
					}
				} ?>
					</div><!-- end carousel-inner-->
				</div> <!-- End #myCarousel-->
		        <br>

				<?php

				//PRETTY BOXES
				echo "<div id = 'grid' data-columns>";
				$query = "Select * from articles WHERE breaking = '0' ORDER BY id DESC LIMIT 6";
				$result = mysqli_query($this->connection, $query);
				if(mysqli_num_rows($result)!=0){
					$count = 0;
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
							$imgUrl = "./img/image1.jpg";
							echo"
								<div class = 'preview-article pretty-box' style = 'background-color: black'>							
									<div class = 'hold-image'>
										<img src = '$image'>
									</div>
										<a href = 'genre.php?genre=$uppercase'><div class = 'genre' id = '$genreID'></div></a>
										<br><br>
										<div class = 'container'>
						        			<a href = 'article.php?id=$id'><h1>$title</h1></a>
						        			<p><span>$author</span><span>	|	</span><span>$date</span></p>	
					        			</div>
	                         			<br><br>
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
				        				<div class = "col-md-3 col-xs-12 top-pad">
				        					<h3>Latest</h3>
				        					<div class = "media">
					        					<div class = "media-left">
					        						<a href="#"><img class = "media-object" src = "img/image1.jpg"></a>
					        					</div>
					        					<div class = "media-body">
					        						<h4 class = "media-heading">Media heading</h4>
					        						<p>Date</p>
					        					</div>
					        				</div>
					        				<div class = "media">
					        					<div class = "media-left">
					        						<a href="#"><img class = "media-object" src = "img/image1.jpg"></a>
					        					</div>
					        					<div class = "media-body">
					        						<h4 class = "media-heading">Media heading</h4>
					        						<p>Date</p>
					        					</div>
					        				</div>
					        				<div class = "media">
					        					<div class = "media-left">
					        						<a href="#"><img class = "media-object" src = "img/image1.jpg"></a>
					        					</div>
					        					<div class = "media-body">
					        						<h4 class = "media-heading">Media heading</h4>
					        						<p>Date </p>
					        					</div>
					        				</div>
					        				<div class = "media">
					        					<div class = "media-left">
					        						<a href="#"><img class = "media-object" src = "img/image1.jpg"></a>
					        					</div>
					        					<div class = "media-body">
					        						<h4 class = "media-heading">Media heading</h4>
					        						<p>Date</p>
					        					</div>
					        				</div>
					        				<div class = "media">
					        					<div class = "media-left">
					        						<a href="#"><img class = "media-object" src = "img/image1.jpg"></a>
					        					</div>
					        					<div class = "media-body">
					        						<h4 class = "media-heading">Media heading</h4>
					        						<p>Date </p>
					        					</div>
					        				</div><!--end media -->

					        				<div class = "editorial-preview">
					        					<h3>Featured Article</h3>
					        					<img class = 'preview-image' src = './img/image1.jpg'>
					        					<h4><b>Title</b></h4>
					        					<p><span>Author</span><span>	|	</span><span>Date</span></p>
					        					<p>Text text text Text text text Text text text Text text text Text text text Text text text Text text text Text text text Text text text Text text text </p>
					        					<p>Text text text Text text text Text text text Text text text Text text text Text text text Text text text Text text text Text text text Text text text </p>
					        					<p>Text text text Text text text Text text text Text text text Text text text Text text text Text text text Text text text Text text text Text text text </p>
					        					<p>Text text text Text text text Text text text Text text text Text text text Text text text Text text text Text text text Text text text Text text text </p>
					        				</div>									        				
				        				</div>
				        				<div class = "col-md-6 col-xs-12 top-pad big-pad">
				        					<h3>Top News</h3>
				        					<div class = "main-news">
					        					<img class = "main-image" src = "./img/image1.jpg">
					        					<h4>Title</h4>
					        					<p>Text text text Text text text Text text text Text text text Text text text Text text text Text text text Text text text Text text text Text text text </p>
					        				</div>
					        				<hr>
					        				<div class = "row">
					        					<div class = "col-md-6">
					        						<div class = "us-news-home">
					        							<h3>US</h3>
						        						<div class = 'list-group'>
						        							<a href = '#' class = 'list-group-item'>
						        								<div class = "md-article">
								        							<img class = "med-img-home" src = "./img/image1.jpg">
								        							<h4>Title</h4>
								        							<p> Text Text text text Text text text Text text text</p>
						        								</div>
						        							</a>
						        							<a href = '#' class = 'list-group-item'>Link</a>
						        							<a href = '#' class = 'list-group-item'>Link</a>
						        							<a href = '#' class = 'list-group-item'>Link</a>
						        						</div>
					        						</div>
					        					</div>
					        					<div class = "col-md-6">
					        						<div class = "world-news-home">
					        							<h3>World</h3>
					        							<div class = 'list-group'>
						        							<a href = '#' class = 'list-group-item'>
						        								<div class = "md-article">
								        							<img class = "med-img-home" src = "./img/image1.jpg">
								        							<h4>Title</h4>
								        							<p> Text Text text text Text text text Text text text</p>
						        								</div>
						        							</a>
						        							<a href = '#' class = 'list-group-item'>Link</a>
						        							<a href = '#' class = 'list-group-item'>Link</a>
						        							<a href = '#' class = 'list-group-item'>Link</a>
						        						</div>
					        						</div>
					        					</div>
					        				</div>
					        				<div class = "row">
					        					<div class = "col-md-12">
					        						<div class = "tech-news-home">
					        							<h3>Tech & Sciences</h3>
						        						<div class = 'list-group'>
						        							<a href = '#' class = 'list-group-item'>
						        								<div class = "md-article">
						        									<div class = "row">
						        										<div class = "col-md-6">
						        											<img class = "med-img-home" src = "./img/image1.jpg">
						        										</div>
						        										<div class = "col-md-6">
						        											<h4>Title</h4>
								        									<p> Text Text text text Text text text Text text text</p>
						        										</div>
						        									</div>
						        								</div>
						        							</a>
						        							<a href = '#' class = 'list-group-item'>Link</a>
						        							<a href = '#' class = 'list-group-item'>Link</a>
						        							<a href = '#' class = 'list-group-item'>Link</a>
						        						</div>
					        						</div>
					        					</div>
					        					<div class = "col-md-12">
					        						<div class = "enth-news-home">
					        							<h3>Entertainment</h3>
						        						<div class = 'list-group'>
						        							<a href = '#' class = 'list-group-item'>
						        								<div class = "md-article">
						        									<div class = "row">
						        										<div class = "col-md-6">
						        											<h4>Title</h4>
								        									<p> Text Text text text Text text text Text text text</p>
						        										</div>
						        										<div class = "col-md-6">
						        											<img class = "med-img-home" src = "./img/image1.jpg">
						        										</div>
						        									</div>
						        								</div>
						        							</a>
						        							<a href = '#' class = 'list-group-item'>Link</a>
						        							<a href = '#' class = 'list-group-item'>Link</a>
						        							<a href = '#' class = 'list-group-item'>Link</a>
						        						</div>
					        						</div>
					        					</div>
					        				</div>

				        				</div>
				        				<div class = "col-md-3 col-xs-12 top-pad">
				        					<h3>Staff's Picks</h3>
				        					<?php

											$query = "Select * from articles WHERE staff = '1' ORDER BY id DESC LIMIT 3";
											$result = mysqli_query($this->connection, $query);
											if(mysqli_num_rows($result)!=0){
												$count = 0;
												$length = mysqli_num_rows($result);

												while ($row = $result->fetch_assoc()) {
													$id = $row['id'];
													$title = $row['title'];
													$image = $row['image'];
													$date = $row['date'];

													echo "
														<div class = 'media'>
								        					<div class = 'media-left'>
								        						<a href='article.php?id=".$id."'><img class = 'media-object' src = '$image'></a>
								        					</div>
								        					<div class = 'media-body'>
								        						<a href='article.php?id=".$id."'><h4 class = 'media-heading'>$title</h4></a>
								        						<p>$date</p>
								        					</div>
								        				</div>
													";
												}
											}


				        					?>
				        			
					        				<div class = "school-news-home">
					        					<h3>School</h3>
						        				<div class = 'list-group'>
						        					<a href = '#' class = 'list-group-item'>
						        						<div class = "md-article">
								        					<img class = "med-img-home" src = "./img/image1.jpg">
								        					<h4>Title</h4>
								        					<p> Text Text text text Text text text Text text text</p>
						        						</div>
						        					</a>
						        					<a href = '#' class = 'list-group-item'>Link</a>
						        					<a href = '#' class = 'list-group-item'>Link</a>
						        					<a href = '#' class = 'list-group-item'>Link</a>
						        				</div>
					        				</div>
					        				<div class = "life-news-home">
					        					<h3>Lifestyle & Health</h3>
						        				<div class = 'list-group'>
						        					<a href = '#' class = 'list-group-item'>
						        						<div class = "md-article">
								        					<img class = "med-img-home" src = "./img/image1.jpg">
								        					<h4>Title</h4>
								        					<p> Text Text text text Text text text Text text text</p>
						        						</div>
						        					</a>
						        					<a href = '#' class = 'list-group-item'>Link</a>
						        					<a href = '#' class = 'list-group-item'>Link</a>
						        					<a href = '#' class = 'list-group-item'>Link</a>
						        				</div>
					        				</div>
					        				<div class = "tags">
					        					<h3>Tags</h3>
					        					<div>
					        						<p>tag1		tag2	tag3	tag4	tag5</p>
					        						<p>tag1		tag2	tag3	tag4	tag5</p>
					        						<p>tag1		tag2	tag3	tag4	tag5</p>
					        					</div>
					        				</div>	
					        				<a class="twitter-timeline" data-height="500" data-theme="light" href="https://twitter.com/TwoViewsPress">Tweets by TwoViewsPress</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>		       				
				        				</div>
				        			</div>
					        	 <!-- end column -->

					        	
					        



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


<?php

	$home_articles = new home_articles();	
	$home_articles -> find_articles();
		
?>