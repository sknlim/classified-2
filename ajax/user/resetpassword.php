<?php
session_start();
require_once "../../common/class/common.class.php";
require_once "../../common/class/user.class.php";
require_once "../../common/class/config.class.php";

if(is_array($_POST))
{
	$objconfig=new config;
	$objuser=new user;
	$bool=$objuser->resetPassword($_POST);
	if($bool=="1")
	{
		echo "script:messageBox('Your Password has been Reset , A confirmation mail has been sent to your email.');";
	}
	else
	{
		echo "script:wrongStatus(document.forms['frmResetPassword'].elements['password'],\"".$objuser->error."\");";	
	}
			

}

?>