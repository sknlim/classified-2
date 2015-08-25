<?php 
include "header.php";
include "subheader.php";
?>
<div  style="width: 580px; margin-left: 50px;">
  <h3 class="heading">Post Service</h3>
  <div style="float: right; padding-bottom: 0; margin-bottom: 0;">Not a member? please <a href="signup.php">sign up</a> first</div>
  <form name="frmPostServices" method="post" onsubmit="if(validateForm(this)) startUpload('flashUpload');  return false;" action="ajax/service/postservice1.php">
    <?php include "post_login_form.php"; ?>
    <table class="tableDetails" cellpadding="4" width="100%" style="clear:both">
      <tr>
        <th width="125"><label for="title">Title</label></th>
        <td><input type="text" name="title" id="title" class="vldnoblank vistaStyle width250">
          <span class="checkStatus"></span></td>
      </tr>
      <tr class="fir">
        <th><label for="description">Description</label></th>
        <td><textarea name="description" style="height:100px;" id="description" class="vldnoblank vistaStyle width250"></textarea>
          <span class="checkStatus"></span></td>
      </tr>
      <tr>
        <th><label for="mobileorphone">Mobile/phone</label></th>
        <td><input type="text" name="mobileorphone" id="mobileorphone" class="vldnoblank vldnum vistaStyle width250">
          <span class="checkStatus"></span></td>
      </tr>
      <tr class="fir">
        <th><label for="description">State</label></th>
        <td><div id="div_subcategory">
            <!-- Ajax Load Sub Category -->
          </div></td>
      </tr>
      <tr>
        <th><label for="jobtype">Service Category</label></th>
        <td><?php
	$objservicetype= new subcategory("services_category");
	$jobservice=$objservicetype->getcategory();
	echo "<select class='jobtype' id='servicecategory' name=\"servicecategory\">";
	foreach($jobservice as $data)
	{
		echo "<option value='".$data['id']."'>".$data['name']."</option>";
	}
	echo "</select>";
?>
          <span class="checkStatus"></span> </td>
      </tr>
      <tr class="fir">
        <th>Upload Image File</th>
        <td><?php
				unset($_SESSION['photofilename']);
				require_once $_SERVER['DOCUMENT_ROOT']."/common/class/flashupload.class.php";
				$uploadObj = new flashUpload('flashUpload');
				$uploadObj->redirectLink="javascript:submitFormOnFloat(document.forms['frmPostServices']);";
				$uploadObj->uploadPath="http://".$_SERVER['HTTP_HOST']."/ajax/service/postservice.php";
				$uploadObj->filetypedesc="Image files";
				$uploadObj->vldnoblank=false;
				$objCommon=new common();
				$uploadObj->maxfilesize=$objCommon->getConfigValue("max_photo_upload_size");
				$uploadObj->writeCode();
				?></td>
      </tr>
    </table>
    <center>
      <input type="submit" value="SUBMIT" class="bigButton width180">
    </center>
  </form>
</div>
<script>loadAjax('/ajax/project/subcategory.php?id=1','div_subcategory'); </script>
<?php
include "subfooter.php";
include "footer.php";
?>
