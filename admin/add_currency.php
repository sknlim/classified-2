<?php include "header.php";
?>

<table align="center" width="100%">
<tr align="center">
<td align="center" bgcolor="#66CCFF">Add Currency</td>
</tr>
</table>
<form name="frmaddcategory" action="currency_management.php?wtdo=add_currency" method="post" onSubmit="if(validateForm(this)) return true; else return false;">

<table>
		<tr>
				<td><label for="tags"><strong>Name</strong></label></td>
				<td><input type="text" id="name" name="name" class="vldnoblank textWidth" />
                <span class="checkStatus"></span>            	
         		 </td>
		</tr>

		<tr>
				<td><label for="tags"><strong>Full Name</strong></label></td>
				<td><input type="text" id="fullname" name="fullname" style="width:300px;"  class="vldnoblank textWidth" />
                <span class="checkStatus"></span>            	
         		 </td>
		</tr>

		
		<tr>
			<td>	
				<input type="submit" value="Update Currency">
                <span class="checkStatus"></span>            	
           <td>
		</tr>
</form>



<?php include "footer.php";?>