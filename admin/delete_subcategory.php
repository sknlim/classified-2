<?php include "header.php";
require_once "../common/class/sub_rentorhire.class.php";

$delete_category=new sub_rentorhire();
	if($_GET['action']=="delete" && $_GET['id']=="")
	{
	$midarray = explode(",",$_POST['selectcheck']);
	foreach($midarray as $w)
		{
		$delete_category->delete_sub_category($w);
		}	
	//disconnect_db($cn);
	echo "<script>alert('Sub Category Deleted ...'); window.location='rentorhire_sub_category.php?id=".$_GET['cate_id']."';</script>";
	}
	else
	{
	$delete_category->delete_sub_category($_GET['id']);
	echo "<script>alert('Sub Category Deleted ...'); window.location='rentorhire_sub_category.php?id=".$_GET['cate_id']."';</script>";
	}
?>

