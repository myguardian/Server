<?php
    // Imports script to establish conenction to database. Creates $conn variable    
    require 'conn.php';
    
    // Creates Select Command
    $sql = "SELECT `Flowerpot ID`, `Tag ID`, `Timestamp`, `Acknowledge Time` FROM `Sensor Data` WHERE 1";
    
    // Execute Select Command
    $result = $conn->query($sql);

    // Loops thorugh results
    if ($result->num_rows > 0) {
        // Add each element from sensor data table to the rules table
       while($row = $result->fetch_assoc()) {
           $tagID = $row["Tag ID"];
           $flowerpotID = $row["Flowerpot ID"];
           echo "New rule added successfully". "<br>";
           $sql2 = "INSERT INTO `Rules`(`Tag ID`, `Flowerpot ID`, `Rule`) VALUES ('$tagID', '$flowerpotID', 'Garage Open')";
           $conn->query($sql2);
       }
    } else {
        echo "No new tag sensors";
    }


    // Close connection
    $conn->close();
    
?>






















