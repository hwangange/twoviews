<?php include 'display-media.php'; ?>
<h3 class = "article-sidebar-item">Latest</h3>
<div class="panel panel-default">
  <div class="panel-body">
<?php 
	$recent_html = "";
	if(isset($_SESSION['genre'])) {
		
		$sql = "Select id, title, image, date from articles WHERE genre <> ? ORDER BY date DESC LIMIT 7";

		if($stmt = $conn->prepare($sql)) { // assuming $conn is the connection
			$stmt->bind_param('s', $id);
			$genreSql = $_SESSION['genre'];
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $title, $image, $date);
			while($stmt->fetch()) {
				$recent_html = display_media($id, $title, $image, $date);
				echo $recent_html;
			}
			
			$stmt->close();
		}
	} else {
		$sql = "Select id, title, image, date from articles ORDER BY date DESC LIMIT 7";

		if($stmt = $conn->prepare($sql)) { // assuming $conn is the connection
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $title, $image, $date);
			while($stmt->fetch()) {
				echo "<div class = 'media'>
							<div class = 'media-left'>			
								<a href='article.php?id=".$id."'><img class = 'media-object' src = '$image'></a>
							</div>
							<div class = 'media-body'>
								<a href='article.php?id=".$id."'><h4 class = 'media-heading'>$title</h4></a>
								<p>$date</p>
							</div>
						</div>";
			}
			$stmt->close();
		}
	}
?>

<?php
	$conn->close();
?>

  </div>
</div>