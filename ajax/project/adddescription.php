<?php require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php"; ?>
<form method="post" action="ajax/project/updatedescription.php" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;">
<input type="hidden" name="projectid" value="<?php echo $_GET['pid']; ?>" >
<?php
$objproject=new project;
$data=$objproject->getdetails($_GET['pid']);

?>
<table width="100%">
<tr>
<td width="30%"></td>
<td width="70%"></td>
</tr>
<tr>
	<td colspan="2"><big><b>Add More Description to : <?php echo $data['project_title']; ?></b></big></td>
</tr>    

<tr>
<td><strong>Description</strong></td>
<td><textarea name="description" value="" rows="10" cols="40" class="vldnoblank"></textarea>
<span class="checkStatus"></span> 
</td>
</tr>

<tr>
<td colspan="2" align="center"><input type="submit" value="Submit"></td>
</tr>

</table>
</form>