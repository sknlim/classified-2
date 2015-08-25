<?php 
include "header.php";
require_once "../common/class/mysql.class.php";
require_once "../common/class/project.class.php";
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

function delete_project()
{
	checkBoxArr = getSelectedCheckboxValue(document.listproject.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Page Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="delete";
		return confirm("Are You Sure ?");
}

function block_project()
{
	checkBoxArr = getSelectedCheckboxValue(document.listproject.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Row Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="block";
		return confirm("Are You Sure ?");
}
function active_project()
{
	checkBoxArr = getSelectedCheckboxValue(document.listproject.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Row Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="active";
		return confirm("Are You Sure ?");
}
</script>


<?php  
$mysql=new mysql();
//$common = new common();
$project = new project("projects");
$table="projects";


?>

<table align="left" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#FFFFFF; font-size:16px;">
	
	
	<tr><td colspan="6" align="center" valign="middle">
    <table align="center" >
    <tr>
    <td><img src="images/listmain.png" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;List of Projects</td>
    </tr>
    </table>
	</td></tr>

<tr><td  colspan="6"><table width="100%"><tr><td>
<br />

<?php
$result = $project->getProjects();

?>

<form name="listproject" action="delete_project.php" method="post">
<input type="hidden" id="selectcheck"  name="selectcheck" />
<input type="hidden" id="type" name="type" value="" />
<table width="100%"><tr><td align="right" width="100%">
<?php
if(is_array($result))
{?>
<b><font color="red" size="2"> *Delete : this will delete there all data from the website </font></b><input type="submit" value="Active"  onclick="return active_project(); " /><input type="submit" value="Block"  onclick="return block_project(); " /><input type="submit" value="Delete" onclick="return delete_project(); " /></td></tr></table>
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 	

	<tr bgcolor="#3262bd">
		<td class="grey" align="center">Project Title</td>
		<td class="grey" align="center">Min. Budget</td>
		<td class="grey" align="center">Max. Budget</td>
		<td class="grey" align="center">Total Bids</td>
		<td class="grey" align="center">Status</td>
		<td class="grey" align="center">Create Time</td>
		
	<td class="grey" align="center">Active</td>
	
		
		<td class="grey" align="center" align="center"><input type="checkbox" name="allbox" onclick="CheckAll(document.listproject);" /></td>
	</tr>
	<? 
	

	foreach($result as $group_details)
		{
if($group_details['diff_days']<=0)
{
$time="<b style='color:green;'>Expired</b>";

}
else
{
$time="<b style='color:green;'>Open</b><br>".$group_details['diff_days']." Days left";
}
$bids=$project->countbid($group_details['id']);
		echo "<tr align='center' ";
		if($group_details['status']=="active")
		$status="<b style='color:green;'>Active</b>";
		else
		$status="<b style='color:red;'>Blocked</b>";
		
		$color=!$color;
		if($color)
			echo 'bgcolor="#ffffff"';
		else
			echo 'bgcolor="#e4ebfb"';
		echo ">
		
		
		<td>".$group_details['project_title']."</td>
		<td>".$group_details['min_budget']."</td>
		<td>".$group_details['max_budget']."</td>
	    <td>";
		if($bids>0){echo "<a href='bids_details.php?id=".$group_details['id']."'>".$bids."</a>";
		}
		else
		{
		echo $bids;
		}
		echo "</td>
		<td>".$time."</td>
		<td>".$group_details['created_time']."</td>
		<td>".$status."</td>
		
		<td align='center'><input type='checkbox' name='checkdel' value='".$group_details['id']."' /></td></tr>";
		
	}
}
else
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
		
		<td align='center'>No Projects Posted Yet</td></tr>";
}
	?>
</table>
</form>
      
</td></tr></table></td></tr></table>


<?php include "footer.php"; ?>