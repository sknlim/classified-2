<?php
require_once "config.php";
function image_delete($pid)
{
	$cn = connect_db();
	$sql = "SELECT * FROM `photo` WHERE id='".$pid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$data=mysql_fetch_assoc($link);

	
	$path=str_replace(get_domain_path(),"",$data['original_url']);
	unlink(get_full_domain_path().$path);
	
//	$path=str_replace(get_domain_path(),"",$data['medium_url']);
	//unlink(get_full_domain_path().$path);
	
	$path=str_replace(get_domain_path(),"",$data['thumb_url']);
	unlink(get_full_domain_path().$path);

	$sql = "DELETE FROM `photo` WHERE id='".$pid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	disconnect_db($cn);
}

function deleteuser($uid)
{
	$cn = connect_db();
	$sql = "select * from `users` where userid='".$uid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$num=mysql_num_rows($link);
	disconnect_db($cn);

	if($num>0)
	{
	$ans=true;
	cancelphoto($uid);
	canceldiary($uid);
	cancelmessage($uid);
	cancelfriend($uid);
	canceluser($uid);
	}

	else
	{
	$ans=false;
	}
	
	return $ans;
}

function cancelphoto($uid)
{
	$cn = connect_db();
	$sql = "select * from `photo` where userid='".$uid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	while($data=mysql_fetch_assoc($link))
	{
	image_delete($data['id']);
	}
	disconnect_db($cn);
}

function canceldiary($uid)
{
	$cn = connect_db();
	$sql = "delete from `diary` where userid='".$uid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	disconnect_db($cn);
}

function cancelmessage($uid)
{
	$cn = connect_db();
	$sql = "delete from `message` where touserid='".$uid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	disconnect_db($cn);
}

function cancelfriend($uid)
{
	$cn = connect_db();
	$sql = "delete from `friend` where userid='".$uid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	disconnect_db($cn);
}

function canceluser($uid)
{
	$cn = connect_db();
	$sql = "delete from `users` where userid='".$uid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	disconnect_db($cn);
}

function getuserimage($uid)
{
	$cn = connect_db();
	$sql = "select * from `users` where userid='".$uid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$data = mysql_fetch_assoc($link);
	disconnect_db($cn);
	if($data['photoid']=="0")
	{
	$str=get_domain_path()."../images/nophoto.jpg";
	}
	else
	{
	$str=getthumbimagefromid($data['photoid']);
	}
	return $str;
}

function getthumbimagefromid($id)
{
	$cn = connect_db();
	$sql = "SELECT *,UNIX_TIMESTAMP(upload_time) as upload_time FROM `photo` WHERE id='".$id."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$data=mysql_fetch_assoc($link);
	disconnect_db($cn);
	if ($data['thumb_url']=="")
	{
	$str=get_domain_path()."images/nophoto.gif";
	}
	else
	{
	$str=$data['thumb_url'];
	}
	return $str;
}

function getusercountry($uid)
{
		$cn = connect_db();
		$sql = "select * from `users` where userid='".$uid."'";
		$result = mysql_query($sql,$cn) or die("ERROR :".mysql_error());
		$data=mysql_fetch_assoc($result);
		$sql1 = "select * from `country` where CountryId='".$data['country']."'";
		$result1 = mysql_query($sql1,$cn) or die("ERROR :".mysql_error());
		$data1=mysql_fetch_assoc($result1);
		$str=$data1['Country'];
		disconnect_db($cn);
		return $str;
}
function listblogimages($bid,$uid)
{
	$cn = connect_db();
	$sql = "SELECT *, DATE(sdate) as sdate, 
			DATE(edate) as edate
			FROM diary
			WHERE id='".$bid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$data = mysql_fetch_assoc($link);
	$sdate=$data['sdate'];
	$edate=$data['edate'];

	$sql = "SELECT * 
			FROM photo
			WHERE userid='".$uid."' and DATE(upload_time) BETWEEN '".$sdate."' and '".$edate."' order by upload_time DESC ";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	//$array=array();
	while($data = mysql_fetch_assoc($link))
		{
		$array[]=$data;
		}
	disconnect_db($cn);
	return $array;
}
#List username by putting userid 	
function list_users($limit)
	{
	$cn=connect_db();
	$sql_list_users = "SELECT * FROM `users` where userid != 1 ORDER BY createtime DESC".$limit;
	$result_list_users = mysql_query($sql_list_users,$cn) or die("ERROR : list_users()".mysql_error());
	$array=array();
	while($data=mysql_fetch_assoc($result_list_users))
		{
		$array[]=$data;
		}
		disconnect_db($cn);

	return $array;	
	
	}

function totalsignupbydate($d)
{
$cn=connect_db();
$sql="SELECT count(*) AS cnt
		FROM `users`
		WHERE DATE(createtime)='".$d."'";
$link=mysql_query($sql,$cn) or die ("Error : ".mysql_error());		
$data=mysql_fetch_assoc($link);
disconnect_db($cn);
return $data['cnt'];
}

function totalsignupmalebydate($d)
{
$cn=connect_db();
$sql="SELECT count(*) AS cnt
		FROM `users`
		WHERE DATE(createtime)='".$d."' and gender='Male'";
$link=mysql_query($sql,$cn) or die ("Error : ".mysql_error());		
$data=mysql_fetch_assoc($link);
disconnect_db($cn);
return $data['cnt'];
}

function totalsignupfemalebydate($d)
{
$cn=connect_db();
$sql="SELECT count(*) AS cnt
		FROM `users`
		WHERE DATE(createtime)='".$d."' and gender='Female'";
$link=mysql_query($sql,$cn) or die ("Error : ".mysql_error());		
$data=mysql_fetch_assoc($link);
disconnect_db($cn);
return $data['cnt'];
}

function totalsignupbymonthyear($m,$y)
{
$cn=connect_db();
$sql="SELECT count(*) AS cnt
		FROM `users`
		WHERE MONTH(createtime)='".$m."' and YEAR(createtime)='".$y."'";
$link=mysql_query($sql,$cn) or die ("Error : ".mysql_error());		
$data=mysql_fetch_assoc($link);
disconnect_db($cn);
return $data['cnt'];

}

function totalsignupmalebymonthyear($m,$y)
{
$cn=connect_db();
$sql="SELECT count(*) AS cnt
		FROM `users`
		WHERE MONTH(createtime)='".$m."' and YEAR(createtime)='".$y."' and gender='Male'";
$link=mysql_query($sql,$cn) or die ("Error : ".mysql_error());		
$data=mysql_fetch_assoc($link);
disconnect_db($cn);
return $data['cnt'];

}

function totalsignupfemalebymonthyear($m,$y)
{
$cn=connect_db();
$sql="SELECT count(*) AS cnt
		FROM `users`
		WHERE MONTH(createtime)='".$m."' and YEAR(createtime)='".$y."' and gender='Female'";
$link=mysql_query($sql,$cn) or die ("Error : ".mysql_error());		
$data=mysql_fetch_assoc($link);
disconnect_db($cn);
return $data['cnt'];

}

function totalsignupbyyear($y)
{
$cn=connect_db();
$sql="SELECT count(*) AS cnt
		FROM `users`
		WHERE YEAR(createtime)='".$y."'";
$link=mysql_query($sql,$cn) or die ("Error : ".mysql_error());		
$data=mysql_fetch_assoc($link);
disconnect_db($cn);
return $data['cnt'];


}

function totalsignupmalebyyear($y)
{
$cn=connect_db();
$sql="SELECT count(*) AS cnt
		FROM `users`
		WHERE YEAR(createtime)='".$y."' and gender='Male'";
$link=mysql_query($sql,$cn) or die ("Error : ".mysql_error());		
$data=mysql_fetch_assoc($link);
disconnect_db($cn);
return $data['cnt'];

}

function totalsignupfemalebyyear($y)
{
$cn=connect_db();
$sql="SELECT count(*) AS cnt
		FROM `users`
		WHERE YEAR(createtime)='".$y."' and gender='Female'";
$link=mysql_query($sql,$cn) or die ("Error : ".mysql_error());		
$data=mysql_fetch_assoc($link);
disconnect_db($cn);
return $data['cnt'];

}

function totalsignupbymonth($m,$y)
{
$cn=connect_db();
$sql="SELECT count(*) AS cnt
		FROM `users`
		WHERE MONTH(createtime)='".$m."' and YEAR(createtime)='".$y."'";
$link=mysql_query($sql,$cn) or die ("Error : ".mysql_error());		
$data=mysql_fetch_assoc($link);
disconnect_db($cn);
return $data['cnt'];

}

function totalsignupmalebymonth($m,$y)
{
$cn=connect_db();
$sql="SELECT count(*) AS cnt
		FROM `users`
		WHERE MONTH(createtime)='".$m."' and YEAR(createtime)='".$y."' and gender='Male'";
$link=mysql_query($sql,$cn) or die ("Error : ".mysql_error());		
$data=mysql_fetch_assoc($link);
disconnect_db($cn);
return $data['cnt'];

}

function totalsignupfemalebymonth($m,$y)
{
$cn=connect_db();
$sql="SELECT count(*) AS cnt
		FROM `users`
		WHERE MONTH(createtime)='".$m."' and YEAR(createtime)='".$y."' and gender='Female'";
$link=mysql_query($sql,$cn) or die ("Error : ".mysql_error());		
$data=mysql_fetch_assoc($link);
disconnect_db($cn);
return $data['cnt'];

}





	
#List username by putting userid 	
function list_users_profile($userid)
	{
	$cn=connect_db();
	$sql_list_users_profile = "SELECT * FROM `users` WHERE userid='".$userid."'";
	$result_list_users_profile = mysql_query($sql_list_users_profile,$cn) or die("ERROR : list_users_profile()".mysql_error());
	$array=array();
	$data=mysql_fetch_assoc($result_list_users_profile);
	$array=$data;
	disconnect_db($cn);
	return $array;	
	}		

#list of user information		
function get_user_generalprofile($userid)
	{
	$cn=connect_db();
	$sql_get_user_generalprofile = "SELECT * FROM `users` WHERE userid='".$userid."'";
	$result_get_user_generalprofile = mysql_query($sql_get_user_generalprofile,$cn) or die("ERROR : get_user_generalprofile()".mysql_error());
	$array=array();
	$data=mysql_fetch_assoc($result_get_user_generalprofile);
	$array=$data;
	disconnect_db($cn);
	return $array;	
	}

	
function FuzzyTime($time)
    {
        define("ONE_DAY",86400);
    
        $now = time();
        // sod = start of day :)
        $sod = mktime(0,0,0,date("m",$time),date("d",$time),date("Y",$time));
        $sod_now = mktime(0,0,0,date("m",$now),date("d",$now),date("Y",$now));
        
        // check 'today'
        if ($sod_now == $sod)
        {
            return "Today at " . date("g:ia",$time);
        }
        // check 'yesterday'
        if (($sod_now-$sod) <= 86400)
        {
            return "Yesterday at " . date("g:ia",$time);
        }
        // give a day name if within the last 5 days
        if (($sod_now-$sod) <= (ONE_DAY*5))
        {
            return date("l \a\\t g:ia",$time);
        }
        // miss off the year if it's this year
        if (date("Y",$now) == date("Y",$time))
        {
            return date("M j \a\\t g:ia",$time);
        }
        // return the date as normal
        return date("M j, Y \a\\t g:ia",$time);
    } 

function seofilter_title($pt)
	{
	$page_title = "";
	for($i=0;$i<=strlen($pt);$i++)
		{
		if($pt[$i] >= 'A' && $pt[$i] <= 'Z')
			$page_title .= $pt[$i];
		else if($pt[$i] >= 'a' && $pt[$i] <= 'z')
			$page_title .= $pt[$i];
		else if($pt[$i] == " ")
			$page_title .= $pt[$i];
		}
	return trim($page_title);
	}		
	
function seofilter_meta($pt)
	{
	$page_title = "";
	for($i=0;$i<=strlen($pt);$i++)
		{
		if($pt[$i] >= 'A' && $pt[$i] <= 'Z')
			$page_title .= $pt[$i];
		else if($pt[$i] >= 'a' && $pt[$i] <= 'z')
			$page_title .= $pt[$i];
		else if($pt[$i] == " ")
			$page_title .= $pt[$i];
		else if($pt[$i] == ",")
			$page_title .= $pt[$i];
		else if($pt[$i] == "'")
			$page_title .= $pt[$i];	
		}
	return trim($page_title);
	}			
function dateformat($d)
{
$str=date("jS M Y",strtotime($d)); 
return $str; 
}

function getsearchdata($str)
{
$cn=connect_db();

 $sqlj = "select * from `users` where username like '".$str."%'";
$linkj = mysql_query($sqlj,$cn) or die("Error1 : ".mysql_error());
$dataj=mysql_fetch_assoc($linkj);
echo $totch=$dataj['username'];
	disconnect_db($cn);

}

function count_users()
	{
	$cn=connect_db();
	$sql_count_users = "SELECT COUNT(userid) as total_users,COUNT(status=0) as non_active FROM `users` where username!='admin'";
	$result_count_users = mysql_query($sql_count_users,$cn) or die("ERROR : count_users()".mysql_error());
	$array=array();
	while($data=mysql_fetch_assoc($result_count_users))
		{
		$array[]=$data;
		}
	disconnect_db($cn);
	return $array;	
	
	}
#Count number of active users	
function count_active_users()
	{
	$cn=connect_db();
	$sql_count_active_users = "SELECT COUNT(status) as active FROM `users` WHERE status='1' and username!='admin'";
	$result_count_active_users = mysql_query($sql_count_active_users,$cn) or die("ERROR : count_active_users()".mysql_error());
	$array=array();
	while($data=mysql_fetch_assoc($result_count_active_users))
		{
		$array[]=$data;
		}
			disconnect_db($cn);
	return $array;	
	}
	
function getusername($uid)
{
	$cn=connect_db();
	$sqluname = "select * from `users` where  userid='".$uid."'";
	$linkuname = mysql_query($sqluname,$cn) or die("Error : Username :".mysql_error());
	$datauname = mysql_fetch_assoc($linkuname);
	$uname = $datauname['username'];
	disconnect_db($cn);
	return $uname;
	
}

function magicquotes($text)
{
if (!get_magic_quotes_gpc()) 
{
   $text = addslashes($text);
}    
return $text;
}

function mymail($to,$subject,$data,$from)
{
		if (strtoupper(substr(PHP_OS,0,3)=='WIN')) 
		{
		  $eol="\r\n";
		} 
		elseif (strtoupper(substr(PHP_OS,0,3)=='MAC')) 
		{
		  $eol="\r";
		} 
		else 
		{
		  $eol="\n";
		} 
	//$filename = "email/signup.tpl";

	$headers .= 'From: '.$from['name'].' <'.$from['email'].'>'.$eol;
	$headers .= 'Reply-To: '.$to['name'].' <'.$to['email'].'>'.$eol;
	$headers .= "Message-ID: <".$now." TheSystem@".$_SERVER['SERVER_NAME'].">".$eol;
	$headers .= "X-Mailer: PHP v".phpversion().$eol;           // These two to help avoid spam-filters
	$headers.= "Content-Type: text/html; charset=ISO-8859-1 ".$eol;
	$headers .= "MIME-Version: 1.0 ".$eol;; 
	ini_set(sendmail_from,$from['email']);  // the INI lines are to force the From Address to be used !

	if(!mail($to['email'], $subject, $data, $headers))
		{		
		echo "Error Email Sending "; 
		exit();
		}
	ini_restore(sendmail_from);	

}


function getfriends($uid)
	{
	$sql="select * from `friendlist`  where (userid='".$uid."' OR username_friendid='".$uid."') and status=1";
	$links = mysql_query ($sql,$_SESSION['cn']) or die("Error : INSERt user :".mysql_error());
	$num = mysql_num_rows($links);
	if($num)
		{
		while($dis = mysql_fetch_assoc($links))
			{
			if($dis['userid']==$uid)
				$friendslist[]=$dis['username_friendid'];
			else
				$friendslist[]=$dis['userid'];
			}
		return $friendslist;			
		}
	return 0;
	}

function uniqueid()
{
   list($usec, $sec) = explode(" ", microtime());
   return str_replace(".","",$usec.$sec);
}

//Function...
function loginstate($u)
{
	if($u)
	{
	$_SESSION['login']=1;
	}
	else
	{
	$_SESSION['login']=0;
	}
}

function login($username,$password)
	{
	$cn=connect_db();
	$sql="select  * from `users` where userid='1' and password='".$password."' and username='".$username."'" ;
	$link = mysql_query ($sql,$cn) or die("Error : INSERt user  : ".mysql_error());
	$dis = mysql_fetch_assoc($link);
	$num =mysql_num_rows($link);
	if($num)
		{
		echo "Login..";
		//print_r($_SESSION);
		$_SESSION['admin_system']=1;
		$_SESSION['USER']=$username;
				}
		else
		{$_SESSION['admin_system']=0;
		}
	disconnect_db($cn);
	}
	
function checklogin()
	{
	if($_SESSION['admin_system']=="1")
		{return true;
				}
		else
		{return false;
		}
	
	}

function PhotoThumbnail($pid)
	{
	$cn=connect_db();
	$sql="SELECT  thumb_url FROM `photo` WHERE id=".$pid;
	$link=mysql_query($sql,$cn) or die("Error : Photo Thumbnail ".mysql_error());
	$row=mysql_fetch_assoc($link);
	return $row['thumb_url'];
	disconnect_db($cn);
	}
	
	
?>
