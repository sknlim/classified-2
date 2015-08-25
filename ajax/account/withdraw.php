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
{
?>
<h1 align="center">Money Withdraw Request</h1><br>
<h3>Select Mode</h3><br>
<input type="radio" value="paypal" name="withdrawmode" onClick="showDiv('div_withdrawpaypal'); hideDiv('div_withdrawbankwire');"> Withdraw Through Paypal <br><br>
<input type="radio" value="bankwire" name="withdrawmode" onClick="showDiv('div_withdrawbankwire'); hideDiv('div_withdrawpaypal');"> Withdraw Through Bankwire
<div id ="div_withdrawpaypal" style="display:none;">
<h1 align="center">Money Withdrawal through Paypal</h1>
<form method="post" action="withdrawpaypal.php" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;">
<table width="100%">
<tr>
<td width="30%"></td>
<td width="70%"></td>
</tr>
   

<tr>
<td><strong>Email</strong></td>
<td><input name="email" value="" type="text" class="vldemail vldnoblank">
<span class="checkStatus"></span> 
</td>
</tr>

<tr>
<td><strong>Amount</strong></td>
<td>$<input name="amount" value="" type="text" class="vldnoblank vldnum"><span class="checkStatus"></span> 

</td>
</tr>

<tr>
<td colspan="2" align="center">
<input value="Submit" name="submit" type="submit">
</td>
</tr>
</table>

</form>
</div>

<div id ="div_withdrawbankwire" style="display:none;">
<h1 align="center">Money Withdrawal through Bankwire</h1>
<form method="post" action="withdrawbankwire.php" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;">
<table width="100%">
<tr>
<td width="30%"></td>
<td width="70%"></td>
</tr>
   

<tr>
<td><strong>Account Number</strong></td>
<td><input name="accountnum" value="" type="text" class="vldnum vldnoblank">
<span class="checkStatus"></span> 
</td>
</tr>

<tr>
<td><strong>Account Holder Name</strong></td>
<td><input name="accountholdername" value="" type="text" class="vldnoblank">
<span class="checkStatus"></span> 
</td>
</tr>

<tr>
<td><strong>Bank Name</strong></td>
<td><input name="bankaddress" value="" type="text" class="vldnoblank">
<span class="checkStatus"></span> 
</td>
</tr>

<tr>
<td><strong>Swift Code</strong></td>
<td><input name="swiftcode" value="" type="text" class="vldnoblank">
<span class="checkStatus"></span> 
</td>
</tr>

<tr>
<td><strong>Additional Info</strong></td>
<td><textarea name="additionalinfo" value="" class="vldnoblank" rows="4" cols="40"></textarea>
<span class="checkStatus"></span> 
</td>
</tr>

<tr>
<td colspan="2" align="center">
<input value="Submit" name="submit" type="submit">
</td>
</tr>
</table>

</form>
</div>

<?php
}
else
	echo "script: messageBox('Insufficient Balance..',function() { window.location='account.php'; } );";

?>

