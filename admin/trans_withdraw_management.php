<?php 
include "header.php";
include "../common/class/admin/admin.class.php";
require_once "../common/class/mysql.class.php";
require_once "../common/class/transaction_admin.class.php";
$user=new user();
?> 
<style>
.grey
{
font-weight:bold;
color:#FFFFFF;
}
</style><script src="/js/checkall.js"></script>
<script language="javascript">

var checkBoxArr;

function pending_withdraw()
{
	checkBoxArr = getSelectedCheckboxValue(document.listtransaction.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Row Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="pending";
		return confirm("Are You Sure ?");
}
function process_withdraw()
{
	checkBoxArr = getSelectedCheckboxValue(document.listtransaction.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Row Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="process";
		return confirm("Are You Sure ?");
}
function process_cancel()
{
	checkBoxArr = getSelectedCheckboxValue(document.listtransaction.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Row Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="cancel";
		return confirm("Are You Sure ?");
}
</script>

<?php  
$transaction = new transaction_admin();
?>

<table align="left" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#FFFFFF; font-size:16px;">
	<tr><td colspan="6" align="center" valign="middle">
    <table align="center" >
    <tr>
    <td><img src="images/listmain.png" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;List of withdraw</td>
    </tr>
    </table>
	</td></tr>

<tr><td colspan="6"><table width="100%"><tr><td>
<br />

<?php
if($_GET['show_for'])
$result = $transaction->getall_withdraw($_GET['show_for']);
else
$result = $transaction->getall_withdraw();

if(is_array($result))
	{
?>
<a href="trans_withdraw_management.php?show_for=complete">Complete List</a>&nbsp;&nbsp;&nbsp;&nbsp;    
<a href="trans_withdraw_management.php?show_for=pending">Pending List</a>&nbsp;&nbsp;&nbsp;&nbsp;    
<a href="trans_withdraw_management.php">View All</a>
<form name="listtransaction" action="cancel_trans_withdraw.php?action=delete" method="post" onsubmit="return deletetransaction(); ">
<input type="hidden" id="selectcheck"  name="selectcheck" />
<input type="hidden" id="type" name="type" value="" />
<table width="100%"><tr><td align="right" width="100%">
<b><font color="red" size="2"> *Delete : this will delete there all data from the website </font></b><input type="submit" value="Process"  onclick="return process_withdraw(); " /><input type="submit" value="Cancel"  onclick="return process_cancel(); " /><input type="submit" value="Pending"  onclick="return pending_withdraw(); " /></td></tr></table>
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 	
	<tr bgcolor="#3262bd">
		<td class="grey" align="center">Username </td>
		<td class="grey" align="center">Amount</td>
		<td class="grey" align="center">Requested Date</td>
		<td class="grey" align="center">Processed Date</td>
		<td class="grey" align="center">Status</td>
		<td class="grey" align="center" align="center"><input type="checkbox" name="allbox" onclick="CheckAll(document.listtransaction);" /></td>
	</tr>
	<? 
	
	
	foreach($result as $group_details)
		{
?>	
	<?php	
		echo "<tr align='center' ";
		if($group_details['status']=="process")
		$status="<b style='color:green;'>Complete</b>";
		elseif($group_details['status']=="cancel")
		$status="<b style='color:black;'>Canceled</b>";
		else
		$status="<b style='color:red;'>Pending</b>";
		
		$color=!$color;
		if($color)
			echo 'bgcolor="#ffffff"';
		else
			echo 'bgcolor="#e4ebfb"';
		echo ">
		
		
		<td align='left'><a href='user_profile.php?userid=".$group_details['userid']."'>".$user->getUserNameFromUserID($group_details['userid'])."</a></td>
		<td >".$group_details['amount']."</td>
		<td >".$group_details['requested_date']."</td>
		<td >".$group_details['processed_date']."</td>
		<td >".$status."</td>
		<td align='center'><input type='checkbox' name='checkdel' value='".$group_details['id']."' /></td></tr>";
		
	}
	?>
</table>
</form>

<table style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; background-color:#5790dc; height:20px;width:100%;" >
<tr>
<td align="left"></td>
<td align="right">


&nbsp;&nbsp;&nbsp;&nbsp;
      </td>
</tr>
</table>
<?php
}
else
{
	if($_GET['show_for']=="complete")
		{
		$message="No Withdraw is Completed yet";
		}
	elseif($_GET['show_for']=="pending")
		{
		$message="No Withdraw is Pending ";
		}
	else
		{
		$message="Withdraw List is Empty ";
		}
echo "<tr align='center' ";
			echo 'bgcolor="#e4ebfb"';
		echo ">
		
		<td align='center'>".$message."</td></tr>";
}
?>
 
</td></tr></table></td></tr></table>


<?php include "footer.php"; ?>