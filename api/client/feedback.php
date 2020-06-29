<?php
include '../../db_connection.php';

header('Access-Control-Allow-Origin:*');
$data = json_decode(file_get_contents('php://input'),true);
ini_set('error_reporting',1);
ini_set('display_errors',1);
error_reporting(E_ALL);

$feedback = $data['feedback'];
$jid = $data['jid'];

$sql = " SELECT * FROM jobs WHERE  jid = '$jid'";
$query = mysqli_query($conn , $sql);

if(mysqli_num_rows ($query)==true)
{
	$sql1 = "UPDATE jobs SET rating = '$feedback' WHERE jid = '$jid' ";
	$query1= mysqli_query($conn,$sql1 );
	echo json_encode(['message'=> 'Thanks for your feedback']);
}


?>