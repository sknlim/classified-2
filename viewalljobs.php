<?php 
include "header.php";
include "subheader.php";
$transaction = new transaction;
$user = new user;
$user_data = $user->getbyid($user->getloggedid());
$balance = $transaction->balance();

if($user_data['type']=="seeker" || $user_data['type']=="provider")
{
?>

<div style="height:20px; clear:both;"></div>
<strong>List of All Jobs You have Posted</strong>
<?php
	$objjob=new jobs;
    $joblist=$objjob->get_all_jobs_by_userid($_SESSION['foongigs_userid']);
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
				echo '<tr>';
                echo '<td><a href="job_view.php?id='.$data['id'].'">'.$data['title'].'</a></td>';
                echo '<td>'.$data['posted_time'].'</td>';
				echo '<td>'.$objjob->getstatus($data['id']).'</td>';
               	echo "<td><a href='edit_job.php?jid=".$data['id']."'>Edit</a></td>";
				echo "<td>".$objjob->getoption($data['id'])."</td>";
			    echo '</tr>';
                } 
            ?>
        </table>
        </div>
	<?php } 
	else
	echo '<h3 class="subheading" style="clear:both;">No Jobs found...</h3>';
	?> 
 
<?php	
}	

	
include "subfooter.php";
include "footer.php";
?>
