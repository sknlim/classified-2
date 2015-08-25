<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php";
class contactus
	{
	var $mysql;
		function contactus()
			{
			$this->mysql = new mysql;
			}
			
		function add($type,$subject,$project_id,$url,$description)
			{
			 $sql = "insert into contactus(`type`,`subject`,`projects_id`,`url`,`description`,`userid`) values ('".$type."','".$this->mysql->magicquotes($subject)."','".$project_id."','".$this->mysql->magicquotes($url)."','".$this->mysql->magicquotes($description)."','".$_SESSION['foongigs_userid']."')";
			 $result1=$this->mysql->queryinsert($sql,"contactus");
			}
			
		function add_general($type,$subject,$description,$email)
			{
			 $sql = "insert into contactus(`type`,`subject`,`description`,`userid`,`email`) values ('".$type."','".$this->mysql->magicquotes($subject)."','".$this->mysql->magicquotes($description)."','".$_SESSION['foongigs_userid']."','".$email."')";
			 $result1=$this->mysql->queryinsert($sql,"contactus");
			}
			
		function get_list_all()
			{
			$sql = "select * from `contactus` limit 0,20";
			$data = $this->mysql->getdata($sql);
			return $data;
			}
		
		function deletecontactus($id)
			{
			$sql = "delete from `contactus` where id='".$id."'";
			$result1=$this->mysql->query($sql);
			return true;
			}
			
		function get_list_for_type($type)
			{
			$sql = "select * from `contactus` where type='".$type."'";
			$data = $this->mysql->getdata($sql);
			return $data;
			}
	}
?>