<?php include "header.php";
require_once "../common/class/rentorhire.class.php";
$delete_page=new rentorhire();
	
	if($_POST['type']=="delete")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->delete_rentorhire($w);
				}	
			//disconnect_db($cn);
		echo "<script>alert('Item Deleted ...'); window.location='rent_hire_management.php';</script>";
	}
?>

