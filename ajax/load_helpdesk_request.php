<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";

require_once $_SERVER['DOCUMENT_ROOT']."/common/class/helpdesk.class.php";
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
	
	$helpdesk=new helpdesk();
	if($_GET['helpdesk_id'])
	{
	$send=$helpdesk->add_entry($_POST['description'],$_GET['helpdesk_id']);
	}
	else
	{
	$send=$helpdesk->send_message($_POST['subject'],$_POST['description']);
	}
	if($_POST['status_change']=="reopen")
	{
	$change=$helpdesk->reopen_request($_GET['helpdesk_id']);
	echo "script:messageBox('Message Sent and Request is Re-Open');closePage();";
	}
	else
	{
	 echo "script:messageBox('Message Sent');closePage();"; 
	}
} 
?>
