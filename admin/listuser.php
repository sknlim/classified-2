<?php 
include "header.php";
include "../common/class/admin/admin.class.php";
require_once "../common/class/mysql.class.php";
require_once "../common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/pagenumbering.class.php";
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

function deleteuser()
{
	checkBoxArr = getSelectedCheckboxValue(document.listuser.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Users Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="delete";
		return confirm("Are You Sure ?");
}
function approveuser()
{
	checkBoxArr = getSelectedCheckboxValue(document.listuser.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Users Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="approve";
		return confirm("Are You Sure ?");
}
function blockuser()
{
	checkBoxArr = getSelectedCheckboxValue(document.listuser.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Users Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="block";
		return confirm("Are You Sure ?");
}
function suspenduser()
{
	checkBoxArr = getSelectedCheckboxValue(document.listuser.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Users Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="suspend";
		return confirm("Are You Sure ?");
}


</script>


<?php  
$mysql=new mysql();
$user = new user();
$common = new common();
$admin = new admin();
$total=$user->count_users();
$total_active=$user->count_active_users();

?>

<table align="left" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#FFFFFF; font-size:16px;">
	<tr bgcolor="#CCCCCC" align="center">
		<td bgcolor="#333333" ><b>Total Users </b></td><td bgcolor="#0066CC"><b><? echo $total[0]['total_users'];?></b></td>
		<td bgcolor="#333333" >Total Active Users </td><td bgcolor="#00CC00"><? echo $total_active[0]['active'];?></td>
		<td bgcolor="#333333">Total Non-Active Users </td><td bgcolor="#FF0000"><? echo $total[0]['total_users']-$total_active[0]['active'];?></td>
	</tr>
	<tr>
	<td colspan="6">
	
	</td>
	</tr>
	<tr><td colspan="6" align="center" valign="middle">
    <table align="center" >
    <tr>
    <td><img src="images/listmain.png" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;List of Users</td>
    </tr>
    </table>
	</td></tr>

<tr><td colspan="6"><table width="100%"><tr><td>
<br />
<?php
/* Page Numbering Class */
$pagelimit = 10;
$query_string = $_SERVER['PHP_SELF']."?type_id=".$_GET['type_id'];
if($_GET['pageno']=="")
	$current_page = 1;
else
	$current_page = $_GET['pageno'];
$pagenum = new pagenumbering($total[0]['total_users'],$query_string,$current_page,$pagelimit,6);
$st_limit = ($current_page - 1) *  $pagelimit;
$ed_limit = $pagelimit;
if($total[0]['total_users'] < 1)
	{
	$st_limit  = 0;
	$ed_limit  = 0;
	}
/* Page Numbering Class */

if($_POST['keywords'])
{
$str=$_POST['keywords'];
$result=$user->get_search_userlist($str,$st_limit,$ed_limit);
}
else
{
$result=$user->getalluserlist($st_limit,$ed_limit);
}
// $result = mysql_query($sql);
//echo $sql;


?>
<br />
<?
if(is_array($result))
	{
	
	?>

<form name="listuser" action="deleteuser.php?action=delete" method="post">
<input type="hidden" id="type" name="type" value="" />
<input type="hidden" id="selectcheck"  name="selectcheck" />
<table width="100%"><tr><td align="right" width="100%">
<b><font color="red" size="1"> *Delete : this will delete there all data from the website </font></b><input type="submit" value="Block"  onclick="return blockuser(); " />
<input type="submit" value="Approve"  onclick="return approveuser(); " />
<input type="submit" value="Suspend"  onclick="return suspenduser(); " />
<input type="submit" value="Certified"  onclick="return certifyuser(); " />
<input type="submit" value="Uncertified"  onclick="return uncertifyuser(); " />
<input type="submit" value="Delete"  onclick="return deleteuser(); " />

</td></tr></table>
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 	
	<tr bgcolor="#3262bd">
		<td class="grey" align="center">Username</td>
		<td class="grey" align="center">Password</td>
		<td class="grey" align="center">Email</td>
		<td class="grey" align="center">Type</td>
		<td class="grey" align="center">Created DateTime</td>
   		<td class="grey" align="center">Account Status</td>
		<td class="grey" align="center" align="center"><input type="checkbox" name="allbox" onclick="CheckAll(document.listuser);" /></td>
	</tr>
	<? 
	
	
	foreach($result as $group_details)
		{
?>	
	<?php	
		echo "<tr align='center' ";
		if($group_details['active']=="yes")
		$status="<b style='color:green;'>Active</b>";
		elseif($group_details['active']=="no")
		$status="<b style='color:red;'>Blocked</b>";
		elseif($group_details['active']=="suspended")
		$status="<b style='color:balck;'>Suspended</b>";
		
		$color=!$color;
		if($color)
			echo 'bgcolor="#ffffff"';
		else
			echo 'bgcolor="#e4ebfb"';
		echo ">
		
		
		<td><a href=\"user_profile.php?userid=".$group_details['id']."\">".$group_details['username']."</a></td>
		<td>".substr(md5($group_details['password']),0,10)."</td>
		<td align='left'>".$group_details['email']."</td>
		<td align='left'>".$group_details['type']."</td>
		<td>".$common->fuzzyTime($group_details['time_stamp'])."</td>
		<td>".$status."</td>";
		echo "
		<td align='center'><input type='checkbox' name='checkdel' value='".$group_details['id']."' /></td></tr>";
		
	}
	?>
</table>
</form>

<table style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; background-color:#5790dc; height:20px;width:100%;" >
<tr>
<td align="right"><?php $pagenum->showHTML();?></td>

</tr>
</table>
      
</td></tr></table></td></tr></table>
<?
}
	else
	{
		echo "<p align='center' style='font-size:16px; font-weight:bold; color:red;'>No Results Found...</p>";

	}
	
?>

<?php include "footer.php"; ?>