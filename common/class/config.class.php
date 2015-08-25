<?php
class config
{
	function config()
	{
//	session_start();
	}
	
	function get_full_domain_path()
	{
	$str=$_SERVER['DOCUMENT_ROOT']."/";
	return $str;
	}
	
	function get_domain_path()
	{
	$str="http://foongigs.mylifeisweb.com/";
	return $str;
	}
	
	function get_upload_dir()
	{
	$str="/final_mylifeisonline/member/userimages/";
	return $str;
	}
		
}
?>