<?php include "header.php";

?>

<table  width="100%">
<tr align="center">
<td align="center" bgcolor="#66CCFF">Add Static Page</td>
</tr>
</table>
<form name="frmaddcategory" action="static_page_management.php?wtdo=add_static_page" method="post" onSubmit="if(validateForm(this)) return true; else return false;">
<table >
     <tr>
		 <td><label for="tags"><strong>Menu Name:</strong></label></td>
	 	 <td><input type="text" id="menuname" name="menuname" class="vldnoblank textWidth" />
                <span class="checkStatus"></span>            	
         </td>
	</tr>
		
	<tr>
				<td><label for="tags"><strong>File Name:</strong></label></td>
				<td><input type="text" id="filename" name="filename" class="vldnoblank textWidth" />
                <span class="checkStatus"></span>            	
    	        </td>
	</tr>
		
	<tr>
				<td><label for="tags"><strong>Title:</strong></label></td>
				<td><input type="text" id="title" name="title" class="vldnoblank textWidth" />
                <span class="checkStatus"></span>            	
         	    </td>
	</tr>
		
	<tr>
				<td><label for="tags"><strong>Meta Keywords:</strong></label></td>
				<td><input type="text" id="metakeywords" name="metakeywords" class="vldnoblank textWidth" />
                <span class="checkStatus"></span>            	
          	    </td>
	</tr>
		
	<tr>
				<td><label for="tags"><strong>Meta description:</strong></label></td>
				<td><input type="text" id="metadescription" name="metadescription" class="vldnoblank textWidth" />
                <span class="checkStatus"></span>            	
       		    </td>
	</tr>
		
	
	<tr><td><label for="tags"><strong>Content:</strong></label></td></tr>
	</table>
	<table>
	<tr>
				
				<td><?php 
				include("FCKeditor/fckeditor.php") ;
				$oFCKeditor = new FCKeditor('FCKeditor1');
				$oFCKeditor->Width  = '600';
				$oFCKeditor->Height = '600';
				$oFCKeditor->BasePath = 'FCKeditor/';
				$oFCKeditor->Create();
				?>
                <span class="checkStatus"></span>            	
       		    </td>
	</tr>
	
	<tr align="center">
				<td >
				<input type="submit" value="ADD PAGE">
                <span class="checkStatus"></span>            	
                </td> 
	</tr>
</table>
</form>



<?php include "footer.php";?>