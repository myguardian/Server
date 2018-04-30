<?php
      // Function that creates an alert in the Alerts table
    function createAlert($conn, $FlowerpotID, $shortDescription, $longDescription, $level, $timeStamp) {
        $alertTime = $timeStamp;
        
        $sql = "SELECT * FROM `AlertDemo` WHERE `Long Description` = '123'";
    
        // Execute Select Command
        $result = $conn->query($sql);
        
        if ($result->num_rows <= 0) {
            // Creates Insert Command
            $sql = "INSERT INTO `AlertDemo`(`Flowerpot ID`, `Short Description`, `Long Description`, `Level`, `Alert Timestamp`, `Acknowledged Timestamp`, `Image`, `Sound`)
            VALUES ('$FlowerpotID', '$shortDescription', '$longDescription', '$level', '$alertTime' , 'NULL', 'NULL', 'NULL')";
            
            // Executes and checks status of query
            if ($conn->query($sql) === TRUE) {
                echo "New alert created successfully" . "<br>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
        
    // Imports script to establish conenction to database. Creates $conn variable    
    require 'conn.php';
    
        $sql = "SELECT * FROM `Demo` WHERE `Status` = 'open' AND `Object` = 'Garage'";
    
        // Execute Select Command
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
               $shortDescription = "Garage Open";
               $longDescription = "Garage opened at ". $row["Timestamp"];
               $level = 3;
                createAlert($conn, "79B41758C", $shortDescription, $longDescription, $level, $row["Timestamp"]);
            }
        }
        
       $sql = "SELECT * FROM `Demo` WHERE `Status` = 'open' AND `Object` = 'Door'";
    
        // Execute Select Command
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
               $shortDescription = "Door Open";
               $longDescription = "Door opened at ". $row["Timestamp"];
               $level = 3;
                createAlert($conn, "79B41758C", $shortDescription, $longDescription, $level, $row["Timestamp"]);
            }
        }
    

    // Close connection
    $conn->close();
    
?>






















