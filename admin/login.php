<? 
include("ImgVerification.php");

$vImage = new vImage();
?>
<html>
<head>
<title>Login</title>
<style>
.white
	{
	font-family: Helvetica;
	font-size: 14px;
	font-weight:bold;
	color:#FFFFFF;
	}
.white_small
	{
	font-family: Helvetica;
	font-size: 12px;
	font-weight:bold;
	color:#FFFFFF;
	}
</style>
<script type="text/javascript">
window.onload=select_form;
function select_form()
	{
		document.getElementById("user").focus()
		document.getElementById("user").select()
	}
	

function checkadminlogin()
{
	if(document.getElementById('user').value=="")
	{
	alert("Please Enter Admin Username ..");
	document.getElementById('user').focus();
	document.getElementById('user').select();
	return false;
	}
	
	if(document.getElementById('pass').value=="")
	{
	alert("Please Enter Admin Password..");
	document.getElementById('pass').focus();
	document.getElementById('pass').select();
	return false;
	}
	
	if(document.forms['adminlogin'].vImageCodP.value=="")
	{
	alert("Please Enter Image Verification Code..");
	document.forms['adminlogin'].vImageCodP.focus();
	return false;
	}
	
	return true;
}
</script>
	
	

</head>

<body>
<br><br></br><br><br>
<table width="400" align="center" cellpadding="2" cellspacing="2" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; border: #000000;"><tr><td>

<table align="center" >
    <tr>
    <td><img src="images/cp.gif" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;Administrative Login Only !</td>
    </tr>
</table>

<form method="post" action="checklogin.php" onSubmit="return checkadminlogin();" name="adminlogin">
	<table  bgcolor="#e4ebfb" cellpadding="6" cellspacing="4" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; border:6px solid #3262bd; color:#000000;">
			<tr><td  align="right"><img src="images/username.png"/>  Username : </td><td><input type="text" id="user" name="user"  width="20"></td></tr>
			<tr><td  align="right"><img src="images/password.png"/>  Password : </td><td><input type="password" name="pass"  id="pass" width="20"></td></tr>
			<tr><td>&nbsp;</td><td><img src="img.php?size=6"></td></tr>
			<tr><td align="right"><b>Image Verification :</b></td><td><?php $vImage->showCodBox(1);?></td></tr>
			<tr><td colspan="2" align="center"><input type="submit" name="submit" value="Login"><br><br></td></tr>
     </table>
</form>


</body>
</html>
