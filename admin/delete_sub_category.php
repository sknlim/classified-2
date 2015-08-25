<?php include "header.php";
require_once "../common/class/category.class.php";
$delete_category=new subcategory("sub_maincategory");
	if($_GET['action']=="delete" && $_GET['id']=="")
	{
	$midarray = explode(",",$_POST['selectcheck']);
	foreach($midarray as $w)
		{
		$delete_category->deleteSubCategory($w);
		}	
	//disconnect_db($cn);
	echo "<script>alert('Category Deleted ...'); window.location='sub_category_management.php';</script>";
	}
	else
	{
	$delete_category->deleteSubCategory($_GET['id']);
	echo "<script>alert('Category Deleted ...'); window.location='sub_category_management.php';</script>";
	}
?>

