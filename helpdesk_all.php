<?php 
session_start();
include "header.php";
include "subheader.php";
require_once "common/class/helpdesk.class.php";
require_once "common/class/user.class.php";
$user=new user();

$helpdesk=new helpdesk();

$type="all";

$result=$helpdesk->get_all_request($type);
?>
<div  style="width: 580px; margin-left: 50px;">
<center>
  <h3><u>Support Help Desk</u></h3>
</center>

  <div class="formRowBig"><span class="fieldNamewithheader heading">
  <table width="100%">
  <tr>
  <td align="left">
  <a href="javascript: loadPage('/ajax/helpdesk_new_request.php')">Open New Request</a>
  </td>
  <td align="center">
   <a href="helpdesk.php">Open Request </a>
   </td>
   <td align="right">
   <a href="helpdesk_all.php">View All Request</a>
   </td>
  </tr>
  </table>
  </div>
  <br />
  <form name="listuser" action="deleteuser.php?action=delete" method="post">
<input type="hidden" id="type" name="type" value="" />
<input type="hidden" id="selectcheck"  name="selectcheck" />

<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 	
<?php
	if(is_array($result))
	{
	?>
	<tr bgcolor="#FFFFFF">
		<td class="grey" align="center">From Username</td>
		<td class="grey" align="center">Subject</td>
		<td class="grey" align="center">Timestamp</td>

		<td class="grey" align="center" align="center"> Change Status</td>
	</tr>
	<? 

	foreach($result as $group_details)
		{
?>	
	<?php	
		echo "<tr align='center' ";
		if($group_details['status']=="open")
		$status="";
		elseif($group_details['status']=="reopen")
		$status="";
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

		<td align='center'>";
		if($status!=""){?>
		<a href="javascript: loadPage('/ajax/helpdesk_new_request.php?helpdesk_id=<?php echo $group_details['id'];?>&status_change=reopen')">Re Open</a><?php }echo "</td></tr>";
		
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
	?>
</table>
</form>
 
</div>   

  
  
 
 
<script>loadAjax('/ajax/project/subcategory.php?id=1','div_subcategory'); </script>

<?php
include "subfooter.php";
include "footer.php";
?>
