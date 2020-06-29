
<?php
include("db_connection.php");
 session_start();

$id = $_REQUEST['id'];

$job_del= "DELETE FROM jobs WHERE emp_id= '$id' ";
$emp_del = "DELETE FROM employee WHERE id= '$id' ";


if(mysqli_query($conn, $job_del)){
	if(mysqli_query($conn, $emp_del)){
		echo "Data deleted sucessfully!";
	}
}
?>