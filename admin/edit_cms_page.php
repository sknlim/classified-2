<?php include "header.php";
require_once "../common/class/cms.class.php";
$cms=new cms("cms");
$get_page=$cms->getpage($_GET['id']);
?>

<table align="center" width="100%">
<tr align="center">
<td align="center" bgcolor="#66CCFF">Edit Static Page</td>
</tr>
</table>
<form name="frmaddcategory" action="static_page_management.php?wtdo=edit_page&id=<?php echo $_GET['id'];?>" method="post" onSubmit="if(validateForm(this)) return true; else return false;">
<table>
     <tr>
		 <td><label for="tags"><strong>Menu Name</strong></label></td>
	 	 <td><input type="text" id="menuname" name="menuname" class="vldnoblank textWidth" value="<?php echo $get_page['menuname'];?>" />
                <span class="checkStatus"></span>            	
         </td>
	</tr>
		
	<tr>
				<td><label for="tags"><strong>File Name</strong></label></td>
				<td><input type="text" id="filename" name="filename" value="<?php echo $get_page['filename'];?>" class="vldnoblank textWidth" />
                <span class="checkStatus"></span>            	
    	        </td>
	</tr>
		
	<tr>
				<td><label for="tags"><strong>Title</strong></label></td>
				<td><input type="text" id="title" name="title" value="<?php echo $get_page['title'];?>" class="vldnoblank textWidth" />
                <span class="checkStatus"></span>            	
         	    </td>
	</tr>
		
	<tr>
				<td><label for="tags"><strong>Meta Keywords</strong></label></td>
				<td><input type="text" id="metakeywords" name="metakeywords" value="<?php echo $get_page['meta_keywords'];?>" class="vldnoblank textWidth" />
                <span class="checkStatus"></span>            	
          	    </td>
	</tr>
		
	<tr>
				<td><label for="tags"><strong>Meta description</strong></label></td>
				<td><input type="text" id="metadescription" name="metadescription" value="<?php echo $get_page['meta_description'];?>" class="vldnoblank textWidth" />
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
				$oFCKeditor->Value=$get_page['content'];
				$oFCKeditor->Create();
				?>
                <span class="checkStatus"></span>            	
       		    </td>
	</tr>
	
	<tr align="center">
				<td >
				<input type="submit" value="UPDATE PAGE">
                <span class="checkStatus"></span>            	
                </td> 
	</tr>
</table>
</form>



<?php include "footer.php";?>