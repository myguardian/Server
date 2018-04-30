<?php
$code = "";
$code = $_GET["code"];

// Begin process b going to OAuth page for sign on
if ($code == ""){
    $url = "https://www.google.com";
    $url = "https://www.mytaglist.com/oauth2/authorize.aspx?client_id=bfd6ba69-652b-457b-bb34-b7f51743ebe1&redirect_uri=https://hanifso.dev.fast.sheridanc.on.ca/Pi/TagServerOAuth.php";
    header('Location: '. $url);
}

// After recieving code
else{
    
    echo $code;
    //curl -X POST https://www.mytaglist.com/oauth2/access_token.aspx -d 'client_id=bfd6ba69-652b-457b-bb34-b7f51743ebe1&client_secret=aced0da7-4af7-42e8-9d39-b716688969bb&code=$code'
    
        // create curl resource
        $ch = curl_init();

        // set url -X
        curl_setopt($ch, CURLOPT_URL, "https://www.mytaglist.com/oauth2/access_token.aspx");
    
        // set parameters -d
        curl_setopt($ch, CURLOPT_POSTFIELDS, "client_id=bfd6ba69-652b-457b-bb34-b7f51743ebe1&client_secret=aced0da7-4af7-42e8-9d39-b716688969bb&code=$code");
        
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);      
        
        // Decode JSON to get access code
        $jsonObject = json_decode($output);
        $accessToken =  $jsonObject -> access_token;
        
        addTagManager($accessToken);
        //getTagManagerName($accessToken);
}

    function addTagManager($accessToken) {
        // Add tag manager using curl
        
        //curl -X POST https://www.mytaglist.com/ethClient.asmx/Beep -d '{id:1, beepDuration:1001}' -H 'Content-Type: application/json' -H 'Authorization: Bearer [access token you saved in step 3]' 
        
        // create curl resource
        $ch = curl_init();

        // set url -X
        curl_setopt($ch, CURLOPT_URL, "https://my.wirelesstag.net/ethAccount.asmx/AddTagManager");

        $parameters = array(mac => "89940D11FA90", name => "Mike", allowMore=>"true", makeSelected => "true", linkToMac=>"none");
        $jsonParameters = json_encode($parameters);
        //echo $jsonParameters;
    
        // set parameters -d
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonParameters);
        
        // set header -H
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken
        ));
        
        curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);  
    }
    
    function getTagManagerName($accessToken) {
        // create curl resource
        $ch = curl_init();

        // set url -X
        curl_setopt($ch, CURLOPT_URL, "https://my.wirelesstag.net/ethAccount.asmx/GetTagManagerName");

        $parameters = array(mac => "89940D11FA90");
        $jsonParameters = json_encode($parameters);
        //echo $jsonParameters;
        
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
        
        // COnvert results string to object
        $resultsJSON = json_decode($results);
        
        //echo results from object
        echo "Tag Manager Name: " . $resultsJSON->{'d'};
    }
?>
























