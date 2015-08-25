<?php include "header.php";
require_once "../common/class/category.class.php";
$category_class=new subcategory("sub_maincategory");

$sub_category=$category_class->get_category_by_id($_GET['id']);
$category_class=new subcategory("maincategory");
$get_category=$category_class->getcategory();
?>

<table align="center" width="100%">
<tr align="center">
<td align="center" bgcolor="#66CCFF">Edit Sub Category</td>
</tr>
</table>
<form name="frmaddcategory" action="sub_category_management.php?wtdo=edit_category&id=<?php echo $_GET['id'];?>" method="post" onSubmit="if(validateForm(this)) return true; else return false;">


<div class="formRow" align="center">
				<span class="fieldName"><label for="tags"><strong>Sub Category Name</strong></label></span>
				<span class="fieldVal"><input type="text" id="subcategory" name="subcategory" value="<?php echo $sub_category['name'];?>" class="vldnoblank textWidth" />
                <span class="checkStatus"></span>            	
           </span>
		</div>
		<div class="formRow" align="center">
				<span class="fieldName"><label for="tags"><strong>Category</strong></label></span>
				<span class="fieldVal">
					<select name="category" id="category"  class="vldnoblank bigTextBox" errormessage="Please select a valid Category">
					  <option value="" selected="selected">Select Category</option>
					  <?php
					   foreach($get_category as $category)
						  {
						  echo '<option value="'.$category['id'].'"';if($sub_category['category_id']==$category['id']){ echo 'selected="selected"';}echo ' >'.$category['name'].'</option>';
						  }
					  ?>
					</select>
                <span class="checkStatus"></span>            	
           </span>
		</div>
	<div class="formRow" align="center">
				<span class="fieldName"><label for="tags"><strong>Mark Bold</strong></label></span>
				<span class="fieldVal">
				<input name="markbold" id="yes" value="yes" type="radio" <?php if($sub_category['markbold']=="yes") {?> checked="checked"<?php }?>>
          Yes
          <input name="markbold" id="no" value="no" type="radio" <?php if($sub_category['markbold']=="no") {?> checked="checked"<?php }?>>
          No 
                <span class="checkStatus"></span>            	
           </span>
		</div>
<div class="formRow" align="center">
				<input type="submit" value="EDIT SUB CATEGORY">
                <span class="checkStatus"></span>            	
           </span>
		</div>
</form>



<?php include "footer.php";?>