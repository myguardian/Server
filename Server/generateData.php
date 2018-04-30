<?php
for($i=0;$i<1000;$i++){
    $tagName = str_pad(rand(0,99), 3, '0', STR_PAD_LEFT) . substr(str_shuffle(str_repeat("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 12);;
    $timeStamp = date("Y-m-d H:i:s", time());
    
    // First three characters in tagName = tagID, after = tagManagerSerial
    $FlowerpotID = substr($tagName,3);
    $tagName = substr($tagName,0,3);

    
    // Imports script to establish conenction to database. Creates $conn variable    
    require 'conn.php';

    // Insert into table
    $sql = "INSERT INTO `Sensor Data`(`Flowerpot ID`, `Tag ID`, `Timestamp`) VALUES ('$FlowerpotID', '$tagName', '$timeStamp')";

    // Checks if insertion was successful
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully". "<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>