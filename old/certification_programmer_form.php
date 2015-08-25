<?php

?>
<link REL="STYLESHEET" TYPE="text/css" href="admin/style.css" Title="TOCStyle">
<script type="text/javascript">
function validemailid(text) 
	{
		return(/^([\w\.]+)\@([\w]+)\.([\w\.]+)$/.test(text.toString()));
	}
function validphone(phone)
	{
		return(/^[0-9]+$/.test(phone.toString()));
	}

function checkall()
	{
		document.getElementById("f1").className = "";
		document.getElementById("f_name").className = "";
		document.getElementById("f2").className = "";
		document.getElementById("u_id").className = "";
		document.getElementById("f3").className = "";
		document.getElementById("url").className = "";
		document.getElementById("f4").className = "";
		document.getElementById("p_email").className = "";
		document.getElementById("f5").className = "";
		document.getElementById("year_of_exp").className = "";
		
		if(document.getElementById("f_name").value=='')
			{
				alert("First Name Is Empty...!");
				document.getElementById("f1").className = "error";
				document.getElementById("f_name").className = "error_background";
				document.getElementById("f_name").focus();
				document.getElementById("f_name").select();
				return false;
			}
		if(document.getElementById("rb").checked==true)
			{
				if(document.getElementById("url").value=='http://' || document.getElementById("url").value=='')
					{
						alert("Website URL Field Is Empty...!");
						document.getElementById("f2").className = "error";
						document.getElementById("url").className = "error_background";
						document.getElementById("url").focus();
						return false;
					}
			}			
		if(document.getElementById("u_id").value=='')
			{
				alert("User Id Is Empty...!");
				document.getElementById("f3").className = "error";
				document.getElementById("u_id").className = "error_background";
				document.getElementById("u_id").focus();
				document.getElementById("u_id").select();
				return false;
			}
		if(!validemailid(document.getElementById("p_email").value))
			{
				alert("Primary Email Id Is Empty Or Invalid...!");
				document.getElementById("f4").className = "error";
				document.getElementById("p_email").className = "error_background";
				document.getElementById("p_email").focus();
				document.getElementById("p_email").select();
				return false;
			}
		if(!validphone(document.getElementById("year_of_exp").value))
			{
				alert("Year Of Experience Is Empty Or Invalid...!");
				document.getElementById("f5").className = "error";
				document.getElementById("year_of_exp").className = "error_background";
				document.getElementById("year_of_exp").focus();
				document.getElementById("year_of_exp").select();
				return false;
			}
	}
</script>

<h2 align="center">Certified Programmer Application Form</h2>
<table width="80%" border="0" align="center">
  <tr>
    <td align="right" width="30%">Status :</td>
    <td width="50%">
	<select name="subject" size="1">
		<option selected value="Certified Programmer Application">New Application</option>
		<option value="Certified Programmer Re-Application">Re Application (I was a 'Guaranteed Programmer')</option>
	</select>
	</td>
  </tr>
  <tr>
    <td align="right" width="30%" id="f1">Full Name :</td>
    <td width="50%"><input type="text" name="f_name" id="f_name" /></td>
  </tr>
  <tr>
    <td align="right" width="30%">Business Name: (optional) </td>
    <td width="50%"><input type="text" name="b_name" id="b_name" /></td>
  </tr>
  <tr>
    <td align="right" width="30%"><input type="checkbox" name="rb" id="rb" /></td>
    <td width="50%">This is a registered business name in my country.</td>
  </tr>
  <tr>
    <td align="right" width="30%" id="f2">Primary Business Website URL:  </td>
    <td width="50%"><input type="text" name="url" id="url" value="http://" /></td>
  </tr>
  <tr>
    <td align="right" width="30%" id="f3">Your User Id : </td>
    <td width="50%"><input type="text" name="u_id" id="u_id" /></td>
  </tr>
  <tr>
    <td align="right" width="30%" id="f4">Primary E-mail: </td>
    <td width="50%"><input type="text" name="p_email" id="p_email" /> (Not a free e-mail Account)</td>
  </tr>
  <tr>
    <td align="right" width="30%">Phone Number: (Optional)</td>
    <td width="50%"><input type="text" name="p_no" id="p_no" /></td>
  </tr>
  <tr>
    <td align="right" width="30%">Mobile Number: (Optional)</td>
    <td width="50%"><input type="text" name="m_no" id="m_no" /></td>
  </tr>
  <tr>
    <td align="right" width="30%">Fax Number: (Optional) </td>
    <td width="50%"><input type="text" name="fax_no" id="fax_no" /></td>
  </tr>
  <tr>
    <td align="right" width="30%" id="f5">Years of experience: </td>
    <td width="50%"><input type="text" name="year_of_exp" id="year_of_exp" /> (in programming)</td>
  </tr>
  <tr>
    <td align="right" width="30%">Number of jobs completed: (Optional) </td>
    <td width="50%"><input type="text" name="no_of_job_comp" id="no_of_job_comp" /> (on and off ScriptLance)</td>
  </tr>
  <tr valign="top">
    <td align="right" width="30%">Mailing Address:</td>
    <td width="50%"><textarea name="text_area" id="text_area" cols="20" rows="4"></textarea></td>
  </tr>
  <tr valign="top">
    <td align="right" width="30%">Other Contact Info: (Optional) </td>
    <td width="50%"><textarea name="text_area_other" id="text_area_other" cols="20" rows="4"></textarea></td>
  </tr>
  <tr valign="top">
    <td align="right" width="30%">Additional Information:  </td>
    <td width="50%"><textarea name="additional_info" id="additional_info" cols="20" rows="4"></textarea></td>
  </tr>
  <tr>
	<td align="right" width="30%"width="30%"><input type="checkbox" name="check" id="check"></td>
    <td width="50%">I have read the Certified Members Terms & Conditions and I agree to them.</td>
  </tr>
  <tr>
	<td colspan="2" align="center"><input type="button" value="Apply For Cerification" onclick="return checkall();"</td>
  </tr>
</table>
