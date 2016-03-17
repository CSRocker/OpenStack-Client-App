<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="/oswebapp/css/style.css" type="text/css">

<script type="text/javascript" src="/oswebapp/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
function validateInfo(){

var flavorRef=document.getElementById('flavor').value;
var instanceCount=document.getElementById('instanceCount').value;
var networkId=document.getElementById('network_id').value;
var imageRef=document.getElementById('image').value;
var serverName=document.getElementById('instanceName').value;


var doPost=true;

if(instanceCount==null||instanceCount=="")
{
	doPost=false;
    document.getElementById('instance_count_err').innerHTML="Please enter a instance count";

}

if(serverName==null||serverName=="")
	 {
	 doPost=false;
	 document.getElementById('server_name_err').innerHTML="Please enter a valid server name";
	    
	  }

if(imageRef==null || imageRef=="")
	 {

	 doPost=false;
	 document.getElementById('image_id_error').innerHTML="Please select a image file";
	}

	if(networkId==null || networkId=="")
	{
	 doPost=false;
	 document.getElementById('network_id_error').innerHTML="Please select a valid network";
	
	}



if(doPost){

var dataString = 'flavorRef=' + flavorRef +'&imageRef='+imageRef+'&maxCount='+instanceCount+'&networkId='+networkId +'&serverName='+serverName;
//alert(dataString);

$.ajax({
                    type: "POST",
                    url: '/oswebapp/ui/createInstance.php',
                    data: dataString,
                    success: function(data)
                    {
                       alert("success! X:" + data);
                    }

        });
}}
</script>

</head>

    <body>
 <?php 
 session_start();
 include '/RestUtils.php';
  


?>
	<form  method="POST" action="" >
	 
    


	<table align="center">
 <thead><th colspan="3" align="center"> Launch Instance</th></thead>
 <tbody>
     <tr>
     <td><label>Availability Zone </label> </td> 
     <td>
		<select  name="availaibilityZone">
		<option id ="zones" value="nova">nova</option>
		</select>
		<td></td>
	 </td>
     </tr>
    
     <tr>
     <td><label>Instance Name* </label> </td> 
     <td><input type ="text" name ="instanceName" id="instanceName"></input></td>
	  <td><label style="color:red" id="server_name_err"></label></td>
     </tr> 
     
     <tr>
     <td><label>Flavor* </label> </td> 
     <td><select  name="flavor" id="flavor">
	 
	 <?php 
		$json=getFlavors($token,$tenant_id,$host);
		foreach($json['flavors'] as $row){
                echo'<option value="';
                echo $row['id'].'">'; 
                echo $row['name'].'</option>';
                
               
              }
     ?>
	 
	 </select>
	 </td>
	 <td></td>
     </tr> 
     
     <tr>
     <td><label>Instance Count* </label> </td> 
     <td><input type ="text" name ="instanceCount" id="instanceCount"></input></td>
	 <td><label style="color:red" id="instance_count_err"></label></td>
     </tr> 
     
     <tr>
     <td><label>Instance Boot Source </label> </td> 
     <td>
	 <select  name="instanceBootSource">
		<option value="Boot from Image">Boot from Image</option>
    
	</select>
	</td>
	<td></td>
     </tr> 
	 
	  <tr>
     <td><label>Select Image File *</label> </td> 
     <td><select  name="image" id="image">
	 
	  <?php 
		$json=getImages($token,$tenant_id,$host);
		foreach($json['images'] as $row){
                echo'<option value="';
                echo $row['id'].'">'; 
                echo $row['name'].'</option>';
                
               
              }
            ?>
	 
	 </select>
	 </td>
	 <td><label style="color:red" id="image_id_error"></label></td>
     </tr> 
     
	 <tr>
     <td><label>Select Network *</label> </td> 
     <td ><select  name="network" id="network_id">
	 
	  <?php 
		$json=getNetworks($token,$tenant_id,$host);
		foreach($json['networks'] as $row){
                echo'<option value="';
                echo $row['id'].'">'; 
                echo $row['name'].'</option>';
                
               
              }
            ?>
	 
	 </select>
	 </td>
	 <td><label style="color:red" id="network_id_error"></label></td>
     </tr> 
	 
     <tr>
	 <td><input type ="submit" style="color:#fff;background-color:#800;"  name ="cancel" value="Cancel" onclick="window.open('/oswebapp/ui/vmInstances.php')"/></td>
     <td><input type ="submit" style="color:#fff;background-color:#800;"  name ="submitInstance" value="Launch Instance" onclick="validateInfo();"/></td>
	 <td></td>
     </tr> 
	 	<?php if(isset($_SESSION['error'])){
		if($_SESSION['error']!=""){
				echo '<tr><td colspan="2" style="color:red" align="center"><div>'.$_SESSION['error'].'</div></td></tr>';
				
				
			$_SESSION['error']="";
			}}
			if(isset($_SESSION['success'])){
		if($_SESSION['success']!=""){
				echo '<tr><td colspan="2" style="color:red" align="center"><div><a href="/oswebapp/ui/vmInstances.php")>'.$_SESSION['success'].': Click here to view instance</a></div></td></tr>';
				
				
			$_SESSION['success']="";
			}}
	?>
	 </tbody>
	 </table>
	 </form>
     </body>
</html>