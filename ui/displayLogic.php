		<?php 
		function createActions($StringInstanceName , $StringInstanceStatus)
		{
		
		//actions for active vm
			$VMInstanceStatus1Action1 ="PAUSE";
			$VMInstanceStatus1Action2 ="SUSPEND";
			$VMInstanceStatus1Action3 ="TERMINATE";
						
		//actions for paused vm	

			$VMInstanceStatus2Action1 ="UNPAUSE";
			$VMInstanceStatus2Action2 ="TERMINATE";
		
		//actions for suspended vm			
			
			$VMInstanceStatus3Action1="RESUME";
			$VMInstanceStatus3Action2 ="TERMINATE";
			
	    //actions for suspended vm		
		
			$VMInstanceStatus4Action1='START';
			$VMInstanceStatus4Action2 ="TERMINATE";
			
			//actions for build vm		
		
		$VMInstanceStatus5Action1 ="TERMINATE";
			
		if($StringInstanceStatus=="ACTIVE")
		{	echo '<td >'.
			'<input type="button" style="color:#fff;background-color:#800;" value ="'.$VMInstanceStatus1Action1.'" onclick=pauseVm("'.$StringInstanceName.'")>'.
      	    '</td>';
				
			echo '<td>'.
			'<input type = "button" style="color:#fff;background-color:#800;" value ="'.$VMInstanceStatus1Action2.'" onClick=suspendVm("'.$StringInstanceName.'")>'.
      	    ' </td>';
			
			echo '<td>'.
			'<input type = "button" style="color:#fff;background-color:#800;" value ="'.$VMInstanceStatus1Action3.'" onClick=terminateVm("'.$StringInstanceName.'")>'.
      	    ' </td>';
				
				  	
      	
		}
		elseif($StringInstanceStatus=="PAUSED")
		{	
			echo '<td >'.
			 '<input type = "button" style="color:#fff;background-color:#800;"  value ="'.$VMInstanceStatus2Action1.'" onClick=unPauseVm("'.$StringInstanceName.'")>'.
      	     '</td>';
			 
			 echo '<td colspan="2">'.
			'<input type = "button"  style="color:#fff;background-color:#800;" value ="'.$VMInstanceStatus2Action2.'" onClick=terminateVm("'.$StringInstanceName.'")>'.
      	    ' </td>';
				
		}
		elseif($StringInstanceStatus=="SUSPENDED")
			{
				echo '<td >'.
				 '<input type = "button" style="color:#fff;background-color:#800;" value ="'.$VMInstanceStatus3Action1.'" onClick=resumeVm("'.$StringInstanceName.'")>'.
      	      	 '</td>';
				 
				 echo '<td colspan="2">'.
			'<input type = "button"  style="color:#fff;background-color:#800;" value ="'.$VMInstanceStatus3Action2.'" onClick=terminateVm("'.$StringInstanceName.'")>'.
      	    ' </td>';
				
			}
  		elseif($StringInstanceStatus=="SHUTOFF")
			{
				echo '<td >'.
				 '<input type = "button" style="color:#fff;background-color:#800;" value ="'.$VMInstanceStatus4Action1.'" onClick=startVm("'.$StringInstanceName.'")>'.
      	      	 '</td>';
				
				 echo '<td colspan="2">'.
			'<input type = "button" style="color:#fff;background-color:#800;" value ="'.$VMInstanceStatus4Action2.'" onClick=terminateVm("'.$StringInstanceName.'")>'.
      	    ' </td>';
			}
		elseif($StringInstanceStatus=="BUILD")
			{
							
				 echo '<td colspan="3">'.
			'<input type = "button" style="color:#fff;background-color:#800;" value ="'.$VMInstanceStatus5Action1.'" onClick=terminateVm("'.$StringInstanceName.'")>'.
      	    ' </td>';
			}
		}
		?>
		


		

