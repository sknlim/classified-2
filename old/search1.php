<?php require_once "header.php"; ?>
<?php require_once "function.php"; ?>
<?php require_once "sidemenu.php"; ?>

<?php
if(isset($_POST['search']))
{
$keyword=str_replace(" ",",",trim($_POST['search']));
	function search($keyword)
	{
		$sql="SELECT * FROM `projects` WHERE MATCH (`project_title`) AGAINST ('".$keyword."' IN BOOLEAN MODE)";
		$link=mysql_query($sql,$_SESSION['cn']) or die("Error Search Data : ".mysql_error());
		echo "Project Search Results";
		echo "<table border='0' cellpadding='2' cellspacing='2'><tr bgcolor='#dde1e8'>
		<td class=\"header_text\">Project Name</td><td class=\"header_text\">Description</td>
		<td class=\"header_text\">Job Type</td><td class=\"header_text\">Bids</td>
		<td class=\"header_text\">Avg Bid</td><td class=\"header_text\">Status</td>
		<td class=\"header_text\">Started Date</td>
		</tr>";
		while($row=mysql_fetch_assoc($link))
			{
				echo "<tr class=\"dark\">
					<td>
						<a href=\"project.php?id=".$row['id']."\">".$row['project_title']."</a>
					</td>
					<td>".$row['description']."</td>
					<td>
						job type
					</td>
					<td>
						Bids
					</td>
					<td>
						Avg Bid
					</td>
					<td>
						Status
					</td>
					<td>
						Started Date
					</td>
				</tr>";
			}
	
	// Secound Statement
	
		$sql="SELECT * FROM `projects` WHERE MATCH (`description`) AGAINST ('".$keyword."')";
		$link=mysql_query($sql,$_SESSION['cn']) or die("Error Search Data : ".mysql_error());
		while($row=mysql_fetch_assoc($link))
			{
				echo "<tr class=\"dark\">
					<td>
						<a href=\"project.php?id=".$row['id']."\">".$row['project_title']."</a>
					</td>
					<td>".$row['description']."</td>
									<td>
						job type
					</td>
					<td>
						Bids
					</td>
					<td>
						Avg Bid
					</td>
					<td>
						Status
					</td>
					<td>
						Started Date
					</td>
				</tr>";
			}
	
		echo "</table>";
		}
}
search($_POST['search']);

?>



<?php include "footer.php"; ?>