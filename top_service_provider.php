<?php 
include "header.php";
include "subheader.php";
?>
<?php
$objuser=new user;
$serviceproviders=$objuser->get_top_service_providers();
?>

<h3 class="heading">Top Service Providers</h3>
	<table width="100%" align="center" cellpadding="1" cellspacing="1">
          <tr bgcolor="#dedede" height="25">
            <td align="center">Username</td>
            <td align="center">Reviews</td>
            <td align="center">Points</td>
            <td align="center">Rating</td>
         </tr>
     <?php
	 
		  foreach($serviceproviders as $data)
			{
			$cal=$objuser->getCalculation($data['id']);
			$color=($color=="EEEEEE")?"E0E0E0":"EEEEEE";
			echo  '<tr bgcolor="#'.$color.'" height="25">' ;
			echo '<td><a href="viewprofile.php?id='.$data['id'].'">'.$data['username'].'</a>';
			if($data['certified_member']=="yes")
			echo " [C] ";
			echo '</td>';
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
