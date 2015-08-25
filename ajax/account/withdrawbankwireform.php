<?php
session_start();
?>
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