<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php";

if(is_array($_POST))
{
	$objconfig=new config;
	$objuser=new user;
	$bool=$objuser->changePassword($_POST);
	if($bool=="1")
	{
		echo "script: closePage(); messageBox('Your Password has been Changed , A confirmation mail has been sent to your email.');";
	}
	else
	{
		echo "script:wrongStatus(document.forms['frmChangePassword'].elements['currentpassword'],\"".$objuser->error."\");";	
	}
			

}

?>