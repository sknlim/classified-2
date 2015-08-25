<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php";
if(is_array($_POST))
{
		$objuser=new user;
		$bool=$objuser->forgotPassword($_POST['email']);
		echo $bool."<br>";
		if($bool=="0")
		{
			echo "script:wrongStatus(document.forms['frmforgot'].elements['email'],\"".$objuser->error."\");";			
		}
		else
		{
			echo "script:closePage();
				messageBox('Reset Password request sent to your email');";
		}
		
} 
?>
