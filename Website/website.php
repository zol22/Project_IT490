<?php 

include ('../LoginFiles/login_register_request.php'); 

//	If the user is not logged in, they cannot access this page
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	redirect("Redirecting to the login", "../login.php", 2);
  	//header('location: login.php');
  }

?>


<!DOCTYPE html>
<html>
<head>
	<title>Website</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="UTF-8" />
</head>

<body>

	<div class="header">
		<h2>Home</h2>
	</div>

	<div class="content">

		<?php if (isset($_SESSION['success'])) : ?>
      	<div class="error success " >
      		<h3>
          		<?php 
          			echo $_SESSION['success']; 
          			unset($_SESSION['success']);
          		?>
      		</h3>
      	</div>
  		<?php endif ?>


  	    <!-- logged in user information -->
    	<?php  if (isset($_SESSION['username'])) : ?>
    		<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    		<p> <a href="website.php?logout='1'">logout</a> </p>
    	<?php endif ?>


	</div>
</body>
</html>

