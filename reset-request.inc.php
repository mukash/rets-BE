<?php
	session_start();
	include("db_connection.php");

	if(isset($_POST["reset-request-submit"])){
		$selector = bin2hex(random_bytes(8));
		$token = random_bytes(32);
		$url = "https://www.rets.codlers.com/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token) . "";
		$expires= date("U")+ 1800;
		$userEmail =$POST["email"]; 
		$sql= "DELETE FROM pwdReset WHERE pwdrstEmail=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			echo 'There was an error';
			exit();
		}else{
			mysqli_stmt_bind_param($stmt, "s", $userEmail);
			mysqli_stmt_execute($stmt);
		}
		$sql= "INSERT INTO pwdReset (`pwdrstid`,`pwdrstEmail`,`pwdrstSelector`,`pwdrstToken`,`pwdrstExpires`) VALUES (?, ? ,? ,?)";
		if(!mysqli_stmt_prepare($stmt,$sql)){
			echo 'There was an error';
			exit();
		}else{
			$hashed = password_hash($token, PASSWORD_DEFAULT);
			mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selelctor, $hashed, $expires);
			mysqli_stmt_execute($stmt);
		}
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
		$to = $userEmail;
		$subject = "Reset your password for rets.";
		$message = '<p>We recievd a password reset request. The link to rest 
		your password is given bellow,if you did not make this request, you can ignore this mail </p>';
		$message .= '<p>Here is your password reset link:</p>';
		$message .= '<a href="' . $url . '>' . $url . '</a>';
		
		$headers = "From: rets <mkwastii@gmail.com>\r\n";
		$headers .= "Reply-To: rets mkwastii@gmail.com\r\n";
		$headers .= "Content-type: text/html\r\n";
		$mail($to, $subject, $message, $header);
		header("Location: reset-password.php?reset=success");
		
	
	
	
	
	}else{
		header("location: index.php");
	}


?>