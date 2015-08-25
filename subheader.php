<div id="main">
<div class="lc">
  <div class="login">
    <div>
    <?php 
	$objuser=new user;
	if($objuser->checkLogin())
	{
	?>
      <ul style="display: block;">
        <li>Logged in as &nbsp;<span class="black_small"><b><?php echo $objuser->getLoggedType(); ?></b></span></li>
        <li>Welcome &nbsp;<span class="black_small"><b><?php echo $objuser->getLoggedUserName().","; ?></b></span></li>
        <li><span class="black_small"><a href="account.php">Manage Account</a></span></li>
        <li><span class="black_small"><a href="javascript:;" onclick="loadPage('changepassword.php');">Change Password</a></span></li>
        <li><span class="black_small"><a href="logout.php">Logout</a></span></li>
      </ul>
     <?php } else { ?> 
      <form name="frmLogin" action="/ajax/user/submit_login.php" method="post" onSubmit="if(validateForm(this)) submitFormOnFloat(this); return false;">
        <div class="formRow"> <span class="inlineBlock" style="width:60px; vertical-align:middle">Email</span>&nbsp;
          <input type="text" name="username" id="username" class="input_box vldnoblank"  style="vertical-align:middle" /><span class="checkStatus"></span>
          <input type="hidden" name="redirect" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];?>" />
		  
        </div>
        <div class="formRow"> <span class="inlineBlock" style="width:60px;  vertical-align:middle">Password</span>&nbsp;
          <input type="password" name="password" id="password" class="input_box_small vldnoblank" style="vertical-align:middle" /><span class="checkStatus"></span>
          <input type="image" src="images/go.gif" style="padding: 0; vertical-align:middle" /> </div>
        <div class="frm" style="text-align: center;">
          <input type="checkbox" name="remember" />
          <small> Remember me.</small></div>
        <div class="frm" style="text-align: center;"><a href="javascript:;" onclick="loadPage('forgot.php');"><small>Forgot password?</small></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="signup.php"><small>New sign up</small></a></div>
      </form>
      <?php } ?>
    </div>
  </div>
  <ul id="leftmenu">
  
  	<?php
	$user_check = new user;
	if($user_check->checklogin())
		{
		$user_data = $user_check->getbyid($user_check->getloggedID());
		if(strtoupper($user_data['type'])=="SEEKER")
			{
			echo '<li><a href="post_project.php">post project</a></li>';
    		echo '<li><a href="post_jobs.php">post jobs</a></li>';
			echo '<li><a href="post_service.php" onclick="javascript:messageBox(\'Only Provider can post services\'); return false;">post service</a></li>';
			echo '<li><a href="post_rentorhire.php" onclick="javascript:messageBox(\'Only Provider can post rent or hire\'); return false;">post things rent or hire</a></li>';
			}
		else if(strtoupper($user_data['type'])=="PROVIDER")
			{
			echo '<li><a href="post_project.php" onclick="javascript:messageBox(\'Only Seeker can post projects\'); return false;">post project</a></li>';
    		echo '<li><a href="post_jobs.php">post jobs</a></li>';
			echo '<li><a href="post_service.php">post service</a></li>';
			echo '<li><a href="post_rentorhire.php">post things rent or hire</a></li>';
			}
		}
	else
		{
		echo '<li><a href="post_project.php" onclick="javascript:messageBox(\'Please Login \'); return false;">post project</a></li>';
		echo '<li><a href="post_service.php" onclick="javascript:messageBox(\'Please Login \'); return false;">post service</a></li>';
    	echo '<li><a href="post_jobs.php" onclick="javascript:messageBox(\'Please Login \'); return false;">post jobs</a></li>';
		echo '<li><a href="post_rentorhire.php" onclick="javascript:messageBox(\'Please Login \'); return false;">post things rent or hire</a></li>';
		}
	?>
	<li><a href="view_projects.php">projects listing</a></li>
    <li><a href="jobs.php">job listing</a></li>
	<li><a href="services.php">service listing</a></li>
	<li><a href="rentorhire.php">rent or hire listing</a></li>
    <li><a href="featured_project.php">featured projects</a></li>
    <li><a href="certified_members.php">certified members</a></li>
    <li><a href="top_service_provider.php">top service provider</a></li>
    <li><a href="/forum/">forum</a></li>
    <li><a href="contactus.php">contact us</a></li>
    <li><?php
		if($user_check->checklogin())
			echo '<a href="helpdesk.php" >helpdesk</a>';
		else
			echo '<a href="helpdesk.php" onclick="javascript:messageBox(\'Please Login \'); return false;">helpdesk</a>';
		?>
		</li>
  </ul>
</div>
<div class="rc">
