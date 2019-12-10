<?php
	SESSION_START();
	if(!isset($_SESSION['username_session'])){
		$message = "No User Account Login!";
		echo "<script type='text/javascript'>
			alert('$message');
			window.location='index.php';
			</script>";
	}
?>

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
		<div id="div3">
			<p>
				<input type="button" value="New Loan Request" onclick="window.location.href='new_request.php'" />
			</p>
			<center><h2>Balance to Pay</h2></center><br>
			<table style="border:1px solid black; margin-left:auto; margin-right:auto;">
				<?php
					$query = "SELECT arrangement_id, lender_id_name.username, amount, description, created_on FROM arrangements
							JOIN users AS lender_id_name ON lender_id_name.user_id = arrangements.lender_id
							JOIN users AS borrower_id_name ON borrower_id_name.user_id = arrangements.borrower_id
							WHERE borrower_id_name.username = '".$_SESSION['username_session']."'
							ORDER BY created_on;";
					$result = mysqli_query($conn,$query);
					if(mysqli_num_rows($result) > 0){
				?>
				<tr>
					<th>Arrangement ID</th>
					<th>Lender</th>
					<th>Amount</th>
					<th>Description</th>
					<th>Created on</th>
				</tr>
				<?php
						while($row = mysqli_fetch_assoc($result)){
							echo "<tr><td>".$row['arrangement_id']."</td><td>".$row['username']."</td><td>".$row['amount']."</td><td>".$row['description']."</td><td>".$row['created_on']."</td></tr>";
						}
					}
					else{
						echo "No Balances to Pay<br>";
					}
				?>
			</table>
			<form action="get_debttopay.php" method="POST">
				<p>
					<input type="submit" id="approve_button" value="Pay">
				</p>
			</form>
			<form action="process_payment.php" method="POST">
			<p>
				<label>Loan Arrangement ID:</label>
				<select name="arrangement_id_text">
					<?php
						$query = "SELECT * FROM hackathon2019_db.arrangements
								WHERE borrower_id = '".$_SESSION['user_id_session']."';";
						$result = mysqli_query($conn,$query);
					?>
					<?php
					while($line = mysqli_fetch_array($result)){
					?>
						<option value="<?php echo $line['arrangement_id'];?>"> <?php echo $line['arrangement_id'];?> </option>
					<?php
					}
					?>
				</select>
				<input type="submit" id="approve_button" value="Pay">
			</p>
			</form>
			<hr>
			<center><h2>Balance to Collect</h2></center><br>
			<table style="border:1px solid black; margin-left:auto; margin-right:auto;">
				<?php
					$query = "SELECT borrower_id_name.username, amount, description, created_on FROM arrangements
							JOIN users AS borrower_id_name ON borrower_id_name.user_id = arrangements.borrower_id
							JOIN users AS lender_id_name ON lender_id_name.user_id = arrangements.lender_id
							WHERE lender_id_name.username = '".$_SESSION['username_session']."'
							ORDER BY created_on;";
					$result = mysqli_query($conn,$query);
					if(mysqli_num_rows($result) > 0){
				?>
				<tr>
					<th>Borrower</th>
					<th>Amount</th>
					<th>Description</th>
					<th>Created on</th>
				</tr>
				<?php
						while($row = mysqli_fetch_assoc($result)){
							echo "<tr><td>".$row['username']."</td><td>".$row['amount']."</td><td>".$row['description']."</td><td>".$row['created_on']."</td></tr>";
						}
					}
					else{
						echo "No Balances to Collect<br>";
					}
				?>
			</table>
			<hr>
			<center><h2>Pending Loan Requests</h2></center><br>
			<table style="border:1px solid black; margin-left:auto; margin-right:auto;">
				<?php
					$query = "SELECT arrangement_id, lender_id_name.username, amount, description, created_on FROM requests
							JOIN users AS borrower_id_name ON borrower_id_name.user_id = requests.borrower_id
							JOIN users AS lender_id_name ON lender_id_name.user_id = requests.lender_id
							WHERE borrower_id_name.username = '".$_SESSION['username_session']."'
							ORDER BY created_on;";
					$result = mysqli_query($conn,$query);
					if(mysqli_num_rows($result) > 0){
				?>
				<tr>
					<th>Request ID</th>
					<th>Lender</th>
					<th>Amount</th>
					<th>Description</th>
					<th>Created on</th>
				</tr>
				<?php
						while($row = mysqli_fetch_assoc($result)){
							echo "<tr><td>".$row['arrangement_id']."</td><td>".$row['username']."</td><td>".$row['amount']."</td><td>".$row['description']."</td><td>".$row['created_on']."</td></tr>";
						}
					}
					else{
						echo "No Loan Requests to Review<br>";
					}
				?>
			</table>
			<hr>
			<center><h2>Loan Requests to Approve</h2></center><br>
			<table style="border:1px solid black; margin-left:auto; margin-right:auto;">
				<?php
					$query = "SELECT arrangement_id, borrower_id_name.username, amount, description, created_on FROM requests
							JOIN users AS borrower_id_name ON borrower_id_name.user_id = requests.borrower_id
							JOIN users AS lender_id_name ON lender_id_name.user_id = requests.lender_id
							WHERE lender_id_name.username = '".$_SESSION['username_session']."'
							ORDER BY created_on;";
					$result = mysqli_query($conn,$query);
					if(mysqli_num_rows($result) > 0){
				?>
				<tr>
					<th>Request ID</th>
					<th>Borrower</th>
					<th>Amount</th>
					<th>Description</th>
					<th>Created on</th>
				</tr>
				<?php
						while($row = mysqli_fetch_assoc($result)){
							echo "<tr><td>".$row['arrangement_id']."</td><td>".$row['username']."</td><td>".$row['amount']."</td><td>".$row['description']."</td><td>".$row['created_on']."</td></tr>";
						}
					}
					else{
						echo "No Loan Requests to Review<br>";
					}
				?>
			</table>
			<form action="process_arrangement.php" method="POST">
			<p>
				<label>Loan Request ID:</label>
				<select name="arrangement_id_text">
					<?php
						$query = "SELECT * FROM hackathon2019_db.requests
								WHERE lender_id = '".$_SESSION['user_id_session']."';";
						$result = mysqli_query($conn,$query);
					?>
					<?php
					while($line = mysqli_fetch_array($result)){
					?>
						<option value="<?php echo $line['arrangement_id'];?>"> <?php echo $line['arrangement_id'];?> </option>
					<?php
					}
					?>
				</select>
				<input type="submit" id="approve_button" value="Approve">
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