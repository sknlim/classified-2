<?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/subheader.php"; ?>
<center><h2 >Outsource</h2></center><br />
<h3 class="heading">All Featured Project</h3>
 <?php
  	$projects = new project;
	$projects->display_projects("featured",2,0,0,10,"order by rand()");
	?><br />
<h3 class="heading">All Projects</h3>
 <?php
  	$projects = new project;
	$projects->display_projects("",2,0,0,10,"order by rand()");
	?>

<?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/subfooter.php"; ?>