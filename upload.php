<?php
if($_GET['sid']) session_id($_GET['sid']);
session_start();
$_SESSION['filename']=$_FILES['Filedata']['tmp_name'];
?>