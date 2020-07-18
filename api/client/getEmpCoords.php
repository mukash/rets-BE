<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	$jid =$data['jid'];
	
	$sql = "SELECT employee.token FROM  jobs INNER JOIN employee ON employee.emid = jobs.emp_id WHERE jid = '$jid' LIMIT 1";
	$results = mysqli_query($conn , $sql);
	$jobDetail = mysqli_fetch_assoc($results);
		
	echo json_encode(['token'=>$jobDetail['token']]);
	
?>	