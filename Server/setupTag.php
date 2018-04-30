<?php
    
    // Imports script to establish conenction to tag server. Creates $signInCookie variable    
    require 'tagServerSignIn.php';
    
    // Imports script to establish conenction to database. Creates $conn variable    
    require 'conn.php';
    
    // URL parameters
    $rule = $_GET["rule"];
    $flowerpotId = $_GET["flowerpotId"];
        
    // Scan Tag
    // create curl resource
    $ch = curl_init();

    // set url -X
    curl_setopt($ch, CURLOPT_URL, "https://my.wirelesstag.net/ethClient.asmx/ScanNewTag");

    $parameters = array(timeout => "3000");
    $jsonParameters = json_encode($parameters);
    //echo $jsonParameters;
    
    // set parameters -d
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonParameters);
        
    // set header -H
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Cookie: WTAG=' . $signInCookie
    ));
    
    // Return results from curl request
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    // execute request
    $tagInfo = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);  
    
    echo $tagInfo;
    

    //Associate Tag
    $ch = curl_init();

    // set url -X
    curl_setopt($ch, CURLOPT_URL, "https://my.wirelesstag.net/ethClient.asmx/AssociateNewTag");

    $tagInfo = json_decode($tagInfo);
    $parameters = array(name => $tagInfo->d->suggestedName, comment => "", taginfo => $tagInfo->d, timeout => "10000");
    
    $jsonParameters = json_encode($parameters);
    echo "<br>". "<br>". $jsonParameters;
    
    // set parameters -d
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonParameters);
        
    // set header -H
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Cookie: WTAG=' . $signInCookie
    ));
    
    // Return results from curl request
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    // execute request
    $results = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);  
    
    // Set tagId
    $tagId = json_decode($results)->d ->slaveId;
    
    
    // Add Rule
    switch($rule){
        case "garage":
            $rule = "Garage Open";
        case "door":
            $rule = "Door Open";
    }
    
    $sql = "INSERT INTO `Rules`(`Tag ID`, `Flowerpot ID`, `Rule`) VALUES ('$tagId', '$flowerpotID', $rule)";
    $conn->query($sql);
    $conn->close();
    
    
    // Add Event 
    $ch = curl_init();

    // set url -X
    curl_setopt($ch, CURLOPT_URL, "https://my.wirelesstag.net/ethClient.asmx/SaveEventURLConfig");
    
    $motionDetected = array(url => "https://hanifso.dev.fast.sheridanc.on.ca/Pi/insertSensorData.php?tagName={0}&orientationChange={1}&xAxis={2}&yAxis={3}&zAxis={4}&tagID={5}&timeStamp={6}", nat => "false");
    
    $config = array (motion_detected => $motionDetected);
    $parameters = array(id => $tagId, config => $config, applyAll => "false");
    
    $jsonParameters = json_encode($parameters);
    echo "<br>". "<br>". $jsonParameters;
    
    // set parameters -d
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonParameters);
        
    // set header -H
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Cookie: WTAG=' . $signInCookie
    ));
    
    // Return results from curl request
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    // execute request
    $results = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);  
    
    echo "<br>". "<br>". $results;
    
    /*
    // Arm All
    // create curl resource
    $ch = curl_init();

    // set url -X
    curl_setopt($ch, CURLOPT_URL, "https://my.wirelesstag.net/ethClient.asmx/ArmAll");
        
    $parameters = array(blank => "null");
    $jsonParameters = json_encode($parameters);
    //echo $jsonParameters;
    
    // set parameters -d
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonParameters);
    
    // set header -H
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Cookie: WTAG=' . $signInCookie
    ));
    
    // Return results from curl request
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    // execute request
    $armResults = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);  
    
    echo "<br>". "<br>".  $armResults;
    
    // Motion Detection Settings
    $ch = curl_init();

    // set url -X
    curl_setopt($ch, CURLOPT_URL, "https://my.wirelesstag.net/ethClient.asmx/SaveMotionSensorConfig2");
    
    $config = array (sensitivity => "60", auto_reset_delay => "1000");
    $parameters = array(id => $tagId, config => $config, applyAll => "true", allMac=>"true");
    
    $jsonParameters = json_encode($parameters);
    echo "<br>". "<br>". $jsonParameters;
    
    // set parameters -d
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonParameters);
        
    // set header -H
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Cookie: WTAG=' . $signInCookie
    ));
    
    // Return results from curl request
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    // execute request
    $results = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);  
    
    echo "<br>". "<br>". $results;
    
    */
?>
























