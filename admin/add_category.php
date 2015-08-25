<?php include "header.php";
require_once "../common/class/category.class.php";
?>

<table align="center" width="100%">
<tr align="center">
<td align="center" bgcolor="#66CCFF">Add Category</td>
</tr>
</table>
<form name="frmaddcategory" action="category_management.php?wtdo=add_category&type=<?php echo $_GET['type'];?>" method="post" onSubmit="if(validateForm(this)) return true; else return false;">


<div class="formRow" align="center">
				<span class="fieldName"><label for="tags"><strong>Category Name</strong></label></span>
				<span class="fieldVal"><input type="text" id="category" name="category" class="vldnoblank textWidth" />
                <span class="checkStatus"></span>            	
           </span>
		</div>
<div class="formRow" align="center">
				<input type="submit" value="ADD CATEGORY">
                <span class="checkStatus"></span>            	
           </span>
		</div>
</form>



<?php include "footer.php";?>