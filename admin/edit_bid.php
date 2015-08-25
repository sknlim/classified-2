<?php include "header.php";
require_once "../common/class/user.class.php";
require_once "../common/class/project_admin.class.php";
$user=new user();
$project_admin=new project_admin();
$bid_details=$project_admin->get_bid_by_id($_GET['id']);
?>
<script>
function check_amount()
{
var transaction_type=document.getElementById('transaction_type').value;
if(transaction_type=="credit")
{
document.getElementById('plus_amount').style.display="inline";
document.getElementById('minus_amount').style.display="none"
}
else
{
if(transaction_type=="debit")
{
document.getElementById('minus_amount').style.display="inline";
document.getElementById('plus_amount').style.display="none";
}
}
}
</script>
<table  width="100%">
<tr align="center">
<td align="center" bgcolor="#66CCFF">Edit Bid on '<?php echo $project_admin->gettitle($bid_details['projectid']);?>'</td>
</tr>
</table>
<form name="frmeditbid" action="bids_details.php?wtdo=edit_bid&bid_id=<?php echo $_GET['id'];?>&id=<?php echo $_GET['pro_id'];?>" method="post" onSubmit="if(validateForm(this)) { if(check_amount()) return true; } else return false; ">
<table>
    
		
	<tr>
				<td><label for="tags"><strong>Username:</strong></label></td>
				<td>
					<?php echo $user->getUserNameFromUserId($bid_details['userid']);?>
                <span class="checkStatus"></span>            	
           		</td>
	</tr>

		
	<tr>
				<td><label for="tags"><strong>Amount:</strong></label></td>
				<td>
					<input type="text" id="amount" name="amount" class="vldnum textWidth" value="<?php echo $bid_details['amount'];?>"  />	
                <span class="checkStatus"></span>            	
           		</td>
	</tr>
	
	 <tr>
		 <td><label for="tags"><strong>Days:</strong></label></td>
		
	 	 <td><span id="plus_amount" style="display:none;">+</span><span id="minus_amount" style="display:none;">-</span><input type="text" id="days" name="days" class="vldnum textWidth" value="<?php echo $bid_details['days'];?>"  />	
                <span class="checkStatus"></span>            	
         </td>
	
	</tr>
		
	<tr>
				<td><label for="tags"><strong>Comment:</strong></label></td>
				<td><textarea id="comments" style="width:300px; height:200px" name="comments" class="vldnoblank textWidth" ><?php echo $bid_details['comment'];?></textarea>
                <span class="checkStatus"></span>            	
    	        </td>
	</tr>
	
	<tr align="center">
				<td >
				<input type="submit" value="Update Bid">
                <span class="checkStatus"></span>            	
                </td> 
	</tr>
</table>
</form>



<?php include "footer.php";?>