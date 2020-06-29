<?php
 session_start();
include("db_connection.php");
//error_reporting(0);
$empname = $_POST["empname"];
$email = $_POST["email"];
$emp_number = $_POST["emp_number"];
$pass = $_POST["pass"];
$cpass = $_POST["cpass"];
$imageUp = $_FILES["file"];
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$token= generateRandomString(10);
//*************************************************************//
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


//************************************************************************************************//

if($empname=="" && $email=="" && $emp_number="" && $pass="" && $cpass=""){
    echo "Fields are empty.";
	header("refresh:1; url=https://www.rets.codlers.com/registration.php");
 }
if($pass != $cpass){
    echo "Passwords don't match...";
 
    exit;
}


$empname_ch = mysqli_query($conn, "SELECT `email` FROM `employee` WHERE `email` = '$email' ");
if(mysqli_num_rows($empname_ch) >=1){
            echo "User already exist";
            
            exit;
        }
else{
	
	$hashed = hash('sha512', $pass);
    $sql = "INSERT INTO `employee`(`emid`, `empname`, `email`, `emp_number`, `pass`,`image`, `token`) VALUES ('','$empname','$email','$emp_number','$hashed','$target_file', '$token')";
    if (mysqli_query($conn, $sql)) {
        echo "New account created successfully";
 
        exit;
        } 
    else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    exit;
    }
}

?>