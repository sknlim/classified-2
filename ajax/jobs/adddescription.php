<?php require_once $_SERVER['DOCUMENT_ROOT']."/common/class/jobs.class.php"; ?>
<form method="post" action="ajax/jobs/updatedescription.php" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;">
<input type="hidden" name="jobid" value="<?php echo $_GET['jid']; ?>" >
<?php
$objjob=new jobs;
$data=$objjob->get_job_by_id($_GET['jid']);

?>
<table width="100%">
<tr>
<td width="30%"></td>
<td width="70%"></td>
</tr>
<tr>
	<td colspan="2"><big><b>Add More Description to : <?php echo $data['title']; ?></b></big></td>
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