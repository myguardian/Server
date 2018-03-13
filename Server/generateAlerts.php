<?php
    // Imports script to establish conenction to database. Creates $conn variable    
    require 'conn.php';
    
    // Creates Select Command
    $sql = "SELECT * FROM `Alerts` WHERE 1";
    
    // Execute Select Command
    $result = $conn->query($sql);

    // Loops thorugh results
    if ($result->num_rows > 0) {
        // Duplicate each element in Alerts table with new timestamp
       while($row = $result->fetch_assoc()) {
           $alertTime = date("Y-m-d H:i:s",time());
           $flowerpotID = $row["Flowerpot ID"];
           $shortDescription = $row["Short Description"];
           $longDescription = $row["Long Description"];
            $sql = "INSERT INTO `Alerts`(`Flowerpot ID`, `Short Description`, `Long Description`, `Level`, `Alert Timestamp`, `Acknowledged Timestamp`, `Image`, `Sound`)
            VALUES ('$flowerpotID', '$shortDescription', '$longDescription', '3', '$alertTime' , 'NULL', 'NULL', 'NULL')";           
            $conn->query($sql);
           
           echo "New Alert added successfully". "<br>";
       }
    } else {
        echo "No Alerts";
    }


    // Close connection
    $conn->close();
?>






















