<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";

$objuser=new user;
$objuser->checkLoginAjax();
$userdata=$objuser->getbyid($_GET['touserid']);


$objproject=new project;
$data=$objproject->getdetails($_GET['pid']);

?>

<form method="post" action="ajax/project/review.php" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;">
<input type="hidden" name="projectid" value="<?php echo $_GET['pid']; ?>" >
<table width="100%">
<tr>
<td width="30%"></td>
<td width="70%"></td>
</tr>


<tr>
    <td><strong>Review to User</strong></td>
    <td><input name="username" value="<?php echo $userdata['username']; ?>" readonly="readonly" type="text"></td>
    <input type="hidden" name="userid" value="<?php echo $_GET['touserid']; ?>">
</tr>


<tr>
	<td><strong>Review for Project: </strong></td><td><big><b><?php echo $data['project_title']; ?></b></big></td>
</tr>    

<tr>
<td><strong>Points</strong></td>
<td><select name="points" class="vldnoblank">
	<?php
	for($i=1;$i<=10;$i++)
	echo "<option value='".$i."'>".$i."</option>";
	?>
	</select>
<span class="checkStatus"></span> 
</td>
</tr>

<tr>
<td><strong>Review</strong></td>
<td><textarea rows="8" name="details" cols="52" onkeydown="textCounter(this.form.details,this.form.textbox,500);" onkeyup="textCounter(this.form.details,this.form.textbox,500);"></textarea>
<input readonly="readonly" name="textbox" size="3" maxlength="3" value="500" tabindex="500" type="text"> characters left.
</td>
</tr>

<tr>
<td colspan="2" align="center">
<input value="Submit Review" name="submit" type="submit">
</td>
</tr>
</table>

</form>