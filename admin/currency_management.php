<?php 
include "header.php";
include "../common/class/admin/admin.class.php";
require_once "../common/class/mysql.class.php";
require_once "../common/class/currency.class.php";
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

function deletecategory()
{
	checkBoxArr = getSelectedCheckboxValue(document.listuser.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Users Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
		return confirm("Are You Sure ?");
}


</script>


<?php  
$currency = new currency();
if($_GET['wtdo']=='add_currency' && $_POST['name']!="" && $_POST['fullname']!="")
	{
	if(!is_array($currency->check_currency($_POST)))
	{
	$add=$currency->add_currency($_POST);
	}
	else
	{
	?>
	<table align="center">
	<tr>
	<td>
	<b><font>Error: </font></b><b><font color="#CC3333"><?php echo "Duplicate Entry of Currency";?></font></b>
	</td>
	</tr>
	</table>
	<?php 
	}
	}
if($_GET['wtdo']=='edit_currency' && $_POST['name']!="" && $_POST['fullname']!="")
	{
	$add=$currency->edit_currency($_POST,$_GET['id']);
	}

?>
<table align="left" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#FFFFFF; font-size:16px;">
	<tr><td colspan="6" align="center" valign="middle">
    <table align="center" >
    <tr>
    <td><img src="images/listmain.png" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;List of Currency</td>
    </tr>
    </table>
	</td></tr>

<tr><td colspan="6"><table width="100%"><tr><td>
<br />

<?php
/* Page Numbering Class */
$pagelimit = 25;
$total=$currency->total_currency();
$query_string = $_SERVER['PHP_SELF']."?type_id=".$_GET['type_id'];
if($_GET['pageno']=="")
	$current_page = 1;
else
	$current_page = $_GET['pageno'];
$pagenum = new pagenumbering($total,$query_string,$current_page,$pagelimit,6);
$st_limit = ($current_page - 1) *  $pagelimit;
$ed_limit = $pagelimit;
if($total < 1)
	{
	$st_limit  = 0;
	$ed_limit  = 0;
	}
/* Page Numbering Class */
$result = $currency->getall($st_limit,$ed_limit);
?>
 <a href='add_currency.php'>ADD Currency</a>
<form name="listuser" action="delete_currency.php?action=delete" method="post" onsubmit="return deletecategory(); ">
<input type="hidden" id="selectcheck"  name="selectcheck" />
<table width="100%"><tr><td align="right" width="100%">
<b><font color="red" size="2"> *Delete : this will delete there all data from the website </font></b><input type="submit" value="Delete" /></td></tr></table>
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 	
	<tr bgcolor="#3262bd">
		<td class="grey" align="center">Name</td>
		<td class="grey" align="center">Full Name</td>
		<td class="grey" align="center">Edit</td>
		<td class="grey" align="center">Delete</td>
		
		<td class="grey" align="center" align="center"><input type="checkbox" name="allbox" onclick="CheckAll(document.listuser);" /></td>
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
		
		
		<td>".$group_details['name']."</td>
		<td align='left'>".$group_details['full_name']."</td>
		<td><a href='edit_currency.php?id=".$group_details['id']."&type=".$_GET['type']."'>EDIT</a></td>
		<td><a href='delete_currency.php?action=delete&id=".$group_details['id']."'  onclick=\"return confirmSubmit()\">DELETE</a></td>
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
 <a href='add_currency.php'>ADD Currency</a>     
</td></tr></table></td></tr></table>


<?php include "footer.php"; ?>