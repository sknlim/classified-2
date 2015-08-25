<?php include "header.php";
require_once "../common/class/cms.class.php";
$delete_page=new cms("cms");
	
if($_POST['type']=="delete")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->deletepage($w);
				}	
			//disconnect_db($cn);
		echo "<script>alert('Page Deleted ...'); window.location='static_page_management.php';</script>";
	}
elseif($_POST['type']=="approve")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->approve_page($w);
				}	
			//disconnect_db($cn);
		echo "<script>alert('Page is now: Active !..'); window.location='static_page_management.php';</script>";
	
	}
elseif($_POST['type']=="block")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->block_page($w);
				}	
			//disconnect_db($cn);
		echo "<script>alert('Page is now: Blocked ...'); window.location='static_page_management.php';</script>";
	
	}
?>

