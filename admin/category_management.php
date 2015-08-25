<?php 
include "header.php";
include "../common/class/admin/admin.class.php";
require_once "../common/class/mysql.class.php";
require_once "../common/class/category.class.php";
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
$category = new subcategory($_GET['type']);
if($_GET['wtdo']=='add_category' && $_POST['category']!="")
	{
	$add=$category->add_category($_POST['category']);
	}
if($_GET['wtdo']=='edit_category' && $_POST['category']!="")
	{
	$add=$category->edit_category($_POST['category'],$_GET['id']);
	}
switch($_GET['type'])
	{
	
	case "maincategory" :
				$message="Categories";
				break;
	case "projects_category" :
				$message="projects category";
				break;
	case "rentorhire_category" :
				$message="Rent or Hire category";
				break;
	case "services_category" :
				$message="Services category";
				break;
	default : echo "Error Seletecting Category Type "; exit();
	}
?>
<table align="left" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#FFFFFF; font-size:16px;">
	<tr><td colspan="6" align="center" valign="middle">
    <table align="center" >
    <tr>
    <td><img src="images/listmain.png" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;List of <?php echo $message;?></td>
    </tr>
    </table>
	</td></tr>

<tr><td colspan="6"><table width="100%"><tr><td>
<br />

<?php
$result = $category->getcategory();
?>
<a href='add_category.php?type=<?php echo $_GET['type'];?>'>ADD CATEGORY</a>
<form name="listuser" action="deletecategory.php?action=delete&type=<?php echo $_GET['type'];?>" method="post" onsubmit="return deletecategory(); ">
<input type="hidden" id="selectcheck"  name="selectcheck" />
<table width="100%"><tr><td align="right" width="100%">
<b><font color="red" size="2"> *Delete : this will delete there all data from the website </font></b><input type="submit" value="Delete" /></td></tr></table>
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 	
	<tr bgcolor="#3262bd">
		<td class="grey" align="center">Category Name</td>
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
		
		
		<td align='left'>".$group_details['name']."</td>
		<td><a href='edit_category.php?id=".$group_details['id']."&type=".$_GET['type']."'>EDIT</a></td>
		<td><a href='deletecategory.php?action=delete&id=".$group_details['id']."&type=".$_GET['type']."'  onclick=\"return confirmSubmit()\">DELETE</a></td>
		<td align='center'><input type='checkbox' name='checkdel' value='".$group_details['id']."' /></td></tr>";
		
	}
	?>
</table>
</form>

<table style="color:#FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; background-color:#5790dc; height:20px;width:100%;" >
<tr>
<td align="left"></td>
<td align="right">


&nbsp;&nbsp;&nbsp;&nbsp;
      </td>
</tr>
</table>
  <a href='add_category.php?type=<?php echo $_GET['type'];?>'>ADD CATEGORY</a>    
</td></tr></table></td></tr></table>


<?php include "footer.php"; ?>