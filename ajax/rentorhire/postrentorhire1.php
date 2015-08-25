<?php session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/rentorhire.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/image.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/photo.class.php";

$objuser=new user;
$objuser->checkLoginAjax();

if(strtoupper($_SESSION['foongigs_usertype'])=="SEEKER")
{
	echo "script: messageBox('Sorry!, Only PROVIDER can post Rent or Hire ');";
	exit();
}

if(is_array($_POST))
{
	$pid="";
	if(isset($_SESSION['photofilename']))
	{
	$photo=new photo;
	$commonObj=new common;
	$size[0]=$commonObj->getConfigValue("imagesize1");
	$size[1]=$commonObj->getConfigValue("imagesize2");
	$size[2]=$commonObj->getConfigValue("imagesize3");
	
	$photo->createPhotos($size,$_SESSION['photofilename']);
	$pid=$photo->insertimage();
	}
	
	$objrentorhire=new rentorhire();
	$rentorhireid=$objrentorhire->add($_POST);
	
	if($pid!="")
	$objrentorhire->addimages($rentorhireid,$pid);

	echo "script: messageBox('Things Posted rent or hire',function() { window.location='account.php'; });";
}
?>