<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/email.class.php";
class user extends mysql
	{ 
	var $error;	
function count_users()
			{
			$sql_count_users = "SELECT COUNT(id) as total_users,COUNT(active=0) as non_active FROM `users` where username!='admin'";
			return $result1 = $this->getdata($sql_count_users);
			}
		function count_active_users()
			{
			$sql_count_active_users = "SELECT COUNT(active) as active FROM `users` WHERE active='1' and username!='admin'";
			return $result1 = $this->getdata($sql_count_active_users);
			}
		
		function deleteuser($uid)
			{
				$sql = "select * from `users` where id='".$uid."'";
				$result1 = $this->queryrow($sql);
			if($result1!=0)
				{
				$ans=true;
				$sql = "delete from `users` where id='".$uid."'";
				$result1=$this->query($sql);
				}
				else
				{
				$ans=false;
				}
				return $ans;
			}
		function approve_user($id)
			{
						
						$status="yes";
						$sql = "update users set active='".$status."' where id='".$id."'";
						$result=$this->query($sql);
						return $result;
			}
			
		function block_user($id)
			{
					
						$status="no";
						echo $sql = "update users set active='".$status."' where id='".$id."'";
						$result=$this->query($sql);
						return $result;
			}
		
		function suspend_user($id)
			{
					
						$status="suspended";
						$sql = "update users set active='".$status."' where id='".$id."'";
						$result=$this->query($sql);
						return $result;
			}
	}
			?>