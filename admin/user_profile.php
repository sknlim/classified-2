<?php 
include "header.php";
include "../common/class/admin/admin.class.php"; 
require_once "../common/class/mysql.class.php";
require_once "../common/class/common.class.php";
$admin_class=new admin();
$common_class=new common();
$mysql_querry=new mysql();?>
<script language="javascript">

var checkBoxArr;

function deleteuser()
{
	document.getElementById('type').value="delete";
		return confirm("Are You Sure ?");
}
function approveuser()
{

	document.getElementById('type').value="approve";
		return confirm("Are You Sure ?");
}
function blockuser()
{
	
	document.getElementById('type').value="block";
		return confirm("Are You Sure ?");
}
function suspenduser()
{

	document.getElementById('type').value="suspend";
		return confirm("Are You Sure ?");
}


</script>


<?php
$sql="select *,UNIX_TIMESTAMP(createtime) as time_stamp,UNIX_TIMESTAMP(lastlogin) as lastlogin from users where id='".$_GET['userid']."'";
$profile=$mysql_querry->queryrow($sql);
if($profile['active']=="yes")
		$status="<b style='color:green;'>Active</b>";
		elseif($profile['active']=="no")
		$status="<b style='color:red;'>Blocked</b>";
		elseif($profile['active']=="suspended")
		$status="<b style='color:balck;'>Suspended</b>";
?>

<table align="center" >
    <tr>
    <td><img src="images/details.png" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;Details of <?php echo $profile['username']; ?> </td>
    </tr>
    </table>

<style>
.header
{
font-size:12px;
color:#333333;
font-weight:bold;
}
</style>
<form name="listuser" action="deleteuser.php?action=delete&userid=<?php echo $_GET['userid'];?>" method="post">
<input type="hidden" id="type" name="type" value="" />
<table border="0" class="header" align="center">
  <tr height="20"></tr>
  
  <tr>
    <td align="right">&nbsp;Status : </td> <td><b><?php echo $status;?></b></td> 
  </tr>
  
   <tr>
    <td align="right">&nbsp;Username : </td> <td><b><?php echo $profile['username'];?></b></td> 
  </tr>
 
  <tr>
    <td  align="right">&nbsp;First Name :</td> <td >&nbsp;<?php echo $profile['firstname'];?></td>
  </tr>
 
  <tr>
     <td align="right">&nbsp;Last Name :</td> <td>&nbsp;<?php echo $profile['lastname'];?></td>
  </tr>
  
  <tr>
    <td align="right">&nbsp;Date of Birth :</td> <td>&nbsp;<?php echo $profile['dob'];?></td>
  </tr>

  <tr>
    <td align="right">&nbsp;Gender:</td> <td>&nbsp;<?php if($profile['gender']=="M") { echo "Male"; } else { echo "Female"; };?></td>
  </tr>

 
    <td align="right">&nbsp;E Mail :</td> <td>&nbsp;<?php echo $profile['email'];?></td>
  </tr>
  

  
  <tr>
    <td align="right">&nbsp;Member Since :</td> <td>&nbsp;<?php echo $common_class->fuzzyTime($profile['time_stamp']);?></td>
  </tr>
  
  <tr>
    <td align="right">&nbsp;Profile Views :</td> <td>&nbsp;<?php echo $profile['views'];?></td>
  </tr>
  
  <tr>
    <td align="right">&nbsp;Last Login :</td> <td>&nbsp;<?php echo $common_class->fuzzyTime($profile['lastlogin']);?></td>
  </tr>
  <tr>
    <td ><input type="submit" value="Block"  onclick="return blockuser(); " /></td> 
	<td><input type="submit" value="Approve"  onclick="return approveuser(); " /></td>
	<td ><input type="submit" value="Suspend"  onclick="return suspenduser(); " /></td> 
	<td><input type="submit" value="Delete"  onclick="return deleteuser(); " /></td>
  </tr>
 
</table>
</table>