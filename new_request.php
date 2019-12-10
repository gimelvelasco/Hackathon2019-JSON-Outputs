<!DOCTYPE html>
<html>
	<head>
		<title>Loan Tracker App</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<?php
			$server = "localhost:3306";
			$user = "root";
			$pass = "root";
			$db = "hackathon2019_db";
			$conn = mysqli_connect($server, $user, $pass, $db);

			if(!$conn){
				die(msqli_connect_error());
			}
		?>
	</head>
	<body>
		<div id="div2">
			<p>
				<input type="button" value="Home" onclick="window.location.href='homepage.php'" />
			</p>
		</div>
		<div id="div1">
			<center><h2>Utang App</h2></center><br>
			<form action="process_request.php" method="POST">
				<p>
					<label>Lender:</label>
					<select name="lender_text">
						<?php
							if(!$conn){
								die(msqli_connect_error());
							}
							else{
								$query = "SELECT * FROM hackathon2019_db.users;";
								$result = mysqli_query($conn,$query);
							}
						?>
						<?php
						while($line = mysqli_fetch_array($result)){
						?>
							<option value="<?php echo $line['user_id'];?>"> <?php echo "(".$line['username'].") ".$line['first_name']." ".$line['last_name'].""?> </option>
						<?php
						}
						?>
					</select>
				</p>
				<p>
					<label>Borrower:</label>
					<select name="borrower_text">
						<?php
							if(!$conn){
								die(msqli_connect_error());
							}
							else{
								$query = "SELECT * FROM hackathon2019_db.users;";
								$result = mysqli_query($conn,$query);
							}
						?>
						<?php
						while($line = mysqli_fetch_array($result)){
						?>
							<option value="<?php echo $line['user_id'];?>"> <?php echo "(".$line['username'].") ".$line['first_name']." ".$line['last_name'].""?> </option>
						<?php
						}
						?>
					</select>
				</p>
				<p>
					<label>Description:</label>
					<input type="text" id="description_text" name="description_text">
				</p>
				<p>
					<label>Amount:</label>
					<input type="number" id="amount_number" name="amount_number">
				</p>
				<p>
					<input type="submit" id="request_button" value="Create Request">
				</p>
			</form>
		</div>
		<div id="div2">
			<form action="process_logout.php" method="POST">
				<p>
					<label><?php echo "".$_SESSION['username_session']."";?></label>
				</p>
				<p>
					<input type="submit" id="logout_button" value="Logout">
				</p>
			</form>
		</div>
	</body>
</html>