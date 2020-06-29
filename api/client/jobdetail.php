<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	error_reporting(E_ALL);
	$jid = $data['jid'];
	$cid =$data['cid'];
	$sql = "SELECT jobs.*,tracking.latitude as t_lat,tracking.longitude as t_long , employee.empname FROM jobs LEFT JOIN tracking ON tracking.emp_id = jobs.emp_id LEFT JOIN employee ON employee.emid = jobs.emp_id WHERE jobs.client_id ='$cid' and jobs.jid = '$jid' ";	
	$query = mysqli_query($conn,$sql);
	//print_r($query);
	echo json_encode(mysqli_fetch_all($query, MYSQLI_ASSOC));
?>