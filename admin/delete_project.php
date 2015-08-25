<?php include "header.php";
require_once "../common/class/project.class.php";
$delete_page=new project("projects");
	
	if($_POST['type']=="delete")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->delete_project($w);
				}	
			//disconnect_db($cn);
		echo "<script>alert('Project Delete ...'); window.location='project_management.php';</script>";
	}
elseif($_POST['type']=="active")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->active_project($w);
				}	
			//disconnect_db($cn);
		echo "<script>alert('Project Activated !..'); window.location='project_management.php';</script>";
	
	}
elseif($_POST['type']=="block")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->block_project($w);
				}	
			//disconnect_db($cn);
		echo "<script>alert('Project Blocked !..'); window.location='project_management.php';</script>";
	
	}
?>

