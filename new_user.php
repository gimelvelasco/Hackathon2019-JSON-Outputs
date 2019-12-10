<!DOCTYPE html>
<html>
	<head>
		<title>Utang App</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
		<div id="div2">
			<p>
				<input type="button" value="Login Page" onclick="window.location.href='index.php'" />
			</p>
		</div>
		<div id="div1">
			<center><h2>Create New Account</h2></center><br>
			<form action="process_user.php" method="POST">
				<p>
					<label>Username:</label>
					<input type="text" id="user_text" name="user_text">
				</p>
				<p>
					<label>Password:</label>
					<input type="text" id="pass_text" name="pass_text">
				</p>
				<p>
					<label>First Name:</label>
					<input type="text" id="first_name_text" name="first_name_text">
				</p>
				<p>
					<label>Last Name:</label>
					<input type="text" id="last_name_text" name="last_name_text">
				</p>
				<p>
					<input type="submit" id="newuser_button" value="Create">
				</p>
			</form>
		</div>
	</body>
</html>