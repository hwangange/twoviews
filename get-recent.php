<?php require_once 'display-media.php'; ?>
<h3 class = "article-sidebar-item">Latest</h3>
<?php 
	if(isset($_SESSION['genre'])) {
		$genreSql = $_SESSION['genre'];
		$query = "Select * from articles WHERE genre <> '" . $genreSql . "'ORDER BY id DESC LIMIT 7";
	} else {
		$query = "Select * from articles ORDER BY id DESC LIMIT 7";
	}

	
	$result = mysqli_query($this->connection, $query);
?>
<div class="panel panel-default">
  <div class="panel-body">
<?php
	$recent_html = display_media($result);
	echo $recent_html;
?>

  </div>
</div>