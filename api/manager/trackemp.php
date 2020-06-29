<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);

	//$token = $data['token'];
	//$lng = $data['longitude'];
	//$lat = $data['latitude'];
	
	$sql = "SELECT * FROM tracking INNER JOIN employee ON employee.emid=tracking.emp_id ";
	
	$query = mysqli_query($conn, $sql);
	
	$fetch=mysqli_fetch_all($query, MYSQLI_ASSOC);
	
	echo json_encode ($fetch);
?>