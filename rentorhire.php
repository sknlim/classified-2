<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/category.class.php";
$maincategory = new maincategory;
$cat = $maincategory->getbyseo($_GET['seo_url']);
//print_r($cat);
$seo_header = '<meta name="description" content="Rent or Hire for State - '.$cat['name'].'" />
<meta name="keywords" content="'.$cat['sub_cat'].'" />';
$page_title = "Rent or Hire for ".$cat['sub_cat'];
include "header.php"; 
include "subheader.php"; 
?>
<p align="center">
	<font size="+1">USA<?php if($_GET['seo_url']!="") { echo " - &quot;<strong>".$cat['name']."</strong>&quot;"; } ?><?php if($_GET['rentorhire_seo_url']!="") { echo " - &quot;<strong>".$_GET['rentorhire_seo_url']."</strong>&quot;"; } ?></font>
</p>
<h3 class="heading">Rent or Hire </h3>
 <?php
 	if($_GET['seo_url']=="")
		{
		$maincategory = new maincategory;
		$maincategory->display_category_usa("rentorhire","rentorhire.php");
		}
	else
		{
		$rentorhire = new rentorhire;
		$rentorhire->display_rentorhire_category();
		}
	?>
<br />
<h3 class="heading"> Featured Rent or Hire </h3>
<?php
$rentorhire = new rentorhire;

if($_GET['seo_url']=="")
	$rentorhire_status = $rentorhire->display_rentofhire(1,0,0,10,"");
else if($_GET['rentorhire_seo_url']=="")
	$rentorhire_status = $rentorhire->display_rentofhire(1,$cat['id'],"",0,10,"");
else
	$rentorhire_status = $rentorhire->display_rentofhire(1,$cat['id'],$_GET['rentorhire_seo_url'],0,10,"");
?>
<p align="right">
	<?php
	if($user_check->checklogin() && strtoupper($_SESSION['foongigs_usertype'])=="SEEKER")
		echo '<a href="post_rentorhire.php" onclick="javascript:messageBox(\'Only Provider can post Rent or Hire\'); return false;">Post Rent or Hire</a>'; 
	else if($user_check->checklogin() && strtoupper($_SESSION['foongigs_usertype'])=="PROVIDER")
		echo '<a href="post_rentorhire.php">Post Rent or Hire</a>'; 
	else
		echo '<a href="post_rentorhire.php" onclick="javascript:messageBox(\'Please Login \'); return false;">Post Rent or Hire</a>'; 
	?>
	</p>
<br />
<?php include "subfooter.php"; ?>
<?php include "footer.php"; ?>
