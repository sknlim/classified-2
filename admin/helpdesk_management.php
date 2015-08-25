<?php 
include "header.php";
require_once "../common/class/mysql.class.php";
require_once "../common/class/helpdesk.class.php";
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

function deleterequest()
{
	checkBoxArr = getSelectedCheckboxValue(document.listrequest.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Rows Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="delete";
		return confirm("Are You Sure ?");
}
function resolvedrequest()
{
	checkBoxArr = getSelectedCheckboxValue(document.listrequest.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Rows Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="resolved";
		return confirm("Are You Sure ?");
}
function openrequest()
{
	checkBoxArr = getSelectedCheckboxValue(document.listrequest.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Rows Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="open";
		return confirm("Are You Sure ?");
}
function closerequest()
{
	checkBoxArr = getSelectedCheckboxValue(document.listrequest.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Rows Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="close";
		return confirm("Are You Sure ?");
}
function reopendrequest()
{
	checkBoxArr = getSelectedCheckboxValue(document.listrequest.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Rows Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="reopen";
		return confirm("Are You Sure ?");
}

</script>


<?php  
$mysql=new mysql();
//$common = new common();
$user = new user();
$helpdesk=new helpdesk();
if($_GET['wtdo']=='send_message')
	{
	$reply=$helpdesk->reply_entry_admin($_POST['description'],$_GET['helpdesk_id'],$_POST['from']);
	}
?>

<table align="left" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#FFFFFF; font-size:16px;">
	
	
	<tr><td colspan="6" align="center" valign="middle">
    <table align="center" >
    <tr>
    <td><img src="images/listmain.png" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;List of Requests</td>
    </tr>
    </table>
	</td></tr>

<tr><td  colspan="6"><table width="100%"><tr><td>
<br />

<?php
if($_GET['type']=="all")
{
$result = $helpdesk->get_all_request($_GET['type']);
$mes="No Request Posted Yet";
}
else
{
$result = $helpdesk->get_all_request();
$mes="No Open Requests";
}

if($_GET['type']=="all")
{
echo '<form name="listrequest" action="delete_requests.php?type='.$_GET['type'].'" method="post">';
}
else
{
?>
<form name="listrequest" action="delete_requests.php" method="post">
<?php }?>
<input type="hidden" id="type" name="type" value="" />
<input type="hidden" id="selectcheck"  name="selectcheck" />
<table width="100%"><tr><td align="right" width="100%">
<?php
if(is_array($result))
{?>
<b><font color="red" size="2"> *Delete : this will delete there all data from the website </font></b><input type="submit" value="Re-Open"  onclick="return reopendrequest(); " /><input type="submit" value="Resolved"  onclick="return resolvedrequest(); " /><input type="submit" value="Open"  onclick="return openrequest(); " /><input type="submit" value="Close"  onclick="return closerequest(); " /><input type="submit" value="Delete"  onclick="return deleterequest(); " /></td></tr></table>
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 	

	<tr bgcolor="#3262bd">
		<td class="grey" align="center">Username</td>
		<td class="grey" align="center">Subject</td>
		<td class="grey" align="center">Posted Time</td>
		<td class="grey" align="center">Status</td>
	
		
		<td class="grey" align="center" align="center"><input type="checkbox" name="allbox" onclick="CheckAll(document.listrequest);" /></td>
	</tr>
	<? 
	

	foreach($result as $group_details)
		{

		echo "<tr align='center' ";
		if($group_details['status']=="open")
		$status="<b style='color:green;'>Open</b>";
		elseif($group_details['status']=="reopen")
		$status="<b style='color:pink;'>Re-Open</b>";
		elseif($group_details['status']=="close")
		$status="<b style='color:red;'>Closed</b>";
		elseif($group_details['status']=="resolved")
		$status="<b style='color:black;'>Resolved</b>";
		
		$color=!$color;
		if($color)
			echo 'bgcolor="#ffffff"';
		else
			echo 'bgcolor="#e4ebfb"';
		echo ">
		
		<td><a href='user_profile.php?userid=".$group_details['userid']."'>".$user->getUserNameFromUserId($group_details['userid'])."</a></td>
		<td><a href='helpdesk_message.php?helpdesk_id=".$group_details['id']."'>".$group_details['subject']."</a></td>
		<td>".$group_details['timestamp']."</td>
	    <td>".$status."</td>
		
		
		<td align='center'><input type='checkbox' name='checkdel' value='".$group_details['id']."' /></td></tr>";
		
	}
}
else
{
echo "<tr align='center' ";
			echo 'bgcolor="#e4ebfb"';
		echo ">
		
		<td align='center'>".$mes."</td></tr>";
}
	?>
</table>
</form>
      
</td></tr></table></td></tr></table>


<?php include "footer.php"; ?>