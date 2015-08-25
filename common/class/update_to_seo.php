<?php
include "mysql.class.php";
include "seo.class.php";
$seo = new seo;
$mysql = new mysql;
$sql = "select * from rentorhire_category ";
$data = $mysql->getdata($sql);
foreach($data as $value)
	{
	$sql_update =  "update rentorhire_category  set seo_url='".$seo->get_seo_url($value['name'])."' where id='".$value['id']."'";
	echo $sql_update."<br />";
	$mysql->query($sql_update);
	
	}
?>