<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php";
$objproject=new project;
$result=$objproject->disposefile($_GET['id']);
$size=$result['size'];
$name=$result['name'];
$type=$result['type'];
$content=$result['content'];
header("Content-length: $size");
header("Content-type: $type");
header("Content-Disposition: attachment; filename=$name");
echo $content;
?>
