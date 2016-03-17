<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<link rel="stylesheet" href="/oswebapp/css/style.css" type="text/css">
<script type="text/javascript" src="/oswebapp/js/jquery-2.1.1.min.js"></script>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>networks</title>
</head>
<body>
 	    
			
<?php

 session_start();
 include '/RestUtils.php';
 include '/menu.php';
 show_menu(); 
?>

			
			
			
			
     
            <?php
			
			if(isset($_SESSION['error'])){
			if($_SESSION['error']!=""){
				echo '<tr><td colspan="2" style="color:red" align="center"><div>'.$_SESSION['error'].'</td></tr>';
				
				
			$_SESSION['error']="";
			}}

			
			//list networks 	
		
		
			 $json=getnetworks($token,$tenant_id,$host);
			 
					
			if(isset($json['error'])){
				echo '<div>'.$json['error'].'</div>';
				echo '<div>Service Unavailable</div>';
				
			
			}
			else{
			

			
			if(isset($json['networks'])){
						echo '<table class="table table-striped table-condensed" >';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Network Name</th>';
                echo '<th>Status</th>';
				
				echo '<th>Shared</th>';
				echo '<th>Admin State</th>';
				
                echo '</tr>';
                echo '</thead>';
			
			 $isEmpty = empty($json['networks']) ? NULL : $json['networks'];
			
			 if($isEmpty==""){
				
				echo'<tbody>';
				echo'<tr>'; 
				echo '<td>No networks found.</td>';
				echo '</tr>';
				}
		
			 else{
			 		
          
                echo'<tbody>';
				foreach($json['networks'] as $row){
			
                echo'<tr>'; 
                echo'<td>'. $row['name']."</td>";
                echo'<td>'. $row['status'].'</td>';
				
				/*foreach($json['subnets'] as $subnet){
				echo'<td>'. $subnet.'</td>';
				}*/
				
				if($row['shared'])
				echo'<td>Yes</td>';
				else
				echo'<td>No</td>';
				
				if($row['admin_state_up'])
				echo'<td>DOWN</td>';
				else
				echo'<td>UP</td>';
				
				echo '</tr>';
               }
              }}
            

			
				
				
                echo'</tbody>';
			}
			?>
        </table>
</body>
    
</html>