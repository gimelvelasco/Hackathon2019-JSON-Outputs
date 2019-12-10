<!DOCTYPE html>
<html>
	<head>
		<title>Loan Tracker App</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
	</head>
	<body>
		<div id="div1">
			<center><h2>Loan Tracker App</h2></center><br>
			<form action="process_login.php" method="POST">
				<p>
					<label>Username:</label>
					<input type="text" id="user_text" name="user_text">
				</p>
				<p>
					<label>Password:</label>
					<input type="password" id="pass_text" name="pass_text">
				</p>
				<p>
					<input type="submit" id="login_button" value="Login">
				</p>
			</form>
			<form>
				<p>
					<input type="button" value="New User" onclick="window.location.href='new_user.php'" />
				</p>
			</form>
		</div>
	</body>
</html>