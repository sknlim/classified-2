<?php 
include "header.php";
include "subheader.php";
?>
<?php
if($_GET['rid']!="")
{
$objrentorhire=new rentorhire;
$rentorhire=$objrentorhire->getbyid($_GET['rid']);
if($_SESSION['foongigs_userid']!=$rentorhire['userid'])
header("Location: index.php");
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

<h3 class="heading">Edit Rent or Hire</h3>

  <div style="float: right; padding-bottom: 0; margin-bottom: 0;">Not a member? please <a href="signup.php">sign up</a> first</div>
  
  <form name="frmPostRentOrHire" action="ajax/rentorhire/editpostrentorhire1.php" method="post" onsubmit="if(validateForm(this)) startUpload('flashUpload');  return false;">
  <input type="hidden" name="rentorhireid" value="<?php echo $_GET['rid']; ?>">
  <table class="tableDetails" width="100%" style="clear:both" cellpadding="4">
  <?php include "post_login_form.php"; ?>

	<tr>
        	<th width="150"><label for="description">State</label></th>
            <td><select id="state" name="state" style="width:200px;" class="vldnoblank">
        <option value="">Select One</option>
        		<?php
				
				$statelist=$objrentorhire->getstatelist();
		
				foreach($statelist as $data)
				{
					echo "<option value='".$data['id']."'";
					if($data['id']==$rentorhire['sub_maincategory_id'])
					echo "selected='selected'";
					echo ">".$data['name']."</option>";
				}
				
				?>
			</select><span class="checkStatus"></span>
      		</td>
        </tr>
        <tr class="fir">
        	<th><label for="description">Product Listing Category</label></th>
            <td>
			<select id="productcategory" name="productcategory" style="width:200px;" class="vldnoblank">
        <option value="">Select One</option>
        		<?php
				$categorylist=$objrentorhire->get_all_category();

				foreach($categorylist as $data)
				{
					echo "<option value='".$data['id']."'";
					if($data['id']==$rentorhire['product_category'])
					echo "selected='selected'";
					echo ">".$data['name']."</option>";
				}
				
				?>
			</select>
			<span class="checkStatus"></span></td>
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
        <td><input type="text" name="itemname" id="itemname" class="vldnoblank vistaStyle width250" value="<?php echo $rentorhire['name']; ?>"><span class="checkStatus"></span></td>
        </tr>
		<tr>
        	<th valign="top"><label for="description">Description</label></th>
            <td><textarea name="description" id="description" style="width: 400px; height: 180px;" class="vldnoblank"><?php echo $rentorhire['description']; ?></textarea><span class="checkStatus"></span></td>
      	</tr>
      	<tr class="fir">
			<th><label for="quantity">Quantity</label></th>
            <td><input type="text" name="quantity" id="quantity" class="vldnoblank vldnum vistaStyle" style="width: 50px;" value="<?php echo $rentorhire['quantity']; ?>"><span class="checkStatus"></span></td>
        </tr>
        <tr>
        	<th valign="top"><label>Charges On what basis will you charge ? </label></th>
            <td><input type="radio" name="chargetype" id="chargetimely"  value="timely" onclick="showDiv('div_chargetimely'); hideDiv('div_chargefixed');" <?php if($rentorhire['chargetype']=="timely") echo "checked='checked'"; ?>>
      <label for="chargetimely">Timely</label>
      <input type="radio" name="chargetype" id="chargefixed"  value="fixed" onclick="showDiv('div_chargefixed'); hideDiv('div_chargetimely');" <?php if($rentorhire['chargetype']=="fixed") echo "checked='checked'"; ?>>
      <label for="chargefixed">Fixed Rate</label><span class="checkStatus"></span>
      
      
    <div id="div_chargetimely" style="display:<?php if($rentorhire['chargetype']=="timely") echo "block"; else echo "none"; ?>; background:#EEE; border:1px solid #DDD">
    <table class="tableDetails" cellpadding="4">
    	<tr>
        	<th width="100"><input id="check_hour" name="check_hour" onclick="changetextstatus(this,'text_hour');" value="1" type="checkbox" <?php if($rentorhire['hire_period_hr']!="0") echo "checked='checked'"; ?>/>
            
            <input name="hidden_hour" value="0" type="hidden" /> <label for="check_hour">hour </label></th>
            
            <td>$ <input <?php if($rentorhire['hire_period_hr']=="0") echo "disabled='disabled'"; ?> id="text_hour" name="text_hour" size="30" value="<?php echo $rentorhire['hire_period_hr']; ?>" type="text" /></td>
        </tr>
       	<tr>
			<th><input id="check_4hour" name="check_4hour" onclick="changetextstatus(this,'text_4hour');" value="1" type="checkbox" <?php if($rentorhire['hire_period_4hr']!="0") echo "checked='checked'"; ?>/>
            
            <input name="hidden_4hour" value="0" type="hidden" /> <label for="check_4hour">4 hours </label></th>
            
            <td>$ <input <?php if($rentorhire['hire_period_4hr']=="0") echo "disabled='disabled'"; ?> id="text_4hour" name="text_4hour" size="30" value="<?php echo $rentorhire['hire_period_4hr']; ?>" type="text" /></td>
        </tr>
		<tr>
        	<th><input checked="checked" id="check_day" name="check_day" onclick="changetextstatus(this,'text_day');" value="1" type="checkbox" <?php if($rentorhire['hire_period_day']!="0") echo "checked='checked'"; ?>/>
            
            <input name="hidden_day" value="0" type="hidden" /> <label for="check_day">day </label></th>
            
            <td>$ <input  id="text_day" name="text_day" size="30" value="<?php echo $rentorhire['hire_period_day']; ?>" type="text" <?php if($rentorhire['hire_period_day']=="0") echo "disabled='disabled'"; ?>/></td>
		</tr>
        <tr>
        	<th><input id="check_week" name="check_week" onclick="changetextstatus(this,'text_week');" value="1" type="checkbox" <?php if($rentorhire['hire_period_week']!="0") echo "checked='checked'"; ?>/>
            
            <input name="hidden_week" value="0" type="hidden" /> <label for="check_week">week </label></th>
            
            <td>$ <input <?php if($rentorhire['hire_period_week']=="0") echo "disabled='disabled'"; ?> id="text_week" name="text_week" size="30" value="<?php echo $rentorhire['hire_period_week']; ?>" type="text" /></td>
        </tr>
        <tr>
        	<th><input id="check_fortnight" name="check_fortnight" onclick="changetextstatus(this,'text_fortnight');" value="1" type="checkbox" <?php if($rentorhire['hire_period_fortnight']!="0") echo "checked='checked'"; ?>/>
            
            <input name="hidden_fortnight" value="0" type="hidden" /> <label for="check_fortnight">fortnight </label></th>
            
            <td>$ <input <?php if($rentorhire['hire_period_fortnight']=="0") echo "disabled='disabled'"; ?> id="text_fortnight" name="text_fortnight" size="30" value="<?php echo $rentorhire['hire_period_fortnight']; ?>" type="text" /></td>
        </tr>
        <tr>
        	<th><input id="check_month" name="check_month" onclick="changetextstatus(this,'text_month');" value="1" type="checkbox" <?php if($rentorhire['hire_period_month']!="0") echo "checked='checked'"; ?> />
            
            <input name="hidden_month" value="0" type="hidden" /> <label for="check_month">month </label></th>
            
            <td>$ <input <?php if($rentorhire['hire_period_month']=="0") echo "disabled='disabled'"; ?> id="text_month" name="text_month" size="30" value="<?php echo $rentorhire['hire_period_month']; ?>" type="text" /></td>
		</tr>
      </table>
    </div>
    
    <div  id="div_chargefixed" style="display:<?php if($rentorhire['chargetype']=="fixed") echo "block"; else echo "none"; ?>; background:#EEE; border:1px solid #DDD;"> 
      	<table class="tableDetails">
        <tr>
        	<th><label for="asset_is_monthly_rate_used">Fixed rate</label></th>
            <td>$ <input id="text_fixed" name="text_fixed" size="30" type="text" value="<?php echo $rentorhire['fixed_rate']; ?>" /></td>
      	</tr>
        </table>
    </div>
    
    </td>
    </tr>
    <tr class="fir">
    <th><label for="quantity">Minimum Charge $ </label></th>
    <td><input id="minimum_charge" name="minimum_charge" size="30" type="text" value="<?php echo $rentorhire['minimum_charge']; ?>"/>
    <span class="checkStatus"></span></td>
    </tr>
      <?php
	if($objrentorhire->hasfiles($_GET['rid']))
	{
	
	echo "<tr><td colspan='2'>List of image Files associated with this Rent or Hire : <br>";
	echo $objrentorhire->editphotos($_GET['rid']);
	echo "<td></tr>";	
	}
	?>
    
    <tr>
    <th>Upload Image File</th>
	<td><?php
				unset($_SESSION['photofilename']);
				require_once $_SERVER['DOCUMENT_ROOT']."/common/class/flashupload.class.php";
				$uploadObj = new flashUpload('flashUpload');
				$uploadObj->redirectLink="javascript:submitFormOnFloat(document.forms['frmPostRentOrHire']);";
				$uploadObj->uploadPath="http://".$_SERVER['HTTP_HOST']."/ajax/rentorhire/editpostrentorhire.php";
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
<!--<script>loadAjax('/ajax/project/subcategory.php?id=1','div_subcategory'); </script>
<script>loadAjax('/ajax/rentorhire/subcategory.php?id=1','div_subcategoryproduct'); </script>-->
<?php
}
else
{
echo '<h3 class="subheading" style="clear:both;">Invalid Rent or Hire Id</h3>';
}
?>

<?php
include "subfooter.php";
include "footer.php";
?>

