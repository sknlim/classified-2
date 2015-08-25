<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";

$objuser=new user;
$objuser->checkLoginAjax();

$objproject=new project;
$data=$objproject->getdetails($_GET['pid']);
?>

<form method="post" action="ajax/project/placebid.php" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;">
<input type="hidden" name="projectid" value="<?php echo $_GET['pid']; ?>" >
<table width="100%">
<tr>
<td width="30%"></td>
<td width="70%"></td>
</tr>
<tr>
	<td colspan="2"><big><b>Bid on Project: <?php echo $data['project_title']; ?></b></big></td>
</tr>    

<tr>
<td colspan="2"><strong>Your bid details for the total project:</strong><br>
<small>(Project budget is $ <?php echo $data['min_budget']."-".$data['max_budget']; ?>)</small></td>
</tr>

<tr>
<td><strong>Bid Amount</strong></td><td>$<input name="bidamount" value="" maxlength="6" size="6" type="text" class="vldnum vldnoblank">
<span class="checkStatus"></span> 
</td>
</tr>

<tr>
<td><strong>In how many days can you deliver a completed project?</strong></td>
<td><input name="days" value="" maxlength="3" size="5" type="text" class="vldnum vldnoblank"> Day(s)
<span class="checkStatus"></span> 
</td>
</tr>

<tr>
<td><strong>Provide the details of your bid (optional):</strong></td>
<td><textarea rows="8" name="details" cols="52" onkeydown="textCounter(this.form.details,this.form.textbox,500);" onkeyup="textCounter(this.form.details,this.form.textbox,500);"></textarea>
<input readonly="readonly" name="textbox" size="3" maxlength="3" value="500" tabindex="500" type="text"> characters left.
</td>
</tr>

<tr>
<td colspan="2">
<input name="notification" type="checkbox"> Notify me by e-mail if someone bids lower than me on this project.</td>
</tr>

<tr>
<td colspan="2">
<input value="Place Bid" name="submit" type="submit">
</td>
</tr>
</table>

</form>