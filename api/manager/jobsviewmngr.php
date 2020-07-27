<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);


	$response_data = array();
	$sql = "SELECT jobs.*,client.cid,client.name,client.ph_number,employee.empname,employee.emp_number FROM jobs INNER JOIN client ON client.cid=jobs.client_id INNER JOIN employee ON employee.emid=jobs.emp_id WHERE emp_id>1";
    $query = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($query) ) {		
		$response_data[] = $row;
    }
	echo json_encode(['list'=> $response_data]);
?>