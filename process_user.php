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
		$var_user_text = $_POST['user_text'];
		$var_pass_text = $_POST['pass_text'];
		$var_first_name_text = $_POST['first_name_text'];
		$var_last_name_text = $_POST['last_name_text'];

		$var_user_text = stripcslashes($var_user_text);
		$var_pass_text = stripcslashes($var_pass_text);
		$var_first_name_text = stripcslashes($var_first_name_text);
		$var_last_name_text = stripcslashes($var_last_name_text);
		
		//query the database
		$query = "INSERT INTO `hackathon2019_db`.`users` (`username`, `password`, `first_name`, `last_name`) VALUES ('$var_user_text', '$var_pass_text', '$var_first_name_text', '$var_last_name_text');";
		if(mysqli_query($conn,$query)){
			echo json_encode((object)[
				'status' => 200,
				'message' => 'Success',
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