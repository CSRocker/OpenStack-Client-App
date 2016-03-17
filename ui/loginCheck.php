<?php

session_start();
include '/restUtils.php';
if (isset($_POST)) {
    
    $body = '<?xml version="1.0" encoding="UTF-8"?><auth xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://docs.openstack.org/identity/api/v2.0"  tenantName="' . $_POST['username'] . '"><passwordCredentials username="' . $_POST['username'] . '" password="' . $_POST['password'] . '"/></auth>';
     
    
    $ch = curl_init();
    
    $url = 'http://'.$host.':5000/v2.0/tokens';
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        
        'Content-Type: application/xml', //not sure if its required
        'Accept: application/json'
        
    ));
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  
  $data = curl_exec($ch);
    
    if (empty($data)) {
        // some kind of an error happened
        die(curl_error($ch));
        curl_close($ch); // close cURL handler
    } else {
        $info = curl_getinfo($ch);
        
        curl_close($ch); // close cURL handler
        
        if (empty($info['http_code'])) {
            die("No HTTP code was data urned");
        } else {
            
			// load the HTTP codes
            
            if (strcmp($info['http_code'], '200') !== 0) {
                $error='Invalid Credentials !!! Please try again !!';
                $_SESSION['errors']=$error;
                //echo "Error!!". $info['http_code'];
                header('Location: ./../Login.php');
				exit();
                
            } else {
			 
			
                $json=json_decode($data,true);
                $access = $json['access'];
                $token  = $access['token'];
                $tenant = $token['tenant'];
				$_SESSION["token"] = $token['id'];
				$_SESSION["tenant_id"]=$tenant['id'];
				$_SESSION["tenant_name"]=$tenant['name'];
                             
                header('Location: home.php');
                
                exit();
            }
        }
                
    }
}

?> 