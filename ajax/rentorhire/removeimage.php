<?php session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/rentorhire.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php";

$objuser=new user;
$objuser->checkLoginAjax();
$objrentorhire=new rentorhire;
$objrentorhire->removeimage($_GET['imageid']);
?>