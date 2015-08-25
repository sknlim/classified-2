<?php 
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php";

if(is_array($_POST))
{
	$objuser=new user;
	$objuser->updateprofile($_POST);
	echo "script: messageBox('Your Profile has been updated.',function() { window.location='account.php'; } );";
}
?>



