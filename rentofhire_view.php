<?php 
include "header.php";
include "subheader.php";
require_once "common/class/mysql.class.php";
require_once "common/class/service.class.php";
$rentorhire=new rentorhire;
$rentorhire_data = $rentorhire->getbyid($_GET['id']);
//print_r($rentorhire_data);
$user=new user();
?>

<h3 class="heading">&nbsp;<?php echo $rentorhire_data['name']; ?> - Rent or Hire</h3>
<div style="margin:3px 0 0 0;"><strong>Rent or Hire ID:</strong> <?php echo $_GET['id']; ?></div>
<table border="0" class="tableDetails" align="center">
	<tr height="20"></tr>
   <tr class="fir">
    <th>&nbsp;Title : </th> <td><b><?php echo $rentorhire_data['name'];?></b></td> 
  </tr>
    <tr>
    <th width="200">&nbsp;Status :</th> <td>&nbsp;<?php echo $rentorhire_data['status'];?></td>
  </tr>
   <tr class="fir">
    <th>&nbsp;Posted On :</th> <td>&nbsp;<?php echo $rentorhire_data['posted_time'];?></td>
  </tr>

  <tr>
    <th >&nbsp;By Username :</th> <td >&nbsp;<?php echo $user->getUserNameFromUserId($rentorhire_data['userid']);?></td>
  </tr>
 
  <tr class="fir">
     <th>&nbsp;Category Listing  :</th> <td>&nbsp;Category Listing..</td>
  </tr>
  
   <tr>
    <th valign="top">&nbsp;Description:</th> <td valign="top"><?php echo $rentorhire_data['description'];?></td>
  </tr>

 <tr>
  	<th valign="top">&nbsp;Related photos:</th>
    <td><?php
		$photos=$rentorhire->getPhotos($_GET['id']);
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
