<?php include "header.php";
require_once "../common/class/category.class.php";
$category=new subcategory($_GET['type']);
$name=$category->getbyid($_GET['id']);
?>

<table align="center" width="100%">
<tr align="center">
<td align="center" bgcolor="#66CCFF">Edit Category</td>
</tr>
</table>
<form name="frmaddcategory" action="category_management.php?wtdo=edit_category&id=<?php echo $_GET['id'];?>&type=<?php echo $_GET['type'];?>" method="post" onSubmit="if(validateForm(this)) return true; else return false;">


<div class="formRow" align="center">
				<span class="fieldName"><label for="tags"><strong>Category Name</strong></label></span>
				<span class="fieldVal"><input type="text" id="category" name="category" value="<?php echo $name;?>" class="vldnoblank textWidth" />
                <span class="checkStatus"></span>            	
           </span>
		</div>
<div class="formRow" align="center">
				<input type="submit" value="Update CATEGORY">
                <span class="checkStatus"></span>            	
           </span>
		</div>
</form>



<?php include "footer.php";?>