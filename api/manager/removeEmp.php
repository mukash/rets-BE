 <?php
include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	
	$empId= $data['emid'];
	
	$sql = "DELETE FROM employee WHERE emid='$empId'";
    $query = mysqli_query($conn, $sql);
	echo json_encode(['message=>Employee removed']);
?>