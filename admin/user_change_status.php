<?php include "header.php";
require_once "../common/class/admin/admin.class.php";
require_once "../common/class/mysql.class.php";
$mysql_querry=new mysql();
//disconnect_db($cn);
if($_GET['userid']!="" && $_GET['status']!="")
{
	if($_GET['status']=="1")
	$status="0";
	else
	$status="1";
	
	$sql = "update users set active='".$status."' where id='".$_GET['userid']."'";
	$result=$mysql_querry->query($sql);
	echo "<script>";
	echo "alert('Account is now : ";
	if($status)
		echo "Active";
	else
		echo "Non-Active";
	echo "!');";
	echo "window.location='listuser.php';";
	echo "</script>";
}
?>
<?php include "footer.php"; ?>