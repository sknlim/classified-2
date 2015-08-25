<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php"; 
$userObj=new user;
$userObj->logout();
header("Location: "."http://".$_SERVER['HTTP_HOST']."/index.php");
?>