<?php 
include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	
	$id =$data['id'];
	
	/**all jobs ***/
	$response_data = array();
	$sql = "SELECT jobs.*,employee.empname,employee.emp_number FROM jobs INNER JOIN employee ON employee.emid=jobs.emp_id WHERE emp_id>1 AND client_id='$id'";
    $query = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($query) ) {		
		$response_data[] = $row;
    }
	$count = count($response_data);
	
	
	/****all completed jobs****/
	
	$sql1="SELECT jobs.*,employee.empname,employee.emp_number FROM jobs INNER JOIN employee ON employee.emid=jobs.emp_id WHERE emp_id>1 AND client_id='$id' AND status='completed'";
	$query1 = mysqli_query($conn, $sql1);
	$response_data1=array();
	while($row1 = mysqli_fetch_assoc($query1)) {		
		$response_data1[] = $row1;
	}
	$completedCount=count($response_data1);
	
		/****all pending jobs****/
	$sql2="SELECT jobs.*,employee.empname,employee.emp_number FROM jobs INNER JOIN employee ON employee.emid=jobs.emp_id WHERE emp_id>1 AND client_id='$id' AND status='Pending'";
	$query2 = mysqli_query($conn, $sql2);
	$response_data2=array();
	while($row2 = mysqli_fetch_assoc($query2)) {		
		$response_data2[] = $row2;
	}
	$pendingCount=count($response_data2);
	

	echo json_encode(['count'=>$count,'completedCount'=>$completedCount,'pendingCount'=>$pendingCount, 'completed'=>$response_data1,'Pending'=>$response_data2]);



?>