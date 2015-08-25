<?php include "header.php"; ?>
<?php include "subheader.php"; ?>
<?php
session_start();

if($_SESSION['status']==false)
	{
		echo "<font color=red><b>Sorry..Login As A Webmaster For Posting Project..!</b></font>";
		exit();
	}
else
	{
		if(!usertype($_SESSION['username']))
			{
				echo "<font color=red><b>Sorry..Login As A Webmaster For Posting Project..!</b></font>";
				exit();
			}
		else
			{	

?>
<script src="textarea.js" type="text/javascript"></script>
<link href="textarea.css" rel="stylesheet" type="text/css">

<script type="text/javascript">

<!-- Ajax Function Start -->
function GetXmlHttpObject()
{
var XMLHttpRequestObject=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  XMLHttpRequestObject=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    XMLHttpRequestObject=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    XMLHttpRequestObject=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return XMLHttpRequestObject;
}


function post_project()
	{
		var checked=Array();
		var xy=0;
		for(var i=1;i<=42;i++)
			{
			if(document.getElementById(i).checked)
				{
					checked[xy]=document.getElementById(i).value;
					xy++;
				}
			}
		var title=document.getElementById("project_title").value;
		var days=document.getElementById("days").value;
		var discription=document.getElementById("desc").value;
		var min_bud=document.getElementById("minbud").value;
		var max_bud=document.getElementById("maxbud").value;
		var featured;
		var hide;
			if(document.getElementById("featured").checked==true)
				featured=1;
			else
				featured=0;	
			if(document.getElementById("hide").checked==true)
				hide=1;
			else
				hide=0;	
						
		 var checked = checked.toString();
		XMLHttpRequestObject=GetXmlHttpObject()
		var url="post_project.php"; // Sending Value on ajax1.php
		XMLHttpRequestObject.open("POST",url,true); // Opening ajax1.php file using http GET method...
		XMLHttpRequestObject.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		XMLHttpRequestObject.send("title="+title+"&days="+days+"&disc="+discription+"&min_bud="+min_bud+"&max_bud="+max_bud+"&feat="+featured+"&hide="+hide+"&array="+checked);
		// For Loding Image..
		document.getElementById("p_project").innerHTML="";
		var loadingImg = document.createElement('img');
		loadingImg.src = 'wait.gif';
		document.getElementById("p_project").appendChild(loadingImg);
		document.getElementById("p_project").ajaxInProgress = true;

		XMLHttpRequestObject.onreadystatechange = stateChanged; // On Change Of status call function stateChange() 
	}

function stateChanged() // Display data through innerHTML
	{ 
	if (XMLHttpRequestObject.readyState==4 && XMLHttpRequestObject.status==200 ) // Check Ready state 0 to 4(Ok)
		{ 
			document.getElementById("p_project").innerHTML="";
			document.getElementById("p_project").innerHTML=XMLHttpRequestObject.responseText;
			return false;
		}
	else
		{
		return (true);	
		}

	}	


<!-- Ajax Function End -->



function israte(rate)
	{
		return(/^[0-9]+$/.test(rate.toString()));
	}
function proj_disc(name)
	{
		return(/([a-zA-Z0-9])+$/.test(name.toString()));
	}
	
function enable_list()
	{
		if(document.getElementById("priv_list").disabled==true)
			{
				document.getElementById("priv_list").disabled=false;
				document.getElementById("chk1").disabled=false;
				document.getElementById("chk2").disabled=false;
			}
		else
			{
				document.getElementById("priv_list").disabled=true;
				document.getElementById("chk1").disabled=true;
				document.getElementById("chk2").disabled=true;
			}
	}		
function print_error(divid,errormessage)
	{

		for(var x=60; x<=66;x++)
			{
				document.getElementById(x).innerHTML="";
			}
		
		document.getElementById(divid).innerHTML="<? echo "<font color=red><b>"; ?>"+errormessage+"<? "</b></font>"; ?>";
	return (false);
	}

function checkall()
	{
		var mychecking=0;
		if(document.getElementById("project_title").value=='')
			{
				print_error('60',"Project Name Field Is Empty");
				document.getElementById("project_title").focus();
				document.getElementById("project_title").select();
				return false;
			}
		if(!israte(document.getElementById("days").value))
			{
				print_error('61',"Day Field Is Empty");
				document.getElementById("days").focus();
				document.getElementById("days").select();
				return false;
			}
		for(var i=1;i<=42;i++)
			{
			if(document.getElementById(i).checked)
				{
					mychecking=1;
					break;
				}
			}
		if(mychecking==0)
			{
				print_error('62',"Select Any One Job Type");
				document.getElementById("3").focus();
				return false;					
			}
		if(document.getElementById("desc").value=="")	
			{
				print_error("63","Discription Field Is Empty");
				document.getElementById("desc").focus();
				document.getElementById("desc").select();
				return false;
			}
<!--

var min_max_2 = new Spry.Widget.ValidationTextarea("min_max_2", {minChars:1, maxChars:1000, validateOn:["blur", "change"], counterType:"chars_remaining", counterId:"Counttextarea_max_chars2"});

//-->
		var name=document.getElementById("desc").value;
		if((name.match('@'.toString())))
			{
				alert("Email Id Are Not Allowed In Description...!");
				document.getElementById("desc").focus();
				document.getElementById("desc").select();
				return false;
			}
	
		if(!israte(document.getElementById("minbud").value))
			{	
				print_error('64',"Minimum Budget Is $5");
				document.getElementById("minbud").focus();
				document.getElementById("minbud").select();
				return false;
			}	
		if(document.getElementById("minbud").value < 5)
			{	
				print_error('64',"Minimum Budget Is $5");
				document.getElementById("minbud").focus();
				document.getElementById("minbud").select();
				return false;
			}					
		if(!israte(document.getElementById("maxbud").value))
			{	
				print_error('65',"Minimum Budget Is $5");
				document.getElementById("maxbud").focus();
				document.getElementById("maxbud").select();
				return false;
			}	
		if(document.getElementById("maxbud").value < 5)
			{	
				print_error('65',"Minimum Budget Is $5");
				document.getElementById("maxbud").focus();
				document.getElementById("maxbud").select();
				return false;
			}	
		if(document.getElementById("maxbud").value < document.getElementById("minbud").value)	
			{
				print_error('65',"Check Maximum Amount");
				document.getElementById("maxbud").focus();
				document.getElementById("maxbud").select();
				return false;
			}

post_project();			
	}

</script>
<div id="p_project">
<form method="POST" action="post_project.php" ENCTYPE="multipart/form-data" name="myform">
<table border="0" cellpadding="2" cellspacing="0" align="center" width="100%">
<tr>
	<th colspan="2" align="center">Post a Project ... !</th>
</tr>
<tr>
	<td width="30%" align="right">Project Name:</td><td width="30%"><input type="text" name="project_title" id="project_title"></td><td width="40%"><div id="60"></div></td>
</tr>
<tr>
	<td width="30%" align="right">Project is stay open for bidding for </td>
	<td width="30%"><input type="text" name="days" size="4" id="days"> days.</td>
	<td width="40%"><div id="61"></div></td>
</tr>
<tr>
	<td colspan="2" width="40%">Job Type: <div id="62"></div></td><TD></TD>
</tr>
<tr>




<?php
include "config.php";
$sql="SELECT * FROM `experts_area`";
$link=mysql_query($sql,$_SESSION['cn']) or die("Error :expert_field".mysql_error());
//echo "<table border=0>";
while($show=mysql_fetch_assoc($link))
	{
?>
		<tr>
		<td width="20%" align="left"><input type="checkbox" name="category[]" value="<? echo $show['id']; ?>" id="<? echo $show['id']; ?>" ><? echo $show['languages']; ?></td>
	<? $show=mysql_fetch_assoc($link); if($show != NULL) { ?>	
		<td width="20%"><input type="checkbox" name="category[]" value="<? echo $show['id']; ?>" id="<? echo $show['id']; ?>" ><? echo $show['languages']; ?></td>

	<? $show=mysql_fetch_assoc($link); if($show != NULL) { ?>	

			<td width="20%"><input type="checkbox" name="category[]" value="<? echo $show['id']; ?>" id="<? echo $show['id']; ?>" ><? echo $show['languages']; ?></td>
		</tr>
<?		
			}
		}
	}
//echo "</table>";	
?>




</tr>
<tr>
	<td valign="top" width="30%" align="right">Describe the project in detail:</td>
	<td width="30%">
	<span class="textareaRequiredState" id="min_max_2">
		<textarea autocomplete="off" rows="5" name="description" id="desc" cols="25"></textarea>
		<span id="Counttextarea_max_chars2" class="vishu">
		</span><br />
		<span class="textareaRequiredMsg">The value is Maximum 1000 Charactors...</span>
	</span>	
	</td>
	<td width="40%" valign="top"><div id="63"></div></td>
</tr>
<tr>
	<td colspan="3">Optional Project Details...</td>
</tr>
<tr>
	<td colspan="3">Project Budget (optional):</td>
</tr>
<tr>
	<td width="30%" align="right">Minimum: </td><td width="30%">$<input type="text" name="minbud" id="minbud" value="" size="5"></td>
	<td width="40%"><div id="64"></div></td>
</tr>
<tr>
  <td width="30%" align="right">Maximum: </td><td width="30%">$<input type="text" name="maxbud" id="maxbud" value="" size="5"></td>
  <td width="40%"><div id="65"></div></td>
</tr>
<tr>
	<td colspan="3"><input type="checkbox" name="featureds" id="featured">Make Project Featured $25 Fee</td>
</tr>
<tr>
	<td colspan="3"><input type="checkbox" name="hide_bids" id="hide">Hide Project Bids $1 Fee</td>
</tr>
<tr height="8"></tr>
<tr>
	<td valign="top" width="30%" align="left"><INPUT type="checkbox" value="1" name="make_private" onclick="enable_list();" > Make Project Private $1 Fee</td>
	<td width="30%">
		Private Invitation List :<br />
		<textarea rows="3" name="private_list" cols="25" id="priv_list" disabled="disabled"></textarea><br />
		<input type="checkbox" name="certified" id="chk1" disabled="disabled"> Invite All Certified Members<br />
		<input type="checkbox" name="certified" id="chk2" disabled="disabled"> Invite Top 15 Programmer<br />
	<td width="40%"><div id="66"></div></td>	
	</td>
</tr>
<tr height="20"></tr>
<tr>
	<td colspan="2" align="center"><input type="button" value="Submit Project" name="submit_proj" onclick="return checkall();"></td>
</tr>
</table>
<script type="text/javascript">
<!--

var min_max_2 = new Spry.Widget.ValidationTextarea("min_max_2", {minChars:1, maxChars:1000, validateOn:["blur", "change"], counterType:"chars_remaining", counterId:"Counttextarea_max_chars2"});
//-->
</script>

</form>
</div>

<?php
	}
}
?>
<?php include "subfooter.php"; ?>
<?php include "footer.php"; ?>       