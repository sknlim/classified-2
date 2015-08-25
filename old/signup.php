<?php include "header.php"; ?>
<script language="javascript" src="js/createaccount.js"></script>
<div id="twocolumn_broadNarrow">
<div class="lc">
<center>
<h2 class="mt"><span class="textStep"> Create your account.</span></h2>
</center>
<form name="frmCreateAccount" method="POST" action="ajax/create/account.php" onsubmit="return checkCreateAccount();">
		 <div class="formRow">
				<span class="fieldName"><label for="username">Username</label></span>
				<span class="fieldVal"><input type="text" name="username" id="username" class="vistaStyle width180">
                <span class="checkStatus"></span></span>
        </div>
         
         <div class="formRow">
				<span class="fieldName"><label for="email">Email Address</label></span>
				<span class="fieldVal"><input type="text" name="email" id="email"  class="vistaStyle width180">
                <span class="checkStatus"></span></span>
        </div>
        
         <div class="formRow">
				<span class="fieldName"><label for="retypeemail">Retype Email Address</label></span>
				<span class="fieldVal"><input type="text" name="retypeemail" id="retypeemail"  class="vistaStyle width180">
                <span class="checkStatus"></span>
            	<small>An email verification will be sent here</small>
           </span>
		</div>

        
         <div class="formRow">
				<span class="fieldName"><label for="password">Password</label></span>
				<span class="fieldVal"><input type="password" name="password" id="password"  class="vistaStyle width180"><span class="checkStatus"></span>
            <small>(6-10 characters)</small>
           </span>
			</div>

         <div class="formRow">
				<span class="fieldName"><label for="retypepassword">Retype Password</label></span>
				<span class="fieldVal"><input type="password" name="retypepassword" id="retypepassword"  class="vistaStyle width180"><span class="checkStatus"></span></span>
			</div>

        
       	 <div class="formRow">
				<span class="fieldName"><label for="mm">Date of Birth</label></span>
				<span class="fieldVal">
									
			<select name="mm" id="mm"  class="vistaStyle">
						<option value="0" selected="selected">Month</option>
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
                    
					<select name="dd" id="dd" class="vistaStyle">
						<option value="0">Day</option>
						<?php for($i=1;$i<=31;$i++)
						{
						echo '<option value="'.$i.'">'.$i.'</option>';
						}	
						?>
					</select>
                    					
					<select name="yyyy" id="yyyy"  class="vistaStyle">
						<option value="0">Year</option>
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
				<span class="fieldVal"><img src="picture.php" /><br /><input type="text" name="verificationcode" id="verificationcode"  class="vistaStyle width180"/><span class="checkStatus" ></span></span>
	</div>

    
<div class="formRow">
				<span class="fieldName"></span>
				<span class="fieldVal"><input name="agree" id="agree" type="checkbox"><label for="agree"> I agree <a href="javascript:loadPage('terms.php','','variable=value');">terms & conditions</a></label>
                <span class="checkStatus"></span></span>
</div>
	<div class="formRow mt mb">
                  	<span class="fieldName"></span>
				<span class="fieldVal"><input type="submit" value="Sign Up" class="bigButton width180">
				</span>
	</div>
    
</form>				    
</div>
<div class="rc"><h3>About Foongigs Services!</h3>
<p style="padding-left: 20px; padding-top: 20px;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec sed est ac enim gravida gravida. Cras dolor. Donec aliquet. Etiam in orci ac eros venenatis fermentum. Fusce venenatis, lorem pharetra lobortis volutpat, ligula risus molestie ligula, a tristique est pede et mi. Fusce commodo diam luctus lorem. In in ante et nisl feugiat aliquam. Nunc vestibulum mauris sit amet ipsum vehicula placerat. Suspendisse nibh turpis, aliquam ut, aliquet vitae, adipiscing quis, nisl. Praesent leo. Aenean egestas suscipit purus.</p>
</div>
</div>
<?php include "footer.php"; ?>
