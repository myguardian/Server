<?php

    // Imports script to establish conenction to tag server. Creates $signInCookie variable    
    require 'tagServerSignIn.php';
    
    // Add tag manager using curl
        
    //curl -X POST https://www.mytaglist.com/ethClient.asmx/Beep -d '{id:1, beepDuration:1001}' -H 'Content-Type: application/json' -H 'Authorization: Bearer [access token you saved in step 3]' 
        
    // create curl resource
    $ch = curl_init();

    // set url -X
    curl_setopt($ch, CURLOPT_URL, "https://my.wirelesstag.net/ethAccount.asmx/AddTagManager");

    $parameters = array(mac => "89940D11FA90", name => "Mike", allowMore=>"true", makeSelected => "false", linkToMac=>"none");
    $jsonParameters = json_encode($parameters);
    //echo $jsonParameters;
    
    // set parameters -d
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonParameters);
        
    // set header -H
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Cookie: WTAG=' . $signInCookie
    ));
    
    // stops results from printing to screen
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    
    // execute request
    curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);  
?>
























