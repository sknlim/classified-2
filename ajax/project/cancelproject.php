<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/projectaccount.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";



$objuser=new user;
$objuser->checkLoginAjax();

$objproject= new project;
//$data=$objproject->getdetails($_GET['pid']);
$response=$objproject->cancelProject($_GET['pid']);
echo "script: messageBox('Your Project has been Cancelled',function() { window.location='account.php'; } );";

?>