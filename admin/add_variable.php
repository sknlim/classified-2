<?php include "header.php";
require_once "../common/class/user.class.php";
?>
<script>
function validno(no)
	{
		return(/^[0-9]+$/.test(no.toString()));
	}

function validemailid(email)
	{
		//return(/^([\w\.]+)\@([\w]+)\.([\w\.]+)$/.test(email.toString()));
		return(/^[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9\.-]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$/.test(email.toString()));
	}

function checkconfiguration()
{
	switch(document.getElementById('formtype').value)
	{
		case "number":
			if(!validno(document.getElementById('configvaluenumber').value))
			{
			alert("Invalid Number..");	
			document.getElementById('configvaluenumber').focus();
			document.getElementById('configvaluenumber').select();
			return false;
			}
			else
			{
			return true;
			}	
		break;	
	
		case "email":
			if(!validemailid(document.getElementById('configvalueemail').value))
			{
			alert("Invalid Email..");
			document.getElementById('configvalueemail').focus();
			document.getElementById('configvalueemail').select();
			return false;
			}	
			else
			{
			return true;
			}
		break;	
		
		case "string":
			if(document.getElementById('configvaluestring').value=="")
			{
			alert("Value Missing..");
			document.getElementById('configvaluestring').focus();
			document.getElementById('configvaluestring').select();
			return false;
			}	
			else
			{
			return true;
			}
		break;	
	}
	
}


</script>
<table  width="100%">
<tr align="center">
<td align="center" bgcolor="#66CCFF">Add Variable</td>
</tr>
</table>
<form name="frmaddcategory" action="configuration.php?wtdo=add_variable" method="post" onSubmit="if(validateForm(this)) { if(checkconfiguration()) return true; } else return false; ">
<table>
    
		
	<tr>
				<td><label for="tags"><strong>Vriable Name:</strong></label></td>
				<td>
					<input type="text" id="var_name" name="var_name" class="textWidth"  />	
                <span class="checkStatus"></span>            	
           		</td>
	</tr>

		
	<tr>
				<td><label for="tags"><strong>Value:</strong></label></td>
				<td>
					<input type="text" id="value" name="value" class="textWidth"  />	
                <span class="checkStatus"></span>            	
           		</td>
	</tr>
	
	<tr>
				<td><label for="tags"><strong>Type:</strong></label></td>
				<td>
					<select name="type" id="type"  class="vldnoblank bigTextBox" errormessage="Please select a valid Type">
					  		  <option value="" selected="selected">Select Type</option>
						 	  <option value="number" >Number</option>
							  <option value="radio" >Radio</option>
							  <option value="email" >Email</option>
							  <option value="string" >String</option>
					</select>	
                <span class="checkStatus"></span>            	
           		</td>
	</tr>
	
	
	<tr align="center">
				<td >
				<input type="submit" value="ADD Variable">
                <span class="checkStatus"></span>            	
                </td> 
	</tr>
</table>
</form>



<?php include "footer.php";?>