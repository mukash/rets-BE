<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
//error_reporting(0);
	$clientname = $data["name"];
	$email = $data["email"];
	$ph_number = $data["ph_number"];
	$address = $data["address"];
	$pass = $data["pass"];
	$cpass = $data["cpass"];


	if($pass != $cpass){
		echo json_encode(['error' => 'Password not matched.']);
		exit;
	}

	$client_ch = mysqli_query($conn, "SELECT `email` FROM `client` WHERE `email` = '$email' ");
	if(mysqli_num_rows($client_ch)>=1){
				echo json_encode(['error' => 'user already exist.']);
				exit;
			}
	else{
		$sql = "INSERT INTO `client`(`cid`, `name`, `email`, `ph_number`, `pass`) VALUES ('','$clientname','$email','$ph_number','$pass')";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(['message' => 'Registered successfully']);
			exit;
			} 
		else {
			echo json_encode(['error'=> mysqli_error($conn)]);
			exit;
		}
	}

?>