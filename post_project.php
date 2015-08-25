<?php
session_start();
$_SESSION['filename']="";
include "header.php"; 
include "subheader.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/display.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/maincategory.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/flashupload.class.php"; 
?>
<script>

	function addcertified()
	{
		document.getElementById('span_status').innerHTML="Please Wait...";
		loadAjax('/ajax/project/addcertifiedmembers.php','div_privateinvite');
	}
	
	function enablecertified(id)
	{
		if(document.getElementById(id).checked)
		{
		document.getElementById('allcertifiedmember').disabled=false;
		document.getElementById('privateInvitaitonList').disabled=false;
		}
		else
		{
		document.getElementById('allcertifiedmember').disabled=true;
		document.getElementById('privateInvitaitonList').disabled=true;
	//	document.getElementById('privateInvitaitonList').value="";						
		}
	}
</script>

<div  style="width: 580px; margin-left: 50px;">
  <h3 class="heading">Post a New Project</h3>
  <div style="float: right; padding-bottom: 0; margin-bottom: 0;">Not a member? please <a href="signup.php">sign up</a> first</div>
    <form name="frmPostProject" method="post" onsubmit="if(validateForm(this)) startUpload('flashUpload');  return false;" action="ajax/project/postproject1.php">
    <?php include "post_login_form.php"; ?>
    <h3 class="subheading" style="clear:both;">Required Project Details...</h3>
    <div class="lineBreakBig"></div>
    <table width="100%" class="tableDetails" cellpadding="4">
      <tr>
        <th width="140"><label for="title">Project Title</label></th>
        <td><input type="text" name="title" id="title" class="vldnoblank vistaStyle" style="width: 250px;">
          <span class="checkStatus"></span></td>
      </tr>
      <tr class="fir">
        <th><label for="days">I want my project to stay open for bidding for </label></th>
        <td><input type="text" name="days" id="days" class="vldnum vldnoblank vistaStyle" style="width: 50px;">
          Days<span class="checkStatus"></span><small><br />
          (Maximum 35 days. Set to 1 day to mark as urgent project.)</small></td>
      </tr>
      <tr>
        <th valign="top"><label for="jobtype">Job Type</label></th>
        <td><textarea name="jobtype" id="jobtype" style="width: 400px; height: 100px;" class="vldnoblank"></textarea>
          <span class="checkStatus"></span></td>
      </tr>
      <tr class="fir">
        <th valign="top"><label for="description">Description</label></th>
        <td><small>note: Do not post any contact info (Review terms here...) </small>
          <textarea name="description" id="description" style="width: 400px; height: 180px;" class="vldnoblank"></textarea>
          <span class="checkStatus"></span></td>
      </tr>
      <tr>
        <th><label>Project Area  &nbsp;&nbsp;&nbsp;</label></th>
        <td><?php
		$project = new project();
		$project->display_category();
		?>
          <span class="checkStatus"></span></td>
      </tr>
      <tr>
        <th></th>
        <td><div id="subcategory" style="display:block;">
            <table>
              <tr>
                <th> <label for="description">State  &nbsp;&nbsp;&nbsp;</label>
                </th>
                <td><div id="div_subcategory">
                    <!-- Ajax Load Sub Category -->
                  </div>
                  <span class="checkStatus"></span> </td>
              </tr>
            </table>
          </div></td>
    </table>
    <div class="lineBreakBig"></div>
    <div class="lineBreakBig"></div>
    <h3 class="subheading">Optional Project Details...</h3>
    <div class="lineBreakBig"></div>
    <table class="tableDetails" width="100%" cellpadding="4">
      <tr>
        <th width="180" valign="top"><label for="min">Project Budget</label></th>
        <td><table>
            <tr>
              <th>Minimum $</th>
              <td><input type="text" name="min" id="min" class="vldnoblank  vistaStyle" style="width: 50px;">
                <span class="checkStatus"></span></td>
            </tr>
            <tr>
              <th>Maximum $</th>
              <td><input type="text" name="max" id="max" class="vldnoblank  vld_fld_greaterthaneq_min vistaStyle" style="width: 50px;" />
                <span class="checkStatus"></span> </td>
            </tr>
          </table></td>
      </tr>
      <tr class="fir">
        <th valign="top">Upload File</th>
        <td><?php
    unset($_SESSION['filename']);
    unset($_SESSION['tempfilename']);
    unset($_SESSION['filetype']);
    unset($_SESSION['filesize']);
    require_once $_SERVER['DOCUMENT_ROOT']."/common/class/flashupload.class.php";
    $uploadObj = new flashUpload('flashUpload');
    $uploadObj->redirectLink="javascript:submitFormOnFloat(document.forms['frmPostProject']);";
    $uploadObj->uploadPath="http://".$_SERVER['HTTP_HOST']."/ajax/project/postproject.php";
    $uploadObj->filetypedesc="All files";
    $uploadObj->vldnoblank=false;
    $objCommon=new common();
    $uploadObj->maxfilesize=$objCommon->getConfigValue("max_file_upload_size");
    $uploadObj->writeCode();
    ?></td>
      </tr>
      <tr>
        <th valign="top"><input type="checkbox" name="makeFeatured" id="makeFeatured" />
          <label for="makeFeatured"> Make Project Featured</label></th>
        <td><?php 
	$objcommon=new common;
	$fpf=$objcommon->getConfigValue('featured_project_fee');
	if ($fpf=="0")
	echo "Free";
	else
	echo "$".$fpf." Fee";
	?>
          <br />
          <small>Your project will appear longer on the main page and you will receive lower bids. This fee must be paid at time of posting project. Click here to read more about Featured projects.<br />
          <br />
          <span class="red">Note: Your project MUST be Featured if it requires bids in the form of hourly/monthly wages, per-item pricing, commissions, trades, etc.</span></small> </td>
      </tr>
      <tr class="fir">
        <th valign="top"><input type="checkbox" name="makePrivate" id="makePrivate" onclick="enablecertified(this.id);"/>
          <label for="makePrivate"> Make Project Private</label></th>
        <td><?php 
	$mpp=$objcommon->getConfigValue('private_project_fee');
	if ($mpp=="0")
	echo "Free";
	else
	echo "$".$mpp." Fee";
	?>
          <br />
          <small>You may limit your project to certain Programmers only. This option is free if your project is Featured or if you are a Certified Member.
          <ul style="padding: 10px;">
            <li>Only these Programmers will be able to view your project.</li>
            <li>We will notify them of your invitation.</li>
            <li>You may modify this invite list anytime.</li>
            <li>Your project's title and its category WILL be visible to the public.</li>
          </ul>
          <br />
          <br />
          
      
 
          <div id="div_privateinvite">
         Private Invitation List (one username per line):<span id="span_status" style="color:green; font-weight:bold;"></span>
          <textarea name="privateInvitaitonList" id="privateInvitaitonList" style="width: 300px; height: 80px;" disabled="disabled"></textarea>  </div>
          <input type="button" name="allcertifiedmember" id="allcertifiedmember" value="Add All Certified Members" style="height: 30px;" onclick="addcertified();" disabled="disabled"/>
          </small>
        
           </td>
      </tr>
      <tr>
        <th valign="top"><input type="checkbox" name="hideBid" id="hidebid" />
          <label for="hidebid"> Hide Bid</label></th>
        <td><?php 
	$hbf=$objcommon->getConfigValue('project_hide_bid_fee');
	if ($hbf=="0")
	echo "Free";
	else
	echo "$".$hbf." Fee";
	?>
          <br />
          <small>Only you will be able to view bids placed on your project. This option is free if your project is Featured or Private, or if you are a Certified Member.</small></td>
      </tr>
    </table>
    <div class="lineBreakBig"></div>
    <center>
      <input type="submit" value="SUBMIT" class="bigButton width180">
    </center>
    <div class="lineBreakBig"></div>
  </form>
</div>
<script>loadAjax('/ajax/project/subcategory.php?id=1','div_subcategory');</script>
<?php include "subfooter.php"; ?>
<?php include "footer.php"; ?>
