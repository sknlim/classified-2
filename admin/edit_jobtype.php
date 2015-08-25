<?php include "header.php";
require_once "../common/class/jobtype.class.php";
$jobtype=new jobtype($_GET['type']);
$name=$jobtype->getbyid($_GET['id']);
?>

<table align="center" width="100%">
<tr align="center">
<td align="center" bgcolor="#66CCFF">Edit Job Type</td>
</tr>
</table>
<form name="frmaddjobtype" action="jobtype_management.php?wtdo=edit_jobtype&id=<?php echo $_GET['id'];?>&type=<?php echo $_GET['type'];?>" method="post" onSubmit="if(validateForm(this)) return true; else return false;">


<div class="formRow" align="center">
				<span class="fieldName"><label for="tags"><strong>Name</strong></label></span>
				<span class="fieldVal"><input type="text" id="jobtype" name="jobtype" value="<?php echo $name;?>" class="vldnoblank textWidth" />
                <span class="checkStatus"></span>            	
           </span>
		</div>
<div class="formRow" align="center">
				<input type="submit" value="Update Job Type">
                <span class="checkStatus"></span>            	
           </span>
		</div>
</form>



<?php include "footer.php";?>