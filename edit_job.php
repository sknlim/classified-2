<?php 
include "header.php";
include "subheader.php";
if($_GET['jid']!="")
{
$objjob=new jobs;
$job=$objjob->get_job_by_id($_GET['jid']);

if($_SESSION['foongigs_userid']!=$job['userid'])
header("Location: index.php");
?>
<div  style="width: 580px; margin-left: 50px;">
<h3 class="heading">Edit Job</h3>
<div style="float: right; padding-bottom: 0; margin-bottom: 0;">Not a member? please <a href="signup.php">sign up</a> first</div>
<form name="frmEditJobs" action="ajax/jobs/updatejobs.php" method="post" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;">
<input type="hidden" name="jobid" value="<?php echo $_GET['jid']; ?>">
<div>
 <?php include "post_login_form.php"; ?>

	<table class="tableDetails" width="100%" style="clear:both;" cellpadding="4">
    <tr>
		<th width="120">Required For</th>
        <td><input type="text" name="requiredfor" id="requiredfor" class="vldnoblank vistaStyle width250" value="<?php echo $job['title']; ?>"><span class="checkStatus"></span></td>
	</tr>
    <tr class="fir">
    	<th><label for="company">Company</label></th>
        <td><input type="text" name="company" id="company" class="vldnoblank vistaStyle width250" value="<?php echo $job['company']; ?>"> <span class="checkStatus"></span></td>
    </tr>
    <tr>
    	<th><label for="companyurl">Company URL</label></th>
        <td><input type="text" name="companyurl" id="companyurl" class="vldurl vistaStyle width250" value="<?php echo $job['company_url']; ?>">
    <span class="checkStatus"></span></td>
    </tr>
    <tr class="fir">
    	<th><label for="jobtype">Job Type</label></th>
        <td><?php
$objjobtype= new jobs;
$jobtype=$objjobtype->getalljobtypes();
	echo "<select class='jobtype' id='jobtype' name='jobtype'>";
	echo '<option value="">Select One</option>';
	foreach($jobtype as $data)
	{
		echo "<option value='".$data['id']."'"; 
		if($job['jobtype']==$data['id'])
		echo "selected='selected'";
		echo ">".$data['name']."</option>";
	}
	echo "</select>";
?><span class="checkStatus"></span>
    </td>
    </tr>
    <tr>
    	<th><label for="category">Category</label></th>
        <td><select id="category" name="category" class="vldnoblank">
    <option value="">Select One</option>
    <option value="employee" <?php if($job['category']=="employee") echo "selected='selected'"; ?>>Employee</option>
    <option value="temporary" <?php if($job['category']=="temporary") echo "selected='selected'"; ?>>Temporary</option>
    <option value="seasonal" <?php if($job['category']=="seasonal") echo "selected='selected'"; ?>>Seasonal</option>
    <option value="internship" <?php if($job['category']=="internship") echo "selected='selected'"; ?>>Internship</option>
    <option value="partnership" <?php if($job['category']=="partnership") echo "selected='selected'"; ?>>Partnership</option> 
    </select><span class="checkStatus"></span></td>
    </tr>
 
    
   <!-- <div class="formRowBig"> <span class="fieldNameBig">
    <label for="description">Location  &nbsp;&nbsp;&nbsp;</label>
    <?php
//    $project = new project();
//	$project->display_category();
	?>
    <span class="checkStatus"></span> </span> </div>-->

	<tr class="fir">
    	<th><label for="description">State  &nbsp;&nbsp;&nbsp;</label></th>
        <td>
        <select id="state" name="state" style="width:200px;" class="vldnoblank">
        <option value="">Select One</option>
        		<?php
				
				$statelist=$objjobtype->getstatelist();
		
				foreach($statelist as $data)
				{
					echo "<option value='".$data['id']."'";
					if($data['id']==$job['sub_maincategory_id'])
					echo "selected='selected'";
					echo ">".$data['name']."</option>";
				}
				?>
			</select><span class="checkStatus"></span>
        </td>
	</tr>
    
    <tr>
    	<th valign="top"><label for="title">Salary</label></th>
        <td><select id="salary_currency" name="salary_currency" style="width:200px;" class="vldnoblank">
                      		<option value="" >Currency type</option>
				<?php
				$objcurrency=new currency;
				$currency=$objcurrency->getall();
		
				foreach($currency as $data)
				{
					echo "<option value='".$data['id']."'";
					if($job['currency_id']==$data['id'])
					echo "selected='selected'";
					echo ">".stripslashes($data['full_name'])."</option>
					";
				}
				?>
			</select>
	
    <select id="salary_basis" name="salary_basis" class="vldnoblank">
        <option value="">Period</option>
        <option value="weekly" <?php if($job['salary_basis']=="weekly") echo "selected='selected'"; ?> >Weekly</option>
        <option value="monthly" <?php if($job['salary_basis']=="monthly") echo "selected='selected'"; ?>>Monthly</option>
        <option value="yearly" <?php if($job['salary_basis']=="yearly") echo "selected='selected'"; ?>>Yearly</option>
    </select><span class="checkStatus"></span><br />
    
        <table>
            <tr>
            <th>Minimum</th>
            <td>$<input type="text" name="salary_min" id="salary_min" class="vldnoblank vistaStyle" style="width: 50px;" value="<?php echo $job['salary_minimum']; ?>"><span class="checkStatus"></span></td>
            </tr>
            <tr>
            <th>Maximum</th>
            <td>$<input type="text" name="salary_max" id="salary_max" class="vldnoblank vld_fld_greaterthaneq_salary_min vistaStyle" style="width: 50px;" value="<?php echo $job['salary_maximum']; ?>"><span class="checkStatus"></span></td>
            </tr>
        </table>
	</td>
    </tr>
    <tr class="fir">
    	<th valign="top"><label for="jobdescription">Job Description</label></th>
        <td><textarea name="jobdescription" id="jobdescription" style="width: 400px; height: 180px;" class="vldnoblank"><?php echo $job['description']; ?></textarea><br />
    <span class="checkStatus"></span></td>
    </tr>
    <tr>
    	<th valign="top"><label for="jobcontactinfo">Job Contact Info</label></th>
        <td><textarea name="jobcontactinfo" id="jobcontactinfo" style="width: 400px; height: 180px;" class="vldnoblank"><?php echo $job['contact']; ?></textarea><br />
    <span class="checkStatus"></span></td>
    </tr>
</table>
   
<br />
   <div style="width:400px; margin:0 auto; border:1px solid #CCC; background:#FFF; padding:5px ">($39 will be deducted from your  account once you post your job. If you don't have enough funds in your account please make a deposit before continuing.)</div>
<div class="lineBreakBig"></div>
<center><input type="submit" value="SUBMIT" class="bigButton width180"></center>
</form>
</div>   

</div>
  
  <div class="lineBreakBig"></div>
 
 
<!--<script>loadAjax('/ajax/project/subcategory.php?id=1','div_subcategory'); </script>-->

<?php
}
else
{
echo '<h3 class="subheading" style="clear:both;">Invalid Job Id</h3>';
}
include "subfooter.php";
include "footer.php";
?>
