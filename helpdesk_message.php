<?php include "header.php";
include "subheader.php";
require_once "common/class/user.class.php";
$user=new user();
require_once "common/class/helpdesk.class.php";
require_once "common/class/common.class.php";
$common=new common();

$helpdesk=new helpdesk();
$result=$helpdesk->get_message_by_id($_GET['helpdesk_id']);
$subject=$helpdesk->get_subject_by_id($_GET['helpdesk_id']);
?>
<table  width="100%">
<tr align="center">
<td align="center" bgcolor="#66CCFF">Helpdesk Message</td>
</tr>
</table>
<form name="frmaddcategory" action="helpdesk.php?wtdo=send_message" method="post" onSubmit="if(validateForm(this)) { if(check_amount()) return true; } else return false; ">
<table>
    

	
	 <tr>
		 <td><label for="tags"><strong>From Username:</strong></label>
		 
		 <span id="plus_amount" style="display:none;">+</span><span id="minus_amount" style="display:none;">-</span>
		 <?php
		 echo $user->getUserNameFromUserId($_SESSION['foongigs_userid']);
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
				<td><label for="tags"><strong>Description:</strong></label>'.$message['description'].'<br><label for="tags"><strong>By:</strong></label>
				By:';
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
				   <label for="tags"><strong>Posted Time:</strong></label>'.$common->fuzzyTime($message['time_stamp']).'           	
    	        </td>
	</tr>';
	}
	?>
	</table>
<tr>
<td>
<a href="javascript: loadPage('/ajax/helpdesk_new_request.php?helpdesk_id=<?php echo $_GET['helpdesk_id'];?>')">Add New Entry</a>
</td>
</tr>	
	
</table>
</form>



<?php
include "subfooter.php";
include "footer.php";
?>