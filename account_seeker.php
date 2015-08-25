<link href="css/style.css" rel="stylesheet" type="text/css" />
<input type="button" class="bigButton" value="Edit Account Info" onclick="window.location='editprofile.php';" />
<input type="button" class="bigButton" value="Withdraw Request" onclick="loadPage('/ajax/account/withdraw.php');" />
<input type="button" class="bigButton" value="Deposit Money" onclick="loadPage('/ajax/account/deposit.php');" />
<input type="button" class="bigButton" value="Transfer Money" onclick="loadPage('/ajax/account/transfer_moeny.php');" />
<input type="button" class="bigButton" value="File Manager" onclick="loadPage('/ajax/account/filemanager.php');" />
<script>
function selectprovider(pid)
{
	providerid=document.getElementById('provider_'+pid).value;
	loadPage('/ajax/project/selectprovider.php?projectid='+pid+'&providerid='+providerid);
}

function cancelprovider(pid)
{
	loadPage('/ajax/project/cancelprovider.php?projectid='+pid);
}


</script>
<div style="height:20px;"></div>

<div id="account_management" style="width:100%; clear:both;">
<strong>Seeker - Account Management</strong>
</div>

<div style="height:10px;"></div>

<div id="balance" style="width:50%; float:left;">

  <table width="300">
    <tr bgcolor="#CCCCCC">
      <td>Balance : $<strong><?php echo $balance;?></strong></td>
    </tr>
    <tr bgcolor="#CCCCCC">
      <td> Last Transaction <br>
        Amount($) : +23232<br>
        Description: sdfasdf sdf adfa sdf asfsdaf<br>
        Date: 11/11/1111 222:200:22<br>
        <a href="account_viewall.php">View All</a> </td>
    </tr>
  </table>
</div>

<div id="escrow" style="width:50%; float:left;">
  <table width="300">
    <tr bgcolor="#CCCCCC">
      <td colspan="3"> Escrow Payment </td>
    </tr>
<?php
$escrow = new transaction;
$user = new user;
$escrow_list = $escrow->list_escrow();
if(!is_array($escrow_list))
	{
	echo "<tr><td>No Escrow Payment </td></tr>";
	}
else
	{
	echo '<tr><td>Provider</td><td>Amount</td><td>Option</td></tr>';
	foreach($escrow_list as $row)
		{
		echo '<tr><td>'.$user->getUserNameFromUserId($row['provider_userid']).'</td><td>$'.$row['amount'].'</td><td><a href="">Cancel</a></td></tr>';
		}
	}
?>
</table>
</div>

<?php
$user_data = $user->getbyid($user->getloggedid);
if($user_data['active']=="suspended")
	{
	$common = new common;
	$msg = $common->getconfigvalue('account_suspended_message');
	echo "<div style='height:20px;clear:both;'></div><div id='account_suspended' style='clear:both; text-align:center;'>".$msg ."</div><div style='height:20px;clear:both;'></div>";
	}
?>

<div style="height:20px; clear:both;"></div>
<strong>List of Your Running Projects </strong>
<?php
$projectac= new project;
$projects=$projectac->getRunningProjects('seeker','recent');
if(is_array($projects))
{
?>
   
    <div id="account_open_projects" style="clear:both; width:600px;">
    <table width="100%">
    <tr class="heading"><td>Project Title</td><td>Posted Date</td><td>Started Date</td><td>Provider</td></tr>
    <?php
    foreach($projects as $data)
    {
	//	if(!$projectac->isReviewed($data['selected_userid'],$data['id']))
	//	{	
			$userdata=$user->getById($data['selected_userid']);
			echo '<tr>';
			echo '<td><a href="projects.php?id='.$data['id'].'">'.$data['project_title'].'</a></td>';
			echo '<td>'.$data['created_time'].'</td>';
			echo '<td>'.$data['started_time'].'</td>';
			echo '<td><a href="javascript:;" onclick="loadPage(\'review.php?pid='.$data['id'].'&touserid='.$data['selected_userid'].'\');">'.$userdata['username'].'</a></td>';
			echo '</tr>';
	//	}	
	}
	?>
    
        
    </table>
    </div>
<?php 
} 
	else
	echo '<h3 class="subheading" style="clear:both;">No Running projects found...</h3>';
?>
<a href="viewallrunningprojects.php">View All</a>
<div style="height:20px; clear:both;"></div>
<strong>List of Open Projects You have Posted</strong>

<?php
   
    $projectlist=$projectac->getOpenProjectList();
    $objcommon=new common;
    if(is_array($projectlist)) 
    {
    ?>
        <div id="account_open_projects" style="clear:both; width:100%;">
        
        <table width="100%">
        <tr class="heading"><td>Project Title</td><td>Posted On</td><td>Status</td><td>Select Provider</td><td>Edit</td><td>Option</td></tr>
            <?php 
                foreach($projectlist as $data)
                {
				$pstatus=$projectac->getStatus($data['id']);
				
				if($pstatus=="open")
				$pstatus='<font style="color:green;">Open</font>';
				if($pstatus=="frozen")
				$pstatus='<font style="color:blue;">Frozen</font>';
				if($pstatus=="cancelled")
				$pstatus='<font style="color:red;">Cancelled</font>';
				if($pstatus=="closed")
				$pstatus='<font style="color:red;">Closed</font>';
				
				echo '<tr>';
                echo '<td><a href="projects.php?id='.$data['id'].'">'.$data['project_title'].'</a></td>';
                echo '<td>'.$objcommon->Fuzzytime($data['created_time']).'</td>';
                echo '<td>'.$pstatus.'</td>';
				echo "<td>".$projectac->displayProviderList($data['id'])."</td>";
				echo "<td><a href='edit_project.php?pid=".$data['id']."'>Edit</a></td>";
				$projectstat=$projectac->getStatus($data['id']);
				if($projectstat=="open" || $projectstat="frozen")
                echo "<td><a href='javascript:;' onclick=\"loadPage('/ajax/project/cancelproject.php?pid=".$data['id']."');\">Cancel Project</a></td>";
				else
				echo "<td>Cancel Project</td>";
			    echo '</tr>';
                } 
            ?>
        </table>
        </div>
        
	<?php } 
	else
	echo '<h3 class="subheading" style="clear:both;">No Open projects found...</h3>';
	?>
    <a href="viewallprojects.php">View All</a>



<div style="height:20px; clear:both;"></div>
<strong>List of Open Jobs You have Posted</strong>

<?php
	$objjob=new jobs;
    $joblist=$objjob->get_open_jobs();
	$objmaincat=new maincategory;
    $objcommon=new common;
    if(is_array($joblist)) 
    {
    ?>
        <div id="account_open_projects" style="clear:both; width:100%;">
        <table width="100%" >
        <tr class="heading"><td>Required For</td><td>Posted On</td><td>Status</td><td>Edit</td><td>Option</td></tr>
            <?php 
                foreach($joblist as $data)
                {
				if($data['status']=="active")
				$status='<font style="color:green;">Active</font>';
				else
				$status='<font style="color:red;">Blocked</font>';
				echo '<tr>';
                echo '<td><a href="job_view.php?id='.$data['id'].'">'.$data['title'].'</a></td>';
                echo '<td>'.$data['posted_time'].'</td>';
				echo '<td>'.$status.'</td>';
               	echo "<td><a href='edit_job.php?jid=".$data['id']."'>Edit</a></td>";
				if($data['status']=="active")
				echo "<td><a href='javascript:;'  onclick=\"loadPage('/ajax/jobs/blockjob.php?jid=".$data['id']."&action=block');\">Block</a></td>";
				else
				echo "<td><a href='javascript:;'  onclick=\"loadPage('/ajax/jobs/blockjob.php?jid=".$data['id']."&action=active');\">Active</a></td>";
			    echo '</tr>';
                } 
            ?>
        </table>
        </div>
	<?php } 
	else
	echo '<h3 class="subheading" style="clear:both;">No Open Jobs found...</h3>';
	?>
    <a href="viewalljobs.php">View All</a>
