<?php session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/jobs.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php";

$objuser=new user;
$objuser->checkLoginAjax();

$objjobtype=new jobs();
$objjobtype->add($_POST);
echo "script: messageBox('Job Posted',function() { window.location='account.php'; });";
?>