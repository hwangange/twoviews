<?php require_once 'display-media.php'; ?>
<h3 class = "article-sidebar-item">Recent</h3>
	    			<hr>
	    			<?php 
	    				$query = "Select * from articles ORDER BY date DESC LIMIT 7";
						$result = mysqli_query($this->connection, $query);
						$recent_html = display_media($result);
						echo $recent_html;
					?>