<?php
require $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php";
$project = new project;
$project->display_editsubcategory($_GET['id'],$_GET['selected']);
?>