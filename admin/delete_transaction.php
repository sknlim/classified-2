<?php include "header.php";
require_once "../common/class/transaction_admin.class.php";
$transaction=new transaction_admin();

	if($_GET['action']=="delete" && $_GET['id']=="")
	{
		$midarray = explode(",",$_POST['selectcheck']);
		foreach($midarray as $w)
			{
			$transaction->delete_transaction($w,$table);
			}	
		echo "<script>alert('transaction Deleted ...'); window.location='transaction_management.php';</script>";
	}
	else
	{
		$transaction->delete_transaction($_GET['id'],$table);
		echo "<script>alert('transaction Deleted ...'); window.location='transaction_management.php';</script>";
	}
?>

