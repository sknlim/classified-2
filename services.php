<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/category.class.php";
$maincategory = new maincategory;
$cat = $maincategory->getbyseo($_GET['seo_url']);
//print_r($cat);
$seo_header = '<meta name="description" content="Services for State - '.$cat['name'].'" />
<meta name="keywords" content="'.$cat['sub_cat'].'" />';
$page_title = "Services for ".$cat['sub_cat'];
include "header.php"; 
include "subheader.php"; 
?>
<p align="center">
	<font size="+1">USA<?php if($_GET['seo_url']!="") { echo " - &quot;<strong>".$cat['name']."</strong>&quot;"; } ?><?php if($_GET['service_seo_url']!="") { echo " - &quot;<strong>".$_GET['service_seo_url']."</strong>&quot;"; } ?></font>
</p>
<h3 class="heading">Services </h3>
 <?php
 	if($_GET['seo_url']=="")
		{
		$maincategory = new maincategory;
		$maincategory->display_category_usa("services","services.php");
		}
	else
		{
		$service = new service;
		$service->display_category();
		}
	?>
<br />
<h3 class="heading"> Featured Service </h3>
<?php
$service = new service;
if($_GET['seo_url']=="")
	$service_status = $service->display_service(1,0,0,10,"");
else if($_GET['service_seo_url']!="")
	$service_status = $service->display_service(1,$cat['id'],0,0,"order by posted_time desc",$_GET['service_seo_url']);
else
	$service_status = $service->display_service(1,$cat['id'],0,10,"");
?>
<p align="right">
	<?php
	if($user_check->checklogin() && strtoupper($_SESSION['foongigs_usertype'])=="SEEKER")
		echo '<a href="post_service.php" onclick="javascript:messageBox(\'Only Provider can post services\'); return false;">Post service</a>'; 
	else if($user_check->checklogin() && strtoupper($_SESSION['foongigs_usertype'])=="PROVIDER")
		echo '<a href="post_service.php">Post service</a>'; 
	else
		echo '<a href="post_service.php" onclick="javascript:messageBox(\'Please Login \'); return false;">Post service</a>'; 
	?>
	</p>
<br />
<?php include "subfooter.php"; ?>
<?php include "footer.php"; ?>
