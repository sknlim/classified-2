<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/email.class.php";

class admin extends mysql
	{
	var $error;	
	     function login($username,$password)
		{
			$sql="select  * from `users` where username='".$username."' and password='".$password."' and accesslevel='2'" ;
			$result1 = $this->queryrow($sql);
			if($result1!=0)
				{
				$_SESSION['admin_login_system']=1;
				$_SESSION['USER']=$username;
				}
				else
				{
				$_SESSION['admin_login_system']=0;
				}
		}
			
		function checklogin()
		{
		if($_SESSION['admin_login_system']=="1")
			{return true;
					}
			else
			{return false;
			}
		
		}
		
	}
		
?>
	