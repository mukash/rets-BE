<?php
include("db_connection.php");
    $num = mysqli_query($conn, "SELECT * FROM employee");
	$len= mysqli_num_rows($num);
	 

echo $len;
?>
