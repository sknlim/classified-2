<?php
class message
{
function postmessage($ar)
{
	$cn = connect_db();
	$sql = "insert into `message` (touserid,fromuserid,subject,message,name) values ('".$ar['touserid']."','".$ar['fromuserid']."','".magicquotes(htmlspecialchars($ar['subject']))."','".formattext(htmlspecialchars(magicquotes($ar['message'])))."','".htmlspecialchars($ar['name'])."')";
	$result = mysql_query($sql,$cn) or die("ERROR :".mysql_error());
	disconnect_db($cn);
}

function getallmessages($uid,$sr="",$ps="")
{
	$cn = connect_db();
	if($sr=="" && $ps=="")
	{
	$sql = "select * from `message` where touserid='".$uid."'";
	}
	else
	{
	$sql = "select * from `message` where touserid='".$uid."' LIMIT $sr,$ps";
	}
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	//$array=array();
	while($data = mysql_fetch_assoc($link))
		{
		$array[]=$data;
		}
	disconnect_db($cn);
	return $array;
}

function countmessages($uid)
{
	$cn = connect_db();
	$sql = "select count(*) as cnt from `message` where touserid='".$uid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$data = mysql_fetch_assoc($link);
	disconnect_db($cn);
	return $data['cnt'];
}

function deletemessage($mid)
{
	$cn = connect_db();
	$sql = "delete from message where id='".$mid."'";
	$result = mysql_query($sql,$cn) or die("ERROR :".mysql_error());
	disconnect_db($cn);
}



}
?>