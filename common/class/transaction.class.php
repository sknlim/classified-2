<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
class transaction
	{
	var $mysql;
	var $userid;
	var $table;
	function transaction()
		{
		$user = new user;
		$this->userid = $user->getLoggedID();
		if($this->userid <= 0)
			{
		
			echo "Error: User Must Be Logged in to Access Transaction";
			exit();
			}
		$this->mysql = new mysql;
		$this->table = 'transaction';
		}
	function balance()
		{
		$sql = "select sum(amount) as balance from `transaction` where userid='".$this->userid."'";
		$data = $this->mysql->queryrow($sql);
		if($this->mysql->num <= 0 || $data['balance']=="")
			return 0;
		return $data['balance'];
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
		$data = $this->mysql->getdata($sql);
		return $data;
		}
	function deposit($amount,$payment_type,$description)
		{
		if($amount <= 0)
			{
			echo "Deposit Amount - Must be a +ve Amount - Errro: Program Terminated!";
			exit();
			}
		$sql = "insert into `".$this->table."` (`userid`,`amount`,`transaction_type`,`payment_type`,`description`) values('".$this->userid."','".$amount."','debit','".$payment_type."','".$this->mysql->magicquotes($description)."'";
		return $this->mysql->queryinsert($sql,$this->table);
		}
	function withdraw($amount)
		{
		if($this->balance() >= $amount)
			{
			$sql = "insert into `transaction_withdraw` (`userid`,`amount`) values('".$this->userid."','".$amount."')";
			$this->mysql->queryinsert($sql,"transaction_withdraw");
			return "Request Submitted - Pending Withdraw";
			}
		else
			{
			return "Insufficient Balance";
			}
		}
	function escrow($amount,$touserid)
		{
		if($amount <= 0)
			{
			return "Amount Must be +ve value - Error - Program Terminated";
			}
		$user = new user;
		$user_data = $user->getbyId($this->userid);
		if($user_data['type']!="provider")
			{
			return "Only Seeker Account is allowed to send escrow payment";
			}
		if($this->balance() < $amount)
			{
			return "Insufficient Balance! ";
			}
		$touserid_data = $user->getbyid($touserid);
		if($touserid_data['type'] != "provider")
			{
			return "Only Provider Account can accept Escrow Payment!";
			}
		if($touserid_data['active']!="yes")
			{
			return "Provider Account is not Active!";
			}
		
		$sql = "LOCK TABLES `".$this->table."`";
		$this->mysql->query($sql);
		$sql = "LOCK TABLES `transaction_escrow`";
		$this->mysql->query($sql);
		$sql = "insert into `".$this->table."` (`userid`,`amount`,`payment_type`,`transaction_type`,`description`) values 
				('".$this->userid."','".(($amount)*(-1))."','escrow','debit','Escrow Payment To '".$touserid_data['username']."')";
		$this->mysql->query($sql);
		$debit_transaction_id = mysql_insert_id($this->mysql->cn);
		$sql = "insert into `transaction_escrow` (`debit_transaction_id`,`amount`,`provider_userid`,`seeker_userid`) values 
				('".$debit_transaction_id."','".$amount."','".$this->userid."','".$touserid."')";
		$this->mysql->query($sql);
		$this->mysql->query("UNLOCK TABLES");
		
		return "Amount Ready in Escrow";
		}
	function cancel_escrow($id)
		{
		$sql = "select * from `transaction_escrow` where id='".$id."'";
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
	function list_escrow()
		{
		$user = new user();
		$user_data = $user->getbyid($this->userid);
		if($user_data['type']=="seeker")
			$sql = "select * from transaction_escrow where seeker_userid='".$this->userid."'";
		else if($user_data['type']=="provider")
			$sql = "select * from transaction_escrow where provider_userid='".$this->userid."'";
		else
			{
			echo "Error : User Type : Contact Admin ";
			exit();
			}
		$escrow_list = $this->mysql->getdata($sql);
		return $escrow_list;
		}
	function makepayment($amount,$touserid)
		{
		
		}
		
	function checkbalance()
	{
		$sql="select sum(amount) as total from transaction_withdraw where userid='".$_SESSION['foongigs_userid']."'";
		$data=$this->mysql->queryrow($sql);
		return $data['total'];
	}	

	}
?>