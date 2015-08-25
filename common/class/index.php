<?php
include "config.class.php";
$objconfig=new config;
header("Location: ".$objconfig->get_domain_path());
?>