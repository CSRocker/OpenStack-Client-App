<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<link rel="stylesheet" href="/oswebapp/css/style.css" type="text/css">
<script type="text/javascript" src="/oswebapp/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript">

function resumeVm(instName) {

var dataString = 'vmName='+instName;

$.ajax({
                    type: "POST",
                    url: '/oswebapp/cli/resumeInstance.php',
                    data: dataString,
                    success: function(data)
                    {
                       alert("success! X:" + data);
                    }

        });
	
}

function unPauseVm(instName) {

var dataString = 'vmName='+instName;

$.ajax({
                    type: "POST",
                    url: '/oswebapp/cli/unpauseInstance.php',
                    data: dataString,
                    success: function(data)
                    {
                       alert("success! X:" + data);
                    }

        });
	
}

function suspendVm(instName){


var dataString = 'vmName='+instName;
$.ajax({
                    type: "POST",
                    url: '/oswebapp/cli/suspendInstance.php',
                    data: dataString,
                    success: function(data)
                    {
					
                   
                    }

        });


}

function pauseVm(instName){

var dataString = 'vmName='+instName;

$.ajax({
                    type: "POST",
                    url: '/oswebapp/cli/pauseInstance.php',
                    data: dataString,
                    success: function(data)
                    {
                       alert("success! X:" + data);
                    }

        });


}
function terminateVm(instName){

var dataString = 'vmName='+instName;

$.ajax({
                    type: "POST",
                    url: '/oswebapp/cli/terminateInstance.php',
                    data: dataString,
                    success: function(data)
                    {
                       alert("success! X:" + data);
                    }

        });


}

function startVm(instName){

var dataString = 'vmName='+instName;

$.ajax({
                    type: "POST",
                    url: '/oswebapp/cli/startInstance.php',
                    data: dataString,
                    success: function(data)
                    {
                       alert("success! X:" + data);
                    }

        });


}
function viewDetail(instId){

var dataString = 'vmName='+instId;
alert(dataString);

$.ajax({
                    type: "POST",
                    url: '/oswebapp/ui/details.php',
                    data: dataString,
                   

        });


}

</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>VM Instances</title>
</head>
<body>
 	    
			
<?php

 session_start();
 include '/RestUtils.php';
 include '/displayLogic.php';
 include '/menu.php';
 show_menu(); 
 //$host=$_SESSION["host"];
 $server_str='localhost:8582';
?>

			
			
			
			
     
            <?php
			
			if(isset($_SESSION['error'])){
			if($_SESSION['error']!=""){
				echo '<tr><td colspan="2" style="color:red" align="center"><div>'.$_SESSION['error'].'</td></tr>';
				
				
			$_SESSION['error']="";
			}}

			
			//list servers 	
		    
		
			 $json=getServers($token,$tenant_id,$host);
			 
					
			if(isset($json['error'])){
				echo '<div>'.$json['error'].'</div>';
				echo '<div>Service Unavailable</div>';
				
			
			}
			else{
			

			
			if(isset($json['servers'])){
						echo '<table class="table table-striped table-condensed" >';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Instances</th>';
                echo '<th>Status</th>';
				
				echo '<th colspan="3">VM Actions</th>';
				
                echo '</tr>';
                echo '</thead>';
			
			 $isEmpty = empty($json['servers']) ? NULL : $json['servers'];
			
			 if($isEmpty==""){
				
				echo'<tbody>';
				echo'<tr>'; 
				echo '<td>No instances found.</td>';
				echo '</tr>';
				}
		
			 else{
			 		
          
                echo'<tbody>';
				foreach($json['servers'] as $row){
			
                echo'<tr>'; 
               
				echo '<td><a rel="nofollow" href="http://'.$server_str.'/oswebapp/ui/details.php?ID='.$row['id'].'">'.$row['name'].'</a></td>';
				
                echo'<td>'. $row['status'].'</td>';
				createActions($row['name'],$row['status']);
				echo '</tr>';
               }
              }}
            

			
				
				echo '<tr align="right">';
				echo '<td colspan="5">';
				echo '<input type="button" style="color:#fff;background-color:#800;" value="Launch Instance" onClick=location.href="/oswebapp/ui/launchInstance.php">';
				echo '</td>';
				echo '</tr>';
                echo'</tbody>';
			}
			?>
			
        </table>
		
</body>
    
</html>