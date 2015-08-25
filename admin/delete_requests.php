<?php include "header.php";
require_once "../common/class/helpdesk.class.php";
$delete_page=new helpdesk();
	
if($_POST['type']=="delete")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->delete_request($w);
				}	
			//disconnect_db($cn);
			if($_GET['type']=="all")
			{
				echo "<script>alert('Request Deleted ...'); window.location='helpdesk_management.php?type=".$_GET['type']."';</script>";
			}	
			else
			{
				echo "<script>alert('Request Deleted ...'); window.location='helpdesk_management.php';</script>";
			}
	}
elseif($_POST['type']=="open")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->open_request($w);
				}	
			//disconnect_db($cn);
			if($_GET['type']=="all")
			{
				echo "<script>alert('Request is now: Open !..'); window.location='helpdesk_management.php?type=".$_GET['type']."';</script>";
			}
			else
			{
				echo "<script>alert('Request is now: Open !..'); window.location='helpdesk_management.php';</script>";
			
			}
	
	}
elseif($_POST['type']=="close")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->close_request($w);
				}	
			//disconnect_db($cn);
			if($_GET['type']=="all")
			{
				echo "<script>alert('Request is now: Closed ...'); window.location='helpdesk_management.php?type=".$_GET['type']."';</script>";
			}
			else
			{
				echo "<script>alert('Request is now: Closed ...'); window.location='helpdesk_management.php';</script>";
			}
	
	}
elseif($_POST['type']=="resolved")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->resolved_request($w);
				}	
			//disconnect_db($cn);
			if($_GET['type']=="all")
			{
				echo "<script>alert('Request is now: Resolved ...'); window.location='helpdesk_management.php?type=".$_GET['type']."';</script>";
			}
			else
			{
				echo "<script>alert('Request is now: Resolved ...'); window.location='helpdesk_management.php';</script>";
			}
	
	}
elseif($_POST['type']=="reopen")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->reopen_request($w);
				}	
			//disconnect_db($cn);
			if($_GET['type']=="all")
			{
				echo "<script>alert('Request is now: Re-opened ...'); window.location='helpdesk_management.php?type=".$_GET['type']."';</script>";
			}
			else
			{
				echo "<script>alert('Request is now: Re-opened ...'); window.location='helpdesk_management.php';</script>";
			}
	
	}
?>



