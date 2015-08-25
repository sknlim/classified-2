<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/category.class.php";
$maincategory = new maincategory;
$cat = $maincategory->getbyseo($_GET['seo_url']);
//print_r($cat);
$seo_header = '<meta name="description" content="Jobs for State - '.$cat['name'].'" />
<meta name="keywords" content="'.$cat['sub_cat'].'" />';
$page_title = "Jobs for ".$cat['sub_cat'];

include "header.php";
include "subheader.php";
?>

<p align="center">
	<font size="+1">USA<?php if($_GET['seo_url']!="") { echo " - &quot;<strong>".$cat['name']."</strong>&quot;"; } ?><?php if($_GET['rentorhire_seo_url']!="") { echo " - &quot;<strong>".$_GET['rentorhire_seo_url']."</strong>&quot;"; } ?></font>
</p>
<h3 class="heading">Jobs </h3>
 <?php
 	if($_GET['seo_url']=="")
		{
		$maincategory = new maincategory;
		$maincategory->display_category_usa("jobs","jobs.php");
		}
	else
		{
	//	$jobs = new jobs;
	//	$jobs->display_jobs();
		$maincategory = new maincategory;
		$maincategory->display_category_usa("jobs","jobs.php",$_GET['seo_url']);
		}
	?>
<br />
<h3 class="heading"> Featured Jobs </h3>
<?php
$jobs = new jobs;

if($_GET['seo_url']=="")
	$jobs_status = $jobs->display_jobs(1,0,0,10,"");
//else if($_GET['jobs_seo_url']=="")
//	$jobs_status = $jobs->display_jobs(1,$cat['id'],0,10,"");
else
	$jobs_status = $jobs->display_jobs(1,$cat['id'],0,10,"");
?>
<p align="right">
	<?php
	if($user_check->checklogin()==false)
	echo '<a href="post_jobs.php" onclick="javascript:messageBox(\'Please Login \'); return false;">Post Jobs</a>'; 
	else
	echo '<a href="post_jobs.php">Post Jobs</a>'; 	
		
	?>
	</p>
<br />
<?php include "subfooter.php"; ?>
<?php include "footer.php"; ?>
