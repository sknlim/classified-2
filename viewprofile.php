<?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/subheader.php"; ?>
<?php
  	$objuser = new user;
	$data=$objuser->getbyid($_GET['id']);
?>

<h1><?php echo strtoupper($data['type']); ?> INFO</h1>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td class="dt1" valign="top" width="150"><b>Username:</b></td>
<td class="dt1" valign="top"><?php echo $data['username']; ?></td>
</tr>

<tr>
<td class="dt2" valign="top" width="150"><b>Name:</b></td>
<td class="dt2" valign="top"><?php echo $data['firstname']." ".$data['lastname']; ?></td>
</tr>

<tr>
<td class="dt2" valign="top" width="150"><b>Company:</b></td>
<td class="dt2" valign="top"><?php echo $data['company']; ?></td>
</tr>

<tr>
<?php $objcommon=new common; ?>
<td class="dt1" valign="top" width="150"><b>Location:</b></td>
<td class="dt1" valign="top"><?php echo $objcommon->getcountrybyid($data['country_id']); ?></td>

</tr>

<tr>
<td class="dt1" valign="top" width="150"><b>Services Provided:</b></td>
<td class="dt1" valign="top"><?php echo $data['jobtype']; ?></td>
</tr>

<tr>
<td class="dt2" valign="top" width="150"><b>Profile:</b></td>
<td class="dt2" valign="top"><?php echo $data['profile']; ?></td>
</tr>

<tr>
<td class="dt1" valign="top" width="150"><b>Rating:</b></td>
<td class="dt1" valign="top"><?php echo $objuser->getReviews($_GET['id']); ?></td>
</tr>

<tr>
<td class="dt2" valign="top"><b>Rank:</b></td>
<td class="dt2" valign="top"><?php echo $_GET['id']; ?></td></tr>
<tr>
<td class="dt1" valign="top"><b>Member Since:</b></td>
<td class="dt1" valign="top"><?php echo $data['createtime']; ?></td>
</tr>

<tr>
<td class="dt2" valign="top"><b>Last Activity:</b></td>
<td class="dt2" valign="top">9/17/2007</td>
</tr>
</table>


<?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/subfooter.php"; ?>