<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	$response_data = array();
	//$emp_id=$data['emid'];
	$token = $data['token'];
	$query= mysqli_query($conn, "SELECT emid FROM employee WHERE token='$token' ");
	if(mysqli_num_rows($query)==true){
		$fetch_id =mysqli_fetch_assoc($query); 
		$id=$fetch_id['emid'];
		$sql = "SELECT jobs.*,client.cid,client.name,client.ph_number FROM  jobs INNER JOIN client ON client.cid=jobs.client_id WHERE emp_id=$id AND status='completed';";
		$query1 = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($query1)!=0){
		while($row = mysqli_fetch_assoc($query1)) {		
			$response_data[] = $row;
		}
			
		echo json_encode($response_data);
		}else{
			echo json_encode(['Message'=>'You have no jobs.']);
		}
	}
	
	else{
	echo json_encode(['error' => 'employee doesnot exist']);
	}
?>