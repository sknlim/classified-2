<?php include "header.php";
require_once "../common/class/category.class.php";
$category_class=new subcategory("maincategory");
$get_category=$category_class->getcategory_admin();
?>

<table align="center" width="100%">
<tr align="center">
<td align="center" bgcolor="#66CCFF">Add Sub Category</td>
</tr>
</table>
<form name="frmaddcategory" action="sub_category_management.php?wtdo=add_category" method="post" onSubmit="if(validateForm(this)) return true; else return false;">


	<div class="formRow" align="center">
				<span class="fieldName"><label for="tags"><strong>Sub Category Name</strong></label></span>
				<span class="fieldVal"><input type="text" id="subcategory" name="subcategory" class="vldnoblank textWidth" />
                <span class="checkStatus"></span>            	
           </span>
		</div>
	<div class="formRow" align="center">
				<span class="fieldName"><label for="tags"><strong>Select Category</strong></label></span>
				<span class="fieldVal">
					<select name="category" id="category"  class="vldnoblank bigTextBox" errormessage="Please select a valid Category">
					  <option value="" selected="selected">Select Category</option>
					  <?php
					   foreach($get_category as $category)
						  {
						  echo '<option value="'.$category['id'].'" >'.$category['name'].'</option>';
						  }
					  ?>
					</select>
                <span class="checkStatus"></span>            	
           </span>
		</div>
	<div class="formRow" align="center">
				<span class="fieldName"><label for="tags"><strong>Mark Bold</strong></label></span>
				<span class="fieldVal">
				<input name="markbold" id="yes" value="yes" type="radio"  checked="checked">
          Yes
          <input name="markbold" id="no" value="no" type="radio" >
          No 
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