<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<link rel="stylesheet" href="/oswebapp/css/style.css" type="text/css">
<script type="text/javascript" src="/oswebapp/js/jquery-2.1.1.min.js"></script>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Flavors</title>
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

			
			//list flavors 	
		
		
			 $json=getFlavors($token,$tenant_id,$host);
			 
					
			if(isset($json['error'])){
				echo '<div>'.$json['error'].'</div>';
				echo '<div>Service Unavailable</div>';
				
			
			}
			else{
			

			
			if(isset($json['flavors'])){
						echo '<table class="table table-striped table-condensed" >';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Flavors</th>';
                echo '<th>ID</th>';
				
				echo '<th>RAM</th>';
				echo '<th>VCPUs</th>';
				
                echo '</tr>';
                echo '</thead>';
			
			 $isEmpty = empty($json['flavors']) ? NULL : $json['flavors'];
			
			 if($isEmpty==""){
				
				echo'<tbody>';
				echo'<tr>'; 
				echo '<td>No Flavors found.</td>';
				echo '</tr>';
				}
		
			 else{
			 		
          
                echo'<tbody>';
				foreach($json['flavors'] as $row){
			
                echo'<tr>'; 
                echo'<td>'. $row['name']."</td>";
                echo'<td>'. $row['id'].'</td>';
				echo'<td>'. $row['ram'].'</td>';
				echo'<td>'. $row['vcpus'].'</td>';
				echo '</tr>';
               }
              }}
            

			
				
				
                echo'</tbody>';
			}
			?>
        </table>
</body>
    
</html>