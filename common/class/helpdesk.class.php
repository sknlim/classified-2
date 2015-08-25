<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php"; 

class helpdesk
	{
	var $mysql;
	function helpdesk()
		{
		$this->mysql = new mysql;
		if($_SESSION['foongigs_userid']=="")
			{
			echo "Error Can't Create Object Without Login";
			exit();
			}
		}
	
	function send_message($subject,$description)
		{
		 $sql = "insert into helpdesk(subject,userid) values ('".$this->mysql->magicquotes($subject)."','".$_SESSION['foongigs_userid']."')";
		 $helpdesk_id = $this->mysql->queryinsert($sql,"helpdesk");
	
		 $sql1 = "insert into helpdesk_message(description,helpdesk_id,userid) values ('".$this->mysql->magicquotes($description)."','".$helpdesk_id."','".$_SESSION['foongigs_userid']."')";
		 $message_id = $this->mysql->queryinsert($sql1,"helpdesk_message");
			
				
		}
	
	
	function add_entry($description,$helpdesk_id)
		{
			
		 $sql1 = "insert into helpdesk_message(description,helpdesk_id,userid) values ('".$this->mysql->magicquotes($description)."','".$helpdesk_id."','".$_SESSION['foongigs_userid']."')";
		 $message_id = $this->mysql->queryinsert($sql1,"helpdesk_message");
			
				
		}
		
	
	function reply_entry_admin($description,$helpdesk_id,$admin)
		{
			
		 $sql1 = "insert into helpdesk_message(description,helpdesk_id,userid) values ('".$this->mysql->magicquotes($description)."','".$helpdesk_id."','".$admin."')";
		 $message_id = $this->mysql->queryinsert($sql1,"helpdesk_message");
			
				
		}
		
	
	function delete_request($id)
		{
		$sql = "delete from `helpdesk` where id='".$id."'";
		$result1=$this->mysql->query($sql);
		return true;
		}
	
	
	function get_all_request($type="open")
		{
		if($type=="open" || $type=="resolved")
			$sql = "select * from `helpdesk`  where status='".$type."' and userid='".$_SESSION['foongigs_userid']."' order by `timestamp`";
		elseif($type=="all")
			$sql = "select * from `helpdesk` where userid='".$_SESSION['foongigs_userid']."' order by `timestamp`";
		$data = $this->mysql->getdata($sql);
		return $data;
		}	
	
	function get_message_by_id($id)
		{
		$sql = "select *,UNIX_TIMESTAMP(timestamp) as time_stamp from `helpdesk_message` where helpdesk_id=".$id." ";
		$data = $this->mysql->getdata($sql);
		return $data;
		}	
		
	function get_userid_by_id($id)
		{
		$sql = "select * from `helpdesk` where id=".$id." ";
		$data = $this->mysql->queryrow($sql);
		return $data['userid'];
		}
		
	function get_subject_by_id($id)
		{
		$sql = "select * from `helpdesk` where id=".$id."";
		$data = $this->mysql->queryrow($sql);
		return $data['subject'];
		}
	
	function get_resolved_request()
		{
		$sql = "select * from `jobs` where id='".$id."'";
		$data = $this->mysql->queryrow($sql);
		return $data;
		}	
		
	function open_request($id)
		{
					
					$status="open";
					$sql = "update helpdesk set status='".$status."' where id='".$id."'";
					$result=$this->mysql->query($sql);
					return $result;
		}
		
	function close_request($id)
		{
				
					$status="close";
					$sql = "update helpdesk set status='".$status."' where id='".$id."'";
					$result=$this->mysql->query($sql);
					return $result;
		}
	
	function resolved_request($id)
		{
				
					$status="resolved";
					$sql = "update helpdesk set status='".$status."' where id='".$id."'";
					$result=$this->mysql->query($sql);
					return $result;
		}
	
	function reopen_request($id)
		{
				
					$status="reopen";
					$sql = "update helpdesk set status='".$status."' where id='".$id."'";
					$result=$this->mysql->query($sql);
					return $result;
		}	
		
	}
?>