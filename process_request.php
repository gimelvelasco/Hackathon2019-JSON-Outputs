<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
	
	$server = "localhost:3306";
	$user = "root";
	$pass = "root";
	$db = "hackathon2019_db";
	$conn = mysqli_connect($server, $user, $pass, $db);

	if(!$conn){
		die(msqli_connect_error());
	}
	else{
		$var_lender_text = $_POST['lender_text'];
		$var_borrower_text = $_POST['borrower_text'];
		$var_amount_number = $_POST['amount_number'];
		$var_description_text = $_POST['description_text'];
		$var_lender_text = stripcslashes($var_lender_text);
		$var_borrower_text = stripcslashes($var_borrower_text);
		$var_amount_number = stripcslashes($var_amount_number);
		$var_description_text = stripcslashes($var_description_text);

		$query = "INSERT INTO `hackathon2019_db`.`requests` (`lender_id`, `borrower_id`, `amount`, `description`) VALUES ('$var_lender_text', '$var_borrower_text', '$var_amount_number', '$var_description_text');";
		if(mysqli_query($conn,$query)){
			echo json_encode((object)[
				'status' => 200,
				'message' => 'Success'
			]);
		}
		else{
			echo json_encode((object)[
				'status' => 400,
				'message' => 'Failure'
			]);
		}
		mysqli_close($conn);
	}
?>