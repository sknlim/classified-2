<?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/subheader.php"; ?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
  <td class="heading">United States</td>
 </tr>
 <tr><td>
  <?php
	$maincategory = new maincategory;
	$maincategory->display_category_usa();
	?></td>
</tr>
</table>
<?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/subfooter.php"; ?>
