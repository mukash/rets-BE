<?php
    
	 $servername = "localhost";
     $username = "jhnerdco_rets";
     $password = "g^p&2a1@hV)o";
     $db = 'jhnerdco_rets';
     // Create connection
     $conn = new mysqli($servername, $username, $password, $db);
     
     // Check connection
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }  
?>