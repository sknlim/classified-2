<?php include "header.php";
include $_SERVER['DOCUMENT_ROOT']."/common/class/user.class.php";
$delete_user=new user();
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
if($_POST['type']=="delete")
	{   
		if($_GET['userid'])
			{
				$delete_user->deleteuser($_GET['userid']);
				echo "<script>alert('User Deleted ...'); window.location='listuser.php';</script>";
			}
		else
			{
				$midarray = explode(",",$_POST['selectcheck']);
					foreach($midarray as $w)
						{
						$delete_user->deleteuser($w);
						}	
					//disconnect_db($cn);
				echo "<script>alert('User Deleted ...'); window.location='listuser.php';</script>";
			}
	}
elseif($_POST['type']=="approve")
	{
		if($_GET['userid'])
			{
				$delete_user->approve_user($_GET['userid']);
				echo "<script>alert('User is now: Active !..'); window.location='listuser.php';</script>";
			}
		else
			{
				$midarray = explode(",",$_POST['selectcheck']);
					foreach($midarray as $w)
						{
						$delete_user->approve_user($w);
						}	
					//disconnect_db($cn);
				echo "<script>alert('User is now: Active !..'); window.location='listuser.php';</script>";
			}
	
	}
elseif($_POST['type']=="block")
	{
		if($_GET['userid'])
			{
				$delete_user->block_user($_GET['userid']);
				echo "<script>alert('User is now: Blocked ...'); window.location='listuser.php';</script>";
			}
		else
			{
				$midarray = explode(",",$_POST['selectcheck']);
					foreach($midarray as $w)
						{
						$delete_user->block_user($w);
						}	
					//disconnect_db($cn);
				echo "<script>alert('User is now: Blocked ...'); window.location='listuser.php';</script>";
			}
	}
elseif($_POST['type']=="suspend")
	{
		if($_GET['userid'])
			{
				$delete_user->suspend_user($_GET['userid']);
				echo "<script>alert('User is now: Suspended ...'); window.location='listuser.php';</script>";
			}
		else
			{
				$midarray = explode(",",$_POST['selectcheck']);
					foreach($midarray as $w)
						{
						$delete_user->suspend_user($w);
						}	
					//disconnect_db($cn);
				echo "<script>alert('User is now: Suspended ...'); window.location='listuser.php';</script>";
			}
	}
?>

