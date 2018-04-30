<?php
        // create curl resource
        $ch = curl_init();

        // set url -X
        curl_setopt($ch, CURLOPT_URL, "https://my.wirelesstag.net/ethAccount.asmx/SignIn");

        $parameters = array(email => "Sahmedhanif@gmail.com", password => "Test");
        $jsonParameters = json_encode($parameters);

        // set parameters -d
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonParameters);
        
        // set header -H
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
        ));
        
        // Return results from curl request
        curl_setopt($ch, CURLOPT_HEADER, 1);
        
        // Return results from curl request
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        // Execute curl and set contents to $results
        $result = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);  
        
        // Get cookies
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
        $cookies = array();
        foreach($matches[1] as $item) {
            parse_str($item, $cookie);
            $cookies = array_merge($cookies, $cookie);
        }   
        
        //var_dump($cookies) . "<br>";
        
        $signInCookie = $cookies["WTAG"];
        //echo $signInCookie;
?>
























