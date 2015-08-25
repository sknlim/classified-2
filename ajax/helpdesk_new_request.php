<?php 
session_start();
require_once "../common/class/user.class.php";
$user=new user();
if($_GET['helpdesk_id'])
{
require_once "../common/class/helpdesk.class.php";

$helpdesk=new helpdesk();
$result=$helpdesk->get_message_by_id($_GET['helpdesk_id']);
$subject=$helpdesk->get_subject_by_id($_GET['helpdesk_id']);
}
?>
<table  width="100%">
<tr align="center">
<td align="center" bgcolor="#66CCFF">Helpdesk Message Composer</td>
</tr>
</table>
 <form name="frmaddcategory" <?php if($_GET['helpdesk_id']){ ?> action="ajax/load_helpdesk_request.php?helpdesk_id=<?php echo $_GET['helpdesk_id'];?>" <?php } else {?> action="ajax/load_helpdesk_request.php"<?php }?> method="post"onSubmit="if(validateForm(this)) submitFormOnFloat(this); return false;">
 <input type="hidden" value="<?php echo $_GET['status_change'];?>" id="status_change" name="status_change" />
<table>
    

	
	 <tr>
		 <td><label for="tags"><strong>From Username:</strong></label></td>
		
	 	 <td><span id="plus_amount" style="display:none;">+</span><span id="minus_amount" style="display:none;">-</span>
		 <?php
		 echo $user->getUserNameFromUserId($_SESSION['foongigs_userid']);
		 ?>	
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
</form>


