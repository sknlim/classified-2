<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php";
$objuser=new user;
$objuser->checkLoginAjax();

if(is_array($_POST))
{
	$objproject=new project();
	$objproject->update($_POST);
	if(isset($_SESSION['tempfilename']))
	{
	$fp = fopen($_SESSION['tempfilename'], 'r');
	$content = fread($fp, $_SESSION['filesize']);
	fclose($fp);
	$objproject->addfile($_SESSION['filename'],$_SESSION['filetype'],$_SESSION['filesize'],$content,$_POST['projectid']);	
	}

	echo "script: messageBox('Project Updated',function() { window.location='account.php'; });";
}
?>
