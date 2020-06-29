<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	$fcm =$data['fcm'];
	$cid = $data['cid'];
	
	$sql = "SELECT * FROM client WHERE cid='$cid'";
	
	$query = mysqli_query($conn, $sql);
	
	if(mysqli_num_rows($query)==true){
		$sql1 ="UPDATE client SET Fcm_Token ='$fcm' WHERE cid = '$cid'";
		$query1 = mysqli_query($conn, $sql1);
		echo json_encode(['Message'=>'firebase cloud messaging sent.']);
		
	}
?>