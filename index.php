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
<tr>
	<td>&nbsp;</td>
</tr>
<tr>
  <td class="heading">OutSource</td>
</tr>
<tr>
<td>
  <?php
  	$projects = new project;
	$projects_status = $projects->display_projects("",2,0,0,10,"order by rand()");
	?>
    </td>
</tr>
<tr>
<td align="right">
<?php if($projects_status) { ?>  <a href="view_projects.php">View More</a> <?php } ?>
</td></tr>
</table>
<?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/subfooter.php"; ?>
