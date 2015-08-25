<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php"; 

class currency
{
	var $mysql;

	function currency()
	{
	$this->mysql=new mysql;
	}

	function getall($start_limit=0,$end_limit=0)
		{	
			if($start_limit==0 && $end_limit==0)
			{
			$sql = "select * from `currency` order by `name`";
			}
			else
			{
			$sql = "select * from `currency` order by `name` limit ".$start_limit.",".$end_limit."";
			}
			$data = $this->mysql->getdata($sql);
			return $data;
		}
		
	function total_currency()
		{
			$sql = "select count(*) as total from `currency` order by `name`";
			$data = $this->mysql->queryrow($sql);
			return $data['total'];
		}
		
	function getbyid($id)
		{
			$sql = "select * from `currency` where id='".$id."'";
			$data = $this->mysql->queryrow($sql);
			return $data;
		}
	
	function edit_currency($ar,$id)
		{
			 $sql = "update `currency` set name='".$this->mysql->magicquotes($ar['name'])."',full_name='".$this->mysql->magicquotes($ar['fullname'])."' where id='".$id."'";;
		     $result = $this->mysql->query($sql);
		}
	
	function add_currency($ar)
		{
			 $sql = "insert into currency(`name`,`full_name`) values ('".$this->mysql->magicquotes($ar['name'])."','".$this->mysql->magicquotes($ar['fullname'])."')";
			 $result1=$this->mysql->queryinsert($sql,"currency");
		}
	
	function delete_currency($ar)
		{
			$sql = "delete from `currency` where id='".$ar."'";
			$result1=$this->mysql->query($sql);
			return true;
		}
		
	function check_currency($ar)
		{
			$sql = "select * from `currency` where name='".$ar['name']."' and full_name='".$ar['fullname']."'";
			$data = $this->mysql->queryrow($sql);
			return $data;
		}
}	
?>