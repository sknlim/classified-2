<?php
session_start();
$_SESSION['filename']="";
include "header.php"; 
include "subheader.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/display.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/project.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/maincategory.class.php"; 
require_once $_SERVER['DOCUMENT_ROOT']."/common/class/flashupload.class.php"; 

$objproject=new project;
$projects=$objproject->getdetails($_GET['pid']);
$objuser=new user;
?>
<h3 class="heading">Message Board</h3>
<div><b>Project: </b><a href='projects.php?id=<?php echo $_GET['pid']; ?>'><?php echo $projects['project_title']; ?></a></div>
<br />

<table  cellpadding="0" cellspacing="0">
<tr><td><br /><input type="button" value="Post Message" onclick="
<?php 	if(!$objuser->checkLogin())  echo "messageBox('Please Login to Post / Reply Message');"; 
		else echo "loadPage('/ajax/project/form_postmessage.php?pid=".$_GET['pid']."');"; ?>" /></td></tr>
<tr><td><small>Total Message Posted :  <?php echo $objproject->countmessage($_GET['pid']); ?></small></td></tr>
</table>
<hr />

<?php $messages=$objproject->getMessages($_GET['pid']); 
if(is_array($messages)) { ?>

<table width="100%">
<tr bgcolor="#FFFFFF">
    <td class="dt" width="20%">Author</td>
    <td class="dt" colspan="2">Message</td>
</tr>
<?php
$i=1;
foreach ($messages as $data)
{
if($i%2==0)
$bg = "#FFFFCC";
else
$bg = "#CCCCCC";
	echo '<tr valign="top" bgcolor='.$bg.'>';
		echo '<td >'.$objuser->getReviews($data['fromuserid']).'<br><small><b>('.$objuser->getUserType($data['fromuserid']).')</b></small></td>';
		
		//'<br></td>';
		if($data['touserid']==0)  // For Public
			{
			echo '<td><small>'."Message #".$i." Posted at ".$objproject->Fuzzytime($data['postedtime']).'</small><br><br>'.str_replace(htmlspecialchars("<br>"),"<br>",htmlspecialchars(str_replace("\n","<br>",$data['message']))).'</td>';
			echo '<td align="right"><i>[ public ]</i></td>';		
			}
		else if($data['touserid']==$objuser->getloggedid() || $data['fromuserid']==$objuser->getloggedid()) // For Logged In User
			{
			echo '<td><small>'."Message #".$i." Posted at ".$objproject->Fuzzytime($data['postedtime']).'</small><br><br>'.str_replace(htmlspecialchars("<br>"),"<br>",htmlspecialchars(str_replace("\n","<br>",$data['message']))).'</td>';
			
			if($data['fromuserid']!=$objuser->getloggedid())
				echo '<td align="right"><i>[<a href="javascript:loadPage(\'/ajax/project/form_postmessage.php?pid='.$_GET['pid'].'&private='.$objuser->getUserNameFromUserId($data['fromuserid']).'\');">reply to '.$objuser->getUserNameFromUserId($data['fromuserid']).'</a> ]</i></td>';
			else
				echo '<td align="right"><i>[Message for '.$objuser->getUserNameFromUserId($data['touserid']).'] </i></td>';
			
			
			}
		else // For Not Logged IN Private View 
			{
			echo '<td><small>'."Message #".$i." Posted at ".$objproject->Fuzzytime($data['postedtime']).'</small></td>';
			echo '<td align="right"><i>[private for '.$objuser->getUserNameFromUserId($data['touserid']).']</i></td>';
			}
		echo '</tr>';
	$i++;
	echo "\n";
}
?>

</table>
<?php } else { echo "<table width='100%'><tr><td align='center'>No Message(s) posted yet.</td></tr></table>"; }?>


<hr />
<table  cellpadding="0" cellspacing="0">
<tr><td><br /><input type="button" value="Post Message" onclick="
<?php 	if(!$objuser->checkLogin())  echo "messageBox('Please Login to Post / Reply Message');"; 
		else echo "loadPage('/ajax/project/form_postmessage.php?pid=".$_GET['pid']."');"; ?>" /></td></tr>
</table>



<?php include "footer.php"; ?>
<?php include "subfooter.php"; ?>
