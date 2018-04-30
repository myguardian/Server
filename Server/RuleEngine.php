<?php
    function checkRule($conn, $TagID, $FlowerpotID, $Rule) {
        // Calls aprropriate method to check rule based on rule chosen
        switch ($Rule) {
            // Rule number 1 is if motion is detected
            case "Garage Open":
                // Calls function that checks the Sensor Data Table to determine if motion was detected at the flowerpot ID specified by $FlowerpotID
                checkGarageOpen($conn, $TagID, $FlowerpotID);
                break;
                
            case "Door Open":
                // Calls function that checks the Sensor Data Table to determine if motion was detected at the flowerpot ID specified by $FlowerpotID
                checkDoorOpen($conn, $TagID, $FlowerpotID);
                break;
                
            // Invalid rule
            default:
        }
    }
    
    // Function that checks the Sensor Data Table to determine if motion was detected at the flowerpot ID specified by $FlowerpotID
    function checkGarageOpen($conn, $TagID, $FlowerpotID) {
        // Creates Select Command to get elements from sensor data table that detecetd motion and has the correct FlowerpotID
        $sql = "SELECT * FROM `Sensor Data` WHERE `Flowerpot ID` = '$FlowerpotID'";
    
        // Execute Select Command
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "Flowerpot: " . $row["Flowerpot ID"] . " garage opened at ". $row["Timestamp"]. "<br>";
               $shortDescription = "Garage Open";
               $longDescription = "Garage opened at ". $row["Timestamp"];
               $level = 3;
                createAlert($conn, $FlowerpotID, $shortDescription, $longDescription, $level, $row["Timestamp"]);
            }
        }

    }
    
      // Function that checks the Sensor Data Table to determine if motion was detected at the flowerpot ID specified by $FlowerpotID
    function checkDoorOpen($conn, $TagID, $FlowerpotID) {
        // Creates Select Command to get elements from sensor data table that detecetd motion and has the correct FlowerpotID
        $sql = "SELECT * FROM `Sensor Data` WHERE `Flowerpot ID` = '$FlowerpotID'";
    
        // Execute Select Command
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "Flowerpot: " . $row["Flowerpot ID"] . " door opened at ". $row["Timestamp"]. "<br>";
               $shortDescription = "Door Open";
               $longDescription = "Door opened at ". $row["Timestamp"];
               $level = 3;
                createAlert($conn, $FlowerpotID, $shortDescription, $longDescription, $level, $row["Timestamp"]);
            }
        }

    }
    
      // Function that creates an alert in the Alerts table
    function createAlert($conn, $FlowerpotID, $shortDescription, $longDescription, $level, $timeStamp) {
        $alertTime = $timeStamp;
        
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
    $sql = "SELECT `Tag ID`, `Flowerpot ID`, `Rule` FROM `Rules` WHERE 1";
    
    // Execute Select Command. gets every row in rules table
    $result = $conn->query($sql);

    // Loops thorugh results
    if ($result->num_rows > 0) {
        // Call function to check each rule against data from Sensor Data Table.
       while($row = $result->fetch_assoc()) {
           // Calls function to call appropriate function based on rule number
           checkRule($conn, $row["Tag ID"], $row["Flowerpot ID"], $row["Rule"]);
       }
    } else {
        echo "No Rules";
    }


    // Close connection
    $conn->close();
    
?>






















