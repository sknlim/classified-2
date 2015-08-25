<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/transaction.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";



$objuser=new user;
$objuser->checkLoginAjax();
$objtransaction= new transaction;
$balance=$objtransaction->checkbalance();

if($balance>0)
echo '<h1 align="center">Money Withdraw Request</h1><br>
<h3>Select Mode</h3><br>
<input type="radio" value="paypal" name="withdrawmode" onClick="loadPage(\'/ajax/transaction/withdrawpaypalform.php\');"> Withdraw Through Paypal
	<input type="radio" value="bankwire" name="withdrawmode" onClick="loadPage(\'withdrawbankwireform.php\');"> Withdraw Through Bankwire';
else
	echo "script: messageBox('Insufficient Balance..',function() { window.location='account.php'; } );";

?>

