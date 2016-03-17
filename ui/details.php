
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link type="text/css" rel="stylesheet" href="VMInstances.css">
<link rel="stylesheet" href="/oswebapp/css/style.css" type="text/css">

<title>Details</title>

</head>

<body>
 

<?php

 session_start();
 include '/restUtils.php';
 include '/displayLogic.php';
 include '/menu.php';
 show_menu();
 $id=$_GET['ID']; 


$server_details=getDetailsforServer($token,$tenant_id,$host,$id);

$server=$server_details['server'];

$server_name=$server['name'];
$server_status=$server['status'];
/*$net_addr=$server['addresses'];
$net=$net_addr['net1'];
foreach
$ip_addr=$net['addr'];*/

$image=$server['image'];

$image_id=$image['id'];

$image_details=getDetailsforImage($token,$tenant_id,$host,$image_id);
$image=$image_details['image'];
$image_name=$image['name'];
$image_size=$image['OS-EXT-IMG-SIZE:size'];


$tableString='<table align="center"><thead><th colspan="2" align="center">VM Details</th></thead><tbody>
      <tr>
     <td><label>Instance Name </label> </td> 
     <td><label>'.$server_name.'<label> </td> 
     </tr>
     
     <tr>
     <td><label>Image Name </label> </td> 
     <td><label>'.$image_name.' </label> </td> 
     </tr>
     
     
     
     
     <tr>
     <td><label>Size in Bytes </label> </td> 
     <td><label>'.$image_size.'</label> </td> 
     </tr>
     
     
      <tr>
     <td><label>Status </label> </td> 
     <td><label>'.$server_status.'</label> </td> 
     </tr>
     
    
	 </tbody>
     </table>';
    
    echo $tableString;
 
 /*<tr>
     <td><label>IP Address</label> </td> 
     <td><label>'.$ip_addr.'</label> </td> 
     </tr>*/
	?>
 </body>
	
   
</html>