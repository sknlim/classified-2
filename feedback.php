<?php include $_SERVER['DOCUMENT_ROOT']."/header.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/subheader.php"; ?>
<?php
	$objuser = new user;
	$data=$objuser->getbyid($_GET['id']);
	$reviews=$objuser->getreviewdetailbyid($_GET['id']);
	$calculation=$objuser->getCalculation($_GET['id']);
?>
<h2>
<?php 
if($data['type']=="seeker")
echo "Feedback Provided by Providers for Seeker ".$data['username'];
else
echo "Feedback Provided by Seekers for Provider ".$data['username'];
?>
</h2>

<p>
<a href="viewprofile.php?id=<?php echo $_GET['id']; ?>">View <?php echo $data['username']; ?> profile...</a>
</p>


<table>
<tr>
	<td class="dt">Average Rating</td>
	<td class="dt"><?php echo $calculation['average']; ?></td>
</tr>

<tr>
	<td class="dt">Current Rank</td>
	<td class="dt"></td>
</tr>

<tr>
	<td class="dt">Total Reviews</td>
	<td class="dt"><?php echo $calculation['review']; ?></td>
</tr>

<tr>
	<td class="dt">Total Points</td>
	<td class="dt"><?php echo $calculation['points']; ?></td>
</tr>

</table>


<table border="0" cellpadding="2" cellspacing="1" width="100%">

<tr>
<td class="dt">Rating</td>
<td class="dt" width="150">Programmer</td>
<td class="dt">Project Name</td>
<td class="dt">Review Date</td>
<td class="dt">Project Status</td>
</tr>

<?php 
if(is_array($reviews))
{
	foreach($reviews as $review)
	{
	$objproject= new project;
	$pdetails=$objproject->getdetails($review['projectid']);
	$pstatus=$objproject->getstatus($review['projectid']);
				if($pstatus=="open")
				$pstatus='<font style="color:green;">Open</font>';
				if($pstatus=="frozen")
				$pstatus= '<font style="color:blue;">Frozen</font>';
				if($pstatus=="cancelled")
				$pstatus= '<font style="color:red;">Cancelled</font>';
				if($pstatus=="closed")
				$pstatus= '<font style="color:red;">Closed</font>';
?>
<tr>
<td class="dt1"><?php echo $review['point']; ?></td>
<td class="dt1"><?php echo $objuser->getReviews($review['fromuserid']); ?></td>
<td class="dt1"><a href="projects.php?id=<?php echo $review['projectid']; ?>"><?php echo $pdetails['project_title']; ?></a></td>
<td class="dt1"><?php echo $review['reviewdate']; ?></td>
<td class="dt1"><?php echo $pstatus; ?></td>
</tr>
<tr>
<td class="dt1">&nbsp;</td>
<td class="dt1" colspan="4"><small><b>Review:</b> <?php echo $review['review']; ?></small></td>

</tr>
<?php }
} 
else
{
echo "<h3>No Reviews Found</h3>";
}
?>
</table>

<?php include $_SERVER['DOCUMENT_ROOT']."/footer.php"; ?>
<?php include $_SERVER['DOCUMENT_ROOT']."/subfooter.php"; ?>