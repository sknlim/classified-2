<?php
session_start();
$_SESSION['filename']="";
include "header.php"; 
include "subheader.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/display.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/maincategory.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/flashupload.class.php"; 
if($_GET['pid']!="")
{
$objproject=new project;
$projectdata=$objproject->getdetails($_GET['pid']);
//print_r($projectdata);
if($_SESSION['foongigs_userid']!=$projectdata['userid'])
header("Location: index.php");
?>

<div  style="width: 580px; margin-left: 50px;">
<h3 class="heading">Edit Project</h3>
<div style="float: right; padding-bottom: 0; margin-bottom: 0;">Not a member? please <a href="signup.php">sign up</a> first</div>
<form name="frmPostProject" action="ajax/project/editpostproject1.php" method="post" onsubmit="if(validateForm(this)) startUpload('flashUpload');  return false;">
<input type="hidden" value="<?php echo $_GET['pid']; ?>" name="projectid" />
<?php include "post_login_form.php"; ?>
  
  <table width="100%" class="tableDetails" cellpadding="4">
  	<tr>
    	<th width="140"><label for="title">Project Title</label></th>
        <td><input type="text" name="title" id="title" class="vldnoblank vistaStyle" style="width: 250px;" value="<?php echo $projectdata['project_title']; ?>">
    <span class="checkStatus"></span></td>
    </tr>
    <tr class="fir">
    	<th><label for="days">I want my project to stay open for bidding for </label></th>
        <td><input type="text" name="days" id="days" class="vldnum vldnoblank vistaStyle" style="width: 50px;" value="<?php echo $objproject->getduration($_GET['pid']); ?>" readonly="readonly"> Days<span class="checkStatus"></span><small><br />(Maximum 35 days. Set to 1 day to mark as urgent project.)</small></td>
    </tr>
    <tr>
    	<th valign="top"><label for="jobtype">Job Type</label></th>
        <td><textarea name="jobtype" id="jobtype" style="width: 400px; height: 100px;" class="vldnoblank"><?php echo $projectdata['jobtype']; ?></textarea>
    <span class="checkStatus"></span></td>
    </tr>
    <tr class="fir">
    	<th valign="top"><label for="description">Description</label></th>
        <td><small>note: Do not post any contact info (Review terms here...) </small>
    <textarea name="description" id="description" style="width: 400px; height: 180px;" class="vldnoblank"><?php echo $projectdata['description']; ?></textarea>
    <span class="checkStatus"></span></td>
    </tr>
   
    <tr>
     <th><label>Project Area  &nbsp;&nbsp;&nbsp;</label></th>
        <td><?php
	
		$category = new maincategory;
		$data = $category->getcategory();

		foreach($data as $row)
			{
		//	print_r($data);
			echo '<input name="maincategory" id="maincategory" value="'.$row['id'].'" type="radio"';
			$subcategory = $category->getsubcategory($row['id'] );
			
			if(is_array($subcategory))
				echo ' onclick="showDiv(\'subcategory\'); loadAjax(\'/ajax/project/editsubcategory.php?id='.$row['id'].'&selected='.$projectdata['sub_maincategory_id'].'\',\'div_subcategory\');" ';
			else
				echo ' onclick="hideDiv(\'subcategory\');" ';
				
				if($projectdata['maincategory_id']==$row['id'])
				echo "checked='checked'";
//			if(strtoupper($row['name'])=="USA") echo '"  checked="checked"';
	//		echo '> '.$row['name']." &nbsp;&nbsp;&nbsp;&nbsp;";
	echo '>'. $row['name']. "  &nbsp;&nbsp;&nbsp;&nbsp;";
			}
	
	
//		$project = new project();
	//	$project->display_category();
		?><span class="checkStatus"></span></td>
    </tr>
    
    <tr>
    	<th></th>
        <td> <div id="subcategory" style="display:<?php if($projectdata['maincategory_id']=="1") echo "block"; else echo "none"; ?>;">
    <table>
    <tr>
   		<th>
	    <label for="description">State  &nbsp;&nbsp;&nbsp;</label>
    	</th>
        <td>
        <div id="div_subcategory">
          <!-- Ajax Load Sub Category -->
        </div>
        <span class="checkStatus"></span>
  		</td>
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
    <td>
	<table>
    	<tr>	
        <th>Minimum $</th>
        <td><input type="text" name="min" id="min" class="vldnoblank  vistaStyle" style="width: 50px;" 
        value="<?php echo $projectdata['min_budget']; ?>"><span class="checkStatus"></span></td>
        </tr>
        <tr>
		<th>Maximum $</th>
        <td><input type="text" name="max" id="max" class="vldnoblank  vld_fld_greaterthaneq_min vistaStyle" style="width: 50px;" value="<?php echo $projectdata['max_budget']; ?>"/><span class="checkStatus"></span> </td>
        </tr>
	</table>
	</td>

    </tr>
    
    <?php
	if($objproject->hasfiles($_GET['pid']))
	{
	
	echo "<tr><td colspan='2'>List of Files associated with this project : <br>";
		$objproject->editfiles($_GET['pid']);
	echo "<td></tr>";	
	}
	?>
    
    <tr class="fir">
    <th valign="top">Upload Another</th>
    
    <td><?php
    unset($_SESSION['filename']);
    unset($_SESSION['tempfilename']);
    unset($_SESSION['filetype']);
    unset($_SESSION['filesize']);
    require_once $_SERVER['DOCUMENT_ROOT']."/common/class/flashupload.class.php";
    $uploadObj = new flashUpload('flashUpload');
    $uploadObj->redirectLink="javascript:submitFormOnFloat(document.forms['frmPostProject']);";
    $uploadObj->uploadPath="http://".$_SERVER['HTTP_HOST']."/ajax/project/editpostproject.php";
    $uploadObj->filetypedesc="All files";
    $uploadObj->vldnoblank=false;
    $objCommon=new common();
    $uploadObj->maxfilesize=$objCommon->getConfigValue("max_file_upload_size");
    $uploadObj->writeCode();
    ?></td>
    
    
    </tr>
       
    </table>
    
    
    <div class="lineBreakBig"></div>
    <center><input type="submit" value="SUBMIT" class="bigButton width180"></center>
    <div class="lineBreakBig"></div>
    
</form>
</div>
<?php // if($projectdata['maincategory_id']=="1") ?>
<script>loadAjax('/ajax/project/editsubcategory.php?id=1&selected=<?php echo $projectdata['sub_maincategory_id']; ?>','div_subcategory'); </script>

<?php
}
else
{
echo '<h3 class="subheading" style="clear:both;">Invalid Project Id</h3>';
}
?>
<?php include "footer.php"; ?>
<?php include "subfooter.php"; ?>
