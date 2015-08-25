<?php include "header.php";
include "../common/adminfunction.php";
?>
<script>
function validno(no)
	{
		return(/^[0-9]+$/.test(no.toString()));
	}

function checklistphoto()
{
	if(!validno(document.getElementById('listphoto').value))
	{
	alert("Invalid Size..");
	document.getElementById('listphoto').focus();
	document.getElementById('listphoto').select();
	return false;
	}
	return true;
}

function checklistdiary()
{
	if(!validno(document.getElementById('listdiary').value))
	{
	alert("Invalid Size..");
	document.getElementById('listdiary').focus();
	document.getElementById('listdiary').select();
	return false;
	}
	return true;
}

function checkmessages()
{
	if(!validno(document.getElementById('messages').value))
	{
	alert("Invalid Size..");
	document.getElementById('messages').focus();
	document.getElementById('messages').select();
	return false;
	}
	return true;
}

function checkmydiary()
{
	if(!validno(document.getElementById('mydiary').value))
	{
	alert("Invalid Size..");
	document.getElementById('mydiary').focus();
	document.getElementById('mydiary').select();
	return false;
	}
	return true;
}

function checkmygallery()
{
	if(!validno(document.getElementById('mygallery').value))
	{
	alert("Invalid Size..");
	document.getElementById('mygallery').focus();
	document.getElementById('mygallery').select();
	return false;
	}
	return true;
}

function checkmyfriends()
{
	if(!validno(document.getElementById('myfriends').value))
	{
	alert("Invalid Size..");
	document.getElementById('myfriends').focus();
	document.getElementById('myfriends').select();
	return false;
	}
	return true;
}

function checkmymessages()
{
	if(!validno(document.getElementById('mymessages').value))
	{
	alert("Invalid Size..");
	document.getElementById('mymessages').focus();
	document.getElementById('mymessages').select();
	return false;
	}
	return true;
}

function checkmyblog()
{
	if(!validno(document.getElementById('myblog').value))
	{
	alert("Invalid Size..");
	document.getElementById('myblog').focus();
	document.getElementById('myblog').select();
	return false;
	}
	return true;
}

function checkmyfriendinvites()
{
	if(!validno(document.getElementById('myfriendinvites').value))
	{
	alert("Invalid Size..");
	document.getElementById('myfriendinvites').focus();
	document.getElementById('myfriendinvites').select();
	return false;
	}
	return true;
}

function checksearch()
{
	if(!validno(document.getElementById('search').value))
	{
	alert("Invalid Size..");
	document.getElementById('search').focus();
	document.getElementById('search').select();
	return false;
	}
	return true;
}


</script>

<?php 
$cn=connect_db();
switch($_GET['action'])
{
	case "listphoto":
	$sql="update paging set value='".$_POST['listphoto']."' where page='listphoto'";
	$link=mysql_query($sql,$cn);
	echo "<script>alert('Updated..');</script>";
	break;
	
	case "listdiary":
	$sql="update paging set value='".$_POST['listdiary']."' where page='listdiary'";
	$link=mysql_query($sql,$cn);
	echo "<script>alert('Updated..');</script>";
	break;
	
	case "messages":
	$sql="update paging set value='".$_POST['messages']."' where page='deletemessages'";
	$link=mysql_query($sql,$cn);
	echo "<script>alert('Updated..');</script>";
	break;
	
	case "mydiary":
	$sql="update paging set value='".$_POST['mydiary']."' where page='mydiary'";
	$link=mysql_query($sql,$cn);
	echo "<script>alert('Updated..');</script>";
	break;

	case "mygallery":
	$sql="update paging set value='".$_POST['mygallery']."' where page='mygallery'";
	$link=mysql_query($sql,$cn);
	echo "<script>alert('Updated..');</script>";
	break;
	
	case "myfriends":
	$sql="update paging set value='".$_POST['myfriends']."' where page='myfriends'";
	$link=mysql_query($sql,$cn);
	echo "<script>alert('Updated..');</script>";
	break;	
	
	case "mymessages":
	$sql="update paging set value='".$_POST['mymessages']."' where page='mymessages'";
	$link=mysql_query($sql,$cn);
	echo "<script>alert('Updated..');</script>";
	break;
	
	case "myblog":
	$sql="update paging set value='".$_POST['myblog']."' where page='myblog'";
	$link=mysql_query($sql,$cn);
	echo "<script>alert('Updated..');</script>";
	break;

	case "myfriendinvites":
	$sql="update paging set value='".$_POST['myfriendinvites']."' where page='myfriendinvites'";
	$link=mysql_query($sql,$cn);
	echo "<script>alert('Updated..');</script>";
	break;
	
	case "search":
	$sql="update paging set value='".$_POST['search']."' where page='search'";
	$link=mysql_query($sql,$cn);
	echo "<script>alert('Updated..');</script>";
	break;

}

	

?>
<?php

$sql="select * from paging where page='listphoto'";
$link=mysql_query($sql,$cn);
$data=mysql_fetch_assoc($link);
$listphoto=$data['value'];

$sql="select * from paging where page='listdiary'";
$link=mysql_query($sql,$cn);
$data=mysql_fetch_assoc($link);
$listdiary=$data['value'];

$sql="select * from paging where page='deletemessages'";
$link=mysql_query($sql,$cn);
$data=mysql_fetch_assoc($link);
$deletemessages=$data['value'];

$sql="select * from paging where page='mydiary'";
$link=mysql_query($sql,$cn);
$data=mysql_fetch_assoc($link);
$mydiary=$data['value'];

$sql="select * from paging where page='mygallery'";
$link=mysql_query($sql,$cn);
$data=mysql_fetch_assoc($link);
$mygallery=$data['value'];

$sql="select * from paging where page='myfriends'";
$link=mysql_query($sql,$cn);
$data=mysql_fetch_assoc($link);
$myfriends=$data['value'];

$sql="select * from paging where page='mymessages'";
$link=mysql_query($sql,$cn);
$data=mysql_fetch_assoc($link);
$mymessages=$data['value'];

$sql="select * from paging where page='myblog'";
$link=mysql_query($sql,$cn);
$data=mysql_fetch_assoc($link);
$myblog=$data['value'];

$sql="select * from paging where page='myfriendinvites'";
$link=mysql_query($sql,$cn);
$data=mysql_fetch_assoc($link);
$myfriendinvites=$data['value'];

$sql="select * from paging where page='search'";
$link=mysql_query($sql,$cn);
$data=mysql_fetch_assoc($link);
$search=$data['value'];

disconnect_db($cn);
?>

<form name="listphoto" action="pagemanagement.php?action=listphoto" method="post" onsubmit="return checklistphoto();">
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;" bgcolor="#FFFFFF">
<tr>
<td width="25%">List Photo Page Size: </td>
<td width="25%"><input type="text" value="" name="listphoto" id="listphoto"/> </td>
<td width="25%">(Current : <?php echo $listphoto; ?> Photos)</td>
<td width="25%"><input type="submit" value="Set Value" />
</td>
</tr>
</table>
</form>

<form name="listdiary" action="pagemanagement.php?action=listdiary" method="post" onsubmit="return checklistdiary();">
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;" bgcolor="#FFFFFF">
<tr>
<td width="25%">List Diary Page Size: </td>
<td width="25%"><input type="text" value="" name="listdiary" id="listdiary"/></td>
<td width="25%">(Current : <?php echo $listdiary; ?> Entries Per Page)</td>
<td width="25%"><input type="submit" value="Set Value" />
</td>
</tr>
</table>
</form>

<form name="messages" action="pagemanagement.php?action=messages" method="post" onsubmit="return checkmessages();">
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;" bgcolor="#FFFFFF">
<tr>
<td width="25%">Delete Messages Page Size: </td>
<td width="25%"><input type="text" value="" name="messages" id="messages"/> </td>
<td width="25%">(Current : <?php echo $deletemessages; ?> Entries Per Page)</td>
<td width="25%">
<input type="submit" value="Set Value" />
</td>
</tr>
</table>
</form>

<form name="mydiary" action="pagemanagement.php?action=mydiary" method="post" onsubmit="return checkmydiary();">
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;" bgcolor="#FFFFFF">
<tr>
<td width="25%">My Diary Entry Page Size: </td>
<td width="25%"><input type="text" value="" name="mydiary" id="mydiary"/> </td>
<td width="25%">(Current  : <?php echo $mydiary; ?> Entries Per Page)</td>
<td width="25%"><input type="submit" value="Set Value" />
</td>
</tr>
</table>
</form>

<form name="mygallery" action="pagemanagement.php?action=mygallery" method="post" onsubmit="return checkmygallery();">
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;" bgcolor="#FFFFFF">
<tr>
<td width="25%">My Gallery Page Size: </td>
<td width="25%"><input type="text" value="" name="mygallery" id="mygallery"/> </td>
<td width="25%">(Current : <?php echo $mygallery; ?> Photos Per Page)</td>
<td width="25%"><input type="submit" value="Set Value" /></td>
</tr>
</table>
</form>

<form name="myfriends" action="pagemanagement.php?action=myfriends" method="post" onsubmit="return checkmyfriends();">
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;" bgcolor="#FFFFFF">
<tr>
<td width="25%">My Friends Page Size: </td>
<td width="25%"><input type="text" value="" name="myfriends" id="myfriends"/> </td> 
<td width="25%">(Current : <?php echo $myfriends; ?> Friends Per Page)</td>
<td width="25%"><input type="submit" value="Set Value" /></td>
</tr>
</table>
</form>

<form name="mymessages" action="pagemanagement.php?action=mymessages" method="post" onsubmit="return checkmymessages();">
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;" bgcolor="#FFFFFF"> 
<tr>
<td width="25%">My Messages Page Size: </td>
<td width="25%"><input type="text" value="" name="mymessages" id="mymessages"/> </td>
<td width="25%">(Current : <?php echo $mymessages; ?> Messages Per Page)</td>
<td width="25%"><input type="submit" value="Set Value" />
</td>
</tr>
</table>
</form>

<form name="myblog" action="pagemanagement.php?action=myblog" method="post" onsubmit="return checkmyblog();">
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;" bgcolor="#FFFFFF">
<tr>
<td width="25%">My Blog Page Size: </td>
<td width="25%"><input type="text" value="" name="myblog" id="myblog"/> </td>
<td width="25%">(Current : <?php echo $myblog; ?> Blogs Per Page)</td>
<td width="25%"><input type="submit" value="Set Value" />
</td>
</tr>
</table>
</form>

<form name="myfriendinvites" action="pagemanagement.php?action=myfriendinvites" method="post" onsubmit="return checkmyfriendinvites();">
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;" bgcolor="#FFFFFF">
<tr>
<td width="25%">My Friend Invites Page Size: </td>
<td width="25%"><input type="text" value="" name="myfriendinvites" id="myfriendinvites"/> </td>
<td width="25%">(Current : <?php echo $myfriendinvites; ?> Friends Per Page)</td>
<td width="25%"><input type="submit" value="Set Value" />
</td>
</tr>
</table>
</form>

<form name="search" action="pagemanagement.php?action=search" method="post" onsubmit="return checksearch();">
<table width="100%" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;" bgcolor="#FFFFFF">
<tr>
<td width="25%">Search Page Size: </td>
<td width="25%"><input type="text" value="" name="search" id="search"/> </td>
<td width="25%">(Current : <?php echo $search; ?> Results Per Page)</td>
<td width="25%"><input type="submit" value="Set Value" />
</td>
</tr>
</table>
</form>


