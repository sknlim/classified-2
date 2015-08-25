<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php";

$objuser=new user;
$objuser->checkLoginAjax();

$objproject= new project;
$data=$objproject->getdetails($_POST['projectid']);
$pt=$data['project_title'];

	if($objproject->isReviewed($_POST['userid'],$_POST['projectid']))
	{
		echo "script: messageBox('Sorry! You are already reviewed.');";
		exit();
	}
	else
	{
		$mes="Your Review to ".$_POST['username']." for project : \"".$pt."\" submitted.";
		$objproject->markReview($_POST['userid'],$_POST['projectid'],$_POST['points'],$_POST['details']);
		echo "script: messageBox('".$mes."',function() { window.location='account.php'; });";		
	}
?>