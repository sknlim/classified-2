<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php";


$objuser=new user;
$objuser->checkLoginAjax();

if($_POST['private']=="")
{
	$objproject= new project;
	$response=$objproject->postmessage($_POST);
	echo "script: closePage(); messageBox('Your message have been posted',function() { window.location='messageboard.php?pid=".	$_POST['projectid']."'; });";
}
else
{
	if(!$objuser->isUserExists($_POST['private']))
	{
		echo "script:wrongStatus(document.forms['frmPostMessage'].elements['private'],'No user exists with this name.');";
		exit();
	}
	$objproject= new project;
	$response=$objproject->postmessage($_POST);
	echo "script: closePage(); messageBox('Your message have been posted',function() { window.location='messageboard.php?pid=".	$_POST['projectid']."'; });";

}


?>