<?php 
include "header.php";
include "../common/class/admin/admin.class.php";
require_once "../common/class/mysql.class.php";
require_once "../common/class/contactus.class.php";
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

function delete_contactus()
{
	checkBoxArr = getSelectedCheckboxValue(document.listcontactus.checkdel);
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
$mysql=new mysql();
$common = new common();
$contactus = new contactus();

?>

<table align="left" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#FFFFFF; font-size:16px;">
	
	
	<tr><td colspan="6" align="center" valign="middle">
    <table align="center" >
    <tr>
    <td><img src="images/listmain.png" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;Contact us Management</td>
    </tr>
    </table>
	</td></tr>

<tr><td  colspan="6"><table width="100%"><tr><td>
<br />

<?php

if($_GET['show_for']=="general" || $_GET['show_for']=="spam" || $_GET['show_for']=="dispute" || $_GET['show_for']=="cancel")
{
$result = $contactus->get_list_for_type($_GET['show_for']);
}
else
{
$result = $contactus->get_list_all();
}
?>
<a href="contact_management.php?show_for=general">General Type</a>&nbsp;&nbsp;&nbsp;&nbsp;    
<a href="contact_management.php?show_for=spam">Spam Type</a>&nbsp;&nbsp;&nbsp;&nbsp;   
<a href="contact_management.php?show_for=dispute">Dispute Type</a>&nbsp;&nbsp;&nbsp;&nbsp;  
<a href="contact_management.php?show_for=cancel">Cancel Type</a>
<br /><br /><br />
<?php

if(is_array($result))
{

?>

<form name="listcontactus" style="width:100%" action="deletecontactus.php?action=delete" method="post" onsubmit="return delete_contactus(); ">
<input type="hidden" id="selectcheck"  name="selectcheck" />
<table width="100%"><tr><td align="right" width="100%">

<b><font color="red" size="2"> *Delete : this will delete there all data from the website </font></b><input type="submit" value="Delete" /></td></tr></table>
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 	
	<tr bgcolor="#3262bd">
		<td class="grey" align="center">Type</td>
		<td class="grey" align="center">Subject</td>
		<td class="grey" align="center">Description</td>
		
		<td class="grey" align="center" align="center"><input type="checkbox" name="allbox" onclick="CheckAll(document.listcontactus);" /></td>
	</tr>
	<? 
	

	foreach($result as $group_details)
		{

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
		
		
		<td align='left'>".$group_details['type']."</td>
		<td>".$group_details['subject']."</td>
		<td>".$group_details['description']."</td>
		
		<td align='center'><input type='checkbox' name='checkdel' value='".$group_details['id']."' /></td></tr>";
		
	}

	?>
</table>
</form>
<?php
	   }
   else
   {
   echo "<table align='center'><tr><td>";
   echo "<font size='+1' color='#CC6633'>No Messages From Contact Us</font>";
   echo "</td></tr></table>";
   }
   
   ?>

</td></tr></table></td></tr></table>


<?php include "footer.php"; ?>