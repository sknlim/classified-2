<!-- START OF PANE CODE -->
<div id="dhtmlgoodies_xpPane">
	<div class="dhtmlgoodies_panel">
		<div>
			<!-- Start content of pane -->
			<li style="list-style-image:url(images/search.png)"><a class="my_header" href="search_user.php">Search User</a></li>
			<li style="list-style-image:url(images/list.png)"><a class="my_header" href="listuser.php">List User</a>
            <li style="list-style-image:url(images/sendmail.png)"><a class="my_header" href="sendmail.php">Send Mail</a>
			<!-- End content -->
		</div>	
	</div>
	
	 <div class="dhtmlgoodies_panel">
		<div>
			<!-- Start content of pane -->
            	<li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="category_management.php?type=services_category">Services Category</a> </li>
			<!-- End content -->
		</div>		
	</div>
	
	 <div class="dhtmlgoodies_panel">
		<div>
			<!-- Start content of pane -->
			<li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="category_management.php?type=maincategory">Category</a> </li>
			<li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="sub_category_management.php">Sub Category</a> </li>
           
			<!-- End content -->
		</div>		
	</div>
	
	
	 <div class="dhtmlgoodies_panel">
		<div>
			<!-- Start content of pane -->
			<li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="static_page_management.php">Static Pages</a> </li>
            
			<!-- End content -->
		</div>		
	</div>
	
	 <div class="dhtmlgoodies_panel">
		<div>
			<!-- Start content of pane -->
			<li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="project_management.php">List Projects</a> </li>
           	<li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="category_management.php?type=projects_category">Projects Category</a> </li>
            
			<!-- End content -->
		</div>		
	</div>
	
	<div class="dhtmlgoodies_panel">
		<div>
			<!-- Start content of pane -->
			<li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="job_management.php">List Jobs</a> </li>
           <li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="jobtype_management.php">Jobs Category</a> </li>
            
			<!-- End content -->
		</div>		
	</div>
	
		<div class="dhtmlgoodies_panel">
		<div>
			<!-- Start content of pane -->
			<li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="rent_hire_management.php">Rent or Hire</a> </li>
           <li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="category_management.php?type=rentorhire_category">Rent or Hire Category</a> </li>
			<li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="rentorhire_sub_category.php">Rent or Hire Sub Category</a> </li>
            
			<!-- End content -->
		</div>		
	</div>
	
	<div class="dhtmlgoodies_panel">
		<div>
			<!-- Start content of pane -->
			<li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="transaction_management.php">Transaction</a> </li>
           <li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="trans_escrow_management.php?type=rentorhire_category">Transaction escrow</a> </li>
			<li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="trans_withdraw_management.php?show_for=pending">transaction withdraw</a> </li>
            
			<!-- End content -->
		</div>		
	</div>
	
	<div class="dhtmlgoodies_panel">
		<div>
			<!-- Start content of pane -->
			<li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="currency_management.php">Currency Management</a> </li>
           <li style="list-style-image:url(images/configin.png)">  <a  class="my_header" href="configuration.php">System Configuration</a></li>	
            
			<!-- End content -->
		</div>		
	</div>
  
		<div class="dhtmlgoodies_panel">
		<div>
			<!-- Start content of pane -->
			<li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="helpdesk_management.php">List Open Request</a> </li>
           <li style="list-style-image:url(images/configin.png)">  <a  class="my_header" href="helpdesk_management.php?type=all">List All</a></li>	
            
			<!-- End content -->
		</div>		
	</div>
	
	<div class="dhtmlgoodies_panel">
		<div>
			<!-- Start content of pane -->
			<li style="list-style-image:url(images/contentin.png)"> <a class="my_header" href="contact_management.php">List contact us </a> </li>
          
            
			<!-- End content -->
		</div>		
	</div>
  
    <div class="dhtmlgoodies_panel">
		<div>
			<!-- Start content of pane -->
		<li style="list-style-image:url(images/changepass.png)"> <a  class="my_header" href="changepasswd.php"> Change Password</a></li>
			<!-- End content -->
		</div>		
	</div>
    
    <div class="dhtmlgoodies_panel">
		<div>
			<!-- Start content of pane -->
          <li style="list-style-image:url(images/logoutin.png)"> <a class="my_header" href="logout.php">Logout</a> </li>
            <!-- End content -->
		</div>		
	</div> 
    
</div>
<script type="text/javascript">
/*
Arguments to function
1) Array of titles
2) Array indicating initial state of panels(true = expanded, false = not expanded )
3) Array of cookie names used to remember state of panels
*/
initDhtmlgoodies_xpPane(Array('User Management','Services Management','Area Management','Content Manager','Project Management','Jobs Management','Rent/Hire Management','Transaction','General Configuration','Helpdesk Management','Contact Management','Change Password','Logout'),Array(false,false,false,false,false,false,false,false,false,false,true),Array('pane1','pane2','pane3','pane4','pane5','pane6','pane7','pane8','pane9','pane10','pane11'),Array('images/user.png','images/shopping.png','images/photo.png','images/password.png','images/logout.png'));
</script>
<!-- END OF PANE CONTENT -->
