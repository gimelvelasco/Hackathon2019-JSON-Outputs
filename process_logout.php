<?php
	SESSION_START();
	if(isset($_SESSION['username_session'])){
		echo "<h1>Logging out ".$_SESSION['username_session']."</h1>";
		SESSION_UNSET();
		SESSION_DESTROY();
		$message = "Logout Successful";
		echo "<script type='text/javascript'>
			alert('$message');
			window.location='index.php';
			</script>";
	}
	else{
		$message = "No User Login!";
		echo "<script type='text/javascript'>
			alert('$message');
			window.location='index.php';
			</script>";
	}
?>