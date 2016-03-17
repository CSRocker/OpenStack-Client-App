<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="/oswebapp/css/style.css" type="text/css">
	<title>Login OpenStack</title>
</head>

<body>



	<table align="center" style="width:500px;height:300px;">
   <thead><th colspan="2" align="center">Openstack Login</th></thead>
    <form  method="POST" action="/oswebapp/ui/loginCheck.php">
    
      <tr>
		<td><label>Username </label> </td> <td> <input type ="text" name ="username"> </td>
      </tr>
      <tr>
		<td><label>Password </label> </td> <td> <input type ="password" name ="password"> </td>
       </tr>
      <tr >
        <td colspan="2" align="center"> <input type ="submit" name ="Login" value="Sign in" align="right" style="color:#fff;background-color:#800;"> </td>
       </tr>
    </form>
	<?php
	session_start();
	if(isset($_SESSION['errors'])){
	if($_SESSION['errors']!=="")
	{
	echo '<tr  style="color:red"><td  colspan="2" align=center>'.$_SESSION['errors'].'</td></tr>';
	$_SESSION['errors']="";
	}}
	
	
	?>
   
    
       
     
    </table>
 
</body>
</html>