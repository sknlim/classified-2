<?php
session_start();
?>
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