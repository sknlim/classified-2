<div style="width:500px; margin:0 auto; margin-top: 40px;">
<div style="font-family:'Trebuchet MS'; margin-bottom:10px; text-align:left">
  <h1>Change Password</h1>
</div>
<div style="width:500px; margin:0 auto; background:#FFFFFF; text-align:center; border-top: 2px solid #CCC; border-bottom: 2px solid #CCC; background:#EEE;">

<div class="content">
    <form name="frmChangePassword" method="POST" action="ajax/user/changepassword.php" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;" class="formLeft">
      <div class="formRow">
        <span class="fieldName"><label for="currentpassword">Current Password</label></span>
        <span class="fieldVal"><input type="password" name="currentpassword" id="currentpassword" class="vldnoblank vldpass bigTextBox width250" /> <span class="checkStatus"></span></span>
        
      </div>
      
      <div class="formRow">
		<span class="fieldName"><label for="newpassword">New Password</label></span>
		<span class="fieldVal"><input type="password" name="newpassword" id="newpassword" class="vldpass bigTextBox width250" ><span class="checkStatus"></span>
    </span>
	</div>

     <div class="formRow">
		<span class="fieldName"><label for="retypepassword">Retype New Password</label></span>
		<span class="fieldVal"><input type="password" name="retypepassword" id="retypepassword" class="vld_fld_equalto_newpassword bigTextBox width250" ><span class="checkStatus"></span></span>
	</div>

	<div class="formRow">
                 <span class="fieldVal"> <input type="submit" value="Change My Password" class="bigButton"></span>
	</div>
      
       
     
     </form>
</div>
</div></div>


