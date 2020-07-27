 <?php
include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);

	$counter = 1;
	$response_data = array();
	$sql = "SELECT * FROM employee WHERE emid>1";
    $query = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($query) ) {		
	
		$response_data[] = $row;
   
    }
	
	$count = count($response_data);
	$response_data2 = array();
	$sq2 = "SELECT * FROM employee WHERE emid>1 AND job_status='Free'";
    $query2 = mysqli_query($conn, $sq2);
    while($row2 = mysqli_fetch_assoc($query2) ) {		
	
		$response_data2[] = $row;
   
    }
	
	$countFree = count($response_data2);
	$response_data3 = array();
	$sql3 = "SELECT * FROM employee WHERE emid>1 AND job_status='Working'";
    $query3 = mysqli_query($conn, $sql3);
    while($row3 = mysqli_fetch_assoc($query3) ) {		
	
		$response_data3[] = $row3;
   
    }
	
	$countWorking = count($response_data3);
	
	echo json_encode(['list'=> $response_data,'free'=>$response_data2,'working'=>$response_data3, 'totalEmp'=>$count,'totalFree'=>$countFree,'totalWorking'=>$countWorking]);
?>