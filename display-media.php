<?php
	function display_media($id, $title, $image, $date) {
		$returnString = "";
		
			
			 
				$returnString = $returnString . "<div class = 'media'>
							<div class = 'media-left'>			
								<a href='article.php?id=".$id."'><img class = 'media-object' src = '$image'></a>
							</div>
							<div class = 'media-body'>
								<a href='article.php?id=".$id."'><h4 class = 'media-heading'>$title</h4></a>
								<p>$date</p>
							</div>
						</div>";
			
		
		return $returnString;
	}
?>