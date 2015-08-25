<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/jobs.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";



$objuser=new user;
$objuser->checkLoginAjax();
$objjob= new jobs;
$response=$objjob->delete_job($_GET['jid']);

echo "script: messageBox('Your Job has been deleted..',function() { window.location='account.php'; } );";

?>