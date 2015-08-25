<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php"; 

class configuration
{
	var $mysql;

	function configuration()
	{
	$this->mysql=new mysql;
	}

	function getall_values($start_limit=0,$end_limit=0)
		{	
			if($start_limit==0 && $end_limit==0)
			{
			$sql = "select * from `configuration` order by `id`";
			}
			else
			{
			$sql = "select * from `configuration` order by `id` limit ".$start_limit.",".$end_limit."";
			}
			$data = $this->mysql->getdata($sql);
			return $data;
		}
		
	function get_by_id($id)
		{
			$sql = "select * from `configuration` where id='".$id."'";
			return $data = $this->mysql->queryrow($sql);
		}
		
	
	
	function edit_configuration($ar,$id)
		{
			 $sql = "update `configuration` set variable='".$this->mysql->magicquotes($ar['var_name'])."',value='".$this->mysql->magicquotes($ar['value'])."', type='".$this->mysql->magicquotes($ar['type'])."' where id='".$id."'";;
		     $result = $this->mysql->query($sql);
		}
	
	function add_variable($ar)
		{
		$sql = "insert into configuration(`variable`,`value`,`type`) values ('".$this->mysql->magicquotes($ar['var_name'])."','".$this->mysql->magicquotes($ar['value'])."','".$ar['type']."')";
			 $result1=$this->mysql->queryinsert($sql,"configuration");
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