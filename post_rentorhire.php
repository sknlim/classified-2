<?php 
include "header.php";
include "subheader.php";
?>
<script>
	function loadsubcategory(obj)
	{
		loadAjax('/ajax/rentorhire/subcategory.php?id='+obj.value,'div_subcategoryproduct');
	}
	
	function changetextstatus(obj,id)
	{
		document.getElementById(id).disabled=!obj.checked;
		document.getElementById(id).value="0.0";
	}
	
</script>

<div  style="width: 580px; margin-left: 50px;" >

<h3 class="heading">Post for Rent or Hire</h3>

  <div style="float: right; padding-bottom: 0; margin-bottom: 0;">Not a member? please <a href="signup.php">sign up</a> first</div>
  
  <form name="frmPostRentOrHire" action="ajax/rentorhire/postrentorhire1.php" method="post" onsubmit="if(validateForm(this)) startUpload('flashUpload');  return false;">
  <table class="tableDetails" width="100%" style="clear:both" cellpadding="4">
  <?php include "post_login_form.php"; ?>


   
  <!--  <div class="formRowBig"> <span class="fieldNameBig">
      <label for="description">Area  &nbsp;&nbsp;&nbsp;</label>
      <?php
    $project = new project();
	$project->display_category();
	?>
      <span class="checkStatus"></span> </span> </div>-->
		<tr>
        	<th width="150"><label for="description">State</label></th>
            <td><div id="div_subcategory">
        <!-- Ajax Load Sub Category -->
      </div><span class="checkStatus"></span>
      		</td>
        </tr>
        <tr class="fir">
        	<th><label for="description">Product Listing Category</label></th>
            <td><?php
			$objrentorhire = new rentorhire();
			$objrentorhire->display_category();
			?><span class="checkStatus"></span></td>
        </tr>
       	<tr>
        <td>
      
      
      
    <div class="formRowBig" id="subcategoryproduct" style="display:block;"> 
    <span class="fieldNameBig">
     </span> </div>
     	</td>
        </tr>
        <tr class="fir">
        <th><label for="itemname">Item Name</label></th>
        <td><input type="text" name="itemname" id="itemname" class="vldnoblank vistaStyle width250"><span class="checkStatus"></span></td>
        </tr>
		<tr>
        	<th valign="top"><label for="description">Description</label></th>
            <td><textarea name="description" id="description" style="width: 400px; height: 180px;" class="vldnoblank"></textarea><span class="checkStatus"></span></td>
      	</tr>
      	<tr class="fir">
			<th><label for="quantity">Quantity</label></th>
            <td><input type="text" name="quantity" id="quantity" class="vldnoblank vldnum vistaStyle" style="width: 50px;"><span class="checkStatus"></span></td>
        </tr>
        <tr>
        	<th valign="top"><label>Charges On what basis will you charge ? </label></th>
            <td><input type="radio" name="chargetype" id="chargetimely"  value="timely" onclick="showDiv('div_chargetimely'); hideDiv('div_chargefixed');" checked="checked">
      <label for="chargetimely">Timely</label>
      <input type="radio" name="chargetype" id="chargefixed"  value="fixed" onclick="showDiv('div_chargefixed'); hideDiv('div_chargetimely');">
      <label for="chargefixed">Fixed Rate</label><span class="checkStatus"></span>
      
      
    <div id="div_chargetimely" style="display:block; background:#EEE; border:1px solid #DDD">
    <table class="tableDetails" cellpadding="4">
    	<tr>
        	<th width="100"><input id="check_hour" name="check_hour" onclick="changetextstatus(this,'text_hour');" value="1" type="checkbox"  /><input name="hidden_hour" value="0" type="hidden" /> <label for="check_hour">hour </label></th>
            <td>$ <input disabled="disabled" id="text_hour" name="text_hour" size="30" value="0.0" type="text" /></td>
        </tr>
       	<tr>
			<th><input id="check_4hour" name="check_4hour" onclick="changetextstatus(this,'text_4hour');" value="1" type="checkbox" /><input name="hidden_4hour" value="0" type="hidden" /> <label for="check_4hour">4 hours </label></th>
            <td>$ <input disabled="disabled" id="text_4hour" name="text_4hour" size="30" value="0.0" type="text" /></td>
        </tr>
		<tr>
        	<th><input checked="checked" id="check_day" name="check_day" onclick="changetextstatus(this,'text_day');" value="1" type="checkbox" /><input name="hidden_day" value="0" type="hidden" /> <label for="check_day">day </label></th>
            <td>$ <input  id="text_day" name="text_day" size="30" value="0.0" type="text" /></td>
		</tr>
        <tr>
        	<th><input id="check_week" name="check_week" onclick="changetextstatus(this,'text_week');" value="1" type="checkbox" /><input name="hidden_week" value="0" type="hidden" /> <label for="check_week">week </label></th>
            <td>$ <input disabled="disabled" id="text_week" name="text_week" size="30" value="0.0" type="text" /></td>
        </tr>
        <tr>
        	<th><input id="check_fortnight" name="check_fortnight" onclick="changetextstatus(this,'text_fortnight');" value="1" type="checkbox" /><input name="hidden_fortnight" value="0" type="hidden" /> <label for="check_fortnight">fortnight </label></th>
            <td>$ <input disabled="disabled" id="text_fortnight" name="text_fortnight" size="30" value="0.0" type="text" /></td>
        </tr>
        <tr>
        	<th><input id="check_month" name="check_month" onclick="changetextstatus(this,'text_month');" value="1" type="checkbox" /><input name="hidden_month" value="0" type="hidden" /> <label for="check_month">month </label></th>
            <td>$ <input disabled="disabled" id="text_month" name="text_month" size="30" value="0.0" type="text" /></td>
		</tr>
      </table>
    </div>
    
    <div  id="div_chargefixed" style="display:none; background:#EEE; border:1px solid #DDD;"> 
      	<table class="tableDetails">
        <tr>
        	<th><label for="asset_is_monthly_rate_used">Fixed rate</label></th>
            <td>$ <input id="text_fixed" name="text_fixed" size="30" value="0.0" type="text" /></td>
      	</tr>
        </table>
    </div>
    
    </td>
    </tr>
    <tr class="fir">
    <th><label for="quantity">Minimum Charge $ </label></th>
    <td><input id="minimum_charge" name="minimum_charge" size="30" type="text" />
    <span class="checkStatus"></span></td>
    </tr>
    <tr>
    <th>Upload Image File</th>
	<td><?php
				unset($_SESSION['photofilename']);
				require_once $_SERVER['DOCUMENT_ROOT']."/common/class/flashupload.class.php";
				$uploadObj = new flashUpload('flashUpload');
				$uploadObj->redirectLink="javascript:submitFormOnFloat(document.forms['frmPostRentOrHire']);";
				$uploadObj->uploadPath="http://".$_SERVER['HTTP_HOST']."/ajax/rentorhire/postrentorhire.php";
				$uploadObj->filetypedesc="Image files";
				$uploadObj->vldnoblank=false;
				$objCommon=new common();
				$uploadObj->maxfilesize=$objCommon->getConfigValue("max_photo_upload_size");
				$uploadObj->writeCode();
				?>
	</td>
    </tr>    
    
   </table>
	<div class="lineBreakBig"></div>
	<center><input type="submit" value="SUBMIT" class="bigButton width180"></center>
	<div class="lineBreakBig"></div>
  </form>
</div>
<script>loadAjax('/ajax/project/subcategory.php?id=1','div_subcategory'); </script>
<script>loadAjax('/ajax/rentorhire/subcategory.php?id=1','div_subcategoryproduct'); </script>
<?php
include "subfooter.php";
include "footer.php";
?>

