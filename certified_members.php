<?php 
include "header.php";
include "subheader.php";
?>
<?php
$objuser=new user;
$certifiedprovider=$objuser->get_certified_members('provider');
?>

<h3 class="heading">Certified Service Providers</h3>
	<table width="100%" align="center" cellpadding="1" cellspacing="1">
          <tr bgcolor="#dedede" height="25">
            <td align="center">Username</td>
            <td align="center">Reviews</td>
            <td align="center">Points</td>
            <td align="center">Rating</td>
         </tr>
     <?php
	 
		  foreach($certifiedprovider as $data)
			{
			$cal=$objuser->getCalculation($data['id']);
			$color=($color=="EEEEEE")?"E0E0E0":"EEEEEE";
			echo  '<tr bgcolor="#'.$color.'" height="25">' ;
			echo '<td><a href="viewprofile.php?id='.$data['id'].'">'.$data['username'].'</a> [C] </td>';
			echo '<td align="center">'.$cal['review'].'</td>';
			echo '<td align="center">'.$cal['points'].'</td>';
			echo '<td align="center">'.$objuser->getRating($data['id']).'</td>';
			echo '</tr>';
			}
	 ?>    
     </table>
		 
<br />			
<h3 class="heading">Certified Service Seekers</h3>
	<table width="100%" align="center" cellpadding="1" cellspacing="1">
          <tr bgcolor="#dedede" height="25">
            <td align="center">Username</td>
            <td align="center">Reviews</td>
            <td align="center">Points</td>
            <td align="center">Rating</td>
         </tr>
     <?php
	 $certifiedprovider=$objuser->get_certified_members('seeker');
		  foreach($certifiedprovider as $data)
			{
			$cal=$objuser->getCalculation($data['id']);
			$color=($color=="EEEEEE")?"E0E0E0":"EEEEEE";
			echo  '<tr bgcolor="#'.$color.'" height="25">' ;
			echo '<td><a href="viewprofile.php?id='.$data['id'].'">'.$data['username'].'</a> [C] </td>';
			echo '<td align="center">'.$cal['review'].'</td>';
			echo '<td align="center">'.$cal['points'].'</td>';
			echo '<td align="center">'.$objuser->getRating($data['id']).'</td>';
			echo '</tr>';
			}
	 ?>    
     </table>


<?php
include "subfooter.php";
include "footer.php";
?>
