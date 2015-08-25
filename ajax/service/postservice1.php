<?php session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/service.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/image.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/photo.class.php";

$objuser=new user;
$objuser->checkLoginAjax();

$referrer=$_SERVER['HTTP_REFERER'];

if(strtoupper($_SESSION['foongigs_usertype'])=="SEEKER")
{
	echo "script: messageBox('Sorry!, Only PROVIDER can post Service ');";
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
	
	$objservice=new service();
	$serviceid=$objservice->add($_POST);
	
	if($pid!="")
	$objservice->addimages($serviceid,$pid);

	echo "script: messageBox('Service Posted',function() { window.location='account.php'; }); ";
}
?>