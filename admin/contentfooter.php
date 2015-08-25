<?php 
include "header.php";
require_once "../common/class/mysql.class.php";
require_once "../common/class/cms.class.php";
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

function deleteuser()
{
	checkBoxArr = getSelectedCheckboxValue(document.listpage.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Page Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
		return confirm("Are You Sure ?");
}
function deletepage()
{
	checkBoxArr = getSelectedCheckboxValue(document.listpage.checkdel);
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
function approvepage()
{
	checkBoxArr = getSelectedCheckboxValue(document.listpage.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Page Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="approve";
		return confirm("Are You Sure ?");
}
function blockpage()
{
	checkBoxArr = getSelectedCheckboxValue(document.listpage.checkdel);
	if (checkBoxArr.length == 0) 
 	{ 
	 alert("No Page Selected");  
	 return false;
	 }
	var arv = checkBoxArr.toString();
	document.getElementById('selectcheck').value=arv;
	document.getElementById('type').value="block";
		return confirm("Are You Sure ?");
}

</script>


<?php  
$mysql=new mysql();
//$common = new common();
$cms = new cms("cms_footer");
$table="cms";
if($_GET['wtdo']=='add_static_page')
	{
	$add=$cms->createpage($_POST['filename'],$_POST['menuname'],$_POST['title'],$_POST['metakeywords'],$_POST['metadescription'],$_POST['FCKeditor1']);
	}
if($_GET['wtdo']=='edit_page' && $_POST['category']!="")
	{
	$add=$cms->updatepage($_GET['id'],$_POST['filename'],$_POST['menuname'],$_POST['title'],$_POST['metakeywords'],$_POST['metadescription'],$_POST['FCKeditor1']);
	}
?>

<table align="left" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-weight:bold; color:#FFFFFF; font-size:16px;">
	
	
	<tr><td colspan="6" align="center" valign="middle">
    <table align="center" >
    <tr>
    <td><img src="images/listmain.png" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;List of Footer Pages</td>
    </tr>
    </table>
	</td></tr>

<tr><td  colspan="6"><table width="100%"><tr><td>
<br />

<?php
$result = $cms->getStaticPage();

?>
   <a href='add_cms_page.php'>ADD Page</a>
<form name="listpage" action="delete_static_page.php?action=delete" method="post">
<input type="hidden" id="selectcheck"  name="selectcheck" />
<input type="hidden" id="type" name="type" value="" />
<table width="100%"><tr><td align="right" width="100%">
<b><font color="red" size="2"> *Delete : this will delete there all data from the website </font></b><input type="submit" value="Block"  onclick="return blockpage(); " /><input type="submit" value="Approve"  onclick="return approvepage(); " /><input type="submit" value="Delete"  onclick="return deletepage(); " /></td></tr></table>
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:13px;"> 	
	<tr bgcolor="#3262bd">
		<td class="grey" align="center">Menu Name</td>
		<td class="grey" align="center">Title</td>
		<td class="grey" align="center">File Name</td>
		<td class="grey" align="center">Create Time</td>
		<td class="grey" align="center">Status</td>
		<td class="grey" align="center">Edit</td>
	
		
		<td class="grey" align="center" align="center"><input type="checkbox" name="allbox" onclick="CheckAll(document.listpage);" /></td>
	</tr>
	<? 
	
	if(is_array($result))
	{
	foreach($result as $group_details)
		{

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
		
		
		<td>".$group_details['menuname']."</td>
		<td>".$group_details['title']."</td>
		<td>".$group_details['filename']."</td>
	
		<td>".$group_details['createtime']."</td>
		<td>".$status."</td>
		<td><a href='edit_cms_page.php?id=".$group_details['id']."&tbl=cms_footer'>EDIT</a></td>
		
		<td align='center'><input type='checkbox' name='checkdel' value='".$group_details['id']."' /></td></tr>";
		
		}
	}
	else
		{
		echo "<tr align='center'><td colspan='7'>No Page!</td></tr>";
		}
	?>
</table>
</form>
   <a href='add_cms_page.php'>ADD Page</a>   
</td></tr></table></td></tr></table>


<?php include "footer.php"; ?>