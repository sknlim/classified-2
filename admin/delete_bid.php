<?php include "header.php";
require_once "../common/class/project_admin.class.php";
$project_admin=new project_admin();

	if($_GET['action']=="delete" && $_GET['id']=="")
	{
		$midarray = explode(",",$_POST['selectcheck']);
		foreach($midarray as $w)
			{
			$project_admin->delete_bid($w);
			}	
		echo "<script>alert('Bid Deleted ...'); window.location='bids_details.php';</script>";
	}
	else
	{
		$project_admin->delete_bid($_GET['id']);
		echo "<script>alert('Bid Deleted ...'); window.location='bids_details.php';</script>";
	}
?>

