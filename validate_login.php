<?php
error_reporting(0);
 session_start();
include("db_connection.php");
$email = $_POST["email"];
$pass = $_POST["pass"];
$hashed = hash ('sha512', $pass);

 $sql = mysqli_query($conn, "SELECT * FROM manager WHERE email='$email' AND pass='$hashed' "); 
//print_r($sql);
 
 if($email=="" && $pass==""){
	 $_SESSION['error'] = "Fields are empty";
    //echo "<h1>Fields are empty.</h1>";
	header("location: index.php");
 }

	   
     else if(mysqli_num_rows($sql) == 1){ 
        $row = mysqli_fetch_array($sql); 
         
        $_SESSION['email'] = $row['email']; 
		$_SESSION['logged'] = true; 
		//print_r($_SESSION);
        header ("location: dashboard.php");
        exit; 
    }else{ 
        //echo "Incorrect login details"; 
        header("location: index.php"); 
        
    } 
?>