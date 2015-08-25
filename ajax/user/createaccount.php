<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/verification_image.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php";
if(is_array($_POST))
{
	$image = new verification_image();
	$objcommon=new common;
	$objconfig=new config;
	$vdate=$objcommon->validatedate($_POST['dd'],$_POST['mm'],$_POST['yyyy']);
	if($vdate=="0")
	{
	echo "script:wrongStatus(document.forms['frmsignup'].elements['yyyy'],\"Invalid Date\");";
	return false;
	}
	else if($image->validate_code($_POST['verificationcode'])==false) 
	{
	echo "script:wrongStatus(document.forms['frmsignup'].elements['verificationcode'],\"Invalid Verification Code\");";
	return false;
	}
	else
	{
		$objuser=new user;
		$bool=$objuser->registerUser($_POST);
		if($bool=="-1")
		{
			echo "script:wrongStatus(document.forms['frmsignup'].elements['username'],\"".$objuser->error."\");";			
		}
		elseif($bool=="-2")
		{
			echo "script:wrongStatus(document.forms['frmsignup'].elements['email'],\"".$objuser->error."\");";
		}
		elseif($bool=="1")
		{
			$ans=$objuser->login($_POST['username'],md5($_POST['password']),"register");
			echo "messageBox('Thank you for Sign up',function() { window.location='index.php'; });";
		}
		else
		{
			echo "Error :".$objuser->error;
		}
		
				
	}
			
} 
?>
