<?php 
session_start();
include "header.php";
include "subheader.php";
require_once "common/class/helpdesk.class.php";
require_once "common/class/user.class.php";


$user=new user();
if(!$user->checklogin())
{
echo "<script>window.location='index.php'; </script>";
echo "Please Login!";
include "footer.php";
exit();
}


$helpdesk=new helpdesk();
if($_GET['show']=="all")
	$type="all";
else
	$type="open";
$result=$helpdesk->get_all_request($type);
?>
<div>
<center><h3><u>Support Help Desk</u></h3></center>
  <table width="100%" bgcolor="#cccccc">
  <tr>
  <td align="left">
  <a href="javascript: loadPage('/ajax/helpdesk_new_request.php')">Open New Request</a>
  </td>
  <td align="center">
   <a href="helpdesk.php">Open Request </a>
   </td>
   <td align="right">
   <a href="helpdesk.php?show=all">View All Request</a>
   </td>
  </tr>
  </table>
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;">
<form name="listuser" action="deleteuser.php?action=delete" method="post">
<input type="hidden" id="type" name="type" value="" />
<input type="hidden" id="selectcheck"  name="selectcheck" /> 	
<?php
	if(is_array($result))
	{
	?>
	<tr bgcolor="#FFFFFF">
		<td class="grey" align="center">From Username</td>
		<td class="grey" align="center">Subject</td>
		<td class="grey" align="center">Timestamp</td>
		<td class="grey" align="center">Status</td>
		
	</tr>
	<? 
	foreach($result as $group_details)
		{
		echo "<tr align='center' ";
		if($group_details['status']=="open")
		$status="<b style='color:green;'>Open</b>";
		elseif($group_details['status']=="reopen")
		$status="<b style='color:red;'>Re Open</b>";
		elseif($group_details['status']=="close")
		$status="<b style='color:balck;'>Close</b>";
		elseif($group_details['status']=="resolved")
		$status="<b style='color:balck;'>Resolved</b>";
		
		$color=!$color;
		if($color)
			echo 'bgcolor="#ffffff"';
		else
			echo 'bgcolor="#e4ebfb"';
		echo ">
		
		
		<td>".$user->getUserNameFromUserId($group_details['userid'])."</td>
		<td><a href='helpdesk_message.php?helpdesk_id=".$group_details['id']."'>".substr($group_details['subject'],0,100)."</td>
		<td align='center'>".$group_details['timestamp']."</td>
		<td align='center'>".$status."</td>
		</tr>";
		
		}
	}
	else
	{
	echo '
	<tr bgcolor="#FFFFFF">
		<td class="grey" align="center">No Messages </td>
		
	</tr>
	';
	}
	?></form>
</table>
</div>   
<?php
include "subfooter.php";
include "footer.php";
?>
