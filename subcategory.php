<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/category.class.php";
$maincategory = new maincategory;
$cat = $maincategory->getbyseo($_GET['seo_url']);
//print_r($cat);
$seo_header = '<meta name="description" content="Project for State - '.$cat['name'].'" />
<meta name="keywords" content="'.$cat['sub_cat'].'" />';
$page_title = "Project for ".$cat['sub_cat'];
include "header.php"; 
include "subheader.php"; 
?>
<p align="center">
	<font size="+1"><a href="/index.php">USA</a> - &quot;<strong><?php echo $cat['name'];?></strong>&quot;</font>
</p>
<div class="lineBreak"></div>
<h3 class="heading">Services</h3>
<?php
$service = new service;
$service->display_category();
?>
<br />



<h3 class="heading"> Featured Projects </h3>
<?php
$projects = new project;
$projects_status = $projects->display_projects("featured",1,$cat['id'],0,10,"order by rand()");
?>
<p align="right">
	<?php 
	if($user_check->checklogin() && strtoupper($_SESSION['foongigs_usertype'])=="SEEKER")
		echo '<a href="post_project.php">Post Project</a>';
	else if($user_check->checklogin() && strtoupper($_SESSION['foongigs_usertype'])=="PROVIDER")
		echo '<a href="post_project.php" onclick="javascript:messageBox(\'Only Seeker can post projects\'); return false;">Post Project</a>';
	else
		echo '<a href="post_project.php" onclick="javascript: messageBox(\'Please Login \'); return false;">Post Project</a>';
	if($projects_status) { ?> | <a href="view_projects.php?category=<?php echo $cat['seo_url'];?>">View More</a> <?php } ?>
</p>
<br />




<h3 class="heading"> Featured Rent of Hire </h3>
<?php
$rentorhire = new rentorhire;
$rentorhire_status = $rentorhire->display_rentofhire(1,$cat['id'],0,10,"order by rand()");
?>
<p align="right">
	<?php
	if($user_check->checklogin() && strtoupper($_SESSION['foongigs_usertype'])=="SEEKER")
	echo '<a href="post_rentorhire.php" onclick="javascript:messageBox(\'Only Provider can post rent or hire\'); return false;">Post things rent or hire</a>';
	else if($user_check->checklogin() && strtoupper($_SESSION['foongigs_usertype'])=="PROVIDER")
	echo '<a href="post_rentorhire.php"> Post things rent or hire </a>';
	else
	echo '<a href="post_rentorhire.php" onclick="javascript:messageBox(\'Please Login \'); return false;">Post things rent or hire</a>';
	if($rentorhire_status) { ?> | <a href="category_rentorhire.php?category=<?php echo $cat['seo_url'];?>"> View More</a> <?php } ?></p>
<br />



<h3 class="heading"> Featured Job Listing </h3>
<?php
$jobs= new jobs;
$jobs_status = $jobs->display_jobs(1,$cat['id'],0,10,"order by rand()");
?>
<p align="right">
	<?php
	if($user_check->checklogin())
		echo '<a href="post_jobs.php">Post job listing</a>';
	else
		echo '<a href="post_jobs.php" onclick="javascript:messageBox(\'Please Login \'); return false;">Post job listing</a>';
	if($jobs_status) { ?> | <a href="category_jobs.php?category=<?php echo $cat['seo_url'];?>">View More</a> <?php } ?>
</p>
<br />



<h3 class="heading"> Featured Service </h3>
<?php
$service = new service;
$service_status = $service->display_service(1,$cat['id'],0,10,"order by rand()");
?>
<p align="right">
	<?php
	if($user_check->checklogin() && strtoupper($_SESSION['foongigs_usertype'])=="SEEKER")
		echo '<a href="post_service.php" onclick="javascript:messageBox(\'Only Provider can post services\'); return false;">Post service</a>'; 
	else if($user_check->checklogin() && strtoupper($_SESSION['foongigs_usertype'])=="PROVIDER")
		echo '<a href="post_service.php">Post service</a>'; 
	else
		echo '<a href="post_service.php" onclick="javascript:messageBox(\'Please Login \'); return false;">Post service</a>'; 
	if($service_status) { ?> | <a href="category_services.php?category=<?php echo $cat['seo_url'];?>">View More </a> <?php } ?></p>
<br />
<?php include "subfooter.php"; ?>
<?php include "footer.php"; ?>
