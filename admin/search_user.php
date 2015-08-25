<?php include "header.php";
include "../common/class/admin/admin.class.php";
?>
<script>
function checksearch()
{
	if(document.getElementById('keywords').value=="")
	{
	alert("Please Enter Keyword to Search..");
	document.getElementById('keywords').focus();
	document.getElementById('keywords').select();
	return false;
	}
	return true;
}
</script>

<table align="center">
<tr><td><img src="images/Searchmain.png" /></td><td valign="middle" style="color:#003399; text-align:center; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="left">Search User</td></tr></table>

<form name="search" action="listuser.php" method="POST" onsubmit="return checksearch();">
<table style="font-family:Arial, Helvetica, sans-serif; font-size:12px;color:#003399;" align="center">
<tr>
<td>
<b>Enter Keyword to Search</b>
</td>
						<td  align="center">
							<input type="text" name="keywords" id="keywords" size="30"/>&nbsp;&nbsp;
							
						</td>
						<td align="center">
						&nbsp;&nbsp;<input type="submit" name="search" value="SEARCH" />
						</td>
						</tr>
						</table>
					</form><?php include "footer.php";?>