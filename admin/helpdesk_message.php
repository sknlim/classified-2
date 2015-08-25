<?php include "header.php";
require_once "../common/class/user.class.php";
$user=new user();
require_once "../common/class/helpdesk.class.php";

$helpdesk=new helpdesk();
$result=$helpdesk->get_message_by_id($_GET['helpdesk_id']);
$userid=$helpdesk->get_userid_by_id($_GET['helpdesk_id']);
$subject=$helpdesk->get_subject_by_id($_GET['helpdesk_id']);
?>
<table  width="100%">
<tr align="center">
<td align="center" bgcolor="#66CCFF">Helpdesk Message</td>
</tr>
</table>
<form name="frmaddcategory" action="helpdesk_management.php?wtdo=send_message&helpdesk_id=<?php echo $_GET['helpdesk_id'];?>" method="post" onSubmit="if(validateForm(this)) { if(check_amount()) return true; } else return false; ">
<table>
    

	
	 <tr>
		 <td><label for="tags"><strong>From Username:</strong></label>
		 
		 <span id="plus_amount" style="display:none;">+</span><span id="minus_amount" style="display:none;">-</span>
		 <?php
		 echo $user->getUserNameFromUserId($userid);
		 ?>	
                <span class="checkStatus"></span>            	
         </td>
	
	</tr>	

	 <tr>
		 <td><label for="tags"><strong>Subject:</strong></label>
		 
		 <span id="plus_amount" style="display:none;">+</span><span id="minus_amount" style="display:none;">-</span>
		 <?php	
		 echo $subject;
		 ?>
                <span class="checkStatus"></span>            	
         </td>
	
	</tr>
	<table border="1">
		<?php foreach($result as $message)
		{
		echo '
	<tr>
				<td><label for="tags"><strong>Description:</strong></label>'.$message['description'].'<br>
				<label for="tags"><strong>By:</strong></label>';
				if(is_numeric($message['userid']))
				{
				echo $user->getUserNameFromUserId($message['userid']);
				}
				else
				{
				echo $message['userid'];
				}
				echo '
                <br>
				   <label for="tags"><strong>Posted Time:</strong></label>'.$message['timestamp'].'       	
    	        </td>
	</tr>';
	}
	?>
	</table>
<tr>

<td>
<a onclick="showDiv('reply_admin');">Reply</a>
</td>
</tr>	
	
</table>
<div id="reply_admin" style="display:none;">
<table>
    

	
	 <tr>
		 <td><label for="tags"><strong>From:</strong></label></td>
		
	 	 <td><span id="plus_amount" style="display:none;">+</span><span id="minus_amount" style="display:none;">-</span>
		<input type="text" id="from" name="from" class="vldnoblank textWidth" style="width:300px;"  />		
                <span class="checkStatus"></span>            	
         </td>
	
	</tr>	

	 <tr>
		 <td><label for="tags"><strong>Subject:</strong></label></td>
		
	 	 <td><span id="plus_amount" style="display:none;">+</span><span id="minus_amount" style="display:none;">-</span>
		 <?php if($_GET['helpdesk_id']){ echo $subject;}
		 else
		 {
		 ?>
		 <input type="text" id="subject" name="subject" value="<?php if($_GET['helpdesk_id']){ echo $subject;}?>" class="vldnoblank textWidth" style="width:300px;"  />	
		 <?php }?>
                <span class="checkStatus"></span>            	
         </td>
	
	</tr>
		
	<tr>
				<td><label for="tags"><strong>Description:</strong></label></td>
				<td><textarea id="description" style="width:300px; height:200px" name="description" class="vldnoblank textWidth" ></textarea>
                <span class="checkStatus"></span>            	
    	        </td>
	</tr>
	
	<tr align="center">
				<td >
				<input type="submit" value="Send Message">
                <span class="checkStatus"></span>            	
                </td> 
	</tr>
</table>
</div>
</form>



<?php

include "footer.php";
?>