<!DOCTYPE html>
<html>
<head>
	<?php require "admin-head.php";?>
  <?php require "config.php";?>
  <?php 
    session_start();
    $conn = new mysqli(hostname, username, password, db_name) or die ("could not connect to mysql"); ?>
</head>
<body>
	<div class = "container">
		<h1>Welcome, Two Views Staff!</h1>
		<hr>
		<div class = "row">
			<div class = "col-md-6">
				<h3>Returning Staff Member</h3>
				<hr>
				<form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" id = "loginForm">
					<div class="form-group">
					  <label for="username">Username</label>
					   <input type="text" class="form-control" name="loginUsername">
					</div>
					<div class="form-group">
					  <label for="password">Password</label>
					   <input type="password" class="form-control" name="loginPassword">
					</div>
					<button type = "submit" name="loginSubmit" id = 'loginSubmit'>Login</button>
				</form>
			</div>
			<div class = "col-md-6">
				<h3>New to Two Views?</h3>
				<hr>
				<form method = "post" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" id = "registerForm">
					<div class="form-group">
					  <label for="name">Full Name</label>
					   <input type="text" class="form-control" name="registerName" id = "registerName">
					</div>
					<div class="form-group">
					  <label for="username">Username</label>
					   <input type="text" class="form-control" name="registerUsername" id = "registerUsername">
					</div>
					<div class="form-group">
					  <label for="password">Password</label>
					   <input type="password" class="form-control" name="registerPassword" id = "registerPassword">
					</div>
					<button type = "submit" name="registerSubmit" id = 'registerSubmit'>Register</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

<?php
	if(isset($_POST['registerSubmit'])) {
              if(!$_POST['registerUsername'] | !$_POST['registerPassword'] | !$_POST['registerName']) {
                die('Please complete the entire form.');
              }
              if(!get_magic_quotes_gpc()) {
                $_POST['registerUsername'] = addslashes($_POST['registerUsername']);
              }

             

              $stmt = $conn->prepare("SELECT * FROM login WHERE username = ?");
              $stmt->bind_param("s", $usercheck);
              $usercheck = $_POST['registerUsername'];
              $stmt->execute();
              $stmt->store_result();
              $existCount = $stmt->num_rows;
              if($existCount!=0) {
                die('Sorry, the username '. $usercheck.' is already in use.');
              }

              $stmt->close();

              $_POST['registerPassword'] = md5($_POST['registerPassword']);
              if(!get_magic_quotes_gpc()) {
                $_POST['registerName'] = addslashes($_POST['registerName']);
                $_POST['registerPassword'] = addslashes($_POST['registerPassword']);
                $_POST['registerUsername'] = addslashes($_POST['registerUsername']);
              }

              $stmt = $conn->prepare("INSERT INTO login (name, username, password)
              VALUES (?, ?, ?)");
              $stmt->bind_param("sss", $name, $username, $password);
              $name = $_POST['registerName'];
              $username = $_POST['registerUsername'];
              $password = $_POST['registerPassword'];
              $stmt->execute();

              if($stmt) {
                echo "<p style = 'margin-top: 5cm'>Thank you for registering.</p>";
                $stmt->close(); 
              } else {
                  echo "Error: " . $conn->error;
              }

              $conn->close();


            }
     if(isset($_POST['loginSubmit'])) {
              if(!$_POST['loginUsername'] | !$_POST['loginPassword']) {
                die('Please complete the entire form.');
              }
              if(!get_magic_quotes_gpc()) {
                $_POST['loginUsername'] = addslashes($_POST['loginUsername']);
              }

              $_POST['loginPassword'] = md5($_POST['loginPassword']);

              $stmt = $conn->prepare("SELECT name, username FROM login WHERE username = ? AND password = ?");
              $stmt->bind_param("ss", $username, $password);
              $username = $_POST["loginUsername"];
              $password = $_POST["loginPassword"];
              $stmt->execute();
              $stmt->store_result();
              $existCount = $stmt->num_rows;
              var_dump("existCount: " . $existCount);
              if($existCount == 0) { 
                die('Sorry, the username and password do not match.');
              } else {
                /* fetch  array */
                 $stmt->bind_result($name, $username);
                
                while($stmt->fetch())
                {
                  $_SESSION['username'] = $username;
                  $_SESSION['name'] = $name;
                }

                header('Location: admin.php');
                exit;  
                
              }
        }
    unset($db);
?>