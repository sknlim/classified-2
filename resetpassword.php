<?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/subheader.php"; ?>

<?php
if($_GET['linkid']!="")
{
	$objuser=new user;
	if($objuser->verifyResetPasswordLink($_GET['linkid']))
	{
	
?>
<div style="width:500px; margin:0 auto; margin-top: 40px;">
<div style="font-family:'Trebuchet MS'; margin-bottom:10px; text-align:left">
  <h1>Reset your password</h1>
  <h3>Plaese Fill the details to reset your password.</h3>
</div>
<div style="width:500px; margin:0 auto; background:#FFFFFF; text-align:center; border-top: 2px solid #CCC; border-bottom: 2px solid #CCC;">

<div class="content">
<form name="frmResetPassword" method="POST" action="ajax/user/resetpassword.php" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;">
<input type="hidden" value="<?php echo $_GET['linkid']; ?>" name="linkid" id="linkid" />
	<div class="formRow">
		<span class="fieldName"><label for="password">Password</label></span>
		<span class="fieldVal"><input type="password" name="password" id="password" class="vldpass bigTextBox width250" ><br /><span class="checkStatus"></span>
    </span>
	</div>

     <div class="formRow">
		<span class="fieldName"><label for="retypepassword">Retype Password</label></span>
		<span class="fieldVal"><input type="password" name="retypepassword" id="retypepassword" class="vld_fld_equalto_password bigTextBox width250" ><br /><span class="checkStatus"></span></span>
	</div>

	<div class="formRow">
                  <input type="submit" value="Reset My Password" class="bigButton">
	</div>

</form>
</div>
<div id="divResetPassword">
</div>
<?php
}
else
{
echo "<h1 align='center'>Unable to verify the link id or password request link expired.. </h1>";
}
}
?>
<?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/subfooter.php"; ?>
