<?php
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/config.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/mysql.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/common.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/email.class.php";

class user 
	{
	var $error;	
	var $mysql;
		function user()
			{
			$this->mysql = new mysql;
			}
			
			function isexist($uname)
			{
				$sql="select * from users where username='".$uname."'";
				$data=$this->mysql->queryrow($sql);
				return $data;
			}
		
		function registerUser($ar) 
		{
						
			$sql1 = "select count(*) as cnt from `users` where username='".$ar['username']."'";
			$result1 = $this->mysql->queryrow($sql1);
			
			$sql = "select count(*) as cnt from `users` where email='".$ar['email']."'";
			$result = $this->mysql->queryrow($sql);
			
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
					
					 $sql = "insert into `users` (
					 `username`, `email`, `password`, `dob`, `createtime`, `gender`, `activation`, `expirydate`, `zip`, `country_id`, `state`, `city`, `type`, `firstname`, `lastname`, `profile`, `company`, `jobtype` ) 
					 values (
					 '".$ar['username']."', '".$ar['email']."', '".md5($ar['password'])."', '".$dob."', '".$createdtime."',
					 '".$ar['gender']."', '".$verificationlink."', '".$expirydate."', '".$ar['zip']."', '".$ar['country']."',
					 '".$ar['state']."', '".$ar['city']."', '".$ar['type']."', '".$this->mysql->magicquotes(strip_tags($ar['fname']))."', '".$this->mysql->magicquotes(strip_tags($ar['lname']))."', 
					 '".$this->mysql->magicquotes(strip_tags($ar['profile']))."', 
					 '".$this->mysql->magicquotes(strip_tags($ar['company']))."', 
					 '".$this->mysql->magicquotes(strip_tags($ar['jobtype']))."')";	
					
					$this->mysql->queryinsert($sql,"users");

					
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
		
		function editprofile($uid)
		{
			$sql = "select * from `users` where id='".$uid."'";
			$result = $this->mysql->queryrow($sql);
			return $result;
		}
		
		function updateprofile($ar)
		{
			$dob=$ar['yyyy']."-".$ar['mm']."-".$ar['dd'];
			$sql = "update users set firstname='".$this->mysql->magicquotes(strip_tags($ar['fname']))."',
					lastname='".$this->mysql->magicquotes(strip_tags($ar['lname']))."',
					company='".$this->mysql->magicquotes(strip_tags($ar['company']))."',
					profile='".$this->mysql->magicquotes(strip_tags($ar['profile']))."',
					jobtype='".$this->mysql->magicquotes(strip_tags($ar['jobtype']))."',
					email='".$this->mysql->magicquotes(strip_tags($ar['email']))."',
					country_id='".$ar['country']."',
					state='".$this->mysql->magicquotes(strip_tags($ar['state']))."',
					city='".$this->mysql->magicquotes(strip_tags($ar['city']))."',
					zip='".$ar['zip']."',dob='".$dob."',
					gender='".$ar['gender']."' where id='".$_SESSION['foongigs_userid']."'";
			$this->mysql->query($sql);
		}
		
		
		
		function login($username,$password,$type='login')
		{
			switch($type)
			{
				case "register":
				case "login":
					$sql = "SELECT *  FROM `users` where email='".$username."' and password='".md5($password)."' and active='yes'";
					$type=$this->mysql->queryrow($sql);
					 $sql = "SELECT count(*) as cnt FROM `users` where email='".$username."' and password='".md5($password)."' and active='yes'";
					$array=$this->mysql->queryrow($sql);
					
					if($array['cnt']>0)
					{
						if($this->getEmailLeftDays($array['id'])<0)
						{
						$ans="-2";
						$this->error="Your account is blocked because you have not verified your email.";
						}
						else
						{
						$_SESSION['foongigs_loggedin']="1";
						$_SESSION['foongigs_username']=$type['username'];
						$_SESSION['foongigs_userid']=$type['id'];
						$_SESSION['foongigs_usertype']=$type['type'];
						$ans="1";		
						$this->updateLastLogin($_SESSION['foongigs_userid']);
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
				$sql = "update `users` set lastlogin='".$timestamp."' where id='".$uid."'";
				$this->mysql->query($sql);
		}
		
		function updateUserProfileViews($uid)
		{
				$sql = "update `users` set views=views+1 where id='".$uid."'";
				$this->mysql->query($sql);
		}

			
		function isEmailVerified()
		{
				$sql = "select count(*) from `users` where id='".$_SESSION['foongigs_userid']."' and email_verified='1'";
				$array=$this->mysql->queryrow($sql);
				if($array['cnt']>0)
				return true;
				else
				return false;
		}

		
		function getEmailLeftDays($uid='')
		{
				if($uid=='') $uid=$_SESSION['foongigs_userid']; 
				$sql = "select DATEDIFF(expirydate,CURDATE()) as dd  from `users` where id='".$uid."'";
				$array=$this->mysql->queryrow($sql);
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
				$array=$this->mysql->queryrow($sql);
				if($this->getEmailLeftDays($array['userid'])>0)
				{
					if($array['email_verified']=="1")
					{
					$ans="-3"; // already verified
					}
					else
					{
						$sql = "update `users` set email_verified='1' where activation='".$linkid."'";;
						$this->mysql->query($sql);
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
			if(($_SESSION['foongigs_loggedin']!="1"))
			return false;
			else
			return true;
		}
		
						
		function checkLoginAjax()
		{
			if(($_SESSION['foongigs_loggedin']!="1"))
			{
			echo "script:messageBox('You are not logged in..');";
			exit();
			}
		}
		
		function getLoggedID()
			{
			if($_SESSION['foongigs_loggedin']==1)
				return $_SESSION['foongigs_userid'];
			else
				return 0;
			}
		
		function getLoggedUserName()
			{
			if($_SESSION['foongigs_loggedin']==1)
				return $_SESSION['foongigs_username'];
			else
				return 0;
			}	
			
		function getLoggedType()
			{
			if($_SESSION['foongigs_loggedin']==1)
				return $_SESSION['foongigs_usertype'];
			else
				return 0;
			}	
		
		function getUserType($userid)
			{
			$sql = "select * from `users` where id='".$userid."'";
			$array=$this->mysql->queryrow($sql);
			return $array['type'];
			}			
	
		function forgotPassword($email)
		{
			$sql = "select * from `users` where email='".$email."'";
			$array=$this->mysql->queryrow($sql);
			if(is_array($array))
			{
				$objcommon=new common;
				$resetpasswordlink=substr(md5($email.$array['username']),0,25);
				$str=$objcommon->getTemplateFormat('forgotpassword');
				$objconfig=new config;
				$to['name']=$array['username'];
				$to['email']=$email;
				$from['name']=$objcommon->getConfigValue('forgot_password_from_name');
				$from['email']=$objcommon->getConfigValue('forgot_password_from_email');
				$subject=$objcommon->getConfigValue('forgot_password_from_subject');
				$identifier['sitename']=$objcommon->getConfigValue('sitename');
				$identifier['email']=$email;
				$identifier['link']='<a href="http://'.$_SERVER['HTTP_HOST'].'/resetpassword.php?linkid='.$resetpasswordlink.'">http://'.$_SERVER['HTTP_HOST'].'/resetpassword.php?linkid='.$resetpasswordlink.'</a>';
				$objemail=new email;
			//	$objemail->sendMail($to,$from,$subject,$str,$identifier);	
				$sql = "update users set resetpasswordlink='".$resetpasswordlink."' where email='".$email."'";
				$array=$this->mysql->query($sql);		
				return "1";
			}
			else
			{
				$this->error="Wrong email..";
				return "0";
			}	
		}

	function resetPassword($ar)
		{
			$sql = "select * from `users` where resetpasswordlink='".$ar['linkid']."'";
			$array=$this->mysql->queryrow($sql);
			if(is_array($array))
			{
				$objcommon=new common;
				$str=$objcommon->getTemplateFormat('resetpassword');
				$objconfig=new config;
				$newpass=substr(md5($array['username']),0,8);
				$sql = "update users set password='".md5($newpass)."' where resetpasswordlink='".$ar['linkid']."'";
				$array=$this->mysql->query($sql);	
				
				$to['name']=$array['username'];
				$to['email']=$array['email'];
				$from['name']=$objcommon->getConfigValue('reset_password_from_name');
				$from['email']=$objcommon->getConfigValue('reset_password_from_email');
				$subject=$objcommon->getConfigValue('reset_password_from_subject');
				$identifier['sitename']=$objcommon->getConfigValue('sitename');
				$identifier['username']=$array['username'];
				$identifier['password']=$newpass;
				$objemail=new email;
			//	echo $identifier['link'];
			//	$objemail->sendMail($to,$from,$subject,$str,$identifier);	
				$sql = "update users set resetpasswordlink='' where resetpasswordlink='".$ar['linkid']."'";
				$array=$this->mysql->query($sql);		
				return "1";
			}
			else
			{
				$this->error="Unable to reset your password..";
				return "0";
			}	
			
		}

	function verifyResetPasswordLink($linkid)
	{
			$sql = "select count(*) as cnt from `users` where resetpasswordlink='".$linkid."'";
			$array=$this->mysql->queryrow($sql);
			if($array['cnt']>0)
			return true;
			else
			return false;
	}

	function changePassword($ar)
		{
			$sql = "select * from `users` where password='".md5($ar['currentpassword'])."' and id='".$this->getLoggedID()."'";
			$array=$this->mysql->queryrow($sql);
			if(is_array($array))
			{

				$objcommon=new common;
				$str=$objcommon->getTemplateFormat('changepassword');
				$objconfig=new config;
				$newpass=md5($ar['newpassword']);

				$sql = "update users set password='".$newpass."' where id='".$this->getLoggedID()."'";
				$this->mysql->query($sql);	
				
				$to['name']=$array['username'];
				$to['email']=$array['email'];
				$from['name']=$objcommon->getConfigValue('change_password_from_name');
				$from['email']=$objcommon->getConfigValue('change_password_from_email');
				$subject=$objcommon->getConfigValue('change_password_from_subject');
				$identifier['sitename']=$objcommon->getConfigValue('sitename');
				$identifier['username']=$array['username'];
				$identifier['password']=$ar['newpassword'];
				$objemail=new email; 
				$objemail->sendMail($to,$from,$subject,$str,$identifier);	

				return "1";
			}
			else
			{
		//	echo "else part";
			$this->error="Invalid Current Password..";
			return "0";
			}
			disconnect_db($cn);
			
		}

	function changeEmail($uname)
	{
	
	}
	
	function updateEmailSettings($ar)
	{

	}
	
	function updatePrivacySettings($ar)
	{

	}
	
	
	function getReviews($userid)
	{
			$sql = "select count(review) as cnt, avg(point) as average from `user_review` where userid='".$userid."'";
			$array=$this->mysql->queryrow($sql);
			
			if($array['cnt']!=0)
			return "<a href='viewprofile.php?id=".$userid."'>".$this->getUserNameFromUserId($userid)."</a><br><a href='feedback.php?id=".$userid."'><small>".number_format($array['average'],1)." Points (".$array['cnt']." Reviews) </small></a>";		
			else
			return "<a href='viewprofile.php?id=".$userid."'>".$this->getUserNameFromUserId($userid)."</a><br><small>Rating (No Feedback Yet.)</small>";			

	}
	
	function getRating($userid)
	{
			$sql = "select count(review) as cnt, avg(point) as average from `user_review` where userid='".$userid."'";
			$array=$this->mysql->queryrow($sql);
			
			if($array['cnt']!=0)
			return "<a href='feedback.php?id=".$userid."'><small>".number_format($array['average'])." Points (".$array['cnt']." Reviews) </small></a>";		
			else
			return "<small>Rating (No Feedback Yet.)</small>";			

	}



	function resendVerification()
	{
			$verificationlink=substr(md5($ar['username'].$ar['email']),1,25);
			$sql = "update `users` set activation='".$verificationlink."' where id='".$_SESSION['vibes_userid']."'";	
			$this->mysql->query($sql);
			
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

function isUserExists($uname)
{
			$sql = "select * from `users` where username='".$uname."'";
			$array = $this->mysql->queryrow($sql);
			$objuser->error="No user exists with this name";
			return is_array($array);	
}	
	
function getUserIdFromUserName($uname)
	{
			$sql = "select * from `users` where username='".$uname."'";
			$array = $this->mysql->queryrow($sql);
			return $array['id'];		
	}

function getUserNameFromUserId($uid)
	{
			$sql = "select * from `users` where id='".$uid."'";
			$array = $this->mysql->queryrow($sql);
			return $array['username'];
	}

function getUserEmailFromUserId($uid)
	{
			$sql = "select * from `users` where id='".$uid."'";
			$array = $this->mysql->queryrow($sql);
			return $array['email'];
	}

function getbyId($uid)
	{
			$sql = "select * from `users` where id='".$uid."'";
			$array = $this->mysql->queryrow($sql);
			return $array;
	}
	
function cancelaccount($ar)
	{
	}

function update_user($ar)
	{
	}


function getalluserlist($start_limit=0,$end_limit=0)
	{
		if($start_limit==0 && $end_limit==0)
		{
			$sql = "SELECT *,UNIX_TIMESTAMP(createtime) as time_stamp FROM `users` where accesslevel != 2 and active='yes' ORDER BY createtime DESC ";
		}
		else
		{
				$sql = "SELECT *,UNIX_TIMESTAMP(createtime) as time_stamp FROM `users` where accesslevel != 2 ORDER BY createtime DESC limit ".$start_limit.",".$end_limit."";
		}
			$result=$this->mysql->getdata($sql);
					return $result;
	}
function get_search_userlist($str,$start_limit=0,$end_limit=0)
	{
		if($start_limit==0 && $end_limit==0)
		{
		$sql = "select *,UNIX_TIMESTAMP(createtime) as time_stamp from `users` where username like '".$str."%' or username like '%".$str."' or username like '%".$str."%' and accesslevel!=2";
		}
		else
		{
		$sql = "select *,UNIX_TIMESTAMP(createtime) as time_stamp from `users` where username like '".$str."%' or username like '%".$str."' or username like '%".$str."%' and accesslevel!=2 limit ".$start_limit.",".$end_limit."";
		}
		$result=$this->mysql->getdata($sql);
				return $result;
	}
	
function approve_user($id)
	{
				
				$status="yes";
				 $sql = "update users set active='".$status."' where id='".$id."'";
				$result=$this->mysql->query($sql);
				return $result;
	}
	
function block_user($id)
	{
			
				$status="no";
				$sql = "update users set active='".$status."' where id='".$id."'";
				$result=$this->mysql->query($sql);
				return $result;
	}

function suspend_user($id)
	{
			
				$status="suspended";
				$sql = "update users set active='".$status."' where id='".$id."'";
				$result=$this->mysql->query($sql);
				return $result;
	}

function deleteuser($uid)
			{
				$sql = "delete from `users` where id='".$uid."'";
				return $result1=$this->mysql->query($sql);
			}

function count_users()
			{
			$sql_count_users = "SELECT COUNT(id) as total_users,COUNT(active='no') as non_active FROM `users` where username!='admin'";
			return $result1 = $this->mysql->getdata($sql_count_users);
			}
			
function count_active_users()
			{
			$sql_count_active_users = "SELECT COUNT(active) as active FROM `users` WHERE active='yes' and username!='admin'";
			return $result1 = $this->mysql->getdata($sql_count_active_users);
			}

function get_certified_members($type)
{
	$sql="select * from users where certified_member='yes' and accesslevel!='2' and type='".$type."' order by id ASC";
	$data=$this->mysql->getdata($sql);
	return $data;
}			

function getCalculation($userid)
{
			$sql = "select count(review) as cnt, avg(point) as average , sum(point) as total from `user_review` where userid='".$userid."'";
			$array=$this->mysql->queryrow($sql);
			if($array['cnt']!=0)
			{
			$cal['review']=$array['cnt'];
			$cal['points']=$array['total'];
			$cal['average']=$array['average'];
			}
			else
			{
			$cal['review']=0;
			$cal['points']=0;
			$cal['average']=0;
			}
			
			return $cal;

}

function getreviewdetailbyid($uid)
{
	$sql="select * from user_review where userid='".$uid."'";
	$data=$this->mysql->getdata($sql);
	return $data;
}

function get_top_service_providers()
{
	$sql="select * from users where accesslevel!='2' and type='provider' order by id ASC";
	$data=$this->mysql->getdata($sql);
	return $data;
}		


			
} 
?>