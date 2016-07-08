<?php
	
	$conn = new mysqli(hostname, username, password, db_name) or die ("could not connect to mysql");
?>

<div class = "tags">
	<h3>Tags</h3>
	<div class="panel panel-default">
		<div class="panel-body">
		<?php
			$tagRows = array();
			$sql = "SELECT tags from articles";
			if($stmt = $conn->prepare($sql)) { 
				$stmt->execute();
				$stmt->bind_result($tags);

				while($stmt->fetch()) {
						$tagRows = array_merge($tagRows, explode(',', $tags));
				}
				$tagCount = array_count_values($tagRows);
				$tagRows = array_unique_compact($tagRows);

				$max = max($tagCount);
				$min = min($tagCount);

				$x = 18; // 18px
				$y = 11; // 11px

				$stepvalue = ($max - $min) / ($x - $y);	


				for($i=0;$i<count($tagRows);$i++)
				{
					echo '<a href="tags.php?tag='.$tagRows[$i].'" 
					style="font-size:'. ( $y + round( ($tagCount[$tagRows[$i]]-$min) / $stepvalue ) ).'px;">'. $tagRows[$i].'</a>';
					if($i<count($tagRows)-1) echo ",\n";
				}		


			}
		
				
				?>
			</div> <!-- end panel-body -->
		</div> <!-- end panel -->
	</div>	


<?php 
	function array_unique_compact($a) {
		 $tmparr = array_unique($a);
		 $i=0;
		 foreach ($tmparr as $v) {
		   $newarr[$i] = $v;
		   $i++;
		 }
		 return $newarr;
	}
?>