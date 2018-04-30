<?php
    
    // Motion Detection Settings
    $ch = curl_init();

    // set url -X
    curl_setopt($ch, CURLOPT_URL, "https://my.wirelesstag.net/ethClient.asmx/SaveMotionSensorConfig");
    
    $config = array (sensitivity => "60", auto_reset_delay => "10000");
    $parameters = array(id => "52", config => $config, applyAll => "false");
    
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
    
    
    // Imports script to establish conenction to tag server. Creates $signInCookie variable    
    require 'tagServerSignIn.php';
    
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
    
?>
























