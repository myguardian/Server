<?php
//https://hanifso.dev.fast.sheridanc.on.ca/Pi/insertSensorData.php?tagName={0}&orientationChange={1}&xAxis={2}&yAxis={3}&zAxis={4}&tagID={5}&timeStamp={6}

    // Get parameters from url
    $object = $_GET["object"];
    $timestamp = $_GET["timestamp"];
    $status = "open";
    
    // Imports script to establish conenction to database. Creates $conn variable    
    require 'conn.php';
    
    $sql = "SELECT * FROM `Demo` WHERE `Object` = '$object'";
    
    $result = $conn->query($sql);

    // Loops thorugh results
    if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
           $status = $row["Status"];
        }
    }

    if($status == "open"){
        $status = "closed";
    }
    else{
        $status = "open";
    }

    // Creates Update Command
    $sql = "Update `Demo` Set `Status` = '$status' Where Object = '$object'";
    

    // Executes and checks status of query
    if ($conn->query($sql) === TRUE) {
    }
    
    // Creates Update Command
    $sql = "Update `Demo` Set `Timestamp` = '$timestamp' Where Object = '$object'";

    // Executes and checks status of query
    if ($conn->query($sql) === TRUE) {
    }
    
    // Close connection
    $conn->close();
    
    require 'generateAlerts.php';
    
?>