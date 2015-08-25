<?php 
include "header.php";
include "../common/class/admin/admin.class.php";
require_once "../common/class/mysql.class.php";
require_once "../common/class/project_admin.class.php";
require_once "../common/class/user.class.php";
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

function deletebid()
{
	checkBoxArr = getSelectedCheckboxValue(document.listbid.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Rows Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
		return confirm("Are You Sure ?");
}


</script>


<?php  
$user=new user();
$project_admin = new project_admin();

if($_GET['wtdo']=='edit_bid' && $_POST!="")
	{
	$add=$project_admin->edit_bid($_POST,$_GET['bid_id']);
	}

?>
<table align="left" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#FFFFFF; font-size:16px;">
	<tr><td colspan="6" align="center" valign="middle">
    <table align="center" >
    <tr>
    <td><img src="images/listmain.png" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;Bids on <?php echo $project_admin->gettitle($_GET['id']);?></td>
    </tr>
    </table>
	</td></tr>

<tr><td colspan="6"><table width="100%"><tr><td>
<br />

<?php
$result = $project_admin->get_bid_details($_GET['id']);
if(is_array($result))
	{
?>

<form name="listbid" action="delete_bid.php?action=delete&type=<?php echo $_GET['type'];?>" method="post" onsubmit="return deletebid(); ">
<input type="hidden" id="selectcheck"  name="selectcheck" />
<table width="100%"><tr><td align="right" width="100%">
<b><font color="red" size="2"> *Delete : this will delete there all data from the website </font></b><input type="submit" value="Delete" /></td></tr></table>
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 	
	<tr bgcolor="#3262bd">
		<td class="grey" align="center">By Username</td>
		<td class="grey" align="center">Comments</td>
		<td class="grey" align="center">Days</td>
		<td class="grey" align="center">Amount</td>
		<td class="grey" align="center">Edit</td>
		<td class="grey" align="center">Delete</td>
		
		<td class="grey" align="center" align="center"><input type="checkbox" name="allbox" onclick="CheckAll(document.listbid);" /></td>
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
		
		
		<td align='left'><a href='user_profile.php?userid=".$group_details['userid']."'>".$user->getUserNameFromUserId($group_details['userid'])."</a></td>
		<td align='left'>".$group_details['comment']."</td>
		<td >".$group_details['days']."</td>
		<td >".$group_details['amount']."</td>
		<td><a href='edit_bid.php?id=".$group_details['id']."&pro_id=".$_GET['id']."'>EDIT</a></td>
		<td><a href='delete_bid.php?action=delete&id=".$group_details['id']."&type=".$_GET['type']."'  onclick=\"return confirmSubmit()\">DELETE</a></td>
		<td align='center'><input type='checkbox' name='checkdel' value='".$group_details['id']."' /></td></tr>";
		
	}
	
	?>
</table>
</form>
<?php
}
	else
	{
	echo "No Bids";
	}
	?>
<table style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; background-color:#5790dc; height:20px;width:100%;" >
<tr>
<td align="left"></td>
<td align="right">


&nbsp;&nbsp;&nbsp;&nbsp;
      </td>
</tr>
</table>

</td></tr></table></td></tr></table>


<?php include "footer.php"; ?>