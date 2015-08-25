<?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/subheader.php"; ?>
<?php
  	$projects = new project;
	$projects->markProjectExpired();
?>
<?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/subfooter.php"; ?>