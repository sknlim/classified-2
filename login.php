<?php session_start();
include "header.php"; ?>
<script language="javascript" src="js/login.js"></script>
<div class="box" style="width: 500px; margin-top: 20px; margin-left: 220px;">
<div style="margin-top: 10px; text-align: center; margin-bottom: 20px;">
<span class="textWith32px">Login!</span><img src="images/smiley.gif" style="vertical-align: middle;" />
</div>
<div style="width:500px; margin:0 auto;">
<form name="frmLogin" action="ajax/user/submit_login.php" method="post" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;">
<div class="formRow">
		<span class="fieldName"><label for="username">Username</label></span>
		<span class="fieldVal"><input type="text" name="username" id="username" class="vldnoblank vistaStyle width180">
		<span class="checkStatus"></span></span>
</div>
<div class="formRow">
		<span class="fieldName"><label for="username">Password</label></span>
		<span class="fieldVal"><input type="password" name="password" id="password" class="vldnoblank vistaStyle width180">
		<span class="checkStatus"></span></span>
</div>
	<div class="formRow mt mb">
                  	<span class="fieldName"></span>
				<span class="fieldVal"><input type="submit" value="Log In" class="bigButton width180">
				</span>
	</div>

</form>
</div>
</div>
<?php include "footer.php"; ?>