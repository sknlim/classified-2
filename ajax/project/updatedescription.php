<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";

$objuser=new user;
$objuser->checkLoginAjax();
$objproject= new project;
$response=$objproject->getdetails($_POST['projectid']);

$description=$response['description'];
$description.="<br> <b>More Description added on ".date("F j, Y, g:i a")."</b><br>";
$description.=$_POST['description'];
$objproject->adddescription($description,$_POST['projectid']);

echo "script: messageBox('More Description Added to Project.',function() { window.location='account.php'; } );";

?>