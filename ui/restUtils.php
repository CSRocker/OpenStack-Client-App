<?php

 $token=$_SESSION["token"];
 $tenant_id=$_SESSION["tenant_id"];
 $server_ip=file_get_contents('C:\\xampp\\htdocs\\oswebapp\\config\\server.json');
 $host_server=json_decode($server_ip,true);
 $host_name=$host_server['server'];
 $_SESSION["host"]=$host_name;
 $host=$_SESSION["host"];
 
 function getNetworks($token,$tenant_id,$host){
 
 $url='http://'.$host.':9696/v2.0/networks';

 $json = executeRequest($token, $url);
 return $json;
 
 
 }
 
 function getDetailsforServer($token,$tenant_id,$host,$serverName){
 
 $url='http://'.$host.':8774/v2/'.$tenant_id.'/servers/'.$serverName;


 $json = executeRequest($token, $url);

 return $json;
 
 
 }
 
  
 function getDetailsforImage($token,$tenant_id,$host,$imageId){
 
 $url='http://'.$host.':8774/v2/'.$tenant_id.'/images/'.$imageId;
 //$url='http://10.0.0.3:9696/v2.0/networks';
 $json = executeRequest($token, $url);
 return $json;
 
 
 }
 
function getFlavors($token,$tenant_id,$host)
{   
     $url='http://'.$host.':8774/v2/'.$tenant_id.'/flavors/detail';
	 //echo $url;
    //$url = 'http://10.0.0.3:8774/v2/8ad1e6ce99ad4f99a56c57fb653f7bdf/flavors/detail';
    $json = executeRequest($token, $url);
    return $json;
}

function getImages($token,$tenant_id,$host)
{
	 $url='http://'.$host.':8774/v2/'.$tenant_id.'/images/detail';
   // $url = 'http://10.0.0.3:8774/v2/8ad1e6ce99ad4f99a56c57fb653f7bdf/images/detail';
    $json =  executeRequest($token, $url);
    return $json;
    
    
}

function getServers($token,$tenant_id,$host)
{

	$url='http://'.$host.':8774/v2/'.$tenant_id.'/servers/detail';
    //$url  = 'http://10.0.0.3:8774/v2/8ad1e6ce99ad4f99a56c57fb653f7bdf/servers/detaile';
    $json = executeRequest($token, $url);
    return $json;
}

function getLimits($token,$tenant_id,$host){
 
 $url='http://'.$host.':8774/v2/'.$tenant_id.'/limits';
 //$url='http://10.0.0.3:9696/v2.0/networks';
 $json = executeRequest($token, $url);
 return $json;
 
 
 }
 

function executeRequest($token, $url)
{
    
    $ch = curl_init();
    $content_type = 'application/json';
    $accept_type  = 'application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'X-Auth-Token:' . $token,
        'Content-Type:' . $content_type,
        'Accept:' . $accept_type
        
    ));
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $data = curl_exec($ch);
	
  
if (empty($data)) {
        // some kind of an error happened
		$errorString= '{"error":"No data returned"}';
		return json_decode($errorString,true);
        die(curl_error($ch));
        curl_close($ch); // close cURL handler
    } else {
        $info = curl_getinfo($ch);
        curl_close($ch); // close cURL handler
        
        if (empty($info['http_code'])) {
            die("No HTTP code was data urned");
        } else {
            // load the HTTP codes
            
            if ((strcmp($info['http_code'], '200') !== 0)) {
              
                //header('Location: Login.php');
				$errorString= '{"error":" Error : '. $info['http_code'].'"}';
				return json_decode($errorString,true);
                
            }
			else {
			return json_decode($data, true);
			}}}}

?> 