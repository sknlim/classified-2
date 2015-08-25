<?php include "header.php";
require_once "../common/class/transaction_admin.class.php";
$delete_page=new transaction_admin();
	
	if($_POST['type']=="cancel")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->cancel_escrow($w);
				}	
			//disconnect_db($cn);
		echo "<script>alert('Transaction Escrow Cancel ...'); window.location='trans_escrow_management.php';</script>";
	}
elseif($_POST['type']=="complete")
	{
		$midarray = explode(",",$_POST['selectcheck']);
			foreach($midarray as $w)
				{
				$delete_page->complete_escrow($w);
				}	
			//disconnect_db($cn);
		echo "<script>alert('Transaction Escrow Completed !..'); window.location='trans_escrow_management.php';</script>";
	
	}

?>

