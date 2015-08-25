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


function checkexternal()
{
	
		if(trim(document.getElementById("txtexmenuname").value)=="")
			{
				alert("External Menu Name Missing...");
				document.getElementById("txtexmenuname").focus();
				document.getElementById("txtexmenuname").select();
				return false;
			}

		if(trim(document.getElementById("txtexurl").value)=="")
			{
				alert("External URL Missing...");
				document.getElementById("txtexurl").focus();
				document.getElementById("txtexurl").select();
				return false;
			}
		if(!isValidURL(document.getElementById("txtexurl").value))	
		{
				alert("Invalid URL ...");
				document.getElementById("txtexurl").focus();
				document.getElementById("txtexurl").select();
		return false;
		}
return true;
}	



function checkinternal()
{
	var ans=true;
		if(trim(document.getElementById("txtinmenuname").value)=="")
			{
				alert("Internal Menu Name Missing...");
				document.getElementById("txtinmenuname").focus();
				document.getElementById("txtinmenuname").select();
				return false;
			}
		
		if(document.getElementById("indexmenu").value=="optselect")
		{
				alert("Select Index Menu ...");
				document.getElementById("indexmenu").focus();
				document.getElementById("indexmenu").select();
				return false;
					
		}
		else
		{
				switch (document.getElementById('indexmenu').value)
				{
						case "opttop":
						case "optleft":
						case "optbottom":
						case "optnews":
							if(document.getElementById("optmenu").value=="Select Menu")
							{
							alert("Select Menu ...");
							document.getElementById("optmenu").focus();
							ans=false;
							}
						break; 
						
						case "optservice":
							if(document.getElementById("servicesub").checked==true)
							{
								if(document.getElementById("optservicemenu").value=="Select Menu")
								{
								alert("Select Service Menu ...");
								document.getElementById("optservicemenu").focus();
								ans=false;
								}
							}
						
							if(document.getElementById("servicesub1").checked==true)
							{
								if(document.getElementById("optsubmenu").value=="Select Sub Menu")
								{
								alert("Select Service Sub Menu ...");
								document.getElementById("optsubmenu").focus();
								ans=false;
								}
								
							}
						
						break; 	
						
				}
				return ans;
				
		}
		
}	


function checkall()
{
		if(trim(document.getElementById("menuname").value)=="")
			{
				alert("Menu Name Missing...");
				document.getElementById("menuname").focus();
				document.getElementById("menuname").select();
				return false;
			}
		
		if(document.getElementById("menuname").value.length>15)
			{
				alert("Menu Name should not exceed more than 15 characters");
				document.getElementById("menuname").focus();
				document.getElementById("menuname").select();
				return false;
			}

		if(wordcount(document.getElementById("menuname").value)==false)
		{
				alert("Invalid Words in Menu Name ...");
				document.getElementById("menuname").focus();
				document.getElementById("menuname").select();
				return false;
		}
		
		if(trim(document.getElementById("pagetitle").value)=="")
			{
				alert("Page Title Missing...");
				document.getElementById("pagetitle").focus();
				document.getElementById("pagetitle").select();
				return false;
			}

		if(trim(document.getElementById("metadesc").value)=="")
			{
				alert("Meta Description Missing...");
				document.getElementById("metadesc").focus();
				document.getElementById("metadesc").select();
				return false;
			}

		if(trim(document.getElementById("metakeywords").value)=="")
			{
				alert("Meta Keywords Missing...");
				document.getElementById("metakeywords").focus();
				document.getElementById("metakeywords").select();
				return false;
			}


return true;
}


	function checkpriority()
	{
		/*for(i=1;i<=5;i++)
		{
			if(!IsNumeric(document.getElementById("priority_"+i).value))
			{
				alert("Priority must be Numeric ...");
				document.getElementById("priority_"+i).focus();
				document.getElementById("priority_"+i).select();
				return false;
			}
		}
*/
	return true;
	}

function showadd()
{
	document.getElementById('add_menu').style.display="block";
	document.getElementById('btnadd').style.display="none";
	document.getElementById('btncancel').style.display="block";
}

function canceladd()
{
	document.getElementById('add_menu').style.display="none";
	document.getElementById('btncancel').style.display="none";
	document.getElementById('btnadd').style.display="block";
}

function shownewpage()
{
	document.getElementById('div_newpage').style.display="block";
	document.getElementById('div_linkpage').style.display="none";
}

function showlinkpage()
{
	document.getElementById('div_newpage').style.display="none";
	document.getElementById('div_linkpage').style.display="block";
}


function showinternallink()
{
	document.getElementById('div_inlink').style.display="block";
	document.getElementById('div_exlink').style.display="none";
}

function showexternallink()
{
	document.getElementById('div_inlink').style.display="none";
	document.getElementById('div_exlink').style.display="block";
}

function showservicemenu()
{
//alert(document.getElementById("servicesub").checked);
	document.getElementById('div_servicemenu').style.display="block";
	document.getElementById('div_servicesubmenu').style.display="none";
	document.getElementById('txtspan').style.display="block";

//	document.getElementById('div_servicesubmenu').innerHTML="";
}


</script>
 <table align="center" >
    <tr>
    <td><img src="images/contentman.gif" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;Edit Content Manager</td>
    </tr>
    </table>
<br /><br />
<?php
$cn=connectdb();
	if($_GET['action']!="" && $_GET['pageid']!="")
	{
	
	// action update type newpage
	if($_GET['action']=="update" && $_GET['type']=="newpage")
		{
		$sqladd="UPDATE contentmanager set page_title='".seofilter_title(magicquotes($_POST['pagetitle']))."',meta_description='".seofilter_meta(magicquotes($_POST['metadesc']))."',meta_keywords='".seofilter_meta(magicquotes($_POST['metakeywords']))."',menu_name='".$_POST['menuname']."',page_tpl='".urlencode($_POST['FCKeditor1'])."' where id='".$_GET['pageid']."'"; 
		$linkadd=mysql_query($sqladd,$cn) or die("Error : ". mysql_error());
		echo "<script>alert('Menu Updated...');  window.location='contentmanager.php';</script>";
		}
	
	// action update type linkpage
	if($_GET['action']=="update" && $_GET['type']=="linkpage")
		{
		$sqladd="UPDATE contentmanager set menu_name='".magicquotes($_POST['txtexmenuname'])."',ex_url='".magicquotes($_POST['txtexurl'])."' where id='".$_GET['pageid']."'";
		$linkadd=mysql_query($sqladd,$cn) or die("Error : ". mysql_error());
		echo "<script>alert('Menu Updated...');   window.location='contentmanager.php';</script>";
		}
	
	
	// delete page
	
	
	if($_GET['action']=="delete")
		{
		$sql1="delete from contentmanager where id='".$_GET['pageid']."'";
		$link1=mysql_query($sql1,$cn) or die("Error : ". mysql_error());
		echo "<script>alert('Menu Deleted...'); window.location='contentmanager.php';</script>";
		}
	
	// block page 
	if($_GET['action']=="block")
		{
		$sql2="update contentmanager set block='1' where id='".$_GET['pageid']."'";
		$link2=mysql_query($sql2,$cn) or die("Error : ". mysql_error());
		echo "<script>alert('Menu Blocked...'); window.location='contentmanager.php';</script>";
		}
		
	if($_GET['action']=="unblock")
		{
		$sql3="update contentmanager set block='0' where id='".$_GET['pageid']."'";
		$link3=mysql_query($sql3,$cn) or die("Error : ". mysql_error());
		echo "<script>alert('Menu Unblocked...'); window.location='contentmanager.php';</script>";
		}	
	
	// edit page
	if($_GET['action']=="edit")
		{
	//	type check
			$sql4="select * from contentmanager where id='".$_GET['pageid']."'";
			$link4=mysql_query($sql4,$cn) or die("Error : ". mysql_error());
			$data=mysql_fetch_assoc($link4);
			
			if($data['page_type']=="linkpage")
			{
			// edit link page
			?>
			<form name="form_external" method="post" action="editcontentmanager.php?action=update&type=linkpage&pageid=<?php echo $data['id']; ?>" onsubmit="return checkexternal();">	
		<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold; color:#000000;">
		<tr bgcolor="#bcceff" height="25">
			<td align="right">Menu Name :</td>
			<td align="left"><input type="text" name="txtexmenuname" value="<?php echo $data['menu_name']; ?>" id="txtexmenuname" /></td>
		</tr>	
		<tr bgcolor="#bcceff" height="25">
			<td align="right">External URL :</td>
			<td align="left"><input type="text" name="txtexurl" value="<?php echo $data['ex_url']; ?>" id="txtexurl" />
			<font color="#000000">(Type exactly in this format eg. http://www.yahoo.com )</font></td>
		</tr>	
		<tr bgcolor="#bcceff" height="25" align="center">
			<td colspan="2" align="center"><input type="submit" name="btnexurl" value="Save Page" /></td>
		</tr>	
		</table>	
		</form>
			
			<?
				
			}
		
			if($data['page_type']=="newpage")
			{
			// edit new page
			?>
			<form name="top" action="editcontentmanager.php?action=update&type=newpage&pageid=<?php echo $data['id']; ?>" method="post" onsubmit="return checkall();">
		<table border="0" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;color:#000000;">
		<tr bgcolor="#bcceff" height="25">
			<td  align="right" >Menu Name : </td>
			<td ><input type="text" value="<?php echo $data['menu_name']; ?>" name="menuname" id="menuname" /> </td>
		</tr>	
		<tr bgcolor="#bcceff" height="25">
			<td  align="right" >Page Title : </td>
			<td><input type="text" value="<?php echo $data['page_title']; ?>" name="pagetitle"  id="pagetitle"/>  </td>
		</tr>
		<tr bgcolor="#bcceff" height="25">
			<td  align="right" >Meta Description: </td>
			<td><input type="text" value="<?php echo $data['meta_description']; ?>" name="metadesc" id="metadesc"/>  </td>
		</tr>
		<tr bgcolor="#bcceff" height="25">
			<td  align="right" >Meta Keywords : </td>
			<td><input type="text" value="<?php echo $data['meta_keywords']; ?>" name="metakeywords" id="metakeywords"/>  </td>
		</tr>
		<tr bgcolor="#bcceff" height="25">
			<td align="left" colspan="2" >Page Tpl : </td>
		</tr>
		<tr >	
			<td width="100%" colspan="2"><!--<textarea name="elm1" style="width:100%" rows="30"></textarea>--><?php 
				include("FCKeditor/fckeditor.php") ;
				$oFCKeditor = new FCKeditor('FCKeditor1');
				$oFCKeditor->Width  = '100%';
				$oFCKeditor->Height = '600';
				$oFCKeditor->BasePath = 'FCKeditor/';
				$oFCKeditor->Value = urldecode($data['page_tpl']);
				$oFCKeditor->Create();
				?>
			</td>
		</tr>
		<tr bgcolor="#bcceff" height="25">
			<td align="center" colspan="2" >	<input type="submit" name="submit" value="Save Page"  /></td>
		</tr>
		</table>
		</form>	
			<?
			}
			
		}
	
	
}
disconnectdb($cn);	
?>		


		
<?php include "footer.php"; ?>