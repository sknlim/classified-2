<?php include "header.php"; 
include "subheader.php";
require_once "common/class/common.class.php";

$objuser=new user;
$data=$objuser->editprofile($_SESSION['foongigs_userid']);
?>



<div style="width: 800px; margin:0 auto; margin-top: 40px;">
<div style="font-family:'Trebuchet MS'; margin-bottom:10px; text-align:left">
  <h1>Edit Profile</h1>
</div>
<div style="width:800px; margin:0 auto; background:#FFFFFF; text-align:center; border-top: 2px solid #CCC; border-bottom: 2px solid #CCC;">
  <!--<div class="wrapper">-->
  <!--<fieldset>-->
  <div class="content">
    <form name="frmeditprofile" method="POST" action="ajax/account/updateprofile.php" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;" class="formLeft">
      
      <span class="inlineBlock" style="width:300px">
      <div class="formRow">
        <label for="fname">First Name</label>
        <input type="text" name="fname" id="fname" class=" vldnoblank bigTextBox width250" value="<?php echo $data['firstname']; ?>">
        <span class="checkStatus"></span> </div>
      </span> <span class="inlineBlock" style="width:300px">
      <div class="formRow">
        <label for="lname">Last Name</label>
        <input type="text" name="lname" id="lname" class="vldnoblank bigTextBox width250"  value="<?php echo $data['lastname']; ?>">
        <span class="checkStatus"></span> </div>
      </span>
      
      
      <div class="formRow">
        <label for="fname">Company Name</label>
        <input type="text" name="company" id="company" class=" bigTextBox width250"  value="<?php echo $data['company']; ?>">
        <span class="checkStatus"></span> 
       </div>
        <div class="formRow">
        <label for="fname">Profile - About You / Your Company</label>
        <textarea name="profile" id="profile" class="bigTextBox" style="width:550px;height:150px;"  ><?php echo $data['profile']; ?></textarea>
        <span class="checkStatus"></span> 
       </div>
       
       <div class="formRow">
        <label for="fname">Job Type - Seeker - What type of service you can provide?</label>
        <textarea name="jobtype" id="jobtype" class="bigTextBox" style="width:550px;height:150px;"  ><?php echo $data['jobtype']; ?></textarea>
        <span class="checkStatus"></span> 
       </div>
       
      <span class="inlineBlock" style="width:300px">
      <div class="formRow">
        <label for="email">Email Address</label>
        <input type="text" name="email" id="email"  class="vldemail bigTextBox width250"  value="<?php echo $data['email']; ?>">
       <span class="checkStatus"></span> </div>
      </span> 
     

      <?php 
						$common_class=new common();
						$array1=$common_class->getCountryList();
						?>
      <div class="formRow">
        <label for="country">Country</label>
        <select name="country" id="country"  class="vldnoblank bigTextBox width250">
          <option value="" selected="selected">Select Country</option>
          <?php foreach($array1 as $data1)
				 {
				 echo "<option value=\"".$data1['countryid'];?>
          "
          <?php if($data1['countryid']==$data['country_id']) {?>
          
           selected="selected"
          <?php }?>
          ><?php echo $data1['country']; echo'</option> ';
				 }
				 ?>
        </select>
        <span class="checkStatus"></span> </div>
      <div class="formRow">
        <label for="email">State</label>
        <input type="text" name="state" id="state"  class="vldnoblank bigTextBox width250" value="<?php echo $data['state']; ?>">
        <span class="checkStatus"></span> </div>
      <span class="inlineBlock" style="width:300px">
      <div class="formRow">
        <label for="email">City</label>
        <input type="text" name="city" id="city"  class="vldnoblank bigTextBox width250" value="<?php echo $data['city']; ?>">
        <span class="checkStatus"></span> </div>
      </span> <span class="inlineBlock" style="width:300px">
      <div class="formRow">
        <label for="zip">Zip code</label>
        <input type="text" name="zip" id="zip"  class="vldnum vldnoblank bigTextBox width250" value="<?php echo $data['zip']; ?>">
        <span class="checkStatus"></span> </div>
      </span>
      <div class="formRow">
      <?php 
	  $day=date("j",strtotime($data['dob']));
	  $month=date("n",strtotime($data['dob']));
	  $year=date("Y",strtotime($data['dob']));
	  ?>
        <label for="mm">Date of Birth</label>
        <select name="mm" id="mm"  class="vldnoblank bigTextBox" errormessage="Please select a valid Date of birth">
          <option value="" selected="selected">Month</option>
          <option value="1" <?php if($month=="1") echo "selected='selected'"; ?> > Jan </option>
          <option value="2" <?php if($month=="2") echo "selected='selected'"; ?> > Feb </option>
          <option value="3" <?php if($month=="3") echo "selected='selected'"; ?>> Mar </option>
          <option value="4" <?php if($month=="4") echo "selected='selected'"; ?>> Apr </option>
          <option value="5" <?php if($month=="5") echo "selected='selected'"; ?>> May </option>
          <option value="6" <?php if($month=="6") echo "selected='selected'"; ?>> Jun </option>
          <option value="7" <?php if($month=="7") echo "selected='selected'"; ?>> Jul </option>
          <option value="8" <?php if($month=="8") echo "selected='selected'"; ?>> Aug </option>
          <option value="9" <?php if($month=="9") echo "selected='selected'"; ?>> Sep </option>
          <option value="10" <?php if($month=="10") echo "selected='selected'"; ?>> Oct </option>
          <option value="11"  <?php if($month=="11") echo "selected='selected'"; ?>> Nov </option>
          <option value="12" <?php if($month=="12") echo "selected='selected'"; ?>> Dec </option>
        </select>
        <select name="dd" id="dd" class="vldnoblank bigTextBox" errormessage="Please select a valid Date of birth">
          <option value="">Day</option>
          <?php for($i=1;$i<=31;$i++)
						{
						echo '<option value="'.$i.'"';
						if($i==$day)
						echo "selected='selected'";
						echo '>'.$i.'</option>';
						}	
						?>
        </select>
        <select name="yyyy" id="yyyy"  class="vldnoblank bigTextBox" errormessage="Please select a valid Date of birth">
          <option value="">Year</option>
          <?php $today = date("Y");
							for($i=($today-17);$i!=($today-120);$i--)
							{
							echo '<option value="'.$i.'"';
							if($i==$year)
							echo "selected='selected'";
							echo '>'.$i.'</option>';
							}
						?>
        </select>
        <span class="checkStatus"></span> </div>
      <div class="formRow">
        <label>Gender</label>
        <div class="lineBreak"></div>
        <div style="padding-left:10px">
          <input name="gender" id="male" value="male" type="radio"  <?php if($data['gender']=="Male") echo "checked='checked'"; ?>>
          Male<br />
          <input name="gender" id="female" value="female" type="radio" <?php if($data['gender']=="Female") echo "checked='checked'"; ?>>
          Female <span class="checkStatus" ></span> </div>
      </div>
      
      <div class="formRow">
        <input type="submit" value="Update" style="width:200px; font-size:18px; padding:10px; color:#333333"/>
      </div>
  
    </form>
  </div>
  <!-- </div> -->
  <!--</fieldset>-->
</div>
<?php include "footer.php"; ?>
