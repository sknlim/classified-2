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

function cancel_escrow()
{
	checkBoxArr = getSelectedCheckboxValue(document.listtransaction.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Users Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="cancel";
		return confirm("Are You Sure ?");
}
function complete_escrow()
{
	checkBoxArr = getSelectedCheckboxValue(document.listtransaction.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Users Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="complete";
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
    &nbsp;&nbsp;List</td>
    </tr>
    </table>
	</td></tr>

<tr><td colspan="6"><table width="100%"><tr><td>
<br />

<?php
$result = $transaction->getall_escrow();
if(is_array($result))
	{
?>


<form name="listtransaction" action="cancel_trans_escrow.php?action=delete" method="post" onsubmit="return deletetransaction(); ">
<input type="hidden" id="selectcheck"  name="selectcheck" />
<input type="hidden" id="type" name="type" value="" />
<table width="100%"><tr><td align="right" width="100%">
<b><font color="red" size="2"> *Delete : this will delete there all data from the website </font></b><input type="submit" value="Cancel"  onclick="return cancel_escrow(); " /><input type="submit" value="Complete"  onclick="return complete_escrow(); " /></td></tr></table>
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 	
	<tr bgcolor="#3262bd">
		<td class="grey" align="center">Provider Name </td>
		<td class="grey" align="center">Seeker Name</td>
		<td class="grey" align="center">Amount</td>
		
		
		
		<td class="grey" align="center" align="center"><input type="checkbox" name="allbox" onclick="CheckAll(document.listtransaction);" /></td>
	</tr>
	<? 
	
	
	foreach($result as $group_details)
		{
?>	
	<?php	
		echo "<tr align='center' ";
		if($group_details['active']=="1")
		$status="<b style='color:green;'>Active</b>";
		else
		$status="<b style='color:red;'>Blocked</b>";
		
		$color=!$color;
		if($color)
			echo 'bgcolor="#ffffff"';
		else
			echo 'bgcolor="#e4ebfb"';
		echo ">
		
		
		<td><a href='user_profile.php?userid=".$group_details['provider_userid']."'>".$user->getUserNameFromUserID($group_details['provider_userid'])."</a></td>
		<td ><a href='user_profile.php?userid=".$group_details['seeker_userid']."'>".$user->getUserNameFromUserID($group_details['seeker_userid'])."</a></td>
		<td >".$group_details['amount']."</td>
	
		
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
?>
 
</td></tr></table></td></tr></table>


<?php include "footer.php"; ?>