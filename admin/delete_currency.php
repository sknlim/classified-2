<?php include "header.php";
require_once "../common/class/currency.class.php";
$currency=new currency("currency");

	if($_GET['action']=="delete" && $_GET['id']=="")
	{
		$midarray = explode(",",$_POST['selectcheck']);
		foreach($midarray as $w)
			{
			$currency->delete_currency($w,$table);
			}	
		echo "<script>alert('currency Deleted ...'); window.location='currency_management.php';</script>";
	}
	else
	{
		$currency->delete_currency($_GET['id'],$table);
		echo "<script>alert('currency Deleted ...'); window.location='currency_management.php';</script>";
	}
?>

