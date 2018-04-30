<?php
    // Get Flowerpot ID from url parameters
    $flowerpotID = "79B41758C";
    
    // Imports script to establish conenction to database. Creates $conn variable    
    require 'conn.php';
    
    // Creates Select Command to get all rules
    $sql = "SELECT * FROM `AlertDemo` WHERE `Flowerpot ID` = '$flowerpotID' AND `Acknowledged Timestamp` = '0000-00-00 00:00:00'";
    
    // Execute Select Command. gets every row in rules table
    $result = $conn->query($sql);

    $alertsArray = array();
    
    // Loops thorugh results
    if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
           $alertsArray[] = $row;
       }
    } else {
        echo "No Alerts";
    }


    // Close connection
    $conn->close();
    
    $alertsJSON = json_encode(array('Alerts' => $alertsArray));
    
    // Print object containing array on screen
	echo $alertsJSON;
?>






















