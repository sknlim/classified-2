<?php 
include "header.php";
include "subheader.php";
require_once "common/class/mysql.class.php";
require_once "common/class/service.class.php";
$service=new service;
$service_data = $service->getbyid($_GET['id']);
//print_r($service_data);
$user=new user();
?>


<h3 class="heading">&nbsp;<?php echo $service_data['title']; ?> - Service</h3>
<div style="margin:3px 0 0 0;"><strong>Service ID:</strong> <?php echo $_GET['id']; ?></div>
<table border="0" class="tableDetails" width="100%">
 <tr height="20"></tr>
   <tr>
    <th>&nbsp;Title : </th> <td><b><?php echo $service_data['title'];?></b></td> 
  </tr>
  <tr class="fir">
    <th>&nbsp;Posted On :</th> <td>&nbsp;<?php echo $service_data['posted_time'];?></td>
  </tr>
    <tr>
    <th width="200">&nbsp;Status :</th> <td>&nbsp;<?php echo $service_data['status'];?></td>
  </tr>
 
  <tr class="fir">
    <th >&nbsp;By Username :</th> <td >&nbsp;<?php echo $user->getUserNameFromUserId($service_data['userid']);?></td>
  </tr>
 
  <tr>
     <th>&nbsp;Category Listing  :</th> <td>&nbsp;Category Listing..</td>
  </tr>
  
   <tr class="fir">
    <th valign="top">&nbsp;Description:</th> <td valign="top">&nbsp;<?php echo $service_data['description'];?></td>
  </tr>
  <tr>
  	<th valign="top">&nbsp;Related photos:</th>
    <td><?php
		$photos=$service->getPhotos($_GET['id']);
		if($photos)
		{
		echo "<ul style=\"list-style:none\">";
		$ph=new photo;
		foreach($photos as $photo)
			{
			$img=$ph->getPhotoById($photo['photo_id'],2);
			echo '<li><a href="javascript:;" onclick="loadPage(\'/ajax/display_image.php?id='.$photo['photo_id'].'\')"><img src="'.$img.'" border="0"></a></li>';
			}
		echo "</ul>";
		}
		?>
</td>
  </tr>
</table>
<?php
include "subfooter.php";
include "footer.php";
?>
