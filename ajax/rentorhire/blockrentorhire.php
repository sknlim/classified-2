<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/rentorhire.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";


$objuser=new user;
$objuser->checkLoginAjax();

$objrentorhire= new rentorhire;
$objrentorhire->action($_GET['action'],$_GET['rid']);

if($_GET['action']=="block")
$mes="Rent or Hire has been Blocked..";
else
$mes="Rent or Hire has been Activated..";

echo "script: messageBox('".$mes."',function() { window.location='account.php'; } );";

?>