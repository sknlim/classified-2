<?php 
session_id($_GET['sid']);
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";

unset($_SESSION['photofilename']);

$objuser=new user;
$objuser->checkLoginAjax();

$temppath=$_SERVER['DOCUMENT_ROOT']."/temp/";

if(is_uploaded_file($_FILES['Filedata']['tmp_name']))
{
	$uploadedfile = $_FILES['Filedata']['tmp_name'];
	$file_name = $_FILES['Filedata']['name'];
	
	$ext_array=explode(".",$file_name);
	$ext=$ext_array[count($ext_array)-1];
	
	$code = substr(md5(microtime()),0,6); // Always Unique File Name ....
	$filename =substr($file_name,0,3).$code.".".$ext; // Create Unique File....
	
	$t=$temppath.$filename;
	move_uploaded_file($uploadedfile,$t);
	
	$_SESSION['photofilename']=$t;
}
?>