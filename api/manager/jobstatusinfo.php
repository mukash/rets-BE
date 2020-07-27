<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	/***average of completed jobs***/
	$sql1="SELECT AVG(rating) FROM jobs WHERE status='completed'";
	$query1 = mysqli_query($conn, $sql1);
	$avg=mysqli_fetch_row($query1);
	
	
	/****all jobs and count****/
	$sql5="SELECT * FROM jobs";
	$query5 = mysqli_query($conn, $sql5);
	$response_data5=array();
	while($row5 = mysqli_fetch_assoc($query5)) {		
		$response_data5[] = $row5;
	}
	$count=count($response_data5);
	
	/****all completed jobs adn count****/
	$sql2="SELECT jobs.*,client.cid,client.name,client.ph_number,employee.empname,employee.emp_number FROM jobs INNER JOIN client ON client.cid=jobs.client_id INNER JOIN employee ON employee.emid=jobs.emp_id WHERE emp_id>1 AND status='completed'";
	$query2 = mysqli_query($conn, $sql2);
	$response_data1=array();
	while($row1 = mysqli_fetch_assoc($query2)) {		
		$response_data1[] = $row1;
	}
	$completedCount=count($response_data1);
	
	
	/****all pending jobs and count****/
	$sql3="SELECT jobs.*,client.cid,client.name,client.ph_number,employee.empname,employee.emp_number FROM jobs INNER JOIN client ON client.cid=jobs.client_id INNER JOIN employee ON employee.emid=jobs.emp_id WHERE emp_id>1 AND status='Pending'";
	$query3 = mysqli_query($conn, $sql3);
	$response_data2=array();
	while($row2 = mysqli_fetch_assoc($query3)) {		
		$response_data2[] = $row2;
	}
	$pendingCount = count($response_data2);
	
/****all processing jobs and count****/
	$sql4="SELECT jobs.*,client.cid,client.name,client.ph_number,employee.empname,employee.emp_number FROM jobs INNER JOIN client ON client.cid=jobs.client_id INNER JOIN employee ON employee.emid=jobs.emp_id WHERE emp_id>1 AND status='Processing'";
	$query4 = mysqli_query($conn, $sql4);
	$response_data3=array();
	while($row3 = mysqli_fetch_assoc($query4)) {		
		$response_data3[] = $row3;
	}
	$processingCount = count($response_data3);

	echo json_encode(['avg'=>$avg,'count'=>$count,'completedCount'=>$completedCount,'processingCount'=>$processingCount,'pendingCount'=>$pendingCount, 'completed'=>$response_data1,'pending'=>$response_data2,'processing'=>$response_data3]);

?>