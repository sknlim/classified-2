<?php 
include "header.php";
include "subheader.php";
require_once "common/class/mysql.class.php";
require_once "common/class/jobs.class.php";
$common_class=new jobs();
$mysql_querry=new mysql();
$jobs=new jobs();
$job=$jobs->get_job_by_id($_GET['id']);
$objmaincat=new maincategory;
$user=new user();
?>
<h3 class="heading">&nbsp;<?php echo $job['title']; ?> - Jobs</h3>
<div style="margin:3px 0 0 0;"><strong>Job ID:</strong> <?php echo $_GET['id']; ?></div>
<table border="0" class="tableDetails" width="100%">
  <tr height="20"></tr>
   <tr class="fir">
    <th width="175">&nbsp;Title : </th> <td><b><?php echo $job['title'];?></b></td> 
  </tr>
  <tr>
    <th>&nbsp;Posted On :</th> <td>&nbsp;<?php echo $job['posted_time'];?></td>
  </tr>
  <tr>
    <th>&nbsp;Job Type :</th> <td>&nbsp;<?php echo $job['category'];?></td>
  </tr>
  <tr>
    <th>&nbsp;State :</th> <td>&nbsp;<?php echo $objmaincat->getsubcategoryname($job['sub_maincategory_id']);?></td>
  </tr>
  <tr>
    <th>&nbsp;Salary :</th> <td>&nbsp;<?php echo "$".$job['salary_minimum']."-".$job['salary_maximum']; ?></td>
  </tr>
  
   <tr class="fir">
    <th>&nbsp;Status :</th> <td>&nbsp;<?php echo $job['status'];?></td>
  </tr>

  <tr>
    <th>&nbsp;By Username :</th> <td >&nbsp;<?php echo $user->getUserNameFromUserId($job['userid']);?></td>
  </tr>
 
  <tr class="fir">
     <th>&nbsp;Company :</th> <td>&nbsp;<?php echo $job['company'];?></td>
  </tr>
  
  <tr>
    <th>&nbsp;Company URL :</th> <td>&nbsp;<a href="<?php echo trim($job['company_url']);?>"><?php echo $job['company_url'];?></a></td>
  </tr>

  <tr class="fir">
    <th valign="top">&nbsp;Description:</th> <td valign="top">&nbsp;<?php echo $job['description'];?></td>
  </tr>

 <tr>
    <th>&nbsp;Contact :</th> <td>&nbsp;<?php echo $job['contact'];?></td>
  </tr>
  
</table>

<?php
include "subfooter.php";
include "footer.php";
?>
