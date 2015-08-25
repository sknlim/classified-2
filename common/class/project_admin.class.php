<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php"; 

class project_admin extends project 
	{
	var $mysql;
	function project_admin()
		{
		$this->mysql = new mysql;
		}
	
	function getAllBids($pid)
	{
		$sql="select *,UNIX_TIMESTAMP(bid_time) as bid_time from projects_bids where projectid='".$pid."'";
		$data=$this->mysql->getdata($sql);
		return $data;
	}	
		
	function gettitle($pid)
		{
		$sql = "select * from `projects` where `id`='".$pid."'";
		$data=$this->mysql->queryrow($sql);
		return $data['project_title'];
		}
		
		
	function get_bid_details($pid)
		{
		return $bid=$this->getAllBids($pid);
		}
	
	function delete_bid($id)
		{
		$sql = "delete from `projects_bids` where id='".$id."'";
		$result1=$this->mysql->query($sql);
		return true;
		}

	function get_bid_by_id($id)
	{
		$sql="select *,UNIX_TIMESTAMP(bid_time) as bid_time from projects_bids where id='".$id."'";
		$data=$this->mysql->queryrow($sql);
		return $data;
	}
	
	function edit_bid($ar,$bid_id)
		{
		 $sql = "update `projects_bids` set comment='".$this->mysql->magicquotes($ar['comments'])."',days='".$ar['days']."',amount='".$ar['amount']."' where id='".$bid_id."'";;
				 $result = $this->mysql->query($sql);
		}
	
	}
?>