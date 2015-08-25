<?php
require_once "config.class.php"; 
require_once "mysql.class.php";
require_once "common.class.php";
require_once "email.class.php";
require_once "photo.class.php";

class user extends mysql
	{
	var $error;	
	 
		function registerUser($ar) 
		{
						
			$sql1 = "select count(*) as cnt from `users` where username='".$ar['username']."'";
			$result1 = $this->queryrow($sql1);
			
			$sql = "select count(*) as cnt from `users` where email='".$ar['email']."'";
			$result = $this->queryrow($sql);
			
			if($result1['cnt']>0)
			{
				$this->error="Username already exists";
				return "-1";
			}
			elseif($result['cnt']>0)
			{
				$this->error="Email already exists";			
				return "-2";
			}
			else
			{
					$objcommon=new common;
					$createdtime=$objcommon->getCurrentTimestamp();					
					$dob=$ar['yyyy']."-".$ar['mm']."-".$ar['dd'];
					$expirydate=date("Y-m-d",mktime(0, 0, 0, date("m"),date("d")+7, date("Y")));
					$verificationlink=substr(md5($ar['username'].$ar['email']),1,25);
					
					$sql = "insert into `users` (username,email,password,dob,createtime,gender,activation,expirydate) values 
					('".$ar['username']."','".$ar['email']."','".md5($ar['password'])."','".$dob."','".$createdtime."','".$ar['gender']."','".$verificationlink."','".$expirydate."')";	
					$this->queryinsert($sql,"users");

					
					$str=$objcommon->getTemplateFormat('emailverification');

					$objconfig=new config;
										
					$to['name']=$ar['username'];
					$to['email']=$ar['email'];
					$from['name']=$objcommon->getConfigValue('email_verification_from_name');
					$from['email']=$objcommon->getConfigValue('email_verification_from_email');
					$subject=$objcommon->getConfigValue('email_verification_subject');
					$identifier['sitename']=$objcommon->getConfigValue('sitename');
					$identifier['link']='<a href="'.$objconfig->get_domain_path().'emailverification.php?linkid='.$verificationlink.'">'.$objconfig->get_domain_path().'emailverification.php?linkid='.$verificationlink.'</a>';
					
					$objemail=new email;
					$objemail->sendMail($to,$from,$subject,$body,$identifier);			
					//echo $identifier['link'];
//					exit();
					return "1";
		
			}
		}
		
		
		function registerProfile($ar)
		{
			
					$objcommon=new common;
					$sql = "update `users` set firstname='".$ar['firstname']."', lastname='".$ar['lastname']."', nickname='".$ar['nickname']."', city='".$ar['city']."', state='".$ar['state']."', country='".$ar['country']."', zip='".$ar['zip']."'  where userid='".$ar['userid']."'";	
					$this->query($sql);
					return true;
		}
		
		function login($username,$password,$type='login')
		{
			switch($type)
			{
				case "register":
					$_SESSION['vibes_loggedin']="1";
					$_SESSION['vibes_username']=$username;
					$_SESSION['vibes_userid']=$this->getUserIdFromUserName($username);
					unset($_SESSION['verification_key']);
					$ans="1";		
				break;
				
				case "login":
					$sql = "SELECT count(*) as cnt FROM `users` where username='".$username."' and password='".md5($password)."' and active='1'";
					$array=$this->queryrow($sql);
					if($array['cnt']>0)
					{
						if($this->getEmailLeftDays($array['userid'])<0)
						{
						$ans="-2";
						$this->error="Your account is blocked because you have not verified your email.";
						}
						else
						{
						$_SESSION['vibes_loggedin']="1";
						$_SESSION['vibes_username']=$username;
						$_SESSION['vibes_userid']=$this->getUserIdFromUserName($username);
						$ans="1";		
						$this->updateLastLogin($_SESSION['vibes_userid']);
						}
					}
					else
					{
						session_unset();
						$ans="-1";		
						$this->error="Invalid username or password.";
					}
				break;
			}
					
				return $ans;
		}
	
	

		function updateLastLogin($uid)
		{
				$objcommon=new common;
				$timestamp=$objcommon->getCurrentTimestamp();
				$sql = "update `users` set lastlogin='".$timestamp."' where userid='".$uid."'";
				$this->query($sql);
		}
		
		function updateUserProfileViews($uid)
		{
				$sql = "update `users` set views=views+1 where userid='".$uid."'";
				$this->query($sql);
		}

			
		function isEmailVerified()
		{
				$sql = "select count(*) from `users` where userid='".$_SESSION['vibes_userid']."' and email_verified='1'";
				$array=$this->queryrow($sql);
				if($array['cnt']>0)
				return true;
				else
				return false;
		}

		
		function getEmailLeftDays($uid='')
		{
				if($uid=='') $uid=$_SESSION['vibes_userid']; 
				$sql = "select DATEDIFF(expirydate,CURDATE()) as dd  from `users` where userid='".$uid."'";
				$array=$this->queryrow($sql);
				return $array['dd'];
		}
			
		function logout()
		{
				session_unset();
		}


		function activateUser($linkid)
		{
			$sql = "select count(*) as cnt from `users` where activation='".$linkid."'";
			$array=$this->queryrow($sql);
			if($array['cnt']>0) 
			{
				$sql = "select * from `users` where activation='".$linkid."'";
				$array=$this->queryrow($sql);
				if($this->getEmailLeftDays($array['userid'])>0)
				{
					if($array['email_verified']=="1")
					{
					$ans="-3"; // already verified
					}
					else
					{
						$sql = "update `users` set email_verified='1' where activation='".$linkid."'";;
						$this->query($sql);
						$ans="1"; // now verified
					}	
				}
				else
				{
				$ans="-2"; // contact admin 
				}
			}
			else
			{
			$ans="-1"; // Invalid verification link
			}
			return $ans;
		}	
						
		function checkLogin()
		{
			if(($_SESSION['vibes_loggedin']!="1"))
			return false;
			else
			return true;
		}
		
	
		function forgotPassword($email)
		{
			$sql = "select count(*) as cnt from `users` where email='".$email."'";
			$array=$this->queryrow($sql);
			if($array['cnt']>0)
			{
				$objcommon=new common;
				$resetpasswordlink=substr(md5($email.$array['username']),0,25);
				$str=$objcommon->getTemplateFormat('forgetpassword');
				$objconfig=new config;
				$to['name']=$array['username'];
				$to['email']=$email;
				$from['name']=$objcommon->getConfigValue('forgot_password_from_name');
				$from['email']=$objcommon->getConfigValue('forgot_password_from_email');
				$subject=$objcommon->getConfigValue('forgot_password_from_subject');
				$identifier['sitename']=$objcommon->getConfigValue('sitename');
				$identifier['email']=$email;
				$identifier['link']='<a href="'.$objconfig->get_domain_path().'resetpassword.php?linkid='.$resetpasswordlink.'">'.$objconfig->get_domain_path().'resetpassword.php?linkid='.$resetpasswordlink.'</a>';
				$objemail=new email;
				$objemail->sendMail($to,$from,$subject,$body,$identifier);	
				$sql = "update users set resetpasswordlink='".$resetpasswordlink."' where email='".$email."'";
				$array=$this->query($sql);		
				return true;
			}
			else
			{
				$this->error="Wrong email..";
			}	
		}

	function resetPassword($ar)
		{
			$sql = "select count(*) as cnt from `users` where resetpasswordlink='".$ar['linkid']."'";
			$array=$this->queryrow($sql);
			if($array['cnt']>0)
			{
				$objcommon=new common;
				$str=$objcommon->getTemplateFormat('resetpassword');
				$objconfig=new config;
				$sql = "update users set password='".md5($ar['password'])."' where resetpasswordlink='".$ar['linkid']."'";
				$array=$this->query($sql);	
				
				$to['name']=$array['username'];
				$to['email']=$array['email'];
				$from['name']=$objcommon->getConfigValue('reset_password_from_name');
				$from['email']=$objcommon->getConfigValue('reset_password_from_email');
				$subject=$objcommon->getConfigValue('reset_password_from_subject');
				$identifier['sitename']=$objcommon->getConfigValue('sitename');
				$identifier['username']=$array['username'];
				$identifier['password']=$ar['password'];
				$objemail=new email;
				echo $identifier['link'];
				$objemail->sendMail($to,$from,$subject,$str,$identifier);	
				$sql = "update users set resetpasswordlink='' where resetpasswordlink='".$ar['linkid']."'";
				$array=$this->query($sql);		
				return true;
			}
			else
			{
				$this->error="Unable to reset your password..";
				return false;
			}	
			
		}

	function verifyResetPasswordLink($linkid)
	{
			$sql = "select count(*) as cnt from `users` where resetpasswordlink='".$linkid."'";
			$array=$this->queryrow($sql);
			if($array['cnt']>0)
			return true;
			else
			return false;
	}

	function changePassword($uname)
		{

			$sql = "select * from `users` where username='".$uname."'";
			$result = mysql_query($sql,$cn) or die("ERROR :".mysql_error());
			$num=mysql_num_rows($result);
			//$ans=array();
			if($num>0)
			{
				$userdata=mysql_fetch_assoc($result);
				$pass=$userdata['password'];
		//		$ans=true;
				$to['name']=$userdata['firstname'];
				$to['email']=$userdata['email'];
				$from['name']="Support";
				$from['email']=getadminemail();
				$subject=getsitename()." Password Recovery Service";
				$filename="email/forget.tpl";
				$data['fname']=$userdata['firstname']." ".$userdata['lastname'];
				$data['myname']=getsitename();
				$data['username']=$userdata['username'];
				$data['password']=$userdata['password'];
				$data['from']=getadminemail();
				mymail($to,$subject,$data,$filename,$from);
				$ans=true;
			}
			else
			{
			$ans=false;
			}
			disconnect_db($cn);
			return $ans;
		}

	function changeEmail($uname)
	{
	
	}
	
	function updateEmailSettings($ar)
	{
		if($ar['sendmessage']=="")
		$ar['sendmessage']="no";
		
		if($ar['addasafriend']=="")
		$ar['addasafriend']="no";
		
		if($ar['invitegroup']=="")
		$ar['invitegroup']="no";
		
		if($ar['commentprofile']=="")
		$ar['commentprofile']="no";
	
		if($ar['commentall']=="")
		$ar['commentall']="no";
	
		if($ar['shareall']=="")
		$ar['shareall']="no";
	
		if($ar['upload']=="")
		$ar['upload']="no";

		$sql="update users set email_sendmessage='".$ar['sendmessage']."', email_addfriend='".$ar['addasafriend']."', email_invitegroup='".$ar['invitegroup']."', email_commentprofile='".$ar['commentprofile']."' , email_commentall='".$ar['commentall']."' , email_shareall='".$ar['shareall']."' , email_upload='".$ar['upload']."' where userid='".$ar['userid']."'";
		$this->query($sql);
		return true;
	}
	
	function updatePrivacySettings($ar)
	{
		if($ar['requireapproval']=="")
		$ar['requireapproval']="no";
		$sql="update users set privacy_sendmessage='".$ar['sendmessage']."', privacy_requestfriend='".$ar['requestfriend']."', privacy_invitegroup='".$ar['invitegroup']."', privacy_profilecommentapproval='".$ar['requireapproval']."' where userid='".$ar['userid']."'";
		$this->query($sql);
		return true;
	}
	
	function getUserSettings($uid)
	{
		$sql = "select * from users where userid='".$uid."'";
		$array=$this->queryrow($sql);
		return $array;
	}
	

	function resendVerification()
	{
			$verificationlink=substr(md5($ar['username'].$ar['email']),1,25);
			$sql = "update `users` set activation='".$verificationlink."' where userid='".$_SESSION['vibes_userid']."'";	
			$this->query($sql);
			
			$str=$objcommon->getTemplateFormat('emailverification');
			$objconfig=new config;
			$objuser=new user;
			
			$to['name']=$_SESSION['vibes_username'];
			$to['email']=$objuser->getUserEmailFromUserId($_SESSION['vibes_userid']);
			
			$from['name']=$objcommon->getConfigValue('email_verification_from_name');
			$from['email']=$objcommon->getConfigValue('email_verification_from_email');
			$subject=$objcommon->getConfigValue('email_verification_subject');
			$identifier['sitename']=$objcommon->getConfigValue('sitename');
			$identifier['link']='<a href="'.$objconfig->get_domain_path().'emailverification.php?linkid='.$verificationlink.'">'.$objconfig->get_domain_path().'emailverification.php?linkid='.$activationlink.'</a>';
			$objemail=new email;
			$objemail->sendMail($to,$from,$subject,$body,$identifier);			
			return true;
					//echo $identifier['link'];
//					exit();
	}

	
	
function getUserIdFromUserName($uname)
{
		$sql = "select * from `users` where username='".$uname."'";
		$array = $this->queryrow($sql);
		return $array['userid'];
		
}

function getUserNameFromUserId($uid)
{
		$sql = "select * from `users` where userid='".$uid."'";
		$array = $this->queryrow($sql);
		return $array['username'];
		
}

function getUserEmailFromUserId($uid)
{
		$sql = "select * from `users` where userid='".$uid."'";
		$array = $this->queryrow($sql);
		return $array['email'];
}


function getUserFullNameFromUserId($uid)
{
		$sql = "select * from `users` where userid='".$uid."'";
		$array = $this->queryrow($sql);
		return $array['firstname']." ".$array['lastname'];
}

function getUserUrlFromUserId($uid)
{
		$sql = "select * from `users` where userid='".$uid."'";
		$array = $this->queryrow($sql);
		return $array['url'];
}


function getUserCountryFromUserId($uid)
{
		$sql = "select * from `users` where userid='".$uid."'";
		$array = $this->queryrow($sql);
		$cid=$array['country'];
		$sql = "select * from `countries` where countryid='".$cid."'";
		$array1 = $this->queryrow($sql);
		return $array1['country'];
}


function getUserGenderFromUserId($uid)
{
		$sql = "select * from `users` where userid='".$uid."'";
		$array = $this->queryrow($sql);
		return $array1['gender'];
}



function getusergender($uid)
{
		$cn = connect_db();
		$sql = "select * from `users` where userid='".$uid."'";
		$result = mysql_query($sql,$cn) or die("ERROR :".mysql_error());
		$data=mysql_fetch_assoc($result);
		if($data['hidegender']=="0")
		$str=$data['gender'];
		else
		$str="";
		disconnect_db($cn);
		return $str;
		
}


function get_age_by_date($dob_year, $dob_month, $dob_day)
{
    if (checkdate($dob_month, $dob_day, $dob_year)) {
        $dob_date = "$dob_year" . "$dob_month" . "$dob_day";
        $age = floor((date("Ymd")-intval($dob_date))/10000);
        if (($age < 0) or ($age > 114)) {
            return FALSE;
        }
        return $age;
    }
    return FALSE;
}


function getuserage($uid)
{
		$cn = connect_db();
		$sql = "select * from `users` where userid='".$uid."'";
		$result = mysql_query($sql,$cn) or die("ERROR :".mysql_error());
		$data=mysql_fetch_assoc($result);

		if($data['hidedob']=="0")
		{
		$datetime=$data['dob'];
		$year = substr($datetime,0,4);
		$month = substr($datetime,5,2);
	    $day = substr($datetime,8,2);
		$str=get_age_by_date($year,$month,$day)." Years";
		}
		else
		$str="";
		disconnect_db($cn);
		return $str;
}



function getuseraboutme($uid)
{
		$cn = connect_db();
		$sql = "select * from `users` where userid='".$uid."'";
		$result = mysql_query($sql,$cn) or die("ERROR :".mysql_error());
		$data=mysql_fetch_assoc($result);
		$str=formattext($data['description']);
		disconnect_db($cn);
		return $str;
}

function getuserthemecolor($uid)
{
		$cn = connect_db();
		$sql = "select * from `users` where userid='".$uid."'";
		$result = mysql_query($sql,$cn) or die("ERROR :".mysql_error());
		$data=mysql_fetch_assoc($result);
		$str=$data['themecolor'];
		disconnect_db($cn);
		return $str;
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
	$str=get_domain_path()."images/nophoto.jpg";
	}
	else
	{
	$str=getthumbimagefromid($data['photoid']);
	}
	return $str;
}

function cancelaccount($ar)
{
	$cn = connect_db();
	$sql = "select * from `users` where userid='".$_SESSION['gallery_userid']."' and password='".$ar['confirmpassword']."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$num=mysql_num_rows($link);
	disconnect_db($cn);

	if($num>0)
	{
	$ans=true;
	cancelphoto($_SESSION['gallery_userid']);
	canceldiary($_SESSION['gallery_userid']);
	cancelmessage($_SESSION['gallery_userid']);
	cancelfriend($_SESSION['gallery_userid']);
	canceluser($_SESSION['gallery_userid']);
	$_SESSION['gallery_loginsystem']=0;
	$_SESSION['gallery_username']="";
	$_SESSION['gallery_userid']="";
	}

	else
	{
	$ans=false;
	}
	
	return $ans;
}
function changepassword1($ar)
{
	$cn = connect_db();
	$sql = "select * from `users` where userid='".$_SESSION['gallery_userid']."' and password='".$ar['currentpassword']."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$num=mysql_num_rows($link);
	disconnect_db($cn);

	if($num>0)
	{
		$cn = connect_db();
		$sql = "update `users` set password='".$ar['newpassword']."' where userid='".$_SESSION['gallery_userid']."'";
		$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
		disconnect_db($cn);
		$ans=true;
	}

	else
	{
	$ans=false;
	}
	
	return $ans;
}

function edit_user($uid)
{
	$cn = connect_db();
	$sql = "select * from `users` where userid='".$uid."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$data = mysql_fetch_assoc($link);
	disconnect_db($cn);
	return $data;
}

function update_user($ar)
{
	$cn = connect_db();
//	print_r($ar);
	if($ar['hidedob']=="on")
	{
	$hidedob=1;
	}
	else
	{
	$hidedob=0;
	}
	
	if($ar['hidegender']=="on")
	{
	$hidegender=1;
	}
	else
	{
	$hidegender=0;
	}
	
	
	$sql = "update `users` set firstname='".magicquotes($ar['firstname'])."', lastname='".magicquotes($ar['lastname'])."', email='".magicquotes($ar['email'])."', photoid='".$ar['photoid']."',title='".magicquotes($ar['title'])."', sitetype='".$ar['sitetype']."', themecolor='".$ar['color']."', description='".formattext(magicquotes(htmlspecialchars($ar['sitedesc'])))."', allowprint='".$ar['allowprint']."',pictureview='".$ar['pictureview']."',hidegender='".$hidegender."',hidedob='".$hidedob."' where userid='".$_SESSION['gallery_userid']."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	disconnect_db($cn);
}

function checktitle($title)
{
	$cn = connect_db();
	$sql = "select * from `users` where title='".$title."' and userid<>'".$_SESSION['gallery_userid']."'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$num=mysql_num_rows($link);
	if($num>0)
	{
	$ans=false;
	}	
	else
	{
	$ans=true;
	}
	disconnect_db($cn);
	return $ans;
}

function getalluserlist()
{
	$cn = connect_db();
	$sql = "select * from `users` where username<>'admin'";
	$link = mysql_query($sql,$cn) or die("Error : ".mysql_error());
	$array=array();
	while($data = mysql_fetch_assoc($link))
		{
		$array[]=$data;
		}
	disconnect_db($cn);
	return $array;
}



function checkloginnoredirect()
{
	if(($_SESSION['gallery_loginsystem']!=1)&&($_SESSION['gallery_username']=="")||($_SESSION['gallery_userid']==""))
	{
	$ans=false;
	}
	else
	{
	$ans=true;
	}
	return $ans;
	
}
function uploadPhoto($files)
{
	$photoObj=new photo($files);
	$photoObj->image_add();

}

		
}
	