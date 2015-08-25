<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
class transaction_admin
	{
	var $mysql;
	var $userid;
	var $table;
	function transaction_admin()
		{
		$this->mysql = new mysql;
		$this->table = 'transaction';
		}
	
	function getall()
		{
		$sql = "select * from `".$this->table."`";
		$data = $this->mysql->getdata($sql);
		return $data;
		}
	function getbyid($id)
		{
	    $sql = "select * from `".$this->table."` where id='".$id."'";
		$data = $this->mysql->queryrow($sql);
		return $data;
		}
	
	function add_transaction($ar)
		{
		if($ar['transaction_type']=="debit")
		{
		$amount="-".$ar['amount'];
		}
		else
		{
		$amount=$ar['amount'];
		}
		 $sql = "insert into `".$this->table."` (`userid`,`amount`,`transaction_type`,`payment_type`,`description`) values('".$ar['user']."','".$amount."','".$ar['transaction_type']."','manual','".$this->mysql->magicquotes($ar['description'])."')";
		return $this->mysql->queryinsert($sql,$this->table);
		}
		
	function delete_transaction($id)
		{
		$sql = "delete from `".$this->table."` where id='".$id."'";
		$this->mysql->query($sql);
		}
	
	function edit_transaction($ar,$id)
		{
			if($ar['transaction_type']=="debit")
				{
				$amount="-".$ar['amount'];
				}
			else
				{
				$amount=$ar['amount'];
				}
			
			$sql = "update `".$this->table."` set userid='".$ar['user']."',amount='".$amount."',transaction_type='".$ar['transaction_type']."',payment_type='".$ar['payment_type']."',description='".$ar['description']."' where id='".$id."'";;
			$result = $this->mysql->query($sql);
		}
	
		function cancel_escrow($id)
		{
		echo $sql = "select * from `transaction_escrow` where id='".$id."'";
		$escrow_data = $this->mysql->queryrow($sql);
		if($escrow_data['id']!=$id)
			return "Error : No, Escrow Payment Found with ID : ".$id;
		if($escrow_data['seeker_userid']!=$this->userid)
			return "Error : Operation Not Allowed ! You cannot cancel the Escrow Payment";
		$user= new user;
		$user_data = $user->getbyid($this->userid);
		$sql = "LOCK TABLES `".$this->table."`";
		$this->mysql->query($sql);
		$sql = "LOCK TABLES `transaction_escrow`";
		$this->mysql->query($sql);
	
		$sql = "insert into `".$this->table."` (`userid`,`amount`,`payment_type`,`transaction_type`,`description`) values 
				('".$escrow_data['provider_userid']."','".$escrow_data['amount']."','escrow_cancel','credit','Escrow Payment Cancelled From '".$user_data['username']."')";
		$this->mysql->query($sql);
		$sql = "delete from `transaction_escrow` where id='".$id."'";
		$this->mysql->query($sql);
		$this->mysql->query("UNLOCK TABLES");
		return "Escrow Payment Cancelled";
		}
		
	function complete_escrow($id)
		{
		$sql = "select * from `transaction_escrow` where id='".$id."'";
		$escrow_data = $this->mysql->queryrow($sql);
		if($escrow_data['id']!=$id)
			return "Error : No, Escrow Payment Found with ID : ".$id;
		if($escrow_data['provider_userid']!=$this->userid)
			return "Error : Operation Not Allowed ! You cannot complete the Escrow Payment";
		$user= new user;
		$user_data = $user->getbyid($this->userid);
		$sql = "LOCK TABLES `".$this->table."`";
		$this->mysql->query($sql);
		$sql = "LOCK TABLES `transaction_escrow`";
		$this->mysql->query($sql);
		$sql = "insert into `".$this->table."` (`userid`,`amount`,`payment_type`,`transaction_type`,`description`) values 
				('".$escrow_data['seeker_userid']."','".$escrow_data['amount']."','escrow_complete','credit','Escrow Payment Completed From '".$user_data['username']."')";
		$this->mysql->query($sql);
		$sql = "delete from `transaction_escrow` where id='".$id."'";
		$this->mysql->query($sql);
		$this->mysql->query("UNLOCK TABLES");
		return "Escrow Payment Completed";
		}
	function getall_escrow()
		{
		$sql = "select * from `transaction_escrow`";
		$data = $this->mysql->getdata($sql);
		return $data;
		}
	function getall_withdraw($show="all")
		{
		if($show=="all")
		{
			$sql = "select * from `transaction_withdraw`";
		}
		elseif($show=="complete")
		{
			$sql = "select * from `transaction_withdraw` where status='process'";
		}
		elseif($show=="pending")
		{
			$sql = "select * from `transaction_withdraw` where status='pending'";
		}
		$data = $this->mysql->getdata($sql);
		return $data;
		}
	
	function process_withdraw($id)
		{
					
					$status="process";
					$sql = "update transaction_withdraw set status='".$status."' where id='".$id."'";
					$result=$this->mysql->query($sql);
					return $result;
		}
		
	function pending_withdraw($id)
		{
				
					$status="pending";
					$sql = "update transaction_withdraw set status='".$status."' where id='".$id."'";
					$result=$this->mysql->query($sql);
					return $result;
		}
		
	function cancel_withdraw($id)
		{
				
					$status="cancel";
					$sql = "update transaction_withdraw set status='".$status."' where id='".$id."'";
					$result=$this->mysql->query($sql);
					return $result;
		}
	
	}
?>