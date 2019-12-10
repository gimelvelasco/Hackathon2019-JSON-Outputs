<?php
	header("Access-Control-Allow-Origin: *");
	
	$server = "localhost:3306";
	$user = "root";
	$pass = "root";
	$db = "hackathon2019_db";
	$conn = mysqli_connect($server, $user, $pass, $db);

	if(!$conn){
		die(msqli_connect_error());
	}
	else{
		$var_arrangement_id_text = $_POST['arrangement_id_text'];
		//$var_amount_number = $_POST['amount_number'];
		$var_arrangement_id_text = stripcslashes($var_arrangement_id_text);
		//$var_amount_number = stripcslashes($var_amount_number);

		//echo "".$_POST['arrangement_id_text']."";
		$query = "INSERT INTO `hackathon2019_db`.`paid` (`lender_id`, `borrower_id`, `amount`, `description`) 
				SELECT `lender_id`, `borrower_id`, `amount`, `description`
				FROM arrangements
				WHERE arrangement_id = '".$var_arrangement_id_text."';";

		if(mysqli_query($conn,$query)){
			$query = "DELETE FROM `hackathon2019_db`.`arrangements` WHERE (`arrangement_id` = '".$var_arrangement_id_text."');";
			mysqli_query($conn,$query);
			$message = "Payment Successful!";
			echo "{
					\"status\": 200,
					\"message\": Success
				}";
		}
		else{
			echo "{
					\"status\": 400,
					\"message\": Failure
				}";
		}		
		mysqli_close($conn);
	}
?>