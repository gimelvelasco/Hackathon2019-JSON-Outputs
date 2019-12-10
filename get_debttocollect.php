<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");

	$server = "localhost:3306";
	$user = "root";
	$pass = "root";
	$db = "hackathon2019_db";
	$conn = mysqli_connect($server, $user, $pass, $db);

	$query = "SELECT borrower_id_name.username, amount, description, created_on FROM arrangements
			JOIN users AS borrower_id_name ON borrower_id_name.user_id = arrangements.borrower_id
			JOIN users AS lender_id_name ON lender_id_name.user_id = arrangements.lender_id
			WHERE lender_id_name.username = '".$_POST['user_text']."'
			ORDER BY created_on;";

	$result = mysqli_query($conn,$query);
	if(mysqli_num_rows($result) > 0){
		$json_array = array();
		while($row = mysqli_fetch_assoc($result)){
			$json_array[] = $row;
		}
		$jsonout = json_encode($json_array);
		echo $jsonout;
	}
	else{
		echo json_encode((object)[
				'status' => 200,
				'message' => 'No Debt to Collect'
			]);
	}
	mysqli_close($conn);
?>