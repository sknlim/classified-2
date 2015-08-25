<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/projectaccount.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";



$objuser=new user;
$objuser->checkLoginAjax();
$objproject= new projectaccount;
$response=$objproject->selectProvider($_GET['projectid'],$_GET['providerid']);

echo "script: messageBox('Provider Selected for this Project',function() { window.location='account.php'; } );";

?>