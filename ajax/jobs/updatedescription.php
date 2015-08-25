<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/jobs.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";

$objuser=new user;
$objuser->checkLoginAjax();
$objjob= new jobs;
$response=$objjob->get_job_by_id($_POST['jobid']);

$description=$response['description'];
$description.="<br><b> More Description added on ".date("F j, Y, g:i a")."</b><br>";
$description.=$_POST['description'];
$objjob->adddescription($description,$_POST['jobid']);

echo "script: messageBox('More Description Added to Job.',function() { window.location='account.php'; } );";

?>