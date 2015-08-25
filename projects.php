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
$projects=$objproject->getdetails($_GET['id']);
?>
<script language="javascript">
function textCounter(field,cntfield,maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else
cntfield.value = maxlimit - field.value.length;
}
</script>
<h3 class="heading">&nbsp;<?php echo $projects['project_title']; ?></h3>
<div><strong>Project ID: </strong><?php echo $_GET['id']; ?></div>
<br />
<table border="0" cellpadding="2" cellspacing="0" width="100%" class="tableDetails">
<tbody>
    <tr class="fir">
        <td class="dt1" valign="top" width="20%"><b>Status:</b></td>
        <td class="dt1" valign="top" width="80%"><?php  
				$pstatus=$objproject->getstatus($_GET['id']);
				if($pstatus=="open")
				echo '<font style="color:green;">Open</font>';
				if($pstatus=="frozen")
				echo '<font style="color:blue;">Frozen</font>';
				if($pstatus=="cancelled")
				echo '<font style="color:red;">Cancelled</font>';
				if($pstatus=="closed")
				echo '<font style="color:red;">Closed</font>';
		?></td>
    </tr>

    <tr>
        <td class="dt2" valign="top"><b>Budget:</b></td>
        <td class="dt2" valign="top">$<?php echo $projects['min_budget']."-".$projects['max_budget']; ?></td>
    </tr>

    <tr class="fir">
        <td class="dt1" valign="top"><b>Created:</b></td>
        <td class="dt1" valign="top">
        <?php echo $objproject->longDateFormat($projects['created_time']); ?>
        </td>
    </tr>

    <tr>
        <td class="dt2" valign="top"><b>Bidding Ends:</b></td>
        <td class="dt2" valign="top">
	<?php echo $objproject->longDateFormat($projects['expiry_date']);  echo " (".$objproject->getDaysLeftText($_GET['id']).")"; ?>
        </td>
    </tr>

    <tr class="fir">
        <td class="dt1" valign="top"><b>Project Creator:</b></td>
        <td class="dt1" valign="top"><?php 
		$objuser = new user;
		echo $objuser->getReviews($projects['userid']); 
		?></td>
    </tr>

    <tr>
        <td class="dt2" valign="top"><b>Description:</b></td>
        <td class="dt2" valign="top">
        <?php echo $projects['description']; ?>
        
        </td>
    </tr>

<?php if($objproject->hasfiles($_GET['id']))
{ ?>

	<tr class="fir">
        <td class="dt2" valign="top"><b>Attached File:</b></td>
        <td class="dt2" valign="top">
		<?php $objproject->listfiles($_GET['id'])."<br>"; ?>            
        </td>
	</tr>
<?php } ?>	
<tr>
<td class="dt1" valign="top"><b>Job Type:</b></td>
<td class="dt1" valign="top"><?php echo $projects['jobtype']; ?></td>
</tr>
</tbody>
</table>
<br /><br />



<table>
<tr><td><input type="button" value="View Project Message Board" onclick="window.location='messageboard.php?pid=<?php echo $_GET['id']; ?>';"/><br />
<small>Message Posted : <?php echo $objproject->countmessage($_GET['id']); ?></small>
</td></tr>
<tr><td><br />
<?php if($pstatus=="open") { ?>
<input type="button" value="Place Bid" onclick="
<?php 	if($_SESSION['foongigs_usertype']=="seeker")  echo "messageBox('Only providers are allowed to post bid');"; 
		else echo "loadPage('placebid.php?pid=".$_GET['id']."');"; ?>" />
 <?php } 
else {
echo '<input type="button" value="Place Bid" onclick="messageBox(\'Bidding Closed for the Project\');">';
	}		
		?>
        </td></tr>

</table>

    <?php $projectbids=$objproject->getAllBids($_GET['id']); 
	if(is_array($projectbids)) {
	?>
	<table width="100%">
        <tr bgcolor="#FFFFFF">
        <td>&nbsp;&nbsp;Providers</td>
        <td>&nbsp;&nbsp;Bid</td>
        <td>&nbsp;&nbsp;Delivery Within</td>
        <td>&nbsp;&nbsp;Time of Bid</td>
        <td>&nbsp;&nbsp;Rating</td>
        </tr>
        <?php 	if($objproject->ishidden($_GET['id'])) 
			 	{ 
					echo "<tr><td colspan='5' align='center'>(".count($projectbids)." bids have been placed. ".$objuser->getUserNameFromUserId($projects['userid'])." has chosen to keep all bids for this project hidden.)</td></tr>";
				} 
				else 
				{
				$common = new common;
					  foreach($projectbids as $data) 
					  { ?>
				        <tr>
			        	<td><?php echo "<a href='viewprofile.php?id=".$data['userid']."'>".$objuser->getUserNameFromUserId($data['userid'])."</a>"; ?></td>
           				<td><?php echo "$".$data['amount']; ?></td>
			          	<td><?php echo $data['days']." Days"; ?></td>
           				<td><?php echo $common->Fuzzytime($data['bid_time']); ?></td>
			           	<td><?php echo $objuser->getRating($data['userid']); ?></td>
				        </tr>
				        <tr><td colspan="5"><?php echo $data['comment']; ?></td></tr>
			   <?php } 
			   }
			   ?>
        
	</table>
    <?php } else {	?>
    <table align="center">
    	<tr><td>No Bids Placed Yet..</td></tr>
    </table>
    <?php } ?>
    
    
<table>
<tr><td>

<?php if($pstatus=="open") { ?>
<input type="button" value="Place Bid" onclick="
<?php 	if($_SESSION['foongigs_usertype']=="seeker")  echo "messageBox('Only providers are allowed to post bid');"; 
		else echo "loadPage('placebid.php?pid=".$_GET['id']."');"; ?>" />
 <?php } 
else {
echo '<input type="button" value="Place Bid" onclick="messageBox(\'Bidding Closed for the Project\');">';
	}		
		?></td></tr>
</table>

<?php include "footer.php"; ?>
<?php include "subfooter.php"; ?>
