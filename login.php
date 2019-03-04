<?php include('server.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>User Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

	<div class="header">
		<h2>Login</h2>
	</div>

	<form action="login.php" method="post">
		<?php include('errors.php'); ?>
		<div class="input-group">
			<label>Username</label>
			<input type=text name="user">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type=text name="pass">
		</div>
		<div class="input-group">
			<button type=submit name="login" class="btn">Login</button>
		</div>
		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p>
	</form>


</body>


</html>

