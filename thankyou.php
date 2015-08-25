<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/contactus.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
$contactus=new contactus();
$user = new user;
if($_POST['type']!="general")
{
if($user->login($_POST['username'],$_POST['password']) > 0)
	{
	 $contactus->add($_POST['type'],$_POST['subject'],$_POST['project_id'],$_POST['url'],$_POST['description']);

	echo "script:messageBox('Thanks For contacting us');
	closePage();
	";
	}
else
	{
	
	echo "script:messageBox('Login Failed');
	closePage();
	";
	}
}
else
{
$contactus->add_general($_POST['type'],$_POST['subject'],$_POST['description'],$_POST['email']);

	echo "script:messageBox('Thanks For contacting us');
	closePage();
	";

}


?>