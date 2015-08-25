<?php include "header.php";
require_once "../common/class/category.class.php";
$delete_category=new subcategory($_GET['type']);

	if($_GET['action']=="delete" && $_GET['id']=="")
	{
		$midarray = explode(",",$_POST['selectcheck']);
		foreach($midarray as $w)
			{
			$delete_category->deletecategory($w,$table);
			}	
		echo "<script>alert('Category Deleted ...'); window.location='category_management.php?type=".$_GET['type']."';</script>";
	}
	else
	{
		$delete_category->deletecategory($_GET['id'],$table);
		echo "<script>alert('Category Deleted ...'); window.location='category_management.php?type=".$_GET['type']."';</script>";
	}
?>

