<?php include "header.php";
require_once "../common/class/configuration.class.php";
$configuration=new configuration();
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
<?php 



if($_GET['action']=="edit" && $_GET['cid']!="")
{

$data=$configuration->get_by_id($_GET['cid']);
//$num=mysql_num_rows($link);
?>

<table align="center" >
    <tr>
    <td><img src="images/configuration.png" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;Edit Configuration Value</td>
    </tr>
    </table>
<form name="configuration" action="configuration.php?wtdo=edit_variable&cid=<?php echo $_GET['cid']; ?>" method="post" onSubmit="if(validateForm(this)) { if(checkconfiguration()) return true; } else return false; ">

  <table>
    
		
	<tr>
				<td><label for="tags"><strong>Vriable Name:</strong></label></td>
				<td>
					<input type="text" id="var_name" value="<?php echo $data['variable']; ?>" name="var_name" class="textWidth"  />	
                <span class="checkStatus"></span>            	
           		</td>
	</tr>

		
	<tr>
				<td><label for="tags"><strong>Value:</strong></label></td>
				<td>
					 <?php 
if($_GET['type']=="number")
{
?>
        <input type="text" value="<?php echo $data['value']; ?>" name="value" id="value"/>
        <? } 
if($_GET['type']=="radio")
{
?>
        <input type="radio" value="yes" <?php if($data['value']=="yes") echo "checked='checked'"; ?> name="configvalueradio" id="configvalueradioyes"/>
        Yes
        <input type="radio" value="no" <?php if($data['value']=="no") echo "checked='checked'"; ?> name="configvalueradio" id="configvalueradiono"/>
        No
        <? } 
if($_GET['type']=="email")
{
?>
        <input type="text" value="<?php echo $data['value']; ?>" name="value" id="value"/>
        <? } 
if($_GET['type']=="string")
{
?>
        <textarea name="value" id="value" rows="20" cols="80"><?php echo $data['value']; ?></textarea>
        <? } 
if($_GET['type']=="")
{
?>
        <input type="text" value="<?php echo $data['value']; ?>" name="value" id="value"/>
        <? } ?>		
                <span class="checkStatus"></span>            	
           		</td>
	</tr>
	
	<tr>
				<td><label for="tags"><strong>Type:</strong></label></td>
				<td>
					<select name="type" id="type"  class="vldnoblank bigTextBox" errormessage="Please select a valid Type">
					  		  <option value="" selected="selected">Select Type</option>
						 	  <option value="number" <?php if($data['type']=="number"){?> selected="selected"<?php }?> >Number</option>
							  <option value="radio" <?php if($data['type']=="radio"){?> selected="selected"<?php }?>>Radio</option>
							  <option value="email" <?php if($data['type']=="email"){?> selected="selected"<?php }?>>Email</option>
							  <option value="string" <?php if($data['type']=="string"){?> selected="selected"<?php }?>>String</option>
					</select>	
                <span class="checkStatus"></span>            	
           		</td>
	</tr>
	
	
	<tr align="center">
				<td >
				<input type="submit" value="Update Variable">
                <span class="checkStatus"></span>            	
                </td> 
	</tr>
</table>
</form>
<?php
}
?>
