<div style="width:500px; margin:0 auto; margin-top: 40px;">
<div style="font-family:'Trebuchet MS'; margin-bottom:10px; text-align:left">
  <h1>Forgot Password?</h1>
</div>
<div style="width:500px; margin:0 auto; background:#FFFFFF; text-align:center; border-top: 2px solid #CCC; border-bottom: 2px solid #CCC;">

<div class="content">
    <form name="frmforgot" method="POST" action="ajax/user/forgot.php" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;" class="formLeft">
      <div class="formRow">
        <label for="email">Enter your email</label>
        <input type="text" name="email" id="email" class="vldnoblank vldemail bigTextBox width250">
        <span class="checkStatus"></span> 
      </div>
      
       
      <div class="formRow">
        <input type="submit" value="Submit Request" style="width:200px; font-size:18px; padding:10px; color:#333333"/>
      </div>
     </form>
</div>
</div></div>