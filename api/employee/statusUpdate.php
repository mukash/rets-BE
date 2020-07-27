<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	$jid =$data['jid'];
	
	/**********************/
	$coords = "SELECT * FROM jobs WHERE jid = '$jid' ";
	$query_coords = mysqli_query($conn , $coords);
	$fetch_data2 = mysqli_fetch_assoc($query_coords);
	$fetch_emp_id = $fetch_data2['emp_id'];
	$fetch_long_cli = $fetch_data2['longitude'];
	$fetch_lat_cli = $fetch_data2['latitude'];
	 $coords1 = "SELECT * FROM tracking WHERE emp_id = '$fetch_emp_id'";
	 $query_coords1 = mysqli_query($conn, $coords1);
	 $fetch_data1 = mysqli_fetch_assoc($query_coords1);
	
	 $fetch_emp_long = $fetch_data1['longitude'];
	 $fetch_emp_lat = $fetch_data1['latitude'];
	/**********************/
	$job_array= array('job_id'=>$jid,'lat_cli'=>$fetch_lat_cli,'lng_cli'=>$fetch_long_cli,'lat_emp'=>$fetch_emp_lat,'lng_emp'=>$fetch_emp_long, 'rets'=>'job');
	//$fcm='fUKC2ySxO0Y:APA91bHcqQBAq4nVrZ2-024cHszg9SqL36FjNjcK46o7wM7SaY8vRdGnx5xBe2vcE28QYV3nTPsnzBTdWlvscV4ANCdK_oYSMPIndl2nBqoRFRYyU5zkWC2eEGoTdmOR_hnQrO2pSHcA';
	$fcm_jid = "Select * FROM jobs WHERE jid = '$jid'";
	$run = mysqli_query($conn, $fcm_jid);
	$fetch = mysqli_fetch_assoc($run);
	$fetch_cid = $fetch['client_id'];
	
	$getId = "SELECT Fcm_token FROM client WHERE cid='$fetch_cid'";
	$run1 = mysqli_query($conn, $getId);
	//print_r($run1);
	$fetch_client = mysqli_fetch_assoc($run1);
	$fetch_cid_token = $fetch_client['Fcm_token'];
	//print_r($fetch_cid_token);
	/*******Notification function*******/
	function sendPushNotices( $msg_data, $title, $fcm, $payload) {
		$msg     = array
		(
			'body'  => $msg_data,
			'title' => $title,
			'sound' => "default",
			'color' => "#48575E"
		);
		$fields  = array
		(
			'to'           => $fcm,
			'priority'     => 'high',
			'time_to_live' => 2419200,
			'notification' => $msg
		);

		if($payload != null)
			$fields['data'] = $payload;

		$headers = array
		(
			'Authorization:key=AAAAVaLXzE4:APA91bENUubT8DZLhd_QLHFoOPAqOga3aego3e9qU4WbeH9095YGHim9jzY6UtZ88W6sgLWNY71tZn0WhoygXYgrHsfTXuPwHQO6W75gOm6rXefqX1n5sCfI7o06Zz7-35zgmKnbrkdZ',
			'Content-Type: application/json'
		);
		$ch      = curl_init();
		curl_setopt( $ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec( $ch );
		curl_close( $ch );
		$data = json_decode( $result );
		//print_r($data);
		//return $data->success;
	}
	$sql = "SELECT * FROM jobs where jid ='$jid'";
	$query= mysqli_query($conn, $sql);
	if(mysqli_num_rows($query)==true){
		$fetch_data = mysqli_fetch_assoc($query);
		$fetch_status =$fetch_data['status'];
		if($fetch_status=='Pending'){
			/***Map push and status change***/
			$title_feedback= 'Your complian under processing';
			$msg_data_feedback ='our complain is being entertained now';
			$sql1="UPDATE jobs SET status='Processing' WHERE jid='$jid'";
			$query1= mysqli_query($conn,$sql1 );
			echo json_encode(['message'=>'Complain is under processing.']);
			sendPushNotices( $msg_data_feedback, $title_feedback, $fetch_cid_token, $job_array);
			$sql3 = "UPDATE employee SET job_status='Working' WHERE emid='$fetch_emp_id'";
			$query3 = mysqli_query($conn, $sql3);
		}else{
			/***feedback push and status change***/
			$job_array['rets'] = 'feedback';
			$title_feedback= 'Job completed';
			$msg_data_feedback =' please give feedback.';
			$sql2="UPDATE jobs SET status='completed' WHERE jid='$jid'";
			$query2= mysqli_query($conn,$sql2 );
			echo json_encode(['message'=>'Job is completed.']);
			sendPushNotices( $msg_data_feedback, $title_feedback, $fetch_cid_token, $job_array);
			$sql4 = "UPDATE employee SET job_status='Free' WHERE emid='$fetch_emp_id'";
			$query4= mysqli_query($conn, $sql4);
			//echo json_encode(['message'=>'Job is completed.']);
			
		}
		
		
	}
?>