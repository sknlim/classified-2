<?php 
if(!$user_check->checklogin())
{
?>
  <div class="formRowBig"><span class="fieldNamewithheader heading">Login Information</span></div>
  <div class="formRowBig"> <span class="fieldNameBig">
    <label for="username">Username</label>
    </span> <span class="fieldNameVal">
    <input type="text" name="username" id="username" class="vldnoblank vistaStyle width250">
    <span class="checkStatus"></span></span> </div>
  <div class="formRowBig"> <span class="fieldNameBig">
    <label for="password">Password</label>
    </span> <span class="fieldNameVal">
    <input type="password" name="password" id="password" class="vldnoblank vistaStyle width250">
    <span class="checkStatus"></span></span> </div>
  <div class="formRowBig"><span class="fieldNameBig"><small>(Tip: Read our project guidelines. They contain important suggestions to help you have a great experience at Foongigs.)</small></span></div>
<?php } ?>