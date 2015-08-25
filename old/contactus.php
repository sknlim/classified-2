<?php require_once "header.php"; ?>
<?php require_once "subheader.php"; ?>
<?php

?>
<script src="textarea.js" type="text/javascript"></script>
<link href="textarea.css" rel="stylesheet" type="text/css">
<link href="admin/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
<!--

function validemail(text) //function that checks weather the given value is valid it returns true if it is valid other wise false and alerts  is
	{
		return(/^([\w\.]+)\@([\w]+)\.([\w\.]+)$/.test(text.toString()));
	}
function onlyno(no)
	{
		return(/^[0-9]+$/.test(no.toString()));
	}

function checkall()
	{
		if(document.getElementById("contact_for").value == "Select Below")
			{
				alert("Select From Contact For...!");
				document.getElementById("contact_for").focus();
				return false;
			}
		if(document.getElementById("contact_user").value == '' && document.getElementById("contact_for").value!="Violations")
			{
				alert("User Name Is Empty...!");
				document.getElementById("contact_user").focus();
				document.getElementById("contact_user").select();
				return false;
			}
		if(document.getElementById("contact_password").value == '' && document.getElementById("contact_for").value!="Violations")
			{
				alert("Password Field Is Empty...!");
				document.getElementById("contact_password").focus();
				document.getElementById("contact_password").select();
				return false;
			}
		if(!validemail(document.getElementById("contact_email").value) && document.getElementById("contact_for").value!="Violations")
			{
				alert("Valide Email Id Required...!");
				document.getElementById("contact_email").focus();
				document.getElementById("contact_email").select();
				return false;
			}
		if(!onlyno(document.getElementById("contact_project_id").value) && document.getElementById("contact_for").value=="Cancel")
			{
				alert("Project Id Is Empty Or Not A Numaric...!");
				document.getElementById("contact_project_id").focus();
				document.getElementById("contact_project_id").select();
				return false;
			}

		if(document.getElementById("v_user").value=='' && document.getElementById("contact_for").value=="Violations")
			{
				alert("User Id Of Other Person Is Empty...!");
				document.getElementById("v_user").focus();
				document.getElementById("v_user").select();
				return false;
			}
		if(document.getElementById("v_url").value=='http://' && document.getElementById("contact_for").value=="Violations")
			{
				alert("Check URL Field ..!");
				document.getElementById("v_url").focus();
				return false;
			}

		var name=document.getElementById("contact_us").value;
		if(name=='')
			{
				alert("Comment Required...!");
				document.getElementById("contact_us").focus();
				document.getElementById("contact_us").select();
				return false;
			}

var min_max_2 = new Spry.Widget.ValidationTextarea("min_max_2", {minChars:1, maxChars:500, validateOn:["blur", "change"], counterType:"chars_remaining", counterId:"Counttextarea_max_chars2"});

		var name=document.getElementById("contact_us").value;
		if((name.match('@'.toString())))
			{
				alert("Email Id Are Not Allowed In Description...!");
				document.getElementById("contact_us").focus();
				document.getElementById("contact_us").select();
				return false;
			}
//-->
	}
	
function selectoption(value)
	{
		document.getElementById("header").innerHTML=document.getElementById("contact_for").value;

		if(document.getElementById("contact_for").value=="Violations")
			{
			document.getElementById("o_user").innerHTML="(Optional)";
			document.getElementById("o_pass").innerHTML="(Optional)";
			document.getElementById("o_email").innerHTML="(Optional)";
			}
		else
			{
			document.getElementById("o_user").innerHTML="";
			document.getElementById("o_pass").innerHTML="";
			document.getElementById("o_email").innerHTML="";
			}
		
		if(document.getElementById("contact_for").value=="Cancel")
			document.getElementById("cancel").style.display="block";
		else
			document.getElementById("cancel").style.display="none";

		if(document.getElementById("contact_for").value=="Violations")
			document.getElementById("violations").style.display="block";
		else
			document.getElementById("violations").style.display="none";
	}	
</script>
<h3 align="center"><span>Contact Us Form</span></h3>
<form name="myForm" action="contactus_entery.php" method="post" enctype="multipart/form-data" >
<table border="0" width="60%" align="center">
	<tr>	
		<td align="right" width="20%">Contact For :</td>
		<td width="20%">
			<select name="select_for" id="contact_for" onchange="selectoption(this.value);">
				<option value="Select Below" selected="selected" >- - - - - - - Select Below - - - - - - -</option>
				<option value="New idea">New Idea to Impove</option>
				<option value="Ads on website">Advertisement on this Website</option>
				<option value="Broken link">Broken Link</option>
				<option value="Suggestion">Suggestion</option>
				<option value="Reporting">Report About Content to Remove</option>
				<option value="Cancel" >Cancel Project</option>
				<option value="Suspended Account">Suspended Account</option>
				<option value="Violations">Violations</option>																				
			</select>
		</td>
	</tr>
	<tr>	
		<td align="right" width="20%">User Id :</td>
		<td width="20%"><input type="text" name="contact_user" id="contact_user" /><span class="red" id="o_user"></span></td>
	</tr>
	<tr>	
		<td align="right" width="20%">Password :</td>
		<td width="20%"><input type="password" name="contact_password" id="contact_password" /><span class="red" id="o_pass"></span></td>
	</tr>
	<tr>	
		<td align="right" width="20%">Email Id :</td>
		<td width="20%"><input type="text" name="contact_email" id="contact_email" /><span class="red" id="o_email"></span></td>
	</tr>

<tr>
<td colspan="2" width="100%">
<div id="cancel" style="display:none;">	
	<table width="100%" align="center" border="0">
	<tr>	
		<td align="right">Project Id :</td>
		<td><input type="text" name="contact_project_id" id="contact_project_id" /></td>
	</tr>

	<tr>
		<td align="right">Reason for Cancellation: </td>
		<td>
		<select name="reason" size="1">
		<option selected value="Mutual agreement to cancel project.">Mutual agreement by both parties to cancel project.</option>
		<option value="Service rendered, payment NOT made.">Service rendered, payment NOT made.</option>
		<option value="Service NOT rendered.">Service NOT rendered.</option>
		<option value="No communication.">No communication (for over 3 business days).</option>
		<option value="Dispute over quality of service.">Dispute over quality of service.</option>
		<option value="Other">Other</option>
		</select>
		</td>
	</tr>
	<tr>
		<td align="right">Payment Status: </td>
		<td>
		<select name="payment" size="1">
		<option selected value="No payment issue.">No payment made, or payment was refunded.</option>
		<option value="Escrow was used.">An escrow payment was made.</option>
		<option value="Direct transfer made.">I sent/received money directly (without escrow).</option>
		</select>
		</td>
	</tr>
	</table>
</div>

<div id="violations" style="display:none;">	
	<table width="100%" align="center" border="0">
	<tr>
	<td align="right">Violation: </td>
	<td><select name="violation" size="1">
	<option selected value="Posting contact information">Posting contact information</option>
	<option value="Advertising another website">Advertising another website</option>
	<option value="Fake project posted">Fake project posted</option>
	
	<option value="Non-featured project posted requiring abnormal bidding">Non-featured project posted requiring abnormal bids</option>
	<option value="Other">Other</option>
	</select></td>
	</tr>
	<tr>
	<td align="right">User Id of other person: </td>
	<td><input type="text" name="v_username" id="v_user" size="20"></td>
	
	</tr>
	<tr>
	<td align="right">URL Link of Violation: </td>
	<td><input type="text" name="v_url" id="v_url" size="29" value="http://"></td>
	</tr>
	</table>
</div>

</td>
</tr>


	
	<tr height="150">	
		<td align="right" width="20%" valign="top">Comment :</td>
		<td width="20%" valign="top" align="">
		<span class="textareaRequiredState" id="min_max_2">
			<textarea autocomplete="off" name="contact_us" id="contact_us" cols="30" rows="5"></textarea>
			<span id="Counttextarea_max_chars2" class="vishu">
			</span><br />
			<span class="textareaRequiredMsg">The value is Maximum 500 Charactors...</span>
		</span>	
		</td>
	</tr>
	<tr>	
		<td colspan="2" align="center"><input type="submit" value="Submit" onclick="return checkall()" /></td>
	</tr>
<script type="text/javascript">
<!--

var min_max_2 = new Spry.Widget.ValidationTextarea("min_max_2", {minChars:1, maxChars:500, validateOn:["blur", "change"], counterType:"chars_remaining", counterId:"Counttextarea_max_chars2"});
//-->
</script>

</table>


<?php include "subfooter.php"; ?>
<?php include "footer.php"; ?>
