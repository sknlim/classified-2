<?php 
include $_SERVER['DOCUMENT_ROOT']."/common/class/admin/admin.class.php";
include("ImgVerification.php");
$vImage = new vImage();
$vImage->loadCodes();
//include "common/function.php";
if (!$vImage->checkCode()) 
{
 ?> <script>
 alert('Please enter the exact value from image');
 window.location="login.php";</script><? 
 exit();
}
$login = new admin();
$login_status=$login->login($_POST['user'],$_POST['pass']);
//login($_POST['user'],$_POST['pass']);
$check_login=$login->checklogin();

if($login->checklogin()==true)
{
echo "<script> window.location='index.php'; </script>";
}
else
{
echo "<script> alert('Invalid Username and Password'); window.location='index.php'; </script>";
}

?>