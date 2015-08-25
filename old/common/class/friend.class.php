<?php
class friend
{
function addasafriend($fid)
{
		$cn = connect_db();
		$sql = "select * from `friend` where userid='".$_SESSION['gallery_userid']."' and friendid='".$fid."'";
		$result = mysql_query($sql,$cn) or die("ERROR :".mysql_error());
		$num=mysql_num_rows($result);
		
		if($num>0)
		{
			$str=2;
		}

		else
		{
			$sql = "insert into `friend` (userid,friendid,status) values('".$_SESSION['gallery_userid']."','".$fid."','0')";
			$result = mysql_query($sql,$cn) or die("ERROR :".mysql_error());
			$str=1;
		}
		disconnect_db($cn);
		return $str;
}

function countfriends($uid)
{
		$cn = connect_db();
		$sql = "select count(*) as cnt from `friend` where (userid='".$uid."' OR friendid='".$uid."') and status='1'";
		$result = mysql_query($sql,$cn) or die("ERROR 1:".mysql_error());
		$data=mysql_fetch_assoc($result);
		disconnect_db($cn);
		return $data['cnt'];
}
function getfriendlist($uid,$sr="",$ps="")
{
		$cn = connect_db();
		if($sr=="" && $ps=="")
		$sql="select * from `friend`  where (userid='".$uid."' OR friendid='".$uid."') and status='1'";
		else
		$sql="select * from `friend`  where (userid='".$uid."' OR friendid='".$uid."') and status='1' LIMIT $sr,$ps";
		$result = mysql_query($sql,$cn) or die("ERROR 4:".mysql_error());
		$array=array();
		while($data = mysql_fetch_assoc($result))
		{
		$array[]=$data;
		}
		disconnect_db($cn);
		
		return $array;
}


function countfriendrequests()
{
		$cn = connect_db();
		$sql = "select count(*) as cnt from `friend` where friendid='".$_SESSION['gallery_userid']."' and status='0'";
		$result = mysql_query($sql,$cn) or die("ERROR 2:".mysql_error());
		$data=mysql_fetch_assoc($result);
		disconnect_db($cn);
		return $data['cnt'];
}
function getfriendrequestlist()
{
		$cn = connect_db();
//		$sql = "select *  from `friend` where userid='".$_SESSION['gallery_userid']."' and status='0'";
		$sql="select * from `friend`  where friendid='".$_SESSION['gallery_userid']."' and status='0'";
		$result = mysql_query($sql,$cn) or die("ERROR 3:".mysql_error());
		$array=array();
		while($data = mysql_fetch_assoc($result))
		{
		$array[]=$data;
		}
		disconnect_db($cn);
		return $array;
}

function countfriendinvites()
{
		$cn = connect_db();
		$sql = "select count(*) as cnt from `friend` where userid='".$_SESSION['gallery_userid']."' and status='0'";
		$result = mysql_query($sql,$cn) or die("ERROR 2:".mysql_error());
		$data=mysql_fetch_assoc($result);
		disconnect_db($cn);
		return $data['cnt'];
}

function getinvitefriendlist()
{
		$cn = connect_db();
		$sql="select * from `friend`  where userid='".$_SESSION['gallery_userid']."' and status=0";
		$result = mysql_query($sql,$cn) or die("ERROR 3:".mysql_error());
		$array=array();
		while($data = mysql_fetch_assoc($result))
		{
		$array[]=$data;
		}
		disconnect_db($cn);
		return $array;
}




function acceptfriend($fid)
{
		$cn = connect_db();
//		$sql = "update `friend` set status='1' where userid='".$_SESSION['gallery_userid']."' and friendid='".$fid."' and status='0'";
$sql="update `friend` set status='1' where userid='".$fid."' and  friendid='".$_SESSION['gallery_userid']."'";
		$result = mysql_query($sql,$cn) or die("ERROR :".mysql_error());
	//	$sql = "insert into `friend` (friendid,userid,status) values('".$_SESSION['gallery_userid']."','".$fid."','1')";
	//	$result = mysql_query($sql,$cn) or die("ERROR :".mysql_error());
		disconnect_db($cn);
		return $array;
}

function rejectfriend($fid)
{
		$cn = connect_db();
		$sql = "delete from `friend` where userid='".$fid."' and  friendid='".$_SESSION['gallery_userid']."'";
		$result = mysql_query($sql,$cn) or die("ERROR :".mysql_error());
		disconnect_db($cn);
}		
		
 
function deletefriend($fid)
{
	$cn = connect_db();
//	$sql = "delete from `friend` where friendid='".$fid."' and  userid='".$_SESSION['gallery_userid']."'";
	$sql="delete from `friend` where (userid='".$fid."' and  friendid='".$_SESSION['gallery_userid']."') or (userid='".$_SESSION['gallery_userid']."' and  friendid='".$fid."')"  ;
	$result = mysql_query($sql,$cn) or die("ERROR :".mysql_error());
	disconnect_db($cn);
	
}

function cancelfriendrequest($fid)
{
	$cn = connect_db();
	$sql = "delete from `friend` where friendid='".$fid."' and  userid='".$_SESSION['gallery_userid']."'";
	$result = mysql_query($sql,$cn) or die("ERROR :".mysql_error());
	disconnect_db($cn);
	
}
}

?>