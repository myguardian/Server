<?php
    // Get parameters from url
    $tagName = $_GET["tagName"];
    $timeStamp = date("Y-m-d H:i:s", time());;
    $orientationChange = $_GET["orientationChange"];
    $xAxis = $_GET["xAxis"];
    $yAxis = $_GET["yAxis"];
    $zAxis = $_GET["zAxis"];
    
    // First three characters in tagName = tagID, after = FlowerpotID
    //$FlowerpotID = substr($tagName,3);
    //$tagName = substr($tagName,0,3);
    
    // Converts timeStamp from server to unix time, and then to DateTime 
    $timeStamp = date("Y-m-d H:i:s", strtotime($timeStamp));
    
    
    $myfile = fopen("motionView.txt", "a") or die("Unable to open file!");
    $txt = "\r\nName: $tagName Orientation Change: $orientationChange X-Axis: $xAxis  Y-Axis:$yAxis  Z-Axis:$zAxis Time: $timeStamp\n";
    //$txt = "\r\nhello";
    fwrite($myfile, $txt);
    fclose($myfile);

?>