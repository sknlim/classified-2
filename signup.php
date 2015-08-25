<?php include "header.php"; 
require_once "common/class/common.class.php";
?>

<div style="width: 800px; margin:0 auto; margin-top: 40px;">
<div style="font-family:'Trebuchet MS'; margin-bottom:10px; text-align:left">
  <h1>Sign up</h1>
</div>
<div style="width:800px; margin:0 auto; background:#FFFFFF; text-align:center; border-top: 2px solid #CCC; border-bottom: 2px solid #CCC;">
  <!--<div class="wrapper">-->
  <!--<fieldset>-->
  <div class="content">
    <form name="frmsignup" method="POST" action="ajax/user/createaccount.php" onsubmit="if(validateForm(this)) submitFormOnFloat(this); return false;" class="formLeft">
      <div class="formRow">
        <label>Type</label>
        <div class="lineBreak"></div>
        <div style="padding-left:10px">
          <input name="type" id="seeker" value="seeker" type="radio"  checked="checked">
          Seeker (offer a service)<br />
          <input name="type" id="provider" value="provider" type="radio" >
          Provider (hire)<span class="checkStatus" ></span> </div>
      </div>
      <div class="formRow">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="vldnoblank bigTextBox width250">
        <span class="checkStatus"></span> </div>
      <span class="inlineBlock" style="width:300px">
      <div class="formRow">
        <label for="fname">First Name</label>
        <input type="text" name="fname" id="fname" class=" vldnoblank bigTextBox width250">
        <span class="checkStatus"></span> </div>
      </span> <span class="inlineBlock" style="width:300px">
      <div class="formRow">
        <label for="lname">Last Name</label>
        <input type="text" name="lname" id="lname" class="vldnoblank bigTextBox width250">
        <span class="checkStatus"></span> </div>
      </span>
      
      
      <div class="formRow">
        <label for="fname">Company Name</label>
        <input type="text" name="company" id="company" class=" bigTextBox width250">
        <span class="checkStatus"></span> 
       </div>
        <div class="formRow">
        <label for="fname">Profile - About You / Your Company</label>
        <textarea name="profile" id="profile" class="bigTextBox" style="width:550px;height:150px;"></textarea>
        <span class="checkStatus"></span> 
       </div>
       
       <div class="formRow">
        <label for="fname">Job Type - Seeker - What type of service you can provide?</label>
        <textarea name="jobtype" id="jobtype" class="bigTextBox" style="width:550px;height:150px;"></textarea>
        <span class="checkStatus"></span> 
       </div>
       
      <span class="inlineBlock" style="width:300px">
      <div class="formRow">
        <label for="email">Email Address</label>
        <input type="text" name="email" id="email"  class="vldemail bigTextBox width250">
        <small>An email verification will be sent here</small> <span class="checkStatus"></span> </div>
      </span> <span class="inlineBlock" style="width:300px">
      <div class="formRow">
        <label for="retypeemail">Retype Email Address</label>
        <input type="text" name="retypeemail" id="retypeemail"  class="vld_fld_equalto_email bigTextBox width250" errormessage="It should be same as the email address">
        <span class="checkStatus"></span> </div>
      </span> <span class="inlineBlock" style="width:300px">
      <div class="formRow">
        <label for="password">Password</label>
        <input type="password" name="password" id="password"  class="vldpass bigTextBox width250" errormessage="Please enter a valid password length">
        <span class="checkStatus"></span><small>(6-10 characters)</small> </div>
      </span> <span class="inlineBlock" style="width:300px">
      <div class="formRow">
        <label for="retypepassword">Retype Password</label>
        <input type="password" name="retypepassword" id="retypepassword"  class="vld_fld_equalto_password width250 bigTextBox" errormessage="It should be same as the password">
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
          <?php foreach($array1 as $data)
				 {
				 echo "<option value=\"".$data['countryid'];?>
          "
          <?php if($data['countryid']=="254") {?>
          
           selected="selected"
          <?php }?>
          ><?php echo $data['country']; echo'</option> ';
				 }
				 ?>
        </select>
        <span class="checkStatus"></span> </div>
      <div class="formRow">
        <label for="email">State</label>
        <input type="text" name="state" id="state"  class="vldnoblank bigTextBox width250">
        <span class="checkStatus"></span> </div>
      <span class="inlineBlock" style="width:300px">
      <div class="formRow">
        <label for="email">City</label>
        <input type="text" name="city" id="city"  class="vldnoblank bigTextBox width250">
        <span class="checkStatus"></span> </div>
      </span> <span class="inlineBlock" style="width:300px">
      <div class="formRow">
        <label for="zip">Zip code</label>
        <input type="text" name="zip" id="zip"  class="vldnum vldnoblank bigTextBox width250">
        <span class="checkStatus"></span> </div>
      </span>
      <div class="formRow">
        <label for="mm">Date of Birth</label>
        <select name="mm" id="mm"  class="vldnoblank bigTextBox" errormessage="Please select a valid Date of birth">
          <option value="" selected="selected">Month</option>
          <option value="1" > Jan </option>
          <option value="2" > Feb </option>
          <option value="3" > Mar </option>
          <option value="4" > Apr </option>
          <option value="5" > May </option>
          <option value="6" > Jun </option>
          <option value="7" > Jul </option>
          <option value="8" > Aug </option>
          <option value="9" > Sep </option>
          <option value="10"> Oct </option>
          <option value="11" > Nov </option>
          <option value="12" > Dec </option>
        </select>
        <select name="dd" id="dd" class="vldnoblank bigTextBox" errormessage="Please select a valid Date of birth">
          <option value="">Day</option>
          <?php for($i=1;$i<=31;$i++)
						{
						echo '<option value="'.$i.'">'.$i.'</option>';
						}	
						?>
        </select>
        <select name="yyyy" id="yyyy"  class="vldnoblank bigTextBox" errormessage="Please select a valid Date of birth">
          <option value="">Year</option>
          <?php $today = date("Y");
							for($i=($today-17);$i!=($today-120);$i--)
							{
							echo '<option value="'.$i.'">'.$i.'</option>';
							}
						?>
        </select>
        <span class="checkStatus"></span> </div>
      <div class="formRow">
        <label>Gender</label>
        <div class="lineBreak"></div>
        <div style="padding-left:10px">
          <input name="gender" id="male" value="male" type="radio"  checked="checked">
          Male<br />
          <input name="gender" id="female" value="female" type="radio" >
          Female <span class="checkStatus" ></span> </div>
      </div>
      <div style="padding:10px; width:260px;" class="vistaStyle">
        <div class="formRow">
          <label for="verificationcode">Are you human?<br />
          <font size="-1">Enter the Code Shown Here</font></label>
          <img src="picture.php" /><br />
          <input type="text" name="verificationcode" id="verificationcode"   class="bigTextBox width250"/>
          <span class="checkStatus" ></span> </div>
      </div>
      <br />
      <div class="formRow" style="font-size:16px;">
        <input name="agree" class="vldmustchecked" id="agree" type="checkbox" errormessage="You must agree our terms & conditions to proceed" style="vertical-align:middle">
        I agree <a href="javascript:loadPage('terms.php','','variable=value');">terms & conditions</a> <span class="checkStatus"></span> </div>
      <div class="formRow">
        <input type="submit" value="Submit" style="width:200px; font-size:18px; padding:10px; color:#333333"/>
      </div>
      <!--
  <div class="formRow">
				<span class="fieldName"><label for="programmer">Type</label></span>
				<span class="fieldVal">
			<input name="type" id="programmer" value="programmer" type="radio"  checked="checked"> Programmer
			<input name="type" id="webmaster" value="webmaster" type="radio" > Webmaster <span class="checkStatus" ></span>
		</span>
		</div>
		
		 <div class="formRow">
				<span class="fieldName"><label for="username">Username</label></span>
				<span class="fieldVal"><input type="text" name="username" id="username" class=" vldnoblank vistaStyle width180">
                <span class="checkStatus"></span></span>
        </div>
		
		<div class="formRow">
				<span class="fieldName"><label for="fname">First Name</label></span>
				<span class="fieldVal"><input type="text" name="fname" id="fname" class=" vldnoblank vistaStyle width180">
                <span class="checkStatus"></span></span>
        </div>
		
		<div class="formRow">
				<span class="fieldName"><label for="lname">Last Name</label></span>
				<span class="fieldVal"><input type="text" name="lname" id="lname" class="vldnoblank vistaStyle width180">
                <span class="checkStatus"></span></span>
        </div>
         
         <div class="formRow">
				<span class="fieldName"><label for="email">Email Address</label></span>
				<span class="fieldVal"><input type="text" name="email" id="email"  class="vldemail vistaStyle width180">
                <span class="checkStatus"></span></span>
        </div>
        
         <div class="formRow">
				<span class="fieldName"><label for="retypeemail">Retype Email Address</label></span>
				<span class="fieldVal"><input type="text" name="retypeemail" id="retypeemail"  class="vldemail vistaStyle width180">
                <span class="checkStatus"></span>
            	<small>An email verification will be sent here</small>
           </span>
		</div>

        
         <div class="formRow">
				<span class="fieldName"><label for="password">Password</label></span>
				<span class="fieldVal"><input type="password" name="password" id="password"  class="vldpass vistaStyle width180"><span class="checkStatus"></span>
            <small>(6-10 characters)</small>
           </span>
			</div>

         <div class="formRow">
				<span class="fieldName"><label for="retypepassword">Retype Password</label></span>
				<span class="fieldVal"><input type="password" name="retypepassword" id="retypepassword"  class="vld_fld_equalto_password vistaStyle width180"><span class="checkStatus"></span></span>
			</div>

		  
       
		<?php 
						$common_class=new common();
						$array1=$common_class->getCountryList();
						?>
		<div class="formRow">
				<span class="fieldName"><label for="country">Country</label></span>
				<span class="fieldVal">
				<select name="country" id="country"  class="vldnoblank vistaStyle">
						<option value="" selected="selected">Select Country</option>
						 <?php foreach($array1 as $data)
				 {
				 echo "<option value=\"".$data['countryid'];?>" <?php if($data['countryid']=="254") {?> selected="selected"<?php }?>><?php echo $data['country']; echo'</option> ';
				 }
				 ?>
						</select>
                <span class="checkStatus"></span></span>
        </div>
		
		<div class="formRow">
				<span class="fieldName"><label for="email">State</label></span>
				<span class="fieldVal"><input type="text" name="state" id="state"  class="vldnoblank vistaStyle width180">
                <span class="checkStatus"></span></span>
        </div>
		
		<div class="formRow">
				<span class="fieldName"><label for="email">City</label></span>
				<span class="fieldVal"><input type="text" name="city" id="city"  class="vldnoblank vistaStyle width180">
                <span class="checkStatus"></span></span>
        </div>
		
		<div class="formRow">
				<span class="fieldName"><label for="zip">Zip code</label></span>
				<span class="fieldVal"><input type="text" name="zip" id="zip"  class="vldnum vldnoblank vistaStyle width180">
                <span class="checkStatus"></span></span>
        </div>
        
       	 <div class="formRow">
				<span class="fieldName"><label for="mm">Date of Birth</label></span>
				<span class="fieldVal">
									
			<select name="mm" id="mm"  class="vldnoblank vistaStyle">
						<option value="" selected="selected">Month</option>
							<option value="1" > Jan  </option>
							<option value="2" > Feb  </option>
							<option value="3" > Mar  </option>
							<option value="4" > Apr  </option>
							<option value="5" > May  </option>
							<option value="6" > Jun  </option>
							<option value="7" > Jul  </option>
							<option value="8" > Aug  </option>
							<option value="9" > Sep  </option>
							<option value="10"> Oct  </option>
							<option value="11" > Nov  </option>
							<option value="12" > Dec  </option>
					</select>
                    
					<select name="dd" id="dd" class="vldnoblank vistaStyle">
						<option value="">Day</option>
						<?php for($i=1;$i<=31;$i++)
						{
						echo '<option value="'.$i.'">'.$i.'</option>';
						}	
						?>
					</select>
                    					
					<select name="yyyy" id="yyyy"  class="vldnoblank vistaStyle">
						<option value="">Year</option>
						<?php $today = date("Y");
							for($i=($today-17);$i!=($today-120);$i--)
							{
							echo '<option value="'.$i.'">'.$i.'</option>';
							}
						?>
					</select>
                    <span class="checkStatus"></span>
			</span>
			</div>
					
        
       <div class="formRow">
				<span class="fieldName"><label for="male">Gender</label></span>
				<span class="fieldVal">
			<input name="gender" id="male" value="male" type="radio"  checked="checked"> Male
			<input name="gender" id="female" value="female" type="radio" > Female <span class="checkStatus" ></span>
		</span>
		</div>

     <div class="formRow">
				<span class="fieldName"><label for="verificationcode">Enter the Code Shown Here</label></span>
				<span class="fieldVal"><img src="picture.php" /><br /><input type="text" name="verificationcode" id="verificationcode"   class="vistaStyle width180"/><span class="checkStatus" ></span></span>
	</div>

    
<div class="formRow">
				<span class="fieldName"></span>
				<span class="fieldVal"><input name="agree" class="vldmustchecked" id="agree" type="checkbox"><label for="agree"> I agree <a href="javascript:loadPage('terms.php','','variable=value');">terms & conditions</a></label>
                <span class="checkStatus"></span></span>
</div>
	<div class="formRow mt mb">
                  	<span class="fieldName"></span>
				<span class="fieldVal"><input type="submit" value="Sign Up" class="bigButton width180">
				</span>
	</div>
-->
    </form>
  </div>
  <!-- </div> -->
  <!--</fieldset>-->
</div>
<?php include "footer.php"; ?>
