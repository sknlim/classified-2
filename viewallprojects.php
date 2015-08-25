<?php 
include "header.php";
include "subheader.php";
$transaction = new transaction;
$user = new user;
$user_data = $user->getbyid($user->getloggedid());
$balance = $transaction->balance();

if($user_data['type']=="seeker")
{
?>
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
<div style="height:20px; clear:both;"></div>
<strong>List of All Projects You have Posted</strong>
<?php
$projectac= new project;
    $projectlist=$projectac->getAllProjectList();
    $objcommon=new common;
    if(is_array($projectlist)) 
    {
    ?>
        <div id="account_open_projects" style="clear:both; width:100%;">
        <table width="100%">
        <tr class="heading"><td>Project Title</td><td>Date</td><td>Status</td><td>Edit</td><td>Option</td><td>Select Provider</td></tr>
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
				echo "<td><a href='edit_project.php?pid=".$data['id']."'>Edit</a></td>";
				if($projectac->getStatus($data['id'])=="open")
                echo "<td><a href='javascript:;' onclick=\"loadPage('/ajax/project/cancelproject.php?pid=".$data['id']."');\">Cancel Project</a></td>";
				else
				echo "<td>Cancel Project</td>";
               	echo "<td>".$projectac->displayProviderList($data['id'])."</td>";
			    echo '</tr>';
                } 
            ?>
        </table>
        </div>
	<?php } 
	else
	echo '<h3 class="subheading" style="clear:both;">No Open projects found...</h3>';
	?>
<?php	
}	
else
	include "account_provider.php";
	
include "subfooter.php";
include "footer.php";
?>
