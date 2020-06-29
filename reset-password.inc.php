<?php
	include("db_connection.php");
	if(isset($_POST["reset-password-submit"])){
		$selector = $POST["selector"];
		$validator = $POST["validator"];
		$password = $POST["pwd"];
		$passwordRepeat = $POST["pwd-repeat"];
		
		if(empty($password) || empty($passwordRepeat)){
			header("Location: create-new-password.php?newpwd=empty");//masla check krana
			exit();
		}else if($password != $passwordRepeat){
			header("Location: create-new-password.php?newpwd=empty");
			exit();
		}
		$currentDate = date("U");
		$sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			echo 'There was an error';
			exit();
		}else{
			mysqli_stmt_bind_param($stmt, "s", $selector, $currentDate);
			mysqli_stmt_execute($stmt);
			
			$result = mysqli_stmt_get_result(stmt);
			if(!$row = mysqli_fetch_assoc($result)){
				echo "you need to re-submit your reset request";
				exit();
			}else{
				$tokenBin = hex2bin($validator);
				$tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);
				if($token==false){
					echo "you need to re-submit your reset request";
					xit();
				}else if($tokenCheck==true){
					$tokenEmail = $row['pwdResetEmail'];
					$sql = "SELECT * FROM manager WHERE email=?";
					$stmt = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt,$sql)){
						echo 'There was an error';
						exit();
					}else{
						mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result(stmt);
					if(!$row = mysqli_fetch_assoc($result)){
						echo "There was an error";
						exit();
					}else{
						$sql = "UPDATE manager SET pass=? WHERE email=?";
						$stmt = mysqli_stmt_init($conn);
					if(!mysqli_stmt_prepare($stmt,$sql)){
						echo 'There was an error';
						exit();
					}else{
						$newpwdhash = password_hash($password, PASSWORD_DEFAULT);
						mysqli_stmt_bind_param($stmt, "ss", $newpwdhash, $tokenEmail);
						mysqli_stmt_execute($stmt);
					}
					}
					}
				}
			}
		}
		
	}else{
		header("Location: index.php");
	}
?>