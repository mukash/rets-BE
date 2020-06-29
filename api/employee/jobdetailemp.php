<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	error_reporting(E_ALL);
	$jid = $data['jid'];
	$emp_id =$data['emid'];
	$sql = "SELECT jobs.*,tracking.latitude as t_lat,tracking.longitude as t_long , client.name, client.ph_number FROM jobs LEFT JOIN tracking ON tracking.emp_id = jobs.emp_id LEFT JOIN client ON client.cid = jobs.client_id WHERE jobs.emp_id ='$emp_id' and jobs.jid ='$jid' ";	
	$query = mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)==true){
		$result = mysqli_fetch_assoc($query);
	
		echo json_encode(['job_detail'=>$result]);
	}
	//print_r($query);
?>