<?php include "header.php";
require_once "../common/class/user.class.php";
require_once "../common/class/transaction_admin.class.php";
$transaction=new transaction_admin();
$transaction_details=$transaction->getbyid($_GET['id']);
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
<td align="center" bgcolor="#66CCFF">Edit Transaction</td>
</tr>
</table>
<form name="frmaddcategory" action="transaction_management.php?wtdo=edit_transaction&id=<?php echo $_GET['id'];?>" method="post" onSubmit="if(validateForm(this)) { if(check_amount()) return true; } else return false; ">
<table>
    
		
	<tr>
				<td><label for="tags"><strong>User:</strong></label></td>
				<td>
					<select name="user" id="user"  class="vldnoblank bigTextBox" errormessage="Please select a valid User">
					  		  <option value="" selected="selected">Select User</option>
							  <?php
							  $user=new user();
							 print_r($getuser=$user->getalluserlist());
								  foreach($getuser as $result)
									  {
									 echo '<option value="'.$result['id'].'" '; if($transaction_details['userid']==$result['id']){echo 'selected="selected"';}echo ' >'.$result['username'].'</option>';
									  }
							  ?>
					</select>
                <span class="checkStatus"></span>            	
           		</td>
	</tr>

		
	<tr>
				<td><label for="tags"><strong>Transaction Type:</strong></label></td>
				<td>
					<select name="transaction_type" onchange="check_amount();" id="transaction_type"  class="vldnoblank bigTextBox" errormessage="Please select a valid Type">
					  		  <option value="" selected="selected">Select Type</option>
						 	  <option value="debit" <?php if($transaction_details['transaction_type']=="debit"){?> selected="selected"<?php }?> >Debit</option>
							  <option value="credit"  <?php if($transaction_details['transaction_type']=="credit"){?> selected="selected"<?php }?>>Credit</option>
					</select>
                <span class="checkStatus"></span>            	
           		</td>
	</tr>
	
	 <tr>
		 <td><label for="tags"><strong>Amount:</strong></label></td>
		
	 	 <td><span id="plus_amount" style="display:none;">+</span><span id="minus_amount" style="display:none;">-</span><input type="text" id="amount" name="amount" class="vldnum textWidth" value="<?php echo $transaction_details['amount'];?>"  />	
                <span class="checkStatus"></span>            	
         </td>
	
	</tr>
		
	<tr>
				<td><label for="tags"><strong>Description:</strong></label></td>
				<td><textarea id="description" style="width:300px; height:200px" name="description" class="vldnoblank textWidth" ><?php echo $transaction_details['description'];?></textarea>
                <span class="checkStatus"></span>            	
    	        </td>
	</tr>
	
	<tr align="center">
				<td >
				<input type="submit" value="Update Transaction">
                <span class="checkStatus"></span>            	
                </td> 
	</tr>
</table>
</form>



<?php include "footer.php";?>