<?php
    // Get tagName and timeStamp from url
    $tagName = $_GET["tagName"];
    $timeStamp = $_GET["timeStamp"];
    $motion = $_GET["motion"];
    
    // First three characters in tagName = tagID, after = FlowerpotID
    $FlowerpotID = substr($tagName,3);
    $tagName = substr($tagName,0,3);
    
    // Converts timestamp from server to unix time, and then to DateTime 
    $timeStamp = date("Y-m-d H:i:s", strtotime($timeStamp));
    
    // Imports script to establish connection to database. Creates $conn variable    
    require 'conn.php';

    // Creates Insert Command
    $sql = "INSERT INTO `Sensor Data`(`Flowerpot ID`, `Tag ID`, `Timestamp`, `Motion`) VALUES ('$FlowerpotID', '$tagName', '$timeStamp', '$motion')";

    // Executes and checks status of query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
?>