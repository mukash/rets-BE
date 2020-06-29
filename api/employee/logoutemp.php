<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	error_reporting(E_ALL);
	
	$token = $data['token'];
	$sql = "SELECT emid FROM employee WHERE token ='$token' ";
	
	$query = mysqli_query($conn, $sql);
	if(mysqli_num_rows($query)==true){
		$fetch_id = mysqli_fetch_assoc($query);
		$id=$fetch_id['emid'];
		
		$sql1 = "SELECT * FROM tracking WHERE emp_id=$id";
		$query1 = mysqli_query($conn,$sql1);
		
		if(mysqli_num_rows($query1)==true){
			$sql2 = "DELETE FROM tracking WHERE emp_id=$id";
			$del = mysqli_query($conn,$sql2);
			//print_r($del);
			echo json_encode(['message'=>'tracking stopped successfully.']);
		}
	}
?>	