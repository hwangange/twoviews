<?php 
	try {
		$query = "SELECT COUNT(*) from articles";
		$result = mysqli_query($this->connection, $query);
		$array = mysqli_fetch_all($result);

		$total = $array[0][0]; //length of array

		$limit = 10; //how many items to list per page
		$pages = ceil($total / $limit); //how many pages

		//current page
		$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
	        'options' => array(
	            'default'   => 1,
	            'min_range' => 1,
	        ),
	    )));

	    // Calculate the offset for the query
	    $offset = ($page - 1)  * $limit;

	    // Some information to display to the user
	    $start = $offset + 1;
	    $end = min(($offset + $limit), $total);

	    $query = "SELECT * FROM articles ORDER BY id LIMIT ".$limit." OFFSET ".$offset;
	    $result = mysqli_query($this->connection, $query);
	    if(mysqli_num_rows($result)!=0) {
	    	while ($row = $result->fetch_assoc()) {
	    		echo '<p>', $row['title'], '</p>';
	    	}
	    } else {
	    	echo '<p>No results could be displayed.</p>';
	    }

		// The "back" link
	    $prevlink = ($page > 1) ? '<a href="?genre='.$_SESSION['genre'].'&page=1" title="First page">&laquo;</a> <a href="?genre='.$_SESSION['genre'].'&page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

	    // The "forward" link
	    $nextlink = ($page < $pages) ? '<a href="?genre='.$_SESSION['genre'].'&page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?genre='.$_SESSION['genre'].'&page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

	    // Display the paging information
	    echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';

	} catch (Exception $e) {
	    echo '<p>', $e->getMessage(), '</p>';
	}
?>