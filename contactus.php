<?php 
include "header.php";
include "subheader.php";
?>
<script>
function show_form()
{
var type=document.getElementById('type').value;

if(type=="general")
{
hideDiv('div_username');
hideDiv('div_suspended');
showDiv('email_general');
document.forms['contactus'].elements['username'].className="";
document.forms['contactus'].elements['password'].className="";
document.forms['contactus'].elements['url'].className="";
document.forms['contactus'].elements['project_id'].className="";
document.forms['contactus'].elements['email'].className="vldemail vldnoblank";
}
else
{
showDiv('div_username');
showDiv('div_suspended');
hideDiv('email_general');
document.forms['contactus'].elements['username'].className="vldnoblank";
document.forms['contactus'].elements['password'].className="vldnoblank";
document.forms['contactus'].elements['project_id'].className="vldnum vldnoblank";
document.forms['contactus'].elements['url'].className="vldurl vldnoblank";
document.forms['contactus'].elements['email'].className="";
}

}
</script>
<?php 
  if($_GET['message']=="failed")
  {?>
<center>
  <strong>
  <font color="#CC0000" size="+1">
  Login Failed
  </font>
  </strong>
</center>
<br />
<?php }?>
<?php 
  if($_GET['message']=="Thanks")
  {?>
<center>
  <strong>
  <font color="#CC0000" size="+1">
 Thanks For Contacting us
  </font>
  </strong>
</center>
<br />
<?php }?>
  <h3 class="heading">Contact Us</h3><br />
<div style="clear:both; margin-left:20px;">
  <form name="contactus" method="post" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;" action="thankyou.php">
    <div id="div_basic">
      <table width="550">
        <tr valign="top">
          <td width="150"> Contact For : </td>
          <td>
          	<select name="type" id="type" class="vldnoblank" style="width:200px;" onchange="show_form();">
              <option value="">[Select Type]</option>
              <option value="general" >General</option>
              <option value="dispute">Dispute Resolution</option>
              <option value="cancel">Cancel Project</option>
              <option value="spam">Spam Posting</option>
            </select>
            <span class="checkStatus"></span> </td>
        </tr>
      </table>
    </div>
    <div id="div_username">
      <table width="550">
        <tr valign="top">
          <td width="150">Username : </td>
          <td><input type="text" name="username" style="width:300px;" /><span class="checkStatus"></span> </td>
        </tr>
        <tr valign="top">
          <td>Password : </td>
          <td><input type="password" name="password" style="width:300px;"/><span class="checkStatus"></span> </td>
        </tr>
      </table>
    </div>
	<div id="email_general">
	 <table width="550">
        <tr valign="top">
          <td width="150">Email : </td>
          <td><input type="text" name="email" id="email" style="width:300px;" /><span class="checkStatus"></span> </td>
        </tr>
     </table>
	</div>
    <div id="div_general">
      <table width="550">
        <tr valign="top">
          <td width="150">Subject:</td>
          <td><input type="text" name="subject" style="width:300px;" class="vldnoblank" />
            <span class="checkStatus"></span></td>
        </tr>
        <tr valign="top">
          <td>Description:</td>
          <td><textarea style="width:300px; height:150px;" id="description" name="description" class="vldnoblank"></textarea>
            <span class="checkStatus"></span></td>
        </tr>
      </table>
    </div>
    <div id="div_suspended">
      <table width="550">
        <tr valign="top">
          <td width="150" >Project ID : </td>
          <td><input type="text" name="project_id" id="project_id" style="width:300px;" /><span class="checkStatus"></span> </td>
        </tr>
        <tr valign="top">
          <td >URL : </td>
          <td><input type="text" name="url" id="url" style="width:300px;"/><span class="checkStatus"></span> </td>
        </tr>
      </table>
    </div>
   <center><input type="submit" name="submit" value="submit" /></center>
  </form>
</div>
<br /><br /><br /><br />
<center>
<h3><font color="red"><?php
		if($user_check->checklogin())
			echo '<a href="helpdesk.php" >';
		else
			echo '<a href="helpdesk.php" onclick="javascript:messageBox(\'Please Login \'); return false;">';
		?>Suspended Account - Click here</a></font></h3>
</center>
<?php
include "subfooter.php";
include "footer.php";
?>
