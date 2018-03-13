<?php
    function checkRule($conn, $TagID, $FlowerpotID, $RuleNum) {
        // Calls aprropriate method to check rule based on rule chosen
        switch ($RuleNum) {
            // Rule number 1 is if motion is detected
            case 1:
                // Calls function that checks the Sensor Data Table to determine if motion was detected at the flowerpot ID specified by $FlowerpotID
                checkMotion($conn, $TagID, $FlowerpotID);
                break;
            // Invalid rule
            default:
        }
    }
    
    // Function that checks the Sensor Data Table to determine if motion was detected at the flowerpot ID specified by $FlowerpotID
    function checkMotion($conn, $TagID, $FlowerpotID) {
        // Creates Select Command to get elements from sensor data table that detecetd motion and has the correct FlowerpotID
        $sql = "SELECT `Flowerpot ID`, `Tag ID`, `Timestamp`, `Acknowledge Time`, `Motion` FROM `Sensor Data` WHERE Motion = 1 AND `Flowerpot ID` = '$FlowerpotID'";
    
        // Execute Select Command
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
               // Print if motion was detected for the specified flowerpot
                echo "Flowerpot: " . $row["Flowerpot ID"] . " detected motion at ". $row["Timestamp"]. "<br>";
               $shortDescription = "Motion Detected";
               $longDescription = "Flowerpot: " . $row["Flowerpot ID"] . " detected motion at ". $row["Timestamp"];
               $level = 3;
                createAlert($conn, $FlowerpotID, $shortDescription, $longDescription, $level);
            }
        }

    }
    
      // Function that creates an alert in the Alerts table
    function createAlert($conn, $FlowerpotID, $shortDescription, $longDescription, $level) {
        $alertTime = date("Y-m-d H:i:s",time());
        
        // Creates Insert Command
        //$sql = "INSERT INTO `Alerts`(`Flowerpot ID`, `Short Description`, `Long Description`, `Level`) 
        $sql = "INSERT INTO `Alerts`(`Flowerpot ID`, `Short Description`, `Long Description`, `Level`, `Alert Timestamp`, `Acknowledged Timestamp`, `Image`, `Sound`)
        VALUES ('$FlowerpotID', '$shortDescription', '$longDescription', '$level', '$alertTime' , 'NULL', 'NULL', 'NULL')";
        
        // Executes and checks status of query
        if ($conn->query($sql) === TRUE) {
            echo "New alert created successfully" . "<br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
        
    // Imports script to establish conenction to database. Creates $conn variable    
    require 'conn.php';
    
    // Creates Select Command to get all rules
    $sql = "SELECT `Tag ID`, `Flowerpot ID`, `Rule Number` FROM `Rules` WHERE 1";
    
    // Execute Select Command. gets every row in rules table
    $result = $conn->query($sql);

    // Loops thorugh results
    if ($result->num_rows > 0) {
        // Call function to check each rule against data from Sensor Data Table.
       while($row = $result->fetch_assoc()) {
           // Calls function to call appropriate function based on rule number
           checkRule($conn, $row["Tag ID"], $row["Flowerpot ID"], $row["Rule Number"]);
       }
    } else {
        echo "No Rules";
    }


    // Close connection
    $conn->close();
    
?>






















