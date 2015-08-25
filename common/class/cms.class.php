<?php
class cms	
	{
	var $table;
	var $mysql;
	var $type;

	function cms($table='cms')
		{
		$this->table = $table;
		require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php";
		$this->mysql = new mysql;
		}

	function getpage($pageid)
		{
		$sql = "select * from ".$this->table." where id='".$pageid."' and status='active'";
		$page = $this->mysql->queryrow($sql);
		$page['content'] = urldecode($page['content']);
		return $page;
		}
	function getpagebyfilename($filename)
		{
		$sql = "select * from ".$this->table." where filename='".$filename."' and status='active' ";
		$page = $this->mysql->queryrow($sql);
		$page['content'] = urldecode($page['content']);
		return $page;
		}
		
	function getStaticPage()
		{
		$sql = "select * from ".$this->table." where status='active' order by filename DESC ";
		$page = $this->mysql->getdata($sql);
		return $page;
		}
		
	function get_type_static()
		{
		$sql = "select * from ".$this->table." ";
		$page = $this->mysql->getdata($sql);
		return $page;
		}

	function updatepage($pageid,$filename,$menuname,$title,$meta_keywords,$meta_description,$content)
		{
		$sql = "update ".$this->table." set 
		`filename`='".$filename."',`menuname`='".$menuname."',
		`title`='".$title."',
		`meta_keywords`='".$meta_keywords."',
		`meta_description`='".$meta_description."',
		`content`='".$content."' where id='".$pageid."'";
		return $this->mysql->query($sql);
		}

	function createpage($filename,$menuname,$title,$meta_keywords,$meta_description,$content)
		{
		 $sql = "insert into ".$this->table."(`filename`,`menuname`,`title`,`meta_keywords`,`meta_description`,`content`)
			values('".$filename."','".$menuname."','".$title."','".$meta_keywords."','".$meta_description."','".urlencode(stripslashes($content))."')";
		return $this->mysql->queryinsert($sql,$this->table);
		}

	function deletepage($pageid)
		{
		$sql = "delete from ".$this->table." where id='".$pageid."'";
		return $this->mysql->query($sql);
		}
	
	function approve_page($id)
		{
					
					$status="active";
					$sql = "update ".$this->table." set status='".$status."' where id='".$id."'";
					$result=$this->mysql->query($sql);
					return $result;
		}
		
	function block_page($id)
		{
				
					$status="block";
					$sql = "update ".$this->table." set status='".$status."' where id='".$id."'";
					$result=$this->mysql->query($sql);
					return $result;
		}
	}
?>