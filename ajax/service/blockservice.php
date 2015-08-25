<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/service.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";


$objuser=new user;
$objuser->checkLoginAjax();

$objservice= new service;
$objservice->action($_GET['action'],$_GET['sid']);

if($_GET['action']=="block")
$mes="Service has been Blocked..";
else
$mes="Service has been Activated..";

echo "script: messageBox('".$mes."',function() { window.location='account.php'; } );";



?>