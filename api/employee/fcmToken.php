<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	$fcm =$data['fcm'];
	$id = $data['emid'];
	
	$sql = "SELECT * FROM employee WHERE emid='$id'";
	
	$query = mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($query)==true){
		$sql1 ="UPDATE employee SET Fcm_Token ='$fcm' WHERE emid = '$id'";
		$query1 = mysqli_query($conn, $sql1);
		echo json_encode(['Message'=>'firebase cloud messaging sent.']);
		
	}
?>