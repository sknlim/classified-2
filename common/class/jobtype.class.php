<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php"; 

class jobtype
	{
	var $mysql;
	function jobtype()
		{
		$this->mysql = new mysql;
		}
	
	function getjob_type()
		{
		$sql = "select * from `jobs_type` ";
		$data = $this->mysql->getdata($sql);
		return $data;
		}
	
	function add_jobtype($name)
		{
		$sql = "insert into jobs_type(`name`) values ('".$name."')";
		$result1=$this->mysql->queryinsert($sql,"jobs_type");
		}	
		
	function deletejobtype($id)
		{
		$sql = "delete from `jobs_type` where id='".$id."'";
		$result1=$this->mysql->query($sql);
		return true;
		}
	
	function edit_jobtype($name,$id)
		{
		$sql = "update `jobs_type` set name='".$this->mysql->magicquotes($name)."' where id='".$id."'";;
		$result = $this->mysql->query($sql);
		}
		
	function getById($id)
		{
		$sql = "select * from `jobs_type` where id='".$id."'";
		$data = $this->mysql->queryrow($sql);
		return $data['name'];
		}
		
	}
?>