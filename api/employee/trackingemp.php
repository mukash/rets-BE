<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	error_reporting(E_ALL);
	
	$token = $data['token'];
	$lng = $data['longitude'];
	$lat = $data['latitude'];
	
	$sql = "SELECT emid FROM employee WHERE token='$token' ";
	
	$query = mysqli_query($conn, $sql);
	
	$fetch_id = mysqli_fetch_assoc($query);
	
	$sql1 = "SELECT * FROM tracking WHERE emp_id=$fetch_id[emid]";
	
	$query1 = mysqli_query($conn,$sql1);
	if(mysqli_num_rows($query1)==false){
		$sql2 = "INSERT INTO tracking (`trackid`,`emp_id`,`latitude`,`longitude`,`last_updated`) VALUES ('','$fetch_id[emid]','$lat','$lng', NOW())";
		$query2 = mysqli_query($conn,$sql2);
		echo json_encode(['message'=>'Tracking started']);
	}else{
		$sql3 = "UPDATE tracking SET latitude='$lat' , longitude='$lng' WHERE emp_id='$fetch_id[emid]'";
		$query3 = mysqli_query($conn,$sql3);
		echo json_encode(['message'=>'Location updated']);
	}
?>	