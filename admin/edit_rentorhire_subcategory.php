<?php include "header.php";
require_once "../common/class/sub_rentorhire.class.php";
$sub_rentorhire=new sub_rentorhire();
?>

<table align="center" width="100%">
<tr align="center">
<td align="center" bgcolor="#66CCFF">Edit Rent or Hire Sub Category</td>
</tr>
</table>
<form name="frmaddcategory" action="rentorhire_sub_category.php?wtdo=edit_category&subid=<?php echo $_GET['id'];?>&id=<?php echo $_GET['cate_id'];?>" method="post" onSubmit="if(validateForm(this)) return true; else return false;">
<table align="center">
		<tr>
				<td><label for="tags"><strong>Category Name</strong></label></td>
				<td><?php echo $sub_rentorhire->get_name_category_id($_GET['id']);?>
                <span class="checkStatus"></span>           	
          		</td>
		</tr>

		<tr>
				<td><label for="tags"><strong>Sub Category Name</strong></label></td>
				<td><input type="text" id="subcategory" name="subcategory" class="vldnoblank textWidth" value="<?php echo $sub_rentorhire->get_name_subcategory_id($_GET['id']);?>" />
                <span class="checkStatus"></span>            	
         		 </td>
		</tr>
		<tr>
				<tr>
				<td>
				<input type="submit" value="Update Category">
                <span class="checkStatus"></span>            	
				</td>
			   </tr>
		</tr>
</table>
</form>



<?php include "footer.php";?>