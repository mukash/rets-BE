<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	$token = $data['token'];
	$sql = "SELECT * FROM employee WHERE token ='$token' ";
	
	$query = mysqli_query($conn, $sql);
	if(mysqli_num_rows($query)==true){
		$fetch = mysqli_fetch_assoc($query);
		$fetch_id=$fetch['emid'];
		
		$sql1="SELECT AVG(rating) FROM jobs WHERE emp_id='$fetch_id' AND status='completed'";
		$query1 = mysqli_query($conn, $sql1);
		
//		echo json_encode($avg);
		$sql2="SELECT * FROM jobs WHERE emp_id='$fetch_id' AND status='completed'";
		$query2 = mysqli_query($conn, $sql2);
		$response_data=array();
		while($row = mysqli_fetch_assoc($query2)) {		
			$response_data[] = $row;
		}
		if($response_data==null){
			$count=0;
			$avg=0;
			echo json_encode([$count,$avg]);
		}
		else {
			$count=count($response_data);
			$avg=mysqli_fetch_row($query1);
			$rating=implode($avg);
			$sql3 = "UPDATE employee SET rating='$rating', job_assigned='$count' WHERE emid='$fetch_id'";
			$sql4="SELECT jid from jobs where emp_id='$fetch_id' AND status='completed'";
			$query4 = mysqli_query($conn, $sql4);
			$sql5="SELECT rating from jobs where emp_id='$fetch_id' AND status='completed'";
			$query5 = mysqli_query($conn, $sql5);
			//print_r($query4);
			$query3 = mysqli_query($conn, $sql3);
			$response=array();
			while($lables = mysqli_fetch_assoc($query4)) {		
				$lable[] = $lables['jid'];
			}
			while($rate = mysqli_fetch_assoc($query5)) {		
				$ratings[] = intval($rate['rating']);
			}
			echo json_encode(['count'=>$count,'average'=>$avg,'lable'=>$lable,'rating'=>$ratings]);
		};
		
	}
?>