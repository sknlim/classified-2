<?php include "header.php";
include "../common/adminfunction.php";
?>
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
		
		if(document.getElementById("menuname").value.length>25)
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
<?php
$cn=connectdb();
	if(isset($_GET['action'])=="add" && ($_GET['type']=="newpage"))
		{
		$sqladd="INSERT INTO contentmanager(page_title,meta_description,meta_keywords,menu_name,page_tpl,page_type) VALUES ('".seofilter_title(magicquotes($_POST['pagetitle']))."','".seofilter_meta(magicquotes($_POST['metadesc']))."','".seofilter_meta(magicquotes($_POST['metakeywords']))."','".magicquotes($_POST['menuname'])."','".urlencode($_POST['FCKeditor1'])."','newpage')";
		$linkadd=mysql_query($sqladd,$cn) or die("Error : ". mysql_error());
		echo "<script>alert('Menu Added...');  window.location='contentmanager.php';</script>";
		}
	
	if(isset($_GET['action'])=="add" && ($_GET['type']=="linkpage"))
		{
		$sqladd="INSERT INTO contentmanager(menu_name,ex_url,page_type) VALUES ('".magicquotes($_POST['txtexmenuname'])."','".magicquotes($_POST['txtexurl'])."','linkpage')";
		$linkadd=mysql_query($sqladd,$cn) or die("Error : ". mysql_error());
		echo "<script>alert('Menu Added...');   window.location='contentmanager.php';</script>";
		}
		
?>		

 <table align="center" >
    <tr>
    <td><img src="images/contentman.gif" /></td>
    <td style="color:#003399; font-family:Arial, Helvetica, sans-serif; font-weight:bold; font-size:18px;" align="center" valign="middle">
    &nbsp;&nbsp;Content Manager</td>
    </tr>
    </table>
<br /><br />

		
<table align="center" cellpadding="2" cellspacing="2" style=" font-weight:bold;color:#003399;"  width="100%" >
	<tr>
		<td width="100%" align="center">
		<input type="button" name="btnadd" value="Add Page" onclick="showadd();" id="btnadd" />
		</td>
	</tr>
	<tr>
		<td align="center" width="100%">
		<div id="add_menu" style="display:none; font-size:12px;">		
		<input type="button" name="btncancel" value="Cancel Menu" onclick="canceladd();" id="btncancel" />
		<input type="radio" name="pagetype" value="newpage"  onclick="shownewpage();"  /> New Page
		<input type="radio" name="pagetype" value="linkpage" onclick="showlinkpage();" /> Link Page				
		

		<div id="div_newpage" style="display:none;" >
		<form name="top" action="contentmanager.php?action=add&type=newpage" method="post" onsubmit="return checkall();">
		<table border="0" width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;color:#000000; font-weight:bold;">
		<tr bgcolor="#bcceff" height="25">
			<td  align="right" >Menu Name : </td>
			<td ><input type="text" value="" name="menuname" id="menuname" /> </td>
		</tr>	
		<tr bgcolor="#bcceff" height="25">
			<td  align="right" >Page Title : </td>
			<td><input type="text" value="" name="pagetitle"  id="pagetitle"/>  </td>
		</tr>
		<tr bgcolor="#bcceff" height="25">
			<td  align="right" >Meta Description: </td>
			<td><input type="text" value="" name="metadesc" id="metadesc"/>  </td>
		</tr>
		<tr bgcolor="#bcceff" height="25">
			<td  align="right" >Meta Keywords : </td>
			<td><input type="text" value="" name="metakeywords" id="metakeywords"/>  </td>
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
				$oFCKeditor->Create();
				?>
			</td>
		</tr>
		<tr bgcolor="#bcceff" height="25">
			<td align="center" colspan="2" >	<input type="submit" name="submit" value="Save Page"  /></td>
		</tr>
		</table>
		</form>	
		</div>


		<div id="div_linkpage" style="display:none;">
		
		<form name="form_external" method="post" action="contentmanager.php?action=add&type=linkpage" onsubmit="return checkexternal();">	
		<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold;">
		<tr bgcolor="#bcceff" height="25">
			<td align="right">Menu Name :</td>
			<td align="left"><input type="text" name="txtexmenuname" value="" id="txtexmenuname" /></td>
		</tr>	
		<tr bgcolor="#bcceff" height="25">
			<td align="right">External URL :</td>
			<td align="left"><input type="text" name="txtexurl" value="" id="txtexurl" />
			<font color="#000000">(Type exactly in this format eg. http://www.yahoo.com )</font>
			</td>
		</tr>	
		<tr bgcolor="#bcceff" height="25" align="center">
			<td colspan="2" align="center"><input type="submit" name="btnexurl" value="Save Page" /></td>
		</tr>	
		</table>	
		</form>
		</div>
	</div>
</td></tr>
</table>

<?php
$sql="select * from contentmanager order by priority ASC";
$link=mysql_query($sql,$cn) or die("Error : ". mysql_error());
$num=mysql_num_rows($link);
if($num>0)
{
?>
<form name="priority" action="setpriority.php" method="post" >
<table	width="100%" align="center" cellpadding="2" cellspacing="2" style="border:#1d6f23;"  >					
						<tr><td>
						<table width='100%' align='center' cellpadding='2' cellspacing='2' style="font-family:Arial, Helvetica, sans-serif; font-size:12px;">
						<tr bgcolor='#3262bd' height='25' style="font-weight:bold; color:#FFFFFF;" >
							<td  align='center'>Page Id</td>
							<td  align='center'>Edit</td>
							<td  align='center'>Delete</td>
							<td  align='center'>Block/Unblock</td>
							<td  align='center'>Status</td>
                            <td  align='center' class='black'>Priority</td>
							<td  align='center' class='black'>Menu Name</td>
							<td align='center' class='black'>Page Title</td>
							<td  align='center' class='black'>Meta Description</td>
							<td  align='center' class='black'>Meta Keywords</td>
							<td  align='center' class='black'>Page Type</td>

						
							</tr>
							<?php 
							
							$i=1;
							while ($data=mysql_fetch_assoc($link))
							{
							if($data['block']=='1') { $status="<b style=color:red;'>Blocked</b>"; } 
							else {  $status="<b style=color:green;'>Active</b>"; }  
							?>
							
                            
							<tr height='25'
                            <?php
							$color=!$color;
							if($color)
							echo 'bgcolor="#ffffff"';
							else
							echo 'bgcolor="#e4ebfb"';
							?>
                            >
							<td  align='center' >
							<?php echo $data['id']; ?>
							</td>
							<td  align='center'>
							<a href="editcontentmanager.php?action=edit&pageid=<?php echo $data['id']; ?>"><img src="images/edit.png" border="0" /></a>
							</td>
							<td  align='center'><a href="editcontentmanager.php?action=delete&pageid=<?php echo $data['id']; ?>" onclick="javascript: return confirm('Are You Sure to Delete This Page ?');"><img src="images/delete.png" border="0" /></a></td>
							<td  align='center'>
							<?php if($data['block']=='1') { ?>
							<a href="editcontentmanager.php?action=unblock&pageid=<?php echo $data['id']; ?>" onclick="javascript: return confirm('Are You Sure to Unblock This Page ?');"><img src="images/unblock.png" border="0" /></a>
							<? } else { ?>
							<a href="editcontentmanager.php?action=block&pageid=<?php echo $data['id']; ?>" onclick="javascript: return confirm('Are You Sure to Block This Page ?');"><img src="images/block.png" border="0" /></a>
							<? } ?>
							</td>
                            <td><?php echo $status; ?></td>
							<td  align='center' class='black'><input size="2" type="text" name="<? echo $data['id']; ?>" value="<? echo $i; ?>" id="priority_<?php echo $i; ?>" /></td>
							<td  align='center' class='black'><?php echo $data['menu_name']; ?></td>
							<?php
							if($data['page_type']=="linkpage")
							{
							?>
							<td align='center' class='black' colspan="3"><?php echo $data['ex_url']; ?></td>
							<? 
							} 
							else
							{
							?>
							<td align='center' class='black'><?php echo $data['page_title']; ?></td>
							<td  align='center' class='black'><?php echo $data['meta_description']; ?></td>
							<td  align='center' class='black'><?php echo $data['meta_keywords']; ?></td>
							<? 
							} 
							?>
							<td  align='center' class='black'><?php echo $data['page_type']; ?></td>
							</tr>

							<?	
							$i++;
							}						
							?>
							</table>
						<input type="submit"  value="Update Priority" name="priority" />
						</td></tr>
		</table>
		</form>
<? } 
disconnectdb($cn);
?>
				</td></tr>
				
					
			</table>
		</td>
	</tr>
</table>
		
<?php include "footer.php"; ?>