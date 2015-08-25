<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php";
//sleep(2);
$objuser=new user;
$cm=$objuser->get_certified_members('provider');

foreach ($cm as $data)
{
	$str.=$data['username']."\n";
}

echo 'Private Invitation List (one username per line): <span id="span_status" style="color:green; font-weight:bold">'.count($cm).' members added</span>
          <textarea name="privateInvitaitonList" id="privateInvitaitonList" style="width: 300px; height: 80px;">'.$str.'</textarea>';
?>
