<?php
session_start();
?>
<h1 align="center">Deposit Money through Credit Card</h1>
<form method="post" action="depositbankwire.php" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;">
<table width="100%">
<tr>
<td width="30%"></td>
<td width="70%"></td>
</tr>
   

<tr>
<td><strong>Text Message</strong></td>
<td><textarea name="message" value="" class="vldnoblank" rows="4" cols="40"></textarea>
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