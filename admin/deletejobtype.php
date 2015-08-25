<?php include "header.php";
require_once "../common/class/jobtype.class.php";
$delete_jobtype=new jobtype();

	if($_GET['action']=="delete" && $_GET['id']=="")
	{
		$midarray = explode(",",$_POST['selectcheck']);
		foreach($midarray as $w)
			{
			$delete_jobtype->deletejobtype($w,$table);
			}	
		echo "<script>alert('Job Type Deleted ...'); window.location='jobtype_management.php?type=".$_GET['type']."';</script>";
	}
	else
	{
		$delete_jobtype->deletejobtype($_GET['id'],$table);
		echo "<script>alert('Job Type Deleted ...'); window.location='jobtype_management.php?type=".$_GET['type']."';</script>";
	}
?>

