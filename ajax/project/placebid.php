<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php";



$objuser=new user;
$objuser->checkLoginAjax();

if(strtoupper($_SESSION['foongigs_usertype'])=="SEEKER")
{
	echo "script: messageBox('Sorry!, Only PROVIDER can Place Bid ');";
	exit();
}

$objproject= new project;

	if($objproject->is_private($_POST['projectid']))
	{
		if(!$objproject->isuserinvited($_POST['projectid'],$_SESSION['foongigs_userid']))
		{
			echo "script: messageBox('Sorry! This is private project, You are not Invited to bid on this project ');";
			exit();
		}
	}


$response=$objproject->placebid($_POST);

if($objproject->getStatus($_POST['projectid'])=="open")
{
	if($response=="Add")
	{
	echo "script: closePage(); messageBox('Your Bid have been posted for this project',function() { window.location='projects.php?id=".$_POST['projectid']."'; });";
	}
	if($response=="Update")
	{
	echo "script: closePage(); messageBox('Your Bid have been updated for this project',function() { window.location='projects.php?id=".$_POST['projectid']."'; });";
	}
}
else
{
	echo "script: closePage(); messageBox('Bidding Closed for this project',function() { window.location='projects.php?id=".$_POST['projectid']."'; });";
}

?>