<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php";


$objuser=new user;
$objuser->checkLoginAjax();

if(strtoupper($_SESSION['foongigs_usertype'])=="PROVIDER")
{
	echo "script: messageBox('Sorry!, Only SEEKER can post a project');";
	exit();
}	

/* if(isset($_SESSION['counter']))
	$_SESSION['counter']++;
else
	$_SESSION['counter']=1;
echo $_SESSION['counter'];
print_r($_POST);
exit();
*/


if(is_array($_POST))
{
	$objproject=new project();
	$projectid=$objproject->add($_POST);
	
	if(isset($_SESSION['tempfilename']))
	{
	$fp = fopen($_SESSION['tempfilename'], 'r');
	$content = fread($fp, $_SESSION['filesize']);
	fclose($fp);
	$objproject->addfile($_SESSION['filename'],$_SESSION['filetype'],$_SESSION['filesize'],$content,$projectid);	
	}
	echo "script: messageBox('Project Posted',function() { window.location='account.php'; });";
}
?>
