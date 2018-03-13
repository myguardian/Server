<?php
    // Get Flowerpot ID from url
    $flowerpotID = $_GET["flowerpotID"];
    
    // Imports script to establish connection to database. Creates $conn variable    
    require 'conn.php';
    
    // Creates Select Command to get all rules
    $sql = "SELECT * FROM `Alerts` WHERE `Flowerpot ID` = '$flowerpotID' AND `Acknowledged Timestamp` = '0000-00-00 00:00:00'";
    
    // Execute Select Command. gets every row in alerts table
    $result = $conn->query($sql);

    $alertsArray = array();
    
    // Loops through results
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
	
	// Create or update file that will contain the JSON data object
	$fp = fopen('alerts.json', 'w');
	// Write the JSON information to the file
	fwrite($fp, $alertsJSON);
	// Close the file
	fclose($fp);
?>






















