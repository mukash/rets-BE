<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	$response_data = array();
	$cid = $data['cid'];
	$sql = "SELECT jobs.*,employee.empname,employee.emp_number FROM jobs LEFT JOIN employee ON employee.emid = jobs.emp_id WHERE client_id='$cid' AND status = 'completed'";
	//echo $sql;
    $query = mysqli_query($conn, $sql);
	if(mysqli_num_rows($query)>0){
		while($row = mysqli_fetch_assoc($query) ) {		
		$response_data[] = $row;
    }
	echo json_encode($response_data);
	}
?>