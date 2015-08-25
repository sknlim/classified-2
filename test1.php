<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/seo.class.php"; 
$mysql = new mysql;
$seo = new seo;
$sql = "select * from category";
$data = $mysql->getdata($sql);
foreach($data as $row)
	{
	$sql = "update category set seo_url='".$seo->get_seo_url($row['sub_cat'])."' where id='".$row['id']."'";
	echo $row['id']."<br>";
	$mysql->query($sql);
	}
?>