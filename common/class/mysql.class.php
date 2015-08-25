<?php
require_once "config.class.php";
class mysql 
	{
	var $cn;
	var $db;
	var $last_sql;
	var $num;
	var $username;
	var $password;
	var $hostname;
	
	function magicquotes($text)
		{
			if (!get_magic_quotes_gpc()) 
			{
			   $text = addslashes($text);
			}    
			return $text;
		}
		
	function mysql()
		{
		$username="foongigs";
		$password="foongigs";
		$hostname="localhost";
		$database="foongigs";
		$this->cn = mysql_connect($hostname,$username,$password) or die("MYSQL : Error : DB CONNECT ");
		$this->db = mysql_select_db($database,$this->cn) or die("MYSQL : ERROR : DB SELECT : ".mysql_error());
		}
	function __mysql()
		{
		mysql_close($this->cn);
		}
	function getdata($sql)
		{
		$this->last_sql = $sql;
		$link = mysql_query($sql,$this->cn) or die("MYSQL : QUERY : ".$sql." : ".mysql_error());
		$num = mysql_num_rows($link);
		$this->num = $num;
		if($num > 0)
			{
			while($dt = mysql_fetch_assoc($link))
				$data[] = $dt;
			return $data;
			}
		else
			return $num;
		}
		
	function queryrow($sql)
		{
		$this->last_sql = $sql;
		$link = mysql_query($sql,$this->cn) or die("MYSQL : QUERY : ".$sql." : ".mysql_error());
		$num = mysql_num_rows($link);
		$this->num = $num;
		if($num > 0)
			{
			$data = mysql_fetch_assoc($link);
			return $data;
			}
		else
			return $num;
		}
		
	function queryinsert($sql,$table)
		{
		//echo $sql;
		$link = mysql_query("LOCK TABLES ".$table." WRITE",$this->cn) or die("MYSQL : ERROR : LOCK TABLE : ".mysql_error());
		$link = mysql_query($sql,$this->cn);
		$result = mysql_insert_id($this->cn) or die("MYSQL : ERROR : MAXID : ".mysql_error());
		$link = mysql_query("UNLOCK TABLES") or die("MYSQL : ERROR : UNLOCK TABLES : ".mysql_error());
		return $result;
		}
	
	function query($sql)
		{
//		echo $sql;
//		exit();
		$link = mysql_query($sql,$this->cn) or die("MYSQL : ERROR : ".$sql." : ".mysql_error());
		}
	}
?>