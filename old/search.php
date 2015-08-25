<?php require_once "header.php"; ?>
<?php require_once "admin/function.php"; ?>
<?php require_once "sidemenu.php"; ?>

<?php
if(isset($_POST['search']))
{
$keyword=str_replace(" ",",",trim($_POST['search']));
	function search($keyword)
	{
		$sql="SELECT *,DATE_FORMAT(created_time,'%m/%d/%Y at %H:%i:%s') AS created_time FROM `projects` WHERE MATCH (`project_title`) AGAINST ('".$keyword."' IN BOOLEAN MODE)";
		$link=mysql_query($sql,$_SESSION['cn']) or die("Error Search Data : ".mysql_error());
		echo "Project Search Results :";
		echo "<table border='0' cellpadding='2' cellspacing='2'><tr bgcolor='#dde1e8'>
		<td class=\"header_text\">Project Name</td><td class=\"header_text\">Description</td>
		<td class=\"header_text\">Job Type</td><td class=\"header_text\">Bids</td>
		<td class=\"header_text\">Avg Bid</td><td class=\"header_text\">Status</td>
		<td class=\"header_text\">Started Date</td>
		</tr>";
		while($row=mysql_fetch_assoc($link))
			{
?>				
				<tr class="dark">
					<td class="dark" align="">
						<a href="project.php?id=<? echo $row['id']; ?>"><? echo ucwords($row['project_title']); ?></a>
					<? if($row['featured']==1) echo "[F]";if($row['private']==1) echo "[P]";?>
					</td>
					<td ><? echo $row['description']; ?></td>
					<td><? echo job_type($row['id']);?></td>
					<td><? echo count_bids($row['id']); ?></td>
					<td>Avg Bid</td>
					<td align="center" width="2%">
						<? if($row['status']==1) echo "<img src='admin/right.jpg'>"; else echo "<img src='admin/wrong.gif'>"; ?>
					</td>
					<td align="center"><? echo $row['created_time']; ?></td>
				</tr>
<?			
			}
	
	// Secound Statement
	
		$sql="SELECT *,DATE_FORMAT(created_time,'%m/%d/%Y at %H:%i:%s') AS created_time FROM `projects` WHERE MATCH (`description`) AGAINST ('".$keyword."')";
		$link=mysql_query($sql,$_SESSION['cn']) or die("Error Search Data : ".mysql_error());
		while($row=mysql_fetch_assoc($link))
			{
?>
<tr class="dark">
					<td>
						<a href="project.php?id=<? echo $row['id'];?>"><? echo ucwords($row['project_title']);?></a>
						<? if($row['featured']==1) echo "[F]";if($row['private']==1) echo "[P]";?>
					</td>
					<td><? echo $row['description']; ?></td>
					<td><? echo job_type($row['id']);?></td>
					<td><? echo count_bids($row['id']); ?></td>
					<td>
						Avg Bid
					</td>
					<td align="center" width="2%">
						<? if($row['status']==1) echo "<img src='admin/right.jpg'>"; else echo "<img src='admin/wrong.gif'>"; ?>
					</td>
					<td align="center"><? echo $row['created_time']; ?></td>
				</tr>
<?
			}
	
		echo "</table>";
		}
}
search($_POST['search']);

?>



<?php include "footer.php"; ?>