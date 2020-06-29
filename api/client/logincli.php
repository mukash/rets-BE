<?php
include '../../db_connection.php';

header('Access-Control-Allow-Origin:*');
$data = json_decode(file_get_contents('php://input'),true);
ini_set('error_reporting',1);
ini_set('display_errors',1);
error_reporting(E_ALL);

$email = $data['email'];
$pass = $data['pass'];

$query = mysqli_query($conn, "SELECT * FROM client WHERE email='$email' AND pass='$pass' "); 

//print_r($query);
//if($email =='' && $pass==''){
//	echo json_encode(['error1' => 'Please fill all the fields.']);
//}
if(mysqli_num_rows($query)){

    $row = mysqli_fetch_assoc($query);
    echo json_encode(['client'=>$row,'message'=>'user logged in successfully..']);
}
   
else{ 
   echo json_encode(['error' => 'user not logged in']);
    
} 

?>