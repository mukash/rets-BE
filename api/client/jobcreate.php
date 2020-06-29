<?php
include '../../db_connection.php';

header('Access-Control-Allow-Origin:*');
$data = json_decode(file_get_contents('php://input'),true);
ini_set('error_reporting',1);
ini_set('display_errors',1);
error_reporting(E_ALL);

$cid=$data["cid"];
$address = $data['address'];
$des = $data['description'];
$long = $data["longitude"];
$lat = $data["latitude"];
$title= 'New Job';
$msg_data ='You have received a new job request.';
function sendPushNotices( $msg_data, $title, $fcm  ) {
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

		//if($payload != null)
		//	$fields['data'] = $payload;

		$headers = array
		(
			'Authorization:key=AAAAbA9DhyY:APA91bE_P7VI9A2Oud5oOtbEDooIep19vo91hVqud3VQUfkjsbccpcG1Rs0qwPnwlWP4218IGnmBOT8RvRKqLXQCBGJZ-HjKE_LMX7pSVfBode4CDE0wYf_Uk9cG2PouNt_K6rKE0fBr',
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
$query = mysqli_query($conn, "SELECT cid FROM client WHERE cid='$cid' ");

if(mysqli_num_rows($query)>0){
		$sql11 ="INSERT INTO jobs (`jid`, `emp_id`,`client_id`,`address`,`description`,`latitude`,`longitude`,`dated`,`status`,`rating`) VALUES ('','1','$cid','$address','$des','$lat','$long',NOW(),'Pending','0' )";
		$query2=mysqli_query($conn, $sql11);
		$last_id = mysqli_insert_id($conn);
		echo json_encode(['message'=>'job Inserted successfully']);
		//haversine formula
		$sql ='SELECT tracking.emp_id,tracking.longitude,tracking.latitude,(6371000*acos(cos(radians('.$lat.'))*cos(radians(tracking.latitude))*cos(radians(tracking.longitude)-radians('.$long.'))+sin(radians('.$lat.'))*sin(radians(tracking.latitude)))) AS distance  from tracking ORDER BY distance ASC LIMIT 1';
		$query = mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($query)>0){
			$fetch_id=mysqli_fetch_assoc($query);
			$id =$fetch_id['emp_id'];
			$sql1="UPDATE jobs SET emp_id=$id WHERE jid=$last_id";
			$update=mysqli_query($conn,$sql1);
			//print_r($id);
			$sql2= "SELECT * From employee WHERE emid='$id'";
			$query2 = mysqli_query($conn, $sql2);
			$fetch_fcm=mysqli_fetch_assoc($query2);
			$fcm = $fetch_fcm['Fcm_token'];
			sendPushNotices( $msg_data, $title, $fcm );
			//print_r($fcm);
		}
		else{
			echo json_encode(['error'=>'No employee avalible at the moment please try later.']);
		}		
}
else{
	echo json_encode(['error'=>'User does not exist.']);
}

?>