<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
//error_reporting(0);
	$empname = $data["empname"];
	$email = $data["email"];
	$emp_number = $data["emp_number"];
	$pass = $data["pass"];
	$cpass = $data["cpass"];

	$hashed = hash('sha512', $pass);
	function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}
	$token= generateRandomString(10);
	if($pass != $cpass){
		echo json_encode(['error' => 'Password not matched.']);
		exit;
	}

	$empname_ch = mysqli_query($conn, "SELECT `email` FROM `employee` WHERE `email` = '$email' ");
	if(mysqli_num_rows($empname_ch) >=1){
				echo json_encode(['error' => 'Employee already exist.']);
				exit;
			}
	else{
		$sql = "INSERT INTO employee (`emid`, `empname`, `email`, `emp_number`, `pass`, `token`) VALUES ('','$empname','$email','$emp_number','$hashed','$token')";
		if (mysqli_query($conn, $sql)) {
			echo json_encode(['message' => 'Employee added']);
			exit;
			} 
		else {
			echo json_encode(['error'=> mysqli_error($conn)]);
			exit;
		}
	}

?>