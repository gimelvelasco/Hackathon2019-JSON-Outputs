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
		$var_user_text = stripcslashes($var_user_text);
		$var_pass_text = stripcslashes($var_pass_text);
		
		//query the database
		$query = "SELECT * FROM hackathon2019_db.users WHERE username = '".$var_user_text."' AND password = '".$var_pass_text."';";
		$result = mysqli_query($conn,$query);
		$line = mysqli_fetch_array($result);

		if(mysqli_num_rows($result)==1){
			// echo "{
			// 		\"status\": 200,
			// 		\"message\": Success
			// 		\"user_id\": ".$line['user_id']."
			// 	}";
			echo json_encode((object)[
				'status' => 200,
				'message' => 'Success',
				'user_id' => $line['user_id']
			]);	
		}
		else{
			echo json_encode((object)[
				'status' => 400,
				'message' => 'Failure'
			]);
		}

		/*
		$json_array = array();
		while($row = mysqli_fetch_assoc($result)){
			$json_array[] = $row;
		}
		$jsonout = json_encode($json_array);
		echo $jsonout;
		*/
		
		mysqli_close($conn);
	}
?>