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
<strong>List of All Rent or Hire You have Posted</strong>
<?php
	$objrentorhire=new rentorhire;
    $rentorhirelist=$objrentorhire->get_all_rentorhire_by_userid($_SESSION['foongigs_userid']);
	$objmaincat=new maincategory;
    $objcommon=new common;
    if(is_array($rentorhirelist)) 
    {
    ?>
        <div id="account_open_projects" style="clear:both; width:100%;">
        <table width="100%" >
        <tr class="heading"><td>Rent or Hire Title</td><td>Posted On</td><td>Status</td><td>Edit</td><td>Option</td></tr>
            <?php 
                foreach($rentorhirelist as $data)
                {
				echo '<tr>';
                echo '<td><a href="rentofhire_view.php?id='.$data['id'].'">'.$data['name'].'</a></td>';
                echo '<td>'.$data['posted_time'].'</td>';
				echo '<td>'.$objrentorhire->getstatus($data['id']).'</td>';
               	echo "<td><a href='edit_rentorhire.php?rid=".$data['id']."'>Edit</a></td>";
				echo "<td>".$objrentorhire->getoption($data['id'])."</td>";
			    echo '</tr>';
                } 
            ?>
        </table>
        </div>
	<?php } 
	else
	echo '<h3 class="subheading" style="clear:both;">No Rent or Hire found...</h3>';
	?> 
 
<?php	
}	

	
include "subfooter.php";
include "footer.php";
?>
