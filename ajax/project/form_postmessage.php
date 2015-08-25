<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";

$objuser=new user;
$objuser->checkLoginAjax();

$objproject=new project;
$data=$objproject->getdetails($_GET['pid']);

if($_SESSION['foongigs_usertype']=="seeker")
 {
 if($_GET['private']=="")
 $private="";
 else
 $private=$_GET['private'];
 }
else
$private=$objuser->getUserNameFromUserId($data['userid']);

?>

<form method="post" action="ajax/project/postmessage.php" name="frmPostMessage" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;">
<input type="hidden" name="projectid" value="<?php echo $_GET['pid']; ?>" >
<table width="100%">
<tr>
<td width="20%"></td>
<td ></td>
</tr>
<tr>
	<td colspan="2"><big><b>Post Message</b></big></td>
</tr>    

<tr>
	<td colspan="2"><b>Project: <?php echo $data['project_title']; ?></b></td>
</tr>    


<tr>
<td><strong>Message:</strong></td>
<td><textarea rows="8" name="details" class="vldnoblank" cols="52" ></textarea><span class="checkStatus"></span><br>
<small>Tip: You can post programming code by placing it within [code] and [/code] tags.</small> </td>
</tr>

<tr>
<td><strong>Private Post: (optional)</strong></td>
<td><input name="private" value="<?php echo $private; ?>" size="15" type="text"><span class="checkStatus"></span><br>
<small>If you want this message to only be seen by a specific person, enter their username here.<br>
They will be notified of your post. If you leave this blank everyone will be able to view your message.</small></td>
</tr>


<tr>
<td colspan="2" align="center">
<input value="Submit" name="submit" type="submit">
</td>
</tr>


</table>