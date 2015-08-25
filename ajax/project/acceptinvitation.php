<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/projectaccount.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";

$objuser=new user;
$objuser->checkLoginAjax();
$objproject= new projectaccount;
$response=$objproject->acceptInvitation($_GET['pid']);

echo "script: messageBox('You have accepted the project invitation..',function() { window.location='account.php'; } );";

?>