<?php
	function display_media($result) {
		$returnString = "";
		if(mysqli_num_rows($result)!=0){
			$count = 0;
			$length = mysqli_num_rows($result);	

			while ($row = $result->fetch_assoc()) {
				$id = $row['id'];
				$title = $row['title'];
				$image = $row['image'];
				$date = $row['date'];

				$returnString = $returnString . "<div class = 'media'>
							<div class = 'media-left'>			
								<a href='article.php?id=".$id."'><img class = 'media-object' src = '$image'></a>
							</div>
							<div class = 'media-body'>
								<a href='article.php?id=".$id."'><h4 class = 'media-heading'>$title</h4></a>
								<p>$date</p>
							</div>
						</div>";
			}
		}
		return $returnString;
	}
?>