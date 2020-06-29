<?php
include '../../db_connection.php';

header('Access-Control-Allow-Origin:*');
$data = json_decode(file_get_contents('php://input'),true);

$email = $data['email'];
$pass = $data['pass'];

$hashed = hash('sha512', $pass);

$query = mysqli_query($conn, "SELECT * FROM employee WHERE email='$email' AND pass='$hashed' "); 

if(mysqli_num_rows($query)){

    $row = mysqli_fetch_assoc($query);
	$row['image'] = "http://rets.codlers.com/".$row['image'];
    echo json_encode(['employee'=>$row,'message'=>'user logged in successfully..']);
}
   
else{ 
   echo json_encode(['error' => 'user not logged in']);
    
} 

