<?php include "header.php";
require_once "../common/class/transaction_admin.class.php";
$delete_page=new transaction_admin();
	
	if($_POST['type']=="pending")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->pending_withdraw($w);
				}	
			//disconnect_db($cn);
		echo "<script>alert('Transaction Withdraw Pending ...'); window.location='trans_withdraw_management.php';</script>";
	}
elseif($_POST['type']=="process")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->process_withdraw($w);
				}	
			//disconnect_db($cn);
		echo "<script>alert('Transaction Withdraw Processed !..'); window.location='trans_withdraw_management.php';</script>";
	
	}
elseif($_POST['type']=="cancel")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->cancel_withdraw($w);
				}	
			//disconnect_db($cn);
		echo "<script>alert('Transaction Withdraw Canceled !..'); window.location='trans_withdraw_management.php';</script>";
	
	}

?>

