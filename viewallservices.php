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
<strong>List of All Services You have Posted</strong>
<?php
	$objservice=new service;
    $servicelist=$objservice->get_all_services_by_userid($_SESSION['foongigs_userid']);
	$objmaincat=new maincategory;
    $objcommon=new common;
    if(is_array($servicelist)) 
    {
    ?>
        <div id="account_open_projects" style="clear:both; width:100%;">
        <table width="100%" >
        <tr class="heading"><td>Service Title</td><td>Posted On</td><td>Status</td><td>Edit</td><td>Option</td></tr>
            <?php 
                foreach($servicelist as $data)
                {
				echo '<tr>';
                echo '<td><a href="service_view.php?id='.$data['id'].'">'.$data['title'].'</a></td>';
                echo '<td>'.$data['posted_time'].'</td>';
				echo '<td>'.$objservice->getstatus($data['id']).'</td>';
               	echo "<td><a href='edit_service.php?sid=".$data['id']."'>Edit</a></td>";
				echo "<td>".$objservice->getoption($data['id'])."</td>";
			    echo '</tr>';
                } 
            ?>
        </table>
        </div>
	<?php } 
	else
	echo '<h3 class="subheading" style="clear:both;">No Services found...</h3>';
	?> 
 
<?php	
}	

	
include "subfooter.php";
include "footer.php";
?>
