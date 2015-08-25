<?php require_once "header.php"; ?>
<?php require_once "subheader.php"; ?>
<div id="innerajax">
<table width="96%" cellpadding="1" cellspacing="1" align="center">
	<tr height="20" bgcolor="#dde1e8">
		<td>&nbsp;&nbsp;<b>Featured Projects</b></td>
	</tr>
</table>
<table width="96%" cellpadding="1" cellspacing="1" align="center">
	<tr height="20" bgcolor="#dde1e8">
		<td class="header_text">&nbsp;&nbsp;Projects Name</td>
		<td class="header_text">&nbsp;&nbsp;Bids</td>
		<td class="header_text">&nbsp;&nbsp;Avg Bids</td>
		<td class="header_text">&nbsp;&nbsp;Job type</td>
		<td class="header_text">&nbsp;&nbsp;Stated Time</td>
		<td class="header_text">&nbsp;&nbsp;End Time</td>
		
	</tr>
	<? $r=retrive_project("featured");
foreach($r as $project) { 
	$project_status = get_project_details($project['id']);
	$job=job_type($project['id']);
	if ($project_status['status'] != "Expired")
		{?>
	<tr height="20" class="dark">
	    <td>
			<a href="project.php?id=<?php echo $project['id']; ?>"><? echo $project["project_title"];?></a>
			<? if($project['featured']==1) echo "[F]";if($project['private']==1) echo "[P]";?>
		</td>
		<td>&nbsp;&nbsp;<?php echo $project['count_bid']; ?></td>
		<td>&nbsp;&nbsp;$<?php echo $project['avg_bid_amount']; ?></td>
		<td>&nbsp;&nbsp;<?php echo $job;?></td>
		<td>&nbsp;&nbsp;<? echo $project['created_time']; ?></td>
		<td>&nbsp;&nbsp;<? echo $project['leftdate']; ?></td>
		
		
	</tr>
	<? }}?>
	
</table>
<br />
</div>
<?php require_once "subfooter.php"; ?>
<?php require_once "footer.php"; ?>
