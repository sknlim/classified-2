<?php include "header.php"; ?>
<?php include "subheader.php"; ?>
<?php
$cms = new cms("cms");
$page = $cms->getpagebyfilename($_GET['filename']);
?>
<h2><?php echo $page['title']; ?></h2>
<p>
<?php echo $page['content']; ?>
</p>
<?php include "footer.php"; ?>