<?php

?>

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
		    var currentDate = $("#date").datepicker("getDate");
		    $("#date").attr("value", currentDate);
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
		<h1>Post an Article</h1>

	  	<form name = "articleForm" id = "articleForm" method = "post"  action = "admin-post.php">
	  		<div class = "row">
		  		<div class="form-group col-md-6">
				  <label for="name">First and Last Name:</label>
				  <input type="text" class="form-control" name = "name" id="name">
				</div>
				<div class="form-group col-md-6">
				  <label for="date">Date:</label>
				   <input type="text" class="form-control" name = "date" id="date">
				</div>
			</div>
			<div class="form-group">
			  <label for="title">Title of Article:</label>
			  	<p>No quotations around your title. Ex. <i>"Title"</i> is incorrect. <i>Title</i> is correct.</p>
			   <input type="text" class="form-control" name = "title" id="title">
			</div>
			<div class = "row">
				<div class="form-group col-md-6">
				  <label for="genre">Genre:</label>
				  <select class="form-control" name = "genre" id="genre">
				    <option>U.S.</option>
				    <option>Viral</option>
				    <option>International</option>
				    <option>Tech & Sciences</option>
				    <option>Entertainment</option>
				    <option>School</option>
				    <option>Lifestyle & Health</option>
				    <option>Editorials</option>
				  </select>
				</div>
				<div class="form-group col-md-6">
				  <label for="tags">Tags: </label>
				  <p>Separate tags with a comma and space. <i>Example: "tag1, tag2, tag3, tag4"</i></p>
				   <input type="text" class="form-control" name = "tags" id="tags">
				</div>
			</div>
			<div class = "form-group">
				<label for="image">Upload image: </label>
				<p>This image will be displayed in thumbnails, panels and sidebars on other webpages. Essentially, it is the "title" image of your article. To make all of our lives easier, try to use landscape oriented images.</p>
				<input class = "btn btn-primary" type = "file" name = "image" id = "image">
			</div>
			<div class = "form-group">
				<label for="mytextarea">Article: </label>
				<p>Do <b>NOT</b> include the title in your article.</p>
		    	<textarea id="mytextarea" name = "article">Hello, World!</textarea>
		    </div>
	    	<button name="submitbtn" id = "submitbtn" type = "submit">Submit</button>
	  	</form>
	  	<br><br><br>
	 </div>
</body>
</html>

<?php

?>