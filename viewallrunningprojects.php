<?php 
include "header.php";
include "subheader.php";
$user = new user;
$user_data = $user->getbyid($user->getloggedid());
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
<?php
if($user_data['type']=="seeker")
{
?>
<div style="height:20px; clear:both;"></div>
<strong>List of Your Running Projects </strong>
<?php
$projectac= new project;
$projects=$projectac->getRunningProjects('seeker');
if(is_array($projects))
{
?>
   
    <div id="account_open_projects" style="clear:both; width:600px;">
    <table width="100%">
    <tr class="heading"><td>Project Title</td><td>Posted Date</td><td>Started Date</td><td>Provider</td></tr>
    <?php
    foreach($projects as $data)
    {
	$userdata=$user->getById($data['selected_userid']);
	echo '<tr>';
	echo '<td><a href="projects.php?id='.$data['id'].'">'.$data['project_title'].'</a></td>';
	echo '<td>'.$data['created_time'].'</td>';
	echo '<td>'.$data['started_time'].'</td>';
	echo '<td><a href="javascript:;" onclick="loadPage(\'review.php?pid='.$data['id'].'&touserid='.$data['selected_userid'].'\');">'.$userdata['username'].'</a></td>';
	echo '</tr>';
	}
	?>
    
        
    </table>
    </div>
<?php 
} 
	else
	echo '<h3 class="subheading" style="clear:both;">No Running projects found...</h3>';
?>

<?php	
}
?>



<?php
if($user_data['type']=="provider")
{
?>
<div style="height:20px; clear:both;"></div>
<strong>List of Your Running Projects </strong>
<?php
$projectac= new project;
$projects=$projectac->getRunningProjects('provider');
if(is_array($projects))
{
?>
   
    <div id="account_open_projects" style="clear:both; width:600px;">
    <table width="100%">
    <tr class="heading"><td>Project Title</td><td>Posted Date</td><td>Started Date</td><td>Seeker</td></tr>
    <?php
    foreach($projects as $data)
    {
	$userdata=$user->getById($data['userid']);
	echo '<tr>';
	echo '<td><a href="projects.php?id='.$data['id'].'">'.$data['project_title'].'</a></td>';
	echo '<td>'.$data['created_time'].'</td>';
	echo '<td>'.$data['started_time'].'</td>';
	echo '<td><a href="javascript:;" onclick="loadPage(\'review.php?pid='.$data['id'].'&touserid='.$data['userid'].'\');">'.$userdata['username'].'</a></td>';
	
	echo '</tr>';
	}
	?>
    
        
    </table>
    </div>
<?php 
} 
	else
	echo '<h3 class="subheading" style="clear:both;">No Running projects found...</h3>';
?>
<?php	
}
?>


<?php
include "subfooter.php";
include "footer.php";
?>