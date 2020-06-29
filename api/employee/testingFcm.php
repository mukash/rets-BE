<?php
	include '../../db_connection.php';
	header('Access-Control-Allow-Origin:*');
	$data = json_decode(file_get_contents('php://input'),true);
	ini_set('error_reporting',1);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	$msg_data = 'testing my first push through php';
	$title = 'RETS';
	$fcm='elefzXzYgg4:APA91bEifuzlolWqHAipB2LbBoFOLBNX0Mh4Bt64NspqE6OyzMsQOscKWJ1NYl-W4bfGntJ1M2oTwo4RtGKNxWIAdFABPRI8O9cFBYm83kfYiSRKiDdvwLu7FcWOphfasJSQ5LvKqZJv';
		function sendPushNotices( $msg_data, $title, $fcm, $payload=null) {
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
		print_r($data);
		//return $data->success;
	}
	
	sendPushNotices( $msg_data, $title, $fcm,$payload=null);
		
?>