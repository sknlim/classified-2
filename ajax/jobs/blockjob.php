<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/jobs.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";


$objuser=new user;
$objuser->checkLoginAjax();

$objjob= new jobs;
$objjob->action($_GET['action'],$_GET['jid']);

if($_GET['action']=="block")
$mes="Job has been Blocked..";
else
$mes="Job has been Activated..";

echo "script: messageBox('".$mes."',function() { window.location='account.php'; } );";

?>