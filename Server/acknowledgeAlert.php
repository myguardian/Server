<?php
    // Get Alert ID from url parameters
    $alertID = $_GET["alertID"];
    
    // Imports script to establish conenction to database. Creates $conn variable    
    require 'conn.php';
    
    // Creates Select Command to get all rules
    $sql = "SELECT * FROM `Alerts` WHERE `Alert ID` = '$alertID'";
    
    // Execute Select Command. gets every row in rules table
    $result = $conn->query($sql);

    
    // Loops thorugh results
    if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
           $alertTime = date("Y-m-d H:i:s",time());
           $sql = "UPDATE `Alerts` SET `Acknowledged Timestamp`='$alertTime'  WHERE `Alert ID` = '$alertID'";
           $conn->query($sql);
            echo "Acknowledged Alert";
       }
    } else {
        echo "Alert not found";
    }


    // Close connection
    $conn->close();
?>






















