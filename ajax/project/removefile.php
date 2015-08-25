<?php session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php";

$objuser=new user;
$objuser->checkLoginAjax();
$objproject=new project;
$objproject->removefiles($_GET['fileid']);
//echo "";

//$objjobtype=new jobs();
/*$i=0;
		foreach ($_POST['jobtype'] as $data)
			{
			if($data!="")
			$i++;
			}
		if($i==0)
		{
		echo "script:wrongStatus(document.getElementById('jobtype'),\"Select at least one\");";
		exit();
		}*/
//$objjobtype->add($_POST);
//echo "script: messageBox('Job Posted',function() { window.location='index.php'; });";
?>