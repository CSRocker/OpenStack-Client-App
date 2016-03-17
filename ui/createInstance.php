<?php
session_start();


include '/RestUtils.php';
$body='{
     "server": {
         "name":"'.$_POST["serverName"].'",
         "imageRef":"'.$_POST["imageRef"].'",
         "flavorRef":"'.$_POST["flavorRef"].'",
         "max_count":'.$_POST["maxCount"].',
         "min_count":1,
         "networks": [
             {
                 "uuid":"' .$_POST["networkId"].'"
             }
         ],
         "security_groups":[
             {
                 "name":"default"
             }
         ]
     }
 }';

	$ch = curl_init();
	$url='http://'.$host.':8774/v2/'.$tenant_id.'/servers';
    $content_type = 'application/json';
    $accept_type  = 'application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'X-Auth-Token:' . $token,
        'Content-Type:' . $content_type,
        'Accept:' . $accept_type
        
    ));
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    
    $data = curl_exec($ch);
	
    //$json=json_decode($data, true);
	//echo $data;
	
	if (empty($data)) {
	
	 $errorString= '{"error":" Error"}';
	 return json_decode($errorString,true);
        // some kind of an error happened
        die(curl_error($ch));
        curl_close($ch); // close cURL handler
    } else {
        $info = curl_getinfo($ch);
        
        curl_close($ch); // close cURL handler
        
        
            // load the HTTP codes
            
            if (strcmp($info['http_code'], '202') !== 0) {
                
				if(isset($info['http_code'])){
                $_SESSION['error']= 'Error in Launching Instance:' .$info['http_code'].'';
				header('Location: launchInstance.php');
				}
				else{
				 $_SESSION['error']= 'Error in Launching Instance : Service Unavailable';
				 header('Location: launchInstance.php');
				}
                				
				} 
				else {
				
                 $_SESSION['success']= 'Successfully Launched Instance';
                 header('Location: vmInstances.php');
                
               // exit();
            }
        
          
}
	
?>
