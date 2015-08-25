<?php include "header.php";
require_once "../common/class/jobs.class.php";
$delete_page=new jobs();
	
if($_POST['type']=="delete")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->delete_job($w);
				}	
			//disconnect_db($cn);
		echo "<script>alert('job Deleted ...'); window.location='job_management.php';</script>";
	}
elseif($_POST['type']=="approve")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->approve_job($w);
				}	
			//disconnect_db($cn);
		echo "<script>alert('job is now: Active !..'); window.location='job_management.php';</script>";
	
	}
elseif($_POST['type']=="block")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->block_job($w);
				}	
			//disconnect_db($cn);
		echo "<script>alert('job is now: Blocked ...'); window.location='job_management.php';</script>";
	
	}
elseif($_POST['type']=="suspend")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->suspend_job($w);
				}	
			//disconnect_db($cn);
		echo "<script>alert('job is now: Suspended ...'); window.location='job_management.php';</script>";
	
	}
?>

