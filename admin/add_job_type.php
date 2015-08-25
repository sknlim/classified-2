<?php include "header.php";
require_once "../common/class/jobtype.class.php";
?>

<table align="center" width="100%">
<tr align="center">
<td align="center" bgcolor="#66CCFF">Add Job Type</td>
</tr>
</table>
<form name="frmaddjobtype" action="jobtype_management.php?wtdo=add_jobtype&type=<?php echo $_GET['type'];?>" method="post" onSubmit="if(validateForm(this)) return true; else return false;">


<div class="formRow" align="center">
				<span class="fieldName"><label for="tags"><strong>Name</strong></label></span>
				<span class="fieldVal"><input type="text" id="jobtype" name="jobtype" class="vldnoblank textWidth" />
                <span class="checkStatus"></span>            	
           </span>
		</div>
<div class="formRow" align="center">
				<input type="submit" value="ADD JOB TYPE">
                <span class="checkStatus"></span>            	
           </span>
		</div>
</form>



<?php include "footer.php";?>