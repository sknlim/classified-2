<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php";
/*
echo session_id();
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/
if(is_array($_POST))
{
	$objconfig=new config;
	$objuser=new user;
	$bool=$objuser->login($_POST['username'],$_POST['password'],"login");
		if($bool=="-1")
		{
			echo "script:messageBox('".$objuser->error."');";
		}
		elseif($bool=="-2")
		{
			echo "script:messageBox('".$objuser->error."');";
		}
		elseif($bool=="1")
		{
			//header("Location: members.php");
			if($_POST['redirect']=="")
				echo "link:index.php";
			else
				echo "link:".$_POST['redirect'];
			//echo "script:window.location='".$objconfig->get_domain_path()."welcome.php';";

		}
		else
		{
			echo "Error :".$objuser->error;
		}
		
				
	}
?>