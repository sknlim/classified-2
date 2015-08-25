<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/projectaccount.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";



$objuser=new user;
$objuser->checkLoginAjax();
$objproject= new projectaccount;
$response=$objproject->removeBid($_GET['pid']);

echo "script: messageBox('Your Bid have been removed from this project',function() { window.location='account.php';} );";

?>