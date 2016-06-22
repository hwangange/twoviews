<div class = "tags">
	<h3>Tags</h3>
	<div class="panel panel-default">
		<div class="panel-body">
		<?php
			$tagRows = array();
			$query = "SELECT * from articles";
			$result = mysqli_query($this->connection, $query);
						        					while($row = $result->fetch_assoc()) {
						        						$tagRows = array_merge($tagRows, explode(',', $row['tags']));
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