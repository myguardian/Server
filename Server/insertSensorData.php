<?php
//https://hanifso.dev.fast.sheridanc.on.ca/Pi/insertSensorData.php?tagName={0}&orientationChange={1}&xAxis={2}&yAxis={3}&zAxis={4}&tagID={5}&timeStamp={6}

    // Get parameters from url
    $tagName = $_GET["tagName"];
    $timeStamp = date("Y-m-d H:i:s", time());;
    $orientationChange = $_GET["orientationChange"];
    $xAxis = $_GET["xAxis"];
    $yAxis = $_GET["yAxis"];
    $zAxis = $_GET["zAxis"];
    
    // First three characters in tagName = tagID, after = FlowerpotID
    $FlowerpotID = substr($tagName,3);
    $tagName = substr($tagName,0,3);
    
    // Imports script to establish conenction to database. Creates $conn variable    
    require 'conn.php';

    // Creates Insert Command
    $sql = "INSERT INTO `Sensor Data`(`Flowerpot ID`, `Tag ID`, `Timestamp`, `Orientation Change`, `X Axis`, `Y Axis`, `Z Axis`) VALUES ('$FlowerpotID', '$tagName', '$timeStamp', '$orientationChange', '$xAxis', '$yAxis', '$zAxis')";

    // Executes and checks status of query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
?>