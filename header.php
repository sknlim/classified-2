<?php 
session_start(); 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/photo.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/seo.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/maincategory.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/jobs.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/currency.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/rentorhire.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/transaction.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/service.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/projectaccount.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/category.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/cms.class.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $seo_header; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="css/widgets.css" type="text/css" />
<script type="text/javascript" language="javascript" src="js/common/ajax_widget.js"></script>
<script type="text/javascript" language="javascript" src="js/common/common.js"></script>
<script type="text/javascript" language="javascript" src="js/common/coordinates.js"></script>
<script type="text/javascript" language="javascript" src="js/common/screenSeparator.js"></script>
<script type="text/javascript" language="javascript" src="js/common/fadeIn.js"></script>
<script type="text/javascript" language="javascript" src="js/common/floatDropDown.js"></script>
<title><?php echo $page_title." - foongigs.com ";?></title>
</head>
<body>
<div id="page">
	<div id="header">
	<div class="top">
		<div class="left"><a href="/" id="logo">foongigs</a></div>
		<div class="right">
			<div style="float: right; margin-right: 5px; margin-top: 6px;">
			<a href="index.php">home</a> |<a href="signup.php">sign up</a> | <a href="/forum/">forum</a> | <a href="/faqs/">faq's</a></div>
			<div class="lineBreak"></div>
			<div style="float: right; margin-top: 5px;"><form name="searchform" action="search.php" method="post"><input type="text" name="search" style="width: 300px;"/>&nbsp;<select>
				<option value="posted_projects">Posted projects</option>
				<option value="posted_jobs">Posted jobs</option></select>&nbsp;&nbsp;<input type="submit" name="submit" value="SEARCH" onclick="searchdata();" /></form></div>
		</div>			 
	</div>
	</div>