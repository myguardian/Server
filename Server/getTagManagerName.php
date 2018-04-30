<?php
        // create curl resource
        $ch = curl_init();

        // set url -X
        curl_setopt($ch, CURLOPT_URL, "https://my.wirelesstag.net/ethAccount.asmx/GetTagManagerName");

        $parameters = array(mac => "79B41758CFA8");
        $jsonParameters = json_encode($parameters);
        echo $jsonParameters;
        
        // set parameters -d
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonParameters);
        
        // set header -H
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
        ));
        
        // Return results from curl request
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        // Execute curl and set contents to $results
        $results = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);  
        
        //echo $results;
        
        // Convert results string to object
        $resultsJSON = json_decode($results);
        
        //echo results from object
        echo "Access Token: " . $resultsJSON->{'d'};
?>
























