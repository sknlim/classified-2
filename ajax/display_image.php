<?php
session_start(); 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/photo.class.php";
$ph=new photo;
$img=$ph->getPhotoById($_GET['id'],3);
echo '<img src="'.$img.'">';
?>