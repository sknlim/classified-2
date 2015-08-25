

<?php

require_once $_SERVER['DOCUMENT_ROOT']."/common/class/sub_rentorhire.class.php";
$sub_rentorhire = new sub_rentorhire();
$result = $sub_rentorhire->get_all_sub_category($_GET['id']);

?>

<form name="listjob" action="delete_subcategory.php?action=delete&cate_id=<?php echo $_GET['id'];?>" method="post">
<input type="hidden" id="type" name="type" value="" />
<input type="hidden" id="selectcheck"  name="selectcheck" />
<table width="100%"><tr><td align="right" width="100%">
<?php
if(is_array($result))
{?>
<b><font color="red" size="2"> *Delete : this will delete there all data from the website </font></b><input type="submit" value="Delete"  onclick="return deletesubcategory(); " /></td></tr></table>
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 	

	<tr bgcolor="#3262bd">
		<td class="grey" align="center">Sub Category Name</td>
		<td class="grey" align="center">Edit</td>
		<td class="grey" align="center">Delete</td>
		<td class="grey" align="center" align="center"><input type="checkbox" name="allbox" onclick="CheckAll(document.listjob);" /></td>
	</tr>
	<? 
	

	foreach($result as $group_details)
		{

		echo "<tr align='center' ";
		if($group_details['status']=="active")
		$status="<b style='color:green;'>Active</b>";
		elseif($group_details['status']=="block")
		$status="<b style='color:red;'>Blocked</b>";
		elseif($group_details['status']=="expired")
		$status="<b style='color:pink;'>Expired</b>";
		elseif($group_details['status']=="suspended")
		$status="<b style='color:black;'>Suspended</b>";
		
		$color=!$color;
		if($color)
			echo 'bgcolor="#ffffff"';
		else
			echo 'bgcolor="#e4ebfb"';
		echo ">
		
		<td align='left'>".$group_details['name']."</td>
<td><a href='edit_rentorhire_subcategory.php?id=".$group_details['id']."&cate_id=".$_GET['id']."'>EDIT</a></td>
		<td><a href='delete_subcategory.php?action=delete&id=".$group_details['id']."&cate_id=".$_GET['id']."'  onclick=\"return confirmSubmit()\">DELETE</a></td>
		<td align='center'><input type='checkbox' name='checkdel' value='".$group_details['id']."' /></td></tr>";		
	}
}
else
{
echo "<tr align='center' ";
			echo 'bgcolor="#e4ebfb"';
		echo ">
		
		<td align='center'>No Sub Category </td></tr>
		";
}
	?>
</table>
</form>
       <a href='add_rentorhire_subcategory.php?id=<?php echo $_GET['id'];?>'>ADD SUB CATEGORY</a>  
</td></tr></table></td></tr></table>
