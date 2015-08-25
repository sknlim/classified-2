<?php 
include "header.php";
include "subheader.php";
?>
<?php
/*<script>
var checkboxarray=new Array();

function ischeckboxes()
{ 
	count=0;
	 for (i=0 ; i<checkboxarray.length ; i++)
	 { 
	    if (document.getElementById(checkboxarray[i]).checked)
	   	count++;
	 }    

 if(count==0)
 wrongStatus(document.getElementById('servicecategory'),"Select at least one");
 else
 
}
</script>*/ ?>
<?php
if($_GET['sid']!="")
{
$objservice=new service;
$service=$objservice->getbyid($_GET['sid']);
if($_SESSION['foongigs_userid']!=$service['userid'])
header("Location: index.php");
?>
<div  style="width: 580px; margin-left: 50px;">
<h3 class="heading">Edit Service</h3>
<div style="float: right; padding-bottom: 0; margin-bottom: 0;">Not a member? please <a href="signup.php">sign up</a> first</div>
<form name="frmPostServices" method="post" onsubmit="if(validateForm(this)) startUpload('flashUpload');  return false;" action="ajax/service/editpostservice1.php">
<input type="hidden" name="serviceid" value="<?php echo $_GET['sid']; ?>">
<?php include "post_login_form.php"; ?>
<table class="tableDetails" cellpadding="4" width="100%" style="clear:both">
	<tr>
    	<th width="125"><label for="title">Title</label></th>
        <td><input type="text" name="title" id="title" class="vldnoblank vistaStyle width250" value="<?php echo $service['title']; ?>"><span class="checkStatus"></span></td>
    </tr>
    <tr class="fir">
    	<th><label for="description">Description</label></th>
        <td><textarea name="description" style="height:100px;" id="description" class="vldnoblank vistaStyle width250" ><?php echo $service['description']; ?></textarea><span class="checkStatus"></span></td>
	</tr>
    <tr>
    	<th><label for="mobileorphone">Mobile/phone</label></th>
        <td><input type="text" name="mobileorphone" id="mobileorphone" class="vldnoblank vldnum vistaStyle width250" value="<?php echo $service['mobileorphone']; ?>"><span class="checkStatus"></span></td>
    </tr>
    <tr class="fir">
    	<th><label for="description">State</label></th>
        <td>
        <select id="state" name="state" style="width:200px;" class="vldnoblank">
        <option value="">Select One</option>
        		<?php
				
				$statelist=$objservice->getstatelist();
		
				foreach($statelist as $data)
				{
					echo "<option value='".$data['id']."'";
					if($data['id']==$service['subcategory'])
					echo "selected='selected'";
					echo ">".$data['name']."</option>";
				}
				
				?>
			</select><span class="checkStatus"></span>
        </td>
    </tr>
    <tr>
		<th><label for="jobtype">Service Category</label></th>
		<td><?php
$objservicetype= new subcategory("services_category");
$jobservice=$objservicetype->getcategory();
	echo "<select class='jobtype' id='servicecategory' name=\"servicecategory\">";
	foreach($jobservice as $data)
	{
		echo "<option value='".$data['id']."'";
		if($service['service_category']==$data['id'])
		echo "selected='selected'";
		echo ">".$data['name']."</option>";
		//$str.="checkboxarray.push('chk_".$data['id']."');\n";
	}
	echo "</select>";
?><span class="checkStatus"></span>
	</td>
   </tr>
   
     <?php
	if($objservice->hasfiles($_GET['sid']))
	{
	
	echo "<tr><td colspan='2'>List of image Files associated with this service : <br>";
	echo $objservice->editphotos($_GET['sid']);
	echo "<td></tr>";	
	}
	?>
   
   <tr class="fir">
   	<th>Upload Another Image File</th>
	<td><?php
				unset($_SESSION['photofilename']);
				require_once $_SERVER['DOCUMENT_ROOT']."/common/class/flashupload.class.php";
				$uploadObj = new flashUpload('flashUpload');
				$uploadObj->redirectLink="javascript:submitFormOnFloat(document.forms['frmPostServices']);";
				$uploadObj->uploadPath="http://".$_SERVER['HTTP_HOST']."/ajax/service/editpostservice.php";
				$uploadObj->filetypedesc="Image files";
				$uploadObj->vldnoblank=false;
				$objCommon=new common();
				$uploadObj->maxfilesize=$objCommon->getConfigValue("max_photo_upload_size");
				$uploadObj->writeCode();
				?></td>
    </tr>
</table>
<center><input type="submit" value="SUBMIT" class="bigButton width180"></center>
</form>
</div>   

<?php
}
else
{
echo '<h3 class="subheading" style="clear:both;">Invalid Service Id</h3>';
}
?>
  
 
 
<!--<script>loadAjax('/ajax/project/subcategory.php?id=1','div_subcategory'); </script>-->
  <?php
include "subfooter.php";
include "footer.php";
?>

