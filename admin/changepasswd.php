<?php
include "header.php"; 
include "../common/class/admin.class.php";
require_once "../common/class/mysql.class.php";
?>
<?php
if($_GET['type']=="changepw" && $_POST['pass1']!="" && $_POST['pass2']!="")
	{
	if($_POST['pass1']==$_POST['pass2'])
		{
		$mysql_class=new mysql();
		$sql = "update `users` set `password`='".$_POST['pass2']."' where username='admin' and accesslevel=2";
		$link = $mysql_class->query($sql);;
		$_SESSION['check']=false;
		echo "<script> alert('Password Changed !'); window.location='logout.php'; </script>";
		}
	}
?>
<script>
function checkchangepwd()
{
	if(document.getElementById('pass1').value=="")
	{
	alert("Please Enter New Password..");
	document.getElementById('pass1').focus();
	document.getElementById('pass1').select();
	return false;
	}
	
	if(document.getElementById('pass2').value=="")
	{
	alert("Please Enter Confirm Password..");
	document.getElementById('pass2').focus();
	document.getElementById('pass2').select();
	return false;
	}
	
	if(document.getElementById('pass1').value!=document.getElementById('pass2').value)
	{
	alert("New Password and Confirm Password Does not Match..");
	document.getElementById('pass1').focus();
	document.getElementById('pass1').select();
	return false;
	}
	
	
	return true;
}
</script>

<br /><br /><br /><br />
<table width="400" align="center" cellpadding="2" cellspacing="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; border: #000000;"><tr><td>
<table align="center" >
    <tr>
    <td><img src="images/cp.gif" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;Change Password !</td>
    </tr>
    </table>
    <br />
<form name="change_password" method="post" action="changepasswd.php?type=changepw" onsubmit="return checkchangepwd();">
	<table  bgcolor="#e4ebfb" cellpadding="6" cellspacing="4" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#000000; border:4px solid #3262bd;">
	<tr>
		<td align="right"><img src="images/password.png" />   New Password :</td> 
		<td><input type="password" name="pass1" id="pass1" /></td>
	</tr>
	<tr>
		<td align="right"><img src="images/changepass.png" />    Confirm New Password :</td>
		<td><input type="password" name="pass2" id="pass2"/></td>
	</tr>
	<tr><td colspan="2" align="center"><input type="submit" value="Change Password"  /></td></tr></table>
</form>
</td></tr>
</table>

<?php include "footer.php"; ?>