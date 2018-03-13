<?php
    // Set database name, mysql username, mysql password, and server address
	$dbname = "hanifso_Pi";
	$username = "hanifso";
	$password = "K?t7?MkVkeC";
	$servername = "hanifso.dev.fast.sheridanc.on.ca";
	
    // Create connection to database. Used to access all tables since they are on the same server.
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>






















