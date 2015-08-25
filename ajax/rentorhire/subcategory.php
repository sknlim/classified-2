<?php
require $_SERVER['DOCUMENT_ROOT']."/common/class/rentorhire.class.php";
$rentorhire = new rentorhire;
$rentorhire->display_subcategory($_GET['id']);
//print_r($_GET);
//echo $_GET['id'];
?>