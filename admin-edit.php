<!DOCTYPE html>
<html>
<head>
	<?php require "admin-head.php";?>
	<?php require "config.php";?>
	  <?php 
	    session_start();
		if(!isset($_SESSION['username'])) {
			header("Location: admin-login.php");
			exit;
		}
		if(!isset($_GET['id'])) {
			header("Location: admin-my-articles.php");
			exit;
		}
	    $conn = mysqli_connect(hostname, username, password, db_name) or die ("could not connect to mysql"); ?>
	<script>
		tinymce.init({
	    selector: '#mytextarea',
	    plugins : 'advlist autolink link hr image media lists charmap print preview fullscreen paste textcolor autosave wordcount',
	    /*menubar: "view", */
	  	toolbar: "fullscreen, paste, forecolor backcolor",
	  	paste_data_images: true,
	  	link_assume_external_targets: true,
	  	height: 500

	  });
		$(function() {
		    $( "#date" ).datepicker({
		    	dateFormat: "yy-mm-dd",
		    });
		   
		 /*   var currentDate = $("#date").datepicker("getDate");
		    $("#date").attr("value", currentDate); */
		  });
	</script>
	<script>
		$("#articleForm").submit(function(event) {
			event.preventDefault();
			var cansubmit = checkform();
			if(!cansubmit) { alert("Please complete the entire form.");}

			var $form = $( this ),
	        url = $form.attr( 'action' );

		      /* Send the data using post with element id name and name2*/
		    var posting = $.post( url, { 
		    	name: $('#name').val(), 
		    	date: $('#date').val(), 
		    	title: $('#title').val(), 
		    	genre: $('#genre').val(), 
		    	tags: $('#tags').val(), 
		    	image: $('#image').val(), 
		    	article: $('#article').val() } );

		      /* Alerts the results */
		    posting.done(function( data ) {
		      alert('success');
		    });

		});

		function checkform() {
		    var f = document.forms["articleForm"].elements;
		    var cansubmit = true;

		    for (var i = 0; i < f.length; i++) {
		        if (f[i].value.length == 0)
		            cansubmit = false;
		    }

		    return cansubmit;
		}
		
	</script>

</head>

<body>
	<?php require "admin-nav.php";?>
	<div class = "container" style = "margin-top: 50px">
		<h1>Edit an Article</h1>
		<h4><strong>NOTE: </strong>DO NOT WORRY if the article information displayed on the screen does NOT match the article you intended to pull up. If this happens to you, you'll have to fill in all the information in the form again. Sorry. DO NOT PRESS THE BACK BUTTON, SUBMIT BUTTON, CANCEL BUTTON, ANY LINK ON THE NAV BAR, OR ANY LINK THAT WILL REDIRECT YOU AWAY FROM THIS PAGE FOR THAT MATTER. Sorry again.</h4>
		<form name = "articleForm" id = "articleForm" method = "post" action = "admin-update.php?id=<?php echo $_GET['id'];?> " enctype = "multipart/form-data">
	  		<div class = "row">
		  		<div class="form-group col-md-6">
		<?php
			/** START HERE **/
			$sql = "SELECT title, author, date, text, image, genre, tags FROM articles WHERE id = ? LIMIT 1";
			if($stmt = $conn->prepare($sql)) { // assuming $conn is the connection
			    $stmt->bind_param('i', $id);
			    $id = intval($_GET['id']);
			    $stmt->execute();
 				$stmt->store_result();
			    $stmt->bind_result($title, $author, $date, $text, $image, $genre, $tags);
			   while($stmt->fetch()){
				$title = stripslashes($title);
				$author = stripslashes($author);
				$text = stripslashes($text);
				$tags = stripslashes($tags);

				?>

				  <label for="name">First and Last Name:</label>
				  <input type="text" class="form-control" name = "name" id="name" value = "<?php echo $author; ?>">
				</div>
				<div class="form-group col-md-6">
				  <label for="date">Date:</label>
				   <input type="text" class="form-control" name = "date" id="date">
				   <script>
				   		$(function() {
				   			$( "#date" ).datepicker( "setDate", <?php echo json_encode($date);?> );
				   		});
				   </script>
				</div>
			</div>
			<div class="form-group">
			  <label for="title">Title of Article:</label>
			  	<p>No quotations around your title. Ex. <i>"Title"</i> is incorrect. <i>Title</i> is correct.</p>
			   <input type="text" class="form-control" name = "title" id="title" value = "<?php echo $title; ?>">
			</div>
			<div class = "row">
				<div class="form-group col-md-6">
				  <label for="genre">Genre:</label>
				  <select class="form-control" name = "genre" id="genre">
				  	<?php
				  		$options = array( 'us', 'viral', 'international', 'science', 'entertainment', 'school', 'life', 'edit' );
				  		$proper_options = array( 'U.S.', 'Viral', 'International', 'Tech & Sciences', 'Entertainment', 'School', 'Lifestyle & Health', 'Editorials');
						$output = '';
						for( $i=0; $i<count($options); $i++ ) {
						  $output .= '<option value = "' . $options[$i] . '" '
						             . ( $genre == $options[$i] ? 'selected="selected"' : '' ) . '>' 
						             . $proper_options[$i] 
						             . '</option>';
						}
						echo $output;
				  	?>
				   
				  </select>
				</div>
				<div class="form-group col-md-6">
				  <label for="tags">Tags: </label>
				  <p>Separate tags with a comma and space. <i>Example: "tag1, tag2, tag3, tag4"</i></p>
				   <input type="text" class="form-control" name = "tags" id="tags" value = "<?php echo $tags; ?>">
				</div>
			</div>
			<div class = "form-group">
				<label for="image">Upload image: </label>
				<p>This image will be displayed in thumbnails, panels and sidebars on other webpages. Essentially, it is the "title" image of your article. To make all of our lives easier, try to use landscape oriented images.</p>
				<p><b>Note: You do NOT have to upload a file if you wish to keep your current image.</b></p>
				<input class = "btn btn-primary" type = "file" name = "image" id = "image" value = "<?php echo $image; ?>">
			</div>
			<div class = "form-group">
				<label for="mytextarea">Article: </label>
				<p>Do <b>NOT</b> include the title in your article.</p>
		    	<textarea id="mytextarea" name = "article"><?php echo $text; ?></textarea>
		    </div>
	    	<button name="submitbtn" id = "submitbtn" type = "submit">Submit</button> or
	    	<button name = "cancelbtn" id = "cancelbtn"><a href = "admin-my-articles.php">Cancel</a></button>
	  	</form>
	  	<br><br>
	  	
					
			    <?php 
				}
			    $stmt->close();
			} else {
				echo "Couldn't prepare statement";
			}

			
		?>

	  	
				 
	  	<br><br><br>
	 </div>

	 <script>
	
		var Anchors = document.getElementsByTagName("a");
		for (var i = 0; i < Anchors.length ; i++) {
		    Anchors[i].addEventListener("click", 
		        function (event) {
		            event.preventDefault();
		            if (confirm('Are you sure you want to leave this page? Any changes will not be saved.')) {
		                window.location = this.href;
		            }
		        }, 
		        false);
		}

		$("#cancelbtn").click(function(event) {
			event.preventDefault();
		})
	</script>
</body>
</html>

<?php

?>