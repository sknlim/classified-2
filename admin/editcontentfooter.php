<?php include "header.php";
include "../common/adminfunction.php"; ?>


<script language="javascript">

function IsNumeric(strString)
   //  check for valid numeric strings	
   {
   var strValidChars = "0123456789-";
   var strChar;
   var blnResult = true;

   if (strString.length == 0) return false;

   //  test strString consists of valid characters listed above
   for (i = 0; i < strString.length && blnResult == true; i++)
      {
      strChar = strString.charAt(i);
      if (strValidChars.indexOf(strChar) == -1)
         {
         blnResult = false;
         }
      }
   return blnResult;
   }

function wordcount(st)
    {
    var ar = st.split(" ");
   // alert(ar.length);
	var i=0;
    for(i=0;i<=ar.length-1;i++)
        {
        	if(ar[i].length>15)
			{
			//alert("Invalid Words");
			return false;
			}
        }
	return true;	
    }

function trim(sString)
{
while (sString.substring(0,1) == ' ')
{
sString = sString.substring(1, sString.length);
}
while (sString.substring(sString.length-1, sString.length) == ' ')
{
sString = sString.substring(0,sString.length-1);
}
return sString;
}




function checkall()
{
		if(trim(document.getElementById("headline").value)=="")
			{
				alert("Headline Missing...");
				document.getElementById("headline").focus();
				document.getElementById("headline").select();
				return false;
			}
		
		if(document.getElementById("headline").value.length>25)
			{
				alert("Headline should not exceed more than 25 characters");
				document.getElementById("headline").focus();
				document.getElementById("headline").select();
				return false;
			}

		if(trim(document.getElementById("content").value)=="")
			{
				alert("Content Missing...");
				document.getElementById("content").focus();
				document.getElementById("content").select();
				return false;
			}
		
		if(document.getElementById("content").value.length>255)
			{
				alert("Content should not exceed more than 255 characters");
				document.getElementById("content").focus();
				document.getElementById("content").select();
				return false;
			}

return true;
}


	
</script>
 <table align="center" >
    <tr>
    <td><img src="images/contentman.gif" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;Edit Content Manager Footer Block</td>
    </tr>
    </table>
<br /><br />
<?php
$cn=connectdb();
	if($_GET['action']!="" && $_GET['pageid']!="")
	{
	
	// action update type newpage
	if($_GET['action']=="update" )
		{
		$sqladd="UPDATE contentfooter set headline='".$_POST['headline']."',content='".$_POST['content']."' where id='".$_GET['pageid']."'"; 
		$linkadd=mysql_query($sqladd,$cn) or die("Error : ". mysql_error());
		echo "<script>alert('Menu Updated...');  window.location='contentfooter.php';</script>";
		}
	

	// edit page
	if($_GET['action']=="edit")
		{
	//	type check
			$sql4="select * from contentfooter where id='".$_GET['pageid']."'";
			$link4=mysql_query($sql4,$cn) or die("Error : ". mysql_error());
			$data=mysql_fetch_assoc($link4);
			
		?>	
				
	
			<form name="top" action="editcontentfooter.php?action=update&pageid=<?php echo $data['id']; ?>" method="post" onsubmit="return checkall();">
		<table border="0"  style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;color:#000000;" align="center">
		<tr bgcolor="#bcceff" height="25">
			<td  align="right" >Headline : </td>
			<td ><input type="text" value="<?php echo $data['headline']; ?>" name="headline" id="headline" /> </td>
		</tr>	
		<tr bgcolor="#bcceff" height="25">
			<td  align="right" >Content : </td>
			<td><textarea name="content" id="content" rows="7" cols="40"><?php echo $data['content']; ?></textarea></td>
		</tr>
        <tr bgcolor="#bcceff" height="25">
			<td  colspan="2" align="center" ><input type="submit" value="Update" /></td>
		</tr>

		</table>
		</form>	
			<?
			}
			
		}
	
disconnectdb($cn);	
?>		
		
<?php include "footer.php"; ?>