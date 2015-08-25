<?php 
include "header.php";
require_once "../common/class/mysql.class.php";
require_once "../common/class/rentorhire.class.php";
require_once "../common/class/category.class.php";
require_once "../common/class/sub_rentorhire.class.php";
require_once "../common/class/user.class.php";
$category=new subcategory("sub_maincategory");
$sub_rentorhire=new sub_rentorhire();
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

function deleterentorhire()
{
	checkBoxArr = getSelectedCheckboxValue(document.listjob.checkdel);
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


</script>


<?php  
$mysql=new mysql();
//$common = new common();
$user = new user();
$rentorhire = new rentorhire();


if($_GET['wtdo']=='edit_job' && $_POST['category']!="")
	{
	$add=$project->updatepage($_POST['filename'],$_POST['menuname'],$_POST['title'],$_POST['metakeywords'],$_POST['metadescription'],$_POST['FCKeditor1']);
	}
?>

<table align="left" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#FFFFFF; font-size:16px;">
	
	
	<tr><td colspan="6" align="center" valign="middle">
    <table align="center" >
    <tr>
    <td><img src="images/listmain.png" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;List of Rent or Hire Items</td>
    </tr>
    </table>
	</td></tr>

<tr><td  colspan="6"><table width="100%"><tr><td>
<br />

<?php
$result = $rentorhire->get_all_rentorhire();

?>

<form name="listjob" action="delete_rentorhire_item.php" method="post">
<input type="hidden" id="type" name="type" value="" />
<input type="hidden" id="selectcheck"  name="selectcheck" />
<table width="100%"><tr><td align="right" width="100%">
<?php
if(is_array($result))
{?>
<b><font color="red" size="2"> *Delete : this will delete there all data from the website </font></b><input type="submit" value="Delete"  onclick="return deleterentorhire(); " /></td></tr></table>
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 	

	<tr bgcolor="#3262bd">
		<td class="grey" align="center">By Username</td>
		<td class="grey" align="center">Name</td>
		<td class="grey" align="center">Product Category</td>
		
		<td class="grey" align="center">Area</td>
	
	
		
		<td class="grey" align="center" align="center"><input type="checkbox" name="allbox" onclick="CheckAll(document.listjob);" /></td>
	</tr>
	<? 
	

	foreach($result as $group_details)
		{

		echo "<tr align='center' ";
		$color=!$color;
		if($color)
			echo 'bgcolor="#ffffff"';
		else
			echo 'bgcolor="#e4ebfb"';
		echo ">
		
		<td><a href='user_profile.php?userid=".$group_details['userid']."'>".$user->getUserNameFromUserId($group_details['userid'])."</a></td>
		<td>".$group_details['name']."</td>
		<td>".$sub_rentorhire->get_name_category_id($group_details['product_category'])."</td>
		<td>".$category->getById($group_details['sub_maincategory_id'])."</td>
	  
		
		
		<td align='center'><input type='checkbox' name='checkdel' value='".$group_details['id']."' /></td></tr>";
		
	}
}
else
{
echo "<tr align='center' ";
			echo 'bgcolor="#e4ebfb"';
		echo ">
		
		<td align='center'>No Rent or Hire Items Posted Yet</td></tr>";
}
	?>
</table>
</form>
      
</td></tr></table></td></tr></table>


<?php include "footer.php"; ?>