<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<link rel="stylesheet" href="/oswebapp/css/style.css" type="text/css">
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="/oswebapp/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
     google.setOnLoadCallback(draw);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
     function drawChart(num1,num2,column1,column2,divname) {
			
        // Create the data table.
		
		var divName=divname;
		var Column1=column1;
		var Column2=column2;
		var num1=num1;
		var num2=num2;
		
        var instance_data = new google.visualization.DataTable();
        
        instance_data.addColumn('string', Column1);
		instance_data.addColumn('number', Column2);
        instance_data.addRows([
          [Column1, Number(num1) ],
          [Column2,Number(num2)]

        ]);

        // Set chart options
        var options = {'title':'N',
                       'width':250,
                       'height':300,
					   colors:['#000','#800000'],
					   is3D: true};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById(divName));
        chart.draw(instance_data, options);
		
		
      }
	  
	  function draw(){
		//Draw first pie chart
		
		var input1 = document.getElementById('inst_used');
		var input2= document.getElementById('total_inst');
		
		var str1=input1.getAttribute("value");
		var str2=input2.getAttribute("value");
		
		var num1= str1*1;
		var num2= str2*1-num1;
				
		drawChart(num1,num2,"Instances Used","Total Instances","inst_chart");
		
		//Draw second pie chart
		
		var input3 = document.getElementById('ram_used');
		var input4= document.getElementById('total_ram');
		
		var str3=input3.getAttribute("value");
		var str4=input4.getAttribute("value");
		
		var num3= str3*1;
		var num4= str4*1-num3;
		
		
		drawChart(num3,num4,"Ram Used","Total Ram","ram_used_chart");
		
		//Draw third pie chart
		
		var input5 = document.getElementById('cpu_used');
		var input6 = document.getElementById('total_cpu');
		
		var str5=input5.getAttribute("value");
		var str6=input6.getAttribute("value");
		
		var num5= str5*1;
		var num6= str6*1-num5;
		
		drawChart(num5,num6,"VCPU Used","Total VCPUs","cpu_used_chart");
	  
	  }
	  
	 
</script>
	
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Home</title>
</head>
<body>
 	    
			
<?php

 session_start();
 include '/RestUtils.php';
 include '/menu.php';
 show_menu(); 
 $tenant_name=$_SESSION["tenant_name"];

			
			if(isset($_SESSION['error'])){
			if($_SESSION['error']!=""){
				echo '<tr><td colspan="2" style="color:red" align="center"><div>'.$_SESSION['error'].'</td></tr>';
				
				
			$_SESSION['error']="";
			}}
		
			//list networks 	
		
		
			 $json=getLimits($token,$tenant_id,$host);
			 
					
			if(isset($json['error'])){
				echo '<div>'.$json['error'].'</div>';
				echo '<div>Service Unavailable</div>';
				
			
			}
			else{
			

			
			if(isset($json['limits'])){
			
		
			$instances=$json['limits'];
			
			$json_data=$instances['absolute'];
			
			$totalInstances=$json_data['maxTotalInstances'];
			$instanceUsed=$json_data['totalInstancesUsed'];
			
			echo '<label id="inst_used" value="'.$instanceUsed.'"></label>';
			echo '<label id="total_inst" value="'.$totalInstances.'"></label>';
			
			$totalRam=$json_data['maxTotalRAMSize'];
			$ramUsed=$json_data['totalRAMUsed'];
			
			echo '<label id="ram_used" value="'.$ramUsed.'"></label>';
			echo '<label id="total_ram" value="'.$totalRam.'"></label>';
			
			$totalCPU=$json_data['maxTotalCores'];
			$cpuUsed=$json_data['totalCoresUsed'];
			
			echo '<label id="cpu_used" value="'.$cpuUsed.'"></label>';
			echo '<label id="total_cpu" value="'.$totalCPU.'"></label>';
			
			}
			
			
			}
			?>
								
			<table><thead><th colspan="3" align="center"> Limit Summary for Project : <?php echo $tenant_name ?></th></thead><tbody><tr>
			<td>
			<div align="left" id="inst_chart" ></div></td>
			
			<td>
			<div align="right" id="ram_used_chart"></div></td>
			<td>
			<div align="center" id="cpu_used_chart"></div></td>
			
			</tbody>
			</table>
</div>
</body>
    
</html>