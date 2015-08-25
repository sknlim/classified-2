<?php 
include "header.php";
include "subheader.php";
$transaction = new transaction;
$user = new user;
$user_data = $user->getbyid($user->getloggedid());
$balance = $transaction->balance();
?>
<script language="javascript">
function textCounter(field,cntfield,maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else
cntfield.value = maxlimit - field.value.length;
}
</script>
<?php
if($user_data['type']=="seeker")
	include "account_seeker.php";
else
	include "account_provider.php";
	
include "subfooter.php";
include "footer.php";
?>
